<?php

namespace App\DTOs;

class RegisterDto
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public ?string $name = null,
        public ?string $email = null,
        public ?string $username = null,
        public ?string $phone = null,
        public ?string $passport = null,
        public ?string $jshshir = null,
        public string $password = '',
        public ?string $role = 'client'
    ) {
        if (empty($this->name)) {
            $this->name = trim("{$this->first_name} {$this->last_name}");
        }
    }

    public static function fromArray(array $data): self
    {
        $firstName = $data['first_name'] ?? '';
        $lastName = $data['last_name'] ?? '';

        if (empty($firstName) && !empty($data['name'])) {
            $parts = explode(' ', trim($data['name']), 2);
            $firstName = $parts[0] ?? '';
            $lastName = $parts[1] ?? '';
        }

        $fullName = $data['name'] ?? trim("{$firstName} {$lastName}");

        return new self(
            first_name: $firstName,
            last_name: $lastName,
            name: $fullName,
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->name,
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
