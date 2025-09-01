<?php

namespace Core\Commands;

use Database\Seeders\DatabaseSeeder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseSeedCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('db:seed')
            ->setDescription('Seed the database using DatabaseSeeder class or a specific seeder.')
            ->addOption(
                'class',
                null,
                InputOption::VALUE_OPTIONAL,
                'The name of the seeder class to run'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $class = $input->getOption('class');

            if ($class) {
                // If the user didn't provide a full namespace, prefix it
                if (!str_contains($class, '\\')) {
                    $class = "Database\\Seeders\\{$class}";
                }

                $output->writeln("<info>Seeding with {$class}...</info>");

                if (!class_exists($class)) {
                    $output->writeln("<error>Seeder class {$class} not found.</error>");
                    return Command::FAILURE;
                }

                $seeder = new $class();
                $seeder->run();

                $output->writeln("<info>{$class} completed successfully.</info>");
            } else {
                // Run all seeders via DatabaseSeeder
                $seeder = new DatabaseSeeder();
                $seeder->run();

                $output->writeln('<info>Database seeding completed successfully.</info>');
            }
        } catch (\Throwable $e) {
            $output->writeln('<error>Error while seeding: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
