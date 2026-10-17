<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\Region;
use App\Models\SubCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Builds the home page "market analytics" widget data from real listings:
 * average price per m² of residential sale listings (Kvartira, Hovli),
 * per region and per district (tuman).
 */
class MarketAnalyticsService
{
    private const SALE_CATEGORY = 'Sotuv';
    private const RESIDENTIAL_TYPES = ['Kvartira', 'Hovli'];

    // Listings outside this $/m² range are treated as data-entry mistakes.
    private const MIN_PRICE_PER_M2 = 50;
    private const MAX_PRICE_PER_M2 = 20000;

    // Trend compares the last N days with the N days before that.
    private const TREND_WINDOW_DAYS = 90;
    private const TREND_MIN_SAMPLE = 3;

    private const SERIES_MONTHS = 6;

    private const CAPITAL_REGION_ID = 1;

    public function regionAnalytics(): Collection
    {
        $listings = $this->residentialSaleListings();
        $byRegion = $listings->groupBy('region_id');

        return Region::with('cities')->orderBy('id')->get()->map(function (Region $region) use ($byRegion) {
            $regionListings = $byRegion->get($region->id, collect());
            $byCity = $regionListings->groupBy('city_id');

            $districts = $region->cities
                ->map(function ($city) use ($byCity) {
                    $cityListings = $byCity->get($city->id, collect());
                    if ($cityListings->isEmpty()) {
                        return null;
                    }

                    $avgM2 = (int) round($cityListings->avg('price_per_m2'));
                    $avgPrice = (int) round($cityListings->avg('price'));

                    return [
                        'id' => $city->id,
                        'name' => $city->name,
                        'short_name' => $this->shortName($city->name),
                        'lat' => (float) $city->lat,
                        'lng' => (float) $city->long,
                        'count' => $cityListings->count(),
                        'avg_m2' => $avgM2,
                        'm2_formatted' => $this->formatM2($avgM2),
                        'price_formatted' => '$' . number_format($avgPrice),
                    ];
                })
                ->filter()
                ->sortByDesc('avg_m2')
                ->values();

            $count = $regionListings->count();
            $avgM2 = $count > 0 ? (int) round($regionListings->avg('price_per_m2')) : null;

            return [
                'id' => $region->id,
                'name' => $region->name,
                'lat' => (float) $region->lat,
                'lng' => (float) $region->long,
                'zoom' => $region->id === self::CAPITAL_REGION_ID ? 11 : 8,
                'count' => $count,
                'avg_m2' => $avgM2,
                'avg_m2_formatted' => $avgM2 !== null ? $this->formatM2($avgM2) : '—',
                'trend' => $this->trend($regionListings),
                'series' => $this->monthlySeries($regionListings),
                'districts' => $districts,
            ];
        });
    }

    /**
     * Region to show first: the capital if it has data, otherwise the busiest region.
     */
    public function defaultRegionId(Collection $analytics): ?int
    {
        $capital = $analytics->firstWhere('id', self::CAPITAL_REGION_ID);
        if ($capital && $capital['count'] > 0) {
            return $capital['id'];
        }

        $busiest = $analytics->sortByDesc('count')->first();

        return $busiest && $busiest['count'] > 0
            ? $busiest['id']
            : ($capital['id'] ?? $busiest['id'] ?? null);
    }

    private function residentialSaleListings(): Collection
    {
        $saleCategoryId = Category::where('name', self::SALE_CATEGORY)->value('id');
        if (!$saleCategoryId) {
            return collect();
        }

        $residentialIds = SubCategory::where('category_id', $saleCategoryId)
            ->whereIn('name', self::RESIDENTIAL_TYPES)
            ->pluck('id');

        return Product::query()
            ->where('status', 'active')
            ->where('category_id', $saleCategoryId)
            ->whereIn('subcategory_id', $residentialIds)
            ->whereNotNull('region_id')
            ->where('price', '>', 0)
            ->where('square', '>', 0)
            ->toBase()
            ->get(['region_id', 'city_id', 'price', 'square', 'created_at'])
            ->map(function ($row) {
                $price = (float) $row->price;

                return [
                    'region_id' => (int) $row->region_id,
                    'city_id' => $row->city_id !== null ? (int) $row->city_id : null,
                    'price' => $price,
                    'price_per_m2' => $price / (float) $row->square,
                    'created_at' => Carbon::parse($row->created_at),
                ];
            })
            ->filter(fn ($row) => $row['price_per_m2'] >= self::MIN_PRICE_PER_M2
                && $row['price_per_m2'] <= self::MAX_PRICE_PER_M2)
            ->values();
    }

    /**
     * Percent change of average $/m² for listings posted in the last window
     * versus the window before it. Null when there is too little data.
     */
    private function trend(Collection $listings): ?float
    {
        $now = now();
        $recentFrom = $now->copy()->subDays(self::TREND_WINDOW_DAYS);
        $previousFrom = $now->copy()->subDays(self::TREND_WINDOW_DAYS * 2);

        $recent = $listings->filter(fn ($row) => $row['created_at']->gte($recentFrom));
        $previous = $listings->filter(fn ($row) => $row['created_at']->gte($previousFrom)
            && $row['created_at']->lt($recentFrom));

        if ($recent->count() < self::TREND_MIN_SAMPLE || $previous->count() < self::TREND_MIN_SAMPLE) {
            return null;
        }

        $previousAvg = $previous->avg('price_per_m2');

        return round(($recent->avg('price_per_m2') - $previousAvg) / $previousAvg * 100, 1);
    }

    /**
     * Average $/m² per calendar month over the last few months (months without listings are skipped).
     */
    private function monthlySeries(Collection $listings): array
    {
        $from = now()->startOfMonth()->subMonths(self::SERIES_MONTHS - 1);

        return $listings
            ->filter(fn ($row) => $row['created_at']->gte($from))
            ->groupBy(fn ($row) => $row['created_at']->format('Y-m'))
            ->sortKeys()
            ->map(fn ($rows, $month) => [
                'month' => $month,
                'value' => (int) round($rows->avg('price_per_m2')),
            ])
            ->values()
            ->all();
    }

    private function shortName(string $name): string
    {
        return trim(preg_replace('/\s+(tumani|shahri|shahar)$/u', '', $name));
    }

    private function formatM2(int $value): string
    {
        return '$' . number_format($value) . '/m²';
    }
}
