<?php
if (file_exists(dirname(__FILE__).'/config.inc.php')) {
    require_once dirname(__FILE__).'/config.inc.php';
} else {
    require dirname(__FILE__).'/config.sample.php';
}

echo 'Connecting to the database&hellip;';
$db = Wub_Controller::getDB();
echo 'connected successfully!<br />';
/**
 * 
 * Enter description here ...
 * @param mysqli $db
 * @param string $sql
 * @param string $message
 * @param bool   $fail_ok
 */
function exec_sql($db, $sql, $message, $fail_ok = false)
{
    echo $message.'&hellip;'.PHP_EOL;
    try {
        if ($db->multi_query($sql)) {
            do {
                /* store first result set */
                if ($result = $db->store_result()) {
                    $result->free();
                }
            } while ($db->next_result());
        }
    } catch (Exception $e) {
        if (!$fail_ok) {
            echo 'The query failed:'.$result->errorInfo();
            exit();
        }
    }
    echo 'finished.<br />'.PHP_EOL;
}

exec_sql($db, file_get_contents(dirname(__FILE__).'/data/db.sql'), 'Initializing database structure');

$weapons = array();

/*
$weapons = array(
                array('name' => "Energy Rifle", 'close' => 2, 'near' => 4, 'far' => 2, 'required_rank' => 0, 'slot' => 1 ),
                array('name' => "Slug Rifle", 'close' => 2, 'near' => 3, 'far' => 3, 'required_rank' => 0, 'slot' => 1 ),
                array('name' => "Hand to Hand", 'close' => 2, 'near' => 0, 'far' => 0, 'required_rank' => 0, 'slot' => 3 ),
                array('name' => "Grenades", 'close' => 4, 'near' => 2, 'far' => 0, 'required_rank' => 0, 'slot' => 2 ),
                array('name' => "Sidearm", 'close' => 3, 'near' => 3, 'far' => 1, 'required_rank' => 2, 'slot' => 2 ),
                array('name' => "E-Cannon", 'close' => 1, 'near' => 5, 'far' => 1, 'required_rank' => 1, 'slot' => 1 ),
                array('name' => "Heavy MG", 'close' => 2, 'near' => 3, 'far' => 1, 'required_rank' => 1, 'slot' => 1 ),
                );
*/

foreach ($weapons as $weapon) {
    $sql    = "SELECT id FROM weapons WHERE name = '".$weapon['name']."' LIMIT 1;";
    $result = $db->query($sql);
    if (!$result->fetch_assoc()) {
        $sql = "INSERT INTO weapons (`id`, `creator_id`, `name`, `description`, `image`, `date_created`, `close`, `near`, `far`, `required_rank`, `slot`) VALUES (NULL, 0, '".$weapon['name']."', NULL, NULL, " . time() . ", ".$weapon['close'].", ".$weapon['near'].", ".$weapon['far'].", ".$weapon['required_rank'].", ".$weapon['slot'].");";
        exec_sql($db, $sql, 'Adding ' . $weapon['name']);
    } else {
        $sql = "UPDATE weapons SET close = ".$weapon['close'].", near = ".$weapon['near'].", far = ".$weapon['far'].", required_rank = ".$weapon['required_rank'].", slot = ".$weapon['slot']." WHERE creator_id = 0 AND name = '".$weapon['name']."';";
        exec_sql($db, $sql, 'Updateing ' . $weapon['name']);
    }
}