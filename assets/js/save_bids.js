//checking project status -- code added by satheesh kumar
$(function() {
	$('.date').on("dp.show", function(e) {		
		var top  = $(this).offset().top + $(this).outerHeight();
		var left = $(this).offset().left;		
		var ele = $(e.target).data('DateTimePicker');
		if (ele.widget.position().left > 0) {					 		 			
			$(ele.widget).css({
				'top' : top,
				'left': left+'px !important',
				'bottom':'auto'
			});		 
		}			 
	});
	
	var ub_bid_request_id = $('#ub_bid_request_id').val();   
	if(ub_bid_request_id != '' || ub_bid_request_id > 0)
	{
		if(project_status_check == false)
		{
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Project was '+project_status+'. You can not able to edit');
		//alert('you can not edit');
		}
	}
	/* checking project status code ends here*/
});

$(function(){
    CKEDITOR.replace( 'sub_notes', {
    toolbar : [
    [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat']
    ]
   });
   var inputs = $(".varian");
                inputs.keyup(function(){					
                    var total = 0;
                    $.each(inputs, function(input){
                        var num = parseInt(inputs[input].value);
                        total += (!isNaN(num))? num : 0;
						$(this).parent().removeClass('has-error');
                    });
			if(inputs == ''){
				$(this).parent().addClass('has-error');				
			}
			else{
				$(this).parent().removeClass('has-error');	
				$(this).next('span').text('');				
			}
            $("#total").html(total);
            $("#bid_amount").val(total);
	}); 
	/* $(".varian").on('keyup', function(){
		 var total = 0;
		 var inputs = $(this);
		  inputs.val( inputs.val().replace(/[^0-9\.]/g, function(){return ''; }) );
		 $.each(inputs, function(input){
                        var num = parseInt(inputs[input].value);
                        total += (!isNaN(num))? num : 0;	
			if(inputs == ''){
				$(this).parent().addClass('has-error');				
			}
			else{
				$(this).parent().removeClass('has-error');	
				$(this).next('span').text('');				
			}						
            });
			
			$("#total").html(total);
            $("#bid_amount").val(total);
	}); */
});
//Add and back
/* $('#add_task_new_back').on('click',function(e) {	
	$("#save_type").val('save_and_back');
		var mandatory = $('#bid_amount').val();		
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
			$('.error-message .alerts').text('Updated Results succesfully');
			save_bidrequest_form();
			e.preventDefault();
		}
 		
});
//Add and back
$('#add_task_new').on('click',function(e) {	
	$("#save_type").val('save_and_new');
		var mandatory = $('#bid_amount').val();		
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
			$('.error-message .alerts').text('Updated Results succesfully');
			save_bidrequest_form();
			e.preventDefault();
		}
 		
}); */
//Add and stay
$('#add_task_new_stay').on('click',function(e) {	
	$("#save_type").val('save_and_stay');
		var mandatory = $('#bid_amount').val();	
        var varian    = $('.varian').val();		
        var textfield    = $('#textfield').val();
        var flatt_fee_amount = $('#flatt_fee_amount').val();		
		if(varian == '' || flatt_fee_amount == 0.00){
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');	
			$('.varian').parent().addClass('has-error');
			$('.varian').next('span').text('The bid amount cannot be empty');
			return false;
		}
		else{
			$('.varian').parent().removeClass('has-error');
			$('.varian').next('span').text('');
			save_bidrequest_form();
			e.preventDefault();
		}
 		
});
/*
Add/ Update Bids_request
*/
function save_bidrequest_form() {
    // Encode the String
    var encoded_string = Base64.encode('bids/submit_bids_request/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('bids/get_bid_requests/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    var sub_notes = CKEDITOR.instances.sub_notes.getData();
	//alert(sub_notes);
    var ajaxData  = $("#bid_request_save").serialize();
	
	//return false;
   // var project = $("#project_id").val();
   // var date = $("#log_date").val();
   // var ub_daily_log_id = $('#ub_daily_log_id').val();    
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData+ '&sub_notes=' + sub_notes,
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');		
        },		
        success: function(response) { 
			$('.uni_wrapper').removeClass('loadingDiv');		
            if(response.status == true)
            {  
				$.when(file_upload(response.insert_id)).done(function()
				{
					
					if($("#save_type").val() == 'save_and_new')
					{
						var encoded_string_edit_log = Base64.encode( 'bids/submit_bids_request/' + response.insert_id);
						var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
						window.location.href = encoded_edit_val;
					}
					else if($("#save_type").val() == 'save_and_back')
					{
						window.location.href = encoded_home_val;
					}
					else if($("#save_type").val() == 'save_and_stay')
					{
						 //var encoded_string_edit_log = Base64.encode( 'bids/submit_bids_request/' + response.insert_id);

						  var encoded_string_edit_log = Base64.encode( 'bids/submit_bids_request/' + response.insert_id);

							var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
							window.location.href = encoded_edit_val; 
						 

					}
				}
				);				
				success_box();
				$('.error-message .alerts').text('Updated successfully');	
				
				//return false;
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Update failed');	
				
			}
		}
		
    }); 
   
   
}
$('#decline_bid').on('click',function(e) {	
decline_bidrequest_form();
});
/*
Add/ Update Bids_request
*/
function decline_bidrequest_form() {
    // Encode the String
    var encoded_string = Base64.encode('bids/decline_bids_request/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('bids/bid_request_list/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
 
    var ajaxData  = $("#bid_request_save").serialize();

        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');		
        },		
        success: function(response) {           
            if(response.status == true)
            {  
			
			window.location.href = encoded_home_val ; 
			
			}
		}
				
    }); 
}

$(function () { 
  
  
    $('#datetimepicker6').datetimepicker({
      pickTime: false
    });
    
 });

//file upload list
$(function() {
    uploaded_doc_content_form();
});
function uploaded_doc_content_form() {
	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	var folderid = $("#folder_id").val();
	var moduleid = $("#ub_bid_id").val();
	var projectid = $("#project_id").val();
	var encoded_string = Base64.encode('bids/get_uploaded_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
						'tableName': $('#uploaded_doc_content'),
						'this_table' : {'table_name':'uploaded_doc_content'},
						'ajax_encoded_url':encoded_val,
						//'parent_id' : '{"folderid":"'+folderid+'"}',
						'folder_id' : 'folder_id',
						'post_data':'{"folderid":"'+folderid+'","moduleid":"'+moduleid+'","projectid":"'+projectid+'"}',
						'display_columns' : [{"data": "file_name", "bSortable": false},{"data": "date", "bSortable": false},{"data": "date", "bSortable": false}],
						'default_order_by': [[0, 'desc']]
					};
	// Populate data table
	ubdatatable_docs(dbobject);
}

/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';
    
    var temp_id = $("#temp_directory_id").val();    

    //alert(temp_id); 
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('bids/upload/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#bid_request_save').fileupload({
	add: function(e, data) {
            var name = data.originalFiles[data.index].name;
            var size = data.originalFiles[data.index].size;
            // code to validate the directory name start.
            var values = new Object() // creates a new instance of an object
            $('.doc_name').each(function() {
                values[$(this).attr('title')] = $(this).val()
            })
            var output = "";
            var property = "";
            for (property in values) {
              output += property + ',' + values[property];
            }
            var output_data = output.substring(0, output.length - 1);
            var array = output_data.split(',');
            if ($.inArray(name, array) > -1)
            {
                alert(name + ' - Already exixt.' );
                return false;
            }
            // code to validate the directory name end.

            var encoded_string = Base64.encode('bids/allowed_extension/');
            var encoded_val = encoded_string.strtr(encode_chars_obj);
            var uploadErrors = [];
            var ext = name.split('.').pop().toLowerCase();
            $.ajax({
                url: base_url + encoded_val,
                dataType: "json",
                type: "post",
                data: "ext="+ext, 
				beforeSend: function() {
				  $('.uni_wrapper').addClass('loadingDiv');				  
				},
                success: function(response) {   
					$('.uni_wrapper').removeClass('loadingDiv');
                    if(response.status == false)
                    {   
                        alert(ext +" is not an accepted file type.");
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        alert(name + ' - Filesize is too big.' );
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        alert(uploadErrors.join("\n"));
                        return false;
                    }
                    else
                    {              
                        data.submit();          
                    }
                }
            });
        },
        url: encoded_val,
        dataType: 'json',
        autoUpload: false,
        // acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        // maxFileSize: 5000000,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
        success: function (data) {			
			setTimeout(checkbox, 1*200);			
			//alert(JSON.stringify(response));
			$("#temp_directory_id").val(data.files[0]['temp_dir_id']);
			$('.uni_wrapper').removeClass('loadingDiv');
		}
    });
	// Load existing files:
	$.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: $('#bid_request_save').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#bid_request_save')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
});

/* //doc hierarchy
$(function(){
	var encoded_string = Base64.encode('bids/get_doc_hierarchy/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
 var tree_data;
    var jsonUrl = encoded_val;
    $.getJSON(jsonUrl, function(data) {
        tree_data = data;
        //alert(JSON.stringify(tree_data));
        tree_data_fun();
    });

    function tree_data_fun() {
        $('#fixed-tree').fileTree({
            data: tree_data
        });
    }

    $('body').on('click', 'li.file', function() {
        $('li.file').removeClass('selected');
        $(this).addClass('selected');
    });
	$('.file_uploaded_div').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	});
});
$(function() {
    $(window).load(function() {
        $("#docs_upload_Modal .modal-con").mCustomScrollbar({
            setHeight: 250,
            theme: "dark-3"
        });

    });

}); */

function file_upload(insert_id)
{
	var temp_directory_id = $("#temp_directory_id").val();
	var folderid = $("#folder_id").val();
	var moduleid = insert_id;
	var projectid = $("#project_id").val();

	var encoded_string = Base64.encode('bids/get_temp_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var response = $.ajax({
		url: base_url + encoded_val,
		//dataType: "json",
		type: "post",
		data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid + '&moduleid=' + moduleid + '&projectid=' + projectid,			
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },	
		success: function(response) {		
			//if(response.status == true)
			//{	
				//window.location.href = role_index_url;
			//}
		}
	});
	return  response;
}

/*function to copy the files path to the hidden variable */
function copy_file_path(file_path)
{
	$('#temp_file_path').val(file_path);
	$(".upload_alerts").html('');
}

function copy_file_to_temp()
{
	var file_path = $('#temp_file_path').val();
	var temp_id = $("#temp_directory_id").val();
	var encoded_string = Base64.encode('bids/copy_file_to_temp/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);	
	if(file_path == '')
	{
		$(".modal-body .upload_error-message .upload_alerts").removeClass('alert-success');
		$(".modal-body .upload_error-message .upload_alerts").addClass('alert-danger');
		$(".modal-body .upload_error-message").show();
		$(".upload_alerts").html('Please Select a File');
	}
	else
	{
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: 'file_path='+file_path+'&temp_id='+temp_id,		

		success: function(response) 
        {
          if(response.status == true)
          {
            $(".modal-body .upload_error-message .upload_alerts").removeClass('alert-danger');
            $(".modal-body .upload_error-message .upload_alerts").addClass('alert-success');
            $(".modal-body .upload_error-message").show();
            if(response.message)
            {
                success_msg = response.message;
            }
            $(".upload_alerts").html(success_msg);
            relode_temp();
          }
        }
	});	
	}
} 

function relode_temp()
{
	var temp_id = $("#temp_directory_id").val();
	$.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: $('#bid_request_save').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#bid_request_save')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$("#bid_request_save").find(".files").empty();
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
}
$('#intrest_yes').on('click',function(e) {	
var intrest = 'Yes' ;
bids_intrest(intrest);
});
$('#intrest_no').on('click',function(e) {	
var intrest = 'No' ;
bids_intrest(intrest);
});
$('#intrest_maybe').on('click',function(e) {	
var intrest = 'May be' ;
bids_intrest(intrest);
});
function bids_intrest(intrest)
{
    var ub_bid_request_id = $('#ub_bid_request_id').val();
	var encoded_string_bid = Base64.encode('bids/submit_bids_request/'+ ub_bid_request_id);
	var encoded_bid_val = encoded_string_bid.strtr(encode_chars_obj);
	var encoded_string = Base64.encode('bids/save_bids_intrest/');					
	var encoded_val = encoded_string.strtr(encode_chars_obj);	
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: 'interest='+ intrest +'&ub_bid_request_id='+ ub_bid_request_id,  
	    success: function(response) {
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Updated succesfully');
			window.location.href = encoded_bid_val;
		}
	});	
	
}
$(function(){

  
   $('#flatt_fee_amount').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
 
 $(document).on('keyup','.varian', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){ return ''; }) );
 });
});
$(function(){
	var bid_sub_ststus = $("#ub_bid_sub_status").val();
	if(bid_sub_ststus == 'Submitted' || bid_sub_ststus == 'Accepted' || bid_sub_ststus == 'Rejected')
	{ 
	  setTimeout(function(){
		$('.fileinput-button').hide();
		$('.file-button').hide();
		$('.up_check').hide();
		$('.delete_btn').hide();
		}, 500);
	}
});
