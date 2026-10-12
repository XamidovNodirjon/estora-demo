<?php

namespace App\Enums;

enum LeadStatus: string
{
    case New = 'new';
    case InProgress = 'in_progress';
    case Rejected = 'rejected';
    case Agreed = 'agreed';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Yangi',
            self::InProgress => 'Jarayonda',
            self::Rejected => 'Rad etildi',
            self::Agreed => 'Kelishuvga erishildi',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::New => 'fa-star',
            self::InProgress => 'fa-hourglass-half',
            self::Rejected => 'fa-circle-xmark',
            self::Agreed => 'fa-handshake',
        };
    }

    /**
     * Tailwind classes for badges / pills.
     */
    public function badgeClasses(): string
    {
        return match ($this) {
            self::New => 'bg-blue-50 text-blue-700 border-blue-100',
            self::InProgress => 'bg-amber-50 text-amber-700 border-amber-100',
            self::Rejected => 'bg-red-50 text-red-700 border-red-100',
            self::Agreed => 'bg-emerald-50 text-emerald-700 border-emerald-100',
        };
    }

    /**
     * Tailwind classes for the icon tile of stat cards.
     */
    public function iconClasses(): string
    {
        return match ($this) {
            self::New => 'bg-blue-500/10 text-blue-600',
            self::InProgress => 'bg-amber-500/10 text-amber-600',
            self::Rejected => 'bg-red-500/10 text-red-600',
            self::Agreed => 'bg-emerald-500/10 text-emerald-600',
        };
    }

    public function dotClass(): string
    {
        return match ($this) {
            self::New => 'bg-blue-500',
            self::InProgress => 'bg-amber-500',
            self::Rejected => 'bg-red-500',
            self::Agreed => 'bg-emerald-500',
        };
    }

    /**
     * Rejection must be explained in detail, other statuses need a short note.
     */
    public function commentMinLength(): int
    {
        return $this === self::Rejected ? 20 : 5;
    }

    public function commentHint(): string
    {
        return match ($this) {
            self::New => 'Nima uchun lid qayta "Yangi" holatiga qaytarilayotganini yozing.',
            self::InProgress => 'Mijoz bilan qanday aloqa qilindi va keyingi qadam nima?',
            self::Rejected => 'Rad etilish sababini aniq yozing: mijoz nima dedi, nima uchun kelishilmadi?',
            self::Agreed => 'Qaysi uy, qanday shartlar va narx bo\'yicha kelishildi?',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Status meta for front-end (status change modal).
     */
    public static function toFrontend(): array
    {
        return collect(self::cases())->mapWithKeys(fn (self $status) => [
            $status->value => [
                'label' => $status->label(),
                'icon' => $status->icon(),
                'badge' => $status->badgeClasses(),
                'min' => $status->commentMinLength(),
                'hint' => $status->commentHint(),
            ],
        ])->all();
    }
}
