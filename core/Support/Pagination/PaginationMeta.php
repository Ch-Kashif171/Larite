<?php

namespace Core\Support\Pagination;

final class PaginationMeta
{
    public const KEYS = [
        'total',
        'page',
        'per_page',
        'current_page',
        'last_page',
        'from',
        'to',
        'first_page_url',
        'last_page_url',
        'next_page_url',
        'prev_page_url',
        'path',
    ];

    public static function keys(): array
    {
        return self::KEYS;
    }
}
