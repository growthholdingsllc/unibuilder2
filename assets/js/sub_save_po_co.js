//checking project status -- code added by satheesh kumar
$(function() {
	var ub_po_co_id = $('#ub_po_co_id').val();   
	if(ub_po_co_id == '' || ub_po_co_id == 0)
	{
		if(project_status == 'Closed' || project_status == 'Disabled')
		{	
			url = 'budget/subcontractor_po';
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
$(document).on( 'shown.bs.tab', 'a[href="#payments"]', function (){        
        po_payment_list_view();
    });
$(document).on( 'shown.bs.tab', 'a[href="#general"]', function (){        
        po_cost_list();
    });
$(document).on( 'shown.bs.tab', 'a[href="#scope_work"]', function (){        
        uploaded_doc_content_form();
    });
    var url = window.location.href;
    var hash = url.substring(url.indexOf("#"));
        
        if (hash == "#payments")
        {
            po_payment_list_view();
        }
        if (hash == "#general")
        {
            po_cost_list();
        }
        if (hash == "#scope_work")
        {
            uploaded_doc_content_form();
        }
        
});
$('#budget_po_tab a').click(function (e) {
    var current_tab = this.id;
    if(current_tab == "payment_tab")
    {
        po_payment_list_view();
    }
});
$(function() {
    po_cost_list();
	//create_new_payment();
});
$(document).ready(function() {
 
 $(document).on('keyup','.requested_amount', function() {
        var $inpt = $(this);
        $inpt.val( $inpt.val().replace(/[^0-9]/g, function(){ return ''; }) );
 });
});
function po_cost_list() {
        var ub_po_co_id = $('#ub_po_co_id').val();
        var encoded_url = Base64.encode('budget/po_cost_list/');
        var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        var dbobject = {
                            'tableName': $('#po_cost_list'),
                            'ajax_encoded_url':ajax_encoded_url,
                            'id':'cost_code_id',
                            'name' : 'cost_code_id',
                            'this_table' : {'table_name':'po_cost_list'},
                            'post_data':'{"po_co_id":"'+ub_po_co_id+'"}',
                            'delete_data':{},
                            'edit_data':{},
                            'display_columns' : [{"data": "cost_variance_code"},{"data": "unit_cost","render": $.fn.dataTable.render.number( ',', '.', 2)},{"data": "quantity"},{"data": "total","render": $.fn.dataTable.render.number( ',', '.', 2)}],
                            'default_order_by': [[1, 'asc']]
                        };  
        // Populate data table
        ubdatatable(dbobject);
}
/*$(function() {     
	po_scope_list_view();
    $(document).on('click', '#make_payment', function(e){
		var payment_title = $('#payment_title').val();
		if(payment_title == ''){
			error_box();
			$('.error-message .alerts').text('Please fill the mandatory fields');
		}else{
        make_payment();
        e.preventDefault();
		}
    });
});

function po_scope_list_view() {
	$('#po_scope_list').dataTable({						
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5, 
					
		sAjaxSource: base_url + 'assets/js/json_po_scope_list.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],			
		"columns":[            
		{ "sTitle":"File Name", "data": "file_name"},
		{ "sTitle":"Size", "data": "size"}
		
		
	],
	"order": [[1, 'asc']]

	});
}*/
$(function() {
    if (typeof list_page != 'undefined') {
        po_payment_list_view();
    }
});
function po_payment_list_view() {
        var ub_po_co_id = $('#ub_po_co_id').val();
        var encoded_url = Base64.encode('budget/get_po_co_payment/');
        var ajax_encoded_url = encoded_url.strtr(encode_chars_obj);
        var dbobject = {
                            'tableName': $('#po_payment_list'),
                            'ajax_encoded_url':ajax_encoded_url,
                            'id':'ub_po_co_payment_request_id',
                            'name' : 'payment_title',
                            'this_table' : {'table_name':'po_payment_list'},
                            'post_data':'{"po_co_id":"'+ub_po_co_id+'"}',
                            'delete_data':{},
                            'payment_request_status' : 'payment_request_status',
                            'modified_on':{'index':3},
                            'pay_to':{'index':4}, 
                            'total_paid_amount':'total_paid_amount',  
                            'edit_data':{'index':0, 'url':'#'},
                            'display_columns' : [{"data": "payment_title"},{"data": "total_paid_amount","render": $.fn.dataTable.render.number( ',', '.', 2)},{"data": "payment_request_status"},{"data": "modified_on"},{"data": "pay_to"}],
                            'default_order_by': [[1, 'desc']]
                        };  
        // Populate data table
        ubdatatable(dbobject);
}

$('#po_co_accept').click(function(e) {
        $("#save_type").val('save_and_release');
        $("#status").val('Accepted');
       
            change_po_co_status();
            e.preventDefault();
        
    });

    $('#po_co_reject').click(function(e) {
        $("#save_type").val('save_and_release');
        $("#status").val('Rejected');
       
            change_po_co_status();
            e.preventDefault();
         
    });

    $('#po_co_work_completed').click(function(e) {
        $("#save_type").val('save_and_release');
        $("#status").val('Work Completed');
       
            change_po_co_status();
            e.preventDefault();
         
    });

     $('#back').click(function(e) {
       
       var encoded_home_string = Base64.encode('budget/subcontractor_po');
       var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 
       window.location.href = encoded_home_val;
       e.preventDefault();
         
    });
    


function change_po_co_status()
{
    var encoded_string = Base64.encode('budget/change_po_co_status/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);

    var type = $('#type').val();
    var ub_po_co_id = $('#ub_po_co_id').val();
    var encoded_home_string = Base64.encode('budget/sub_save_po_co/'+type +'/'+ ub_po_co_id);
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    var ajaxData  = $("#add_new_budget_po").serialize();     
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
        window.location.href = encoded_home_val;
      }
   }); 
}

function get_payment()
{
    $('.grid_settings').hide();
	$('#ub_po_co_payment_id').val(0);
    $('#status_vals').text('');
	var encoded_string = Base64.encode('budget/get_po_co_payment_transactions/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    //dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
        // alert(response);
		$(".po_co_transaction").html(response);
        var sum = 0;
        $(".out").each(function(){
            sum += +$(this).val();
        });

        setTimeout(function(){
        if(sum == 0)
        {
            $('.make-payments').hide();
        }
        }, 500);
		$('#ub_po_co_payment_id').val(0);
		$('#payment_title').val('');
		$('#comments').val('');
		$('.amount').hide();
        $('#sta').show();
		$('.void-payment').hide();
        $('#payment_request_status').closest('.icheckbox_square-red').removeClass('checked');   
        $('#payment_request_status').removeAttr("checked", "checked");
        $('#payment_title').attr('readonly', false);
        $('#comments').attr('readonly', false);
        $('.status_block').hide();
        var title = $('#title').val();
        $('#po_titles').html(title);
	    get_files();
      }
   }); 
   
}
/*Document Upload code Start Here*/

function get_files()
{
    //alert('hi');
    $('#ub_po_co_payment_id').val(0);
    var encoded_string = Base64.encode('budget/get_setup_budget_documents/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    //dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
        // alert(response);
        $(".file_upload").html(response);
    
      }
   }); 
}

function get_files_list()
{
    //alert('hi');
    var encoded_string = Base64.encode('budget/get_po_co_payment_request_documents/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    //dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
        if(response.status == false){
        $(".file_upload").html('');
        }
        else
        {
          $(".file_upload").html(response);
        }
    
      }
   }); 
}
// alert message code added by  satheesh kumar
 $(document).on('keyup','#payment_title', function() {
        $('.grid_settings').hide();
 });
 $(document).on('keyup','.requested_amount', function() {
        $('.grid_settings').hide();
 });
/*Document Upload code End Here*/
function make_payment_request()
{
	var encoded_string = Base64.encode('budget/save_po_co_payment/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);    
    //var ajaxData  = $("#add_new_budget_po").serialize(); 
    var payment_title = $('#payment_title').val();
    var sum = 0;
    $(".requested_amount").each(function(){
        sum += +$(this).val();
    });
    if(payment_title == '')
    {
        //alert('Please Enter The Title');
        /*$('#alertModal').modal('show');
        $('.alert_modal_txt').text('Please Enter The Title');*/
        grid_error_box();
        $('.grid_settings .error-message .alerts').text('Please Enter The Title');
    }
    else if(sum == 0)
    {
        //alert('Please Enter atleat one requested amount');
        /*$('#alertModal').modal('show');
        $('.alert_modal_txt').text('Please Enter atleast one requested amount');*/
        grid_error_box();
        $('.grid_settings .error-message .alerts').text('Please Enter atleast one requested amount');
    }
    else
    {
    var formData = new FormData($('#add_new_budget_po')[0]);     
    $.ajax({
    url: base_url + encoded_val,
    dataType: "json",
    type: "post",
    contentType: false,
    processData: false,
    data: formData,
    beforeSend: function() {
            $('.uni_wrapper').addClass('loadingDiv');            
        },                          
    success: function(response) {
        $('.uni_wrapper').removeClass('loadingDiv');
		get_payment();
		po_payment_list_view();
		$('#payment_title').val('');
		$('#comments').val('');
		$('#create_payment').hide();
	
      }
   }); 
  }
}

function open_payment_modal(id)
{
    //alert(id);
    $('.grid_settings').hide();
    $('#ub_po_co_payment_id').val(id);
    $('.status_block').show();
    //$('#ub_po_co_payment_id').val(id);
    var encoded_string = Base64.encode('budget/get_payment_details_transaction/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    var ajaxData  = $("#add_new_budget_po").serialize();     
    $.ajax({
    url: base_url + encoded_val,
    //dataType: "json",
    type: "post",
    data: ajaxData,         
    success: function(response) {
        // alert(response);
        $(".po_co_transaction").html(response);
        $('#ub_po_co_payment_id').val(id);
        $('#payment_title').attr('readonly', true);
        $('#comments').attr('readonly', true);
        var title = $('#title').val();
        $('#po_titles').html(title);
        get_payment_details(id);
        get_files_list();
    
      }
   }); 
}

function get_payment_details(id)
{
  //alert(id);
  $('#ub_po_co_payment_id').val(id);
  var ub_po_co_payment_id = $('#ub_po_co_payment_id').val();

  var encoded_string = Base64.encode('budget/get_po_co_payment_details/');
  var encoded_val = encoded_string.strtr(encode_chars_obj);
  
    var ajaxData  = "ub_po_co_payment_id="+ub_po_co_payment_id;
        $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: ajaxData,         
        success: function(response) {           
            if(response.status == true)
            {   
                $('#payment_title').val(response.payment_title);
                $('#comments').val(response.comments);
                $('#status_val').text(response.payment_status);
                $('.requested_amount').attr('readonly', true);
                if(response.payment_status != 'Payment request created')
                {
                 $('#payment_request_status').closest('.icheckbox_square-red').addClass('checked'); 
                 $('#sta').show();  
                 $('#payment_request_status').attr("checked", "checked");
                
                }
                if(response.payment_status == 'Approved' || response.payment_status == "Partial payment done" || response.payment_status == "Paid" || response.payment_status == "made void" || response.payment_status == "Ready for Payment" || response.payment_status == "Rejected")
                {
                 $('.make-payments').hide();
                 $('#sta').hide();
                 $('.requested_amount').attr('readonly', true);         
                 /*$('#visibile_to_subs').closest('.icheckbox_square-red').removeClass('checked');   
                 $('#visibile_to_subs').removeAttr("checked", "checked");*/
                }
            }
          }
    }); 
}

function delete_pic(file_id)
{
    var fileid = file_id;
    var encoded_string = Base64.encode('budget/delete_file/');
    var encoded_val = encoded_string.strtr(encode_chars_obj);
    $.ajax({
        url: base_url + encoded_val,
        dataType: "json",
        type: "post",
        data: 'fileid='+fileid,         
        success: function(response) {  
        }
    });
}

//file upload list
$(function() {
    uploaded_doc_content_form();
});
function uploaded_doc_content_form() {
	var fetch_type = typeof calltype !== 'undefined' ? calltype : 'list';
	var folderid = $("#folder_id").val();
	var moduleid = $("#ub_po_co_id").val();
	var projectid = $("#project_id").val();
	var modulename = 'poco';
	var encoded_string = Base64.encode('budget/get_uploaded_filename/');
	var encoded_val = encoded_string.strtr(encode_chars_obj);
	// Data table Object	
	var dbobject = {
						'tableName': $('#uploaded_doc_content'),
						'this_table' : {'table_name':'uploaded_doc_content'},
						'ajax_encoded_url':encoded_val,
						//'parent_id' : '{"folderid":"'+folderid+'"}',
						'folder_id' : 'folder_id',
						'post_data':'{"folderid":"'+folderid+'","moduleid":"'+moduleid+'","projectid":"'+projectid+'","modulename":"'+modulename+'"}',
						'display_columns' : [{"data": "file_name", "bSortable": false},{"data": "date", "bSortable": false},{"data": "date", "bSortable": false}],
						'default_order_by': [[0, 'desc']]
					};
	// Populate data table
	ubdatatable_docs(dbobject);
}
$(document).ready(function () {
    $(document).on('change blur','#po_vocher_payment_lists input[name="requested_amount[]"]', function () {     
        $this = $(this).parents('tr');      
        $this.find('input[name="requested_amount[]"]').each(function() {
            var value = parseInt(this.value);
            var requested_amt = $this.find('input[name="requested_amount[]"]').val();
            var payment_pending = $this.find('input[name="payment-pending[]"]').val();
            var out_standing = $this.find('input[name="out_standing[]"]').val();
            var payment_list_amount = out_standing - payment_pending;
            //var payment_list_amount = requested_amt - paid_amt;
            if(payment_list_amount >= value){              
                $(this).parent().removeClass('has-error');
                $(this).parent().addClass('has-success');               
                $(this).parent().find('.mes').html('');
            }           
            else{               
                $(this).parent().addClass('has-error');
                $(this).parent().removeClass('has-success');
                $(this).parent().find('.mes').html('<p class="text-danger">The Request amount should not be greater than the difference between Out standing and Payment request pending</p>');
                
            }
            if($('#po_vocher_payment_lists').find('.form-group').hasClass("has-error")){                
                $('.make-payments').attr('disabled','disabled');
            }
            else{               
                $('.make-payments').removeAttr('disabled','disabled');
            }       
        });     
        return true;
    });
});
/*$(function(){
    $(document).on('blur click', '#po_vocher_payment_lists input[name="requested_amount[]"], #make_payment', function() {
    var $cur = $(this).closest('tr');
    var input_out_standing = Number($cur.find('input[name="out_standing[]"]').val()) || 0;
    var input_amount = Number($cur.find('input[name="requested_amount[]"]').val()) || 0;          
    if(input_amount > input_out_standing){      
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-success');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-error');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().find('.mes').html('');
        $(this).parent().addClass('has-error');
        $(this).parent().find('.mes').html('<p class="text-danger">Less than Out Standing</p>');
        $('.make-payment').attr('disabled','disabled');
    }
    else if(isNaN(input_amount)){
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-success');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-error');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().find('.mes').html('');
        $(this).parent().addClass('has-error');
        $(this).parent().find('.mes').html('<p class="text-danger">not a number</p>');
        $('.make-payment').attr('disabled','disabled');
    }
    else if(input_amount ==''){
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-success');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-error');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().find('.mes').html('');
        $(this).parent().addClass('has-error');
        $(this).parent().find('.mes').html('<p class="text-danger">cannot be empty</p>');
        $('.make-payment').attr('disabled','disabled');
    }
    else if(input_amount == input_out_standing){        
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-success');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-error');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().find('.mes').html('');
        $(this).parent().addClass('has-success');
        $(this).parent().find('.mes').html('');
        $('.make-payment').removeAttr('disabled');
    }
    else{       
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-success');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().removeClass('has-error');
        $('#po_vocher_payment_lists input[name="requested_amount[]"]').parent().find('.mes').html('');
        $(this).parent().addClass('has-success');
        $(this).parent().find('.mes').html('');
        $('.make-payment').removeAttr('disabled');
    }       
    });
});*/

/*function create_new_payment(){	
	$('#add_new_budget_po').formValidation({
			framework: 'bootstrap',
			excluded: ':disabled',        
		 button: {
            selector: '#make_payment'			
        },
        fields: {
            'payment_title': {
                validators: {
                    notEmpty: {
                        message: 'The payment title cannot be empty'
                    }
                }
            },
			'requested_amount[]': {
                validators: {
					notEmpty: {
						 message: 'The amount is required'
					}
                }
            }
        }	
		
    }).on('err.field.fv', function(e, data) {
             data.fv.disableSubmitButtons(false);
      }).on('success.field.fv', function(e, data) {            
             data.fv.disableSubmitButtons(false);            
      }).on('success.form.fv', function(e) {
			make_payment();		  
			e.preventDefault();			 
	  });
}*/