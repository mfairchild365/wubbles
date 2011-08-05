<?php
$routes = array();

//The homepage.
$routes['/^home$/i'] = 'Wub_Homepage';

//Login
$routes['/^login$/i'] = 'Wub_Account_Login';

//Logout
$routes['/^logout$/i'] = 'Wub_Account_Logout';

$routes['/^resetPassword$/i'] = 'Wub_Account_ForgotPassword';

//Register
$routes['/^register$/i'] = 'Wub_Account_Edit';

$routes['/^account\/((?<id>[\d]+)\/)?edit$/i'] = 'Wub_Account_Edit';

$routes['/^account\/((?<id>[\d]+)\/)?edit\/password$/i'] = 'Wub_Account_EditPassword';

$routes['/^account\/(?<account_id>[\d]+)\/timeline$/i'] = 'Wub_Timeline';

$routes['/^account\/(?<account_id>[\d]+)\/memories\/timeline$/i'] = 'Wub_Memory_List_Timeline';

$routes['/^account\/(?<account_id>[\d]+)\/memories$/i'] = 'Wub_Memory_List';

$routes['/^account\/(?<account_id>[\d]+)\/activate$/i'] = 'Wub_Account_Activate';

$routes['/^account\/(?<account_id>[\d]+)\/edit\/resetPassword$/i'] = 'Wub_Account_ForgotPassword';

//Success
$routes['/^success$/i'] = 'Wub_Success';

$routes['/^mymemories$/i'] = 'Wub_Memory_MyMemories';

$routes['/^memory\/((?<id>[\d]+)\/)?edit$/i'] = 'Wub_Memory_Edit';

$routes['/^comment\/((?<id>[\d]+)\/)?edit$/i'] = 'Wub_Comment_Edit';

$routes['/^memory\/(?<id>[\d]+)$/i'] = 'Wub_Memory_View';

$routes['/^memory\/(?<memory_id>[\d]+)\/share\/((?<id>[\d]+)\/)?edit?$/i'] = 'Wub_SharedMemory_Edit';

$routes['/^memory\/(?<memory_id>[\d]+)\/share\/((?<id>[\d]+)\/)?multiedit?$/i'] = 'Wub_SharedMemory_MultiEdit';

$routes['/^memory\/(?<memory_id>[\d]+)\/picture\/((?<id>[\d]+)\/)?edit?$/i'] = 'Wub_Picture_Edit';

$routes['/^memory\/(?<memory_id>[\d]+)\/picture\/(?<id>[\d]+)$/i'] = 'Wub_Picture_View';

$routes['/^account\/(?<id>[\d]+)$/i'] = 'Wub_Account_View';

$routes['/^account\/(?<account_id>[\d]+)\/friends$/i'] = 'Wub_Friendship_List';

$routes['/^account\/list$/i'] = 'Wub_Account_List';

$routes['/^comment\/(?<id>[\d]+)\/delete$/i'] = 'Wub_Comment';

$routes['/^comment\/list$/i'] = 'Wub_Comment_List';

$routes['/^account\/(?<id>[\d]+)\/request\/(?<type>(remove|block|send|accept|reject))$/i'] = 'Wub_Account_FriendRequest';

$routes['/^notifications$/i'] = 'Wub_Notification_List';

$routes['/^notification\/(?<id>[\d]+)\/delete$/i'] = 'Wub_Notification';

return $routes;