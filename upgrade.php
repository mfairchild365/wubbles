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

exec_sql($db, file_get_contents(dirname(__FILE__).'/data/database.sql'), 'Initializing database structure');
exec_sql($db, "ALTER TABLE `accounts`  ADD `email_notifications` INT(1) DEFAULT 1", "Adding email_notifications", true);
exec_sql($db, "ALTER TABLE `memories`  ADD `start_date` INT(15) NULL DEFAULT 0", "Adding start date", true);
exec_sql($db, "ALTER TABLE `memories`  ADD `end_date` INT(15) NULL DEFAULT 0", "Adding end date", true);
exec_sql($db, "ALTER TABLE `memories`  ADD `importance` INT(3) DEFAULT 1", "Adding importance", true);
exec_sql($db, "ALTER TABLE `accounts`  ADD `activation_code` VARCHAR(100) DEFAULT 0", "Adding activation", true);
exec_sql($db, "ALTER TABLE `accounts`  ADD `timezone` VARCHAR(100) DEFAULT 'America/Chicago'", "Adding timezone", true);