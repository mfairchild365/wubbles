<script type="text/javascript">
    $.ajax({
        url: "<?php echo Wub_Controller::$url; ?>comment/list?class=<?php echo $context->actionable->getCommentableClass();?>&reference_id=<?php echo $context->actionable->id?>&format=partial",
        cache: false,
        success: function(html){
        $("#commentContainer").html(html);
        }
    });
</script>

<div class='commentForm'>
    <h4>Comments</h4>
    <div id='commentContainer'>
        Loading...
    </div>
    <form name="input"  id='memoryForm' action="<?php echo Wub_Controller::$url; ?>comment/edit" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Add A Comment</legend>
            <ul>
                <li>
                    <label for="title">Add a comment</label>
                    <textarea rows="3" cols="100" name="comment"></textarea>
                </li>
            </ul>
            <input type="hidden" name="class" value='<?php echo $context->getRawObject()->getCommentableClass(); ?>'/>
            <input type="hidden" name="reference_id" value='<?php echo $context->id;?>'/>
            <input type="hidden" name="id" value=''/>
            <input type="hidden" name="_class" value='Wub_Comment_Edit'/>
            <input type="submit" value="Submit" class='submit'/>
        </fieldset>
    </form>
</div>