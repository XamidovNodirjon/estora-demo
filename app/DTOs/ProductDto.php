<?php

namespace App\DTOs;

class ProductDto
{
    public function __construct(
        public ?int $category_id,
        public ?int $subcategory_id,
        public ?int $user_id,
        public ?int $region_id,
        public ?int $city_id,
        public ?string $name,
        public ?float $price,
        public ?string $description,
        public array $images,
        public ?string $phone,
        public ?int $floor,
        public ?int $building_floor,
        public ?int $square,
        public ?int $rooms,
        public ?string $repair,
        public ?int $sotix,
        public string $status,
        public ?string $landmark,
        public bool $exchange,
        public bool $pay_in_installments,
        public bool $credit,
        public array $items = [],
        public array $metros = [],
        public array $universities = []
    ) {}

    /**
     * Create DTO from request validated data or array.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            category_id: isset($data['category_id']) ? (int) $data['category_id'] : null,
            subcategory_id: isset($data['subcategory_id']) ? (int) $data['subcategory_id'] : null,
            user_id: isset($data['user_id']) ? (int) $data['user_id'] : auth()->id(),
            region_id: isset($data['region_id']) ? (int) $data['region_id'] : null,
            city_id: isset($data['city_id']) ? (int) $data['city_id'] : null,
            name: $data['name'] ?? null,
            price: isset($data['price']) ? (float) $data['price'] : null,
            description: $data['description'] ?? null,
            images: $data['images'] ?? [],
            phone: $data['phone'] ?? null,
            floor: isset($data['floor']) ? (int) $data['floor'] : null,
            building_floor: isset($data['building_floor']) ? (int) $data['building_floor'] : null,
            square: isset($data['square']) ? (int) $data['square'] : null,
            rooms: isset($data['rooms']) ? (int) $data['rooms'] : null,
            repair: $data['repair'] ?? null,
            sotix: isset($data['sotix']) ? (int) $data['sotix'] : null,
            status: $data['status'] ?? 'active',
            landmark: $data['landmark'] ?? null,
            exchange: filter_var($data['exchange'] ?? false, FILTER_VALIDATE_BOOLEAN),
            pay_in_installments: filter_var($data['pay_in_installments'] ?? false, FILTER_VALIDATE_BOOLEAN),
            credit: filter_var($data['credit'] ?? false, FILTER_VALIDATE_BOOLEAN),
            items: $data['items'] ?? [],
            metros: $data['metros'] ?? [],
            universities: $data['universities'] ?? []
        );
    }

    /**
     * Convert DTO to array format suitable for model fillable columns.
     */
    public function toArray(): array
    {
        return [
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'user_id' => $this->user_id,
            'region_id' => $this->region_id,
            'city_id' => $this->city_id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'images' => $this->images,
            'phone' => $this->phone,
            'floor' => $this->floor,
            'building_floor' => $this->building_floor,
            'square' => $this->square,
            'rooms' => $this->rooms,
            'repair' => $this->repair,
            'sotix' => $this->sotix,
            'status' => $this->status,
            'landmark' => $this->landmark,
            'exchange' => $this->exchange,
            'pay_in_installments' => $this->pay_in_installments,
            'credit' => $this->credit,
        ];
    }
}
