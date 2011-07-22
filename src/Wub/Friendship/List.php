<?php
class Wub_Friendship_List extends Wub_List
{
    function __construct($options = array())
    {
        parent::__construct($options);
    }
    
    function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = 'Wub_Friendship';
        $options['listClass'] = 'Wub_Friendship_List';
        
        return $options;
    }
    
}