<?php

namespace App\Console\Commands;

use Core\Console\BaseCommand;

class CommandTemplate extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected static string $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected static string $description = 'Command description here';

    /**
     * Execute the console command logic.
     */
    public function handle(): int
    {
        $this->output->writeln('Command executed from handle()!');
        return 0;
    }
}
