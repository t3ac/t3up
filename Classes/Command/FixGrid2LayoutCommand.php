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

final class FixGrid2LayoutCommand extends Command
{
    protected static $defaultName = 't3up:fix:grid2';

    protected function configure(): void
    {
        $this
            ->setAliases(['t3up:f:grid2'])
            ->setDescription('Replace layout "grid2" or empty string in tt_content.layout with 0 across all pages.')
            ->addOption('dry-run', 'd', InputOption::VALUE_NONE, 'Simulate the update without making any changes');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dryRun = (bool)$input->getOption('dry-run');

        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $connection = $connectionPool->getConnectionForTable('tt_content');

        $searchValues = ['grid2', '']; // values to replace
        $placeholders = implode(', ', array_fill(0, count($searchValues), '?'));

        try {
            // Count how many rows match either 'grid2' or ''
            $countMatching = (int)$connection->fetchOne(
                "SELECT COUNT(*) FROM tt_content WHERE layout IN ($placeholders)",
                $searchValues
            );

            // Count how many rows already have layout = 0 (for reporting)
            $countZero = (int)$connection->fetchOne(
                'SELECT COUNT(*) FROM tt_content WHERE layout = ?',
                [0]
            );
        } catch (\Throwable $e) {
            $output->writeln('<error>Database error while counting rows: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        if ($countMatching === 0) {
            $output->writeln('<info>No rows with layout "grid2" or empty string found.</info>');
            return Command::SUCCESS;
        }

        $output->writeln("<comment>{$countMatching} rows with layout 'grid2' or '' found.</comment>");
        $output->writeln("<comment>{$countZero} rows with layout = 0 found.</comment>");

        if ($dryRun) {
            try {
                $sample = $connection->fetchAllAssociative(
                    "SELECT uid, pid, header, layout FROM tt_content WHERE layout IN ($placeholders) ORDER BY uid LIMIT 200",
                    $searchValues
                );
            } catch (\Throwable $e) {
                $output->writeln('<error>Database error while fetching sample rows: ' . $e->getMessage() . '</error>');
                return Command::FAILURE;
            }

            $output->writeln('<info>Dry run enabled — the following rows would be updated (showing up to 200):</info>');
            foreach ($sample as $row) {
                $output->writeln(sprintf(
                    ' uid=%s | pid=%s | layout=%s | header=%s',
                    $row['uid'],
                    $row['pid'],
                    (string)$row['layout'],
                    (string)$row['header']
                ));
            }

            $output->writeln('<info>Dry run complete — no changes were made.</info>');
            return Command::SUCCESS;
        }

        // Perform the update: set layout = 0 where layout IN ('grid2', '')
        try {
            $sql = "UPDATE tt_content SET layout = ? WHERE layout IN ($placeholders)";
            $params = array_merge([0], $searchValues);
            $types = array_merge([ParameterType::INTEGER], array_fill(0, count($searchValues), ParameterType::STRING));

            $affected = $connection->executeStatement($sql, $params, $types);
        } catch (\Throwable $e) {
            $output->writeln('<error>Update failed: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        $output->writeln("<info>Update successful: {$affected} rows updated (layout → 0).</info>");
        return Command::SUCCESS;
    }
}
