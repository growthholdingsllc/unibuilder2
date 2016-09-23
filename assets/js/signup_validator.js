/* Login Module Start*/
$(function() { 
	signupvalidation();
	 $("#username").blur(function(e) {
        var username_set = $('#system_provided_user_name').val();
        //alert(username_set);
        if (username_set != '') 
        {
            
        }
        else
        {
            check_valid_user();
        }
		e.preventDefault();
   });
	
});
$('#loginForm').on('click', function(e){		
		var username = $('#username').val();		
		var password = $('#password').val();
		var cpassword = $('#cpassword').val();
		
		if(username == '' || password == '' || cpassword == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{			
			check_valid_user();
			sign_up();
			e.preventDefault();
		}
	});
/* Login Form Post */

/* /Login Form Post */
function check_valid_user()
{
    var username = $('#username').val();
    var ajaxData  = 'username='+username;
    var encoded_string = Base64.encode('register/unique_user/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },		
        success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
            if(response.status == true)
            {               
                if(response.message)
                {
                    success_msg = response.message;
                }
				success_box();
				$('.error-message .alerts').text(success_msg);	                
            }
            else
            {   
                
                if(response.message)
                {
                    failure_msg = response.message;
                }                   
				error_box();
				$('.error-message .alerts').text(failure_msg);				
            }
           /* return false;*/
        }
    });
}
function sign_up()
{
	var ajaxData  = $("#signup_form").serialize();
	var ub_user_id = $('#ub_user_id').val();
	var encoded_string = Base64.encode('register/accept_invite/'+ub_user_id);
    var encoded_val = encoded_string.strtr(encode_chars_obj);

    var encoded_login_string = Base64.encode('login/login_submit/');
    var encoded_login_val = encoded_login_string.strtr(encode_chars_obj);
     $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {
        	if(response.status == true)
            {		
            	
                if(response.message)
                {
                    success_msg = response.message;
                }                
				success_box();
				$('.error-message .alerts').text('Password updated successfully');	
                loginForm();				
            }
            else
            {   
                if(response.message)
                {
                    failure_msg = response.message;
                }   
                error_box();
				$('.error-message .alerts').text(failure_msg);              
            }
           //return false;
        }
    });

}
function loginForm() {	
    // Encode the String
    var encoded_string = Base64.encode('login/login_submit/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var success_msg = 'Successful';
    var failure_msg = 'Failed';

    var username = $('#username').val();
    var password = $('#password').val();
    
    var ajaxData  = 'username='+username+'&password='+password;

        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,     
        success: function(response) {
            if(response.status == true)
            {
               
                if(response.message)
                {
                    success_msg = response.message;
                }
                success_box();
				$('.error-message .alerts').text('Password updated successfully');	
                setTimeout(function(){
				var encoded_home_string = Base64.encode(response.dashbord_url);
				var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
                 window.location.href = base_url + encoded_home_val;                          
                }, 500);
            }
            else
            {
               
                if(response.message)
                {
                    failure_msg = response.message;
                }                
				error_box();
				$('.error-message .alerts').text(failure_msg);
            }           
        }
    }); 
}
/* Registration  Form Val*/
function signupvalidation(){
	var loginform = $('#signup_form').formValidation({        
		button: {
            selector: '#loginForm'          
        },
        fields: {
            'userName': {
                validators: {
                    notEmpty: {
                        message: 'The User name is required and cannot be empty'
                    }
                }
            },
            'password': {
                validators: {
                    notEmpty: {
                        message: 'The Password is required and cannot be empty'
                    },
                    stringLength: {
                        min: 5,
                        message: 'The New password must be greater than five characters'
                    }			
                }
            },
		
			'confirm_password':{
                validators: {
                    identical: {
						field: 'password',
						message: 'The password and its confirm are not the same'
					}
                }
            }		
			
        }		/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
            data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) { 			
			sign_up();
			e.preventDefault();      
    }); 
}
/* /Login Form Val*/
/* /Login Module End*/
/* Project Module Start */


/* Project Module End */
function error_box(){
	$('.error-message').show();
	$('.error-message .alerts').removeClass('alert-success');
	$('.error-message .alerts').removeClass('alert-danger');
	$('.error-message .alerts').addClass('alert-danger');
}
function success_box(){
	$('.error-message').show();
	$('.error-message .alerts').removeClass('alert-danger');
	$('.error-message .alerts').addClass('alert-success');	
}