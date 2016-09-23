$(function() {
	if (typeof list_page != 'undefined') {
		internal_users_list();
	}
	$('#update_result').click(function(e){	
		e.preventDefault();
		internal_users_list();	
	});
	$('#add_internal_user').click(function() {				
		add_formval();
	});
	$('#add_internal_user_new').click(function() {
		$("#save_type").val('save_and_new');
		add_formval();		
	});
	$('#add_internal_user_back').click(function() {
		$("#save_type").val('save_and_back');
		add_formval();		
	});	
	
	//contractor functions
	$('#Vendors').click(function(e){	
		sub_vendors_list();
	});
	$('#vendors').click(function(e){	
		sub_vendors_list();
	});
	$('#update_contractor_result').click(function(e){	
		e.preventDefault();
		sub_vendors_list();
	});
	
	function sub_vendors_list() {
	
		var division = $('#subcontractor_department').val();
		var user_status = $('#user_status').val();
		
		// Ajax URL
		var encoded_url = Base64.encode('user/get_sub_vendors/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		var dbobject = {
							'tableName': $('#Sub_Vendors'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_subcontractor_id',
							'name' : 'company',
							'post_data':'{"division":"'+division+'","user_status":"'+user_status+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'user/edit_sub_vendors/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_subcontractor_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "company"},{"data": "division"},{"data": "mobile_phone"},{"data": "desk_phone"},{"data": "primary_email"}],
							'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#Sub_Vendors').on( 'click', 'a.editor_remove', function (e) {
		  var user_id = $(this).attr('id');
		  delete_role({'ub_user_id':{user_id:user_id}});
	});
	}
	function internal_users_list() {
		var first_name = $('#first_name').val();
		//var role_status = $('#role_active').val();
		// return false;
		// Ajax URL
		var encoded_url = Base64.encode('user/get_internal_user/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		var dbobject = {
							'tableName': $('#Internal_Users'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_user_id',
							'name' : 'first_name',
							'post_data':'{"first_name":"'+first_name+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'user/edit_internal_user/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_user_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "first_name"},{"data": "mobile_phone"},{"data": "primary_email"},{"data": "user_status"}],
							'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#Internal_Users').on( 'click', 'a.editor_remove', function (e) {
		  var user_id = $(this).attr('id');
		  delete_role({'ub_user_id':{user_id:user_id}});
	});
	}
});
$('#editrole').on('click', function() {
	$("#save_type").val('save_and_stay');
	Edit_formval();
});
$('#editrole-back').on('click', function() {	
	$("#save_type").val('save_and_back');
	Edit_formval();
});
function add_formval(){
	var add_new_user = $('#add_new_user').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'user_name': {
                validators: {
                    notEmpty: {
                        message: 'The User name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 128,
                        message: 'The name must be more than 2 and less than 128 characters long'
                    }
                }
            }
        }		/* added closing brace */
		
    }).on('success.form.fv', function(e) {			 
		add_internal_user_form();			
		e.preventDefault();	
	});
}

function add_internal_user_form() {
	// Encode the String
	var encoded_string = Base64.encode('users/new_user/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('users/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	
	var ajaxData  = $("#add_new_user").serialize();	
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,			
		success: function(response) {			
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
				$(".error-message .alert").removeClass('alert-danger');
				$(".error-message .alert").addClass('alert-success');
				$(".error-message").show();
				if(response.message)
				{
					success_msg = response.message;								
				}
				$(".alert").html(success_msg);
			}
			else
			{	
				$(".error-message .alert").removeClass('alert-success');
				$(".error-message .alert").addClass('alert-danger');		
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


// save filter(user search)
$('#save_filter').on('click', function() {
	var first_name = $('#first_name').val();
	var encoded_url = Base64.encode('user/get_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'first_name='+first_name;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,			
		success: function(response) {		
			if(response.status == true)
			{	
				
			}
		}
	});	
});


// user search reset
$('#user_search_reset').on('click', function() {
	var encoded_destroy_session = Base64.encode('user/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var user_index = Base64.encode('user/index/');
	var user_index_url = user_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"USERS","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = user_index_url;
			}
		}
	});	
});

//Apply Filter
$('#apply_save_filter').on('click',function() {
		var encoded_url = Base64.encode('user/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('user/index/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",		
		success: function(response) {		
			if(response.status == true)
			{	
				 window.location.href= base_url + ajax_encoded_urls;
			}
		}
	});	
		});
		
// contractor search (save filter)
$('#save_contractor_filter').on('click', function() {
	var division = $('#division').val();
	var status = $('#status').val();
	var encoded_url = Base64.encode('user/get_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'division='+division+'&status='+status;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,			
		success: function(response) {		
			if(response.status == true)
			{	
				
			}
		}
	});	
});


// contractor search reset (save filter reset)
$('#contractor_search_reset').on('click', function() {
	var encoded_destroy_session = Base64.encode('user/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var user_index = Base64.encode('user/index/');
	var user_index_url = user_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"USERS","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = user_index_url;
			}
		}
	});	
});

