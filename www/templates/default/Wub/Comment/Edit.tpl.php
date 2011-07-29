<script type="text/javascript" src="<?php echo Wub_Controller::$url?>www/js/confirmLinks.js"></script>

<script type="text/javascript">
    $(function() {
        refreshComments();
        initCommentForms();
    });
    
    function initCommentForms()
    {
        var options = { 
                success: showCommentResponse  // post-submit callback 
        }
        $('.commentForm').ajaxForm(options); 
    }

    function refreshComments()
    {
        $.ajax({
            url: "<?php echo Wub_Controller::$url; ?>comment/list?class=<?php echo $context->actionable->getCommentableClass();?>&reference_id=<?php echo $context->actionable->id?>&format=partial",
            cache: false,
            success: function(html){
            $("#commentContainer").html(html);
            initConfirmLinks();
            }
        });
    }

    function showCommentResponse(responseText, statusText, xhr, $form)
    {
        /*
        This is kinda tricky.  We have to grab the content, which is pure html (html tags and all)
        and get the #maincontent area.  THEN we have to set the contents of the dialog-message to
        the content of the maincontent area.  o.O
        */
        var div = ($(responseText).find('#maincontent')[0]);
        $( "#dialog-message" ).html($(div).html());
        $( "#dialog-message" ).dialog( "open" );

        if ($(div).find('#ajaxRedirect').length > 0) {
            window.location.replace($(div).find('#ajaxRedirect').html());
        }

        if ($(div).find('#success').length > 0
            && $(div).find('.created').length > 0) {
            $('.commentForm').clearForm();
            refreshComments();
        }
        return false;
    }
</script>

<div class='comments'>
    <h4>Comments</h4>
    <div id='commentContainer'>
        Loading...
    </div>
    <form name="input" class='commentForm' action="<?php echo Wub_Controller::$url; ?>comment/edit" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Add A Comment</legend>
            <ul>
                <li>
                    <label for="title">Add a comment</label>
                    <textarea rows="3" cols="100" name="comment"></textarea>
                </li>
            </ul>
            <input type="hidden" name="class" value='<?php echo $context->actionable->getRawObject()->getCommentableClass(); ?>'/>
            <input type="hidden" name="reference_id" value='<?php echo $context->actionable->id;?>'/>
            <input type="hidden" name="id" value=''/>
            <input type="hidden" name="_class" value='Wub_Comment_Edit'/>
            <input type="submit" value="Submit" class='submit'/>
        </fieldset>
    </form>
</div>