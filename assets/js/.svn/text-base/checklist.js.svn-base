$(function() {
 //update_result_form();

if (typeof list_page != 'undefined') {
		check_list();
	}
//Update result

//Data table code
$('#update_result').click(function(e){				
	 $("#checklist_index").val('update_result');
	 check_list();
	 e.preventDefault();
	});
});


//Reset function

$('#check_list_search_reset').on('click', function(e) {	
	reset_function();
	e.preventDefault();
});	
function reset_function(){
	var encoded_destroy_session = Base64.encode('checklist/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('checklist/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"CHECKLIST","destroy_type":["SEARCH"]},
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
// Export result set to file
	$('#export_file').on('click', function() { 
		var form1 = $('#Search_Result'), 
		form2 = $('#Search_Result_export'); 
		$(form2).val(function(){
			return $(form1).val();
		});
	if(datatable_getrowcount('#Check_List_table') >0 ){
	var encoded_url = Base64.encode('checklist/get_checklist/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var submit_url = base_url + ajax_encoded_url;
		$(form2).attr('action', submit_url).submit();
		}else{
			// alert('Sorry! No records found for export');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
		}
	});

function checkbox() {
    $('input[type=checkbox]').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event) {}).iCheck({
        checkboxClass: 'icheckbox_square-red',
        radioClass: 'iradio_square-red',
        increaseArea: '20%'
    });
	 $('input[type=radio]').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event) {}).iCheck({   radioClass: 'iradio_square-red',
        increaseArea: '20%'
    });
}
function checkedAll(){
	$(document).on('ifChecked','#selectall', function(event){
		$('.da-tab-checkbox input').attr('checked', this.checked);		
	});	
	$(document).on('ifChecked','.da-tab-checkbox input', function(event){
		$(this).closest('.icheckbox_square-red').addClass('checked');		
		$(this).attr("checked", "checked");	
	});	
	
	$(document).on('ifUnchecked','#selectall', function(event){			
		$('.da-tab-checkbox input').removeAttr('checked');			
	});
	$(document).on('ifUnchecked','.da-tab-checkbox input', function(event){
		$(this).closest('.icheckbox_square-red').removeClass('checked');		
		$(this).removeAttr("checked", "checked");
	});
}
function allcheck(){	
		$(document).on('ifChecked','#selectall', function(event){			
			$('.da-tab-checkbox .icheckbox_square-red').addClass('checked');
			$('.da-tab-checkbox input').attr('checked', this.checked);		
		});
		$(document).on('ifUnchecked','#selectall', function(event){	
			$('.da-tab-checkbox .icheckbox_square-red').removeClass('checked');		
			$('.da-tab-checkbox input').removeAttr('checked');			
		});
		if ($('input[name="all"]').is(':checked') ) {			
			$('.da-tab-checkbox .icheckbox_square-red').addClass('checked');
			$("#selectall .da-tab-checkbox input").attr("checked", "checked");				
		} 
		else {
			$('.da-tab-checkbox .icheckbox_square-red').removeClass('checked');
			$("#selectall .da-tab-checkbox input").removeAttr("checked");			
		}
}

// Save filter
$('#save_filter').on('click', function(e) {
	$("#checklist_index").val('save_filter');
	var project_id = $('#project').val();
	var tags = $('#tagType').val();
	var category = $('#categoryType').val();

	if((!project_id) && (!tags) && (!category)){		
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
	var project_id = $('#project').val();
	var tags = $('#tagType').val();
	var category = $('#categoryType').val();
	
	var encoded_url = Base64.encode('checklist/apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'project_id='+project_id+'&tags='+tags+'&category='+category;
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
				//$("#comments_area").load(location.href + " #comments_area");
				$("#apply_save_filter").show();
				success_box();
				$('.error-message .alerts').text('Saved successfully');	
				
			}
			else{
				error_box();
				$('.error-message .alerts').text('Saved failed');	
			}
		}
	});
}
//Apply Filter
$('#apply_save_filter').on('click',function() {
		var encoded_url = Base64.encode('checklist/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('checklist/index/');
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
				$('.error-message .alerts').text('Applied filter failed');
			}
		}
	});	
		//$.post(baseurl+ajax_encoded_url,'POST',function(res) {
			
		});
//Multi delete
//Multi delete

function delete_multi_checked_check_lists(ub_checklist_id){
	var encoded_delete_roles = Base64.encode('checklist/delete_checklist/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('checklist/index/');
	var index_url = index_string.strtr(encode_chars_obj);
	//alert(ub_task_id);return false;
	$.ajax({
			type:'POST',
			url: base_url + encoded_delete_val,
			dataType: 'json',
			data:ub_checklist_id,
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

function delete_all_checked_checklist(val)
{
	if(val == 'delete_multi_check_list')
	{
		ub_checklist_id = multi_checklist_checked_list();
			if(ub_checklist_id != false)
			{
				var conf = $('#confirmModal').modal('show');
				$('#delete_confirm').click(function(){
					var conf = true;
					if(conf == true){
						delete_multi_checked_check_lists({ub_checklist_id:ub_checklist_id})
					}
				});
			}
			else
			{
				return ub_checklist_id;
			}
	}
	else
	{
		//alert('Please select tasks');
		return false;
	}
}

function multi_checklist_checked_list(){
	var delete_obj = {};
	$(".checked input.chk:checked").each(function() {
		delete_obj[$(this).val()] = $(this).val();
	});
	//alert(delete_obj.toSource());
	if($.isEmptyObject(delete_obj)){		
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select Checklist');
		return false;
	}
	else{
		return delete_obj;
	}
}

/* function update_result_form(){	
	var updateresultform = $('#Search_Result').find('[name="project_id, tags[], category[]"]').selectpicker().change(function(e) {            
                $('#Search_Result').formValidation('revalidateField', 'project_id');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #save_filter'			
        },
        fields: {
            'project_id': {
                validators: {
                    notEmpty: {
                        message: 'Please select the project name'
                    }
                }
            },
			'tags[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select the project tags'
                    }
                }
            },
			'category[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select the project category'
                    }
                }
            }
        }	
		
    }).on('keyup change', '[name="project_id"], [name="tags[]"], [name="category[]"]', function(e) {
            var tags = $('#Search_Result').find('[name="tags[]"]').val(),
                project_id    = $('#Search_Result').find('[name="project_id"]').val(),
                category           = $('#Search_Result').find('[name="category[]"]').val(),
                fv            = $('#Search_Result').data('formValidation');

            switch ($(this).attr('name')) {               
                case 'project_id':
                    fv.enableFieldValidators('tags[]', project_id === '').revalidateField('tags[]');
                    fv.enableFieldValidators('category[]', project_id === '').revalidateField('category[]');

                    if (project_id && fv.getOptions('project_id', null, 'enabled') === false) {
                        fv.enableFieldValidators('project_id', true).revalidateField('project_id');
                    } 
					else if (project_id === '' && tags !== '' && category !== '') {
                        fv.enableFieldValidators('project_id', false).revalidateField('project_id');
                    }					
                    break;
               
                case 'tags[]':
                    fv.enableFieldValidators('project_id', tags === '').revalidateField('project_id');
                    fv.enableFieldValidators('category[]', tags === '').revalidateField('category[]');

                    if (tags && fv.getOptions('tags[]', null, 'enabled') === false) {
                        fv.enableFieldValidators('tags[]', true).revalidateField('tags[]');
                    } 
					else if (tags === '' && project_id !== '' && category !== '') {
                        fv.enableFieldValidators('tags[]', false).revalidateField('tags[]');
                    }					
                    break;
					
				case 'category[]':
                    fv.enableFieldValidators('tags[]', category === '').revalidateField('tags[]');
                    fv.enableFieldValidators('project_id', category === '').revalidateField('project_id');

                    if (category && fv.getOptions('category[]', null, 'enabled') === false) {
                        fv.enableFieldValidators('category[]', true).revalidateField('category[]');
                    } 
					else if (category === '' && tags !== '' && project_id !== '') {
                        fv.enableFieldValidators('category[]', false).revalidateField('category[]');
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
			 if($("#checklist_index").val() == 'update_result'){
				success_box();
				check_list();				
			 }			
			else if($("#checklist_index").val() == 'save_filter'){
				success_box();
				save_filter_function();				
			}
			e.preventDefault();			 
	  });		
} */
function check_list(calltype) {
		// Ajax URL
		calltype = typeof calltype !== 'undefined' ? calltype : 'list';
		var fetch_type = calltype;
		var project = $('#project').val();
		var tagType = $('#tagType').val();
		var categoryType = $('#categoryType').val();
		var encoded_url = Base64.encode('checklist/get_checklist/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#Check_List_table'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_checklist_id',
							'name':'title',
							'post_data':'{"fetch_type":"'+fetch_type+'","project":"'+project+'","tagType":"'+tagType+'","categoryType":"'+categoryType+'"}',
							'delete_data':{'index':0}, 
							'edit_data':{'index':1, 'url':'checklist/save_checklist/'},
							'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_checklist_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data": "title"},{"data": "project_name"},{"data": "tags", "bSortable": false},{"data": "category"}],
							// 'default_order_by': [[1, 'asc']]
						};
						//alert(1234);
		//alert(dbobject);
		//alert(JSON.stringify(dbobject));
		// Populate data table
		ubdatatable(dbobject);
		$('#Check_List_table').on( 'click', 'a.editor_remove', function (e) {
		  var checklist_id = $(this).attr('id');
		  delete_task({'ub_checklist_id':{checklist_id:checklist_id}});
		});
	}