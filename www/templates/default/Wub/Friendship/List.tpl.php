<h3>Friendship List</h3>
<ul>
    <?php 
    foreach ($context as $friendship) {
        echo "<li><a href='" . $friendship->getFriendForAccount(Wub_Controller::getAccount()->id)->getURL() . "'>" . $friendship->getFriendForAccount(Wub_Controller::getAccount()->id)->getFullName() . "</a></li>";
    }
    ?>
</ul>