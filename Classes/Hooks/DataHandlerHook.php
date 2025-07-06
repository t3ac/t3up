<?php
namespace T3ac\T3up\Hooks;

use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class DataHandlerHook
{
    public function processDatamap_afterDatabaseOperations(
        $status,
        $table,
        $id,
        array &$fieldArray,
        DataHandler $pObj
        ) {
            if ($table === 'pages' && $status === 'update') {
                $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('pages');
                
                // Aktuelle Seite laden
                $pageRecord = $connection->select(
                    ['uid', 'pid', 'backend_layout', 'backend_layout_next_level'],
                    'pages',
                    ['uid' => (int)$id]
                    )->fetchAssociative();
                    
                    if (!$pageRecord) {
                        return;
                    }
                    
                    // Effektives Backend-Layout bestimmen
                    $effectiveLayout = $this->resolveBackendLayout((int)$pageRecord['uid'], $connection);
                    
                    // Nur wenn NICHT OnePager: auf container = 0 setzen
                    if ($effectiveLayout !== 'pagets__OnePager') {
                        $contentConnection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tt_content');
                        $contentRecords = $contentConnection->select(
                            ['uid', 'container'],
                            'tt_content',
                            ['pid' => (int)$id]
                            )->fetchAllAssociative();
                            
                            foreach ($contentRecords as $content) {
                                if ((int)$content['container'] !== 0) {
                                    $pObj->updateDB('tt_content', (int)$content['uid'], ['container' => 0]);
                                }
                            }
                    }
                    
                    // Sichtbarkeit wird im TCA geregelt – siehe nächster Abschnitt
            }
    }
    
    /**
     * Bestimmt das effektive Backend-Layout über Vererbung (backend_layout + backend_layout_next_level)
     *
     * @param int $pageId
     * @param \TYPO3\CMS\Core\Database\Connection $connection
     * @return string
     */
    protected function resolveBackendLayout(int $pageId, $connection): string
    {
        $firstLevel = true;
        
        while ($pageId > 0) {
            $page = $connection->select(
                ['uid', 'pid', 'backend_layout', 'backend_layout_next_level'],
                'pages',
                ['uid' => $pageId]
                )->fetchAssociative();
                
                if (!$page) {
                    break;
                }
                
                // Wenn direkt gesetzt, hat Vorrang
                if (!empty($page['backend_layout'])) {
                    return $page['backend_layout'];
                }
                
                // Ab zweiter Ebene: Vererbung prüfen
                if (!$firstLevel && !empty($page['backend_layout_next_level'])) {
                    return $page['backend_layout_next_level'];
                }
                
                $firstLevel = false;
                $pageId = (int)$page['pid'];
        }
        
        return '';
    }
}
