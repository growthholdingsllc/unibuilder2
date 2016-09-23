imgLink = base_url + 'assets/images/'; 
$(function(){	

$('#mail-reply-button').click(function() {
	$('#mail-reply').toggle();
	return false;
});
		
	lead_activity_table();

	/*$('#alternative_email').tagsinput({		
   		allowDuplicates: false
   	});*/
   	$('#alt-email').tagsinput({		
   		allowDuplicates: false
   	});
	$('#alt-email-to').tagsinput({		
   		allowDuplicates: false
   	});
	$('#alt-email-cc').tagsinput({		
   		allowDuplicates: false
   	});
	$('#alt-email-bcc').tagsinput({		
   		allowDuplicates: false
   	});
	
	$('#s_alt-email').tagsinput({		
   		allowDuplicates: false
   	});
	$('#s_alt-email-to').tagsinput({		
   		allowDuplicates: false
   	});
	$('#s_alt-email-cc').tagsinput({		
   		allowDuplicates: false
   	});
	$('#s_alt-email-bcc').tagsinput({		
   		allowDuplicates: false
   	});
	var confidence = $('#sl1').val();	
	$('#sl1').slider({	
          formater: function(value) {
            return 'Current value: '+ value;
          }
        });
		var x = $("#sl1").slider();    
        x.slider('setValue', confidence ); 	
	$('.lead_checked_marked').hide();	
	$('.lead_unchecked_marked').click(function(){		
		$(this).hide();
		$('.lead_checked_marked').show();
		$('#lead_marked-list').val("No");		
		$('#datetimepicker10').find('input').attr("disabled", true);
		$('#schedule-time').find('input').attr("disabled", true);
		//$('#reminder_id').attr("disabled", true);
									
	});
	$('.lead_checked_marked').click(function(){
		$(this).hide();
		$('.lead_unchecked_marked').show();
		$('#lead_marked-list').val("Yes");	
		$('#datetimepicker10').find('input').attr("disabled", false);
		$('#schedule-time').find('input').attr("disabled", false);	
		//$('#reminder_id').attr("disabled", false);
	});
	$('.log_complete , .s_lead_act').hide();	
	$('.Schedule_complete').hide();
	
	/* Log Activity */	
	$(document).on('click', '#log-complete-activity', function() {
		//var lead_activity_id = $('#lead_activity_id').val();
		
		$(this).attr('id','log-complete-activity-new');
		$('#schedule_activity_new').attr('id','schedule_activity');		
		$('.log_complete').show();		
		$('.lead_act').hide();		
		$('.Schedule_complete').hide();		
		$('.log_complete .tabbable .nav-tabs li').removeClass('active');
		$('.log_complete .tabbable .nav-tabs li:first-child').addClass('active');
		$('.log_complete .tabbable .tab-content #general').addClass('active');
		$('.log_complete .tabbable .tab-content #sendmail').removeClass('active');
		$('.email-btn-all').css('visibility','hidden');		
		$('#lead_activity_id').val('');
	});	
	$(document).on('click', '#log-complete-activity-new', function() {			
		$(this).attr('id','log-complete-activity'); 
		$('#schedule_activity_new').attr('id','schedule_activity');
		$('.log_complete').hide();		
		$('.lead_act').show();		
		$('.Schedule_complete').hide();		
		$('.log_complete .tabbable .nav-tabs li').removeClass('active');
		$('.log_complete .tabbable .nav-tabs li:first-child').addClass('active');
		$('.log_complete .tabbable .tab-content #general').addClass('active');
		$('.log_complete .tabbable .tab-content #sendmail').removeClass('active');
		$('.email-btn-all').css('visibility','hidden');		
		$('#lead_activity_id').val('');
	});
	/* /Log Activity */
	/* Shcedule */	
	$(document).on('click', '#schedule_activity', function() {
		$(this).attr('id','schedule_activity_new'); 
		$('#log-complete-activity-new').attr('id','log-complete-activity'); 
		$('.Schedule_complete').show();						
		$('.log_complete').hide();		
		$('.lead_act').hide();		
		$('.s_lead_checked_marked').show();	
		$('.s_lead_unchecked_marked').hide();
		$('#s_datetimepicker10').find('input').attr("disabled", true);
		$('#s_schedule-time').find('input').attr("disabled", true);	
		$('.Schedule_complete .tabbable .nav-tabs li').removeClass('active');
		$('.Schedule_complete .tabbable .nav-tabs li:first-child').addClass('active');
		$('.Schedule_complete .tabbable .tab-content #s_general').addClass('active');
		$('.Schedule_complete .tabbable .tab-content #s_sendmail').removeClass('active');
		$('.email-btn-all').css('visibility','hidden');		
	});
	$(document).on('click', '#schedule_activity_new', function() {
		$(this).attr('id','schedule_activity');
		$('#log-complete-activity-new').attr('id','log-complete-activity');		
		$('.Schedule_complete').hide();						
		$('.log_complete').hide();		
		$('.lead_act').show();		
		$('.s_lead_checked_marked').show();	
		$('.s_lead_unchecked_marked').hide();
		$('#s_datetimepicker10').find('input').attr("disabled", true);
		$('#s_schedule-time').find('input').attr("disabled", true);	
		$('.Schedule_complete .tabbable .nav-tabs li').removeClass('active');
		$('.Schedule_complete .tabbable .nav-tabs li:first-child').addClass('active');
		$('.Schedule_complete .tabbable .tab-content #s_general').addClass('active');
		$('.Schedule_complete .tabbable .tab-content #s_sendmail').removeClass('active');
		$('.email-btn-all').css('visibility','hidden');		
	});
	$('.s_lead_checked_marked').hide();	
	$('.s_lead_unchecked_marked').click(function(){		
		$(this).hide();
		$('.s_lead_checked_marked').show();
		$('#s_lead_marked-list').val("No");		
		$('#s_datetimepicker10').find('input').attr("disabled", true);
		$('#s_schedule-time').find('input').attr("disabled", true);	
		$('#s_reminder_id').attr("disabled", false);		
	});
	$('.s_lead_checked_marked').click(function(){
		$(this).hide();
		$('.s_lead_unchecked_marked').show();
		$('#s_lead_marked-list').val("Yes");		
		$('#s_datetimepicker10').find('input').attr("disabled", false);
		$('#s_schedule-time').find('input').attr("disabled", false);	
		$('#s_reminder_id').attr("disabled", true);	
	});
	/* /Shcedule */
	$('.general-btn-all a img.uni_save , .general-btn-all a img.uni_cancel , .email-btn-all a img.uni_cancel ').click(function(){
		$('#schedule_activity_new').attr('id','schedule_activity');
		$('#log-complete-activity-new').attr('id','log-complete-activity');
		$('.lead_act').show();
		$('.log_complete').hide();
	});
	$('.s_general-btn-all a img.uni_save , .s_general-btn-all a img.uni_cancel , .s_email-btn-all a img.uni_cancel ').click(function(){	
		$('#schedule_activity_new').attr('id','schedule_activity');
		$('#log-complete-activity-new').attr('id','log-complete-activity');	
		$('.lead_act').show();
		$('.Schedule_complete').hide();
	});	
	$('#datetimepicker5').datetimepicker({
			pickTime: false
	});
	$('#datetimepicker11').datetimepicker({
			pickTime: false
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
	

});
//Insert code starts here
$(function() {
//Add and back
$('#add_lead_new_back').on('click',function() {
		$("#save_type").val('save_and_back');
		add_lead_form();
});
//Add and New
$('#add_lead_new_new').on('click',function() {
		$("#save_type").val('save_and_new');
		add_lead_form();
});
$('#save_lead_info').on('click',function() {
		$("#save_type").val('save_and_stay');
		add_lead_form();
});
//Add and Stay
$('#add_lead_new_stay').click(function (e) {
	var lead_id = $('#ub_lead_id').val();
	if(lead_id > 0)
	{
		add_lead_form();
	}
	else
	{
		$("#save_type").val('save_and_stay');
		add_lead_form();
	}
});
$('#leadinfotab a').click(function (e) {
	var lead_id = $('#ub_lead_id').val();
	if(lead_id > 0)
	{
		add_lead_form();
	}
	else
	{
		$("#save_type").val('save_and_stay');
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
});
$('#add_new_activity_new_stay').click(function (e) {
	$("#save_type").val('update_completed_activity');
	add_activity_form();
});
var ub_lead_activity_id = $('#ub_lead_activity_id').val();
if(ub_lead_activity_id > 0)
	{
		get_activity_form(ub_lead_activity_id);
	}
});
$(function(){	 
	$('#compose').on('ifChecked', function(event)
	{
        var module_pk_id = $("#module_pk_id").val();
        if (module_pk_id > 0) 
    	{
    		email_thread_form();
    	}
    }); 
	$('.alter-mail').hide();	
	$('.alter-mail').parent().find('.bootstrap-tagsinput').hide();	
	$('#alter-email').on('ifChecked', function(event){		 
		$(".log_complete .composedmail").show();		
		$('.alter-mail').parent().find('.bootstrap-tagsinput').show();
	});
	$("#alter-email").on('ifUnchecked', function(event){				
		$(".log_complete .composedmail").show();		
		$('.alter-mail').hide(); 
		$('.alter-mail').parent().find('.bootstrap-tagsinput').hide();		
	});
	
	$('.s_alter-mail').hide();	
	$('.s_alter-mail').parent().find('.bootstrap-tagsinput').hide();	
	$('#s_alter-email').on('ifChecked', function(event){		 
		 $(".Schedule_complete .composedmail").show();	
		$('.s_alter-mail').parent().find('.bootstrap-tagsinput').show();
	});
	$("#s_alter-email").on('ifUnchecked', function(event){				
		 $(".Schedule_complete .composedmail").show();		
		$('.s_alter-mail').hide(); 
		$('.s_alter-mail').parent().find('.bootstrap-tagsinput').hide();		
	});
	
	$('.composedmail').hide();
	$('.email-btn-all ,.s_email-btn-all').css('visibility','hidden');	
	
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function(e) {
		if ($('input[name="name"]').is(':checked') ) {					
			$(this).parent().addClass('checked');
			$('.email-btn-all').css('visibility','visible');				
		}
		if ($('input[name="mail"]').is(':checked') ) {					
			$(this).parent().addClass('checked');
			$('.s_email-btn-all').css('visibility','visible');
		}
		if ($('#compose').is(':checked') ) {			
			$(".log_complete .composedmail").show();
			$('#compose').parent().addClass('checked');
			$('.email-btn-all').css('visibility','visible');
		} 
		if ($('#s_compose').is(':checked') ) {			
			$(".Schedule_complete .composedmail").show();
			$('#s_compose').parent().addClass('checked');
			$('.s_email-btn-all').css('visibility','visible');			
		}
	});
	if ($('#compose').is(':checked') ) {			
			$(".log_complete .composedmail").show();
			$('#compose').parent().addClass('checked');
		} 
		if ($('#s_compose').is(':checked') ) {			
			$(".Schedule_complete .composedmail").show();
			$('#s_compose').parent().addClass('checked');		
		}
	 $('.log_complete input').on('ifChecked', function(event){			          
            if($(this).prop("value")=="composedmail"){
                $(".log_complete .composedmail").show();
				$('.email-btn-all').css('visibility','visible');
				$('#compose').attr("checked", "checked");					
            }
			if($(this).prop("value")=="notmail"){                
				$(".log_complete .composedmail").hide();				
				$('#compose').removeAttr("checked");
				$('.email-btn-all').css('visibility','hidden');
            }
            
        });
		$('.Schedule_complete input').on('ifChecked', function(event){			          
            if($(this).prop("value")=="composedmail"){
                $(".Schedule_complete .composedmail").show();
				$('.s_email-btn-all').css('visibility','visible');
				$('#s_compose').attr("checked", "checked");				
            }
			if($(this).prop("value")=="notmail"){                
				$(".Schedule_complete .composedmail").hide();
				$('#s_compose').removeAttr("checked");
				$('.s_email-btn-all').css('visibility','hidden');
            }
            
        });					
});
/*(function() {        
	alert("hello");
        lead_activity_table();				       				
    });*/
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
							'name' : 'activity_type',
							'post_data':'{"fetch_type":"'+fetch_type+'","ub_lead_id":"'+ub_lead_id+'"}',
							'update_data':{'index':6}, 
							'edit_data':{'index':0, 'url':'leads/save_lead/'},
							'display_columns' : [{"data": "activity_type"},{"data": "first_name"},{"data": "name"},{"data": "activity_date"},{"data": "followup_date"},{"data": "modified_on"},{"className": 'da-tab-checkbox',"orderable": false,"data": 'ub_lead_activity_id', "defaultContent": '<input type="checkbox" class="chk" />'}],
							'default_order_by': [[6, 'desc']]
						};
		// Populate data table
		ubdatatable(dbobject);
		$('#lead_activity').on( 'click', 'a.editor_remove', function (e) {
		  var lead_id = $(this).attr('id');
		  delete_role({'ub_lead_activity_id':{lead_activity_id:lead_activity_id}});
		});
    }
/*$(function() {        
        lead_activity_table();				       				
    });
    function lead_activity_table() {
        $('#lead_activity').dataTable({				
            "aLengthMenu": [
                [5, 15, 50, 100],
                [5, 15, 50, "l00"]
            ],
            "iDisplayLength": 5,           		   		   
            sAjaxSource: base_url + 'assets/js/lead.json',
            "aoColumnDefs": [{"bSortable": false,"aTargets": [3]}],			 
			 "columns": [
			 //{"sTitle":'<input type="checkbox"/>',"className": 'da-tab-checkbox',"orderable": false,"data": null,"defaultContent": '<input type="checkbox" />'},			 
			 {"sTitle":"Status","data": "Status"},
			 {"sTitle":"Activity Type","data": "ActivityType"},
			 {"sTitle":"Sales Person","data": "SalesPerson","orderable": false,"bSortable": false},
			 {"sTitle":"","data": "interaction","bSortable": false,"orderable": false, "width":"20px","className":'arrow-bor'},
			 {"sTitle":"Lead","data": "Lead","className":'arrow-bor',"orderable": false,"bSortable": false},
			 {"sTitle":"Due By","data": "DueBy"},
			 {"sTitle":"Followup","data": "Followup"},
			 {"sTitle":"Updated","data": "Updated"},
			 {"sTitle":"Mark Complete","data": "MarkComplete"}
			 ],
			 "fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {
				 var right_interaction = '<div class="text-center"><img src="' + imgLink + 'inter_right.png"/></div>';
				 var left_interaction =  '<div class="text-center"><img src="' + imgLink + 'inter_left.png"/></div>';
				 var Overdue =  '<div class="text-danger">'+ data['Status'] +'</div>';
				 var Completed =  '<div class="text-left">'+ data['Status'] +'</div>';
				 if (data['interaction'] === "0") {
					$('td:eq(3)', nRow).html(right_interaction);					
				 }
				if (data['interaction'] === "1") {
					$('td:eq(3)', nRow).html(left_interaction);					
				 }
				 if (data['Status'] === "Overdue") {
					$('td:eq(0)', nRow).html(Overdue);					
				 }
				 if (data['Status'] === "Completed") {
					$('td:eq(0)', nRow).html(Completed);					
				 }
				var MarkComplete = '<div class="text-center"><a href="javascript:void(0);" class="unchecked"><img src="' + imgLink + 'small_box-1.png"/></a> <a href="javascript:void(0);" class="checked" style="display:none;"><img src="' + imgLink + 'small_green_tickbox.png"/></a><input class="marked-list" type="hidden" value="" name=""></div>';
				$('td:eq(8)', nRow).html(MarkComplete);	
				return nRow;				
            },
			 "order": [[1, 'asc']]
        });		
		$('#lead_activity tbody').on('click', 'a.unchecked', function () {			
			$(this).hide();
			$(this).parent().find('.checked').show();
			$(this).parent().find('.marked-list').attr("checked", true);
		});
		$('#lead_activity tbody').on('click', 'a.checked', function () {			
			$(this).hide();
			$(this).parent().find('.unchecked').show();
			$(this).parent().find('.marked-list').attr("checked", false);
		});
    }*/
	
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
					alert("Added successfully");
					$("#AddProjectType").modal('hide');
				}else
				{
					alert("Insertion failed");
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
							alert("Deleted successfully");
							$("#EditProjectType").modal('hide');
						}else
						{
							alert("Deletion failed: "+response.message);
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
					alert("Added successfully");
					$("#AddSource").modal('hide');
				}else
				{
					alert("Insertion failed");
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
							alert("Deleted successfully");
							$("#EditSource").modal('hide');
						}else
						{
							alert("Deletion failed: "+response.message);
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
					alert("Added successfully");
					$("#AddNewTag").modal('hide');
				}else
				{
					alert("Insertion failed");
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
							alert("Deleted successfully");
							$("#EditNewTag").modal('hide');
						}else
						{
							alert("Deletion failed: "+response.message);
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
					alert("Added successfully");
					$("#AddActivityType").modal('hide');
				}else
				{
					alert("Insertion failed");
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
							alert("Deleted successfully");
							$("#EditNewActivityType").modal('hide');
						}else
						{
							alert("Deletion failed: "+response.message);
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
// Code for save page
function add_formval(){
	// var tags = $('#tags').val();
	//alert("hello");
	var add_new_task = $('#add_new_lead').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'title': {
                validators: {
                    notEmpty: {
                        message: 'Title is required and cannot be empty'
                    }
                }
            }
        }		/* added closing brace */
			
		
    }).on('success.form.fv', function(e) {
		add_lead_form();			
		e.preventDefault();	
	});
	
}

function add_lead_form() {
	// Encode the String
	var ub_lead_id = $('#ub_lead_id').val();
	var name = $('#name').val();
	var desk_phone = $('#desk_phone').val();
	var mobile_phone = $('#mobile_phone').val();
	var confidence_level = $('#sl1').val();
	var projected_sales_date = $('#projected_sales_date').val();
	var encoded_string = Base64.encode('leads/save_lead/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	
	var encoded_home_string = Base64.encode('leads/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = $("#add_new_lead").serialize();
	//alert(ajaxData);
		$.ajax({
		url: base_url + encoded_val,
		dataType: "json",
		type: "post",
		data: ajaxData+ '&ub_lead_id='+ub_lead_id+'&name='+name+'&desk_phone='+desk_phone+'&mobile_phone='+mobile_phone+'&confidence_level='+confidence_level+'&projected_sales_date='+projected_sales_date,	

		success: function(response) {
			if(response.status == true)
			{	
			//console.log(response.insert_id);return false;
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
					success_msg = response.message;								
				}
				//$(".alert").html(success_msg);
			}
			else
			{	
				if(response.message)
				{
					failure_msg = response.message;
				}	
				//$(".alert").html(failure_msg);				
			}
			return false;
		}
	});	
}

//Delete checklist

function deletelead(ub_lead_id){
    if(ub_lead_id > 0)
    {
    var encoded_delete_roles = Base64.encode('leads/delete_leads/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('leads/index/');
    var index_url = index_string.strtr(encode_chars_obj);
    $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: {'ub_lead_id':{ub_lead_id:ub_lead_id}},
            success: function(response) {   
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
    else
    {               
        $(".error-message .alerts").addClass('alert-danger');
        $(".error-message .alerts").removeClass('alert-success');
        $(".error-message").show();
        $(".alerts").html("Log id is not set");      
    }
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
	if($("#save_type").val() == 'update_completed_activity')
	{
		var ajaxData  = $("#update_completed_activity").serialize();
	}
	else
	{
		var ajaxData  = $("#add_new_activity").serialize();
	}
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
                    $(this).attr('id','log-complete-activity-new');
					$('#schedule_activity_new').attr('id','schedule_activity');		
					$('.log_complete').show();		
					$('.lead_act').hide();		
					$('.Schedule_complete').hide();		
					$('.log_complete .tabbable .nav-tabs li').removeClass('active');
					$('.log_complete .tabbable .nav-tabs li:first-child').addClass('active');
					$('.log_complete .tabbable .tab-content #general').addClass('active');
					$('.log_complete .tabbable .tab-content #sendmail').removeClass('active');
					$('.email-btn-all').css('visibility','hidden');
				 	$('.selectpicker').selectpicker('refresh');
		            $("#lead_activity_type option[value='" + response.aaData[0]['activity_type'] + "']").prop("selected", true);
		            $("#lead_sales_person option[value='" + response.aaData[0]['sales_person'] + "']").prop("selected", true);
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
		$.ajax({
		url: base_url + encoded_val,
		dataType:'json',
		type: "post",
		data: ajaxData+ '&message_body=' + message_body+ '&email=' + email+ '&alternative_email=' + alternative_email, 	

		success: function(response) {
			//alert(JSON.stringify(response));
			if(response.status == true)
			{	
				email_thread_form();
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
  
  function email_thread_form()
{
	var encoded_string = Base64.encode('messages/get_messages/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);	

	var module_pk_id = $("#module_pk_id").val();

	var success_msg = 'Successful';
	var failure_msg = 'Failed';
		$.ajax({
		url: base_url + encoded_val,
		type: "post",
		data: 'module_pk_id=' + module_pk_id, 	
		success: function(response) {
			//alert(JSON.stringify(response));
			if(response != '')
			{	
				//alert(response);
				$('#mail-thread').html(response);
				$("#composedmail").hide();
			}
			else
			{	
				$("#mail-thread").hide();
				$("#composedmail").show();				
			}
			return false;
		}
	});	
}

$("body").on("click", ".mail-button", function (event) {

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

    var encoded_string = Base64.encode('messages/get_messages/');
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
					$("#composedmail").show();
					$('#alt_email_to').val(response.aaData[0]['from_email_id']);
					$('#alt_email_cc').val('');
					$('#subject').val(response.aaData[0]['subject']);
					$('#unique_email_id').val(response.aaData[0]['from_email_id']);
					CKEDITOR.instances.message_body.setData(response.aaData[0]['message_body']);
				}
				else if($("#email_type").val() == 'reply-all')
				{
					$("#composedmail").show();
					$('#alt_email_to').val(response.aaData[0]['from_email_id']);
					$('#alt_email_cc').val(response.aaData[0]['cc_other_emails']);
					$('#subject').val(response.aaData[0]['subject']);
					$('#unique_email_id').val(response.aaData[0]['from_email_id']);
					CKEDITOR.instances.message_body.setData(response.aaData[0]['message_body']);
				}
				else if($("#email_type").val() == 'forward')
                {
                	$("#composedmail").show();
                	$('#alt_email_to').val('');
					$('#alt_email_cc').val('');
					$('#subject').val(response.aaData[0]['subject']);
					CKEDITOR.instances.message_body.setData(response.aaData[0]['message_body']);
                }
			}
			else
			{	
				alert('fail');			
			}
			return false;
		}
	});	
});