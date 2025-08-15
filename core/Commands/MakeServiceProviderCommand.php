<?php

namespace Core\Commands;

use Core\Support\Constants;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeServiceProviderCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('make:provider')
            ->setDescription('Create a new service provider class.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the seeder class');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $className = trim($input->getArgument('name'));
        $className = preg_replace('/[^A-Za-z0-9_]/', '', $className);
        $fileName = $className . '.php';
        $path = base_path() . '/' . Constants::PROVIDER_DIR;

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $filePath = ROOT_PATH . '/'.Constants::PROVIDER_DIR.'/' . $fileName;

        if (file_exists($filePath)) {
            $output->writeln("<error>Provider '{$className}' already exists!</error>");
            return Command::FAILURE;
        }

        $stubPath = ROOT_PATH . '/core/Templates/Providers/ProviderTemplate.php';

        if (!file_exists($stubPath)) {
            $output->writeln("<error>Stub file 'Providers/ProviderTemplates.php' not found.</error>");
            return Command::FAILURE;
        }

        $content = file_get_contents($stubPath);

        $className = ucfirst(basename(str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $className)));
        $providerContent = str_replace('ProviderTemplate', $className, $content);

        file_put_contents($filePath, $providerContent);

        $output->writeln("<info>Provider '{$className}' created at: /".Constants::PROVIDER_DIR."/{$fileName}</info>");

        return Command::SUCCESS;
    }
}