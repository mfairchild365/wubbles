<?php
$routes = array();

//The homepage.
$routes['/^home$/i'] = 'Wub_Homepage';

//Login
$routes['/^login$/i'] = 'Wub_Account_Login';

//Logout
$routes['/^logout$/i'] = 'Wub_Account_Logout';

//Register
$routes['/^register$/i'] = 'Wub_Account_Register';

//Success
$routes['/^success$/i'] = 'Wub_Success';

$routes['/^memory\/((?<id>[\d]+)\/)?edit$/i'] = 'Wub_Memory_Edit';

return $routes;