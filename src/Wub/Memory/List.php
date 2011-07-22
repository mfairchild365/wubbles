<?php
class Wub_Memory_List extends Wub_List
{
    function __construct($options = array())
    {
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

}