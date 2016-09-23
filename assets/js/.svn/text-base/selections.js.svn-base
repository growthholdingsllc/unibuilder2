$(function() {
	 //update_result_form();
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
  $(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
	$('.error-message').hide();
  });
});
$(function() {
	default_pagination_length = $('#categoty_iDisplayLength').val();
    displayStart = $('#categoty_iDisplayStart').val();
    //alert(displayStart);
	selections_category();
	 $(document).on( 'click', 'a[href="#Category"]', function (e) {

	 	$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");
        default_pagination_length = $('#categoty_iDisplayLength').val();
		displayStart = $('#categoty_iDisplayStart').val();

		selections_category();
	 });
	 $(document).on( 'click', 'a[href="#Location"]', function (e) {

	 	$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");
        default_pagination_length = $('#location_iDisplayLength').val();
		displayStart = $('#location_iDisplayStart').val();

		selections_location();
	 });
	 $(document).on( 'click', 'a[href="#List"]', function (e) {

	 	$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");
        default_pagination_length = $('#list_iDisplayLength').val();
		displayStart = $('#list_iDisplayStart').val();

		selections_list();
	 });
	var url = window.location.href;
	var hash_tag = url.substring(url.indexOf("#"));	
		if (hash_tag == "#Category")
		{
			default_pagination_length = $('#categoty_iDisplayLength').val();
		    displayStart = $('#categoty_iDisplayStart').val();

			selections_category();
		}
		if (hash_tag == "#Location")
		{
			default_pagination_length = $('#location_iDisplayLength').val();
		    displayStart = $('#location_iDisplayStart').val();

			selections_location();			
		}
		if (hash_tag == "#List")
		{
			default_pagination_length = $('#list_iDisplayLength').val();
		    displayStart = $('#list_iDisplayStart').val();

			selections_list();
		}
		if((!hash_tag))
		{
			default_pagination_length = $('#categoty_iDisplayLength').val();
		    displayStart = $('#categoty_iDisplayStart').val();

			selections_category();
		}
		
//update_result_form();
if (typeof list_page != 'undefined') 
{
	
}
// Category_Locations Data table child node on click 
$('#Category_Locations tbody').on('click', 'td.details-control1', function() {
	$(this).parent().nextUntil('.group').toggle();
	var table1 = $(Category_Locations).DataTable();
	var tr = $(this).closest('tr');
	var row = table1.row(tr);
	tr.toggleClass('shown');
});
// Category_Locations Data table parent node on click 
$('#Category_Locations tbody').on('click', 'td.details-control', function() {
	var table = $('#Category_Locations').DataTable();
	var tr = $(this).closest('tr');
	var row = table.row(tr);
	if (row.child.isShown()) {
		row.child.hide();
		tr.removeClass('shown');
	} else {
		row.child(format_Locations(row.data())).show();
		tr.addClass('shown');
	}
});
// Category_Selections Data table parent node on click 
$('#Category_Selections tbody').on('click', 'td.details-control', function() {
	var table = $('#Category_Selections').DataTable();
	var tr = $(this).closest('tr');
	var row = table.row(tr);
	if (row.child.isShown()) {
		row.child.hide();
		tr.removeClass('shown');
	} else {
		row.child(format_Selections(row.data())).show();
		tr.addClass('shown');
	}
});
// Category_Selections Data table child node on click 
$('#Category_Selections tbody').on('click', 'td.details-control1', function() {
	$(this).parent().nextUntil('.group').toggle();
	var table1 = $(Category_Selections).DataTable();
	var tr = $(this).closest('tr');
	var row = table1.row(tr);
	tr.toggleClass('shown');
});
 //Update result
$('#update_result').click(function(e){
	if('.tab-con li.active'){		
		$tab_href = $('.tab-con li.active a').attr('href');		
	}
	if($tab_href == '#Category')
	{
		selections_category();		
	}
	if($tab_href == '#Location'){
		selections_location();		
	}
	if($tab_href == '#List'){
		selections_list();		
	}
	$('.error-message').hide();
	e.preventDefault();   	
});
//Data table code for List tab in selection landing page
});

$('#selections_search_reset').on('click', function(e) {				
	reset_function();
	e.preventDefault();
});
function reset_function(){
	if('.tab-con li.active'){		
		$tab_href = $('.tab-con li.active a').attr('href');		
	}
	var encoded_destroy_session = Base64.encode('selections/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	var role_index = Base64.encode('selections/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"SELECTION","destroy_type":["SEARCH"]},			
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
		success: function(response) {		
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url+$tab_href;
				location.reload(true);				
				success_box();
				$('.error-message .alerts').text('Reset successfully');
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Reset failed');
			}
		}
	});	
}
// Save Filter
$('#save_filter').on('click', function(e) {
	var status 			= $('#status').val();
	var vendors 		= $('#vendors').val();
	var title 			= $('#title').val();
	var location 		= $('#location').val();
	var category 		= $('#category').val();
	var daterange 		= $('#daterange').val();
	var coordinators 	= $('#coordinators').val();
	if((!status) && (!vendors) && (!title) && (!location) && (!category) && (!daterange) && (!coordinators))
		{
			error_box();
			$('.error-message .alerts').text('Please select one mandatory field');	
			return false;
		}
		else{
			save_filter_function();
			e.preventDefault();
		}
		
});
function save_filter_function(){	
	var status = $('#status').val();
	var vendors = $('#vendors').val();
	var title = $('#title').val();
	var location = $('#location').val();
	var category = $('#category').val();
	var daterange = $('#daterange').val();
	var coordinators = $('#coordinators').val();
	var encoded_url = Base64.encode('selections/apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);	
	var data = 'status='+status+'&vendors='+vendors+'&title='+title+'&location='+location+'&category='+category+'&coordinators='+coordinators+ '&daterange='+daterange;		
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
				$("#apply_save_filter").show();				
				success_box();
				$('.error-message .alerts').text('Saved Successfully');
			}
			else{
				error_box();
				$('.error-message .alerts').text('Save filter failed');
			}
		}
	});
}


//Apply Filter
$('#apply_save_filter').on('click',function() {
// alert(apply_save_filter);
		var encoded_url = Base64.encode('selections/apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('selections/index/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
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
				 window.location.href= base_url + ajax_encoded_urls;
				 success_box();
				$('.error-message .alerts').text('Applied Filter Successfully');	
			}
			else{
				error_box();
				$('.error-message .alerts').text('Applied filter failed');	
			}
		}
	});	
		//$.post(baseurl+ajax_encoded_url,'POST',function(res) {
			
});

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
	
	var encoded_url = Base64.encode('selections/import_selections/');
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

function selections_list() 
{
	var status = $('#status').val();
	var vendors = $('#vendors').val();
	var title = $('#title').val();
	var location = $('#location').val();
	var categories = $('#category').val();
	var daterange = $('#daterange').val();
	var tab_type = 'list';
	var encoded_url = Base64.encode('selections/get_selections/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var dbobject = {
		'tableName': $('#Selection_List'),
		'ajax_encoded_url':ajax_encoded_url,
		'this_table' : {'table_name':'Selection_List'},
		'id':'ub_selection_id',
		'name' : 'title',
		'status_val':'status',
		'status':{'index':8},
		'post_data':'{"status":"'+status+'", "vendors":"'+vendors+'","title":"'+title+'","location":"'+location+'","categories":"'+categories+'","daterange":"'+daterange+'","tab_type":"'+tab_type+'"}',
		 'delete_data':{},  
		'edit_data':{'index':0, 'url':'selections/save_selection/'},
		'display_columns' : [{"data":"title"},{"data":"category"},{"data":"location"},{"data":"choice_title"},{"data":"allowance"},{"data":"owner_price", "bSortable": false},{"data":"difference", "bSortable": false},{"data":"due_date_time"},{"data":"status"}],
		// 'default_order_by': [[1, 'desc']]
	};
	// Populate data table
	ubdatatable(dbobject);
	$('#Selection_List').on( 'click', 'a.editor_remove', function (e) 
	{
	  var selection_id = $(this).attr('id');
	  delete_project({'ub_selection_id':{selection_id:selection_id}});
	}); 
}
//Data table code for Location tab in selection landing page
function selections_location() 
{
	var status = $('#status').val();
	var vendors = $('#vendors').val();
	var title = $('#title').val();
	var location = $('#location').val();
	var categories = $('#category').val();
	var daterange = $('#daterange').val();
	var tab_type = 'location';
	var encoded_url = Base64.encode('selections/get_selections/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
		'tableName': $('#Category_Locations'),
		'ajax_encoded_url':ajax_encoded_url,
		'this_table' : {'table_name':'Category_Locations'},
		'id':'ub_selection_id',
		'name' : 'title',
		'status_val':'status',
		'status':{'index':8},
		'group_by_name' : 'title',
		'edit_data':{'index':1, 'url':'selections/save_selection/'},
		'post_data':'{"status":"'+status+'", "vendors":"'+vendors+'","title":"'+title+'","location":"'+location+'","categories":"'+categories+'","daterange":"'+daterange+'","tab_type":"'+tab_type+'"}',
		'display_columns' : [{"orderable": false,"data": null,"defaultContent": '',"sClass": "details-control"},{"data": "title"},{"data": "category"},{"data":"location"},{"data": "choice_title"},{"data": "owner_price", "bSortable": false}, {"data": "difference", "bSortable": false}, 
		{"data": "due_date_time"}, {"data": "status"}],
		// 'default_order_by': [[4, 'desc']]
	};
	// Populate data table
	ubdatatable_tree(dbobject);
}
//Data table code for Category tab in selection landing page
function selections_category() 
{
	var status = $('#status').val();
	var vendors = $('#vendors').val();
	var title = $('#title').val();
	var location = $('#location').val();
	var categories = $('#category').val();
	var daterange = $('#daterange').val();
	var tab_type = 'category';
	var encoded_url = Base64.encode('selections/get_selections/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
		'tableName': $('#Category_Selections'),
		'ajax_encoded_url':ajax_encoded_url,
		'this_table' : {'table_name':'Category_Selections'},
		'id':'ub_selection_id',
		'name' : 'title',
		'status_val':'status',
		'status':{'index':8},
		'group_by_name' : 'title',
		'edit_data':{'index':1, 'url':'selections/save_selection/'},
		'post_data':'{"status":"'+status+'", "vendors":"'+vendors+'","title":"'+title+'","location":"'+location+'","categories":"'+categories+'","daterange":"'+daterange+'","tab_type":"'+tab_type+'"}',
		'display_columns' : [{"orderable": false,"data": null,"defaultContent": '',"sClass": "details-control"},{"data": "title"},{"data":"location"},{"data":"category"},{"data":"choice_title"}, {"data": "owner_price" , "bSortable": false},{"data": "difference", "bSortable": false}, 
		{"data": "due_date_time"}, {"data": "status"}],
		// 'default_order_by': [[4, 'desc']]
	};
	// Populate data table
	ubdatatable_tree(dbobject);
}
// Format location tab child data table
function format_Locations(d) 
{
	var table_html = '<table class="table table-bordered">' +
		'<thead>' +
		'<tr>' +
		'<th>Choice</th>' +
		'<th>Added By</th>' +
		'<th>Details</th>' +
		'<th>Status</th>' +
		// '<th>Files</th>' +
		'<th>Price</th>' +
		'</tr>' +
		'</thead>';
	var append_th = '';	
	if(d.selection_choices.length>0)
	{	
		$.each(d.selection_choices, function(colID,colNAME) {  
		if(d.selection_choices[colID]['status'] == 'Approved')
			{
				var img_src = base_url + 'assets/images/strip.gif';
				d.selection_choices[colID]['status'] = '<img src="'+ img_src +'" class="uni_new" />'+' '+d.selection_choices[colID]['status'];
				
			}
			if(d.selection_choices[colID]['status'] == 'Pending')
			{
				var img_src = base_url + 'assets/images/strip.gif';
				d.selection_choices[colID]['status'] = '<img src="'+ img_src +'" class="uni_pending" />'+' '+d.selection_choices[colID]['status'];
				
			}                  
			append_th = append_th + '<tr><td>' + d.selection_choices[colID]['choice_title'] +'</td>'+
			'<td>' + d.selection_choices[colID]['creator'] + '</td>' +
			'<td>' + d.selection_choices[colID]['description'] + '</td>' +
			'<td>' + d.selection_choices[colID]['status'] + '</td>' +
			// '<td>' + d.selection_choices[colID]['choice_title'] + '</td>' + 
			'<td>'+'$ ' + d.selection_choices[colID]['owner_price'] + '</td></tr>';
		});	 
	}
	else
	{
		append_th = append_th + '<tr><td>No Records</td><tr>';
	}
	table_html = table_html + append_th + '</table>';
	return table_html;
}
// Format category tab child data table
function format_Selections(d) 
{
	var table_html = '<table class="table table-bordered">' +
		'<thead>' +
		'<tr>' +
		'<th>Choice</th>' +
		'<th>Added By</th>' +
		'<th>Details</th>' +
		'<th>Status</th>' +
		// '<th>Files</th>' +
		'<th>Price</th>' +
		'</tr>' +
		'</thead>';
	var append_th = '';	
	if(d.selection_choices.length>0)
	{		
		$.each(d.selection_choices, function(colID,colNAME) {
			if(d.selection_choices[colID]['status'] == 'Approved')
			{
				var img_src = base_url + 'assets/images/strip.gif';
				d.selection_choices[colID]['status'] = '<img src="'+ img_src +'" class="uni_new" />'+' '+d.selection_choices[colID]['status'];
				
			}
			if(d.selection_choices[colID]['status'] == 'Pending')
			{
				var img_src = base_url + 'assets/images/strip.gif';
				d.selection_choices[colID]['status'] = '<img src="'+ img_src +'" class="uni_pending" />'+' '+d.selection_choices[colID]['status'];
				
			}
			                   
			append_th = append_th + '<tr><td>' + d.selection_choices[colID]['choice_title'] + '</td>'+
			'<td>' + d.selection_choices[colID]['creator'] + '</td>' +
			'<td>' + d.selection_choices[colID]['description'] + '</td>' +
			'<td>' + d.selection_choices[colID]['status'] + '</td>' +
			// '<td>' + d.selection_choices[colID]['choice_title'] + '</td>' + 
			'<td>'+'$ ' + d.selection_choices[colID]['owner_price'] + '</td></tr>';
		});
	}
	else
	{
		append_th = append_th + '<tr><td>No Records</td><tr>';
	}		
	table_html = table_html + append_th + '</table>';	
	return table_html;
}

