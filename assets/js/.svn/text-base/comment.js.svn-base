$(function(){
	update_comment_form();

    // $('#post_comment').click(function(e) {
        // add_comment();
        // e.preventDefault();      
    // });
   $('#commentModal').on('hidden.bs.modal', function () {
      $('#form_comment').formValidation('resetForm', true);
      $(this).find('form')[0].reset();
   });
});

/*
Add Comment
*/
function add_comment()
{
    //var form = document.forms[0].id;
    var ajaxData  = $('#form_comment').serialize();
    var encoded_string = Base64.encode('bids/save_comment/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
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
            $("#commentModal").modal('hide');
             $.ajaxSetup({cache: false});
             $("#comments_area").load(location.href + " #comments_area");
             //send_notify();
             $("#comments").val('');
             $('#owner').closest('.icheckbox_square-red').removeClass('checked');        
             $('#owner').removeAttr("checked", "checked");
             $('#sub').closest('.icheckbox_square-red').removeClass('checked');        
             $('#sub').removeAttr("checked", "checked");
             $('#owner-child').closest('.icheckbox_square-red').removeClass('checked');        
             $('#owner-child').removeAttr("checked", "checked");
             $('#sub-child').closest('.icheckbox_square-red').removeClass('checked');        
             $('#sub-child').removeAttr("checked", "checked");
   

        }
        });
}

//Delete Comment
function delete_comment(comment_ids_obj){
    
    var encoded_delete_roles = Base64.encode('bids/delete_comment/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var conf = $('#confirm_comment_Modal').modal('show');
  $('#delete_comment_confirm').click(function(){
  var conf = true;
    if(conf == true){  
  $('#confirm_comment_Modal').modal('hide');
    $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: {'ub_comments_id':{ub_comments_id:comment_ids_obj}},
            success: function(response) {   
                if(response.status == true)
                {   
                   
                    if(response.message)
                    {
                        
                        //window.location.href = index_url;
                        $.ajaxSetup({cache: false});
                        $("#comments_area").load(location.href + " #comments_area");
                           
                    }
                    
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

function update_comment_form(){	
	var updatecommentform = $('#form_comment').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#post_comment'			
        },
        fields: {            
			'comments': {
                validators: {
                    notEmpty: {
                        message: 'The comments is required and cannot be empty'
                    },
					stringLength: {
                        min: 2,
                        max: 4000,
                        message: 'The comments must be less than 4000 characters'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			add_comment();									
			e.preventDefault();			 
	  });		 
}