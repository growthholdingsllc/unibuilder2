$(function() {
//update_result_form();
if (typeof list_page != 'undefined') {
roles_list();
  
}
//Update result
$('#update_result').click(function(e){	
	$("#roles_index").val('update_result');		 		
	roles_list();
	e.preventDefault();
});
//Data table code
function roles_list() {
        var role_name = $('#role_name').val();
		var encoded_url = Base64.encode('user/get_user_roles/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#user_roles_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_role_id',
							'name' : 'role_name',
							'post_data':'{"role_name":"'+role_name+'"}',
							'delete_data':{'index':0},  
							'edit_data':{'index':1, 'url':'user/add_userroles/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_role_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "role_name"},{"data": "role_active"},{"data": "description"}],
							// 'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#user_roles_list').on( 'click', 'a.editor_remove', function (e) 
		{
		  var role_id = $(this).attr('id');
		  delete_project({'ub_role_id':{role_id:role_id}});
		}); 
	}

});
//userroles search reset
$('#userroles_search_reset').on('click', function(e) {
	reset_function();
	e.preventDefault();
});
function reset_function(){
	var encoded_destroy_session = Base64.encode('user/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var projects_index = Base64.encode('user/user_roles/');
	var projects_index_url = projects_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"USERROLES","destroy_type":["SEARCH"]},
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },		
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = projects_index_url;
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
	$("#roles_index").val('save_filter');		 
		var role_name = $('#role_name').val();		
		if(role_name == ''){			
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
	var role_name = $('#role_name').val();	
	var role_active = $('#role_active_val').val();	
	var encoded_url = Base64.encode('user/apply_saved_search_userroles/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);	
	var data = 'role_name='+role_name+'&role_active='+role_active;
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
		var encoded_url = Base64.encode('user/apply_saved_search_userroles/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('user/user_roles/');
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


//Multi delete

function Delete_checked_userroles(ub_role_id){
	var encoded_delete_roles = Base64.encode('user/delete_userroles/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('user/user_roles/');
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


function delete_all_checked_userroles(val)
{
	if(val === 'delete_multi_userroles')
	{
		ub_role_id = userroles_checked_list();
		if(false != ub_role_id)
		{
			if(confirm("Are you sure, you want to delete the selected userrole(s)?"))
			{
				Delete_checked_userroles({ub_role_id:ub_role_id});
			}
			else
			{
				return false;
			}
		}
		else
		{
			return ub_role_id;
		}
	}
	else
	{
		return false;
	}
}

function userroles_checked_list(){
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
	var updateresultform = $('#Search_Result').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #save_filter'			
        },
        fields: {
            'role_name': {
                validators: {
                    notEmpty: {
                        message: 'The role name cannot be empty'
                    }
                }
            }
        }	
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#roles_index").val() == 'update_result'){
				roles_list();				
			 }				
			else if($("#roles_index").val() == 'save_filter'){
				save_filter_function();				
			}
			e.preventDefault();			 
	  });  

} */
$(function() {
    $(document).on('ifChecked','#role_active', function(event){                	
        $("#role_active_val").val("active");		
    }); 
    $(document).on('ifUnchecked','#role_active', function(event){
        $("#role_active_val").val("inactive"); 	
    }); 
});
