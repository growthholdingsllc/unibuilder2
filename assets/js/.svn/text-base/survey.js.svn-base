$(function() {
	$('.Status, .Project, .released, .tags2').addClass('hide');
	$('#release_survey').addClass('hide');
	var survey_url = window.location.href;
	var survey_hash = survey_url.substring(survey_url.indexOf("#"));
	if (survey_hash == "#Templates")
	{
		$('.tags').addClass('show');
		$('.Status, .Project, .released, .tags2').addClass('hide');
		
		$('#release_survey').addClass('hide');
		$('.new_template').addClass('show');
		
		//Dynamically Id Changing Code
		$('#apply_saved_filter').attr('id','apply_saved_filter');
		$('#response_apply_save_filter').attr('id','apply_saved_filter');
		$('#survey_apply_save_filter').attr('id','apply_saved_filter');
		
		$('#update_result').attr('id','update_result');
		$('#response_update_result').attr('id','update_result');
		$('#survey_update_result').attr('id','update_result');

		$('#save_filter').attr('id','save_filter');
		$('#response_save_filter').attr('id','save_filter');
		$('#survey_save_filter').attr('id','save_filter');
		
		$('#reset').attr('id','reset');
		$('#response_reset').attr('id','reset');
		$('#survey_reset').attr('id','reset');

		default_pagination_length = $('#template_default_pagination_length').val();
		displayStart = $('#template_displayStart').val();

		//apply filter code added by -- satheesh kumar
		if(template_apply_filter == true)
		{
			$("#apply_saved_filter").show();
		}
		else
		{
			$("#apply_saved_filter").hide();
		}
		survey_template();
		
	}
	if (survey_hash == "#Response")
	{
		$('.tags2').addClass('show');
		$('.Project, .released').addClass('show');
		$('.Status, .tags').addClass('hide');		
		
		$('.new_template').addClass('hide');
		$('#release_survey').addClass('show');
		
		//Dynamically Id Changing Code
		$('#apply_saved_filter').attr('id','response_apply_save_filter');
		$('#response_apply_save_filter').attr('id','response_apply_save_filter');
		$('#survey_apply_save_filter').attr('id','response_apply_save_filter');
		
		$('#update_result').attr('id','response_update_result');
		$('#response_update_result').attr('id','response_update_result');
		$('#survey_update_result').attr('id','response_update_result');

		$('#save_filter').attr('id','response_save_filter');
		$('#response_save_filter').attr('id','response_save_filter');
		$('#survey_save_filter').attr('id','response_save_filter');
		
		$('#reset').attr('id','response_reset');
		$('#response_reset').attr('id','response_reset');
		$('#survey_reset').attr('id','response_reset');

		default_pagination_length = $('#response_default_pagination_length').val();
		displayStart = $('#response_displayStart').val();

		//apply filter code added by -- satheesh kumar
		if(response_apply_filter == true)
		{
			$("#response_apply_save_filter").show();
		}
		else
		{
			$("#response_apply_save_filter").hide();
		}
		response_table();
	}
	if (survey_hash == "#Survey")
	{
		$('.tags, .released, .tags2').addClass('hide');		
		$('.Status, .Project').addClass('show');
		
		$('.new_template').addClass('hide');
		$('#release_survey').addClass('hide');
		
		//Dynamically Id Changing Code
		$('#apply_saved_filter').attr('id','survey_apply_save_filter');
		$('#response_apply_save_filter').attr('id','survey_apply_save_filter');
		$('#survey_apply_save_filter').attr('id','survey_apply_save_filter');
		
		$('#update_result').attr('id','survey_update_result');
		$('#response_update_result').attr('id','survey_update_result');
		$('#survey_update_result').attr('id','survey_update_result');

		$('#save_filter').attr('id','survey_save_filter');
		$('#response_save_filter').attr('id','survey_save_filter');
		$('#survey_save_filter').attr('id','survey_save_filter');
		
		$('#reset').attr('id','survey_reset');
		$('#response_reset').attr('id','survey_reset');
		$('#survey_reset').attr('id','survey_reset');

		default_pagination_length = $('#request_default_pagination_length').val();
		displayStart = $('#request_displayStart').val();

		//apply filter code added by -- satheesh kumar
		if(request_apply_filter == true)
		{
			$("#survey_apply_save_filter").show();
		}
		else
		{
			$("#survey_apply_save_filter").hide();
		}
		Survey_list();
	}
	
	
	$('a[href = "#Templates"]').click(function(){
		$('.tags').addClass('show');
		$('.Status, .Project, .released, .tags2').removeClass('show');
		$('.Status, .Project, .released, .tags2').addClass('hide');
		
		$('.new_template').addClass('show');		
		$('.new_template').removeClass('hide');
		
		$('#release_survey').removeClass('show');
		$('#release_survey').addClass('hide');
		
		//Dynamically Id Changing Code
		$('#apply_saved_filter').attr('id','apply_saved_filter');
		$('#response_apply_save_filter').attr('id','apply_saved_filter');
		$('#survey_apply_save_filter').attr('id','apply_saved_filter');
		
		$('#update_result').attr('id','update_result');
		$('#response_update_result').attr('id','update_result');
		$('#survey_update_result').attr('id','update_result');

		$('#save_filter').attr('id','save_filter');
		$('#response_save_filter').attr('id','save_filter');
		$('#survey_save_filter').attr('id','save_filter');
		
		$('#reset').attr('id','reset');
		$('#response_reset').attr('id','reset');
		$('#survey_reset').attr('id','reset');

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");

		default_pagination_length = $('#template_default_pagination_length').val();
		displayStart = $('#template_displayStart').val();

		//apply filter code added by -- satheesh kumar
		if(template_apply_filter == true)
		{
			$("#apply_saved_filter").show();
		}
		else
		{
			$("#apply_saved_filter").hide();
		}
		survey_template();
	});
	$('a[href = "#Response"]').click(function(){
		$('.tags2').addClass('show');
		$('.Project, .released').addClass('show');
		$('.Status, .tags').removeClass('show');	
		$('.Status, .tags').addClass('hide');	
		
		$('.new_template').removeClass('show');
		$('.new_template').addClass('hide');
						
		$('#release_survey').addClass('show');
		$('#release_survey').removeClass('hide');
		
		//Dynamically Id Changing Code
		$('#apply_saved_filter').attr('id','response_apply_save_filter');
		$('#response_apply_save_filter').attr('id','response_apply_save_filter');
		$('#survey_apply_save_filter').attr('id','response_apply_save_filter');
		
		$('#update_result').attr('id','response_update_result');
		$('#response_update_result').attr('id','response_update_result');
		$('#survey_update_result').attr('id','response_update_result');

		$('#save_filter').attr('id','response_save_filter');
		$('#response_save_filter').attr('id','response_save_filter');
		$('#survey_save_filter').attr('id','response_save_filter');
		
		$('#reset').attr('id','response_reset');
		$('#response_reset').attr('id','response_reset');
		$('#survey_reset').attr('id','response_reset');

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");

		default_pagination_length = $('#response_default_pagination_length').val();
		displayStart = $('#response_displayStart').val();

		//apply filter code added by -- satheesh kumar
		if(response_apply_filter == true)
		{
			$("#response_apply_save_filter").show();
		}
		else
		{
			$("#response_apply_save_filter").hide();
		}
		response_table();
	});
	
	$('a[href = "#Survey"]').click(function(){
		$('.tags, .released, .tags2').addClass('hide');		
		$('.tags, .released, .tags2').removeClass('show');		
		$('.Status, .Project').addClass('show');
		
		$('.new_template').removeClass('show');
		$('.new_template').addClass('hide');
						
		$('#release_survey').removeClass('show');
		$('#release_survey').addClass('hide');
		
		//Dynamically Id Changing Code
		$('#apply_saved_filter').attr('id','survey_apply_save_filter');
		$('#response_apply_save_filter').attr('id','survey_apply_save_filter');
		$('#survey_apply_save_filter').attr('id','survey_apply_save_filter');
		
		$('#update_result').attr('id','survey_update_result');
		$('#response_update_result').attr('id','survey_update_result');
		$('#survey_update_result').attr('id','survey_update_result');

		$('#save_filter').attr('id','survey_save_filter');
		$('#response_save_filter').attr('id','survey_save_filter');
		$('#survey_save_filter').attr('id','survey_save_filter');
		
		$('#reset').attr('id','survey_reset');
		$('#response_reset').attr('id','survey_reset');
		$('#survey_reset').attr('id','survey_reset');

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");

		default_pagination_length = $('#request_default_pagination_length').val();
		displayStart = $('#request_displayStart').val();
		//apply filter code added by -- satheesh kumar
		if(request_apply_filter == true)
		{
			$("#survey_apply_save_filter").show();
		}
		else
		{
			$("#survey_apply_save_filter").hide();
		}
		Survey_list();
	});
});
$('#release_survey').on('click', function(){
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
	else
	{
		$('#release_survey_modal').modal('show');
	}
	
});

$(function() {
	if (typeof list_page != 'undefined') {

		default_pagination_length = $('#template_default_pagination_length').val();
		displayStart = $('#template_displayStart').val();
		
		survey_template();
	}
	$(document).on('click','#update_result', function(e){			
		survey_template();
		$('.error-message').hide();
		e.preventDefault();			
	});
});
function survey_template() {
	// Ajax URL
	var tags = $('#tags').val();
	var encoded_url = Base64.encode('survey/get_template_list/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// alert(ajax_encoded_url);
	// Data table Object	
	var dbobject = {
						'tableName': $('#survey_template_table'),
						'ajax_encoded_url':ajax_encoded_url,
						'id':'ub_survey_template_id',
						'name':'name',
						'post_data':'{"tags":"'+tags+'"}',
						'delete_data':{},  
						'edit_data':{'index':0, 'url':'survey/new_template/'},
						'display_columns' : [{"data": "name"},{"data": "tags"},{"data": "created_by"}],
						'default_order_by': [[1, 'asc']]
					};				
	// Populate data table
	ubdatatable(dbobject);
}
$(document).on('click','#response_update_result', function(e){			
	 response_table();
	 $('.error-message').hide();
	 e.preventDefault();			
});
function response_table() {
        var tags = $('#respone_tags').val();
        var user_id = $('#user_id').val();
		var encoded_url = Base64.encode('survey/get_survey_response_list/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// alert(ajax_encoded_url);
		// Data table Object	
		var dbobject = {
							'tableName': $('#response_table'),
							'ajax_encoded_url':ajax_encoded_url,
							'this_table' : {'table_name':'response_table'},
							'id':'ub_survey_id',
							'name':'name',
							'post_data':'{"user_id":"'+user_id+'","tags":"'+tags+'"}',
							'delete_data':{},  
							'edit_data':{'index':0, 'url':'survey/new_survey/'},
							'view_data':{'index':5, 'url':'survey/survey_response/'},
							'display_columns' : [{"data": "name"},{"data": "project_name"},{"data": "released_on"},{"data": "Released_by"},{"data": "Released_to"},{"data": "status"}],
							'default_order_by': [[1, 'asc']]
						};				
		// Populate data table
		ubdatatable(dbobject);
}
$(document).on('click','#survey_update_result', function(e){			
	 Survey_list();
	 $('.error-message').hide();
	 e.preventDefault();			
});

function Survey_list() {
	var status = $('#status').val();
	var encoded_url = Base64.encode('survey/get_survey_request_list/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// alert(ajax_encoded_url);
	// Data table Object	
	var dbobject = {
						'tableName': $('#Survey_list'),
						'ajax_encoded_url':ajax_encoded_url,
						'id':'ub_survey_id',
						'name':'name',
						'post_data':'{"status":"'+status+'"}',
						'delete_data':{},  
						'edit_data':{'index':0, 'url':'survey/save_survey_request/'},
						'display_columns' : [{"data": "name","bSortable": false},{"data": "project_name"},{"data": "released_on"},{"data": "first_name"},{"data": "status"}],
						'default_order_by': [[1, 'asc']]
					};				
	// Populate data table
	ubdatatable(dbobject);
}

$(document).on('click', '#add_table', function()
{ 
	var encoded_url = Base64.encode('survey/release_survey/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var survay_name = $('#survey_name').val();
	var template_id = $('#template_id').val();
	var ajaxData  = $("#release_survey").serialize();
		$.ajax({
			url: base_url + ajax_encoded_url,
			dataType: "json",
			type: "post",
			data: "survay_name="+survay_name+"&template_id="+template_id,
			success: function(response) {           
				if(response.status == true)
				{   
						 var encoded_string_edit_log = Base64.encode( 'survey/new_survey/' + response.insert_id);
						 var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
						 window.location.href = encoded_edit_val;
						 
						 
				}
			}
		
	});
});
/* -------------Survey Template Reset, savefilter, and Apply Filter Code Starts Here ---------*/
//template reset
$(document).on('click','#reset', function(e) {		
	template_reset_function();
	e.preventDefault();
});
function template_reset_function(){
	var encoded_destroy_session = Base64.encode('survey/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('survey/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"SURVEY_TEMPLATE","destroy_type":["template_search"]},
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },		
		success: function(response) {		
		$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url + '#Templates';
				location.reload(true);				
				success_box();
				$('.error-message .alerts').text('Reset Successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Reset failed');					
			}
		}
	});
}

// Save Filter template
$(document).on('click','#save_filter', function(e){
	var tags = $('#tags').val();

 	if((!tags))
	{
		error_box();
		$('.error-message .alerts').text('Please select one mandatory fields');	
		return false;
	} 	
	template_save_filter_function();
	e.preventDefault();	
});

function template_save_filter_function(){
	var tags = $('#tags').val();	
	var encoded_url = Base64.encode('survey/template_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'tags='+tags;
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
				$("#apply_saved_filter").show();
				success_box();
				$('.error-message .alerts').text('Saved Successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Saved failed');	
			}
		}
	});	
}
//Apply Filter
$(document).on('click','#apply_saved_filter', function(e) {
		var encoded_url = Base64.encode('survey/template_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('survey/index/');
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
				window.location.href= base_url + ajax_encoded_urls+ '#Templates';
				location.reload(true);
				success_box();
				$('.error-message .alerts').text('Apply saved filter successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Apply saved filter failed');
			}
		}
	});			
			
});
/* --------------************------------*************-----------***********------------ */

/* -------------Survey Request Reset, savefilter, and Apply Filter Code Starts Here------*/
//template reset
$(document).on('click','#response_reset', function(e) {		
	response_reset_function();
	e.preventDefault();
});
function response_reset_function(){
	var encoded_destroy_session = Base64.encode('survey/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('survey/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"SURVEY_RESPONSE","destroy_type":["response_search"]},
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },		
		success: function(response) {		
		$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url + '#Response';
				location.reload(true);				
				success_box();
				$('.error-message .alerts').text('Reset Successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Reset failed');					
			}
		}
	});
}

// Save Filter template
$(document).on('click','#response_save_filter', function(e){
	var tags = $('#tags').val();
	var user_id = $('#user_id').val();
 	if((!tags) && (!user_id))
	{
		error_box();
		$('.error-message .alerts').text('Please select one mandatory fields');	
		return false;
	} 	
	response_save_filter_function();
	e.preventDefault();	
});

function response_save_filter_function(){
	var tags = $('#respone_tags').val();
	var user_id = $('#user_id').val();	
	var encoded_url = Base64.encode('survey/response_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'tags='+tags+'&user_id='+user_id;
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
				$("#response_apply_save_filter").show();
				success_box();
				$('.error-message .alerts').text('Saved Successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Saved failed');	
			}
		}
	});	
}
//Apply Filter
$(document).on('click','#response_apply_save_filter', function(e) {
		var encoded_url = Base64.encode('survey/response_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('survey/index/');
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
				window.location.href= base_url + ajax_encoded_urls+ '#Response';
				location.reload(true);
				success_box();
				$('.error-message .alerts').text('Apply saved filter successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Apply saved filter failed');
			}
		}
	});			
			
});

/* --------------************------------*************-----------***********------------ */

/* -------------Survey Response Reset, savefilter, and Apply Filter Code Starts Here-----*/
//template reset
$(document).on('click','#survey_reset', function(e) {		
	survey_request_reset_function();
	e.preventDefault();
});
function survey_request_reset_function(){
	var encoded_destroy_session = Base64.encode('survey/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('survey/index/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"SURVEY_REQUEST","destroy_type":["survey_request_search"]},
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },		
		success: function(response) {		
		$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url + '#Survey';
				location.reload(true);				
				success_box();
				$('.error-message .alerts').text('Reset Successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Reset failed');					
			}
		}
	});
}

// Save Filter template
$(document).on('click','#survey_save_filter', function(e){
	var status = $('#status').val();
 	if((!status))
	{
		error_box();
		$('.error-message .alerts').text('Please select one mandatory fields');	
		return false;
	} 	
	survey_request_save_filter_function();
	e.preventDefault();	
});

function survey_request_save_filter_function(){
	var status = $('#status').val();
	var encoded_url = Base64.encode('survey/survey_request_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'status='+status;
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
				$("#survey_apply_save_filter").show();
				success_box();
				$('.error-message .alerts').text('Saved Successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Saved failed');	
			}
		}
	});	
}
//Apply Filter
$(document).on('click','#survey_apply_save_filter', function(e) {
		var encoded_url = Base64.encode('survey/survey_request_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('survey/index/');
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
				window.location.href= base_url + ajax_encoded_urls+ '#Survey';
				location.reload(true);
				success_box();
				$('.error-message .alerts').text('Apply saved filter successfully');	
			}
			else{
				error_box();				
				$('.error-message .alerts').text('Apply saved filter failed');
			}
		}
	});			
			
});

/* --------------************------------*************-----------***********------------ */