<?php

namespace Core\Commands\Executor;

use App\Console\Kernel;
use Core\Commands\CreateControllerCommand;
use Core\Commands\CreateMigrationCommand;
use Core\Commands\CreateModelCommand;
use Core\Commands\DatabaseSeedCommand;
use Core\Commands\MakeAuth;
use Core\Commands\MakeCommandCommand;
use Core\Commands\MakeMiddlewareCommand;
use Core\Commands\MakeSeederCommand;
use Core\Commands\MigrationCommand;
use Core\Commands\RollbackMigrationCommand;
use Core\Commands\RouteListCommand;
use Core\Dotenv\Dotenv;

use Core\Scheduling\ScheduleRun;
use Core\Support\DBQuery;
use Symfony\Component\Console\Application;

class Commander
{
    protected Application $app;

    /**
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->loadEnv();

        $this->app = $application;
    }

    /**
     * @return void
     */
    private function registerCoreCommands()
    {
        $coreCommands = [
            CreateControllerCommand::class,
            CreateModelCommand::class,
            MakeAuth::class,
            MigrationCommand::class,
            CreateMigrationCommand::class,
            RollbackMigrationCommand::class,
            MakeSeederCommand::class,
            DatabaseSeedCommand::class,
            RouteListCommand::class,
            MakeMiddlewareCommand::class,
            MakeCommandCommand::class,
        ];

        foreach ($coreCommands as $command) {
            $this->app->add(new $command);
        }
    }

    /**
     * @return void
     */
    private function registerCustomCommands()
    {
        $this->app->add(new ScheduleRun());

        $kernel = new Kernel();

        foreach ($kernel->getCommands() as $command) {
            $this->app->add(new $command);
        }
    }


    /**
     * @return Application
     */
    public function register(): Application
    {
        // Bind DB facade (need to bind for cli her)
        app('db', new DBQuery());

        $this->registerCoreCommands();

        $this->registerCustomCommands();

        return $this->app;
    }

    /**
     * @return void
     */
    private function loadEnv()
    {
        $dotenv = new Dotenv(ROOT_PATH);
        $dotenv->load();
    }
}