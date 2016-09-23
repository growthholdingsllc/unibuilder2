$(function() {
	 //update_result_form();
	if (typeof list_page != 'undefined') {
		project_list();
		var mapped_projects = $('#last_searched_map').val();
		if(mapped_projects != 'unmapped')
		{
			$('#last_searched_map').val('mapped');
			initialize();
		}
	}
	$('#update_result').click(function(e){		
		project_list();							
		if(mapped_projects != 'unmapped')
		{
			$('#last_searched_map').val('mapped');
			initialize();
		}	
		$('.error-message').hide();
		e.preventDefault();
	});
	$('#add_project').click(function() {				
		add_formval();
	});
	$('#add_project_new').click(function() {
		$("#save_type").val('save_and_new');
		add_formval();		
	});
	$('#add_project_back').click(function() {
		$("#save_type").val('save_and_back');
		add_formval();		
	});	
	// Export result set to file
	$('#export_file').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#Projects_List')>0){
			var encoded_url = Base64.encode('projects/get_projects/');
			var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			var submit_url = base_url + ajax_encoded_url;
			$(form1).attr('action', submit_url).submit();	
		}else{
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
		}
	});	
		
	function project_list(calltype) {
		calltype = typeof calltype !== 'undefined' ? calltype : 'list';
		var fetch_type = calltype;
		var project_group = $('#project_group').val();
		var project_managers = $('#project_managers').val();
		var project_status = $('#project_status').val();
		var mapped_projects = $('#mapped_projects').val();
		var datatable_grid_id = $('#datatable_grid_id').val();
		$('#last_searched_map').val(mapped_projects);
		// return false;
		// Ajax URL
		var map_column_index = datatable_map_column_index;
		var contract_price_column_index = datatable_contract_price_column_index;
		var encoded_url = Base64.encode('projects/get_projects/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var display_column = datatable_column;
		// Data table Object
		var class_name_index = typeof display_column[0]['className'] == 'undefined' ? 'not_set' : 'set';	
		if(class_name_index=="not_set")
		{
			display_column.unshift({"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_project_id', "defaultContent": '<input type="checkbox" class="chk" />'});
		}	
		var dbobject = {
							'tableName': $('#Projects_List'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_project_id',
							'name' : 'project_name',
							'lat_long' : 'lat_long',
							'this_table' : {'table_name':'Projects_List'},
							'post_data':'{"mapped_projects":"'+mapped_projects+'","fetch_type":"'+fetch_type+'","project_group":"'+project_group+'","project_managers":"'+project_managers+'","project_status":"'+project_status+'","datatable_grid_id":"'+datatable_grid_id+'"}',
							'delete_data':{'index':0},  
							'edit_data':{'index':1, 'url':'projects/save_project/'},
							'map_data':{'index':map_column_index},
							'contract_price_data':{'index':contract_price_column_index},
							'display_columns' : display_column,
							 "column_defs": [{"targets":parseInt(map_column_index),"orderable": false}],
							// 'default_order_by': [[1, 'desc']]
						};
		//alert(dbobject.display_columns.toSource());
		
		// Populate data table
		ubdatatable(dbobject);
 		$('#Projects_List').on( 'click', 'a.editor_remove', function (e) {
		  var project_id = $(this).attr('id');
		  delete_project({'ub_project_id':{project_id:project_id}});
		}); 
	}
	
	
});

$('#project_search_reset').on('click', function(e) {	
	reset_function();			
	e.preventDefault();		
});
function reset_function(){
	var encoded_destroy_session = Base64.encode('projects/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	var project_index = Base64.encode('projects/index/');
	var project_index_url = project_index.strtr(encode_chars_obj);	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"PROJECTS","destroy_type":["SEARCH"]},
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');		
        },		
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');			
			if(response.status == true)
			{	
				window.location.href = project_index_url;				
				success_box();
				$('.error-message .alerts').text('Reset Successfully');
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Reset failed');
			}
		}
	});	
}
$('#editproject-back').on('click', function() {	
	$("#save_type").val('save_and_back');
	Edit_formval();
});

function delete_project(project_ids_obj){
	var encoded_delete_projects = Base64.encode('projects/delete_projects/');
	var encoded_delete_val = encoded_delete_projects.strtr(encode_chars_obj);
	var index_string = Base64.encode('projects/index/');
	var index_url = index_string.strtr(encode_chars_obj);
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:project_ids_obj,
			success: function(response) {	
				if(response.status == true)
				{	
					if(response.message)
					{
						success_msg = response.message;
						//project_list();
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
function delete_all(val)
{
	if(val === 'delete_projects')
	{
		project_ids_obj = projects_checked_list();
		if(false != project_ids_obj)
		{
			var conf = $('#confirmModal').modal('show');
			$('#delete_confirm').click(function(){
			var conf = true;
				if(conf == true){
					$('#confirmModal').modal('hide');
					delete_project({ub_project_id:project_ids_obj});
				}
			});			
		}
		else
		{
			return project_ids_obj;
		}
	}
	else
	{
		return false;
	}
}

function projects_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	if($.isEmptyObject(delete_obj)){		
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select project(s)');
		return false;
	}
	else{
		return delete_obj;
	}
}
function add_formval(){
	var add_new_project = $('#add_new_project').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'project_name': {
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
		add_project_form();			
		e.preventDefault();	
	});
}
function add_project_form() {
	// Encode the String
	var encoded_string = Base64.encode('projects/new_project/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('projects/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	
	var ajaxData  = $("#add_new_project").serialize();	
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
	var edit_project = $('#edit_project').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'project_name': {
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
	edit_project_form();		
	// Prevent form submission
				
	});
}
function edit_project_form() {
	// Encode the String
	var encoded_string = Base64.encode('projects/edit_project/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('projects/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	
	var ajaxData  = $("#edit_project").serialize();	
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
/* Select Checkbox */
/* Sathish Coding */
// Save search filter
$('#save_filter').on('click', function(e) {	
	var project_group = $('#project_group').val();
	var project_managers = $('#project_managers').val();
	var project_status = $('#project_status').val();
	var mapped_projects = $('#mapped_projects').val();
	if((!project_group) && (!project_managers) && (!project_status) && (!mapped_projects)){			
		error_box();
		$('.error-message .alerts').text('Please select one mandatory field');	
		return false;
	}
	else{		 		
		save_filter_function();			
		e.preventDefault();
	}
});
function save_filter_function(){
	var project_group = $('#project_group').val();
	var project_managers = $('#project_managers').val();
	var project_status = $('#project_status').val();
	var mapped_projects = $('#mapped_projects').val();
	var project_index = Base64.encode('projects/index/');
	var project_index_url = project_index.strtr(encode_chars_obj);	
	var encoded_url = Base64.encode('projects/save_or_apply_project_search_filter/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'project_group='+project_group+'&project_managers='+project_managers+'&project_status='+project_status+'&mapped_projects='+mapped_projects;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },
		success: function(response) {		
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{					
				//window.location.href = project_index_url;				
				success_box();
				$('.error-message .alerts').text('Saved filter Successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Save filter failed');	
			}
		}
	});	
}
// Apply Filter
$('#apply_filter').on('click',function() {
	var encoded_url = Base64.encode('projects/save_or_apply_project_search_filter/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var project_index = Base64.encode('projects/index/');
	var project_index_url = project_index.strtr(encode_chars_obj);

	$.ajax({
	url: base_url + ajax_encoded_url,
	dataType: "json",
	type: "post",
	beforeSend: function() {
        $('.uni_wrapper').addClass('loadingDiv');	  
    },
	success: function(response) {		
	    $('.uni_wrapper').removeClass('loadingDiv');
		if(response.status == true)
		{	
			window.location.href = project_index_url;			
			success_box();
			$('.error-message .alerts').text('Applied filter successfully');	
			
		}
		else{
			error_box();			
			$('.error-message .alerts').text('Applied filter failed');	
		}
	}
	});	
			
});


/* Project index Form Validation */
/* function update_result_form(){	
	var updateresultform = $('#Search_Result').find('[name="project_status"]').selectpicker().change(function(e) {            
                $('#Search_Result').formValidation('revalidateField', 'project_status');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #project_search_reset, #save_filter'			
        },
        fields: {
            'project_status': {
                validators: {
                    notEmpty: {
                        message: 'Please select the project status'
                    }
                }
            }
        }
		
    }).on('err.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
      }).on('success.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
      }).on('success.form.fv', function(e) {
			 if($("#project_index").val() == 'update_result'){
				project_list();				
			 }
			 else if($("#project_index").val() == 'project_search_reset'){
				 reset_function();
			 }	
			else if($("#project_index").val() == 'save_filter'){
				 save_filter_function();
			 }						 
			e.preventDefault();
	  });		
} */
/* /Projects index Form Validation */

