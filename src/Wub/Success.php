<?php
class Wub_Success
{
    public $message = "There was a success for something.... idk what.";
    
    public $continueURL = NULL;
    
    public $saveType = NULL;
    
    public $ajaxRedirect = NULL;
    
    function __construct($options = array())
    {
        if (isset($_GET['message'])) {
            $this->message = $_GET['message'];
        }
        
        if (isset($options['continueURL'])) {
            $this->continueURL = $options['continueURL'];
        }
        
        if (isset($options['saveType'])) {
            $this->saveType = $options['saveType'];
        }
        
        if (isset($options['ajaxredirect'])) {
            $this->ajaxRedirect = $options['ajaxredirect'];
        }
        
        if (isset($_GET['for'])) {
            switch ($_GET['for']) {
                case "login":
                    $this->message = "You have been logged in!  Please click continue if you are not redirected.";
                    $options['continueURL'] = Wub_Controller::$url . "home";
                    break;
                case "accounts":
                    if ($this->saveType == 'create') {
                        $this->message = "Thank you for registering.  You will now need to log in.";
                        $this->continueURL = Wub_Controller::$url . "login";
                    } else {
                        $this->message = "You account has been saved!";
                    }
                    break;
                case "friendship_sent":
                    $this->message = "Your friendship request has been sent!";
                    break;
                case "friendship_accepted":
                    $this->message = "The request has been accepted!";
                    break;
                case "friendship_rejected":
                    $this->message = "The request has been rejected!";
                    break;
                default:
                    $this->message = "There was a success for something!  dunno what...";
                    break;
            }
        }
    }
}