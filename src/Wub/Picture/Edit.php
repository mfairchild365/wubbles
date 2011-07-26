<?php
class Wub_Picture_Edit extends Wub_Picture
{
    function __construct($options = array())
    {
        Wub_Controller::requireLogin();
        
        if (!isset($options['memory_id'])) {
            throw new Exception("No memory ID was passed!");
        }
        
        $this->memory_id = $options['memory_id'];
        
        parent::__construct($options);
    }
    
    function handlePost($options = array())
    {
        //Make sure everything is filled out.
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            throw new Exception("No title provided");
        }
        
        if (!isset($_POST['caption']) || empty($_POST['caption'])) {
            $_POST['caption'] = '';
        }
        
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
                $extension = (empty($extension))?'.gif':$extension;
            case 'image/jpeg':
                $extension = (empty($extension))?'.jpg':$extension;
            case 'image/pjpeg':
                $extension = (empty($extension))?'.jpg':$extension;
            case 'image/png':
                $extension = (empty($extension))?'.png':$extension;
                break;
            default:
                throw new Exception("That file type is not selected.  :(");
        }
        
        //Determin the file name
        $filename = $this->memory_id . '-' . Wub_Controller::getAccount()->id . '-' . time();
        $thumb_filename = $this->memory_id . '-' . Wub_Controller::getAccount()->id . '-' . time() . '-thumb' . $extension;
        $filename      .= $extension;
        
        $this->path = $filename;
        
        if (file_exists($this->path)) {
            throw new Exception("That file already exists!");
        }
        
        if (!move_uploaded_file($_FILES['picture']['tmp_name'], Wub_Controller::$uploadDir . $filename)) {
            throw new Exception("Failed to move the file on the server!");
        }
        
        //render the image so that its a little easier on the filesystem.
        $resizer = new Resize(Wub_Controller::$uploadDir . $filename);
        $resizer->resizeImage(720, 540);
        $resizer->saveImage(Wub_Controller::$uploadDir . $filename, 85);
        
        //Thumbnail
        $resizer = new Resize(Wub_Controller::$uploadDir . $filename);
        $resizer->resizeImage(150, 100);
        $resizer->saveImage(Wub_Controller::$uploadDir . $thumb_filename, 75);
        
        parent::handlePost($options);
    }
}