//checking project status -- code added by satheesh kumar
$(function() {
	var ub_bid_id = $('#ub_template_bid_id').val();   
	if(ub_bid_id == '' || ub_bid_id == 0)
	{
		check_project_status('template/bids/index/');
	}
	else if(project_status_check == false)
	{
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Project was closed. You can not able to edit');
		//alert('you can not edit');
	}
	/* checking project status code ends here*/
});

imgLink = base_url + 'assets/images/'; 
$(function(){

	$('#daily_sub_reminder').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	$('#number_days').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	 $('#bid_amount').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });

});
$(function(){
  var encoded_string = Base64.encode('template/bids/get_doc_hierarchy/');
  var encoded_val = encoded_string.strtr(encode_chars_obj);
 var tree_data;
 //alert(123);
    var jsonUrl = encoded_val;
    setTimeout(function(){  
    $.getJSON(jsonUrl, function(data) {
        tree_data = data;
        //alert(JSON.stringify(tree_data));
        tree_data_fun();
    });
}, 3000);
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

});


//List Files
 $(function() {    
        new_warranty();
    });

    function new_warranty() {
        $('#new_claim_files').dataTable({
            "aLengthMenu": [
                [5, 15, 50, 100],
                [5, 15, 50, "l00"]
            ],
            "iDisplayLength": 5,            
            sAjaxSource: base_url + 'assets/js/new_warranty.json',
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [-1] // <-- gets last column and turns off sorting
            }],
                "fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {
                var permission_UserIcon = data.permission[0].usericon;      
                var permission_OwnerIcon =  data.permission[0].ownericon;     
        var view_permission = '<div class="text-center"><input type="checkbox"/>'+'&nbsp;&nbsp;&nbsp;'+'<img src="' + imgLink + permission_UserIcon + '" />' +'<span class="space"></span>'+'<input type="checkbox"/>'+'&nbsp;&nbsp;&nbsp;'+'<img src="' + imgLink + permission_OwnerIcon + '" /></div>';       
        $('td:eq(2)', nRow).html(view_permission);        
        return nRow;        
            },
      "columns":[
            
            { "sTitle":"File Name","data": "filename"},
            { "sTitle":"Size","data": "size"},
            { "sTitle":"View Permission","data": "permission"}            
        ],
        "order": [[1, 'asc']]

        });
    }

 

//pricing Format
$(document).ready(function() {

  var cointainer = $('.removeBtn').parent().parent().parent().parent().closest('.cointainer');
  var counts = cointainer.children('.content').length;
  if (counts == 1) {
            cointainer.find('.removeBtn').hide();
        }
  if(counts < 10)
  {
    cointainer.children('.addBtn').show();
  }
  $('.removeBtn').click( function() {
    var cointainer = $(this).parent().parent().parent().parent().closest('.cointainer');
    var counts = cointainer.children('.content').length;
    
    counts--;
    if(counts < 10) {
        cointainer.children('.addBtn').show();         
        if (counts == 1) {
            cointainer.find('.removeBtn').hide();
        }
    }
    $(this).parent().parent().parent().parent().remove();
    cointainer.find('.label-num').text(function(idx){
        return 1 + idx
    })
});

//add button
$('.addBtn').click( function() {
  $('#cost_code_id').trigger("change");
    var cointainer = $(this).closest('.cointainer');  
    var counts = cointainer.children('.content').length;
    var content = $(this).prev();
    counts++;   
    if (counts > 9) {                     
        $(this).hide();
         
    
    }
    content.clone(true,true).insertAfter(content).find('input').val('').end().find('.label-num').text(counts);  
	$('.selectpicker').data('selectpicker', null);
	$('.bootstrap-select').remove();
	$('.selectpicker').selectpicker();
    cointainer.find('.removeBtn').show();
});

});

$(function () { 
  $(window).load(function(){
    $(".bid_attach_con").mCustomScrollbar({
      setHeight:300,
      theme:"dark-3"
    });
        
  });
  $('#datetimepicker5').datetimepicker({
      pickTime: false
    });
    $('#datetimepicker6').datetimepicker({
      pickTime: false
    });
    $('#datetimepicker7').datetimepicker({
      pickTime: false
    });
    $('#task-time').datetimepicker({
    pickDate: false
  });
  $(document).on('ifChecked','#has_checklist', function(event){     
           $('#checklist-view').show();
  });
  $(document).on('ifUnchecked','#has_checklist', function(event){  
           $('#checklist-view').hide();
   
  });
 });



  $(function() {

    $('.link-to').hide();
    $(document).on('change', '#toggle-event', function() {      
    var task = $(this).prop('checked');
    if(task == true){ 
		$('.toggle').removeClass('off');
		$('.toggle').removeClass('btn-default');
		$('.toggle').addClass('btn-primary');
		$('.link-to').show();
		$('.due-date').hide();      
    }
    else if(task == false){
		$('.toggle').addClass('off');
		$('.toggle').addClass('btn-default');
		$('.toggle').removeClass('btn-primary');
		$('.due-date').show();
		$('.link-to').hide();
    }
  });

    $(document).on('ifChecked','#flat-fee', function (event) {
      $('#line-items-view').hide();
      $('#flat-fee-view').show();
    });


    $(document).on('ifChecked','#line-items', function (event) {
      $('#line-items-view').show();
      $('#flat-fee-view').hide();
    });
  });
  
  $(function(){

      
     if($('#toggle-event').attr('checked'))
      {
        $('.link-to').show();
        $('.due-date').hide();
      }
     if($('#line-items').attr('checked'))
      {
        $('#line-items-view').show();
        $('#flat-fee-view').hide();
      } 
     if($('#has_checklist').attr('checked'))
      {
        $('#checklist-view').show();
      }     

  });
  /*
    Tab change operations
  */
 
  $('#bidtab a').click(function(e) { 
    //add_formval();
    var package_title = document.getElementById('package_title').value;
    var current_tab = this.id;
    if(current_tab == "General-tab")
    {
        $('#current_tab').val('#General');
    }
    if(current_tab == "Requestes-tab")
    {
        $('#current_tab').val('#Requestes');
    }
    if(current_tab == "Files-tab")
    {
        $('#current_tab').val('#Files');
    }
  
    $("#save_type").val('save_and_stay');
    var mandatory = $('#package_title').val();
    if(mandatory == ''){      
      var form = $(this).closest("form");   
      form.submit();
      $('.error-message').show();
      $('.error-message .alerts').removeClass('alert-success');
      $('.error-message .alerts').removeClass('alert-danger');
      $('.error-message .alerts').addClass('alert-danger');
      $('.error-message .alerts').text('Please fill mandatory fields');         
      return false;
    }
    else if(mandatory != ''){    
      $('.error-message').show();
      $('.error-message .alerts').removeClass('alert-danger');
      $('.error-message .alerts').addClass('alert-success');
      //$('.error-message .alerts').text('save succesfully');
      add_bid_form();     
      e.preventDefault();
    }
    else{
      $("#save_type").val('save_and_stay');
      add_bid_form();
      e.preventDefault();
    }  
            
});
  /* 
 Set your save type
 */
$(function() {  
    add_formval();
    //add_comment_formval();
    $('#bid_save_stay').click(function(e) { 
    $("#save_type").val('save_and_stay'); 
    $('#current_tab').val('');
     var mandatory = $('#package_title').val();
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
      //$('.error-message .alerts').text('Updated Results search succesfully');
      add_bid_form();
      e.preventDefault();
    }
    
    });
    $('#bid_save_new').click(function(e) {
        $("#save_type").val('save_and_new'); 
        $('#current_tab').val('');
     var mandatory = $('#package_title').val();
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
      //$('.error-message .alerts').text('Updated Results search succesfully');
      add_bid_form();
      e.preventDefault();
    } 
    });
    $('#bid_save_back').click(function(e) {
        $("#save_type").val('save_and_back'); 
        $('#current_tab').val('');
     var mandatory = $('#package_title').val();
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
      //$('.error-message .alerts').text('Updated Results search succesfully');
      add_bid_form();
      e.preventDefault();
    }   
    });

    $('#bid_save_release').click(function(e) {
        $("#save_type").val('save_and_release');
        $('#current_tab').val('');
        $("#status").val('Released');
     var mandatory = $('#package_title').val();
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
      //$('.error-message .alerts').text('Updated Results search succesfully');
      add_bid_form();
      e.preventDefault();
    }  

    });

    $('#bid_close').click(function(e) {
        $("#save_type").val('save_and_back');
        $('#current_tab').val('');
        $("#status").val('Closed');
     var mandatory = $('#package_title').val();
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
      //$('.error-message .alerts').text('Updated Results search succesfully');
      add_bid_form();
      e.preventDefault();
    }   
      
    });    
    
    $('#bid_cancel').click(function(e) {   
         $('#current_tab').val('');
         var encoded_home_string = Base64.encode('template/bids/index/');
         var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
         window.location.href = encoded_home_val; 
         e.preventDefault();      
    });  
/*  $('#delete_uni_pro').click(function(){
    $('#confirmModal').modal('show'); 
  }); */
});
function add_formval(){  
    var bidform = $('#bid_save').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
     button: {
            selector: '#bid_save_stay, #bid_save_new, #bid_save_back, #bid_save_release, #bid_close, #bidtab a'          
        },
        fields: {
            'package_title': {
                validators: {
                    notEmpty: {
                        message: 'The package_title is required and cannot be empty'
                    },
          
                }
            }
           
        } 
    
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {      
       if($("#save_type").val() == 'save_and_stay'){
        add_bid_form();       
       }
      else if($("#save_type").val() == 'save_and_new'){
        add_bid_form();       
      } 
      else if($("#save_type").val() == 'save_and_back'){
        add_bid_form();       
      }
      else if($("#save_type").val() == 'save_and_release'){
        add_bid_form();       
      }
      e.preventDefault();      
    }); 
  
}

/*
Add/ Update Bid
*/
function add_bid_form() {

 
    // Encode the String
    var encoded_string = Base64.encode('template/bids/save_bid/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('template/bids/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    
    var ub_bid_id = $('#ub_template_bid_id').val();  
    var tab = $('#current_tab').val();
    var description = CKEDITOR.instances['description'].getData();
    var ajaxData  = $("#bid_save").serialize();

        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData+ '&description=' + description,  
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');
			  
        },		
        success: function(response) {  
	
            if(response.status == true)
            {  
				        $('.uni_wrapper').removeClass('loadingDiv');
                $.when(file_upload(response.insert_id)).done(function()
                {			
                if($("#save_type").val() == 'save_and_new')
                {
                    window.location.href = encoded_val;
                }
                else if($("#save_type").val() == 'save_and_back')
                {
                    window.location.href = encoded_home_val;
                }
                else if($("#save_type").val() == 'save_and_release')
                {
                  $tab_href = $('.tab-con li.active a').attr('href');
                  var encoded_string_edit_log = Base64.encode( 'template/bids/save_bid/' + ub_bid_id);
                  var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                  window.location.href = encoded_edit_val+$tab_href;
                  location.reload(true);
                }
                else if($("#save_type").val() == 'save_and_stay')
                {

                     var encoded_string_edit_log = Base64.encode( 'template/bids/save_bid/' + response.insert_id);
                     var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                     window.location.href = encoded_edit_val+tab;
                     //location.reload(true);

                    $.ajaxSetup({cache: false});
                    $("#request_list").load(location.href + " #request_list");
                }
                $(".error-message .alerts").removeClass('alert-danger');
                $(".error-message .alerts").addClass('alert-success');
                $(".error-message").show();
                if(response.message)
                {
                    success_msg = response.message;
                }
                $(".alerts").html(success_msg);
              });
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


function delete_bid(bid_ids_obj){
    if(bid_ids_obj > 0)
    {
    var encoded_delete_roles = Base64.encode('template/bids/delete_bid/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('template/bids/index/');
    var index_url = index_string.strtr(encode_chars_obj);
    var conf = $('#confirmModal').modal('show');
  $('#delete_confirm').click(function(){
  var conf = true;
    if(conf == true){
  $('#confirmModal').modal('hide');
    $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: {'ub_template_bid_id':{ub_template_bid_id:bid_ids_obj}},
            success: function(response) {   
                if(response.status == true)
                {   
                    $(".error-message .alerts").removeClass('alert-danger');
                    $(".error-message .alerts").addClass('alert-success');
                    $(".error-message").show();
                    if(response.message)
                    {
                        success_msg = response.message;
                        window.location.href = index_url;                           
                    }
                    $(".alerts").html(success_msg);
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
  });
    }
    else
    {               
        $(".error-message .alerts").addClass('alert-danger');
        $(".error-message .alerts").removeClass('alert-success');
        $(".error-message").show();
        $(".alerts").html("Bid id is not set");      
    }
}




/*Below code for File Upload*/


function file_upload(insert_id)
{
    var temp_directory_id = $("#temp_directory_id").val();
    var folderid = $("#folder_id").val();
    var projectid = $('#project_id').val();
    var moduleid = insert_id;
    var encoded_string = Base64.encode('template/bids/get_temp_filename/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var response = $.ajax({
        url: base_url + encoded_val,
        //dataType: "json",
        type: "post",
        data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid + '&moduleid='+moduleid + '&projectid='+projectid,          
        /*beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');       
        }, */ 
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
    var encoded_string = Base64.encode('template/bids/upload/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#bid_save').fileupload({
    add: function(e, data) {
            var name = data.originalFiles[0].name;
            var size = data.originalFiles[0].size;
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

            var encoded_string = Base64.encode('template/bids/allowed_extension/');
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
                        alert("Not an accepted file type.");
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
        url: $('#bid_save').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#bid_save')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
});
function copy_file_path(file_path)
{
  $('#temp_file_path').val(file_path);
  $(".upload_alerts").html('');
}

function copy_file_to_temp()
{
  var file_path = $('#temp_file_path').val();
  var temp_id = $("#temp_directory_id").val();
  var encoded_string = Base64.encode('template/bids/copy_file_to_temp/');
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
    url: $('#bid_save').fileupload('option', 'url'),
    dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
    context: $('#bid_save')[0]
  }).always(function () {
    $(this).removeClass('fileupload-processing');
  }).done(function (result) {
    // alert(result.toSource());
    $("#bid_save").find(".files").empty();
    $(this).fileupload('option', 'done')
      .call(this, $.Event('done'), {result: result});
  });
}