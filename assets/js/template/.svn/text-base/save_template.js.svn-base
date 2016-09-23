$(function(){
  $('#datetimepicker8').datetimepicker({
    pickTime: false
  });
});//checking project status -- code added by satheesh kumar




	imgLink = base_url + 'assets/images/'; 		


/* 
 Set your save type
 */
$(function() {  
    add_formval();    
    $('#add_template_new_stay').click(function(e) { 
		$("#save_type").val('save_and_stay'); 
		$('#current_tab').val('');
		var project_group = $('#project_group').val();
		var template_name = $('#template_name').val();	 
		if(project_group == null || template_name == ''){      
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields'); 
		}
		else{      
			add_template_form();
			e.preventDefault();
		}
    });
    $('#add_template_new').click(function(e) {
        $("#save_type").val('save_and_new'); 
        $('#current_tab').val('');
		var project_group = $('#project_group').val();
		var template_name = $('#template_name').val();	 
		if(project_group == null || template_name == ''){      
		   error_box();
		   $('.error-message .alerts').text('Please fill all mandatory fields');         
		}
		else{    
		  add_template_form();
		  e.preventDefault();
		} 
    });
    $('#add_template_new_back').click(function(e) {
        $("#save_type").val('save_and_back'); 
        $('#current_tab').val('');
		var project_group = $('#project_group').val();
		var template_name = $('#template_name').val();	 
		if(project_group == null || template_name == ''){      
     
		  error_box();
		  $('.error-message .alerts').text('Please fill all mandatory fields');         
		}
		else{		  
		  add_template_form();
		  e.preventDefault();
		}   
    });

    $('#btn_cancel').click(function(e) {   
         $('#current_tab').val('');
         var encoded_home_string = Base64.encode('template/projects/index/');
         var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
         window.location.href = encoded_home_val; 
         e.preventDefault();      
    }); 
      
    });  
function add_formval(){  
    var bidform = $('#save_template').find('[name="project_group[]"]').selectpicker().change(function(e) {            
                $('#save_template').formValidation('revalidateField', 'project_group[]');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled', 				
     button: {
            selector: '#add_template_new_back, #add_template_new_stay, #add_template_new'          
        },
        fields: {
            'project_group[]': {
                validators: {
                    notEmpty: {
                        message: 'The project group cannot be empty'
                    }          
                }
            },
			 'template_name': {
                validators: {
                    notEmpty: {
                        message: 'The template name cannot be empty'
                    }          
                }
            }
			
           
        } 
    
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {      		  
			add_template_form();             
			e.preventDefault();      
    }); 
  
}  

 



/*
Add/ Update Log
*/
function add_template_form() {
    // Encode the String
    var encoded_string = Base64.encode('template/projects/save_templates/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('template/projects/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';

    var ajaxData  = $("#save_template").serialize();
    //var ub_daily_log_id = $('#ub_daily_log_id').val();    
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,
		/*beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			 
        },	*/	
        success: function(response) {           
            if(response.status == true)
            {   
				//$('.uni_wrapper').removeClass('loadingDiv');
               
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
                    
                     var encoded_string_edit_log = Base64.encode('template/projects/save_templates/' + response.insert_id);
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
function delete_template(log_ids_obj){
    if(log_ids_obj > 0)
    {
    var encoded_delete_roles = Base64.encode('template/projects/delete_template/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('template/projects/index/');
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
            data: {'ub_template_id':{ub_template_id:log_ids_obj}},
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
//Project Group Modal

$('#project_group').on('change', function() {
        var selected = $(this).find("option:selected").val();
        $('#edit_project_group').val(selected);
        $('#selected').val(selected);
    });
    $('#project_group_save').click(function() {
        var value = $('#new_project_group').val();
    var encoded_url = Base64.encode('template/projects/update_general_value/');
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
          alert("Added successfully");
          $("#TypeAddModal").modal('hide');
        }else
        {
          alert("Insertion failed");
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
        var encoded_url = Base64.encode('template/projects/update_general_value/');
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