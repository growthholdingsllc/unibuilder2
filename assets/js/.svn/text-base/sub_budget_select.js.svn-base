$(function() {     
var budget_url = window.location.href;
	var budget_hash = budget_url.substring(budget_url.indexOf("#"));
		if (budget_hash == "#po")
		{			
			$('#current_tab').val("po");
			$('.po').addClass('show');			 
			$('.co').addClass('hide');

			$('#apply_save_filter').attr('id','apply_save_filter_po');
			$('#apply_save_filter_po').attr('id','apply_save_filter_po');
			$('#apply_save_filter_co').attr('id','apply_save_filter_po');


			$('#update_result_po').attr('id','update_result_po');
			$('#update_result_co').attr('id','update_result_po');
			$('#update_result').attr('id','update_result_po');
	
			$('#save_filter_po').attr('id','save_filter_po');
			$('#save_filter_co').attr('id','save_filter_po');
			$('#save_filter').attr('id','save_filter_po');

			$('#po_search_reset').attr('id','po_search_reset');
			$('#co_search_reset').attr('id','po_search_reset');
			$('#reset').attr('id','po_search_reset');
			
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
		if (budget_hash == "#co")
		{			
			$('#current_tab').val("co");
			$('.co').addClass('show');
			$('.po').addClass('hide');
			
			$('#apply_save_filter').attr('id','apply_save_filter_co');
			$('#apply_save_filter_po').attr('id','apply_save_filter_co');
			$('#apply_save_filter_co').attr('id','apply_save_filter_co');

			$('#update_result').attr('id','update_result_co');
			$('#update_result_po').attr('id','update_result_co');
			$('#update_result_co').attr('id','update_result_co');

			$('#save_filter').attr('id','save_filter_co');
			$('#save_filter_po').attr('id','save_filter_co');
			$('#save_filter_co').attr('id','save_filter_co');

			$('#reset').attr('id','co_search_reset');
			$('#po_search_reset').attr('id','co_search_reset');
			$('#co_search_reset').attr('id','co_search_reset');
			
			//apply filter code added by -- satheesh kumar
			if(co_apply_filter == true)
			{
				$("#apply_save_filter_co").show();
			}
			else
			{
				$("#apply_save_filter_co").hide();
			}
			// Change Order list page AJAX call for an individual project 
			budget_co_list_view();
			
		}
});


$(function() {     
	$('#datetimepicker1').datetimepicker({pickTime: false});
	$('#datetimepicker2').datetimepicker({pickTime: false});
	$('#datetimepicker3').datetimepicker({pickTime: false});
	$('#datetimepicker4').datetimepicker({pickTime: false});
	$('#datetimepicker5').datetimepicker({pickTime: false});
});
/* 
function budget_summary_list_view() {
	$('#budget_summary_list').dataTable({
		"scrollX": true,
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5,           
		sAjaxSource: base_url + 'assets/js/json_budget_summary_list.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],
		"columns":[
		{ "sTitle":"Project Name", "data": "project_name"},
		{ "sTitle":"Budgeted Amount", "data": "budgeted_amount"},
		{ "sTitle":"Estimated Revenue", "data": "est_revenue"},
		{ "sTitle":"Total Vendor Cost", "data": "total_vendor_cost"},
		{ "sTitle":"Estimated General Condition/Overhead", "data": "estimated_overhead"},
		{ "sTitle":"Estimated Profit", "data": "estimated_profit"},
		{ "sTitle":"Billed To Client to Date", "data": "billed_client_date"},
		{ "sTitle":"Paid By Client to Date", "data": "paid_client_date"},
		{ "sTitle":"Unpaid Client Billings", "data": "unpaid_client_billings"},
		{ "sTitle":"Balance To Bill Client(D - H)", "data": "balance_bill_client"},
		{ "sTitle":"Invoiced to Date by sub", "data": "invoice_date_sub"},
		{ "sTitle":"Amount Paid to sub", "data": "amount_paid_sub"},
		{ "sTitle":"Balance To be Invoiced by sub", "data": "balance_to_invoiced_sub"},
		{ "sTitle":"Total Balance Owned to sub", "data": "total_balance_owned_sub"},
		{ "sTitle":"Overhead/In house", "data": "overhead_inhouse"},
		{ "sTitle":"Total Cost", "data": "total_cost"},
		{ "sTitle":"Profit to Date", "data": "profit_to_date"},
		{ "sTitle":"Profit", "data": "profit"},
		{ "sTitle":"Profit %", "data": "profit_percentage"}
		
	],
	"order": [[1, 'asc']]

	});
}


$(function() {
if (typeof list_page != 'undefined') {
budget_jobs_list_view();
  
}
//Data table code
function budget_jobs_list_view() {
		var encoded_url = Base64.encode('budget/get_jobs/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#budget_jobs_list'),
							'this_table' : {'table_name':'budget_jobs_list'},
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_estimate_id',
							'name' : 'cost_code_name',
							'post_data':'{}',
							'delete_data':{},  
							'edit_data':{'index':1, 'url':'#'},
							'display_columns' : [{"data": "ub_estimate_id"},{"data": "cost_code_name"},{"data": "budget_amount"},{"data": "po_awarded_amount"},{"data": "po_count"},{"data": "co_awarded_amount"},{"data": "co_count"},{"data": "revised_contract"},{"data": "overhead_cost"},{"data": "estimated_profit_amount"},{"data": "bill_to_client_to_date"},{"data": "paid_by_client_to_date"},{"data": "unpaid_client_billing"},{"data": "balance_to_bill_client"},{"data": "invoiced_by_sub_to_date"},{"data": "amount_paid_to_sub"},{"data": "balance_to_be_invoiced_by_sub"},{"data": "total_balance_owed_to_sub"},{"data": "total_cost"},{"data": "profit_to_date"},{"data": "overall_profit"}],
							'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#budget_co_list').on( 'click', 'a.editor_remove', function (e) 
		{
		  var role_id = $(this).attr('id');
		  delete_project({'ub_role_id':{role_id:role_id}});
		}); 
	}

});

$(function() {     
	setTimeout("budget_pay_app_list_view()",500);
});

function budget_pay_app_list_view() {
	var period_to = $('#due_date').val();
	var pay_app_name = $('#pay_app_name').val();
	var encoded_url = Base64.encode('budget/get_payapp/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		// alert(123);
	var dbobject = {
						'tableName': $('#budget_pay_app_list'),
						'ajax_encoded_url':ajax_encoded_url,
						'id':'name',
						'name' : 'name',
						'post_data':'{"period_to":"'+period_to+'","pay_app_name":"'+pay_app_name+'"}',
						'delete_data':{},  
						'edit_data':{'index':1, 'url':'budget/get_payapp_certificate/'},
						'display_columns' : [{"data": "payapp_number"},{"data": "name"},{"data": "period_to"},{"data": "status"}],
						'default_order_by': [[0, 'asc']]
					};
	// Populate data table
	ubdatatable(dbobject);
	
}

$(function() {     
	budget_pay_app_list_details_view();
	var encoded_delete_roles = Base64.encode('logs/index/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var editor = new $.fn.dataTable.Editor( {		
        ajax: base_url + encoded_delete_val,
        table: "#budget_pay_app_list_details",
        fields: [{               
                name: "cost_code"
            },
			{               
                name: "budgeted_value"
            },
			{               
                name: "scheduled_value"
            },
			
			{               
                name: "prev_app"
            },
			{               
                name: "period"
            },
			{               
                name: "materials_stored"
            },
			{               
                name: "stored_till_date"
            },
			{               
                name: "work_done"
            },
			{               
                name: "balance_finished"
            },
			{               
                name: "retainage_percentage"
            },
			{               
                name: "retainage_amount"
            }
        ]
		
    } );
	$('#budget_pay_app_list_details').on( 'click', 'tbody td:not(:first-child)', function (e) {
        editor.inline( this , {
            buttons: { label: '&gt;', fn: function () { this.submit();} }
		});
    });
});

function budget_pay_app_list_details_view() {
   $('#budget_pay_app_list_details').dataTable({				   
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5, 
					
		sAjaxSource: base_url + 'assets/js/json_budget_pay_app_list_details.json',				
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],	
		"drawCallback": function ( settings ) {
			
		var api = this.api();
		var rows = api.rows( {page:'current'} ).nodes();
		var last=null;           			
		api.column(0, {page:'current'} ).data().each( function ( group, i ) {
			if ( last !== group ) {
				$(rows).eq( i ).before(
					'<tr class="group"><td class="" colspan="12">'+group+'</td></tr>'
				); 					
				last = group;
			}				
		});			
		api.column(0, {page:'current'} ).data().each( function ( group, i ) {				
			if (last !== group) {
			//$(this).closest('.main').nextUntil('.main:not(.reply)').addBack().last().after(new_add);
				
				 var new_add =  '<tr class="gro-tot"><td colspan="2" class="text-right">Total</td><td>Total Val</td><td>Total Val</td><td>Total Val</td><td>&nbsp;</td><td>Total Val</td><td>Total Val</td><td>Total Val</td><td>Total Val</td><td>Total Val</td><td>Total Val</td></tr>';
			   
			   $(rows).eq(i).nextUntil('.group').last().after(new_add);
							
				last = group;
			}
			
			
		});				
		},	
				
		"columns":[            
		{ "sTitle":"", "data": "item_name","visible": false,},
		{ "sTitle":"Item No", "data": "item_no"},
		{ "sTitle":"Cost Code", "data": "cost_code"},
		{ "sTitle":"Budgeted Value", "data": "budgeted_value"},
		{ "sTitle":"Scheduled Value", "data": "scheduled_value"},
		{ "sTitle":"From Prev App", "data": "prev_app"},
		{ "sTitle":"This Period", "data": "period"},
		{ "sTitle":"Value of Materials Stored(Not in work completed)", "data": "materials_stored"},
		{ "sTitle":"Total Completed and stored till date", "data": "stored_till_date"},
		{ "sTitle":"% of work done", "data": "work_done"},
		{ "sTitle":"Balance to be finished", "data": "balance_finished"},
		{ "sTitle":"Retainage %", "data": "retainage_percentage"},
		{ "sTitle":"Retainage amount", "data": "retainage_amount"}
	],
	"order": [[1, 'asc']],
	tableTools: {
            sRowSelect: "os",
            sRowSelector: 'td:first-child'
        }

	});
	
} */



$(function() {
if (typeof list_page != 'undefined') {
	budget_po_list_view(); 
}
});

//Data table code
function budget_po_list_view() {

        // var due_date_time = $('#due_date_time').val();
        // var po_status = $('#po_status').val();
	    // alert(po_status);
        // var payment_status = $('#payment_result').val();		
		var due_date_time = typeof $('#due_date_time').val() !== 'undefined' ? $('#due_date_time').val() : '';
        var po_status = typeof $('#po_status').val() !== 'undefined' ? $('#po_status').val() : '';
        var payment_result = typeof $('#payment_result').val() !== 'undefined' ? $('#payment_result').val() : '';
		var encoded_url = Base64.encode('budget/get_po/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#budget_po_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_po_co_id',
							'name' : 'title',
							'project_id' : 'project_id',
							'this_table' : {'table_name':'budget_po_list'},
							'post_data':'{"due_date_time":"'+due_date_time+'","po_status":"'+po_status+'","payment_result":"'+payment_result+'"}',
							'delete_data':{},
							'status':'po_status', 
							'bid_po_id':'bid_po_id',
							'edit_data':{'index':0, 'url':'budget/sub_save_po_co/PO/'},
							'po_data':{'index':10, 'url':'budget/save_po_co/CO/0/'},
							'display_columns' : [{"data": "title"},{"data": "ub_po_co_number"},{"data": "package_title", "bSortable": false},{"data": "assigned_to"},{"data": "po_date"},{"data": "po_status"},{"data": "work_completed"},{"data": "payment_status"},{"data": "total_amount"},{"data": "paid_amount"},{"data": "bid_po_id"}],
							'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
}
function add_co(id)
{
	//alert(id);
    var encoded_string = Base64.encode('budget/save_po_co/CO/0/'+id);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    window.location.href = encoded_val;
            
   
}
	
$(function() {
if (typeof list_page != 'undefined') {
// budget_co_list_view();
}
});

//Data table code
function budget_co_list_view() 
{
	// alert("hi");
	// var due_date_time = $('#due_date_time').val();
	// var po_status = $('#po_status').val();
	// var payment_status = $('#payment_result').val();
	
	var co_due_date_time = typeof $('#co_due_date_time').val() !== 'undefined' ? $('#co_due_date_time').val() : '';
	var co_status = typeof $('#co_status').val() !== 'undefined' ? $('#co_status').val() : '';
	var co_payment_result = typeof $('#co_payment_result').val() !== 'undefined' ? $('#co_payment_result').val() : '';
	
	var encoded_url = Base64.encode('budget/get_co/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object
	//alert(123);
	var dbobject = {
						'tableName': $('#budget_co_list'),
						'ajax_encoded_url':ajax_encoded_url,
						'id':'ub_po_co_id',
						'name' : 'title',
						'post_data':'{"co_due_date_time":"'+co_due_date_time+'","co_status":"'+co_status+'","co_payment_result":"'+co_payment_result+'"}',
						'delete_data':{},  
						'edit_data':{'index':0, 'url':'budget/sub_save_po_co/CO/'},
						'display_columns' : [{"data": "title"},{"data": "ub_po_co_number"},{"data": "package_title", "bSortable": false},{"data": "assigned_to"},{"data": "po_date"},{"data": "po_status"},{"data": "work_completed"},{"data": "payment_status"},{"data": "total_amount"},{"data": "paid_amount"}],
						'default_order_by': [[1, 'asc']]
					};
	// Populate data table
	ubdatatable(dbobject);
	$('#budget_co_list').on( 'click', 'a.editor_remove', function (e) 
	{
	  var role_id = $(this).attr('id');
	  delete_project({'ub_role_id':{role_id:role_id}});
	}); 
}

$(function(){	
	$('.po').show();
	$('.co').hide();
	$('#apply_save_filter').attr('id','apply_save_filter_po');
	$('#apply_save_filter_po').attr('id','apply_save_filter_po');
	$('#apply_save_filter_co').attr('id','apply_save_filter_po');


	$('#update_result_po').attr('id','update_result_po');
	$('#update_result_co').attr('id','update_result_po');
	$('#update_result').attr('id','update_result_po');

	$('#save_filter_po').attr('id','save_filter_po');
	$('#save_filter_co').attr('id','save_filter_po');
	$('#save_filter').attr('id','save_filter_po');

	$('#po_search_reset').attr('id','po_search_reset');
	$('#co_search_reset').attr('id','po_search_reset');
	$('#reset').attr('id','po_search_reset');
	if(po_apply_filter == true)
	{
		$("#apply_save_filter_po").show();
	}
	else
	{
		$("#apply_save_filter_po").hide();
	}	
	$('a[href = "#po"]').click(function(){			
		$('.po').show();
	});
	$('a[href = "#co"]').click(function(){			
		$('.co').show();
	});	
	
});

$(function(){
	
	$('a[href = "#po"]').click(function(){	
		
		$('.co').hide();
		$('.po').show();
		$('.co').removeClass('hide show');
		$('.po').removeClass('hide show');
		
		$('#apply_save_filter').attr('id','apply_save_filter_po');
		$('#apply_save_filter_po').attr('id','apply_save_filter_po');
		$('#apply_save_filter_co').attr('id','apply_save_filter_po');


		$('#update_result_po').attr('id','update_result_po');
		$('#update_result_co').attr('id','update_result_po');
		$('#update_result').attr('id','update_result_po');

		$('#save_filter_po').attr('id','save_filter_po');
		$('#save_filter_co').attr('id','save_filter_po');
		$('#save_filter').attr('id','save_filter_po');

		$('#po_search_reset').attr('id','po_search_reset');
		$('#co_search_reset').attr('id','po_search_reset');
		$('#reset').attr('id','po_search_reset');
		
		$('.error-message').css('display','none');
		// Purchase Order list page AJAX call for an individual project
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("po");
		if($('#previous_tab').val() != $('#current_tab').val())
		{
			budget_po_list_view();
		}		
	});
	$('a[href = "#co"]').click(function(){
	
		$('.po').hide();
		$('.co').show();
		$('.co').removeClass('hide show');
		$('.po').removeClass('hide show');
		$('.error-message').css('display','none');
		$('#apply_save_filter').attr('id','apply_save_filter_co');
		$('#apply_save_filter_po').attr('id','apply_save_filter_co');
		$('#apply_save_filter_co').attr('id','apply_save_filter_co');

		$('#update_result').attr('id','update_result_co');
		$('#update_result_po').attr('id','update_result_co');
		$('#update_result_co').attr('id','update_result_co');

		$('#save_filter').attr('id','save_filter_co');
		$('#save_filter_po').attr('id','save_filter_co');
		$('#save_filter_co').attr('id','save_filter_co');

		$('#reset').attr('id','co_search_reset');
		$('#po_search_reset').attr('id','co_search_reset');
		$('#co_search_reset').attr('id','co_search_reset');
		// Change Order list page AJAX call for an individual project 
		// Purchase Order list page AJAX call for an individual project
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("co");
		if($('#previous_tab').val() != $('#current_tab').val())
		{
			budget_co_list_view();
		}		
	});
});	


/*----------------------------------------********************------------*/
//budget po search
$(document).on('click','#po_search_reset', function(e) {		
	po_reset_function();
	e.preventDefault();
});
function po_reset_function(){
	var encoded_destroy_session = Base64.encode('budget/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('budget/project_budget/');
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
$(document).on('click','#save_filter_po', function(e){
	var due_date_time = $('#due_date_time').val();
	var po_status = $('#po_status').val();
	var payment_status = $('#payment_result').val();	

 	if((!due_date_time) && (!po_status) && (!payment_status) )
	{
		error_box();
		$('.error-message .alerts').text('Please select one mandatory fields');	
		return false;
	} 	
	po_save_filter_function();
	e.preventDefault();	
});

function po_save_filter_function(){
	var due_date_time = $('#due_date_time').val();
	var po_status = $('#po_status').val();
	var payment_status = $('#payment_result').val();	
	var encoded_url = Base64.encode('budget/po_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'due_date_time='+due_date_time+'&po_status='+po_status+'&payment_status='+payment_status;
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
				$("#apply_save_filter_po").show();
				success_box();
				$('.error-message .alerts').text('Saved Successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Save failed');	
			}
		}
	});	
}
//Apply Filter
$(document).on('click','#apply_save_filter_po', function(e) {
		var encoded_url = Base64.encode('budget/po_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('budget/project_budget/');
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
				 window.location.href= base_url + ajax_encoded_urls+ '#po';
				location.reload(true);
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

//---------------------------**********************************-------------
//budget co search
$(document).on('click','#co_search_reset', function(e) {		
	co_reset_function();
	e.preventDefault();
});
function co_reset_function(){
	var encoded_destroy_session = Base64.encode('budget/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('budget/project_budget/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BUDGET_CO","destroy_type":["co_search"]},
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
		success: function(response) {		
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url + '#co';
				location.reload(true);
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
$(document).on('click','#save_filter_co', function(e){
	var co_due_date_time = $('#co_due_date_time').val();
	var co_status = $('#co_status').val();
	var co_payment_status = $('#co_payment_result').val();

 	if((!co_due_date_time) && (!co_status) && (!co_payment_status) )
	{
		error_box();
		$('.error-message .alerts').text('Please select one mandatory field');	
		return false;
	} 
	else{
		co_save_filter_function();
		e.preventDefault();
	}
});

function co_save_filter_function(){
	var co_due_date_time = $('#co_due_date_time').val();
	var co_status = $('#co_status').val();
	var co_payment_status = $('#co_payment_result').val();
	var encoded_url = Base64.encode('budget/co_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);	
	var data = 'co_due_date_time='+co_due_date_time+'&co_status='+co_status+'&co_payment_status='+co_payment_status;
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
				$("#apply_save_filter_co").show();
				success_box();
				$('.error-message .alerts').text('Saved Successfully');	

			}
			else{
				error_box();				
				$('.error-message .alerts').text('Save failed');	
			}
		}
	});	
}
//Apply Filter
$(document).on('click','#apply_save_filter_co', function(e) {
		var encoded_url = Base64.encode('budget/co_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('budget/project_budget/');
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
				window.location.href= base_url + ajax_encoded_urls+ '#co';
				location.reload(true);
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

//---------------------------**********************************-------------

//Update result

$(document).on('click','#update_result_po', function(e){				
	budget_po_list_view();
	$('.error-message').hide();
	e.preventDefault();			
});

$(document).on('click','#update_result_co', function(e){			
	 budget_co_list_view();
	 $('.error-message').hide();
	 e.preventDefault();			
});