$(function() {
//update_result_form();
if (typeof list_page != 'undefined') {
	sub_contractor_list();
}
//Update result
$('#update_result').click(function(e){	
	$("#user_subcontractor_index").val('update_result');		
	sub_contractor_list();
	e.preventDefault();	
});
//Data table code
function sub_contractor_list() {
		var encoded_url = Base64.encode('subcontractor/get_sub_contractor/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var company_name = $('#company_name').val();
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#sub_contractor_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_subcontractor_id',
							'name':'company',
							'division':'division',
							'this_table' : {'table_name':'sub_contractor_list'},
							'post_data':'{"company_name":"'+company_name+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'subcontractor/save_subcontractor/'},
							'length':'length',
							'division_index':{'index':2},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_subcontractor_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "company"},{"data": "division"},{"data": "user_status"},{"data": "country", "bSortable": false},{"data": "desk_phone", "bSortable": false},{"data": "primary_email", "bSortable": false}],
							// 'default_order_by': [[1, 'asc']]
						};
		ubdatatable(dbobject);
		$('#sub_contractor_list').on( 'click', 'a.editor_remove', function (e) {
		  var checklist_id = $(this).attr('id');
		  delete_task({'ub_checklist_id':{checklist_id:checklist_id}});
		});
	}

});

// subcontractor search
$('#sub_contractor_search_reset').on('click', function(e) {	
	reset_function();
	e.preventDefault();	
});
function reset_function(){
	var encoded_destroy_session = Base64.encode('subcontractor/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var task_index = Base64.encode('subcontractor/user_subcontractor/');
	var task_index_url = task_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"SUBCONTRACTOR","destroy_type":["SEARCH"]},	
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = task_index_url;
				success_box();
				$('.error-message .alerts').text('Reset successfully');	
			}
			else{
				error_box();
				$('.error-message .alerts').text('Reset failed');
			}
			
		}
	});	
}
//Save filter and apply filter code

// Task search
$('#save_filter').on('click', function(e) {
	$("#user_subcontractor_index").val('save_filter');	
	var company_name = $('#company_name').val();		
	if(company_name == ''){			
		error_box();
		$('.error-message .alerts').text('Please fill mandatory field');	
		return false;					
	}
	else{		
		save_filter_function();
		e.preventDefault();
	}
});
function save_filter_function(){
	var company_name = $('#company_name').val();
	var encoded_url = Base64.encode('subcontractor/apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'company='+company_name;
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
				//show apply filter button
				$("#apply_save_filter").show();
				success_box();
				$('.error-message .alerts').text('saved successfully');	
			}
			else{
				error_box();
				$('.error-message .alerts').text('saved failed');	
			}
		}
	});	
}
//Apply Filter
$('#apply_save_filter').on('click',function() {
		var encoded_url = Base64.encode('subcontractor/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('subcontractor/user_subcontractor/');
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
				$('.error-message .alerts').text('applied filter successfully');
			}
			else{
				error_box();
				$('.error-message .alerts').text('applied filter failed');
			}
		}
	});	
			
});

//Bulk actions

function delete_all_checked_users(val){
	if(val == 'delete_multi_users')
	{
		ub_user_id = users_checked_list();
		if(ub_user_id != false)
		{
			var conf = $('#confirmModal').modal('show');
			$('#delete_confirm').click(function(){
				var conf = true;
				if(conf == true){
					delete_checked_users({ub_subcontractor_id:ub_user_id})
				}
			});
	    }
        else
	    {
	      return ub_user_id;
	    }
	}
	else
	{
		return false;
	}
}
function delete_checked_users(ub_subcontractor_id){
	var encoded_delete_roles = Base64.encode('subcontractor/delete_sub_contractor/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('subcontractor/user_subcontractor/');
	var index_url = index_string.strtr(encode_chars_obj);
	//alert(ub_daily_log_id);return false;
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:ub_subcontractor_id,
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
function users_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	//alert(delete_obj.toSource());
	if($.isEmptyObject(delete_obj)){		
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select Users');
		return false;
	}
	else{
		return delete_obj;
	}
}

/* function update_result_form(){	
	var updateresultform = $('#Search_Result').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #sub_contractor_search_reset, #save_filter'			
        },
        fields: {
            'company_name': {
                validators: {
                    notEmpty: {
                        message: 'The name is required cannot be empty'
                    }
                }
            }
        }
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#user_subcontractor_index").val() == 'update_result'){
				sub_contractor_list();				
			 }			
			else if($("#user_subcontractor_index").val() == 'save_filter'){
				save_filter_function();				
			}
			e.preventDefault();			 
	  });		
} */