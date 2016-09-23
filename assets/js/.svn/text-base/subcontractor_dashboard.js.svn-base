$(function() {
	$('.scroll-pane').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	});
	if (typeof subcontractor_dashboard_page != 'undefined') 
	{
		setTimeout("dashboard_con()", 500);
		project_current_weather();	
		// setTimeout("project_current_weather()", 300);
		setTimeout("comment_list()", 300);
		//task_list();
		setTimeout("task_list()", 500);
		// selection_list();
		setTimeout("selection_list()", 800);
		// warranty_list();
		setTimeout("warranty_list()", 1200);
		bid_package_list();
		setTimeout("budget_po_co()", 1500);
		setTimeout("mail_notification_list()", 1900); 
	}
	//refresh sections
	$('#weather_refresh').on('click', function() { 
		project_current_weather();
	});
	$('#task_refresh').on('click', function() { 
		task_list();
	});
	$('#warranty_refresh').on('click', function() { 
		warranty_list();
	});
	$('#comment_refresh').on('click', function() {
		setTimeout("dashboard_con()", 500);	
		comment_list();					
	});
	$('#mail_notification_refresh').on('click', function() { 
		mail_notification_list();
	});
	$('#selection_refresh').on('click', function() { 
		selection_list();
	});
	$('#bid_packages_refresh').on('click', function() { 
		bid_package_list();
	});
	$('#po_co_refresh').on('click', function() { 
		budget_po_co();
	});
	$('#mail_notification_refresh').on('click', function() { 
		mail_notification_list();
	});
});


//recent_comments list
function comment_list() {
	var encoded_destroy_session = Base64.encode('subcontractor_dashboard/get_comments/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		//data:'ub_project_id='+selectedprojectId,
		beforeSend: function() {
                $('.uni_wrapper').addClass('loadingDiv');
        },
		success:function(res) {
			if(res != ''){					
				$('#load_comment_to_div').html(res);
				$('.uni_wrapper').removeClass('loadingDiv');
			}
			else{
				$('#load_comment_to_div').html('');
			}
		}
	});
}

//tasks list
function task_list() {
	var encoded_destroy_session = Base64.encode('subcontractor_dashboard/get_tasks/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');
        },
		success:function(res) {
			if(res != ''){					
				$('#load_task_to_div').html(res);
				$('.uni_wrapper').removeClass('loadingDiv');
			}
			else{
				$('#load_task_to_div').html('');
			}
		}
	});
}
//warranty_alerts list
function warranty_list() {
	var encoded_destroy_session = Base64.encode('subcontractor_dashboard/get_warranty/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');
        },
		success:function(res) {
			if(res != ''){					
				$('#load_warranty_to_div').html(res);
				 $('.uni_wrapper').removeClass('loadingDiv');
			}
			else{
				$('#load_warranty_to_div').html('');
			}
		}
	});
}

//redirect to index page of warranty
function warranty_index(status)
{
	//alert(status);return false;
	var encoded_destroy_session = Base64.encode('warranty/get_warranty/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	
	var encoded_warranty = Base64.encode('warranty/index/');
	var warranty_home = encoded_warranty.strtr(encode_chars_obj);
	
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		data:'status='+status,
		success:function(res) {
			if(res != ''){					
				window.location.href= base_url + warranty_home;
			}
		}
	});
}

//mail notifications list
function mail_notification_list() {
	var encoded_destroy_session = Base64.encode('subcontractor_dashboard/get_mail_notification/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');
        },
		success:function(res) {
			if(res != ''){					
				$('#load_mail_notification_to_div').html(res);
				$('.uni_wrapper').removeClass('loadingDiv');
			}
			else{
				$('#load_mail_notification_to_div').html('');
			}
		}
	});
}

//selection list
function selection_list() {
	var encoded_destroy_session = Base64.encode('subcontractor_dashboard/get_selections/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');
        },
		success:function(res) {
			if(res != ''){					
				$('#load_selection_to_div').html(res);
				$('.uni_wrapper').removeClass('loadingDiv');
			}
			else{
				$('#load_selection_to_div').html('');
			}
		}
	});
}

//warranty_alerts list
function bid_package_list() {
	var encoded_destroy_session = Base64.encode('subcontractor_dashboard/get_bid_packages/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');
        },
		success:function(res) {
			if(res != ''){					
				$('#load_bid_to_div').html(res);
				$('.uni_wrapper').removeClass('loadingDiv');
			}
			else{
				$('#load_bid_to_div').html('');
			}
		}
	});
}
//warranty_alerts list
function budget_po_co() {
	var encoded_destroy_session = Base64.encode('subcontractor_dashboard/get_budget_po_co/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');
        },
		success:function(res) {
			if(res != ''){					
				$('#load_po_co_to_div').html(res);
				$('.uni_wrapper').removeClass('loadingDiv');
			}
			else{
				$('#load_po_co_to_div').html('');
			}
		}
	});
}

// project current weather
function project_current_weather() {
	var encoded_destroy_session = Base64.encode('subcontractor_dashboard/get_project_current_weather/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		data: {'dashboard':'yes'},
		beforeSend: function() {
             $('.uni_wrapper').addClass('loadingDiv');
        },
		success:function(res) {
			if(res != ''){					
				$('#load_weather_to_div').html(res);
			    $('.uni_wrapper').removeClass('loadingDiv');
			}
			else{
				$('#load_weather_to_div').html('');
			}
		}
	});
}

function dashboard_con(){
	$("#load_comment_to_div, #load_log_to_div").mCustomScrollbar({
			setHeight:160,
			theme:"dark-3"
		});	
}