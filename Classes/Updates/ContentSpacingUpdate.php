<?php
declare(strict_types=1);

namespace T3ac\T3up\Updates;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;

#[UpgradeWizard('contentSpacingUpdate')]
final class ContentSpacingUpdate implements UpgradeWizardInterface
{
    public const SPACING_MAP = [
        // Size 0  => 0
        '0px'  => '0',

        // Size 1  => $v025  (~4px)
        '4px'  => '1',

        // Size 2  => $v033  (~6px)
        '6px'  => '2',

        // Size 3  => $v050  (~8px)
        '8px'  => '3',

        // Size 4  => $v066  (~10px)
        '10px' => '4',

        // Size 5  => $v075  (~12px)
        '12px' => '5',

        // Size 6  => $v1    (~16px)
        '16px' => '6',
        '20px' => '6',

        // Size 7  => $v150  (~25px)
        '24px' => '7',
        '25px' => '7',

        // Size 8  => $v2    (~32px)
        '32px' => '8',
        '36px' => '8',

        // Size 9  => $v3    (~48px)
        '48px' => '9',
    ];

    public const FIELDS = [
        'space_before_class',
        'space_after_class',
        'padding_before_class',
        'padding_after_class',
    ];

    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {}

    public function getIdentifier(): string
    {
        return 'contentSpacingUpdate';
    }

    public function getTitle(): string
    {
        return 'T3UP: Update content spacing values';
    }

    public function getDescription(): string
    {
        return 'Replaces old spacing values like "16px" in tt_content.space_before_class / space_after_class with new numeric values.';
    }

    public function executeUpdate(): bool
    {
        $connection = $this->connectionPool->getConnectionForTable('tt_content');

        foreach (self::FIELDS as $field) {
            foreach (self::SPACING_MAP as $old => $new) {
                $connection->update(
                    'tt_content',
                    [$field => $new],
                    [$field => $old]
                );
            }
        }

        return true;
    }

    public function updateNecessary(): bool
    {
        return true; // nur zum Test
        $connection = $this->connectionPool->getConnectionForTable('tt_content');

        foreach (self::FIELDS as $field) {
            $qb = $connection->createQueryBuilder();
            $count = $qb->count('*')
                ->from('tt_content')
                ->where($qb->expr()->in($field, array_keys(self::SPACING_MAP)))
                ->executeQuery()
                ->fetchOne();

            if ($count > 0) {
                return true;
            }
        }

        return false;
    }

    public function getPrerequisites(): array
    {
        return [];
    }
}
