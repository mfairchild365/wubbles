<h3>My Memories</h3>
<ul>
    <?php 
    foreach ($context as $memory) {
        echo "<li><a href='".$memory->getURL().""'>".$memory->subject."</a></li>";
    }
    ?>
</ul>