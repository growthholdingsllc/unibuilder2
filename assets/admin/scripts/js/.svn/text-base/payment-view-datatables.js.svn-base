$(function() {
payment_list();
});
function payment_list()
{
        var plan_id = $('#plan_id').val();
		var status_id = $('#status_id').val();
		var membership_id = $('#membership_id').val();
		var company_name = $('#company-name').val();
		var encoded_url = Base64.encode('admin/payment/get_payment_list/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var dbobject = {
							'tableName': $('#payment_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_payment_id',
							'name':'builder_name',
							'post_data':'{"plan_id":"'+plan_id+'","status_id":"'+status_id+'","membership_number":"'+membership_id+'","builder_name":"'+company_name+'"}',
                            'delete_data':{},							
							'edit_data':{},
							'display_columns' : [{"data": "membership_number"},{"data": "builder_name"},{"data": "payment_date","bSortable": false},{"data": "plan_name","bSortable": false},{"data": "payment_type","bSortable": false},{"data": "payment_status"},{"data": "amount","bSortable": false},{"data": "reference_id","bSortable": false},{"data": "result_text","bSortable": false}],
							// 'default_order_by': [[2, 'desc']]
						};
						//alert(1234);
		//alert(dbobject);
		//alert(JSON.stringify(dbobject));
		// Populate data table
		ubdatatable(dbobject);
}
$('#reset').on('click', function(e) {
	reset_function();
	e.preventDefault();
});	
$('#update_result').on('click', function(e) {
	payment_list();
	e.preventDefault();
});	

function reset_function(){
	var encoded_destroy_session = Base64.encode('admin/payment/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('admin/payment/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"PAYMENT","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = role_index_url;
			}
		}
	});
}