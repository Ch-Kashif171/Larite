<?php

namespace Core\Commands;

use Core\Support\Constants;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCommandCommand extends Command
{
    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setName('make:command')
            ->setDescription('Create a new console command.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the command class');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $className = trim($input->getArgument('name'));
        $fileName = $className . '.php';
        $directory = base_path() .DIRECTORY_SEPARATOR. Constants::CONSOLE_DIR;

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filePath = $directory . DIRECTORY_SEPARATOR . $fileName;

        if (file_exists($filePath)) {
            $output->writeln("<error>Command '{$className}' already exists!</error>");
            return Command::FAILURE;
        }

        $stubPath = root_path . '/core/Templates/Console/CommandTemplate.php';

        if (!file_exists($stubPath)) {
            $output->writeln("<error>file not found at core/Templates/Console/CommandTemplate.php</error>");
            return Command::FAILURE;
        }

        $stub = file_get_contents($stubPath);
        $stub = str_replace('CommandTemplate', $className, $stub);

        file_put_contents($filePath, $stub);
        $output->writeln("<info>Console command '{$className}' created at ".Constants::CONSOLE_DIR."/{$fileName}</info>");

        return Command::SUCCESS;
    }
}