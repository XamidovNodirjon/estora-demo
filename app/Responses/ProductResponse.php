<?php

namespace App\Responses;

use App\Models\Product;

class ProductResponse
{
    /**
     * Format a single product for API or output.
     */
    public static function format(Product $product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => (float) $product->price,
            'price_formatted' => number_format((float) $product->price, 0, '.', ' ') . ' UZS',
            'description' => $product->description,
            'images' => $product->images ?? [],
            'phone' => $product->phone,
            'floor' => $product->floor,
            'building_floor' => $product->building_floor,
            'square' => $product->square,
            'rooms' => $product->rooms,
            'repair' => $product->repair,
            'sotix' => $product->sotix,
            'status' => $product->status,
            'landmark' => $product->landmark,
            'exchange' => (bool) $product->exchange,
            'pay_in_installments' => (bool) $product->pay_in_installments,
            'credit' => (bool) $product->credit,
            'category' => $product->category ? [
                'id' => $product->category->id,
                'name' => $product->category->name,
            ] : null,
            'subcategory' => $product->subCategory ? [
                'id' => $product->subCategory->id,
                'name' => $product->subCategory->name,
            ] : null,
            'region' => $product->region ? [
                'id' => $product->region->id,
                'name' => $product->region->name,
            ] : null,
            'city' => $product->city ? [
                'id' => $product->city->id,
                'name' => $product->city->name,
            ] : null,
            'user' => $product->user ? [
                'id' => $product->user->id,
                'name' => $product->user->name,
            ] : null,
            'items' => $product->items ? $product->items->pluck('name')->toArray() : [],
            'created_at' => $product->created_at ? $product->created_at->format('d.m.Y H:i') : null,
        ];
    }

    /**
     * Format a collection of products.
     */
    public static function formatCollection($products): array
    {
        $formatted = [];
        foreach ($products as $product) {
            $formatted[] = self::format($product);
        }
        return $formatted;
    }
}
