$(function(){
  
  $('#bid_reject').click(function(e) { 
  $('#bid_sub_status').val('Rejected'); 
    bid_status();
    e.preventDefault();
    });

  $('#bid_accept').click(function(e) { 
   $('#bid_sub_status').val('Accepted'); 
    bid_status();
    e.preventDefault();
    });

  $(function(){
    CKEDITOR.replace( 'sub_notes', {
    toolbar : [
    [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat']
    ]
   });
  });

  var inputs = $(".varian");
                inputs.keyup(function(){          
                    var total = 0;
                    $.each(inputs, function(input){
                        var num = parseInt(inputs[input].value);
                        total += (!isNaN(num))? num : 0;
            $(this).parent().removeClass('has-error');
                    });
      if(inputs == ''){
        $(this).parent().addClass('has-error');       
      }
      else{
        $(this).parent().removeClass('has-error');  
        $(this).next('span').text('');        
      }
            $("#total").html(total);
            $("#bid_amount").val(total);
          });

});

  $('#btncancel').click(function(e) {   
         var bid_id = $('#bid_id').val();
         var encoded_home_string = Base64.encode('bids/save_bid/'+bid_id);
         var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
         window.location.href = encoded_home_val; 
         e.preventDefault();      
    });

function bid_status()
{

    // Encode the String
    var encoded_string = Base64.encode('bids/update_bid_status/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
   

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    
    var ub_bid_request_id = $('#ub_bid_request_id').val(); 
    var bid_sub_status = $('#bid_sub_status').val();
    var bid_id = $('#bid_id').val();
    var ajaxData  = $("#edit_bid").serialize();    
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData, 
        beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');      
        },        
        success: function(response) {           
            if(response.status == true)
            {
              $('.uni_wrapper').removeClass('loadingDiv');
              var encoded_string_edit_log = Base64.encode( 'bids/save_bid/' + bid_id);
              var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
              window.location.href = encoded_edit_val;
            	
            }
         }
     }); 
   
   

	 
}

//file upload list
$(function() {
    uploaded_doc_content_form();
});
function uploaded_doc_content_form() {
	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	var folderid = $("#folder_id").val();
	var moduleid = $("#ub_bid_request_id").val();
	var projectid = $("#project_id").val();
	var encoded_string = Base64.encode('bids/get_uploaded_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
						'tableName': $('#uploaded_doc_content'),
						'this_table' : {'table_name':'uploaded_doc_content'},
						'ajax_encoded_url':encoded_val,
						//'parent_id' : '{"folderid":"'+folderid+'"}',
						'folder_id' : 'folder_id',
						'post_data':'{"folderid":"'+folderid+'","moduleid":"'+moduleid+'","projectid":"'+projectid+'"}',
						'display_columns' : [{"data": "file_name", "bSortable": false},{"data": "date", "bSortable": false},{"data": "date", "bSortable": false}],
						'default_order_by': [[0, 'desc']]
					};
	// Populate data table
	ubdatatable_docs(dbobject);
}

$('#add_task_new_stay').on('click',function(e) {  
  $("#save_type").val('save_and_stay');
    var mandatory = $('#bid_amount').val(); 
        var varian    = $('.varian').val();   
        var textfield    = $('#textfield').val();
        var flatt_fee_amount = $('#flatt_fee_amount').val();   
    if(varian == '' || flatt_fee_amount == 0.00){
      $('.error-message').show();
      $('.error-message .alerts').removeClass('alert-success');
      $('.error-message .alerts').removeClass('alert-danger');
      $('.error-message .alerts').addClass('alert-danger');
      $('.error-message .alerts').text('Please fill all mandatory fields'); 
      $('.varian').parent().addClass('has-error');
      $('.varian').next('span').text('The bid amount cannot be empty');
      return false;
    }
    else{
      $('.varian').parent().removeClass('has-error');
      $('.varian').next('span').text('');
      save_bidrequest_form();
      e.preventDefault();
    }
    
});
/*
Add/ Update Bids_request
*/
function save_bidrequest_form() {
    // Encode the String
    var encoded_string = Base64.encode('bids/submit_bids_request/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('bids/get_bid_requests/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';

    var ub_bid_request_id = $('#ub_bid_request_id').val();
    var ub_bid_id = $('#ub_bid_id').val();
    var sub_notes = CKEDITOR.instances.sub_notes.getData();
  //alert(sub_notes);
    var ajaxData  = $("#edit_bid").serialize();
  
  //return false;
   // var project = $("#project_id").val();
   // var date = $("#log_date").val();
   // var ub_daily_log_id = $('#ub_daily_log_id').val();    
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData+ '&sub_notes=' + sub_notes,
    beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');   
        },    
        success: function(response) { 
      $('.uni_wrapper').removeClass('loadingDiv');    
            if(response.status == true)
            {  
        /*$.when(file_upload(response.insert_id)).done(function()
        {*/
          
          if($("#save_type").val() == 'save_and_new')
          {
            var encoded_string_edit_log = Base64.encode('bids/accept_bid/'+ub_bid_request_id+'/'+ub_bid_id);
            var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
            window.location.href = encoded_edit_val;
          }
          else if($("#save_type").val() == 'save_and_back')
          {
            window.location.href = encoded_home_val;
          }
          else if($("#save_type").val() == 'save_and_stay')
          {
             //var encoded_string_edit_log = Base64.encode( 'bids/submit_bids_request/' + response.insert_id);

              var encoded_string_edit_log = Base64.encode('bids/accept_bid/'+ub_bid_request_id+'/'+ub_bid_id);

              var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
              window.location.href = encoded_edit_val; 
             

          }
        /*}
        );  */      
        success_box();
        $('.error-message .alerts').text('Updated successfully'); 
        
        //return false;
      }
      else{
        error_box();        
        $('.error-message .alerts').text('Update failed');  
        
      }
    }
    
    }); 
   
   
}

$(function(){

  
   $('#flatt_fee_amount').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
 
 $(document).on('keyup','.varian', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){ return ''; }) );
 });
});
