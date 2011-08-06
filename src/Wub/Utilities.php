<?php
class Wub_Utilities
{
    static function formatTime($timeStamp)
    {
        if ($account = Wub_Controller::getAccount()) {
            $time = new DateTime(date("F j, Y, g:i a", $timeStamp), new DateTimeZone($account->timezone));
            $timeStamp = $time->format('U');
        }
        
        return  date("F j, Y, g:i a", $timeStamp);
    }
}