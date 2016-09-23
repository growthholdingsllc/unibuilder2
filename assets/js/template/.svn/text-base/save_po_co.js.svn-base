imgLink = base_url + 'assets/images/'; 
$(document).ready(function() {
 add_new_budget_po_form();
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
 	$(document).on("click", ".removeBtn", function(){
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
		});
});

//add button
	$(document).on("click", "a.addBtn", function(){
		
	  //$('#cost_code_id').trigger("change");
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
	});
});
$(function(){
	$('#datetimepicker5').datetimepicker({
      pickTime: false
    });
});

$(function() {     	
$(document).on('keyup change', '.cointainer input[name="quantity[]"], .cointainer input[name="unit_cost[]"]', function() {
    var $input = $(this).closest('.content');
	var quantity = Number($input.find('input[name="quantity[]"]').val()) || 0;
	var unicost = Number($input.find('input[name="unit_cost[]"]').val()) || 0;
	var total = (quantity * unicost);        
        $input.find('input[name="total[]"]').val(total);		
	});
});

// New codes added by sidhartha
 $('#budget_po_tab li a').click(function (e) {	 
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
    
	$("#save_type").val('save_and_stay');
		var title 				= $('#title').val();			
		var cost_code_select 	= $("input[name*='cost_code_id']").val();
		var quantity 			= $("input[name*='quantity']").val();
		var uni_cost 			= $("input[name*='unit_cost']").val();				
		
		if(title == '' || cost_code_select == '' || quantity == '' || uni_cost == ''){	
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
  
    $('#save_stay').click(function(e) { 
         $('#current_tab').val('');
         $("#save_type").val('save_and_stay'); 
		var title 				= $('#title').val();			
		var cost_code_select 	= $("input[name*='cost_code_id']").val();
		var quantity 			= $("input[name*='quantity']").val();
		var uni_cost 			= $("input[name*='unit_cost']").val();				
		
		if(title == '' || cost_code_select == '' || quantity == '' || uni_cost == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{			
			add_budget_po_form();
			e.preventDefault();
		}
    });
    $('#save_new').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('save_and_new');
        var title 				= $('#title').val();			
		var cost_code_select 	= $("input[name*='cost_code_id']").val();
		var quantity 			= $("input[name*='quantity']").val();
		var uni_cost 			= $("input[name*='unit_cost']").val();				
		
		if(title == '' || cost_code_select == '' || quantity == '' || uni_cost == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{			
			add_budget_po_form();
			e.preventDefault();
		}
    });
    $('#save_back').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('save_and_back');
		var title 				= $('#title').val();			
		var cost_code_select 	= $("input[name*='cost_code_id']").val();
		var quantity 			= $("input[name*='quantity']").val();
		var uni_cost 			= $("input[name*='unit_cost']").val();				
		
		if(title == '' || cost_code_select == '' || quantity == '' || uni_cost == ''){			
			error_box();
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{			
			add_budget_po_form();
			e.preventDefault();
		} 
    });
    

    $('#po_cancel').click(function(e) {
        $('#current_tab').val('');
        var type = $('#type').val().toLowerCase();
        var encoded_home_string = Base64.encode('template/budget/project_budget/');
        var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
        window.location.href = encoded_home_val+'#'+type; 
        e.preventDefault();      
    });

    
    
});

 function add_budget_po_form(){	
    // Encode the String
    var user_id = $('#user_id').val();
    var created_by = $('#created_by').val();
    var ub_po_co_id = $('#po_co_id').val();
    
    var type = $('#type').val();
    var encoded_string = Base64.encode('template/budget/save_po_co/'+type);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('template/budget/project_budget/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

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
        	/*$.when(file_upload(response.insert_id)).done(function()
            {*/
				if($("#save_type").val() == 'save_and_new')
				{
					window.location.href = encoded_val;
				}
				else if($("#save_type").val() == 'save_and_back')
				{
					window.location.href = encoded_home_val;
				}
				else if($("#save_type").val() == 'save_and_release')
				{
				  $tab_href = $('.tab-con li.active a').attr('href');
				  var encoded_string_edit_log = Base64.encode( 'template/budget/save_po_co/'+type +'/'+ ub_po_co_id);
				  var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
				  window.location.href = encoded_edit_val+$tab_href;
				  location.reload(true);
				}
				else if($("#save_type").val() == 'save_and_stay')
				{
					  var encoded_string_edit_builderuser = Base64.encode('template/budget/save_po_co/'+type +'/'+ response.insert_id);
					  var encoded_edit_val = encoded_string_edit_builderuser.strtr(encode_chars_obj);
					  window.location.href = encoded_edit_val+tab;
					  //location.reload(true);
					//po_status_list();
					//get_cost_code();
					//po_bids_list_view();
					//po_payment_list_view();
				}				
				if(response.message)
				{
					success_msg = response.message;
				}
				success_box();
				$('.error-message .alerts').text(success_msg);
			/*});*/
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

function add_new_budget_po_form(){	
		$('#add_new_budget_po').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save_stay, #save_new, #save_back, #budget_po_tab li a'			
        },
        fields: {
            'title': {
                validators: {
                    notEmpty: {
                        message: 'The Titele is required cannot be empty'
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

function delete_po_co(po_co_ids_obj){
    if(po_co_ids_obj > 0)
    {
    var encoded_delete_roles = Base64.encode('template/budget/delete_po_co/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('template/budget/project_budget/');
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
            data: {'ub_template_po_co_id':{ub_template_po_co_id:po_co_ids_obj}},
            success: function(response) {   
                if(response.status == true)
                {   
                    $(".error-message .alerts").removeClass('alert-danger');
                    $(".error-message .alerts").addClass('alert-success');
                    $(".error-message").show();
                    if(response.message)
                    {
                        success_msg = response.message;
                        window.location.href = index_url+'#po';                           
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




