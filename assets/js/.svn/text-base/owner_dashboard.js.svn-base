$(function() {
	$('.scroll-pane').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	});
	if (typeof owner_dashboard_page != 'undefined') 
	{
		task_list();
		// setTimeout("task_list()", 100);
		// warranty_list();
		setTimeout("warranty_list()", 400);
		//selection_list();
		setTimeout("selection_list()", 900);
		// mail_notification_list();
		setTimeout("mail_notification_list()", 1300); 
		// project_current_weather();
		setTimeout("project_current_weather()", 1600); 
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
	$('#selection_refresh').on('click', function() { 
		selection_list();
	});
	$('#mail_notification_refresh').on('click', function() { 
		mail_notification_list();
	});
});

//tasks list
function task_list() {
	var encoded_destroy_session = Base64.encode('owner_dashboard/get_tasks/');
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
	var encoded_destroy_session = Base64.encode('owner_dashboard/get_warranty/');
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

//selection list
function selection_list() {
	var encoded_destroy_session = Base64.encode('owner_dashboard/get_selections/');
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

//mail notifications list
function mail_notification_list() {
	var encoded_destroy_session = Base64.encode('owner_dashboard/get_mail_notification/');
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

function project_current_weather() {
	var encoded_destroy_session = Base64.encode('owner_dashboard/get_project_current_weather/');
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

jssor_slider2_starter = function (containerId) {
var options = {
	$AutoPlay: true,	
	$AutoPlaySteps: 1,
	$AutoPlayInterval: 4000,
	$PauseOnHover: 1,
	$ArrowKeyNavigation: true,
	$SlideDuration: 500,      
	$MinDragOffsetToSlide: 20,
	$SlideSpacing: 0, 
	$DisplayPieces: 1,          
	$ParkingPosition: 0,        
	$UISearchMode: 1,           
	$PlayOrientation: 1,        
	$DragOrientation: 3,        
	$ArrowNavigatorOptions: {
		$Class: $JssorArrowNavigator$,
		$ChanceToShow: 1,             
		$AutoCenter: 2,               
		$Steps: 1                     
	},
	$ThumbnailNavigatorOptions: {
		$Class: $JssorThumbnailNavigator$,
		$ChanceToShow: 2,                 
		$ActionMode: 1,                   
		$AutoCenter: 3,                   
		$Lanes: 1,                        
		$SpacingX: 3,                     
		$SpacingY: 3,                     
		$DisplayPieces: 9,                
		$ParkingPosition: 260,            
		$Orientation: 1,                  
		$DisableDrag: false               
	}
};
var jssor_slider2 = new $JssorSlider$(containerId, options);
function ScaleSlider() {
	var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
	if (parentWidth)
		jssor_slider2.$ScaleWidth(Math.min(parentWidth, 1300));
	else
		$Jssor$.$Delay(ScaleSlider, 30);
}
ScaleSlider();
$Jssor$.$AddEvent(window, "load", ScaleSlider);
$Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
};
jssor_slider2_starter('slider2_container');
