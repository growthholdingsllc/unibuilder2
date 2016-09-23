/* var demoDataTables = function () {
	alert('success');return false;
    return {
        init: function () {
            $('.datatable').dataTable({
                "ajax": "assets/admin/scripts/data/datatables-arrays.txt",
                "sPaginationType": "bootstrap",
				 "bLengthChange": false,
				 "bFilter": false,
            });
        }
    };
}();

$(function () {
    "use strict";
    demoDataTables.init();
}); */
$(function() {
if (typeof list_page != 'undefined') {
		builder_list();
	}
	update_result_form();
	$('#update_result').on('click',function(e) {
		var mandatory = $('#plan_id').val();		
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
			builder_list();
			e.preventDefault();
		}		
	});
});
function builder_list()
{
		var plan_id = $('#plan_id').val();
		var status_id = $('#status_id').val();
		var company_name = $('#company_name').val();
		var encoded_url = Base64.encode('admin/builder/get_builder/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var dbobject = {
							'tableName': $('#builder_List_table'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'builder_id',
							'name':'membership_number',
							'post_data':'{"plan_id":"'+plan_id+'","status_id":"'+status_id+'","company_name":"'+company_name+'"}',
							'delete_data':{}, 
							'edit_data':{'index':0, 'url':'admin/builder/editbuilder/'},
							'display_columns' : [{"data": "membership_number"},{"data": "builder_name"},{"data": "full_name"},{"data": "plan_name"},{"data": "user_status"},{"data": "city"}],
							// 'default_order_by': [[1, 'asc']]
						};
						//alert(1234);
		//alert(dbobject);
		//alert(JSON.stringify(dbobject));
		// Populate data table
		ubdatatable(dbobject);
}

//Reset function

$('#reset').on('click', function(e) {
	reset_function();
	e.preventDefault();
});	
function reset_function(){
	var encoded_destroy_session = Base64.encode('admin/builder/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('admin/builder/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BUILDER","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = role_index_url;
			}
		}
	});
}

function update_result_form(){	
	var updateresultform = $('#Search_Result').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result'			
        },
        fields: {
            'plan_id': {
                validators: {
                    notEmpty: {
                        message: 'Please select current plan'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  			
			log_list();							
			e.preventDefault();			 
	  });	
}