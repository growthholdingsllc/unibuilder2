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

if (typeof list_page != 'undefined') 
{
	get_template_bidpackage();

}
});
// Category_Locations Data table child node on click 


//Update result
$('#update_result').click(function(e){			 
	get_template_bidpackage();
	$('.error-message').hide();
	e.preventDefault();
});
//Data table code for Location tab in selection landing page


// Reset 
$('#bids_search_reset').on('click', function(e) {	
	reset_function();
	e.preventDefault();
		
});
function reset_function(){
	var encoded_destroy_session = Base64.encode('template/bids/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	var role_index = Base64.encode('template/bids/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"TEMP_BIDS","destroy_type":["SEARCH"]},			
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
		success: function(response) {		
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url;
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
 



//project left collapse
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

$('#import_template').on('click',function(){
	var encoded_url = Base64.encode('bids/import_bids/');
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

function get_template_bidpackage(){
// alert(get_bidpackage);
	var daterange = $('#daterange').val();
	var encoded_url = Base64.encode('template/bids/get_bids/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
		'tableName': $('#Template_Bids_List'),
		'ajax_encoded_url':ajax_encoded_url,
		'id':'ub_template_bid_id',
		'name' : 'package_title',
		'edit_data':{'index':0, 'url':'template/bids/save_bid/'},
		'delete_data':{},
		'post_data':'{"daterange":"'+daterange+'"}',
		'display_columns' : [{"data": "package_title"},{"data": "due_date_time"},{"data": "status"}],
		// 'default_order_by': [[1,'asc']]
	};
	// Populate data table
	ubdatatable(dbobject);
}