//checking project status -- code added by satheesh kumar
$(function() {
	var ub_selection_id = $('#ub_selection_id').val();   
	if(ub_selection_id == '' || ub_selection_id == 0)
	{
		check_project_status('template/selections/index/');
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

$(function() {
    $('.link-to').hide();
    $('#toggle-event').change(function() {
        var task = $(this).prop('checked');
        if (task == true) {
            $('.link-to').show();
            $('.due-date').hide();
        } else if (task == false) {
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
        $('.selection_choice').toggleClass('hide');
    });
});
$(function() {
    //selection_choice();
});
/* selection choice file upload hidden value */
$('#add_choice').click(function() {
		$('.choice #folder_id').val(choice_folder_id);
        $('.choice #temp_directory_id').val(choice_dir_id);
    });
$('#selection_file_upload').click(function() 
{
    $('.selection_file #folder_id').val(selection_folder_id);
    $('.selection_file #temp_directory_id').val(selection_dir_id);
});

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
                alert("Added successfully");
                $("#TypeAddModal").modal('hide');
            } else {
                alert("Insertion failed");
            }
        }
    });
	}
       else
       {
         alert('Please Enter a category name');
       }
});
$('.TypeEditModal').click(function() {
    var n = $('#category').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
	if($('#selected').val() == '')
	{
		alert('Please select');
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
                        alert("Deleted successfully");
                        $("#TypeEditModal").modal('hide');
                    } else {
                        alert("Deletion failed: " + response.message);
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
                alert("Added successfully");
                $("#TypeAddModals").modal('hide');
            } else {
                alert("Insertion failed");
            }
        }
    });
	}
       else
       {
         alert('Please Enter a Location name');
       }
});
$('.TypeEditModals').click(function() {
    var n = $('#locations').next().find('.dropdown-menu.inner.selectpicker li.selected').length;
	if($('#selected').val() == '')
	{
		alert('Please select');
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
                        alert("Deleted successfully");
                        $("#TypeEditModals").modal('hide');
                    } else {
                        alert("Deletion failed: " + response.message);
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
/* /Drop Down Add / Edit / Delete */

//Inser code starts from here

$(function() {    
    $('#selectioninfotab ul li a').click(function(e) {
        $("#save_type").val('save_and_stay');
		var title = $('#title').val();		
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
         var encoded_home_string = Base64.encode('template/selections/index/');
         var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);
         window.location.href = encoded_home_val; 
         e.preventDefault();      
    }); 
});
//Cancel button code
function add_new_choices_cancel() {
        var id = confirm("Are you sure you want to Cancel");
        if (id == true) {
            location.reload();
        }
    }
    //CHOICE Add
function add_new_choices() {
	$("#add_new_choices").hide();
	$("#add_new_choices2").hide();
    var ub_selection_id = $('#ub_selection_id').val();
    var template_id = $('#template_id').val();
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
    // var choice_vendor = $('#choice_vendor').val();
    // var choice_installer = $('#choice_installer').val();
    var choice_description = $('#choice_description').val();
	
		// alert(ub_selection_choice_id);return false;
    var encoded_url = Base64.encode('template/selections/save_selection_choices/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);

    var data = 'choice_title=' + choice_title + '&choice_standard_choice=' + choice_standard_choice + '&choice_product_url=' + choice_product_url + '&choice_owner_price=' + choice_owner_price + '&choice_owner_price_tbd=' + choice_owner_price_tbd + '&choice_builder_cost_price=' + choice_builder_cost_price + '&choice_builder_cost=' + choice_builder_cost + '&choice_sub_pricing_comments=' + choice_sub_pricing_comments + '&choice_description=' + choice_description + '&ub_selection_id=' + ub_selection_id + '&ub_selection_choice_id=' + ub_selection_choice_id + '&owner_id=' + owner_id+ '&template_id=' + template_id;
    //alert(data);return false;
    $.ajax({
        url: base_url + ajax_encoded_url,
        dataType: "json",
        type: "post",
        data: data,
        success: function(response) {
            if (response.status == true) {
                location.reload();
            } 
			else 
			{
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
    var encoded_string = Base64.encode('template/selections/save_selection/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);

    var encoded_home_string = Base64.encode('template/selections/index/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);

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
            if (response.status == true) 
			{
               
				 $('.uni_wrapper').removeClass('loadingDiv');
                if ($("#save_type").val() == 'save_and_new') {
                    window.location.href = encoded_val;
                } else if ($("#save_type").val() == 'save_and_back') {
                    window.location.href = encoded_home_val;
                } else if ($("#save_type").val() == 'save_and_stay') {
                    if (response.message == 'Data inserted successfully') {
                        var encoded_string_edit_log = Base64.encode('template/selections/save_selection/' + response.insert_id);
                        var encoded_edit_val = encoded_string_edit_log.strtr(encode_chars_obj);
                        window.location.href = encoded_edit_val;
                    }
                }
                if (response.message) {
                    success_msg = response.message;
                }
                $(".alerts").html(success_msg);
				
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
    });
    $(document).on('ifUnchecked','#owner-child', function(event) {
        $("#owner_notify").val("No");
    });
    $(document).on('ifChecked','#sub-child', function(event) {
        $("#sub_notify").val("Yes");
    });
    $(document).on('ifUnchecked','#sub-child', function(event) {
        $("#sub_notify").val("No");
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
    Delete Comment End
    */
/* Delete selection code added by chandru 14-07-2015 */
function delete_selection(ub_selection_id){
    if(ub_selection_id > 0)
    {
    var encoded_delete_roles = Base64.encode('template/selections/delete_selection_data/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    var index_string = Base64.encode('template/selections/index/');
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
        $(".alerts").html("selection id is not set");      
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
    var encoded_url = Base64.encode('template/selections/get_selection_choices/');
    var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
    // Data table Object
    //alert(123);
    var dbobject = {
        'tableName': $('#selection_choices'),
        'this_table': {
            'table_name': 'selection_choices'
        },
        'ajax_encoded_url': ajax_encoded_url,
        'id': 'ub_template_selection_choice_id',
        'name': 'choice_title',
        'post_data': '{"ub_selection_choice_ids":"' + ub_selection_choice_ids + '"}',
        'delete_data': {
            'index': 0
        },
        'edit_data': {
            'index': 1,
            'url': 'template/selections/save_selection_choices/'
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
            "data": "creator"
        }, {
            "data": "status"
        }, {
            "data": "owner_price"
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
    // alert(ub_selection_choice_id);
    var encoded_delete_roles = Base64.encode('template/selections/save_selection_choices/');
    var encoded_delete_val = encoded_delete_roles.strtr(encode_chars_obj);
    $.ajax({
        type: 'POST',
        url: base_url + encoded_delete_val,
        dataType: 'json',
        data: "ub_selection_choice_id=" + ub_selection_choice_id,
        success: function(response) {
            if (response.status != "") {
                $('.choice #folder_id').val(choice_folder_id);
                $('.choice #temp_directory_id').val(choice_dir_id);
                $('#add_choice').toggleClass('hide');
                $('.choice-con').toggle();
                $('.selection_choice').toggleClass('hide');
                //$("#selection_choice_block").load(location.href + " #selection_choice_block");
                $('#ub_selection_choice_id').val(response['ub_template_selection_choice_id']);
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
                    $('#choice_standard_choice').closest('.icheckbox_square-red').addClass('checked');
                }
                $('#choice_owner_price').val(response['owner_price_tbd']);
                if ($('#choice_owner_price').val() == 'Yes') {
                    $('#choice_owner_price').closest('.icheckbox_square-red').addClass('checked');
                }
                //alert($('#choice_owner_price').val());
                $('#choice_builder_cost').val(response['subcontractor_price_tbd']);
                if ($('#choice_builder_cost').val() == 'Yes') {
                    $('#choice_builder_cost').closest('.icheckbox_square-red').addClass('checked');
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
					
				//--- checking role access // by satheesh kumar 
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
						$("#choice_standard_choice").prop('readonly', true);
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
                    alert('Id was not properly passed');
                }
            }
            return false;
        }
    });
}

//Status field update code
function update_status(status) {
    var ub_selection_choice_id = $("#ub_selection_choice_id").val();
    var ub_selection_id = $("#ub_selection_id").val();
    var ub_selection_name = $("#title").val();
	var condition_check = 'condition_check'; 
    if (ub_selection_choice_id > 0) {
        var id = confirm("Are you sure you want to Change the Status");
        if (id == true) {
            var encoded_delete_roles = Base64.encode('template/selections/update_choice_status/');
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
                    'condition_check': condition_check
                },
                success: function(response) {
                    if (response.status == true) {
						
                        alert('Status was modified successfully');
                        location.reload();
                    }
                }
            });
        }
    } else {
        alert('You can only change the status in edit page');
        return false;
    }
}

//Status field update code for selection
function update_selection_status(status) {
    var ub_selection_id = $("#ub_selection_id").val();
    if (ub_selection_id > 0) {
        var id = confirm("Are you sure you want to Change the Selection Status");
        if (id == true) {
            var encoded_delete_roles = Base64.encode('template/selections/update_selection_status/');
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
                        alert('Status was modified successfully');
                        location.reload();
                    }
                }
            });
        }
    } else {
        alert('Status was not set');
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