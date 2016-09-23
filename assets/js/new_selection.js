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

/* alert(selection_dir_id);
alert(choice_dir_id); */
$('select#schedule_id,select#before_or_after,#number_days').on('change',function() {
    var schedule_id = $('#schedule_id').val();
    if(schedule_id != ''){
    var encoded_string = Base64.encode('selections/get_schedule_date/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_selections").serialize(); 
    $.ajax({
    url: base_url + encoded_val,
    dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
        //alert(response.end_date);
        $('#schedule_due_date').val(response.end_date);
      }
    });
    }
    else
    {
      $('#schedule_due_date').val('');
    }
  });
//checking project status -- code added by satheesh kumar
$(function() {
	choice_val_form();
	var ub_selection_id = $('#ub_selection_id').val();   
	if(ub_selection_id == '' || ub_selection_id == 0)
	{
		check_project_status('selections/index/');
	}
	else if(project_status_check == false)
	{
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Project was closed. You can not able to edit');
		//alert('you can not edit');
	}
	/* checking project status code ends here*/
});

imgLink = base_url + 'assets/images/';
 $(function() {
	 $('#choice_owner_price_tbd').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#choice_builder_cost_price').keyup(function() {       
		var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	add_new_selections_form();
	post_comment_form();
	$('#datetimepicker5').datetimepicker({
		pickTime: false
	});
	$('#task-time').datetimepicker({
		pickDate: false
	});
	$('#allowance').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9\.]/g, function(){return ''; }) );
    });
	$('#days').keyup(function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){return ''; }) );
    });
	
});
 
$(function(){
    var encoded_string = Base64.encode('selections/get_doc_hierarchy/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
 var tree_data;
    var jsonUrl = encoded_val;
    $.getJSON(jsonUrl, function(data) {
        tree_data = data;
        //alert(JSON.stringify(tree_data));
        tree_data_fun();
    });

    function tree_data_fun() {
        $('.fixed-tree').fileTree({
            data: tree_data
        });
    }

    $('body').on('click', 'li.file', function() {
        $('li.file').removeClass('selected');
        $(this).addClass('selected');
    });
    $('.file_uploaded_div').enscroll({
        showOnHover: false,
        verticalTrackClass: 'track3',
        verticalHandleClass: 'handle3'
    });
});
$(function() {
    $(window).load(function() {
        $("#docs_upload_Modal .modal-con, #docs_discus_upload_Modal .modal-con").mCustomScrollbar({
            setHeight: 250,
            theme: "dark-3"
        });

    });

});
$(function() {
    $('.link-to').hide();
    $(document).on('change','#toggle-event', function() {
        var task = $(this).prop('checked');
        if (task == true) {
			$('.toggle').removeClass('off');
			$('.toggle').removeClass('btn-default');
			$('.toggle').addClass('btn-primary');
            $('.link-to').show();
            $('.due-date').hide();
        } else if (task == false) {
			$('.toggle').addClass('off');
			$('.toggle').addClass('btn-default');
			$('.toggle').removeClass('btn-primary');
            $('.due-date').show();
            $('.link-to').hide();
        }
    });
});
$(function() {

    $(window).load(function() {
        $(".inner-jumbotron").mCustomScrollbar({
            setHeight: 300,
            theme: "dark-3"
        });

    });

});
$(function() {
    $('.choice-con').hide();
    $('#add_choice').click(function() {
        $('.choice-con').toggle();
        $('.status_box').hide();
        $('.selection_choice').toggleClass('hide');
		// $('.choice #folder_id').val(choice_folder_id);
        // $('.choice #temp_directory_id').val(choice_dir_id);
		$("#choice_form").trigger('reset');
		$("#choice_form .selectpicker").selectpicker('refresh');
    });
});
$(function() {
    //selection_choice();
});
/* selection choice file upload hidden value */
/* $('#selection_file_upload').click(function() 
{
    $('.selection_file #folder_id').val(selection_folder_id);
    $('.selection_file #temp_directory_id').val(selection_dir_id);
}); */

function selection_choice() {
    $('#selection_choice').dataTable({
        "aLengthMenu": [
            [5, 15, 50, 100],
            [5, 15, 50, "l00"]
        ],
        "iDisplayLength": 5,
        sAjaxSource: base_url + 'assets/js/selection_choice.json',
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [0] // <-- gets last column and turns off sorting
        }],
        "columns": [{
                "sTitle": "Choice",
                "data": "choice"
            }, {
                "sTitle": "Added By",
                "data": "addedby"
            }, {
                "sTitle": "Details",
                "data": "details"
            }, {
                "sTitle": "Status/Alerts",
                "data": "status"
            }, {
                "sTitle": "Price",
                "data": "price"
            }

        ],
        "fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {
            var status_icon = data.status[0].icon;
            var status_text = data.status[0].text;
            var status_details = '<img src="' + imgLink + status_icon + '"/>&nbsp;&nbsp;&nbsp;' + status_text + '';
            var added_by = '<img src="' + imgLink + data['addedby'] + '"/>';

            $('td:eq(1)', nRow).html(added_by);
            $('td:eq(3)', nRow).html(status_details);
            return nRow;
        },
        "order": [
            [1, 'asc']
        ]

    });
}
$(function() {
    selection_file_photos();
});

function selection_file_photos() {
    $('#selection_file_photos').dataTable({
        "aLengthMenu": [
            [5, 15, 50, 100],
            [5, 15, 50, "l00"]
        ],
        "iDisplayLength": 5,
        sAjaxSource: base_url + 'assets/js/selection_file_photos.json',
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [-1] // <-- gets last column and turns off sorting
        }],
        "fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {
            var permission_UserIcon = data.permission[0].usericon;
            var permission_OwnerIcon = data.permission[0].ownericon;
            var view_permission = '<div class="text-center"><input type="checkbox"/>' + '&nbsp;&nbsp;&nbsp;' + '<img src="' + imgLink + permission_UserIcon + '" />' + '<span class="space"></span>' + '<input type="checkbox"/>' + '&nbsp;&nbsp;&nbsp;' + '<img src="' + imgLink + permission_OwnerIcon + '" />' + '&nbsp;&nbsp;&nbsp;<img src="' + imgLink + 'delete.png" />' + '</div>';
            $('td:eq(2)', nRow).html(view_permission);
            return nRow;
        },
        "columns": [

            {
                "sTitle": "File Name",
                "data": "filename"
            }, {
                "sTitle": "Size",
                "data": "size"
            }, {
                "sTitle": "View Permission",
                "data": "permission"
            }
        ],
        "order": [
            [1, 'asc']
        ]

    });
}
$(function() {
    selection_file_discussion();
});

function selection_file_discussion() {
        $('#selection_file_discussion').dataTable({
            "aLengthMenu": [
                [5, 15, 50, 100],
                [5, 15, 50, "l00"]
            ],
            "iDisplayLength": 5,
            sAjaxSource: base_url + 'assets/js/selection_file_discussion.json',
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [-1] // <-- gets last column and turns off sorting
            }],
            "fnRowCallback": function(nRow, data, iDisplayIndex, iDisplayIndexFull) {
                var permission_UserIcon = data.permission[0].usericon;
                var permission_OwnerIcon = data.permission[0].ownericon;
                var view_permission = '<div class="text-center"><input type="checkbox"/>' + '&nbsp;&nbsp;&nbsp;' + '<img src="' + imgLink + permission_UserIcon + '" />' + '<span class="space"></span>' + '<input type="checkbox"/>' + '&nbsp;&nbsp;&nbsp;' + '<img src="' + imgLink + permission_OwnerIcon + '" />' + '&nbsp;&nbsp;&nbsp;<img src="' + imgLink + 'delete.png" />' + '</div>';
                $('td:eq(2)', nRow).html(view_permission);
                return nRow;
            },
            "columns": [

                {
                    "sTitle": "File Name",
                    "data": "filename"
                }, {
                    "sTitle": "Size",
                    "data": "size"
                }, {
                    "sTitle": "View Permission",
                    "data": "permission"
                }
            ],
            "order": [
                [1, 'asc']
            ]

        });
    }
    //chandru code starting from here

/* Drop Down Add / Edit / Delete category */
$('#category').on('change', function() {
    var selected = $(this).find("option:selected").val();
    $('#edit_project_group').val(selected);
    $('#selected').val(selected);
});
$('#category_save').click(function() {
    var value = $('#category_add').val();
    var encoded_url = Base64.encode('selections/update_general_value/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
    var classification = 'selection_category';
    var operation_type = 'add';
	if(value!=''){
    xhr = $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            "classification": classification,
            "type": operation_type,
            "value": value
        },
        url: base_url + ajax_encoded_url,
        success: function(response) {
            if (response.status == true) {
                $('#category').append($("<option value=" + value + ">" + value + "</option>").text(value));
                $(".selectpicker").selectpicker("refresh");
                // alert("Added successfully");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Added successfully');
                $("#TypeAddModal").modal('hide');
            } else {
                // alert("Insertion failed");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Insertion failed');
            }
        }
    });
	}
       else
       {
		// alert('Please Enter a category name');
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please Enter a category name');
       }
});
$('.TypeEditModal').click(function() {
    var n = $('#category').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
	if($('#selected').val() == '')
	{
		// alert('Please select');
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select');
		return false;
	}
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
            var encoded_url = Base64.encode('selections/update_general_value/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var classification = 'selection_category';
            var operation_type = 'delete';
            dataobj = {
                "classification": classification,
                "type": operation_type,
                "value": value
            };
            xhr = $.ajax({
                type: "POST",
                dataType: "json",
                data: dataobj,
                url: base_url + ajax_encoded_url,
                success: function(response) {
                    if (response.status == true) {
                        $('#edit_project_group').val('');
                        $('#category').next().find('.dropdown-menu li.selected').remove();
                        $('#category').next().find('.selectpicker .filter-option').empty();
                        $('#category').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
                        $(".selectpicker").selectpicker("refresh");
                        // alert("Deleted successfully");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text('Deleted successfully');
                        $("#TypeEditModal").modal('hide');
                    } else {
                        // alert("Deletion failed: " + response.message);
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text("Deletion failed: " + response.message);
                    }
                }
            });

        });
    } else if (n > 1) {
        // alert('select only one at a time');
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('select only one at a time');
    } else if (n === 0) {
        // alert('Please select');
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select');
    }
});

/* Drop Down Add / Edit / Delete Locations */
$('#locations').on('change', function() {
    var selected = $(this).find("option:selected").val();
    $('#edit_project_groups').val(selected);
    $('#selected').val(selected);
});
$('#locations_save').click(function() {
    var value = $('#locations_add').val();
    var encoded_url = Base64.encode('selections/update_general_value/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
    var classification = 'selction_location';
    var operation_type = 'add';
	if(value!=''){
    xhr = $.ajax({
        type: "POST",
        dataType: "json",
        data: {
            "classification": classification,
            "type": operation_type,
            "value": value
        },
        url: base_url + ajax_encoded_url,
        success: function(response) {
            if (response.status == true) {
                $('#locations').append($("<option value=" + value + ">" + value + "</option>").text(value));
                $(".selectpicker").selectpicker("refresh");
                // alert("Added successfully");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Added successfully');
                $("#TypeAddModals").modal('hide');
            } else {
                // alert("Insertion failed");
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text('Insertion failed');
            }
        }
    });
	}
       else
       {
			// alert('Please Enter a Location name');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please Enter a Location name');
       }
});
$('.TypeEditModals').click(function() {
    var n = $('#locations').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
	if($('#selected').val() == '')
	{
		// alert('Please select');
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Please select');
		return false;
	}
    if (n === 1) {
        $('#TypeEditModals').modal({
            show: true
        });
        $('#Edit_project').click(function() {
            var sat = $('#edit_project_groups').val();
            var selected_val = $('#selected').val();
            if (selected_val == selected_val) {
                $('#locations option[value=' + selected_val + ']').remove();
            }
            if (sat == sat) {
                $('#locations').append($("<option value=" + sat + ">" + sat + "</option>").text(sat));
            }
            $('#locations').next().find('.dropdown-menu li.selected a .text').empty();
            $('#locations').next().find('.dropdown-menu li.selected a .text').append(sat);
            $('#locations').next().find('.selectpicker .filter-option').empty();
            $('#locations').next().find('.selectpicker .filter-option').append(sat);
        });
        $('#project_group_deletes').click(function() {
            var value = $('#edit_project_groups').val();
            if (value == value) {
                $('#locations option[value="' + value + '"]').remove();
            }
            var encoded_url = Base64.encode('selections/update_general_value/');
            var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
            var classification = 'selction_location';
            var operation_type = 'delete';
            dataobj = {
                "classification": classification,
                "type": operation_type,
                "value": value
            };
            xhr = $.ajax({
                type: "POST",
                dataType: "json",
                data: dataobj,
                url: base_url + ajax_encoded_url,
                success: function(response) {
                    if (response.status == true) {
                        $('#edit_project_group').val('');
                        $('#locations').next().find('.dropdown-menu li.selected').remove();
                        $('#locations').next().find('.selectpicker .filter-option').empty();
                        $('#locations').next().find('.dropdown-toggle.selectpicker').removeAttr('title');
                        $(".selectpicker").selectpicker("refresh");
                        // alert("Deleted successfully");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text('Deleted successfully');
                        $("#TypeEditModals").modal('hide');
                    } else {
                        // alert("Deletion failed: " + response.message);
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text("Deletion failed: " + response.message);
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

//Inser code starts from here

$(function() {    
    $('#selectioninfotab ul li a').click(function(e) {
        $("#save_type").val('save_and_stay');
		var title = $('#title').val();
        var current_tab = this.id;
        //alert(current_tab);
        if(current_tab == "General-tab")
        {
         $('#current_tab').val('#General');
        }
        if(current_tab == "Description-tab")
        {
         $('#current_tab').val('#Description');
        }
        if(current_tab == "selection_file_upload")
        {
         $('#current_tab').val('#Discussion');
        }
        if(current_tab == "Participation-tab")
        {
         $('#current_tab').val('#Particiption');
        }		
		if(title == ''){
			var form = $(this).closest("form");   
			form.submit();			
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-success');
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-danger');
			$('.error-message .alerts').text('Please fill all mandatory fields');	
			return false;			
		}
		else{
			$('.error-message').show();
			$('.error-message .alerts').removeClass('alert-danger');
			$('.error-message .alerts').addClass('alert-success');
			//$('.error-message .alerts').text('Updated Results search succesfully');
			add_selections_form();
			e.preventDefault();
		}
    });
    //Add and Stay
    $('#add_selection_new_back').on('click', function(e) {
        $("#save_type").val('save_and_stay');
        $('#current_tab').val('');
		var title = $('#title').val();		
		if(title == ''){			
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
			add_selections_form();
			e.preventDefault();
		}        
    });
    //Add and back
    $('#add_selection_new_back_to_list').on('click', function(e) {
        $("#save_type").val('save_and_back');
        $('#current_tab').val('');
        var title = $('#title').val();		
		if(title == ''){			
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
			add_selections_form();
			e.preventDefault();
		}

    });
    //Add and new
    $('#add_selection_new_button').on('click', function(e) {
        $("#save_type").val('save_and_new');
        $('#current_tab').val('');
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
			add_selections_form();
			e.preventDefault();
		} 
    });  
	$('#btncancel').click(function(e) {		
         var encoded_home_string = Base64.encode('selections/index/');
         var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
         window.location.href = encoded_home_val; 
         e.preventDefault();      
    }); 
    // $('#post_comment').click(function(e) {
        // add_comment();
        // e.preventDefault();
    // });
});
//Cancel button code
function add_new_choices_cancel() {
        /*var id = confirm("Are you sure you want to Cancel");
        if (id == true) {*/
            location.reload(true);
        /*}*/
    }
    //CHOICE Add
function add_new_choices() {
	$("#add_new_choices").hide();
    var ub_selection_id = $('#ub_selection_id').val();
    var owner_id = $('#owner_id').val();
    var ub_selection_choice_id = $('#ub_selection_choice_id').val();
    var choice_title = $('#choice_title').val();
    var choice_standard_choice = $('#choice_standard_choice_hidden').val();
    var choice_product_url = $('#choice_product_url').val();
    var choice_owner_price = $('#choice_owner_price_hidden').val();
    var choice_owner_price_tbd = $('#choice_owner_price_tbd').val();
    var choice_builder_cost_price = $('#choice_builder_cost_price').val();
    var choice_builder_cost = $('#choice_builder_cost_hidden').val();
    var choice_sub_pricing_comments = $('#choice_sub_pricing_comments').val();
    var choice_vendor = $('#choice_vendor').val();
    var choice_installer = $('#choice_installer').val();
    var choice_description = $('#choice_description').val();

    var encoded_url = Base64.encode('selections/save_selection_choices/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);

    var data = 'choice_title=' + choice_title + '&choice_standard_choice=' + choice_standard_choice + '&choice_product_url=' + choice_product_url + '&choice_owner_price=' + choice_owner_price + '&choice_owner_price_tbd=' + choice_owner_price_tbd + '&choice_builder_cost_price=' + choice_builder_cost_price + '&choice_builder_cost=' + choice_builder_cost + '&choice_sub_pricing_comments=' + choice_sub_pricing_comments + '&choice_vendor=' + choice_vendor + '&choice_installer=' + choice_installer + '&choice_description=' + choice_description + '&ub_selection_id=' + ub_selection_id + '&ub_selection_choice_id=' + ub_selection_choice_id + '&owner_id=' + owner_id+ '&choice_dir_id=' + choice_dir_id;
    //alert(data);return false;
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
            if (response.status == true) {
                $.when(choice_file_upload(response.insert_id)).done(function()
                {
                    location.reload(true);
                });
            } else {
                if (response.message) {
                    failure_msg = response.message;
                }
                //$(".alert").html(failure_msg);                
            }
            return false;
        }
    });
}

function add_selections_form() {
    // Encode the String
    var encoded_string = Base64.encode('selections/save_selection/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);

    var encoded_home_string = Base64.encode('selections/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
    var tab = $('#current_tab').val();
    var success_msg = 'Successful';
    var failure_msg = 'Failed';
    var ajaxData = $("#add_new_selections").serialize();
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,
		beforeSend: function() {
              $('.uni_wrapper').addClass('loadingDiv');			 
        },
        success: function(response) {
            if (response.status == true) {
                //console.log(response.insert_id);return false;
				$.when(selection_file_upload(response.insert_id)).done(function()
				{
				 $('.uni_wrapper').removeClass('loadingDiv');
                if ($("#save_type").val() == 'save_and_new') {
                    window.location.href = encoded_val;
                } else if ($("#save_type").val() == 'save_and_back') {
                    window.location.href = encoded_home_val;
                } else if ($("#save_type").val() == 'save_and_stay') {
                    //if (response.message == 'Data inserted successfully') {
                        var encoded_string_edit_log = Base64.encode('selections/save_selection/' + response.insert_id);
                        var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                        window.location.href = encoded_edit_val+tab;
                    //}
                }
                if (response.message) {
                    success_msg = response.message;
                }
                $(".alerts").html(success_msg);
				});
            } else {
                if (response.message) {
                    failure_msg = response.message;
                }
                $(".alerts").html(failure_msg);				
            }
            return false;
        }
    });
}
$(function() {
    $(document).on('ifChecked','#owner', function(event) {
        $("#owner_val").val("Yes");
    });
    $(document).on('ifUnchecked','#owner', function(event) {
        $("#owner_val").val("No");
    });
    $(document).on('ifChecked','#sub', function(event) {
        $("#sub_val").val("Yes");
    });
    $(document).on('ifUnchecked','#sub', function(event) {
        $("#sub_val").val("No");
    });
    $(document).on('ifChecked','#owner-child', function(event) {
        $("#owner_notify").val("Yes");
        $("#owner_val").val("Yes");
    });
    $(document).on('ifUnchecked','#owner-child', function(event) {
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
    $(document).on('ifChecked','#sub-child', function(event) {
        $("#sub_notify").val("Yes");
        $("#sub_val").val("Yes");
    });
    $(document).on('ifUnchecked','#sub-child', function(event) {
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
    //Check box in selection choice
    $(document).on('ifChecked','#choice_standard_choice', function(event) {
        $("#choice_standard_choice_hidden").val("Yes");
    });
    $(document).on('ifUnchecked','#choice_standard_choice', function(event) {
        $("#choice_standard_choice_hidden").val("No");
    });

    $(document).on('ifChecked','#choice_owner_price', function(event) {
        $("#choice_owner_price_hidden").val("Yes");
    });
    $(document).on('ifUnchecked','#choice_owner_price', function(event) {
        $("#choice_owner_price_hidden").val("No");
    });

    $(document).on('ifChecked','#choice_builder_cost', function(event) {
        $("#choice_builder_cost_hidden").val("Yes");
    });
    $(document).on('ifUnchecked','#choice_builder_cost', function(event) {
        $("#choice_builder_cost_hidden").val("No");
    });
});
/*
Add Comment
*/
function add_comment() {
    var comments = $("#comments").val();
    var owner = $("#owner_val").val();
    var sub = $("#sub_val").val();
    var selection_id = $("#ub_selection_id").val();
    var project_id = $("#project_id").val();
    var encoded_string = Base64.encode('selections/save_comment/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: "comments=" + comments + "&show_owner=" + owner + "&show_sub=" + sub + "&selection_id=" + selection_id + "&project_id=" + project_id,
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			 
        },
        success: function(response) {
			 $('.uni_wrapper').removeClass('loadingDiv');
            $("#commentModal").modal('hide');
            $.ajaxSetup({
                cache: false
            });
            $("#comments_area").load(location.href + " #comments_area");
            send_notify();

        }
    });
}

function send_notify() {
    var owner_notify = $("#owner_notify").val();
    var sub_notify = $("#sub_notify").val();
    var project_id = $("#project_id").val();
    var encoded_string = Base64.encode('selections/send_notify/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: "&owner_notify=" + owner_notify + "&sub_notify=" + sub_notify + "&project_id=" + project_id,
        success: function(response) {

        }
    });
}


//Delete Comment
function delete_comment(comment_ids_obj) {

	var encoded_delete_roles = Base64.encode('selections/delete_comment/');
	var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
	var index_string = Base64.encode('logs/save_log/');
	var index_url = index_string.strtr(encode_chars_obj);
	var conf = $('#commentconfirmModal').modal('show');
	$('#commentdelete_confirm').click(function(){
		var conf = true;
		if(conf == true){
			$('#commentconfirmModal').modal('hide');
			$.ajax({
				type: 'POST',
				url: base_url + encoded_delete_val,
				dataType: 'json',
				data: {
					'ub_comments_id': {
						ub_comments_id: comment_ids_obj
					}
				},
				success: function(response) {
					if (response.status == true) {

						if (response.message) {

							//window.location.href = index_url;
							$.ajaxSetup({
								cache: false
							});
							$("#comments_area").load(location.href + " #comments_area");

						}

					} else {
						if (response.message) {
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
/* Delete selection code added by chandru 14-07-2015 */
function delete_selection(ub_selection_id){
    if(ub_selection_id > 0)
    {
    var encoded_delete_roles = Base64.encode('selections/delete_selection_data/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('selections/index/');
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
            data: {'ub_selection_id':{ub_selection_id:ub_selection_id}},
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
        $(".alerts").html("Selection id is not set");      
    }
}

//Data table code was added by chandru raja 28/04/15
$(function() {
    if (typeof list_page != 'undefined') {
        selection_choice_list();
    }
});

//Data table code
function selection_choice_list() {
    // Ajax URL
    var ub_selection_choice_ids = $("#ub_selection_id").val();
    var encoded_url = Base64.encode('selections/get_selection_choices/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
    // Data table Object
    //alert(123);
    var dbobject = {
        'tableName': $('#selection_choices'),
        'this_table': {
            'table_name': 'selection_choices'
        },
        'ajax_encoded_url': ajax_encoded_url,
        'id': 'ub_selection_choice_id',
        'name': 'choice_title',
        'post_data': '{"ub_selection_choice_ids":"' + ub_selection_choice_ids + '"}',
        'delete_data': {
            'index': 0
        },
        'edit_data': {
            'index': 1,
            'url': 'selections/save_selection_choices/'
        },
        'display_columns': [{
            "className": 'da-tab-checkbox',
            "orderable": false,
            "data": 'ub_selection_choice_id',
            "defaultContent": '<input type="checkbox" class="chk" />'
        }, {
            "data": "choice_title"
        }, {
            "data": "creator"
        }, {
            "data": "description"
        }, {
            "data": "status"
        }, {
            "data": "owner_price","render": $.fn.dataTable.render.number( ',', '.', 2)
        }],
        'default_order_by': [
            [1, 'asc']
        ]
    };
    //alert(1234);
    //alert(dbobject);
    //alert(JSON.stringify(dbobject));
    // Populate data table
    ubdatatable(dbobject);
    $('#selection_choices').on('click', 'a.editor_remove', function(e) {
        var ub_selection_choice_id = $(this).attr('id');
        delete_task({
            'ub_selection_choice_id': {
                ub_selection_choice_id: ub_selection_choice_id
            }
        });
    });
}

function get_selection_choices_form(ub_selection_choice_id , choice_dir_id) {
    var encoded_delete_roles = Base64.encode('selections/save_selection_choices/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    $.ajax({
        type: 'POST',
        url: base_url + encoded_delete_val,
        dataType: 'json',
        data: "ub_selection_choice_id=" + ub_selection_choice_id + "&choice_dir_id=" + choice_dir_id,
        success: function(response) {
            if (response.status != "") {
                $('.choice .folder_id').val(choice_folder_id);
                $('.choice .temp_directory_id').val(choice_dir_id);
                $('#add_choice').toggleClass('hide');
                $('.choice-con').toggle();
                $('.selection_choice').toggleClass('hide');
                //$("#selection_choice_block").load(location.href + " #selection_choice_block");
                $('#ub_selection_choice_id').val(response['ub_selection_choice_id']);
                $('#choice_title').val(response['choice_title']);
                $('#added_on').val(response['created_on_date']);
                //$('#followup_time').val(response['standard_choice']);
                $('#choice_product_url').val(response['product_url']);

                $('#choice_owner_price_tbd').val(response['owner_price']);
                //checkbox code
                $('#choice_standard_choice').val(response['standard_choice']);
                if ($('#choice_standard_choice').val() == 'Yes') {
                    /* $('.check_box_value .icheckbox_square-red').removeClass('checked');		
						$('.check_box_value').removeAttr('checked');	 */
                    //$('#choice_standard_choice').closest('.icheckbox_square-red').addClass('checked');
                    $('#choice_standard_choice').iCheck('check');
                }
                $('#choice_owner_price').val(response['owner_price_tbd']);
                if ($('#choice_owner_price').val() == 'Yes') {
                    $('#choice_owner_price').iCheck('check');
                }
                //alert($('#choice_owner_price').val());
                $('#choice_builder_cost').val(response['subcontractor_price_tbd']);
                if ($('#choice_builder_cost').val() == 'Yes') {
                    $('#choice_builder_cost').iCheck('check');
                }
                //checkbox code ends here
                $('#choice_builder_cost_price').val(response['subcontractor_price']);
                $('#choice_sub_pricing_comments').val(response['sub_pricing_comments']);
                $('#choice_description').val(response['description']);
                $("#choice_vendor option[value='" + response['vendor_id'] + "']").prop("selected", true);
                $("#choice_installer option[value='" + response['installer_id'] + "']").prop("selected", true);
                $('.selectpicker').selectpicker('refresh');

                /* $("input[id='#choice_standard_choice']:first").checkboxradio("refresh");
					$("#choice_owner_price").checkboxradio("refresh");
					$("#choice_builder_cost").checkboxradio("refresh"); */

                //$('#choice_status').html(response['status']);
                //alert(response['total_count']);
                if(response['total_count'] == 0 && response['status'] != 'Declined')
                {
                    $('.owner_approve').show();
                    $('.owner_decline').show();
                }
                else
                {
                    $('.owner_approve').hide();
                    $('.owner_decline').hide();
                    $('#choice_status').html(response['status']);
                }
					
				//--- checking role access // by satheesh kumar 
				if(response['status'] == 'Approved')
				{
					$('.owner_approve').hide();
				}else if(response['status'] == 'Pending')
				{
					$('.owner_pending').hide();
				}else if(response['status'] == 'Declined')
				{
					$('.owner_decline').hide();
				}
				if(response['account_type']== 200 && response['user_id'] != response['created_by'])
				{
					$("#add_new_choices").hide();
				}
				if(response['account_type']== 200 && response['user_id'] == response['created_by'])
				{
					$("#added_on").prop('readonly', true);
					$("#choice_owner_price_tbd").prop('readonly', true);
					$("#choice_vendor").prop('disabled', true);
					$("#choice_installer").prop('disabled', true);
				}
				if(response['account_type']== 300)
				{
					$("#added_on").prop('readonly', true);
					$("#choice_vendor").prop('disabled', true);
					$("#choice_installer").prop('disabled', true);
					if(response['user_id'] != response['created_by'])
					{
						$('#choice_builder_cost').iCheck('disable');
						$('#choice_standard_choice').iCheck('disable');
						// $("#choice_standard_choice").prop('readonly', true);
						$("#choice_product_url").prop('readonly', true);
						$("#choice_title").prop('readonly', true);
					}
					if ($('#choice_builder_cost').val() == 'No') 
					{
						$("#choice_builder_cost_price").prop('readonly', true);
					}
				}
				//----end of checking role access
            } else {
                if (response.message) {
                    failure_msg = response.message;
                } else {
                    // alert('Id was not properly passed');
					$('#alertModal').modal('show');
					$('.alert_modal_txt').text('Id was not properly passed');
                }
            }
            return false;
        }
    });
	//uploaded file list function calls 
	if(file_upload_list_page_user != 100)
	{
		uploaded_choice_doc_content_form();
	}
}

//Status field update code
function update_status(status) {
    var ub_selection_choice_id = $("#ub_selection_choice_id").val();
    var ub_selection_id = $("#ub_selection_id").val();
    var ub_selection_name = $("#title").val();
    var choice_owner_price_tbd = $("#choice_owner_price_tbd").val();
	var condition_check = 'condition_check'; 
    if (ub_selection_choice_id > 0) {
        // var id = confirm("Are you sure you want to Change the Status");
		/* var conf = $('#confirmModalapprove').modal('show');
			$('#approve_confirm').click(function(){
			var conf = true;
			if(conf == true){ */
            var encoded_delete_roles = Base64.encode('selections/update_choice_status/');
            var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
            $.ajax({
                type: 'POST',
                url: base_url + encoded_delete_val,
                dataType: 'json',
                data: {
                    'ub_selection_choice_id': ub_selection_choice_id,
                    'status': status,
                    'ub_selection_id': ub_selection_id,
                    'ub_selection_name': ub_selection_name,
                    'condition_check': condition_check,
                    'owner_price': choice_owner_price_tbd
                },
                success: function(response) {
                    if (response.status == true) {
						success_box();
						$(".alerts").html('Status was modified successfully');	
						// $('#alertModal').modal('show');
						// $('.alert_modal_txt').text('Status was modified successfully');
                        location.reload(true);
                    }
                }
            });
			/* }
			}); */
    } else {
        // alert('You can only change the status in edit page');
		error_box();
		$(".alerts").html('You can only change the status in edit page');	
		// $('#alertModal').modal('show');
		// $('.alert_modal_txt').text('You can only change the status in edit page');
        return false;
    }
}

//Status field update code for selection
function update_selection_status(status) {
    var ub_selection_id = $("#ub_selection_id").val();
    if (ub_selection_id > 0) {
        // var id = confirm("Are you sure you want to Change the Selection Status");
        // if (id == true) {
		var conf = $('#confirmModalapprove').modal('show');
		$('#approve_confirm').click(function(){
		var conf = true;
		if(conf == true){	
            var encoded_delete_roles = Base64.encode('selections/update_selection_status/');
            var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
            $.ajax({
                type: 'POST',
                url: base_url + encoded_delete_val,
                dataType: 'json',
                data: {
                    'ub_selection_id': ub_selection_id,
                    'status': status
                },
                success: function(response) {
                    if (response.status == true) {
						$('#confirmModalapprove').modal('hide');
						success_box();
						$(".alerts").html('Status was modified successfully');	
						// $('#alertModal').modal('show');
						// $('.alert_modal_txt').text('Status was modified successfully');
                        location.reload(true);
                    }
                }
            });
        }
		});
    } else {
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('Status was not set');
        return false;
    }
}

function add_new_selections_form(){	
	var addnewselectionsform = $('#add_new_selections').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_selection_new_back, #add_selection_new_button, #add_selection_new_back_to_list, #selectioninfotab ul li a'			
        },
        fields: {
            'title': {
                validators: {
                    notEmpty: {
                        message: 'The title cannot be empty'
                    }
                }
            }			
        }	
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			 add_selections_form();
			e.preventDefault();			 
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
function choice_val_form(){
	
	$('#choice_form').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#add_new_choices'			
        },
        fields: {
            'choice_title': {
                validators: {
                    notEmpty: {
                        message: 'The title cannot be empty'
                    }
                }
            }
        }	/* added closing brace */
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {		  
			add_new_choices();
			e.preventDefault();			 
	  });
}
/* File upload code starts here */
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
    
    var temp_id = selection_dir_id;    

    //alert(temp_id); 
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('selections/upload/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#add_new_selections').fileupload({
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
                // alert(name + ' - Already exixt.' );
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text(name + ' - Already exixt.');
                return false;
            }
            // code to validate the directory name end.

            var encoded_string = Base64.encode('selections/allowed_extension/');
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
                        // alert("Not an accepted file type.");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(ext +'is not an accepted file type.');
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        // alert(name + ' - Filesize is too big.' );
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(name + ' - Filesize is too big.');
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        // alert(uploadErrors.join("\n"));
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
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');			
        },
        success: function (data) {			
			setTimeout(checkbox, 1*200);			
			//alert(JSON.stringify(response));
			$('.uni_wrapper').removeClass('loadingDiv');
		}
    });
	// Load existing files:
	$.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: $('#add_new_selections').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#add_new_selections')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
	}
});

$(function () {
    if(file_upload_list_page_user == 100)
    {
    'use strict';
    
    var temp_id = choice_dir_id;    

    //alert(temp_id); 
    // Initialize the jQuery File Upload widget:
    var encoded_string = Base64.encode('selections/upload/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $('#choice_form').fileupload({
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
                // alert(name + ' - Already exixt.' );
				$('#alertModal').modal('show');
				$('.alert_modal_txt').text(name + ' - Already exixt.' );
                return false;
            }
            // code to validate the directory name end.

            var encoded_string = Base64.encode('selections/allowed_extension/');
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
                        // alert("Not an accepted file type.");
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(ext +'is not an accepted file type.');
                        return false;
                    }
                    if(size > (ALLOWED_FILE_SIZE)) {//2 MB
                        // alert(name + ' - Filesize is too big.' );
						$('#alertModal').modal('show');
						$('.alert_modal_txt').text(name + ' - Filesize is too big.');
                        return false;
                    }
                    if(uploadErrors.length > 0) {
                        // alert(uploadErrors.join("\n"));
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
        url: $('#choice_form').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#choice_form')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
    }
});

/* File upload code ends here */


function selection_file_upload(insert_id)
{
	var temp_directory_id = selection_dir_id;
	var folderid = selection_folder_id;
	var projectid = $("#project").val();
	var moduleid = insert_id;
	var encoded_string = Base64.encode('selections/get_temp_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	var response = $.ajax({
		url: base_url + encoded_val,
		//dataType: "json",
		type: "post",
		data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid + '&moduleid='+moduleid+ '&projectid='+projectid,			
		beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');             
        },  
        success: function(response) {		
			//if(response.status == true)
			//{	
				//window.location.href = role_index_url;
			//}
		}
	});
	return  response;
}

function choice_file_upload(insert_id)
{
    var temp_directory_id = choice_dir_id;
    var folderid = choice_folder_id;
    var projectid = $("#project").val();
    var module_name = 'choice';
    var moduleid = insert_id;

    var encoded_string = Base64.encode('selections/get_temp_filename/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var response = $.ajax({
        url: base_url + encoded_val,
        //dataType: "json",
        type: "post",
        data: 'temp_directory_id='+ temp_directory_id + '&folderid='+folderid + '&moduleid='+moduleid+ '&projectid='+projectid + '&module_name='+module_name,         
        beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');             
        },  
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
    $(".choice_upload_alerts").html('');
}

function copy_selection_file_to_temp(selection_dir_id)
{
	var file_path = $('#temp_file_path').val();
	var temp_id = selection_dir_id;
	var encoded_string = Base64.encode('selections/copy_file_to_temp/');
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
	var temp_id = selection_dir_id;
	$.ajax({
		// Uncomment the following to send cross-domain cookies:
		//xhrFields: {withCredentials: true},
		url: $('#add_new_selections').fileupload('option', 'url'),
		dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
		context: $('#add_new_selections')[0]
	}).always(function () {
		$(this).removeClass('fileupload-processing');
	}).done(function (result) {
		// alert(result.toSource());
		$("#add_new_selections").find(".files").empty();
		$(this).fileupload('option', 'done')
			.call(this, $.Event('done'), {result: result});
	});
}


//file upload list
$(function() {
	if(file_upload_list_page_user != 100)
	{
    uploaded_doc_content_form();
	}
});
function uploaded_doc_content_form() {
	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	var folderid = selection_folder_id;
	var moduleid = $("#ub_selection_id").val();
	var projectid = $("#project").val();
	var encoded_string = Base64.encode('selections/get_uploaded_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
						'tableName': $('.selection_file #uploaded_doc_content'),
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
function copy_choice_file_to_temp(choice_dir_id)
{
    var file_path = $('#temp_file_path').val();
    var temp_id = choice_dir_id;
    var encoded_string = Base64.encode('selections/copy_file_to_temp/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);   
	if(file_path == '')
	{
		$(".modal-body .upload_error-message .choice_upload_alerts").removeClass('alert-success');
		$(".modal-body .upload_error-message .choice_upload_alerts").addClass('alert-danger');
		$(".modal-body .upload_error-message").show();
		$(".choice_upload_alerts").html('Please Select a File');
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
            $(".modal-body .choice_upload_error-message .choice_upload_alerts").removeClass('alert-danger');
            $(".modal-body .choice_upload_error-message .choice_upload_alerts").addClass('alert-success');
            $(".modal-body .choice_upload_error-message").show();
            if(response.message)
            {
                success_msg = response.message;
            }
            $(".choice_upload_alerts").html(success_msg);
            relode_choice_temp();
          }
        }
    }); 
	}
}

function relode_choice_temp()
{

    var temp_id = choice_dir_id;
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#choice_form').fileupload('option', 'url'),
        dataType: 'json',
        data: 'temp_directory_id=' + temp_id,
        context: $('#choice_form')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        // alert(result.toSource());
        $("#choice_form").find(".files").empty();
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
}

//file upload list
$(function() {
	$(document).on( 'shown.bs.tab', 'a[href="#files-photos"]', function (){
	if(file_upload_list_page_user != 100)
	{
		uploaded_choice_doc_content_form();
	}
	});
	var url = window.location.href;
    var hash = url.substring(url.indexOf("#"));	
    if (file_upload_list_page_user != 100 && hash == "#files-photos")
    {
        uploaded_choice_doc_content_form();
    }
}); 
function uploaded_choice_doc_content_form() {
	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	var folderid = choice_folder_id;
	var moduleid = $("#ub_selection_choice_id").val();
	var projectid = $("#project").val();
	var modulename = 'choice';
	var encoded_string = Base64.encode('selections/get_uploaded_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
						'tableName': $('.choice #uploaded_doc_content'),
						'this_table' : {'table_name':'uploaded_doc_content'},
						'ajax_encoded_url':encoded_val,
						//'parent_id' : '{"folderid":"'+folderid+'"}',
						'folder_id' : 'folder_id',
						'post_data':'{"folderid":"'+folderid+'","moduleid":"'+moduleid+'","projectid":"'+projectid+'","modulename":"'+modulename+'"}',
						'display_columns' : [{"data": "file_name"},{"data": "date", "bSortable": false},{"data": "date", "bSortable": false}],
						'default_order_by': [[0, 'desc']]
					};
	// Populate data table
	ubdatatable_docs(dbobject);
}
$(function(){

	  
	 if($('#toggle-event').attr('checked'))
	  {
		$('.link-to').show();
		$('.due-date').hide();
	  }
     
  });
  
 /* Below code was added by chandru */
 
 $('#choice_folder_load').click(function(){
	if(file_upload_list_page_user == 100)
	{
	 relode_choice_temp();
	} 
 });