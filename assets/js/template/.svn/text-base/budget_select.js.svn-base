$(function() { 
budget_jobs_list_view();    
var budget_url = window.location.href;
	var budget_hash = budget_url.substring(budget_url.indexOf("#"));
		
		if (budget_hash == "#jobs")
		{
			$('#current_tab').val("jobs");
			$('.new_estimate').addClass('show');
			$('.filter_none').addClass('hide');
			$('.new_payapp').addClass('hide');
			$('.pay-app').addClass('hide');
			$('.co').addClass('hide');
			$('.po').addClass('hide');	

			default_pagination_length = $('#jobs_default_pagination_length').val();
		    displayStart = $('#jobs_displayStart').val();

			// Estimate Job list & cost summary AJAX call for an individual project 
			budget_jobs_list_view();
			
		}
		
		if (budget_hash == "#po")
		{			
			$('#current_tab').val("po");
			$('.po').addClass('show');			 
			$('.filter_none').addClass('show');
			$('.new_payapp').addClass('hide');
			$('.pay-app').addClass('hide');
			$('.new_estimate').addClass('hide');
			$('.co').addClass('hide');

			$('#apply_save_filter').attr('id','apply_save_filter_po');
			$('#apply_save_filter_pay_app').attr('id','apply_save_filter_po');
			$('#apply_save_filter_po').attr('id','apply_save_filter_po');
			$('#apply_save_filter_co').attr('id','apply_save_filter_po');

			$('#update_result_pay_app').attr('id','update_result_po');
			$('#update_result_po').attr('id','update_result_po');
			$('#update_result_co').attr('id','update_result_po');
			$('#update_result').attr('id','update_result_po');

			$('#save_filter_pay_app').attr('id','save_filter_po');	
			$('#save_filter_po').attr('id','save_filter_po');
			$('#save_filter_co').attr('id','save_filter_po');
			$('#save_filter').attr('id','save_filter_po');

			$('#pay_app_search_reset').attr('id','po_search_reset');
			$('#po_search_reset').attr('id','po_search_reset');
			$('#co_search_reset').attr('id','po_search_reset');
			$('#reset').attr('id','po_search_reset');
			

			//pagination code start here by -- Sidhartha
			default_pagination_length = $('#po_default_pagination_length').val();
		    displayStart = $('#po_displayStart').val();

			//apply filter code added by -- satheesh kumar
			if(po_apply_filter == true)
			{
				$("#apply_save_filter_po").show();
			}
			else
			{
				$("#apply_save_filter_po").hide();
			}	
			// Purchase Order list page AJAX call for an individual project 
			budget_po_list_view();
			
		}
		
});
$(function(){
	//$('#pro-group option[value="1"]').prop('disabled', true);	
	$('.filter_none').hide();
	$('.new_estimate').show();
	$('.new_estimate_con, .new_payapp_con').hide();
	$('.pay-app, .po, .co, .new_payapp').hide();
	$('.budget_pay_app_list_details').hide();
	
    /* checking role access  // by satheesh kumar */
	if (user_account_type == 200)
	{
		$('.filter_none').show();
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .new_payapp').show();
		$('.po, .co').hide();
	}
	/* pay app for owner */
	$('a[href = "#jobs"]').click(function(){
		$('.filter_none').hide();		
		$('.new_estimate').show();
		$('.pay-app, .po, .co, .new_payapp').hide();
		$('#new_estimate button').attr('disabled', false);
		
		$('.new_estimate').removeClass('hide show');
		$('.filter_none').removeClass('hide show');
		$('.new_payapp').removeClass('hide show');
		$('.pay-app').removeClass('hide show');
		$('.co').removeClass('hide show');
		$('.po').removeClass('hide show');
		$('.error-message').css('display','none');
		// Estimate Job list & cost summary AJAX call for an individual project 
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("jobs");

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");
		default_pagination_length = $('#jobs_default_pagination_length').val();
		displayStart = $('#jobs_displayStart').val();

		if($('#previous_tab').val() != $('#current_tab').val())
		{
			budget_jobs_list_view();
			//setTimeout("project_cost_summary()", 1000);
		}
	});
	
	
	$('a[href = "#po"]').click(function(){	
		$('.filter_none').show();
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .new_payapp , .co').hide();
		$('.po').show();
		
		$('.new_estimate').removeClass('hide show');
		$('.filter_none').removeClass('hide show');
		$('.new_payapp').removeClass('hide show');
		$('.pay-app').removeClass('hide show');
		$('.co').removeClass('hide show');
		$('.po').removeClass('hide show');
		$('.error-message').css('display','none');
		// Purchase Order list page AJAX call for an individual project
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("po");

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");
		//pagination code start here by -- Sidhartha
		default_pagination_length = $('#po_default_pagination_length').val();
		displayStart = $('#po_displayStart').val();

		if($('#previous_tab').val() != $('#current_tab').val())
		{
			budget_po_list_view();
		}		
	});
	
	$('#new_estimate').click(function(){		
		$('.new_estimate_con').show();
		$('#new_estimate button').attr('disabled', true);
				
	});
	$('#close_estimate').click(function(){
		$('.new_estimate_con').hide();
		$('#new_estimate button').attr('disabled', false);		
	});
	
});
$(function() {
	//update_result_form();
	$('#quantity').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#unit_cost').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#overhead_cost').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#datetimepicker2').datetimepicker({
      pickTime: false
    });
	$('#datetimepicker5').datetimepicker({
      pickTime: false
    });
	$('#datetimepicker3').datetimepicker({
      pickTime: false
    });
	$(document).on('click', '#budget_pay_app_list tbody tr a.pay_app_name', function (){	
			//$('.budget_pay_app_list').hide();							
			//$('.pay-app-list-content').show();	
			//$('.pay_app_filter').hide();
	});

if (typeof list_page != 'undefined') {
//project_summary_list_view();
 // alert ("hi");
}

});
$(function() {
if (typeof list_page != 'undefined') {
  //budget_po_list_view();  
}
//Update result
});
$('#export_file_estimate').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#budget_jobs_list') > 0){
            var encoded_url = Base64.encode('template/budget/get_jobs/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $(form1).attr('action', submit_url).submit();
        }else{
            $('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
        }
	
	});
//Data table code
function budget_jobs_list_view() {
	var encoded_url = Base64.encode('template/budget/get_jobs/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object
	//alert(123);
	var dbobject = {
		'tableName': $('#budget_jobs_list'),
		'this_table' : {'table_name':'template_budget_jobs_list'},
		'ajax_encoded_url':ajax_encoded_url,
		'id':'ub_template_estimate_id',
		'name' : 'cost_code_name',
		'post_data':'{}',
		'delete_data':{},  
		'edit_data':{'index':0, 'url':'#'},
		'job_id':'cost_code_id',
		'job_name' : 'po_count',
		'job_data':{},
		'job_co_id':'cost_code_id',
		'job_co_name' : 'co_count',
		'job_co_data':{},
		'display_columns' : [{"data": "cost_code_name"},{"data": "budget_amount"},{"data": "po_awarded_amount"},{"data": "po_count"},{"data": "overhead_cost"}],
		// 'default_order_by': [[1, 'asc']]
					};
	// Populate data table
	ubdatatable(dbobject);
	/*$('#budget_jobs_list tbody').on('click', 'tr', function () {
		 var name = $('td', this).eq(0).text();
			edit_estimate(name);
	} );
	$('#budget_co_list').on( 'click', 'a.editor_remove', function (e) 
	{
	  var role_id = $(this).attr('id');
	  delete_project({'ub_role_id':{role_id:role_id}});
	}); */
}
$(document).on('click','#update_result_po', function(e){				
	budget_po_list_view();
	$('.error-message').hide();
	e.preventDefault();			
});

$('#export_file').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#budget_po_list') > 0){
            var encoded_url = Base64.encode('template/budget/get_po/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $(form1).attr('action', submit_url).submit();
        }else{
            $('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
        }
	
	});	


//Data table code
function budget_po_list_view(calltype) {
	    var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
        /*var due_date_time = $('#due_date_time').val();
        var po_status = $('#po_status').val();
        var payment_status = $('#payment_result').val();*/

        var due_date_time = typeof $('#due_date_time').val() !== 'undefined' ? $('#due_date_time').val() : '';

        
		var encoded_url = Base64.encode('template/budget/get_po/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#budget_po_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_template_po_co_id',
							'name' : 'title',
							'this_table' : {'table_name':'budget_po_list'},
							'post_data':'{"fetch_type":"'+fetch_type+'","due_date_time":"'+due_date_time+'"}',
							'delete_data':{}, 
							'edit_data':{'index':0, 'url':'template/budget/save_po_co/PO/'},
							'po_data':{'index':10, 'url':'#'},
							'status':'po_status',
							'bid_po_id':'bid_po_id',
							'display_columns' : [{"data": "title"},{"data": "ub_po_co_number"},{"data": "due_date_time"},{"data": "po_status"},{"data": "total_amount"}],
							// 'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#budget_po_list').on( 'click', 'a.editor_remove', function (e) 
		{
		  var role_id = $(this).attr('id');
		  delete_project({'ub_role_id':{role_id:role_id}});
		}); 
}



//---------------------------------****************************---------------------------


//--------------------*********************************-----------------------------
//budget po search
$(document).on('click','#po_search_reset', function(e) {		
	po_reset_function();
	e.preventDefault();
});
function po_reset_function(){
	var encoded_destroy_session = Base64.encode('template/budget/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('template/budget/project_budget/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BUDGET_PO","destroy_type":["po_search"]},
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },		
		success: function(response) {		
		$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url + '#po';
				location.reload(true);				
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





$('#import_template').on('click',function(){
	var encoded_url = Base64.encode('template/budget/import_budget_poco/');
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
