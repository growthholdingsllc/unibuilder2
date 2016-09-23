$(function() {
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
	
update_result_form();
if (typeof list_page != 'undefined') {
bidsrequest_list();
  
}
//Update result
$('#update_result').click(function(e){	
	$("#bids_index").val('update_result');		 
		/* var mandatory = $('#bid_package_status').val();		
		if(mandatory == ''){			
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
			$('.error-message .alerts').text('Updated Filter Successfully'); */
			bidsrequest_list();
			e.preventDefault();
		// }	
});
//Data table code
function bidsrequest_list() {
		
         var bid_package_status = $('#bid_package_status').val();
		var bid_status = $('#bid_status').val();
		var daterange = $('#daterange').val();
      var encoded_url = Base64.encode('bids/get_bid_requests/');
	  var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {					
							'tableName': $('#Bidsrequest_List'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_bid_request_id',
							'name' : 'package_title',
							'this_table' : {'table_name':'Bidsrequest_List'},
							'post_data':'{}',
							'delete_data':'{}', 
							'edit_data':{'index':0, 'url':'bids/submit_bids_request/'},
							'post_data':'{"bid_package_status":"'+bid_package_status+'", "bid_status":"'+bid_status+'","daterange":"'+daterange+'"}',
							'display_columns' : [{"data": "package_title"},{"data": "released_date"},{"data": "due_time"},{"data":"will_bid", "bSortable": false},{"data":"project_name"},{"data":"bid_amount", "bSortable": false},{"data":"bid_sub_status", "bSortable": false}],
							// 'default_order_by': [[1, 'desc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		 
	}

});


//mom search reset
$('#bidrequest_search_reset').on('click', function(e) {
	$("#bids_index").val('bidrequest_search_reset');					 
	reset_function();			
	e.preventDefault();
		
});	
function reset_function(){
	var encoded_destroy_session = Base64.encode('bids/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var projects_index = Base64.encode('bids/bid_request_list/');
	var projects_index_url = projects_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BIDREQUEST","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = projects_index_url;
				success_box();
				$('.error-message .alerts').text('Reset Successfully');	
			}
			else
			{
				error_box();
				$('.error-message .alerts').text('Reset failed');	
			}
		}
	});
}

$('#save_filter').on('click', function(e) {
	$("#bids_index").val('save_filter');
	var daterange = $('#daterange').val();
	var bid_package_status = $('#bid_package_status').val();
	var bid_status = $('#bid_status').val();
	
	if((!daterange) && (!bid_package_status) && (!bid_status)){			
		error_box();
		$('.error-message .alerts').text('Please select one mandatory field');
		return false;
	}
	else
	{	
		save_filter_function();			
		e.preventDefault();
	}	
		/* var mandatory = $('#bid_package_status').val();		
		if(mandatory == ''){			
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
			$('.error-message .alerts').text('Saved Successfully');
			save_filter_function();
			e.preventDefault();
		}	 */
});
// Save Filter
function save_filter_function(){
	var bid_package_status = $('#bid_package_status').val();
	var bid_status = $('#bid_status').val();
	var daterange = $('#daterange').val();
	var encoded_url = Base64.encode('bids/bidrequest_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var data = 'bid_package_status='+bid_package_status+'&bid_status='+bid_status+'&daterange='+daterange;
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
$('#apply_save_filter').on('click',function(e) {
		var encoded_url = Base64.encode('bids/bidrequest_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('bids/bid_request_list/');
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
			else
			{
				error_box();
				$('.error-message .alerts').text('Applied filter failed');	
			}
		}
	});	
		//$.post(baseurl+ajax_encoded_url,'POST',function(res) {
			
});


function update_result_form(){	
	var updateresultform = $('#Search_Result').find('[name="bid_package_status[]"]').selectpicker().change(function(e) {            
                $('#Search_Result').formValidation('revalidateField', 'bid_package_status[]');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #bids_search_reset, #save_filter'			
        },
        fields: {
            'bid_package_status[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select the package status'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#bids_index").val() == 'update_result'){
				bidsrequest_list();				
			 }
			else if($("#bids_index").val() == 'bids_search_reset'){
				reset_function();				
			}	
			else if($("#bids_index").val() == 'save_filter'){
				save_filter_function();				
			}
			e.preventDefault();			 
	  });		
}
