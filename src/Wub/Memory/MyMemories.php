<?php
class Wub_Memory_MyMemories extends Wub_Memory_List
{
    function __construct()
    {
        Wub_Controller::requireLogin();
        
        $options['array'] = Wub_Controller::getAccount()->getMemories(array('returnArray' => true));
        
        parent::__construct($options);
    }
}