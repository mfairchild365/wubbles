<?php
class Wub_Memory_Edit extends Wub_Memory
{
    function __construct($options = array())
    {
        $this->importance = 35;
        $this->start_date = time();
        $this->end_date   = time();
        
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        //Make sure everything is filled out.
        if (!isset($_POST['subject']) || empty($_POST['subject'])) {
            throw new Exception("No subject provided", 400);
        }
        
        if (!isset($_POST['details']) || empty($_POST['details'])) {
            throw new Exception("no details provided", 400);
        }
        
        if (!isset($_POST['permission']) || empty($_POST['permission'])) {
            throw new Exception("no permission provided", 400);
        }
        
        if (!in_array($_POST['permission'], array('private', 'public'))) {
            throw new Exception("That is not a valid permission", 400);
        }
        
        if (!isset($_POST['start_date']) || empty($_POST['start_date'])) {
            throw new Exception("no start date provided", 400);
        }
        
        if (!isset($_POST['end_date'])) {
            throw new Exception("no end date provided", 400);
        }
        
        if (!isset($_POST['importance']) || empty($_POST['importance'])) {
            throw new Exception("no importance provided", 400);
        }
        
        if ($_POST['importance'] < 1 || $_POST['importance'] > 100) {
            throw new Exception("Importance must be between 1 and 100", 400);
        }
        
        $_POST['start_date'] = strtotime($_POST['start_date']);
        
        
        if ($_POST['end_date'] == 1) {
            $this->end_date = 1;
        } else {
            $_POST['end_date'] = strtotime($_POST['end_date']);
            
            if ($_POST['end_date'] < $_POST['start_date']) {
                throw new Exception("That makes no sense silly.  Make sure you have the dates right.", 400);
            }
        }
        
        $options['continueURL'] = 'view';
        
        parent::handlePost($options);
    }
}