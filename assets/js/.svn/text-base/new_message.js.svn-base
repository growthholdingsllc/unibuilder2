 $(function(){
   	$('#alt-email').tagsinput({		
   		allowDuplicates: false
   	});
   $('#alt-email-cc').tagsinput({		
   		allowDuplicates: false
   	});
   $('#alt-email-bcc').tagsinput({		
   		allowDuplicates: false
   	});
   $('#alt-email-to').tagsinput({		
   		allowDuplicates: false
   	});

$('.alt-email-to, .alt-email-cc, .alt-email-bcc').hide();

$(document).on('ifChecked','#toemailinput', function(event){
	$('.alt-email-to').show();
});
$(document).on('ifChecked','#ccemailinput', function(event){
	$('.alt-email-cc').show();
});
$(document).on('ifChecked','#bccemailinput', function(event){
	$('.alt-email-bcc').show();
});

$(document).on('ifUnchecked','#toemailinput', function(event){
	$('.alt-email-to').hide();
});
$(document).on('ifUnchecked','#ccemailinput', function(event){
	$('.alt-email-cc').hide();
});
$(document).on('ifUnchecked','#bccemailinput', function(event){
	$('.alt-email-bcc').hide();
});
});