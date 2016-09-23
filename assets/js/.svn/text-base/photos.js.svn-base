imgLink = base_url + 'assets/images/'; 
$(function() {
	photos_list();
	update_add_album_form();
	$(document).on('click', '#upload_data', function(){	
			upload_data();
		setTimeout(function()
		{
			$('#UploadModal').modal('hide');
			location.reload();
		},1000);
		//photos_list();
	});
	
});

function photos_list() {
	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	var folderid = $("#folder_id").val();
	var module = 'photos';
	//block for back to folder
	var encoded_string = Base64.encode('photos/back_to_folder/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
	$.ajax({
            url: base_url + encoded_val,
            dataType: "json",
            type: "post",
            data: "folderid="+folderid,			
            success: function(response) {   
                if(response.status == true)
                {   
                    var func_url = 'photos/index';
					var encoded_url = Base64.encode(func_url + '/' + response.parent_folder_id + '/' + response.parent_project_id);
					var back_encoded_url = encoded_url.strtr(encode_chars_obj);
					$("a#back_to_folder").attr("href", base_url+back_encoded_url);
                }
            }
        });

	//block for zip download.
	var encoded_zip_url = Base64.encode('photos/get_folder_path/'+ folderid);
	var zip_encoded_url = encoded_zip_url.strtr(encode_chars_obj);
	$("a#zip_download").attr("href", base_url+zip_encoded_url);
	// return false;
	// Ajax URL
	var encoded_url = Base64.encode('photos/get_folder_details/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
						'tableName': $('#Photos'),
						'this_table' : {'table_name':'Photos'},
						'ajax_encoded_url':ajax_encoded_url,
						//'parent_id' : '{"folderid":"'+folderid+'"}',
						'folder_id' : 'folder_id',
						'project_id' : 'project_id',
						'post_data':'{"folderid":"'+folderid+'","module":"'+module+'"}',
						'display_columns' : [{"data": "Name"},{"data": "Name", "bSortable": false},{"data": "Photos", "bSortable": false},{"data": "Name", "bSortable": false},{"data": "LastUpdated"}],
						'default_order_by': [[4, 'desc']]
					};
	// Populate data table
	ubdatatable_docs(dbobject);
}
/* Block to create the new directory*/
$('#create_album').on('click',function(e) {
	var mandatory = $('#album_name').val();		

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
		$('.error-message .alerts').text('Album already exist.');
		return false;
    }
	else{
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-success');
		$('.error-message .alerts').text('Created succesfully');
		add_album();
		e.preventDefault();
	} 		
});
function add_album() {
	// Encode the String
	var folderid = $("#folder_id").val();
	var project_id = $("#project_id").val();
	var encoded_string = Base64.encode('photos/create_new_dir/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var ajaxData  = $("#add_album").serialize();
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",		
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
		data: ajaxData + '&folderid='+folderid + '&project_id='+project_id,
		success: function(response) {		
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				$("#TypeNewFolderModal").modal('hide');
				$("#album_name").val('');	
				photos_list();	
						
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
	var encoded_string = Base64.encode('photos/get_temp_filename/');
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
			if(response.status == true)
			{	
				window.location.href = role_index_url;
			}
		}
	});
}
function album_delete(album_id)
{
	var folderid = album_id;
	var encoded_string = Base64.encode('photos/delete_folder/');
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
			photos_list();
		}
	});
		}
	});

}

$(function(){
	$(document).on('click', '#Photos tr td a.edit_album_modal', function(){
		var docs_name = $(this).parent().parent().closest('tr').find('.doc_name').text();
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
	$(document).on('click', '#Photos tr td a.edit_album_modal', function(){
		var docs_id = $(this).parent().parent().closest('tr').find('.folder_id').val();
		$('#folderid').val(docs_id);

		if($(this).parent().parent().closest('tr').find('img').hasClass("folder_doc")){		
			$('.display_for_file').hide();	
		}
		else{
			$('.display_for_file').show();
		}	
	});
	$(document).on('click', '#Photos tr td a.edit_album_modal', function(){
		var file_id = $(this).parent().parent().closest('tr').find('.file_id').val();
		$('#fileid').val(file_id);
	});
	$(document).on('click', '#Photos tr td a.album_image', function(){
		var file_path = $(this).parent().parent().closest('tr').find('.file_path').val();
	$('#album-img').attr('src',default_file_path+file_path);
	});
	$(document).on('click', '#Photos tr td a.edit_album_modal', function(){
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
	var encoded_string = Base64.encode('photos/update_folder/');
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
                photos_list();
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



function update_add_album_form(){	
	var updateadd_albumform = $('#add_album').formValidation({
		framework: 'bootstrap',
		excluded: ':disabled',        
		button: {
            selector: '#create_album'			
        },
        fields: {
            'album_name': {
                validators: {
                    notEmpty: {
                        message: 'The album name cannot be empty'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  			
		    add_album();
			e.preventDefault();			 
	  });		  
}
//function for download file

	$(document).on('click', '#Photos tr td a.sys_file_name', function(){
		var sys_file_name = $(this).attr('title');
		var folderid = $("#folder_id").val();
		var encoded_string = Base64.encode('photos/download_file/');
		var encoded_val = encoded_string.strtr(encode_chars_obj);
		$.ajax({
			url: base_url + encoded_val,
			dataType: "json",
			type: "post",
			data: 'sys_file_name='+ sys_file_name + '&folderid='+folderid,			
			success: function(response) {		
				if(response.status == true)
				{	
					window.location.href = role_index_url;
				}
			}
		});
	});

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
        	photos_list();
        }
    });
		}
	});
}