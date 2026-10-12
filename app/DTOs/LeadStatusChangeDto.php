<?php

namespace App\DTOs;

use App\Enums\LeadStatus;

class LeadStatusChangeDto
{
    public function __construct(
        public LeadStatus $status,
        public string $comment
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            status: LeadStatus::from($data['status']),
            comment: trim($data['comment'])
        );
    }
}
