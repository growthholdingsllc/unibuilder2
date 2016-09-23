//character counter added in comments
$(function() {
	var totalChars 		= 4000; 
	var countTextBox 	= $('#comments')
	var charsCountEl 	= $('#commentcountchars');
	charsCountEl.text(totalChars);
	countTextBox.keyup(function() {
		var thisChars = this.value.replace(/{.*}/g, '').length;
		var per = thisChars*100; 
		var value= (per / totalChars);
		if(thisChars > totalChars)
		{
			var CharsToDel = (thisChars-totalChars);
			this.value = this.value.substring(0,this.value.length-CharsToDel);
		}else{
			charsCountEl.text( totalChars - thisChars );
			$('#commentpercent').text(value +'%');
		}
	});
});

$('select#subcontractor_user').on('change',function() {

    var encoded_string = Base64.encode('warranty/get_user_accounttype/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_warranty").serialize(); 
    $.ajax({
    url: base_url + encoded_val,
    dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
        if(response.account_type == SUBCONTRACTOR)
        {
            //$('#sub_accept_appoinment').show();
            $("#sub_accept_appoinment").iCheck('enable');
            //$("#sub_accept_appoinment").iCheck('uncheck');
        }
        else
        {
           //$('#sub_accept_appoinment').hide(); 
           $("#sub_accept_appoinment").iCheck('disable');         
           $("#sub_accept_appoinment").iCheck('uncheck');
        }
        //alert(response.end_date);
        //$('#schedule_due_date').val(response.end_date);
      }
    });
    
});
$(function(){
var account_type = $('#account_type').val();
    if(account_type == SUBCONTRACTOR)
    {
        $("#sub_accept_appoinment").iCheck('enable');
    }
    else
    {
        $("#sub_accept_appoinment").iCheck('disable');         
        $("#sub_accept_appoinment").iCheck('uncheck');
    }
});
$(function() {
    //appointment_validation();
    $(document).on('ifUnchecked','#override_by_builder', function(event){
        //$('#app_comment').hide();
        $('#approval_comments').attr('readonly', true);
        $("#feedback_drop").hide();
        $("#com_date").hide();
        $("#override_feedback").show();
        
    }); 
    $(document).on('ifChecked','#override_by_builder', function(event){

        //$('#app_comment').show();
        $('#approval_comments').attr('readonly', false);
        $("#feedback_drop").show();
        $("#com_date").show();
        $("#override_feedback").hide();
        
    }); 
    if($('#override_by_builder').attr('checked'))
    {
         //$('#app_comment').show();
         $('#approval_comments').attr('readonly', false);
         $("#feedback_drop").show();
         $("#com_date").show();
         $("#override_feedback").hide();
    }
    else
    {
         //$('#app_comment').hide();
         //$("#feedback_drop").hide();
         $("#com_date").hide();
         $("#override_feedback").show();
         $('#approval_comments').attr('readonly', true);
         $("#feedback_drop").hide();
    }
});
//checking project status -- code added by satheesh kumar
$(function() {
	var ub_warranty_claim_id = $('#ub_warranty_claim_id').val();   
	if(ub_warranty_claim_id == '' || ub_warranty_claim_id == 0)
	{
		if(project_status == 'Closed' || project_status == 'Disabled')
		{	
			url = 'warranty/index/';
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('project was closed or disabled. You can not able to add'); 
			var encoded_home_string = Base64.encode(url);
			var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
			window.location.href = encoded_home_val;
		}
	}
	else if(project_status == 'Closed' || project_status == 'Disabled')
	{
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Project was closed or disabled. You can not able to edit');
		//alert('you can not edit');
	}
});

imgLink = base_url + 'assets/images/'; 

$(function(){

  $('#added_cost').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });

});

$(function(){
	post_comment_form();
	$('.file_uploaded_div').enscroll({
		showOnHover: false,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'
	});
    
	
});
/* Scroll */
$(function () {	
	$(window).load(function(){
		$("#docs_upload_Modal .modal-con").mCustomScrollbar({
			setHeight:250,
			theme:"dark-3"
		});
        $(".inner-jumbotron").mCustomScrollbar({
            setHeight:300,
            theme:"dark-3"
        });
				
	});	
	
});
/* /Scroll */
$(function(){
//var datetimepicker = $.fn.datetimepicker.noConflict();
$('#task-time').datetimepicker({
		pickDate: false
	});
	$('#schedule-time').datetimepicker({
		pickDate: false,
	});	
	/*$('#task-time').on("dp.show", function(e) {
		pickDate: false		
	});
	$('#schedule-time').on("dp.show", function(e) {
        minView:0			
	});*/
	 $('#datetimepicker5').datetimepicker({
			pickTime: false,
            minDate:new Date()
		});
        $('#datetimepicker6').datetimepicker({
			pickTime: false,
            minDate:new Date()
		});
		$('#datetimepicker7').datetimepicker({
			pickTime: false
		});
		$('#datetimepicker8').datetimepicker({
			pickTime: false
		});
		$('#datetimepicker9').datetimepicker({
			pickDate: false
		});
		$('#datetimepicker11').datetimepicker({
			pickTime: false
		});
		$('#datetimepicker12').datetimepicker({
            pickTime: false
        });
		$('.custom_datetimepicker').datetimepicker({
			pickTime: false
		});
$('.schedule_save, .schedule_cancel, .service-con, .save-service-con').hide();
$('#schedule_service').click(function(){
    var ub_warranty_claim_appointments_id = $('#ub_warranty_claim_appointments_id').val();
    $(this).addClass('btn-is-disabled');
    $(this).hide();
    $('.schedule_save, .schedule_cancel, .service-con').show();
    $('.request-accept').show();
    if(ub_warranty_claim_appointments_id > 0)
    {
        $('.save-service-con').show();
    }
    else
    {
        $('.save-service-con').hide();
    }
});
$('.schedule_save').click(function(){
    $('#schedule_service').removeClass('btn-is-disabled');
    $('#schedule_service').hide();
    //$('.request-accept').hide();
    $('.save-service-con').show();
    //$('.save-request-accept').show();
});
$('.schedule_cancel').click(function(){
    $('#schedule_service').show();
    $('#schedule_service').removeClass('btn-is-disabled');
    $('.schedule_save, .schedule_cancel, .service-con, .save-service-con').hide();
});
});
/* /Warranty */
$(function()
{
    var ub_warranty_claim_appointments_id = $('#ub_warranty_claim_appointments_id').val();
    if(ub_warranty_claim_appointments_id != '')
    {
        $('.schedule_save, .schedule_cancel, .service-con').show();
        $('#schedule_service').hide();
        $('.request-accept').show();
        $('.save-service-con').show();
    }
});


    
/* Drop Down Add / Edit / Delete */
    $(document).ready(function(){   
    var selected = $('#category').find("option:selected").val();
    $('#edit_project_group').val(selected);
    $('#selected').val(selected);
    });
    $('#category').on('change', function() {
        var selected = $(this).find("option:selected").val();
        $('#edit_project_group').val(selected);
        $('#selected').val(selected);
    });
    $('#category_save').click(function() {
        var value = $('#category_add').val();
        var encoded_url = Base64.encode('warranty/update_general_value/');
        var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        var classification = 'warranty_category';
        var operation_type = 'add';
        if(value!=''){
        xhr = $.ajax({
            type: "POST",
            dataType: "json",
            data: {"classification":classification,"type":operation_type,"value":value},
            url: base_url + ajax_encoded_url,
            success: function (response) {
                if(response.status == true)
                {
                    $('#category').append($("<option value=" + value + ">" + value + "</option>").text(value));
                    $(".selectpicker").selectpicker("refresh");
                    //alert("Added successfully");
                    $('#alertModal').modal('show');
                    $('.alert_modal_txt').text('Added successfully');
                    $("#TypeAddModal").modal('hide');
                    $('#category_add').val('');
                }else
                {
                    //alert("Insertion failed");
                    $('#alertModal').modal('show');
                    $('.alert_modal_txt').text(response.message);
                }
            }
        });
       }
       else
       {
         //alert('Please Enter a Category name');
         $('#alertModal').modal('show');
         $('.alert_modal_txt').text('Please Enter a Category name');
       } 
    });
    $('.TypeEditModal').click(function() {
        var n = $('#category').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
        if (n === 1) {
            $('#TypeEditModal').modal({
                show: true
            });
            $('#Edit_project').click(function() {
                var sat = $('#edit_project_group').val();
                var selected_val = $('#selected').val();
                if (selected_val == selected_val) {
                    $('#category option[value=' + selected_val + ']').remove();
                }
                if (sat == sat) {
                    $('#category').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
                }
                $('#category').next().find('.dropdown-menu li.selected a .text').empty();
                $('#category').next().find('.dropdown-menu li.selected a .text').append(sat);
                $('#category').next().find('.selectpicker .filter-option').empty();
                $('#category').next().find('.selectpicker .filter-option').append(sat);
            });
            $('#project_group_delete').click(function() {
                var value = $('#edit_project_group').val();
                if (value == value) {
                    $('#category option[value="' + value + '"]').remove();
                }
                var encoded_url = Base64.encode('warranty/update_general_value/');
                var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
                var classification = 'warranty_category';
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
                            $('#category').next().find('.dropdown-menu li.selected').remove();
                            $('#category').next().find('.selectpicker .filter-option').empty();
                            $('#category').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
                            $(".selectpicker").selectpicker("refresh");
                            //alert("Deleted successfully");
                            $('#alertModal').modal('show');
                            $('.alert_modal_txt').text('Deleted successfully');
                            $("#TypeEditModal").modal('hide');
                        }else
                        {
                            alert("Deletion failed: "+response.message);
                        }
                    }
                }); 
              
            });
        } else if (n > 1) {
            //alert('select only one at a time');
            $('#alertModal').modal('show');
            $('.alert_modal_txt').text('Select only one at a time');
        } else if (n === 0) {
            //alert('Please select');
            $('#alertModal').modal('show');
            $('.alert_modal_txt').text('Please select');
        }
    });
    
  $(function() {
    $(document).on( 'shown.bs.tab', 'a[href="#Files-Pictures"]', function (){        
        uploaded_doc_content_form();
    });
    
    var url = window.location.href;
    var hash = url.substring(url.indexOf("#"));
        
        if (hash == "#Files-Pictures")
        {
            uploaded_doc_content_form();
        }
        
  });
    /* /Drop Down Add / Edit / Delete */
    $('#warrantyinfotab a').click(function (e) {
	var project_id = document.getElementById('project_id').value;
    var title = document.getElementById('title').value;
    var current_tab = this.id;
    if(current_tab == "Basic-tab")
    {
        $('#current_tab').val('#Basic-Info');
    }
    if(current_tab == "Assigned-tab")
    {
        $('#current_tab').val('#Assigned-Info');
    }
    if(current_tab == "Appointments-tab")
    {
        $('#current_tab').val('#Appointments');
    }
    if(current_tab == "Files-Pictures-tab")
    {
        $('#current_tab').val('#Files-Pictures');
    }
	$("#save_type").val('save_and_stay');
	var mandatory = $('#title').val();	
	if(mandatory == ''){			
			var form = $(this).closest("form");   
			form.submit();
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill mandatory fields');					
			return false;
		}
		else if(mandatory != ''){		 
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('save succesfully');
			add_warranty_form();			
			e.preventDefault();
		}
		else{
			$("#save_type").val('save_and_stay');
			add_warranty_form();
			e.preventDefault();
		}	 		
	
});
$(function(){
    $(document).on('ifChecked','#owner', function(event){                
        $("#owner_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#owner', function(event){      
        $("#owner_val").val("No"); 
        });
    $(document).on('ifChecked','#sub', function(event){                
        $("#sub_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#sub', function(event){      
        $("#sub_val").val("No"); 
        });
    $(document).on('ifChecked','#owner-child', function(event){                
        $("#owner_notify").val("Yes");
        $("#owner_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#owner-child', function(event){      
        $("#owner_notify").val("No");
        if($('#owner').is(":checked"))
        {
            $("#owner_val").val("Yes"); 
        }
        else
        {
            $("#owner_val").val("No"); 
        } 
        });
    $(document).on('ifChecked','#sub-child', function(event){                
        $("#sub_notify").val("Yes");
        $("#sub_val").val("Yes");    
    }); 
    $(document).on('ifUnchecked','#sub-child', function(event){      
        $("#sub_notify").val("No");
        if($('#sub').is(":checked"))
        {
            $("#sub_val").val("Yes"); 
        }
        else
        {
            $("#sub_val").val("No"); 
        } 
        });  
});
$(function() {
    add_new_warranty_form();
    $('#uni_save_and_stay').click(function(e) { 
         $('#current_tab').val('');
         $("#save_type").val('save_and_stay'); 
		var mandatory = $('#title').val();		
		if(mandatory == ''){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('Updated Results search succesfully');
			add_warranty_form();
			e.preventDefault();
		}
    });
    $('#uni_save_and_new').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('save_and_new');
        var mandatory = $('#title').val();		
		if(mandatory == ''){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('Updated Results search succesfully');
			add_warranty_form();
			e.preventDefault();
		}
    });
    $('#uni_save_and_back').click(function(e) {
        $('#current_tab').val('');
        $("#save_type").val('save_and_back');
       var mandatory = $('#title').val();		
		if(mandatory == ''){			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');					
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('Updated Results search succesfully');
			add_warranty_form();
			e.preventDefault();
		} 
    });
    $('#uni_cancel').click(function(e) {
        $('#current_tab').val('');
        var encoded_home_string = Base64.encode('warranty/index/');
        var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
        window.location.href = encoded_home_val; 
        e.preventDefault();      
    });
    $('#appoinment_save').click(function(e) {
        $("#save_appointment").val('save_appointment');
		$("#save_type").val('');
        $('#current_tab').val('');
		var subcontractor_user = $('#subcontractor_user').val();	
		var start_date = $('#projected_start_date').val();	
		var service_from_time = $('input[name$="service_from_time"]').val();			
		var service_to_time = $('input[name$="service_to_time"]').val();
		
		var hrs = Number(service_from_time.match(/^(\d+)/)[1]);
		var mnts = Number(service_from_time.match(/:(\d+)/)[1]);
		var format = service_from_time.match(/\s(.*)$/)[1];
		if (format == "PM" && hrs < 12) hrs = hrs + 12;
		if (format == "AM" && hrs == 12) hrs = hrs - 12;
		var from_hours = hrs.toString();
		var from_minutes = mnts.toString();
		if (hrs < 10) from_hours = "0" + from_hours;
		if (mnts < 10) from_minutes = "0" + from_minutes;		
		
		var hrs = Number(service_to_time.match(/^(\d+)/)[1]);
		var mnts = Number(service_to_time.match(/:(\d+)/)[1]);
		var format = service_to_time.match(/\s(.*)$/)[1];
		if (format == "PM" && hrs < 12) hrs = hrs + 12;
		if (format == "AM" && hrs == 12) hrs = hrs - 12;
		var to_hours = hrs.toString();
		var to_minutes = mnts.toString();
		if (hrs < 10) to_hours = "0" + to_hours;
		if (mnts < 10) to_minutes = "0" + to_minutes;				
		if(from_hours <= to_hours){						
			if(to_minutes < from_minutes){				
				//alert('Invalid To Time');
                $('#alertModal').modal('show');
                $('.alert_modal_txt').text('Invalid To Time');
				return false;
			}						
		}		
		else{			
			//alert('Invalid To Time');
            $('#alertModal').modal('show');
            $('.alert_modal_txt').text('Invalid To Time');
			return false;
		}
		

		if(subcontractor_user == '' || start_date == ''){
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill mandatory fields');
			//return false;
			
		}
		else{			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			$('.error-message .alerts').text('save succesfully');
			add_warranty_appoinment_form();			
			e.preventDefault();
		} 		
		
    });
    $('#appoinment_cancel').click(function(e) {
        $('#current_tab').val('');
        $('.schedule_save, .schedule_cancel, .service-con').hide();
        $('#schedule_service').show();
        $('.request-accept').hide();
        $('.save-service-con').hide();
        e.preventDefault();      
    });  
    // $('#post_comment').click(function(e) {
        // add_comment();
        // e.preventDefault();      
    // });
});

 function add_warranty_form(){
    // Encode the String
    var encoded_string = Base64.encode('warranty/save_warranty/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('warranty/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    
    var ub_warranty_claim_id = $('#ub_warranty_claim_id').val();

    var project_id = document.getElementById('project_id').value;
    var title = document.getElementById('title').value;
    var tab = $('#current_tab').val();
    var ajaxData  = $("#add_new_warranty").serialize();     
    $.ajax({
    url: base_url + encoded_val,
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
            $.when(file_upload(response.insert_id)).done(function()
            {
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
            	
	              var encoded_string_edit_builderuser = Base64.encode( 'warranty/save_warranty/' + response.insert_id);
	              var encoded_edit_val = encoded_string_edit_builderuser.strtr(encode_chars_obj);
	              window.location.href = encoded_edit_val+tab;
	            
            }
            $(".error-message .alerts").removeClass('alert-danger');
            $(".error-message .alerts").addClass('alert-success');
            $(".error-message").show();
            if(response.message)
            {
                success_msg = response.message;
            }
            $(".alerts").html(success_msg);
            });
        }
        else
        {   
            $(".error-message .alerts").removeClass('alert-success');
            $(".error-message .alerts").addClass('alert-danger');        
            $(".error-message").show();
            if(response.message)
            {
                failure_msg = response.message;
            }   
            $(".alerts").html(failure_msg);              
        }
        return false;
      }
   }); 
   
}
function delete_warranty(warranty_ids_obj){
    if(warranty_ids_obj > 0)
    {
    var encoded_delete_roles = Base64.encode('warranty/delete_warranty/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('warranty/index/');
    var index_url = index_string.strtr(encode_chars_obj);
    var conf = $('#confirmModal').modal('show');
	$('#delete_confirm').click(function(){
	var conf = true;
    if(conf == true){
	$('#confirmModal').modal('hide');
    $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: {'ub_warranty_claim_id':{ub_warranty_claim_id:warranty_ids_obj}},
            success: function(response) {   
                if(response.status == true)
                {   
                    $(".error-message .alerts").removeClass('alert-danger');
                    $(".error-message .alerts").addClass('alert-success');
                    $(".error-message").show();
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
	});
    }
    else
    {               
        $(".error-message .alerts").addClass('alert-danger');
        $(".error-message .alerts").removeClass('alert-success');
        $(".error-message").show();
        $(".alerts").html("Warranty id is not set");      
    }
}

function add_warranty_appoinment_form()
 {	
     // Encode the String
    var encoded_string = Base64.encode('warranty/save_warranty_appoinment/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    
    var encoded_home_string = Base64.encode('warranty/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
    var warranty_claim_id = $('#warranty_claim_id').val();
    var encoded_app_string = Base64.encode('warranty/save_warranty/'+warranty_claim_id);
    var encoded_app_val = encoded_app_string.strtr(encode_chars_obj); 

    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    var ub_warranty_claim_id = $('#ub_warranty_claim_id').val();
    
    var project_id = document.getElementById('project_id').value;
    var ajaxData  = $("#add_new_warranty").serialize();  
    $.ajax({
    url: base_url + encoded_val,
    dataType: "json",
    type: "post",
    data: ajaxData,  
	beforeSend: function() {
	  $('.uni_wrapper').addClass('loadingDiv');
    },	
    success: function(response) { 
        $('.uni_wrapper').removeClass('loadingDiv');
        if(response.status == true)
        {   
           if($("#save_type").val() == 'save_and_load')
           {
             $tab_href = $('.tab-con li.active a').attr('href');
             window.location.href = encoded_app_val+$tab_href;
             location.reload(true);
           }
            else
            {
               $('#ub_warranty_claim_appointments_id').val(response.insert_id);
               $(".error-message .alerts").removeClass('alert-danger');
               $(".error-message .alerts").addClass('alert-success');
               $(".error-message").show();
               if(response.message)
               {
        			//var encoded_string_edit_builderuser = Base64.encode( 'warranty/save_warranty/');
        			//var encoded_edit_val = encoded_string_edit_builderuser.strtr(encode_chars_obj);
        			//window.location.href = encoded_edit_val+'#Appointments';
                    $tab_href = $('.tab-con li.active a').attr('href');
                    window.location.href = encoded_app_val+$tab_href;
                    location.reload(true);
        			success_msg = response.message;
               }
        	  $(".alerts").html(success_msg);
		   }
        }
        else
        {   
			  $(".error-message .alerts").removeClass('alert-success');
			  $(".error-message .alerts").addClass('alert-danger');        
			  $(".error-message").show();
				  if(response.message)
				  {
					failure_msg = response.message;
				  }   
			  $(".alerts").html(failure_msg);              
        }
        return false;
        
    }
   }); 
}

$(function(){

    $('#commentModal').on('hidden.bs.modal', function () {
      $('#post_comment_form').formValidation('resetForm', true);
      $(this).find('form')[0].reset();
   });

});

/*
Add Comment
*/
function add_comment()
{
    var comments  = $("#comments").val();
    var owner  = $("#owner_val").val();
    var sub  = $("#sub_val").val();
    var title = $("#title").val();
    var warranty_claim_id  = $("#ub_warranty_claim_id").val();
    var project_id = $("#project_id").val();
    var encoded_string = Base64.encode('warranty/save_comment/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: "comments="+comments+"&show_owner="+owner+"&show_sub="+sub+"&warranty_claim_id="+warranty_claim_id+"&project_id="+project_id+"&title="+title,
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');
        },
        success: function(response) {           
				$("#commentModal").modal('hide');
				 $.ajaxSetup({cache: false});
				 $("#comments_area").load(location.href + " #comments_area");
				 send_notify();				
				 $('.uni_wrapper').removeClass('loadingDiv');
			}
        });
}
function send_notify()
 {
    var owner_notify  = $("#owner_notify").val();
    var sub_notify  = $("#sub_notify").val();
    var project_id  = $("#project_id").val();
    var encoded_string = Base64.encode('warranty/send_notify/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: "&owner_notify="+owner_notify+"&sub_notify="+sub_notify+"&project_id="+project_id,         
        success: function(response) {

        
                   
        }
        });
    $("#comments").val('');
    $('#owner').closest('.icheckbox_square-red').removeClass('checked');        
    $('#owner').removeAttr("checked", "checked");
    $('#sub').closest('.icheckbox_square-red').removeClass('checked');        
    $('#sub').removeAttr("checked", "checked");
    $('#owner-child').closest('.icheckbox_square-red').removeClass('checked');        
    $('#owner-child').removeAttr("checked", "checked");
    $('#sub-child').closest('.icheckbox_square-red').removeClass('checked');        
    $('#sub-child').removeAttr("checked", "checked");
    $("#owner_val").val('No');
    $("#sub_val").val('No');
    $("#owner_notify").val('No');
    $("#sub_notify").val('No');
 }


//Delete Comment
function delete_comment(comment_ids_obj){
    
    var encoded_delete_roles = Base64.encode('warranty/delete_comment/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var conf = $('#confirm_comment_Modal').modal('show');
	$('#delete_comment_confirm').click(function(){
	var conf = true;
    if(conf == true){
	$('#confirm_comment_Modal').modal('hide');
    $.ajax({
            type:'POST',
            url: base_url + encoded_delete_val,
            dataType: 'json',
            data: {'ub_comments_id':{ub_comments_id:comment_ids_obj}},
            success: function(response) {   
                if(response.status == true)
                {   
                   
                    if(response.message)
                    {
                        
                        //window.location.href = index_url;
                        $.ajaxSetup({cache: false});
                        $("#comments_area").load(location.href + " #comments_area");
                           
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
/*
Delete Comment End
*/
function add_new_warranty_form(){	
  FormValidation.Validator.subcontractor = {
        validate: function(validator, $field, options) {
            var value = $field.val();
			if (value == 0) {
					return false;
				} 
			return true;				
            }                      
        };
	$('#add_new_warranty').find('[name="subcontractor_id"]').selectpicker().change(function(e) {            
                $('#add_new_warranty').formValidation('revalidateField', 'subcontractor_id');
            }).end().formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#uni_save_and_stay, #uni_save_and_new, #uni_save_and_back, #warrantyinfotab a, #appoinment_save'			
        },
        fields: {
            'title': {
                validators: {
                    notEmpty: {
                        message: 'The Titele is required cannot be empty'
                    }
                }
            },
			 'subcontractor_id': {
                validators: {                    
                    subcontractor: {
                        message: 'Please select servicing'
                    }
                }
            },
			'service_date': {
                validators: {
					notEmpty: {
						 message: 'The date is required'
					},
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is required'
                    }
                }
            }
        }		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 if($("#save_type").val() == 'save_and_stay'){			
				add_warranty_form();				
			 }
			else if($("#save_type").val() == 'save_and_new'){
				add_warranty_form();				
			}	
			else if($("#save_type").val() == 'save_and_back'){
				add_warranty_form();				
			}
			else if($("#save_appointment").val() == 'save_appointment'){				
				add_warranty_appoinment_form();				
			}
			e.preventDefault();			 
	  });	
	$('#datetimepicker6').on('dp.change dp.show', function(e) {		
        $('#add_new_warranty').formValidation('revalidateField', 'service_date');
    });	
		
}

function post_comment_form(){	
	var postcommentform = $('#post_comment_form').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#post_comment'			
        },
        fields: {
            'comments': {
                validators: {
                    notEmpty: {
                        message: 'The comment is required and cannot be empty'
                    },
					stringLength: {
                        min: 2,
                        max: 4000,
                        message: 'The comment must be less than 4000 characters'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			add_comment();
			e.preventDefault();			 
	  });  
}

//schedule confirm
$('#appoinment_confirm').click(function(e) { 
    $('#appoinment_status').val('Accepted');
    $("#save_type").val('save_and_load');
   add_warranty_appoinment_form();
   e.preventDefault();
});

$('#appoinment_reschedule').click(function(e) { 
    $('#appoinment_status').val('Reschedule');
    $("#save_type").val('save_and_load');
    //appointment_validation();
    var prefered_date               = $('#prefered_date').val();        
    var prefered_time               = $('#prefered_time').val();              
    
    if(prefered_date == '' || prefered_time == ''){  
        //appointment_validation();
        var form = $(this).closest("form");   
        form.submit();      
        error_box();
        $('.error-message .alerts').text('Please fill prefered date and time');
        return false;           
    }
    else{           
        add_warranty_appoinment_form();
        e.preventDefault();
    }
   //add_warranty_appoinment_form();
   //e.preventDefault();
});
function appointment_validation(){  
    var bidform = $('#add_new_warranty').formValidation({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
     button: {
            selector: '#appoinment_reschedule'          
        },
        fields: {
            'prefered_date': {
                validators: {
                    notEmpty: {
                        message: 'The prefered_date is required and cannot be empty'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is required'
                    }
          
                }
            },
            'prefered_time': {
                validators: {
                    notEmpty: {
                        message: 'The prefered_time is required and cannot be empty'
                    },
                    /*date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is required'
                    }*/
          
                }
            },
           
        } 
    
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {      
       if($("#save_type").val() == 'save_and_load')
       {
         add_warranty_appoinment_form();   
       }    
       
      
      e.preventDefault();      
    }); 
  
}

/*Below code for File Upload*/
    $(function(){
    var encoded_string = Base64.encode('warranty/get_doc_hierarchy/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var tree_data;
    var jsonUrl = encoded_val;
    $.getJSON(jsonUrl, function(data) {
        tree_data = data;
        //alert(JSON.stringify(tree_data));
        tree_data_fun();
    });

    function tree_data_fun() {
        $('#fixed-tree').fileTree({
            data: tree_data
        });
    }

    $('body').on('click', 'li.file', function() {
        $('li.file').removeClass('selected');
        $(this).addClass('selected');
    });
});

function file_upload(insert_id)
{
    var temp_directory_id = $("#temp_directory_id").val();
    var folderid = $("#folder_id").val();
    var moduleid = insert_id;
    var projectid = $('#project_id').val();
    var encoded_string = Base64.encode('warranty/get_temp_filename/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var response = $.ajax({
        url: base_url + encoded_val,
        //dataType: "json",
        type: "post",
        data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid + '&moduleid='+moduleid + '&projectid='+projectid,          
        /*beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');             
        },*/  
        success: function(response) {       
            //if(response.status == true)
            //{ 
                //window.location.href = role_index_url;
            //}
        }
    });
    return  response;
}
/*function to copy the files path to the hidden variable */
function copy_file_path(file_path)
{
    $('#temp_file_path').val(file_path);
    $(".upload_alerts").html('');
}

function copy_file_to_temp()
{
    var file_path = $('#temp_file_path').val();
    var temp_id = $("#temp_directory_id").val();
    var encoded_string = Base64.encode('warranty/copy_file_to_temp/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);   
	if(file_path == '')
	{
		$(".modal-body .upload_error-message .upload_alerts").removeClass('alert-success');
		$(".modal-body .upload_error-message .upload_alerts").addClass('alert-danger');
		$(".modal-body .upload_error-message").show();
		$(".upload_alerts").html('Please Select a File');
	}
	else
	{
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: 'file_path='+file_path+'&temp_id='+temp_id,       

        success: function(response) 
        {
          if(response.status == true)
          {
            $(".modal-body .upload_error-message .upload_alerts").removeClass('alert-danger');
            $(".modal-body .upload_error-message .upload_alerts").addClass('alert-success');
            $(".modal-body .upload_error-message").show();
            if(response.message)
            {
                success_msg = response.message;
            }
            $(".upload_alerts").html(success_msg);
            relode_temp();
          }
        }
    });
	}	
} 

function relode_temp()
{
    var temp_id = $("#temp_directory_id").val();
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#add_new_warranty').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#add_new_warranty')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $("#add_new_warranty").find(".files").empty();
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
}
/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
	if(file_upload_list_page_user == 100)
	{
    'use strict';
    
    var temp_id = $("#temp_directory_id").val();    

    //alert(temp_id); 
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('warranty/upload/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#add_new_warranty').fileupload({
    add: function(e, data) {
            var name = data.originalFiles[data.index].name;
            var size = data.originalFiles[data.index].size;
            // code to validate the directory name start.
            var values = new Object() // creates a new instance of an object
            $('.doc_name').each(function() {
                values[$(this).attr('title')] = $(this).val()
            })
            var output = "";
            var property = "";
            for (property in values) {
              output += property + ',' + values[property];
            }
            var output_data = output.substring(0, output.length - 1);
            var array = output_data.split(',');
            if ($.inArray(name, array) > -1)
            {
                //alert(name + ' - Already exixt.' );
                $('#alertModal').modal('show');
                $('.alert_modal_txt').text(name + ' - Already exixt.' );
                return false;
            }
            // code to validate the directory name end.

            var encoded_string = Base64.encode('warranty/allowed_extension/');
            var encoded_val = encoded_string.strtr(encode_chars_obj);
            var uploadErrors = [];
            var ext = name.split('.').pop().toLowerCase();
            $.ajax({
                url: base_url + encoded_val,
                dataType: "json",
                type: "post",
                data: "ext="+ext,
				beforeSend: function() {
					$('.uni_wrapper').addClass('loadingDiv');					  
				},				
                success: function(response) {   
					$('.uni_wrapper').removeClass('loadingDiv');
                    if(response.status == false)
                    {   
                        //alert("Not an accepted file type.");
                        $('#alertModal').modal('show');
                        $('.alert_modal_txt').text(ext +"is not an accepted file type.");
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        //alert(name + ' - Filesize is too big.' );
                        $('#alertModal').modal('show');
                        $('.alert_modal_txt').text(name + ' - Filesize is too big.' );
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        //alert(uploadErrors.join("\n"));
                        $('#alertModal').modal('show');
                        $('.alert_modal_txt').text(uploadErrors.join("\n"));
                        return false;
                    }
                    else
                    {              
                        data.submit();          
                    }
                }
            });
        },
        url: encoded_val,
        dataType: 'json',
        autoUpload: false,
        // acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        // maxFileSize: 5000000,
		beforeSend: function() {
			$('.uni_wrapper').addClass('loadingDiv');		  
		},				
        success: function (data) {          
            setTimeout(checkbox, 1*200);            
            //alert(JSON.stringify(response));
            $("#temp_directory_id").val(data.files[0]['temp_dir_id']);
			$('.uni_wrapper').removeClass('loadingDiv');
        }
    });
    // Load existing files:
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#add_new_warranty').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#add_new_warranty')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
	}
});


//file upload list
$(function() {
	if(file_upload_list_page_user != 100)
	{
    uploaded_doc_content_form();
	}
});
function uploaded_doc_content_form() {
	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	var folderid = $("#folder_id").val();
	var moduleid = $("#warranty_claim_id").val();
	var projectid = $("#project_id").val();
	var encoded_string = Base64.encode('warranty/get_uploaded_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
						'tableName': $('#uploaded_doc_content'),
						'this_table' : {'table_name':'uploaded_doc_content'},
						'ajax_encoded_url':encoded_val,
						//'parent_id' : '{"folderid":"'+folderid+'"}',
						'folder_id' : 'folder_id',
						'post_data':'{"folderid":"'+folderid+'","moduleid":"'+moduleid+'","projectid":"'+projectid+'"}',
						'display_columns' : [{"data": "file_name", "bSortable": false},{"data": "date", "bSortable": false},{"data": "date", "bSortable": false}],
						'default_order_by': [[0, 'desc']]
					};
	// Populate data table
	ubdatatable_docs(dbobject);
}