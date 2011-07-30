<?php
$routes = array();

//The homepage.
$routes['/^home$/i'] = 'Wub_Homepage';

//Login
$routes['/^login$/i'] = 'Wub_Account_Login';

//Logout
$routes['/^logout$/i'] = 'Wub_Account_Logout';

//Register
$routes['/^register$/i'] = 'Wub_Account_Edit';

$routes['/^account\/((?<id>[\d]+)\/)?edit$/i'] = 'Wub_Account_Edit';

//Success
$routes['/^success$/i'] = 'Wub_Success';

$routes['/^mymemories$/i'] = 'Wub_Memory_MyMemories';

$routes['/^memory\/((?<id>[\d]+)\/)?edit$/i'] = 'Wub_Memory_Edit';

$routes['/^memory\/(?<id>[\d]+)\/(?<action>(delete))/i'] = 'Wub_Memory';

$routes['/^comment\/((?<id>[\d]+)\/)?edit$/i'] = 'Wub_Comment_Edit';

$routes['/^memory\/(?<id>[\d]+)$/i'] = 'Wub_Memory_View';

$routes['/^memory\/(?<memory_id>[\d]+)\/share\/((?<id>[\d]+)\/)?edit?$/i'] = 'Wub_SharedMemory_Edit';

$routes['/^memory\/(?<memory_id>[\d]+)\/picture\/((?<id>[\d]+)\/)?edit?$/i'] = 'Wub_Picture_Edit';

$routes['/^memory\/(?<memory_id>[\d]+)\/picture\/(?<id>[\d]+)$/i'] = 'Wub_Picture_View';

$routes['/^account\/(?<id>[\d]+)$/i'] = 'Wub_Account_View';

$routes['/^account\/(?<account_id>[\d]+)\/friends$/i'] = 'Wub_Friendship_List';

$routes['/^account\/list$/i'] = 'Wub_Account_List';

$routes['/^comment\/(?<id>[\d]+)\/(?<action>(delete))$/i'] = 'Wub_Comment';

$routes['/^memory\/(?<memory_id>[\d]+)\/picture\/(?<id>[\d]+)\/(?<action>(delete))$/i'] = 'Wub_Picture';

$routes['/^comment\/list$/i'] = 'Wub_Comment_List';

$routes['/^account\/(?<id>[\d]+)\/request\/(?<type>(remove|block|send|accept|reject))$/i'] = 'Wub_Account_FriendRequest';

$routes['/^account\/(?<account_id>[\d]+)\/notifications$/i'] = 'Wub_Notification_List';

$routes['/^notification\/(?<id>[\d]+)\/(?<action>(delete))$/i'] = 'Wub_Notification';

return $routes;