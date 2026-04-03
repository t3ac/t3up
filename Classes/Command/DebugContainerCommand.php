<?php

namespace T3ac\T3up\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DebugContainerCommand extends Command
{
    protected static $defaultName = 't3up:debug:container';

    public function __construct(
        protected readonly ContainerInterface $container
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setAliases(['t3up:d:c'])
            ->setDescription('Liste Services im Container nach Filter')
            ->addArgument(
                'filter',
                InputArgument::OPTIONAL,
                'Optionaler String zum Filtern der Service-IDs (z. B. "project", "Connection", "Repository")',
                ''
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filter = strtolower($input->getArgument('filter'));

        $output->writeln("<info>Services mit Filter: \"$filter\"</info>");

        foreach ($this->container->getServiceIds() as $id) {
            if ($filter && !str_contains(strtolower($id), $filter)) {
                continue;
            }

            $output->writeln($id);
        }

        return Command::SUCCESS;
    }
}