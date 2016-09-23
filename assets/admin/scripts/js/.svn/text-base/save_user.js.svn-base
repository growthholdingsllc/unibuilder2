$(function(){
	add_new_user_form();
	edit_new_user_form();
	//$(".box").hide();
	$("#user_status").on('change',function(){
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
	
	$("#status_id").on('change',function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("value")==""){
				$('#select_change').val('');
                $(".box").hide();
            }
            else if($(this).attr("value")=="Active"){
				$('#select_change').val('active');
                 $(".box").show();
            }
            else if($(this).attr("value")=="Inactive"){
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

$('#save_new_user').click(function(e) {
	var firstname 		= $('#first-name').val();		
	var surname 		= $('#sur-name').val();		
	var primary_email 	= $('#primary_email').val();		
	var user_status 	= $('#user_status').val();		
	var username 		= $('#username').val();			
		if(firstname == '' || surname == '' || primary_email == '' || user_status == ''){			
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
				save_user();
				e.preventDefault();
			}
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Updated Results search succesfully');
			save_user();
			e.preventDefault();
		}
	
});
$('#update_user').click(function(e) {	
	var firstname 		= $('#first-name').val();		
	var surname 		= $('#sur-name').val();				
	var user_status 	= $('#status_id').val();		
	var username 		= $('#username').val();			
		if(firstname == '' || surname == '' || user_status == ''){			
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
				update_user();
				e.preventDefault();
			}
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Updated Results search succesfully');
			update_user();
			e.preventDefault();
		}
});
function update_user()
{
	var encoded_string = Base64.encode('admin/user/update_user/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var encoded_home_string = Base64.encode('admin/user/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	var ajaxData  = $("#edit_new_user").serialize();
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
			$('#ub_user_id').val(response.userid);
			$('.error-message .alerts').text(response.message);
/* 			$('.uni_wrapper').removeClass('loadingDiv'); */
				//window.location.href = encoded_home_val;
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
function save_user()
{
	var encoded_string = Base64.encode('admin/user/save_user/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('admin/user/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var ajaxData  = $("#add_new_user").serialize();
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
			$('#ub_user_id').val(response.userid);
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

$('#send_activation_link').click(function(e) {
var firstname 		= $('#first-name').val();		
	var surname 		= $('#sur-name').val();		
	var primary_email 	= $('#primary_email').val();		
	var user_status 	= $('#user_status').val();		
	var username 		= $('#username').val();			
		if(firstname == '' || surname == '' || primary_email == '' || user_status == ''){			
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
			$('.error-message .alerts').text('Updated Results search succesfully');
			send_activationlink();
	       e.preventDefault();
		}

});

$('#save_new_user').click(function(e) {
	var firstname 		= $('#first-name').val();		
	var surname 		= $('#sur-name').val();		
	var primary_email 	= $('#primary_email').val();		
	var user_status 	= $('#user_status').val();		
	var username 		= $('#username').val();			
		if(firstname == '' || surname == '' || primary_email == '' || user_status == ''){			
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
				save_user();
				e.preventDefault();
			}
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Updated Results search succesfully');
			save_user();
			e.preventDefault();
		}
	
});

$('#cancel_user').click(function(e) {
	var encoded_home_string = Base64.encode('admin/user/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	window.location.href = encoded_home_val;
});
function send_activationlink()
{
	var encoded_string = Base64.encode('admin/user/user_email_invitation/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('admin/user/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	var edit_page = $('#edit_page').val();
	if(edit_page == 'edit')
	{
	 var ajaxData  = $("#edit_new_user").serialize();
	}
	else{
	var ajaxData  = $("#add_new_user").serialize();
	}
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

function add_new_user_form(){	
	var addnewuserform = $('#add_new_user').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save_new_user, #send_activation_link'			
        },
        fields: {
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
						 message: 'The sur name cannot be empty'
					}
                }
            },
			'primary_email': {
                validators: {
					notEmpty: {
						 message: 'The email cannot be empty'
					},
					emailAddress: {
                        message: 'The value is not a valid email address'
                   }
                }
            },
			'user_status': {
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
                                var username = $('#add_new_user').find('[name="username"]').val();
                                return (username !== '');
                            }
                        }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			save_user();						
			e.preventDefault();			 
	  }).on('change', '[name="user_status"]', function(e) {
            $('#add_new_user').formValidation('revalidateField', 'username');
        });  
}
$("#delete_user").click(function(){
		deleteuser();
	});
/* code to delete the project*/
function deleteuser()
{
	var encoded_string = Base64.encode('admin/user/delete_users/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var encoded_home_string = Base64.encode('admin/user/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	//var edit_page = $('#edit_page').val();
	 var ajaxData  = $("#edit_new_user").serialize();
	 $.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,		
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
			window.location.href = encoded_home_val ;
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
function edit_new_user_form(){	
	$('#edit_new_user').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_user, #send_activation_link'			
        },
        fields: {
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
						 message: 'The sur name cannot be empty'
					}
                }
            },			
			'status_id': {
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
                                var username = $('#edit_new_user').find('[name="username"]').val();
                                return (username !== '');
                            }
                        }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			save_user();						
			e.preventDefault();			 
	  }).on('change', '[name="status_id"]', function(e) {
            $('#edit_new_user').formValidation('revalidateField', 'username');
        });  
}
