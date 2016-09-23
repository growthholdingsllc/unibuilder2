$(function() {
	if (typeof list_page != 'undefined') {
		role_list();
	}
	$('#update_result').click(function(e){	
		e.preventDefault();
		role_list();
	});
	$('#add_role').click(function() {				
		add_formval();
	});
	$('#add_role_new').click(function() {
		$("#save_type").val('save_and_new');
		add_formval();		
	});
	$('#add_role_back').click(function() {
		$("#save_type").val('save_and_back');
		add_formval();		
	});	
	// Function to built the data table and AJAX list  
	function role_list() {
		var role_name = $('#role_name').val();
		var role_status = $('#role_active').val();
		// return false;
		// Ajax URL
		var encoded_url = Base64.encode('roles/get_roles/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object	
		var dbobject = {
							'tableName': $('#Roles_List'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_role_id',
							'name' : 'role_name',
							'post_data':'{"role_name":"'+role_name+'","role_active":"'+role_status+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'roles/edit_role/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_role_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "role_name"},{"data": "role_active"},{"data": "created_on"},{"data": "modified_on"}/*,{"className": 'edit',"orderable": false,"data": null,"defaultContent": ''}*/],
							'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#Roles_List').on( 'click', 'a.editor_remove', function (e) {
		  var role_id = $(this).attr('id');
		  delete_role({'ub_role_id':{role_id:role_id}});
		});
	}
});
$('#editrole').on('click', function() {
	$("#save_type").val('save_and_stay');
	Edit_formval();
});
$('#role_search_reset').on('click', function() {
	var encoded_destroy_session = Base64.encode('roles/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('roles/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"ROLES","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = role_index_url;
			}
		}
	});	
});
$('#editrole-back').on('click', function() {	
	$("#save_type").val('save_and_back');
	Edit_formval();
});
function delete_role(role_ids_obj){
	var encoded_delete_roles = Base64.encode('roles/delete_roles/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('roles/index/');
	var index_url = index_string.strtr(encode_chars_obj);
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:role_ids_obj,
			success: function(response) {	
				if(response.status == true)
				{	
					if(response.message)
					{
						success_msg = response.message;
						window.location.href = index_url;							
					}
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
function SearchForm() {
	// Encode the String
	var encoded_string = Base64.encode('roles/get_roles/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('roles/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	
	var ajaxData  = $("#Search_Result").serialize();	
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
					$('#Roles_List').dataTable({
						destroy: true,
						"fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {              			
						$('td:eq(5)', nRow).html('<a href="'+base_url+'cm9sZXMvZWRpdF9yb2xlLw--">'+'<span class="glyphicon glyphicon-pencil"></span>'+'</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);">'+'<span class="glyphicon glyphicon-trash"></span>'+'</a>');	$('td:eq(0)', nRow).html('<input type="checkbox" value="'+ data.ub_role_id +'" class="chk" />');						 					
						return nRow;				
						},
						"columns": [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_role_id', "defaultContent": '<input type="checkbox" class="chk"/>'},{"data": "role_name"},{"data": "role_active"},{"data": "created_on"},{"data": "modified_on"},{"className": 'edit',"orderable": false,"data": null,"defaultContent": ''}],						
						aaData: response.data					
					});								
				}
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
function delete_all(val)
{
	if(val == 'delete_roles')
	{
		role_ids_obj = roles_checked_list();
		delete_role({ub_role_id:role_ids_obj})
	}
	else
	{
		alert('Please select roles');
		return false;
	}
}

function roles_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	//alert(delete_obj.toSource());
	if($.isEmptyObject(delete_obj)){
		alert('Please select roles');
		return false;
	}
	else{
		return delete_obj;
	}
}
function add_formval(){
	var add_new_role = $('#add_new_role').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'role_name': {
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
		add_role_form();			
		e.preventDefault();	
	});
}
function add_role_form() {
	// Encode the String
	var encoded_string = Base64.encode('roles/new_role/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('roles/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	
	var ajaxData  = $("#add_new_role").serialize();	
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
function Edit_formval(){
	var edit_role = $('#edit_role').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'role_name': {
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
e.preventDefault();	
   var $form        = $(e.target),
	validator    = $form.data('formValidation'),
	submitButton = validator.getSubmitButton();	
		edit_role_form();		
		// Prevent form submission
				
	});
}
function edit_role_form() {
	// Encode the String
	var encoded_string = Base64.encode('roles/edit_role/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('roles/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	
	var ajaxData  = $("#edit_role").serialize();	
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,			
		success: function(response) {					
			if(response.status == true)
			{	
				if($("#save_type").val() == 'save_and_back')
				{
					window.location.href = encoded_home_val;
				}
				
				if(response.message)
				{
					success_msg = response.message;								
				}
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
/* Data Tables Checkbox Sorting */
$(function() {	
	$('#Roles_List_length select').addClass('form-control input-sm select-filter');
		setTimeout(checkbox, 1 * 800);	
		setTimeout(checkedAll, 1 * 500);		
		setTimeout(allcheck, 1 * 500);	
	$(document).on('click','.sorting_asc, .sorting_desc', function(){
		setTimeout(checkbox, 1 * 800);	
		setTimeout(checkedAll, 1 * 500);		
		setTimeout(allcheck, 1 * 500);				
	});
		
	$(document).on('click', '.pagination li a, .details-control', function() {        		
		setTimeout(checkbox, 1 * 500);	
		setTimeout(allcheck, 1 * 500);		
		setTimeout(checkedAll, 1 * 500);
		});
	$(".select-filter").change(function () {  
		setTimeout(checkbox, 1 * 500);			
		setTimeout(checkedAll, 1 * 500);	
		setTimeout(allcheck, 1 * 500);			
    });
});
function checkbox() {
    $('input[type=checkbox]').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event) {}).iCheck({
        checkboxClass: 'icheckbox_square-red',
        radioClass: 'iradio_square-red',
        increaseArea: '20%'
    });
	 $('input[type=radio]').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event) {}).iCheck({   radioClass: 'iradio_square-red',
        increaseArea: '20%'
    });
}
function checkedAll(){
	$(document).on('ifChecked','#selectall', function(event){
		$('.da-tab-checkbox input').attr('checked', this.checked);		
	});	
	$(document).on('ifChecked','.da-tab-checkbox input', function(event){
		$(this).closest('.icheckbox_square-red').addClass('checked');		
		$(this).attr("checked", "checked");	
	});	
	
	$(document).on('ifUnchecked','#selectall', function(event){			
		$('.da-tab-checkbox input').removeAttr('checked');			
	});
	$(document).on('ifUnchecked','.da-tab-checkbox input', function(event){
		$(this).closest('.icheckbox_square-red').removeClass('checked');		
		$(this).removeAttr("checked", "checked");
	});
}
function allcheck(){	
		$(document).on('ifChecked','#selectall', function(event){			
			$('.da-tab-checkbox .icheckbox_square-red').addClass('checked');
			$('.da-tab-checkbox input').attr('checked', this.checked);		
		});
		$(document).on('ifUnchecked','#selectall', function(event){	
			$('.da-tab-checkbox .icheckbox_square-red').removeClass('checked');		
			$('.da-tab-checkbox input').removeAttr('checked');			
		});
		if ($('input[name="selectall"]').is(':checked') ) {			
			$('.da-tab-checkbox .icheckbox_square-red').addClass('checked');
			$("#selectall .da-tab-checkbox input").attr("checked", "checked");				
		} 
		else {
			$('.da-tab-checkbox .icheckbox_square-red').removeClass('checked');
			$("#selectall .da-tab-checkbox input").removeAttr("checked");			
		}
}
/* /Data Tables Checkbox Sorting */