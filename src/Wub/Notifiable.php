<?php
interface Wub_Notifiable
{
    public function getNotifyMembersList();
    
    public function getNotifyClass();
    
    public function getURL();
    
    /* getNotifyText()
     * return the notify text for the notification.
     * 
     * $saveType will either be 'create' or 'save'
     */
    public function getNotifyText($saveType, $toID);
    
    public function getNotifyReferenceID();
    
    public function getName();
}