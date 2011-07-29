<?php
interface Wub_Permissionable
{
    public function canView();
    
    public function canEdit();
    
    public function canDelete();
}