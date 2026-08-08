<?php

namespace App\DTOs;

class ProfileUpdateDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $username,
        public ?string $phone = null,
        public ?string $passport = null,
        public ?string $jshshir = null,
        public ?string $password = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            username: $data['username'],
            phone: $data['phone'] ?? null,
            passport: $data['passport'] ?? null,
            jshshir: $data['jshshir'] ?? null,
            password: !empty($data['password']) ? $data['password'] : null
        );
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'phone' => $this->phone,
            'passport' => $this->passport,
            'jshshir' => $this->jshshir,
        ];

        if ($this->password !== null) {
            $data['password'] = $this->password;
        }

        return $data;
    }
}
