<?php
declare(strict_types=1);

namespace T3ac\T3up\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

final class AdjustAllContentColPosToZeroCommand extends Command
{
    // command name
    protected static $defaultName = 't3up:adjust-colpos';

    protected function configure(): void
    {
        $this
            ->setAliases(['t:colpos'])
            ->setDescription('Set all tt_content.colPos values to 0 (single-column layout).');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $connection = $connectionPool->getConnectionForTable('tt_content');

        // Prüfen, ob es Einträge mit colPos != 0 oder NULL gibt
        try {
            $count = (int) $connection->fetchOne(
                'SELECT COUNT(*) FROM tt_content WHERE colPos IS NULL OR colPos != 0'
            );
        } catch (\Throwable $e) {
            $output->writeln('<error>DB error while checking tt_content: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        if ($count === 0) {
            $output->writeln('<info>No tt_content records require update (all colPos already 0).</info>');
            return Command::SUCCESS;
        }

        // Update ausführen
        try {
            $affected = $connection->executeStatement(
                'UPDATE tt_content SET colPos = 0 WHERE colPos IS NULL OR colPos != 0'
            );

            $output->writeln("<info>Updated {$affected} tt_content rows — colPos set to 0.</info>");
            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $output->writeln('<error>Failed to update tt_content: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }
    }
}
