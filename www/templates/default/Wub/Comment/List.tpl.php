<div class='commentList'>
    <ul>
        <?php 
        foreach ($context as $comment) {
            echo "<li>";
                echo "<ul class='commentItem'>";
                    $owner = Wub_Account::getByID($comment->owner_id);
                    
                    $delete = "";
                    if ($comment->canDelete()) {
                        $delete = "
                        <form id='comment_" . $comment->id . "' name='input' class='deleteForm ajaxDelete' action='" . Wub_Controller::$url . "comment/" . $comment->id . "/delete' method='post'>
                            <input type='hidden' name='action' value='delete'/>
                            <input type='hidden' name='_class' value='Wub_Comment'/>
                            <input type='hidden' name='id' value='" . $comment->id . "'/>
                            <input type='submit' value='Delete' class=''/>
                        </form>";
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
