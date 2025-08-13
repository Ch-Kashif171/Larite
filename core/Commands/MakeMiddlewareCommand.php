<?php

namespace Core\Commands;

use Core\Support\Constants;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeMiddlewareCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('make:middleware')
            ->setDescription('Create a new middleware class.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the middleware class');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $className = trim($input->getArgument('name'));
        $className = preg_replace('/[^A-Za-z0-9_]/', '', $className);
        $fileName = $className . '.php';
        $path = base_path() . '/' . Constants::MIDDLEWARE_DIR;

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $filePath = $path . '/' . $fileName;

        if (file_exists($filePath)) {
            $output->writeln("<error>Middleware '{$className}' already exists!</error>");
            return Command::FAILURE;
        }

        $stubPath = ROOT_PATH . '/core/Templates/Middleware/MiddlewareTemplate.php';

        if (!file_exists($stubPath)) {
            $output->writeln("<error>Stub file 'MiddlewareTemplate.php' not found at ".Constants::MIDDLEWARE_DIR.".</error>");
            return Command::FAILURE;
        }

        $content = file_get_contents($stubPath);

        $className = ucfirst(basename(str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $className)));
        $middlewareContent = str_replace('MiddlewareTemplate', $className, $content);

        file_put_contents($filePath, $middlewareContent);

        $output->writeln("<info>Middleware '{$className}' created at: ".Constants::MIDDLEWARE_DIR."/{$fileName}</info>");

        return Command::SUCCESS;
    }
}