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
	get_bidpackage();

}

// Category_Locations Data table child node on click 
$('#Bids_List tbody').on('click', 'td.details-control1', function() {
	$(this).parent().nextUntil('.group').toggle();
	var table1 = $(Bids_List).DataTable();
	var tr = $(this).closest('tr');
	var row = table1.row(tr);
	tr.toggleClass('shown');
});
// Category_Locations Data table parent node on click 
$('#Bids_List tbody').on('click', 'td.details-control', function() {
	//$(this).parent().nextUntil('.group').toggle();
	var table = $('#Bids_List').DataTable();
	var tr = $(this).closest('tr');
	var row = table.row(tr);
	tr.toggleClass('shown');
	if (row.child.isShown()) {
		row.child.hide();
		tr.removeClass('shown');
	} else {
		row.child(format_Bids(row.data())).show();
		tr.addClass('shown');
	}
});

//Update result
$('#update_result').click(function(e){			 
	get_bidpackage();
	$('.error-message').hide();
	e.preventDefault();
});
//Data table code for Location tab in selection landing page
function get_bidpackage(){
// alert(get_bidpackage);
	var daterange = $('#daterange').val();
	var bid_package_status = $('#bid_package_status').val();
	var bid_status = $('#bid_status').val();
	var encoded_url = Base64.encode('bids/get_bids/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
		'tableName': $('#Bids_List'),
		'ajax_encoded_url':ajax_encoded_url,
		'id':'ub_bid_id',
		'name' : 'package_title',
		'this_table' : {'table_name':'Bids_List'},
		'group_by_name' : 'package_title',
		'edit_data':{'index':1, 'url':'bids/save_bid/'},
		'status_val':'status',
		'status':{'index':6},
		'released_date_val':'released_date',
		'released_date':{'index':4},
		'post_data':'{"bid_package_status":"'+bid_package_status+'","bid_status":"'+bid_status+'","daterange":"'+daterange+'"}',
		'display_columns' : [{"orderable": false,"data": null,"defaultContent": '',"sClass": "details-control da-tab-checkbox"},{"data": "package_title"},{"data":"responsee_count", "bSortable": false},{"data":"accepted_count", "bSortable": false},{"data": "released_date"},{"data": "due_date_time"},{"data": "status"}],
		// 'default_order_by': [[1,'asc']]
	};
	// Populate data table
	ubdatatable_tree(dbobject);
}
// Format location tab child data table
function format_Bids(d) 
{
	var table_html = '<table class="table table-bordered">' +
		'<thead>' +
		'<tr>' +
		'<th>Sub</th>' +
		'<th>Sub Viewed</th>' +
		'<th>Submitted</th>' +
		'<th>Bid Amount</th>' +
		'<th>Status</th>' +
		'</tr>' +
		'</thead>';
	var append_th = '';	
	if(d.bid_items.length>0)
	{	
		var total_amount = 0;
		$.each(d.bid_items, function(colID,colNAME) {
		if(d.bid_items[colID]['bid_sub_status'] == 'Released')
		{
			var img_src = base_url + 'assets/images/strip.gif';
			d.bid_items[colID]['bid_sub_status'] = '<img src="'+ img_src +'" class="uni_send_email" />'+' '+d.bid_items[colID]['bid_sub_status'];
				
		}
		if(d.bid_items[colID]['bid_sub_status'] == 'Accepted')
		{
			var img_src = base_url + 'assets/images/strip.gif';
			d.bid_items[colID]['bid_sub_status'] = '<img src="'+ img_src +'" class="uni_approve" />'+' '+d.bid_items[colID]['bid_sub_status'];
				
		}
		if(d.bid_items[colID]['bid_sub_status'] == 'Declined' || d.bid_items[colID]['bid_sub_status'] == 'Rejected')
		{
			var img_src = base_url + 'assets/images/strip.gif';
			d.bid_items[colID]['bid_sub_status'] = '<img src="'+ img_src +'" class="uni_rejected" />'+' '+d.bid_items[colID]['bid_sub_status'];
				
		} 
		if(d.bid_items[colID]['bid_sub_status'] == 'Submitted')
		{
			var img_src = base_url + 'assets/images/strip.gif';
			d.bid_items[colID]['bid_sub_status'] = '<img src="'+ img_src +'" class="uni_approved" />'+' '+d.bid_items[colID]['bid_sub_status'];
				
		}
		if(d.bid_items[colID]['bid_sub_status'] == 'In Progress')
		{
			var img_src = base_url + 'assets/images/strip.gif';
			d.bid_items[colID]['bid_sub_status'] = '<img src="'+ img_src +'" class="uni_status_pending" />'+' '+d.bid_items[colID]['bid_sub_status'];
				
		}  
		if(d.bid_items[colID]['bid_sub_status'] == 'Closed')
		{
			var img_src = base_url + 'assets/images/strip.gif';
			d.bid_items[colID]['bid_sub_status'] = '<img src="'+ img_src +'" class="uni_cancel_new" />'+' '+d.bid_items[colID]['bid_sub_status'];
				
		}
		if(d.bid_items[colID]['submitted'] == null)
		{
			
			d.bid_items[colID]['submitted'] = '---';
				
		}
			var bid_amount = parseFloat(d.bid_items[colID]['bid_amount']);	
			append_th = append_th + '<tr><td><a href="javascript:void(0);" onclick="edit_bid('+d.bid_items[colID]['ub_bid_request_id']+','+d.bid_items[colID]['bid_id']+');">' + d.bid_items[colID]['sub'] + '</a></td>'+
			'<td>' + d.bid_items[colID]['sub_viewed'] + '</td>' +
			'<td>' + d.bid_items[colID]['submitted'] + '</td>' +
			'<td>' + bid_amount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,") + '</td>' + 
			'<td>' + d.bid_items[colID]['bid_sub_status'] + '</td></tr>';
			total_amount = total_amount + parseFloat(d.bid_items[colID]['bid_amount']);
		});	
	  append_th = append_th + '<tr><td></td><td></td><th>Total Accepted Bid Amount:</th><td>' + total_amount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,") +'</td><td></td><tr>';
	}
	else
	{
		append_th = append_th + '<tr><th>No Records</th><tr>';
	}
	table_html = table_html + append_th + '</table>';
	return table_html;
}
 });
// Reset 
$('#bids_search_reset').on('click', function(e) {	
	reset_function();
	e.preventDefault();
		
});
function reset_function(){
	var encoded_destroy_session = Base64.encode('bids/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	var role_index = Base64.encode('bids/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BIDS","destroy_type":["SEARCH"]},			
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
 // Save Filter
$('#save_filter').on('click', function(e) {
	var bid_package_status = $('#bid_package_status').val();
	var bid_status = $('#bid_status').val();
	var daterange = $('#daterange').val();		
	if((!bid_package_status) && (!bid_status) && (!daterange)){			
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
	var bid_package_status = $('#bid_package_status').val();
	var bid_status = $('#bid_status').val();
	var daterange = $('#daterange').val();	
	var encoded_url = Base64.encode('bids/apply_saved_search/');
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
			else{
				error_box();
				$('.error-message .alerts').text('Save filter failed');
			}
		}
	});
}
//Apply Filter
$('#apply_save_filter').on('click',function() {
	var encoded_url = Base64.encode('bids/apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var encoded_urls = Base64.encode('bids/index/');
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

//Multi delete

function Delete_checked_bid(ub_bid_id){
	var encoded_delete_roles = Base64.encode('bids/delete_bids/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('bids/index/');
	var index_url = index_string.strtr(encode_chars_obj);
	//alert(ub_task_id);return false;
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:ub_bid_id,
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


function delete_all_checked_bid(val)
{
	if(val === 'delete_multi_bid')
	{
		ub_bid_id = bid_checked_list();
		if(false != ub_bid_id)
		{
			if(confirm("Are you sure, you want to delete the selected bid(s)?"))
			{
				Delete_checked_bid({ub_bid_id:ub_bid_id});
			}
			else
			{
				return false;
			}
		}
		else
		{
			return ub_bid_id;
		}
	}
	else
	{
		return false;
	}
}

function bid_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	//alert(delete_obj.toSource());
	if($.isEmptyObject(delete_obj)){
		alert('Please select Bid');
		return false;
	}
	else{
		return delete_obj;
	}
}	


/* function update_result_form(){	
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
        }
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#bids_index").val() == 'update_result'){
				get_bidpackage();				
			 }
			else if($("#bids_index").val() == 'bids_search_reset'){
				reset_function();				
			}	
			else if($("#bids_index").val() == 'save_filter'){
				save_filter_function();				
			}
			e.preventDefault();			 
	  });		
} */
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
				$("#Import_modal").modal('hide');
				//get_bidpackage();
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
function edit_bid(ub_bidrequest_id,bid_id)
{

    var encoded_string = Base64.encode('bids/accept_bid/'+ub_bidrequest_id+'/'+bid_id);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    window.location.href = encoded_val;
            


}