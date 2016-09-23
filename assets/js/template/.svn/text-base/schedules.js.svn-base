//imgLink = base_url + 'assets/images/'; 
/* Schedule */
/* calendar listview */
/* line number 8 was added by chandru for baseline list 14-05-2014 */
    $(function() {
	var url = window.location.href;
	var hash = url.substring(url.indexOf("#"));
		if (hash == "#phaselist")
		{
			$('#current_tab').val("phaselist");
			$('.primary_filt').addClass('show');
			$('.date_range_filt').addClass('show');
			$('.event_filter').addClass('hide');
			$('.workdays_filter').addClass('hide');
			$('.phase_filt').addClass('hide');
		}
		if (hash == "#workdays")
		{
			$('#current_tab').val("workdays");
			$('.primary_filt').addClass('hide');
			$('.phase_filt').addClass('hide');
			$('.date_range_filt').addClass('hide');
			$('.event_filter').addClass('hide');
			$('.workdays_filter').addClass('show');
		}
		if (hash == "#baselineview")
		{
			$('#current_tab').val("baselineview");
			$('.primary_filt').addClass('show');
			$('.phase_filt').addClass('show');
			$('.date_range_filt').addClass('show');
			$('.event_filter').addClass('hide');
			$('.workdays_filter').addClass('hide');
		}
		if (hash == "#Gantt")
		{
			$('#current_tab').val("Gantt");
			$('.primary_filt').addClass('show');
			$('.phase_filt').addClass('show');
			$('.date_range_filt').addClass('show');
			$('.event_filter').addClass('hide');
			$('.workdays_filter').addClass('hide');
			// gantt_chart();
		}
		if (hash == "#listview")
		{
			$('#current_tab').val("listview");
			$('.primary_filt').addClass('show');
			$('.phase_filt').addClass('show');
			$('.date_range_filt').addClass('show');
			$('.event_filter').addClass('show');
			$('.workdays_filter').addClass('hide');
		}
		if (hash == "#Full_Calendar")
		{
			$('#current_tab').val("Full_Calendar");
			$('.primary_filt').addClass('show');
			$('.phase_filt').addClass('show');
			$('.date_range_filt').addClass('hide');
			$('.event_filter').addClass('hide');
			$('.workdays_filter').addClass('hide');
		}
		//update_result_form();
		//role access checked by satheesh kumar
		if (user_account_type == 100)
		{
			if($('#current_tab').val() == "listview")
			{
				schedule_listview();
			}else if($('#current_tab').val() == "workdays"){
				// workdays_exception();
			}else if($('#current_tab').val() == "baselineview"){
				// baseline_listview();
			}else if($('#current_tab').val() == "phaselist"){
				// get_phase_list();
			}else if($('#current_tab').val() == "Full_Calendar"){
				$('#calendar').empty();
				// runFullCalendar();
			}
		}
		else
		{
			 if($('#current_tab').val() == "Full_Calendar"){
					$('#calendar').empty();
					// runFullCalendar();
			}
		}
		/* $('.tab-con ul.nav li a').click(function(){			
			update_result_form();
		}); */
		//gantt_chart();
		$('a[href = "#Gantt"]').click(function(e){	
	      // gantt_chart();
        });
    });

	$('#update_result').click(function(e){
			if (user_account_type == 100)
			{				
				if($('#current_tab').val() == "listview")
				{
					schedule_listview();
				}else if($('#current_tab').val() == "workdays"){
					// workdays_exception();
				}else if($('#current_tab').val() == "baselineview"){
					// baseline_listview();
				}else if($('#current_tab').val() == "phaselist"){
					// get_phase_list();
				}
			}
			/* if($('#current_tab').val() == "Full_Calendar")
			{
				$('#calendar').empty();
				runFullCalendar();				
			} */
			if($('#current_tab').val() == "Gantt")
			{
				// gantt_chart();			
			}
			$('.error-message').hide();
			e.preventDefault();
	    
	});
function gantt_chart(){ 
	var encoded_gantt_string = Base64.encode('schedules/get_schedules_gantt/') ;
	var encoded_gantt_val = encoded_gantt_string.strtr(encode_chars_obj);
    var assignedto = $('#assigned_users').val();
	var status  = $('#status').val();
	var tags    = $('#tags').val();
	var phase   = $('#phase').val();
	var daterange =  $('#list_date_range').val();
    var encoded_home_string = Base64.encode('schedules/get_schedules_calender/') ;
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 
    var ajaxdata = 'tags='+tags+'&assignedto='+assignedto+'&phase='+phase+'&status='+status+'&daterange='+ daterange ;	
	gantt.attachEvent("onBeforeLightbox", function(id) {
		return false; //denies edit popup
	});
	gantt.attachEvent("onBeforeTaskDrag", function(id, mode, e){
		return false;      //denies dragging 
	});
	$.ajax({
		url: base_url + encoded_gantt_val,
		dataType: "json",
		type: "post",
        data: ajaxdata,		
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			 
        },
		success: function(response) {
			 $('.uni_wrapper').removeClass('loadingDiv');
			
			var tasks =  {   
		
				data: response.schedule_list,			
				links:response.link_to
			};
			gantt.init("gantt_here");
			gantt.parse(tasks);
			gantt.clearAll(); 
			//console.log(tasks);
			gantt.config.work_time = true;
			gantt.setWorkTime({ day:7, hours:true }); 
			gantt.config.drag_links = false;
			gantt.config.columns=[
				{name:"project_name",label:"Project", tree:true, width:100 },	 
				{name:"text",       label:"Schedule", align: "center", width:150  },
				{name:"start_date", label:"Start Date", align: "center", width:80 },
				{name:"end_date", label:"End Date", align: "center", width:80 },
				{name:"duration",   label:"Duration",   align: "center", width:80 },
				{name:"assignedto",   label:"Assignto",   align: "center", width:100 }
			];
			gantt.templates.tooltip_text = function(start,end,task,duration,assignedto){
				return "<b>Task:</b> "+task.text+"<br/><b>Start date:</b> " + 
				gantt.templates.tooltip_date_format(start)+ 
				"<br/><b>End date:</b> "+gantt.templates.tooltip_date_format(end)+ 
				"<br/><b>Duration:</b> "+task.duration+"<br/><b>Assignto:</b> "+task.assignedto;
			};
			
			gantt.init("gantt_here");
			
			gantt.parse(tasks);
		}
	});	
}	
function schedule_listview(calltype) {
        var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
		// var assignedto = $('#assigned_users').val();
	    var schdule_status  = $('#status').val();
	    var tags      = $('#tags').val();
	    var phase     = $('#phase').val();
		var daterange = $('#list_date_range').val();
		var event     = $('#event').val();
		
		// return false;
		// Ajax URL
		var encoded_url = Base64.encode('template/schedules/get_schedules/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(ajax_encoded_url);
		
		var dbobject = {					
							'tableName': $('#schedule_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_template_schedule_id',
							'name': 'title',
							'this_table' : {'table_name':'schedule_list'},
							'post_data':'{"schdule_status":"'+  schdule_status+'", "tags":"'+tags+'","phase":"'+phase+'", "daterange":"'+daterange+'","event":"'+event+'"}',
							'delete_data':'', 
							'edit_data':{'index':0, 'url':'template/schedules/save_schedule/'},
							'display_columns' : [
							{"data": "title"},{"data": "schedule_status","bSortable": false},{"data": "phase"},
							{"data": "start_date"},{"data": "end_date"},{"data": "assigned_users", "bSortable": false}
							],
							'default_order_by': [[0, 'desc']]
						};
		// Populate data table
		ubdatatable(dbobject);
	}
	
	/* Below function was added by chandru for list baseline 14-05-2014 */
	function baseline_listview() {
		var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
		var assignedto = $('#assigned_users').val();
	    var schdule_status  = $('#status').val();
	    var tags      = $('#tags').val();
	    var phase     = $('#phase').val();
		var daterange = $('#list_date_range').val();
		var encoded_url = Base64.encode('schedules/get_schedules_baseline/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var dbobject = {
							'tableName': $('#Calendar_Baselineview'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_schedule_id',
							'name':'title',
							'is_completed':'is_completed',
							'status':{'index':1},
							'basedays':'basedays',
							'no_of_days':{'index':2},
							'baseline_start_date':'baseline_start_date',
							'actual_start_date':{'index':3},
							'baseline_end_date':'baseline_end_date',
							'actual_end_date':{'index':4},
							'this_table' : {'table_name':'Calendar_Baselineview'},
							'post_data':'{"assignedto":"'+assignedto+'","schdule_status":"'+  schdule_status+'", "tags":"'+tags+'","phase":"'+phase+'", "daterange":"'+daterange+'"}',
							'delete_data':{},  
							'edit_data':{'index':0, 'url':'schedules/save_schedule/'},
							'display_columns' : [{"data": "title"},{"data": "is_completed",},{"data": "no_of_days"},
							{"data": "actual_start_date"},{"data": "actual_end_date"},{"data": "direct_shifts"},{"data": "duration_change"},{"data": "slip_days"},{"data": "assignedto"}],
							'default_order_by': [[1, 'asc']]
						};
		ubdatatable(dbobject);
	}


/* calendar workdays */
function workdays_exception() {
       var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	   	var exception_type      = $('#exception_type').val();
		var workdays_category  = $('#workdays_category').val();
		// return false;
		// Ajax URL
		var encoded_url = Base64.encode('schedules/get_work_day_exception/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(ajax_encoded_url);
		
		var dbobject = {					
							'tableName': $('#workdays_exception'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_workday_exception_id',
							'name': 'title',
							'exception_type':'exception_type',
							'totaldays':'totaldays',
							'this_table' : {'table_name':'workdays_exception'},
						    'post_data':'{"exception_type":"'+exception_type+'","workdays_category":"'+workdays_category+'"}',
							'delete_data':'', 
							'edit_data':{'index':0, 'url':'schedules/save_work_day_exception/'},
							'days':{'index':3},
							'type':{'index':4},
							'display_columns' : [{"data": "title"},{"data": "start_date"},
							{"data": "end_date"},{"data": "totaldays"},{"data": "exception_type"},
							{"data": "category"},{"data": "same_every_year"}],
							'default_order_by': [[0, 'desc']]
						};

		// Populate data table
		ubdatatable(dbobject);
	
	}
  


$(function(){
	$('.workdays_filter').hide();
	$('a[href = "#Full_Calendar"]').click(function(){
		$('.error-message').hide();
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("Full_Calendar");
		if($('#previous_tab').val() != $('#current_tab').val())
		{
			$('#calendar').empty();
			runFullCalendar();
		}
		$('.primary_filt').show();
		$('.phase_filt').show();
		$('.date_range_filt').hide();
		$('.event_filter').hide();
		$('.workdays_filter').hide();
		
		$('.primary_filt').removeClass('show');
		$('.primary_filt').removeClass('hide');
		$('.date_range_filt').removeClass('show');
		$('.date_range_filt').removeClass('hide');
		$('.event_filter').removeClass('hide');
		$('.event_filter').removeClass('show');
		$('.workdays_filter').removeClass('hide');
		$('.workdays_filter').removeClass('show');
		$('.phase_filt').removeClass('hide');
		$('.phase_filt').removeClass('show');
		
	});
	$('a[href = "#listview"]').click(function(){
		$('.error-message').hide();
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("listview");
		if($('#previous_tab').val() != $('#current_tab').val())
		{
			schedule_listview();
		}
		$('.primary_filt').show();
		$('.phase_filt').show();
		$('.date_range_filt').show();
		$('.event_filter').show();
		$('.workdays_filter').hide();
		
		$('.primary_filt').removeClass('show');
		$('.primary_filt').removeClass('hide');
		$('.date_range_filt').removeClass('show');
		$('.date_range_filt').removeClass('hide');
		$('.event_filter').removeClass('hide');
		$('.event_filter').removeClass('show');
		$('.workdays_filter').removeClass('hide');
		$('.workdays_filter').removeClass('show');
		$('.phase_filt').removeClass('hide');
		$('.phase_filt').removeClass('show');
				
	});
	$('a[href = "#Gantt"]').click(function(){
		$('.error-message').hide();
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("Gantt");
		$('.primary_filt').show();
		$('.phase_filt').show();
		$('.date_range_filt').show();
		$('.event_filter').hide();	
		$('.workdays_filter').hide();	
		
		$('.primary_filt').removeClass('show');
		$('.primary_filt').removeClass('hide');
		$('.date_range_filt').removeClass('show');
		$('.date_range_filt').removeClass('hide');
		$('.event_filter').removeClass('hide');
		$('.event_filter').removeClass('show');
		$('.workdays_filter').removeClass('hide');
		$('.workdays_filter').removeClass('show');
		$('.phase_filt').removeClass('hide');
		$('.phase_filt').removeClass('show');
	});
	$('a[href = "#baselineview"]').click(function(){
		$('.error-message').hide();
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("baselineview");
		if($('#previous_tab').val() != $('#current_tab').val())
		{
			baseline_listview();
		}
		$('.primary_filt').show();	
		$('.phase_filt').show();		
		$('.date_range_filt').show();
		$('.event_filter').hide();	
		$('.workdays_filter').hide();	
		
		$('.primary_filt').removeClass('show');
		$('.primary_filt').removeClass('hide');
		$('.date_range_filt').removeClass('show');
		$('.date_range_filt').removeClass('hide');
		$('.event_filter').removeClass('hide');
		$('.event_filter').removeClass('show');
		$('.workdays_filter').removeClass('hide');
		$('.workdays_filter').removeClass('show');
		$('.phase_filt').removeClass('hide');
		$('.phase_filt').removeClass('show');
	});
	$('a[href = "#workdays"]').click(function(){
		$('.error-message').hide();
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("workdays");
		if($('#previous_tab').val() != $('#current_tab').val())
		{
			workdays_exception();
		}
		$('.primary_filt').hide();	
		$('.workdays_filter').show();
		$('.event_filter').hide();
		$('.primary_filt').hide();
		$('.date_range_filt').hide();
		
		$('.primary_filt').removeClass('show');
		$('.primary_filt').removeClass('hide');
		$('.date_range_filt').removeClass('show');
		$('.date_range_filt').removeClass('hide');
		$('.event_filter').removeClass('hide');
		$('.event_filter').removeClass('show');
		$('.workdays_filter').removeClass('hide');
		$('.workdays_filter').removeClass('show');
		$('.phase_filt').removeClass('hide');
		$('.phase_filt').removeClass('show');
			
	});
	$('a[href = "#phaselist"]').click(function(){
		$('.error-message').hide();		
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("phaselist");
		if($('#previous_tab').val() != $('#current_tab').val())
		{
			get_phase_list();
		}
		$('.primary_filt').show();
		$('.date_range_filt').show();
		$('.event_filter').hide();
		$('.phase_filt').hide();
		$('.workdays_filter').hide();
		
		$('.primary_filt').removeClass('show');
		$('.primary_filt').removeClass('hide');
		$('.date_range_filt').removeClass('show');
		$('.date_range_filt').removeClass('hide');
		$('.event_filter').removeClass('hide');
		$('.event_filter').removeClass('show');
		$('.workdays_filter').removeClass('hide');
		$('.workdays_filter').removeClass('show');
		$('.phase_filt').removeClass('hide');
		$('.phase_filt').removeClass('show');
		
	});
	
});
/* /Schedule Tabs */
//Data table code for phaselist tab in schedule landing page
// Category_Locations Data table child node on click 
$('#calendar_phaselist tbody').on('click', 'td.details-control1', function() {
	$(this).parent().nextUntil('.group').toggle();
	var table1 = $(calendar_phaselist).DataTable();
	var tr = $(this).closest('tr');
	var row = table1.row(tr);
	tr.toggleClass('shown');
});
// Category_Locations Data table parent node on click 
$('#calendar_phaselist tbody').on('click', 'td.details-control', function() {
	var table = $('#calendar_phaselist').DataTable();
	var tr = $(this).closest('tr');
	var row = table.row(tr);
	if (row.child.isShown()) {
		row.child.hide();
		tr.removeClass('shown');
	} else {
		row.child(format_phase_list(row.data())).show();
		tr.addClass('shown');
	}
});
function get_phase_list(){
// alert(get_bidpackage);
    var assignedto = $('#assigned_users').val();
    var status = $('#status').val();
    var tags = $('#tags').val();
    var daterange = $('#list_date_range').val();
	var encoded_url = Base64.encode('schedules/get_schedules_phase_list/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);

	// Data table Object	
	var dbobject = {
		'tableName': $('#calendar_phaselist'),
		'ajax_encoded_url':ajax_encoded_url,
		'id':'ub_schedule_id',
		'name' : 'phase',
		'post_data':'{}',
		'group_by_name' : 'phase',
		'post_data':'{"phase":"'+phase+'","assignedto":"'+assignedto+'","status":"'+status+'", "tags":"'+tags+'","daterange":"'+daterange+'"}',
		'display_columns' : [{"orderable": false,"data": null,"defaultContent": '',"sClass": "details-control"},{"data": "phase"},{"data":"start_date"},{"data":"end_date"},{"data": "associated_items"},{"data": "completed_items"},{"data":"is_completed"}],
		'default_order_by': [[1,'asc']]
	};
	// Populate data table
	ubdatatable_tree(dbobject);
}
// Format location tab child data table
function format_phase_list(d) 
{
	var table_html = '<table class="table table-bordered">' +
		'<thead>' +
		'<tr>' +
		'<th>Schedule Item Name</th>' +
		'<th>Duration in Days</th>' +
		'<th>Start Date</th>' +
		'<th>Finish Date</th>' +
		'<th>Status</th>' +
		'<th>Assignees</th>' +
		'</tr>' +
		'</thead>';
	var append_th = '';	
	if(d.schedule_items.length>0)
	{	
		var total_amount = 0;
		$.each(d.schedule_items, function(colID,colNAME) {                    
			append_th = append_th + '<tr><td>' + d.schedule_items[colID]['schedule_item_name'] + '</td>'+
			'<td>' + d.schedule_items[colID]['no_of_days'] + '</td>' +
			'<td>' + d.schedule_items[colID]['start_date'] + '</td>' +
			'<td>' + d.schedule_items[colID]['end_date'] + '</td>' + 
			'<td>' + d.schedule_items[colID]['is_completed'] + '</td>' + 
			'<td>' + d.schedule_items[colID]['assigned_users'] + '</td></tr>';
		});	
	}
	else
	{
		append_th = append_th + '<tr><th>No Records</th><tr>';
	}
	table_html = table_html + append_th + '</table>';
	return table_html;
}

$(function() {
  $('.daterange').daterangepicker(null, function(start, end, label) {
	console.log(start.toISOString(), end.toISOString(), label);
  }); 
  
  $('.applyBtn').click(function(){
	  var start = $('input[name="daterangepicker_start"]').val();
	  var end = $('input[name="daterangepicker_end"]').val();
	  var start_end = start + ' - ' + end;
	  $('#list_date_range').val(start_end);
  });
  
  $('.cancelBtn').click(function(){
	   $('#list_date_range').val('');
  });
});


// Save Filter
$('#save_filter').on('click', function(e) {
		if('.tab-con li.active'){		
			$tab_href = $('.tab-con li.active a').attr('href');	
		}
		var assignedto 			= $('#assigned_users').val();
		var status  			= $('#status').val();
		var tags    			= $('#tags').val();
		var phase   			= $('#phase').val();
		var daterange 			= $('#list_date_range').val();
		var event     			= $('#event').val();
		var exception_type      = $('#exception_type').val();
		var workdays_category   = $('#workdays_category').val();
		if($tab_href == "#listview")
		{
			
			if((!assignedto)  && (!status)  && (!tags) && (phase !== 'null') && (!daterange) && (!event))
			{				
				error_box();
				$('.error-message .alerts').text('Please select one mandatory field');	
				return false;
			}
			else{
				save_filter_function();
				e.preventDefault();
			}
		}
		if($tab_href == "#workdays"){
			if((!exception_type) && (!workdays_category))
			{				
				error_box();
				$('.error-message .alerts').text('Please select one mandatory field');	
				return false;
			}
			else{
				save_filter_function();
				e.preventDefault();
			}
		}
		if($tab_href == "#baselineview"){
			if((!assignedto)  && (!status)  && (!tags) && (phase !== 'null') && (!daterange))
			{				
				error_box();
				$('.error-message .alerts').text('Please select one mandatory field');	
				return false;
			}
			else{
				save_filter_function();
				e.preventDefault();
			}
		}
		if($tab_href == "#phaselist"){
			if((!assignedto)  && (!status)  && (!tags) && (!daterange))
			{				
				error_box();
				$('.error-message .alerts').text('Please select one mandatory field');	
				return false;
			}
			else{
				save_filter_function();
				e.preventDefault();
			}
		}		
		if($tab_href == "#Full_Calendar")
		{
			if((!assignedto)  && (!status)  && (!tags) && (phase !== 'null'))
			{				
				error_box();
				$('.error-message .alerts').text('Please select one mandatory field');	
				return false;
			}
			else{
				save_filter_function();
				e.preventDefault();
			}
		}
		if($tab_href == "#Gantt")
		{
			if((!assignedto)  && (!status)  && (!tags) && (phase !== 'null') && (!daterange))
			{				
				error_box();
				$('.error-message .alerts').text('Please select one mandatory field');	
				return false;
			}
			else{
				save_filter_function();
				e.preventDefault();
			}
		}		
});	
function save_filter_function(){
	var assignedto = $('#assigned_users').val();
	var status  = $('#status').val();
	var tags    = $('#tags').val();
	var phase   = $('#phase').val();
	var daterange = $('#list_date_range').val();
	var event     = $('#event').val();
	var exception_type       = $('#exception_type').val();
	var workdays_category    = $('#workdays_category').val();
	var encoded_url = Base64.encode('schedules/apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'assigned_users='+assignedto+'&status='+status+'&tags='+tags+'&phase='+phase+ '&daterange='+daterange+'&event='+event+'&exception_type='+exception_type+'&workdays_category='+workdays_category  ;
	
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },		
		success: function(response) {		
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				//alert(response.message);
				$("#apply_save_filter").show();				
				success_box();
				$('.error-message .alerts').text('saved successfully');
			}
			else{
				error_box();				
				$('.error-message .alerts').text('save filter failed');				
			}
		}
	});
}
//apply filter
$('#apply_filter').on('click',function() {
	if('.tab-con li.active'){		
		$tab_href = $('.tab-con li.active a').attr('href');		
	}
	var encoded_url = Base64.encode('schedules/save_or_apply_schedule_search_filter/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var schdule_index = Base64.encode('schedules/index/');
	var schdule_index_url = schdule_index.strtr(encode_chars_obj);

	$.ajax({
	url: base_url + ajax_encoded_url,
	dataType: "json",
	type: "post",
	beforeSend: function() {
		$('.uni_wrapper').addClass('loadingDiv');
	},	
	success: function(response) {		
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = schdule_index_url+$tab_href;
				location.reload(true);				
				success_box();
				$('.error-message .alerts').text('apllied filter successfully');
			}
			else{
				error_box();
				$('.error-message .alerts').text('apllied filter failed');

			}
		}
	});	
			
});	
$('#schedules_search_reset').on('click', function(e) {		
		if('.tab-con li.active'){		
			$tab_href = $('.tab-con li.active a').attr('href');		
		}		
		reset_function();
		e.preventDefault();		
		
});
function reset_function(){	
	var encoded_destroy_session = Base64.encode('schedules/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	var schedules_index = Base64.encode('schedules/index/');
	var schedules_index_url = schedules_index.strtr(encode_chars_obj);
	var reset_schedule = schedules_index_url+$tab_href
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"SCHEDULES","destroy_type":["SEARCH"]},			
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
		success: function(response) {		
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{					
				window.location.href = reset_schedule;
				location.reload(true);				
				success_box();
				$('.error-message .alerts').text('reset succesfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('reset failed');	
			}
		}
	});
}
/* function update_result_form(){	
	var updateresultform = $('#Search_Result').find('[name="assigned_users[]"], [name="exception_type"]').selectpicker().change(function(e) {         
                $('#Search_Result').formValidation('revalidateField', 'assigned_users[], exception_type');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result, #save_filter'			
        },
        fields: {
            'assigned_users[]': {
                    validators: {
                        callback: {
                            message: 'Please select Assigned',
                            callback: function(value, validator, $field) {                                
                                var options = validator.getFieldElements('assigned_users[]').val();
                                return (options != null);
                            }
                        }
                    }
                }
        },	
		'exception_type': {
                validators: {
                    notEmpty: {
                        message: 'Please select the type'
                    }
                }
        }
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {			
			if($("#schedule_index").val() == 'update_result'){
				//role access checked by satheesh kumar
				if (user_account_type == 100)
				{
				/* alert('success');
				schedule_listview();
				workdays_exception();
				get_phase_list();
				baseline_listview(); *//*
				}
			 }
			else if($("#schedule_index").val() == 'save_filter'){
				save_filter_function();				
			}	
			e.preventDefault();			
	  });		
}
 */
$('#import_button').on('click', function(){	
	if (project_id == '') 
	{			
			$('.side-menu').removeAttr('style');
			$('.side-menu').show();
			$('.arrow-left').css("margin-left") == "250px"
			$('.arrow-left > .glyphicon-chevron-right').hide();
			$('.arrow-left > .glyphicon-chevron-left').show();
			$('.side-menu').animate({"margin-left": '+=250'});
			$('.arrow-left').animate({"margin-left": '+=250'});
			$('.uni_child_wrapper').addClass('disablingDiv');	
			$('.create_project_con').show();					
			$('.arrow-left').addClass('pointer_none');							
	}
	
});

$('#import_template').on('click',function(e){
	var encoded_url = Base64.encode('schedules/import_schedules/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var ajaxData  = $("#import_from_template").serialize();
	//alert(ajaxData);
	$.ajax({
		url: base_url + ajax_encoded_url,
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
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Imported Successfully');
			}
			else
			{
				$('.uni_wrapper').removeClass('loadingDiv');
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('No Template Found. Please create a template.');
			}
		}
	});
});