//checking project status -- code added by satheesh kumar
$(function() {
	var ub_workday_exception_id = $('#ub_workday_exception_id').val();   
	if(ub_workday_exception_id == '' || ub_workday_exception_id == 0)
	{
		check_project_status('schedules/index/');
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
	save_workday_exception_form();
	$('#datetimepicker5').datetimepicker({ pickTime: false });
    $('#datetimepicker6').datetimepicker({ pickTime: false });	
});
$(function(){
	$('body ul.drag-ele').on('click', 'li', function() {
	   $(this).toggleClass('selected'); 
	});
	$('#sub_move_left').click(function() {
		$('.sub_list1').append($('.sub_list2 .selected').removeClass('selected'));				
	});
	$('#sub_move_right').click(function() {
		$('.sub_list2').append($('.sub_list1 .selected').removeClass('selected'));	
	});
	/* Viewing Access Search */
    $('#subs_left').keyup(function() {
        var valThis = $(this).val().toUpperCase();
        if (valThis == "") {
            $('.sub_list1 > li').show();
        } else {
            $('.sub_list1 > li').each(function() {
                var text = $(this).text().toUpperCase();
                (text.indexOf(valThis) == 0) ? $(this).show(): $(this).hide();
            });
        };
    });
    $('#subs_right').keyup(function() {
        var valThis = $(this).val().toUpperCase();
        if (valThis == "") {
            $('.sub_list2 > li').show();
        } else {
            $('.sub_list2 > li').each(function() {
                var text = $(this).text().toUpperCase();
                (text.indexOf(valThis) == 0) ? $(this).show(): $(this).hide();
            });
        };
    });    
    /* /Viewing Access Search */
	
}); 
/* category Add/EDIt/Delete code was added by cahdnru 12-05-2015 */
/* Drop Down Phase Add / Edit / Delete */
$('#category').on('change', function() {
    var selected = $(this).find("option:selected").val();
    $('#Edit_category_group').val(selected);
    $('#selected').val(selected);
});
$('#category_saveing').click(function() {
    var value = $('#category_save').val();
    var encoded_url = Base64.encode('schedules/update_general_value/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
    var classification = 'workday_exception_category';
    var operation_type = 'add';
    xhr = $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            "classification": classification,
            "type": operation_type,
            "value": value
        },
        url: base_url + ajax_encoded_url,
        success: function(response) {
            if (response.status == true) {
                $('#category').append($("<option value=" + value + ">" + value + "</option>").text(value));
                $(".selectpicker").selectpicker("refresh");
                // alert("Added successfully");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Added successfully');
                $("#CategoryAddModal").modal('hide');
            } else {
                // alert("Insertion failed");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Insertion failed');
            }
        }
    });
});
$('.CategoryEditModal').click(function() {
    var n = $('#category').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
    if (n === 1) {
        $('#CategoryEditModal').modal({
            show: true
        });
        $('#Edit_project').click(function() {
            var sat = $('#Edit_phase_group').val();
            var selected_val = $('#selected').val();
            if (selected_val == selected_val) {
                $('#category option[value=' + selected_val + ']').remove();
            }
            if (sat == sat) {
                $('#category').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
            }
            $('#category').next().find('.dropdown-menu li.selected a .text').empty();
            $('#category').next().find('.dropdown-menu li.selected a .text').append(sat);
            $('#category').next().find('.selectpicker .filter-option').empty();
            $('#category').next().find('.selectpicker .filter-option').append(sat);
        });
        $('#Delete_category').click(function() {
            var value = $('#Edit_category_group').val();
            if (value == value) {
                $('#category option[value="' + value + '"]').remove();
            }
            var encoded_url = Base64.encode('schedules/update_general_value/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var classification = 'workday_exception_category';
            var operation_type = 'delete';
            dataobj = {
                "classification": classification,
                "type": operation_type,
                "value": value
            };
            xhr = $.ajax({
                type: "POST",
                dataType: "json",
                data: dataobj,
                url: base_url + ajax_encoded_url,
                success: function(response) {
                    if (response.status == true) {
                        $('#Edit_category_group').val('');
                        $('#category').next().find('.dropdown-menu li.selected').remove();
                        $('#category').next().find('.selectpicker .filter-option').empty();
                        $('#category').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
                        $(".selectpicker").selectpicker("refresh");
                        // alert("Selected category was Deleted successfully");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text('Selected category was Deleted successfully');
                        $("#CategoryEditModal").modal('hide');
                    } else {
                        // alert("Deletion failed: " + response.message);
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text("Deletion failed: " + response.message);
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
/* category Drop Down Add / Edit / Delete code Ends here */
/* Chandru code ends here */

/* Save code was added by chandru */
$(function(){
//Add and stay
$('#workday_exception_save_and_back').on('click',function(e) {
	$("#save_type").val('save_and_back');
	var title = $('#title').val();
	var start_date = $('#start_date').val();
	if(title == '' || start_date == ''){
		error_box();
		$('.error-message .alerts').text('Please fill all mandatory fields');		
	}
	else{
		add_schedule_exception_form();
		e.preventDefault(); 	
	}
});

//Add and New
$('#workday_exception_save_and_stay').on('click',function(e) { 
		$("#save_type").val('save_and_stay');
		var title = $('#title').val();
		var start_date = $('#start_date').val();
		
		if(title == '' || start_date == ''){
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');						
		}
		else{
			 add_schedule_exception_form();
			 e.preventDefault(); 
		}
});

//Add and Back
$('#workday_exception_save_and_new').on('click',function(e) {
	$("#save_type").val('save_and_new');
	var title = $('#title').val();
	var start_date = $('#start_date').val();
	if(title == '' || start_date == ''){
		error_box();
		$('.error-message .alerts').text('Please fill all mandatory fields');		
	}
	else{		
		add_schedule_exception_form();
		e.preventDefault(); 	
	}
});
$('#workday_exception_cancel').on('click',function(e) {
	var encoded_home_string = Base64.encode('schedules/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 
	window.location.href = encoded_home_val;
});
});

/* save code added by cahdnru */
function add_schedule_exception_form() {
    // Encode the String
    var encoded_string = Base64.encode('schedules/save_work_day_exception/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('schedules/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    
    var ajaxData  = $("#save_workday_exception").serialize();
    var project = $("#project_id").val();
    var ub_daily_log_id = $('#ub_workday_exception_id').val();
    
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');
        },
        success: function(response) {           
			$('.uni_wrapper').removeClass('loadingDiv');
            if(response.status == true)
            {   
                if($("#save_type").val() == 'save_and_new')
                {
                    window.location.href = encoded_val;
                }
                else if($("#save_type").val() == 'save_and_back')
                {
					var type = '#workdays';
                    window.location.href = encoded_home_val+type;
                }
                else if($("#save_type").val() == 'save_and_stay')
                {
                    
                     var encoded_string_edit_log = Base64.encode( 'schedules/save_work_day_exception/' + response.inserted_id);
                     var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                     window.location.href = encoded_edit_val;
                    
                }                
                if(response.message)
                {
                    success_msg = response.message;
                }				
				success_box();
				$('.error-message .alerts').text(success_msg);	               
            }
            else
            {                   
                if(response.message)
                {
                    failure_msg = response.message;
                }                               
				error_box();				
				$('.error-message .alerts').text(failure_msg);
            }
            return false;
        }
    }); 
   
}

function save_workday_exception_form(){	
		$('#save_workday_exception').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#workday_exception_save_and_new, #workday_exception_save_and_stay, #workday_exception_save_and_back'			
        },
        fields: {
            'title': {
                validators: {
                    notEmpty: {
                        message: 'The title cannot be empty'
                    }
                }
            },
			'start_date': {
                validators: {
					notEmpty: {
						 message: 'The date is required'
					},
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is required'
                    }
                }
            }
        }
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		 
			add_schedule_exception_form();		  
			e.preventDefault();			 
	  });	
	$('#datetimepicker5').on('dp.change dp.show', function(e) {		
        $('#save_workday_exception').formValidation('revalidateField', 'start_date');
    });
	$(document).on('click','.glyphicon.glyphicon-remove', function(e) {			
        $('#save_workday_exception').formValidation('revalidateField', 'start_date');
    });	
}
/* Workday exception code was added by chandru 15-10-2015 */
function delete_workdays(ub_workday_exception_id){
    if(ub_workday_exception_id > 0)
    {
		var encoded_delete_roles = Base64.encode('schedules/delete_workday/');
		var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
		var index_string = Base64.encode('schedules/index/');
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
					data: {'ub_workday_exception_id':{ub_workday_exception_id:ub_workday_exception_id}},
					beforeSend: function() {
						$('.uni_wrapper').addClass('loadingDiv');
					},
					success: function(response) {   
					$('.uni_wrapper').removeClass('loadingDiv');
						if(response.status == true)
						{   
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