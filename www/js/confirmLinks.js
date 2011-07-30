function initConfirmLinks()
{
    $(".confirmLink").click(function(e) {
        e.preventDefault();
        var targetUrl  = $(this).attr("href");
        var ajaxDelete = $(this).hasClass('ajaxDelete');
        var parent     = $(this).parent().parent();
        
        $("#dialog").dialog({
            buttons : {
                "Confirm" : function() {
                    if (ajaxDelete) {
                        $.ajax({
                            url: targetUrl + '?format=json',
                            success: function(){
                                $(parent).hide('slow', function() {
                                    $(parent).remove();
                                })
                            }
                        });
                        $(this).dialog("close");
                    } else {
                        window.location.href = targetUrl;
                    }
                },
                "Cancel" : function() {
                    $(this).dialog("close");
                }
            }
        });
        
        $("#dialog").dialog("open");
    });
}