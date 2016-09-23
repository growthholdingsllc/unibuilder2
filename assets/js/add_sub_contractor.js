imgLink = base_url + 'assets/images/';
$(document).ready(function() {
	$('#desk_phone').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	$('#mobile_phone').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	$(document).on('keyup', '.days', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	
	
    var max_fields      = 10;
    var wrapper         = $(".input_fields_wrap");
    var add_button      = $(".add_field_button");    
    var x = 1;
    $(add_button).click(function(e){
		
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div class="clon"><div class="row"><div class="col-xs-4"><label>Name Of Certificate</label><input type="text" class="form-control" name="certificate_name[]" id="certificate_name" /></div><div class="col-xs-4"><label>Expires</label><div class="input-group datetimepicker5 date"><input type="text" class="form-control" name="reminder_start_date[]" id="reminder_start_date"><span class="input-group-addon"> <span class="glyphicon-calendar glyphicon"></span> </span> </div></div><div class="col-xs-4"><label>Reminder</label><div class="row"><div class="col-xs-4"><input type="text" class="form-control days" name="reminds_in_days[]" id="reminds_in_days" /></div><div class="col-xs-2">Day(s)</div><div class="col-xs-4"><select class="selectpicker form-control" name="reminder_type[]" id="reminder_type" ><option value="">Nothing selected</option><option>Before</option><option>After</option></select></div><div class="col-xs-2">Expires</div></div></div></div><div class="col-xs-12"><div class="preview_file"><div class="imagePreview"></div><div class="close_file"><a href="javascript:void(0);" class="close-file"><img src="' + imgLink + 'file_close.png"/></a></div></div><div class="file_name"></div><div class="btn btn-blue btn-file browse"> <img class="uni_attchment_second" src="' + imgLink + 'strip.gif"/> Browse<input type="file" name="attachments[]" class="file_up"  /></div></div><div class="col-xs-12"><button class="btn btn-gray pull-right m-left-1 remove_field" type="button"><img src="'+imgLink+'strip.gif" class="uni_cancel_new"/> Remove</button><br/><div class="col-xs-12"><hr/></div></div></div>'); //add input box
        }
		datepick();
		
    });    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
       // e.preventDefault(); 	
	   /* Below code was added by chandru */
	    var fileid = $(this).parent().find('.remove_val').val(); 
		var encoded_string = Base64.encode('subcontractor/delete_file/');
		var encoded_val = encoded_string.strtr(encode_chars_obj);
		$.ajax({
			url: base_url + encoded_val,
			dataType: "json",
			type: "post",
			data: 'fileid='+fileid,         
			success: function(response) { 
				// window.location.reload();
			}
		});
		$(this).parent().parent('.clon, .wrapper').remove(); 		
		x--;
    })
});
$(function(){
	$('.datetimepicker5').datetimepicker({
		pickTime: false
	});
});
function datepick(){
	$('.datetimepicker5').datetimepicker({
		pickTime: false
	});
	$('.date').find('input').attr('readonly', true);
	$('.date').find('input').after('<a href="javascript:void(0);" class="glyphicon glyphicon-remove"></a>');
}
$(function(){
	$('.drop-down-show-hide').hide();
	$('#accessmethod').change(function(){
		$(this).find("option").each(function()
		{
			$('.' + this.value).hide();
		});
		$('.' + this.value).show();
	});	
	if($("#login_enabled").prop('checked') == false){	
		$('.log-disable').hide();
	}
	Login_enabled();
		
});	
function Login_enabled(){
	$(document).on('ifChecked','#login_enabled', function(event){
		//alert(1);
		$(this).attr('checked','checked');		
		$("#accessmethod").prop("disabled", false);
		$(".disabled_prop").prop("disabled", false);		
		$(".disabled_input").prop("disabled", false);		
		$(".disabled_prop").addClass("btn-primary");	
		$('.access-log').show();
		
	});	
	$(document).on('ifUnchecked','#login_enabled', function(event){
		//alert(2);
		$(this).removeAttr("checked");			
		$('.selectpicker').selectpicker('deselectAll');	
		$('.log-disable').hide();      		
	});	
	
}
$(function() { 
	// user_jobs_site_view();
	var url = window.location.href;
	var hash = url.substring(url.indexOf("#"));
	if (hash == "#Project_Access")
	{
		user_jobs_site_view();
	}
   $(document).on( 'shown.bs.tab', 'a[href="#Project_Access"]', function (){ 		
		user_jobs_site_view();
   });
});

function user_jobs_site_view() {
	var encoded_url = Base64.encode('subcontractor/get_all_projects_user_involved/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        // Data table Object
    var ub_subcontractor_id = $('#user_id').val(); 
 
        var dbobject = {                    
                            'tableName': $('#user_jobs_site_view'),
                            'ajax_encoded_url':ajax_encoded_url,
                            'id':'project_name',
                            'name': "project_name",
							'this_table' : {'table_name':'user_jobs_site_view'},
                            'post_data':'{"ub_subcontractor_id":"'+ub_subcontractor_id+'"}',
                            'delete_data':{}, 
                            'edit_data':{},
                            'display_columns' : [{"data": "project_name"},{"data": "role_name"},{"data": "project_status"},{"data": "project_group"},{"data": "projected_start_date"}],
                            'default_order_by': [[0, 'desc']]
                        };

        // Populate data table
        ubdatatable(dbobject);
}

//Below code was added bu chandru

//checkbox code

//Insert code starts here
$(function() {
	add_formval();
	//Add and back
	$('#add_sub_contractor_user_list_save_and_back').on('click',function(e) {
			$("#save_type").val('save_and_back');
			var company 		= $('#company').val();		
			var first_name 		= $('#first_name').val();		
			var primary_email 	= $('#primary_email').val();		
			var date_format 	= $('#date_format').val();		
			var time_zone 		= $('#time_zone').val();				
			var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;			
			if(company == '' || first_name == '' || primary_email == '' || date_format == '' || time_zone == '' || valid == false){			
				error_box();
				$('.error-message .alerts').text('Please fill all mandatory fields');					
			}
			else{				
				add_sub_contractor_user_list_form();
				e.preventDefault();
			}
	});	
	//Add and Stay
	$('#add_sub_contractor_user_list_save_and_stay').on('click',function(e) {			
			$("#save_type").val('save_and_stay');
			var company 		= $('#company').val();		
			var first_name 		= $('#first_name').val();		
			var primary_email 	= $('#primary_email').val();		
			var date_format 	= $('#date_format').val();		
			var time_zone 		= $('#time_zone').val();
			var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;					
			if(company == '' || first_name == '' || primary_email == '' || date_format == '' || time_zone == '' || valid == false){			
				error_box();
				$('.error-message .alerts').text('Please fill all mandatory fields');					
			}
			else{				
				add_sub_contractor_user_list_form();
				e.preventDefault();
			}					
	});
	$('#sub_contractor_useremailinvitation').on('click',function(e) {			
			$("#save_type").val('save_and_stay_and_sent_mail');
			var company 		= $('#company').val();		
			var first_name 		= $('#first_name').val();		
			var primary_email 	= $('#primary_email').val();		
			var date_format 	= $('#date_format').val();		
			var time_zone 		= $('#time_zone').val();
			var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;
			if(company == '' || first_name == '' || primary_email == '' || date_format == '' || time_zone == '' || valid == false){			
				error_box();
				$('.error-message .alerts').text('Please fill all mandatory fields');					
			}
			else{				
				add_sub_contractor_user_list_form();
				e.preventDefault();
			}					
	});
	//Add and New
	$('#add_sub_contractor_user_list_save_and_new').on('click',function(e) {
			$("#save_type").val('save_and_new');
			var company 		= $('#company').val();		
			var first_name 		= $('#first_name').val();		
			var primary_email 	= $('#primary_email').val();		
			var date_format 	= $('#date_format').val();		
			var time_zone 		= $('#time_zone').val();
			var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;			
			if(company == '' || first_name == '' || primary_email == '' || date_format == '' || time_zone == '' || valid == false){			
				error_box();
				$('.error-message .alerts').text('Please fill all mandatory fields');					
			}
			else{				
				add_sub_contractor_user_list_form();
				e.preventDefault();
			}
	});
});
// $(document).on("submit", "#add_new_sub_contractor_user", function(event)
function add_sub_contractor_user_list_form()
{
	var encoded_string = Base64.encode('subcontractor/save_subcontractor/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var encoded_home_string = Base64.encode('subcontractor/user_subcontractor/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
   var formData = new FormData($('#add_new_sub_contractor_user')[0]);

   var accessmethod = $('#accessmethod').val();
    if(accessmethod === 'configure')
    {
        var password_length = $('#password').val().length;
        if($('#user_name').val() == '')
        {
            error_box();           
            $('.error-message .alerts').text('Username cannot be Empty');
            return false;
        }
        else if($('#password').val() == '')
        {
            error_box();           
            $('.error-message .alerts').text('Password cannot be Empty');
            return false;
        }
        else if(password_length < 5)
        {
            //alert('Password must be greater than five character');
            error_box();           
            $('.error-message .alerts').text('Password must be greater than five character');
            return false;
        }
    }
     
    $.ajax({
        url: base_url + encoded_val,
        data: formData,
		dataType: "json",
        contentType: false,
        processData: false,
        type: 'POST',
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
        success: function(response){
			$('.uni_wrapper').removeClass('loadingDiv');
            if(response.status == true)
			{	
				//console.log(response.insert_id);return false;
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
						var encoded_string_edit_log = Base64.encode( 'subcontractor/save_subcontractor/' + response.insert_id);
						var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
						window.location.href = encoded_edit_val;
                }
                else if($("#save_type").val() == 'save_and_stay_and_sent_mail')
                {
						var encoded_string_edit_log = Base64.encode( 'subcontractor/save_subcontractor/' + response.insert_id);
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
			else{
			if (response.message) {
                    failure_msg = response.message;
                }  
				error_box();              	
				$('.error-message .alerts').text(failure_msg);
			}			
			return false;
        }
    });
	return false;
}
//);
/* function add_sub_contractor_user_list_form() {
	// Encode the String
	var encoded_string = Base64.encode('subcontractor/save_subcontractor/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('subcontractor/user_subcontractor/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
    var accessmethod = $('#accessmethod').val();
    
	// var ajaxData  = $("#add_new_sub_contractor_user").serialize();	
	var ajaxData  = new FormData($('#add_new_sub_contractor_user')[0]);;	
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData,			
		success: function(response) {
			if(response.status == true)
			{	
			//console.log(response.insert_id);return false;
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
					if(response.message == 'Data inserted successfully')
					{
						var encoded_string_edit_log = Base64.encode( 'subcontractor/save_subcontractor/' + response.insert_id);
						var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
						window.location.href = encoded_edit_val;
					}
                }
				 $(".error-message .alerts").removeClass('alert-danger');
				$(".error-message .alerts").addClass('alert-success');
				$(".error-message").show();
				if(response.message)
				{
					success_msg = response.message;								
				}
				$(".alerts").html(success_msg);
				//$(".alert").html(success_msg);
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
				//$(".alert").html(failure_msg);				
			}
			return false;
		}
	});	
} */

//Delete sub_contractor
function delete_sub_contractors(ub_subcontractor_id){
    if(ub_subcontractor_id > 0)
    {
    var encoded_delete_roles = Base64.encode('subcontractor/delete_sub_contractor/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('subcontractor/user_subcontractor/');
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
            data: {'ub_subcontractor_id':{ub_subcontractor_id:ub_subcontractor_id}},
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



function add_formval(){	
	var addnewsubcontractoruser = $('#add_new_sub_contractor_user').find('[name="date_format"], [name="time_zone"]').selectpicker().change(function(e) {            
                $('#add_new_sub_contractor_user').formValidation('revalidateField', 'date_format, time_zone');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_sub_contractor_user_list_save_and_stay, #add_sub_contractor_user_list_save_and_new, #add_sub_contractor_user_list_save_and_back,#sub_contractor_useremailinvitation'			
        },
        fields: {
            'company': {
                validators: {
                    notEmpty: {
                        message: 'The company is required cannot be empty'
                    }
                }
            },
			'first_name': {
                validators: {
                    notEmpty: {
                        message: 'The first name is required cannot be empty'
                    }
                }
            },
			'primary_email': {
                validators: {
                    notEmpty: {
                        message: 'The email is required cannot be empty'
                    },
					emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            },
			'date_format': {
                validators: {
                    notEmpty: {
                        message: 'The date format is required cannot be empty'
                    }
                }
            },
			'time_zone': {
                validators: {
                    notEmpty: {
                        message: 'The time zone is required cannot be empty'
                    }
                }
            },
			'mobile_phone': {
                    validators: {
						notEmpty: {
							message: 'The cell Number cannot be empty'
						},
                        phone: {
                            country: 'countrySelectBox',
                            message: 'The value is not valid %s Cell number'
                        }
                    }
            }
			
			
        }	
		
     }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#save_type").val() == 'save_and_stay'){
				add_sub_contractor_user_list_form();				
			 }
			else if($("#save_type").val() == 'save_and_new'){
				add_sub_contractor_user_list_form();				
			}	
			else if($("#save_type").val() == 'save_and_back'){
				add_sub_contractor_user_list_form();				
			}
			e.preventDefault();			 
	  }).on('change', '[name="countrySelectBox"]', function(e) {
            $('#add_new_sub_contractor_user').formValidation('revalidateField', 'mobile_phone');
        });	
}
 function delete_pic(file_id)
{
    var fileid = file_id;
    var encoded_string = Base64.encode('subcontractor/delete_file/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: 'fileid='+fileid,         
        success: function(response) { 
			window.location.reload();
        }
    });
}
$(function() {
    var accessmethod = $('#accessmethod').val();
    if(accessmethod === 'configure')
    {
        $('.' + accessmethod).show();
    }
});