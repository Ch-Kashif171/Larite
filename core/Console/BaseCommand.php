<?php

namespace Core\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
{
    protected InputInterface $input;
    protected OutputInterface $output;

    protected string $name = '';
    protected string $description = '';

    public function __construct()
    {
        parent::__construct();

        if (!empty($this->name)) {
            $this->setName($this->name);
        }

        if (!empty($this->description)) {
            $this->setDescription($this->description);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;

        if (method_exists($this, 'handle')) {
            return $this->handle();
        }

        return Command::SUCCESS;
    }

    protected function info(string $message): void
    {
        $this->output->writeln("<info>{$message}</info>");
    }

    protected function error(string $message): void
    {
        $this->output->writeln("<error>{$message}</error>");
    }

    protected function comment(string $message): void
    {
        $this->output->writeln("<comment>{$message}</comment>");
    }

}
