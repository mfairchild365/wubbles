<div class='commentList'>
    <ul>
        <?php 
        foreach ($context as $comment) {
            echo "<li>";
                echo "<ul class='commentItem'>";
                    $owner = Wub_Account::getByID($comment->owner_id);
                    
                    $delete = "";
                    if ($comment->canDelete()) {
                        $delete = "<a href='" . $comment->getURL() . "/delete' class='confirmLink'>Delete</a>";
                    }
                    echo "<li class='info'>
                              <b>" . $owner->getFullName() . "</b>
                              <em><a href='" . $owner->getURL() . "'>$owner->username</a></em>
                              <em>On: " . Wub_Utilities::formatTime($comment->date_created) . "</em>
                              " . $delete . "
                          </li>";
                    echo "<li class='details'>" . $comment->comment . "</li>";
                echo "</ul>";
            echo "</li>";
        }
        ?>
    </ul>
</div>
