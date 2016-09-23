// iterate over all checked checkboxes with class box
$(function(){
    var total_modules = $('#total_modules').val();
    if($('#checkbox6:checked').length == total_modules)
    {
        $('#email_check').closest('.icheckbox_square-red').addClass('checked');   
        $('#email_check').attr("checked", "checked");
    }
    if($('#checkbox7:checked').length == total_modules)
    {
        $('#text_check').closest('.icheckbox_square-red').addClass('checked');   
        $('#text_check').attr("checked", "checked");
    }

});

$(function(){
	update_result_form();
	Login_enabled();
	$('.log-disable').hide(); 
	
	$('#desk_phone').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){ return ''; }) );
    });
	$('#mobile_phone').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){ return ''; }) );
    });
	
});	
function Login_enabled(){
	$(document).on('ifChecked','#login-enabled', function(event){			
		$('.log-disable').show(); 
		
	});	
	$(document).on('ifUnchecked','#login-enabled', function(event){		
		$('.log-disable').hide();     		
	});
}

$(function(){
$('#alt-email-to').tagsinput({		
	allowDuplicates: false
});
$('.alt-email-to').hide();
$(document).on('ifChecked','#toemailinput', function(event){
	$('.alt-email-to').show();
});
$(document).on('ifUnchecked','#toemailinput', function(event){
	$('.alt-email-to').hide();
});
});

imgLink = base_url + 'assets/images/'; 
/* Schedule */
$(function() {
   user_jobs_site_view();
});
 function user_jobs_site_view() {
        $('#user_jobs_site_view').dataTable({
            "aLengthMenu": [
                [5, 15, 50, 100],
                [5, 15, 50, "l00"]
            ],
            "iDisplayLength": 5,           
           sAjaxSource: base_url + 'assets/js/jsonuserjobssiteview.json',
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0] // <-- gets last column and turns off sorting
            }],
			"columns":[
            {
				"sTitle":'<input type="checkbox"/>',
                "defaultContent":'<input type="checkbox"/>',
				"className": 'da-tab-checkbox',
                "orderable":  false,
                "data":       null
            },
            { "sTitle":'Job Name',"data": "jobname"},
            { "sTitle":'Role',"data": "role" },
            { "sTitle":'Job Status',"data": "jobstatus" },
            { "sTitle":'Job Group',"data": "jobgroup" },
            { "sTitle":'Job Opened',"data": "jobopened" }
        ],
        "order": [[1, 'asc']]

        });
}
$(function(){    
    $('#update_user_profile').click(function(e) {     
		var mandatory = $('#first_name').val();		
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
			update_user_profile();
			e.preventDefault();
		}	             
    });
});

function update_user_profile()
{
    var encoded_string = Base64.encode('preferences/update_user_profile/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('preferences/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);

    var signature_text = CKEDITOR.instances['editor1'].getData();
    //var ajaxData  = $("#user_profile").serialize();
    var ajaxData  = new FormData($('#user_profile')[0]);
    ajaxData.append("signature_text", signature_text);
	
    $.ajax({
    url: base_url + encoded_val,
    dataType: "json",
    type: "post",
    data: ajaxData,         
	contentType: false,
	processData: false,
    success: function(response) {           
        if(response.status == true)
        {   
            
            $(".error-message .alerts").removeClass('alert-danger');
            $(".error-message .alerts").addClass('alert-success');
            $(".error-message").show();
            if(response.message)
            {
                success_msg = response.message;
				window.location.href = encoded_home_val;
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

function update_result_form(){	
	var updateresultform = $('#user_profile').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_user_profile'			
        },
        fields: {
            'first_name': {
                validators: {
                    notEmpty: {
                        message: 'The Name cannot be empty'
                    }
                }
            },
			'mobile_phone': {
                validators: {
                    notEmpty: {
                        message: 'The mobile number cannot be empty'
                    },
					phone: {
                            country: 'countrySelectBox',
                            message: 'The value is not valid %s Cell number'
                        }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 update_user_profile();
			e.preventDefault();			 
	  }).on('change', '[name="countrySelectBox"]', function(e) {
            $('#add_new_lead, #add_new_lead_prime').formValidation('revalidateField', 'mobile_phone');
        });				  
}

//delete pic
function delete_pic(file_id)
{
    var fileid = file_id;
    var encoded_string = Base64.encode('preferences/delete_file/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: 'fileid='+fileid,         
        success: function(response) { 
			$('#uploader').val('');
			setTimeout(function(){  
                location.reload();
            }, 500);
        }
    });
}

$(document).on('ifChecked','#email_check', function(event){	
	$('.mail_chk').closest('.icheckbox_square-red').addClass('checked');		
	$('.mail_chk').attr("checked", "checked");	
});
$(document).on('ifUnchecked','#email_check', function(event){	
	$('.mail_chk').closest('.icheckbox_square-red').removeClass('checked');		
	$('.mail_chk').removeAttr("checked", "checked");	
});

$(document).on('ifChecked','#text_check', function(event){	
	$('.txt_chk').closest('.icheckbox_square-red').addClass('checked');		
	$('.txt_chk').attr("checked", "checked");	
});
$(document).on('ifUnchecked','#text_check', function(event){	
	$('.txt_chk').closest('.icheckbox_square-red').removeClass('checked');		
	$('.txt_chk').removeAttr("checked", "checked");	
});