function initDeleteForms()
{
	var options = { 
        success: handleDeleteResponse,  // post-submit callback 
    }
	
    if ($('.deleteForm').length > 0) {
    	$( ".deleteForm" ).submit(function(){
    			$("#dialog").html("Confirm delete");
    			var form = this;
    			$(form).attr("action", $(form).attr("action") + "?format=partial")
                $("#dialog").dialog({
                    buttons : {
                        "Confirm" : function() {
                            $(this).dialog("close");
                            $(form).ajaxSubmit(options);
                            return false;
                        },
                        "Cancel" : function() {
                            $(this).dialog("close");
                            return false;
                        }
                    }
                });
                $("#dialog").dialog("open")
                //alert('here');
                return false;
        });
        
        $('.deleteForm').ajaxForm(options); 
    }
}

function handleDeleteResponse(responseText, statusText, xhr, $form)
{
    /*
    This is kinda tricky.  We have to grab the content, which is pure html (html tags and all)
    and get the #maincontent area.  THEN we have to set the contents of the dialog-message to
    the content of the maincontent area.  o.O
    */
    var div = ($(responseText).find('#maincontent')[0]);
    
    if ($(div).find('#success').length > 0) {
    	if ($($form).hasClass('ajaxDelete')) {
	        var parent = $($form).parent().parent();
	        $(parent).hide('slow', function() {
	            $(parent).remove();
	        })
    	} else {
    		$('#maincontent').html($(div).find('#success'));
    	}
    }

    return false;
}