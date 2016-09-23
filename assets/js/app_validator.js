/* Login Module Start*/
$(function() {
	//loginformval();	
	forgotpassword();		
	reset_form();
	
});
$(document).on('click', '#login-form', function(e){	
		loginformval();	
	});
function reset_form(){
$('#resetForm').formValidation({
	message: 'This value is not valid',	
	button: {
        selector: '#reset-form',          
    },
	fields: {
		newpassword: {
			validators: {
				notEmpty: {
					message: 'The Password is required'
				},
				identical: {
					field: 'confirmpassword',
					message: 'The password and its confirm are not the same'
				}
			}
		},
		confirmpassword: {
			validators: {
				notEmpty: {
					message: 'The Password is required'
				},
				identical: {
					field: 'validators',
					message: 'The password and its confirm are not the same'
				}
			}
		}
	}
}).on('err.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);  
      }).on('success.form.fv', function(e) {	
			reset_password_form();
			e.preventDefault();
	  });
}
/* Login Form Post */
function loginForm() {
	// Encode the String
	var encoded_string = Base64.encode('login/login_submit/');
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
			   
				$(".error-message .alert").removeClass('alert-danger');
				$(".error-message .alert").addClass('alert-success');
				$(".error-message").show();
				if(response.message)
				{
					success_msg = response.message;
				}
				$(".alert").html(success_msg);
				setTimeout(function(){
				var encoded_home_string = Base64.encode(response.dashbord_url);
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
				}
				$(".alert").html(failure_msg);
				if(response.re_direct_status == true)
				{
					window.location.href = response.re_direct_url;
				}
			}
			return false;
		}
	});	
}
/* /Login Form Post */
/* Login Form Val*/
function loginformval(){
	var loginform = $('#loginForm').formValidation({        
		 button: {
            selector: '#login-form',          
        },
        fields: {
            'username': {
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
                    }				
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
           data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {
           data.fv.disableSubmitButtons(false);
      }).off('success.form.fv').on('success.form.fv', function(e) {	
			loginForm();
			 e.preventDefault();          
           
	  });	
}
/* /Login Form Val*/
function forgotpassword(){
var forgotform = $('#forgotForm').formValidation({
	framework: 'bootstrap',
	excluded: ':disabled',	
	button: {
        selector: '#forgot-form',          
    },
	fields: {
		'user[username]': {
			validators: {
				notEmpty: {
					message: 'The User name is required and cannot be empty'
				}
			}
		}
	}
}).on('err.field.fv', function(e, data) {
           data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {
           data.fv.disableSubmitButtons(false);
      }).on('success.form.fv', function(e) {	
			forgotForm();
			e.preventDefault();
	  });
}
/* Login Form Post */
function forgotForm() {
	// Encode the String
	var encoded_string = Base64.encode('login/forgot_password/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_login_string = Base64.encode('login/index/');
	var encoded_login_val = encoded_login_string.strtr(encode_chars_obj);
	
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
				$(".error-message .alert").removeClass('alert-danger');
				$(".error-message .alert").addClass('alert-success');
				$(".error-message").show();
				if(response.message)
				{
					success_msg = response.message;
					
				}
				$(".alert").html(success_msg);
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
				$(".alert").html(failure_msg);
			}
			return false;
		}
	});	
}
/* /Login Form Post */
/* /Reset Password Form Post */
function reset_password_form() {
	// Encode the String
	var encoded_string = Base64.encode('login/reset_password/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_login_string = Base64.encode('login/index/');
	var encoded_login_val = encoded_login_string.strtr(encode_chars_obj);
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	
	var ajaxData  = $("#resetForm").serialize();	
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
				$(".error-message .alert").removeClass('alert-danger');
				$(".error-message .alert").addClass('alert-success');
				$(".error-message").show();
				if(response.message)
				{
					success_msg = response.message;
				}
				$(".alert").html(success_msg);
				setTimeout(function(){						 
				 window.location.href = base_url + encoded_login_val;						  
				}, 500);
			}
			else
			{
				$(".error-message").show();
				if(response.message)
				{
					failure_msg = response.message;
				}
				$(".alert").html(failure_msg);
			}
			return false;
		}
	});	
}
/* /Reset Password Form Post */
/* /Login Module End*/