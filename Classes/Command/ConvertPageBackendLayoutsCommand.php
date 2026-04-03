<?php
declare(strict_types=1);

namespace T3ac\T3up\Command;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;

#[AsCommand(
    name: 't3up:convert:layouts',
    description: 'Replace pagets__<Suffix> values in pages.backend_layout and backend_layout_next_level based on mappings'
)]
final class ConvertPageBackendLayoutsCommand extends Command
{
    private const TABLE = 'pages';

    /**
     * Mapping Suffix => Suffix
     * Example: 'RightMarginalLayout' => 'RightMarginal'
     * Will convert 'pagets__RightMarginalLayout' -> 'pagets__RightMarginal'
     * 
     * @var array<string,string>
     */
    private const SUFFIX_MAPPINGS = [
        // 'OldSuffix' => 'NewSuffix',
        'RightMarginalLayout' => 'RightMarginal',
        'OneColumnLayout' => 'OneColumn',
        'RightNavigationInMediaTopLayout' => 'RightMarginal',
        'RightNavigationInMediaTop' => 'RightMarginal',
        'StandardLayout' => 'Standard',
        'OneColumnContainerLayout' => 'OneColumn',
        'OneColumnContainer' => 'OneColumn',
        'RightNavigationLayout' => 'RightNavigation',
        'LeftNavigationLayout' => 'LeftNavigation',
        'OnePagerLayout' => 'OnePager',
        'DefaultLayout' => 'Default',
    ];

    /** @var string[] Columns to check/update */
    private const COLUMNS = [
        'backend_layout',
        'backend_layout_next_level',
    ];

    public function __construct(
        protected ConnectionPool $connectionPool
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption(
            'dry-run',
            null,
            InputOption::VALUE_NONE,
            'Show changes without applying them'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dryRun = (bool)$input->getOption('dry-run');
        /** @var Connection $connection */
        $connection = $this->connectionPool->getConnectionForTable(self::TABLE);

        $totalFound = 0;
        $totalUpdated = 0;

        foreach (self::SUFFIX_MAPPINGS as $srcSuffix => $targetSuffix) {
            $srcValue = 'pagets__' . $srcSuffix;
            $targetValue = 'pagets__' . $targetSuffix;

            $output->writeln(sprintf(
                '<info>Mapping:</info> %s → %s',
                $srcValue,
                $targetValue
            ));

            foreach (self::COLUMNS as $column) {
                // Count matches
                $countSql = sprintf('SELECT COUNT(*) FROM %s WHERE `%s` = ?', self::TABLE, $column);
                $count = (int)$connection->fetchOne($countSql, [$srcValue], [ParameterType::STRING]);

                if ($count === 0) {
                    $output->writeln(sprintf(
                        '  <comment>Column %s: no rows with value %s</comment>',
                        $column,
                        $srcValue
                    ));
                    continue;
                }

                $totalFound += $count;
                $output->writeln(sprintf(
                    '  Found %d rows in column %s with value %s',
                    $count,
                    $column,
                    $srcValue
                ));

                if ($dryRun) {
                    $output->writeln(sprintf(
                        '  <info>DRY RUN: would update %d rows in %s: %s → %s</info>',
                        $count,
                        $column,
                        $srcValue,
                        $targetValue
                    ));
                    continue;
                }

                // Perform update
                try {
                    $rows = $connection->update(
                        self::TABLE,
                        [$column => $targetValue],
                        [$column => $srcValue]
                    );

                    $totalUpdated += $rows;
                    $output->writeln(sprintf(
                        '  <info>Updated %d rows in %s: %s → %s</info>',
                        $rows,
                        $column,
                        $srcValue,
                        $targetValue
                    ));
                } catch (\Throwable $e) {
                    $output->writeln(sprintf(
                        '<error>Error updating %s in column %s: %s</error>',
                        $srcValue,
                        $column,
                        $e->getMessage()
                    ));
                }
            }
        }

        $output->writeln('');
        $output->writeln(sprintf('<info>Total found:</info> %d', $totalFound));
        $output->writeln(sprintf('<info>Total updated:</info> %d', $totalUpdated));

        if ($dryRun) {
            $output->writeln('<comment>Dry run finished. No changes were made.</comment>');
        } else {
            $output->writeln('<info>Completed updates.</info>');
        }

        return Command::SUCCESS;
    }
}
