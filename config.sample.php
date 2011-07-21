<?php
function autoload($class)
{
    $class = str_replace('_', '/', $class);
    include $class . '.php';
}
    
spl_autoload_register("autoload");

set_include_path(dirname(__FILE__) . 
'/src'.PATH_SEPARATOR.dirname(__FILE__).'/lib/php');

ini_set('display_errors', true);

error_reporting(E_ALL);

Wub_Controller::$url = 'http://localhost/wubbles/';

Wub_Controller::$admins = array('mfairchild365');

Wub_Controller::setDbSettings(array(
    'host'     => 'localhost',
    'user'     => 'wubbles',
    'password' => 'wubbles',
    'dbname'   => 'wubbles'
));
