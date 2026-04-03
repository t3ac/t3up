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
    name: 't3up:convert:listtypes',
    description: 'Replace multiple tt_content CType and list_type values based on predefined mappings'
)]
final class ConvertListTypesCommand extends Command
{
    private const C_TYPE = 'CType';
    private const LIST_TYPE = 'list_type';

    /**
     * Mixed mappings: each entry may contain CType and/or list_type.
     * - If both are set: WHERE CType = src AND list_type = src will be used
     * - If only one is set: only that field will be used in the WHERE clause
     *
     * Structure:
     * [
     *   [
     *     self::C_TYPE => [ 'ctypeSource' => 'ctypeTarget', ... ],
     *     self::LIST_TYPE => [ 'listSource' => 'listTarget', ... ],
     *   ],
     *   ...
     * ]
     */
    private const C_TYPE_AND_LIST_TYPE_MAPPINGS = [
        [
            self::C_TYPE => ['list' => 'news_newsliststicky'],
            self::LIST_TYPE => ['news_pi1' => 'news_pi1'],
        ],
        [
            self::C_TYPE => ['buttons' => 'hda_buttonbox'],
            self::LIST_TYPE => [],
        ],
        [
            self::C_TYPE => ['slideshow' => 't3upslideshow_content'],
            self::LIST_TYPE => [],
        ],
        [
            self::C_TYPE => ['slide' => 't3upslideshow_content'],
            self::LIST_TYPE => [],
        ],
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
            't3up:c:l',
            InputOption::VALUE_NONE,
            'Show changes without applying'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dryRun = (bool)$input->getOption('dry-run');
        $connection = $this->connectionPool->getConnectionForTable('tt_content');

        // --- Mixed mappings (CType and/or list_type per block) ---
        foreach (self::C_TYPE_AND_LIST_TYPE_MAPPINGS as $mapping) {
            $cTypeMap = $mapping[self::C_TYPE] ?? [];
            $listTypeMap = $mapping[self::LIST_TYPE] ?? [];

            // If both maps are present: combine all CType × list_type pairs
            if (!empty($cTypeMap) && !empty($listTypeMap)) {
                foreach ($cTypeMap as $cSource => $cTarget) {
                    foreach ($listTypeMap as $lSource => $lTarget) {
                        $where = [
                            self::C_TYPE => $cSource,
                            self::LIST_TYPE => $lSource,
                        ];
                        $update = [
                            self::C_TYPE => $cTarget,
                            self::LIST_TYPE => $lTarget,
                        ];
                        $this->processWhereUpdate($connection, $output, $dryRun, $where, $update);
                    }
                }
                
                continue;
            }

            // If only CType mappings are present
            if (!empty($cTypeMap) && empty($listTypeMap)) {
                foreach ($cTypeMap as $cSource => $cTarget) {
                    $where = [self::C_TYPE => $cSource];
                    $update = [self::C_TYPE => $cTarget];
                    $this->processWhereUpdate($connection, $output, $dryRun, $where, $update);
                }
                
                continue;
            }

            // If only list_type mappings are present
            if (empty($cTypeMap) && !empty($listTypeMap)) {
                foreach ($listTypeMap as $lSource => $lTarget) {
                    $where = [self::LIST_TYPE => $lSource];
                    $update = [self::LIST_TYPE => $lTarget];
                    $this->processWhereUpdate($connection, $output, $dryRun, $where, $update);
                }
                
                continue;
            }

            // If neither is set: nothing to do for this mapping
        }

        return Command::SUCCESS;
    }

    /**
     * General routine: counts affected records for $where and performs the update on tt_content with $update
     *
     * @param Connection $connection
     * @param OutputInterface $output
     * @param bool $dryRun
     * @param array<string,string> $where  e.g. ['CType' => 'buttons', 'list_type' => 'news_pi1']
     * @param array<string,string> $update e.g. ['CType' => 'hda_buttonbox', 'list_type' => 'news_newsliststicky']
     */
    private function processWhereUpdate(Connection $connection, OutputInterface $output, bool $dryRun, array $where, array $update): void
    {
        // Build WHERE SQL and parameters
        $conditions = [];
        $params = [];
        $types = [];
        foreach ($where as $field => $value) {
            $conditions[] = sprintf('%s = ?', $field);
            $params[] = $value;
            $types[] = ParameterType::STRING;
        }

        $sql = 'SELECT COUNT(*) FROM tt_content';
        if (!empty($conditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $count = (int)$connection->fetchOne($sql, $params, $types);

        if ($count === 0) {
            $output->writeln(sprintf(
                '<comment>No entries found for %s.</comment>',
                json_encode($where)
            ));
            
            return;
        }

        $output->writeln(sprintf(
            'Found %d entries for %s.',
            $count,
            json_encode($where)
        ));

        if ($dryRun) {
            $output->writeln(sprintf(
                '<info>DRY RUN: would update %s → %s</info>',
                json_encode($where),
                json_encode($update)
            ));
            
            return;
        }

        try {
            $rows = $connection->update('tt_content', $update, $where);
            $output->writeln(sprintf(
                '<info>Updated %d entries: %s → %s</info>',
                $rows,
                json_encode($where),
                json_encode($update)
            ));
        } catch (\Throwable $e) {
            $output->writeln(sprintf(
                '<error>Error updating %s → %s: %s</error>',
                json_encode($where),
                json_encode($update),
                $e->getMessage()
            ));
        }
    }
}
