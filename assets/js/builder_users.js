$(function() {
	//update_result_form();
	if (typeof list_page != 'undefined') {
		builderusers_list();
	}
	$('#update_result').click(function(e){	
		$("#builder_user_list").val('update_result');
		builderusers_list();
		e.preventDefault();
	});
	// Export result set to file
	$('#export_file').on('click', function() {
		if(datatable_getrowcount('#Builder_Users')>0){
            var encoded_url = Base64.encode('user/get_builder_users/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $('#Search_Result').attr('action', submit_url).submit();
        }else{
            alert('Sorry! No records found for export');
        }
	
	});	
	  function builderusers_list(calltype) {
	  	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
		var full_name = $('#full_name').val();
		// return false;
		// Ajax URL
		var encoded_url = Base64.encode('user/get_builder_users/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		
		var dbobject = {					
							'tableName': $('#Builder_Users'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_user_id',
							'name': "first_name",
							'role_id':"role_id",
							'this_table' : {'table_name':'Builder_Users'},
							'post_data':'{"fetch_type":"'+fetch_type+'","full_name":"'+full_name+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'user/save_builderuser/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_user_id', "defaultContent": '<input type="checkbox" class="chk" />'},
							{"data": "first_name"},{"data": "role_name"},{"data": "time_zone","bSortable": false},{"data": "user_status"},{"data": "primary_email"}],
							// 'default_order_by': [[1, 'desc']]
						};

		ubdatatable(dbobject);
	}
});
$('#builderuser_search_reset').on('click', function(e) {			
	reset_function();
	e.preventDefault();		
});	
function reset_function(){
	var encoded_destroy_session = Base64.encode('user/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('user/builder_users/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BUILDERUSER","destroy_type":["SEARCH"]},
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },		
		success: function(response) {	
			$('.uni_wrapper').removeClass('loadingDiv');		
			if(response.status == true)
			{	
				window.location.href = role_index_url;
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
// Save Filter
$('#save_filter').on('click', function(e) {
	$("#builder_user_list").val('save_filter');
		var full_name = $('#full_name').val();		
		if((!full_name)){			
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
	var first_name = $('#full_name').val();
	var encoded_url = Base64.encode('user/apply_saved_search_builderuser/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'full_name='+first_name;
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
		var encoded_url = Base64.encode('user/apply_saved_search_builderuser/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('user/builder_users/');
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
		//$.post(baseurl+ajax_encoded_url,'POST',function(res) {
			
});
function delete_checked_users(ub_user_id){
	var encoded_delete_roles = Base64.encode('user/delete_builderuser/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('user/builder_users/');
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


function delete_all_checked_users(val)
{
	if(val == 'delete_multi_users')
	{
		ub_user_id = users_checked_list();
		if(ub_user_id != false)
		{
			var conf = $('#confirmModal').modal('show');
			$('#delete_confirm').click(function(){
				var conf = true;
				if(conf == true){
					delete_checked_users({ub_user_id:ub_user_id})
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
            selector: '#update_result, #save_filter'			
        },
        fields: {
            'full_name': {
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
			 if($("#builder_user_list").val() == 'update_result'){
				builderusers_list();				
			 }				
			else if($("#builder_user_list").val() == 'save_filter'){
				save_filter_function();				
			}
			e.preventDefault();			 
	  });		
} */