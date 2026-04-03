<?php
declare(strict_types=1);

namespace T3ac\T3up\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use Doctrine\DBAL\ParameterType;

final class SysFileTypeFixCommand extends Command
{
    protected static $defaultName = 't3up:fix:filetype';

    protected function configure(): void
    {
        $this
            ->setAliases(['t3up:f:ft'])
            ->setDescription('Set sys_file.type = 0 if the value is empty.')
            ->addOption('dry-run', 'd', InputOption::VALUE_NONE, 'Simulate the update without making any changes');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dryRun = (bool)$input->getOption('dry-run');

        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $connection = $connectionPool->getConnectionForTable('sys_file');

        // Check if there are any rows with empty or NULL type
        try {
            $count = (int)$connection->fetchOne(
                'SELECT COUNT(*) FROM sys_file WHERE type = "" OR type IS NULL'
            );
        } catch (\Throwable $e) {
            $output->writeln('<error>Database error while counting rows: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        if ($count === 0) {
            $output->writeln('<info>No rows with empty type found in sys_file.</info>');
            return Command::SUCCESS;
        }

        $output->writeln("<comment>{$count} rows with empty type found.</comment>");

        if ($dryRun) {
            // Dry-run: only report, do not modify the database
            $output->writeln('<info>Dry run enabled — no changes will be made.</info>');
            return Command::SUCCESS;
        }

        // Perform the update using executeStatement and a proper Doctrine parameter type
        try {
            $sql = 'UPDATE sys_file SET type = ? WHERE type = "" OR type IS NULL';
            $affected = $connection->executeStatement(
                $sql,
                [0],
                [ParameterType::INTEGER]
            );
        } catch (\Throwable $e) {
            $output->writeln('<error>Update failed: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        $output->writeln("<info>Update successful: {$affected} rows updated.</info>");
        return Command::SUCCESS;
    }
}
