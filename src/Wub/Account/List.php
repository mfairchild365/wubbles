<?php
class Wub_Account_List extends Wub_List
{
    function __construct($options = array())
    {
        if (!isset($options['model']) || $options['model'] != 'Wub_Account_List') {
            parent::__construct($options);
            return;
        }
        
        $options['returnArray'] = true;
        
        $options['array'] = self::getAllOrderByLastName($options);
         
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_Account';
        $options['listClass'] = 'Wub_Account_List';
        
        return $options;
    }
    
    public static function getAllOrderByLastName($options = array())
    {
        $options        = $options + self::getDefaultOptions();
        $options['sql'] = "SELECT id FROM accounts ORDER BY lastname ASC";
        return self::getBySql($options);
    }
}

