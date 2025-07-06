<?php
namespace T3ac\T3up\UserConditions;

use TYPO3\CMS\Backend\Utility\BackendUtility;

class DisplayCond
{
    /**
     * UserFunc für displayCond
     *
     * @param array $params
     * @param mixed $formEngine - kann verschieden sein, daher kein Typhint
     * @return bool
     */
    public function isOnePagerLayout(array $params, $formEngine): bool
    {
        // Seiten-ID aus dem aktuellen Datensatz holen (Parent-Seite)
        $pageId = (int)($params['record']['pid'] ?? 0);
        if (!$pageId) {
            return false;
        }
        
        // Backend-Layout der Seite holen
        $pageRecord = BackendUtility::getRecord('pages', $pageId, 'backend_layout');
        if (!$pageRecord) {
            return false;
        }
        
        // Prüfen, ob das Backend-Layout dem gewünschten entspricht
        return $pageRecord['backend_layout'] === 'pagets__OnePager';
    }
}
