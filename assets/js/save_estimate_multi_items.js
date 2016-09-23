$(function(){
	$("#cost_code_id").selectpicker({
		multiple:true
	});
	//$("#cost_code_id option[value=" + 11 + "]").removeAttr('disabled');

$('#save_estimate_multiple_items').hide();	
	var eastimate_dropdown_value = $('.cost_code #cost_code_id').html();	
	var values = '';	
	$('.add_estimate_new').on('click',function(){					
		$('.added_estimate_multiple_items').html('');	
		
		var value = $('#cost_code_id').val();
		if(value !=null){
			var values = value.filter(function(value) { return value != '0' });				
		}
		var optionText = new Array();
		$("#cost_code_id :selected").each(function () {
			optionText.push($(this).text());		
		});		
		var optionText1 = optionText.filter(function(value) { return value != 'Select All' });
		var description_val 		= $('#description').val();		
		var quantity_val 			= $('#quantity').val();		
		var unit_cost_val 			= $('#unit_cost').val();		
		var budget_amount_val		= $('#budget_amount').val();		
		var overhead_cost_val 		= $('#overhead_cost').val();							
		var description 	= '<div class="col-xs-3"><input type="text" id="description" name="description[]" value="'+description_val+'" class="form-control" placeholder="Description" /></div>';
		var quantity 		= '<div class="col-xs-1"><input type="text" id="quantity" name="quantity[]" value="'+quantity_val+'" class="form-control"  placeholder="Qty" autocomplete="off" /></div>';		
		var unit_cost 		= '<div class="col-xs-1"><input type="text" id="unit_cost" name="unit_cost[]" value="'+unit_cost_val+'" class="form-control"  placeholder="Unit Cost($)" autocomplete="off" /></div>';
		var budget_amount 	= '<div class="col-xs-1"><input type="text" id="budget_amount" name="budget_amount[]" value="'+budget_amount_val+'" class="form-control"  placeholder="Total" readonly value="" /></div>';
		var overhead_cost 	= '<div class="col-xs-2"><input type="text" id="overhead_cost" name="overhead_cost[]" value="'+overhead_cost_val+'" class="form-control"  placeholder="Estimated Overhead($)" /></div>';		
		var remove_btn = '<div class="col-xs-1"><a href="javascript:void(0);" class="remove_field_old pull-right"><img src="'+imgLink+'delete.png"/></a></div>';		
		
		if(values == null || values == ''){
			// alert('Please select cost code');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select cost code');
		}
		else{
			// $('.uni_wrapper').addClass('loadingDiv');
			for(var i = 0; i < values.length; i += 1) {			  
			   var cost_code 	  = '<div class="col-xs-3 old_cost_code"><select class="form-control selectpicker" id="costcode_id" name="costcode_id[]"><option value="'+values[i]+'">'+optionText1[i]+'</option></select></div>';

				$('<div class="clon col-xs-12">'+cost_code+description+quantity+unit_cost+budget_amount+overhead_cost+remove_btn+'</div>').appendTo('.added_estimate_multiple_items');			
			}
			$('.selectpicker').selectpicker('refresh');	
			$('.estimate_multiple_items').show();
			$('#save_estimate_multiple_items').show();	
			// $('.uni_wrapper').removeClass('loadingDiv');
		}	
				
	});
	$(".added_estimate_multiple_items").on('click','.remove_field_old',function(){
		$(this).parent().parent().remove();		
		var selected_val = $(this).parent().parent().find('select').val();	
		$('#cost_code_id').find('[value='+selected_val+']').prop('selected', false);
		$values = $('#cost_code_id').val();	
		$('#cost_code_id').selectpicker('deselectAll');
		$('#cost_code_id').selectpicker('val', $values );
		$('#cost_code_id').selectpicker('refresh');
		if($('.added_estimate_multiple_items .col-xs-12').hasClass("clon")){	
			$('.estimate_multiple_items').show();	
			$('#save_estimate_multiple_items').show();
		}
		else{
			$('.estimate_multiple_items').hide();
			$('#save_estimate_multiple_items').hide();
		}
	});
	$('.estimate_multiple_items').hide();
	var max_fields      = 1000;
    var wrapper         = $(".added_estimate_multiple_items");
    var add_button      = $(".add_estimate");    
    var x = 1;
    $(add_button).click(function(e){
		$('.estimate_multiple_items').show();
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div class="clon col-xs-12"><div class="col-xs-3"><select class="form-control selectpicker" id="cost_code_id" name="costcode_id[]" >'+eastimate_dropdown_value.replace('Select All', 'Nothing Selected')+'</select></div><div class="col-xs-3"><input type="text" id="description" name="description[]" class="form-control" placeholder="Description" /></div><div class="col-xs-1"><input type="text" id="quantity" name="quantity[]" class="form-control" value="1" placeholder="Qty" /></div><div class="col-xs-1"><input type="text" id="unit_cost" name="unit_cost[]" class="form-control"  placeholder="Unit Cost($)" /></div><div class="col-xs-1"><input type="text" id="budget_amount" name="budget_amount[]" class="form-control"  placeholder="Total" readonly /></div><div class="col-xs-2"><input type="text" id="overhead_cost" name="overhead_cost[]" class="form-control"  placeholder="Estimated Overhead($)" /></div><div class="col-xs-1"><a href="javascript:void(0);" class="remove_field pull-right"><img src="'+imgLink+'delete.png"/></a></div></div>'); //add input box
        }	
	$('.selectpicker').data('selectpicker', null);
	$('.bootstrap-select').remove();
	$('.selectpicker').selectpicker();		
		
    });    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text      	 
		$(this).parent().parent('.clon, .wrapper').remove(); 		
		x--;
		if($('.added_estimate_multiple_items .col-xs-12').hasClass("clon")){	
			$('.estimate_multiple_items').show();	
		}
		else{
			$('.estimate_multiple_items').hide();
		}
    });
	$(document).on('keyup change', '.added_estimate_multiple_items input[name="quantity[]"], .added_estimate_multiple_items input[name="unit_cost[]"]', function() {
		var $input = $(this).closest('.clon');
		var quantity = Number($input.find('input[name="quantity[]"]').val()) || 0;
		var unicost = Number($input.find('input[name="unit_cost[]"]').val()) || 0;
		var total = (quantity * unicost);        
		$input.find('input[name="budget_amount[]"]').val(total);		
	});	
	
	$(document).on('keyup blur change','input[name="quantity[]"]', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){ return ''; }) );
		if($inpt.val() == ''){	
			$(this).parent().addClass('has-error');			
		}
		else{
			$(this).parent().removeClass('has-error');
		}
	});
	$(document).on('keyup blur change','input[name="unit_cost[]"]', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){ return ''; }) );
		if($inpt.val() == ''){	
			$(this).parent().addClass('has-error');			
		}
		else{
			$(this).parent().removeClass('has-error');
		}
	});
	$(document).on('keyup blur change','input[name="overhead_cost[]"]', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){ return ''; }) );
		if($inpt.val() == ''){	
			$(this).parent().addClass('has-error');			
		}
		else{
			$(this).parent().removeClass('has-error');
		}
	});
	$(document).on('keyup blur change','input[name="client_contract[]"]', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){ return ''; }) );
		if($inpt.val() == ''){	
			$(this).parent().addClass('has-error');			
		}
		else{
			$(this).parent().removeClass('has-error');
		}
	});
	
});

// $( "#budget_amount, #quantity, #unit_cost" ).keyup(function() {
$("body").on("keyup change", "#budget_amount, #quantity, #unit_cost", function(event){ 
  var quantity = $("#quantity").val();
  var unit_cost = $("#unit_cost").val();
  var budget_amount =  (quantity * unit_cost);
  $("#budget_amount").val(budget_amount);
});

$(function(){
	$('#save_estimate_multiple_items').on('click', function(e){
		/*var values = $('#cost_code_id').val();
		if(values == null || values == '' ){
			// alert('Please select cost code');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select cost code');
			return false;
		}*/
		$(".error-message").hide();
		var reurnestimate;
		var return_quantity_val;
		var return_unit_cost_val;
		
		var optionVal = new Array();	
		$('.added_estimate_multiple_items .clon select').each(function() {
			if($(this).val() == 0 || $(this).val() == "0"){
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Please select cost code');
				return false;
			}
			optionVal.push($(this).val());
		});
		var uniqueArray = optionVal.filter(function(elem, pos) {
			var duplicate_value =  optionVal.indexOf(elem) == pos;
			reurnestimate = duplicate_value;
			/* if(duplicate_value == false)
			{
					error_box();	
					$('.error-message .alerts').text('Duplicate Cost Code');					
					return false;					
			} */
		});			
		$('.added_estimate_multiple_items .clon input[name="quantity[]"]').each(function() {	
			var quantity_val = $(this).val();
			return_quantity_val = quantity_val;
			/* if($(this).val() == ''){				
				$(this).parent().addClass('has-error');	
				e.preventDefault();
			} */
		});
		$('.added_estimate_multiple_items .clon input[name="unit_cost[]"]').each(function() {
			var unit_cost_val = $(this).val();
			return_unit_cost_val = unit_cost_val;	
			
			/* if($(this).val() == ''){				
				$(this).parent().addClass('has-error');
				e.preventDefault();
			} */
		
		});		
		if(return_quantity_val == ''){
			$('.clon input[name="quantity[]"]').parent().addClass('has-error');	
		}
		if(return_unit_cost_val == ''){
			$('.clon input[name="unit_cost[]"]').parent().addClass('has-error');	
		}
		if(reurnestimate == false){
			error_box();	
			$('.error-message .alerts').text('Duplicate Cost Code');								
		}				
		if(reurnestimate == true && return_quantity_val =='' && return_unit_cost_val ==''){
			error_box();	
			$('.error-message .alerts').text('Please fill all mandatory field');								
		}
		if(return_quantity_val !='' && return_unit_cost_val !='' && reurnestimate == true){
			add_multiple_estimate_form();
			success_box();
			$('.error-message .alerts').text('Added Successfully');	
		}
		
		//add_multiple_estimate_form();
		return false;
	});
});

function add_multiple_estimate_form() {
	var encoded_string = Base64.encode('budget/save_multiple_estimate/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
					
	var ajaxData  = $("#estimate_multiple_items").serialize();	
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
				var encoded_string_edit_log = Base64.encode( 'budget/project_budget/');
				var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);								
				window.location.href = encoded_edit_val+"#jobs";
				//location.reload(true);				
				if(response.message)
				{
					success_msg = response.message;								
				}
				//$(".alert").html(success_msg);
			}
			else
			{
				if(response.message)
				{
					failure_msg = response.message;
					error_box();	
					$('.error-message .alerts').text(failure_msg);					
				}	
				//$(".alert").html(failure_msg);				
			}
			return false;
		}
	});	
}
/* $(function(){
	$('#cost_code_id').on('change', function(){
		toggleSelectAll($(this));
	}).trigger('change');	
function toggleSelectAll(control) {
    var allOptionIsSelected = (control.val() || []).indexOf("0") > -1;
    function valuesOf(elements) {
        return $.map(elements, function(element) {
            return element.value;
        });
    }

    if (control.data('allOptionIsSelected') != allOptionIsSelected) {
        // User clicked 'All' option
        if (allOptionIsSelected) {
            // Can't use .selectpicker('selectAll') because multiple "change" events will be triggered
            control.selectpicker('val', valuesOf(control.find('option')));
        } else {
            control.selectpicker('val', []);
        }
    } else {
        // User clicked other option
        if (allOptionIsSelected && control.val().length != control.find('option').length) {
            // All options were selected, user deselected one option
            // => unselect 'All' option
            control.selectpicker('val', valuesOf(control.find('option:selected[value!=0]')));
            allOptionIsSelected = false;
        } else if (!allOptionIsSelected && control.val().length == control.find('option').length - 1) {
            // Not all options were selected, user selected all options except 'All' option
            // => select 'All' option too
            control.selectpicker('val', valuesOf(control.find('option')));
            allOptionIsSelected = true;
        }
    }
    control.data('allOptionIsSelected', allOptionIsSelected);
}


}); */

$(function(){

	var pro_id = $('#pro_id').val();
	if(pro_id != 0)
	{
		$('#save_estimate_multiple_items').show();
	    $('.estimate_multiple_items').show();
	}
	//$('#save_estimate_multiple_items').show();
	//$('.estimate_multiple_items').show();

});