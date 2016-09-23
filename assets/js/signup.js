$(function() {
	$('#accept').click(function(e) { 
	 var  ub_user_id = $('#ub_user_id').val();
     var encoded_string = Base64.encode('register/accept_invite/'+ub_user_id);
     var encoded_val = encoded_string.strtr(encode_chars_obj);
     window.location.href = encoded_val;
     e.preventDefault();            
    });
    $('#decline').click(function(e) { 
     var encoded_string = Base64.encode('register/reject_invite/');
     var encoded_val = encoded_string.strtr(encode_chars_obj);
     window.location.href = encoded_val;
     e.preventDefault();            
    });   
   
});


