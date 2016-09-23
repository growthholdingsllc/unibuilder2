 /* Drop Down Add / Edit / Delete */
$(document).ready(function(){   
var selected = $('#tags').find("option:selected").val();
$('#Edit_tags_group').val(selected);
$('#selected').val(selected);
});
$('#tags').on('change', function() {
	var selected = $(this).find("option:selected").val();
	$('#Edit_tags_group').val(selected);
	$('#selected').val(selected);
});
$('#save_tags').click(function() {
	var value = $('#tags_group').val();
	var encoded_url = Base64.encode('survey/update_general_value/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var classification = 'survey_tags';
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
				$("#survey_tags").modal('hide');
				$('#tags_group').val('');
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
$('.edit_survey_tags').click(function() {
	var n = $('#tags').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
	if (n === 1) {
		$('#edit_survey_tags').modal({
			show: true
		});
		$('#Edit_project').click(function() {
			var sat = $('#Edit_tags_group').val();
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
		$('#tags_group_delete').click(function() {
			var value = $('#Edit_tags_group').val();
			if (value == value) {
				$('#tags option[value="' + value + '"]').remove();
			}
			var encoded_url = Base64.encode('survey/update_general_value/');
			var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
			var classification = 'survey_tags';
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
						$('#Edit_tags_group').val('');
						$('#tags').next().find('.dropdown-menu li.selected').remove();
						$('#tags').next().find('.selectpicker .filter-option').empty();
						$('#tags').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
						$(".selectpicker").selectpicker("refresh");
						// alert("Deleted successfully");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text('Deleted successfully');
						$("#edit_survey_tags").modal('hide');
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

$(function(){	
		
	$('#add_question').modal({
		backdrop: 'static',
		keyboard: false
	});
	$('#add_question').modal('hide');
	update_survey_question_form();
	$('#edit_save_survey_question').hide();
        var panelList = $('#survey_field_list');
        panelList.sortable({            
            handle: '.panel-heading', 
            update: function() {
                $('.panel', panelList).each(function(index, elem) {
                     var $listItem = $(elem),
                     newIndex = $listItem.index();
                });
            }
        });	
		
		$(document).on('ifChecked','#inc_app', function(event){
			$(this).val('Yes');
		});
		$(document).on('ifUnchecked','#inc_app', function(event){
			$(this).val('No');	
		});				
		$(document).on('click', '.add_question', function(){
			//alert(1);
			$('#ub_survey_id').val($('#ub_survey_id').val());
			$('#add_question').modal('show');
			$('h4 span.title').text('Add Question');
			$('#save_survey_question').show();
			$('#edit_save_survey_question').hide();
			$('#survey_field_list').addClass('add_question');
			var no_record = $('#survey_field_list li').length;
			if(no_record > 0){
				$('.no_ques').hide();
			}
			else{
				$('.no_ques').show();
			}
		});
		$(document).on('click', '.edit_survey_question', function(){
			// alert(this.id);
			$('#survey_field_list li').removeClass('selected');
			$(this).parent().parent().parent().parent().parent().parent().parent().addClass('selected');
			$('#add_question').modal('show');
			$('#save_survey_question').hide();
			$('#edit_save_survey_question').show();
			$('h4 span.title').text('Edit Question');			
			var res_col_name_field 		= $(this).parent().parent().parent().parent().find('.res_col_name_field').text();
			var ans_type_field		 	= $(this).parent().parent().parent().parent().find('.ans_type_field').text();
			var q_notes_field		 	= $(this).parent().parent().parent().parent().find('.q_notes_field').text();
			var inlcude_app_field		= $(this).parent().parent().parent().parent().find('.inlcude_app_field').text();
			var question_id		= $(this).parent().parent().parent().parent().find('.question_id').text();
			// alert(question_id);
			var survey_id             =$('#ub_survey_id').val();
			// alert(survey_id);
			if(inlcude_app_field == 'Yes'){
				$('#inc_app').iCheck('check');
			}
			else{
				$('#inc_app').iCheck('uncheck');				
			}			
			$('#question_notes').val(q_notes_field);
			$('#res_col_name').val(res_col_name_field);
			$('#ans_type').val(ans_type_field);
			$('#inc_app').val(inlcude_app_field);
			$('#ub_survey_id').val(survey_id);
			//alert($('#inc_app').val());
			if($('#inc_app').val() == 'Yes')
			{
				$('#inc_app').closest('.icheckbox_square-red').addClass('checked');   
                $('#inc_app').attr("checked", "checked");
			}
			else if($('#inc_app').val() == 'No')
			{
				$('#visibile_to_subs').closest('.icheckbox_square-red').removeClass('checked');   
                $('#visibile_to_subs').removeAttr("checked", "checked");
			}
			$('#ub_survey_question_id').val(question_id);
			$('.selectpicker').selectpicker('refresh');
		});
		$(document).on('click', '#question_cancel', function(){	
			$('#survey_field_list li').removeClass('selected');
			$('#survey_field_list').removeClass('add_question');
		});
		$('#add_question').on('hidden.bs.modal', function () {
			  $('#question_form').formValidation('resetForm', true);
			  $(this).find('form')[0].reset();
			  $('.selectpicker').selectpicker('refresh');
		});		
		$(document).on('click', '#delete_survey_question', function(){
			$(this).parent().parent().parent().parent().parent().parent().parent().remove();
			var no_record = $('#survey_field_list li').length;
			if(no_record > 0){
				$('.no_ques').hide();
			}
			else{
				$('.no_ques').show();
			}
		});
});	

function update_survey_question_form(){
		var commentform = $('#question_form').formValidation({        
		excluded: [':disabled'],
		 button: {
            selector: '#save_survey_question , #edit_save_survey_question',          
        },
        fields: {
            'question_notes': {
                validators: {
                    notEmpty: {
                        message: 'The Question cannot be empty'
                    }
                }
            },
			'res_col_name': {
                validators: {
                    notEmpty: {
                        message: 'The column name cannot be empty'
                    }
                }
            },
			'ans_type': {
                validators: {
                    notEmpty: {
                        message: 'The answer type cannot be empty'
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
		  if($('#survey_field_list').hasClass("add_question")){
			// save_question();
			save_new_survey_question();
			$('#add_question').modal('hide');
			$('#survey_field_list').removeClass('add_question');
			$('#survey_field_list li').removeClass('selected');
		  }
		  if($('#survey_field_list li').hasClass("selected")){
		  	save_new_survey_question();
			//edit_save_survey_question();
			$('#add_question').modal('hide');
		}
			var no_record = $('#survey_field_list li').length;
			if(no_record > 0){
				$('.no_ques').hide();
			}
			else{
				$('.no_ques').show();
			}
			e.preventDefault();			
	  });	  
	
}

function save_survey_question(ub_survey_question_id){
			// alert(ub_survey_question_id);
		//if(ub_survey_question_id != "undefined"){
			var q_notes 		= $('#question_notes').val();
			var res_col_name 	= $('#res_col_name').val();
			var ans_type		= $('#ans_type').val();
			var inlcude_app		= $('#inc_app').val();						;
			$('#survey_field_list').append('<li class="panel panel-info"><div class="panel-heading"><table width="100%" class="table borderless"><tr><td width="50" rowspan="3"><img border="0" alt="sort" class="sort_img" src="' + imgLink + 'sort.png"></td><td width="150"><label>Answer Type:</label></td><td width="150"><span class="ans_type_field">'+ans_type+'</span></td><td width="120"><label>Response Feild:</label></td><td width="300"><span class="res_col_name_field">'+res_col_name+'</span></td><td>&nbsp;</td></tr><tr><td colspan="4" class="question_box"><p><label>Question:</label> <span class="q_notes_field">'+q_notes+'</span><span class="question_id hide">'+ub_survey_question_id+'</span></p></td><td><div class="pull-right"><button type="button" class="btn btn-blue edit_survey_question" id='+ub_survey_question_id+' value='+ub_survey_question_id+'><img border="0" alt="edit" class="uni_edit" src="'+imgLink + 'strip.gif"> Edit</button> <button type="button" class="btn btn-blue" id="'+ub_survey_question_id+'" onclick="deletesurveyquestion('+ub_survey_question_id+')"><img border="0" alt="edit" class="uni_delete" src="'+imgLink+'strip.gif"> Delete</button></div></td></tr><tr><td width="150"><label>Include Not applicable:</label></td><td colspan="4"><span class="inlcude_app_field">'+inlcude_app+'</span></td></tr></table></div></li>');
		 //}
			
		} 			
		
function edit_save_survey_question(ub_survey_question_id){			
	var q_notes 		= $('#question_notes').val();
	var res_col_name 	= $('#res_col_name').val();
	var ans_type		= $('#ans_type').val();
	var inlcude_app		= $('#inc_app').val();	
	$('#survey_field_list li.selected').html('<div class="panel-heading"><table width="100%" class="table borderless"><tr><td width="50" rowspan="3"><img border="0" alt="sort" class="sort_img" src="' + imgLink + 'sort.png"></td><td width="150"><label>Answer Type:</label></td><td width="150"><span class="ans_type_field">'+ans_type+'</span></td><td width="120"><label>Response Feild:</label></td><td width="300"><span class="res_col_name_field">'+res_col_name+'</span></td><td>&nbsp;</td></tr><tr><td colspan="4" class="question_box"><p><label>Question:</label> <span class="q_notes_field">'+q_notes+'</span><span class="question_id hide">'+ub_survey_question_id+'</span></p></td><td><div class="pull-right"><button type="button" class="btn btn-blue edit_survey_question" id='+ub_survey_question_id+' value='+ub_survey_question_id+'><img border="0" alt="edit" class="uni_edit" src="'+imgLink + 'strip.gif"> Edit</button> <button type="button" class="btn btn-blue" id="'+ub_survey_question_id+'" onclick="deletesurveyquestion('+ub_survey_question_id+')"><img border="0" alt="edit" class="uni_delete" src="'+imgLink+'strip.gif"> Delete</button></div></td></tr><tr><td width="150"><label>Include Not applicable:</label></td><td colspan="4"><span class="inlcude_app_field">'+inlcude_app+'</span></td></tr></table></div>');
}

//-------------------------------------------**********************---------------------------------------

//Add and stay
$('#survey_save_and_stay').on('click',function(e) {
		$("#save_type").val('save_and_stay');
		var name_val = $('#name').val();		
		var save_question_field = $('.ans_type_field,.res_col_name_field,.q_notes_field,.inlcude_app_field').map(function() { return $(this).text(); }).get().join();					
		// alert(save_question_field);
		if(name_val == ''){		
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill name');
			return false;
		}
		else
		{		 
			save_new_survey();
			e.preventDefault();			
		}		
});
//Add and back
$('#survey_save_and_back').on('click',function(e) {	
		$("#save_type").val('save_and_back');
		var name_val = $('#name').val();												
		if(name_val == ''){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill name');
			return false;
		}
		else{		 
			save_new_survey();
			e.preventDefault();	
		}
});
//Add and release
$('#survey_save_release').on('click',function(e) {	
		$("#save_type").val('save_and_release');
		$("#status").val('Released');
		var name_val = $('#name').val();
		var assign_val = $('#assigned_user').val();
		var question_id = $('.question_id').map(function() { return $(this).text(); }).get().join();
		//alert(question_id);return false;
		if(name_val == ''){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill name');
			return false;
		}
		else if(assign_val == null){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please select assigned users');
			return false;
		}
		else if(question_id == ''){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('please create questions');
			return false;
		}
		else{		 
			save_new_survey();
			e.preventDefault();	
		}
});
function save_new_survey()
{
	var question_id = $('.question_id').map(function() { return $(this).text(); }).get().join();
	// alert(question_id);return false;
	var ub_survey_id = $('#ub_survey_id').val();
	var encoded_string = Base64.encode('survey/new_survey/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('survey/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#save_survey_form").serialize();
	// alert(ajaxData.toSource());
	$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData+ '&question_id=' + question_id,	
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			 
        },		
		success: function(response) {	
			if(response.status == true)
			{	
				$('.uni_wrapper').removeClass('loadingDiv');
				if($("#save_type").val() == 'save_and_back')
				{
					window.location.href = encoded_home_val + '#Response';
				}
				else if($("#save_type").val() == 'save_and_stay')
				{
					var encoded_string_edit_log = Base64.encode('survey/new_survey/' + response.insert_id);
					var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
					//console.log(encoded_edit_val);
					//window.location.href = encoded_edit_val;
					// console.log(response.insert_id);
				}
				else if($("#save_type").val() == 'save_and_release')
				{
					var encoded_string_edit_log = Base64.encode('survey/new_survey/' + response.insert_id);
					var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
					window.location.href = encoded_edit_val;
					location.reload(true);
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

/*-------------------save survey question------------------------*/
$('#save_survey_question').click(function(e) {
 // alert("hi");		
        $("#save_question_type").val('add');	
		var question = $('#question_notes').val();							
		if(question == '' ){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');								
		}
		/*else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Question Added succesfully');			
			save_survey_question();
			save_new_survey_question();
			e.preventDefault();
		}*/
    });

	$('#edit_save_survey_question').click(function(e) {
		$("#save_question_type").val('edit');	
		var question = $('#question_notes').val();							
		if(question == '' ){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');								
		}
		/*else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Question Updated succesfully');			
			edit_save_survey_question();
			edit_new_survey_question();
			e.preventDefault();
		}*/
    });
/*function edit_new_survey_question()
{

	var encoded_string = Base64.encode('survey/new_survey_question/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var ub_survey_question_id = $('#ub_survey_question_id').val();
	var encoded_home_string = Base64.encode('survey/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#question_form").serialize();
	$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,	
		success: function(response) {	
			if(response.status == true)
			{	
				// $("#response-message").text('Updated successfully');
			}
			
			return false;
		}
	});	
		
}*/	
	
function save_new_survey_question()
{
	var project_id = $('#project_id').val();
	var survey_question_id = $('#survey_question_id').val();
	var survey_question_type = $('#save_question_type').val();
	var encoded_string = Base64.encode('survey/new_survey_question/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('survey/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#question_form").serialize();
	$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData+ '&project_id=' + project_id,	
		success: function(response) {	
			if(response.status == true)
			{	
		        //save_survey_question(response.insert_id);
				// $("#response-message").text('Updated successfully');
				if(survey_question_type == 'add')
				{
					save_survey_question(response.insert_id);
				}
		        else
				{
					// alert("hello");
					edit_save_survey_question(response.insert_id);
				}			 
			}
			//edit_save_survey_question();
			
			return false;
		}
	});	
}

function deletesurvey(ub_survey_id){
//alert(ub_survey_template_id);
    if(ub_survey_id > 0)
    {
    var encoded_delete_roles = Base64.encode('survey/delete_survey/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('survey/index/');
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
					data: {'ub_survey_id':{ub_survey_id:ub_survey_id}},
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
        $(".alerts").html("Survey id is not set");      
    }
}

function deletesurveyquestion(ub_survey_question_id){
//alert(ub_survey_template_id);
    if(ub_survey_question_id > 0)
    {
    var encoded_delete_roles = Base64.encode('survey/delete_survey_question/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('survey/index/');
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
					data: {'ub_survey_question_id':{ub_survey_question_id:ub_survey_question_id}},
					success: function(response) {   
						if(response.status == true)
						{   
							$(".error-message .alerts").removeClass('alert-danger');
							$(".error-message .alerts").addClass('alert-success');
							$(".error-message").show();
							if(response.message)
							{
								success_msg = response.message;
								location.reload();                            
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
        $(".alerts").html("Question id is not set");      
    }
}

$(document).on('click', '.complete_survey', function()
{ 
	$('#survey_question').val(this.id);
	var encoded_url = Base64.encode('survey/save_survey_request/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);

	var notapplicable = $('#notapplicable').val();
	var survey_question_id = $('#survey_question_id').val();
	var answer = $('#answer_type').val();

	var ajaxData  = $("#question_answer_form").serialize();
	//alert(ajaxData);
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: ajaxData,
		success: function(response) { 
			$('#complete_survey').hide();
			if(response.status == true)
			{   
				success_box();
				$(".alerts").html(response.message);
			}
			else
			{               
				error_box();
				$(".alerts").html(response.message);         
			}
			return false; 
		}
	});
		
});
