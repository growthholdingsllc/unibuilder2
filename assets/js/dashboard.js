$(function() {
	$('.scroll-pane').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	});
	if (typeof dashboard_page != 'undefined')
	{
		$.when(comment_list(), log_list(),task_list()).done(function(){
			$.when(warranty_list(),owner_activity_list()).done(function(){
				$.when(mail_notification_list(),schedule_list()).done(function(){
					$.when(project_cost_summary(),project_current_weather()).done(function(){
						/* $.when(project_current_weather()).done(function(){
					
						});	 */
					});	
				});	
		    });
		});
		
		/* //setTimeout("dashboard_con()", 500);
		comment_list();	
		// setTimeout("comment_list()", 100);
		log_list();
		// setTimeout("log_list()", 500);
		task_list();
		// setTimeout("task_list()", 1000);
		warranty_list();
		// setTimeout("warranty_list()", 1500);
		schedule_list();
		// setTimeout("schedule_list()", 1900); 
		// reminder_list();
		// setTimeout("reminder_list()", 2000); 
		owner_activity_list();
		// setTimeout("owner_activity_list()", 2300); 
		mail_notification_list();
		// setTimeout("mail_notification_list()", 2500); 
		project_cost_summary();
		// setTimeout("project_cost_summary()", 2900);
		project_current_weather();	 */	
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
		//setTimeout("dashboard_con()", 500);	
		comment_list();					
	});
	$('#log_refresh').on('click', function() { 
		log_list();
	});
	$('#schedule_refresh').on('click', function() { 
		schedule_list();
	});
	$('#owner_activity_refresh').on('click', function() { 
		owner_activity_list();
	});
	$('#mail_notification_refresh').on('click', function() { 
		mail_notification_list();
	});
	$('#selection_refresh').on('click', function() { 
		selection_list();
	});
	$('#project_cost_summary_refresh').on('click', function() { 
		project_cost_summary();
	});
});


//recent_comments list
function comment_list() {
	var encoded_destroy_session = Base64.encode('builder_dashboard/get_comments/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	var result =jQuery.ajax({
			type:'POST',
			url:ajaxUrl,
			//data:'ub_project_id='+selectedprojectId,
			beforeSend: function() {
					//$('.uni_wrapper').addClass('loadingDiv');
			},
			success:function(res) {
				if(res != ''){					
					$('#load_comment_to_div').html(res);
					//$('.uni_wrapper').removeClass('loadingDiv');
					
				}
				else{
					$('#load_comment_to_div').html('');
				}
			}
		});
	return result;
}

//tasks list
function task_list() {
	var encoded_destroy_session = Base64.encode('builder_dashboard/get_tasks/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	var result = jQuery.ajax({
				type:'POST',
				url:ajaxUrl,
				beforeSend: function() {
					 // $('.uni_wrapper').addClass('loadingDiv');
				},
				success:function(res) {
					if(res != ''){					
						$('#load_task_to_div').html(res);
						//$('.uni_wrapper').removeClass('loadingDiv');
					}
					else{
						$('#load_task_to_div').html('');
					}
				}
			});
	return result;
}

//daily_log list
function log_list() {
	var encoded_destroy_session = Base64.encode('builder_dashboard/get_logs/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	var result = jQuery.ajax({
				type:'POST',
				url:ajaxUrl,
				beforeSend: function() {
					  // $('.uni_wrapper').addClass('loadingDiv');
				},
				success:function(res) {
					if(res != ''){					
						$('#load_log_to_div').html(res);
						//$('.uni_wrapper').removeClass('loadingDiv');
					}
					else{
						$('#load_log_to_div').html('');
					}
				}
			});
	return result;
}

//warranty_alerts list
function warranty_list() {
	var encoded_destroy_session = Base64.encode('builder_dashboard/get_warranty/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	var result = jQuery.ajax({
				type:'POST',
				url:ajaxUrl,
				beforeSend: function() {
					 // $('.uni_wrapper').addClass('loadingDiv');
				},
				success:function(res) {
					if(res != ''){					
						$('#load_warranty_to_div').html(res);
						// $('.uni_wrapper').removeClass('loadingDiv');
					}
					else{
						$('#load_warranty_to_div').html('');
					}
				}
			});
	return result;
}

//schedule list
function schedule_list() {
	var encoded_destroy_session = Base64.encode('builder_dashboard/get_schedule/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	var result = jQuery.ajax({
				type:'POST',
				url:ajaxUrl,
				beforeSend: function() {
					//  $('.uni_wrapper').addClass('loadingDiv');
				},
				success:function(res) {
					if(res != ''){					
						$('#load_schedule_to_div').html(res);
					//	$('.uni_wrapper').removeClass('loadingDiv');
					}
					else{
						$('#load_schedule_to_div').html('');
					}
				}
			});
	return result;
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

//reminders list
/* function reminder_list() {
	var encoded_destroy_session = Base64.encode('builder_dashboard/get_reminder/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	jQuery.ajax({
		type:'POST',
		url:ajaxUrl,
		success:function(res) {
			if(res != ''){					
				$('#load_reminder_to_div').html(res);
			}
			else{
				$('#load_reminder_to_div').html('');
			}
		}
	});
} */

//mail notifications list
function mail_notification_list() {
	var encoded_destroy_session = Base64.encode('builder_dashboard/get_mail_notification/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	var result = jQuery.ajax({
				type:'POST',
				url:ajaxUrl,
				beforeSend: function() {
					//  $('.uni_wrapper').addClass('loadingDiv');
				},
				success:function(res) {
					if(res != ''){					
						$('#load_mail_notification_to_div').html(res);
					//	$('.uni_wrapper').removeClass('loadingDiv');
					}
					else{
						$('#load_mail_notification_to_div').html('');
					}
				}
			});
	return result;
}

//owner activity list
function owner_activity_list() {
	var encoded_destroy_session = Base64.encode('builder_dashboard/get_owner_activity/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	var result = jQuery.ajax({
					type:'POST',
					url:ajaxUrl,
					beforeSend: function() {
						 // $('.uni_wrapper').addClass('loadingDiv');
					},
					success:function(res) {
						if(res != ''){					
							$('#load_owner_activity_to_div').html(res);
							//$('.uni_wrapper').removeClass('loadingDiv');
						}
						else{
							$('#load_owner_activity_to_div').html('');
						}
					}
				});
	return result;
}

//project cost summary
function project_cost_summary() {
	var encoded_destroy_session = Base64.encode('builder_dashboard/get_project_cost_summary/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	var result = jQuery.ajax({
					type:'POST',
					url:ajaxUrl,
					data: {'dashboard':'yes'},
					beforeSend: function() {
						// $('.uni_wrapper').addClass('loadingDiv');
					},
					success:function(res) {
						if(res != ''){					
							$('#load_project_cost_summary_to_div').html(res);
						//	$('.uni_wrapper').removeClass('loadingDiv');
						}
						else{
							$('#load_project_cost_summary_to_div').html('');
						}
					}
				});
	return result;
}

function project_current_weather() {
	var encoded_destroy_session = Base64.encode('builder_dashboard/get_project_current_weather/');
	var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajaxUrl = base_url + find_users_basedon_project;
	var result = jQuery.ajax({
					type:'POST',
					url:ajaxUrl,
					data: {'dashboard':'yes'},
					beforeSend: function() {
						// $('.uni_wrapper').addClass('loadingDiv');
					},
					success:function(res) {
						if(res != ''){					
							$('#load_weather_to_div').html(res);
						//	$('.uni_wrapper').removeClass('loadingDiv');
						}
						else{
							$('#load_weather_to_div').html('');
						}
					}
				});
	return result;
}
// function dashboard_con(){
	// $("#load_comment_to_div, #load_log_to_div").mCustomScrollbar({
			// setHeight:160,
			// theme:"dark-3"
		// });	
// }