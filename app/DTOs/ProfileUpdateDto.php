<?php

namespace App\DTOs;

class ProfileUpdateDto
{
    public function __construct(
        public ?string $name = null,
        public ?string $first_name = null,
        public ?string $last_name = null,
        public ?string $email = null,
        public ?string $username = null,
        public ?string $phone = null,
        public ?string $passport = null,
        public ?string $jshshir = null,
        public ?string $password = null
    ) {
        if (empty($this->name) && (!empty($this->first_name) || !empty($this->last_name))) {
            $this->name = trim("{$this->first_name} {$this->last_name}");
        }
    }

    public static function fromArray(array $data): self
    {
        $firstName = $data['first_name'] ?? null;
        $lastName = $data['last_name'] ?? null;
        $name = $data['name'] ?? null;

        if (empty($name) && ($firstName || $lastName)) {
            $name = trim("{$firstName} {$lastName}");
        }

        return new self(
            name: $name,
            first_name: $firstName,
            last_name: $lastName,
            email: $data['email'] ?? null,
            username: $data['username'] ?? null,
            phone: $data['phone'] ?? null,
            passport: $data['passport'] ?? null,
            jshshir: $data['jshshir'] ?? null,
            password: !empty($data['password']) ? $data['password'] : null
        );
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->first_name !== null) {
            $data['first_name'] = $this->first_name;
        }
        if ($this->last_name !== null) {
            $data['last_name'] = $this->last_name;
        }
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        if ($this->email !== null) {
            $data['email'] = $this->email;
        }
        if ($this->username !== null) {
            $data['username'] = $this->username;
        }
        if ($this->phone !== null) {
            $data['phone'] = $this->phone;
        }
        if ($this->passport !== null) {
            $data['passport'] = $this->passport;
        }
        if ($this->jshshir !== null) {
            $data['jshshir'] = $this->jshshir;
        }
        if ($this->password !== null) {
            $data['password'] = $this->password;
        }

        return $data;
    }
}
