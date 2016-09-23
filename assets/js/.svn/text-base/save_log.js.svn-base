//character counter added in comments
$(function() {	
	var totalChars 		= 4000; 
	var countTextBox 	= $('#comments')
	var charsCountEl 	= $('#commentcountchars');
	charsCountEl.text(totalChars);
	countTextBox.keyup(function() {
		var thisChars = this.value.replace(/{.*}/g, '').length;
		var per = thisChars*100; 
		var value= (per / totalChars);
		if(thisChars > totalChars)
		{
			var CharsToDel = (thisChars-totalChars);
			this.value = this.value.substring(0,this.value.length-CharsToDel);
		}else{
			charsCountEl.text( totalChars - thisChars );
			$('#commentpercent').text(value +'%');
		}
	});
});
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
	
	var totalChars 		= 4000; 
	var countTextBox 	= $('#log_notes')
	var charsCountEl 	= $('#countchars');
	charsCountEl.text(totalChars);
	countTextBox.keyup(function() {
		var thisChars = this.value.replace(/{.*}/g, '').length;
		var per = thisChars*100; 
		var value= (per / totalChars);
		if(thisChars > totalChars)
		{
			var CharsToDel = (thisChars-totalChars);
			this.value = this.value.substring(0,this.value.length-CharsToDel);
		}else{
			charsCountEl.text( totalChars - thisChars );
			$('#percent').text(value +'%');
		}
	});
});
//checking project status -- code added by satheesh kumar
$(function() {
	var ub_daily_log_id = $('#ub_daily_log_id').val();   
	if(ub_daily_log_id == '' || ub_daily_log_id == 0)
	{
		check_project_status('logs/index/');
	}
	else if(project_status_check == false)
	{
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Project was closed. You can not able to edit');
		//alert('you can not edit');
	}
	/* checking project status code ends here*/
});	


$('body').on('click', 'li.file', function() {
		$('li.file').removeClass('selected');
	    $(this).addClass('selected'); 
});
$(window).load(function(){
		$("#docs_upload_Modal .modal-con").mCustomScrollbar({
			setHeight:250,
			theme:"dark-3"
		});	
});	
$('.file_uploaded_div').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
});
	
$(function(){
	$('#datetimepicker5').datetimepicker({
		pickTime: false,
		 maxDate:new Date()
	});
	$('#task-time').datetimepicker({
		pickDate: false
	});
	imgLink = base_url + 'assets/images/'; 		
});

/* Scroll */
$(function () {
	
	$(window).load(function(){
		$(".inner-jumbotron").mCustomScrollbar({
			setHeight:300,
			theme:"dark-3"
		});
				
	});

});
/* /Scroll */
function dropzoneupload() {
        var Dropzone = function() {
            //function to initiate DropzoneJS 
            var runDropzone = function() {
                //for more information about Server side implementation
                //please visit http://www.dropzonejs.com/
                $(".dropzone").dropzone({
                    paramName: "file", // The name that will be used to transfer the file
                    autoProcessQueue: false,
                    maxFilesize: 5.0, // MB
                    addRemoveLinks: true,
                    removedfile: function(file) {
                        deletefile()
                    }
                });
            };
            return {
                init: function() {
                    runDropzone();				
                }
            };
        }();
    }

    function deletefile(value) {
        var xmlhttp;
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                alert(xmlhttp.responseText);
            }
        }
        xmlhttp.open("GET", base_url + "home/deleteupload/?fid=" + value, true);
        xmlhttp.send();
    }
$(function() {
	 $('.notes-area').hide();
	 $(document).on('ifChecked','#weather_notes', function(event){				
		$('.notes-area').show();	
	});	
	$(document).on('ifUnchecked','#weather_notes', function(event){		
		$('.notes-area').hide();       		
	});	
 });
 //checkbox validation
 $(function() {
    $(document).on('ifChecked','#private_checkbox', function(event){                	
        $("#private").val("Yes");
        $("#show_owner").val("No");
        $("#show_subs").val("No"); 
		$(this).attr("checked", "checked");
		$("#show_subs_checkbox").iCheck('disable');		
		$("#show_owner_checkbox").iCheck('disable');				 		
		$("#show_subs_checkbox").iCheck('uncheck');		
		$("#show_owner_checkbox").iCheck('uncheck');		
    }); 
    $(document).on('ifUnchecked','#private_checkbox', function(event){
        $("#private").val("No"); 
		$(this).attr("checked", false);	
		$("#show_subs_checkbox").iCheck('enable');		
		$("#show_owner_checkbox").iCheck('enable');		
    }); 
    $(document).on('ifChecked','#show_subs_checkbox', function(event){                
        $("#show_subs").val("Yes");
        $("#private").val("No"); 
		$(this).attr("checked", "checked");
		$("#private_checkbox").iCheck('disable');								 		
		$("#private_checkbox").iCheck('uncheck');				
		
    }); 
    $(document).on('ifUnchecked','#show_subs_checkbox', function(event){      
        $("#show_subs").val("No"); 
		$(this).attr("checked", false);	
		$("#private_checkbox").iCheck('enable');
		$("#private_checkbox").iCheck('uncheck');
		if ($('#show_owner_checkbox').is(':checked')){
			$("#private_checkbox").iCheck('disable');								 		
			$("#private_checkbox").iCheck('uncheck');
		}		
    });  
    $(document).on('ifChecked', '#show_owner_checkbox', function(event){                
        $("#show_owner").val("Yes");
        $("#private").val("No"); 
		$(this).attr("checked", "checked");
		$("#private_checkbox").iCheck('disable');								 		
		$("#private_checkbox").iCheck('uncheck');		
		
    }); 
    $(document).on('ifUnchecked','#show_owner_checkbox', function(event){      
        $("#show_owner").val("No"); 
		$(this).attr("checked", false);	
		$("#private_checkbox").iCheck('enable');
		$("#private_checkbox").iCheck('uncheck');
		if($('#show_subs_checkbox').is(':checked')){		
			$("#private_checkbox").iCheck('disable');								 		
			$("#private_checkbox").iCheck('uncheck');
		}
	
     });	
    $(document).on('ifChecked', '#weather_notes', function(event){                
        $("#weather").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#weather_notes', function(event){      
        $("#weather").val("No"); 
        }); 
    $(document).on('ifChecked','#owner', function(event){                
        $("#owner_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#owner', function(event){      
        $("#owner_val").val("No"); 
        });
    $(document).on('ifChecked','#sub', function(event){                
        $("#sub_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#sub', function(event){      
        $("#sub_val").val("No"); 
        });
     $(document).on('ifChecked','#owner-child', function(event){                
        $("#owner_notify").val("Yes");
        $("#owner_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#owner-child', function(event){      
        $("#owner_notify").val("No"); 
        if($('#owner').is(":checked"))
        {
            $("#owner_val").val("Yes"); 
        }
        else
        {
            $("#owner_val").val("No"); 
        }
        });
    $(document).on('ifChecked','#sub-child', function(event){                
        $("#sub_notify").val("Yes");
        $("#sub_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#sub-child', function(event){      
        $("#sub_notify").val("No");
        if($('#sub').is(":checked"))
        {
            $("#sub_val").val("Yes"); 
        }
        else
        {
            $("#sub_val").val("No"); 
        } 
        });  
     if($('#weather_notes').attr('checked'))
      {
         $('.notes-area').show();
         $("#weather").val("Yes");
         $(this).attr("checked", "checked");
         $("#weather_notes").iCheck('disable');
      }
      if($('#private_checkbox').attr('checked'))
      {
         $(this).attr("checked", "checked");
         $("#show_subs_checkbox").iCheck('disable');     
         $("#show_owner_checkbox").iCheck('disable');
      }
      if($('#show_owner_checkbox').attr('checked') || $('#show_subs_checkbox').attr('checked'))
      {
         $(this).attr("checked", "checked");
         $("#private_checkbox").iCheck('disable');     
      }               
    }); 

 /* 
 Set your save type
 */
$(function() {	
    add_formval();
	add_comment_formval();
    $('#add_log').click(function(e) { 
         $("#save_type").val('save_and_stay'); 
		 var mandatory = $('#project_id').val();
		if(mandatory == ''){
			$('.error-message').show();
			$('.error-message .alerts').text('Please fill all mandatory fields');
		 }
		
    });
    $('#add_log_new').click(function(e) {
        $("#save_type").val('save_and_new'); 
		 var mandatory = $('#project_id').val();
		if(mandatory == ''){
			$('.error-message').show();
			$('.error-message .alerts').text('Please fill all mandatory fields');
		 }	
    });
    $('#add_log_back').click(function(e) {
        $("#save_type").val('save_and_back'); 
		 var mandatory = $('#project_id').val();
		if(mandatory == ''){
			$('.error-message').show();
			$('.error-message .alerts').text('Please fill all mandatory fields');
		 }		
    });
    // $('#post_comment').click(function(e) {
        // add_comment();
        // e.preventDefault();      
    // });
    $('#btncancel').click(function(e) {		
         var encoded_home_string = Base64.encode('logs/index/');
         var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
         window.location.href = encoded_home_val; 
         e.preventDefault();      
    });  
	$('#delete_uni_pro').click(function(){
		$('#confirmModal').modal('show'); 
	});	
	$('#commentModal').on('hidden.bs.modal', function () {
		  $('#post_your_comment').formValidation('resetForm', true);
		  $(this).find('form')[0].reset();
	});
});
function add_formval(){	 
     var add_new_role = $('#add_new_log').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_log, #add_log_new, #add_log_back'			
        },
         fields: {             					
			'log_date': {
                validators: {
					notEmpty: {
						 message: 'The date is required'
					},
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is required'
                    }
                }
            },
			'log_notes': {
                 validators: {
					notEmpty: {
						 message: 'The Notes cannot be empty'
					}
                 }
             }
             ,
            'weather_description': {
                 validators: {                     
                     stringLength: {
                        min: 0,
                        max: 4000,
                        message: 'The weather Notes must be less than 4000 characters'
                    }
                 }
             }
		
         }       /* added closing brace */
        
     }).on('err.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
      }).on('success.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
      }).on('success.form.fv', function(e) {	          
			add_log_form();            
			e.preventDefault(); 
     });
	$('#datetimepicker5').on('dp.change dp.show', function(e) {		
        $('#add_new_log').formValidation('revalidateField', 'log_date');
    });
	$(document).on('click','.glyphicon.glyphicon-remove', function(e) {		
        $('#add_new_log').formValidation('revalidateField', 'log_date');
    });
}

function add_comment_formval(){
		var commentform = $('#post_your_comment').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		excluded: [':disabled'],
		 button: {
            selector: '#post_comment',          
        },
        fields: {
            'comments': {
                validators: {
                    notEmpty: {
                        message: 'The comments is required and cannot be empty'
                    }
                }
            }
           
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
      }).on('success.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
      }).on('success.form.fv', function(e) {	
			add_comment();
			e.preventDefault();
			//$('#post_your_comment').formValidation('resetForm', true);
	  });	  
	
}
/*
Add/ Update Log
*/
function add_log_form() {
    // Encode the String
    var encoded_string = Base64.encode('logs/save_log/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('logs/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    
    var ajaxData  = $("#add_new_log").serialize();
    var ub_daily_log_id = $('#ub_daily_log_id').val();    
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
				$('.uni_wrapper').removeClass('loadingDiv');
                $.when(file_upload(response.insert_id)).done(function()
                {
                 //alert(response.insert_id);return false;
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
                    
                     var encoded_string_edit_log = Base64.encode( 'logs/save_log/' + response.insert_id);
                     var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                     window.location.href = encoded_edit_val;
                    
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
/*
Delete log
*/
function delete_log(log_ids_obj){
    if(log_ids_obj > 0)
    {
    var encoded_delete_roles = Base64.encode('logs/delete_log/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('logs/index/');
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
            data: {'ub_daily_log_id':{ub_daily_log_id:log_ids_obj}},
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
        $(".alerts").html("Log id is not set");      
    }
}
/*
Add Comment
*/
function add_comment()
{
    var comments  = $("#comments").val();
    var owner  = $("#owner_val").val();
    var sub  = $("#sub_val").val();
    var daily_log_id  = $("#ub_daily_log_id").val();
    var project_id = $("#project_id").val();
    var encoded_string = Base64.encode('logs/save_comment/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: "comments="+comments+"&show_owner="+owner+"&show_sub="+sub+"&daily_log_id="+daily_log_id+"&project_id="+project_id,         
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');			
        },
        success: function(response) {        
			$('.uni_wrapper').removeClass('loadingDiv');		
            $("#commentModal").modal('hide');
             $.ajaxSetup({cache: false});
             $("#comments_area").load(location.href + " #comments_area");
             send_notify();

        }
        });
}

function send_notify()
 {
    var owner_notify  = $("#owner_notify").val();
    var sub_notify  = $("#sub_notify").val();
    var project_id  = $("#project_id").val();
    var ub_daily_log_id = $('#ub_daily_log_id').val();
    var comment = $('#comments').val();
    var encoded_string = Base64.encode('logs/send_notify/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: "&owner_notify="+owner_notify+"&sub_notify="+sub_notify+"&project_id="+project_id+"&ub_daily_log_id="+project_id+"&comment="+comment,         
        success: function(response) {
                   
        }
        });
    $("#comments").val('');
    $('#owner').closest('.icheckbox_square-red').removeClass('checked');        
    $('#owner').removeAttr("checked", "checked");
    $('#sub').closest('.icheckbox_square-red').removeClass('checked');        
    $('#sub').removeAttr("checked", "checked");
    $('#owner-child').closest('.icheckbox_square-red').removeClass('checked');        
    $('#owner-child').removeAttr("checked", "checked");
    $('#sub-child').closest('.icheckbox_square-red').removeClass('checked');        
    $('#sub-child').removeAttr("checked", "checked");
    $("#owner_val").val('No');
    $("#sub_val").val('No');
    $("#owner_notify").val('No');
    $("#sub_notify").val('No');
 }


//Delete Comment
function delete_comment(log_ids_obj){
    
    var encoded_delete_roles = Base64.encode('logs/delete_comment/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('logs/save_log/');
    var index_url = index_string.strtr(encode_chars_obj);
var conf = $('#confirm_comment_Modal').modal('show');
$('#delete_comment_confirm').click(function(){
	var conf = true;
	if(conf == true){
		$('#confirm_comment_Modal').modal('hide');
    $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: {'ub_comments_id':{ub_comments_id:log_ids_obj}},
			beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');			  
			},
            success: function(response) {   
                if(response.status == true)
                {   
                   $('.uni_wrapper').removeClass('loadingDiv');
                    if(response.message)
                    {
                        
                        //window.location.href = index_url;
                        $.ajaxSetup({cache: false});
                        $("#comments_area").load(location.href + " #comments_area");
                           
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
});

}
/*
Delete Comment End
*/

    /* Drop Down Add / Edit / Delete */
    $(document).ready(function(){   
    var selected = $('#tags').find("option:selected").val();
    $('#edit_project_group').val(selected);
    $('#selected').val(selected);
    });
    $('#tags').on('change', function() {
        var selected = $(this).find("option:selected").val();
        $('#edit_project_group').val(selected);
        $('#selected').val(selected);
    });
    $('#tags_save').click(function() {
        var value = $('#tags_add').val();
        var encoded_url = Base64.encode('logs/update_general_value/');
        var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        var classification = 'log_tags';
        var operation_type = 'add';
        if(value!=''){
        xhr = $.ajax({
            type: "POST",
            dataType: "json",
            data: {"classification":classification,"type":operation_type,"value":value},
            url: base_url + ajax_encoded_url,
            success: function (response) {
                if(response.status == true)
                {
                    $('#tags').append($("<option value=" + value + ">" + value + "</option>").text(value));
                    $(".selectpicker").selectpicker("refresh");
                    // alert("Added successfully");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text('Added successfully');
                    $("#TypeAddModal").modal('hide');
                    $('#tags_add').val('');
                }else
                {
                    // alert("Insertion failed");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text(response.message);
                }
            }
        }); 
       }
       else
       {
         // alert('Please Enter a Tag name');
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please Enter a Tag name');
       }
    });
    $('.TypeEditModal').click(function() {
        var n = $('#tags').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
        if (n === 1) {
            $('#TypeEditModal').modal({
                show: true
            });
            $('#Edit_project').click(function() {
                var sat = $('#edit_project_group').val();
                var selected_val = $('#selected').val();
                if (selected_val == selected_val) {
                    $('#tags option[value=' + selected_val + ']').remove();
                }
                if (sat == sat) {
                    $('#tags').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
                }
                $('#tags').next().find('.dropdown-menu li.selected a .text').empty();
                $('#tags').next().find('.dropdown-menu li.selected a .text').append(sat);
                $('#tags').next().find('.selectpicker .filter-option').empty();
                $('#tags').next().find('.selectpicker .filter-option').append(sat);
            });
            $('#project_group_delete').click(function() {
                var value = $('#edit_project_group').val();
                if (value == value) {
                    $('#tags option[value="' + value + '"]').remove();
                }
                var encoded_url = Base64.encode('logs/update_general_value/');
                var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
                var classification = 'log_tags';
                var operation_type = 'delete';
                dataobj = {"classification":classification,"type":operation_type,"value":value};
                xhr = $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: dataobj,
                    url: base_url + ajax_encoded_url,
                    success: function (response) {
                        if(response.status == true)
                        {                       
                            $('#edit_project_group').val('');
                            $('#tags').next().find('.dropdown-menu li.selected').remove();
                            $('#tags').next().find('.selectpicker .filter-option').empty();
                            $('#tags').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
                            $(".selectpicker").selectpicker("refresh");
                            // alert("Deleted successfully");
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text('Deleted successfully');
                            $("#TypeEditModal").modal('hide');
                        }else
                        {
                            // alert("Deletion failed: "+response.message);
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text('Deletion failed: '+response.message);
                        }
                    }
                }); 
              
            });
        } else if (n > 1) {
            // alert('select only one at a time');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Select only one at a time');
        } else if (n === 0) {
            // alert('Please select');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select');
        }
    });
    /* /Drop Down Add / Edit / Delete */


    /*Below code for File Upload*/
    $(function(){
    var encoded_string = Base64.encode('logs/get_doc_hierarchy/');
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
});

function file_upload(insert_id)
{
    var temp_directory_id = $("#temp_directory_id").val();
    var folderid = $("#folder_id").val();
    var moduleid = insert_id;
    var projectid = $('#project_id').val();
    var encoded_string = Base64.encode('logs/get_temp_filename/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var response = $.ajax({
        url: base_url + encoded_val,
        //dataType: "json",
        type: "post",
        data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid + '&moduleid='+moduleid + '&projectid='+projectid,          
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
    var encoded_string = Base64.encode('logs/copy_file_to_temp/');
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
        url: $('#add_new_log').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#add_new_log')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $("#add_new_log").find(".files").empty();
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
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
	if(file_upload_list_page_user == 100)
	{

    'use strict';
    
    var temp_id = $("#temp_directory_id").val();    

    //alert(temp_id); 
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('logs/upload/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#add_new_log').fileupload({
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
                //alert(name + ' - Already exixt.' );
                $('#alertModal').modal('show');
                $('.alert_modal_txt').text(name + ' - Already exixt.' );
                return false;
            }
            // code to validate the directory name end.

            var encoded_string = Base64.encode('logs/allowed_extension/');
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
                        //alert("Not an accepted file type.");
                        $('#alertModal').modal('show');
                        $('.alert_modal_txt').text(ext +" is not an accepted file type.");
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        //alert(name + ' - Filesize is too big.' );
                        $('#alertModal').modal('show');
                        $('.alert_modal_txt').text(name + ' - Filesize is too big.' );
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        //alert(uploadErrors.join("\n"));
                        $('#alertModal').modal('show');
                        $('.alert_modal_txt').text(uploadErrors.join("\n"));
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
        url: $('#add_new_log').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#add_new_log')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
	}
});

//file upload list
$(function() {
	if(file_upload_list_page_user != 100)
	{
    uploaded_doc_content_form();
	}
});
function uploaded_doc_content_form() {
	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	var builder_id = $("#builder_id").val();
	var folderid = $("#folder_id").val();
	var moduleid = $("#log_id").val();
	var projectid = $("#project_id").val();
	var encoded_string = Base64.encode('logs/get_uploaded_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
						'tableName': $('#uploaded_doc_content'),
						'this_table' : {'table_name':'uploaded_doc_content'},
						'ajax_encoded_url':encoded_val,
						//'parent_id' : '{"folderid":"'+folderid+'"}',
						'folder_id' : 'folder_id',
						'post_data':'{"builder_id":"'+builder_id+'","folderid":"'+folderid+'","moduleid":"'+moduleid+'","projectid":"'+projectid+'"}',
						'display_columns' : [{"data": "file_name", "bSortable": false},{"data": "date", "bSortable": false},{"data": "date", "bSortable": false}],
						'default_order_by': [[0, 'desc']]
					};
	// Populate data table
	ubdatatable_docs(dbobject);
}