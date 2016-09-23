/** 
 * Leads js
 * 
 * @package: Lead js
 * @subpackage: Lead js 
 * @category: Lead
 * @author: Satheesh kumar
 * @createdon(DD-MM-YYYY): 25-03-2015
*/

$(function() {
	 //update_result_form();	
	if (typeof list_page != 'undefined') {
		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");
        default_pagination_length = $('#list_iDisplayLength').val();
		displayStart = $('#list_iDisplayStart').val();
		lead_list();
	}	
	$(document).on( 'shown.bs.tab', 'a[href="#Activity-View"]', function () {
		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");
        default_pagination_length = $('#activity_iDisplayLength').val();
		displayStart = $('#activity_iDisplayStart').val();

		lead_activity_table();
	});
	$('#update_result').click(function(e){
		lead_list();
		lead_activity_table();
		$('.error-message').hide();
		e.preventDefault();
	 });
	$('#add_lead_new_stay').on('click',function() {
		$("#save_type").val('save_and_stay');
		add_formval();	
		e.preventDefault(); 
	});
	$('#add_lead_new').click(function() {
		$("#save_type").val('save_and_new');
		add_formval();	
		e.preventDefault(); 
	});
	$('#add_lead_new_back').click(function() {
		$("#save_type").val('save_and_back');
		add_formval();	
		e.preventDefault(); 
	});		
	
// MOHAN Added this code
// view->activity tab -> data table
	imgLink = base_url + 'assets/images/'; 
    
});	
function lead_list(calltype) {
		var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
		var status = $('#lead_status').val();
		var sales_person = $('#lead_sales_person').val();
		var tags = $('#lead_tags').val();
		var source = $('#lead_source').val();
		var project_type = $('#lead_project_type').val();
		var age = $('#lead_age').val();
		var name = $('#name').val();
	
		// return false;
		// Ajax URL
		var encoded_url = Base64.encode('leads/get_leads/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var datatable_grid_id = $('#datatable_grid_id').val();
		// Data table Object	
		var display_column = datatable_column;
		// Data table Object
		var class_name_index = typeof display_column[0]['className'] == 'undefined' ? 'not_set' : 'set';	
		if(class_name_index=="not_set")
		{
			display_column.unshift({"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_lead_id', "defaultContent": '<input type="checkbox" class="chk" />'});
		}	
		var dbobject = {
			'tableName': $('#Lead_list'),
			'ajax_encoded_url':ajax_encoded_url,
			'id':'ub_lead_id',
			'name' : 'name',
			'post_data':'{"fetch_type":"'+fetch_type+'","status":"'+status+'","tags":"'+tags+'","sales_person":"'+sales_person+'","source":"'+source+'","project_type":"'+project_type+'","age":"'+age+'","name":"'+name+'","datatable_grid_id":"'+datatable_grid_id+'"}',
			'delete_data':{'index':0}, 
			'edit_data':{'index':1, 'url':'leads/save_lead/'},
			'display_columns' : display_column
			//'default_order_by': [[6, 'desc']]
		};	
		
/* {className:"da-tab-checkbox", orderable:false, data:"ub_lead_id", defaultContent:"<input type=\"checkbox\" class=\"chk\" />"}, {data:"name"}, {data:"status"}, {data:"created_on"}, {data:"confidence_level"}, {data:"estimated_revenue_max"}, {data:"project_type"	 */
		//alert(dbobject.display_columns.toSource());				
		// Populate data table
		ubdatatable(dbobject);
		$('#Lead_list').on( 'click', 'a.editor_remove', function (e) {
		  var lead_id = $(this).attr('id');
		  delete_role({'ub_lead_id':{lead_id:lead_id}});
		});
	}
	function lead_activity_table() {
        var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
		var sales_person = $('#lead_sales_person').val();
		var name = $('#name').val();
	
		// return false;
		// Ajax URL
		var encoded_url = Base64.encode('leads/get_activity/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);	
		var dbobject = {
			'tableName': $('#lead_activity_view'),
			'this_table' : {'table_name':'lead_activity_view'},
			'ajax_encoded_url':ajax_encoded_url,
			'parent_id':'lead_id',
			'id':'ub_lead_activity_id',
			'name' : 'activity_type',
			'post_data':'{"fetch_type":"'+fetch_type+'","name":"'+name+'","sales_person":"'+sales_person+'"}',
			'delete_data':{'index':0}, 
			'edit_data':{'index':1, 'url':'leads/save_lead/'},
			'display_columns' : [{"className": 'da-tab-checkbox hide',"orderable": false,"data": 'ub_lead_activity_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "activity_type"},{"data": "first_name"},{"data": "name"},{"data": "activity_date"},{"data": "followup_date"},{"data": "modified_on"}],
			'default_order_by': [[6, 'desc']]
		};
		
		// Populate data table
		ubdatatable(dbobject);
		$('#lead_activity_view').on( 'click', 'a.editor_remove', function (e) {
		  var lead_id = $(this).attr('id');
		  delete_role({'ub_lead_activity_id':{lead_activity_id:lead_activity_id}});
		});
    }
// Export result set to file
	$('#export_file').on('click', function() { 
	 var form1 = $('#Search_Result');
	if(datatable_getrowcount('#Lead_list') >0 ){
	var encoded_url = Base64.encode('leads/get_leads/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var submit_url = base_url + ajax_encoded_url;		
		 $(form1).attr('action', submit_url).submit();
		}else{
			
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
		}
	});

// lead search
$('#lead_search_reset').on('click', function(e) {	
	reset_function();
	e.preventDefault();
});

// save filter
$('#save_filter').on('click', function(e) {
	var lead_status = $('#lead_status').val();
	var lead_sales_person = $('#lead_sales_person').val();
	var lead_age = $('#lead_age').val();
	var lead_tags = $('#lead_tags').val();
	var lead_source = $('#lead_source').val();
	var lead_project_type = $('#lead_project_type').val();
	var name = $('#name').val();
	if((!lead_status) && (!lead_sales_person) && (!lead_age) && (!lead_age) && (!lead_tags) && (!lead_source) && (!lead_project_type) && (!name)){
		error_box();
		$('.error-message .alerts').text('Please select one mandatory field');
		return false;		
	}
	else{
		save_filter_function();
		e.preventDefault();
	}
});


//Apply Filter
$('#apply_save_filter').on('click',function(e) {	
	apply_save_filter_function();
	e.preventDefault();	
});

function apply_save_filter_function(){
	var encoded_url = Base64.encode('leads/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('leads/index/');
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
}
function save_filter_function(){
	var status = $('#lead_status').val();
	var sales_person = $('#lead_sales_person').val();
	var tags = $('#lead_tags').val();
	var source = $('#lead_source').val();
	var project_type = $('#lead_project_type').val();
	var age = $('#lead_age').val();
	var name = $('#name').val();
	var encoded_url = Base64.encode('leads/get_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);	
	var data = 'status='+status+'&sales_person='+sales_person+'&tags='+tags+'&source='+source+'&project_type='+project_type+'&age='+age+'&name='+name;
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

function reset_function(){
	var encoded_destroy_session = Base64.encode('leads/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var lead_index = Base64.encode('leads/index/');
	var lead_index_url = lead_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"LEADS","destroy_type":["SEARCH"]},
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');
        },		
		success: function(response) {		
     		$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = lead_index_url;				
				success_box();
				$('.error-message .alerts').text('reset successfully');
			}
			else{
				error_box();
				$('.error-message .alerts').text('reset failed');
			}
		}
	});
}


function add_formval() {
    // Encode the String
    var encoded_string = Base64.encode('leads/save_lead/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('leads/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    
    var ajaxData  = $("#add_new_lead").serialize();
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {           
            if(response.status == true)
            {   
                if($("#save_type").val() == 'save_and_new')
                {
                    window.location.href = encoded_val;
                }
                else if($("#save_type").val() == 'save_and_back')
                {
                    window.location.href = encoded_home_val;
                }
                else if($("#save_type").val() == 'save_and_stay')
                {
                    
                    var encoded_string_edit_log = Base64.encode( 'leads/save_lead/' + response.insert_id);
                    var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                    //console.log(encoded_edit_val);
                    window.location.href = encoded_edit_val;
                    // console.log(response.insert_id);
                }
                $(".error-message .alert").removeClass('alert-danger');
                $(".error-message .alert").addClass('alert-success');
                $(".error-message").show();
                if(response.message)
                {
                    success_msg = response.message;
                }
                $(".alert").html(success_msg);
            }
            else
            {   
                $(".error-message .alert").removeClass('alert-success');
                $(".error-message .alert").addClass('alert-danger');        
                $(".error-message").show();
                if(response.message)
                {
                    failure_msg = response.message;
                }   
                $(".alert").html(failure_msg);              
            }
            return false;
        }
    }); 
}

function SearchForm() {
	// Encode the String
	var status = $('#lead_status').val();
	var encoded_string = Base64.encode('leads/get_leads/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('roles/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	
	var ajaxData  = $("#Lead_list").serialize();	
	
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,			
		success: function(response) {	
			
			if(response.status == true)
			{	
		
				if(response.message)
				{
					success_msg = response.message;	
					$('#Lead_list').dataTable({
						destroy: true,
						"fnRowCallback": function(nRow, adata, iDisplayIndex, iDisplayIndexFull) {              			
						$('td:eq(5)', nRow).html('<a href="'+base_url+'bgxf1VhZHMvZWRpdF9sZWFkcy8-">'+'<span class="glyphicon glyphicon-pencil"></span>'+'</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);">'+'<span class="glyphicon glyphicon-trash"></span>'+'</a>');	$('td:eq(0)', nRow).html('<input type="checkbox" value="'+ data.ub_role_id +'" class="chk" />');						 					
						return nRow;				
						},
						"columns": [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_role_id', "defaultContent": '<input type="checkbox" class="chk"/>'},{"data": "role_name"},{"data": "role_active"},{"data": "created_on"},{"data": "modified_on"},{"className": 'edit',"orderable": false,"data": null,"defaultContent": ''}],						
						aaData: response.data					
					});								
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

// Multi delete
function delete_multi_checked_leads(ub_lead_id){
	var encoded_delete_roles = Base64.encode('leads/delete_leads/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('leads/index/');
	var index_url = index_string.strtr(encode_chars_obj);
	//alert(ub_task_id);return false;
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:ub_lead_id,
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

function delete_all_checked_leads(val)
{
	if(val == 'delete_multi_leads')
	{
		ub_lead_id = multi_leads_checked_list();
			if(ub_lead_id != false)
			{
				var conf = $('#confirmModal').modal('show');
				$('#delete_confirm').click(function(){
					var conf = true;
					if(conf == true){
						$('#confirmModal').modal('hide');
						delete_multi_checked_leads({ub_lead_id:ub_lead_id})
					 }
				});
			}
			else
			{
				return ub_lead_id;
			}
	}
	else
	{
		//alert('Please select tasks');
		return false;
	}
}
function multi_leads_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	//alert(delete_obj.toSource());
	if($.isEmptyObject(delete_obj)){
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select Leads');
		return false;
	}
	else{
		return delete_obj;
	}
}
$(function() {      
		$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function(e) {
			$('#calendar').fullCalendar('render');		
		}); 
});

/* Lead index Form Validation */
/*function update_result_form(){		
	var updateresultform = $('#Search_Result').find('[name="lead_status"], [name="lead_sales_person"], [name="lead_age"], [name="lead_tags"], [name="lead_source"], [name="lead_project_type"], [name="name"]').selectpicker().change(function(e) {            
                $('#Search_Result').formValidation('revalidateField', 'lead_status, lead_sales_person, lead_age, lead_tags, lead_source, lead_project_type, name');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',  
		 button: {
            selector: '#update_result, #lead_search_reset, #save_filter',          
        },
        fields: {
            'lead_status': {
                validators: {
                    notEmpty: {
                        message: 'The lead status cannot be empty'
                    }
                }
            },
			'lead_sales_person': {
                validators: {
                    notEmpty: {
                        message: 'The lead sales person cannot be empty'
                    }
                }
            },
			'lead_age': {
                validators: {
                    notEmpty: {
                        message: 'The lead age cannot be empty'
                    }
                }
            },
			'lead_tags': {
                validators: {
                    notEmpty: {
                        message: 'The lead tags cannot be empty'
                    }
                }
            },
			'lead_source': {
                validators: {
                    notEmpty: {
                        message: 'The lead source cannot be empty'
                    }
                }
            },
			'lead_project_type': {
                validators: {
                    notEmpty: {
                        message: 'The lead project type cannot be empty'
                    }
                }
            },
			'name': {
                validators: {
                    notEmpty: {
                        message: 'The name cannot be empty'
                    }
                }
            }
        }
		
    }).on('keyup, change', '[name="lead_status"], [name="lead_sales_person"], [name="lead_age"], [name="lead_tags"], [name="lead_source"], [name="lead_project_type"], [name="name"]', function(e) {
	var lead_status 		= $('#Search_Result').find('[name="lead_status"]').val(),
		lead_sales_person   = $('#Search_Result').find('[name="lead_sales_person"]').val(),
		lead_age           	= $('#Search_Result').find('[name="lead_age"]').val(),
		lead_tags           = $('#Search_Result').find('[name="lead_tags"]').val(),
		lead_source         = $('#Search_Result').find('[name="lead_source"]').val(),
		lead_project_type   = $('#Search_Result').find('[name="lead_project_type"]').val(),
		name           		= $('#Search_Result').find('[name="name"]').val(),                
		fv            		= $('#Search_Result').data('formValidation');

	switch ($(this).attr('name')) {               
		case 'lead_status':
			fv.enableFieldValidators('lead_sales_person', lead_status === '').revalidateField('lead_sales_person');                    
			fv.enableFieldValidators('lead_age', lead_status === '').revalidateField('lead_age');                    
			fv.enableFieldValidators('lead_tags', lead_status === '').revalidateField('lead_tags');                    
			fv.enableFieldValidators('lead_source', lead_status === '').revalidateField('lead_source');                    
			fv.enableFieldValidators('lead_project_type', lead_status === '').revalidateField('lead_project_type');                    
			fv.enableFieldValidators('name', lead_status === '').revalidateField('name'); 
			
			if (lead_status && fv.getOptions('lead_status', null, 'enabled') === false) {
				fv.enableFieldValidators('lead_status', true).revalidateField('lead_status');
			} 
			else if (lead_status === '' && lead_sales_person !== '' && lead_age !== '' && lead_tags !== '' && lead_source !== '' && lead_project_type !== '' && name !== '') {
				fv.enableFieldValidators('lead_status', false).revalidateField('lead_status');
			}					
			break;
	   
		case 'lead_sales_person':			
			fv.enableFieldValidators('lead_status', lead_sales_person === '').revalidateField('lead_status');                    
			fv.enableFieldValidators('lead_age', lead_sales_person === '').revalidateField('lead_age');                    
			fv.enableFieldValidators('lead_tags', lead_sales_person === '').revalidateField('lead_tags');                    
			fv.enableFieldValidators('lead_source', lead_sales_person === '').revalidateField('lead_source');                    
			fv.enableFieldValidators('lead_project_type', lead_sales_person === '').revalidateField('lead_project_type');                    
			fv.enableFieldValidators('name', lead_sales_person === '').revalidateField('name');

			if (lead_sales_person && fv.getOptions('lead_sales_person', null, 'enabled') === false) {
				fv.enableFieldValidators('lead_sales_person', true).revalidateField('lead_sales_person');
			} 
			else if (lead_sales_person === '' && lead_status !== '' && lead_age !== '' && lead_tags !== '' && lead_source !== '' && lead_project_type !== '' && name !== '') {
				fv.enableFieldValidators('lead_sales_person', false).revalidateField('lead_sales_person');
			}					
			break;
			
		case 'lead_age':
			fv.enableFieldValidators('lead_status', lead_age === '').revalidateField('lead_status');                    
			fv.enableFieldValidators('lead_sales_person', lead_age === '').revalidateField('lead_sales_person');                    
			fv.enableFieldValidators('lead_tags', lead_age === '').revalidateField('lead_tags');                    
			fv.enableFieldValidators('lead_source', lead_age === '').revalidateField('lead_source');                    
			fv.enableFieldValidators('lead_project_type', lead_age === '').revalidateField('lead_project_type');                    
			fv.enableFieldValidators('name', lead_age === '').revalidateField('name');

			if (lead_age && fv.getOptions('lead_age', null, 'enabled') === false) {
				fv.enableFieldValidators('lead_age', true).revalidateField('lead_age');
			} 
			else if (lead_age === '' && lead_status !== '' && lead_sales_person !== '' && lead_tags !== '' && lead_source !== '' && lead_project_type !== '' && name !== '') {
				fv.enableFieldValidators('lead_age', false).revalidateField('lead_age');
			}					
			break;					
		 
		case 'lead_tags':					
			fv.enableFieldValidators('lead_status', lead_tags === '').revalidateField('lead_status');                    
			fv.enableFieldValidators('lead_sales_person', lead_tags === '').revalidateField('lead_sales_person');                    
			fv.enableFieldValidators('lead_age', lead_tags === '').revalidateField('lead_age');                    
			fv.enableFieldValidators('lead_source', lead_tags === '').revalidateField('lead_source');                    
			fv.enableFieldValidators('lead_project_type', lead_tags === '').revalidateField('lead_project_type');                    
			fv.enableFieldValidators('name', lead_tags === '').revalidateField('name');

			if (lead_tags && fv.getOptions('lead_tags', null, 'enabled') === false) {
				fv.enableFieldValidators('lead_tags', true).revalidateField('lead_tags');
			} 
			else if (lead_tags === '' && lead_status !== '' && lead_sales_person !== '' && lead_age !== '' && lead_source !== '' && lead_project_type !== '' && name !== '') {
				fv.enableFieldValidators('lead_tags', false).revalidateField('lead_tags');
			}					
			break;
			
		case 'lead_source':					
			fv.enableFieldValidators('lead_status', lead_source === '').revalidateField('lead_status');                    
			fv.enableFieldValidators('lead_sales_person', lead_source === '').revalidateField('lead_sales_person');                    
			fv.enableFieldValidators('lead_age', lead_source === '').revalidateField('lead_age');                    
			fv.enableFieldValidators('lead_tags', lead_source === '').revalidateField('lead_tags');                    
			fv.enableFieldValidators('lead_project_type', lead_source === '').revalidateField('lead_project_type');                    
			fv.enableFieldValidators('name', lead_source === '').revalidateField('name');

			if (lead_source && fv.getOptions('lead_source', null, 'enabled') === false) {
				fv.enableFieldValidators('lead_source', true).revalidateField('lead_source');
			} 
			else if (lead_source === '' && lead_status !== '' && lead_sales_person !== '' && lead_age !== '' && lead_tags !== '' && lead_project_type !== '' && name !== '') {
				fv.enableFieldValidators('lead_source', false).revalidateField('lead_source');
			}					
			break;
		
		case 'lead_project_type':			
			fv.enableFieldValidators('lead_status', lead_project_type === '').revalidateField('lead_status');                    
			fv.enableFieldValidators('lead_sales_person', lead_project_type === '').revalidateField('lead_sales_person');                    
			fv.enableFieldValidators('lead_age', lead_project_type === '').revalidateField('lead_age');                    
			fv.enableFieldValidators('lead_tags', lead_project_type === '').revalidateField('lead_tags');                    
			fv.enableFieldValidators('lead_source', lead_project_type === '').revalidateField('lead_source');                    
			fv.enableFieldValidators('name', lead_project_type === '').revalidateField('name');

			if (lead_project_type && fv.getOptions('lead_project_type', null, 'enabled') === false) {
				fv.enableFieldValidators('lead_project_type', true).revalidateField('lead_project_type');
			} 
			else if (lead_project_type === '' && lead_status !== '' && lead_sales_person !== '' && lead_age !== '' && lead_tags !== '' && lead_source !== '' && name !== '') {
				fv.enableFieldValidators('lead_project_type', false).revalidateField('lead_project_type');
			}					
			break;
			
		case 'name':			
			fv.enableFieldValidators('lead_status', name === '').revalidateField('lead_status');                    
			fv.enableFieldValidators('lead_sales_person', name === '').revalidateField('lead_sales_person');                    
			fv.enableFieldValidators('lead_age', name === '').revalidateField('lead_age');                    
			fv.enableFieldValidators('lead_tags', name === '').revalidateField('lead_tags');                    
			fv.enableFieldValidators('lead_source', name === '').revalidateField('lead_source');                    
			fv.enableFieldValidators('lead_project_type', name === '').revalidateField('lead_project_type');

			if (name && fv.getOptions('name', null, 'enabled') === false) {
				fv.enableFieldValidators('name', true).revalidateField('name');
			} 
			else if (name === '' && lead_status !== '' && lead_sales_person !== '' && lead_age !== '' && lead_tags !== '' && lead_source !== '' && lead_project_type !== '') {
				fv.enableFieldValidators('name', false).revalidateField('name');
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
		  success_box();
			 if($("#lead_index").val() == 'update_result'){
				lead_list();
				lead_activity_table(); 
			 }
			 else if($("#lead_index").val() == 'lead_search_reset'){
				 reset_function();
			 }	
			else if($("#lead_index").val() == 'save_filter'){
				 save_filter_function();
			 }						 
			e.preventDefault();
	  });		
}*/
/* /Lead index Form Validation */
