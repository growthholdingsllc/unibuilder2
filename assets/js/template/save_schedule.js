//checking project status -- code added by satheesh kumar
$(function() {
	var schedule_id = $('#schedule_id').val();   
	if(schedule_id == '' || schedule_id == 0)
	{
		check_project_status('template/schedules/index/');
	}
	else if(project_status_check == false)
	{
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Project was closed. You can not able to edit');
		//alert('you can not edit');
	}
	/* checking project status code ends here*/
});

imgLink = base_url + 'assets/images/'; 
$(function(){

	$('#datetimepicker3').datetimepicker({ pickTime: false, format: 'MM/DD/YYYY'});
	$('#datetimepicker4').datetimepicker({ pickTime: false, format: 'MM/DD/YYYY'});	
	
	update_result_form();
	$('.file_uploaded_div').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	});	
	if(schedule_id>0)
	{
		//$('.checked_marked').css('pointer-events','none');		
		if ($('#publish_status').val() == 'Yes') {			
			$('#publish_status').iCheck('disable');			
			$('#hide_publish_status').val('Yes');
		}
		else if($('#publish_status').val() == 'No'){
			$('#publish_status').iCheck('uncheck');
			$('#publish_status').iCheck('enable');
		}
		
		// get_link_follows_schedule(schedule_id);
		// get_schedule_shifts_history(schedule_id,false);
		$('#shift_type').change(function(){
			// get_schedule_shifts_history(schedule_id,true);
		});	
	}
	else
	{
		$('#project_view_access').val('');
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var output = (month<10 ? '0' : '') + month + '/' + (day<10 ? '0' : '') + day +'/'+ d.getFullYear() ;
		$("#start_date").val(output);
		$("#end_date").val(output);
	}
	// assigned_users_dropdown();
	$('#datetimepicker3').change(function(){
		if($('#start_date').val() != '')
		{
			var date = new Date($('#start_date').val());
			var newdate = new Date(date);
			var no_of_days = $('#no_of_days').val();
			newdate.setDate(newdate.getDate() + parseInt(no_of_days));
			var dd = ("0" + newdate.getDate()).slice(-2);
			var mm = ("0" + (newdate.getMonth() + 1)).slice(-2);
			var y = newdate.getFullYear();

			var schedule_end_date = mm + '/' + dd + '/' + y;
			$('#end_date').val(schedule_end_date);					
			$('#datetimepicker4').parent().removeClass('has-error');
			$('#datetimepicker4').parent().addClass('has-success');
			$('#datetimepicker4').parent().next().find('.help-block').hide();
			
			//find_date_interval('find_date_interval',$('#start_date').val(),$('#end_date').val(),$('#no_of_days').val());
		}
		else
		{
			return false;
		}
	});
	$('#datetimepicker4').change(function(){
		if($('#start_date').val() != '' && $('#end_date').val() != '')
		{
			if($('#start_date').val()<$('#end_date').val())
			{
				var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
				var firstDate = new Date($('#end_date').val());
				var secondDate = new Date($('#start_date').val());

				var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
				$('#no_of_days').val(diffDays);
				//find_date_interval('get_duration',$('#start_date').val(),$('#end_date').val(),$('#no_of_days').val());
			}			
		}
	});	
	$("#no_of_days").blur(function() {
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^-0-9]/g, function(){ return ''; }) );
		if($('#no_of_days').val() != '' && $('#start_date').val() != '')
		{
			var date = new Date($('#start_date').val());
			var newdate = new Date(date);
			var no_of_days = $('#no_of_days').val();
			newdate.setDate(newdate.getDate() + parseInt(no_of_days));
			var dd = ("0" + newdate.getDate()).slice(-2);
			var mm = ("0" + (newdate.getMonth() + 1)).slice(-2);
			var y = newdate.getFullYear();

			var schedule_end_date = mm + '/' + dd + '/' + y;
			$('#end_date').val(schedule_end_date);									
			$('#datetimepicker4').parent().removeClass('has-error');
			$('#datetimepicker4').parent().addClass('has-success');
			$('#datetimepicker4').parent().next().find('.help-block').hide();
			//find_date_interval('get_end_date',$('#start_date').val(),$('#end_date').val(),$('#no_of_days').val());
		}
	});
	/* $(".dur").on('click', function() {		
		if($('#no_of_days').val() != '' && $('#start_date').val() != '')
		{
			find_date_interval('get_end_date',$('#start_date').val(),$('#end_date').val(),$('#no_of_days').val());
		}
	});	 */	
	
	$('#predecessor_list').change( function() {
		//validate_predecessor('predecessor_name_dropdown');
	});
	$('#predecessor_type').change( function() {
		//validate_predecessor('predecessor_type_dropdown');
	});
	
	$('input[name^=lag]').blur(function() {
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^-0-9]/g, function(){ return ''; }) );
		if($inpt.val() != '')
		{
			//validate_predecessor('predecessor_type_dropdown');		
		}
	});	
	
		
	$('#colorselector_1').colorselector();
	$('.selectpicker').selectpicker('refresh');
	setTimeout(refresh_picker, 1*200);
});

function refresh_picker(){
	$('.selectpicker').selectpicker('refresh');
}
/* Schedule */
 $(function(){

/* 
$('.checked_marked').hide();	
	$('.unchecked_marked').click(function(){		
		$(this).hide();
		$('.checked_marked').show();
		$('#is_completed').attr("checked", true);
	});
	$('.checked_marked').click(function(){
		$(this).hide();
		$('.unchecked_marked').show();
		$('#is_completed').attr("checked", false);
	}); */
	$('.checked_marked').hide();
	var mark_check = $('#is_completed').val();
	if(mark_check === 'Yes'){
		$('.checked_marked').show();
		$('.unchecked_marked').hide();
	}
	else{
		$('.checked_marked').hide();
		$('.unchecked_marked').show();
	}	
	
	
	/* Below code was added by chandru 09/05/2015 */
	$('.unchecked_marked').click(function(){
		$(this).hide();
		$('.checked_marked').show();
		$('#is_completed').attr("checked", true);
		$('#is_completed').val("Yes");
	});
	$('.checked_marked').click(function(){
		$(this).hide();
		$('.unchecked_marked').show();
		$('#is_completed').attr("checked", false);
		$('#is_completed').val("No");
	});
	
	$(document).on('ifChecked','#publish_status', function(event){
        $("#publish_status").val("Yes");
    });
    $(document).on('ifUnchecked','#publish_status', function(event){
        $("#publish_status").val("No");
    }); 
	
	/* chandru code ends here */
  //remove button
$('.removeBtn').click( function() {
    var cointainer = $(this).parent().parent().parent().parent().closest('.cointainer');
    var counts = cointainer.children('.content').length;
    counts--;
	//alert(counts);
    if(counts < 3) {
        cointainer.children('.addBtn').show();         
        cointainer.children('.addBtn').removeClass('hide');         
        if (counts == 0) {
           //alert('caught');
		   return false;
		   // cointainer.find('.removeBtn').hide();
        }
    }
    $(this).parent().parent().parent().parent().remove();
    cointainer.find('.label-num').text(function(idx){
        return 1 + idx
    })
	//validate_predecessor('remove_pred');
});

//add button
$('.addBtn').click( function() {    
	var validation_flag = validate_predecessor('add_pred');
	if(false === validation_flag)
	{
		return false;
	}
	 
	if(validation_flag)
	{
		var cointainer = $(this).closest('.cointainer');	
		var counts = cointainer.children('.content').length;
		var content = $(this).prev();
		counts++;		
		if (counts > 2) {
			//$(this).removeClass('show');  
			//$(this).hide();  
		}
		content.clone(true,true).insertAfter(content).find('input').val('').end().find('.label-num').text(counts);
		//$('.Lag').val(0);
		$('.selectpicker').data('selectpicker', null);
		$('.bootstrap-select').remove();
		$('.selectpicker').selectpicker(); 
		//$('.selectpicker').selectpicker('refresh');
		cointainer.find('.removeBtn').show();
	}
});  
 
});

function get_link_follows_schedule(schedule_id) 
{
	var scheduleid = (schedule_id > 0) ? schedule_id : 0;
	if(scheduleid>0)
	{
		// Ajax URL
		var encoded_url = Base64.encode('template/schedules/get_link_follows_schedule/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var dbobject = {
			'tableName': $('#link_follows_schedule'),
			'request_from':'schedule_link_to',
			'ajax_encoded_url':ajax_encoded_url,
			'post_data':'{"schedule_id":"'+scheduleid+'"}',
			'display_columns' : [{"sTitle":"Title","data": "title"},{"sTitle":"Lag","data": "lag"},{"sTitle":"Start Date","data": "start_date"},{"sTitle":"End Date","data": "end_date"}]
		};
		// Populate data table
		ubdatatable_just_view(dbobject);
	}
	
	/*$('#predecessor_list').dataTable({						
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5, 
		"paging": false,			
		sAjaxSource: base_url + 'assets/js/json_predecessor_list.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],			
		"columns":[            
		{ "sTitle":"Title", "data": "title"},		
		{ "sTitle":"Lag", "data": "lag"},
		{ "sTitle":"Start Date", "data": "start_date"},
		{ "sTitle":"End Date", "data": "end_date"}
		
	],
	"order": [[1, 'asc']]

	});*/
}
$(function() {     
    baseline_list_view();
});

function baseline_list_view() {
	
	$('#baseline_list').dataTable({						
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5, 
					
		sAjaxSource: base_url + 'assets/js/json_baseline_list.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],			
		"columns":[            
		{ "sTitle":"Baseline Current", "data": "baseline_current"},
		{ "sTitle":"Start Date", "data": "start_date"},
		{ "sTitle":"End Date", "data": "end_date"},
		{ "sTitle":"Duration", "data": "duration"},
		{ "sTitle":"Total Variance", "data": "total_variance"}
		
	],
	"order": [[1, 'asc']]

	});
}

function get_schedule_shifts_history(schedule_id,table_check) {
	
	var scheduleid = (schedule_id > 0) ? schedule_id : 0;
	if(scheduleid>0)
	{
		
		// Ajax URL
		var shift_type = $("#shift_type").val();
		var encoded_url = Base64.encode('template/schedules/get_schedule_shift_history/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var dbobject = {
			'tableName': $('#shifts_list'),
			'request_from':'schedule_shifts_history',
			'table_check':table_check,
			'ajax_encoded_url':ajax_encoded_url,
			'post_data':'{"schedule_id":"'+scheduleid+'","shift_type":"'+shift_type+'"}',
			'display_columns' : [{"sTitle":"User","data": "user"},{"sTitle":"[Base] Start Date","data": "base_start_date"},{"sTitle":"[Base] End Date","data": "base_end_date"},{"sTitle":"Slip","data": "slip"},{"sTitle":"Type","data": "shift_type"},{"sTitle":"Source","data": "title"},{"sTitle":"Reason","data": "reason"},{"sTitle":"Notes","data": "notes"}]
		};
		// Populate data table
		ubdatatable_just_view(dbobject);
	}

	/*$('#shifts_list').dataTable({						
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5, 
					
		sAjaxSource: base_url + 'assets/js/json_shifts_list.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],			
		"columns":[            
		{ "sTitle":"User", "data": "user"},
		{ "sTitle":"[Base] Start Date", "data": "start_date"},
		{ "sTitle":"[Base] End Date", "data": "end_date"},
		{ "sTitle":"Slip", "data": "slip"},
		{ "sTitle":"Type", "data": "type"},
		{ "sTitle":"Source", "data": "source"},
		{ "sTitle":"Reason", "data": "reason"},
		{ "sTitle":"Notes", "data": "notes"}
		
	],
	"order": [[1, 'asc']]

	});*/
}

/* /Schedule */
$(function(){
	$('body ul.drag-ele').on('click', 'li', function() {
	   $(this).toggleClass('selected'); 
	});
	/* Below code was commented by chandru */
	/* Below code was added by chandru 11-05-2015 */
	/* Subs Permitted */
	// UN select the viewable users 
    $('#sub_move_left').click(function() {
		var selected_count = 0
		$('.sub_list2 .selected').each( function(){
			$('#project_view_access').val($('#project_view_access').val().replace(","+$(this).val(), ""));
			selected_count++;
		});
		if($('.sub_list2 .selected').length>0)
		{
			$('.sub_list1').append($('.sub_list2 .selected').removeClass('selected'));
			return true;
		}
		else
		{
			alert('Select a sub user(s) to remove viewable access');return false;
		}
	});

	// UN select the viewable users 
    $('#sub_move_right').click(function() {
		var selected_count = 0
		if($('#project_view_access').val() == '' || $('#project_view_access').val() == ',')
		{
			$('#project_view_access').val(',');
		}
		$('.sub_list1 .selected').each( function(){
			selected_count++;
			$('#project_view_access').val($('#project_view_access').val()+$(this).val()+',');
		});
		if($('.sub_list1 .selected').length>0)
		{
			$('.sub_list2').append($('.sub_list1 .selected').removeClass('selected'));
			return true;
		}
		else
		{
			alert('Select a sub user(s) to assign viewable access');return false;
		}
	});

	/* chandru code ends here */
    /* /Subs Permitted */
	/* Viewing Access Search */
    $('#subs_left').keyup(function() {
        var valThis = $(this).val().toUpperCase();
        if (valThis == "") {
            $('.sub_list1 > li').show();
        } else {
            $('.sub_list1 > li').each(function() {
                var text = $(this).text().toUpperCase();
                (text.indexOf(valThis) == 0) ? $(this).show(): $(this).hide();
            });
        };
    });
    $('#subs_right').keyup(function() {
        var valThis = $(this).val().toUpperCase();
        if (valThis == "") {
            $('.sub_list2 > li').show();
        } else {
            $('.sub_list2 > li').each(function() {
                var text = $(this).text().toUpperCase();
                (text.indexOf(valThis) == 0) ? $(this).show(): $(this).hide();
            });
        };
    });    
    /* /Viewing Access Search */
	
}); 

function validate_schedule_form()
{
	var title = $('#title').val();		
	var start_date = $('#start_date').val();		
	var no_of_days = $('#no_of_days').val();		
	var end_date = $('#end_date').val();		
	if(title == '' || start_date == '' || no_of_days == '' || end_date == '')
	{			
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-success');
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-danger');
		$('.error-message .alerts').text('Please fill all mandatory fields');
		return false;					
	}
	else if(start_date > end_date){
/* 		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-success');
		$('.error-message .alerts').removeClass('alert-danger');
		$('.error-message .alerts').addClass('alert-danger');
		$('.error-message .alerts').text('Start Date cannot be greater than End Date.');
		return false;
 */	}
	else{			
		$('.error-message').show();
		$('.error-message .alerts').removeClass('alert-danger');
		return true;
	}
}

// Click event for button Save & Back
$('#save_and_back').on('click',function(e) { 
	$('#save_type').val('save_and_back');	
	var is_true = validate_predecessor('submit_schedule');
	if(false === is_true)
	{
		return false;
	}
	if(true === validate_schedule_form())
	{
		add_schedule_form('save_and_back');
		e.preventDefault();
	}
	else
	{
		return false;
	}
});
// Click event for button Save & Stay
$('#save_and_stay').on('click',function(e) { 
	$('#save_type').val('save_and_stay');	
	var is_true = validate_predecessor('submit_schedule');
	if(false === is_true)
	{
		return false;
	}
	if(true === validate_schedule_form())
	{
		add_schedule_form('save_and_stay');
		e.preventDefault();
	}
	else
	{
		return false;
	}
});
// Click event for button Save & New
$('#save_and_new').on('click',function(e) { 
	$('#save_type').val('save_and_new');	
	var is_true = validate_predecessor('submit_schedule');
	if(false === is_true)
	{
		return false;
	}
	if(true === validate_schedule_form())
	{
		add_schedule_form('save_and_new');
		e.preventDefault();
	}
	else
	{
		return false;
	}
});




/* 
$("#save_schedule").submit(function(event) {
	var current_id = $(this.id).context.activeElement.id;
	var is_true = validate_predecessor('submit_schedule');
	if(false === is_true)
	{
		return false;
	}
	var submit_button = current_id;
	//alert(submit_button);
	$('#save_type').val(submit_button);		 
		var title = $('#title').val();		
		var start_date = $('#start_date').val();		
		var no_of_days = $('#no_of_days').val();		
		var end_date = $('#end_date').val();		
		if(title == '' || start_date == '' || no_of_days == '' || end_date == '')
		{			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');
			return false;					
		}
		else if(start_date > end_date){
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Start Date cannot be greater than End Date.');
			return false;
		}
		else{			
			$('.top-search a button').addClass('pointer_none');	
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			//$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('Updated Results search succesfully');
			//add_schedule_form();
			//e.preventDefault();
		}
	switch(submit_button)
	{
		
		case 'save_and_back':
		{
			//alert('save and back');
			add_schedule_form(submit_button);			
			
			break;
		}
		case 'save_and_stay':
		{
			add_schedule_form(submit_button);
			break;
		}
		case 'save_and_new':
		{
			add_schedule_form(submit_button);
			break;
		} 		
	}		
	event.preventDefault();
}); */

$( "#cancel" ).click(function( event ) {
	var encoded_home_string = Base64.encode('template/schedules/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	window.location.href = encoded_home_val;
});

$( "#btn_shift_reason" ).click(function( event ) {
	if($('textarea#shift_reason').val().replace(/^\s+|\s+$/g,"").length != 0)
	{
		if($('#save_type').val()!='')
		{
			$('#hide_schedule_reason').val($('textarea#shift_reason').val());
			$('#schedule_modal').modal('hide');			
			add_schedule_form($('#save_type').val());
		}	
	}
	else
	{
		alert("Please enter a value!");
		return false;
	}	
});


// Add schedule
function add_schedule_form(submit_type) {
	/* if($('#schedule_id').val()!="" && $('#schedule_id').val()>0)
	{
		if(($('#start_date').val() != $('#hide_db_start_date').val()) || ($('#no_of_days').val() != $('#hide_db_duration').val()) || ($('#end_date').val() != $('#hide_db_end_date').val()))
		{
			if($('textarea#shift_reason').val()=="")
			{
				$('#schedule_modal').modal('show');	
				return false;
			}
		}
	}*/	
 	$('.top-search a button').addClass('pointer_none'); 	
	var encoded_string = Base64.encode('template/schedules/save_schedule/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('template/schedules/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#save_schedule").serialize();	
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
			 $('.top-search a button').removeClass('pointer_none');
			if(response.status == true)
			{	
				if(submit_type == 'save_and_new')
				{
					window.location.href = encoded_val;
				}
				else if(submit_type == 'save_and_back')
				{
					window.location.href = encoded_home_val;
				}
				else if(submit_type == 'save_and_stay')
				{
					$('#schedule_id').val(response.schedule_id);
					var encoded_string_edit_schedule = Base64.encode( 'template/schedules/save_schedule/' + response.schedule_id);
					var encoded_edit_val = encoded_string_edit_schedule.strtr(encode_chars_obj);
					//console.log(encoded_edit_val);
					window.location.href = encoded_edit_val;
					// console.log(response.insert_id);
				}
				if(response.message)
				{
					success_msg = response.message;
					$('.error-message .alerts').addClass('alert-success');
					$('.error-message .alerts').text(success_msg);
				}  		
				//console.log(response.ub_project_id);
			}
			else
			{	
				if(response.message)
				{
					failure_msg = response.message;
					$('.error-message .alerts').addClass('alert-danger');
					$('.error-message .alerts').text(failure_msg);
				}	
				return false;
			}
		}
	});	
}

// Populating assigned to drop down based on project
function assigned_users_dropdown()
{
	var encoded_destroy_session = Base64.encode('template/schedules/get_assigned_to_dropdown/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	var assigned_users = $('#assigned_to_selected').val();
	var data = 'request_for=assigned_to_dropdown&project_id='+$('#project_id').val()+'&assigned_users='+assigned_users;
	$.ajax({
		type:'POST',
//		dataType: "json",
		url:ajaxUrl,
		data:data,
		success:function(res) {
			if(res != ''){					
				//$('#load_assigned_to_div').html(res);
				
				$('#load_assigned_to_div').html(res);
				$(".selectpicker").selectpicker("refresh");	
			}
			else{
				$('#load_assigned_to_div').html('');
				$(".selectpicker").selectpicker("refresh");	
			}
		}
	});
}

/* Below code was added by chandru on 08-05-2014 */

//Tag add code
/* Drop Down Tag Add / Edit / Delete */
$('#tags').on('change', function() {
    var selected = $(this).find("option:selected").val();
    $('#Edit_tag_group').val(selected);
    $('#selected').val(selected);
});
$('#tags_save').click(function() {
    if($('#tags_add').val()=="")
	{
		alert('Please enter a value!');
		return false;
	}
	var value = $('#tags_add').val();
    var encoded_url = Base64.encode('template/schedules/update_general_value/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
    var classification = 'schedule_tags';
    var operation_type = 'add';
    xhr = $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            "classification": classification,
            "type": operation_type,
            "value": value
        },
        url: base_url + ajax_encoded_url,
        success: function(response) {
            if (response.status == true) {
                $('#tags').append($("<option value=" + value + ">" + value + "</option>").text(value));
                $(".selectpicker").selectpicker("refresh");
                alert("Added successfully");
                $("#TagAddModal").modal('hide');
            } else {
                alert("Insertion failed");
            }
        }
    });
});
$('.TagsEditModal').click(function() {
    var n = $('#tags').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
    if (n === 1) {
        $('#TagsEditModal').modal({
            show: true
        });
        $('#Edit_project').click(function() {
            var sat = $('#Edit_project_group').val();
            var selected_val = $('#selected').val();
            if (selected_val == selected_val) {
                $('#tags option[value=' + selected_val + ']').remove();
            }
            if (sat == sat) {
                $('#tags').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
            }
            $('#tags').next().find('.dropdown-menu li.selected a .text').empty();
            $('#tags').next().find('.dropdown-menu li.selected a .text').append(sat);
            $('#tags').next().find('.selectpicker .filter-option').empty();
            $('#tags').next().find('.selectpicker .filter-option').append(sat);
        });
        $('#Delete_tag').click(function() {
            var value = $('#Edit_tag_group').val();
            if (value == value) {
                $('#tags option[value="' + value + '"]').remove();
            }
            var encoded_url = Base64.encode('template/schedules/update_general_value/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var classification = 'schedule_tags';
            var operation_type = 'delete';
            dataobj = {
                "classification": classification,
                "type": operation_type,
                "value": value
            };
            xhr = $.ajax({
                type: "POST",
                dataType: "json",
                data: dataobj,
                url: base_url + ajax_encoded_url,
                success: function(response) {
                    if (response.status == true) {
                        $('#Edit_tag_group').val('');
                        $('#tags').next().find('.dropdown-menu li.selected').remove();
                        $('#tags').next().find('.selectpicker .filter-option').empty();
                        $('#tags').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
                        $(".selectpicker").selectpicker("refresh");
                        alert("Selected Tag Deleted successfully");
                        $("#TagsEditModal").modal('hide');
                    } else {
                        alert("Deletion failed: " + response.message);
                    }
                }
            });

        });
    } else if (n > 1) {
        alert('select only one at a time');
    } else if (n === 0) {
        alert('Please select');
    }
});
/* /Tags Drop Down Add / Edit / Delete code Ends here */

//Phase add code

/* Drop Down Phase Add / Edit / Delete */
$('#phase').on('change', function() {
    var selected = $(this).find("option:selected").val();
    $('#Edit_phase_group').val(selected);
    $('#selected').val(selected);
});
$('#phase_save').click(function() {
    var value = $('#phase_add').val();
	if($('#phase_add').val()=="")
	{
		alert("Please enter a value!");
		return false;
	}
    var encoded_url = Base64.encode('template/schedules/update_general_value/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
    var classification = 'schedule_phase_list';
    var operation_type = 'add';
    xhr = $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            "classification": classification,
            "type": operation_type,
            "value": value
        },
        url: base_url + ajax_encoded_url,
        success: function(response) {
            if (response.status == true) {
                $('#phase').append($("<option value=" + value + ">" + value + "</option>").text(value));
                $(".selectpicker").selectpicker("refresh");
                alert("Added successfully");
                $("#TypeAddModal").modal('hide');
            } else {
                alert("Insertion failed");
            }
        }
    });
});
$('.TypeEditModal').click(function() {
    var n = $('#phase').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
    if (n === 1) {
        $('#TypeEditModal').modal({
            show: true
        });
        $('#Edit_project').click(function() {
            var sat = $('#Edit_phase_group').val();
            var selected_val = $('#selected').val();
            if (selected_val == selected_val) {
                $('#phase option[value=' + selected_val + ']').remove();
            }
            if (sat == sat) {
                $('#phase').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
            }
            $('#phase').next().find('.dropdown-menu li.selected a .text').empty();
            $('#phase').next().find('.dropdown-menu li.selected a .text').append(sat);
            $('#phase').next().find('.selectpicker .filter-option').empty();
            $('#phase').next().find('.selectpicker .filter-option').append(sat);
        });
        $('#Delete_phase').click(function() {
            var value = $('#Edit_phase_group').val();
            if (value == value) {
                $('#phase option[value="' + value + '"]').remove();
            }
            var encoded_url = Base64.encode('template/schedules/update_general_value/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var classification = 'schedule_phase_list';
            var operation_type = 'delete';
            dataobj = {
                "classification": classification,
                "type": operation_type,
                "value": value
            };
            xhr = $.ajax({
                type: "POST",
                dataType: "json",
                data: dataobj,
                url: base_url + ajax_encoded_url,
                success: function(response) {
                    if (response.status == true) {
                        $('#Edit_phase_group').val('');
                        $('#phase').next().find('.dropdown-menu li.selected').remove();
                        $('#phase').next().find('.selectpicker .filter-option').empty();
                        $('#phase').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
                        $(".selectpicker").selectpicker("refresh");
                        alert("Selected Phase Deleted successfully");
                        $("#TypeEditModal").modal('hide');
                    } else {
                        alert("Deletion failed: " + response.message);
                    }
                }
            });

        });
    } else if (n > 1) {
        alert('select only one at a time');
    } else if (n === 0) {
        alert('Please select');
    }
});
/* Phase Drop Down Add / Edit / Delete code Ends here */
/* Chandru code ends here */

/* find_date_interval code was added by chadnru 09-04-2015 */
function find_date_interval(action_type,start_date_val,end_date_val,duration_val)
{
	var is_pred_call = false;
	var async_val = true;
	var return_value = '';
	if(action_type == 'get_end_date_pred_call')
	{
		is_pred_call = true;
		async_val = false;
		action_type = 'get_end_date';
	}
	if(action_type == 'get_duration_pred_call')
	{
		is_pred_call = true;
		async_val = false;
		action_type = 'get_duration';
	}
	
	var predecessor_name_length = parseInt($('select[name^=predecessor_list] > option:selected').length); 
	var predecessor_type_length = parseInt($('select[name^=predecessor_type] > option:selected').length); 
	if(predecessor_name_length>0 && predecessor_type_length>0 && action_type == 'find_date_interval' )
	{
		var validation_result = validate_predecessor(action_type);
		//return validation_result;
	}
	if(action_type == 'find_date_interval' )
	{	
		start_date_val = $('#start_date').val();
		if($('#no_of_days').val()!='' && $('#no_of_days').val()>0)
		{
			duration_val = $('#no_of_days').val();
			action_type = 'get_end_date';
		}
		else
		{
			return false;
		}
	}
	
	var start_date = '';
	var duration = '';
	var end_date = '';
	if(start_date_val != '')
	{
		start_date = get_formatted_date(start_date_val,'DB');
	}
	var project_id = $('#project_id').val();
	var encoded_url = Base64.encode('template/schedules/find_date_interval/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var flag = false;
	var dataobj = '';
	if(action_type == 'get_duration')
	{
		end_date = get_formatted_date(end_date_val,'DB');
		if(start_date == '' || end_date == '')
		{			
			return false;
		}
		dataobj = {
			"startdate": start_date,
			"enddate": end_date,
			"project_id": project_id,
			"type":action_type
		};
		flag = true;
	}
	else if(action_type == 'get_end_date')
	{
		duration = duration_val;
		if(start_date == '' && duration == '')
		{			
			return false;
		}	
		dataobj = {
			"startdate": start_date,
			"totaldays": duration,
			"project_id": project_id,
			"type":action_type
		};
		flag = true;
	}
	if(true === flag)
	{
		xhr = $.ajax({
			type: "POST",
			dataType: "json",
			data: dataobj,
			async: async_val,
			url: base_url + ajax_encoded_url,
			success: function(response) {
				if (response.status == true) 
				{
					if(response['action_type'] == 'get_duration')
					{
						if(true === is_pred_call)
						{
							$('#pred_manipulated_output').val(response['no_of_days']);	
						}
						else
						{
							$('#no_of_days').val(response['no_of_days']);
							return_value = true;
						}	
					}
					else if(response['action_type'] == 'get_end_date')
					{
						if(true === is_pred_call)
						{
							$('#pred_manipulated_output').val(response['end_date']);	
						}
						else
						{
							$('#end_date').val(response['end_date']);					
							$('#datetimepicker4').parent().removeClass('has-error');
							$('#datetimepicker4').parent().addClass('has-success');
							$('#datetimepicker4').parent().next().find('.help-block').hide();
							return_value = true;
						}
					}
				} 
				else 
				{
					if(true === is_pred_call)
					{
						return_value = false;
						$('#pred_manipulated_output').val('');
					}
					else
					{
						//alert(response['message']);
					}
				}
			}
		});
	}
	if(true === is_pred_call)
	{
		//alert('call from pred');
		return xhr;
	}
	else
	{
		return true;
	}	
}
// Function to format date in UI and DB
function get_formatted_date(date_str,type)
{
	var date_arr = '';
	var formatted_date='';	
	if(date_str=='')
	{
		return false;
	}
	if(type=='DB')
	{
		date_arr = date_str.split("/");
		formatted_date = date_arr[2] + "-" + date_arr[0] + "-" + date_arr[1];
	}
	else if(type=='UI')
	{
		date_arr = date_str.split("-");
		formatted_date = date_arr[1] + "/" + date_arr[2] + "/" + date_arr[0];
	}
	else if(type=='DB_BSLASH')
	{
		date_arr = date_str.split("-");
		formatted_date = date_arr[0] + "/" + date_arr[1] + "/" + date_arr[2];
	}
	
	return formatted_date;
}
// Function to get the JS no. of days added to date maxDate
function get_date_add(inputDate,no_of_days,called_from)
{
	var end_date='';
	var add_one_day = 1;
	var lag_days = 0;
	if(called_from == 'Finish to Start')
	{
/* 		if(no_of_days != '' && no_of_days>0)
		{
			lag_days = parseInt(no_of_days) + add_one_day;			
		}
		else
		{
			lag_days = add_one_day;
		}	
 */		lag_days = parseInt(no_of_days);
	}
	else if(called_from == 'Start to Start')
	{
		lag_days = parseInt(no_of_days);
	}
	$.when(find_date_interval('get_end_date_pred_call',inputDate,'',lag_days)).done(function(){
		end_date = $('#pred_manipulated_output').val();
		//return end_date;
	});
	
/* 	inputDate.setDate(Number(inputDate.getDate()) + parseInt(lag_days));
	if(inputDate.getMonth()<=8)
	{
		var month = Number(inputDate.getMonth()+1);
		end_date = end_date+'0'+month+'/';
	}
	else
	{
		var month = Number(inputDate.getMonth()+1);
		end_date = end_date+month+'/';
	}
	if(inputDate.getDate()<=9)
	{
		end_date = end_date+'0'+inputDate.getDate()+'/';
	}
	else
	{
		end_date = end_date+inputDate.getDate()+'/';
	}
	end_date = end_date+inputDate.getFullYear();

 */	
}

// Validate predecessor
function validate_predecessor(calledfrom)
{
	$('#hide_predecessor_count').val(0);
	//alert(maxDate.getFullYear()+maxDate.getMonth()+maxDate.getDate());
	var predecessor_name_array = new Array();
	var predecessor_type_array = new Array();
	var predecessor_lag_array = new Array();
	var predecessor_date_array = new Array();
	var predecessor_name = '';
	var predecessor_array = new Array(); 
	var maxDate = new Date();
	var dates=[];
	var end_date = '';
	predecessor_date = '';
	var new_date = '';
	var pred_date = '';
	var preds_date ='';
	var new_end_date = '';
	var validation_flag = false;
	var validation_flag1 = false;
	var validation_flag2 = false;
	//var validation_flag3 = false;
	var i = 0;
	var timeDiff = 0;
	var diffDays = 0;
	var lag = 0;
	$('select[name^=predecessor_list] > option:selected').each( function(){
		if($(this).val() != '')
		{
			predecessor_name_array[i]=$(this).text();
			i++;
			validation_flag1 = true;
		}
		else
		{
			validation_flag1 = false;
			return false;
		}	
		
	});
	i = 0;
	$('select[name^=predecessor_type] > option:selected').each( function(){
		if($(this).val() != '')
		{
			predecessor_type_array[i]=$(this).text();
			i++;
			validation_flag2 = true;
		}
		else
		{
			validation_flag2 = false;
			return false;
		}	
	});
	i = 0;
	$('input[name^=lag]').each(function() {
		predecessor_lag_array[i]=$(this).val();
		i++;
	});
	
	if($('select[name^=predecessor_list] > option:selected').length==1 && $('select[name^=predecessor_type] > option:selected').length==1 && $('input[name^=lag]').length==1)
	{
		if(validation_flag2===false && validation_flag1===false && calledfrom=='submit_schedule')
		{
			return true;
			$('.error-message').show();			
			$('.error-message .alerts').text('');
		}
		else if(validation_flag2===false && validation_flag1===false){
			$('.error-message').hide();
			$('.error-message .alerts').text('');
			return false;
		}
	}
	
	if(validation_flag2===false || validation_flag1===false)
	{
		if(calledfrom!='find_date_interval')
		{
			//alert('Please select the predecessor info (Name / Type).');
			//$('.error-message .alerts').addClass('alert-danger');
			//$('.error-message .alerts').text('Please select the predecessor info (Name / Type / Lag).');
		}
		$('.error-message').show();	
		$('.error-message .alerts').text('Please select the predecessor info (Name / Type / Lag).');
		return false;
	}
	
	if(calledfrom == 'add_pred' || calledfrom == 'remove_pred')
	{
		return true;
	}
	
	// check for count
	if(predecessor_name_array.length == predecessor_type_array.length)
	{
		$('.error-message').hide();
		$('.error-message .alerts').text('');
		$('#hide_predecessor_count').val(predecessor_name_array.length);
		for(i=0;i<predecessor_name_array.length;i++)
		{
			predecessor_name = predecessor_name_array[i];
			predecessor_array = predecessor_name.split(" -- "); 
			if(predecessor_type_array[i] == 'Finish to Start')
			{
				predecessor_date = predecessor_array[2].toString();
				//preds_date = new Date(predecessor_date);
				new_end_date = get_date_add(predecessor_date,predecessor_lag_array[i],'Finish to Start');
				new_end_date = $('#pred_manipulated_output').val();
				dates.push(new Date(new_end_date));
				predecessor_date_array[i] = predecessor_array[2];
				
			}
			else if(predecessor_type_array[i] == 'Start to Start')
			{
				predecessor_date = predecessor_array[1];
				//alert(predecessor_date);
				//preds_date = new Date(predecessor_date);
				
				if(predecessor_lag_array[i] != '' && predecessor_lag_array[i]>0)
				{
					new_end_date = get_date_add(predecessor_date,predecessor_lag_array[i],'Start to Start');
					new_end_date = $('#pred_manipulated_output').val();
				}
				else
				{
					new_end_date = predecessor_date;
				}	
				dates.push(new Date(new_end_date));
				predecessor_date_array[i] = predecessor_array[1];
			}	
		}
		if(calledfrom == 'find_date_interval')
		{
			i = 0;
			$('input[name^=lag]').each(function() {
			// code
				if($('#start_date').val() != '' && predecessor_date_array[i]!='')
				{
					$.when(find_date_interval('get_duration_pred_call',predecessor_date_array[i],$('#start_date').val(),0)).done(function(){
						if($('#start_date').val()<predecessor_date_array[i])
						{
							diffDays = $('#pred_manipulated_output').val();
						}
						else
						{
							diffDays = $('#pred_manipulated_output').val();
						}	
					});
				}
				$(this).val(parseInt(diffDays));
				i++;
				/* new_date = new Date($('#start_date').val());
				pred_date = new Date(predecessor_date_array[i]);
				timeDiff = Math.abs(new_date.getTime() - pred_date.getTime());
				diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))-1; 
				i++;
				if(Math.abs(new_date.getTime()) < Math.abs(pred_date.getTime()))
				{
					$(this).val(parseInt(-diffDays));
				}
				else
				{
					$(this).val(parseInt(diffDays));
				}	 */
			});	
			return true;
		}
		
		maxDate = new Date(Math.max.apply(null,dates));
		maxDate.setDate(maxDate.getDate());
		if(maxDate.getMonth()<=8)
		{
			var month = Number(maxDate.getMonth()+1);
			end_date = end_date+'0'+month+'/';
		}
		else
		{
			var month = Number(maxDate.getMonth()+1);
			end_date = end_date+month+'/';
		}
		if(maxDate.getDate()<=9)
		{
			end_date = end_date+'0'+maxDate.getDate()+'/';
		}
		else
		{
			end_date = end_date+maxDate.getDate()+'/';
		}
		end_date = end_date+maxDate.getFullYear();
		
		if(end_date != '' && end_date != 'NaN/NaN/NaN')
		{
			$('#start_date').val(end_date);
		}
		else
		{
			return false;
		}	
	}
	if($('#no_of_days').val()!='' && end_date != '')
	{
		find_date_interval('get_end_date',end_date,'',$('#no_of_days').val());
		i = 0;
		$('input[name^=lag]').each(function() {
		// code
			if($('#start_date').val() != '' && predecessor_date_array[i]!='')
			{
				/* $.when(find_date_interval('get_duration_pred_call',predecessor_date_array[i],$('#start_date').val(),0)).done(function(){
					diffDays = $('#pred_manipulated_output').val();
				}); */
			}
			if(predecessor_type_array[i] == 'Start to Start')
			{
				//$(this).val(parseInt(diffDays-1));
			}
			else
			{
				//$(this).val(parseInt(diffDays-2));
			}	
			i++;
			
/* 			new_date = new Date($('#start_date').val());
			pred_date = new Date(predecessor_date_array[i]);
			timeDiff = Math.abs(new_date.getTime() - pred_date.getTime());
			diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))-1; 
			i++;

			if(Math.abs(new_date.getTime()) < Math.abs(pred_date.getTime()))
			{
				$(this).val(parseInt(-diffDays));
			}
			else
			{
				$(this).val(parseInt(diffDays));
			}
 */			
		});	
	}
	else
	{
		return false;
	}	
	return true;
}
 
function update_result_form(){	
	$('#save_schedule').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#save_and_new, #save_and_stay, #save_and_back'			
        },
        fields: {
            'title': {
                validators: {
                    notEmpty: {
                        message: 'Schedule Title cannot be empty'
                    }
                }
            },
			'start_date': {
                validators: {
					notEmpty: {
						 message: 'Schedule Start Date cannot be empty'
					},
                    date: {
                        format: 'MM/DD/YYYY',
						max: 'end_date',
                        message: 'Schedule Start Date is not valid'
                    }
                }
            },
			 'no_of_days': {
                validators: {
                    notEmpty: {
                        message: 'Schedule Duration cannot be empty'
                    }
                }
            },
			'end_date': {
                validators: {
					notEmpty: {
						 message: 'Schedule End Date cannot be empty'
					},
                    date: {
                        format: 'MM/DD/YYYY',
						min: 'start_date',
                        message: 'Schedule End Date is not valid'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);    
			if (data.field === 'start_date' && !data.fv.isValidField('end_date')) {
                // We need to revalidate the end date
                data.fv.revalidateField('end_date');
            }

            if (data.field === 'end_date' && !data.fv.isValidField('start_date')) {
                // We need to revalidate the start date
                data.fv.revalidateField('start_date');
            }			 
      }).on('success.form.fv', function(e) {
		  
			//add_schedule_form();
			e.preventDefault();				
	  });	
 	$('#datetimepicker3').on('dp.change dp.show', function(e) {		
        $('#save_schedule').formValidation('revalidateField', 'start_date');
    });
	$('#datetimepicker4').on('dp.change dp.show', function(e) {		
        $('#save_schedule').formValidation('revalidateField', 'end_date');
    });
	$(document).on('click','.glyphicon.glyphicon-remove', function(e) {		
        $('#save_schedule').formValidation('revalidateField', 'start_date');
    });
	$(document).on('click','.glyphicon.glyphicon-remove', function(e) {		
        $('#save_schedule').formValidation('revalidateField', 'end_date');
    });
}

$(function(){
$('.spinner .btn:first-of-type').on('click', function() {	
	var spinner_first = $(this).parent().parent('.spinner').find('.Lag'); 	
	$(spinner_first).val( parseInt($(spinner_first).val(), 10) + 1);
	validate_predecessor('pred_lag');		
});
$('.spinner .btn:last-of-type').on('click', function() {	
	var spinner_last = $(this).parent().parent('.spinner').find('.Lag'); 	
	$(spinner_last).val( parseInt($(spinner_last).val(), 0) - 1);
	validate_predecessor('pred_lag');	
});
/* Duration */
$('.spinner .dur:first-of-type').on('click', function() {	
	var spinner_first = $(this).parent().parent('.spinner').find('.Duration'); 	
	$(spinner_first).val( parseInt($(spinner_first).val(), 10) + 1);
	find_date_interval('get_end_date',$('#start_date').val(),$('#end_date').val(),$('#no_of_days').val());

});
$('.spinner .dur:last-of-type').on('click', function() {	
	var spinner_last = $(this).parent().parent('.spinner').find('.Duration'); 			
	$(spinner_last).val( parseInt($(spinner_last).val(), 0) -1);	
	/* 	if($(spinner_last).val() > 0){
	} */
	find_date_interval('get_end_date',$('#start_date').val(),$('#end_date').val(),$('#no_of_days').val());	
});
/* /Duration */
});