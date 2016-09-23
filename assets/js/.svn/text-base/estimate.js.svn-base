$(function(){
	$('#new_estimate button').attr('disabled', false);
	update_save_estimate_form();
	/* $('.new_estimate').show();
	$('.new_estimate_con, .new_payapp_con').hide();
	$('.pay-app, .po , .co, .new_payapp').hide();
	$('.budget_pay_app_list_details').hide();
	
	$('a[href = "#jobs"]').click(function(){	
		$('.new_estimate').show();
		$('.pay-app, .po, .co, .new_payapp').hide();
		$('#new_estimate button').attr('disabled', false);
	});
	$('a[href = "#summary"]').click(function(){	
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .po, .co, .new_payapp').hide();
	});
	$('a[href = "#pay_app"]').click(function(){	
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .new_payapp').show();
		$('.po, .co').hide();
	});
	$('a[href = "#po"]').click(function(){	
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .co, .new_payapp').hide();
		$('.po').show();
	});
	$('a[href = "#co"]').click(function(){	
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .po, .new_payapp').hide();
		$('.co').show();
	}); */
	$(document).on('click', '#new_estimate', function(){
		$('.new_estimate_con').show();
		$('#new_estimate button').attr('disabled', true);
				
	});
	$("body").on("click", "#close_estimate", function(event){ 
		// alert('cancel');
		$('.new_estimate_con').hide();
		$('#new_estimate button').attr('disabled', false);
		location.reload();
	});
	// $('#close_estimate').click(function(){
		// alert('cancel');
		// $('.new_estimate_con').hide();
		// $('#new_estimate button').attr('disabled', false);		
	// });
	$('#new_payapp').click(function(){
		$('.new_payapp_con').show();
		$('#new_payapp button').attr('disabled', true);		
	});
	$('#close_payapp').click(function(){
		$('.new_payapp_con').hide();
		$('#new_payapp button').attr('disabled', false);		
	});
	
});

//Delete estimate
// $('#del_estimate').on('click',function(e) {
$("body").on("click", "#del_estimate", function(event){ 
	//$('#confirmModal').modal('show');
	//$('#delete_confirm').click(function(){
		//$('#confirmModal').modal('hide');
		del_estimate_form();
	//});
});

// $( "#budget_amount, #quantity, #unit_cost" ).keyup(function() {
$("body").on("keyup change", "#budget_amount, #quantity, #unit_cost", function(event){ 
  var quantity = $("#quantity").val();
  var unit_cost = $("#unit_cost").val();
  var budget_amount =  (quantity * unit_cost);
  $("#budget_amount").val(budget_amount);
});

//Add cost code
$(document).on("click", "#insert_costcode", function(e){
	var costcode_status = 'Active';
	//Temporary commenting below code as per Girish
	/*if(document.getElementById('costcode_status').checked) {
		var costcode_status = 'Active';
	}*/
	var operation_type = 'add';
	var check_costcode = $('#check_costcode').val();
	var check_costcode_array = check_costcode.split(',');
	var cost_variance_code = $('#cost_variance_code').val();
	var update_costcode_id = $('#update_costcode_id').val();
	if(update_costcode_id != '')
	{
		var operation_type = 'update';
		$('#cost_code_id option[value="' + update_costcode_id + '"]').remove();
	}
	//var code_category = $('#code_category').val(); //temporary commenting
	var code_category = 0;
	var cost_description = $('#cost_description').val();
	var encoded_url = Base64.encode('budget/update_costcode/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	if(cost_variance_code!=''){
		if(check_costcode_array.indexOf(cost_variance_code) > 0) {
			// alert("This cost code already exists"); 
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('This cost code already exists');
			return false;
		}
		xhr = $.ajax({
			type: "POST",
			dataType: "json",
			data: {"costcode_status":costcode_status,
			"cost_variance_code":cost_variance_code,
			"update_costcode_id":update_costcode_id,
			"code_category":code_category,
			"cost_description":cost_description,
			"type":operation_type},
			url: base_url + ajax_encoded_url,
			beforeSend: function() {
				$('.uni_wrapper').addClass('loadingDiv');		
			},
			success: function (response) {
				$('.uni_wrapper').removeClass('loadingDiv');		
				if(response.status == true)
				{
					$('#cost_code_id').append($("<option value=" + response.insert_id + ">" + cost_variance_code + "</option>"));
					$(".selectpicker").selectpicker("refresh");
					// alert(response.message);
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text(response.message);
					$("#CostCodeEditor").modal('hide');
					$('#cost_variance_code').val('');
					$('#cost_description').val('');
					$('#update_costcode_id').val('');
					$('.selectpicker').selectpicker('refresh');
					$("#code_category option[value='']").prop("selected", true);
					$('.selectpicker').selectpicker('refresh');
					$('#costcode_status').closest('.icheckbox_square-red').removeClass('checked');   
					$('#costcode_status').removeAttr("checked", "checked");
				}else
				{
					// alert("Insertion failed");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text('Insertion failed');
				}
			}
		}); 
   }
   else
   {
	// alert('Please Enter Cost code name');
	$('#alertModal').modal('show');
	$('.alert_modal_txt').text('Please Enter Cost code name');
   }
   e.preventDefault();
});

//Delete Cost Code
$(document).on('click', '.TypeAddModal', function() {
$('.delete_costcode').hide();
$('.deatails_cost').show();
	$('#CostCodeEditor').modal({
	show: true
	});
});	
$(document).on('click', '.close', function () {  
  $('#update_costcode_id').val(''); 
  $('#cost_variance_code').val('');   
});	
$(document).on('click', '.TypeEditModal', function() {	
		
        var n = $('#cost_code_id').next().find('.dropdown-menu.inner.selectpicker li.selected .text').text();		
		var costcode_name = $('#cost_code_id').next().find('.dropdown-menu.inner.selectpicker li.selected .text').text();
        var costcode_id = $('#cost_code_id').val();
		if (n != 'Nothing selected') {	
			$('#CostCodeEditor').modal({
					show: true
			 });
			 $('#update_costcode_id').val(costcode_id);
			 $('.deatails_cost').hide();
			 $('.delete_costcode').show();
			 $('#cost_variance_code').val(costcode_name);
			 
		}else{            
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select Cost code');
        }
		
});

$(document).on("click", "#delete_costcode", function(e){ 
        // var n = $('#cost_code_id').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
        var costcode_id = $('#update_costcode_id').val();
		if (costcode_id != '') {
			$('#cost_code_id option[value="' + costcode_id + '"]').remove();
			var encoded_url = Base64.encode('budget/update_costcode/');
			var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			var operation_type = 'delete';
			dataobj = {"costcode_id":costcode_id,"type":operation_type};
			xhr = $.ajax({
				type: "POST",
				dataType: "json",
				data: dataobj,
				url: base_url + ajax_encoded_url,
				beforeSend: function() {
				    $('.uni_wrapper').addClass('loadingDiv');		
				},
				success: function (response) {
					$('.uni_wrapper').removeClass('loadingDiv');		
					if(response.status == true)
					{    
						$('#cost_code_id').next().find('.dropdown-menu li.selected').remove();
						$('#cost_code_id').next().find('.selectpicker .filter-option').empty();
						$('#cost_code_id').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
						$(".selectpicker").selectpicker("refresh");
						// alert("Deleted successfully");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text('Deleted successfully');
						$("#CostCodeEditor").modal('hide');
						$('.selectpicker').selectpicker('refresh');
						$("#cost_code_id option[value='']").prop("selected", true);
						$('.selectpicker').selectpicker('refresh');
						$('#update_costcode_id').val('');
					}else
					{
						// alert("Deletion failed: "+response.message);
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text("Deletion failed: "+response.message);
					}
				}
			}); 
        } else {
            // alert('No cost code selected');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('No cost code selected');
        }
});

//Add and stay
$(document).on("click", "#add_estimate_new_stay", function(e){	
		var check_estimate = $('#check_estimate').val();
		var check_estimate_array = check_estimate.split(',');
		$("#save_type").val('save_and_stay');	 
		var cost_code_id = $('#cost_code_id').val();
		var quantity = $('#quantity').val();
		var unit_cost = $('#unit_cost').val();		
		if(cost_code_id == '' || quantity == '' || unit_cost == ''){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}		
		else if(check_estimate_array.indexOf(cost_code_id) > 0) {			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Estimate already exists');	
			return false;
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Added estimate succesfully');
			add_estimate_form();
			e.preventDefault();
		}
});

function edit_estimate(ub_estimate_id)
{
	// $('#new_estimate button').attr('disabled', true);
	// End of clearing hidden fields
	if(ub_estimate_id=='' || ub_estimate_id==0)
	{
		return false;
	}
	else
	{
		//checking project status -- code added by satheesh kumar
		if(project_status == 'Closed' || project_status == 'Disabled')
		{	
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Project was '+project_status+'. You can not able to edit');
		}
		/* checking project status ends here */
		
		var encoded_url = Base64.encode('budget/get_estimate/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var ajaxData  = 'ub_estimate_id='+ub_estimate_id;	
		$.ajax({
			url: base_url + ajax_encoded_url,
			type: 'POST',
			data: ajaxData,
			beforeSend: function() {
				$('.uni_wrapper').addClass('loadingDiv');			  
			},
			success: function (response) {
				$('.uni_wrapper').removeClass('loadingDiv');	
				$('.new_estimate').html(response);
			}
		});
	}
}	

$("#save_schedule").submit(function(event) {
	
	var is_true = validate_predecessor('submit_schedule');
	if(false === is_true)
	{
		return false;
	}
	var submit_button = event.originalEvent.explicitOriginalTarget.id;
	$('#save_type').val(submit_button);		 
		var title = $('#title').val();		
		var start_date = $('#start_date').val();		
		var no_of_days = $('#no_of_days').val();		
		var end_date = $('#end_date').val();		
		if(title == '' || start_date == '' || no_of_days == '' || end_date == '')
		{			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');
			return false;					
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			//$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('Updated Results search succesfully');
			//add_schedule_form();
			//e.preventDefault();
		}
	switch(submit_button)
	{
		
		case 'save_and_back':
		{
			add_schedule_form(submit_button);			
			
			break;
		}
		case 'save_and_stay':
		{
			add_schedule_form(submit_button);
			break;
		}
		case 'save_and_new':
		{
			add_schedule_form(submit_button);
			break;
		} 		
	}		
	event.preventDefault();
});



function add_estimate_form() {
	// alert('add Estimate');
	var encoded_string = Base64.encode('budget/save_estimate/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#save_estimate").serialize();	
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
				if($("#save_type").val() == 'save_and_new')
				{
					window.location.href = encoded_val;
				}
				else if($("#save_type").val() == 'save_and_stay')
                {
                    var encoded_string_edit_log = Base64.encode( 'budget/project_budget/');
                    var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                    window.location.href = encoded_edit_val+"#jobs";
					location.reload(true);
                    //  budget_jobs_list_view();
                }
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

function del_estimate_form() {
	 //alert('coming to del');
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
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');		
        },
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{
				var encoded_string_edit_log = Base64.encode( 'budget/project_budget/');
				var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
				window.location.href = encoded_edit_val+"#jobs";
				location.reload(true);
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

function update_save_estimate_form(){	
			$('#save_estimate').find('[name="cost_code_id"]').selectpicker().change(function(e) {            
                $('#save_estimate').formValidation('revalidateField', 'cost_code_id');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_estimate_new_stay'			
        },
        fields: {
            'cost_code_id': {
                validators: {
                    notEmpty: {
                        message: 'Please select the Cost Code'
                    }
                }
            },
			'quantity': {
                validators: {
					notEmpty: {
						 message: 'The quantity is required'
					},
					integer: {
                        message: 'The value is not an integer'
                    }								
                }
            },
			'unit_cost': {
                validators: {
					notEmpty: {
						 message: 'The unit cost is required'
					},
					integer: {
                        message: 'The value is not an integer'
                    }					
                }
            }
			
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			add_estimate_form();							
			e.preventDefault();			 
	  });		  
}