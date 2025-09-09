<?php

namespace App\Enums;

enum BeritaStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';

    /**
     * Memberikan label yang lebih ramah untuk ditampilkan di frontend.
     */
    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
        };
    }
}