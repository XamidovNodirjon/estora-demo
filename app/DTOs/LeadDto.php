<?php

namespace App\DTOs;

class LeadDto
{
    public function __construct(
        public string $name,
        public string $phone,
        public ?string $description = null,
        public ?int $manager_id = null
    ) {}

    public static function fromArray(array $data): self
    {
        $description = isset($data['description']) ? trim($data['description']) : null;

        return new self(
            name: trim($data['name']),
            phone: trim($data['phone']),
            description: $description !== '' ? $description : null,
            manager_id: !empty($data['manager_id']) ? (int) $data['manager_id'] : null
        );
    }

    /**
     * Columns of the leads table only (manager assignment lives in the polymorphic pivot).
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'description' => $this->description,
        ];
    }
}
