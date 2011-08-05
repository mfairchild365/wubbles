<script type="text/javascript">
$(function() {
    $(".chzn-select").chosen()
});
</script>

<?php 
$sharedWith = array();
foreach (Wub_SharedMemory_List::getByMemory($context->memory_id) as $share) {
    $sharedWith[] = $share->account_id;
}

if (Wub_Controller::getAccount() && $context->canEdit()) {
    ?>
    <div class='options'>
        <a href='<?php echo $context->getMemory()->getURL();?>' class='button'>Back to Memory</a>
        <div style='clear:both'></div>
    </div>
    <?php 
}
?>

<form  id='memoryForm' class='ajaxForm' action="<?php echo $context->getEditURL(); ?>" method="post">
    <fieldset>
        <legend>Share a Memory</legend>
            <ul>
                <li>
                    <label for="name">Share with: </label>
                    <span class='helper'><em>Begin typing to chose friends to share with</em></span>
                    <select name='sharewith[]' data-placeholder="Select A Person" style="width:350px;" multiple class="chzn-select" tabindex="8">
                        <?php 
                        foreach (Wub_Friendship_List::getFriendsForAccount(Wub_Controller::getAccount()->id) as $friendship) {
                            $friend = $friendship->getFriendForAccount(Wub_Controller::getAccount()->id);
                            $selected = "";
                            if (in_array($friend->id, $sharedWith)) {
                                $selected = "selected='selected'";
                            }
                            echo "<option value='" . $friend->id . "'" . $selected . ">" . $friend->getFullName() . "</option>";
                        }
                        ?>
                    </select>
                </li>
            </ul>
        <input type="hidden" name="id" value='<?php echo $context->id;?>'/>
        <input type="hidden" name="memory_id" value='<?php echo $context->memory_id;?>'/>
        <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
        <input type="submit" value="Submit" class='submit' />
    </fieldset>
</form>
<div>

</div>