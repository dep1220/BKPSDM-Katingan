<?php

namespace App\Enums;

enum AgendaStatus: string
{
    case UPCOMING = 'upcoming';
    case ONGOING = 'ongoing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    /**
     * Get the label for the status
     */
    public function label(): string
    {
        return match($this) {
            self::UPCOMING => 'Akan Datang',
            self::ONGOING => 'Sedang Berlangsung',
            self::COMPLETED => 'Selesai',
            self::CANCELLED => 'Dibatalkan',
        };
    }

    /**
     * Get the color class for the status
     */
    public function color(): string
    {
        return match($this) {
            self::UPCOMING => 'bg-blue-100 text-blue-800',
            self::ONGOING => 'bg-green-100 text-green-800',
            self::COMPLETED => 'bg-gray-100 text-gray-800',
            self::CANCELLED => 'bg-red-100 text-red-800',
        };
    }

    /**
     * Get all status options for select dropdown
     */
    public static function options(): array
    {
        return [
            self::UPCOMING->value => self::UPCOMING->label(),
            self::ONGOING->value => self::ONGOING->label(),
            self::COMPLETED->value => self::COMPLETED->label(),
            self::CANCELLED->value => self::CANCELLED->label(),
        ];
    }
}
