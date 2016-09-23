$(function() {
update_result_form();
if (typeof list_page != 'undefined') {
		sub_user_list();
	}
//Update result
$('#update_result').click(function(e){
	$("#subuser_index").val('update_result');
	var mandatory = $('#company_name').val();		
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
		$('.error-message .alerts').text('Reset succesfully');
		sub_user_list();
		e.preventDefault();
	}
});
//Data table code
function sub_user_list() {
		var encoded_url = Base64.encode('user/get_sub_users/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var company_name = $('#company_name').val();
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#sub_users'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_user_id',
							'name':'company',
							'post_data':'{"company_name":"'+company_name+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'user/save_subuser/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_user_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "company"},{"data": "fullname"},{"data": "user_status"},{"data": "country"},{"data": "desk_phone"},{"data": "primary_email"}],
							// 'default_order_by': [[1, 'asc']]
						};
		ubdatatable(dbobject);
		$('#sub_users').on( 'click', 'a.editor_remove', function (e) {
		  var ub_user_id = $(this).attr('id');
		  delete_task({'ub_user_id':{ub_user_id:ub_user_id}});
		});
	}

});

// subcontractor search
$('#sub_user_search_reset').on('click', function(e) {	
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-success');
		$('.error-message .alerts').text('Updated Results search succesfully');
		reset_function();
		e.preventDefault();	
});
function reset_function(){
	var encoded_destroy_session = Base64.encode('user/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var task_index = Base64.encode('user/user_subuser/');
	var task_index_url = task_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"SUBUSERS","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = task_index_url;
			}
		}
	});
}
// Save Filter
$('#save_filter').on('click', function() {
	$("#subuser_index").val('save_filter');
	var mandatory = $('#company_name').val();		
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
		$('.error-message .alerts').text('Updated Results search succesfully');
		save_filter_function();
		e.preventDefault();
	}
});
function save_filter_function(){
	var first_name = $('#company_name').val();	
	var encoded_url = Base64.encode('user/apply_saved_search_sub_user/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'first_name='+first_name;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,			
		success: function(response) {		
			if(response.status == true)
			{	
				$("#apply_save_filter").show();
			}
		}
	});	
}
//Apply Filter
$('#apply_save_filter').on('click',function() {
		var encoded_url = Base64.encode('user/apply_saved_search_sub_user/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);		
		var encoded_urls = Base64.encode('user/user_subuser/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",		
		success: function(response) {		
			if(response.status == true)
			{	
				 window.location.href= base_url + ajax_encoded_urls;
			}
		}
	});	
		//$.post(baseurl+ajax_encoded_url,'POST',function(res) {
			
});
function delete_all_checked_users(val){
	if(val == 'delete_multi_users')
	{
		ub_user_id = users_checked_list();
		if(ub_user_id != false)
		{
		  var conf = confirm("Are you sure you want to delete");
	      if(conf == true){
	         delete_checked_users({ub_user_id:ub_user_id})
	      }
	    }
        else
	    {
	      return ub_checklist_id;
	    }
	}
	else
	{
		return false;
	}
}
function delete_checked_users(ub_user_id){
	var encoded_delete_roles = Base64.encode('user/delete_builderuser/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('user/user_subuser/');
	var index_url = index_string.strtr(encode_chars_obj);
	//alert(ub_daily_log_id);return false;
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:ub_user_id,
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
		// alert('Please select Users');
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select Users');
		return false;
	}
	else{
		return delete_obj;
	}
}

function update_result_form(){	
	var updateresultform = $('#Search_Result').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #sub_user_search_reset, #save_filter'			
        },
        fields: {
            'company_name': {
                validators: {
                    notEmpty: {
                        message: 'The name is required cannot be empty'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#subuser_index").val() == 'update_result'){
				sub_user_list();				
			 }				
			else if($("#subuser_index").val() == 'save_filter'){
				save_filter_function();				
			}
			e.preventDefault();			 
	  });		
}