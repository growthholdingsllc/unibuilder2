$(function(){
    var total_modules = $('#total_modules').val();
    if($('#checkbox6:checked').length == total_modules)
    {
        $('#email_check').closest('.icheckbox_square-red').addClass('checked');   
        $('#email_check').attr("checked", "checked");
    }
    if($('#checkbox7:checked').length == total_modules)
    {
        $('#text_check').closest('.icheckbox_square-red').addClass('checked');   
        $('#text_check').attr("checked", "checked");
    }

});

imgLink = base_url + 'assets/images/';
$(function(){
	$('#alter_email').tagsinput({		
   		allowDuplicates: false
   	});	
	$('#desk_phone').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	$('#mobile_phone').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	
});	
$(function() {
   /*  if (typeof list_page != 'undefined') {     
	user_jobs_site_view();
   } */
   var url = window.location.href;
	var hash = url.substring(url.indexOf("#"));
	if (hash == "#Jobsite_Access")
	{
		user_jobs_site_view();
	}
   $(document).on( 'shown.bs.tab', 'a[href="#Jobsite_Access"]', function (){ 		
		user_jobs_site_view();
   });
});
function user_jobs_site_view() {
    var encoded_url = Base64.encode('user/get_all_projects_user_involved/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        // Data table Object
    var ub_user_id = $('#ub_user_id').val(); 
        var dbobject = {                    
                            'tableName': $('#user_jobs_site_view'),
                            'ajax_encoded_url':ajax_encoded_url,
                            'id':'project_name',
                            'name': "project_name",
                            'this_table' : {'table_name':'user_jobs_site_view'},
                            'post_data':'{"ub_user_id":"'+ub_user_id+'"}',
                            'delete_data':{}, 
                            'edit_data':{},
                            'display_columns' : [{"data": "project_name"},{"data": "role_name"},{"data": "project_status"},{"data": "project_group"},{"data": "projected_start_date"}],
                            'default_order_by': [[0, 'desc']]
                        };

        // Populate data table
        ubdatatable(dbobject);
    
}
/* 
 Set your save type
 */
$(function() {
    save_builder_user_form();
    $('#add_builderuser').click(function(e) { 
         $("#save_type").val('save_and_stay');
		var first_name 		= $('#first_name').val();		
		var primary_email 	= $('#primary_email').val();		
		var role_id 		= $('#role_id').val();		
		var date_format 	= $('#date_format').val();		
		var time_zone 		= $('#time_zone').val();	
		var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;		
		if(first_name == '' || primary_email == '' || role_id == '' || date_format == '' || time_zone == '' || valid == false){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{
			
			add_builderuser_form();
			e.preventDefault();
		}		                 
    });

    $('#builderuseremailinvitation').click(function(e) { 
         $("#save_type").val('save_and_stay_and_sent_mail');
        var first_name      = $('#first_name').val();       
        var primary_email   = $('#primary_email').val();        
        var role_id         = $('#role_id').val();      
        var date_format     = $('#date_format').val();      
        var time_zone       = $('#time_zone').val();     
		var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;	
        if(first_name == '' || primary_email == '' || role_id == '' || date_format == '' || time_zone == '' || valid == false){           
            error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');                  
        }
        else{           
            add_builderuser_form();
            e.preventDefault();
        }                        
    });

    $('#add_builderuser_new').click(function(e) {
        $("#save_type").val('save_and_new');
		var first_name 		= $('#first_name').val();		
		var primary_email 	= $('#primary_email').val();		
		var role_id 		= $('#role_id').val();		
		var date_format 	= $('#date_format').val();		
		var time_zone 		= $('#time_zone').val();	
		var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;	
		if(first_name == '' || primary_email == '' || role_id == '' || date_format == '' || time_zone == '' || valid == false){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{			
			add_builderuser_form();
			e.preventDefault();
		}
    });
    $('#add_builderuser_back').click(function(e) {
        $("#save_type").val('save_and_back');
        var first_name 		= $('#first_name').val();		
		var primary_email 	= $('#primary_email').val();		
		var role_id 		= $('#role_id').val();		
		var date_format 	= $('#date_format').val();		
		var time_zone 		= $('#time_zone').val();
		var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;			
		if(first_name == '' || primary_email == '' || role_id == '' || date_format == '' || time_zone == '' || valid == false){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{			
			add_builderuser_form();
			e.preventDefault();
		}
    });
    $('#btncancel').click(function(e) {
        var encoded_home_string = Base64.encode('user/builder_users/');
        var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
        window.location.href = encoded_home_val; 
        e.preventDefault();      
    }); 
});
function add_builderuser_form(){
    // Encode the String
    var encoded_string = Base64.encode('user/save_builderuser/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('user/builder_users/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    var signature_text = CKEDITOR.instances['editor1'].getData();

    var ub_user_id = $('#ub_user_id').val();
    var role_id = $('#role_id').val();
    var accessmethod = $('#accessmethod').val();
	//var formData = new FormData($('#add_new_builderuser')[0]);
	var fd = new FormData();
    var file_data = $('input[type="file"]')[0].files; // for multiple files
    for(var i = 0;i<file_data.length;i++){
        fd.append("file_"+i, file_data[i]);
    }
    var other_data = $('#add_new_builderuser').serializeArray();
    $.each(other_data,function(key,input){
        fd.append(input.name,input.value);
    }); 
	fd.append('signature_text',signature_text);

    var accessmethod = $('#accessmethod').val();
    if(accessmethod === 'configure')
    {
        var password_length = $('#password').val().length;
        if($('#user_name').val() == '')
        {
            error_box();           
            $('.error-message .alerts').text('Username cannot be Empty');
            return false;
        }
        else if($('#password').val() == '')
        {
            error_box();           
            $('.error-message .alerts').text('Password cannot be Empty');
            return false;
        }
        else if(password_length < 5)
        {
            //alert('Password must be greater than five character');
            error_box();           
            $('.error-message .alerts').text('Password must be greater than five character');
            return false;
        }
    }
    $.ajax({
    // data: ajaxData+ '&signature_text=' + signature_text,
	url: base_url + encoded_val,
	dataType: 'json',
	data: fd,
	contentType: false,
	processData: false,
	type: 'POST',
	beforeSend: function() {
        $('.uni_wrapper').addClass('loadingDiv');			  
    },
    success: function(response) {   
        $('.uni_wrapper').removeClass('loadingDiv');        
        if(response.status == true)
        {   	
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
                    var encoded_string_edit_builderuser = Base64.encode( 'user/save_builderuser/' + response.insert_id);
                    var encoded_edit_val = encoded_string_edit_builderuser.strtr(encode_chars_obj);
                    window.location.href = encoded_edit_val;
            }
            else if($("#save_type").val() == 'save_and_stay_and_sent_mail')
            { 
                    var encoded_string_edit_builderuser = Base64.encode( 'user/save_builderuser/' + response.insert_id);
                    var encoded_edit_val = encoded_string_edit_builderuser.strtr(encode_chars_obj);
                    window.location.href = encoded_edit_val;
            }            
            if(response.message)
            {
                success_msg = response.message;
            }
			success_box();            
			$('.error-message .alerts').text(success_msg);
        }
        else
        {     
			if(response.error == 'size')
			{
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text(response.message);
			}  
            if(response.message)
            {
                failure_msg = response.message;
            }               
			error_box();
			$('.error-message .alerts').text(failure_msg);
        }
        return false;
      }
   }); 
}
/*
Delete user
*/
function delete_user(user_ids_obj){
    if(user_ids_obj > 0)
    {   
    var encoded_delete_roles = Base64.encode('user/delete_builderuser/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('user/builder_users/');
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
				data: {'ub_user_id':{ub_user_id:user_ids_obj}},
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

function save_builder_user_form(){	
		var builderuserform = $('#add_new_builderuser').find('[name="role_id"], [name="date_format"], [name="time_zone"]').selectpicker().change(function(e){            
                $('#add_new_builderuser').formValidation('revalidateField', 'role_id, date_format, time_zone ');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_builderuser, #add_builderuser_new, #add_builderuser_back, #builderuseremailinvitation'			
        },
        fields: {
            'first_name': {
                validators: {
                    notEmpty: {
                        message: 'The first name is required cannot be empty'
                    }
                }
            },
			'primary_email': {
                validators: {
					notEmpty: {
                        message: 'The email is required cannot be empty'
                    },
                     emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            },
			'role_id': {
                validators: {
                    notEmpty: {
                        message: 'Please select the User role'
                    }
                }
            },
			'date_format': {
                validators: {
                    notEmpty: {
                        message: 'Please select the date format'
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
			'mobile_phone': {
                    validators: {
						notEmpty: {
							message: 'The cell Number cannot be empty'
						},
                        phone: {
                            country: 'countrySelectBox',
                            message: 'The value is not valid %s Cell number'
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
				add_builderuser_form();				
			 }
			else if($("#save_type").val() == 'save_and_new'){
				add_builderuser_form();				
			}	
			else if($("#save_type").val() == 'save_and_back'){
				add_builderuser_form();				
			}
			e.preventDefault();			 
	  }).on('change', '[name="countrySelectBox"]', function(e) {
            $('#add_new_builderuser').formValidation('revalidateField', 'mobile_phone');
        });		
}


function delete_pic(file_id)
{
    var fileid = file_id;
    var encoded_string = Base64.encode('user/delete_file/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: 'fileid='+fileid,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');       
        },		
        success: function(response) 
		{  
			$('#uploader').val('');
			$('.uni_wrapper').removeClass('loadingDiv'); 
				setTimeout(function(){  
					location.reload();
				}, 300);
        }
    });
}
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
    //$('#login-enabled').on('ifChecked', function(event){            
        $("#accessmethod").prop("disabled", false);
        $(".disabled_prop").prop("disabled", false);        
        $(".disabled_input").prop("disabled", false);               
        $('.access-log').show();
        var accessmethod = $('#accessmethod').val();
        if(accessmethod === 'configure')
        {
         $('.' + accessmethod).show();
        }
        
    });
    $(document).on('ifUnchecked','#login-enabled', function(event){ 
    //$("#login-enabled").on('ifUnchecked', function(event){      
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
$(document).on('ifChecked','#email_check', function(event){
//$('#email_check').on('ifChecked', function(event){	
	$('.mail_chk').closest('.icheckbox_square-red').addClass('checked');		
	$('.mail_chk').attr("checked", "checked");	
});
$(document).on('ifUnchecked','#email_check', function(event){
//$('#email_check').on('ifUnchecked', function(event){	
	$('.mail_chk').closest('.icheckbox_square-red').removeClass('checked');		
	$('.mail_chk').removeAttr("checked", "checked");	
});
$(document).on('ifChecked','#text_check', function(event){
//$('#text_check').on('ifChecked', function(event){	
	$('.txt_chk').closest('.icheckbox_square-red').addClass('checked');		
	$('.txt_chk').attr("checked", "checked");	
});
$(document).on('ifUnchecked','#text_check', function(event){
//$('#text_check').on('ifUnchecked', function(event){	
	$('.txt_chk').closest('.icheckbox_square-red').removeClass('checked');		
	$('.txt_chk').removeAttr("checked", "checked");	
});