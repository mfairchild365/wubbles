<?php
class Wub_Memory_List extends Wub_List
{
    function __construct($options = array())
    {
        if (!isset($options['model']) || (!in_array($options['model'], array('Wub_Memory_List', 'Wub_Memory_List_Timeline')))) {
            parent::__construct($options);
            return;
        }
        
        if (!isset($options['account_id'])) {
            throw new Exception("No account specified.", 404);
        }
        
        $options['returnArray'] = true;
        
        $options['array'] = self::getDynamicForAccount($options['account_id'], $options);
        
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_Memory';
        $options['listClass'] = 'Wub_Memory_List';
        
        return $options;
    }
    
    /**
     * get a list of all memorys that a user owns.
     *
     * @param $accountID The id of the memory to generate the list for..
     * @param $options array of options for constructing the list.
     * 
     * @return object Wub_Memory_List
     */
    public static function getAllByAccount($accountID, $options = array())
    {
        $options        = $options + self::getDefaultOptions();
        $options['sql'] = "SELECT id FROM memories WHERE owner_id = " . (int)$accountID;
        return self::getBySql($options);
    }
    
    public static function getDynamicForAccount($accountID, $options = array()) {
        $options = $options + self::getDefaultOptions();
        
        $whereAdd = "";
        if (Wub_Controller::getAccount()) {
            $whereAdd = "OR shared_memory.account_id = " . (int)Wub_Controller::getAccount()->id . " OR memories.owner_id = " . (int)Wub_Controller::getAccount()->id;
        }
        
        $options['sql'] = "SELECT memories.id FROM memories LEFT JOIN (shared_memory) ON (shared_memory.memory_id = memories.id) WHERE memories.owner_id = " . (int)$accountID . " AND  (memories.permission = 'public' " .  $whereAdd . ") ORDER BY memories.date_created ASC";
        
        return self::getBySql($options);
    }

}