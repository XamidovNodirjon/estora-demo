<?php

namespace App\DTOs;

class RegisterDto
{
    public function __construct(
        public string $name,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $email = null,
        public ?string $username = null,
        public ?string $phone = null,
        public ?string $passport = null,
        public ?string $jshshir = null,
        public string $password = '',
        public ?string $role = 'client'
    ) {}

    public static function fromArray(array $data): self
    {
        $firstName = $data['first_name'] ?? null;
        $lastName = $data['last_name'] ?? null;

        $name = $data['name'] ?? null;
        if (!$name && ($firstName || $lastName)) {
            $name = trim(($lastName ?? '') . ' ' . ($firstName ?? ''));
        }

        return new self(
            name: $name ?? '',
            firstName: $firstName,
            lastName: $lastName,
            email: $data['email'] ?? null,
            username: $data['username'] ?? null,
            phone: $data['phone'] ?? null,
            passport: $data['passport'] ?? null,
            jshshir: $data['jshshir'] ?? null,
            password: $data['password'] ?? '',
            role: $data['role'] ?? 'client'
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'username' => $this->username,
            'phone' => $this->phone,
            'passport' => $this->passport,
            'jshshir' => $this->jshshir,
            'password' => $this->password,
            'role' => $this->role ?? 'client',
        ];
    }
}
