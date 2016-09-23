/** 
 * Registration js
 * 
 * @package: Registration js
 * @subpackage: Registration js 
 * @category: Registration
 * @author: Devansh
 * @createdon(DD-MM-YYYY): 09-05-2015
*/

// $(function() {
        // $('#credit_card_number').validateCreditCard(function(result) {
            // $('.log').html('Card type: ' + (result.card_type == null ? '-' : result.card_type.name)
                     // + '<br>Valid: ' + result.valid
                     // + '<br>Length valid: ' + result.length_valid
                     // + '<br>Luhn valid: ' + result.luhn_valid);
        // });
    // });
$(window).load(function() {   
   $('.uni_wrapper').removeClass('loadingDiv');	
});
$(function() {
	register_val();
    
    var builder_primary_email_id = $('#primary_email').val();
    {
        if (builder_primary_email_id != '') 
        {
            var ajaxData  = 'primary_email='+builder_primary_email_id;
            var encoded_string = Base64.encode('register/check_builder_status/');
            var encoded_val = encoded_string.strtr(encode_chars_obj);
            $.ajax({
                url: base_url + encoded_val,
                dataType: "json",
                type: "post",
                data: ajaxData,         
                success: function(response) {
                    //alert(response);
                    if(response.status == true)
                    {
                        
                        $(".error-message .alerts").removeClass('alert-danger');
                        $(".error-message .alerts").addClass('alert-success');
                        $(".error-message").show();
                        if(response.message)
                        {
                            success_msg = response.message;
                        }
                        $(".alerts").html(success_msg);
                        $('#builder_name').val(response.builder_detail.builder_name);
                        $('#user_name').val(response.builder_detail.username);
                        $('#first_name').val(response.builder_detail.first_name);
                        $('#last_name').val(response.builder_detail.last_name);
                        $('#desk_phone').val('1234567890');
                        $('#address1').val(response.builder_detail.address);
                        $('#city').val(response.builder_detail.city);
                        $('#province').val(response.builder_detail.province);
                        $('#country').val('USA');
                        $('#postal').val(response.builder_detail.postal);
                        
                        $("#personal_details").hide();
                        $("#billing_address").hide();
                    }
                   /* return false;*/
                }
            });
        }
    }
});

$("#primary_email").blur(function()
{
    var primary_email = $('#primary_email').val();
    var ajaxData  = 'primary_email='+primary_email;
    var encoded_string = Base64.encode('register/check_builder_status/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {

            if(response.status == true)
            {
                $(".error-message .alerts").removeClass('alert-danger');
                $(".error-message .alerts").addClass('alert-success');
                $(".error-message").show();
                if(response.message)
                {
                    success_msg = response.message;
                }
                $(".alerts").html(success_msg);
                $("#personal_details").hide();
                $("#billing_address").hide();
            }
           /* return false;*/
        }
    });
});

/*function to check the unique email id*/
function check_valid_email()
{
    var primary_email = $('#primary_email').val();
    var ajaxData  = 'primary_email='+primary_email;
    var encoded_string = Base64.encode('register/unique_email/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {

            if(response.status == true)
            {
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
           /* return false;*/
        }
    });
}
function add_builder_form() {
	// Encode the String
	//alert("hello");
	var encoded_string = Base64.encode('register/save_builder/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);	
	// var response.redirect = false;
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#form_registration1").serialize();
	//alert(ajaxData);
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
					if(response.redirect == true)
					{
					$(".error-message .alerts").removeClass('alert-danger');
                    $(".error-message .alerts").addClass('alert-success');
                    $(".error-message").show();
                    if(response.message)
                    {
                        success_msg = response.message;
                    }
					alert('New subscription have created successfully');
					/* $('#alertModal').modal('show');
					$('.alert_modal_txt').text('New subscription have created successfully'); */
					var encoded_home_string = Base64.encode('Login/index/');
                    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
                    window.location.href = encoded_home_val; 
					}else{
                   $(".error-message .alerts").removeClass('alert-danger');
                    $(".error-message .alerts").addClass('alert-success');
                    $(".error-message").show();
                    if(response.message)
                    {
                        success_msg = response.message;
                        //builderuseremailinvitation(response.userid, response.username);
                        //alert(response.username);
                    }
                    $(".alerts").html(success_msg);
                    var encoded_home_string = Base64.encode('register/register_redirect/' + response.userid);
                    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
                    window.location.href = encoded_home_val; 
            }
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
        }
    }); 
}

/* Below function was added by chandru */
function resend_activation_link(userid)
{
	var userid = userid;
	var encoded_string = Base64.encode('register/resend_email_invitation/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);	
	$.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data:'userid='+userid,       
        success: function(response) {           
            
            if(response.status == true)
            {
				alert('Activation link send successfully');
			}
			
		}
	 }); 
		
}
function builderuseremailinvitation(userid, username) {
    var email = $('#primary_email').val();
    if(email != '')
    {
	    var name=$('#first_name').val() + " " + $('#last_name').val();
	    var primary_email=$('#primary_email').val();
	    var ub_user_id = userid;
	    var username = username;
	    // Encode the String
	        var encoded_string = Base64.encode('register/builderuser_email_invitation/');
	        var encoded_val = encoded_string.strtr(encode_chars_obj);
	 
	    /*var encoded_string = Base64.encode('user/builderuser_email_invitation/');
	    var encoded_val = encoded_string.strtr(encode_chars_obj);
	    */
	    var success_msg = 'Successful';
	    var failure_msg = 'Failed';

	    var ajaxData  = 'name='+name+'&primary_email='+primary_email+'&ub_user_id='+ub_user_id+'&username='+username;       
	        $.ajax({
	        url: base_url + encoded_val,
	        dataType: "json",
	        type: "post",
	        data: ajaxData,     
	        success: function(response) {
	            if(true == response.status)
	            {
	                $(".error-message .alerts").removeClass('alert-danger');
	                $(".error-message .alerts").addClass('alert-success');
	                $(".error-message").show();
	                if(response.message)
	                {
	                    success_msg = response.message;
	                }
	                $(".alerts").html(success_msg);
	                setTimeout(function(){                       
	                // window.location.href = base_url + encoded_login_val;                       
	                }, 500);
	            }
	            else
	            {
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
   else
   {
    alert("Please Enter your primary email id");
   }
}

/* Validate */
function register_val(){
	var registervalform = $('#form_registration1').find('[name="plan_id"]').selectpicker().change(function(e) {            
                $('#form_registration1').formValidation('revalidateField', 'plan_id');
            }).end().find('[name="expiry_month"]').selectpicker().change(function(e) {            
                $('#form_registration1').formValidation('revalidateField', 'expiry_month');
            }).end().find('[name="expiry_year"]').selectpicker().change(function(e) {            
                $('#form_registration1').formValidation('revalidateField', 'expiry_year');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#registration_form1'			
        },
		 icon: {
                valid: 'fa',
                invalid: 'fa',
                validating: 'fa fa-refresh'
            },
        fields: {
            'builder_name': {
                validators: {
                    notEmpty: {
                        message: 'The Company name is cannot be empty'
                    }
                }
            },
			
			'user_name': {
                validators: {
                    notEmpty: {
                        message: 'The username is cannot be empty'
                    },
                    regexp: {
                       regexp: /^[a-zA-Z0-9_.]+$/,
                        message: 'The username can only consist of alphabetical, number and underscore'
                    }
                }
            },			
            'first_name': {
                validators: {
                    notEmpty: {
                        message: 'The First name is cannot be empty'
                    }
                }
            },
			'last_name': {
                validators: {
                    notEmpty: {
                        message: 'The Last name is cannot be empty'
                    }
                }
            },
			'primary_email': {
                validators: {
					 notEmpty: {
                        message: 'The email address is cannot be empty'
                    },
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            },
			'desk_phone': {
                validators: {
					 notEmpty: {
                        message: 'The Phone number is cannot be empty'
                    },
                    phone: {
                            country: 'mobile_isd_code',
                            message: 'The value is not valid %s Cell number'
                    }
                }
            },
			'address1': {
                validators: {
                    notEmpty: {
                        message: 'The Address is cannot be empty'
                    }
                }
            },
			'city': {
                validators: {
                    notEmpty: {
                        message: 'The City is cannot be empty'
                    }
                }
            },
			'province': {
                validators: {
                    notEmpty: {
                        message: 'The State is cannot be empty'
                    }
                }
            },
			'country': {
                validators: {
                    notEmpty: {
                        message: 'The Country is cannot be empty'
                    }
                }
            },
			'postal': {
                validators: {
                    notEmpty: {
                        message: 'The Postal is cannot be empty'
                    }
                }
            },
			'plan_id': {
                validators: {
                    notEmpty: {
                        message: 'Please select the Plan'
                    }
                }
            },
			'credit_card_number': {
                validators: {
                    notEmpty: {
                        message: 'The Credit Card is cannot be empty'
                    },
					creditCard: {
                        message: 'The credit card number is not valid'
                    }
                }
            },
			'expiry_month': {
                validators: {
                    notEmpty: {
                        message: 'Please select the Month'
                    }
                }
            },
			'expiry_year': {
                validators: {
                    notEmpty: {
                        message: 'Please select the Year'
                    }
                }
            },
			'code': {
                validators: {
					notEmpty: {
                        message: 'The CVV No is cannot be empty'
                    },
                    cvv: {
                        creditCardField: 'credit_card_number',
                        message: 'The CVV number is not valid'
                    }
                }
            },
			'cardname': {
                validators: {
                    notEmpty: {
                        message: 'The Card Name is cannot be empty'
                    }
                }
            }
			
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
			if (data.field === 'credit_card_number') {
                var $icon = data.element.data('fv.icon');
                $icon.removeClass().addClass('form-control-feedback fa ');
            }
      }).on('success.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
			if (data.field === 'credit_card_number' && data.validator === 'creditCard') {
                var $icon = data.element.data('fv.icon');
                // data.result.type can be one of
                // AMERICAN_EXPRESS, DINERS_CLUB, DINERS_CLUB_US, DISCOVER, JCB, LASER,
                // MAESTRO, MASTERCARD, SOLO, UNIONPAY, VISA

                switch (data.result.type) {
                    case 'AMERICAN_EXPRESS':
                        $icon.removeClass().addClass('form-control-feedback fa fa-cc-amex');
                        break;

                    case 'DISCOVER':
                        $icon.removeClass().addClass('form-control-feedback fa fa-cc-discover');
                        break;

                    case 'MASTERCARD':
                    case 'DINERS_CLUB_US':
                        $icon.removeClass().addClass('form-control-feedback fa fa-cc-mastercard');
                        break;

                    case 'VISA':
                        $icon.removeClass().addClass('form-control-feedback fa fa-cc-visa');
                        break;

                    default:
                        $icon.removeClass().addClass('form-control-feedback fa fa-credit-card');
                        break;
                }
            }
      }).on('success.form.fv', function(e) {	
			add_builder_form();
			//check_valid_email();
			e.preventDefault();
	  }).on('change', '[name="countrySelectBox"]', function(e) {
            $('#form_registration1').formValidation('revalidateField', 'desk_phone');
        });
}
/* Validate */