/* Below clone checkbox code was added by chadnru 16-05-2014 */
$(function() {
	var ub_task_id = $('#ub_task_id').val();  	
	if(ub_task_id == '' || ub_task_id == 0)
	{
		check_project_status('task/index/');
	}
	else if(project_status_check == false)
	{
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Project was closed. You can not able to edit');
		// alert('you can not edit');
	}
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
			/* $('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success'); */
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
			/* $('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success'); */
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
			/* $('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success'); */
			//$('.error-message .alerts').text('Updated Results search succesfully');
			add_task_form();
			e.preventDefault();
		}
	
});
});



//add task

function add_task_form() {
	// Encode the String
	var encoded_string = Base64.encode('template/task/save_task/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('template/task/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ub_task_id = $('#ub_task_id').val();   
	var ajaxData  = $("#add_new_task").serialize();	
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,			
		success: function(response) {
		//console.log(response);return false;		
			if(response.status == true)
			{	
				
					//alert('ggggggkkkkkkkk');
	               if($("#save_type").val() == 'save_and_new')
					{
						//file_upload(response.insert_id);
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
							var encoded_string_edit_log = Base64.encode('template/task/save_task/' + response.insert_id);
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


function deletetasks(ub_task_id){
    if(ub_task_id > 0)
    {
    var encoded_delete_roles = Base64.encode('template/task/delete_tasks/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('template/task/index/');
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
					data: {'ub_task_id':{ub_task_id:ub_task_id}},
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
        $(".alerts").html("Task id is not set");      
    }
}

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

//Tag add code

// Drop Down Add / Edit // code added by satheesh kumar
$(document).ready(function(){   
    var selected = $('#tags').find("option:selected").val();
	$('#edit_project_group').val(selected);
	$('#selected').val(selected);
});

/* Drop Down Add / Edit / Delete */
    $('#tags').on('change', function() {
        var selected = $(this).find("option:selected").val();
		// echo '<pre>';print_r($selected);exit;
        $('#edit_project_group').val(selected);
        $('#selected').val(selected);
    });
    $('#tags_save').click(function() {
        var value = $('#tags_add').val();
        var encoded_url = Base64.encode('template/task/update_general_value/');
        var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        var classification = 'task_tags';
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
                    alert("Added successfully");
                    $("#TypeAddModal").modal('hide');
                }else
                {
                    alert("Insertion failed");
                }
            }
        }); 
		}
       else
       {
         alert('Please Enter a Tag name');
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
                var encoded_url = Base64.encode('template/task/update_general_value/');
                var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
                var classification = 'task_tags';
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
                            alert("Deleted successfully");
                            $("#TypeEditModal").modal('hide');
                        }else
                        {
                            alert("Deletion failed: "+response.message);
                        }
                    }
                }); 
              
            });
        } else if (n > 1) {
            alert('select only one at a time');
        } else if (n === 0) {
            alert('Please select');
        }
    });
    /* /Drop Down Add / Edit / Delete */