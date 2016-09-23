$(function() {
	 //update_result_form();
	$('.daterange').daterangepicker(null, function(start, end, label) {
		console.log(start.toISOString(), end.toISOString(), label);
	});

	 $('.applyBtn').click(function(){
	  var start = $('input[name="daterangepicker_start"]').val();
	  var end = $('input[name="daterangepicker_end"]').val();
	  var start_end = start + ' - ' + end;
	  $('#daterange').val(start_end);
	  $('#daterange').parent().parent().removeClass('has-error');
	  $('#daterange').parent().parent().find('.help-block').css('display','none');
  });
  $('.cancelBtn').click(function(){
	   $('#daterange').val('');
  });
});
$(function() {	
	//$("#save_filter_buttons").hide();
	if (typeof list_page != 'undefined') {
		task_list();
	}
	$('#update_result').click(function(e){
		task_list();
		$('.error-message').hide();		
		e.preventDefault();				
	});
	$('#add_task').click(function() {
		add_formval();
	});
	$('#add_task_new').click(function() {
		$("#save_type").val('save_and_new');
		add_formval();		
	});
	$('#add_task_back').click(function() {
		$("#save_type").val('save_and_back');
		add_formval();		
	});	
	
	function task_list(calltype) {
		var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
		// var fetch_type = calltype;
		// var priority = $('#priority').val();
		// var status = $('#status').val();
		// var related_to_me = $('#related_to_me').val();
		// var assigned_to = $('#assigned_to').val();
		// var tags = $('#tags').val();
		var daterange = typeof $('#daterange').val() !== 'undefined' ? $('#daterange').val() : '';
		var priority = typeof $('#priority').val() !== 'undefined' ? $('#priority').val() : '';
		var status = typeof $('#status').val() !== 'undefined' ? $('#status').val() : '';
		var related_to_me = typeof $('#related_to_me').val() !== 'undefined' ? $('#related_to_me').val() : '';
		var assigned_to = typeof $('#assigned_to').val() !== 'undefined' ? $('#assigned_to').val() : '';
		var tags = typeof $('#tags').val() !== 'undefined' ? $('#tags').val() : '';
		var datatable_grid_id = $('#datatable_grid_id').val();
		//var from = '';
		//var to = '';
		
		// Ajax URL
		var encoded_url = Base64.encode('task/get_task/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var display_column = datatable_column;
		// Data table Object
		var class_name_index = typeof display_column[0]['className'] == 'undefined' ? 'not_set' : 'set';	
		if(class_name_index=="not_set")
		{
			display_column.unshift({"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_task_id', "defaultContent": '<input type="checkbox" class="chk" />'});
		}	

		
		// Data table Object	
		/*var dbobject = {
							'tableName': $('#Task_List'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_task_id',
							'name':'title',
							'post_data':'{"fetch_type":"'+fetch_type+'","priority":"'+priority+'","daterange":"'+daterange+'","status":"'+status+'","related_to_me":"'+related_to_me+'","tags":"'+tags+'","assigned_to":"'+assigned_to+'","datatable_grid_id":"'+datatable_grid_id+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'task/save_task/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_task_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "title"},{"data": "priority"},{"data": "assignedto"},{"data": "due_date"},{"data": "creator"},{"data": "tags"}],
							'default_order_by': [[4, 'desc']]
						};*/
		var dbobject = {
			'tableName': $('#Task_List'),
			'this_table' : {'table_name':'Task_List'},
			'ajax_encoded_url':ajax_encoded_url,
			'id':'ub_task_id',
			'name':'title',
			'due_date_time':'due_date_time',
			'completed_date_time':'completed_date_time',
			// 'due_date':{'index':4}, 
			'performance_timing':{'index':datatable_performance_timing_index}, 
			'post_data':'{"fetch_type":"'+fetch_type+'","priority":"'+priority+'","daterange":"'+daterange+'","status":"'+status+'","related_to_me":"'+related_to_me+'","tags":"'+tags+'","assigned_to":"'+assigned_to+'","datatable_grid_id":"'+datatable_grid_id+'"}',
			'delete_data':{'index':0}, 
			'edit_data':{'index':1, 'url':'task/save_task/'},
			'display_columns' : display_column
			//'default_order_by': [[4, 'desc']]
		};				
						
						
		// Populate data table
		ubdatatable(dbobject);
		$('#Task_List').on( 'click', 'a.editor_remove', function (e) {
		  var task_id = $(this).attr('id');
		  delete_task({'ub_task_id':{task_id:task_id}});
		});
	}
});



//search form

function SearchForm() {
	// Encode the String
	var priority = $('#priority').val();
	var fromdate = $('#fromdate').val();
	var todate = $('#todate').val();
	var encoded_string = Base64.encode('task/get_task/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('task/index/');
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
					$('#Task_List').dataTable({
						destroy: true,
						"fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {              			
						$('td:eq(5)', nRow).html('<a href="'+base_url+'cm9sZXMvZWRpdF9yb2xlLw--">'+'<span class="glyphicon glyphicon-pencil"></span>'+'</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);">'+'<span class="glyphicon glyphicon-trash"></span>'+'</a>');	$('td:eq(0)', nRow).html('<input type="checkbox" value="'+ data.ub_role_id +'" class="chk" />');						 					
						return nRow;				
						},
						"columns": [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_role_id', "defaultContent": '<input type="checkbox" class="chk"/>'},{"data": "title"},{"data": "priority"},{"data": "first_name"},{"data": "due_date"},{"data": "fulname"},{"data": "tags"},{"className": 'edit',"orderable": false,"data": null,"defaultContent": ''}],						
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


// Task search
$('#task_search_reset').on('click', function(e) {	
	reset_function();
	e.preventDefault();
});

function reset_function(){
	var encoded_destroy_session = Base64.encode('task/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var task_index = Base64.encode('task/index/');
	var task_index_url = task_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"TASK","destroy_type":["SEARCH"]},			
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');
        },
		success: function(response) {		
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = task_index_url;				
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

// Task search
$('#save_filter').on('click', function(e) {	
		var priority = $('#priority').val();
		var status = $('#status').val();
		var related_to_me = $('#related_to_me').val();
		var assigned_to = $('#assigned_to').val();
		var tags = $('#tags').val();
		var fromandto = $('#daterange').val();

		
		if((!related_to_me) && (!assigned_to == 0) && (!status) && (!priority) && (!tags) && (!fromandto)){		
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
	var priority = $('#priority').val();
	var status = $('#status').val();
	var related_to_me = $('#related_to_me').val();
	var assigned_to = $('#assigned_to').val();
	var tags = $('#tags').val();
	var fromandto = $('#daterange').val();
	var encoded_url = Base64.encode('task/apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);	
	var data = 'priority='+priority+'&status='+status+'&related_to_me='+related_to_me+'&assigned_to='+assigned_to+'&tags='+tags+'&fromandto='+fromandto;	
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
				$("#apply_save_filter").show();				
				success_box();
				$('.error-message .alerts').text('Saved Successfully');
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Save filter failed');				
			}
		}
	});	
}
//Apply Filter
$('#apply_save_filter').on('click',function() {
		var encoded_url = Base64.encode('task/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('task/index/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
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
					 window.location.href= base_url + ajax_encoded_urls;
					success_box();
					$('.error-message .alerts').text('Applied filter successfully');
				}
				else{
					error_box();				
					$('.error-message .alerts').text('Apply filter failed');	
				}
			}
		});			
});
	
/* Select Checkbox */
/* Sathish Coding */
	// Export result set to file
	$('#export_file').on('click', function()
	{ 	
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#Task_List') >0 )
		{
			var encoded_url = Base64.encode('task/get_task/');
			var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			var submit_url = base_url + ajax_encoded_url;
			$(form1).attr('action', submit_url).submit();
		}
		else
		{			
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
		}
	});	

//Multi delete

function delete_checked_tasks(ub_task_id){
	var encoded_delete_roles = Base64.encode('task/delete_tasks/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('task/index/');
	var index_url = index_string.strtr(encode_chars_obj);
	//alert(ub_task_id);return false;
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:ub_task_id,
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

function delete_all_checked_tasks(val)
{
	if(val == 'delete_multi_tasks')
	{
		ub_task_id = task_checked_list();
		//alert(role_ids_obj);
		if(ub_task_id != false){
			var conf = $('#confirmModal').modal('show');
			$('#delete_confirm').click(function(){
				var conf = true;
				if(conf == true){
					$('#confirmModal').modal('hide');
					delete_checked_tasks({ub_task_id:ub_task_id})
				}
			});
		}
	}
	else
	{
		return false;
	}
}

function task_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	//alert(delete_obj.toSource());
	if($.isEmptyObject(delete_obj)){		
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select Tasks');
		return false;
	}
	else{
		return delete_obj;
	}
}

/* function update_result_form(){	
	var updateresultform = $('#Search_Result').find('[name="status"]').selectpicker().change(function(e) {            
                $('#Search_Result').formValidation('revalidateField', 'status');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #task_search_reset, #save_filter'			
        },
        fields: {
            'status': {
                validators: {
                    notEmpty: {
                        message: 'Please select the status'
                    }
                }
            }
        }	
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#task_index").val() == 'update_result'){
				task_list();				
			 }
			else if($("#task_index").val() == 'task_search_reset'){
				reset_function();				
			}	
			else if($("#task_index").val() == 'save_filter'){
				save_filter_function();				
			}
			e.preventDefault();			 
	  });		
} */

/* Import code */
 $('#import_button').on('click', function(){	
	if (project_id == '') 
	{			
			$('.side-menu').removeAttr('style');
			$('.side-menu').show();
			$('.arrow-left').css("margin-left") == "250px"
			$('.arrow-left > .glyphicon-chevron-right').hide();
			$('.arrow-left > .glyphicon-chevron-left').show();
			$('.side-menu').animate({"margin-left": '+=250'});
			$('.arrow-left').animate({"margin-left": '+=250'});
			$('.uni_child_wrapper').addClass('disablingDiv');	
			$('.create_project_con').show();					
			$('.arrow-left').addClass('pointer_none');							
	}
	
});

$('#import_template').on('click',function(e){
	
	var encoded_url = Base64.encode('task/import_task/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var ajaxData  = $("#import_from_template").serialize();
	//alert(ajaxData);
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: ajaxData,
		beforeSend: function() {
					$('.uni_wrapper').addClass('loadingDiv');
		},	
		success: function(response) {		
			if(response.status == true)
			{	
				$('.uni_wrapper').removeClass('loadingDiv');
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Imported Successfully');
			}
			else
			{
				$('.uni_wrapper').removeClass('loadingDiv');
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('No Template Found. Please create a template.');
			}
		}
	});
});