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
	 $(document).on( 'shown.bs.tab', 'a[href="#Category"]', function (e) {
	 	$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");
	 	default_pagination_length = $('#categoty_iDisplayLength').val();
        displayStart = $('#categoty_iDisplayStart').val();

		selections_category();
	 });
	 $(document).on( 'shown.bs.tab', 'a[href="#Location"]', function (e) {
	 	$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");
	 	default_pagination_length = $('#location_iDisplayLength').val();
		displayStart = $('#location_iDisplayStart').val();
		selections_location();
	 });
	 $(document).on( 'shown.bs.tab', 'a[href="#List"]', function (e) {
	 	$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");
	 	default_pagination_length = $('#list_iDisplayLength').val();
		displayStart = $('#list_iDisplayStart').val();

		selections_list();
	 });
	 var url = window.location.href;
	var hash = url.substring(url.indexOf("#"));
		if (hash == "#Category")
		{
			$.ajaxSetup({cache: false});
            $("#pagination_area").load(location.href + " #pagination_area");
            default_pagination_length = $('#categoty_iDisplayLength').val();
		    displayStart = $('#categoty_iDisplayStart').val();

			selections_category();
		}
		if (hash == "#Location")
		{
			$.ajaxSetup({cache: false});
            $("#pagination_area").load(location.href + " #pagination_area");
            default_pagination_length = $('#location_iDisplayLength').val();
		    displayStart = $('#location_iDisplayStart').val();

			selections_location();
		}
		if (hash == "#List")
		{
			$.ajaxSetup({cache: false});
            $("#pagination_area").load(location.href + " #pagination_area");
            default_pagination_length = $('#list_iDisplayLength').val();
		    displayStart = $('#list_iDisplayStart').val();

			selections_list();
		}
//update_result_form();
if (typeof list_page != 'undefined') 
{
	selections_category();
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
function selections_list() 
{
	var status = $('#status').val();
	var vendors = $('#vendors').val();
	var title = $('#title').val();
	var location = $('#location').val();
	var categories = $('#category').val();
	var daterange = $('#daterange').val();
	var tab_type = 'list';
	var encoded_url = Base64.encode('template/selections/get_selections/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var dbobject = {
		'tableName': $('#Selection_List'),
		'ajax_encoded_url':ajax_encoded_url,
		'id':'ub_template_selection_id',
		'name' : 'title',
		'post_data':'{"status":"'+status+'", "vendors":"'+vendors+'","title":"'+title+'","location":"'+location+'","categories":"'+categories+'","daterange":"'+daterange+'","tab_type":"'+tab_type+'"}',
		'delete_data':{'index':0},  
		'edit_data':{'index':1, 'url':'template/selections/save_selection/'},
		'display_columns' : [{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_selection_id', "defaultContent": '<input type="checkbox" class="chk" />'},{"data":"title"},{"data":
		"category"},{"data":"location"},{"data":"title"},{"data":"allowance"},{"data":"owner_price", "bSortable": false},{"data":"difference", "bSortable": false},{"data":"due_date_time"},{"data":"status"}],
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
	var encoded_url = Base64.encode('template/selections/get_selections/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
		'tableName': $('#Category_Locations'),
		'ajax_encoded_url':ajax_encoded_url,
		'id':'ub_template_selection_id',
		'name' : 'title',
		'group_by_name' : 'title',
		'edit_data':{'index':1, 'url':'template/selections/save_selection/'},
		'post_data':'{"status":"'+status+'", "vendors":"'+vendors+'","title":"'+title+'","location":"'+location+'","categories":"'+categories+'","daterange":"'+daterange+'","tab_type":"'+tab_type+'"}',
		'display_columns' : [{"orderable": false,"data": null,"defaultContent": '',"sClass": "details-control"},{"data": "title"},{"data": "category"},{"data":"location"},{"data": "status"},{"data": "owner_price", "bSortable": false}, {"data": "difference", "bSortable": false}, 
		{"data": "due_date_time"}, {"data": "status"}],
		'default_order_by': [[4, 'desc']]
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
	var encoded_url = Base64.encode('template/selections/get_selections/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
		'tableName': $('#Category_Selections'),
		'ajax_encoded_url':ajax_encoded_url,
		'id':'ub_template_selection_id',
		'name' : 'title',
		'group_by_name' : 'title',
		'edit_data':{'index':1, 'url':'template/selections/save_selection/'},
		'post_data':'{"status":"'+status+'", "vendors":"'+vendors+'","title":"'+title+'","location":"'+location+'","categories":"'+categories+'","daterange":"'+daterange+'","tab_type":"'+tab_type+'"}',
		'display_columns' : [{"orderable": false,"data": null,"defaultContent": '',"sClass": "details-control"},{"data": "title"},{"data":"location"},{"data":"category"},{"data": "status"}, {"data": "owner_price" , "bSortable": false},{"data": "difference", "bSortable": false}, 
		{"data": "due_date_time"}, {"data": "status"}],
		'default_order_by': [[4, 'desc']]
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
		'<th>Files</th>' +
		'<th>Price</th>' +
		'</tr>' +
		'</thead>';
	var append_th = '';	
	if(d.selection_choices.length>0)
	{	
		$.each(d.selection_choices, function(colID,colNAME) {                    
			append_th = append_th + '<tr><th>' + d.selection_choices[colID]['choice_title'] +'</th>'+
			'<th>' + d.selection_choices[colID]['creator'] + '</th>' +
			'<th>' + d.selection_choices[colID]['description'] + '</th>' +
			'<th>' + d.selection_choices[colID]['status'] + '</th>' +
			'<th>' + d.selection_choices[colID]['choice_title'] + '</th>' + 
			'<th>' + d.selection_choices[colID]['owner_price'] + '</th></tr>';
		});	 
	}
	else
	{
		append_th = append_th + '<tr><th>No Records</th><tr>';
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
		'<th>Files</th>' +
		'<th>Price</th>' +
		'</tr>' +
		'</thead>';
	var append_th = '';	
	if(d.selection_choices.length>0)
	{		
		$.each(d.selection_choices, function(colID,colNAME) {                    
			append_th = append_th + '<tr><th>' + d.selection_choices[colID]['choice_title'] + '</th>'+
			'<th>' + d.selection_choices[colID]['creator'] + '</th>' +
			'<th>' + d.selection_choices[colID]['description'] + '</th>' +
			'<th>' + d.selection_choices[colID]['status'] + '</th>' +
			'<th>' + d.selection_choices[colID]['choice_title'] + '</th>' + 
			'<th>' + d.selection_choices[colID]['owner_price'] + '</th></tr>';
		});
	}
	else
	{
		append_th = append_th + '<tr><th>No Records</th><tr>';
	}		
	table_html = table_html + append_th + '</table>';	
	return table_html;
}

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
	var role_index = Base64.encode('template/selections/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"SELECTIONS","destroy_type":["SEARCH"]},			
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
				$('.error-message .alerts').text('reset successfully');
			}
			else{
				error_box();				
				$('.error-message .alerts').text('reset failed');
			}
		}
	});	
}
