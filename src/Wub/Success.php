<?php
class Wub_Success
{
    public $message = "There was a success for something.... idk what.";
    
    public $continueURL = NULL;
    
    public $saveType = NULL;
    
    public $ajaxRedirect = NULL;
    
    function __construct($options = array())
    {
        if (isset($_GET['for'])) {
            switch ($_GET['for']) {
                 case "campaignInviteRequest":
                    $this->message = "The request has been sent!";
                    break;
                 case "invite":
                    $this->message = "The invite has been edited!";
                    break;
                case "characterActivate":
                    $this->message = "The character has been activated!";
                    break;
                case "login":
                    $this->message = "You have been logged in!  Please click continue if you are not redirected.";
                    $options['continueURL'] = Wub_Controller::$url . "home";
                    break;
                default:
                    break;
            }
        }
        
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
    }
}