// Payapp summary In-line edit global variable
var editor;
// Validation, datepicker and close button function call
$(function() {     
	update_payapp_form();
	$('#datetimepicker4').datetimepicker({pickTime: false});
	$("body").on("click", "#close_payapp", function(event){ 
		$('.new_payapp_con').hide();
		$('#new_payapp button').attr('disabled', false);
	});	
	/* checking role access for owner payapp // by satheesh kumar */
});
// Navigation button functionality inside the payapp tab
$(function() {     
	$('.budget_pay_app_list_details').hide();
	// Display payappp summary inline edit list page 
	$("body").on("click", "#pay-app-list-details", function(){ 
		if($('#selected_payapp_id').val()>0)
		{
			get_payapp_status($('#selected_payapp_id').val(),$('#selected_payapp_status').val(),'payapp_status');
			budget_pay_app_list_details_view($('#selected_payapp_id').val());
			$('.budget_pay_app_list').hide();							
			$('.pay-app-list-content').hide();	
			$('.budget_pay_app_list_details').show();	
			$('.pay_app_filter').hide();
		}
	});
	// Display payappp list / certificate page 
	$("body").on("click", "#pay_app_list_prev", function(){ 
		if($('#selected_payapp_status').val()=='Draft' || $('#selected_payapp_status').val()=='Cancelled')
		{
			budget_pay_app_list_view();
			$('.budget_pay_app_list').show();							
			$('.pay-app-list-content').hide();	
			$('.budget_pay_app_list_details').hide();	
			$('.pay_app_filter').hide();
		}
		else 
		{
			get_payapp_status($('#selected_payapp_id').val(),$('#selected_payapp_status').val(),'from_payapp_summary');
			$('.budget_pay_app_list').hide();							
			$('.pay-app-list-content').show();	
			$('.budget_pay_app_list_details').hide();	
			$('.pay_app_filter').hide();
		}
	});	
	// Display payapp list page 
	$("body").on("click", "#pay_app_list", function(){ 
		budget_pay_app_list_view();
		$('.budget_pay_app_list').show();							
		$('.pay-app-list-content').hide();	
		$('.budget_pay_app_list_details').hide();	
		$('.pay_app_filter').show();
	});	
});
// Payapp summary inline edit code block
$(function() {     
	var encoded_url = Base64.encode('budget/save_payapp_request_summary/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	editor = new $.fn.dataTable.Editor({		
		ajax: base_url + ajax_encoded_url,
		table: "#budget_pay_app_list_details",
		idSrc: "ub_payapp_request_summary_id",
		fields: [{               
				name: "this_period",
			},
			{               
				name: "value_of_material_stored"
			},
			{               
				name: "retainage"
			}]		
	});
/* 	editor.on( 'preSubmit', function ( e, o, action ) {
		if ( o.data.this_period === '' ) {
			this.error('this_period', 'This period cannot be empty!');
			return false;
		}
		else if ( o.data.first_name.length >= 10 ) {
			this.error('this_period', 'The first name length must be less that 10 numeric');
			return false;
		}
    });	 */
	var editIcon = function ( data, type, row ) {
		if ( type === 'display' ) {
			return data + ' sasa';
		}
		return data;
	};
	// In-line Edit for row onclick upon icon  
	$('#budget_pay_app_list_details').on( 'click', 'tbody td i', function (e) {		
		e.stopImmediatePropagation(); // stop the row selection when clicking on an icon
		if($('#hide_payapp_status').val()=='Draft')
		{
			editor.inline( $(this).parent(),{
				buttons: {label: 'submit', fn: function () { this.submit();}}
			});		
		}
		else
		{
			return false;
		}
	});	

});

// Function to draw the payapp summary table 
function budget_pay_app_list_details_view(payapp_id) {
 	var ub_payapp_id = payapp_id;
	//$('#ub_payapp_id').val(ub_payapp_id);
	//var pay_app_name = $('#pay_app_name').val();
	var encoded_url = Base64.encode('budget/get_payapp_request_summary/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);

	var dbobject = {
		'tableName': $('#budget_pay_app_list_details'),
		'this_table' : {'table_name':'budget_pay_app_list_details'},
		'ajax_encoded_url':ajax_encoded_url,
		'id':'ub_payapp_request_summary_id',
		'post_data':'{"ub_payapp_id":"'+ub_payapp_id+'"}',
		'display_columns' : [
		{  "data": "type", "visible" : false, "searchable" : false},
		//{  "data": "cost_code_id"},
		{  "data": "cost_code_name"},
		{  "data": "budgeted_value","render": $.fn.dataTable.render.number( ',', '.', 2, '$' )},
		{  "data": "scheduled_value","render": $.fn.dataTable.render.number( ',', '.', 2, '$' )},
		{  "data": "from_prev_app","render": $.fn.dataTable.render.number( ',', '.', 2, '$' )},
		{  "data": "this_period","className": "d-t-cursor","render": function (data, type, row){
                if (type === 'display') {
                    var numberRenderer = $.fn.dataTable.render.number( ',', '.', 2, '$' ).display;
                    return numberRenderer( data )+ ' <i class="d_t_inline_edit"/>';
                }
                return data;
            } },		
		{  "data": "value_of_material_stored","className": "d-t-cursor","render": function (data, type, row){
                if ( type === 'display' ) {
                    var numberRenderer = $.fn.dataTable.render.number( ',', '.', 2, '$' ).display;
                    return numberRenderer( data )+ ' <i class="d_t_inline_edit"/>';
                }
                return data;
            } },				
		{  "data": "total_completed_and_stored_till_date","render": $.fn.dataTable.render.number( ',', '.', 2, '$' )},
		{  "data": "percentage_of_work_done","render": $.fn.dataTable.render.number( ',', '.', 2, '%' )},
		{  "data": "balance_to_be_finished","render": $.fn.dataTable.render.number( ',', '.', 2, '$' )},
		{  "data": "retainage","className": "d-t-cursor","render": function (data, type, row){					
                if (type === 'display') {					
                    var numberRenderer = $.fn.dataTable.render.number( ',', '.', 2, '%' ).display;
                    return numberRenderer( data )+ ' <i class="d_t_inline_edit"/>';					
                }				
                return data;
            } },		
		{ "data": "retainage_amount","render": $.fn.dataTable.render.number( ',', '.', 2, '$' )}],
		'default_order_by': [[1, 'asc']]
	};
	// Populate data table
	ubdatatable_inline_edit_grouping(dbobject);	
}
// Function to change the payapp status
function get_payapp_status(ub_payapp_id,pay_app_status,action)
{
	$('.error-message').css('display','none');
	$('.new_payapp_con').hide();
	$('#new_payapp button').attr('disabled', false);		
	$('#selected_payapp_id').val(ub_payapp_id);
	$('#selected_payapp_status').val(pay_app_status);
	if(ub_payapp_id=='' || ub_payapp_id==0)
	{
		return false;
	}
	if((pay_app_status=='Funded' || pay_app_status=='Released') && action != 'payapp_status')
	{
		var encoded_url = Base64.encode('budget/get_payapp_certificate/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var ajaxData  = 'payapp_id='+ub_payapp_id;	
		$.ajax({
			url: base_url + ajax_encoded_url,
			type: 'POST',
			data: ajaxData,
			success: function (response) {
				$('.pay-app-list-content').html(response);
				$('.budget_pay_app_list').hide();							
				//$('.budget_pay_app_list_details').show();
				$('.budget_pay_app_list_details').hide();	
				$('.pay-app-list-content').show();
				$('.pay_app_filter').hide();
			}	
		});
	}
	else
	{
		if(ub_payapp_id>0){
			// $('#new_estimate button').attr('disabled', true);
			// End of clearing hidden fields
			var encoded_url = Base64.encode('budget/build_payapp_status/');
			var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			var ajaxData  = 'ub_payapp_id='+ub_payapp_id;	
			$.ajax({
				url: base_url + ajax_encoded_url,
				type: 'POST',
				data: ajaxData,
				success: function (response) {
					$('#payapp_status').html(response);
					
					if(pay_app_status=='Draft')
					{
						budget_pay_app_list_details_view(ub_payapp_id);
						$('.budget_pay_app_list').hide();							
						$('.budget_pay_app_list_details').show();
						//$('.pay-app-list-content').show();
						$('.pay_app_filter').hide();
					}
					else
					{
						$('.budget_pay_app_list').hide();							
						$('.budget_pay_app_list_details').show();
						//$('.pay-app-list-content').show();
						$('.pay_app_filter').hide();
					}
				}
			});
		}
	}
}
// Function to edit payapp entry 
function edit_payapp(ub_payapp_id)
{
	// End of clearing hidden fields
	if(ub_payapp_id=='' || ub_payapp_id == 0)
	{
		return false;
	}
	else
	{
		var encoded_url = Base64.encode('budget/build_payapp_edit/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var ajaxData  = 'ub_payapp_id='+ub_payapp_id;	
		$.ajax({
			url: base_url + ajax_encoded_url,
			type: 'POST',
			data: ajaxData,
			success: function (response) {
				$('.new_payapp').html(response);
			}
		});
	}
}

// Click event for button Save payapp
$(document).on("click", "#btn_save_payapp", function(e){	
	if($('#payapp_name').val() != '' && $('#period_to').val() != '')
	{		
		add_payapp_form('save_payapp');
		e.preventDefault();	
	}
	else
	{
		$('.error-message .alerts').text('Please select one mandatory fields');	
		error_box();
	}
});

$("body").on("click", "#btn_payapp_status,#btn_payapp_status2", function(){ 
	
	var ub_payapp_id = $('#selected_payapp_id').val();
	var payapp_status = $(this).val();
	if(payapp_status == 'Cancelled')
	{
		if(false === confirm('Are you sure? You need to cancel this payapp?'))
		{
			return false;
		}
	}
	var encoded_url = Base64.encode('budget/save_payapp/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	if(ub_payapp_id>0 && payapp_status!='')
	{
		var ajaxData  = 'ub_payapp_id='+ub_payapp_id+'&payapp_status='+payapp_status;	
		$.ajax({
			url: base_url + ajax_encoded_url,
			type: 'POST',
			data: ajaxData,
			success: function (response) {
				if(payapp_status == 'Release')
				{
					$('#selected_payapp_status').val('Released');
				}
				else if(payapp_status == 'Funded')
				{
					$('#selected_payapp_status').val('Funded');
				}
				get_payapp_status(ub_payapp_id,$('#selected_payapp_status').val(),'payapp_status');
			}
		});
	}
	
});


function add_payapp_form(submit_button) {
	var encoded_string = Base64.encode('budget/save_payapp/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#save_payapp").serialize();
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,	
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
		success: function(response) {			
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				if(submit_button == 'save_payapp')
				{					
					$('.new_payapp_con').hide();
					$('#new_payapp button').attr('disabled', false);
					$('.budget_pay_app_list').show();							
					$('.pay-app-list-content').hide();	
					$('.budget_pay_app_list_details').hide();	
					budget_pay_app_list_view();
				}
				if(response.message)
				{
					success_msg = response.message;
					success_box();					
					$('.error-message .alerts').text(success_msg);
				}
			}
			else
			{				
				if(response.message)
				{
					failure_msg = response.message;
					error_box();					
					$('.error-message .alerts').text(failure_msg);
				}	
			}
			return false;
		}
	});	
}
/* 
function del_payapp_form() {
	var encoded_string = Base64.encode('budget/del_estimate/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#save_estimate").serialize();	
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,			
		success: function(response) {
			if(response.status == true)
			{
				var encoded_string_edit_log = Base64.encode( 'budget/project_budget/');
				var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
				window.location.href = encoded_edit_val;
				// console.log(response.insert_id);
				if(response.message)
				{
					success_msg = response.message;								
				}
				//$(".alert").html(success_msg);
			}
			else
			{
				if(response.message)
				{
					failure_msg = response.message;
				}	
				//$(".alert").html(failure_msg);				
			}
			return false;
		}
	});	
}
 */
function update_payapp_form(){	
	$('#save_payapp').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#btn_save_payapp'			
        },
        fields: {
            'payapp_name': {
                validators: {
                    notEmpty: {
                        message: 'Pay App Name cannot be empty'
                    }
                }
            },
			'period_to': {
                validators: {
					notEmpty: {
						 message: 'Period To date is required'
					},
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'Period To date is required'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
			 error_box();
			 $('.error-message .alerts').text("Please fill all mandatory field(s)");
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {
			//add_payapp_form();	  
			e.preventDefault();			 
	  });	
	$('#datetimepicker4').on('dp.change dp.show', function(e) {		
        $('#save_payapp').formValidation('revalidateField', 'period_to');
    });	 
	$(document).on('click','#datetimepicker4', function(e) {		
        $('#save_payapp').formValidation('revalidateField', 'period_to');
    });	
}
$("body").on("click", "#print_pay_app_cost_view", function(){ 
	//alert(1);
	$('#include').closest('.icheckbox_square-red').removeClass('checked');        
    $('#include').removeAttr("checked", "checked");
    $("#include_val").val("No");
    $("#confirmModal").html();
	var conf = $('#confirmModal').modal('show');
	$("#confirmModal").html();
    $('#delete_confirm').click(function(){
        var conf = true;
        if(conf == true){
        	var pay_app_id = $('#pay_app_id').val();
	        var include_val = $('#marked-lists').val();
            $('#confirmModal').modal('hide');
	var encoded_string = Base64.encode('prints/pay_app_cost_view/'+pay_app_id+'/'+include_val);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    //var ajaxData  = $("#add_new_budget_po").serialize();     
    window.open(encoded_val, '_blank');
 }
 });
});
$("body").on("click", "#print_pay_app_certificate", function(){ 
	// alert(1);
	$('#include_certificate').closest('.icheckbox_square-red').removeClass('checked');        
    $('#include_certificate').removeAttr("checked", "checked");
    $("#include_certificate_val").val("No");
    $("#certificateModal").html();
	var conf = $('#certificateModal').modal('show');
    $('#certificate_confirm').click(function(){
        var conf = true;
        if(conf == true){
        	var pay_app_certificate_id = $('#pay_app_certificate_id').val();
	        var include_certificate_val = $('#marked-list').val();
            $('#certificateModal').modal('hide');
	var encoded_string = Base64.encode('prints/pay_app_certificate/'+pay_app_certificate_id+'/'+include_certificate_val);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    //var ajaxData  = $("#add_new_budget_po").serialize();     
    window.open(encoded_val, '_blank');
 }
 });
});

$(function() {
    $(document).on('ifChecked','#include', function(event){                	
        $("#include_val").val("Yes");	
    }); 
    $(document).on('ifUnchecked','#include', function(event){
        $("#include_val").val("No"); 	
    });
    $(document).on('ifChecked','#include_certificate', function(event){                	
        $("#include_certificate_val").val("Yes");	
    }); 
    $(document).on('ifUnchecked','#include_certificate', function(event){
        $("#include_certificate_val").val("No"); 	
    }); 
});