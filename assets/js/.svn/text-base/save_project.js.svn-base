$(function() {
	add_formval();
	$('#primary_email').on('keyup', function(){
		var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(this.value) && this.value.length;
		$('.error_mail').html(''+ (valid?'':' not valid') +' ');			
		
	});
	create_template_form();	
	
	$('#individual_po_limit').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#overall_po_limit').keyup(function() {
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#contract_price').keyup(function() {
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	/* Sign Off */
	$('.sign_off_documents').hide();
	$('.save_sign_off_list').hide();	
	$(document).on('click', '#Signoff_approved', function(){
		$('#signoff_project_modal').modal('hide');
		$('.sign_off_con').hide();
		$('.save_sign_off_list').hide();
		$('.sign_off_documents').show();
		/* Below code was added by chandru for punch list status change */
		var project_id =$('#ub_project_id').val();
		var encoded_string = Base64.encode('projects/punch_list_sign_off_approve/');
		var encoded_val = encoded_string.strtr(encode_chars_obj);
		$.ajax({
			url: base_url + encoded_val,
			dataType: "json",
			type: "post",
			data: 'project_id='+project_id,         
			success: function(response) { 
			}
		});
		/* Punch list code ends here */
		
	});
	$(document).on('click', '#sign_off_cancel', function(){		
		$('.sign_off_con').show();
		$('.sign_off_documents').hide();
		$('.save_sign_off_list').hide();
		location.reload(true); 
	});
	$(document).on('click', '#save_sign_off', function(){	
		/* commented by chandru */
		/* $('.sign_off_con').hide();
		$('.sign_off_documents').hide();
		$('.save_sign_off_list').show(); */
	});
	$(document).on('click', '#sign_off_edit', function(){		
		$('.sign_off_con').hide();
		$('.save_sign_off_list').hide();
		$('.sign_off_documents').show();
	});
	$(document).ready(function() {
		$(".sigWrapper .pad").click(function() {		
		$('.browse').addClass('pointer_none');
		});
		$(document).on( 'click', 'a[href="#clear"]', function (){        
			$('.browse').removeClass('pointer_none');
		});
		$(document).on('click','.close-file', function(){		
			$('.sigWrapper').removeClass('pointer_none');
			$('.sigPad').signaturePad({drawOnly:true});
			$('.browse').removeClass('pointer_none');
		});
		if(account_type == OWNER)
		{
			if(signature_text == "")
        {
            signature_text = [{lx:0,ly:0,mx:0,my:0},{lx:0,ly:0,mx:0,my:0}];
        }
            $('.sigPad').signaturePad({drawOnly:true}).regenerate(signature_text);
		}
		
        //$('.sigPad').signaturePad({drawOnly:true});
    });
	
		/* Clone */
			//remove button
			$('.removeBtn').click( function() {
				var cointainer = $(this).parent().parent().parent().parent().closest('.cointainer');
				var counts = cointainer.children('.content').length;
				
				counts--;
				if(counts < 3) {
					cointainer.children('.addBtn').show();
									
					if (counts == 1) {
						cointainer.find('.removeBtn').hide();
						cointainer.find('.removeBtn').removeClass('show');	
					}
				}
				$(this).parent().parent().parent().remove();
				
				cointainer.find('.label-num').text(function(idx){
					return 1 + idx
				})
			});

			//add button
			$('.addBtn').click( function() {				
				var cointainer = $(this).closest('.cointainer');
				var counts = cointainer.children('.content').length;
				var content = $(this).prev();
				
				counts++;		
				if (counts > 2) {                   	
					$(this).hide();  
				}
				content.clone(true,true).insertAfter(content).find('input').val('').end().find('.label-num').text(counts).end().find('.preview_file').hide().end().find('.preview_file').removeClass('show').end().find('.file_name').hide().end().find('.browse').show().end().find('.browse').removeClass('hide');				
				cointainer.find('.removeBtn').addClass('show');
			});
		/* /Clone */
	/* /Sign Off */
	/* Duration */
	 $(".Duration").spinner({min: 0}); 
/* $('.spinner .btn:first-of-type').on('click', function(e) {
	var spinner_first = $(this).parent().parent('.spinner').find('.Duration'); 	
	$(spinner_first).val( parseInt($(spinner_first).val(), 10) + 1);
	e.preventDefault();
});
$('.spinner .btn:last-of-type').on('click', function(e) {	
	var spinner_last = $(this).parent().parent('.spinner').find('.Duration'); 			
	if($(spinner_last).val() > 0){
		$(spinner_last).val( parseInt($(spinner_last).val(), 0) -1);	
	}	
	e.preventDefault();
}); */
/* /Duration */
    $('#alt-email').tagsinput({
        allowDuplicates: false
    });
    /* Viewing Access*/
    $('body').on('click', 'li', function() {
        $(this).toggleClass('selected');
    });
    /* Subs Permitted */
    $('#sub_move_left').click(function() {
		var selected_count = 0
		$('.sub_list2 .selected').each( function(){
			$('#project_assigned_users').val($('#project_assigned_users').val().replace(","+$(this).val(), ""));
			selected_count++;
		});
		if($('.sub_list2 .selected').length>0)
		{
			document.getElementById('test_ids').value = document.getElementById('project_assigned_users').value;
			$('.sub_list1').append($('.sub_list2 .selected').removeClass('selected'));
			return true;
		}
		else
		{
			// alert('Select a sub user(s) to remove viewable access');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Select a sub user(s) to remove viewable access');
			return false;
		}
    });
    $('#sub_move_right').click(function() {
		var selected_count = 0
		if($('#project_assigned_users').val() == '' || $('#project_assigned_users').val() == ',')
		{
			$('#project_assigned_users').val(',');
		}
		$('.sub_list1 .selected').each( function(){
			selected_count++;
			$('#project_assigned_users').val($('#project_assigned_users').val()+$(this).val()+',');
		});
		if($('.sub_list1 .selected').length>0)
		{
			document.getElementById('test_ids').value = document.getElementById('project_assigned_users').value;
			$('.sub_list2').append($('.sub_list1 .selected').removeClass('selected'));
			return true;
		}
		else
		{
			// alert('Select a sub user(s) to assign viewable access');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Select a sub user(s) to assign viewable access');
			return false;
		}
    });
    /* /Subs Permitted */
    /* Builder Permitted */
    
    $('#build_move_left').click(function() {
		/*var remove_roleid = $('.build_list2 .selected').find('select option:selected').val();
		var remove_userid = $('.build_list2 .selected').val();
		if (typeof(remove_userid) != "undefined")
		{
			var all_user_ids=document.getElementById('project_assigned_users').value;
			var permitted_user_ids=document.getElementById('builder_users_permitted').value;
			var permitted_role_ids=document.getElementById('builder_users_roleid').value;
			var all_users = all_user_ids.replace(","+remove_userid, "");
			var all_permittedusers = permitted_user_ids.replace(","+remove_userid, "");
			var all_roleids = permitted_role_ids.replace(","+remove_roleid, "");
			
			document.getElementById('project_assigned_users').value = all_users;
			document.getElementById('builder_users_permitted').value = all_permittedusers;
			document.getElementById('builder_users_roleid').value = all_roleids;
			document.getElementById('test_ids').value = all_users;
			document.getElementById('test_roleid').value = all_permittedusers;
			document.getElementById('test_userid').value = all_roleids;
			//////////////////////////////////////////////////
			$('.build_list1').append($('.build_list2 .selected').removeClass('selected'));        
			$('.build_list1').find('select').attr('disabled',false);
		}
		else
		{
			alert('Select user and role');return false;
		}*/
		
		var selected_count = 0
		$('.build_list2 .selected').each( function(){
			$('#project_assigned_users').val($('#project_assigned_users').val().replace(","+$(this).val(), ""));
			$('#builder_users_permitted').val($('#builder_users_permitted').val().replace(","+$(this).val(), ""));
			selected_count++;
		});
		if($('.build_list2 .selected').length>0)
		{
			document.getElementById('test_ids').value = document.getElementById('project_assigned_users').value;
			document.getElementById('test_roleid').value = document.getElementById('builder_users_roleid').value;
			document.getElementById('test_userid').value = document.getElementById('builder_users_permitted').value;
			$('.build_list1').append($('.build_list2 .selected').removeClass('selected'));
			return true;
		}
		else
		{
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Select a sub user(s) to remove viewable access');
			// alert('Select a sub user(s) to remove viewable access');
			return false;
		}
    });
	
	$('.build_list2').find('select').attr('disabled',true);
    $('#build_move_right').click(function() {
		/*var roleid = $('.build_list1 .selected').find('select option:selected').val();
		var user_ids = $('.build_list1 .selected').val();
		if (typeof(user_ids) != "undefined" && roleid != "")
		{
			//Below if is for over all project assigned users
			if(document.getElementById('project_assigned_users').value != '')
			{
				document.getElementById('project_assigned_users').value = document.getElementById('project_assigned_users').value + user_ids + ",";
			}
			else{
				 document.getElementById('project_assigned_users').value = "," + user_ids + ",";
			}
			//End of above if
			
			//Below if is for builder users permitted
			if(document.getElementById('builder_users_roleid').value != '')
			{
				document.getElementById('builder_users_roleid').value = document.getElementById('builder_users_roleid').value + roleid + ",";
				document.getElementById('builder_users_permitted').value = document.getElementById('builder_users_permitted').value + user_ids + ",";
			}
			else
			{
				 document.getElementById('builder_users_roleid').value = "," + roleid + ",";
				 document.getElementById('builder_users_permitted').value = "," + user_ids + ",";
			}
			//End of above if
			
			//just for checking
			document.getElementById('test_ids').value = document.getElementById('project_assigned_users').value;
			document.getElementById('test_roleid').value = document.getElementById('builder_users_roleid').value;
			document.getElementById('test_userid').value = document.getElementById('builder_users_permitted').value;
			 $('.build_list2').append($('.build_list1 .selected').removeClass('selected'));
			 $('.build_list2').find('select').attr('disabled',true);
			$('.build_list2 li span').show();
		}
		else
		{
			alert('Select user and role');return false;
		}*/
		var selected_count = 0
		if($('#project_assigned_users').val() == '' || $('#project_assigned_users').val() == ',')
		{
			$('#project_assigned_users').val(',');
		}
		if($('#builder_users_permitted').val() == '' || $('#builder_users_permitted').val() == ',')
		{
			$('#builder_users_permitted').val(',');
		}
		$('.build_list1 .selected').each( function(){
			selected_count++;
			$('#project_assigned_users').val($('#project_assigned_users').val()+$(this).val()+',');
			$('#builder_users_permitted').val($('#builder_users_permitted').val()+$(this).val()+',');			
		});
		if($('.build_list1 .selected').length>0)
		{
			document.getElementById('test_ids').value = document.getElementById('project_assigned_users').value;
			document.getElementById('test_roleid').value = document.getElementById('builder_users_roleid').value;
			document.getElementById('test_userid').value = document.getElementById('builder_users_permitted').value;
			$('.build_list2').append($('.build_list1 .selected').removeClass('selected'));
			return true;
		}
		else
		{
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Select a builder user(s) to assign viewable access');	
			// alert('Select a builder user(s) to assign viewable access');
			return false;
		}
    });
	
    /* Builder Permitted */
    /* Viewing Access*/
    $('a').tooltip({
        placement: "bottom",
        trigger: "focus"
    });
    $(window).resize(function() {
        $('.dataTable').css('width', '100%');
    });
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
    $('#build_left').keyup(function() {
        var valThis = $(this).val().toUpperCase();
        if (valThis == "") {
            $('.build_list1 > li').show();
        } else {
            $('.build_list1 > li').each(function() {
                var text = $(this).text().toUpperCase();
                (text.indexOf(valThis) == 0) ? $(this).closest('li').show(): $(this).closest('li').hide();
            });
        };
    });
    $('#build_right').keyup(function() {
        var valThis = $(this).val().toUpperCase();
        if (valThis == "") {
            $('.build_list2 > li').show();
        } else {
            $('.build_list2 > li').each(function() {
                var text = $(this).text().toUpperCase();
                (text.indexOf(valThis) == 0) ? $(this).closest('li').show(): $(this).closest('li').hide();
            });
        };
    });
    /* /Viewing Access Search */
    /* Login Enabled */
    $('.drop-down-show-hide').hide();
    $('#access_method').change(function() {
        $(this).find("option").each(function() {
            $('.' + this.value).hide();
        });
        $('.' + this.value).show();
    });
    
    /* /Login Enabled */
    /* Drop Down Add / Edit / Delete */
    $('#project_group').on('change', function() {
        var selected = $(this).find("option:selected").val();
        $('#edit_project_group').val(selected);
        $('#selected').val(selected);
    });
    $('#project_group_save').click(function() {
        var value = $('#new_project_group').val();
		var encoded_url = Base64.encode('projects/update_general_value/');
		var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
		var classification = 'project_group';
		var operation_type = 'add';
		xhr = $.ajax({
			type: "POST",
			dataType: "json",
			data: {"classification":classification,"type":operation_type,"value":value},
			url: base_url + ajax_encoded_url,
			success: function (response) {
				if(response.status == true)
				{
					$('#project_group').append($("<option value=" + value + ">" + value + "</option>").text(value));
					$(".selectpicker").selectpicker("refresh");
					// alert("Added successfully");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text('Added successfully');
					$("#TypeAddModal").modal('hide');
				}else
				{
					// alert("Insertion failed");
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text('Insertion failed');
				}
			}
		});	
    });
    $('.TypeEditModal').click(function() {
        var n = $('#project_group').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
        if (n === 1) {
            $('#TypeEditModal').modal({
                show: true
            });
            $('#Edit_project').click(function() {
                var sat = $('#Edit_project_group').val();
                var selected_val = $('#selected').val();
                if (selected_val == selected_val) {
                    $('#project_group option[value=' + selected_val + ']').remove();
                }
                if (sat == sat) {
                    $('#project_group').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
                }
                $('#project_group').next().find('.dropdown-menu li.selected a .text').empty();
                $('#project_group').next().find('.dropdown-menu li.selected a .text').append(sat);
                $('#project_group').next().find('.selectpicker .filter-option').empty();
                $('#project_group').next().find('.selectpicker .filter-option').append(sat);
            });
            $('#project_group_delete').click(function() {
				var value = $('#edit_project_group').val();
                if (value == value) {
                    $('#project_group option[value="' + value + '"]').remove();
                }
				var encoded_url = Base64.encode('projects/update_general_value/');
				var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
				var classification = 'project_group';
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
							$('#edit_project_group').val('');
							$('#project_group').next().find('.dropdown-menu li.selected').remove();
							$('#project_group').next().find('.selectpicker .filter-option').empty();
							$('#project_group').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
							$(".selectpicker").selectpicker("refresh");
							// alert("Deleted successfully");
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text('Deleted successfully');
							$("#TypeEditModal").modal('hide');
						}else
						{
							// alert("Deletion failed: "+response.message);
							$('#alertModal').modal('show');
							$('.alert_modal_txt').text('Deletion failed: '+response.message);
						}
					}
				});	
              
            });
        } else if (n > 1) {
            // alert('select only one at a time');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Select only one at a time');
        } else if (n === 0) {
            // alert('Please select');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select');
        }
    });
    /* /Drop Down Add / Edit / Delete */
    /* Date Picker */
    $('#datetimepicker5').datetimepicker({
        pickTime: false
    });
    $('#datetimepicker6').datetimepicker({
        pickTime: false
		
    });
    $('#datetimepicker7').datetimepicker({
        pickTime: false
    });
    $('#datetimepicker8').datetimepicker({
        pickTime: false
    });
	$('.custom_datetimepicker').datetimepicker({
			pickTime: false
	});
    /* /Date Picker */	
});
//Add code starts here
$('#projectinfotab a').click(function (e) {	
		$("#save_type").val('save_and_stay');
		var tab_tag = $(this).attr("href");
		$('#current_tab').val(tab_tag);	
		var project_name_val = $('input[name="project_name"]').val();		
		var project_status_val = $('select[name="project_status"]').val();		
		var lot_info_val = $('input[name="lot_info"]').val();		
		var project_id = document.getElementById('ub_project_id').value;		
		var project_managers_val = $('select[name="project_managers"]').val();		
		var project_group_val = $('select[name="project_group[]"]').val();		
		if(project_name_val == '' || project_status_val == '' || lot_info_val == '' || project_managers_val == '' || project_group_val == null ){		
			var form = $(this).closest("form");   
			form.submit();
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill mandatory fields');					
			return false;
		}
		else if(project_id > 0 || project_name_val != '' || project_status_val != '' || lot_info_val != '' || project_managers_val != '' || project_group_val != null){		 
			/* $('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('Saved Succesfully'); */
			add_project_form();			
			e.preventDefault();
		}
		else{
			$("#save_type").val('save_and_stay');
			add_project_form();
			e.preventDefault();
		}
		
});

//Add and New
$('#add_project_new').on('click',function(e) { 
		$("#save_type").val('save_and_new');			
		var project_name_val = $('input[name="project_name"]').val();		
		var project_status_val = $('select[name="project_status"]').val();		
		var lot_info_val = $('input[name="lot_info"]').val();	
		var project_managers_val = $('select[name="project_managers"]').val();		
		var project_group_val = $('select[name="project_group[]"]').val();			
		if(project_name_val == '' || project_status_val == '' || lot_info_val == '' || project_managers_val == '' || project_group_val == null ){
			error_box();			
			$('.error-message .alerts').text('Please fill mandatory fields');
		}
		else{		 			
			add_project_form();			
			e.preventDefault();
		}		
});
//Add and stay
$('#add_project_new_stay').on('click',function(e) {
		$("#save_type").val('save_and_stay');
		var project_name_val = $('input[name="project_name"]').val();		
		var project_status_val = $('select[name="project_status"]').val();		
		var lot_info_val = $('input[name="lot_info"]').val();
		var project_managers_val = $('select[name="project_managers"]').val();		
		var project_group_val = $('select[name="project_group[]"]').val();		
		if(project_name_val == '' || project_status_val == '' || lot_info_val == '' || project_managers_val == '' || project_group_val == null ){		  
			error_box();			
			$('.error-message .alerts').text('Please fill mandatory fields');
		}
		else{
			
			add_project_form();			
			e.preventDefault();
		}	
});
$('#owneremailinvitation').on('click',function(e) {
		$("#save_type").val('save_and_stay_and_sent_mail');			
		var primary_email = $('#primary_email').val();		
		var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(primary_email) && primary_email.length;
		if(primary_email == '' || valid == false){				
			error_box();
			$('.error-message .alerts').text('Please enter primary email id');
			$('#primary_email').parent('.form-group').addClass('has-error');			
		}
		else{
			$('#primary_email').parent('.form-group').removeClass('has-error');
			add_project_form();			
			e.preventDefault();
		}	
});

//Add and Back
$('#add_project_new_back').on('click',function(e) {
		$("#save_type").val('save_and_back');
		var project_name_val = $('input[name="project_name"]').val();		
		var project_status_val = $('select[name="project_status"]').val();		
		var lot_info_val = $('input[name="lot_info"]').val();	
		var project_managers_val = $('select[name="project_managers"]').val();		
		var project_group_val = $('select[name="project_group[]"]').val();		
		if(project_name_val == '' || project_status_val == '' || lot_info_val == '' || project_managers_val == '' || project_group_val == null ){			
			error_box();			
			$('.error-message .alerts').text('Please fill mandatory fields');			
		}
		else{
			
			add_project_form();			
			e.preventDefault();
		}
		
});

function add_project_form()
{
	var encoded_string = Base64.encode('projects/save_project/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var encoded_home_string = Base64.encode('projects/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	var ub_project_id = $('#ub_project_id').val();
	var tab = $('#current_tab').val();
	var success_msg = 'Successful';
	var failure_msg = 'Failed';

	var accessmethod = $('#access_method').val();
    if(accessmethod === 'configure')
    {
        var password_length = $('#password').val().length;
        if($('#username').val() == '')
        {
            error_box();           
            $('.error-message .alerts').text('Username cannot be Empty');
            return false;
        }
        else if($('#password').val() == '')
        {
            error_box();           
            $('.error-message .alerts').text('Password cannot be Empty');
            return false;
        }
        else if(password_length < 5)
        {
            //alert('Password must be greater than five character');
            error_box();           
            $('.error-message .alerts').text('Password must be greater than five character');
            return false;
        }
    }
    
	var ajaxData  = new FormData($('#save_project')[0]);	
		$.ajax({
		url: base_url + encoded_val,
        contentType: false,
        processData: false,
		dataType: "json",
		type: "post",
		data: ajaxData,	
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        },
		success: function(response) {
			$('.uni_wrapper').removeClass('loadingDiv');
			if(response.owner_id > 0)
			{
				$("#owner_id").val(response.owner_id);
			}
			if(response.status == true)
			{	
				console.log(response.ub_project_id);
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
					var encoded_string_edit_log = Base64.encode( 'projects/save_project/' + response.ub_project_id);
                    var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                    //console.log(encoded_edit_val);
                    window.location.href = encoded_edit_val+tab;
                    // console.log(response.insert_id);
                }
                else if($("#save_type").val() == 'save_and_stay_and_sent_mail')
                {
					var encoded_string_edit_log = Base64.encode( 'projects/save_project/' + response.ub_project_id);
                    var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);                    
                    window.location.href = encoded_edit_val+tab;
					success_box();
					$('.error-message .alerts').text('email send successfully');	
                }				
				if(response.message)
				{
					success_msg = response.message;								
				}
				success_box();
				$('.error-message .alerts').text(success_msg);				
			}
			else
			{					
				if(response.message)
				{
					failure_msg = response.message;
				}	
				error_box();
				$('.error-message .alerts').text(failure_msg);				
			}
			return false;
		}
	});	
}


    $(document).on('ifChecked','#login-enabled', function(event) {
        $("#access_method").prop("disabled", false);
        $(".disabled_prop").prop("disabled", false);
        $(".disabled_input").prop("disabled", false);        
        $('.access-log').show();
    });
    $(document).on('ifUnchecked','#login-enabled', function(event) {
        $('.selectpicker').selectpicker('deselectAll');
        $('.log-disable').hide();
    });



/* code to delete the project*/
function delete_project(project_ids_obj){
	var ub_project_id=document.getElementById('ub_project_id').value;
	var encoded_delete_projects = Base64.encode('projects/delete_projects/');
	var encoded_delete_val = encoded_delete_projects.strtr(encode_chars_obj);
	var index_string = Base64.encode('projects/index/');
	var index_url = index_string.strtr(encode_chars_obj);
	//var project_ids_obj  = 'ub_project_id='+ub_project_id;
	var conf = $('#confirmModal').modal('show');
	$('#delete_confirm').click(function(){
		var conf = true;
		if(conf == true){
			$('#confirmModal').modal('hide');
			$.ajax({
					type:'POST',
					url: base_url + encoded_delete_val,
					dataType: 'json',
					data: {'ub_project_id':{ub_project_id:project_ids_obj}},
					success: function(response) {	
						if(response.status == true)
						{	
							if(response.message)
							{
								success_msg = response.message;
								window.location.href = index_url;							
							}
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
	});
}

function add_formval(){
	var save_projectform = $('#save_project').find('[name="project_status"], [name="project_managers"], [name="project_group[]"]').selectpicker().change(function(e) {            
                $('#save_project').formValidation('revalidateField', 'project_status');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_project_new, #add_project_new_stay, #add_project_new_back, #projectinfotab a,#owneremailinvitation'			
        },
         fields: {
             'project_name': {
                 validators: {
                    notEmpty: {
                        message: 'The project name is required and cannot be empty'
                    }
                }
             },
			 'project_status': {
                 validators: {
                    notEmpty: {
                        message: 'Please select the project status'
                    }
                }
             },
			 'project_managers': {
                 validators: {
                    notEmpty: {
                        message: 'Please select the project managers'
                    }
                }
             },			 
			  'project_group[]': {
                    validators: {
                        callback: {
                            message: 'Please select the project group',
                            callback: function(value, validator, $field) {
                                // Get the selected options
                                var options = validator.getFieldElements('project_group[]').val();
                                return (options != null);
                            }
                        }
                    }
					
			  },
			 'lot_info': {
                 validators: {
                    notEmpty: {
                        message: 'The lot info is required and cannot be empty'
                    }
                }
             }
		
         }       /* added closing brace */
        
     }).on('err.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
            
      }).on('success.field.fv', function(e, data) {
            data.fv.disableSubmitButtons(false);
            
      }).on('success.form.fv', function(e) {
			 if($("#save_type").val() == 'save_and_stay'){		  
				add_project_form();            
			 }
			 else if($("#save_type").val() == 'save_and_new'){		  
				add_project_form();            
			 }
			 else if($("#save_type").val() == 'save_and_back'){		  
				add_project_form();            
			 }			
         e.preventDefault(); 
     });
	
}

function delete_pic(file_id)
{
    var fileid = file_id;
    var encoded_string = Base64.encode('projects/delete_file/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: 'fileid='+fileid,   
        beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');       
        },        
        success: function(response) 
        { 
			$('#uploader').val('');
        	location.reload(); 
        }
    });
}

$(document).on('click','#create_template', function(e){
		var template_name = $('#template_name').val();		
		if(template_name == ''){			
			$('.error-message1').show();
			$('.error-message1 .alerts').removeClass('alert-success');
			$('.error-message1 .alerts').removeClass('alert-danger');
			$('.error-message1 .alerts').addClass('alert-danger');
			$('.error-message1 .alerts').text('Please fill all mandatory fields');					
		}
		else{
			$('.error-message1').show();
			$('.error-message1 .alerts').removeClass('alert-danger');
			$('.error-message1 .alerts').addClass('alert-success');
			$('.error-message1 .alerts').text('created succesfully');
			create_template();
			e.preventDefault();
		}	
});
function create_template(){
	var encoded_url = Base64.encode('projects/save_template/');
	var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
	var ajaxData  = $("#save_project_template").serialize();
	$.ajax({
		url: base_url + ajax_encoded_url,
		dataType: "json",
		type: "post",
		data: ajaxData,		
		success: function(response) {
		$('#create_template_modal').modal('hide');
		$('#create_template_modal_success').modal('show');			
			if(response.status == true)
			{	
				
			}
		}
	});
}
function create_template_form(){	
	$('#save_project_template').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#create_template'			
        },
        fields: {
            'template_name': {
                validators: {
                    notEmpty: {
                        message: 'The template name cannot be empty'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {				
			e.preventDefault();			 
	  });
}

/* below code was added by chandru for signoff 31-07-2015 */
/* Add signoff */
function add_project_signoff()
{
	var encoded_string = Base64.encode('projects/save_signoff/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var encoded_home_string = Base64.encode('projects/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	var ub_project_id = $('#ub_project_id').val();
	var tab = $('#current_tab').val();
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = new FormData($('#save_project')[0]);	
		$.ajax({
		url: base_url + encoded_val,
        contentType: false,
        processData: false,
		dataType: "json",
		type: "post",
		data: ajaxData,	
		/* beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        } ,*/
		success: function(response) {
			/* $('.uni_wrapper').removeClass('loadingDiv'); */
			if(response.status == true)
			{	
				if(response.message == 'Data inserted successfully')
				{	
					window.location.reload();
				}
				$('.sign_off_con').hide();
				$('.sign_off_documents').hide();
				$('.save_sign_off_list').show();	
				if(response.message)
				{
					success_msg = response.message;								
				}
				success_box();
				$('.error-message .alerts').text(success_msg);				
			}
			else
			{					
				if(response.message)
				{
					failure_msg = response.message;
				}	
				error_box();
				$('.error-message .alerts').text(failure_msg);				
			}
			return false;
		}
	});	
}

/* Below code was added by chandru */
function delete_signoff_pic(file_id)
{
	var r = confirm("Are you sure you want to remove this attachment");
	if (r == true) 
	{
		var fileid = file_id;
		var encoded_string = Base64.encode('projects/delete_file/');
		var encoded_val = encoded_string.strtr(encode_chars_obj);
		$.ajax({
			url: base_url + encoded_val,
			dataType: "json",
			type: "post",
			data: 'fileid='+fileid,         
			success: function(response) { 
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Attachment was removed successfully');
				// alert('attachment was removed successfully');
				window.location.reload();
			}
		});
	}
}

/* change sign off status */
function change_project_signoff_status(project_id)
{
	var r = confirm("Are you sure you want to release for owner acceptance");
	if (r == true) 
	{
		var project_id = project_id;
		var encoded_string = Base64.encode('projects/change_project_signoff_status/');
		var encoded_val = encoded_string.strtr(encode_chars_obj);
		$.ajax({
			url: base_url + encoded_val,
			dataType: "json",
			type: "post",
			data: 'project_id='+project_id,         
			success: function(response) { 
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Released successfully');
				// alert('Status modified successfully');
				window.location.reload();
			}
		});
	}
}
/* Owner approving singoff */
function owner_sign_off_approval()
{
	var encoded_string = Base64.encode('projects/owner_sign_off_approve/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var encoded_home_string = Base64.encode('projects/index/');
	var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
	var ub_project_id = $('#ub_project_id').val();
	var tab = $('#current_tab').val();
	var success_msg = 'Successful';
	var failure_msg = 'Failed';
	var ajaxData  = new FormData($('#signoff_owner')[0]);
		$.ajax({
		url: base_url + encoded_val,
        contentType: false,
        processData: false,
		dataType: "json",
		type: "post",
		data: ajaxData,	
		/* beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			  
        } ,*/
		success: function(response) {
			/* $('.uni_wrapper').removeClass('loadingDiv'); */
			if(response.status == true)
			{	
				// alert('success');return false;
				window.location.reload();	
				if(response.message)
				{
					success_msg = response.message;								
				}
				success_box();
				$('.error-message .alerts').text(success_msg);				
			}
			else
			{					
				if(response.message)
				{
					failure_msg = response.message;
				}	
				error_box();
				$('.error-message .alerts').text(failure_msg);				
			}
			return false;
		}
	});	
}

/* change sign off status */
function sign_off_approve_by_builders(project_id)
{
	var r = confirm("Are you sure you want to over ride and sign off");
	if (r == true) 
	{
		var project_id = project_id;
		var encoded_string = Base64.encode('projects/sign_off_approve_by_builder/');
		var encoded_val = encoded_string.strtr(encode_chars_obj);
		$.ajax({
			url: base_url + encoded_val,
			dataType: "json",
			type: "post",
			data: 'project_id='+project_id,         
			success: function(response) { 
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Overrided and Signed off successfully');
				// alert('Status modified successfully');
				window.location.reload();
			}
		});
	}
}

/* Cancel button reload */
function sign_off_cancels()
{
	window.location.reload();
}