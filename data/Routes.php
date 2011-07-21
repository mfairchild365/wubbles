<?php
$routes = array();

//The homepage.
$routes['/^home$/i'] = 'Wub_Homepage';

//Login
$routes['/^login$/i'] = 'Wub_Account_Login';

//Logout
$routes['/^logout$/i'] = 'Wub_Account_Logout';

//Logout
$routes['/^register$/i'] = 'Wub_Account_Register';

return $routes;