$(function() {	
	//$("#save_filter_buttons").hide();
	if (typeof list_page != 'undefined') {
		punch_list();
	}
	$('#update_result').click(function(e){
		punch_list();
		$('.error-message').hide();		
		e.preventDefault();				
	});

	function punch_list(calltype) {
		var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
		var priority = typeof $('#priority').val() !== 'undefined' ? $('#priority').val() : '';
		var status = typeof $('#status').val() !== 'undefined' ? $('#status').val() : '';
		var tags = typeof $('#tags').val() !== 'undefined' ? $('#tags').val() : '';

		// Ajax URL
		var encoded_url = Base64.encode('punchlist/get_punchlists/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object	
		var dbobject = {
							'tableName': $('#Punch_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_punch_list_id',
							'name':'title',
							'post_data':'{"fetch_type":"'+fetch_type+'","priority":"'+priority+'","status":"'+status+'","tags":"'+tags+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'punchlist/save_punchlist/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_punch_list_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "title"},{"data": "priority"},{"data": "creator"},{"data": "tags"},{"data": "status"}],
							'default_order_by': [[2, 'desc']]
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
	var encoded_destroy_session = Base64.encode('punchlist/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var task_index = Base64.encode('punchlist/index/');
	var task_index_url = task_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"PUNCHLIST","destroy_type":["SEARCH"]},			
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
				$('.error-message .alerts').text('Reset Failed');	
			}
		}
	});	
}

// Task search
$('#save_filter').on('click', function(e) {	
		var priority = $('#priority').val();
		var status = $('#status').val();
		// var related_to_me = $('#related_to_me').val();
		// var assigned_to = $('#assigned_to').val();
		var tags = $('#tags').val();
		// var fromandto = $('#daterange').val();

		
		if((!status) && (!priority) && (!tags)){		
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
	var encoded_url = Base64.encode('punchlist/apply_saved_search/');
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
				$('.error-message .alerts').text('Save Filter Failed');				
			}
		}
	});	
}
//Apply Filter
$('#apply_save_filter').on('click',function() {
		var encoded_url = Base64.encode('punchlist/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('punchlist/index/');
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
					$('.error-message .alerts').text('Applied Filter Successfully');
				}
				else{
					error_box();				
					$('.error-message .alerts').text('Apply Filter Failed');	
				}
			}
		});			
});	

function delete_checked_punchlists(ub_punch_list_id){
	var encoded_delete_roles = Base64.encode('punchlist/delete_punchlist/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('punchlist/index/');
	var index_url = index_string.strtr(encode_chars_obj);
	//alert(ub_punch_list_id);return false;
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:ub_punch_list_id,
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

function delete_all_checked_punchlists(val)
{
	if(val == 'delete_multi_tasks')
	{
		ub_punch_list_id = punchlist_checked_list();
		//alert(role_ids_obj);
		if(ub_punch_list_id != false){
			var conf = $('#confirmModal').modal('show');
			$('#delete_confirm').click(function(){
				var conf = true;
				if(conf == true){
					$('#confirmModal').modal('hide');
					delete_checked_punchlists({ub_punch_list_id:ub_punch_list_id})
				}
			});
		}
	}
	else
	{
		return false;
	}
}

function punchlist_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	//alert(delete_obj.toSource());
	if($.isEmptyObject(delete_obj)){		
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please Select Punch List');
		return false;
	}
	else{
		return delete_obj;
	}
}
