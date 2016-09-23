imgLink = base_url + 'assets/images/'; 
$(function(){	
	var pathname = window.location.pathname; // Returns path only
	var url      = window.location.href; // Returns full URL
	var textAfterHash = url.substring(url.indexOf('#') + 1);
	//alert(pathname); 
	//alert(url);
	//alert(textAfterHash);
	$('#desk_phone').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	$('#mobile_phone').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	$('#estimated_revenue_min').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#estimated_revenue_max').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	add_new_lead_form();
	var encoded_string = Base64.encode('lead/get_doc_hierarchy/');
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
	$('.file_uploaded_div').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
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
/* UI CODE */
$(function(){
	/* Tag Input Mail */
   	$('#alt_email').tagsinput({ allowDuplicates: false });
   //$('#alt_email_to').tagsinput({ allowDuplicates: false });
   //$('#alt_email_cc').tagsinput({ allowDuplicates: false });
    $('#alt_email_bcc').tagsinput({	allowDuplicates: false});
	/* /Tag Input Mail */
	
	/* Activity Tab */
	$('.lead_unchecked_marked').hide();	
	$('.lead_unchecked_marked').click(function(){		
		$(this).hide();
		$('.lead_checked_marked').show();
		$('#lead_marked-list').attr("checked", true);		
		$('#datetimepicker10').find('input').attr("disabled", false);
		$('#schedule-time').find('input').attr("disabled", false);							
		$('#reminder_id').attr("disabled", false);	
		$('#lead_marked-list').val('Yes');
		$('#reminder_id').parent().find('.bootstrap-select .selectpicker').removeClass('disabled');		
	});
	$('.lead_checked_marked').click(function(){
		$(this).hide();
		$('.lead_unchecked_marked').show();
		$('#lead_marked-list').attr("checked", false);
		$('#datetimepicker10').find('input').attr("disabled", true);
		$('#schedule-time').find('input').attr("disabled", true);
		$('#lead_marked-list').val('No');
		//$('#reminder_id').attr("disabled", true);		
		$('.selectpicker').selectpicker('refresh');		
		//$('#reminder_id').parent().find('.bootstrap-select').addClass('disabled');		
	});
	$('.lead_activity_table').show();
	//$('#log-complete-activity').find('button').addClass('btn-blue');
	$('.log_complete').hide();		
	/* Log Completed Activity */
	
	var cur_date_val = cur_date.split('-');
	var cur_date_value = cur_date_val[1]+'/'+cur_date_val[2]+'/'+cur_date_val[0];
	$(document).on('click', '#log-complete-activity', function() {
	//alert(123123);return false;				
		$(this).attr('id','log-complete-activity-new');
		$(this).find('button').addClass('btn-blue');
		$('#schedule_activity_new').find('button').removeClass('btn-blue');
		$('#schedule_activity_new').find('button').removeClass('btn-blue');
		$('#schedule_activity_new').attr('id','schedule_activity');
		$('#datetimepicker12').hide();
		$('#datetimepicker11').show();
		// $('#activity_date_1').attr('id','activity_date');
		$('.log_complete').show();
		$('.lead_activity_table').hide();
		$('.lead_unchecked_marked').hide();
		$('.lead_checked_marked').show();
		$('#datetimepicker10').find('input').attr("disabled", false);
		$('#schedule-time').find('input').attr("disabled", false);
		/* Act Tab */
		$('.act-general, .act-mail').removeClass('active');
		$('.act-general').addClass('active');
		$('.tab-content #general, .tab-content #sendmail').removeClass('active');
		$('.tab-content #general').addClass('active');
		/* /Act Tab */
		/* Radio Act Remove */
		$('.iradio_square-red').removeClass('checked');
		$('#compose').removeAttr('checked');
		$('#not_mail').removeAttr('checked');
		/* /Radio Act Remove */
		$('.composedmail').hide();
		$('.mail-action-btn').css('visibility','hidden');
		$("#update_completed_activity .form-new-schedule input").val("");
		$("#update_completed_activity .form-new-schedule textarea").val("");
		$('#activity_date').val(cur_date_value);
		/*$(".selectpicker").selectpicker('val', '' );
		$('.selectpicker').selectpicker('refresh');*/
		$('#reminder_id').attr("disabled", false);
		$('#reminder_id').parent().find('.bootstrap-select .selectpicker').removeClass('disabled');
		$('#lead_marked-list').val('Yes');
		$('#module_pk_id').val('');	
	});
	$(document).on('click', '#log-complete-activity-new', function() {
		$(this).attr('id','log-complete-activity');	
		$(this).find('button').removeClass('btn-blue');
		$('#schedule_activity_new').find('button').removeClass('btn-blue');
		$('#schedule_activity_new').find('button').removeClass('btn-blue');		
		$('#schedule_activity_new').attr('id','schedule_activity');
		// $('#activity_date_1').attr('id','activity_date');
		$('#datetimepicker12').hide();
		$('#datetimepicker11').show();
		$('.log_complete').hide();
		$('.lead_activity_table').show();
		$('.lead_unchecked_marked').hide();
		$('.lead_checked_marked').show();
		$('#datetimepicker10').find('input').attr("disabled", false);
		$('#schedule-time').find('input').attr("disabled", false);
		/* Act Tab */
		$('.act-general, .act-mail').removeClass('active');
		$('.act-general').addClass('active');
		$('.tab-content #general, .tab-content #sendmail').removeClass('active');
		$('.tab-content #general').addClass('active');
		/* /Act Tab */
		/* Radio Act Remove */
		$('.iradio_square-red').removeClass('checked');
		$('#compose').removeAttr('checked');
		$('#not_mail').removeAttr('checked');
		/* /Radio Act Remove */
		$('.composedmail').hide();
		$('.mail-action-btn').css('visibility','hidden');
		$("#update_completed_activity .form-new-schedule input").val("");
		$('#activity_date').val(cur_date_value);
		/*$(".selectpicker").selectpicker('val', '' );
		$("#update_completed_activity .form-new-schedule textarea").val("");
		$('.selectpicker').selectpicker('refresh');*/
		$('#reminder_id').attr("disabled", false);
		$('#reminder_id').parent().find('.bootstrap-select .selectpicker').removeClass('disabled');
		$('#lead_marked-list').val('Yes');
		$('#module_pk_id').val('');	
	});
	/* /Log Completed Activity */
	
	/* schedule new activity */
	$(document).on('click', '#schedule_activity', function() {
		
		$(this).attr('id','schedule_activity_new');
		$(this).find('button').addClass('btn-blue');
		$('#log-complete-activity').find('button').removeClass('btn-blue');
		$('#log-complete-activity-new').find('button').removeClass('btn-blue');
		$('#log-complete-activity-new').attr('id','log-complete-activity');
		$('#datetimepicker11').hide();
		$('#datetimepicker12').show();
		//$('#activity_date_1').attr('id','activity_date');

		/*setTimeout(function(){*/
		$('.selectpicker').selectpicker('refresh');
        $("#lead_activity_type option[value='']").prop("selected", true);
        $('.selectpicker').selectpicker('refresh');

        $('.selectpicker').selectpicker('refresh');
        $("#lead_activity_sales_person option[value='']").prop("selected", true);
        $('.selectpicker').selectpicker('refresh');

        $('.selectpicker').selectpicker('refresh');
        $("#initiated_by option[value='']").prop("selected", true);
        $('.selectpicker').selectpicker('refresh');

        $('.selectpicker').selectpicker('refresh');
        $("#reminder_id option[value='']").prop("selected", true);
        $('.selectpicker').selectpicker('refresh');
        /*}, 500);*/
        
		$('.log_complete').show();
		$('.lead_activity_table').hide();
		$('.lead_unchecked_marked').show();
		$('.lead_checked_marked').hide();
		$('#datetimepicker10').find('input').attr("disabled", true);
		$('#schedule-time').find('input').attr("disabled", true);
		//$('#reminder_id').attr("disabled", true);
		/* Act Tab */
		$('.act-general, .act-mail').removeClass('active');
		$('.act-general').addClass('active');
		$('.tab-content #general, .tab-content #sendmail').removeClass('active');
		$('.tab-content #general').addClass('active');
		/* /Act Tab */
		/* Radio Act Remove */
		$('.iradio_square-red').removeClass('checked');
		$('#compose').removeAttr('checked');
		$('#not_mail').removeAttr('checked');
		/* /Radio Act Remove */
		$('.composedmail').hide();
		$('.mail-action-btn').css('visibility','hidden');
		//$('#lead_activity_id').val('');
		$("#update_completed_activity .form-new-schedule input").val("");
		$("#update_completed_activity .form-new-schedule textarea").val("");
		$('#activity_date_1').val(cur_date_value);
		/*$(".selectpicker").selectpicker('val', '' );
		$('.selectpicker').selectpicker('refresh');*/
		$('#lead_marked-list').val('No');
		$('#module_pk_id').val('');
	});
	$(document).on('click', '#schedule_activity_new', function() {


		$(this).attr('id','schedule_activity');	
		$(this).find('button').removeClass('btn-blue');		
		$('#log-complete-activity').find('button').removeClass('btn-blue');
		$('#log-complete-activity-new').find('button').removeClass('btn-blue');
		$('#log-complete-activity-new').attr('id','log-complete-activity');
		$('#datetimepicker11').hide();
		$('#datetimepicker12').show();

		setTimeout(function(){
		$('.selectpicker').selectpicker('refresh');
        $("#lead_activity_type option[value='']").prop("selected", true);
        $('.selectpicker').selectpicker('refresh');

        $('.selectpicker').selectpicker('refresh');
        $("#lead_activity_sales_person option[value='']").prop("selected", true);
        $('.selectpicker').selectpicker('refresh');

        $('.selectpicker').selectpicker('refresh');
        $("#initiated_by option[value='']").prop("selected", true);
        $('.selectpicker').selectpicker('refresh');

        $('.selectpicker').selectpicker('refresh');
        $("#reminder_id option[value='']").prop("selected", true);
        $('.selectpicker').selectpicker('refresh');
        }, 500);

		//$('#activity_date_1').attr('id','activity_date');
		$('.log_complete').hide();
		$('.lead_activity_table').show();
		$('.lead_unchecked_marked').show();
		$('.lead_checked_marked').hide();
		$('#datetimepicker10').find('input').attr("disabled", true);
		$('#schedule-time').find('input').attr("disabled", true);
		/* Act Tab */
		$('.act-general, .act-mail').removeClass('active');
		$('.act-general').addClass('active');
		$('.tab-content #general, .tab-content #sendmail').removeClass('active');
		$('.tab-content #general').addClass('active');
		/* /Act Tab */
		/* Radio Act Remove */
		$('.iradio_square-red').removeClass('checked');
		$('#compose').removeAttr('checked');
		$('#not_mail').removeAttr('checked');
		/* /Radio Act Remove */
		$('.composedmail').hide();
		$('.mail-action-btn').css('visibility','hidden');
		$("#update_completed_activity .form-new-schedule input").val("");
		$("#update_completed_activity .form-new-schedule textarea").val("");
		$('#activity_date_1').val(cur_date_value);
		/*$(".selectpicker").selectpicker('val', '' );
		$('.selectpicker').selectpicker('refresh');*/
		$('#lead_marked-list').val('No');
		$('#module_pk_id').val('');
		//$('#lead_activity_id').val('');

	});
	/* /schedule new activity */
	
	/* Radio Btn Activity */
	$('.composedmail').hide();
	$('.mail-action-btn').css('visibility','hidden');
	$('group').each(function(i,e){
        $(e).find('input:radio').attr('name', 'group' + i);
    });
	$(document).on('ifChecked', '#compose', function(event){		
		$(this).attr("checked", true);
		var module_pk_id = $("#module_pk_id").val();
        if (module_pk_id > 0) 
    	{
    		get_email_thread();
    	}
		$('.composedmail').show();		
		$('.mail-action-btn').css('visibility','visible');
		$('.compose_con').css('visibility','visible');
		//$('.compose_con').hide();
	});
	$(document).on('ifUnchecked','#compose', function(event){
		$(this).removeAttr("checked");
		$('.composedmail').hide();
		$('.mail-action-btn').css('visibility','hidden');
		//$('.compose_con').hide();
	});
	$(document).on('ifChecked','#not_mail', function(event){
		$(this).attr("checked", true);
		$('.mail-action-btn').css('visibility','hidden');
		$('.composedmail').hide();
		//$('.compose_con').hide();
	});
	$(document).on('ifUnchecked','#not_mail', function(event){
		$(this).removeAttr("checked");
		$('.mail-action-btn').css('visibility','visible');
		$('.composedmail').show();

		$('.compose_con').css('visibility','visible');
		//$('.compose_con').hide();
	});
	if ($('input[name="composedmail"]').is(':checked')) {
		var module_pk_id = $("#module_pk_id").val();
        if (module_pk_id > 0) 
    	{
    		get_email_thread();
    	}
		$('.composedmail').show();
		$('.mail-action-btn').css('visibility','visible');
		$('.compose_con').css('visibility','visible');
	}	
	if ($('input[name="composedmail"]').is(':checked')) {
		$('.composedmail').show();
		$('.mail-action-btn').css('visibility','visible');
		$('.compose_con').css('visibility','visible');
	}	
	/* /Radio Btn Activity */	
	//$('.compose_con').hide();		
	$("body").on("click", ".reply_forward", function (event) {		
		$('.compose_con').show();
		//$('.mail-action-btn').css('visibility','hidden');
		$('html,body').animate({ scrollTop: 270 }, 'slow', function () {			
		});
	}); 
	/* /Activity Tab */
	
	
	/* Btn Action */
	$('.iradio_square-red').removeClass('checked');
	$('#update_completed_activity_new, #activity_cancel').click(function(){
		$('#log-complete-activity-new').attr('id','log-complete-activity');
		$('#schedule_activity_new').attr('id','schedule_activity');
		$('#schedule_activity').attr('id','schedule_activity');
		$('.log_complete').hide();
		$('.lead_activity_table').show();				
		$('.composedmail').hide();
		$('.mail-action-btn').css('visibility','hidden');
		/* Act Tab */
		$('.act-general, .act-mail').removeClass('active');
		$('.act-general').addClass('active');
		$('.tab-content #general, .tab-content #sendmail').removeClass('active');
		$('.tab-content #general').addClass('active');
		/* /Act Tab */
		/* Radio Act Remove */
		$('.iradio_square-red').removeClass('checked');
		$('#compose').removeAttr('checked');
		$('#not_mail').removeAttr('checked');
		/* /Radio Act Remove */
		$('#log-complete-activity').find('button').removeClass('btn-blue');
		$('#log-complete-activity-new').find('button').removeClass('btn-blue');
		$('#schedule_activity').find('button').removeClass('btn-blue');
		$('#schedule_activity_new').find('button').removeClass('btn-blue');		
		
	});
	$('#mail_cancel').click(function(){
		var triger = 'cencel';
		get_email_thread(triger);
		$('.mail-action-btn').css('visibility','hidden');
		$('.compose_con').css('visibility','hidden');
	});
	/* Btn Action */
	
});

/* /UI CODE */
$(function(){	

$('#mail-reply-button').click(function() {
	$('#mail-reply').toggle();
	return false;
});
var url = window.location.href;
	var hash = url.substring(url.indexOf("#"));
	if (hash == "#Activities")
		{
			lead_activity_table();
		}

$(document).on( 'shown.bs.tab', 'a[href="#Activities"]', function (){ 
	lead_activity_table();
});	

	//lead_activity_table();
	var confidence = $('#sl1').val();	
	$('#sl1').slider({	
          formater: function(value) {
            return 'Current value: '+ value;
          }
        });
		var x = $("#sl1").slider();    
        x.slider('setValue', confidence ); 	
	/* /Shcedule */
	$('.general-btn-all a img.uni_save , .general-btn-all a img.uni_cancel , .mail-action-btn a img.uni_cancel ').click(function(){
		$('#schedule_activity_new').attr('id','schedule_activity');
		$('#log-complete-activity-new').attr('id','log-complete-activity');
		$('.lead_activity_table').show();
		$('.log_complete').hide();
	});
	$('#datetimepicker5').datetimepicker({
			pickTime: false
	});
	$('.custom_datetimepicker').datetimepicker({
			pickTime: false
	});
	var lead_creation_date = $('#lead_created_on').val();
	var lead_creation_date_split = lead_creation_date.split(' ');
	var lead_creation_date_val = lead_creation_date_split[0];	
	var lead_creation_date_value =lead_creation_date_val.split('-');
	var lead_date = lead_creation_date_value[1]+'/'+lead_creation_date_value[2]+'/'+lead_creation_date_value[0];
	$('#datetimepicker11').datetimepicker({
			pickTime: false,
			minDate:new Date(lead_date)
	});	
	$('#datetimepicker12').datetimepicker({
			pickTime: false,
			minDate:new Date()
	});
	$('#task-time').datetimepicker({
		pickDate: false
	});
	$('#datetimepicker10').datetimepicker({
			pickTime: false			
	});
	$('#schedule-time').datetimepicker({
		pickDate: false
	});
	$('#s_datetimepicker10').datetimepicker({
			pickTime: false			
	});
	$('#s_schedule-time').datetimepicker({
		pickDate: false
	});
	$('#s_datetimepicker11').datetimepicker({
			pickTime: false
	});
	$('#s_task-time').datetimepicker({
		pickDate: false
	});	
	$('.datetimepicker11').hide();	
	$('.datetimepicker12').hide();	

});
//Insert code starts here
$(function() {
//Add and back
$('#add_lead_new_back').on('click',function() {
	$("#save_type").val('save_and_back');
	var name = $('#name').val();		
	var primary_email = $('#primary_email').val();
	var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;
	if(name == '' || primary_email == '' || valid == false){			
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-success');
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-danger');
		$('.error-message .alerts').text('Please fill all mandatory fields');
		$('.name-field .help-block:first').show();		
		$('.name-field .help-block').parent('.form-group').addClass('has-error');
		$('.email-field .help-block:first').show();
		$('.email-field .help-block').parent('.form-group').addClass('has-error');	
		if(name != ''){			
			$('.name-field .help-block:first').hide();		
			$('.name-field .help-block').parent('.form-group').removeClass('has-error');
			$('.name-field .help-block').parent('.form-group').addClass('has-success');
		}
		else if(valid != false){
			$('.email-field .help-block:first').hide();
			$('.email-field .help-block').parent('.form-group').removeClass('has-error');	
			$('.email-field .help-block').parent('.form-group').addClass('has-success');	
		}			
	}		
	else{	
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-success');
		var ub_lead_id = $('#ub_lead_id').val();
		if (typeof ub_lead_id == 'undefined')
		{
			$('.error-message .alerts').text('Added succesfully');
		}
		else
		{
			$('.error-message .alerts').text('Updated succesfully');
		}
		$('.name-field .help-block:first').hide();
		$('.email-field .help-block:first').hide();
		$('.help-block').parent('.form-group').removeClass('has-error');
		$('.help-block').parent('.form-group').addClass('has-success');
		add_lead_form();
	}
});
//Add and New
$('#add_lead_new_new').on('click',function(e) {
	$("#save_type").val('save_and_new');
	var name = $('#name').val();		
	var primary_email = $('#primary_email').val();
	var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;
	if(name == '' || primary_email == '' || valid == false){			
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-success');
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-danger');
		$('.error-message .alerts').text('Please fill all mandatory fields');
		$('.name-field .help-block:first').show();		
		$('.name-field .help-block').parent('.form-group').addClass('has-error');
		$('.email-field .help-block:first').show();
		$('.email-field .help-block').parent('.form-group').addClass('has-error');	
		if(name != ''){			
			$('.name-field .help-block:first').hide();		
			$('.name-field .help-block').parent('.form-group').removeClass('has-error');
			$('.name-field .help-block').parent('.form-group').addClass('has-success');
		}
		else if(valid != false){
			$('.email-field .help-block:first').hide();
			$('.email-field .help-block').parent('.form-group').removeClass('has-error');	
			$('.email-field .help-block').parent('.form-group').addClass('has-success');	
		}			
	}		
	else{	
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-success');
		var ub_lead_id = $('#ub_lead_id').val();
		if (typeof ub_lead_id == 'undefined')
		{
			$('.error-message .alerts').text('Added succesfully');
		}
		else
		{
			$('.error-message .alerts').text('Updated succesfully');
		}
		$('.name-field .help-block:first').hide();
		$('.email-field .help-block:first').hide();
		$('.help-block').parent('.form-group').removeClass('has-error');
		$('.help-block').parent('.form-group').addClass('has-success');
		add_lead_form();
	}
});
$('#save_lead_info').on('click',function() {
		$("#save_type").val('save_and_stay');
		add_lead_form();
});
//Add and Stay
$('#add_lead_new_stay').click(function (e) {	
	$("#save_type").val('save_and_stay');
	var ub_lead_id = $('#ub_lead_id').val();
	var name = $('#name').val();		
	var primary_email = $('#primary_email').val();
	var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;
	if(name == '' || primary_email == '' || valid == false){			
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-success');
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-danger');
		$('.error-message .alerts').text('Please fill all mandatory fields');
		$('.name-field .help-block:first').show();		
		$('.name-field .help-block').parent('.form-group').addClass('has-error');
		$('.email-field .help-block:first').show();
		$('.email-field .help-block').parent('.form-group').addClass('has-error');	
		if(name != ''){			
			$('.name-field .help-block:first').hide();		
			$('.name-field .help-block').parent('.form-group').removeClass('has-error');
			$('.name-field .help-block').parent('.form-group').addClass('has-success');
		}	
		else if(valid != false){
			$('.email-field .help-block:first').hide();
			$('.email-field .help-block').parent('.form-group').removeClass('has-error');	
			$('.email-field .help-block').parent('.form-group').addClass('has-success');	
		}		
	}	
			
	else{			
		$('.name-field .help-block:first').hide();
		$('.email-field .help-block:first').hide();
		$('.help-block').parent('.form-group').removeClass('has-error');
		$('.help-block').parent('.form-group').addClass('has-success');
		add_lead_form();
	}
});
$('#leadinfotab a').click(function (e) {
	var ub_lead_id = $('#ub_lead_id').val();
	if (typeof ub_lead_id == 'undefined')
	{
		$("#save_type").val('save_and_stay');
	}
	var name = $('#name').val();		
	var primary_email = $('#primary_email').val();
	var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;
	if(name == '' || primary_email == '' || valid == false){			
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-success');
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-danger');
		$('.error-message .alerts').text('Please fill all mandatory fields');
		$('.name-field .help-block:first').show();		
		$('.name-field .help-block').parent('.form-group').addClass('has-error');
		$('.email-field .help-block:first').show();
		$('.email-field .help-block').parent('.form-group').addClass('has-error');	
		if(name != ''){			
			$('.name-field .help-block:first').hide();		
			$('.name-field .help-block').parent('.form-group').removeClass('has-error');
			$('.name-field .help-block').parent('.form-group').addClass('has-success');
		}
		else if(valid != false){
			$('.email-field .help-block:first').hide();
			$('.email-field .help-block').parent('.form-group').removeClass('has-error');	
			$('.email-field .help-block').parent('.form-group').addClass('has-success');	
		}
		return false;		
	}		
	else{	
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-success');
		if (typeof ub_lead_id == 'undefined')
		{
			$('.error-message .alerts').text('Added succesfully');
		}
		else
		{
			$('.error-message .alerts').text('Updated succesfully');
		}
		$('.name-field .help-block:first').hide();
		$('.email-field .help-block:first').hide();
		$('.help-block').parent('.form-group').removeClass('has-error');
		$('.help-block').parent('.form-group').addClass('has-success');
		add_lead_form();
	}
});
$('#add_new_activity_new').on('click',function() {
		$("#save_type").val('add_new_activity');
		add_activity_form();
		lead_activity_table();
});
$('#update_completed_activity_new').on('click',function() {
		$("#save_type").val('update_completed_activity');
		add_activity_form();
		lead_activity_table();
});
$('#completed_compose_email').on('click',function() {
		send_email_form();
		get_email_thread();
});
$('#add_new_activity_new_stay').click(function (e) {
	add_activity_form();
});
var ub_lead_activity_id = $('#ub_lead_activity_id').val();
if(ub_lead_activity_id > 0)
	{
		get_activity_form(ub_lead_activity_id);
	}
});

function lead_activity_table() {
	
        var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
		var ub_lead_id = $('#ub_lead_id').val();
		// return false;
		// Ajax URL
		var encoded_url = Base64.encode('leads/get_activity/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object	
		var dbobject = {
							'tableName': $('#lead_activity'),
							'this_table' : {'table_name':'lead_activity'},
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_lead_activity_id',
							'mark_status': 'mark_completed_status',
							'name' : 'activity_type',
							'post_data':'{"fetch_type":"'+fetch_type+'","ub_lead_id":"'+ub_lead_id+'"}',
							'update_data':{'index':6}, 
							'edit_data':{'index':0, 'url':'leads/save_lead/'},
							'display_columns' : [{"data": "activity_type"},{"data": "first_name"},{"data": "name"},{"data": "activity_date"},{"data": "followup_date"},{"data": "modified_on"},{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_lead_activity_id', "defaultContent": '<input type="checkbox" class="chk activity_status" />'}],
							'default_order_by': [[6, 'desc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#lead_activity').on( 'click', 'a.editor_remove', function (e) {
		  var lead_id = $(this).attr('id');
		  delete_role({'ub_lead_activity_id':{lead_activity_id:lead_activity_id}});
		});

		$(document).on('ifChecked', '.activity_status',  function() {			
			var ub_lead_activity_id = $(this).attr('id');
			var mark_completed_status = 'Yes';

			var encoded_string = Base64.encode('leads/save_activity/');
			var encoded_val = encoded_string.strtr(encode_chars_obj);	
			
			var success_msg = 'Successful';
			var failure_msg = 'Failed';
			$.ajax({
				url: base_url + encoded_val,
				dataType: "json",
				type: "post",
				data: 'ub_lead_activity_id=' + ub_lead_activity_id + '&mark_completed_status=' + mark_completed_status,	

				success: function(response) {
					if(response.status == true)
		            {	
							//alert(1234567);
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
		});
		$(document).on('ifUnchecked', '.activity_status',  function() {			
			var ub_lead_activity_id = $(this).attr('id');
			var mark_completed_status = 'No';

			var encoded_string = Base64.encode('leads/save_activity/');
			var encoded_val = encoded_string.strtr(encode_chars_obj);	
			
			var success_msg = 'Successful';
			var failure_msg = 'Failed';
			$.ajax({
				url: base_url + encoded_val,
				dataType: "json",
				type: "post",
				data: 'ub_lead_activity_id=' + ub_lead_activity_id + '&mark_completed_status=' + mark_completed_status,	

				success: function(response) {
					if(response.status == true)
		            {	
							//alert(1234567);
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
		});
		setTimeout(checkbox, 1*400);
    }

// Code to Add/Delete Project type in general value table
	$('#lead_project_type').on('change', function() {
        var selected = $(this).find("option:selected").val();
        $('#Edit_new_project_type').val(selected);
        $('#selected').val(selected);
    });
    $('#save_project_type').click(function() {
        var value = $('#new_project_type').val();
		var encoded_url = Base64.encode('leads/update_general_value/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var classification = 'lead_project_type';
		var operation_type = 'add';
		xhr = $.ajax({
			type: "POST",
			dataType: "json",
			data: {"classification":classification,"type":operation_type,"value":value},
			url: base_url + ajax_encoded_url,
			success: function (response) {
				if(response.status == true)
				{
					$('#lead_project_type').append($("<option value=" + value + ">" + value + "</option>").text(value));
					$(".selectpicker").selectpicker("refresh");
					// alert("Added successfully");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text('Added successfully');
					$("#AddProjectType").modal('hide');
				}else
				{
					// alert("Insertion failed");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text('Insertion failed');
				}
			}
		});	
    });
    $('.EditProjectType').click(function() {
        var n = $('#lead_project_type').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
        if (n === 1) {
            $('#EditProjectType').modal({
                show: true
            });
            $('#Edit_project').click(function() {
                var sat = $('#Edit_new_project_type').val();
                var selected_val = $('#selected').val();
                if (selected_val == selected_val) {
                    $('#lead_project_type option[value=' + selected_val + ']').remove();
                }
                if (sat == sat) {
                    $('#lead_project_type').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
                }
                $('#lead_project_type').next().find('.dropdown-menu li.selected a .text').empty();
                $('#lead_project_type').next().find('.dropdown-menu li.selected a .text').append(sat);
                $('#lead_project_type').next().find('.selectpicker .filter-option').empty();
                $('#lead_project_type').next().find('.selectpicker .filter-option').append(sat);
            });
            $('#delete_project_type').click(function() {
				var value = $('#Edit_new_project_type').val();
                if (value == value) {
                    $('#lead_project_type option[value="' + value + '"]').remove();
                }
				var encoded_url = Base64.encode('projects/update_general_value/');
				var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
				var classification = 'lead_project_type';
				var operation_type = 'delete';
				dataobj = {"classification":classification,"type":operation_type,"value":value};
				xhr = $.ajax({
					type: "POST",
					dataType: "json",
					data: dataobj,
					url: base_url + ajax_encoded_url,
					success: function (response) {
						if(response.status == true)
						{						
							$('#Edit_new_project_type').val('');
							$('#lead_project_type').next().find('.dropdown-menu li.selected').remove();
							$('#lead_project_type').next().find('.selectpicker .filter-option').empty();
							$('#lead_project_type').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
							$(".selectpicker").selectpicker("refresh");
							// alert("Deleted successfully");
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text('Deleted successfully');
							$("#EditProjectType").modal('hide');
						}else
						{
							// alert("Deletion failed: "+response.message);
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text("Deletion failed: "+response.message);
						}
					}
				});	
              
            });
        } else if (n > 1) {
            // alert('select only one at a time');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('select only one at a time');
        } else if (n === 0) {
            // alert('Please select');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select');
        }
    });

// Code to Add/Delete Source in general value table
	$('#lead_source').on('change', function() {
        var selected = $(this).find("option:selected").val();
        $('#Edit_new_source').val(selected);
        $('#selected').val(selected);
    });
    $('#save_source').click(function() {
        var value = $('#new_source').val();
		var encoded_url = Base64.encode('leads/update_general_value/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var classification = 'lead_source';
		var operation_type = 'add';
		xhr = $.ajax({
			type: "POST",
			dataType: "json",
			data: {"classification":classification,"type":operation_type,"value":value},
			url: base_url + ajax_encoded_url,
			success: function (response) {
				if(response.status == true)
				{
					$('#lead_source').append($("<option value=" + value + ">" + value + "</option>").text(value));
					$(".selectpicker").selectpicker("refresh");
					// alert("Added successfully");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text("Added successfully");	
					$("#AddSource").modal('hide');
				}else
				{
					// alert("Insertion failed");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text("Insertion failed");
				}
			}
		});	
    });
    $('.EditSource').click(function() {
        var n = $('#lead_source').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
        if (n === 1) {
            $('#EditSource').modal({
                show: true
            });
            $('#Edit_project').click(function() {
                var sat = $('#Edit_new_source').val();
                var selected_val = $('#selected').val();
                if (selected_val == selected_val) {
                    $('#lead_source option[value=' + selected_val + ']').remove();
                }
                if (sat == sat) {
                    $('#lead_source').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
                }
                $('#lead_source').next().find('.dropdown-menu li.selected a .text').empty();
                $('#lead_source').next().find('.dropdown-menu li.selected a .text').append(sat);
                $('#lead_source').next().find('.selectpicker .filter-option').empty();
                $('#lead_source').next().find('.selectpicker .filter-option').append(sat);
            });
            $('#delete_source').click(function() {
				var value = $('#Edit_new_source').val();
                if (value == value) {
                    $('#lead_source option[value="' + value + '"]').remove();
                }
				var encoded_url = Base64.encode('projects/update_general_value/');
				var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
				var classification = 'lead_source';
				var operation_type = 'delete';
				dataobj = {"classification":classification,"type":operation_type,"value":value};
				xhr = $.ajax({
					type: "POST",
					dataType: "json",
					data: dataobj,
					url: base_url + ajax_encoded_url,
					success: function (response) {
						if(response.status == true)
						{						
							$('#Edit_new_source').val('');
							$('#lead_source').next().find('.dropdown-menu li.selected').remove();
							$('#lead_source').next().find('.selectpicker .filter-option').empty();
							$('#lead_source').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
							$(".selectpicker").selectpicker("refresh");
							// alert("Deleted successfully");
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text("Deleted successfully");	
							$("#EditSource").modal('hide');
						}else
						{
							// alert("Deletion failed: "+response.message);
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text("Deletion failed: "+response.message);	
						}
					}
				});	
              
            });
        } else if (n > 1) {
            // alert('select only one at a time');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('select only one at a time');	
        } else if (n === 0) {
            // alert('Please select');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select');	
        }
    });

// Code to Add/Delete Tag in general value table
	$('#lead_tags').on('change', function() {
        var selected = $(this).find("option:selected").val();
        $('#Edit_new_tag').val(selected);
        $('#selected').val(selected);
    });
    $('#save_tag').click(function() {
        var value = $('#new_tag').val();
		var encoded_url = Base64.encode('leads/update_general_value/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var classification = 'lead_tags';
		var operation_type = 'add';
		xhr = $.ajax({
			type: "POST",
			dataType: "json",
			data: {"classification":classification,"type":operation_type,"value":value},
			url: base_url + ajax_encoded_url,
			success: function (response) {
				if(response.status == true)
				{
					$('#lead_tags').append($("<option value=" + value + ">" + value + "</option>").text(value));
					$(".selectpicker").selectpicker("refresh");
					// alert("Added successfully");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text("Added successfully");	
					$("#AddNewTag").modal('hide');
				}else
				{
					// alert("Insertion failed");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text("Insertion failed");	
				}
			}
		});	
    });
    $('.EditNewTag').click(function() {
        var n = $('#lead_tags').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
        if (n === 1) {
            $('#EditNewTag').modal({
                show: true
            });
            $('#Edit_project').click(function() {
                var sat = $('#Edit_new_tag').val();
                var selected_val = $('#selected').val();
                if (selected_val == selected_val) {
                    $('#lead_tags option[value=' + selected_val + ']').remove();
                }
                if (sat == sat) {
                    $('#lead_tags').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
                }
                $('#lead_tags').next().find('.dropdown-menu li.selected a .text').empty();
                $('#lead_tags').next().find('.dropdown-menu li.selected a .text').append(sat);
                $('#lead_tags').next().find('.selectpicker .filter-option').empty();
                $('#lead_tags').next().find('.selectpicker .filter-option').append(sat);
            });
            $('#delete_tag').click(function() {
				var value = $('#Edit_new_tag').val();
                if (value == value) {
                    $('#lead_tags option[value="' + value + '"]').remove();
                }
				var encoded_url = Base64.encode('projects/update_general_value/');
				var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
				var classification = 'lead_tags';
				var operation_type = 'delete';
				dataobj = {"classification":classification,"type":operation_type,"value":value};
				xhr = $.ajax({
					type: "POST",
					dataType: "json",
					data: dataobj,
					url: base_url + ajax_encoded_url,
					success: function (response) {
						if(response.status == true)
						{						
							$('#Edit_new_tag').val('');
							$('#lead_tags').next().find('.dropdown-menu li.selected').remove();
							$('#lead_tags').next().find('.selectpicker .filter-option').empty();
							$('#lead_tags').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
							$(".selectpicker").selectpicker("refresh");
							// alert("Deleted successfully");
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text("Deleted successfully");	
							$("#EditNewTag").modal('hide');
						}else
						{
							// alert("Deletion failed: "+response.message);
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text("Deletion failed: "+response.message);	
						}
					}
				});	
              
            });
        } else if (n > 1) {
            // alert('select only one at a time');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('select only one at a time');	
        } else if (n === 0) {
            // alert('Please select');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select');	
        }
    });

// Code to Add/Delete Tag Type in general value table
	$('#lead_activity_type').on('change', function() {
        var selected = $(this).find("option:selected").val();
        $('#Edit_new_activity_type').val(selected);
        $('#selected').val(selected);
    });
    $('#save_activity_type').click(function() {
        var value = $('#new_activity_type').val();
		var encoded_url = Base64.encode('leads/update_general_value/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var classification = 'lead_activity_type';
		var operation_type = 'add';
		xhr = $.ajax({
			type: "POST",
			dataType: "json",
			data: {"classification":classification,"type":operation_type,"value":value},
			url: base_url + ajax_encoded_url,
			success: function (response) {
				if(response.status == true)
				{
					$('#lead_activity_type').append($("<option value=" + value + ">" + value + "</option>").text(value));
					$(".selectpicker").selectpicker("refresh");
					// alert("Added successfully");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text("Added successfully");	
					$("#AddActivityType").modal('hide');
				}else
				{
					// alert("Insertion failed");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text("Insertion failed");	
				}
			}
		});	
    });
    $('.EditNewActivityType').click(function() {
        var n = $('#lead_activity_type').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
        if (n === 1) {
            $('#EditNewActivityType').modal({
                show: true
            });
            $('#Edit_project').click(function() {
                var sat = $('#Edit_new_tag').val();
                var selected_val = $('#selected').val();
                if (selected_val == selected_val) {
                    $('#lead_activity_type option[value=' + selected_val + ']').remove();
                }
                if (sat == sat) {
                    $('#lead_activity_type').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
                }
                $('#lead_activity_type').next().find('.dropdown-menu li.selected a .text').empty();
                $('#lead_activity_type').next().find('.dropdown-menu li.selected a .text').append(sat);
                $('#lead_activity_type').next().find('.selectpicker .filter-option').empty();
                $('#lead_activity_type').next().find('.selectpicker .filter-option').append(sat);
            });
            $('#delete_activity_type').click(function() {
				var value = $('#Edit_new_activity_type').val();
                if (value == value) {
                    $('#lead_activity_type option[value="' + value + '"]').remove();
                }
				var encoded_url = Base64.encode('projects/update_general_value/');
				var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
				var classification = 'lead_activity_type';
				var operation_type = 'delete';
				dataobj = {"classification":classification,"type":operation_type,"value":value};
				xhr = $.ajax({
					type: "POST",
					dataType: "json",
					data: dataobj,
					url: base_url + ajax_encoded_url,
					success: function (response) {
						if(response.status == true)
						{						
							$('#Edit_new_activity_type').val('');
							$('#lead_activity_type').next().find('.dropdown-menu li.selected').remove();
							$('#lead_lead_activity_type').next().find('.selectpicker .filter-option').empty();
							$('#lead_lead_activity_type').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
							$(".selectpicker").selectpicker("refresh");
							// alert("Deleted successfully");
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text("Deleted successfully");		
							$("#EditNewActivityType").modal('hide');
						}else
						{
							// alert("Deletion failed: "+response.message);
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text("Deletion failed: "+response.message);		
						}
					}
				});	
              
            });
        } else if (n > 1) {
            // alert('select only one at a time');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('select only one at a time');		
        } else if (n === 0) {
            // alert('Please select');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select');		
        }
    });
// Code for save page

function add_lead_form() {
	// Encode the String
	var ub_lead_id = $('#ub_lead_id').val();
	var name = $('#name').val();
	var desk_phone = $('#desk_phone').val();
	var mobile_phone = $('#mobile_phone').val();
	var mobile_isd_code = $('#mobile_isd_code').val();
	var confidence_level = $('#sl1').val();
	var primary_email = $('#primary_email').val();
	var projected_sales_date = $('#projected_sales_date').val();
	var encoded_string = Base64.encode('leads/save_lead/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('leads/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#add_new_lead").serialize();
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData+ '&ub_lead_id='+ub_lead_id+'&name='+name+'&desk_phone='+desk_phone+'&mobile_phone='+mobile_phone+'&mobile_isd_code='+encodeURIComponent(mobile_isd_code)+'&confidence_level='+confidence_level+'&projected_sales_date='+projected_sales_date,	
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },
		success: function(response) 
		{
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				//add_custom_field_form(response.insert_id);
				$.when(file_upload(response.insert_id)).done(function()
				{
					$.when(add_custom_field_form(response.insert_id)).done(function()
					{
						//alert('ggggggkkkkkkkk');
		               if($("#save_type").val() == 'save_and_new')
						{
							window.location.href = encoded_val;
						}
						else if($("#save_type").val() == 'save_and_back')
						{
							window.location.href = encoded_home_val;
						}
						else if($("#save_type").val() == 'save_and_stay')
		                {
		                    var encoded_string_edit_log = Base64.encode( 'leads/save_lead/' + response.insert_id);
		                    var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
		                    //console.log(encoded_edit_val);
		                    window.location.href = encoded_edit_val;
		                    // console.log(response.insert_id);
		                }
						if(response.message)
						{
							success_box();
							success_msg = response.message;
							$('.error-message .alerts').text(success_msg);
						}						
						
					});
					
		        });
			}
			else
			{	
				if(response.message)
				{
					error_box();
					failure_msg = response.message;
					$('.error-message .alerts').text(failure_msg);
				}					
			}
			return false;
		}
		});		
}

//Delete checklist

function deletelead(ub_lead_id){
	
var conf = $('#confirmModal').modal('show');
    // if(ub_lead_id > 0)
    // {
    var encoded_delete_roles = Base64.encode('leads/delete_leads/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('leads/index/');
    var index_url = index_string.strtr(encode_chars_obj);
	$('#delete_confirm').click(function(){
	var conf = true;
	if(conf == true){
	$('#confirmModal').modal('hide');
    $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: {'ub_lead_id':{ub_lead_id:ub_lead_id}},
			beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');			 
			},
            success: function(response) {   
			 $('.uni_wrapper').removeClass('loadingDiv');
                if(response.status == true)
                {   
                    if(response.message)
                    {
                        success_msg = response.message;
                        window.location.href = index_url;                           
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
    //}
    // else
    // {               
        // $(".error-message .alerts").addClass('alert-danger');
        // $(".error-message .alerts").removeClass('alert-success');
        // $(".error-message").show();
        // $(".alerts").html("Log id is not set");      
    // }
}

function add_activity_form() {
	// Encode the String
	var encoded_string = Base64.encode('leads/save_activity/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var ub_lead_activity_id = $('#module_pk_id').val();

	var encoded_home_string = Base64.encode('leads/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#update_completed_activity").serialize();
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData+ '&ub_lead_activity_id=' + ub_lead_activity_id,	
		success: function(response) { 
			if(response.status == true)
            {	
					$('#module_pk_id').val(response['insert_id']);
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

	function get_activity_form(ub_lead_activity_id){
    var encoded_delete_roles = Base64.encode('leads/get_activity/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: {'ub_lead_activity_id':{ub_lead_activity_id:ub_lead_activity_id}},
            success: function(response) {  
              	/*alert(response.aaData.toSource());
              	alert(response.aaData[0]['description']);*/
                if(response.status == true)
                {   
                	//alert(response);
                	//alert(1);
                    $(this).attr('id','log-complete-activity-new');
					$('#schedule_activity_new').attr('id','schedule_activity');	
					$("#log-complete-activity-new").attr('id','log-complete-activity');
					$("#log-complete-activity").find('button').addClass('btn-blue');					
					$('.log_complete').show();		
					$('.lead_activity_table').hide();		
					$('.Schedule_complete').hide();	
					$('#datetimepicker12').hide()
					$('#datetimepicker11').show();					
					$('.log_complete .tabbable .nav-tabs li').removeClass('active');
					$('.log_complete .tabbable .nav-tabs li:first-child').addClass('active');
					$('.log_complete .tabbable .tab-content #general').addClass('active');
					$('.log_complete .tabbable .tab-content #sendmail').removeClass('active');
					$('.mail-action-btn').css('visibility','hidden');
				 	$('.selectpicker').selectpicker('refresh');
		            $("#lead_activity_type option[value='" + response.aaData[0]['activity_type'] + "']").prop("selected", true);
		            $("#lead_activity_sales_person option[value='" + response.aaData[0]['sales_person'] + "']").prop("selected", true);
		            $("#initiated_by option[value='" + response.aaData[0]['initiated_by'] + "']").prop("selected", true);
		            $("#reminder_id option[value='" + response.aaData[0]['reminder_id'] + "']").prop("selected", true);
		            $('.selectpicker').selectpicker('refresh'); 
		            
					$('#description').val(response.aaData[0]['description']);
					$('#activity_time').val(response.aaData[0]['activity_time']);
					$('#followup_time').val(response.aaData[0]['followup_time']);
					$('#activity_date').val(response.aaData[0]['activity_date']);
					$('#lead_activity_id').val(response.aaData[0]['ub_lead_activity_id']);
					$('#schedule_followup').val(response.aaData[0]['followup_date']);
					$('#module_pk_id').val(response.aaData[0]['ub_lead_activity_id']);
					//alert($('#module_pk_id').val());
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
/*function send_email_form()
{

	var encoded_string = Base64.encode('leads/save_and_send_email/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);	

	//var message_body = CKEDITOR.instances['editor'].getData();
	var message_body = CKEDITOR.instances.message_body.getData();
	var email = $("#primary_email").val();
	var alternative_email = $("#alternative_email").val();

    var formData = new FormData($('#compose_completed_email')[0]);
    $.ajax({
        url: base_url + encoded_val,
        data: formData,
         type: 'POST',
        async: false,
        success: function (data) {
            alert(data)
        },
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
}*/
function send_email_form()
{
   		// Encode the String
	var encoded_string = Base64.encode('leads/save_and_send_email/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);	

	//var message_body = CKEDITOR.instances['editor'].getData();
	var message_body = CKEDITOR.instances.message_body.getData();
	var email = $("#primary_email").val();
	var alternative_email = $("#alternative_email").val();

	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#compose_completed_email").serialize();
	//alert(ajaxData);
		$.ajax({
		url: base_url + encoded_val,
		dataType:'json',
		type: "post",
		data: ajaxData+ '&message_body=' + message_body+ '&email=' + email+ '&alternative_email=' + alternative_email, 	

		success: function(response) {
			if(response.status == true)
			{
				get_email_thread();
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

function activity_file_upload(insert_id)
{
	var temp_directory_id = $("#temp_directory_id").val();
	var folderid = $("#folder_id").val();
	var moduleid = insert_id;
	var module_name = 'activity';
	var encoded_string = Base64.encode('leads/get_temp_filename/');

	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var response = $.ajax({
		url: base_url + encoded_val,
		//dataType: "json",
		type: "post",
		data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid + '&moduleid='+moduleid + '&module_name='+module_name,			
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },	
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');			  
			//if(response.status == true)
			//{	
				//window.location.href = role_index_url;
			//}
		}
	});
	return  response;
}

function get_email_thread(triger)
{
	var page_number=0;
	email_thread_form(page_number, triger);
} 
function onclick_next()
{
	var page_number = $("#page_number").attr('class');
	var total_page = $("#total_page").attr('class');
	if (page_number != total_page) 
	{
		$('#mail-thread').html("");
		email_thread_form(page_number);
	}
}
function onclick_previous()
{
	var page_number = $("#page_number").attr('class');
	if (page_number !=1) 
	{
		$('#mail-thread').html("");
		page_number = (page_number-2);
		email_thread_form(page_number);
	}
	
}

function email_thread_form(page_number, triger)
{
	var total_page =null;	
	if(page_number==0)
	{
	    $("#previous").prop('disabled','disabled');
	}
	else
	{
	    $("#previous").prop('disabled', false);
	}

	if(page_number==(total_page-1))
	{
	    $("#next").prop('disabled', true);
	}
	else
	{
	    $("#next").prop('disabled', false);
	}

	$("#page_number").text(page_number+1);

	var encoded_string = Base64.encode('leads/get_activity_thread/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);

	var module_pk_id = $("#module_pk_id").val();

	var success_msg = 'Successful';
	var failure_msg = 'Failed';

		$.ajax({
		url: base_url + encoded_val,
		type: "post",
		data: 'module_pk_id=' + module_pk_id + '&page_number=' + page_number + '&triger=' + triger, 	
		success: function(response) {
			//alert(JSON.stringify(response));
			if(response != '')
			{	
				//alert(response);				
				$('#mail-thread').html(response);
				$('.mail-action-btn').css('visibility','hidden');
				$(".mail-thread-con").mCustomScrollbar({
					setHeight:250,
					theme:"dark-3"
				});	
				$("#mail-thread").show();
				$(".compose_con").hide();
			}
			else
			{	
				$("#mail-thread").hide();
				$(".compose_con").show();				
			}
			return false;
		}
	});	
}

$("body").on("click", ".reply_forward", function (event) {

    var message_id = $(this).attr('id');
    
    var ub_message_id = $('#message_id').val();

    if (message_id == 'mail-reply-button-'+ub_message_id) 
    	{
    		$("#email_type").val('reply');
    	}
    if (message_id == 'mail-reply-all-button-'+ub_message_id) 
    	{
    		$("#email_type").val('reply-all');
    	}
    if (message_id == 'forward-button-'+ub_message_id) 
    	{
    		$("#email_type").val('forward');
    	};

    var encoded_string = Base64.encode('leads/get_activity_thread/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);

	var success_msg = 'Successful';
	var failure_msg = 'Failed';
		$.ajax({
		url: base_url + encoded_val,
		dataType: 'json',
		type: "post",
		data: 'message_id=' + message_id, 	
		success: function(response) {
			//alert(JSON.stringify(response));
			if(response != '')
			{	
				if($("#email_type").val() == 'reply')
				{
					//alert($("#email_type").val());
					$("#composedmail").show();
					$('.mail-action-btn').css('visibility','visible');
					$('#alt_email_to').val(response.aaData[0]['from_email_id']);
					$('#alt_email_cc').val('');
					$('#subject').val(response.aaData[0]['subject']);
					$('#unique_email_id').val(response.aaData[0]['from_email_id']);
					CKEDITOR.instances.message_body.setData(response.aaData[0]['message_body']);
				}
				if($("#email_type").val() == 'reply-all')
				{
					//alert($("#email_type").val());
					$("#composedmail").show();
					$('.mail-action-btn').css('visibility','visible');
					$('#alt_email_to').val(response.aaData[0]['from_email_id']);
					//$('#alt_email_to').parent().find('.bootstrap-tagsinput').append("<span class='tag label label-info'>"+response.aaData[0]['from_email_id']+"<span data-role='remove'></span></span>");
					//$('#alt_email_cc').parent().find('.bootstrap-tagsinput').append("<span class='tag label label-info'>"+response.aaData[0]['cc_other_emails']+"<span data-role='remove'></span></span>");
					$('#alt_email_cc').val(response.aaData[0]['cc_other_emails']);
					$('#subject').val(response.aaData[0]['subject']);
					$('#unique_email_id').val(response.aaData[0]['from_email_id']);
					CKEDITOR.instances.message_body.setData(response.aaData[0]['message_body']);
				}
				if($("#email_type").val() == 'forward')
                {
                	//alert($("#email_type").val());
                	$("#composedmail").show();
                	$('.mail-action-btn').css('visibility','visible');
                	$('#alt_email_to').val('');
					$('#alt_email_cc').val('');
					$('#subject').val(response.aaData[0]['subject']);
					CKEDITOR.instances.message_body.setData(response.aaData[0]['message_body']);
                }
			}
			else
			{	
				// alert('fail');
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('fail');		
			}
			return false;
		}
	});	
});
/*
        $('#lead_activity tbody').on('click', 'td .chk', function () {	
		alert('a');
		//$('.chk input[type="checkbox"]').click(function(){

            if($(this).is(":checked")){

                alert("Checkbox is checked.");

            }

            else if($(this).is(":not(:checked)")){

                alert("Checkbox is unchecked.");

            }

        });*/
		
function add_new_lead_form(){	
	var addnewleadform = $('#add_new_lead, #add_new_lead_prime').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_lead_new_stay, #add_lead_new_new, #add_lead_new_back, #leadinfotab a'			
        },
        fields: {
            'name': {
                validators: {
                    notEmpty: {
                        message: 'The name cannot be empty'
                    }
                }
            },
			'primary_email': {
                validators: {
					/* notEmpty: {
                        message: 'The mail cannot be empty'
                    }, */
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            },
			'mobile_phone': {
                    validators: {						 
                        phone: {
                            country: 'countrySelectBox',
                            message: 'The value is not valid %s Cell number'
                        }
                    }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);			
      }).on('success.form.fv', function(e) {
			add_lead_form();				
			e.preventDefault();			 
	  }).on('change', '[name="countrySelectBox"]', function(e) {
            $('#add_new_lead, #add_new_lead_prime').formValidation('revalidateField', 'mobile_phone');
        });		  
}

/* Leads file upload block start hear*/
$(function () {

    'use strict';
    
    var temp_id = lead_temprory_dir_id;    

    //alert(temp_id); 
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('leads/upload/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#fileupload').fileupload({
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
                // alert(name + ' - Already exixt.' );
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text(name + ' - Already exixt.');
                return false;
            }
            // code to validate the directory name end.

            var encoded_string = Base64.encode('leads/allowed_extension/');
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
                        // alert("Not an accepted file type.");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(ext +" is not an accepted file type.");
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        // alert(name + ' - Filesize is too big.' );
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(name + ' - Filesize is too big.');
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        // alert(uploadErrors.join("\n"));
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
        // acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        // maxFileSize: 5000000,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
        success: function (data) {			
			setTimeout(checkbox, 1*200);			
			//alert(JSON.stringify(response));
			$("#temp_directory_id").val(data.files[0]['temp_dir_id']);
			$('.uni_wrapper').removeClass('loadingDiv');
		}
    });
	// Load existing files:
	$.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: $('#fileupload').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#fileupload')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
});

function file_upload(insert_id)
{
	var temp_directory_id = lead_temprory_dir_id;
	var folderid = lead_folder_id;
	var moduleid = insert_id;
	var encoded_string = Base64.encode('leads/get_temp_filename/');
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
			$('.uni_wrapper').removeClass('loadingDiv');
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

function copy_file_to_temp(temprory_dir_id)
{
	var file_path = $('#temp_file_path').val();
	var temp_id = temprory_dir_id;
	var encoded_string = Base64.encode('leads/copy_file_to_temp/');
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
	var temp_id = lead_temprory_dir_id;
	$.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: $('#fileupload').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#fileupload')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$("#fileupload").find(".files").empty();
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
}

$(function(){
	var encoded_string = Base64.encode('leads/get_doc_hierarchy/');
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
$(document).on('click', '.file_tab', function() {
	$('#Files #folder_id').val(lead_folder_id);
	$('#Files #temp_directory_id').val(lead_temprory_dir_id);
});
$(document).on('ifChecked', '#compose', function() {
	$('#folder_id').val(activity_folder_id);
	$('#temp_directory_id').val(activity_temprory_dir_id);
});


/* Leads -> Activity file upload block start hear*/
$(function () {

    'use strict';
    
    var temp_id = activity_temprory_dir_id;    

    //alert(temp_id); 
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('leads/upload/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#compose_completed_email').fileupload({
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
                // alert(name + ' - Already exixt.' );
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text(name + ' - Already exixt.');
                return false;
            }
            // code to validate the directory name end.

            var encoded_string = Base64.encode('leads/allowed_extension/');
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
                        // alert("Not an accepted file type.");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(ext +" is not an accepted file type.");
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        // alert(name + ' - Filesize is too big.' );
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(name + ' - Filesize is too big.');
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        // alert(uploadErrors.join("\n"));
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
        // acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        // maxFileSize: 5000000,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
        success: function (data) {			
			setTimeout(checkbox, 1*200);			
			//alert(JSON.stringify(response));
			$("#temp_directory_id").val(data.files[0]['temp_dir_id']);
			$('.uni_wrapper').removeClass('loadingDiv');
		}
    });
	// Load existing files:
	$.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: $('#compose_completed_email').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#compose_completed_email')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
});

function add_custom_field_form(ub_lead_id)
{
	var encoded_string = Base64.encode('leads/save_custom_field/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#add_custom_field").serialize();
	//alert(ajaxData);return false;
		var response = $.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData+ '&module_id='+ub_lead_id,	
		/*beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },*/
		success: function(response) 
		{
		}
		});	
		return response;	
}