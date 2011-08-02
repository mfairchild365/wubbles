<?php
class Wub_Memory_Edit extends Wub_Memory
{
    function __construct($options = array())
    {
        $this->importance = 20;
        $this->start_date = time();
        $this->end_date   = time();
        
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        //Make sure everything is filled out.
        if (!isset($_POST['subject']) || empty($_POST['subject'])) {
            throw new Exception("No subject provided");
        }
        
        if (!isset($_POST['details']) || empty($_POST['details'])) {
            throw new Exception("no details provided");
        }
        
        if (!isset($_POST['permission']) || empty($_POST['permission'])) {
            throw new Exception("no permission provided");
        }
        
        if (!isset($_POST['start_date']) || empty($_POST['start_date'])) {
            throw new Exception("no start date provided");
        }
        
        if (!isset($_POST['end_date']) || empty($_POST['end_date'])) {
            throw new Exception("no end date provided");
        }
        
        if (!isset($_POST['importance']) || empty($_POST['importance'])) {
            throw new Exception("no importance provided");
        }
        
        if ($_POST['importance'] < 1 || $_POST['importance'] > 100) {
            throw new Exception("Importance must be between 1 and 100");
        }
        
        $_POST['start_date'] = strtotime($_POST['start_date']);
        
        $_POST['end_date'] = strtotime($_POST['end_date']);
        
        if ($_POST['end_date'] < $_POST['start_date']) {
            throw new Exception("That makes no sense silly.  Make sure you have the dates right.");
        }
        
        $options['continueURL'] = 'view';
        
        parent::handlePost($options);
    }
}