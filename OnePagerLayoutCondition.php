<?php
namespace T3ac\T3up\Conditions;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class OnePagerLayoutCondition
{
    public function matchCondition(array $parameters): bool
    {
        $record = $parameters['record'] ?? [];
        
        $pid = (int)($record['pid'] ?? 0);
        if ($pid <= 0) {
            return false;
        }
        
        $layout = $this->resolveBackendLayout($pid);
        return $layout === 'pagets__OnePager';
    }
    
    protected function resolveBackendLayout(int $pageId): string
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('pages');
        $first = true;
        
        while ($pageId > 0) {
            $page = $connection->select(
                ['uid', 'pid', 'backend_layout', 'backend_layout_next_level'],
                'pages',
                ['uid' => $pageId]
                )->fetchAssociative();
                
                if (!$page) {
                    break;
                }
                
                if (!empty($page['backend_layout'])) {
                    return $page['backend_layout'];
                }
                
                if (!$first && !empty($page['backend_layout_next_level'])) {
                    return $page['backend_layout_next_level'];
                }
                
                $first = false;
                $pageId = (int)$page['pid'];
        }
        
        return '';
    }
}
