<?php 
//print_r($context->toArray());
$output = array();

foreach($context->getRawObject() as $account) {
    $account          = $account->toArray();
    $formatedAccount  = array();
    foreach ($account as $key=>$value) {
        switch ($key) {
            //don't display the following.
            case 'password':
            case 'email':
                break;
            default:
            $formatedAccount[$key] = $value;
        }
    }
    
    $output[] = $formatedAccount;
}

print_r(json_encode($output));