$(function(){
	save_form();		
	$(".box").hide();
	$('#save_new_builder').click(function(e) {		
		var company_name 	= $('#company_name').val();		
		var first_name 		= $('#first_name').val();		
		var last_name 		= $('#last_name').val();		
		var email_address 	= $('#email_address').val();		
		var zip 			= $('#zip').val();		
		var username 		= $('#username').val();					
		var plan_id 		= $('#plan_id').val();		
		var account_info 		= $('#account_info').val();		
		if(company_name == '' || first_name == '' || last_name == '' || email_address == '' || zip == '' || plan_id == '' || account_info == ''){	
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else if($('#select_change').val() == 'active'){			
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
				// $('.error-message .alerts').text('Added builder succesfully');
				save_builder_user();
				e.preventDefault();
			}
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			// $('.error-message .alerts').text('Added builder succesfully');
			save_builder_user();
			e.preventDefault();
		}
		
	});
	$('#cancel').click(function(e) {
	var encoded_home_string = Base64.encode('admin/builder/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	window.location.href = encoded_home_val;
		e.preventDefault();
    });
	
	$("#account_info").on('change',function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("value")==""){
				$('#select_change').val('');
                $(".box").hide();
            }
            else if($(this).attr("value")=="active"){
				$('#select_change').val('active');
                 $(".box").show();
            }
            else if($(this).attr("value")=="inactive"){
				$('#select_change').val('');
                 $(".box").hide();
            }
            else{
				$('#select_change').val('');
                $(".box").hide();
            }
        });
    });	
});


function save_builder_user()
{
	var encoded_string = Base64.encode('admin/builder/add_builder/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('admin/builder/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#add_new_builder").serialize();
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
			
				window.location.href = encoded_home_val;
			}
			else
			{
			    $('.error-message').show();
				$('.error-message .alerts').removeClass('alert-success');
				$('.error-message .alerts').removeClass('alert-danger');
				$('.error-message .alerts').addClass('alert-danger');
				$('.error-message .alerts').text(response.message);	
			}
			return false;
		}
	});	
}

$('#send_activation_link').click(function(e) {
	
	var company_name 	= $('#company_name').val();		
		var first_name 		= $('#first_name').val();		
		var last_name 		= $('#last_name').val();		
		var email_address 	= $('#email_address').val();		
		var zip 			= $('#zip').val();		
		var username 		= $('#username').val();					
		var plan_id 		= $('#plan_id').val();		
		var account_info 		= $('#account_info').val();		
		if(company_name == '' || first_name == '' || last_name == '' || email_address == '' || zip == '' || plan_id == '' || account_info == ''){	
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else if($('#select_change').val() == 'active'){			
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
				$('.error-message .alerts').text('Added builder succesfully');
				send_activationlink();
				e.preventDefault();
			}
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Added builder succesfully');
			send_activationlink();
			e.preventDefault();
		}	
	
});
function send_activationlink()
{
	var encoded_string = Base64.encode('admin/builder/user_email_invitation/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('admin/builder/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var ajaxData  = $("#add_new_builder").serialize();
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
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text(response.message);
		    $('.uni_wrapper').removeClass('loadingDiv');
			window.location.href = encoded_home_val;
			}
			else
			{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text(response.message);
			return false;
			}
		}
	});	
}

function save_form(){	
	var saveform = $('#add_new_builder').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save_new_builder, #send_activation_link'			
        },
        fields: {
            'company_name': {
                validators: {
                    notEmpty: {
                        message: 'The company name cannot be empty'
                    }
                }
            },
			'first_name': {
                validators: {
                    notEmpty: {
                        message: 'The first name cannot be empty'
                    }
                }
            },
			'last_name': {
                validators: {
                    notEmpty: {
                        message: 'The last name cannot be empty'
                    }
                }
            },
			'email_address': {
                validators: {
					notEmpty: {
                        message: 'The email cannot be empty'
                    },
                   emailAddress: {
                        message: 'The value is not a valid email address'
                   }
                }
            },
			'zip': {
                validators: {
                    notEmpty: {
                        message: 'The zip cannot be empty'
                    }
                }
            },
			'account_info': {
                validators: {
                    notEmpty: {
                        message: 'The account cannot be empty'
                    }
                }
            },			
			'username': {
                validators: {                    
					callback: {
                            message: 'The username cannot be empty',
                            callback: function(value, validator, $field) {
                                var username = $('#add_new_builder').find('[name="username"]').val();
                                return (username !== '');
                            }
                        }
                }
            },			
			'plan_id': {
                validators: {
                    notEmpty: {
                        message: 'Please select the plan'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  			
			save_builder_user();							
			e.preventDefault();			 
	  }).on('change', '[name="account_info"]', function(e) {
            $('#add_new_builder').formValidation('revalidateField', 'username');
        });		 
}

