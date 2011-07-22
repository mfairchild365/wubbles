<h3>Account List</h3>
<ol>
    <?php 
    foreach($context as $account) {
        echo "<li><a href='" . $account->getURL() ."'>" . $account->getFullName() . "</a></li>";
    }
    ?>
</ol>