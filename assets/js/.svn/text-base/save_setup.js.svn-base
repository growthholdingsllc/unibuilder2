$(function() {
	$('.scroll-pane').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	});
	add_setup_form();
	if (typeof list_page != 'undefined') {
		co_scope_list_view();		
	}
/* Plan upgrade */
	$('.make-new-plan').hide();
	$('#upgrade_plan_to_gold').on('click', function(){
		$('.upgrade_plan_con').hide();
		$('.make-new-plan').show();
	});
	$('#plan_card_details_cancel').on('click', function(){
		$('.make-new-plan').hide();
		$('.upgrade_plan_con').show();
	});
/* /Plan upgrade */
/* Duration */ 
 $('.Duration').attr('readonly', false);
 $(".Duration").spinner({min: 0}); 
/* /Duration */
	var cointainer = $('.removeBtn').parent().parent().parent().parent().closest('.cointainer');
	var counts = $('.cointainer').children('.content').length;
	if(counts == 3){
		$('.addBtn').hide();		
	}
	if(counts <= 3){
		$('.removeBtn').removeClass('clone-hide');
	}
    if (counts == 1) {
            cointainer.find('.removeBtn').hide();
        }
	$('.removeBtn').click(function() {
    var cointainer = $(this).parent().parent().parent().parent().closest('.cointainer');
    var counts = cointainer.children('.content').length;
    counts--;
    if(counts < 3) {
        cointainer.children('.addBtn').show();         
        if (counts == 1) {
            cointainer.find('.removeBtn').hide();
        }
    }
    $(this).parent().parent().parent().parent().remove();
		cointainer.find('.label-num').text(function(idx){
        return 1 + idx
    });
});

//add button
$('.addBtn').click(function() {
    var cointainer = $(this).closest('.cointainer');	
    var counts = cointainer.children('.content').length;
    var content = $(this).prev();
    counts++;		
    if (counts > 2) {                   	
        $(this).hide();  
    }
    content.clone(true,true).insertAfter(content).find('input').val('').end().find('.label-num').text(counts);
	$('.selectpicker').data('selectpicker', null);
	$('.bootstrap-select').remove();
	$('.selectpicker').selectpicker();
    cointainer.find('.removeBtn').show();
});
	
	$('#cost_code_table tbody').on('click', 'td a.edit_cost_code', function (){
		$('#edit_cost_code').modal({ show: true });
	});	
	$('#cost_code_table tbody').on('click', 'td a.edit_variance_code', function (){
		$('#edit_variance_code').modal({ show: true });
	});
	
	$('.add_cost_code').click(function(){
		$('#add_cost_code').modal({ show: true });
	});
	$('.add_variance_code').click(function(){
		$('#add_variance_code').modal({ show: true });
	});

    $("#builder_currency").change(function(){
		$('.card_details').show();
        var builder_currency = $('#builder_currency option:selected').text();
        var classification = "builder_currency";
        var encoded_string = Base64.encode('setup/get_currency_value/');
        var encoded_val = encoded_string.strtr(encode_chars_obj);   
    
        var success_msg = 'Successful';
        var failure_msg = 'Failed';
        //alert(ajaxData);
        $.ajax({
            url: base_url + encoded_val,
            dataType: "json",
            type: "post",
            data: 'builder_currency=' + builder_currency + '&classification=' + classification,          
            success: function(response) {           
                
                if(response.status == true)
                {
                    $('#builder_currency_type').val(response.values['0']['type']);
                    $('#builder_currency_symbol').val(response.values['0']['value']);
                }
                else
                {   
                    $(".alerts").html(failure_msg);              
                }
            }
        }); 
    });  
});

function update_builder_form(){
    var formData = new FormData($('#add_setup')[0]);
    var encoded_string = Base64.encode('setup/save_builder/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
	var success_msg = 'Successful';
	var failure_msg = 'Successful';
    $.ajax({
        url: base_url + encoded_val,
        type: 'POST',
        data: formData,
		dataType:'json',
        async: false,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');		
        },
        success: function (response) {            
			$('.uni_wrapper').removeClass('loadingDiv');
            if(response.status == true)
            {
                $(".error-message .alerts").removeClass('alert-danger');
                $(".error-message .alerts").addClass('alert-success');
                $(".error-message").show();
                $(".alerts").html(response.message);
				  setTimeout(function(){  
					location.reload();
                }, 500); 
            }
            else
            {   
				if(response.error == 'size')
				{
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text(response.message);
				}
                $(".error-message .alerts").removeClass('alert-success');
                $(".error-message .alerts").addClass('alert-danger');      
                $(".error-message").show();
                if(response.message)
                {
                    failure_msg = response.message;
                }   
                $(".alerts").html(failure_msg); 
                          
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
} 
function add_setup_form(){	
	var addsetupform = $('#add_setup').find('[name="builder_currency"]').selectpicker().change(function(e) {$('#add_setup').formValidation('revalidateField', 'builder_currency');}).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save_details'			
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
                        message: 'The company name is required cannot be empty'
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
                        message: 'Please enter valid email'
                    }
                }
            },
			'builder_currency': {
                validators: {
                    notEmpty: {
                        message: 'Please select the currency'
                    }
                }
            }/* ,
			'credit_card_number': {
                validators: {
                    notEmpty: {
                        message: 'The Credit Card is required and cannot be empty'
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
                        message: 'The CVV No is required and cannot be empty'
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
                        message: 'The Card Name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 2,
                        max: 50,
                        message: 'The card name must be more than 2 and less than 50 characters long'
                    }
                }
            } */			      		
        }			      		
   
	}).on('err.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
			//$('.card_details').hide();
			//$('.new_billing_card_details').show();			
      }).on('success.field.fv', function(e, data) {            
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
			 /* if (data.field === 'credit_card_number' && data.validator === 'creditCard') {
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
            } */
						
      }).on('success.form.fv', function(e) {	
			update_builder_form();			
			e.preventDefault();
			$('.card_details').show();
			$('.new_billing_card_details').hide();
			
	  });	  
}

function co_scope_list_view() {
	$('#cost_code_table').dataTable({						
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5, 
					
		sAjaxSource: base_url + 'assets/js/json_cost_code.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],
		"fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {                                               
				 $('td:eq(0)', nRow).html('<a href="javascript:void(0);" class="edit_cost_code">' + data['cost_code'] + '</a>');
				$('td:eq(1)', nRow).html('<a href="javascript:void(0);" class="edit_variance_code">' + data['variance_code'] + '</a>');
				return nRow;				
            },		
		"columns":[            
		{"sTitle":"Cost Code", "data": "cost_code"},
		{"sTitle":"Variance Code", "data": "variance_code"}
		
	],
	"order": [[1, 'asc']]

	});
}

function delete_pic(file_id)
{
    var fileid = file_id;
    var encoded_string = Base64.encode('setup/delete_file/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: 'fileid='+fileid,   
        beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');       
        },      
        success: function(response) 
        {  
		$('#uploader').val('');	
		 $('.uni_wrapper').removeClass('loadingDiv'); 
            setTimeout(function(){  
                location.reload();
            }, 300);
            
        }
    });
}

/* Custom Field Coding */
$(function(){
	$('.custom_adding_values').hide();
	var panelList = $('#custom_field_list');
        panelList.sortable({            
            handle: '.panel-heading', 
            update: function() {
                $('.panel', panelList).each(function(index, elem) {
                     var $listItem = $(elem),
                     newIndex = $listItem.index();
                });
            }
        });
	/* Lead custom field action */	
	$(document).on('click', '#leads_custom_field_add', function(){		
		$('#custom_field_Modal').modal('show');
		$('.modal-content h4 .custom_title').text('New Lead My Field');
	});
	/* /Lead custom field action */
	
	/* project info custom field action */
	$(document).on('click', '#pro_info_custom_field_add', function(){
		$('#custom_field_Modal').modal('show');
		$('.modal-content h4 .custom_title').text('New Project Info My Field');
	});
	/* /project info custom field action */
	
	/* project Owner custom field action */	
	$(document).on('click', '#pro_owner_custom_field_add', function(){
		$('#custom_field_Modal').modal('show');
		$('.modal-content h4 .custom_title').text('New Project Owner My Field');
	});
	/* /project Owner custom field action */
	
	/* tasks custom field action */
	$(document).on('click', '#tasks_custom_field_add', function(){
		$('#custom_field_Modal').modal('show');
		$('.modal-content h4 .custom_title').text('New Task My Field');
	});
	/* /tasks custom field action */
	
	/* warranty custom field action */	
	$(document).on('click', '#warranty_custom_field_add', function(){
		$('#custom_field_Modal').modal('show');
		$('.modal-content h4 .custom_title').text('New Warranty My Field');
	});
	/* /warranty custom field action */	
	
	/* subcontractor custom field action */	
	$(document).on('click', '#subcontractor_custom_field_add', function(){
		$('#custom_field_Modal').modal('show');
		$('.modal-content h4 .custom_title').text('New Subcontractor My Field');
	});
	/* /subcontractor custom field action */
	$(document).on('change','.selectpicker', function(){
		//var selected = $('#field_type').next().find('.dropdown-menu.inner.selectpicker li.selected .text').text();
		var selected = $('#data_type').val();	
		if(selected == 'single_select_drop_down'){			
			$('.custom_adding_values').show();
		}		
		else if(selected == 'multi_select_drop_down'){
			$('.custom_adding_values').show();
		}
		else{
			$('.custom_adding_values').hide();
		}
	});
	/* Custom Add Values */
		 $(document.body).on('hidden.bs.modal', function (e) {			
			$('.custom_adding_values').hide();
			$('#custom_field_list').empty();
			$('#add_custom_val').val('');
		});
		$(document).on('click','#add_value', function(){
			var add_val = $('#add_custom_val').val();
            var save_custom_fields = $('.add_val_con').map(function() { return $(this).text(); }).get().join();
            var flag = 0;
            var array = save_custom_fields.split(",");
			if(add_val == ''){
				$(this).parent().find('.text-danger').css('paddingLeft','56px');
				$(this).parent().find('.text-danger').text('Value Cannot Be Empty');
				return false;
			} 
            $.each(array,function(i){
            if(add_val == array[i])
            {
                flag++;
            }
            });
            if(flag!=0)
            {
                 $(this).parent().find('.text-danger').css('paddingLeft','56px');
                 $(this).parent().find('.text-danger').text('Cannot Enter Same Value');
                return false;
            }
			else{
				$(this).parent().find('.text-danger').text('');
			}
            
            //alert(array);
			$('#add_custom_val').val('');
			$('#custom_field_list').append('<li class="panel panel-info"><div class="panel-heading"><span class="add_val_con">'+add_val+'</span> <span class="pull-right"><a href="javascript:void(0);" class="edit_custom_val"><img class="uni_edit" src="'+base_url+'assets/images/strip.gif" /></a> <a href="javascript:void(0);" class="delete_custom_val"><img class="uni_delete" src="'+base_url+'assets/images/strip.gif" /></a></span></div></li>');
		});
		$(document).on('click','.edit_custom_val', function(){
			var edit_val = $(this).parent().parent().find('.add_val_con').text();
			var edited_value = edit_val.trim();
			$(this).parent().parent().find('.add_val_con').text('');			
			$(this).parent().parent().find('.add_val_con').append('<input type="text" name="edit_custom_field_val" class="edit_custom_field_val form-control4" value="'+edited_value+'" maxlength="35" />&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" class="edit_field_save"><img class="uni_save_new" src="'+base_url+'assets/images/strip.gif" /></a>');			
		});
		$(document).on('click','.edit_field_save', function(){
			var edit_field_save = $(this).parent().find('.edit_custom_field_val').val();
			var edit_value = edit_field_save.trim();
            var save_custom_fields = $('.add_val_con').map(function() { return $(this).text(); }).get().join();
            var flag = 0;
            var array = save_custom_fields.split(",");
            if(edit_value == ''){
                $(this).parent().find('.edit_custom_field_val').css('paddingLeft','0px');
                $(this).parent().find('.edit_custom_field_val').attr('placeholder','Value Cannot Be Empty');
                return false;
            } 
            $.each(array,function(i){
            if(edit_value == array[i])
            {
                flag++;
            }
            });
            if(flag!=0)
            {
                 $(this).parent().find('.edit_custom_field_val').css('paddingLeft','0px');
                 $(this).parent().find('.edit_custom_field_val').val('');
                 $(this).parent().find('.edit_custom_field_val').attr('placeholder','Cannot Enter Same Value');
                return false;
            }
            else{
                $(this).parent().find('.text-danger').text('');
            }			
			$(this).parent().parent().find('.add_val_con').append(edit_value);
			$(this).parent().find('.edit_custom_field_val').remove();
			$(this).remove();
		});
		$(document).on('click','.delete_custom_val', function(){
			$(this).parent().parent().parent().remove();
		});
		$(document).on('click','#save_custom_field', function(){								
			var save_custom_fields = $('.add_val_con').map(function() { return $(this).text(); }).get().join();
			//alert(save_custom_fields);
		});
	/* /Custom Add Values */
});
/* Custom Field Coding */


/* New Custom Field Code Start Here By Sidhartha*/
function open_field_modal(id)
{
	
	var id = id;
	var fields = id.split(/,/);
    var value = fields[0];
    var type = fields[1];

    $('#module_name').val(type);
    $('#classification').val(value);
    $('#ub_custom_field_id').val(0);
    $('#custom_field_Modal').modal('show');
	$('.modal-content h4 .custom_title').text('New '+type+' My Field');
    $('#label_name').val('');
    $('#tooltip').val('');
    $('#display_order').val('');
    $('.selectpicker').selectpicker('refresh');
    $("#data_type option[value='']").prop("selected", true);
    $('.selectpicker').selectpicker('refresh');
    $('#mandatory').closest('.icheckbox_square-red').removeClass('checked');   
    $('#mandatory').removeAttr("checked", "checked");
	
}
$(function() {
    add_custom_field_form();
    $('#save_custom_field').click(function(e) { 
          
		var label_name 				= $('#label_name').val();		
		var data_type 		        = $('#data_type').val();					
				
		
		if(label_name == '' || data_type == ''){			
			//error_box();
			//$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{			
			add_custom_field();
			e.preventDefault();
		}
  });
  $('#custom_field_Modal').on('hidden.bs.modal', function () {
	  $('#custom_field_form').formValidation('resetForm', true);		  
	  $(this).find('form')[0].reset();
	});
 });
  function add_custom_field_form(){	
		$('#custom_field_form').find('[name="data_type"]').selectpicker().change(function(e) {            
                $('#custom_field_form').formValidation('revalidateField', 'data_type,');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save_custom_field'			
        },
        fields: {
            'label_name': {
                validators: {
                    notEmpty: {
                        message: 'The Label name is required cannot be empty'
                    }
                }
            },
			'data_type': {
                validators: {
                    notEmpty: {
                        message: 'The Field type to cannot be empty'
                    }
                }
            }
			
        }		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 
				add_custom_field();					
			
			e.preventDefault();			 
	  });		
}
function add_custom_field(){
    // Encode the String
   
    var encoded_string = Base64.encode('setup/save_custom_field/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
  
    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    var save_custom_fields = $('.add_val_con').map(function() { return $(this).text(); }).get().join();
    var ajaxData  = $("#custom_field_form").serialize(); 
	//alert(ajaxData+save_custom_fields) ;   
    $.ajax({
    url: base_url + encoded_val,
    dataType: "json",
    type: "post",
    data: ajaxData+save_custom_fields,
    beforeSend: function() {		
            $('.uni_wrapper').addClass('loadingDiv');			 
        },         
    success: function(response) {  
			$('.uni_wrapper').removeClass('loadingDiv');

            get_custom_fields();         
       		$('#custom_field_Modal').modal('hide');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text(response.message);
     } 
  });
}
$(function(){
    get_custom_fields();
});
function get_custom_fields()
{
    //$('#ub_po_co_payment_id').val(0);
    var encoded_string = Base64.encode('setup/get_custom_fields/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#custom_field_form").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    //dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
         
        $(".custom_list").html(response);

      }
   }); 
}
function edit_custom_field(id)
{
    //alert(id);
    $('#ub_custom_field_id').val(id);
    var ub_custom_field_id = $('#ub_custom_field_id').val();
    $('#custom_field_Modal').modal('show');
    $('.modal-content h4 .custom_title').text('Edit Custom Field');

    var encoded_string = Base64.encode('setup/get_custom_field_values/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);

    var ajaxData  = "ub_custom_field_id="+ub_custom_field_id;
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {           
            if(response.status == true)
            {   
               $('#module_name').val(response.module_name);
               $('#classification').val(response.classification);
               $('#label_name').val(response.label_name);
               $('#tooltip').val(response.tooltip);
               $('#display_order').val(response.display_order);
               $('.selectpicker').selectpicker('refresh');
               $("#data_type option[value='" + response.data_type + "']").prop("selected", true);
               $('.selectpicker').selectpicker('refresh');

                if(response.data_type == 'single_select_drop_down'){            
                $('.custom_adding_values').show();
                }       
                else if(response.data_type == 'multi_select_drop_down'){
                $('.custom_adding_values').show();
                }
                else{
                $('.custom_adding_values').hide();
                }

               if(response.mandatory == 'Yes')
               {
                $('#mandatory').closest('.icheckbox_square-red').addClass('checked');   
                $('#mandatory').attr("checked", "checked");
                
               }
               else
               {         
                $('#mandatory').closest('.icheckbox_square-red').removeClass('checked');   
                $('#mandatory').removeAttr("checked", "checked");
 
               }

               parsed_obj = response.field_values;
               $.each(parsed_obj, function( index, values ) {
               if(values != ""){
               $('#custom_field_list').append('<li class="panel panel-info"><div class="panel-heading"><span class="add_val_con">'+values+'</span> <span class="pull-right"><a href="javascript:void(0);" class="edit_custom_val"><img class="uni_edit" src="'+base_url+'assets/images/strip.gif" /></a> <a href="javascript:void(0);" class="delete_custom_val"><img class="uni_delete" src="'+base_url+'assets/images/strip.gif" /></a></span></div></li>');}
                });

            }
          }
    }); 
}
function delete_custom_field(id)
{
    //$('#ub_custom_field_id').val(id);
    var ub_custom_field_id = id;

    var encoded_delete_roles = Base64.encode('setup/delete_custom_field/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);

    var ajaxData  = "ub_custom_field_id="+ub_custom_field_id;

    var conf = $('#confirm_comment_Modal').modal('show');
    $('#delete_comment_confirm').click(function(){
    var conf = true;
    if(conf == true){
        $('#confirm_comment_Modal').modal('hide');

     $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: ajaxData,
            success: function(response) {   
                if(response.status == true)
                {   
                    
                    get_custom_fields();
                   
                }
                else
                {               
                             
                }
                return false;
            }
        });
      }
  });
    
}
/*End*/

/* Payment History */
$(function() {    
    //Payment_History();
	$(document).on( 'shown.bs.tab', 'a[href="#Payments"]', function (){        
        Payment_History();
	});
    $(document).on( 'shown.bs.tab', 'a[href="#changeplan"]', function (){        
         Plan_history();
    });
	var url = window.location.href;
    var hash = url.substring(url.indexOf("#"));	
    if (hash == "#Payments")
    {
        Payment_History();
    }
    if (hash == "#changeplan")
    {
        Plan_history();
    }
    //Plan_history();
	$('.new_billing_card_details').hide();
	$(document).on('click', '#change_card', function(){
		$('#Change_order_Info').modal('show');
		//$('.card_details').hide();
		$('.new_billing_card_details').show();	
	});
	$(document).on('click', '#card_details_cancel', function(){
		$('.card_details').show();
		$('.new_billing_card_details').hide();
	});	
	$(document).on('click', '#upgrade_plan', function(){
		$(".tab-con li").removeClass("active");		
		$('.tab-con a[href="#changeplan"]').tab('show');
		$('#upgrade_to_plan').addClass('active');				
		window.location.hash = '#changeplan';		
	});
	
	$(document).on('click', '#upgrade_to_plan', function(){
		$('#confirmModal').modal('show');		
	});
	$(document).on('click', '#upgrade_plan_confirm', function(){
		var conf = true;
		if(conf == true){
			$('#confirmModal').modal('hide');
		}
        var subscription_id = $('#subscription_id').val();
        var plan_id = $('#plan_id').val();

        var encoded_string = Base64.encode('setup/cancel_plan/');
        var encoded_val = encoded_string.strtr(encode_chars_obj);   
        
        var success_msg = 'Successful';
        var failure_msg = 'Failed';
        $.ajax({
            url: base_url + encoded_val,
            dataType: "json",
            type: "post",
            data: 'subscription_id=' + subscription_id + '&plan_id=' + plan_id, 
            success: function(response) {
                if(response.status == true)
                {   
                        alert(1234567);
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

	});
	
});

function Payment_History() {
	var encoded_url = Base64.encode('setup/get_invoices/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object
	var dbobject = {
		'tableName': $('#Payment_History'),
		'this_table' : {'table_name':'Payment_History'},
		'ajax_encoded_url':ajax_encoded_url,
		'id': 'reference_id',
		'name' : 'reference_id',
		'invoice_date' : {'index':4},
		// 'invoice_to_date' : 'invoice_to_date',
		'billing_date' : 'billing_date',
		'ub_invoice_id' : 'ub_invoice_id',
		'post_data':'{}',
		'delete_data':{},  
		'edit_data':{},
		'edit_data1':{'index':7, 'url':'#'},
		'payment_status': {'index':6},
		//'total_estimated_profit_amount':{'index':4},
		'display_columns' : [{"data": "payment_date"},{"data": "reference_id", "bSortable": false},{"data": "plan_name", "bSortable": false},{"data": "amount", "bSortable": false},{"data": null, "bSortable": false},{"data": "last", "bSortable": false},{"data": "payment_status", "bSortable": false},{"data": null, "bSortable": false}],
		'default_order_by': [[0, 'asc']]
		};
	// Populate data table
	ubdatatable(dbobject);
}
/* /Payment History */
/* Plan History */
function Plan_History() {
        $('#Plan_History').dataTable({
            "aLengthMenu": [
                [5, 15, 50, 100],
                [5, 15, 50, "l00"]
            ],
            "iDisplayLength": 5,            
            sAjaxSource: base_url + 'assets/js/Plan_History.json',
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0] // <-- gets last column and turns off sorting
            }],
      "columns":[            
            {"data": "plan_name"},
            {"data": "cost_per_month"},
            {"data": "from"},            
            {"data": "to"}
        ],
        "order": [[1, 'asc']]

        });
}
/* /Plan History */
//dimenstion checking in file upload

/* var _URL = window.URL || window.webkitURL;
$("#uploader").change(function(e) 
{
	var file, img;
	if ((file = this.files[0])) {
	img = new Image();
	img.onload = function() 
	{
		if(this.width > logo_max_width || this.width < logo_min_width || this.height > logo_max_height || this.height < logo_min_height)
		{
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text("File should Max height: "+logo_max_height+"  Min height: "+logo_min_height+" Max width: "+logo_max_width+"  Min width:"+logo_min_width);
			// alert("File should \n\nMax height:"+logo_max_height+"Min height:"+logo_min_height+"\nMax width:"+logo_max_width+"Min width:"+logo_min_width);
		}
	};
	img.onerror = function() {
	alert( "not a valid file: " + file.type);
	};
	img.src = _URL.createObjectURL(file);
	}
}); */
$(function(){
	cc_validation();
});
/* CC Validation */
/* Below code was commented as per sathish comment */
/* $('#update_card_details').on('click',function(e) {	
	cc_validation();	
}); */

function cc_validation()
{
		$('#add_setup1').find('[name="expiry_month"]').selectpicker().change(function(e) {            
                $('#add_setup1').formValidation('revalidateField', 'expiry_month');
            }).end().find('[name="expiry_year"]').selectpicker().change(function(e) {            
                $('#add_setup1').formValidation('revalidateField', 'expiry_year');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_card_details'			
        },
		 icon: {
                valid: 'fa',
                invalid: 'fa',
                validating: 'fa fa-refresh'
            },
        fields: {
			'credit_card_number': {
                validators: {
                    notEmpty: {
                        message: 'The Credit Card is required and cannot be empty'
                    },
					creditCard: {
                        message: 'The credit card number is not valid'
                    }
                }
            },			
			 'expiry_month': {                
                validators: {
                    notEmpty: {
                        message: 'The month is required'
                    },                    
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator, $field) {
                            value = parseInt(value, 10);
                            var year         = validator.getFieldElements('expiry_year').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < 0 || value > 12) {
                                return false;
                            }
                            if (year == '') {
                                return true;
                            }
                            year = parseInt(year, 10);
                            if (year > currentYear || (year == currentYear && value >= currentMonth)) {
                                validator.updateStatus('expiry_year', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },
			'expiry_year': {              
                validators: {
                    notEmpty: {
                        message: 'The year is required'
                    },
                    callback: {
                        message: 'Expired',
                        callback: function(value, validator, $field) {
                            value = parseInt(value, 10);
                            var month        = validator.getFieldElements('expiry_month').val(),
                                currentMonth = new Date().getMonth() + 1,
                                currentYear  = new Date().getFullYear();
                            if (value < currentYear || value > currentYear + 10) {
                                return false;
                            }
                            if (month == '') {
                                return false;
                            }
                            month = parseInt(month, 10);
                            if (value > currentYear || (value == currentYear && month >= currentMonth)) {
                                validator.updateStatus('expiry_month', 'VALID');
                                return true;
                            } else {
                                return false;
                            }
                        }
                    }
                }
            },			
			'code': {
                validators: {
					notEmpty: {
                        message: 'The CVV No is required and cannot be empty'
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
                        message: 'The Card Name is required and cannot be empty'
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
			add_cc_form();
			//check_valid_email();
			e.preventDefault();
	  });
}

function add_cc_form() {
	// Encode the String
	//alert("hello");
	var encoded_string = Base64.encode('setup/update_cc/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#add_setup1").serialize();
		$.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,
		/* beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');
        }, */
        success: function(response) {           
            /* $('.uni_wrapper').removeClass('loadingDiv'); */
            if(response == true)
            {
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Credit card details are modified successfully');
				window.location.reload();
            }
            else
            {     
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Credit card details are not modified');
				window.location.reload();
            }
        }
    }); 
}

function invoice_download(invoice_id)
{
	var encoded_string_edit_log = Base64.encode( 'setup/invoice_download/' + invoice_id);
	var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
	window.location.href = encoded_edit_val;
}
/* Below code was added by chandru 18-08-2015 */
function Plan_history() {
	var encoded_url = Base64.encode('setup/plan_history/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object
	var dbobject = {
		'tableName': $('#plan_history'),
		'this_table' : {'table_name':'plan_history'},
		'ajax_encoded_url':ajax_encoded_url,
		'id': 'ub_plan_id',
		'name' : 'ub_plan_id',
		/* 'invoice_from_date' : {'index':4},
		'invoice_to_date' : 'invoice_to_date', */
		'post_data':'{}',
		'delete_data':{},  
		'edit_data':{},
		'edit_data1':{'index':7, 'url':'#'},
		'payment_status': {'index':6},
		//'total_estimated_profit_amount':{'index':4},
		'display_columns' : [{"data": "plan_name"},{"data": "contract_number", "bSortable": false},{"data": "plan_amount", "bSortable": false},{"data": "start_date", "bSortable": false},{"data": "end_date", "bSortable": false}/* ,{"data": "expiry_date", "bSortable": false},{"data": "created_on", "bSortable": false} *//* ,{"data": "modified_on", "bSortable": false} */],
		'default_order_by': [[0, 'asc']]
		};
	// Populate data table
	ubdatatable(dbobject);
}
 /*  Below function was added by chandru 
	For "Cancel the subscription"
	On "18-09-2015"
 */
 function cancel_subscriptions(subscription_id)
 {
	var data = 'subscription_id='+subscription_id;
	var encoded_string = Base64.encode('setup/cancel_subscriptions/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);		
     var conf = $('#cancelModal').modal('show');
    $('#delete_confirm').click(function(){
        var conf = true;
        if(conf == true){
            $('#cancelModal').modal('hide');
	jQuery.ajax({
		type:'POST',
		url:base_url + encoded_val,
		dataType: "json",
		data:data,
		beforeSend: function() {
		  $('.uni_wrapper').addClass('loadingDiv');				  
		},
		success:function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
			if (response.status == true) {
			 location.reload(true);
			} else {
				alert('Subscription was not created');
				return false;
			}
		}
	});
    }
    }); 
 }
 /* Change plan payment */
 function make_payments()
 {
	 var first_name = jQuery.trim(jQuery('#first_name').val());
	 var last_name = jQuery.trim(jQuery('#last_name').val());
	 var address = jQuery.trim(jQuery('#address').val());
     var city = jQuery.trim(jQuery('#city').val());
	 var old_subscription_id = jQuery.trim(jQuery('#subscription_id').val());
	 var province = jQuery.trim(jQuery('#province').val());
	 var country = jQuery.trim(jQuery('#country').val());
	 var postal = jQuery.trim(jQuery('#postal').val());
	 var desk_phone = jQuery.trim(jQuery('#desk_phone').val());
	 var primary_email = jQuery.trim(jQuery('#primary_email').val());
	 /* current month amount */
	 var updated_plan_amount = jQuery.trim(jQuery('#updated_plan_amount').val());
	 /* Credit card details */
	 var credit_card_numbers = jQuery.trim(jQuery('#credit_card_numbers').val());
	 var card_expiry_month = jQuery.trim(jQuery('#card_expiry_month').val());
	 var card_expiry_year = jQuery.trim(jQuery('#card_expiry_year').val());
	 var ccv_code = jQuery.trim(jQuery('#ccv_code').val());
	 var card_name = jQuery.trim(jQuery('#card_name').val());
	 /* Convert every thing to data */
	 var data = 'first_name='+first_name+'&last_name='+last_name+'&address='+address+'&city='+city+'&province='+province+'&country='+country+'&postal='+postal+'&desk_phone='+desk_phone+'&primary_email='+primary_email+'&updated_plan_amount='+updated_plan_amount+'&credit_card_numbers='+credit_card_numbers+'&card_expiry_month='+card_expiry_month+'&card_expiry_year='+card_expiry_year+'&ccv_code='+ccv_code+'&card_name='+card_name+'&old_subscription_id='+old_subscription_id;
	var encoded_string = Base64.encode('setup/create_new_subscriptions/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);		
	jQuery.ajax({
		type:'POST',
		url:base_url + encoded_val,
		dataType: "json",
		data:data,
		beforeSend: function() {
		  $('.uni_wrapper').addClass('loadingDiv');				  
		},
		success:function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
			if (response.status == true) {
				$('#alertModal').modal('show');
                $('.alert_modal_txt').text(response.message);
			 location.reload(true);
			} else {
				$('#alertModal').modal('show');
                $('.alert_modal_txt').text(response.message);
				return false;
			}
		}
	});
 }