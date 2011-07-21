<?php
class Wub_Account_List extends Wub_List
{
    function __construct($options = array())
    {
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_Account';
        $options['listClass'] = 'Wub_Account_List';
        
        return $options;
    }

}