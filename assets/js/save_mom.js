/** 
 * Meeting js
 *
 * @category: Meeting
 * @author: Satheesh Kumar N
 * @createdon(DD-MM-YYYY): 09-04-2015 
*/
/* $(function(){	
    var tree_data;
	var jsonUrl = base_url + 'assets/js/docs_tree.json';
	$.getJSON(jsonUrl,function(data){
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
	$(window).load(function(){
		$("#docs_upload_Modal .modal-con").mCustomScrollbar({
			setHeight:250,
			theme:"dark-3"
		});	
	});	
}); */
//checking project status -- code added by satheesh kumar
$(function() {
	var ub_mom_id = $('#ub_mom_id').val();   
	if(ub_mom_id == '' || ub_mom_id == 0)
	{
		check_project_status('projects/meeting/');
	}
	else if(project_status_check == false)
	{
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Project was closed. You can not able to edit');
		//alert('you can not edit');
	}
	/* checking project status code ends here*/
});

$(function() {
	save_mom_form();
	 $('#datetimepicker5').datetimepicker({	pickTime: false	});
	 $('#datetimepicker9').datetimepicker({ pickDate: false });
	 $('.file_uploaded_div').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	});
	
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
	
	
});
//Add and stay
$('#add_mom_new_stay').on('click',function(e) {
		$("#save_type").val('save_and_stay');
		var project_val = $('#title').val();						
		var datetime_val = $('#datetime').val();						
		var attendees_val = $('#attendees').val();						
		var conducted_by = $('#conducted_by').val();						
		if(project_val == '' || datetime_val == '' || attendees_val == null || conducted_by == 0){		
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill mandatory fields');
			//return false;
		}
		else{		 
			//$('.error-message').show();
			//$('.error-message .alerts').removeClass('alert-danger');
			//$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('Updated Results search succesfully');
			add_formval();			
			e.preventDefault();
		}		
});
	
	//Add and new
$('#add_mom_new').on('click',function(e) {
	$("#save_type").val('save_and_new');
	var priority = $('#save_type').val();
	var project_val = $('#title').val();						
	var datetime_val = $('#datetime').val();						
	var attendees_val = $('#attendees').val();						
	var conducted_by = $('#conducted_by').val();						
		if(project_val == '' || datetime_val == '' || attendees_val == null || conducted_by == 0){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill mandatory fields');
		}
		else{		 
			/* $('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Updated Results search succesfully'); */
			add_formval();			
			e.preventDefault();
		}	
});

//Add and back
$('#add_mom_new_back').on('click',function(e) {	
		$("#save_type").val('save_and_back');
		var project_val = $('#title').val();						
		var datetime_val = $('#datetime').val();						
		var attendees_val = $('#attendees').val();						
		var conducted_by = $('#conducted_by').val();						
		if(project_val == '' || datetime_val == '' || attendees_val == null || conducted_by == 0){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill mandatory fields');
		}
		else{		 
			/* $('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Updated Results search succesfully'); */
			add_formval();			
			e.preventDefault();
		}
});

function add_formval() {
	// Encode the String
	  //alert("danga");return false;
	var encoded_string = Base64.encode('projects/save_meeting/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('projects/meeting/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	//var project_id = $('#project').val();
	var description = CKEDITOR.instances['editor1'].getData();
	var ajaxData  = $("#add_new_mom").serialize();	
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData+ '&description=' + description,			
		success: function(response) {	
			if(response.status == true)
			{	
				$.when(file_upload(response.ub_mom_id)).done(function()
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
					  
						var encoded_string_edit_log = Base64.encode( 'projects/save_meeting/' + response.ub_mom_id);
						var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
						//console.log(encoded_edit_val);
						window.location.href = encoded_edit_val;
						// console.log(response.insert_id);
					}
					$(".error-message .alerts").removeClass('alert-danger');
					$(".error-message .alerts").addClass('alert-success');
					$(".error-message").show();
					if(response.message)
					{
						success_msg = response.message;
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
                }   
                $(".alerts").html(failure_msg);				
			}
			return false;
		}
	});	
}

/*Delete mom
*
*
*
*
*/
function delete_meeting(ub_mom_id){
    if(ub_mom_id > 0)
    {
    var encoded_delete_roles = Base64.encode('projects/delete_meeting/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('projects/meeting/');
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
						data: {'ub_mom_id':{ub_mom_id:ub_mom_id}},
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
        $(".alerts").html("MOM id is not set");      
    }
}

// Drop Down Add / Edit // code added by satheesh kumar
$(document).ready(function(){   
    var selected = $('#location').find("option:selected").val();
	$('#edit_location_group').val(selected);
	$('#selected_location').val(selected);
	var selected = $('#tagType').find("option:selected").val();
	$('#edit_tag_group').val(selected);
	$('#selected_tag').val(selected);
	var selected = $('#meetingType').find("option:selected").val();
	$('#edit_meeting_group').val(selected);
	$('#selected_meeting').val(selected);
});
/* tag Drop Down Add / Edit / Delete */
$('#tagType').on('change', function() {
	var selected = $(this).find("option:selected").val();
	$('#edit_tag_group').val(selected);
	$('#selected_tag').val(selected);
});
$('#save_type_tag').click(function() {
	var value = $('#tag_group').val();
	var encoded_url = Base64.encode('projects/update_general_value/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var classification = 'meeting_tags';
	var operation_type = 'add';
	xhr = $.ajax({
		type: "POST",
		dataType: "json",
		data: {"classification":classification,"type":operation_type,"value":value},
		url: base_url + ajax_encoded_url,
		success: function (response) {
			if(response.status == true)
			{
				$('#tagType').append($("<option value=" + value + ">" + value + "</option>").text(value));
				$(".selectpicker").selectpicker("refresh");
				// alert("Added successfully");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Added successfully');
				$("#TagAddModal").modal('hide');
			}else
			{
				// alert("Insertion failed");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Insertion failed');
			}
		}
	}); 
});
$('.TagEditModal').click(function() {
	var n = $('#tagType').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
	if (n === 1) {
		$('#TagEditModal').modal({
			show: true
		});
		$('#Edit_project_delete').click(function() {
			var sat = $('#edit_tag_group').val();
			var selected_val = $('#selected_tag').val();
			if (selected_val == selected_val) {
				$('#tagType option[value=' + selected_val + ']').remove();
			}
			if (sat == sat) {
				$('#tagType').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
			}
			$('#tagType').next().find('.dropdown-menu li.selected a .text').empty();
			$('#tagType').next().find('.dropdown-menu li.selected a .text').append(sat);
			$('#tagType').next().find('.selectpicker .filter-option').empty();
			$('#tagType').next().find('.selectpicker .filter-option').append(sat);
		});
		$('#tag_group_delete').click(function() {
			var value = $('#edit_tag_group').val();
			if (value == value) {
				$('#tagType option[value="' + value + '"]').remove();
			}
			var encoded_url = Base64.encode('projects/update_general_value/');
			var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			var classification = 'meeting_tags';
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
						$('#edit_tag_group').val('');
						$('#tagType').next().find('.dropdown-menu li.selected').remove();
						$('#tagType').next().find('.selectpicker .filter-option').empty();
						$('#tagType').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
						$(".selectpicker").selectpicker("refresh");
						// alert("Deleted successfully");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text('Deleted successfully');
						$("#TagEditModal").modal('hide');
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
/* /tag Drop Down Add / Edit / Delete */


/* location Drop Down Add / Edit / Delete */
$('#location').on('change', function() {
	var selected = $(this).find("option:selected").val();
	$('#edit_location_group').val(selected);
	$('#selected_location').val(selected);
});
$('#save_location').click(function() {
	var value = $('#location_group').val();
	var encoded_url = Base64.encode('projects/update_general_value/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var classification = 'meeting_location';
	var operation_type = 'add';
	xhr = $.ajax({
		type: "POST",
		dataType: "json",
		data: {"classification":classification,"type":operation_type,"value":value},
		url: base_url + ajax_encoded_url,
		success: function (response) {
			if(response.status == true)
			{
				$('#location').append($("<option value=" + value + ">" + value + "</option>").text(value));
				$(".selectpicker").selectpicker("refresh");
				// alert("Added successfully");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Added successfully');
				$("#locationAddModal").modal('hide');
			}else
			{
				// alert("Insertion failed");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Insertion failed');
			}
		}
	}); 
});
$('.locationEditModal').click(function() {
	var n = $('#location').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
	if (n === 1) {
		$('#locationEditModal').modal({
			show: true
		});
		$('#Edit_project_delete').click(function() {
			var sat = $('#edit_location_group').val();
			var selected_val = $('#selected_location').val();
			if (selected_val == selected_val) {
				$('#location option[value=' + selected_val + ']').remove();
			}
			if (sat == sat) {
				$('#location').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
			}
			$('#location').next().find('.dropdown-menu li.selected a .text').empty();
			$('#location').next().find('.dropdown-menu li.selected a .text').append(sat);
			$('#location').next().find('.selectpicker .filter-option').empty();
			$('#location').next().find('.selectpicker .filter-option').append(sat);
		});
		$('#location_group_delete').click(function() {
			var value = $('#edit_location_group').val();
			if (value == value) {
				$('#location option[value="' + value + '"]').remove();
			}
			var encoded_url = Base64.encode('projects/update_general_value/');
			var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			var classification = 'meeting_location';
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
						$('#edit_location_group').val('');
						$('#location').next().find('.dropdown-menu li.selected').remove();
						$('#location').next().find('.selectpicker .filter-option').empty();
						$('#location').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
						$(".selectpicker").selectpicker("refresh");
						// alert("Deleted successfully");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text('Deleted successfully');
						$("#locationEditModal").modal('hide');
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

/* meeting type Drop Down Add / Edit / Delete */
$('#meetingType').on('change', function() {
	var selected = $(this).find("option:selected").val();
	$('#edit_meeting_group').val(selected);
	$('#selected_meeting').val(selected);
});
$('#save_meeting').click(function() {
	var value = $('#meeting_group').val();
	var encoded_url = Base64.encode('projects/update_general_value/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var classification = 'meeting_type';
	var operation_type = 'add';
	xhr = $.ajax({
		type: "POST",
		dataType: "json",
		data: {"classification":classification,"type":operation_type,"value":value},
		url: base_url + ajax_encoded_url,
		success: function (response) {
			if(response.status == true)
			{
				$('#meetingType').append($("<option value=" + value + ">" + value + "</option>").text(value));
				$(".selectpicker").selectpicker("refresh");
				// alert("Added successfully");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Added successfully');
				$("#MeetingAddModal").modal('hide');
			}else
			{
				// alert("Insertion failed");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Insertion failed');
			}
		}
	}); 
});
$('.MeetingEditModal').click(function() {
	var n = $('#meetingType').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
	if (n === 1) {
		$('#MeetingEditModal').modal({
			show: true
		});
		$('#Edit_project_delete').click(function() {
			var sat = $('#edit_meeting_group').val();
			var selected_val = $('#selected_meeting').val();
			if (selected_val == selected_val) {
				$('#meetingType option[value=' + selected_val + ']').remove();
			}
			if (sat == sat) {
				$('#meetingType').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
			}
			$('#meetingType').next().find('.dropdown-menu li.selected a .text').empty();
			$('#meetingType').next().find('.dropdown-menu li.selected a .text').append(sat);
			$('#meetingType').next().find('.selectpicker .filter-option').empty();
			$('#meetingType').next().find('.selectpicker .filter-option').append(sat);
		});
		$('#meeting_group_delete').click(function() {
			var value = $('#edit_meeting_group').val();
			if (value == value) {
				$('#meetingType option[value="' + value + '"]').remove();
			}
			var encoded_url = Base64.encode('projects/update_general_value/');
			var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			var classification = 'meeting_type';
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
						$('#edit_meeting_group').val('');
						$('#meetingType').next().find('.dropdown-menu li.selected').remove();
						$('#meetingType').next().find('.selectpicker .filter-option').empty();
						$('#meetingType').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
						$(".selectpicker").selectpicker("refresh");
						// alert("Deleted successfully");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text('Deleted successfully');
						$("#MeetingEditModal").modal('hide');
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

/* Project MOM Save Form Validation */
function save_mom_form(){
 FormValidation.Validator.conductedby = {
        validate: function(validator, $field, options) {
            var value = $field.val();
            if (value == 0) {
                return false;
            }
            return true;
        }
    };	
	var save_mom_result_form = $('#add_new_mom').find('[name="attendees[]"], [name="conducted_by"]').selectpicker().change(function(e) {            
                $('#add_new_mom').formValidation('revalidateField', 'attendees[], conducted_by');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_mom_new_stay, #add_mom_new, #add_mom_new_back'			
        },
        fields: {
            'title': {
                validators: {
                    notEmpty: {
                        message: 'Project Title Cannot empty'
                    }
                }
            },
			'datetime': {
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
			'attendees[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select the Attendees'
                    }
                }
            },
			'conducted_by': {
                validators: {
                    conductedby: {
                        message: 'Please select the conducted by'
                    }
                   
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#save_type").val() == 'save_and_stay'){
				add_formval();				
			 }
			 else if($("#save_type").val() == 'save_and_new'){
				 add_formval();
			 }	
			else if($("#save_type").val() == 'save_and_back'){
				 add_formval();
			 }						 
			e.preventDefault();
	  });
	$('#datetimepicker5').on('dp.change dp.show', function(e) {		
        $('#add_new_mom').formValidation('revalidateField', 'datetime');
    });	
	$(document).on('click','.glyphicon.glyphicon-remove', function(e) {		
        $('#add_new_mom').formValidation('revalidateField', 'datetime');
    });
	
}
/* /Projects MOM Save Form Validation */

//#########  file upload  #########

$(function(){
	var encoded_string = Base64.encode('projects/get_doc_hierarchy/');
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
	 $(window).load(function() {
        $("#docs_upload_Modal .modal-con").mCustomScrollbar({
            setHeight: 250,
            theme: "dark-3"
        });

    });
});

$(function () {

    'use strict';
    
    var temp_id = $("#temp_directory_id").val();    

    //alert(temp_id); 
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('projects/upload/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#add_new_mom').fileupload({
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

            var encoded_string = Base64.encode('projects/allowed_extension/');
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
						$('.alert_modal_txt').text(name + ' - Filesize is too big.');
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
		url: $('#add_new_mom').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#add_new_mom')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
});

//file upload
function file_upload(insert_id)
{
	var temp_directory_id = $("#temp_directory_id").val();
	var folderid = $("#folder_id").val();
	var moduleid = insert_id;
	var modulename = 'mom';
	var projectid = $('#project').val();
	var encoded_string = Base64.encode('projects/get_temp_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var response = $.ajax({
		url: base_url + encoded_val,
		//dataType: "json",
		type: "post",
		data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid + '&moduleid='+moduleid + '&projectid='+projectid + '&modulename='+modulename,			
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
	var encoded_string = Base64.encode('projects/copy_file_to_temp/');
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
		url: $('#add_new_mom').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#add_new_mom')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$("#add_new_mom").find(".files").empty();
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
}
