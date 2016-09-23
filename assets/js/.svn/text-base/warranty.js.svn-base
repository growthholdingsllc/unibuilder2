$(function() {
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
});
$(function() {
	//update_result_form();
	if (typeof list_page != 'undefined') {
		warrantyclaim_list();
	}
 //Update result

// Export result set to file
	$('#export_file').on('click', function() {
		if(datatable_getrowcount('#Warranty_List')>0){
			var encoded_url = Base64.encode('warranty/get_warranty/');
			var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			var submit_url = base_url + ajax_encoded_url;
			$('#Search_Result').attr('action', submit_url).submit();	
		}else{
			// alert('Sorry! No records found for export');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
		}
	});	
//Data table code


});
$('#update_result').click(function(e){	
	$("#warranty_index").val('update_result');
	warrantyclaim_list();
	e.preventDefault();
});
$('#warranty_search_reset').on('click', function(e) {		
	reset_function();
	e.preventDefault();
});
function reset_function(){
	var encoded_destroy_session = Base64.encode('warranty/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('warranty/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"WARRANTY","destroy_type":["SEARCH"]},		
		beforeSend: function() {
			$('.uni_wrapper').addClass('loadingDiv');
		},			
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url;
				success_box();
				$('.error-message .alerts').text('Reset succesfully');
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
	$("#warranty_index").val('save_filter');
	var status = $('#status').val();
	var classification = $('#classification').val();
	var category = $('#category').val();
	var priority = $('#priority').val();
	var coordinators = $('#coordinators').val();
	var servicingsub = $('#servicingsub').val();
	var subcontractor = $('#subcontractor').val();
	var daterange = $('#daterange').val();
	if((!status) && (!classification) && (!category) && (!priority) && (!coordinators) && (servicingsub == 0) && (subcontractor == 0) && (!daterange))
	{		
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
	var status = $('#status').val();
	var classification = $('#classification').val();
	var category = $('#category').val();
	var priority = $('#priority').val();
	var coordinators = $('#coordinators').val();
	var servicingsub = $('#servicingsub').val();
	var subcontractor = $('#subcontractor').val();
	var daterange = $('#daterange').val();
	
	var encoded_url = Base64.encode('warranty/apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'status='+status+'&classification='+classification+'&category='+category+'&priority='+priority+'&coordinators='+coordinators+'&servicingsub='+servicingsub+'&subcontractor='+subcontractor+'&daterange='+daterange;
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
				$('.error-message .alerts').text('Saved Successfully');	
			}
			else{
				error_box();
				$('.error-message .alerts').text('Save failed');	
			}
		}
	});	
}
//Apply Filter
$('#apply_save_filter').on('click',function() {
// alert(apply_save_filter);
		var encoded_url = Base64.encode('warranty/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('warranty/index/');
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
		//$.post(baseurl+ajax_encoded_url,'POST',function(res) {
			
});
function delete_all_checked_warranty(val)
{
	if(val == 'delete_multi_warranty')
	{
		ub_warranty_claim_id = warranty_checked_list();
		if(ub_warranty_claim_id != false)
		{
			var conf = $('#confirmModal').modal('show');
			$('#delete_confirm').click(function(){
				var conf = true;
				if(conf == true){
					delete_checked_warranty({ub_warranty_claim_id:ub_warranty_claim_id})
				}
			});
	    }
        else
	    {
	      return ub_warranty_claim_id;
	    }
	}
	else
	{
		return false;
	}
}
function delete_checked_warranty(ub_warranty_claim_id){
	var encoded_delete_roles = Base64.encode('warranty/delete_warranty/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('warranty/index/');
	var index_url = index_string.strtr(encode_chars_obj);
	//alert(ub_daily_log_id);return false;
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:ub_warranty_claim_id,
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




function warranty_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	//alert(delete_obj.toSource());
	if($.isEmptyObject(delete_obj)){		
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select Warranty');
		return false;
	}
	else{
		return delete_obj;
	}
}

/* function update_result_form(){	
	var updateresultform = $('#Search_Result').find('[name="status[]"], [name="classification[]"], [name="category[]"], [name="priority[]"], [name="user_id"], [name="subcontractor_id"], [name="subcontractor"], [name="daterange"]').selectpicker().change(function(e) {            
                $('#Search_Result').formValidation('revalidateField', 'status[], classification[], category[], priority[], user_id, subcontractor_id, subcontractor, daterange ');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #warranty_search_reset, #save_filter'			
        },
        fields: {
            'status[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select the status'
                    }
                }
            },
			'classification[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select the classification'
                    }
                }
            },
			'category[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select the category'
                    }
                }
            },
			'priority[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select the priority'
                    }
                }
            }
			
        }
		
    }).on('change', '[name="status[]"], [name="classification[]"], [name="category[]"], [name="priority[]"]', function(e) {			
            var status 			  = $('#Search_Result').find('[name="status[]"]').val(),
				classification    = $('#Search_Result').find('[name="classification[]"]').val(),
				category          = $('#Search_Result').find('[name="category[]"]').val(),
				priority          = $('#Search_Result').find('[name="priority[]"]').val(),
                fv            	  = $('#Search_Result').data('formValidation');
				
					
            switch ($(this).attr('name')) {
				
                case 'status[]':
                    fv.enableFieldValidators('classification[]', status === '').revalidateField('classification[]');
                    fv.enableFieldValidators('category[]', status === '').revalidateField('category[]');
                    fv.enableFieldValidators('priority[]', status === '').revalidateField('priority[]');
					
                    if (status && fv.getOptions('status[]', null, 'enabled') === false) {
                        fv.enableFieldValidators('status[]', true).revalidateField('status[]');						
                    } 
					else if(status === '' && classification !== '' && category !== '' && priority !== ''){
					fv.enableFieldValidators('status[]', false).revalidateField('status[]');
						
					}					
                    break;   
					
				case 'classification[]':
                    fv.enableFieldValidators('status[]', classification === '').revalidateField('status[]');
                    fv.enableFieldValidators('category[]', classification === '').revalidateField('category[]');
                    fv.enableFieldValidators('priority[]', classification === '').revalidateField('priority[]');                    
					
                    if (classification && fv.getOptions('classification[]', null, 'enabled') === false) {
                        fv.enableFieldValidators('classification[]', true).revalidateField('classification[]');
                    } 
					else if (classification === '' && status !== '' && category !== '' && priority !== '') {
                        fv.enableFieldValidators('classification[]', false).revalidateField('classification[]');
                    }					
                    break; 
					
				case 'category[]':
                    fv.enableFieldValidators('status[]', category === '').revalidateField('status[]');
                    fv.enableFieldValidators('classification[]', category === '').revalidateField('classification[]');
                    fv.enableFieldValidators('priority[]', category === '').revalidateField('priority[]');
                    					
                    if (category && fv.getOptions('category[]', null, 'enabled') === false) {
                        fv.enableFieldValidators('category[]', true).revalidateField('category[]');
                    } 
					else if (category === '' && status !== '' && classification !== '' && priority !== '') {
                        fv.enableFieldValidators('category[]', false).revalidateField('category[]');
                    }					
                    break;
					
				case 'priority[]':
                    fv.enableFieldValidators('status[]', priority === '').revalidateField('status[]');
                    fv.enableFieldValidators('classification[]', priority === '').revalidateField('classification[]');
                    fv.enableFieldValidators('category[]', priority === '').revalidateField('category[]');                    
					
                    if (priority && fv.getOptions('priority[]', null, 'enabled') === false) {
                        fv.enableFieldValidators('priority[]', true).revalidateField('priority[]');
                    } 
					else if (priority === '' && status !== '' && classification !== '' && category !== '') {
                        fv.enableFieldValidators('priority[]', false).revalidateField('priority[]');
                    }					
                    break;

                default:
                    break;
            }
        }).on('err.field.fv', function(e, data) {
				error_box();
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#warranty_index").val() == 'update_result'){
				success_box();
				warrantyclaim_list();				
			 }			
			else if($("#warranty_index").val() == 'save_filter'){
				success_box();
				save_filter_function();				
			}
			e.preventDefault();			 
	  });		
}
 */
function warrantyclaim_list(calltype) {
calltype = typeof calltype !== 'undefined' ? calltype : 'list';
var fetch_type = calltype;
var status = $('#status').val();
var classification = $('#classification').val();
// alert(classification);
var category = $('#category').val();
var priority = $('#priority').val();
var coordinators = $('#coordinators').val();
var servicingsub = $('#servicingsub').val();
var subcontractor = $('#subcontractor').val();
var daterange = $('#daterange').val();
var encoded_url = Base64.encode('warranty/get_warranty/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#Warranty_List'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_warranty_claim_id',
							'name' : 'title',
							'this_table' : {'table_name':'Warranty_List'},
							'post_data':'{"fetch_type":"'+fetch_type+'","status":"'+status+'", "classification":"'+classification+'","category":"'+category+'","priority":"'+priority+'","coordinators":"'+coordinators+'","servicingsub":"'+servicingsub+'","daterange":"'+daterange+'","subcontractor":"'+subcontractor+'"}',
							'delete_data':{'index':0},
							'status_val':'status',
							'status':{'index':8},
							'created_by':'created_by',
							'account_type':'account_type',
							'created_on':{'index':4},  
							'edit_data':{'index':1, 'url':'warranty/save_warranty/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_warranty_claim_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data":"title"},{"data": "priority"},{"data":"category"},{"data":"created_on"},{"data": "follow_up_date"},{"data":"classification"},{"data":"service_date"},{"data":"status"}],
							// 'default_order_by': [[1, 'desc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#Warranty_List').on( 'click', 'a.editor_remove', function (e) 
		{
		  var warranty_claim_id = $(this).attr('id');
		  delete_project({'ub_warranty_claim_id':{warranty_claim_id:warranty_claim_id}});
		}); 
	}