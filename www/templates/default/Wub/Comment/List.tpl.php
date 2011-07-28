<div lass='commentList'>
    <ul>
        <?php 
        foreach ($context as $comment) {
            echo "<li>" . $comment->comment . "</li>";
        }
        ?>
    </ul>
</div>
