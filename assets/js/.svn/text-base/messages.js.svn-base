imgLink = base_url + 'assets/images/'; 
$(function() {
  //update_result_form();
  add_comment_formval();
   $('.daterange').daterangepicker(null, function(start, end, label) {
		console.log(start.toISOString(), end.toISOString(), label);
   });
   $('.applyBtn').click(function(){
	  var start = $('input[name="daterangepicker_start"]').val();
	  var end = $('input[name="daterangepicker_end"]').val();
	  var start_end = start + ' - ' + end;
	  $('#daterange').val(start_end);
	  $('#daterange').parent().parent().removeClass('has-error');
	  $('#daterange').parent().parent().find('.help-block').css('display','none');
  });
  $('.cancelBtn').click(function(){
	   $('#daterange').val('');
  });
   $('.message_nav li a').click(function(){
		$('.message_nav li').removeClass('active');
		$(this).parent().addClass('active');
   }); 
   
$(document).on('click','#message_filter', function(e){
	$('#message_index').val('message_filter');
		message_inbox();
		e.preventDefault();   	 
}); 
	
$(document).on('click','#message_reset', function(){
	var mess_date = "";
	$("#daterange").val(mess_date);
	$(".mail-con-div").empty();
	message_inbox();
 // messaage_notification();	
});	
//$(document).on('click','#comments_reset', function(){alert('comments_reset');	});
//$(document).on('click','#notfication_reset', function(){alert('notfication_reset');	});
});
/* Message Final */
$(function(){	
	
	$(document).on('ifChecked', '#sorting_mail', function(event) {
		$('.table-mailbox tbody tr td.small-col').find('input').attr('checked',true);
		$('.table-mailbox tbody tr td.small-col').find('.icheckbox_square-red').addClass('checked');
	});
	$(document).on('ifUnchecked', '#sorting_mail', function(event) {
		$('.table-mailbox tbody tr td.small-col').find('input').attr('checked',false);
		$('.table-mailbox tbody tr td.small-col').find('.icheckbox_square-red').removeClass('checked');
	});
	$(document).on('click', '#all_sorting', function(event) {
		$('.table-mailbox tbody tr td.small-col').find('input').attr('checked',true);
		$('.table-mailbox tbody tr td.small-col').find('.icheckbox_square-red').addClass('checked');		
		$('#sorting_mail').attr('checked',true);
		$('#sorting_mail').parent('.icheckbox_square-red').addClass('checked');
	});
	$(document).on('click', '#all_none', function(event) {
		$('.table-mailbox tbody tr td.small-col').find('input').attr('checked',false);
		$('.table-mailbox tbody tr td.small-col').find('.icheckbox_square-red').removeClass('checked');		
		$('#sorting_mail').attr('checked',false);
		$('#sorting_mail').parent('.icheckbox_square-red').removeClass('checked');
	});
	$(document).on('click', '#all_read, #delete', function(event) {
		var message_action = $(this).attr('id');
		$("#message_action").val(message_action);
		var conf = $('#confirmModal').modal('show');
			$('#delete_confirm').click(function(){
			var conf = true;
			if(conf == true)
			{
				$('#confirmModal').modal('hide');
				message_inbox();
			}
		});
		
	});
	$(document).on('ifChecked', '#toemailinput', function(event) { 
		$('.alt-email-to').show();
	});	
	$(document).on('ifChecked', '#ccemailinput', function(event) { 
		$('.alt-email-cc').show();
	});	
	$(document).on('ifChecked', '#bccemailinput', function(event) { 
		$('.alt-email-bcc').show();
	});

	
	$(document).on('ifUnchecked', '#toemailinput', function(event) {
		$('.alt-email-to').hide();
	});	
	$(document).on('ifUnchecked', '#ccemailinput', function(event) {
		$('.alt-email-cc').hide();
	});	
	$(document).on('ifUnchecked', '#bccemailinput', function(event) {
		$('.alt-email-bcc').hide();
	});
	
	message_inbox();
	$("body").on("click", ".message_inbox,.message_drafts,.message_sent,.message_junk", function(event){ 
		var folder_id = $(this).attr('id');
		$("#current_folder_id").val(folder_id);
		$(".mail-con-div").empty();
		message_inbox();		
	});
	
	$("body").on("click", ".paginate", function(event){ 
		var page_id = $(this).attr('id');
		// alert(page_id);
		$("#current_page_id").val(page_id);
		$(".mail-con-div").empty();
		message_inbox();		
	});

	// $('.compose_mailer').click(function(){
	$(document).on('click', '.compose_mailer', function() {	
		var ub_message_id = 0;
		$("#ub_message_id").val(ub_message_id);
		var compose_id = $(this).attr('id');
		// alert(compose_id);
		$("#compose_id").val(compose_id);			
		compose_message();	
		// $(".mail-con-div").empty();		
		// $(".mail-con-div").load(base_url+'bWVzc2FnZXMvY29tcgxf19zZV9tYWlsZXIv');		
		// setTimeout(ck_editor, 1 * 200);
		// setTimeout(select_picker, 1 * 200);
		// setTimeout(checkbox, 1 * 200);
		// setTimeout(email_tagging, 1 * 200);
		
	});
	$(document).on('click', '#message_inbox tbody tr.row', function() {
		var id_values = $(this).attr('id');
		// alert(id_values);
		id_values = id_values.split('-');
		var ub_message_id = id_values[0];
		var msg_is_read = id_values[1];
		$("#ub_message_id").val(ub_message_id);
		$("#msg_is_read").val(msg_is_read);
		send_message();
	});
	
	$(document).on('click', '#reply', function() {
		$('.mail-thread .action-btn').hide();
		$("#cc_ids option:selected").removeAttr("selected");
		$('#cc_ids').selectpicker('refresh');
		$("#bcc_ids option:selected").removeAttr("selected");
		$('#bcc_ids').selectpicker('refresh');
		$('.compose_mail_con').show();
		checkbox();		
		setTimeout(select_picker, 1 * 200);		
		setTimeout(ck_editor, 1 * 200);
		setTimeout(email_tagging, 1 * 200);		
		$('html,body').animate({ scrollTop: 350 }, 'slow', function () {});	
	});	
	
	$(document).on('click', '#reply_all', function() {
	$('.mail-thread .action-btn').hide();
		$('.compose_mail_con').show();
		checkbox();		
		setTimeout(select_picker, 1 * 200);
		setTimeout(reply_all_function, 1 * 200);
		setTimeout(ck_editor, 1 * 200);
		setTimeout(email_tagging, 1 * 200);		
		$('html,body').animate({ scrollTop: 350 }, 'slow', function () {});	
	});	
	function reply_all_function(){		
		$('#toemailinput').attr('checked', true);
		$('#toemailinput').parent().addClass('checked');
		
		$('#ccemailinput').attr('checked', true);
		$('#ccemailinput').parent().addClass('checked');
		
		$('#bccemailinput').attr('checked', true);
		$('#bccemailinput').parent().addClass('checked');
		$('.alt-email-to, .alt-email-cc, .alt-email-bcc').show();
	}
	$(document).on('click', '#forward', function() {
		$('.mail-thread .action-btn').hide();
		$("#to_ids option:selected").removeAttr("selected");
		$('#to_ids').selectpicker('refresh');
		$("#cc_ids option:selected").removeAttr("selected");
		$('#cc_ids').selectpicker('refresh');
		$("#bcc_ids option:selected").removeAttr("selected");
		$('#bcc_ids').selectpicker('refresh');
		$('.compose_mail_con').show();
		checkbox();		
		setTimeout(select_picker, 1 * 200);
		setTimeout(ck_editor, 1 * 200);
		setTimeout(email_tagging, 1 * 200);		
		$('html,body').animate({ scrollTop: 350 }, 'slow', function () {});	
	});
	
	$(document).on('click', '.mail_revert_back a', function() {
		// alert('revert back');
		var ub_message_id = 0;
		var compose_id = 0;
		$("#ub_message_id").val(ub_message_id);
		$("#compose_id").val(compose_id);
		//below lines will reset the form field vales
		$('#to_ids').val(0);
		$('#cc_ids').val(0);
		$('#bcc_ids').val(0);
		//end of resetting form field values
		$('.compose_mail_con, .mail-thread, .mail_revert_back').hide();		
		$('#message_inbox, #message_sent, #message_junk, .sorting_mail, .mail-pagination').show();	
		message_inbox();
	});
	
	$(document).on('click', '#mail_send', function() {
		//Below forloop added to fix the ajax post ckeditor value issue
		var to_id = $('#to_ids').val();	
		if(to_id == '' || to_id == null ){
			// alert('Select user');
			$("#alertModal").modal('show');
			$(".alert_modal_txt").text("Select user");
			return false;			
		}
		else{
			for ( instance in CKEDITOR.instances )
			{
				CKEDITOR.instances[instance].updateElement();
			}
			//End of code
			var ub_message_id = 0;
			var compose_id = 0;
			$("#ub_message_id").val(ub_message_id);
			$("#compose_id").val(compose_id);
			$('.compose_mail_con, .mail-thread, .mail_revert_back').hide();		
			$('#message_inbox, #message_sent, #message_junk, .sorting_mail, .mail-pagination').show();	
			message_inbox();
		}
	});	
	
	$(document).on('click', '#mail_cancel', function() {
		// alert('mail_cancel');
		var ub_message_id = 0;
		var compose_id = 0;
		$("#ub_message_id").val(ub_message_id);
		$("#compose_id").val(compose_id);
		//below lines will reset the form field vales
		$('#to_ids').val(0);
		$('#cc_ids').val(0);
		$('#bcc_ids').val(0);
		//end of resetting form field values
		$('.compose_mail_con, .mail-thread, .mail_revert_back').hide();		
		$('#message_inbox, #message_sent, #message_junk, .sorting_mail, .mail-pagination').show();	
		message_inbox();
	});
	
	/* Drafts */
	$(document).on('click', '#message_drafts tbody tr.row', function() {		
		$(this).addClass('read');
		$('.mail-pagination').hide();		
		$('.compose_mail_con').show();
		setTimeout(select_picker, 1 * 200);
		setTimeout(ck_editor, 1 * 200);	
		setTimeout(email_tagging, 1 * 200);				
		$(this).parent().parent().hide();
	});	
	/* /Drafts */
	/* Sent Mail */
	$(document).on('click', '#message_sent tbody tr.row', function() {
		$(this).addClass('read');
		$('.sorting_mail, .mail-pagination').hide();
		$('.mail_revert_back, .mail-thread').show();
		$(this).parent().parent().hide();
	});
	/* /Sent Mail */
	/* Junk */
	$(document).on('click', '#message_junk tbody tr.row', function() {
		$(this).addClass('read');
		$('.sorting_mail, .mail-pagination').hide();
		$('.mail_revert_back, .mail-thread').show();
		$(this).parent().parent().hide();
	});
	/* /Junk */
});
function email_tagging(){
	$('#alt-email-to').tagsinput({	allowDuplicates: false	});
	$('#alt-email-cc').tagsinput({	allowDuplicates: false	});
	$('#alt-email-bcc').tagsinput({	allowDuplicates: false	});
}
function select_picker(){
	$(".selectpicker").selectpicker('refresh');
}
function right_side_bar(){
	$(".mail-thread-con").mCustomScrollbar({
		   setHeight:250,
		   theme:"dark-3"
		});
}
function ck_editor(){
	//CKEDITOR.replace( 'editor');
	CKEDITOR.replace( 'editor', {
	toolbar : [
		[ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat', 'Image']
	]
	});	
}

function message_inbox(){
	// we are clearing the hidden values when user directly clicks inbox/directory link from send_message page
	var ub_message_id = 0;
	var compose_id = 0;
	$("#ub_message_id").val(ub_message_id);
	$("#compose_id").val(compose_id);
	// End of clearing hidden fields
	var encoded_url = Base64.encode('messages/get_messages/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var ajaxData  = $("#ub_messages").serialize();
	$.ajax({
		url: base_url + ajax_encoded_url,
		type: 'POST',
		data: ajaxData,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			 
        },
		success: function (response) {
			 $('.uni_wrapper').removeClass('loadingDiv');
			$('.message_display').html(response);
			setTimeout(checkbox, 1 * 600);
		}
	});
}

function send_message(){
	var encoded_url = Base64.encode('messages/get_messages/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var ajaxData  = $("#ub_messages").serialize();
	$.ajax({
		url: base_url + ajax_encoded_url,
		type: 'POST',
		data: ajaxData,		
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			 
        },
		success: function (response) {
			setTimeout(removeloader, 2000);
			$('.message_display').html(response);
			$(this).addClass('read');
			$('.sorting_mail, .mail-pagination').hide();
			$('.mail_revert_back, .mail-thread').show();
			$(this).parent().parent().hide();
		}
	});
}

function compose_message(){ 
	var encoded_url = Base64.encode('messages/get_messages/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var ajaxData  = $("#ub_messages").serialize();
	$.ajax({
		url: base_url + ajax_encoded_url,
		type: 'POST',
		data: ajaxData,	
		beforeSend: function() {
			$('.uni_wrapper').addClass('loadingDiv');
		},			
		success: function (response) {
			setTimeout(removeloader, 2000);
			// $.when(file_upload(response.insert_id)).done(function()
			// {
				$('.message_display').html(response);
				$(this).addClass('read');
				$('.sorting_mail, .mail-pagination').hide();
				$('.mail_revert_back, .compose_mail_con').show();
				setTimeout(checkbox, 1 * 600);
				setTimeout(select_picker, 1 * 200);
				setTimeout(ck_editor, 1 * 200);	
				setTimeout(email_tagging, 1 * 200);
				$(this).parent().parent().hide();
			// }
		}
	});
}

/* Scroll */
$(function () {	
	$(window).load(function(){
		$("#docs_upload_Modal .modal-con, .bid_attach_con").mCustomScrollbar({
			setHeight:250,
			theme:"dark-3"
		});
				
	});

});
/* /Scroll */
/* Message */
$(function(){
	$('.messages, .mess_act').show();
	$('.comments_filt, .notify_filt, .mess_act_none').hide();
	
	$('a[href="#messages"]').click(function(){	
		$('.date_range_filt, .mess_act, .mes-filt, .date_filt').show();
		$('#comments_reset').attr('id','message_reset');	
		$('#notfication_reset').attr('id','message_reset');
		$('#comments_filter').attr('id','message_filter');
		$('#notification_filter').attr('id','message_filter');
		$('.comments_filt, .notify_filt, .mess_act_none').hide();
	});
	$('a[href="#comments"]').click(function(){		
		$('#message_reset').attr('id','comments_reset');	
		$('#notfication_reset').attr('id','comments_reset');
		$('#message_filter').attr('id','comments_filter');
		$('#notification_filter').attr('id','comments_filter');
		$('.comments_filt,.mess_act, .mess_act_none').show();
		$('.date_range_filt, .notify_filt, .mes-filt, .date_filt').hide();
		$('#notification_save_filter').attr('id','save_filter');
		$('#notification_apply_save_filter').attr('id','apply_save_filter');
	});
	$('a[href="#notfication"]').click(function(){
		$('#message_reset').attr('id','notfication_reset');	
		$('#comments_reset').attr('id','notfication_reset');	
		$('#message_filter').attr('id','notification_filter');
		$('#comments_filter').attr('id','notification_filter');
		$('.date_range_filt, .notify_filt, .mess_act, .mess_act_none, .date_filt').show();
		$('.comments_filt, .mess_act_none, .mes-filt').hide();
		$('#save_filter').attr('id','notification_save_filter');
		$('#apply_save_filter').attr('id','notification_apply_save_filter');
	});
});

//on page load 
// Code added by satheesh Kumar 
$(function() {    
var message_url = window.location.href;
	var message_hash = message_url.substring(message_url.indexOf("#"));
		if (message_hash == "#messages")
		{
			$('.date_range_filt, .mess_act, .mes-filt, .date_filt').show();
			$('#comments_reset').attr('id','message_reset');	
			$('#notfication_reset').attr('id','message_reset');
			$('#comments_filter').attr('id','message_filter');
			$('#notification_filter').attr('id','message_filter');
			$('.comments_filt, .notify_filt, .mess_act_none').hide();
		}
		if (message_hash == "#comments")
		{
			$('#message_reset').attr('id','comments_reset');	
			$('#notfication_reset').attr('id','comments_reset');
			$('#message_filter').attr('id','comments_filter');
			$('#notification_filter').attr('id','comments_filter');
			$('.comments_filt,.mess_act, .mess_act_none').show();
			$('.date_range_filt, .notify_filt, .mes-filt, .date_filt').hide();
			$('#notification_save_filter').attr('id','save_filter');
			$('#notification_apply_save_filter').attr('id','apply_save_filter');
		}
		if (message_hash == "#notfication")
		{
			$('#message_reset').attr('id','notfication_reset');	
			$('#comments_reset').attr('id','notfication_reset');	
			$('#message_filter').attr('id','notification_filter');
			$('#comments_filter').attr('id','notification_filter');
			$('.date_range_filt, .notify_filt, .mess_act, .mess_act_none, .date_filt').show();
			$('.comments_filt, .mess_act_none, .mes-filt').hide();
			$('#save_filter').attr('id','notification_save_filter');
			$('#apply_save_filter').attr('id','notification_apply_save_filter');
		}
}); 


$(function() {        
	messagenotfication();
});

function messagenotfication() {
	$('#Message_Notfication').dataTable({
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5,            
		sAjaxSource: base_url + 'assets/js/json_message_notfication.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [-1] // <-- gets last column and turns off sorting
		}]

	});
}

/*New code by sidhartha*/
$(function() {
	if (typeof list_page != 'undefined') {
		//comments_list_view();
	}
	$(document).on( 'shown.bs.tab', 'a[href="#comments"]', function () {
		comments_list_view();		
	});
});
	// Export result set to file
	$(document).on('click','#comments_filter', function(e){
		$('#message_index').val('comments_filter');
		comments_list_view();
		e.preventDefault();	
	});
	  function comments_list_view() {

       var module_name = $('#module_names').val();
 
      
       //alert(module_name);
		// Ajax URL
		var encoded_url = Base64.encode('messages/get_comment/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		
		var dbobject = {					
							'tableName': $('#comments_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'created_on',
							'name': "created_on",
							'this_table' : {'table_name':'comments_list'},
							'post_data':'{"module_name":"'+module_name+'"}',
							'delete_data':{}, 
							'edit_data':{},
							'owner':'comments',
							'owner_coloumn':{'index':1},
							'builder':'comments',
							'builder_coloumn':{'index':2},
							'sub':'comments',
							'first_name':'first_name',
							'sub_coloumn':{'index':3},
							'display_columns' : [{"data": "created_on", "bSortable": false},{"data": "created_on", "bSortable": false},{"data": "created_on", "bSortable": false},{"data": "created_on", "bSortable": false},],
							'default_order_by': [[0, 'desc']]
						};

		// Populate data table
		ubdatatable(dbobject);
		
	}

function reply(id)
{
	var id = id;
	var fields = id.split(/,/);
    var module_name = fields[0];
    var module_pk_id = fields[1];
    var project_id = fields[2];
    $('#module_name').val(module_name);
    $('#module_pk_id').val(module_pk_id);
    $('#project_name').val(project_id);
    /*alert(id);
	alert(module_name);
	alert(module_pk_id);*/
}
$(function(){

	// $('#post_comment').click(function(e) {
        // add_comment();
        // e.preventDefault();      
    // });

});
/*
Add Comment
*/
function add_comment()
{

    var encoded_string = Base64.encode('messages/save_comment/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#posting_comments").serialize();
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
		beforeSend: function() {
		  $('.uni_wrapper').addClass('loadingDiv');
        },
        success: function(response) {           
            $("#commentModal").modal('hide');
            comments_list_view();
            send_notify();
				$('.uni_wrapper').removeClass('loadingDiv');
			}
        });
}
function send_notify()
 {
   

    var ajaxData  = $("#posting_comments").serialize();
    var encoded_string = Base64.encode('messages/send_notify/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {

        }
        });
    $("#comments_txt").val('');
    $('#owner').closest('.icheckbox_square-red').removeClass('checked');        
    $('#owner').removeAttr("checked", "checked");
    $('#sub').closest('.icheckbox_square-red').removeClass('checked');        
    $('#sub').removeAttr("checked", "checked");
    $('#owner-child').closest('.icheckbox_square-red').removeClass('checked');        
    $('#owner-child').removeAttr("checked", "checked");
    $('#sub-child').closest('.icheckbox_square-red').removeClass('checked');        
    $('#sub-child').removeAttr("checked", "checked");
 }
 $(document).on('click','#message_reset', function(){

	var encoded_destroy_session = Base64.encode('messages/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('messages/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);

	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"messages","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = role_index_url;
				success_box();
				$('.error-message .alerts').text('Reset Successfully');	
			}
		}
	});	
});
 
// Save Filter
$(document).on('click','#save_filter', function(){
	var module_names = $('#module_names').val();

	if((!module_names))
	{
		//alert('Please select atleast one search field to save!');
		//$('#alertModal').modal('show');
        //$('.alert_modal_txt').text('Please select atleast one search field to save!');
		error_box();
		$('.error-message .alerts').text('Please select atleast one search field to save!');
		return false;
	}
	var encoded_url = Base64.encode('messages/apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'module_names='+module_names;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,			
		success: function(response) {		
			if(response.status == true)
			{	
				//alert(response.message);
				//$('#alertModal').modal('show');
                //$('.alert_modal_txt').text(response.message);
				success_box();
				$('.error-message .alerts').text('Saved Successfully');
				$("#apply_save_filter").show();
			}
		}
	});	
});
//Apply Filter
$(document).on('click','#apply_save_filter', function(){
		var encoded_url = Base64.encode('messages/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('messages/index/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",		
		success: function(response) {		
			if(response.status == true)
			{	
				 //window.location.href= base_url + ajax_encoded_urls;
				 success_box();
				 $('.error-message .alerts').text('Applied filter successfully');	
				 $tab_href = $('.tab-con li.active a').attr('href');
                 window.location.href = base_url + ajax_encoded_urls+$tab_href;
                 location.reload(true);
			}
			else
			{
				//alert('No Record Found');
				//$('#alertModal').modal('show');
                //$('.alert_modal_txt').text('No Record Found');
				error_box();
		        $('.error-message .alerts').text('No Record Found');
			}
		}
	});	
		//$.post(baseurl+ajax_encoded_url,'POST',function(res) {
			
		});


 $(document).on('click','#comments_reset', function(){

	var encoded_destroy_session = Base64.encode('messages/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('messages/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);

	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"messages","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = role_index_url;
				success_box();
				$('.error-message .alerts').text('Reset Successfully');	
			}
		}
	});	
});

$(function() {		
		if (typeof list_page != 'undefined') 
		{
		 //messaage_notification();
		}
		$(document).on( 'shown.bs.tab', 'a[href="#notfication"]', function () {
			messaage_notification();		
		});
		
});


	$('#update_result').click(function(e){
	     e.preventDefault();
	    messaage_notification();
		 
	});


$(document).on('click','#notification_filter', function(e){
	$('#message_index').val('notification_filter');
	messaage_notification();
	e.preventDefault();	
	 
});

	
function messaage_notification() {
       
	    var primary_email = $('#primary_email').val();
	    var type = $('#type').val();
	    var daterange = $('#daterange').val();
		var encoded_url = Base64.encode('messages/get_notification/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		// Data table Object
		//alert(ajax_encoded_url);
		
		var dbobject = {					
							'tableName': $('#Notfication_List'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'type',
							'name' : 'type',
							'this_table' : {'table_name':'Notfication_List'},
							'post_data':'{"primary_email":"'+primary_email+'","daterange":"'+daterange+'","type":"'+type+'"}',
							'delete_data':{}, 
							'edit_data':{},
							'display_columns' : [
							{"data": "primary_email"},{"data": "type"},{"data": "subject"},
							{"data": "project_name"},{"data": "modified_on"}],
							// 'default_order_by': [[1, 'desc']]
						};
//alert(dbobject.display_columns.toSource());
	//console.log(dbobject);
		// Populate data table
		ubdatatable(dbobject);
		/*$('#schedule_list').on( 'click', 'a.editor_remove', function (e) {
		  var schedule_id = $(this).attr('id');
		  delete_role({'ub_schedule_id':{ub_schedule_id:ub_schedule_id}});
		});*/

	}
	
//notfication search reset
 $(document).on('click','#notfication_reset', function(){
	var encoded_destroy_session = Base64.encode('messages/notification_destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var projects_index = Base64.encode('messages/index/');
	var projects_index_url = projects_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"messages","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = projects_index_url;
				success_box();
				$('.error-message .alerts').text('Reset Successfully');	
			}
		}
	});	
});


/* 	//mom search reset
$('#message_reset').on('click', function(e) {
		$("#messages_index").val('message_reset');		
		reset_function();			
		e.preventDefault();
});
	
	function reset_function(){
	var encoded_destroy_session = Base64.encode('messages/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	var project_index = Base64.encode('messages/index/');
	var project_index_url = project_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"MESSAGES","destroy_type":["SEARCH"]},			
		success: function(response) {		
			if(response.status == true)
			{	
				window.location.href = message_index_url;
			}
		}
	});	
} */
	
	
function update_result_form(){	
	var updateresultform = $('#ub_messages').find('[name="to_ids[]"]').selectpicker().change(function(e) {            
                $('#ub_messages').formValidation('revalidateField', 'to_ids[]');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#message_filter, #comments_filter, #notification_filter'			
        },
        fields: {
            'daterange': {
                validators: {
                    notEmpty: {
                        message: 'Please select the Date'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {
		if($("#message_index").val() == 'message_filter'){
			message_inbox();				
		 }
		else if($("#message_index").val() == 'comments_filter'){
			comments_list_view();				
		}
		else if($("#message_index").val() == 'notification_filter'){
			messaage_notification();				
		}		
		e.preventDefault();			 
	  }); 

}	


function add_comment_formval(){
		var commentform = $('#posting_comments').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		 button: {
            selector: '#post_comment',          
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
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
      }).on('success.field.fv', function(e, data) {
            if (data.fv.getSubmitButton()) {
                data.fv.disableSubmitButtons(false);
            }
      }).on('success.form.fv', function(e) {	
			add_comment();
			e.preventDefault();
	  });

}

//Below code is for file upload
/* $(function () {       
    var temp_id = $("#temp_directory_id").val(); 
	// alert(123); return false;
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('messages/upload/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#ub_messages').fileupload({
        add: function(e, data) {
                var uploadErrors = [];
                var acceptFileTypes = /(\.|\/)(gif|jpe?g|png|pdf)$/i;
                if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                    uploadErrors.push('Not an accepted file type');
                }
                if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 5000000) {
                    uploadErrors.push('Filesize is too big');
                }
                if(uploadErrors.length > 0) {
                    alert(uploadErrors.join("\n"));
                } else {
                    data.submit();
                }
        },
        url: encoded_val,
        dataType: 'json',
        autoUpload: false,
        // acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        // maxFileSize: 5000000,
        success: function (data) {			
			setTimeout(checkbox, 1*200);			
			//alert(JSON.stringify(response));
			$("#temp_directory_id").val(data.files[0]['temp_dir_id']);
		}
    });
	// Load existing files:
	$.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: $('#ub_messages').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#ub_messages')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
}); */

$(function(){
	var encoded_string = Base64.encode('messages/get_doc_hierarchy/');
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
});

$(function() {
    $(window).load(function() {
        $("#docs_upload_Modal .modal-con").mCustomScrollbar({
            setHeight: 250,
            theme: "dark-3"
        });

    });

});

function file_upload(insert_id)
{
	var temp_directory_id = $("#temp_directory_id").val();
	var folderid = $("#folder_id").val();
	var moduleid = insert_id;
	var encoded_string = Base64.encode('messages/get_temp_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var response = $.ajax({
		url: base_url + encoded_val,
		//dataType: "json",
		type: "post",
		data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid + '&moduleid='+moduleid,			
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },	
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
	var encoded_string = Base64.encode('messages/copy_file_to_temp/');
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
		url: $('#ub_messages').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#ub_messages')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$("#ub_messages").find(".files").empty();
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
}
/* Below function added for increasing the loader time to 2 seconds

	added by chandru
	Guided by MS	*/
function removeloader()
{
	$('.uni_wrapper').removeClass('loadingDiv');
}
//End of file upload code