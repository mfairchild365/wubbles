<?php
function get_var($var, $context) {
    if ($var == 'account' && $account_id = get_var('account_id', $context)) {
        return Wub_Account::getByID($account_id)->getFullName();
    }
    
    if (isset($context->$var)) {
        return $context->$var;
    }
    
    return null;
}

$memory = Wub_Memory::getByID($context->memory_id);
?>

<script type='text/javascript'>
    $(function() {
        
        $.get('<?php echo Wub_Controller::getAccount()->getFriendsListURl()?>?format=json', function(data) {
            data = $.parseJSON(data);
            
            //ensure properlly formatd data is sent to the autocomplete method.
            $.each(data, function(key, item) { 
                item.value = item.id;
                item.label = item.fullanme;
            });
            
            $('.result').html(data);
            $( "#account" ).autocomplete({
                minLength: 0,
                source: data,
                focus: function( event, ui ) {
                    $( "#account" ).val( ui.item.label );
                    return false;
                },
                select: function( event, ui ) {
                    $( "#account" ).val( ui.item.label );
                    $( "#account_id" ).val( ui.item.id );
                    return false;
                }
            })
            .data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a>" + item.label + "</a>" )
                    .appendTo( ul );
            };
        });
    });
</script>

Subject: <?php echo $memory->subject?>
<form  id='memoryForm' class='ajaxForm' action="<?php echo $context->getEditURL(); ?>" method="post">
    <fieldset>
        <legend>Share a Memory</legend>
            <ul>
                <li>
                    <label for="name">Friend:</label>
                    <input type="text" id='account' name="account" <?php echo get_var('account', $context);?>/>
                    <input type="hidden" id='account_id' name="account_id" value='<?php echo get_var('details', $context);?>'/>
                </li>
                <li>
                    <label for="description">Permission:</label>
                    <select name="permission">
                        <option value="view">View</option>
                    </select>
                </li>
            </ul>
        <input type="hidden" name="id" value='<?php echo $context->id;?>'/>
        <input type="hidden" name="memory_id" value='<?php echo $context->memory_id;?>'/>
        <input type="hidden" name="_class" value='<?php echo get_class($context->getRawObject()); ?>'/>
        <input type="submit" value="Submit" class='submit' />
    </fieldset>
</form>