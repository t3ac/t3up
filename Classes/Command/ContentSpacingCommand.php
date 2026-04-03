<?php
declare(strict_types=1);

namespace T3ac\T3up\Command;

use T3ac\T3up\Updates\ContentSpacingUpdate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

final class ContentSpacingCommand extends Command
{
    protected static $defaultName = 't3up:update:spacing';

    protected function configure(): void
    {
        $this
            ->setAliases(['t3up:u:s'])
            ->setDescription('Update spacing values (e.g. "16px") in tt_content to new numeric classes.')
            // Dry-Run Option hinzufügen
            ->addOption('dry-run', 'd', InputOption::VALUE_NONE, 'Simulate the update without making any changes');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dryRun = (bool) $input->getOption('dry-run');

        /** @var ConnectionPool $connectionPool */
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $connection = $connectionPool->getConnectionForTable('tt_content');

        // Erst prüfen, ob es überhaupt veraltete Werte gibt
        $hasOutdated = false;
        foreach (ContentSpacingUpdate::FIELDS as $field) {
            $values = array_keys(ContentSpacingUpdate::SPACING_MAP);
            if ($values === []) {
                continue;
            }
            $placeholders = implode(',', array_fill(0, count($values), '?'));
            $sql = "SELECT COUNT(*) FROM tt_content WHERE {$field} IN ({$placeholders})";

            try {
                $count = (int) $connection->fetchOne($sql, $values);
            } catch (\Throwable $e) {
                $output->writeln('<error>DB error while checking field ' . $field . ': ' . $e->getMessage() . '</error>');
                return Command::FAILURE;
            }

            if ($count > 0) {
                $hasOutdated = true;
                break;
            }
        }

        if (!$hasOutdated) {
            $output->writeln('<info>No outdated spacing values found in tt_content.</info>');
            return Command::SUCCESS;
        }

        // Wenn Dry-Run aktiv: lediglich simulieren, nicht speichern
        if ($dryRun) {
            $output->writeln('<comment>Dry run enabled. The following updates would be performed:</comment>');
            try {
                foreach (ContentSpacingUpdate::FIELDS as $field) {
                    foreach (ContentSpacingUpdate::SPACING_MAP as $old => $new) {
                        $count = (int) $connection->fetchOne(
                            "SELECT COUNT(*) FROM tt_content WHERE {$field} = ?",
                            [$old]
                        );
                        if ($count > 0) {
                            $output->writeln("<info>{$count} rows: {$field} '{$old}' -> '{$new}'</info>");
                        }
                    }
                }
            } catch (\Throwable $e) {
                $output->writeln('<error>DB error during dry run: ' . $e->getMessage() . '</error>');
                return Command::FAILURE;
            }
            $output->writeln('<info>Dry run complete. No changes were made.</info>');
            return Command::SUCCESS;
        }

        // Ohne Dry-Run: Normale Updates ausführen
        try {
            foreach (ContentSpacingUpdate::FIELDS as $field) {
                foreach (ContentSpacingUpdate::SPACING_MAP as $old => $new) {
                    $connection->update(
                        'tt_content',
                        [$field => $new],
                        [$field => $old]
                    );
                }
            }
        } catch (\Throwable $e) {
            $output->writeln('<error>Failed to update spacing values: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        $output->writeln('<info>Spacing values updated successfully.</info>');
        return Command::SUCCESS;
    }
}
