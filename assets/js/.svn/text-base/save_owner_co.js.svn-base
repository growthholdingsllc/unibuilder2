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
	$(".sigWrapper .pad").click(function() {		
		$('.browse').addClass('pointer_none');
	});
	$(document).on( 'click', 'a[href="#clear"]', function (){        
        $('.browse').removeClass('pointer_none');
    });
	$(document).on('click','.close-file', function(){		
		$('.sigWrapper').removeClass('pointer_none');
		$('.sigPad').signaturePad({drawOnly:true});
		$('.browse').removeClass('pointer_none');
	});
    if(account_type == OWNER)
    {
        if(signature_status == 'Accepted by Builder' || signature_status == 'Accepted by Client')
        {
            if(signature_text != "")
           {
             $('.sigPad').signaturePad({drawOnly:false}).regenerate(signature_text);
           }
           else
           {
             $('.sigPad').signaturePad({drawOnly:false});
           }
        } 
        else{
        if(signature_text != "")
        {
            //signature_text = [{lx:0,ly:0,mx:0,my:0},{lx:0,ly:0,mx:0,my:0}];
            $('.sigPad').signaturePad({drawOnly:true}).regenerate(signature_text);
        }
        else
        {
            $('.sigPad').signaturePad({drawOnly:true});
        }
      }
    }
    else if(signature_text != "")
    {
        
        
        $('.sigPad').signaturePad({drawOnly:false}).regenerate(signature_text);
    }
      //var sig = [{lx:20,ly:34,mx:20,my:34},{lx:21,ly:33,mx:20,my:34}];
      //$('.sigPad').signaturePad({drawOnly:true});
      
   
//checking project status -- code added by satheesh kumar
/*$(function() {
	$('.signature_wrapper').hide();
	$('#assign_to_vendor').hide();
	$('#release_owner').on('click', function(){
		$('.signature_wrapper').show();
	});
	$('#approve_sign').on('click', function(){
		$('#release_owner').hide();
		$('#assign_to_vendor').show();
	});*/
	
	var ub_po_co_id = $('#ub_po_co_id').val();   
	if(ub_po_co_id == '' || ub_po_co_id == 0)
	{
		check_project_status('budget/project_budget/','#owner_co');
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
   
	$("#save_type").val('save_and_stay_tab');
		var title 				= $('#title').val();
        var po_id               = $('#po_id').val();		
		var assigned_to 		= $('#assigned_to').val();					
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
        var po_id               = $('#po_id').val();		
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
        var po_id               = $('#po_id').val();		
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
        var po_id               = $('#po_id').val();		
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
        $("#status").val('Release to Client');
		var title 				= $('#title').val();
        var po_id               = $('#po_id').val();		
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
        var type = $('#type').val();
        if(type == 'OWNER CO')
        {
            type = '#owner_co';
        }
        if(type == 'OWNER PO')
        {
            type = '#owner_po';
        }
        var encoded_home_string = Base64.encode('budget/project_budget/');
        var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
        window.location.href = encoded_home_val+type; 
        e.preventDefault();      
    });
     $('#po_sub_cancel').click(function(e) {
        $('#current_tab').val('');
       var type = $('#type').val();
        if(type == 'OWNER CO')
        {
            type = '#owner_co';
        }
        if(type == 'OWNER PO')
        {
            type = '#owner_po';
        }
        var encoded_home_string = Base64.encode('budget/project_budget/');
        var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
        window.location.href = encoded_home_val+type;
        e.preventDefault();      
    });

    $('#po_co_accept').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('accept');
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

   
});

 function add_budget_po_form(){
    // Encode the String
    var user_id = $('#user_id').val();
    var created_by = $('#created_by').val();
    var ub_po_co_id = $('#ub_po_co_id').val();
    var status = $('#status_val').val();
    if((user_id == created_by || ub_po_co_id == 0 || $("#save_type").val() == 'save_and_release') && (status == 'Client CO Request' || status == 'Client CO Request by Builder' || status == 'Client PO Request by Builder' || status == 'Client PO Request') && (project_status != 'Closed' && project_status != 'Disabled'))
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

    //var canvas = new fabric.Canvas('c');
    /*canvas.add(
     new fabric.Rect({ top: 100, left: 100, width: 50, height: 50, fill: '#f55' }),
     new fabric.Circle({ top: 140, left: 230, radius: 75, fill: 'green' }),
     new fabric.Triangle({ top: 300, left: 210, width: 100, height: 100, fill: 'blue' })
    );*/
    //JSON.stringify(canvas);
    //alert(canvas);

    var ajaxData  = $("#add_new_budget_po,#add_new_budget_po_second").serialize();     
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
					//window.location.href = encoded_val;
                    owner_signature_file_upload(response.insert_id);
				}
				else if($("#save_type").val() == 'save_and_back')
				{
					/*var types = $('#type').val();
                    if(types == 'OWNER CO')
                    {
                    types = '#owner_co';
                    }
                    if(types == 'OWNER PO')
                    {
                    types = '#owner_po';
                    }
					window.location.href = encoded_home_val+types;*/
                    owner_signature_file_upload(response.insert_id);
				}
				else if($("#save_type").val() == 'save_and_release')
				{
                  owner_signature_file_upload(response.insert_id);
				  /*$tab_href = $('.tab-con li.active a').attr('href');
				  var encoded_string_edit_log = Base64.encode( 'budget/save_po_co/'+type_val +'/'+ ub_po_co_id);
				  var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
				  window.location.href = encoded_edit_val+$tab_href;
				  location.reload(true);*/
				}
                else if($("#save_type").val() == 'save_and_stay_tab')
                {

                    /*var encoded_string_edit_builderuser = Base64.encode( 'budget/save_po_co/'+type_val +'/'+ response.insert_id);
                      var encoded_edit_val = encoded_string_edit_builderuser.strtr(encode_chars_obj);
                     window.location.href = encoded_edit_val+tab;*/
                     owner_signature_file_upload(response.insert_id);

                    
                }
				else if($("#save_type").val() == 'save_and_stay')
				{     
                      owner_signature_file_upload(response.insert_id);
					  /*var encoded_string_edit_builderuser = Base64.encode( 'budget/save_po_co/'+type_val +'/'+ response.insert_id);
					  var encoded_edit_val = encoded_string_edit_builderuser.strtr(encode_chars_obj);
					  window.location.href = encoded_edit_val+tab;*/
					  
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
			/*'assigned_to': {
                validators: {
                    notEmpty: {
                        message: 'The assigned to cannot be empty'
                    }
                }
            },*/
            'po_id': {
                validators: {
                    notEmpty: {
                        message: 'The Owner Po cannot be empty'
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
			 if($("#save_type").val() == 'save_and_stay'){
				add_budget_po_form();				
			 }
			else if($("#save_type").val() == 'save_and_new'){
				add_budget_po_form();				
			}	
			else if($("#save_type").val() == 'save_and_back'){
				add_budget_po_form();				
			}
			else if($("#save_type").val() == 'save_and_release'){
				add_budget_po_form();				
			}
            else if($("#save_type").val() == 'save_and_stay_tab'){
                add_budget_po_form();               
             }
			e.preventDefault();			 
	  });		
}

$(function() {
    if (typeof list_page != 'undefined') {     
	//po_status_list();
   }
});



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
        owner_signature_file_upload(ub_po_co_id);
    	/*$tab_href = $('.tab-con li.active a').attr('href');
        window.location.href = encoded_home_val+$tab_href;
        location.reload(true);*/
        $(".alerts").html(success_msg);
      }
   }); 
}









function delete_po_co(po_co_ids_obj){
    if(po_co_ids_obj > 0)
    {
    var type = $('#type').val();
    if(type == 'OWNER CO')
    {
        type = '#owner_co';
    }
    if(type == 'OWNER PO')
    {
      type = '#owner_po';
    }
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
                        window.location.href = index_url+type;                           
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
        url: $('#add_new_budget_po_second').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#add_new_budget_po_second')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $("#add_new_budget_po_second").find(".files").empty();
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
    $('#add_new_budget_po_second').fileupload({
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
            //$("#temp_directory_id").val(data.files[0]['temp_dir_id']);
			$('.uni_wrapper').removeClass('loadingDiv');
        }
    });
    // Load existing files:
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#add_new_budget_po_second').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#add_new_budget_po_second')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
});

function owner_signature_file_upload(id)
{
    var encoded_string = Base64.encode('budget/save_owner_file/'+id);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var ub_po_co_id = $('#ub_po_co_id').val();
    var type_val = $('#type').val();
    var tab = $('#current_tab').val();
    
    var encoded_new_string = Base64.encode('budget/save_po_co/'+type_val);
    var encoded_new_val = encoded_new_string.strtr(encode_chars_obj);

    var encoded_home_string = Base64.encode('budget/project_budget/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);

    var encoded_accept_string = Base64.encode('budget/save_po_co/'+type_val +'/'+ id);
    var encoded_accept_val = encoded_accept_string.strtr(encode_chars_obj);

    
        var formData = new FormData($('#add_signature')[0]);    
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        contentType: false,
        processData: false,
        data: formData,                
        success: function(response) {
            //alert('hi');
            if($("#save_type").val() == 'save_and_new')
            {
                window.location.href = encoded_new_val;
            }
            else if($("#save_type").val() == 'save_and_back')
            {
                var types = $('#type').val();
                if(types == 'OWNER CO')
                {
                types = '#owner_co';
                }
                if(types == 'OWNER PO')
                {
                types = '#owner_po';
                }
                window.location.href = encoded_home_val+types;
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

                var encoded_string_edit_builderuser = Base64.encode( 'budget/save_po_co/'+type_val +'/'+ id);
                  var encoded_edit_val = encoded_string_edit_builderuser.strtr(encode_chars_obj);
                 window.location.href = encoded_edit_val+tab;

                    
             }
            else if($("#save_type").val() == 'save_and_stay')
            {     
                  $tab_href = $('.tab-con li.active a').attr('href');
                  var encoded_string_edit_builderuser = Base64.encode( 'budget/save_po_co/'+type_val +'/'+ id);
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
            else if($("#save_type").val() == 'accept')
            {     
              $tab_href = $('.tab-con li.active a').attr('href');
              window.location.href = encoded_accept_val+$tab_href;
              location.reload(true);
                  
            }       
          }
        }); 
   
    
}
function delete_pic(file_id)
{
    //alert(file_id);
    var fileid = file_id;
    var encoded_string = Base64.encode('budget/delete_file/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var signature = 'signature';
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: 'fileid='+fileid+ '&module_name=' + signature,         
        success: function(response) {  
            window.location.reload();
        }
    });
}
