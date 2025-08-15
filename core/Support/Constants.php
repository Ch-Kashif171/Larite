<?php

namespace Core\Support;

class Constants
{
    const MIGRATION_DIR = 'database/migrations';

    const SEEDER_DIR = 'database/seeders';

    const PROVIDER_DIR = 'app/Providers';

    const MIDDLEWARE_DIR = 'app/Http/Middleware';

    const CONSOLE_DIR = 'app/Console/Commands';

    const METHODS = ['GET' => 'GET', 'POST' => 'POST', 'PUT' => 'PUT', 'DELETE' => 'DELETE', 'PATCH' => 'PATCH'];

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

    const WHERE_BETWEENS = ['whereBetween', 'orWhereBetween', 'whereNotBetween', 'orWhereNotBetween'];
}