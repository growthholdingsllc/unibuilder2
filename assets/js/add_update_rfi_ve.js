$('#add_rfi_modal').click(function(){
   $('.assign').hide();
   $('#ub_bid_rfi_ve_id').val(0);
   $('#question').val('');
   $('#question').attr('readonly', false);
   $('#question_by').val('');
   $('#answer').val('');
   $('#deadline').val('');
   $('.selectpicker').selectpicker('refresh');
   $("#assign_to_ids option[value='']").prop("selected", true);
   $('#assign_to_ids').attr('disabled',false);
   $('.selectpicker').selectpicker('refresh');
   $('#visibile_to_subs').closest('.icheckbox_square-red').removeClass('checked');   
   $('#visibile_to_subs').removeAttr("checked", "checked");
   $('#datetimepicker6').find('input').attr("disabled", false);
   $('#datetimepicker6 .glyphicon-remove').show();
   $("#visibile_to_subs").iCheck('enable');
   if(account_type == SUBCONTRACTOR)
   {
    $('#assigne_name').val('');
    $('#assign_to_ids').val(0);
   }
   if(account_type == BUILDERADMIN)
   {
     //$('#assign_to_ids').attr('disabled',false);

   }
   $('.error-mes').html('');
 });

// $('#save-rfi').click(function(e) {  
	// add_rfi();
	// scroll_div();
    // e.preventDefault();
    
// });

$('#cancel-rfi').click(function(e) {  
    $("#addrfi").modal('hide');
    e.preventDefault();
    
    });
$('#cancel-ve').click(function(e) {  
    $("#addve").modal('hide');
    e.preventDefault();
    
    });

$('#add_ve_modal').click(function(){
   $('.assign').hide();
   $('#rfi_ve_id').val(0);
   $('#ve_question').val('');
   $('#ve_question').attr('readonly', false);
   $('#ve_question_by').val('');
   $('#ve_answer').val('');
   $('.selectpicker').selectpicker('refresh');
   $("#ve_assign_to_ids option[value='']").prop("selected", true);
   $('#ve_assign_to_ids').attr('disabled',false);
   $('.selectpicker').selectpicker('refresh');
   $('#ve_visibile_to_subs').closest('.icheckbox_square-red').removeClass('checked');   
   $('#ve_visibile_to_subs').removeAttr("checked", "checked");
   $("#ve_visibile_to_subs").iCheck('enable');
   if(account_type == SUBCONTRACTOR)
   {
    $('#ve_assigne_name').val('');
    $('#ve_assign_to_ids').val(0);
   }
   $('.error-mes').html('');
 });

// $('#save-ve').click(function(e) {  
    // add_ve();
	 // scroll_div();
    // e.preventDefault();    
// });

/*
Add/ Update Bid
*/
function add_rfi() {
	 scroll_div();
    // Encode the String
    var encoded_string = Base64.encode('bids/save_rfi/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    //var form = document.forms[0].id;
    var ajaxData  = $('#rfi_save').serialize();
    var ub_bid_rfi_ve_id = $('#ub_bid_rfi_ve_id').val();
    var answer = $('#answer').val();
    if(ub_bid_rfi_ve_id > 0)
    {
      if(answer == '')
      {
        $('.error-mes').html('Please enter the answer');
        return false;
      }
    }
    //alert(ub_bid_rfi_ve_id);//return false;
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
				 $("#addrfi").modal('hide');               
                 search_rfi('all_rfi');
				 $('.uni_wrapper').removeClass('loadingDiv');
            }
          }
    }); 
   
   
}

function add_ve() {
 scroll_div();
    // Encode the String
    var encoded_string = Base64.encode('bids/save_ve/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    //var form = document.forms[0].id;
    var ajaxData  = $('#ve_save').serialize();
    var rfi_ve_id = $('#rfi_ve_id').val();
    var answer = $('#ve_answer').val();
    if(rfi_ve_id > 0)
    {
      if(answer == '')
      {
        $('.error-mes').html('Please enter the answer');
        return false;
      }
    }
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
                $("#addve").modal('hide');                
                search_ve('all_ve');
				$('.uni_wrapper').removeClass('loadingDiv');
            }
          }
    }); 
   
   
}

function update_rfi(id)
{
  //alert(id);
  $('#ub_bid_rfi_ve_id').val(id);
  $('.assign').show();
  //$('#save-rfi').attr('id','update-rfi');
  var ub_bid_rfi_ve_id = $('#ub_bid_rfi_ve_id').val();

  var encoded_string = Base64.encode('bids/get_rfi_ve/');
  var encoded_val = encoded_string.strtr(encode_chars_obj);
  
    var ajaxData  = "ub_bid_rfi_ve_id="+ub_bid_rfi_ve_id;
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {           
            if(response.status == true)
            {   
               $('#question_by').val(response.question_by);
               $('#question').val(response.question);
               $('#question').attr('readonly', true);
               $('#answer').val(response.answer);
               $('#deadline').val(response.deadline);
               $('.error-mes').html('');
               if(response.visible_to_subs == 'Yes')
               {
                $('#visibile_to_subs').closest('.icheckbox_square-red').addClass('checked');   
                $('#visibile_to_subs').attr("checked", "checked");
                
               }
               else
               {         
                $('#visibile_to_subs').closest('.icheckbox_square-red').removeClass('checked');   
                $('#visibile_to_subs').removeAttr("checked", "checked");
 
               }
               /*$('#datetimepicker6').find('input').attr("disabled", true);
               $('#datetimepicker6 .glyphicon-remove').hide();*/
               if(account_type == BUILDERADMIN)
               {
                
                $('.selectpicker').selectpicker('refresh');
                  $("#assign_to_ids option[value='" + response.assign_to_ids + "']").prop("selected", true);
                  //$('#assign_to_ids').attr('disabled',true);
                  $('.selectpicker').selectpicker('refresh');

                if(response.question_by == response.created_by)
                {
                  /*$('.selectpicker').selectpicker('refresh');
                  $("#assign_to_ids option[value='" + response.assign_to_ids + "']").prop("selected", true);
                  $('#assign_to_ids').attr('disabled',true);
                  $('.selectpicker').selectpicker('refresh');*/
                  
                }
                else
                {
                  
                 /* $('.selectpicker').selectpicker('refresh');
                  $("#assign_to_ids option[value='" + response.question_by + "']").prop("selected", true);
                  $('#assign_to_ids').attr('disabled',true);
                  $('.selectpicker').selectpicker('refresh');*/
                  
                }

               }
               /*if(account_type == BUILDERADMIN)
               {
                 $('.selectpicker').selectpicker('refresh');
                 $("#assign_to_ids option[value='" + response.assign_to_ids + "']").prop("selected", true);
                 $('.selectpicker').selectpicker('refresh');
               }*/
               else if(account_type == SUBCONTRACTOR)
               {
                  $('#assigne_name').val(response.assigned);
                  $('#assign_to_ids').val(response.assign_to_ids);
                  $('#datetimepicker6').find('input').attr("disabled", true);
                  $('#datetimepicker6 .glyphicon-remove').hide();
                  $("#visibile_to_subs").iCheck('disable');
               }
               /*$('.selectpicker').selectpicker('refresh');
               $("#assign_to_ids option[value='" + response.assign_to_ids + "']").prop("selected", true);
               $('.selectpicker').selectpicker('refresh');*/
               
               // $("#visibile_to_subs").iCheck('disable');

            }
          }
    }); 
}

function update_ve(id)
{
  //alert(id);
  $('#rfi_ve_id').val(id);
  $('.assign').show();
  var rfi_ve_id = $('#rfi_ve_id').val();

  var encoded_string = Base64.encode('bids/get_rfi_ve/');
  var encoded_val = encoded_string.strtr(encode_chars_obj);
  
    var ajaxData  = "ub_bid_rfi_ve_id="+rfi_ve_id;
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {           
            if(response.status == true)
            {   
               $('#ve_question_by').val(response.question_by);
               $('#ve_question').val(response.question);
               $('#ve_question').attr('readonly', true);
               $('#ve_answer').val(response.answer);
               $('#ve_deadline').val(response.deadline);
               $('.error-mes').html('');
               if(response.visible_to_subs == 'Yes')
               {
                $('#ve_visibile_to_subs').closest('.icheckbox_square-red').addClass('checked');   
                $('#ve_visibile_to_subs').attr("checked", "checked");
                
               }
               else
               {
                $('#ve_visibile_to_subs').closest('.icheckbox_square-red').removeClass('checked');   
                $('#ve_visibile_to_subs').removeAttr("checked", "checked");
               }
               if(account_type == BUILDERADMIN)
               {
                $('.selectpicker').selectpicker('refresh');
                  $("#ve_assign_to_ids option[value='" + response.assign_to_ids + "']").prop("selected", true);
                  //$('#ve_assign_to_ids').attr('disabled',true);
                  $('.selectpicker').selectpicker('refresh');
                if(response.question_by == response.created_by)
                {
                  /*$('.selectpicker').selectpicker('refresh');
                  $("#ve_assign_to_ids option[value='" + response.assign_to_ids + "']").prop("selected", true);
                  $('#ve_assign_to_ids').attr('disabled',true);
                  $('.selectpicker').selectpicker('refresh');*/
                }
                else
                {
                  /*
                  $('.selectpicker').selectpicker('refresh');
                  $("#ve_assign_to_ids option[value='" + response.question_by + "']").prop("selected", true);
                  $('#ve_assign_to_ids').attr('disabled',true);
                  $('.selectpicker').selectpicker('refresh');*/
                }

               }
               /*if(account_type == BUILDERADMIN)
               {
                 $('.selectpicker').selectpicker('refresh');
                 $("#ve_assign_to_ids option[value='" + response.assign_to_ids + "']").prop("selected", true);
                 $('.selectpicker').selectpicker('refresh');
               }*/
               else if(account_type == SUBCONTRACTOR)
               {
                  $('#ve_assigne_name').val(response.assigned);
                  $('#ve_assign_to_ids').val(response.assign_to_ids);
                  $("#ve_visibile_to_subs").iCheck('disable');
               }
               /*$('.selectpicker').selectpicker('refresh');
               $("#ve_assign_to_ids option[value='" + response.assign_to_ids + "']").prop("selected", true);
               $('.selectpicker').selectpicker('refresh');*/
               
               // $("#ve_visibile_to_subs").iCheck('disable');
               
            }
          }
    }); 
}
$(function(){
	update_rfi_form();
	update_ve_form();
	search_rfi('all_rfi');
	search_ve('all_ve');
	//rfi_counter();
	scroll_div();
  $('#addrfi').on('hidden.bs.modal', function () {
        $('#rfi_save').formValidation('resetForm', true);
        $(this).find('form')[0].reset();       
    }); 
  $('#addve').on('hidden.bs.modal', function () {
        $('#ve_save').formValidation('resetForm', true);
        $(this).find('form')[0].reset();       
    });	
	$('.scroll-pane-bids').css("width", "100% !important");
	$('#datetimepicker6').on("dp.show", function(e) {				
		var left = $(this).offset().left;		
		var ele = $(e.target).data('DateTimePicker');
		$(ele.widget).addClass('ssss');
		if (ele.widget.position().left > 0) {
			$(ele.widget).addClass('RFI_Picker');			
				 
		}			 
	});	
});
function search_rfi(id)
{
$('.scroll-pane-bids').css("width", "100% !important");
  var ub_bid_id = $("#ub_bid_id").val();
  var encoded_string = Base64.encode('bids/search_rfi/');
  var encoded_val = encoded_string.strtr(encode_chars_obj);
  var ajaxData = '';
  var form = document.forms[0].id;
  ajaxData  = "search_param="+id+'&ub_bid_id='+ub_bid_id;

  $("#search").empty();
  $("#search_counter").empty();
  var wrapper = $("#search");
  var rfi_counter = $("#search_counter");
    //var ajaxData  = "search_param="+id+'&ub_bid_id='+ub_bid_id;
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
    all_rfi = response.all_rfi;
    $.each(all_rfi, function( index, values ) {
      all_rfi = values.all_rfi;
    });

    rfi_created_by_me = response.rfi_created_by_me;
    $.each(rfi_created_by_me, function( index, values ) {
      rfi_created_by_me = values.asked_by_me;
    });

    rfi_asign_to_me = response.rfi_asign_to_me;
    $.each(rfi_asign_to_me, function( index, values ) {
      rfi_asign_to_me = values.assigned_to_me;
    });

    rfi_unanswered = response.rfi_unanswered;
    $.each(rfi_unanswered, function( index, values ) {
      rfi_unanswered = values.answer;
    });
    var answer = all_rfi - rfi_unanswered;
              $(rfi_counter).append('<p><a href="javascript:void(0);" id="all_rfi" onclick="search_rfi(this.id)">All ('+all_rfi+')</a> | <a href="javascript:void(0);" id="asked_by_me" onclick="search_rfi(this.id)">Asked By Me ('+rfi_created_by_me+')</a> | <a href="javascript:void(0);" id="assigned_to_me" onclick="search_rfi(this.id)">Assigned To Me ('+rfi_asign_to_me+')</a> |<a href="javascript:void(0);" id="answered" onclick="search_rfi(this.id)"> Answered ('+answer+')</a> | <a href="javascript:void(0);" id="unaswered" onclick="search_rfi(this.id)">Unanswered ('+rfi_unanswered+')</a></p>');

              parsed_obj = response.rfi_search_list;
              

              $.each(parsed_obj, function( index, valuess ) {
                
               
    
    var subcontractor_name = '';
    var answer = '';
    var modified_by = '';  
    var modified_on = '';
    var msg = ''; 
    //alert(valuess.deadline);
    if((valuess.answer == '' && response.session == valuess.assign_to_ids) || (account_type == BUILDERADMIN && (valuess.created_by == response.created || response.session == valuess.assign_to_ids)) && valuess.answer == '')
    {
     var answer = '<a href="javascript:void(0);" data-target="#addrfi" data-toggle="modal" class="editing" id="'+valuess.ub_bid_rfi_ve_id+'" onclick="update_rfi(this.id)">&nbsp;<img border="0" src="'+response.img+'" alt="Edit" class="simple_edit"></a>';
    }
    else if(valuess.answer != ''){answer = valuess.answer; modified_by = valuess.modified_by; modified_on = valuess.rfi_ve_modified_on; var msg ='<p class="text-muted">- answered by '+modified_by+' on '+modified_on+'</p>';}
    
    if(valuess.created_by == response.created)
    {
       answer += '<a href="javascript:void(0);" class="delete"><img border="0" src="'+response.img+'" alt="Delete" class="delete_icon" id="'+valuess.ub_bid_rfi_ve_id+'" onclick="delete_rfi_ve(this.id)"></a>';
    }
   

    if(valuess.subcontractor_name != null){subcontractor_name = valuess.subcontractor_name;}
    else{subcontractor_name = 'Not Assigned to any one';}
    

                $(wrapper).append('<div class="info_bar"><div class="col-xs-12"><p><strong>Deadline :</strong>'+valuess.deadline+'</p><p><strong>Assigned To :</strong>'+subcontractor_name+'</div><div class="col-xs-12"><div class="alert alert-info col-xs-10" role="alert"><div class="col-xs-12 alert-info-text"><p><strong>Question:</strong>'+valuess.question+'</p><p class="text-muted pull-right">- asked by '+valuess.first_name+' on '+valuess.rfi_ve_created_on+'</p></div></div></div><div class="col-xs-12"><div class="alert alert-warning pull-right col-xs-10" role="alert"><div class="col-xs-12 alert-info-text text-right"><p><strong>Answer:</strong>'+answer+'</p>'+msg+'</div></div></div></div>'); 
                
            });
            
               
            }
            else
            {
              all_rfi = response.all_rfi;
    $.each(all_rfi, function( index, values ) {
      all_rfi = values.all_rfi;
    });

    rfi_created_by_me = response.rfi_created_by_me;
    $.each(rfi_created_by_me, function( index, values ) {
      rfi_created_by_me = values.asked_by_me;
    });

    rfi_asign_to_me = response.rfi_asign_to_me;
    $.each(rfi_asign_to_me, function( index, values ) {
      rfi_asign_to_me = values.assigned_to_me;
    });

    rfi_unanswered = response.rfi_unanswered;
    $.each(rfi_unanswered, function( index, values ) {
      rfi_unanswered = values.answer;
    });
    var answer = all_rfi - rfi_unanswered;
              $(rfi_counter).append('<p><a href="javascript:void(0);" id="all_rfi" onclick="search_rfi(this.id)">All ('+all_rfi+')</a> | <a href="javascript:void(0);" id="asked_by_me" onclick="search_rfi(this.id)">Asked By Me ('+rfi_created_by_me+')</a> | <a href="javascript:void(0);" id="assigned_to_me" onclick="search_rfi(this.id)">Assigned To Me ('+rfi_asign_to_me+')</a> |<a href="javascript:void(0);" id="answered" onclick="search_rfi(this.id)"> Answered ('+answer+')</a> | <a href="javascript:void(0);" id="unaswered" onclick="search_rfi(this.id)">Unanswered ('+rfi_unanswered+')</a></p>');

                $(wrapper).append('<div class="text-center"><p>No Record Found</p></div>');
            }
          }
    }); 
}

function search_ve(id)
{
  var ub_bid_id = $("#ub_bid_id").val();
  var encoded_string = Base64.encode('bids/search_ve/');
  var encoded_val = encoded_string.strtr(encode_chars_obj);
  var ajaxData = '';
  var form = document.forms[0].id;
    ajaxData  = "search_param="+id+'&ub_bid_id='+ub_bid_id;
  $("#search_ve").empty();
  $("#ve_search_counter").empty();
  var wrapper = $("#search_ve");
  var ve_search_counter = $("#ve_search_counter");
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
              all_ve = response.all_ve;
    $.each(all_ve, function( index, values ) {
      all_ve = values.all_ve;
    });

    ve_created_by_me = response.ve_created_by_me;
    $.each(ve_created_by_me, function( index, values ) {
      ve_created_by_me = values.asked_by_me;
    });

    ve_asign_to_me = response.ve_asign_to_me;
    $.each(ve_asign_to_me, function( index, values ) {
      ve_asign_to_me = values.assigned_to_me;
    });

    ve_unanswered = response.ve_unanswered;
    $.each(ve_unanswered, function( index, values ) {
      ve_unanswered = values.answer;
    });
    var answer = all_ve - ve_unanswered;
              $(ve_search_counter).append('<p><a href="javascript:void(0);" id="all_ve" onclick="search_ve(this.id)">All ('+all_ve+')</a> | <a href="javascript:void(0);" id="ve_asked_by_me" onclick="search_ve(this.id)">Asked By Me ('+ve_created_by_me+')</a> | <a href="javascript:void(0);" id="ve_assigned_to_me" onclick="search_ve(this.id)">Assigned To Me ('+ve_asign_to_me+')</a> |<a href="javascript:void(0);" id="ve_answered" onclick="search_ve(this.id)"> Answered ('+answer+')</a> | <a href="javascript:void(0);" id="ve_unaswered" onclick="search_ve(this.id)">Unanswered ('+ve_unanswered+')</a></p>');

              parsed_obj = response.ve_search_list;
              

              $.each(parsed_obj, function( index, valuess ) {
                
               
    
    var subcontractor_name = '';
    var answer = '';
    var modified_by = '';  
    var modified_on = '';
    var msg = ''; 
    
    if((valuess.answer == '' && response.session == valuess.assign_to_ids) || (account_type == BUILDERADMIN && (valuess.created_by == response.created || response.session == valuess.assign_to_ids)) && valuess.answer == '')
    /*  
    if((valuess.answer == '' && response.session == valuess.assign_to_ids) || (account_type == BUILDERADMIN && valuess.answer == ''))*/
    {

     var answer = '<a href="javascript:void(0);" data-target="#addve" data-toggle="modal" class="editing" id="'+valuess.ub_bid_rfi_ve_id+'" onclick="update_ve(this.id)">&nbsp;<img border="0" src="'+response.img+'" alt="Edit" class="simple_edit"></a>';
    }
    else if(valuess.answer != ''){answer = valuess.answer; modified_by = valuess.modified_by; modified_on = valuess.rfi_ve_modified_on; var msg ='<p class="text-muted">- answered by '+modified_by+' on '+modified_on+'</p>';}

    if(valuess.created_by == response.created)
    {
     answer += '<a href="javascript:void(0);" class="delete"><img border="0" src="'+response.img+'" alt="Delete" class="delete_icon" id="'+valuess.ub_bid_rfi_ve_id+'" onclick="delete_ve(this.id)"></a>';
    }

    if(valuess.subcontractor_name != null){subcontractor_name = valuess.subcontractor_name;}
    else{subcontractor_name = 'Not Assigned to any one';}
    

                $(wrapper).append('<div class="info_bar"><div class="col-xs-12"><p><strong>Assigned To :</strong>'+subcontractor_name+'</p></div><div class="col-xs-12"><div class="alert alert-info col-xs-10" role="alert"><div class="col-xs-12 alert-info-text"><p><strong>Question:</strong>'+valuess.question+'</p><p class="text-muted pull-right">- asked by '+valuess.first_name+' on '+valuess.rfi_ve_created_on+'</p></div></div></div><div class="col-xs-12"><div class="alert alert-warning pull-right col-xs-10" role="alert"><div class="col-xs-12 alert-info-text text-right"><p><strong>Answer:</strong>'+answer+'</p>'+msg+'</div></div></div></div>'); 
                
            });
            
               
            }
            else
            {
              all_ve = response.all_ve;
    $.each(all_ve, function( index, values ) {
      all_ve = values.all_ve;
    });

    ve_created_by_me = response.ve_created_by_me;
    $.each(ve_created_by_me, function( index, values ) {
      ve_created_by_me = values.asked_by_me;
    });

    ve_asign_to_me = response.ve_asign_to_me;
    $.each(ve_asign_to_me, function( index, values ) {
      ve_asign_to_me = values.assigned_to_me;
    });

    ve_unanswered = response.ve_unanswered;
    $.each(ve_unanswered, function( index, values ) {
      ve_unanswered = values.answer;
    });
    var answer = all_ve - ve_unanswered;
              $(ve_search_counter).append('<p><a href="javascript:void(0);" id="all_ve" onclick="search_ve(this.id)">All ('+all_ve+')</a> | <a href="javascript:void(0);" id="ve_asked_by_me" onclick="search_ve(this.id)">Asked By Me ('+ve_created_by_me+')</a> | <a href="javascript:void(0);" id="ve_assigned_to_me" onclick="search_ve(this.id)">Assigned To Me ('+ve_asign_to_me+')</a> |<a href="javascript:void(0);" id="ve_answered" onclick="search_ve(this.id)"> Answered ('+answer+')</a> | <a href="javascript:void(0);" id="ve_unaswered" onclick="search_ve(this.id)">Unanswered ('+ve_unanswered+')</a></p>');

                $(wrapper).append('<div class="text-center"><p>No Record Found</p></div>');
            }
          }
    }); 
}
function scroll_div(){
	$('.scroll-pane-bids').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	});
}


function update_rfi_form(){	
  $('#rfi_save').find('[name="assign_to_ids"]').selectpicker().change(function(e) {            
                $('#rfi_save').formValidation('revalidateField', 'assign_to_ids');
            }).end().formValidation({
	//var updaterfiform = $('#rfi_save').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save-rfi'			
        },
        fields: {            
			'question': {
                validators: {
                    notEmpty: {
                        message: 'The Question is required and cannot be empty'
                    },
					stringLength: {
                        max: 4000,
                        message: 'The Question must be less than 4000 characters'
                    }
                }
            },
            'assign_to_ids': {
                validators: {
                    notEmpty: {
                        message: 'The assigned to cannot be empty'
                    }
                }
            },
            'deadline': {
                validators: {
          notEmpty: {
             message: 'The date is required'
          },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is required'
                    }
                }
            },
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			add_rfi();
			scroll_div();						
			e.preventDefault();			 
	  });	
    $('#datetimepicker6').on('dp.change dp.show', function(e) {   
        $('#rfi_save').formValidation('revalidateField', 'deadline');
    });
  $(document).on('click','.glyphicon.glyphicon-remove', function(e) {   
        $('#rfi_save').formValidation('revalidateField', 'deadline');
    });	 
}
function update_ve_form(){	
  $('#ve_save').find('[name="ve_assign_to_ids"]').selectpicker().change(function(e) {            
                $('#ve_save').formValidation('revalidateField', 've_assign_to_ids');
            }).end().formValidation({
	//var updateveform = $('#ve_save').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save-ve'			
        },
        fields: {            
			've_question': {
                validators: {
                    notEmpty: {
                        message: 'The Question is required and cannot be empty'
                    },
					stringLength: {
                        max: 4000,
                        message: 'The Question must be less than 4000 characters'
                    }
                }
            },
            've_assign_to_ids': {
                validators: {
                    notEmpty: {
                        message: 'The assigned to cannot be empty'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			add_ve();
			scroll_div();						
			e.preventDefault();			 
	  });		 
}
function delete_rfi_ve(ub_bid_rfi_ve_id){
    //alert(ub_bid_rfi_ve_id);
    if(ub_bid_rfi_ve_id > 0)
    {
    var encoded_delete_roles = Base64.encode('bids/delete_rfi_ve/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    //alert(ub_bid_rfi_ve_id);
    /*var conf = $('#confirmModal').modal('show');
  $('#delete_confirm').click(function(){
    var conf = true;
    if(conf == true){
      $('#confirmModal').modal('hide');*/
    $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: "ub_bid_rfi_ve_id="+ub_bid_rfi_ve_id,
            success: function(response) {   
                if(response.status == true)
                {   
                    $(".error-message .alerts").removeClass('alert-danger');
                    $(".error-message .alerts").addClass('alert-success');
                    //$(".error-message").show();
                    if(response.message)
                    {
                        success_msg = response.message;
                        //window.location.href = index_url; 
                        search_rfi('all_rfi');                          
                    }
                    //$(".alerts").html(success_msg);
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
      /*}
  }); */
    
    }
    else
    {               
        $(".error-message .alerts").addClass('alert-danger');
        $(".error-message .alerts").removeClass('alert-success');
        $(".error-message").show();
        $(".alerts").html("Rfi Ve id is not set");      
    }
}
function delete_ve(ub_bid_rfi_ve_id){
    //alert(ub_bid_rfi_ve_id);
    if(ub_bid_rfi_ve_id > 0)
    {
    var encoded_delete_roles = Base64.encode('bids/delete_rfi_ve/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    //alert(ub_bid_rfi_ve_id);
    /*var conf = $('#confirmModal').modal('show');
  $('#delete_confirm').click(function(){
    var conf = true;
    if(conf == true){
      $('#confirmModal').modal('hide');*/
    $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: "ub_bid_rfi_ve_id="+ub_bid_rfi_ve_id,
            success: function(response) {   
                if(response.status == true)
                {   
                    $(".error-message .alerts").removeClass('alert-danger');
                    $(".error-message .alerts").addClass('alert-success');
                    //$(".error-message").show();
                    if(response.message)
                    {
                        success_msg = response.message;
                        //window.location.href = index_url; 
                        search_ve('all_ve');                          
                    }
                    //$(".alerts").html(success_msg);
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
      /*}
  }); */
    
    }
    else
    {               
        $(".error-message .alerts").addClass('alert-danger');
        $(".error-message .alerts").removeClass('alert-success');
        $(".error-message").show();
        $(".alerts").html("Rfi Ve id is not set");      
    }
}