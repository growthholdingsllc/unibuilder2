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
		var daterange = typeof $('#daterange').val() !== 'undefined' ? $('#daterange').val() : '';
		var priority = typeof $('#priority').val() !== 'undefined' ? $('#priority').val() : '';
		var status = typeof $('#status').val() !== 'undefined' ? $('#status').val() : '';
		var related_to_me = typeof $('#related_to_me').val() !== 'undefined' ? $('#related_to_me').val() : '';
		var assigned_to = typeof $('#assigned_to').val() !== 'undefined' ? $('#assigned_to').val() : '';
		var tags = typeof $('#tags').val() !== 'undefined' ? $('#tags').val() : '';
		var datatable_grid_id = $('#datatable_grid_id').val();
	
		
		// Ajax URL
		var encoded_url = Base64.encode('template/task/get_task/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		// Data table Object	
		var dbobject = {
							'tableName': $('#Task_List'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_template_task_id',
							'name':'title',
							'post_data':'{"fetch_type":"'+fetch_type+'","priority":"'+priority+'","daterange":"'+daterange+'","status":"'+status+'","related_to_me":"'+related_to_me+'","tags":"'+tags+'","assigned_to":"'+assigned_to+'","datatable_grid_id":"'+datatable_grid_id+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'template/task/save_task/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_task_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "title"},{"data": "priority"},{"data": "due_date"},{"data": "creator"},{"data": "tags"}],
							'default_order_by': [[3, 'desc']]
						};
		// Populate data table
		ubdatatable(dbobject);
	}
});

// Task search
$('#task_search_reset').on('click', function(e) {	
	reset_function();
	e.preventDefault();
});

function reset_function(){
	var encoded_destroy_session = Base64.encode('task/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var task_index = Base64.encode('template/task/index/');
	var task_index_url = task_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"TEMP_TASK","destroy_type":["SEARCH"]},			
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');
        },
		success: function(response) {		
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = task_index_url;				
				success_box();
				$('.error-message .alerts').text('reset successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('reset failed');	
			}
		}
	});	
}

//Multi delete

function delete_checked_tasks(ub_task_id){
	var encoded_delete_roles = Base64.encode('template/task/delete_tasks/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('template/task/index/');
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