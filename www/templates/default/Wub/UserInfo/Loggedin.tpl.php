<?php 
echo "Hello, <a href='" . $user->getURL() . "'>" . $user->username . "</a>";
?>
(<a href="<?php echo Wub_Controller::$url . "logout"?>" id='logout' title="logout">Logout</a>)
