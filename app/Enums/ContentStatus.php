<?php

namespace App\Enums;

enum ContentStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';

    /**
     * Get all available status values as an array.
     * Useful for validation rules (e.g., `in:`).
     *
     * @return array<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all available status options as a key-value pair array.
     * Useful for select box options (value => label).
     *
     * @return array<string, string>
     */
    public static function toArray(): array
    {
        return [
            self::Draft->value => 'Draft',
            self::Published->value => 'Published',
            self::Archived->value => 'Archived',
        ];
    }
}
