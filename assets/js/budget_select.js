$(function(){

	if(account_type == OWNER)
	{
		budget_owner_co_list_view();
		budget_pay_app_list_view();
		budget_owner_po_list_view();
	}
});
$(function(){
	$('.date').on("dp.show", function(e) {		
		var top  = $(this).offset().top + $(this).outerHeight();
		var left = $(this).offset().left;		
		var ele = $(e.target).data('DateTimePicker');
		if (ele.widget.position().left > 0) {					 		 			
			$(ele.widget).css({
				'top' : top,
				'left': left+'px !important',
				'bottom':'auto'
			});		 
		}			 
	});	
});
function summary_tab_change(){
		var encoded_destroy_session = Base64.encode('budget/get_left_collapse_menu');
		var get_left_collapse = encoded_destroy_session.strtr(encode_chars_obj);
		var ajaxUrl = base_url + get_left_collapse;
		var encoded_urls = Base64.encode('budget/project_budget/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		$.ajax({
			url: ajaxUrl,
			type: "post",
			dataType: "json",
			success: function(response) {
				if(response.status == true){
					window.location.href = base_url + ajax_encoded_urls + '#summary';
					location.reload();
				}
			}
		});
}

function tab_check()
{	
	if (budget_project_id == '') 
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
		return false;	
	}
}

$(function() {    
var budget_url = window.location.href;
	var budget_hash = budget_url.substring(budget_url.indexOf("#"));
		if (budget_hash == "#summary")
		{
			$('#current_tab').val("project_summary");
			$('.new_estimate').addClass('hide');
			$('.filter_none').addClass('hide');
			$('.new_payapp').addClass('hide');
			$('.pay-app').addClass('hide');
			$('.co').addClass('hide');
			$('.po').addClass('hide');
			$('.owner_co').addClass('hide');
			$('.owner_po').addClass('hide');
			// Budget summary list page AJAX call for an individual project 
			// project_summary_list_view();	

			default_pagination_length = 5;
		    displayStart = 0;

			if (budget_project_id == '') 
			{
				project_summary_list_view();
				setTimeout("budget_summary_list_view()", 1000);	
			}
			else
			{
				summary_tab_change();
			}
		}
		
		if (budget_hash == "#jobs")
		{
			$('#current_tab').val("jobs");
			$('.new_estimate').addClass('show');
			$('.filter_none').addClass('hide');
			$('.new_payapp').addClass('hide');
			$('.pay-app').addClass('hide');
			$('.co').addClass('hide');
			$('.po').addClass('hide');
			$('.owner_co').addClass('hide');
			$('.owner_po').addClass('hide');			

			default_pagination_length = 5;
		    displayStart = 0;

			// Estimate Job list & cost summary AJAX call for an individual project 
			tab_check();
			budget_jobs_list_view();
			setTimeout("project_cost_summary()", 1000);
		}
		
		if (budget_hash == "#pay_app")
		{			
			$('#current_tab').val("pay_app");
			$('.filter_none').addClass('show');
			$('.new_payapp').addClass('show');
			$('.pay-app').addClass('show');
			$('.new_estimate').addClass('hide');
			$('.co').addClass('hide');
			$('.po').addClass('hide');
			$('.owner_co').addClass('hide');
			$('.new_payapp_con').hide();
			$('.owner_po').addClass('hide');
			$('#new_payapp button').attr('disabled', false);
			
			
			$('#apply_save_filter').attr('id','apply_save_filter_pay_app');
			$('#apply_save_filter_po').attr('id','apply_save_filter_pay_app');
			$('#apply_save_filter_co').attr('id','apply_save_filter_pay_app');
			$('#apply_save_filter_pay_app').attr('id','apply_save_filter_pay_app');
			$('#apply_save_filter_owner_po').attr('id','apply_save_filter_pay_app');
			$('#apply_save_filter_owner_co').attr('id','apply_save_filter_pay_app');

			$('#update_result').attr('id','update_result_pay_app');
			$('#update_result_po').attr('id','update_result_pay_app');
			$('#update_result_co').attr('id','update_result_pay_app');
			$('#update_result_pay_app').attr('id','update_result_pay_app');
			$('#update_result_owner_co').attr('id','update_result_pay_app');
			$('#update_result_owner_po').attr('id','update_result_pay_app');

			$('#save_filter').attr('id','save_filter_pay_app');
			$('#save_filter_po').attr('id','save_filter_pay_app');
			$('#save_filter_co').attr('id','save_filter_pay_app');
			$('#save_filter_pay_app').attr('id','save_filter_pay_app');
			$('#save_filter_owner_co').attr('id','save_filter_pay_app');
			$('#save_filter_owner_po').attr('id','save_filter_pay_app');
			
			$('#reset').attr('id','pay_app_search_reset');
			$('#po_search_reset').attr('id','pay_app_search_reset');
			$('#co_search_reset').attr('id','pay_app_search_reset');
			$('#pay_app_search_reset').attr('id','pay_app_search_reset');
			$('#owner_co_search_reset').attr('id','pay_app_search_reset');
			$('#owner_po_search_reset').attr('id','pay_app_search_reset');

			//pagination code start here by -- Sidhartha
			default_pagination_length = $('#payapp_default_pagination_length').val();
		    displayStart = $('#payapp_displayStart').val();
			
			//apply filter code added by -- satheesh kumar
			if(payapp_apply_filter == true)
			{
				$("#apply_save_filter_pay_app").show();
			}
			else
			{
				$("#apply_save_filter_pay_app").hide();
			}
			// Payapp list page AJAX call for an individual project 
			$('.budget_pay_app_list').show();							
			$('.pay-app-list-content').hide();	
			$('.budget_pay_app_list_details').hide();
			tab_check();
			budget_pay_app_list_view();
		}
		
		if (budget_hash == "#po")
		{			
			$('#current_tab').val("po");
			$('.po').addClass('show');			 
			$('.filter_none').addClass('show');
			$('.new_payapp').addClass('hide');
			$('.pay-app').addClass('hide');
			$('.new_estimate').addClass('hide');
			$('.new_estimate_con').addClass('hide');
			$('.co').addClass('hide');
			$('.owner_co').addClass('hide');
			$('.owner_po').addClass('hide');

			$('#apply_save_filter').attr('id','apply_save_filter_po');
			$('#apply_save_filter_pay_app').attr('id','apply_save_filter_po');
			$('#apply_save_filter_po').attr('id','apply_save_filter_po');
			$('#apply_save_filter_co').attr('id','apply_save_filter_po');
			$('#apply_save_filter_owner_po').attr('id','apply_save_filter_po');
			$('#apply_save_filter_owner_co').attr('id','apply_save_filter_po');

			$('#update_result_pay_app').attr('id','update_result_po');
			$('#update_result_po').attr('id','update_result_po');
			$('#update_result_co').attr('id','update_result_po');
			$('#update_result').attr('id','update_result_po');
			$('#update_result_owner_co').attr('id','update_result_po');
			$('#update_result_owner_po').attr('id','update_result_po');

			$('#save_filter_pay_app').attr('id','save_filter_po');	
			$('#save_filter_po').attr('id','save_filter_po');
			$('#save_filter_co').attr('id','save_filter_po');
			$('#save_filter').attr('id','save_filter_po');
			$('#save_filter_owner_co').attr('id','save_filter_po');
			$('#save_filter_owner_po').attr('id','save_filter_po');
			
			$('#pay_app_search_reset').attr('id','po_search_reset');
			$('#po_search_reset').attr('id','po_search_reset');
			$('#co_search_reset').attr('id','po_search_reset');
			$('#reset').attr('id','po_search_reset');
			$('#owner_co_search_reset').attr('id','po_search_reset');
			$('#owner_po_search_reset').attr('id','po_search_reset');

			//pagination code start here by -- Sidhartha
			default_pagination_length = $('#po_default_pagination_length').val();
		    displayStart = $('#po_displayStart').val();
			
			//apply filter code added by -- satheesh kumar
			if(po_apply_filter == true)
			{
				$("#apply_save_filter_po").show();
			}
			else
			{
				$("#apply_save_filter_po").hide();
			}	
			// Purchase Order list page AJAX call for an individual project 
			budget_po_list_view();
			
		}
		
		if (budget_hash == "#co")
		{			
			$('#current_tab').val("co");
			$('.co').addClass('show');
			$('.filter_none').addClass('show');
			$('.new_payapp').addClass('hide');
			$('.pay-app').addClass('hide');
			$('.new_estimate').addClass('hide');
			$('.po').addClass('hide');
			$('.owner_co').addClass('hide');
			$('.owner_po').addClass('hide');
			
			$('#apply_save_filter').attr('id','apply_save_filter_co');
			$('#apply_save_filter_pay_app').attr('id','apply_save_filter_co');
			$('#apply_save_filter_po').attr('id','apply_save_filter_co');
			$('#apply_save_filter_co').attr('id','apply_save_filter_co');
			$('#apply_save_filter_owner_po').attr('id','apply_save_filter_co');
			$('#apply_save_filter_owner_co').attr('id','apply_save_filter_co');

			$('#update_result').attr('id','update_result_co');
			$('#update_result_pay_app').attr('id','update_result_co');
			$('#update_result_po').attr('id','update_result_co');
			$('#update_result_co').attr('id','update_result_co');
			$('#update_result_owner_co').attr('id','update_result_co');
			$('#update_result_owner_po').attr('id','update_result_co');

			$('#save_filter').attr('id','save_filter_co');
			$('#save_filter_pay_app').attr('id','save_filter_co');
			$('#save_filter_po').attr('id','save_filter_co');
			$('#save_filter_co').attr('id','save_filter_co');
			$('#save_filter_owner_co').attr('id','save_filter_co');
			$('#save_filter_owner_po').attr('id','save_filter_co');
			
			$('#reset').attr('id','co_search_reset');
			$('#pay_app_search_reset').attr('id','co_search_reset');
			$('#po_search_reset').attr('id','co_search_reset');
			$('#co_search_reset').attr('id','co_search_reset');
			$('#owner_co_search_reset').attr('id','co_search_reset');
			$('#owner_po_search_reset').attr('id','co_search_reset');

			//pagination code start here by -- Sidhartha
			default_pagination_length = $('#co_default_pagination_length').val();
		    displayStart = $('#co_displayStart').val();
			
			//apply filter code added by -- satheesh kumar
			if(co_apply_filter == true)
			{
				$("#apply_save_filter_co").show();
			}
			else
			{
				$("#apply_save_filter_co").hide();
			}
			// Change Order list page AJAX call for an individual project 
			budget_co_list_view();
			
		}
		
		if (budget_hash == "#owner_co")
		{			
			$('#current_tab').val("owner_co");
			$('.owner_co').removeClass('hide');
			$('.owner_co').addClass('show');
			$('.filter_none').addClass('show');
			$('.new_payapp').addClass('hide');
			$('.pay-app').addClass('hide');
			$('.new_estimate').addClass('hide');
			$('.po').addClass('hide');
			$('.co').addClass('hide');
			$('.owner_po').addClass('hide');
			
			$('#apply_save_filter').attr('id','apply_save_filter_owner_co');
			$('#apply_save_filter_pay_app').attr('id','apply_save_filter_owner_co');
			$('#apply_save_filter_po').attr('id','apply_save_filter_owner_co');
			$('#apply_save_filter_co').attr('id','apply_save_filter_owner_co');
			$('#apply_save_filter_owner_po').attr('id','apply_save_filter_owner_co');
			$('#apply_save_filter_owner_co').attr('id','apply_save_filter_owner_co');

			$('#update_result').attr('id','update_result_owner_co');
			$('#update_result_pay_app').attr('id','update_result_owner_co');
			$('#update_result_po').attr('id','update_result_owner_co');
			$('#update_result_co').attr('id','update_result_owner_co');
			$('#update_result_owner_co').attr('id','update_result_owner_co');
			$('#update_result_owner_po').attr('id','update_result_owner_co');

			$('#save_filter').attr('id','save_filter_owner_co');
			$('#save_filter_pay_app').attr('id','save_filter_owner_co');
			$('#save_filter_po').attr('id','save_filter_owner_co');
			$('#save_filter_co').attr('id','save_filter_owner_co');
			$('#save_filter_owner_co').attr('id','save_filter_owner_co');
			$('#save_filter_owner_po').attr('id','save_filter_owner_co');

			$('#reset').attr('id','co_search_reset');
			$('#pay_app_search_reset').attr('id','owner_co_search_reset');
			$('#po_search_reset').attr('id','owner_co_search_reset');
			$('#co_search_reset').attr('id','owner_co_search_reset');
			$('#owner_co_search_reset').attr('id','owner_co_search_reset');
			$('#owner_po_search_reset').attr('id','owner_co_search_reset');
			
			//pagination code start here by -- Sidhartha
			default_pagination_length = $('#client_co_default_pagination_length').val();
		    displayStart = $('#client_co_displayStart').val();

			//apply filter code added by -- satheesh kumar
			if(owner_co_apply_filter == true)
			{
				$("#apply_save_filter_owner_co").show();
			}
			else
			{
				$("#apply_save_filter_owner_co").hide();
			}
			// Change Order list page AJAX call for an individual project 
			budget_owner_co_list_view();
			
		}
		
		if (budget_hash == "#owner_po")
		{			
			$('#current_tab').val("owner_po");
			$('.owner_po').removeClass('hide');
			$('.owner_po').addClass('show');
			$('.filter_none').addClass('show');
			$('.new_payapp').addClass('hide');
			$('.pay-app').addClass('hide');
			$('.new_estimate').addClass('hide');
			$('.po').addClass('hide');
			$('.co').addClass('hide');
			$('.owner_co').addClass('hide');
			
			$('#apply_save_filter').attr('id','apply_save_filter_owner_po');
			$('#apply_save_filter_pay_app').attr('id','apply_save_filter_owner_po');
			$('#apply_save_filter_po').attr('id','apply_save_filter_owner_po');
			$('#apply_save_filter_co').attr('id','apply_save_filter_owner_po');
			$('#apply_save_filter_owner_po').attr('id','apply_save_filter_owner_po');
			$('#apply_save_filter_owner_co').attr('id','apply_save_filter_owner_po');

			$('#update_result').attr('id','update_result_owner_po');
			$('#update_result_pay_app').attr('id','update_result_owner_po');
			$('#update_result_po').attr('id','update_result_owner_po');
			$('#update_result_co').attr('id','update_result_owner_po');
			$('#update_result_owner_co').attr('id','update_result_owner_po');
			$('#update_result_owner_po').attr('id','update_result_owner_po');

			$('#save_filter').attr('id','save_filter_owner_po');
			$('#save_filter_pay_app').attr('id','save_filter_owner_po');
			$('#save_filter_po').attr('id','save_filter_owner_po');
			$('#save_filter_co').attr('id','save_filter_owner_po');
			$('#save_filter_owner_co').attr('id','save_filter_owner_po');
			$('#save_filter_owner_po').attr('id','save_filter_owner_po');

			$('#reset').attr('id','owner_po_search_reset');
			$('#pay_app_search_reset').attr('id','owner_po_search_reset');
			$('#po_search_reset').attr('id','owner_po_search_reset');
			$('#co_search_reset').attr('id','owner_po_search_reset');
			$('#owner_co_search_reset').attr('id','owner_po_search_reset');
			$('#owner_po_search_reset').attr('id','owner_po_search_reset');
			
			//pagination code start here by -- Sidhartha
			default_pagination_length = $('#client_po_default_pagination_length').val();
		    displayStart = $('#client_po_displayStart').val();

			//apply filter code added by -- satheesh kumar
			if(owner_po_apply_filter == true)
			{
				$("#apply_save_filter_co").show();
			}
			else
			{
				$("#apply_save_filter_co").hide();
			}
			// Change Order list page AJAX call for an individual project 
			budget_owner_po_list_view();
			
		}
});

$(function(){
	//$('#pro-group option[value="1"]').prop('disabled', true);	
	$('.filter_none').hide();
	$('.new_estimate').hide();
	$('.new_estimate_con, .new_payapp_con').hide();
	$('.pay-app, .po, .co, .new_payapp, .owner_co, .owner_po').hide();
	$('.budget_pay_app_list_details').hide();
	
    /* checking role access  // by satheesh kumar */
	if (user_account_type == 200)
	{
		$('.filter_none').show();
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .new_payapp').show();
		$('.po, .co').hide();
	}
	/* pay app for owner */
	$('a[href = "#summary"]').click(function(){	
		$('.filter_none').hide();
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .po, .co, .new_payapp, .owner_co, .owner_po').hide();
		
		$('.new_estimate').removeClass('hide show');
		$('.filter_none').removeClass('hide show');
		$('.new_payapp').removeClass('hide show');
		$('.pay-app').removeClass('hide show');
		$('.co').removeClass('hide show');
		$('.po').removeClass('hide show');
		$('.owner_po').removeClass('hide show');
		$('.owner_co').removeClass('hide show');
		$('.error-message').css('display','none');		
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("project_summary");

		default_pagination_length = 5;
		displayStart = 0;

		if($('#previous_tab').val() != $('#current_tab').val())
		{	
			if (budget_project_id == '') 
			{
				project_summary_list_view();	
				setTimeout("budget_summary_list_view()", 1000);	
			}
			else
			{
				summary_tab_change();
			}
		}		
	});
	
	$('a[href = "#jobs"]').click(function(){
		$('.filter_none').hide();		
		$('.new_estimate').show();
		$('.pay-app, .po, .co, .new_payapp, .owner_co, .owner_po').hide();
		$('#new_estimate button').attr('disabled', false);
		
		$('.new_estimate').removeClass('hide show');
		$('.filter_none').removeClass('hide show');
		$('.new_payapp').removeClass('hide show');
		$('.pay-app').removeClass('hide show');
		$('.co').removeClass('hide show');
		$('.po').removeClass('hide show');
		$('.owner_po').removeClass('hide show');
		$('.owner_co').removeClass('hide show');
		$('.error-message').css('display','none');
		// Estimate Job list & cost summary AJAX call for an individual project 
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("jobs");

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");

		default_pagination_length = 5;
		displayStart = 0;

		if($('#previous_tab').val() != $('#current_tab').val())
		{
			tab_check();
			budget_jobs_list_view();
			setTimeout("project_cost_summary()", 1000);
		}
	});
	
	$('a[href = "#owner_co"]').click(function(){
		$('.filter_none').show();		
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .new_payapp, .po, .co, .owner_po').hide();
		$('.owner_co').show();		
		$('.po, .co').removeClass('hide show');
		$('.owner_po').removeClass('hide show');
		$('.owner_po').addClass('hide');
		
		$('.owner_co').removeClass('hide show');
		$('.owner_co').addClass('show');
		
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("owner_co");

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");

		default_pagination_length = $('#client_co_default_pagination_length').val();
		displayStart = $('#client_co_displayStart').val();

		//default_pagination_length = client_co_default_pagination_length;
		//displayStart = client_co_displayStart;

		if($('#previous_tab').val() != $('#current_tab').val())
		{
			budget_owner_co_list_view();
		}		
	});
	
	$('a[href = "#owner_po"]').click(function(){
		$('.filter_none').show();		
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .new_payapp, .po, .co, .owner_co').hide();
		$('.owner_po').show();
		
		$('.new_estimate').removeClass('hide show');
		$('.owner_po').removeClass('hide show');
		$('.owner_co').removeClass('hide show');
		$('.po, .co').removeClass('hide show');
		$('.owner_po').addClass('show');
		$('.filter_none').removeClass('hide show');
		$('.filter_none').addClass('show');
		
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("owner_po");

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");

		default_pagination_length = $('#client_po_default_pagination_length').val();
		displayStart = $('#client_po_displayStart').val();

		//default_pagination_length = client_po_default_pagination_length;
		//displayStart = client_po_displayStart;

		if($('#previous_tab').val() != $('#current_tab').val())
		{
			budget_owner_po_list_view();
		}		
	});
	
	$('a[href = "#pay_app"]').click(function(){	
		$('.filter_none').show();
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .new_payapp').show();
		$('.po, .co, .owner_co, .owner_po').hide();
		
		$('.new_estimate').removeClass('hide show');
		$('.filter_none').removeClass('hide show');
		$('.new_payapp').removeClass('hide show');
		$('.pay-app').removeClass('hide show');
		$('.co').removeClass('hide show');
		$('.po').removeClass('hide show');
		$('.owner_po').removeClass('hide show');
		$('.owner_co').removeClass('hide show');
		$('.error-message').css('display','none');
		// Payapp list page AJAX call for an individual project
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("pay_app");
		$('.new_payapp_con').hide();
		$('#new_payapp button').attr('disabled', false);
		$('.budget_pay_app_list').show();							
		$('.pay-app-list-content').hide();	
		$('.budget_pay_app_list_details').hide();	

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");

		default_pagination_length = $('#payapp_default_pagination_length').val();
		displayStart = $('#payapp_displayStart').val();

		//default_pagination_length = payapp_default_pagination_length;
		//displayStart = payapp_displayStart;

		tab_check();
		budget_pay_app_list_view();	
		
		if($('#previous_tab').val() != $('#current_tab').val())
		{
			// budget_pay_app_list_view();	
		}			
	});
	
	$('a[href = "#po"]').click(function(){	
		$('.filter_none').show();
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .new_payapp , .co, .owner_co, .owner_po').hide();
		$('.po').show();
		
		$('.new_estimate').removeClass('hide show');
		$('.filter_none').removeClass('hide show');
		$('.new_payapp').removeClass('hide show');
		$('.pay-app').removeClass('hide show');
		$('.co').removeClass('hide show');
		$('.po').removeClass('hide show');
		$('.owner_po').removeClass('hide show');
		$('.owner_co').removeClass('hide show');		
		$('.error-message').css('display','none');
		// Purchase Order list page AJAX call for an individual project
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("po");

		//pagination code start here by -- Sidhartha

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");

		default_pagination_length = $('#po_default_pagination_length').val();
		displayStart = $('#po_displayStart').val();

		if($('#previous_tab').val() != $('#current_tab').val())
		{
			budget_po_list_view();

			 //$.ajaxSetup({cache: false});
             //$("#pagination_area").load(location.href + " #pagination_area");
		}		
	});
	
	$('a[href = "#co"]').click(function(){
		$('.filter_none').show();		
		$('.new_estimate').hide();
		$('.new_estimate_con').hide();
		$('.pay-app, .new_payapp, .po, .owner_co, .owner_po').hide();
		$('.co').show();
		
		$('.new_estimate').removeClass('hide show');
		$('.filter_none').removeClass('hide show');
		$('.new_payapp').removeClass('hide show');
		$('.pay-app').removeClass('hide show');
		$('.co').removeClass('hide show');
		$('.po').removeClass('hide show');
		$('.owner_po').removeClass('hide show');
		$('.owner_co').removeClass('hide show');			
		$('.error-message').css('display','none');
		// Change Order list page AJAX call for an individual project 
		// Purchase Order list page AJAX call for an individual project
		$('#previous_tab').val($('#current_tab').val());
		$('#current_tab').val("co");

		//pagination code start here by -- Sidhartha

		$.ajaxSetup({cache: false});
        $("#pagination_area").load(location.href + " #pagination_area");

		default_pagination_length = $('#co_default_pagination_length').val();
		displayStart = $('#co_displayStart').val();

		//default_pagination_length = co_default_pagination_length;
		//displayStart = co_displayStart;

		if($('#previous_tab').val() != $('#current_tab').val())
		{
			budget_co_list_view();
		}		
	});
	
	$('#new_estimate').click(function(){		
		$('.new_estimate_con').show();
		$('#new_estimate button').attr('disabled', true);
				
	});
	$('#close_estimate').click(function(){
		$('.new_estimate_con').hide();
		$('#new_estimate button').attr('disabled', false);		
	});
	$(document).on('click','#new_payapp', function(){		
		$('#ub_payapp_id').val(0);
		$('#payapp_name').val('');
		$('#period_to').val('');
		$('.new_payapp_con').show();
		$('#new_payapp button').attr('disabled', true);		
	});
	$('#close_payapp').click(function(){
		$('.new_payapp_con').hide();
		$('#new_payapp button').attr('disabled', false);		
	});
	
});


$(function() {
	//update_result_form();
	$('#quantity').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#unit_cost').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#overhead_cost').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#datetimepicker2').datetimepicker({
      pickTime: false
    });
	$('#datetimepicker5').datetimepicker({
      pickTime: false
    });
	$('#datetimepicker3').datetimepicker({
      pickTime: false
    });
	$('#datetimepicker6').datetimepicker({
      pickTime: false
    });
	$('#datetimepicker7').datetimepicker({
      pickTime: false
    });
	$(document).on('click', '#budget_pay_app_list tbody tr a.pay_app_name', function (){	
			//$('.budget_pay_app_list').hide();							
			//$('.pay-app-list-content').show();	
			//$('.pay_app_filter').hide();
	});

if (typeof list_page != 'undefined') {
//project_summary_list_view();
 // alert ("hi");
}

});

$('#export_file_project_summary').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#budget_summary_list') > 0){
            var encoded_url = Base64.encode('budget/get_budget_summary/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $(form1).attr('action', submit_url).submit();
        }else{
            $('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
        }
	
	});

//Data table code
function project_summary_list_view() 
{
	var encoded_url = Base64.encode('budget/get_budget_summary/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object
	//alert(123);
	var dbobject = {
		'tableName': $('#budget_summary_list'),
		'this_table' : {'table_name':'budget_project_list'},
		'ajax_encoded_url':ajax_encoded_url,
		'id':'project_name',
		'name' : 'project_name',
		'post_data':'{}',
		'delete_data':{},  
		'edit_data':{},
		'total_estimated_profit_amount':{'index':total_estimated_profit_amount_index},
		'total_plus_minus_budget':{'index':total_plus_minus_budget_index},
		'total_profit_to_date':{'index':total_profit_to_date_index},
		'total_overall_profit':{'index':total_overall_profit_index},
		'display_columns' : datatable_column,
		//[{"data": "project_name"},{"data": "total_amount"},{"data": "total_contract_price"},{"data": "total_plus_minus_budget"},{"data": "total_revised_contract"},{"data": "total_overhead_cost"},{"data": "total_estimated_profit_amount"},{"data": "total_bill_to_client_to_date"},{"data": "total_balance_to_bill_client"},{"data": "total_paid_by_client_to_date"},{"data": "total_unpaid_client_billing"},{"data": "total_invoiced_by_sub_to_date"},{"data": "total_amount_paid_to_sub"},{"data": "total_balance_to_be_invoiced_by_sub"},{"data": "balance_owed_to_sub"},{"data": "cost"},{"data": "total_profit_to_date"},{"data": "total_overall_profit"},{"data": "profit"}],
		'default_order_by': [[0, 'asc']]
					};
	// Populate data table
	ubdatatable(dbobject);
}

//Data table code
function budget_summary_list_view() 
{
	var encoded_url = Base64.encode('budget/get_total_budget_summary/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object
	var dbobject = {
		'tableName': $('#budget_summary_total_list'),
		'this_table' : {'table_name':'budget_summary_total_list'},
		'ajax_encoded_url':ajax_encoded_url,
		'id': 'total_amount',
		'name' : 'total_amount',
		'post_data':'{}',
		'delete_data':{},  
		'edit_data':{},
		'total_estimated_profit_amount':{'index':project_total_estimated_profit_amount_index},
		'total_plus_minus_budget':{'index':project_total_plus_minus_budget_index},
		'total_profit_to_date':{'index':project_total_profit_to_date_index},
		'total_overall_profit':{'index':project_total_overall_profit_index},
		'display_columns' : datatable_column_total_summary,
		//[{"data": "total_amount"},{"data": "total_estimated_revenue"},{"data": "total_plus_minus_budget"},{"data": "total_revised_contract"},{"data": "total_overhead_cost"},{"data": "total_estimated_profit_amount"},{"data": "total_bill_to_client_to_date"},{"data": "total_balance_to_bill_client"},{"data": "total_paid_by_client_to_date"},{"data": "total_unpaid_client_billing"},{"data": "total_invoiced_by_sub_to_date"},{"data": "total_amount_paid_to_sub"},{"data": "total_balance_to_be_invoiced_by_sub"},{"data": "balance_owed_to_sub"},{"data": "cost"},{"data": "total_profit_to_date"},{"data": "total_overall_profit"}],
		'default_order_by': [[0, 'asc']]
		};
	// Populate data table
	ubdatatable(dbobject);
}

$(function() {
	if (typeof list_page != 'undefined') {
		if (user_account_type == 200)
		{
			budget_pay_app_list_view();
		}
		else
		{
			if(budget_project_id == "")
			{
				project_summary_list_view();
				setTimeout("budget_summary_list_view()", 1000);	
			}
			else
			{
				budget_jobs_list_view();
				setTimeout("project_cost_summary()", 1000);
			}
		}
	 // project_cost_summary();
	}
	$(document).on('click','#Estimated_Revenue', function(){
		var estimated_revenue	= $(this).text();
		var client_contract  	= $(this).parent().parent().find('.client_contract').text();
		var client_co		 	= $(this).parent().parent().find('.client_co').text();
		var client_co_count  	= $(this).parent().parent().find('.client_co_count').html();
		var client_contract_count  	= $(this).parent().parent().find('.client_contract_count').html();
		$('span.estimated_revenue').html(estimated_revenue);
		$('span.client_contract').html(client_contract);
		$('span.client_co').html(client_co);
		$('span.client_co_count').html(client_co_count);
		$('span.client_contract_count').html(client_contract_count);
		$('#Estimated_Revenue_Modal').modal('show');
	});
	$(document).on('click','#total_vendor_cost', function(){
		var total_vendor_cost	= $(this).text();
		var vendor_contract  	= $(this).parent().parent().find('.vendor_contract').text();
		var change_order		 	= $(this).parent().parent().find('.change_order').text();		
		$('span.total_vendor_cost').html(total_vendor_cost);
		$('span.vendor_contract').html(vendor_contract);
		$('span.change_order').html(change_order);
		$('#Total_Vendor_Cost_Modal').modal('show');
	});
	
});
$('#export_file_estimate').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#budget_jobs_list') > 0){
            var encoded_url = Base64.encode('budget/get_jobs/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $(form1).attr('action', submit_url).submit();
        }else{
            $('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
        }
	
	});
//Data table code
function budget_jobs_list_view() {
	var encoded_url = Base64.encode('budget/get_jobs/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// Data table Object
	//alert(123);
	var dbobject = {
		'tableName': $('#budget_jobs_list'),
		'this_table' : {'table_name':'budget_jobs_list'},
		'ajax_encoded_url':ajax_encoded_url,
		'id':'ub_estimate_id',
		'name' : 'cost_code_name',
		'post_data':'{}',
		'delete_data':{},  
		'edit_data':{'index':0, 'url':'#'},
		'job_id':'cost_code_id',
		'job_name' : 'po_release_count',
		'po_count' : 'po_count',
		'job_data':{'index':budget_jobs_po_count_index, 'url':'#'},
		'job_co_id':'cost_code_id',
		'job_co_name' : 'co_count',
		'job_co_data':{'index':budget_jobs_co_count_index, 'url':'#'},
		'estimated_revenue':{'index':budget_jobs_estimated_revenue_index, 'url':'#'},
		'total_vendor_cost':{'index':budget_jobs_total_vendor_cost_index, 'url':'#'},
		'plus_minus_budget':{'index':budget_jobs_plus_minus_budget_index,},
		'profit_to_date':{'index':budget_jobs_profit_to_date_index},
		'overall_profit':{'index':budget_jobs_overall_profit_index},
		'client_co_count':{'index':budget_jobs_client_co_count_index, 'url':'#'},
		'job_client_id':'cost_code_id',
		'job_client_name' : 'client_co_count',
		'estimated_profit_amount':{'index':budget_jobs_estimated_profit_amount_index, 'url':'#'},
		'client_po_count':{'index':budget_jobs_client_contract_count_index, 'url':'#'},
		'job_client_po_id':'cost_code_id',
		'job_client_po_name' : 'client_contract_count',
		'display_columns' : datatable_column_budget_jobs,
		//[{"data": "cost_code_name"},{"data": "budget_amount"},{"data": "client_contract", "className":'client_contract'},{"data": "client_contract_count",  "className":'client_contract_count'},{"data": "client_co", "className":'client_co'},{"data": "client_co_count", "className":'client_co_count'},{"data": "estimated_revenue"},{"data": "plus_minus_budget"},{"data": "po_awarded_amount","className":'vendor_contract'},{"data": "po_count"},{"data": "co_awarded_amount","className":'change_order'},{"data": "co_count"},{"data": "total_vendor_cost", "className":'total_vendor_cost'},{"data": "overhead_cost"},{"data": "estimated_profit_amount"},{"data": "bill_to_client_to_date"},{"data": "balance_to_bill_client"},{"data": "paid_by_client_to_date"},{"data": "unpaid_client_billing"},{"data": "invoiced_by_sub_to_date"},{"data": "amount_paid_to_sub"},{"data": "balance_to_be_invoiced_by_sub"},{"data": "total_balance_owed_to_sub"},{"data": "total_cost"},{"data": "profit_to_date"},{"data": "overall_profit"}],
		// 'default_order_by': [[1, 'asc']]
					};
	// Populate data table
	ubdatatable(dbobject);
	/*$('#budget_jobs_list tbody').on('click', 'tr', function () {
		 var name = $('td', this).eq(0).text();
			edit_estimate(name);
	} );
	$('#budget_co_list').on( 'click', 'a.editor_remove', function (e) 
	{
	  var role_id = $(this).attr('id');
	  delete_project({'ub_role_id':{role_id:role_id}});
	}); */
}
function add_po_costcode(id)
{
	//alert(id);
    var encoded_string = Base64.encode('budget/get_po/PO/0/'+id);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    window.location.href = encoded_val;
            
   
}


$(function() {     
	//budget_pay_app_list_view();
});


$(document).on('click','#update_result_pay_app', function(e){	
	budget_pay_app_list_view();
	$('.error-message').hide();
	e.preventDefault();						
	
});	
$('#export_file_payapp').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#budget_pay_app_list') > 0){
            var encoded_url = Base64.encode('budget/get_payapp/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $(form1).attr('action', submit_url).submit();
        }else{
            $('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
        }
	
	});
function budget_pay_app_list_view() {
	var period_to = $('#due_date').val();
	var pay_app_name = $('#pay_app_name').val();
	var encoded_url = Base64.encode('budget/get_payapp/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
	var dbobject = {
						'tableName': $('#budget_pay_app_list'),
						'this_table' : {'table_name':'budget_pay_app_list'},
						'ajax_encoded_url':ajax_encoded_url,
						'id':'ub_payapp_id',
						'name' : 'payapp_number',
						'status' : 'status',
						'post_data':'{"period_to":"'+period_to+'","pay_app_name":"'+pay_app_name+'"}',
						'delete_data':{},  
						'edit_data':{'index':0, 'url':'#'},
						'edit_data1':{'index':4, 'url':'#'},
						'display_columns' : [{"data": "payapp_number"},{"data": "name"},{"data": "period_to"},{"data": "status"},{"data": null, "bSortable": false}],
						// 'default_order_by': [[2, 'desc']]
					};
	// Populate data table
	ubdatatable(dbobject);
	
}


$(function() {
if (typeof list_page != 'undefined') {
  //budget_po_list_view();  
}
//Update result
});
$(document).on('click','#update_result_po', function(e){				
	budget_po_list_view();
	$('.error-message').hide();
	e.preventDefault();			
});

$('#export_file').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#budget_po_list') > 0){
            var encoded_url = Base64.encode('budget/get_po/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $(form1).attr('action', submit_url).submit();
        }else{
            $('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
        }
	
	});	
$('#export_file_co').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#budget_co_list') > 0){
            var encoded_url = Base64.encode('budget/get_co/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $(form1).attr('action', submit_url).submit();
        }else{
            $('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
        }
	
	});	
	//export for owner_co list page
	$('#export_file_owner_co').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#budget_owner_co_list') > 0){
            var encoded_url = Base64.encode('budget/get_owner_co/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $(form1).attr('action', submit_url).submit();
        }else{
            $('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
        }
	
	});	
	//export for owner_po list page
	$('#export_file_owner_po').on('click', function() {
		var form1 = $('#Search_Result');
		if(datatable_getrowcount('#budget_owner_po_list') > 0){
            var encoded_url = Base64.encode('budget/get_owner_po/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var submit_url = base_url + ajax_encoded_url;
            $(form1).attr('action', submit_url).submit();
        }else{
            $('#alertModal').modal('show');
			$('.alert_modal_txt').text('Sorry! No records found for export');
        }
	
	});

//Data table code
function budget_po_list_view(calltype) {
	    var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
        /*var due_date_time = $('#due_date_time').val();
        var po_status = $('#po_status').val();
        var payment_status = $('#payment_result').val();*/

        var due_date_time = typeof $('#due_date_time').val() !== 'undefined' ? $('#due_date_time').val() : '';

        var po_status = typeof $('#po_status').val() !== 'undefined' ? $('#po_status').val() : '';

        var payment_result = typeof $('#payment_result').val() !== 'undefined' ? $('#payment_result').val() : '';
		var costcode = $('#costcode').val();
		var encoded_url = Base64.encode('budget/get_po/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#budget_po_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_po_co_id',
							'name' : 'title',
							'project_id' : 'project_id',
							'paid_amount_index' : {'index':9},
							'cost_index' : {'index':8},
							'this_table' : {'table_name':'budget_po_list'},
							'post_data':'{"fetch_type":"'+fetch_type+'","due_date_time":"'+due_date_time+'","po_status":"'+po_status+'","payment_result":"'+payment_result+'","costcode":"'+costcode+'"}',
							'delete_data':{}, 
							'edit_data':{'index':0, 'url':'budget/save_po_co/PO/'},
							'po_data':{'index':10, 'url':'budget/save_po_co/CO/0/'},
							'status':'po_status',
							'bid_po_id':'bid_po_id',
							'display_columns' : [{"data": "title"},{"data": "ub_po_co_number"},{"data": "package_title", "bSortable": false},{"data": "assigned_to"},{"data": "po_date", "bSortable": false},{"data": "po_status"},{"data": "work_completed"},{"data": "payment_status"},{"data": "total_amount","render": $.fn.dataTable.render.number( ',', '.', 2)},{"data": "paid_amount","render": $.fn.dataTable.render.number( ',', '.', 2)},{"data":"bid_po_id"}],
							// 'default_order_by': [[1, 'asc']]
						};
						// alert(dbobject);
		// Populate data table
		ubdatatable(dbobject);
		$('#budget_po_list').on( 'click', 'a.editor_remove', function (e) 
		{
		  var role_id = $(this).attr('id');
		  delete_project({'ub_role_id':{role_id:role_id}});
		}); 
}
// Code Added By Gayathri kalyani
function add_jobs(type, cost_code_id)
{
	if(type == 0)
	{
		job_type = 'PO';
		other_var = '#po';
	}
	if(type == 1)
	{
		job_type = 'CO';
		other_var = '#co';
	}
	if(type == 2)
	{
	job_type = 'owner_co';
	other_var = '#owner_co';
	}
	if(type == 3)
	{
	job_type = 'owner_po';
	other_var = '#owner_po';
	}
    var encoded_string = Base64.encode('budget/project_budget/'+job_type+'/'+cost_code_id);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    window.location.href = encoded_val+other_var;

   }



$(function() {
if (typeof list_page != 'undefined') {
 //budget_co_list_view();
  
} });
//Update result
$(document).on('click','#update_result_co', function(e){			
	 budget_co_list_view();
	 $('.error-message').hide();
	 e.preventDefault();			
});
//Data table code
function budget_co_list_view(calltype) {
// alert("hi");
        var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
        /*var due_date_time = $('#due_date_time').val();
        var po_status = $('#po_status').val();
        var payment_status = $('#payment_result').val();*/

        var co_due_date_time = typeof $('#co_due_date_time').val() !== 'undefined' ? $('#co_due_date_time').val() : '';

        var co_status = typeof $('#co_status').val() !== 'undefined' ? $('#co_status').val() : '';

        var co_payment_result = typeof $('#co_payment_result').val() !== 'undefined' ? $('#co_payment_result').val() : '';
		var costcode = $('#cocostcode').val();
		var encoded_url = Base64.encode('budget/get_co/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#budget_co_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_po_co_id',
							'name' : 'title',
							'this_table' : {'table_name':'budget_co_list'},
							'paid_amount_index' : {'index':9},
							'cost_index' : {'index':8},
							'post_data':'{"fetch_type":"'+fetch_type+'","co_due_date_time":"'+co_due_date_time+'","co_status":"'+co_status+'","co_payment_result":"'+co_payment_result+'","costcode":"'+costcode+'"}',
							'delete_data':{},  
							'edit_data':{'index':0, 'url':'budget/save_po_co/CO/'},
							'display_columns' : [{"data": "title"},{"data": "ub_po_co_number"},{"data": "package_title" , "bSortable": false},{"data": "assigned_to"},{"data": "po_date", "bSortable": false},{"data": "po_status"},{"data": "work_completed"},{"data": "payment_status"},{"data": "total_amount","render": $.fn.dataTable.render.number( ',', '.', 2)},{"data": "paid_amount","render": $.fn.dataTable.render.number( ',', '.', 2)}],
							// 'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#budget_co_list').on( 'click', 'a.editor_remove', function (e) 
		{
		  var role_id = $(this).attr('id');
		  delete_project({'ub_role_id':{role_id:role_id}});
		}); 
	}

//New Owner Co
/*function budget_owner_co_list_view() {
	$('#budget_owner_co_list').dataTable({						
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5, 
		"sScrollX": "100%",
		"sScrollXInner": "110%",
		"bScrollCollapse": true,					
		sAjaxSource: base_url + 'assets/js/json_budget_owner_co_list.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [1]
		}],				
		"columns":[            
		{"data": "title"},
		{"data": "description"},
		{"data": "status"},
		{"data": "date_created"},
		{"data": "expected_completion"},
		{"data": "assign_sub"}
		
	],
	"order": [[1, 'asc']]

	});
}*/

//Update result
$(document).on('click','#update_result_owner_co', function(e){			
	 budget_owner_co_list_view();
	 $('.error-message').hide();
	 e.preventDefault();			
});
// alert budget_co_list_view()
function budget_owner_co_list_view() {
 var owner_co_due_date_time = $('#owner_co_due_date_time').val();
 var costcode = $('#ownercocostcode').val();
 var co_status = $('#owner_co_status').val();


		var encoded_url = Base64.encode('budget/get_owner_co/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#budget_owner_co_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'id':'ub_po_co_id',
							'name' : 'title',
							'post_data':'{"owner_co_due_date_time":"'+owner_co_due_date_time+'","costcode":"'+costcode+'","co_status":"'+co_status+'"}',
							'delete_data':{},  
							'edit_data':{'index':0, 'url':'budget/save_po_co/OWNER CO/'},
							'display_columns' : [{"data": "ub_po_co_number"},{"data": "title"},{"data": "po_status"},{"data": "created_on"},{"data": "due_date"},{"data": "assigned_to"}],
							// 'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#budget_co_list').on( 'click', 'a.editor_remove', function (e) 
		{
		  var role_id = $(this).attr('id');
		  delete_project({'ub_role_id':{role_id:role_id}});
		}); 
	}
	//Update result
$(document).on('click','#update_result_owner_po', function(e){			
	 budget_owner_po_list_view();
	 $('.error-message').hide();
	 e.preventDefault();			
});
function budget_owner_po_list_view() {
var owner_po_due_date_time = $('#owner_po_due_date_time').val();
var costcode = $('#ownerpocostcodee').val();
 var ownerpostatus = $('#owner_po_status').val();

		var encoded_url = Base64.encode('budget/get_owner_po/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		// Data table Object
		//alert(123);
		var dbobject = {
							'tableName': $('#budget_owner_po_list'),
							'ajax_encoded_url':ajax_encoded_url,
							'this_table' : {'table_name':'budget_owner_po_list'},
							'id':'ub_po_co_id',
							'name' : 'title',
							'project_id' : 'project_id',
							'post_data':'{"owner_po_due_date_time":"'+owner_po_due_date_time+'","costcode":"'+costcode+'","ownerpostatus":"'+ownerpostatus+'"}',
							'delete_data':{},  
							'edit_data':{'index':0, 'url':'budget/save_po_co/OWNER PO/'},
							'po_data':{'index':6, 'url':'budget/save_po_co/OWNER CO/0/'},
							'status':'po_status',
							'bid_po_id':'ub_po_co_id',
							'display_columns' : [{"data": "ub_po_co_number"},{"data": "title"},{"data": "po_status"},{"data": "created_on"},{"data": "due_date"},{"data": "assigned_to"},{"data":"ub_po_co_id"}],
							// 'default_order_by': [[1, 'asc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#budget_co_list').on( 'click', 'a.editor_remove', function (e) 
		{
		  var role_id = $(this).attr('id');
		  delete_project({'ub_role_id':{role_id:role_id}});
		}); 
	}
function add_co(id)
{
	//alert(id);
    var encoded_string = Base64.encode('budget/save_po_co/CO/0/'+id);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    window.location.href = encoded_val;
            
   
}
function add_owner_co(id)
{
	//alert(id);
    var encoded_string = Base64.encode('budget/save_po_co/OWNER CO/0/'+id);
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    window.location.href = encoded_val;
            
   
}

//project cost summary
function project_cost_summary() {
	var encoded_url = Base64.encode('budget/get_project_summary/');
	// var find_users_basedon_project = encoded_destroy_session.strtr(encode_chars_obj);
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	// var ajaxUrl = base_url + find_users_basedon_project;
	// alert(435);
	// alert(datatable_column_budget_summary.toSource());
	var dbobject = {
		'tableName': $('#budget_cost_summary_list'),
		'this_table' : {'table_name':'budget_project_cost_summary'},
		'ajax_encoded_url':ajax_encoded_url,
		'id':'project_name',
		'name' : 'project_name',
		'post_data':'{}',
		'delete_data':{},  
		'edit_data':{},
		'total_plus_minus_budget':{'index':budget_summary_total_plus_minus_budget_index,},
		'total_estimated_profit_amount':{'index':budget_summary_total_estimated_profit_amount_index,},
		'total_profit_to_date':{'index':budget_summary_total_profit_to_date_index,},
		'total_overall_profit':{'index':budget_summary_total_overall_profit_index},
		'total_contract_price':{'index':budget_summary_total_contract_price_index},
		'total_revised_contract':{'index':budget_summary_total_revised_contract_index},
		
		'display_columns' : datatable_column_budget_summary,
		//[{"data": "project_name"},{"data": "total_amount"},{"data": "total_client_contract", "className":"summary_client_contract"},{"data": "total_client_co", "className":"summary_client_co"},{"data": "total_contract_price", "className":"summary_estimated_revenue"},{"data": "total_plus_minus_budget"},{"data": "total_po_awarded_amount", "className":"summary_vendor_contract"},{"data": "total_co_awarded_amount", "className":"summary_vendor_co"},{"data": "total_revised_contract","className":"summary_total_vendor_cost"},{"data": "total_overhead_cost"},{"data": "total_estimated_profit_amount"},{"data": "total_bill_to_client_to_date"},{"data": "total_balance_to_bill_client"},{"data": "total_paid_by_client_to_date"},{"data": "total_unpaid_client_billing"},{"data": "total_invoiced_by_sub_to_date"},{"data": "total_amount_paid_to_sub"},{"data": "total_balance_to_be_invoiced_by_sub"},{"data": "balance_owed_to_sub"},{"data": "cost"},{"data": "total_profit_to_date"},{"data": "total_overall_profit"},{"data": "profit"}],
		// 'default_order_by': [[0, 'asc']]
		};
			// alert('hjhj');		
	// Populate data table
	ubdatatable(dbobject);
}
//---------------------------------****************************---------------------------
$(function(){
	$(document).on('click','#summary_estimated_revenue', function(){
		var summary_estimated_revenue	= $(this).text();
		var summary_client_contract  	= $(this).parent().parent().find('.summary_client_contract').text();
		var summary_client_co		 	= $(this).parent().parent().find('.summary_client_co').text();
		
		$('span.summary_estimated_revenue').html(summary_estimated_revenue);
		$('span.summary_client_contract').html(summary_client_contract);
		$('span.summary_client_co').html(summary_client_co);
		$('#summary_estimated_revenue_modal').modal('show');
	});
	
	$(document).on('click','#summary_total_vendor_cost', function(){
		var summary_total_vendor_cost	= $(this).text();
		var summary_vendor_contract  	= $(this).parent().parent().find('.summary_vendor_contract').text();
		var summary_vendor_co		 	= $(this).parent().parent().find('.summary_vendor_co').text();
		
		$('span.summary_vendor_contract').html(summary_vendor_contract);
		$('span.summary_vendor_co').html(summary_vendor_co);
		$('span.summary_total_vendor_cost').html(summary_total_vendor_cost);
		$('#summary_total_vendor_cost_modal').modal('show');
	});
});
// save filter  for payapp
$(document).on('click','#save_filter_pay_app', function(e){	
	var due_date = $('#due_date').val();	
	var payapp_name = $('#pay_app_name').val();
 	if((!due_date) && (!payapp_name))
	{
		error_box();
		$('.error-message .alerts').text('Please select one mandatory field');	
		return false;
	}
	else{
		payapp_save_filter_function();
		e.preventDefault();	
	}
});

function payapp_save_filter_function(){	
	var due_date = $('#due_date').val();	
	var payapp_name = $('#pay_app_name').val();
	var encoded_url = Base64.encode('budget/payapp_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);	
	var data = 'period_to='+due_date+'&pay_app_name='+payapp_name;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,
		beforeSend: function() {
			//$('.uni_wrapper').addClass('loadingDiv');			
		},		
		success: function(response) {	
			//$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{					
				$("#apply_save_filter_pay_app").show();
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
$(document).on('click','#apply_save_filter_pay_app', function(){
		var encoded_url = Base64.encode('budget/payapp_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('budget/project_budget/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		beforeSend: function() {
		  // $('.uni_wrapper').addClass('loadingDiv');		   
		},		
		success: function(response) {		
			//$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href= base_url + ajax_encoded_urls+ '#pay_app';
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

$(document).on('click','#pay_app_search_reset', function(e){		
	payapp_reset_function();
	e.preventDefault();
});
function payapp_reset_function(){
	var encoded_destroy_session = Base64.encode('budget/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('budget/project_budget/');
	var role_index_url = role_index.strtr(encode_chars_obj);	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BUDGET_PAYAPP","destroy_type":["pay_app_search"]},
		beforeSend: function() {
            //$('.uni_wrapper').addClass('loadingDiv');			
        },
		success: function(response) {		
			//$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url + '#pay_app';
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

//--------------------*********************************-----------------------------
//budget po search
$(document).on('click','#po_search_reset', function(e) {		
	po_reset_function();
	e.preventDefault();
});
function po_reset_function(){
	var encoded_destroy_session = Base64.encode('budget/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('budget/project_budget/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BUDGET_PO","destroy_type":["po_search"]},
		beforeSend: function() {
           // $('.uni_wrapper').addClass('loadingDiv');			
        },		
		success: function(response) {		
		//$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url + '#po';
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

// Save Filter
$(document).on('click','#save_filter_po', function(e){
	var due_date_time = $('#due_date_time').val();
	var po_status = $('#po_status').val();
	var payment_status = $('#payment_result').val();	

 	if((!due_date_time) && (!po_status) && (!payment_status) )
	{
		error_box();
		$('.error-message .alerts').text('Please select one mandatory fields');	
		return false;
	} 	
	po_save_filter_function();
	e.preventDefault();	
});

function po_save_filter_function(){
	var due_date_time = $('#due_date_time').val();
	var po_status = $('#po_status').val();
	var payment_status = $('#payment_result').val();	
	var encoded_url = Base64.encode('budget/po_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'due_date_time='+due_date_time+'&po_status='+po_status+'&payment_status='+payment_status;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,
		beforeSend: function() {
		 // $('.uni_wrapper').addClass('loadingDiv');
		},		
		success: function(response) {	
			//$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{					
				$("#apply_save_filter_po").show();
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
$(document).on('click','#apply_save_filter_po', function(e) {
		var encoded_url = Base64.encode('budget/po_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('budget/project_budget/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		beforeSend: function() {
			//$('.uni_wrapper').addClass('loadingDiv');
		},
		success: function(response) {	
		//	$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				 window.location.href= base_url + ajax_encoded_urls+ '#po';
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

//---------------------------**********************************-------------
//budget co search
$(document).on('click','#co_search_reset', function(e) {		
	co_reset_function();
	e.preventDefault();
});
function co_reset_function(){
	var encoded_destroy_session = Base64.encode('budget/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('budget/project_budget/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BUDGET_CO","destroy_type":["co_search"]},
		beforeSend: function() {
            //$('.uni_wrapper').addClass('loadingDiv');			
        },
		success: function(response) {		
			//$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url + '#co';
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

// Save Filter
$(document).on('click','#save_filter_co', function(e){
	var co_due_date_time = $('#co_due_date_time').val();
	var co_status = $('#co_status').val();
	var co_payment_status = $('#co_payment_result').val();

 	if((!co_due_date_time) && (!co_status) && (!co_payment_status) )
	{
		error_box();
		$('.error-message .alerts').text('Please select one mandatory field');	
		return false;
	} 
	else{
		co_save_filter_function();
		e.preventDefault();
	}
});

function co_save_filter_function(){
	var co_due_date_time = $('#co_due_date_time').val();
	var co_status = $('#co_status').val();
	var co_payment_status = $('#co_payment_result').val();
	var encoded_url = Base64.encode('budget/co_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);	
	var data = 'co_due_date_time='+co_due_date_time+'&co_status='+co_status+'&co_payment_status='+co_payment_status;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,	
		beforeSend: function() {
		  //$('.uni_wrapper').addClass('loadingDiv');			
		},		
		success: function(response) {
			//$('.uni_wrapper').removeClass('loadingDiv');			
			if(response.status == true)
			{					
				$("#apply_save_filter_co").show();
				success_box();
				$('.error-message .alerts').text('Saved filter successfully');	

			}
			else{
				error_box();				
				$('.error-message .alerts').text('saved filter failed');	
			}
		}
	});	
}
//Apply Filter
$(document).on('click','#apply_save_filter_co', function(e) {
		var encoded_url = Base64.encode('budget/co_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('budget/project_budget/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",	
		beforeSend: function() {
		  //$('.uni_wrapper').addClass('loadingDiv');			
		},		
		success: function(response) {
			//$('.uni_wrapper').removeClass('loadingDiv');				
			if(response.status == true)
			{	
				window.location.href= base_url + ajax_encoded_urls+ '#co';
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

//---------------------------**********************************-------------

$(function(){
	$('a[href="#pay_app"]').on('click', function(){
		$('#apply_save_filter').attr('id','apply_save_filter_pay_app');
		$('#apply_save_filter_po').attr('id','apply_save_filter_pay_app');
		$('#apply_save_filter_co').attr('id','apply_save_filter_pay_app');
		$('#apply_save_filter_pay_app').attr('id','apply_save_filter_pay_app');
		$('#apply_save_filter_owner_po').attr('id','apply_save_filter_pay_app');
		$('#apply_save_filter_owner_co').attr('id','apply_save_filter_pay_app');

		$('#update_result').attr('id','update_result_pay_app');
		$('#update_result_po').attr('id','update_result_pay_app');
		$('#update_result_co').attr('id','update_result_pay_app');
		$('#update_result_pay_app').attr('id','update_result_pay_app');
		$('#update_result_owner_co').attr('id','update_result_pay_app');
		$('#update_result_owner_po').attr('id','update_result_pay_app');

		$('#save_filter').attr('id','save_filter_pay_app');
		$('#save_filter_po').attr('id','save_filter_pay_app');
		$('#save_filter_co').attr('id','save_filter_pay_app');
		$('#save_filter_pay_app').attr('id','save_filter_pay_app');
		$('#save_filter_owner_co').attr('id','save_filter_pay_app');
		$('#save_filter_owner_po').attr('id','save_filter_pay_app');
		
		$('#reset').attr('id','pay_app_search_reset');
		$('#po_search_reset').attr('id','pay_app_search_reset');
		$('#co_search_reset').attr('id','pay_app_search_reset');
		$('#pay_app_search_reset').attr('id','pay_app_search_reset');
		$('#owner_co_search_reset').attr('id','pay_app_search_reset');
		$('#owner_po_search_reset').attr('id','pay_app_search_reset');
		
		if(payapp_apply_filter == true)
		{
			$("#apply_save_filter_pay_app").show();
		}
		else
		{
			$("#apply_save_filter_pay_app").hide();
		}	
    });

    $('a[href="#po"]').on('click', function(){
		$('#apply_save_filter').attr('id','apply_save_filter_po');
		$('#apply_save_filter_pay_app').attr('id','apply_save_filter_po');
		$('#apply_save_filter_po').attr('id','apply_save_filter_po');
		$('#apply_save_filter_co').attr('id','apply_save_filter_po');
		$('#apply_save_filter_owner_po').attr('id','apply_save_filter_po');
		$('#apply_save_filter_owner_co').attr('id','apply_save_filter_po');

		$('#update_result_pay_app').attr('id','update_result_po');
		$('#update_result_po').attr('id','update_result_po');
		$('#update_result_co').attr('id','update_result_po');
		$('#update_result').attr('id','update_result_po');
		$('#update_result_owner_co').attr('id','update_result_po');
		$('#update_result_owner_po').attr('id','update_result_po');

		$('#save_filter_pay_app').attr('id','save_filter_po');	
		$('#save_filter_po').attr('id','save_filter_po');
		$('#save_filter_co').attr('id','save_filter_po');
		$('#save_filter').attr('id','save_filter_po');
		$('#save_filter_owner_co').attr('id','save_filter_po');
		$('#save_filter_owner_po').attr('id','save_filter_po');
		
		$('#pay_app_search_reset').attr('id','po_search_reset');
		$('#po_search_reset').attr('id','po_search_reset');
		$('#co_search_reset').attr('id','po_search_reset');
		$('#reset').attr('id','po_search_reset');
		$('#owner_co_search_reset').attr('id','po_search_reset');
		$('#owner_po_search_reset').attr('id','po_search_reset');
		
		if(po_apply_filter == true)
		{
			$("#apply_save_filter_po").show();
		}
		else
		{
			$("#apply_save_filter_po").hide();
		}	
    });
	
    $('a[href="#co"]').on('click', function(){
		$('#apply_save_filter').attr('id','apply_save_filter_co');
		$('#apply_save_filter_pay_app').attr('id','apply_save_filter_co');
		$('#apply_save_filter_po').attr('id','apply_save_filter_co');
		$('#apply_save_filter_co').attr('id','apply_save_filter_co');
		$('#apply_save_filter_owner_po').attr('id','apply_save_filter_co');
		$('#apply_save_filter_owner_co').attr('id','apply_save_filter_co');

		$('#update_result').attr('id','update_result_co');
		$('#update_result_pay_app').attr('id','update_result_co');
		$('#update_result_po').attr('id','update_result_co');
		$('#update_result_co').attr('id','update_result_co');
		$('#update_result_owner_co').attr('id','update_result_co');
		$('#update_result_owner_po').attr('id','update_result_co');

		$('#save_filter').attr('id','save_filter_co');
		$('#save_filter_pay_app').attr('id','save_filter_co');
		$('#save_filter_po').attr('id','save_filter_co');
		$('#save_filter_co').attr('id','save_filter_co');
		$('#save_filter_owner_co').attr('id','save_filter_co');
		$('#save_filter_owner_po').attr('id','save_filter_co');
		
		$('#reset').attr('id','co_search_reset');
		$('#pay_app_search_reset').attr('id','co_search_reset');
		$('#po_search_reset').attr('id','co_search_reset');
		$('#co_search_reset').attr('id','co_search_reset');
		$('#owner_co_search_reset').attr('id','co_search_reset');
		$('#owner_po_search_reset').attr('id','co_search_reset');
		
		if(co_apply_filter == true)
		{
			$("#apply_save_filter_co").show();
		}
		else
		{
			$("#apply_save_filter_co").hide();
		}
    });
	$('a[href="#owner_po"]').on('click', function(){
		$('#apply_save_filter').attr('id','apply_save_filter_owner_po');
		$('#apply_save_filter_pay_app').attr('id','apply_save_filter_owner_po');
		$('#apply_save_filter_po').attr('id','apply_save_filter_owner_po');
		$('#apply_save_filter_co').attr('id','apply_save_filter_owner_po');
		$('#apply_save_filter_owner_po').attr('id','apply_save_filter_owner_po');
		$('#apply_save_filter_owner_co').attr('id','apply_save_filter_owner_po');

		$('#update_result').attr('id','update_result_owner_po');
		$('#update_result_pay_app').attr('id','update_result_owner_po');
		$('#update_result_po').attr('id','update_result_owner_po');
		$('#update_result_co').attr('id','update_result_owner_po');
		$('#update_result_owner_co').attr('id','update_result_owner_po');
		$('#update_result_owner_po').attr('id','update_result_owner_po');

		$('#save_filter').attr('id','save_filter_owner_po');
		$('#save_filter_pay_app').attr('id','save_filter_owner_po');
		$('#save_filter_po').attr('id','save_filter_owner_po');
		$('#save_filter_co').attr('id','save_filter_owner_po');
		$('#save_filter_owner_co').attr('id','save_filter_owner_po');
		$('#save_filter_owner_po').attr('id','save_filter_owner_po');

		$('#reset').attr('id','owner_po_search_reset');
		$('#pay_app_search_reset').attr('id','owner_po_search_reset');
		$('#po_search_reset').attr('id','owner_po_search_reset');
		$('#co_search_reset').attr('id','owner_po_search_reset');
		$('#owner_co_search_reset').attr('id','owner_po_search_reset');
		$('#owner_po_search_reset').attr('id','owner_po_search_reset');
		
		//apply filter code added by -- satheesh kumar
		if(owner_po_apply_filter == true)
		{
			$("#apply_save_filter_owner_po").show();
		}
		else
		{
			$("#apply_save_filter_owner_po").hide();
		}
    });	
	$('a[href="#owner_co"]').on('click', function(){
		$('#apply_save_filter').attr('id','apply_save_filter_owner_co');
		$('#apply_save_filter_pay_app').attr('id','apply_save_filter_owner_co');
		$('#apply_save_filter_po').attr('id','apply_save_filter_owner_co');
		$('#apply_save_filter_co').attr('id','apply_save_filter_owner_co');
		$('#apply_save_filter_owner_po').attr('id','apply_save_filter_owner_co');
		$('#apply_save_filter_owner_co').attr('id','apply_save_filter_owner_co');

		$('#update_result').attr('id','update_result_owner_co');
		$('#update_result_pay_app').attr('id','update_result_owner_co');
		$('#update_result_po').attr('id','update_result_owner_co');
		$('#update_result_co').attr('id','update_result_owner_co');
		$('#update_result_owner_co').attr('id','update_result_owner_co');
		$('#update_result_owner_po').attr('id','update_result_owner_co');

		$('#save_filter').attr('id','save_filter_owner_co');
		$('#save_filter_pay_app').attr('id','save_filter_owner_co');
		$('#save_filter_po').attr('id','save_filter_owner_co');
		$('#save_filter_co').attr('id','save_filter_owner_co');
		$('#save_filter_owner_co').attr('id','save_filter_owner_co');
		$('#save_filter_owner_po').attr('id','save_filter_owner_co');

		$('#reset').attr('id','co_search_reset');
		$('#pay_app_search_reset').attr('id','owner_co_search_reset');
		$('#po_search_reset').attr('id','owner_co_search_reset');
		$('#co_search_reset').attr('id','owner_co_search_reset');
		$('#owner_co_search_reset').attr('id','owner_co_search_reset');
		$('#owner_po_search_reset').attr('id','owner_co_search_reset');
		
		//apply filter code added by -- satheesh kumar
		if(owner_co_apply_filter == true)
		{
			$("#apply_save_filter_owner_co").show();
		}
		else
		{
			$("#apply_save_filter_owner_co").hide();
		}
    });
}); 

$(function(){
	if (user_account_type == 200)
	{
		$('#apply_save_filter').attr('id','apply_save_filter_pay_app');
		$('#apply_save_filter_pay_app').attr('id','apply_save_filter_pay_app');

		$('#update_result').attr('id','update_result_pay_app');
		$('#update_result_pay_app').attr('id','update_result_pay_app');

		$('#save_filter').attr('id','save_filter_pay_app');
		$('#save_filter_pay_app').attr('id','save_filter_pay_app');
		
		$('#reset').attr('id','pay_app_search_reset');
		$('#pay_app_search_reset').attr('id','pay_app_search_reset');
		
		if(payapp_apply_filter == true)
		{
			$("#apply_save_filter_pay_app").show();
		}
		else
		{
			$("#apply_save_filter_pay_app").hide();
		}
	}	
});
/* function update_result_form(){	
	var updateresultform = $('#Search_Result').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#update_result_pay_app'			
        },
        fields: {
            'pay_app_name': {
                validators: {
                    notEmpty: {
                        message: 'The pay app name cannot be empty'
                    }
                }
            }
        }
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#budget_index").val() == 'update_result_pay_app'){
				budget_pay_app_list_view();				
			 }
			e.preventDefault();			 
	  });  
}
 */

/* $('#budget_select_project').on('click', function(){
	$('.filter li').addClass('budget_enable');	 
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
	return false;
}); */

//--------------------*********************************-----------------------------
//budget owner co search
$(document).on('click','#owner_co_search_reset', function(e) {		
	owner_co_reset_function();
	e.preventDefault();
});
function owner_co_reset_function(){
	var encoded_destroy_session = Base64.encode('budget/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('budget/project_budget/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BUDGET_OWNER_CO","destroy_type":["owner_co_search"]},
		beforeSend: function() {
           // $('.uni_wrapper').addClass('loadingDiv');			
        },		
		success: function(response) {		
		//$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url + '#owner_co';
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

// Save Filter
$(document).on('click','#save_filter_owner_co', function(e){
		var costcode = $('#ownercocostcode').val();
		var co_status = $('#owner_co_status').val();

 	if((!costcode) && (!co_status))
	{
		error_box();
		$('.error-message .alerts').text('Please select one mandatory fields');	
		return false;
	} 	
	owner_co_save_filter_function();
	e.preventDefault();	
});

function owner_co_save_filter_function(){
	var owner_co_due_date_time = $('#owner_co_due_date_time').val();
	var costcode = $('#ownercocostcode').val();
	var owner_co_status = $('#owner_co_status').val();	
	var encoded_url = Base64.encode('budget/owner_co_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'owner_co_due_date_time='+owner_co_due_date_time+'&costcode='+costcode+'&owner_co_status='+owner_co_status;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,
		beforeSend: function() {
		 // $('.uni_wrapper').addClass('loadingDiv');
		},		
		success: function(response) {	
		//	$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{					
				$("#apply_save_filter_owner_co").show();
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
$(document).on('click','#apply_save_filter_owner_co', function(e) {
		var encoded_url = Base64.encode('budget/owner_co_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('budget/project_budget/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		beforeSend: function() {
		//	$('.uni_wrapper').addClass('loadingDiv');
		},
		success: function(response) {	
		//	$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				 window.location.href= base_url + ajax_encoded_urls+ '#owner_co';
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
//--------------------*********************************-----------------------------
//budget owner po search
$(document).on('click','#owner_po_search_reset', function(e) {		
	owner_po_reset_function();
	e.preventDefault();
});
function owner_po_reset_function(){
	var encoded_destroy_session = Base64.encode('budget/destroy_session/');
	var destroy_session_url = encoded_destroy_session.strtr(encode_chars_obj);
	
	var role_index = Base64.encode('budget/project_budget/');
	var role_index_url = role_index.strtr(encode_chars_obj);
	
	$.ajax({
		url: base_url + destroy_session_url,
		dataType: "json",
		type: "post",
		data: {"module_name":"BUDGET_OWNER_PO","destroy_type":["owner_po_search"]},
		beforeSend: function() {
           // $('.uni_wrapper').addClass('loadingDiv');			
        },		
		success: function(response) {		
		//$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				window.location.href = role_index_url + '#owner_po';
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

// Save Filter
$(document).on('click','#save_filter_owner_po', function(e){
		var costcode = $('#ownerpocostcodee').val();
		var co_status = $('#owner_po_status').val();

 	if((!costcode) && (!co_status))
	{
		error_box();
		$('.error-message .alerts').text('Please select one mandatory fields');	
		return false;
	} 	
	owner_po_save_filter_function();
	e.preventDefault();	
});

function owner_po_save_filter_function(){
	var owner_po_due_date_time = $('#owner_po_due_date_time').val();
	var costcode = $('#ownerpocostcodee').val();
	var owner_po_status = $('#owner_po_status').val();	
	var encoded_url = Base64.encode('budget/owner_po_apply_saved_search/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	
	var data = 'owner_po_due_date_time='+owner_po_due_date_time+'&costcode='+costcode+'&owner_po_status='+owner_po_status;
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: data,
		beforeSend: function() {
		 // $('.uni_wrapper').addClass('loadingDiv');
		},		
		success: function(response) {	
			//$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{					
				$("#apply_save_filter_owner_po").show();
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
$(document).on('click','#apply_save_filter_owner_po', function(e) {
		var encoded_url = Base64.encode('budget/owner_po_apply_saved_search/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		
		var encoded_urls = Base64.encode('budget/project_budget/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		beforeSend: function() {
			//$('.uni_wrapper').addClass('loadingDiv');
		},
		success: function(response) {	
			//$('.uni_wrapper').removeClass('loadingDiv');
			if(response.status == true)
			{	
				 window.location.href= base_url + ajax_encoded_urls+ '#owner_po';
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

/* ----------------------------------------------------------------------------------- */

$('#import_template').on('click',function(){
	var encoded_url = Base64.encode('budget/import_budget_poco/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var ajaxData  = $("#import_from_template").serialize();
	//alert(ajaxData);
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: ajaxData,
		beforeSend: function() {
					//$('.uni_wrapper').addClass('loadingDiv');
		},
		success: function(response) {		
			if(response.status == true)
			{	
				//$('.uni_wrapper').removeClass('loadingDiv');
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Imported Successfully');
				$("#Import_modal").modal('hide');
				budget_po_list_view();
				
			}
			else
			{
				//$('.uni_wrapper').removeClass('loadingDiv');
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('No Template Found. Please create a template.');
			}
		}
	});
});

$('#import_template_jobs').on('click',function(){
	var encoded_url = Base64.encode('budget/import_budget_jobs/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var ajaxData  = $("#import_from_template_jobs").serialize();
	//alert(ajaxData);
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: ajaxData,
		beforeSend: function() {
				//	$('.uni_wrapper').addClass('loadingDiv');
		},
		success: function(response) {		
			if(response.status == true)
			{	
				//$('.uni_wrapper').removeClass('loadingDiv');
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Imported Successfully');
				$("#Import_modal_jobs").modal('hide');
				budget_jobs_list_view();
			}
			else
			{
				//$('.uni_wrapper').removeClass('loadingDiv');
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('No Template Found. Please create a template.');
			}
		}
	});
});