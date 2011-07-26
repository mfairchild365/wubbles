<?php
class Wub_Picture_List extends Wub_List
{
    function __construct($options = array())
    {
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_Picture';
        $options['listClass'] = 'Wub_Picture_List';
        
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
    public static function getAllByMemory($memoryID, $limit, $options = array())
    {
        $options = $options + self::getDefaultOptions();
        
        $sqlLimit = '';
        
        if ($limit) {
            $sqlLimit = " LIMIT " . (int)$limit;
        }
        
        $options['sql'] = "SELECT id FROM pictures WHERE memory_id = " . (int)$memoryID . $sqlLimit;
        return self::getBySql($options);
    }

}