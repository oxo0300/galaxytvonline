<?php
/**
 * @package membercheck
 */
class MemberCheck {
    var $allGroups = null;
    var $debug;
    var $modx;

    function MemberCheck(&$modx,$config = array()) {
        $this->__construct($modx,$config);
    }
    function __construct(&$modx,$config = array()) {
        $this->modx =& $modx;
        $this->config = array_merge(array(
            'debug' => false,
            'default' => '',
        ),$config);

        if ($this->config['debug']) {
            $this->allGroups = array ();
            $tableName = $this->modx->getTableName('modUserGroup');
            $sql = "SELECT `name` FROM $tableName";
            if ($stmt = $this->modx->query($sql)) {
                $this->allGroups = $stmt->fetchAll(PDO_FETCH_COLUMN);
            }
        }
    }

    function isValidGroup($groupName) {
        $isValid = !(array_search($groupName, $this->allGroups) === false);
        return $isValid;
    }

    function getMemberChunk(& $groups, $chunk) {
        $o = '';
        if (is_array($groups)) {
            for ($i = 0; $i < count($groups); $i++) {
                $groups[$i] = trim($groups[$i]);
                if ($this->config['debug']) {
                    if (!$this->isValidGroup($groups[$i])) {
                        return '<p>The group <strong>' . $groups[$i] . '</strong> could not be found...</p>';
                    }
                }
            }
            $check = $this->modx->isMemberOfWebGroup($groups);
            $chunkcheck = $this->modx->getChunk($chunk);
            $defaultcheck = $this->modx->getChunk($this->config['default']);
            if ( $check ) {
                $o .= ($check && $chunkcheck) ? $chunkcheck : '';
                if (!$chunkcheck && $this->config['debug']) {
                    $o .= '<p>The chunk <strong>'.$chunk.'</strong> not found...</p>';
                }
            }
            else
            {
                if ($defaultcheck && (strlen($this->config['default']) >= 1)) {
                    $o .= ($defaultcheck) ? $defaultcheck : '';
                }
                if (!$defaultcheck && (strlen($this->config['default']) >= 1) && $this->config['debug']) {
                    $o .= '<p>The default chunk <strong>'.$this->config['default'].'</strong> not found...</p>';
                }
            }
        } else {
            $o .= '<p>No valid group names were specified!</p>';
        }
        return $o;
    }
}