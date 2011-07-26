<?php
class Wub_Picture_Edit extends Wub_Picture
{
    function __construct($options = array())
    {
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        if ($_FILES['picture']['error']) {
            switch ($_FILES['picture']['error']) {
                case 1:
                    $message = "That file is too large.";
                case 2:
                    break;
                case 4:
                    $message = "You must select a file to upload";
                    break;
                default:
                    $message = "General Error";
                    break;
                
            }
            throw new Exception("There was an error uploading your file: " . $message);
        }
        
        if ($_FILES['picture']['size'] > 5242880) {
            throw new Exception("The file is too large.");
        }
        
        switch ($_FILES['picture']['type']) {
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
            case 'image/png':
                break;
            default:
                throw new Exception("That file type is not selected.  :(");
        }
        
        //Determin the file name
        $filename = $this->memory_id . '-' . Wub_Controller::getAccount()->id . '-' . time();
        
        if (file_exists(Wub_Controller::$uploadDir . $filename)) {
            throw new Exception("That file already exists!");
        }
        
        if (!move_uploaded_file($_FILES['picture']['tmp_name'], Wub_Controller::$uploadDir . $filename)) {
            throw new Exception("Failed to move the file on the server!");
        }
        
        echo Wub_Controller::$uploadURL . $filename;

        exit();
        
        echo "here"; exit();
        //Make sure everything is filled out.
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            throw new Exception("No title provided");
        }
        
        parent::handlePost($options);
    }
}