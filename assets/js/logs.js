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
		log_list();
	}
	 $('#update_result').on('click',function(e) {
		log_list();
		$('.error-message').hide();
		e.preventDefault();
	 });
	$('#add_new_tag').click(function() {				
		add_tag();
	});
	// Export result set to file
	$('#export_file').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#Logs_List') > 0){
            var encoded_url = Base64.encode('logs/get_logs/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $(form1).attr('action', submit_url).submit();
        }else{
            $('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
        }
	
	});	
	  function log_list(calltype) {
        var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';

		var daterange = typeof $('#daterange').val() !== 'undefined' ? $('#daterange').val() : '';	
		var tags = typeof $('#tags').val() !== 'undefined' ? $('#tags').val() : '';
		//var project = typeof $('#project').val() !== 'undefined' ? $('#project').val() : '';
		// var project = typeof $('#project').val() !== 'undefined' ? $('#project').val() : '';
		// return false;
		// Ajax URL
		var encoded_url = Base64.encode('logs/get_logs/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		
		var dbobject = {					
							'tableName': $('#Logs_List'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_daily_log_id',
							'name': "log_date",
							'viewable_by' : 'viewable_by',
							'privates' : 'private',
							'show_subs' : 'show_subs',
							'show_owner' : 'show_owner',
							'this_table' : {'table_name':'Logs_List'},
							'post_data':'{"fetch_type":"'+fetch_type+'","daterange":"'+daterange+'", "tags":"'+tags+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'logs/save_log/'},
							'privated':{'index':5},
							'sub':{'index':5},
							'owner':{'index':5},
							'lengthe':'length',
							'length_val':{'index':4},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_daily_log_id', "defaultContent": '<input type="checkbox" class="chk" />'},
							{"data": "log_date"},{"data": "full_name"},{"data": "project_name"},
							{"data": "log_notes", "bSortable": false},{"data": "viewable_by", "bSortable": false}
							],
							// 'default_order_by': [[1, 'desc']]
						};

		
		ubdatatable(dbobject);
		
	}
});


$('#log_search_reset').on('click', function(e) {
	reset_function();
	e.preventDefault();
		
});	

function reset_function(){
	var encoded_destroy_session = Base64.encode('logs/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('logs/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"LOGS","destroy_type":["SEARCH"]},
		beforeSend: function() {
             $('.uni_wrapper').addClass('loadingDiv');			  
        },		
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');			
			if(response.status == true)
			{	
				window.location.href = role_index_url;
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

function add_tag()
{
	var encoded_string = Base64.encode('logs/update_general_value/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('logs/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);

	var encoded_new_string = Base64.encode('logs/save_log/');
	var encoded_new_val = encoded_new_string.strtr(encode_chars_obj);

	var encoded_general_string = Base64.encode('logs/get_general_value/');
	var encoded_general_val = encoded_general_string.strtr(encode_chars_obj);		
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	
	var tag = $('#tags').val();

	$.ajax({
			type:'POST',
			url: base_url + encoded_val,
			dataType: 'json',
			data: {'tag':{tag:tag}},
			success: function(response) {	

				$('#TypeAddModal').hide();
				//window.location.href = encoded_new_val;
				display_tag();							
					
			}
		});
}
function display_tag()
{
	var encoded_general_string = Base64.encode('logs/get_general_value/');
	var encoded_general_val = encoded_general_string.strtr(encode_chars_obj);
	var tag = $('#tags').val();
	$.ajax({
			type:'POST',
			url: base_url + encoded_general_val,
			dataType: 'json',
			data: {'tag':{tag:tag}},
			success: function(data) {
				console.log(data.formatted_arrays.formatted_array);
				// $('#TypeAddModal').hide();
				//window.location.href = encoded_new_val;
				// display_log();							
					
			}
		});
}
// Save Filter
$('#save_filter').on('click', function(e) {
		var daterange = $('#daterange').val();
		var tags = $('#tags').val();
		//var project = $('#project').val();
		if((!daterange) && (!tags))
		{
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
	var encoded_url = Base64.encode('logs/apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var daterange = $('#daterange').val();
	var tags = $('#tags').val();
	//var project = $('#project').val();
	var data = 'daterange='+daterange+'&tags='+tags;
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
				//alert(response.message);
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
		var encoded_url = Base64.encode('logs/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('logs/index/');
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
		//$.post(baseurl+ajax_encoded_url,'POST',function(res) {
			
		});


function delete_checked_logs(ub_daily_log_id){
	var encoded_delete_roles = Base64.encode('logs/delete_log/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('logs/index/');
	var index_url = index_string.strtr(encode_chars_obj);
	//alert(ub_daily_log_id);return false;
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:ub_daily_log_id,
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


function delete_all_checked_logs(val)
{
	if(val == 'delete_multi_logs')
	{
		ub_daily_log_id = logs_checked_list();
		if(ub_daily_log_id != false)
		{
			var conf = $('#confirmModal').modal('show');
			$('#delete_confirm').click(function(){
				var conf = true;
				if(conf == true){
					$('#confirmModal').modal('hide');
					delete_checked_logs({ub_daily_log_id:ub_daily_log_id})
				}
			});
	    }
        else
	    {
	      return ub_daily_log_id;
	    }
	}
	else
	{
		return false;
	}
}

function logs_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	//alert(delete_obj.toSource());
	if($.isEmptyObject(delete_obj)){		
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select Logs');
		return false;
	}
	else{
		return delete_obj;
	}
}
/* function update_result_form(){	
	var updateresultform = $('#Search_Result').find('[name="project_id"]').selectpicker().change(function(e) {            
                $('#Search_Result').formValidation('revalidateField', 'project_id');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #log_search_reset, #save_filter'			
        },
        fields: {
            'project_id': {
                validators: {
                    notEmpty: {
                        message: 'Please select the project name'
                    }
                }
            }
        }	/* added closing brace */
		
    /*}).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#logs_index").val() == 'update_result'){
				log_list();				
			 }
			else if($("#logs_index").val() == 'log_search_reset'){
				reset_function();				
			}	
			else if($("#logs_index").val() == 'save_filter'){
				save_filter_function();				
			}
			e.preventDefault();			 
	  });		
} */