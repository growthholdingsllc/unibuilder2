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
	
	var totalChars 		= 2000; 
	var countTextBox 	= $('#task_note')
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
$(function() {
	var ub_punch_list_id = $('#ub_punch_list_id').val();   
	if(ub_punch_list_id == '')
	{
		check_project_status('punchlist/index/');
	}
	else if(project_status_check == false)
	{
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('You can not edit');
		//alert('you can not edit');
	}
	add_comment_formval();
	$(document).on('ifChecked','.check-list-box', function(){	
		$(this).val('Yes');
		$(this).parent().next('.check-list-box-hidden').val("Yes"); 
	});	
	$('#days').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	$(document).on('ifUnchecked','.check-list-box', function(){
		$(this).val('No');
		$(this).parent().next('.check-list-box-hidden').val("No"); 
	});	
});
$(function(){
	var encoded_string = Base64.encode('punchlist/get_doc_hierarchy/');
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

});
imgLink = base_url + 'assets/images/'; 
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
	
	$('.checked_marked').hide();
	var mark_check = $('#marked-list').val();

	if(mark_check === 'Yes'){
		$('.checked_marked').show();
		$('.unchecked_marked').hide();
	}
	else{
		$('.checked_marked').hide();
		$('.unchecked_marked').show();
	}
	$('.unchecked_marked').click(function(){
		$(this).hide();
		$('.checked_marked').show();
		$('#marked-list').attr("checked", true);
		$('#marked-list').val("Yes");
		$('.check-list-box-hidden').val("Yes");
		/* $('.check-list-box input[type="checkbox"]').attr('checked',true);
		$('.check-list-box input[type="checkbox"]').parent().find('icheckbox_square-red').addClass('checked');  */
		$('.check-list-box').iCheck('check');
		$('.check-list-box').parent('.icheckbox_square-red').addClass('checked'); 
	});
	$('.checked_marked').click(function(){
		$(this).hide();
		$('.unchecked_marked').show();
		$('#marked-list').attr("checked", false);
		$('#marked-list').val("No");
		$('.check-list-box-hidden').val("No");
		$('.check-list-box').iCheck('uncheck');
		$('.check-list-box').parent('.icheckbox_square-red').removeClass('checked');
	});
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
	$('.check-list-box').val('0');
	$('.check-list-box').removeAttr("checked");
}
$(function(){
	$('#datetimepicker5').datetimepicker({
		pickTime: false
	});
	$('#task-time').datetimepicker({
		pickDate: false
	});		
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
	
	//Add task code
	
	
	//Add and new
$(function() {
add_formval();
$('#add_task_new').on('click',function(e) {
	$("#save_type").val('save_and_new');
		var mandatory = $('#title').val();		
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
			add_task_form();
			e.preventDefault();
		}
});

//Add and stay
$('#add_task_new_stay').on('click',function(e) {	
	$("#save_type").val('save_and_stay');
		var mandatory = $('#title').val();		
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
			add_task_form();
			e.preventDefault();
		}
 		
});

//Add and back
$('#add_task_new_back').on('click',function(e) {	
	$("#save_type").val('save_and_back');
	var mandatory = $('#title').val();		
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
			add_task_form();
			e.preventDefault();
		}
	
});
});



//add task

function add_task_form() {
	// Encode the String
	var encoded_string = Base64.encode('punchlist/save_punchlist/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('punchlist/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ub_punch_list_id = $('#ub_punch_list_id').val();   
	var ajaxData  = $("#add_new_task").serialize();	
	// alert(ajaxData);return false;
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,			
		success: function(response) {
		//console.log(response);return false;		
			if(response.status == true)
			{	
				//file_upload(response.insert_id);
			//console.log(response.insert_id);return false;
				$.when(file_upload(response.insert_id)).done(function()
				{
					// alert(response.insert_id);
	               if($("#save_type").val() == 'save_and_new')
					{
						window.location.href = encoded_val;
					}
					else if($("#save_type").val() == 'save_and_back')
					{
						//file_upload(response.insert_id);
						window.location.href = encoded_home_val;
					}
					else if($("#save_type").val() == 'save_and_stay')
	                {
	                	//file_upload(response.insert_id);
							var encoded_string_edit_log = Base64.encode( 'punchlist/save_punchlist/' + response.insert_id);
							var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
							window.location.href = encoded_edit_val;
	                }
					$(".error-message .alerts").removeClass('alert-danger');
					$(".error-message .alerts").addClass('alert-success');
					$(".error-message").show();
					if(response.message)
					{	//alert(response.message);
						success_msg = response.message;	
						$('.error-message .alerts').text(success_msg);
						$('.error-message').show();						
					} 
					$(".alerts").html(success_msg);	
	            }
	            );
			}
			else
			{	
				$(".error-message .alerts").removeClass('alert-success');
				$(".error-message .alerts").addClass('alert-danger');		
				$(".error-message").show(); 
				if(response.message)
				{
					failure_msg = response.message;
					$('.error-message .alerts').text(failure_msg);
					$('.error-message').show();
				}	
				$(".alerts").html(failure_msg);				
			}
			return false;
		}
	});	
}

//comment code

 $(function() {
    $(document).on('ifChecked','#owner_show_checkbox', function(event){   
		//console.log('hi');
		//alert('c1');
        $("#owner_show_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#owner_show_checkbox', function(event){ 
        $("#owner_show_val").val("No"); 
        });  
		
		
    $(document).on('ifChecked','#owner_notify_checkbox', function(event){   
		//alert('c2');
        $("#owner_notify_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#owner_notify_checkbox', function(event){      
        $("#owner_notify_val").val("No"); 
        }); 

		
	$(document).on('ifChecked','#sub_show_checkbox', function(event){   
		//alert('c3');
        $("#sub_show_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#sub_show_checkbox', function(event){      
        $("#sub_show_val").val("No"); 
        });   
		
	$(document).on('ifChecked','#sub_notify_checkbox', function(event){     
		//alert('c4');
        $("#sub_notify_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#sub_notify_checkbox', function(event){      
        $("#sub_notify_val").val("No"); 
        });   
		
		
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
//Add comment code



function add_comment()
{
	var task_id = $('#ub_punch_list_id').val();
	
    var comment = $('#comment').val();
    var owner_show = $('#owner_show_val').val();
    var sub_show = $('#sub_show_val').val();
    var owner_notify = $('#owner_notify_val').val();
	var sub_notify = $('#sub_notify_val').val();
     var project_id = $("#project_id").val();
    var encoded_string = Base64.encode('task/new_comments');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: "comments="+comment+"&show_owner="+owner_show+"&show_sub="+sub_show+"&task_id="+task_id+"&notify_owner="+owner_notify+"&notify_sub="+sub_notify+"&project_id="+project_id,          
        success: function(response) {           
            $("#commentModal").modal('hide');
            $.ajaxSetup({cache: false});
            $("#comments_area").load(location.href + " #comments_area");
            send_notify();

        }
        });    
}
function add_comment_formval(){
		var commentform = $('#post_your_comment').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		 button: {
            selector: '#post_comment',          
        },
        fields: {
            'comment': {
                validators: {
                    notEmpty: {
                        message: 'The comments is required and cannot be empty'
                    },
					stringLength: {
                        min: 0,
                        max: 4000,
                        message: 'The comments must be less than 4000 characters'
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
	  });
}
function send_notify()
 {
	var task_id = $('#ub_punch_list_id').val();
	var comment = $('#comment').val();
	var title = $('#title').val();
 	var project_id  = $("#project_name").val();
	var owner_notify = $('#owner_notify_val').val();
	var sub_notify = $('#sub_notify_val').val();
    var encoded_string = Base64.encode('task/send_notify/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: "&owner_notify="+owner_notify+"&sub_notify="+sub_notify+"&project_id="+project_id+"&task_id="+task_id+"&title="+title+"&comment="+comment,         
        success: function(response) {
                   
        }
        });
    $("#comment").val('');
    $('#owner_show_checkbox').closest('.icheckbox_square-red').removeClass('checked');        
    $('#owner_show_checkbox').removeAttr("checked", "checked");
    $('#sub_show_checkbox').closest('.icheckbox_square-red').removeClass('checked');        
    $('#sub_show_checkbox').removeAttr("checked", "checked");
    $('#owner_notify_checkbox').closest('.icheckbox_square-red').removeClass('checked');        
    $('#owner_notify_checkbox').removeAttr("checked", "checked");
    $('#sub_notify_checkbox').closest('.icheckbox_square-red').removeClass('checked');        
    $('#sub_notify_checkbox').removeAttr("checked", "checked");
    $("#owner_show_val").val('No');
    $("#sub_show_val").val('No');
    $("#owner_notify_val").val('No');
    $("#sub_notify_val").val('No');
 }

//Delete comment code
function delete_comment(ub_task_comment_id){    
    var encoded_delete_roles = Base64.encode('task/delete_comment/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('task/save_task/');
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
					data: {'ub_comments_id':{ub_comments_id:ub_task_comment_id}},
					success: function(response) {   
						if(response.status == true)
						{   
							//$(".error-message .alerts").removeClass('alert-danger');
							//$(".error-message .alerts").addClass('alert-success');
						   // $(".error-message").show();
							if(response.message)
							{
								//success_msg = response.message;
							   // window.location.href = index_url; 
								$.ajaxSetup({cache: false});
								$("#comments_area").load(location.href + " #comments_area");						
							}
						   // $(".alerts").html(success_msg);
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

//Delete task

/* $('#delete_tasks').onclick(function() {
		alert('success delete');return false;
        var selected = $(this).find("option:selected").val();
		
		});
 */		

function delete_punchlist(ub_punch_list_id)
{
    if(ub_punch_list_id > 0)
    {
	// alert(ub_punch_list_id);return false;
	var encoded_delete_roles = Base64.encode('punchlist/delete_punchlist/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('punchlist/index/');
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
					data: {'ub_punch_list_id':{ub_punch_list_id:ub_punch_list_id}},
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
        $(".alerts").html("punchlist id is not set");      
    }
}
//Tag add code

/* Drop Down Add / Edit / Delete */
    $('#tags').on('change', function() {
        var selected = $(this).find("option:selected").val();
        $('#edit_project_group').val(selected);
        $('#selected').val(selected);
    });
    $('#tags_save').click(function() {
        var value = $('#tags_add').val();
        var encoded_url = Base64.encode('punchlist/update_general_value/');
        var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        var classification = 'punch_list_tags';
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
                var sat = $('#Edit_project_group').val();
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
                var encoded_url = Base64.encode('punchlist/update_general_value/');
                var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
                var classification = 'punch_list_tags';
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

$(document).ready(function() {
$('.remove-checklist, .new-add-checklist, .add_checklist_div').show();
	$('.add-checklist').hide();
	$('.box').hide();
	
	$('.add-checklist').click(function(){
		$(this).hide();
		$('.remove-checklist, .add_checklist_div').show();		
		$('.new-add-checklist').show();	
		checkbox();	
		$(document).on('ifChecked','.check-list-box', function(event){						
			$(this).val('1');
			$(this).attr("checked", "checked");							
		});
		$(document).on('ifUnchecked','.check-list-box', function(event){						
			$(this).val('0');
			$(this).removeAttr("checked");				
		});	
	});
	$('.remove-checklist').click(function(){
		$(this).hide();
		$('.add-checklist').show();
		$(".new-add-checklist .clon").remove();
		$('.add_checklist_div').hide();
	});
    var max_fields      = 1000;
    var wrapper         = $(".new-add-checklist");
    var add_button      = $(".add_clone");    
    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div class="clon"><div class="row"><div class="col-xs-1"><a href="javascript:void(0);" class="remove_field"><img alt="home" src="'+imgLink+'icon_minus1_1.png"/></a></div><div class="col-xs-10"><input type="text" class="form-control" name="checklist_description[]"/></div><div class="col-xs-1"><input name="checklist_mark[]" type="checkbox" value="" class="check-list-box" /><input name="checklist_mark_hidden[]" type="hidden" value="No" class="check-list-box-hidden" /></div></div></div>'); //add input box
			checkbox();
        }
    });    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
       // e.preventDefault(); 	 
		$(this).parent().parent().parent('.clon').remove(); 			
		
		x--;
    })
});
function add_formval(){	
	var add_new_task = $('#add_new_task').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_task_new_stay, #add_task_new, #add_task_new_back'			
        },
        fields: {
            'title': {
                validators: {
                    notEmpty: {
                        message: 'Title cannot empty'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {	
			 if($("#save_type").val() == 'save_and_new'){
				add_task_form();				
			 }
			else if($("#logs_index").val() == 'save_and_stay'){
				add_task_form();				
			}	
			else if($("#logs_index").val() == 'save_and_back'){
				add_task_form();				
			}
			e.preventDefault();			 
	  });
	
}
/* File upload code starts here */
/*function to copy the files path to the hidden variable */

function file_upload(insert_id)
{
	var temp_directory_id = $("#temp_directory_id").val();
	var folderid = $("#folder_id").val();
	var moduleid = insert_id;
	var projectid = $("#project_id").val();

	var encoded_string = Base64.encode('punchlist/get_temp_filename/');
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

function copy_file_path(file_path)
{
	$('#temp_file_path').val(file_path);
	$(".upload_alerts").html('');
}

function copy_file_to_temp()
{
	var file_path = $('#temp_file_path').val();
	var temp_id = $("#temp_directory_id").val();
	var encoded_string = Base64.encode('punchlist/copy_file_to_temp/');
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
		url: $('#add_new_task').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#add_new_task')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$("#add_new_task").find(".files").empty();
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

    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('punchlist/upload/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#add_new_task').fileupload({
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
                // alert(name + ' - Already exixt.' );
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text(name + ' - Already exixt.');
                return false;
            }
            // code to validate the directory name end.

            var encoded_string = Base64.encode('punchlist/allowed_extension/');
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
                        // alert("Not an accepted file type.");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(ext +' is not an accepted file type.');
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        // alert(name + ' - Filesize is too big.' );
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(name + ' - Filesize is too big.' );
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        // alert(uploadErrors.join("\n"));
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
        url: $('#add_new_task').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#add_new_task')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
    }
});


/* $(function() {
	if(file_upload_list_page_user != 100)
	{
    uploaded_doc_content_form();
	}
});
function uploaded_doc_content_form() {
	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	var builder_id = $("#builder_id").val();
	var folderid = $("#folder_id").val();
	var moduleid = $("#ub_punch_list_id").val();
	var projectid = $("#project_id").val();

	var encoded_string = Base64.encode('punchlist/get_uploaded_filename/');
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
 */