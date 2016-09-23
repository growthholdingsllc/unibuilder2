$(function(){
	$('.date').on("dp.show", function(e) {		
		var top  = $(this).offset().top + $(this).outerHeight();
		var left = $(this).offset().left;		
		var ele = $(e.target).data('DateTimePicker');
		if (ele.widget.position().left > 0) {					 		 			
			$(ele.widget).css({
				'top' : top,
				'left': left+'px !important',
				'bottom':'auto'
			});		 
		}			 
	});	
});
 $('select#po_id').on('change',function() {

 	$('#change_cost_code_list').empty();
 	var po_id = $('#po_id').val();
 	$('#bid_po_id').val(po_id);
 	var encoded_string = Base64.encode('budget/get_cost_code/'+po_id);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    //dataType: "json",
    type: "post",
    data: ajaxData,
    beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			 
        },         
    success: function(response) {
    	//alert(response);return false;
        $('.uni_wrapper').removeClass('loadingDiv');
		$(".cost_code").html(response);
		$('.selectpicker').selectpicker('refresh');
      }
   });
    
    
  });
  $(document).ready(function() {
      $('.sigPad').signaturePad({drawOnly:true});
    });
//checking project status -- code added by satheesh kumar
$(function() {
	$('.signature_wrapper').hide();
	$('#assign_to_vendor').hide();
	$('#release_owner').on('click', function(){
		$('.signature_wrapper').show();
	});
	$('#approve_sign').on('click', function(){
		$('#release_owner').hide();
		$('#assign_to_vendor').show();
	});
	
	var ub_po_co_id = $('#ub_po_co_id').val();   
	if(ub_po_co_id == '' || ub_po_co_id == 0)
	{
		check_project_status('budget/project_budget/','#po');
	}
	else if(project_status_check == false)
	{
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Project was '+project_status+'. You can not able to edit');
		//alert('you can not edit');
	}
	/* checking project status code ends here*/
});

imgLink = base_url + 'assets/images/'; 

$(document).ready(function() {
 $(document).on('keyup','.varian', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){ return ''; }) );
 });
 $(document).on('keyup','.requested_amount', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){ return ''; }) );
 });
 $(document).on('keyup','.amount', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){ return ''; }) );
 });
  var cointainer = $('.removeBtn').parent().parent().parent().parent().closest('.cointainer');
  var counts = cointainer.children('.content').length;
  if (counts == 1) {
            cointainer.find('.removeBtn').hide();
        }
  if(counts < 10)
  {
    cointainer.children('.addBtn').show();
  }
 // $('.removeBtn').click( function() {
 	$(document).on("click", ".removeBtn", function(event){
    var cointainer = $(this).parent().parent().parent().parent().closest('.cointainer');
    var counts = cointainer.children('.content').length;
    
    counts--;
    if(counts < 10) {
        cointainer.children('.addBtn').show();         
        if (counts == 1) {
            cointainer.find('.removeBtn').hide();
        }
    }
    $(this).parent().parent().parent().parent().remove();
    cointainer.find('.label-num').text(function(idx){
        return 1 + idx
    })
});

//add button
//$('.addBtn').click( function() {
$(document).on("click", ".addBtn", function(event){
  $('#cost_code_id').trigger("change");
    var cointainer = $(this).closest('.cointainer');  
    var counts = cointainer.children('.content').length;
    var content = $(this).parent().parent().prev();	
    counts++;   
    if (counts > 9) {                     
        $(this).hide();
         
    
    }
	
    content.clone(true,true).insertAfter(content).find(':input').val('').end().find('.label-num').text(counts);  	
	$('.selectpicker').data('selectpicker', null);
	$('.bootstrap-select').remove();
	$('.selectpicker').selectpicker();
    cointainer.find('.removeBtn').show();
});});
$(function(){
$('#datetimepicker5').datetimepicker({
      pickTime: false
    });
});

$(function() {     
	//po_bids_list_view();
	
$(document).on('keyup change', '.cointainer input[name="quantity[]"], .cointainer input[name="unit_cost[]"]', function() {
    var $input = $(this).closest('.content');
	var quantity = Number($input.find('input[name="quantity[]"]').val()) || 0;
	var unicost = Number($input.find('input[name="unit_cost[]"]').val()) || 0;
	var total = (quantity * unicost);        
        $input.find('input[name="total[]"]').val(total);		
	});
});


$(function() {
if (typeof list_page != 'undefined') {
//po_payment_list_view();
 
}
});
//Data table code
function po_payment_list_view() {
		var ub_po_co_id = $('#ub_po_co_id').val();
		var encoded_url = Base64.encode('budget/get_po_co_payment/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var dbobject = {
							'tableName': $('#po_payment_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_po_co_payment_request_id',
							'name' : 'payment_title',
							'this_table' : {'table_name':'po_payment_list'},
							'post_data':'{"po_co_id":"'+ub_po_co_id+'"}',
							'delete_data':{},
							'total_paid_amount':'total_paid_amount',
							'payment_request_status' : 'payment_request_status',
							'modified_on':{'index':3},
							'pay_to':{'index':4},  
							'edit_data':{'index':0, 'url':'#'},
							'display_columns' : [{"data": "payment_title"},{"data": "total_paid_amount","render": $.fn.dataTable.render.number( ',', '.', 2)},{"data": "payment_request_status"},{"data": "modified_on"},{"data": "pay_to"}],
							'default_order_by': [[1, 'desc']]
						};	
		// Populate data table
		ubdatatable(dbobject);
}

function po_bids_list_view() {
		var ub_po_co_id = $('#ub_po_co_id').val();
		var encoded_url = Base64.encode('budget/get_po_bids_list/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var dbobject = {
							'tableName': $('#po_bids_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'created_on',
							'name' : 'created_on',
							'this_table' : {'table_name':'po_bids_list'},
							'post_data':'{"po_co_id":"'+ub_po_co_id+'"}',
							'delete_data':{},  
							'edit_data':{},
							'display_columns' : [{"data": "package_title"},{"data": "created_on"}],
							'default_order_by': [[1, 'desc']]
						};	
		// Populate data table
		ubdatatable(dbobject);
}
$(function() {
	$(document).on( 'shown.bs.tab', 'a[href="#payments"]', function (){        
        po_payment_list_view();
	});
	$(document).on( 'shown.bs.tab', 'a[href="#bids"]', function (){        
        po_bids_list_view();
	});
	$(document).on( 'shown.bs.tab', 'a[href="#status_log"]', function (){        
        po_status_list();
	});
	var url = window.location.href;
	var hash = url.substring(url.indexOf("#"));
		
		if (hash == "#payments")
		{
			po_payment_list_view();
		}
		if (hash == "#bids")
		{
			po_bids_list_view();
		}
		if (hash == "#status_log")
		{
			po_status_list();
		}
});
// New codes added by sidhartha

$('#budget_po_tab a').click(function (e) {
	/*var project_id = document.getElementById('project_id').value;
    var title = document.getElementById('title').value;*/
    var title = document.getElementById('title').value;
    var current_tab = this.id;
    if(current_tab == "general_tab")
    {
        $('#current_tab').val('#general');
    }
    if(current_tab == "scope_of_work_tab")
    {
        $('#current_tab').val('#scope_work');
    }
    if(current_tab == "status_log_tab")
    {
        $('#current_tab').val('#status_log');
         po_status_list();
    }
    if(current_tab == "bids_tab")
    {
        $('#current_tab').val('#bids');
        po_bids_list_view();
    }
    if(current_tab == "payment_tab")
    {
        $('#current_tab').val('#payments');
        po_payment_list_view();
    }
	$("#save_type").val('save_and_stay_tab');
		var title 				= $('#title').val();		
		var assigned_to 		= $('#assigned_to').val();
		var po_id 		        = $('#po_id').val();					
		var cost_code_select 	= $("input[name*='cost_code_id']").val();
		var quantity 			= $("input[name*='quantity']").val();
		var uni_cost 			= $("input[name*='unit_cost']").val();				
		
		if(title == '' || assigned_to == '' || cost_code_select == '' || quantity == '' || uni_cost == '' || po_id == ''){	
			var form = $(this).closest("form");   
			form.submit();		
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');
			return false;			
		}
		else{			
			add_budget_po_form();
			e.preventDefault();
		}
	
});

$(function() {
    add_new_budget_po_form();
    $('#save_stay').click(function(e) { 
         $('#current_tab').val('');
         $("#save_type").val('save_and_stay'); 
		var title 				= $('#title').val();
		var po_id 		        = $('#po_id').val();		
		var assigned_to 		= $('#assigned_to').val();					
		var cost_code_select 	= $("input[name*='cost_code_id']").val();
		var quantity 			= $("input[name*='quantity']").val();
		var uni_cost 			= $("input[name*='unit_cost']").val();				
		
		var returnData;	
		var optionVal = new Array();	
		$('.change_cost_code_list select').each(function() {
			optionVal.push($(this).val());
		});				
		var uniqueArray = optionVal.filter(function(elem, pos) {
			var duplicate_value =  optionVal.indexOf(elem) == pos;
			returnData = duplicate_value;
			/* if(duplicate_value == false)
			{
					error_box();	
					$('.error-message .alerts').text('Duplicate Cost Code');					
					return false;					
			} */			
		});
		if(title == '' || assigned_to == '' || cost_code_select == '' || quantity == '' || uni_cost == '' || po_id == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		if(returnData == false){
			error_box();	
			$('.error-message .alerts').text('Duplicate Cost Code');					
			return false;
		}
		if(returnData == true && title != '' && assigned_to != '' && cost_code_select != '' && quantity != '' && uni_cost != '' && po_id != '')
		{
			add_budget_po_form();
			e.preventDefault();
		}
		
		
		
    });
    $('#save_new').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('save_and_new');
        var title 				= $('#title').val();
        var po_id 		        = $('#po_id').val();		
		var assigned_to 		= $('#assigned_to').val();					
		var cost_code_select 	= $("input[name*='cost_code_id']").val();
		var quantity 			= $("input[name*='quantity']").val();
		var uni_cost 			= $("input[name*='unit_cost']").val();				
		
		var returnData;	
		var optionVal = new Array();	
		$('.change_cost_code_list select').each(function() {
			optionVal.push($(this).val());
		});				
		var uniqueArray = optionVal.filter(function(elem, pos) {
			var duplicate_value =  optionVal.indexOf(elem) == pos;
			returnData = duplicate_value;
			/* if(duplicate_value == false)
			{
					error_box();	
					$('.error-message .alerts').text('Duplicate Cost Code');					
					return false;					
			} */			
		});
		if(title == '' || assigned_to == '' || cost_code_select == '' || quantity == '' || uni_cost == '' || po_id == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		if(returnData == false){
			error_box();	
			$('.error-message .alerts').text('Duplicate Cost Code');					
			return false;
		}
		if(returnData == true && title != '' && assigned_to != '' && cost_code_select != '' && quantity != '' && uni_cost != '' && po_id != '')
		{
			add_budget_po_form();
			e.preventDefault();
		}
    });
    $('#save_back').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('save_and_back');
		var title 				= $('#title').val();
		var po_id 		        = $('#po_id').val();		
		var assigned_to 		= $('#assigned_to').val();					
		var cost_code_select 	= $("input[name*='cost_code_id']").val();
		var quantity 			= $("input[name*='quantity']").val();
		var uni_cost 			= $("input[name*='unit_cost']").val();				
		
		var returnData;	
		var optionVal = new Array();	
		$('.change_cost_code_list select').each(function() {
			optionVal.push($(this).val());
		});				
		var uniqueArray = optionVal.filter(function(elem, pos) {
			var duplicate_value =  optionVal.indexOf(elem) == pos;
			returnData = duplicate_value;
			/* if(duplicate_value == false)
			{
					error_box();	
					$('.error-message .alerts').text('Duplicate Cost Code');					
					return false;					
			} */			
		});
		if(title == '' || assigned_to == '' || cost_code_select == '' || quantity == '' || uni_cost == '' || po_id == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		if(returnData == false){
			error_box();	
			$('.error-message .alerts').text('Duplicate Cost Code');					
			return false;
		}
		if(returnData == true && title != '' && assigned_to != '' && cost_code_select != '' && quantity != '' && uni_cost != '' && po_id != '')
		{
			add_budget_po_form();
			e.preventDefault();
		}
    });
    $('#save_release').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('save_and_release');
        $("#status").val('Released');
		var title 				= $('#title').val();
		var po_id 		        = $('#po_id').val();		
		var assigned_to 		= $('#assigned_to').val();					
		var cost_code_select 	= $("input[name*='cost_code_id']").val();
		var quantity 			= $("input[name*='quantity']").val();
		var uni_cost 			= $("input[name*='unit_cost']").val();				
		
		var returnData;	
		var optionVal = new Array();	
		$('.change_cost_code_list select').each(function() {
			optionVal.push($(this).val());
		});				
		var uniqueArray = optionVal.filter(function(elem, pos) {
			var duplicate_value =  optionVal.indexOf(elem) == pos;
			returnData = duplicate_value;
			/* if(duplicate_value == false)
			{
					error_box();	
					$('.error-message .alerts').text('Duplicate Cost Code');					
					return false;					
			} */			
		});
		if(title == '' || assigned_to == '' || cost_code_select == '' || quantity == '' || uni_cost == '' || po_id == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		if(returnData == false){
			error_box();	
			$('.error-message .alerts').text('Duplicate Cost Code');					
			return false;
		}
		if(returnData == true && title != '' && assigned_to != '' && cost_code_select != '' && quantity != '' && uni_cost != '' && po_id != '')
		{
			add_budget_po_form();
			e.preventDefault();
		}
    });

    $('#po_cancel').click(function(e) {
        $('#current_tab').val('');
        var type = $('#type').val().toLowerCase();
        var encoded_home_string = Base64.encode('budget/project_budget/');
        var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
        window.location.href = encoded_home_val+'#'+type; 
        e.preventDefault();      
    });
     $('#po_sub_cancel').click(function(e) {
        $('#current_tab').val('');
        var type = $('#type').val().toLowerCase();
        var encoded_home_string = Base64.encode('budget/subcontractor_po/');
        var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
        window.location.href = encoded_home_val+'#'+type; 
        e.preventDefault();      
    });

    $('#po_co_accept').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('save_and_release');
        $("#status").val('Accepted');
       var title = $('#title').val();		
		var assigned_to = $('#assigned_to').val();			
		if(title == '' || assigned_to == ''){			
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
			change_po_co_status();
			e.preventDefault();
		} 
    });

    $('#po_co_reject').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('save_and_release');
        $("#status").val('Rejected');
      var title = $('#title').val();		
		var assigned_to = $('#assigned_to').val();			
		if(title == '' || assigned_to == ''){		
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
			change_po_co_status();
			e.preventDefault();
		} 
    });

    $('#po_co_work_completed').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('save_and_release');
        $("#status").val('Work Completed');
      var title = $('#title').val();		
		var assigned_to = $('#assigned_to').val();			
		if(title == '' || assigned_to == ''){		
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
			change_po_co_status();
			e.preventDefault();
		} 
    });
    
});

 function add_budget_po_form(){
    // Encode the String
    var user_id = $('#user_id').val();
    var created_by = $('#created_by').val();
    var ub_po_co_id = $('#ub_po_co_id').val();
    var status = $('#status_value').val();
    if((user_id == created_by || ub_po_co_id == 0 || $("#save_type").val() == 'save_and_release') && (status == 'Not Released') && (project_status != 'Closed' && project_status != 'Disabled'))
	{
    var type_val = $('#type').val();
    var encoded_string = Base64.encode('budget/save_po_co/'+type_val);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    if(account_type == SUBCONTRACTOR)
    {
      var encoded_home_string = Base64.encode('budget/subcontractor_po/');
      var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
    }
    else
    {
    	var encoded_home_string = Base64.encode('budget/project_budget/');
        var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
    }
    
    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    
    

    
    var title = document.getElementById('title').value;
    var tab = $('#current_tab').val();
    var scope_of_work = CKEDITOR.instances['scope_of_work'].getData();
    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    dataType: "json",
    type: "post",
    data: ajaxData+ '&scope_of_work=' + scope_of_work,
    beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			 
        },         
    success: function(response) {  
			$('.uni_wrapper').removeClass('loadingDiv');         
        if(response.status == true)
        {   
        	$('.uni_wrapper').removeClass('loadingDiv');
        	$.when(file_upload(response.insert_id)).done(function()
            {
				if($("#save_type").val() == 'save_and_new')
				{
					window.location.href = encoded_val;
				}
				else if($("#save_type").val() == 'save_and_back')
				{
					var types = $('#type').val().toLowerCase();
					window.location.href = encoded_home_val+'#'+types;
				}
				else if($("#save_type").val() == 'save_and_release')
				{
				  $tab_href = $('.tab-con li.active a').attr('href');
				  var encoded_string_edit_log = Base64.encode( 'budget/save_po_co/'+type_val +'/'+ ub_po_co_id);
				  var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
				  window.location.href = encoded_edit_val+$tab_href;
				  location.reload(true);
				}
				else if($("#save_type").val() == 'save_and_stay_tab')
                {

                    var encoded_string_edit_builderuser = Base64.encode( 'budget/save_po_co/'+type_val +'/'+ response.insert_id);
					  var encoded_edit_val = encoded_string_edit_builderuser.strtr(encode_chars_obj);
                     window.location.href = encoded_edit_val+tab;

                    
                }
				else if($("#save_type").val() == 'save_and_stay')
				{
					$tab_href = $('.tab-con li.active a').attr('href');
					  var encoded_string_edit_builderuser = Base64.encode( 'budget/save_po_co/'+type_val +'/'+ response.insert_id);
					  var encoded_edit_val = encoded_string_edit_builderuser.strtr(encode_chars_obj);
					  if(ub_po_co_id == 0)
                     {
                       window.location.href = encoded_edit_val+tab;
                     }
                     else
                     {
                       window.location.href = encoded_edit_val+$tab_href;
                       location.reload(true);
                     }
					  //window.location.href = encoded_edit_val+tab;
					  
				}				
				if(response.message)
				{
					success_msg = response.message;
				}
				success_box();
				$('.error-message .alerts').text(success_msg);
			});
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
}

function add_new_budget_po_form(){	
		$('#add_new_budget_po').find('[name="assigned_to"], [name="po_id"], [name="cost_code_id[]"]').selectpicker().change(function(e) {            
                $('#add_new_budget_po').formValidation('revalidateField', 'assigned_to, po_id, cost_code_id[]');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save_stay, #save_new, #save_back, #budget_po_tab a, #save_release'			
        },
        fields: {
            'title': {
                validators: {
                    notEmpty: {
                        message: 'The Titele is required cannot be empty'
                    }
                }
            },
			'assigned_to': {
                validators: {
                    notEmpty: {
                        message: 'The assigned to cannot be empty'
                    }
                }
            },
            'po_id': {
                validators: {
                    notEmpty: {
                        message: 'The PO cannot be empty'
                    }
                }
            },
			'cost_code_id[]': {
                validators: {
                    notEmpty: {
                        message: 'The cost code cannot be empty'
                    }
                }
            },			
			'quantity[]': {
                validators: {
                    notEmpty: {
                        message: 'The quantity cannot be empty'
                    }
                }
            },
			'unit_cost[]': {
                validators: {
                    notEmpty: {
                        message: 'The unit cost cannot be empty'
                    }
                }
            }
			
			
        }		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  			
			add_budget_po_form();							
			e.preventDefault();			 
	  });		
}

$(function() {
    if (typeof list_page != 'undefined') {     
	//po_status_list();
   }
});
function po_status_list() {
    var encoded_url = Base64.encode('budget/get_po_co_activity_log/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        // Data table Object
    var ub_po_co_id = $('#ub_po_co_id').val(); 
        var dbobject = {                    
                            'tableName': $('#po_status_list'),
                            'ajax_encoded_url':ajax_encoded_url,
                            'id':'activity_status',
                            'name': "activity_status",
                            'this_table' : {'table_name':'po_status_list'},
                            'post_data':'{"po_co_id":"'+ub_po_co_id+'"}',
                            'delete_data':{}, 
                            'edit_data':{},
                            'display_columns' : [{"data": "activity_status"},{"data": "created_on"},{"data": "created_by"},{"data": "comment"}],
                            'default_order_by': [[0, 'desc']]
                        };

        // Populate data table
        ubdatatable(dbobject);
    
}
$(function(){
   
   /*setTimeout(function(){
   get_cost_code();
   }, 3000);*/
  /* $(document).on('click', '#make_payments', function(e){
        make_payment();

        e.preventDefault();
    });
   $(document).on('click', '#create_payment_request', function(e){
        make_payment();

        e.preventDefault();
    });
   $(document).on('click', '#void_payment', function(e){
        void_payment();

        e.preventDefault();
    });*/

});
// alert message code added by  satheesh kumar
 $(document).on('keyup','#payment_title', function() {
        $('.grid_settings').hide();
 });
 $(document).on('keyup','.requested_amount', function() {
        $('.grid_settings').hide();
 });
function make_payment_request()
{
	var encoded_string = Base64.encode('budget/save_po_co_payment/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    //var ajaxData  = $("#add_new_budget_po").serialize();
    var payment_title = $('#payment_title').val();

    var sum = 0;
	$(".requested_amount").each(function(){
	    sum += +$(this).val();
	});

    if(payment_title == '')
    {
    	//alert('Please Enter The Title');
    	// $('#alertModal').modal('show');
        // $('.alert_modal_txt').text('Please Enter The Title');
		grid_error_box();
		$('.grid_settings .error-message .alerts').text('Please Enter The Title');
    }
    else if(sum == 0)
    {
    	//alert('Please Enter atleat one requested amount');
    	// $('#alertModal').modal('show');
        // $('.alert_modal_txt').text('Please Enter atleast one requested amount');
		grid_error_box();
		$('.grid_settings .error-message .alerts').text('Please Enter atleast one requested amount');
    }
    else
    {
    	var formData = new FormData($('#add_new_budget_po')[0]);    
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		contentType: false,
		processData: false,
		data: formData,
		beforeSend: function() {
		        $('.uni_wrapper').addClass('loadingDiv');			 
		    },                 
		success: function(response) {
		   $('.uni_wrapper').removeClass('loadingDiv');
			get_payment();
			po_payment_list_view();
			$('#payment_title').val('');
			$('#comments').val('');
			$('#create_payment').hide();

		  }
		}); 
    } 
    
}
// alert message code added by  satheesh kumar
 $(document).on('keyup','.amount', function() {
        $('.grid_settings').hide();
 });
function make_payment()
{
	var encoded_string = Base64.encode('budget/save_po_co_payment/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    //var ajaxData  = $("#add_new_budget_po").serialize();
    var payment_title = $('#payment_title').val();

    var sum = 0;
	$(".amount").each(function(){
	    sum += +$(this).val();
	});

    if(sum == 0)
    {
    	//alert('Please Enter atleat one amount');
    	// $('#alertModal').modal('show');
        // $('.alert_modal_txt').text('Please Enter atleast one amount');
		grid_error_box();
		$('.grid_settings .error-message .alerts').text('Please Enter atleast one amount');
    }
    else
    {
    	var formData = new FormData($('#add_new_budget_po')[0]);    
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		contentType: false,
		processData: false,
		data: formData,
		beforeSend: function() {
		        $('.uni_wrapper').addClass('loadingDiv');			 
		    },                 
		success: function(response) {
		   $('.uni_wrapper').removeClass('loadingDiv');
			get_payment();
			po_payment_list_view();
			$('#payment_title').val('');
			$('#comments').val('');
			$('#create_payment').hide();

		  }
		}); 
    } 
    
}

function void_payment()
{
	var encoded_string = Base64.encode('budget/void_payment/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    //var ajaxData  = $("#add_new_budget_po").serialize();
    var formData = new FormData($('#add_new_budget_po')[0]);     
    $.ajax({
    url: base_url + encoded_val,
    dataType: "json",
    type: "post",
    contentType: false,
    processData: false,
    data: formData,         
    success: function(response) {
        // alert(response);
		get_payment();
		po_payment_list_view();
		$('#payment_title').val('');
		$('#comments').val('');
		$('#create_payment').hide();
	
      }
   }); 
}

function get_payment()
{
	$('.grid_settings').hide();
	$('#ub_po_co_payment_id').val(0);
	$('#status_vals').text('');
	var encoded_string = Base64.encode('budget/get_po_co_payment_transactions/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    //dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
        // alert(response);
        var user_id = $('#user_id').val();
        var created_by = $('#created_by').val();
		$(".po_co_transaction").html(response);

			var sum = 0;
			$(".out").each(function(){
			    sum += +$(this).val();
			});
			
			setTimeout(function(){
			if(sum == 0)
			{
				$('.make-payments').hide();
			}
			}, 500);

		$('#ub_po_co_payment_id').val(0);
		$('#payment_title').val('');
		$('#comments').val('');
        $('.amount').hide();
		$('.void-payment').hide();
		$('.make-payment').hide();
		$('#payment_title').attr('readonly', false);
		$('#comments').attr('readonly', false);
		$('#generate_voucher').hide();
        $('#approve').hide();
        $('#reject').hide();
        $('#override').hide();
        $('#sta').show();
        $('.amount_to_pay_header').hide();
        $('.status_block').hide();
        $('#payment_request_status').closest('.icheckbox_square-red').removeClass('checked');   
        $('#payment_request_status').removeAttr("checked", "checked");
        var title = $('#title').val();
        $('#po_titles').html(title);	
		get_files();
		if(account_type == SUBCONTRACTOR)
		{
			$('.make-payments').show();
		}

	
      }
   }); 
}
/*Document Upload code Start Here*/

function get_files()
{
    //alert('hi');
    $('#ub_po_co_payment_id').val(0);
    var encoded_string = Base64.encode('budget/get_setup_budget_documents/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    //dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
        // alert(response);
        $(".file_upload").html(response);
    
      }
   }); 
}
function get_files_list()
{
    //alert('hi');
    var encoded_string = Base64.encode('budget/get_po_co_payment_request_documents/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    //dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
    	//alert(response);
        if(response.status == false){
        $(".file_upload").html('');
    	}
    	else
    	{
    	  $(".file_upload").html(response);
    	}
      }
   }); 
}

function delete_pic(file_id)
{
    var fileid = file_id;
    var encoded_string = Base64.encode('budget/delete_file/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: 'fileid='+fileid,         
        success: function(response) {  
        }
    });
}



function change_po_co_status()
{
	var encoded_string = Base64.encode('budget/change_po_co_status/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);

    var type = $('#type').val();
    var ub_po_co_id = $('#ub_po_co_id').val();
    var encoded_home_string = Base64.encode('budget/save_po_co/'+type +'/'+ ub_po_co_id);
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var ajaxData  = $("#add_new_budget_po").serialize();     
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
    	success_msg = response.message;
    	$tab_href = $('.tab-con li.active a').attr('href');
        window.location.href = encoded_home_val+$tab_href;
        location.reload(true);
        $(".alerts").html(success_msg);
      }
   }); 
}

function open_payment_modal(id)
{
	//alert(id);
	$('.grid_settings').hide();
	$('#ub_po_co_payment_id').val(id);
	$('.status_block').show();
	//$('#ub_po_co_payment_id').val(id);
	var encoded_string = Base64.encode('budget/get_payment_details_transaction/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    //dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
        // alert(response);
		$(".po_co_transaction").html(response);
		$('#ub_po_co_payment_id').val(id);
		var title = $('#title').val();
        $('#po_titles').html(title);		
		//$('#payment_title').readOnly = false;
		$('#payment_title').attr('readonly', true);
		$('#comments').attr('readonly', true);

		var sum = 0;
    $(".total_outstading").each(function(){
        sum += +$(this).val();
    });
    var total = 0;
    $(".payment_paid").each(function(){
        total += +$(this).val();
    });
    setTimeout(function(){
    if(sum == 0)
    {
    	if(account_type == BUILDERADMIN){
    	$('.make-payment').hide();
    	$('.make-payments').hide();
     } 
    }
    else if(total > 0)
    {
    	if(account_type == BUILDERADMIN){
    	$('.make-payment').show();
    	$('.make-payments').hide();
       }
    }
}, 500);
		//$('#comments').readOnly = false;
		get_payment_details(id);
		get_files_list();	
	if(account_type == BUILDERADMIN){	
 	$('.make-payments').hide();
	}
	if(account_type == SUBCONTRACTOR){	
 	$('#generate_voucher').hide();
	}
      }
   }); 
   /*if(account_type == SUBCONTRACTOR)
   {
			$('.make-payment').show();
   }*/
}

$('#approve').click(function(e) {
        $('#status_val').val('Approved');
        change_payment_status();
        /*$('.make-payment').show();
        $('#generate_voucher').show();
        $('#approve').hide();
        $('#reject').hide();
        $('#override').hide();*/
		e.preventDefault();

});

$('#reject').click(function(e) {
        $('#status_val').val('Rejected');
        change_payment_status();
        $('.make-payment').hide();
     	$('#generate_voucher').hide();
     	$('#void-payment').hide();
     	$('#approve').hide();
        $('#reject').hide();
        $('#override').hide();
		e.preventDefault();

});

$('#override').click(function(e) {
        $('#status_val').val('override');
        change_payment_status();
       /* $('.make-payment').show();
     	$('#generate_voucher').show();
     	$('#approve').hide();
        $('#reject').hide();
        $('#override').hide();*/
		e.preventDefault();

});

function change_payment_status()
{
	var encoded_string = Base64.encode('budget/change_payment_status/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);

    

    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
    	if(response.message == 'Data inserted successfully'){
    	if(account_type == BUILDERADMIN){
    	$('#voucher_id').val(response.insert_id);
    	$('.make-payment').show();
     	$('#generate_voucher').show();
     	$('#approve').hide();
        $('#reject').hide();
        $('#override').hide();
        $('.make-payments').hide();
       }
        }
      }
   }); 
}

function get_voucher()
{
	var voucher_id = $('#voucher_id').val();
	var payment_id = $('#ub_po_co_payment_id').val();
	var project_id = $('#project_id').val();
	//alert(voucher_id);
	var encoded_string = Base64.encode('budget/get_voucher/'+voucher_id+'/'+payment_id+'/'+project_id);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    //var ajaxData  = $("#add_new_budget_po").serialize();     
    window.open(encoded_val, '_blank');
}




function get_payment_details(id)
{
  $('#ub_po_co_payment_id').val(id);
  $('.payment_pending').hide();
  var ub_po_co_payment_id = $('#ub_po_co_payment_id').val();
  var ub_po_co_id = $('#ub_po_co_id').val();

  var encoded_string = Base64.encode('budget/get_po_co_payment_details/');
  var encoded_val = encoded_string.strtr(encode_chars_obj);
  
    var ajaxData  = "ub_po_co_payment_id="+ub_po_co_payment_id + "&ub_po_co_id="+ub_po_co_id;
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {           
            if(response.status == true)
            {
             if(account_type == SUBCONTRACTOR){
                $('#payment_title').val(response.payment_title);
            	$('#comments').val(response.comments);
            	$('#voucher_id').val(response.voucher_id);
            	$('#status_vals').text(response.payment_status); 
            	$('.requested_amount').attr('readonly', true);
            	if(response.payment_status != 'Payment request created')
                {
                 $('#payment_request_status').closest('.icheckbox_square-red').addClass('checked'); 
                 $('#sta').show();  
                 $('#payment_request_status').attr("checked", "checked");
                
                }
                if(response.payment_status == 'Approved' || response.payment_status == "Partial payment done" || response.payment_status == "Paid" || response.payment_status == "made void" || response.payment_status == "Ready for Payment")
                {
                 $('.make-payments').hide();
                 $('#sta').hide();
                 $('.requested_amount').attr('readonly', true);         
                 /*$('#visibile_to_subs').closest('.icheckbox_square-red').removeClass('checked');   
                 $('#visibile_to_subs').removeAttr("checked", "checked");*/
                }
             }  
             else if(account_type == BUILDERADMIN){
            	if(response.file_id == 0)
            	{
            		//alert('hi');
            		$('.app').hide();
            	}
            	else
            	{
            		$('.app').show();
            	}

            	$('#payment_title').val(response.payment_title);
            	$('#comments').val(response.comments);
            	$('#voucher_id').val(response.voucher_id);
            	$('#status_vals').text(response.payment_status);
            	//$('#btns').hide();
            	//alert(response.assigned_to);
            	//alert(response.created_by);
            	if(response.assigned_to == response.created_by && (response.created_by != response.created))
            	{
            		/*$('#btns').hide();
            		$('#payment_btn').hide();
            		$('.make-payments').show();
            		
            		$('.make-payment').hide();
            		$('.amount').hide();*/

            		$('#btns').hide();
            		$('#payment_btn').hide();
            		$('.make-payments').show();
            		//$('.request_amount_header').hide();
            		$('.make-payment').hide();
            		$('.amount').hide();
            		$('.make-payments').hide();
            		$('.amount_to_pay_header').hide();
            		


            		if(response.payment_status == 'Approved' || response.payment_status == "Partial payment done" || response.payment_status == "Paid" || response.payment_status == "made void" || response.payment_status == "Ready for Payment")
                    {
                 
                      $('#sta').hide();
                    }
                    //alert(1);
            		//$('.request').hide();
            		//$('.requested_amount').attr("type", "text");

            	}
            	/*else if(response.assigned_to != response.created)
            	{
            		$('#btns').hide();
            		$('#payment_btn').hide();
            	}*/
            	
            	else if((response.assigned_to == response.created_by) && (response.created_by == response.created))
            	{
            		$('#sta').hide();
            		//$('.make-payments').show();
            		$('#btns').show();
            		$('.amount_to_pay_header').show();
            		//$('#payment_btn').hide();
            		$('.make-payment').hide();
            		$('.void-payment').hide();
            		$('.amount').show();
            		
            	}
            	else if(response.created_by == response.created)
            	{
            		$('#sta').hide();
            		$('.make-payments').hide();
            		//$('.make-payment').show();
            		$('#btns').show();
            		//alert(2);
            		//$('.request').show();
            		//$('.requested_amount').attr("type", "hidden");

            	}
            	if(response.payment_status == "Payment request created")
                {
                    $('#sta').show();
                    $('.make-payment').hide();
     		        $('#generate_voucher').hide();
     		        $('#approve').hide();
     		        $('#reject').hide();
     		        $('#override').hide();
     		        $('.make-payments').show();
     		        $('.void-payment').hide();
     		        $('.amount').hide();
     		        $('.amount_to_pay_header').hide();
                 /*$(document).on('ifChecked', '#sta', function(event){                
                    $('.make-payments').show();
     		        $('#generate_voucher').hide();
     		        $('#approve').show();
     		        $('#reject').show();
     		        $('#override').show();
     		        $('.make-payments').hide();
     		        $('.void-payment').hide();
                  });
                 $(document).on('ifUnchecked', '#sta', function(event){                
                    $('.make-payments').hide();
     		        $('#generate_voucher').hide();
     		        $('#approve').hide();
     		        $('#reject').hide();
     		        $('#override').hide();
     		        $('.make-payments').hide();
     		        $('.void-payment').hide();
                  });*/
                	
                }
                else if(response.payment_status == "Ready for Payment")
                {
                	$('#sta').hide();
                	$('.make-payment').hide();
     		        $('#generate_voucher').hide();
     		        //$('#approve').show();
     		        $('#reject').show();
     		        $('#override').show();
     		        $('.make-payments').hide();
     		        $('.void-payment').hide();
     		        $('.amount').show();
     		        $('.amount_to_pay_header').show();
     		        if(response.file_id == 0)
            	    {
            		
            		  $('#approve').hide();
            	    }
            	    else
            	   {
            		 $('#approve').show();
            	   }
                	//alert(12);
                  }
            	else if(response.payment_status == "Approved" || response.payment_status == "Partial payment done" || response.payment_status == "Paid" || response.payment_status == "made void")
                {
                //alert(11);
        	      $('.make-payments').hide();
        	      $('#sta').hide();
        	     if(response.total_paid_amount == 0.00)
                 {
                 
                	$('.void-payment').hide();
                	$('.amount_to_pay_header').show();
                 }
                 else if(response.last_transaction_amount == 0.00)
                 {
                 	$('.void-payment').hide();
                 	$('.amount_to_pay_header').show();
                 }
                 else
                 {
                 	$('.void-payment').show();
                 	if(response.payment_status == "Paid")
                 	{
                 		$('.amount_to_pay_header').hide();
                 	}
                 	
                 }
     		     
     		     $('.make-payment').show();
     		     $('#generate_voucher').show();
     		     $('#approve').hide();
     		     $('#reject').hide();
     		     $('#override').hide();
                }
                else
                {
        	     if(response.payment_status == "Rejected"){

	    	     	 $('.void-payment').hide();
	    	         $('.make-payment').hide();
	    	         $('#generate_voucher').hide();
	    	         $('#approve').hide();
	    	         $('#reject').hide();
     		         $('#override').hide();

        	     }
        	     else{
        	     $('.void-payment').hide();
        	     $('.make-payment').hide();
        	     $('#generate_voucher').hide();
        	     //$('#approve').show();
        	     if(response.file_id == 0)
            	{
            		//alert('hi');
            		$('#approve').hide();
            	}
            	else
            	{
            		$('#approve').show();
            	}
     		     $('#reject').show();
     		     $('#override').show();
                }}
            }
           }
            //
          }
    }); 
}




function delete_po_co(po_co_ids_obj){
    if(po_co_ids_obj > 0)
    {
    var type = $('#type').val().toLowerCase();
    var encoded_delete_roles = Base64.encode('budget/delete_po_co/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('budget/project_budget/');
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
            data: {'ub_po_co_id':{ub_po_co_id:po_co_ids_obj}},
            success: function(response) {   
                if(response.status == true)
                {   
                    $(".error-message .alerts").removeClass('alert-danger');
                    $(".error-message .alerts").addClass('alert-success');
                    $(".error-message").show();
                    if(response.message)
                    {
                        success_msg = response.message;
                        window.location.href = index_url+'#'+type;                           
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
        $(".alerts").html("PO CO id is not set");      
    }
}
$(document).ready(function () {
	$(document).on('change blur','#po_vocher_payment_lists input[name="amount[]"]', function () {		
		$this = $(this).parents('tr');		
		$this.find('input[name="amount[]"]').each(function() {
			var value = parseInt(this.value);
			var requested_amt = $this.find('input[name="requested_amount[]"]').val();
			var paid_amt = $this.find('input[name="payment_paid_amount[]"]').val();
			var payment_list_amount = requested_amt - paid_amt;
			if(payment_list_amount >= value){				
				$(this).parent().removeClass('has-error');
				$(this).parent().addClass('has-success');				
				$(this).parent().find('.mes').html('');
			}			
			else{				
				$(this).parent().addClass('has-error');
				$(this).parent().removeClass('has-success');
				$(this).parent().find('.mes').html('<p class="text-danger">Less Than Out Standing</p>');
				
			}
			if($('#po_vocher_payment_lists').find('.form-group').hasClass("has-error")){				
				$('.make-payment').attr('disabled','disabled');
			}
			else{				
				$('.make-payment').removeAttr('disabled','disabled');
			}		
		});		
		return true;
	});
});
$(document).ready(function () {
	$(document).on('change blur','#po_vocher_payment_lists input[name="requested_amount[]"]', function () {		
		$this = $(this).parents('tr');		
		$this.find('input[name="requested_amount[]"]').each(function() {
			var value = parseInt(this.value);
			var requested_amt = $this.find('input[name="requested_amount[]"]').val();
			var payment_pending = $this.find('input[name="payment-pending[]"]').val();
			var out_standing = $this.find('input[name="out_standing[]"]').val();
			var payment_list_amount = out_standing - payment_pending;
			if(payment_list_amount >= value){				
				$(this).parent().removeClass('has-error');
				$(this).parent().addClass('has-success');				
				$(this).parent().find('.mes').html('');
			}			
			else{				
				$(this).parent().addClass('has-error');
				$(this).parent().removeClass('has-success');
				$(this).parent().find('.mes').html('<p class="text-danger">The Request amount should not be greater than the difference between Out standing and Payment request pending</p>');
				
			}
			if($('#po_vocher_payment_lists').find('.form-group').hasClass("has-error")){				
				$('.make-payments').attr('disabled','disabled');
			}
			else{				
				$('.make-payments').removeAttr('disabled','disabled');
			}		
		});		
		return true;
	});
});
/* $(function(){
	$(document).on('blur click', '#po_vocher_payment_lists input[name="amount[]"], .make_payment', function() {
	var $cur = $(this).closest('tr');
	var input_out_standing = Number($cur.find('input[name="requested_amount[]"]').val()-$cur.find('input[name="payment_paid_amount[]"]').val()) || 0;
	var input_amount = Number($cur.find('input[name="amount[]"]').val()) || 0;        	
	if(input_amount > input_out_standing){		
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().removeClass('has-success');
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().removeClass('has-error');
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().find('.mes').html('');
		$(this).parent().addClass('has-error');
		$(this).parent().find('.mes').html('<p class="text-danger">Less than Requested Amount</p>');
		$('.make-payment').attr('disabled','disabled');
	}
	else if(isNaN(input_amount)){
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().removeClass('has-success');
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().removeClass('has-error');
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().find('.mes').html('');
		$(this).parent().addClass('has-error');
		$(this).parent().find('.mes').html('<p class="text-danger">not a number</p>');
		$('.make-payment').attr('disabled','disabled');
	}
	else if(input_amount ==''){
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().removeClass('has-success');
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().removeClass('has-error');
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().find('.mes').html('');
		$(this).parent().addClass('has-error');
		$(this).parent().find('.mes').html('<p class="text-danger">cannot be empty</p>');
		$('.make-payment').attr('disabled','disabled');
	}
	else if(input_amount == input_out_standing){		
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().removeClass('has-success');
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().removeClass('has-error');
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().find('.mes').html('');
		$(this).parent().addClass('has-success');
		$(this).parent().find('.mes').html('');
		$('.make-payment').removeAttr('disabled');
	}
	else{		
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().removeClass('has-success');
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().removeClass('has-error');
		$('#po_vocher_payment_lists input[name="amount[]"]').parent().find('.mes').html('');
		$(this).parent().addClass('has-success');
		$(this).parent().find('.mes').html('');
		$('.make-payment').removeAttr('disabled');
	}		
	});
}); */

/*$(function(){
    $(document).on('blur click', '#po_vocher_payment_lists input[name="requested_amount[]"], .make_payments', function() {
    var $cur = $(this).closest('tr');
    var input_out_standing = Number($cur.find('input[name="out_standing[]"]').val()) || 0;
    var input_amount = Number($cur.find('input[name="requested_amount[]"]').val()) || 0;          
    if(input_amount > input_out_standing){      
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-success');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-error');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().find('.mes').html('');
        $(this).parent().addClass('has-error');
        $(this).parent().find('.mes').html('<p class="text-danger">Less than Out Standing</p>');
        $('.make-payments').attr('disabled','disabled');
    }
    else if(isNaN(input_amount)){
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-success');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-error');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().find('.mes').html('');
        $(this).parent().addClass('has-error');
        $(this).parent().find('.mes').html('<p class="text-danger">not a number</p>');
        $('.make-payments').attr('disabled','disabled');
    }
    else if(input_amount ==''){
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-success');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-error');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().find('.mes').html('');
        $(this).parent().addClass('has-error');
        $(this).parent().find('.mes').html('<p class="text-danger">cannot be empty</p>');
        $('.make-payments').attr('disabled','disabled');
    }
    else if(input_amount == input_out_standing){        
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-success');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-error');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().find('.mes').html('');
        $(this).parent().addClass('has-success');
        $(this).parent().find('.mes').html('');
        $('.make-payments').removeAttr('disabled');
    }
    else{       
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-success');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-error');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().find('.mes').html('');
        $(this).parent().addClass('has-success');
        $(this).parent().find('.mes').html('');
        $('.make-payments').removeAttr('disabled');
    }       
    });
});*/

/*Below code for File Upload*/
$(function(){
	var encoded_string = Base64.encode('budget/get_doc_hierarchy/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
 var tree_data;
    var jsonUrl = encoded_val;
    $.getJSON(jsonUrl, function(data) {
        tree_data = data;
        //alert(JSON.stringify(tree_data));
        tree_data_fun();
    });

    function tree_data_fun() {
        $('#fixed-tree').fileTree({
            data: tree_data
        });
    }

    $('body').on('click', 'li.file', function() {
        $('li.file').removeClass('selected');
        $(this).addClass('selected');
    });
	$(window).load(function() {
        $("#docs_upload_Modal .modal-con").mCustomScrollbar({
            setHeight: 250,
            theme: "dark-3"
        });

    });
	/* $('.file_uploaded_div').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	}); */
});

function file_upload(insert_id)
{
    var temp_directory_id = $("#temp_directory_id").val();
    var folderid = $("#folder_id").val();
    var moduleid = insert_id;
	var modulename = 'poco';
    var projectid = $('#project_id').val();
    var encoded_string = Base64.encode('budget/get_temp_filename/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var response = $.ajax({
        url: base_url + encoded_val,
        //dataType: "json",
        type: "post",
        data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid + '&moduleid='+moduleid + '&projectid='+projectid + '&modulename='+modulename,          
        /*beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },	*/
        success: function(response) {       
            //if(response.status == true)
            //{ 
                //window.location.href = role_index_url;
            //}
        }
    });
    return  response;
}
/*function to copy the files path to the hidden variable */
function copy_file_path(file_path)
{
    $('#temp_file_path').val(file_path);
    $(".upload_alerts").html('');
}

function copy_file_to_temp()
{
    var file_path = $('#temp_file_path').val();
    var temp_id = $("#temp_directory_id").val();
    var encoded_string = Base64.encode('budget/copy_file_to_temp/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);   
	if(file_path == '')
	{
		$(".modal-body .upload_error-message .upload_alerts").removeClass('alert-success');
		$(".modal-body .upload_error-message .upload_alerts").addClass('alert-danger');
		$(".modal-body .upload_error-message").show();
		$(".upload_alerts").html('Please Select a File');
	}
	else
	{
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: 'file_path='+file_path+'&temp_id='+temp_id,       

		success: function(response) 
		{
			if(response.status == true)
			{
				$(".modal-body .upload_error-message .upload_alerts").removeClass('alert-danger');
				$(".modal-body .upload_error-message .upload_alerts").addClass('alert-success');
				$(".modal-body .upload_error-message").show();
				if(response.message)
				{
					success_msg = response.message;
				}
				$(".upload_alerts").html(success_msg);
				relode_temp();
			  }
			}
		}); 
	}
} 

function relode_temp()
{
    var temp_id = $("#temp_directory_id").val();
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#add_new_budget_po').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#add_new_budget_po')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $("#add_new_budget_po").find(".files").empty();
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
}
/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {

    'use strict';
    
    var temp_id = $("#temp_directory_id").val();    

    //alert(temp_id); 
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('budget/upload/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#add_new_budget_po').fileupload({
	add: function(e, data) {
            var name = data.originalFiles[data.index].name;
            var size = data.originalFiles[data.index].size;
            // code to validate the directory name start.
            var values = new Object() // creates a new instance of an object
            $('.doc_name').each(function() {
                values[$(this).attr('title')] = $(this).val()
            })
            var output = "";
            var property = "";
            for (property in values) {
              output += property + ',' + values[property];
            }
            var output_data = output.substring(0, output.length - 1);
            var array = output_data.split(',');
            if ($.inArray(name, array) > -1)
            {
                //alert(name + ' - Already exixt.' );
                $('#alertModal').modal('show');
                $('.alert_modal_txt').text(name + ' - Already exixt.' );
                return false;
            }
            // code to validate the directory name end.

            var encoded_string = Base64.encode('budget/allowed_extension/');
            var encoded_val = encoded_string.strtr(encode_chars_obj);
            var uploadErrors = [];
            var ext = name.split('.').pop().toLowerCase();
            $.ajax({
                url: base_url + encoded_val,
                dataType: "json",
                type: "post",
                data: "ext="+ext, 
				beforeSend: function() {
					$('.uni_wrapper').addClass('loadingDiv');			
				},
                success: function(response) {  
					$('.uni_wrapper').removeClass('loadingDiv');
                    if(response.status == false)
                    {   
                        //alert("Not an accepted file type.");
                        $('#alertModal').modal('show');
                        $('.alert_modal_txt').text(ext +" is not an accepted file type.");
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        //alert(name + ' - Filesize is too big.' );
                        $('#alertModal').modal('show');
                        $('.alert_modal_txt').text(name + ' - Filesize is too big.' );
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        //alert(uploadErrors.join("\n"));
                        $('#alertModal').modal('show');
                        $('.alert_modal_txt').text(uploadErrors.join("\n"));
                        return false;
                    }
                    else
                    {              
                        data.submit();          
                    }
                }
            });
        },
        url: encoded_val,
        dataType: 'json',
        autoUpload: false,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },        
        success: function (data) {          
            setTimeout(checkbox, 1*200);            
            //alert(JSON.stringify(response));
            $("#temp_directory_id").val(data.files[0]['temp_dir_id']);
			$('.uni_wrapper').removeClass('loadingDiv');
        }
    });
    // Load existing files:
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#add_new_budget_po').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#add_new_budget_po')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
});
