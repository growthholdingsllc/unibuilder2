/** 
 * Change password js
 * 
 * @package: Change password js
 * @subpackage: Change password js 
 * @category: Registration
 * @author: Devansh
 * @createdon(DD-MM-YYYY): 12-05-2015
*/
$(function(){
	change_pass_form();
});
// $( "#password" ).blur(function(e) {
	// $(".alerts").html('');
    // check_valid_password();
    // e.preventDefault();
   // });
/* function to check the correct old password*/
function check_valid_password()
{
    var password = $('#password').val();
    var ajaxData  = 'password='+password;
    var encoded_string = Base64.encode('user/check_old_password/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,  		
        success: function(response) {

            if(response.status == true)
            {
			$('.uni_wrapper').removeClass('loadingDiv');				
                $(".error-message .alerts").removeClass('alert-danger');
                $(".error-message .alerts").addClass('alert-success');
                $(".error-message").show();
                if(response.message)
                {
                    success_msg = response.message;
                }
                $(".alerts").html(success_msg);
                save_change_password();
            }
            else
            {   
			 $('.uni_wrapper').removeClass('loadingDiv');
                $(".error-message .alerts").removeClass('alert-success');
                $(".error-message .alerts").addClass('alert-danger');        
                $(".error-message").show();
                if(response.message)
                {
                    failure_msg = response.message;
                }   
                $(".alerts").html(failure_msg);              
            }
           /* return false;*/
        }
    });
}

/* on click check the new password is set*/
$(function() {
	$('#save_change_password').on('click',function(e) {
		var password = $('#password').val();		
		var new_password = $('#new_password').val();		
		var confirm_password = $('#confirm_password').val();		
		if(password == '' || new_password == '' || confirm_password == ''){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{
			$('.error-message').show();
			//$('.error-message .alerts').removeClass('alert-danger');
			//$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('Updated Results search succesfully');
			check_valid_password();
			//save_change_password();
			e.preventDefault();
		}
		/*var password = $('#password').val();
		var new_password = $('#new_password').val();
		var confirm_password = $('#confirm_password').val();
		if (password == '') 
		{
			alert("Old password field is required");
		}
		else
		{
			if (new_password == '') 
			{
				alert("New password field is required");
			}
			else
			{
				if (confirm_password == '') 
				{
					alert("Confirm password field is required");
				}
				else
				{
					if (new_password === confirm_password) 
					{
						save_change_password();
					}
					else
					{
						alert("New password and confirm password are not same");
					}
				}
			}	
		}
		*/
	});
});

/* function for change password */
function save_change_password() {
	// Encode the String
	//alert("hello");
	var encoded_string = Base64.encode('user/change_password/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#change_password").serialize();

    var password_length = $('#new_password').val().length;
    if(password_length < 5)
    {
        //alert('Password must be greater than five character');
        error_box();           
        $('.error-message .alerts').text('Password must be greater than five character');
        return false;
    }
	//alert(ajaxData);
		$.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,  
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },		
        success: function(response) {           
            
            if(response.status == true)
            {
				$('.uni_wrapper').removeClass('loadingDiv');
                $(".error-message .alerts").removeClass('alert-danger');
                $(".error-message .alerts").addClass('alert-success');
                $(".error-message").show();
                if(response.message)
                {
                    success_msg = response.message;
                    //alert(response.username);
                }
                $(".alerts").html(success_msg);
            }
            else
            {   
                $(".error-message .alerts").removeClass('alert-success');
                $(".error-message .alerts").addClass('alert-danger');        
                $(".error-message").show();
                if(response.message)
                {
                    failure_msg = response.message;
                }   
                $(".alerts").html(failure_msg);              
            }
        }
    }); 
}

function change_pass_form(){	
	var changepassform = $('#change_password').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save_change_password'			
        },
        fields: {
            'password': {
                validators: {
                    notEmpty: {
                        message: 'The Old password cannot be empty'
                    }
                }
            },
			'new_password': {
                validators: {
                    notEmpty: {
                        message: 'The New password cannot be empty'
                    },
                    stringLength: {
                        min: 5,
                        message: 'The New password must be greater than five characters'
                    }
                }
            },
			'confirm_password': {
                validators: {					
                    identical: {
                        field: 'new_password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {
			check_valid_password();		  
			save_change_password();
			e.preventDefault();			 
	  });	
	
}

