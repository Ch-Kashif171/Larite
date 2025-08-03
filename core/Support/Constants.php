<?php

namespace Core\Support;

class Constants
{
    const MIGRATION_DIR = 'database/migrations';

    const SEEDER_DIR = 'database/seeders';

    const MIDDLEWARE_DIR = 'app/Http/Middleware';

    const CONSOLE_DIR = 'app/Console/Commands';

    const METHODS = ['GET' => 'GET', 'POST' => 'POST', 'PUT' => 'PUT', 'DELETE' => 'DELETE', 'PATCH' => 'PATCH'];
}