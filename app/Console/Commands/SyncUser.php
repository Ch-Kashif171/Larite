<?php

namespace App\Console\Commands;

use Core\Console\BaseCommand;

class SyncUser extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected string $name  = 'sync:user';


    /**
     * The console command description.
     *
     * @var string
     */
    protected string $description = 'Command description here';

    /**
     * Execute the console command logic.
     */
    public function handle(): int
    {
        $this->info('✔ Sync complete!');

        return 0;
    }
}
