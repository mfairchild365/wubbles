<?php 
//print_r($context->toArray());
$output = array();

foreach($context->getRawObject() as $friendship) {
    $formattedFriendship  = array();
    $friend = $friendship->getFriendForAccount(Wub_Controller::getAccount()->id);
    $formattedFriendship['id']       = $friend->id;
    $formattedFriendship['username'] = $friend->username;
    $formattedFriendship['fullanme'] = $friend->getFullName();
    $output[] = $formattedFriendship;
}

print_r(json_encode($output));