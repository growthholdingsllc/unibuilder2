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
  });
  $('.cancelBtn').click(function(){
	   $('#daterange').val('');
  });
});
$(function() {
	if (typeof list_page != 'undefined') {
		mom_list();
	}
	$('#update_result').click(function(e){
		$("#project_mom").val('update_result');	
		mom_list();			
		e.preventDefault();	
	});
	
	// Export result set to file
	$('#export_file').on('click', function() {
		var form1 = $('#Search_Result'), 
		form2 = $('#Search_Result_export'); 
		$(form2).val(function(){
			return $(form1).val();
		});
		if(datatable_getrowcount('#meeting_list')>0){
			var encoded_url = Base64.encode('projects/get_mom/');
			var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			var submit_url = base_url + ajax_encoded_url;
			$(form2).attr('action', submit_url).submit();	
		}else{
			alert('Sorry! No records found for export');
		}
	});	
	//mom list
	function mom_list(calltype) {
	calltype = typeof calltype !== 'undefined' ? calltype : 'list';
		var fetch_type = calltype;
	    // alert(calltype);
	    // var project = $('#project').val();
		var daterange = $('#daterange').val();
		var meetingType = $('#meetingType').val();
		var tagType = $('#tagType').val();
		var status = $('#status').val();
	    var title = $('#title').val();
		/* var location = $('#location').val(); */
		var attendees = $('#attendees').val();
		  // alert(attendees);
		var conducted_by= $('#conducted_by').val(); 
           // alert(conducted_by);		
		// Ajax URL
		var encoded_url = Base64.encode('projects/get_mom/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object	
		var dbobject = {
							'tableName': $('#meeting_list'),
							'this_table' : {'table_name':'meeting_list'},
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_mom_id',
							'name':'title',
							'lengthe':'length',
							'length_val':{'index':2},
							'post_data':'{"fetch_type":"'+fetch_type+'","daterange":"'+daterange+'", "meetingType":"'+meetingType+'","tagType":"'+tagType+'","status":"'+status+'","attendees":"'+attendees+'","conducted_by":"'+conducted_by+'"}',
							'delete_data':{'index':0},  
							'edit_data':{'index':1, 'url':'projects/save_meeting/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_mom_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "title"},{"data": "agenda"},{"data": "mom_date"},{"data": "conducted_by"},{"data": "attendees"},{"data": "type"},{"data": "location"},{"data": "status"},{"data": "project_name"}],
							'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#meeting_list').on( 'click', 'a.editor_remove', function (e) {
		  var mom_id = $(this).attr('id');
		  delete_project({'ub_mom_id':{mom_id:mom_id}});
		});
	}
});


//mom search reset
$('#mom_search_reset').on('click', function(e) {
	$("#project_mom").val('mom_search_reset');					 
	reset_function();			
	e.preventDefault();
		
});	
function reset_function(){
	var encoded_destroy_session = Base64.encode('projects/mom_destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var projects_index = Base64.encode('projects/meeting/');
	var projects_index_url = projects_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"MOM","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = projects_index_url;
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
// Save Filter
$('#save_filter').on('click', function(e) {
		$("#project_mom").val('save_filter');	
		var daterange = $('#daterange').val();
		var tagType = $('#tagType').val();
		// var project = $('#project').val();
		var meetingType = $('#meetingType').val();
		// var location = $('#location').val();
		var attendees = $('#attendees').val();
		var conducted_by = $('#conducted_by').val();
		var status = $('#status').val();
		
		if((!daterange) && (!tagType) && (!meetingType) && (!attendees) && (conducted_by == 0) && (!status) ){			
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
	var daterange = $('#daterange').val();
	var tagType = $('#tagType').val();
	// var project = $('#project').val();
	var meetingType = $('#meetingType').val();
	// var location = $('#location').val();
	var attendees = $('#attendees').val();
	var conducted_by = $('#conducted_by').val();
	var status = $('#status').val();
	var encoded_url = Base64.encode('projects/apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'daterange='+daterange+'&tagType='+tagType+'&meetingType='+meetingType+'&attendees='+attendees+'&conducted_by='+conducted_by+'&status='+status;
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
			else
			{
				error_box();
				$('.error-message .alerts').text('save filter failed');	
			}
		}
	});
}
//Apply Filter
$('#apply_save_filter').on('click',function() {
		var encoded_url = Base64.encode('projects/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('projects/meeting/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",		
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href= base_url + ajax_encoded_urls;
				success_box();
				$('.error-message .alerts').text('Applied filter successfully');	
			}
			else
			{
				error_box();
				$('.error-message .alerts').text('Apply filter failed');	
			}
		}
	});	
		//$.post(baseurl+ajax_encoded_url,'POST',function(res) {
			
		});
//Multi delete

function Delete_checked_mom(ub_mom_id){
// alert("hi");
	var encoded_delete_roles = Base64.encode('projects/delete_meeting/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('projects/meeting/');
	var index_url = index_string.strtr(encode_chars_obj);
	//alert(ub_task_id);return false;
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:ub_mom_id,
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


function delete_all_checked_mom(val)
{
	if(val === 'delete_multi_mom')
	{
		ub_mom_id = mom_checked_list();
		if(false != ub_mom_id)
		{
			if(confirm("Are you sure, you want to delete the selected meeting(s)?"))
			{
				Delete_checked_mom({ub_mom_id:ub_mom_id});
			}
			else
			{
				return false;
			}
		}
		else
		{
			return ub_mom_id;
		}
	}
	else
	{
		return false;
	}
}

function mom_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	//alert(delete_obj.toSource());
	if($.isEmptyObject(delete_obj)){		
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please Select Minutes of Meeting');
		return false;
	}
	else{
		return delete_obj;
	}
}		

/* Project MOM Form Validation */
function update_result_form(){	
	var updateresultform = $('#Search_Result').find('[name="project_id"], [name="status"]').selectpicker().change(function(e) {            
                $('#Search_Result').formValidation('revalidateField', 'project_id , status');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #mom_search_reset, #save_filter'			
        },
        fields: {
            'project_id': {
                validators: {
                    notEmpty: {
                        message: 'Please select the project name'
                    }
                }
            },
			'status': {
                validators: {
                    notEmpty: {
                        message: 'Please select the status'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {
			 if($("#project_mom").val() == 'update_result'){
				mom_list();				
			 }
			 else if($("#project_mom").val() == 'mom_search_reset'){
				 reset_function();
			 }	
			else if($("#project_mom").val() == 'save_filter'){
				 save_filter_function();
			 }						 
			e.preventDefault();
	  });		
}
/* /Projects MOM Form Validation */


