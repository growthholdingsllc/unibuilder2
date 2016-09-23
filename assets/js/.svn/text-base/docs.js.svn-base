imgLink = base_url + 'assets/images/'; 
$(function() {
	update_add_dir_form();
	docslist();
	$('.file_uploaded_div').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	});
	$(document).on('click', '#upload_data', function(){
		upload_data();
		setTimeout(function()
		{
			$('#UploadModal').modal('hide');
			location.reload();
		},1000);
		//location.reload();
	});
});

function docslist() {
	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	var folderid = $("#folder_id").val();
	var module = 'docs';
	//block for back to folder
	var encoded_string = Base64.encode('docs/back_to_folder/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
	$.ajax({
            url: base_url + encoded_val,
            dataType: "json",
            type: "post",
            data: "folderid="+folderid,			
            success: function(response) {   
                if(response.status == true)
                {   
                    var func_url = 'docs/index';
					var encoded_url = Base64.encode(func_url + '/' + response.parent_folder_id + '/' + response.parent_project_id);
					var back_encoded_url = encoded_url.strtr(encode_chars_obj);
					$("a#back_to_folder").attr("href", base_url+back_encoded_url);
                }
            }
        });
	//block for zip download.
	var encoded_zip_url = Base64.encode('docs/get_folder_path/'+ folderid);
	var zip_encoded_url = encoded_zip_url.strtr(encode_chars_obj);
	$("a#zip_download").attr("href", base_url+zip_encoded_url);
	// return false;
	// Ajax URL
	var encoded_url = Base64.encode('docs/get_folder_details/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
						'tableName': $('#Docs_List'),
						'this_table' : {'table_name':'Docs_List'},
						'ajax_encoded_url':ajax_encoded_url,
						//'parent_id' : '{"folderid":"'+folderid+'"}',
						'folder_id' : 'folder_id',
						'project_id' : 'project_id',
						'post_data':'{"folderid":"'+folderid+'","module":"'+module+'"}',
						'display_columns' : [{"data": "Name"},{"data": "Contains", "bSortable": false},{"data": "Contains",  "bSortable": false},{"data": "Name",  "bSortable": false},{"data": "LastUpdated"}],
						'default_order_by': [[4, 'desc']]
					};
	// Populate data table
	ubdatatable_docs(dbobject);
}

/* Block to create the new directory*/
$('#create_dir').on('click',function(e) {
	var mandatory = $('#folder_name').val();

	// code to validate the directory name start.
	var values = new Object() // creates a new instance of an object
	$('.doc_name').each(function() {
	    values[$(this).attr('name')] = $(this).val()
	})
    var output = ""
	for (property in values) {
	  output += property + ',' + values[property];
	}
	var data = output.substring(0, output.length - 1);
	var array = data.split(',');
	// code to validate the directory name end.

	if(mandatory == ''){			
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-success');
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-danger');
		$('.error-message .alerts').text('Please fill all mandatory fields');
		return false;					
	}
	if ($.inArray(mandatory, array) > -1)
    {
        $('.error-message').show();
		$('.error-message .alerts').removeClass('alert-success');
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-danger');
		$('.error-message .alerts').text('Directory already exist.');
		return false;
    }
	else{
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-success');
		$('.error-message .alerts').text('Created succesfully');
		add_dir();
		e.preventDefault();
	} 		
});
function add_dir() {
	// Encode the String
	var folderid = $("#folder_id").val();
	var project_id = $("#project_id").val();
	var encoded_string = Base64.encode('docs/create_new_dir/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);

	var encoded_home_string = Base64.encode('docs/index/'+ folderid);
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var ajaxData  = $("#add_dir").serialize();
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData + '&folderid='+folderid + '&project_id='+project_id,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				$("#TypeNewFolderModal").modal('hide');
				$("#folder_name").val('');
				docslist();
				setTimeout(function(){
					$('.error-message').hide();
				}, 500);
			}
			else
			{	
				alert('error');				
			}
			return false;
		}
	});	
}

/* Block to move the file from temp to actual location*/

function upload_data()
{
	
	var temp_directory_id = $("#temp_directory_id").val();
	var folderid = $("#folder_id").val();
	var encoded_string = Base64.encode('docs/get_temp_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },						
		success: function(response) {
				
		}
	});
}

function docs_delete(docs_id)
{
	var folderid = docs_id;
	var encoded_string = Base64.encode('docs/delete_folder/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var conf = $('#confirmModal').modal('show');
	$('#delete_confirm').click(function(){
		var conf = true;
		if(conf == true){
			$('#confirmModal').modal('hide');
		$.ajax({
			url: base_url + encoded_val,
			dataType: "json",
			type: "post",
			data: 'folderid='+folderid,			
			success: function(response) {		
				docslist();
			}
		});
		}
	});
	$('#cancel_confirm').click(function(){
		folderid = 0;
	});

}
$(function(){
	$(document).on('click', '#Docs_List tr td a.edit_move_docs', function(){
		var docs_name = $(this).parent().parent().closest('tr').find('.doc_name').text();
		var docs_name = docs_name.trim();
		$('#change_folder_name').val(docs_name);
		
		var owner_access = $(this).parent().parent().closest('tr').find('.view_access .check_owner');
		var sub_access = $(this).parent().parent().closest('tr').find('.view_access .check_sub');
	
		if(owner_access.length == 1){
			$('#owner_per').iCheck('check');
		}
		else{
			$('#owner_per').iCheck('uncheck');
		}
		if(sub_access.length == 1){
			$('#sub_per').iCheck('check');
		}
		else{
			$('#sub_per').iCheck('uncheck');
		}	
		
		
	});
	$(document).on('click', '#Docs_List tr td a.edit_move_docs', function(){
		var docs_id = $(this).parent().parent().closest('tr').find('.folder_id').val();
		$('#folderid').val(docs_id);		
		if($(this).parent().parent().closest('tr').find('.folder img').hasClass("folder_doc")){		
			$('.display_for_file').hide();	
		}
		else{
			$('.display_for_file').show();
		}		
	});
	$(document).on('click', '#Docs_List tr td a.edit_move_docs', function(){
		var file_id = $(this).parent().parent().closest('tr').find('.file_id').val();
		$('#fileid').val(file_id);
	});
	$(document).on('click', '#Docs_List tr td a.edit_move_docs', function(){
		$(".error-message .alerts").removeClass('alert-success');
		$(".error-message .alerts").removeClass('alert-danger');
		$(".alerts").html('');
	});
	
	$(document).on('ifChecked','#owner_per', function(){
		$(this).prop('checked', true);
		$(this).val('Yes');
		$(this).parent().find('.icheckbox_square-red').addClass('checked');
	});
	$(document).on('ifUnchecked','#owner_per', function(){
		$(this).prop('checked', false);
		$(this).val('No');
		$(this).parent().find('.icheckbox_square-red').removeClass('checked');
	});
	$(document).on('ifChecked','#sub_per', function(){
		$(this).prop('checked', true);
		$(this).val('Yes');
		$(this).parent().find('.icheckbox_square-red').addClass('checked');
	});
	$(document).on('ifUnchecked','#sub_per', function(){
		$(this).prop('checked', false);
		$(this).val('No');
		$(this).parent().find('.icheckbox_square-red').removeClass('checked');
	});
});

$('#update_folder').on('click',function() {
 		update_permission();
});
function update_permission() {
	// Encode the String
	var folderid = $("#folder_id").val();
	var encoded_string = Base64.encode('docs/update_folder/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);	
	
	var ajaxData  = $("#update_folder_permission").serialize();
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData + '&folder_id='+folderid,	

		success: function(response) {
			if(response.messagestatus == "1")
			{	
				
				$(".error-message .alerts").removeClass('alert-danger');
                $(".error-message .alerts").addClass('alert-success');
                $(".error-message").show();
                if(response.message)
                {
                    success_msg = response.message;
                }
                $(".alerts").html(success_msg);
                docslist();
			}
			else
			{	
				$(".error-message .alerts").removeClass('alert-success');
                $(".error-message .alerts").addClass('alert-danger');        
                $(".error-message").show();
                if(response.message)
                {
                    failure_msg = response.message;
                }   
                $(".alerts").html(failure_msg);				
			}
			return false;
		}
	});	
}
/*$('#close_permission').on('click',function() {
 	docslist();
});*/

function update_add_dir_form(){	
	var updateadd_dirform = $('#add_dir').formValidation({
		framework: 'bootstrap',
		excluded: ':disabled',        
		button: {
            selector: '#create_dir'			
        },
        fields: {
            'folder_name': {
                validators: {
                    notEmpty: {
                        message: 'The folder name cannot be empty'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  			
		    add_dir();
			e.preventDefault();			 
	  });		  
}

function delete_file(file_id)
{
    var fileid = file_id;
    var encoded_string = Base64.encode('docs/delete_file/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
	var conf = $('#confirmModal').modal('show');
	$('#delete_confirm').click(function(){
		var conf = true;
		if(conf == true){
			$('#confirmModal').modal('hide');
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: 'fileid='+fileid,         
        success: function(response) { 
        docslist(); 
        }
    });
		}
	});
}
