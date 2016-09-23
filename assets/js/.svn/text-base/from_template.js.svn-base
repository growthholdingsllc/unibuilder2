$(function(){
	$('#datetimepicker8').datetimepicker({
		pickTime: false
	});
});

$(function() {	
    template_form();
    $('#template_save_back').click(function(e) { 

        var project_name = $('#project_name').val();      
        var template_id = $('#template_id').val();      
        var projected_start_date = $('#projected_start_date').val();      
        if(project_name == '' || template_id == '' || projected_start_date == ''){           
            error_box();
            $('.error-message .alerts').text('Please fill all mandatory fields');                   
        }
        else{            
            add_project_template();
            e.preventDefault();
        }
         
    });
    $('#template_cancel').click(function(e) {     
         var encoded_home_string = Base64.encode('projects/index/');
         var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
         window.location.href = encoded_home_val; 
         e.preventDefault();      
    });
    
});


function add_project_template() {
    // Encode the String
    var encoded_string = Base64.encode('projects/create_project_from_tempate/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('projects/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    
    var ajaxData  = $("#add_project_template").serialize();
 
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
				window.location.href = encoded_home_val;			
				success_box();
				$('.error-message .alerts').text('Updated successfully');	
            }
			else{
				error_box();
				$('.error-message .alerts').text('Updated failed');
			}
          }
    }); 
   
   
}

function template_form(){  
   $('#add_project_template').find('[name="template_id"]').selectpicker().change(function(e) {            
                $('#add_project_template').formValidation('revalidateField', 'template_id');
            }).end().formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',        
         button: {
            selector: '#template_save_back'          
        },
        fields: {
            'project_name': {
                validators: {
                    notEmpty: {
                        message: 'The Project Name is required cannot be empty'
                    }
                }
            },
            'template_id': {
                validators: {
                    notEmpty: {
                        message: 'The Template Id to cannot be empty'
                    }
                }
            },
			'projected_start_date': {
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
            add_project_template();                
            e.preventDefault();          
      });
	$('#datetimepicker8').on('dp.change dp.show', function(e) {		
		$('#add_project_template').formValidation('revalidateField', 'projected_start_date');
	});
	$(document).on('click','.glyphicon.glyphicon-remove', function(e) {		
		$('#add_project_template').formValidation('revalidateField', 'projected_start_date');
	});	
}

//Project Group Modal

$('#project_group').on('change', function() {
        var selected = $(this).find("option:selected").val();
        $('#edit_project_group').val(selected);
        $('#selected').val(selected);
    });
    $('#project_group_save').click(function() {
        var value = $('#new_project_group').val();
		var encoded_url = Base64.encode('projects/update_general_value/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var classification = 'project_group';
		var operation_type = 'add';
		xhr = $.ajax({
			type: "POST",
			dataType: "json",
			data: {"classification":classification,"type":operation_type,"value":value},
			url: base_url + ajax_encoded_url,
			success: function (response) {
				if(response.status == true)
				{
					$('#project_group').append($("<option value=" + value + ">" + value + "</option>").text(value));
					$(".selectpicker").selectpicker("refresh");
					// alert("Added successfully");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text("Added successfully");
					$("#TypeAddModal").modal('hide');
				}else
				{
					// alert("Insertion failed");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text("Insertion failed");
				}
			}
		});	
    });
    $('.TypeEditModal').click(function() {
        var n = $('#project_group').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
        if (n === 1) {
            $('#TypeEditModal').modal({
                show: true
            });
            $('#Edit_project').click(function() {
                var sat = $('#Edit_project_group').val();
                var selected_val = $('#selected').val();
                if (selected_val == selected_val) {
                    $('#project_group option[value=' + selected_val + ']').remove();
                }
                if (sat == sat) {
                    $('#project_group').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
                }
                $('#project_group').next().find('.dropdown-menu li.selected a .text').empty();
                $('#project_group').next().find('.dropdown-menu li.selected a .text').append(sat);
                $('#project_group').next().find('.selectpicker .filter-option').empty();
                $('#project_group').next().find('.selectpicker .filter-option').append(sat);
            });
            $('#project_group_delete').click(function() {
				var value = $('#edit_project_group').val();
                if (value == value) {
                    $('#project_group option[value="' + value + '"]').remove();
                }
				var encoded_url = Base64.encode('projects/update_general_value/');
				var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
				var classification = 'project_group';
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
							$('#project_group').next().find('.dropdown-menu li.selected').remove();
							$('#project_group').next().find('.selectpicker .filter-option').empty();
							$('#project_group').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
							$(".selectpicker").selectpicker("refresh");
							// alert("Deleted successfully");
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text("Deleted successfully");
							$("#TypeEditModal").modal('hide');
						}else
						{
							// alert("Deletion failed: "+response.message);
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text("Deletion failed: "+response.message);
						}
					}
				});	
              
            });
        } else if (n > 1) {
            // alert('select only one at a time');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('select only one at a time');
        } else if (n === 0) {
            // alert('Please select');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select');
        }
    });