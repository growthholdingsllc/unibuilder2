$(function(){
	checkbox();
	update_result_form();
	// $('group').each(
    // function(i,e){
        // $(e).find('input:radio').attr('name', 'group' + i);
    // });
});

$('#save_plan').click(function(e) {
// alert("hi");		
		var planname = $('#plan-name').val();						
		var cost = $('#cost').val();						
		var group1 = $( "input[name$='group1']" ).val();						
		var group2 = $( "input[name$='group2']" ).val();			
		if(planname == '' || cost == '' || group1 == 'on' || group2 == 'on'){			
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
			$('.error-message .alerts').text('Plan Added succesfully');			
			save_add_plan() ;
			e.preventDefault();
		}
    });
	
$('#cancel').click(function(e) {
// alert("hi");
	var encoded_home_string = Base64.encode('admin/plans/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	window.location.href = encoded_home_val;
		e.preventDefault();
    });

function save_add_plan()
{

	var encoded_string = Base64.encode('admin/plans/save_plan/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('admin/plans/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#add_new_plan").serialize();
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
				$('.uni_wrapper').removeClass('loadingDiv');
				$('.error-message').show();
				$('.error-message .alerts').removeClass('alert-danger');
				$('.error-message .alerts').addClass('alert-success');
				$('.error-message .alerts').text('Plan Added succesfully');		
				window.location.href = encoded_home_val;
			}
			return false;
		}
	});	

}


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

function update_result_form(){	
	var updateresultform = $('#add_new_plan').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save_plan'			
        },
        fields: {
			 'plan_name': {
                validators: {
                    notEmpty: {
                        message: 'The plan name cannot be empty'
                    }
                }
            },
			'plan_amount': {
                validators: {
                    notEmpty: {
                        message: 'The cost cannot be empty'
                    },
					integer: {
                        message: 'The value is not an integer'
                    }
                }
            },
            'group1': {
                validators: {
                    notEmpty: {
                        message: 'Please select any one'
                    }
                }
            },
			'group2': {
                validators: {
					notEmpty: {
						 message: 'Please select any one'
					}
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  			
			save_add_plan();							
			e.preventDefault();			 
	  }).find('input[name="group1"], input[name="group2"]')
           .on('ifChanged', function(e) {
                // Get the field name
                var field = $(this).attr('name');
                $('#add_new_plan').formValidation('revalidateField', field);
            }).end();	
}

$("#delete_plan").click(function(){
		delete_plan();
		
	});
/* code to delete the project*/
function delete_plan(plan_ids_obj)
{
	var encoded_string = Base64.encode('admin/plans/delete_user_plan/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var encoded_home_string = Base64.encode('admin/plans/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	//var edit_page = $('#edit_page').val();
	//var ajaxData  = $("#delete_plan").serialize();
	 $.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: {'ub_plan_id':{ub_plan_id:plan_ids_obj}},	
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
			window.location.href = encoded_home_val ;
			}
			else
			{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text(response.message);
			return false;
			}
		}
	});	

}
