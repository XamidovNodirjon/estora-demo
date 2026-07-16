<?php

namespace App\DTOs;

class SubCategoryDto
{
    public function __construct(
        public int $category_id,
        public string $name
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            category_id: (int) $data['category_id'],
            name: $data['name']
        );
    }

    public function toArray(): array
    {
        return [
            'category_id' => $this->category_id,
            'name' => $this->name,
        ];
    }
}
