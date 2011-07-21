Account List
<ol>
    <?php 
    foreach($context as $account) {
        echo "<li>" . $account->username . "</li>";
    }
    ?>
</ol>