<?php
class Wub_Utilities
{
    static function formatTime($timeStamp)
    {
        return  date("F j, Y, g:i a", $timeStamp);
    }
}