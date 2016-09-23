$(window).load(function() {   
   $('.uni_wrapper').removeClass('loadingDiv');
   
});
$(function(){
	login_submit_form();
	forgot_formVal();
	loginactivationFormVal();
	 $('#login_submit').on('click', function(e) {
		 var username = $('#username').val();		
		 var password = $('#password').val();		
		if(username == '' || password == '' ){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('succesfully login');
			loginForm() ;
			e.preventDefault();
		}
        
    });
	 $('#forgot').on('click', function(e) {
		 var username = $('#username').val();
		if(username == ''){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');						
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('Successful');
			forgot_password() ;
			e.preventDefault();
		}
	});
	$('#loginactivation').on('click', function(e) {
		 var username = $('#username').val();
		 var password = $('#password').val();
		 var confirm_password = $('#confirm_password').val();
		if(username == '' || password == '' || confirm_password == ''){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');						
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Successful');
			login_activation() ;
			e.preventDefault();
		}
        
	}); 
});

/* Login Form Post */
function loginForm() {
	// Encode the String
	var encoded_string = Base64.encode('admin/login/login_submit/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#loginForm").serialize();
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
				$('.error-message .alerts').text(success_msg);
				setTimeout(function(){
					 var encoded_home_string = Base64.encode(response.redirect_url);
					 var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);				 
					 window.location.href = base_url + encoded_home_val;					
				}, 500);
			}
			else
			{
				$(".error-message").show();
				if(response.message)
				{
					failure_msg = response.message;
					$('.error-message').show();
					$('.error-message .alerts').removeClass('alert-success');
					$('.error-message .alerts').removeClass('alert-danger');
					$('.error-message .alerts').addClass('alert-danger');
					$('.error-message .alerts').text(failure_msg);
				}
				$(".alert").html(failure_msg);
			}
			return false;
		}
	});	
}
/* /Login Form Post */

 /* $('#login_submit').on('click', function(e) {
        loginForm() ;
		e.preventDefault();
 }); */
  
function login_activation()
{
	var ajaxData  = $("#loginactivationForm").serialize();
	var encoded_string = Base64.encode('admin/login/save_password/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);

    var encoded_login_string = Base64.encode('admin/login/index');
    var encoded_login_val = encoded_login_string.strtr(encode_chars_obj);

     $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {

        	if(response.status == true)
            {
            	$(".error-message .alerts").removeClass('alert-danger');
                $(".error-message .alerts").addClass('alert-success');
                $(".error-message").show();
                if(response.message)
                {
                    success_msg = response.message;
                }
                $(".alerts").html(success_msg);
                window.location.href = encoded_login_val ;
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
           /* return false;*/
        }
    });

}
function forgot_password() {
	// Encode the String
	var encoded_string = Base64.encode('admin/login/forgot_password/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	
	var ajaxData  = $("#forgotForm").serialize();		
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
			if(true == response.status)
			{
				$('.error-message').show();
				$('.error-message .alerts').removeClass('alert-danger');
				$('.error-message .alerts').addClass('alert-success');
				
				if(response.message)
				{
					success_msg = response.message;
				}				
				$('.error-message .alerts').text(success_msg);
				setTimeout(function(){						 
				// window.location.href = base_url + encoded_login_val;						  
				}, 500);
			}
			else
			{			
				$('.error-message').show();
				$('.error-message .alerts').removeClass('alert-success');
				$('.error-message .alerts').removeClass('alert-danger');
				$('.error-message .alerts').addClass('alert-danger');
					
				if(response.message)
				{
					failure_msg = response.message;
				}				
				$('.error-message .alerts').text('failure_msg');
			}
			return false;
		}
	});	
}

function login_submit_form(){	
	var loginsubmitform = $('#loginForm').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#login_submit'			
        },
        fields: {
            'username': {
                validators: {
                    notEmpty: {
                        message: 'The username cannot be empty'
                    }
                }
            },
			'password': {
                validators: {
					notEmpty: {
						 message: 'The password cannot be empty'
					}
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  			 
			loginForm();							
			e.preventDefault();			 
	  });  
}

function forgot_formVal(){
	$('#forgotForm').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#forgot'			
        },
        fields: {
            'username': {
                validators: {
                    notEmpty: {
                        message: 'The username cannot be empty'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  			 
			forgot_password();							
			e.preventDefault();			 
	  });  
}

function loginactivationFormVal(){
	 FormValidation.Validator.securePassword = {
        validate: function(validator, $field, options) {
            var value = $field.val();
            if (value === '') {
                return true;
            }

            // Check the password strength
            if (value.length < 8) {
                return {
                    valid: false,
                    message: 'The password must be more than 8 characters long'
                };
            }

            // The password doesn't contain any uppercase character
            if (value === value.toLowerCase()) {
                return {
                    valid: false,
                    message: 'The password must contain at least one upper case character'
                }
            }

            // The password doesn't contain any uppercase character
            if (value === value.toUpperCase()) {
                return {
                    valid: false,
                    message: 'The password must contain at least one lower case character'
                }
            }

            // The password doesn't contain any digit
            if (value.search(/[0-9]/) < 0) {
                return {
                    valid: false,
                    message: 'The password must contain at least one digit'
                }
            }

            return true;
        }
    };

	$('#loginactivationForm').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#loginactivation'			
        },
        fields: {
            'username': {
                validators: {
                    notEmpty: {
                        message: 'The username cannot be empty'
                    }
                }
            },
			'password': {
                validators: {
                    notEmpty: {
                        message: 'The password cannot be empty'
                    },
					securePassword: {
                        message: 'The password is not valid'
                    }
                }
            },
			'confirm_password': {
                validators: {					
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    },
					
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  			 
			login_activation();							
			e.preventDefault();			 
	  });  
}