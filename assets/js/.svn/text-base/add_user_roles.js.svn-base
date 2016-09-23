$(function() {	
$('.parent_table').each(function() {
	var aaa = $(this).find('td.menu_name').length;						
	if(aaa > 10){
		$(this).parent().parent().addClass('parent_table_td');
		$(this).parent().addClass('parent_table_div');
		$(this).addClass('parent_table_table');
	}
});	
	update_result_form();
	$(document).on('ifChecked','.user_role_check', function(){
		$(this).val('Yes');
		$(this).parent().next('.project_hidden').val("1"); 
	});
	$(document).on('ifUnchecked','.user_role_check', function(){
		$(this).val('No');
		$(this).parent().next('.project_hidden').val("0"); 
	});
	$('#pro-group').on('change', function(){
		var selected = $(this).find("option:selected").val();
		$('#Edit_project_group').val(selected);
		$('#selected').val(selected);
	});
	$('#save').click(function(){
		var sat = $('#project_group').val();		
		$('#pro-group').append($("<option value="+ sat +">"+ sat +"</option>").text(sat)); 	
		$(".selectpicker").selectpicker("refresh");						
	});		
	$('.TypeEditModal').click(function(){		
		var n = $('#pro-group').next().find('.dropdown-menu.inner.selectpicker li.selected').length;				
		if(n === 1){
			$('#TypeEditModal').modal({
				show: true
			});						
			$('#Edit_project').click(function(){				
				var sat = $('#Edit_project_group').val();
				var selected_val = $('#selected').val();
				if(selected_val == selected_val){
					$('#pro-group option[value='+ selected_val +']').remove();
				}
				if(sat == sat){										
					$('#pro-group').append($("<option value="+ sat +">"+ sat +"</option>").text(sat)); 
				}				
				$('#pro-group').next().find('.dropdown-menu li.selected a .text').empty();
				$('#pro-group').next().find('.dropdown-menu li.selected a .text').append(sat);		
				$('#pro-group').next().find('.selectpicker .filter-option').empty();
				$('#pro-group').next().find('.selectpicker .filter-option').append(sat);		
			});
			$('#Delete_project').click(function(){		
				var sat = $('#Edit_project_group').val();
				if(sat == sat){
					$('#pro-group option[value='+ sat +']').remove();
				}
				$('#Edit_project_group').val('');		
				$('#pro-group').next().find('.dropdown-menu li.selected').remove();		
				$('#pro-group').next().find('.selectpicker .filter-option').empty();		
				$('#pro-group').next().find('.dropdown-toggle.selectpicker').removeAttr('title');						
			});			
		}
		else if(n > 1){
			// alert('select only one at a time');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('select only one at a time');
		}
		else if(n === 0){
			// alert('Please select');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select');
		}
	});
});


//Add and stay
$('#add_role_new_stay').on('click',function(e) { 
		$("#save_type").val('save_and_stay');
		var mandatory = $('#role_name').val();		
		if(mandatory == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{			
			add_role_form();					
			e.preventDefault();
		}
});

//Add and New
$('#add_role_new').on('click',function(e) {
		$("#save_type").val('save_and_new');
		var mandatory = $('#role_name').val();		
		if(mandatory == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{			
			add_role_form();					
			e.preventDefault();
		}
});

$('#add_role_new_back').on('click',function(e) {
		$("#save_type").val('save_and_back');
		var mandatory = $('#role_name').val();		
		if(mandatory == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{			
			add_role_form();					
			e.preventDefault();
		}
});


function add_role_form() {
	var encoded_string = Base64.encode('user/add_userroles/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('user/user_roles/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#save_role").serialize();
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,			
		success: function(response){
		// console.log(response);return false;
			if(response.status == true)
			{
				// console.log(response.ub_project_id);
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
					
                    var encoded_string_edit_log = Base64.encode( 'user/add_userroles/' + response.ub_role_id);
                    var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                    //console.log(encoded_edit_val);
                    window.location.href = encoded_edit_val;
                    // console.log(response.insert_id);
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
function update_result_form(){	
	var updateresultform = $('#save_role').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_role_new, #add_role_new_back, #add_role_new_stay'			
        },
        fields: {
            'role_name': {
                validators: {
                    notEmpty: {
                        message: 'The role name cannot be empty'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			add_role_form();
			e.preventDefault();			 
	  });  
}

/* Check All user roles */
$(document).on('ifChecked','#add_check', function(event){	
	$('.user_role_0').closest('.icheckbox_square-red').addClass('checked');		
	$('.user_role_0').attr("checked", "checked");	
});
$(document).on('ifUnchecked','#add_check', function(event){
	$('.user_role_0').closest('.icheckbox_square-red').removeClass('checked');		
	$('.user_role_0').removeAttr("checked", "checked");	
});
$(document).on('ifChecked','#edit_check', function(event){
	$('.user_role_1').closest('.icheckbox_square-red').addClass('checked');		
	$('.user_role_1').attr("checked", "checked");	
});
$(document).on('ifUnchecked','#edit_check', function(event){	
	$('.user_role_1').closest('.icheckbox_square-red').removeClass('checked');		
	$('.user_role_1').removeAttr("checked", "checked");	
});
$(document).on('ifChecked','#delete_check', function(event){	
	$('.user_role_2').closest('.icheckbox_square-red').addClass('checked');		
	$('.user_role_2').attr("checked", "checked");	
});
$(document).on('ifUnchecked','#delete_check', function(event){	
	$('.user_role_2').closest('.icheckbox_square-red').removeClass('checked');		
	$('.user_role_2').removeAttr("checked", "checked");	
});
$(document).on('ifChecked','#view_all_check', function(event){
	$('.user_role_3').closest('.icheckbox_square-red').addClass('checked');		
	$('.user_role_3').attr("checked", "checked");	
});
$(document).on('ifUnchecked','#view_all_check', function(event){	
	$('.user_role_3').closest('.icheckbox_square-red').removeClass('checked');		
	$('.user_role_3').removeAttr("checked", "checked");	
});



$(document).on('ifChecked','#add_check', function(){
	$('.user_role_0').val('Yes');
	$('.user_role_0').parent().next('.project_hidden').val("1"); 
});
$(document).on('ifUnchecked','#add_check', function(){
	$('.user_role_0').val('No');
	$('.user_role_0').parent().next('.project_hidden').val("0"); 
});
$(document).on('ifChecked','#edit_check', function(){
	$('.user_role_1').val('Yes');
	$('.user_role_1').parent().next('.project_hidden').val("1"); 
});
$(document).on('ifUnchecked','#edit_check', function(){
	$('.user_role_1').val('No');
	$('.user_role_1').parent().next('.project_hidden').val("0"); 
});
$(document).on('ifChecked','#delete_check', function(){
	$('.user_role_2').val('Yes');
	$('.user_role_2').parent().next('.project_hidden').val("1"); 
});
$(document).on('ifUnchecked','#delete_check', function(){
	$('.user_role_2').val('No');
	$('.user_role_2').parent().next('.project_hidden').val("0"); 
});
$(document).on('ifChecked','#view_all_check', function(){
	$('.user_role_3').val('Yes');
	$('.user_role_3').parent().next('.project_hidden').val("1"); 
});
$(document).on('ifUnchecked','#view_all_check', function(){
	$('.user_role_3').val('No');
	$('.user_role_3').parent().next('.project_hidden').val("0"); 
});

$(function(){
    var total_modules = $('#total_modules').val();
    if($('.user_role_0:checked').length == total_modules)
    {
        $('#add_check').closest('.icheckbox_square-red').addClass('checked');   
        $('#add_check').attr("checked", "checked");
    }
    if($('.user_role_1:checked').length == total_modules)
    {
        $('#edit_check').closest('.icheckbox_square-red').addClass('checked');   
        $('#edit_check').attr("checked", "checked");
    }
	 if($('.user_role_2:checked').length == total_modules)
    {
        $('#delete_check').closest('.icheckbox_square-red').addClass('checked');   
        $('#delete_check').attr("checked", "checked");
    }
	 if($('.user_role_3:checked').length == total_modules)
    {
        $('#view_all_check').closest('.icheckbox_square-red').addClass('checked');   
        $('#view_all_check').attr("checked", "checked");
    }

}); 