$(function() {
	add_formval();
	//Add and Stay
	$('#sub_user_save_and_stay').on('click',function(e) {
			$("#save_type").val('save_and_stay');
			var first_name = $('#first_name').val();		
			var primary_email = $('#primary_email').val();		
			var time_zone = $('#time_zone').val();		
			var date_format = $('#date_format').val();		
			if(first_name == '' || primary_email == '' || time_zone == '' || date_format == ''){			
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
				$('.error-message .alerts').text('Updated Results search succesfully');
				add_sub_user_list_form();
				e.preventDefault();
			}
	});
	//Add and New
	$('#sub_user_save_and_new').on('click',function(e) {
			$("#save_type").val('save_and_new');
			var first_name = $('#first_name').val();		
			var primary_email = $('#primary_email').val();		
			var time_zone = $('#time_zone').val();		
			var date_format = $('#date_format').val();		
			if(first_name == '' || primary_email == '' || time_zone == '' || date_format == ''){			
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
				$('.error-message .alerts').text('Updated Results search succesfully');
				add_sub_user_list_form();
				e.preventDefault();
			}
	});	
	//Add and back
	$('#sub_user_save_and_back').on('click',function(e) {
			$("#save_type").val('save_and_back');
			var first_name = $('#first_name').val();		
			var primary_email = $('#primary_email').val();		
			var time_zone = $('#time_zone').val();		
			var date_format = $('#date_format').val();		
			if(first_name == '' || primary_email == '' || time_zone == '' || date_format == ''){			
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
				$('.error-message .alerts').text('Updated Results search succesfully');
				add_sub_user_list_form();
				e.preventDefault();
			}
	});
	
});

function add_sub_user_list_form() {
	// Encode the String
	var encoded_string = Base64.encode('user/save_subuser/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('user/user_subuser/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';


	var ajaxData  = $("#add_new_sub_user").serialize();	
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,			
		success: function(response) {
			if(response.status == true)
			{	
			//console.log(response.insert_id);return false;
				if($("#save_type").val() == 'save_and_new')
				{
					window.location.href = encoded_val;
				}
				else if($("#save_type").val() == 'save_and_back')
				{
					window.location.href = encoded_home_val;
				}
				else if($("#save_type").val() == 'save_and_stay')
                {
					if (response.message == 'Data inserted successfully') {
                    var encoded_string_edit_log = Base64.encode( 'user/save_subuser/' + response.insert_id);
                    var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                    window.location.href = encoded_edit_val;
					}
                }
				 $(".error-message .alerts").removeClass('alert-danger');
				$(".error-message .alerts").addClass('alert-success');
				$(".error-message").show();
				if(response.message)
				{
					success_msg = response.message;								
				}
				$(".alerts").html(success_msg);
				//$(".alert").html(success_msg);
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
				//$(".alert").html(failure_msg);				
			}
			return false;
		}
	});	
}

/*
Delete user
*/
function delete_sub_users(ub_user_id){
    if(ub_user_id > 0)
    {   
    var encoded_delete_roles = Base64.encode('user/delete_builderuser/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('user/user_subuser/');
    var index_url = index_string.strtr(encode_chars_obj);
	var conf = $('#confirmModal').modal('show');
$('#delete_confirm').click(function(){
	var conf = true;
	if(conf == true){
		$('#confirmModal').modal('hide');
			$.ajax({
					type:'POST',
					url: base_url + encoded_delete_val,
					dataType: 'json',
					data: {'ub_user_id':{ub_user_id:ub_user_id}},
					success: function(response) {   
						if(response.status == true)
						{   
							$(".error-message .alerts").removeClass('alert-danger');
							$(".error-message .alerts").addClass('alert-success');
							$(".error-message").show();
							if(response.message)
							{
								success_msg = response.message;
								window.location.href = index_url;                           
							}
							$(".alerts").html(success_msg);
						}
						else
						{               
							if(response.message)
							{
								failure_msg = response.message;
							}           
						}
						return false;
					}
				});
		}
	 });
    }
    else
    {               
        $(".error-message .alerts").addClass('alert-danger');
        $(".error-message .alerts").removeClass('alert-success');
        $(".error-message").show();
        $(".alerts").html("User id is not set");      
    }
}

function add_formval(){
	var addformval = $('#add_new_sub_user').find('[name="time_zone"], [name="date_format"]').selectpicker().change(function(e) {            
                $('#add_new_sub_user').formValidation('revalidateField', 'time_zone, date_format');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#sub_user_save_and_stay, #sub_user_save_and_new, #sub_user_save_and_back'			
        },
        fields: {
            'first_name': {
                validators: {
                    notEmpty: {
                        message: 'The name is required cannot be empty'
                    }
                }
            },
			'primary_email': {
                validators: {
                    notEmpty: {
                        message: 'The name is required cannot be empty'
                    },
					emailAddress: {
                        message: 'Please enter the valid mail'
                    }
                }
            },
			'time_zone': {
                validators: {
                    notEmpty: {
                        message: 'Please select the time zone'
                    }
                }
            },
			'date_format': {
                validators: {
                    notEmpty: {
                        message: 'Please select the date format'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#save_type").val() == 'save_and_stay'){
				add_sub_user_list_form();				
			 }
			else if($("#save_type").val() == 'save_and_new'){
				add_sub_user_list_form();				
			}	
			else if($("#save_type").val() == 'save_and_back'){
				add_sub_user_list_form();				
			}
			e.preventDefault();			 
	  });
	
}