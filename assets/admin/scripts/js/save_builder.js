$(function(){
	$('group').each(function(i,e){
        $(e).find('input:radio').attr('name', 'group' + i);
    });
	payment_list();	
	project_details();
	save_builder_form();		
	$("#status_id").on('change',function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("value")==""){
				$('#select_change').val('');
                $(".box").hide();
            }
            else if($(this).attr("value")=="active"){
				$('#select_change').val('active');
                 $(".box").show();
            }
            else if($(this).attr("value")=="inactive"){
				$('#select_change').val('');
                 $(".box").hide();
            }
            else{
				$('#select_change').val('');
                $(".box").hide();
            }
        });
    });
	
	/* Update code */
	$('#update_save_new_builder').click(function(e) {	
		var company_name 	= $('#company_name').val();		
		var first_name 		= $('#first_name').val();		
		var last_name 		= $('#last_name').val();		
		var email_address 	= $('#email_address').val();		
		var zip 			= $('#zip').val();		
		var username 		= $('#username').val();					
		var plan_id 		= $('#plan_id').val();		
		var status_id 		= $('#status_id').val();		
		if(company_name == '' || first_name == '' || last_name == '' || email_address == '' || zip == '' || plan_id == '' || status_id == ''){	
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');			
		}
		else if($('#select_change').val() == 'active'){			
			if(username == ''){				
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
				$('.error-message .alerts').text('Added builder succesfully');
				update_builder_user();
				e.preventDefault();
			}
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Added builder succesfully');
			update_builder_user();
			e.preventDefault();
		}
	});
	$('#cancel').click(function(e) {
	var encoded_home_string = Base64.encode('admin/builder/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	window.location.href = encoded_home_val;
		e.preventDefault();
    });
});
function update_builder_user()
{
	var encoded_string = Base64.encode('admin/builder/update_builder/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('admin/builder/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#update_builder").serialize();
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
				//window.location.href = encoded_home_val;
			}
			return false;
		}
	});	
}
$('#send_activation_link').click(function(e) {
	
	var company_name 	= $('#company_name').val();		
		var first_name 		= $('#first_name').val();		
		var last_name 		= $('#last_name').val();		
		var email_address 	= $('#email_address').val();		
		var zip 			= $('#zip').val();		
		var username 		= $('#username').val();					
		var plan_id 		= $('#plan_id').val();		
		var status_id 		= $('#status_id').val();		
		if(company_name == '' || first_name == '' || last_name == '' || email_address == '' || zip == '' || plan_id == '' || status_id == ''){	
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');			
		}
		else if($('#select_change').val() == 'active'){			
			if(username == ''){				
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
				$('.error-message .alerts').text('Added builder succesfully');
				send_activationlink();
				e.preventDefault();
			}
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Added builder succesfully');
			send_activationlink();
			e.preventDefault();
		}
});
function send_activationlink()
{
	var encoded_string = Base64.encode('admin/builder/user_email_invitation/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('admin/builder/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var ajaxData  = $("#update_builder").serialize();
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
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text(response.message);
		    $('.uni_wrapper').removeClass('loadingDiv');
			window.location.href = encoded_home_val;
			}
			else
			{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text(response.message);
			return false;
			}
		}
	});	
}
$("#delete_builder").click(function(){
		delete_builder();
	});
/* code to delete the project*/
function delete_builder()
{
	var encoded_string = Base64.encode('admin/builder/delete_builders/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var encoded_home_string = Base64.encode('admin/builder/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	//var edit_page = $('#edit_page').val();
	 var ajaxData  = $("#update_builder").serialize();
	 $.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,		
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
			window.location.href = encoded_home_val ;
			}
			else
			{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text(response.message);
			return false;
			}
		}
	});	
}
function save_builder_form(){	
	$('#update_builder').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_save_new_builder, #send_activation_link'			
        },
        fields: {
            'company_name': {
                validators: {
                    notEmpty: {
                        message: 'The company name cannot be empty'
                    }
                }
            },
			'first_name': {
                validators: {
                    notEmpty: {
                        message: 'The first name cannot be empty'
                    }
                }
            },
			'last_name': {
                validators: {
                    notEmpty: {
                        message: 'The last name cannot be empty'
                    }
                }
            },
			'email_address': {
                validators: {
					notEmpty: {
                        message: 'The email cannot be empty'
                    },
                   emailAddress: {
                        message: 'The value is not a valid email address'
                   }
                }
            },
			'zip': {
                validators: {
                    notEmpty: {
                        message: 'The zip cannot be empty'
                    }
                }
            },
			'status_id': {
                validators: {
                    notEmpty: {
                        message: 'The account cannot be empty'
                    }
                }
            },			
			'username': {
                validators: {                    
					callback: {
                            message: 'The username cannot be empty',
                            callback: function(value, validator, $field) {
                                var username = $('#update_builder').find('[name="username"]').val();
                                return (username !== '');
                            }
                        }
                }
            },
			'plan_id': {
                validators: {
                    notEmpty: {
                        message: 'Please select the plan'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  			
			update_builder_user();							
			e.preventDefault();			 
	  }).on('change', '[name="status_id"]', function(e) {
            $('#update_builder').formValidation('revalidateField', 'username');
        });		 
}


//payment list added by Satheesh Kumar
function payment_list()
{
        var builder_id = $('#builder_id').val();
		var encoded_url = Base64.encode('admin/payment/get_payment_list/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var dbobject = {
							'tableName': $('#builder_payments'),
							'this_table' : {'table_name':'builder_payments'},
							'ajax_encoded_url':ajax_encoded_url,
							'id':'reference_id',
							'ub_invoice_id':'ub_invoice_id',
							'name':'builder_id',
							'post_data':'{"builder_id":"'+builder_id+'"}',
                            'delete_data':{},							
							'edit_data':{},
							'edit_data1':{'index':7, 'url':'#'},
							'payment_date':{'index':0},
							'display_columns' : [{"data": "payment_date"},{"data": "plan_name"},{"data": "payment_type"},{"data": "payment_status"},{"data": "amount"},{"data": "reference_id"},{"data": "result_text"},{"data": null}],
							'default_order_by': [[0, 'desc']]
						};
		ubdatatable(dbobject);
}
/* Plan History */
/*function project_details() {
        $('#project_details').dataTable({
            "aLengthMenu": [
                [5, 15, 50, 100],
                [5, 15, 50, "l00"]
            ],
            "iDisplayLength": 5,            
            sAjaxSource: base_url + 'assets/admin/scripts/js/project_details.json',
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0] // <-- gets last column and turns off sorting
            }],
			"fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {                            
			var project_actions = data['actions'];       
			if(project_actions == 'enable'){
				$('td:eq(5)', nRow).html('<a href="javascript:void(0);"><button class="btn btn-success">Enable</button></a>');        
			}
			else if(project_actions == 'disable'){
				$('td:eq(5)', nRow).html('<a href="javascript:void(0);"><button class="btn btn-secondary">Disable</button></a>');  
			}			
			return nRow;        
            },
      "columns":[            
            {"data": "project_name"},
            {"data": "address"},
            {"data": "start_date"},            
            {"data": "end_date"},
            {"data": "status"},
            {"data": "actions"}
        ],
        "order": [[1, 'asc']]

        });
}*/
$(function(){
$(document).on('ifChecked','#open', function (event) {
      $('#search_param').val('Open');
      project_details();
    });


    $(document).on('ifChecked','#disabled', function (event) {
      $('#search_param').val('Disabled');
      project_details();
    });

     $(document).on('ifChecked','#all', function (event) {
      $('#search_param').val('all');
      project_details();
    });
  });
function project_details() {
	    
		var encoded_url = Base64.encode('admin/builder/get_project_details/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var ub_builder_id = $('#builder_id').val();
		var search_param = $('#search_param').val();

		// Data table Object
		var dbobject = {
							'tableName': $('#uni_project_details'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_project_id',
							'name' : 'project_name',
							'projected_start_date' : 'projected_start_date',
							'actual_completion' : 'actual_completion',
							'projected_start_date_index' : {'index':2},
							'actual_completion_index' : {'index':3},
							'this_table' : {'table_name':'uni_project_details'},
							'post_data':'{"ub_builder_id":"'+ub_builder_id+'","search_param":"'+search_param+'"}',
							'delete_data':{},
							'status_val':'project_status', 
							'edit_data':{'index':5, 'url':'#'},
							'display_columns' : [{"data": "project_name", "bSortable": false},{"data": "address", "bSortable": false},{"data": "projected_start_date", "bSortable": false},{"data": "actual_completion", "bSortable": false},{"data": "project_status", "bSortable": false},{"data": "project_status", "bSortable": false}],
							 // 'default_order_by': [[1, 'asc']]
						};
						// alert(dbobject);
		// Populate data table
		ubdatatable(dbobject);
		 
}
/* /Plan History */

function invoice_download(invoice_id , builder_id)
{
	var encoded_string_edit_log = Base64.encode( 'setup/invoice_download/'+invoice_id+'/'+ builder_id);
	var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
	window.location.href = encoded_edit_val;
}
function update_project_status(id)
{
	
	var encoded_string = Base64.encode('admin/builder/update_project_status/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    //var ajaxData  = $("#add_new_budget_po").serialize(); 
    var id = id;
	var fields = id.split(/,/);
    var ub_project_id = fields[0];
    var project_status = fields[1];

    var ajaxData = 'ub_project_id='+ub_project_id+'&project_status='+project_status;
    
    //alert(ajaxData);    
    $.ajax({
    url: base_url + encoded_val,
    dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
        project_details();
      }
   }); 
   
}
/* Below code was added by chandru for changing the plan */
$('#update_plan').click(function(e) {
	update_plan();
	e.preventDefault();
});

function update_plan()
{
	var ub_user_plan_id = $('#ub_user_plan_id').val();
	var plan_id = $('#plan_id').val();
	var builder_id = $('#builder_id').val();
	var current_plan_id = $('#current_plan_id').val();
	var encoded_string = Base64.encode('admin/builder/update_plan/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: "ub_user_plan_id="+ub_user_plan_id+"&plan_id="+plan_id+"&builder_id="+builder_id+"&current_plan_id="+current_plan_id,
		beforeSend: function() {
					$('.uni_wrapper').addClass('loadingDiv');			
				},		
		success: function(response) {  
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.project_disable == true)
			{
				var confirmation = confirm("The projects allowed in the plan which you have selected is ("+response.no_of_projects+") and you have ("+response.current_plan_project_count+") active projects. Please disable any of the ("+response.disable_project_count+") projects to downgrade to this plan.");
				if (confirmation == true) {
					$('#myModal').modal('hide');
					// alert('success');return false;
				}
			}else{
				window.location.reload();
			}
		}
	});  
}
/* Below code was added by chandru for plan change */
$('#plan_id').on('change', function() {
  var plan_id = this.value;
  var builder_id = $('#builder_id').val();
  var encoded_string = Base64.encode('admin/builder/project_details_for_plan_drop_down/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: "plan_id="+plan_id+"&builder_id="+builder_id,          
		success: function(response) { 			
			$('.no_of_pro').text(response.no_of_projects);
			$('.pro_count').text(response.current_plan_project_count);
			// $('.disable_contition').text(response.project_disable);
			$('.disable_count').text(response.disable_project_count);
			if(response.disable_project_count > 0)
			{
				$("#update_plan").hide();
			}else{
				$("#update_plan").show();
			}
			// window.location.reload();
		}
	}); 
});