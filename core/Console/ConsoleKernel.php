<?php

namespace Core\Console;

use Symfony\Component\Console\Application as SymfonyApp;
use Core\Foundation\Application;
use Core\Commands\Executor\Commander;

class ConsoleKernel
{
    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;

        require_once 'core/Utils/helpers.php';
        require_once 'core/Migrations/Migrate.php';
        require_once 'core/Migrations/Blueprint.php';
    }

    public function handle(): int
    {
        $symfony = new SymfonyApp(
            "Welcome to " . Application::framework() .
            " by Kashif Sohail, Version: " . Application::version()
        );

        // Register all commands
        $commander = new Commander($symfony);
        $command   = $commander->register();

        // Important: still call init() but via kernel
        $this->app->init($command);

        return $symfony->run();
    }
}
