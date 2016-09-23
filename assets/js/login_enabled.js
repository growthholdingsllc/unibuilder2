$(function(){
	
	$('.drop-down-show-hide').hide();
	$('#accessmethod').change(function(){
		$(this).find("option").each(function()
		{
			$('.' + this.value).hide();
		});
		$('.' + this.value).show();
	});	
	Login_enabled();
		
});	

function Login_enabled(){
	$(document).on('ifChecked','#login-enabled', function(event){			
		$("#accessmethod").prop("disabled", false);
		$(".disabled_prop").prop("disabled", false);		
		$(".disabled_input").prop("disabled", false);				
		$('.access-log').show();
		
	});	
	$(document).on('ifUnchecked','#login-enabled', function(event){		
		$('.selectpicker').selectpicker('deselectAll');	
		$('.log-disable').hide();     		
	});
      
}
$(function() {
    var accessmethod = $('#accessmethod').val();
    if(accessmethod === 'configure')
    {
        $('.' + accessmethod).show();
    }
});
$(function(){
    if($('#login-enabled').attr('checked'))
    {
      $('.access-log').show();
    } 
    else
    {
        $('.access-log').hide();
    }
});
$("#builderuseremailinvitation").click(function(){
        var user_id = $('#ub_user_id').val();
        if(user_id == 0)
        {
            // alert('First save the user details');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('First save the user details');
            return false;
        }
        else
        {
            builderuseremailinvitation();
        }
        
    }); 
 /* code to send email to project Owner */
function builderuseremailinvitation() {
    var email = $('#primary_email').val();
    if(email != '')
    {
    var name=document.getElementById('first_name').value + " " + document.getElementById('last_name').value;
    var primary_email=document.getElementById('primary_email').value;
    var ub_user_id=document.getElementById('ub_user_id').value;
    // Encode the String
    if($.isNumeric( ub_user_id ))
    {
        var encoded_string = Base64.encode('user/subuser_email_invitation/');
        var encoded_val = encoded_string.strtr(encode_chars_obj);

    }
    else
    {
        var encoded_string = Base64.encode('user/builderuser_email_invitation/');
        var encoded_val = encoded_string.strtr(encode_chars_obj);
    }
    /*var encoded_string = Base64.encode('user/builderuser_email_invitation/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    */
    var success_msg = 'Successful';
    var failure_msg = 'Failed';

    var ajaxData  = 'name='+name+'&primary_email='+primary_email+'&ub_user_id='+ub_user_id;       
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,     
        success: function(response) {
            if(true == response.status)
            {
                $(".error-message .alerts").removeClass('alert-danger');
                $(".error-message .alerts").addClass('alert-success');
                $(".error-message").show();
                if(response.message)
                {
                    success_msg = response.message;
                }
                $(".alerts").html(success_msg);
                setTimeout(function(){                       
                // window.location.href = base_url + encoded_login_val;                       
                }, 500);
            }
            else
            {
                $(".error-message").show();
                if(response.message)
                {
                    failure_msg = response.message;
                }
                $(".alerts").html(failure_msg);
            }
            return false;
        }
    }); 
   }
   else
   {
    // alert("Please Enter your primary email id");
	$('#alertModal').modal('show');
	$('.alert_modal_txt').text('Please Enter your primary email id');
   }
}