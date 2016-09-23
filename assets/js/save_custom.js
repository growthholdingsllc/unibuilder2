$(function() {
	
/* Custom Field Checkbox */
	$('input[type="checkbox"]').each(function(){
		var check_val = $(this).val();
		if(check_val == 'Yes'){
			$(this).iCheck('check'); 	
		}
		else if(check_val == 'No'){
			$(this).iCheck('uncheck'); 
		}
	});
	$(document).on('ifChecked','.checkbox_is_checked', function(){
		$(this).iCheck('check');
		$(this).val('Yes');
	});
	$(document).on('ifUnchecked','.checkbox_is_checked', function(){
		$(this).iCheck('uncheck');
		$(this).val('No');
	});
	
	/* Custom Field Checkbox */

});

// for validating number
	function isNumber(evt) {
	    evt = (evt) ? evt : window.event;
	    var charCode = (evt.which) ? evt.which : evt.keyCode;
	    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	        return false;
	    }
	    return true;
	}