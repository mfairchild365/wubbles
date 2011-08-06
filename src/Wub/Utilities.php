<?php
class Wub_Utilities
{
    static function formatTime($timeStamp)
    {
        if ($account = Wub_Controller::getAccount()) {
            $serverDate = new DateTime('now', new DateTimeZone(date_default_timezone_get()));
            $serverTime = $serverDate->format('U');
            $clientDate = new DateTime('now', new DateTimeZone($account->timezone));
            $clientTime = $clientDate->format('U');
            $diff       = $serverTime - $clientTime;
            $timeStamp  = $timeStamp + $diff;
        }
        
        return  date("F j, Y, g:i a", $timeStamp);
    }
}