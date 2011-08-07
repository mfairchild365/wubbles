<?php 
//print_r($context->toArray());
$output = array();
$output['id']           = 'Memories visible to you.';
$output['title']        = 'Memories';
$output['focus_date']   = date('Y-m-d H:i:s', time());
$output['initial_zoom'] = '38';
$output['events']       = array();

$i = 0;
foreach($context->getRawObject() as $memory) {
    if ($i == 0) {
        $output['focus_date'] = date('Y-m-d H:i:s', $memory->start_date);
        $output['title']      = Wub_Account::getByID($memory->owner_id)->getFullName() . '\'s memories';
    }
    $formattedMemory                = array();
    $formattedMemory['id']          = $memory->id;
    $formattedMemory['title']       = $memory->subject;
    $formattedMemory['description'] = 'Click the link to view more details, photos and comments regarding this memory.';
    $formattedMemory['startdate']   = date('Y-m-d H:i:s', $memory->start_date);
    
    //handle on-going.
    if ($memory->end_date == 1) {
        $formattedMemory['enddate'] = date('Y-m-d H:i:s', time());
        $formattedMemory['title']   = $formattedMemory['title'] . " (ongoing)";
    } else {
        $formattedMemory['enddate'] = date('Y-m-d H:i:s', $memory->end_date);
    }
    
    $formattedMemory['link']        = $memory->getURL();
    $formattedMemory['importance']  = $memory->importance;
    $formattedMemory['icon']        = 'triangle_orange.png';
    $output['events'][]             = $formattedMemory;
    $i++;
}

$timelines[] = $output;
print_r(json_encode($timelines));