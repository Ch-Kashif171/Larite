<?php

namespace Core\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BaseCommand extends Command
{
    protected InputInterface $input;

    protected ?OutputInterface $output = null;

    protected string $signature = '';

    protected string $description = '';

    public function __construct()
    {
        parent::__construct();

        if (!empty($this->signature)) {
            $this->setName($this->signature);
        }

        if (!empty($this->description)) {
            $this->setDescription($this->description);
        }
    }

    public function run(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;

        $this->handle();
        return 1;
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->input = $input;
        $this->output = $output;

        if (method_exists($this, 'handle')) {
            return $this->handle();
        }

        return Command::SUCCESS;
    }

    /**
     * @param string $message
     * @return void
     */
    protected function info(string $message): void
    {
        $this->output?->writeln("<info>{$message}</info>");
    }

    /**
     * @param string $message
     * @return void
     */
    protected function error(string $message): void
    {
        $this->output?->writeln("<error>{$message}</error>");
    }

    /**
     * @param string $message
     * @return void
     */
    protected function comment(string $message): void
    {
        $this->output?->writeln("<comment>{$message}</comment>");
    }

}
