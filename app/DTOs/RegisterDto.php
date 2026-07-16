<?php

namespace App\DTOs;

class RegisterDto
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $username,
        public ?string $phone,
        public ?string $passport,
        public ?string $jshshir,
        public string $password
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            username: $data['username'] ?? null,
            phone: $data['phone'] ?? null,
            passport: $data['passport'] ?? null,
            jshshir: $data['jshshir'] ?? null,
            password: $data['password']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'phone' => $this->phone,
            'passport' => $this->passport,
            'jshshir' => $this->jshshir,
            'password' => $this->password,
        ];
    }
}
