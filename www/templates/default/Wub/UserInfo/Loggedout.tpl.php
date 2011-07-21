<script type="text/javascript">
$(function(){
    $('#logindiv').hide();
    $('#login').click(function() {
        if ($('#logindiv').is(":visible")) {
            $('#logindiv').hide();
            return false;
        }
        $.ajax({
            url: "<?php echo Wub_Controller::$url . "login?format=partial"?>",
            success: function(data){
            $('#logindiv').html(data);
            initAjaxForms();
            $('#logindiv').show();
            }
        });
        return false;
    });
});
</script>

<a href="<?php echo Wub_Controller::$url . "login"?>" class="ui-state-default ui-corner-all" id='login' title="login" style='float:right'><span class="ui-icon ui-icon-power"></span></a>
<div id='logindiv'>
</div>