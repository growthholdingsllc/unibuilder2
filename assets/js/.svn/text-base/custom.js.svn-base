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
$(window).load(function() {   
   $('.uni_wrapper').removeClass('loadingDiv');
	setTimeout(side_tab, 1000);
	setTimeout(checkbox, 10000);	   
});
$(window).load(function(){     
	
    var navbox = $('.nav-tabs');
    navbox.on('click', 'a', function (e) {
      var $this = $(this);
      e.preventDefault();
      window.location.hash = $this.attr('href');
      $this.tab('show');
    });	
    function refreshHash() {
      navbox.find('a[href="'+window.location.hash+'"]').tab('show');
    }
    $(window).bind('hashchange', refreshHash);
    if(window.location.hash){
      refreshHash();
    }
});
function side_tab(){
	 $('.side-menu').show();
}
/* Home Panel */
$(function() {
setTimeout(checkbox, 3000);
$(document).on('click', '.delete_btn' ,function(){
	$(this).parent().parent().parent().remove();
});
	
// if( typeof(CKEDITOR) !== "undefined" ){
	// alert(1);
// }	
    $('#filter > h4 > a > .glyphicon').addClass('glyphicon-chevron-up');
    $('#filter > h4 > a').click(function() {
        $('#filter > h4 > a > .glyphicon').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    });
});
/* /Home Panel */
/* Menu */
$(function() {	
    alignMenu();
    $(window).resize(function() {
        $("#horizontal").append($("#horizontal li.hideshow ul").html());
        $("#horizontal li.hideshow").remove();      		
		alignMenu();
		$('.last_drop_down').removeAttr("style");
    });

    function alignMenu() {
        var w = 0;
        var mw = $("#horizontal").width() - 150;
        var i = -1;
        var menuhtml = '';
        jQuery.each($("#horizontal").children(), function() {
            i++;
            w += $(this).outerWidth(true);
            if (mw < w) {
                menuhtml += $('<div>').append($(this).clone()).html();
                $(this).remove();
            }
        });
        $("#horizontal").append(
            '<li  style="position:relative;" href="#" class="hideshow dropdown">' + '<a href="#">more ' + '<span style="font-size:12px">&#8595;</span>' + '</a><ul class="dropdown-menu">' + menuhtml + '</ul></li>');
        $("#horizontal li.hideshow ul").css("top",
            $("#horizontal li.hideshow").outerHeight(true) + "px");
        $("#horizontal li.hideshow").click(function() {
            $(this).children("ul").toggle();
            $(this).children("ul").toggleClass('show')
        });
        if (menuhtml == '') {
            $("#horizontal li.hideshow").hide();
        } else {
            $("#horizontal li.hideshow").show();
        }
		$("#horizontal li.hideshow ul li.dropdown").click(function() {
		   $(this).parent().toggleClass('show');
		   $(this).find(".dropdown-menu").toggle();
		});
    }
	
$('.arrow-left > .glyphicon-chevron-left').hide();
$('.arrow-left').dblclick(function(e){ 	
    e.preventDefault();
})
$('.arrow-left').on('click', function() {
	if($(this).css("margin-left") == "250px")
	{		
		$('.arrow-left > .glyphicon-chevron-right').show();
		$('.arrow-left > .glyphicon-chevron-left').hide();
		$('.side-menu').animate({"margin-left": '-=250'});
		$('.arrow-left').animate({"margin-left": '-=250'});
	}
	else
	{	
		$('.arrow-left > .glyphicon-chevron-right').hide();
		$('.arrow-left > .glyphicon-chevron-left').show();
		$('.side-menu').animate({"margin-left": '+=250'});
		$('.arrow-left').animate({"margin-left": '+=250'});
	}
});
	
});

/* /Menu */
$(function(){
	$(".dropdown-menu > li > a.trigger").on("click",function(e){
		var current=$(this).next();
		var grandparent=$(this).parent().parent();
		if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
			$(this).toggleClass('right-caret left-caret');
		grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
		grandparent.find(".sub-menu:visible").not(current).hide();
		current.toggle();
		e.stopPropagation();
	});
	$(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
		var root=$(this).closest('.dropdown');
		root.find('.left-caret').toggleClass('right-caret left-caret');
		root.find('.sub-menu:visible').hide();
	});
	$('#accordion').on('show.bs.collapse', function () {
		$('#accordion .in').collapse('hide');
	});	
});
$(function(){
	$('.internal-user').css('display','none');
	$('.sub-vendors').css('display','none');
	
	$('a[href="#Internal-Users"], #internal').click(function(){
		$('.internal-user').css('display','block');
		$('.sub-vendors').css('display','none');
	});
	$('a[href="#Sub-Vendors"], #Vendors').click(function(){
		$('.internal-user').css('display','none');
		$('.sub-vendors').css('display','block');
	});	
	setTimeout(users, 1*200);
});
function users(){
	if($('.nav-tabs li.Internal').is(".active")){
		$('.internal-user').css('display','block');
		$('.sub-vendors').css('display','none');
	}
	if($('.nav-tabs li.vendors').is(".active")){
		$('.sub-vendors').css('display','block');
		$('.internal-user').css('display','none');
	}
}
/* Data Tables Checkbox Sorting */
$(function() {	
	$('.dataTables_empty').parent().parent().parent().next('.row').addClass('hide');	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {     
		setTimeout(pagination_hide, 1*300);
	});
	//$('.dataTables_length select').addClass('form-control input-sm select-filter');	
		setTimeout(checkbox, 1 * 600);	
		setTimeout(checkedAll, 1 * 500);		
		setTimeout(allcheck, 1 * 500);	
	$(document).on('click','.sorting_asc, .sorting_desc', function(){
		setTimeout(checkbox, 1 * 600);	
		setTimeout(checkedAll, 1 * 500);		
		setTimeout(allcheck, 1 * 500);				
						
	});
		
	$(document).on('click', '.pagination li a, .details-control', function() {        		
		setTimeout(checkbox, 1 * 500);	
		setTimeout(allcheck, 1 * 500);		
		setTimeout(checkedAll, 1 * 500);
		setTimeout(activity_check, 1 * 500);		
		});
	$(document).on('change' ,'.select-filter', function () {		
		setTimeout(checkbox, 1 * 500);								
		setTimeout(checkedAll, 1 * 500);	
		setTimeout(allcheck, 1 * 500);	
		setTimeout(activity_check, 1 * 500);		
    });
});
function activity_check(){
	/* if($('.activity_status').is(':checked')){			
		$('.activity_status').iCheck('check');			
	} */
	if ($('.activity_status').is(':checked')) {			
			$('.da-tab-checkbox .icheckbox_square-red').addClass('checked');							
		}
}
function pagination_hide(){
	$('.dataTables_empty').parent().parent().parent().next('.row').addClass('hide');
}
function checkbox() {
    $('input[type=checkbox]').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event) {}).iCheck({
        checkboxClass: 'icheckbox_square-red',
        radioClass: 'iradio_square-red',
        increaseArea: '20%'
    });
	 $('input[type=radio]').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event) {}).iCheck({   radioClass: 'iradio_square-red',
        increaseArea: '20%'
    });
	
}
function checkedAll(){
	$(document).on('ifChecked','#selectall', function(event){
		$('.da-tab-checkbox input').attr('checked', this.checked);		
	});	
	$(document).on('ifChecked','.da-tab-checkbox input', function(event){
		$(this).closest('.icheckbox_square-red').addClass('checked');		
		$(this).attr("checked", "checked");	
	});	
	
	$(document).on('ifUnchecked','#selectall', function(event){			
		$('.da-tab-checkbox input').removeAttr('checked');			
	});
	$(document).on('ifUnchecked','.da-tab-checkbox input', function(event){
		$(this).closest('.icheckbox_square-red').removeClass('checked');		
		$(this).removeAttr("checked", "checked");
	});
}
function allcheck(){	
		$(document).on('ifChecked','#selectall', function(event){		
			$('.da-tab-checkbox .icheckbox_square-red').addClass('checked');
			$('.da-tab-checkbox input').attr('checked', this.checked);		
		});
		$(document).on('ifUnchecked','#selectall', function(event){	
			$('.da-tab-checkbox .icheckbox_square-red').removeClass('checked');		
			$('.da-tab-checkbox input').removeAttr('checked');			
		});
		if ($('input[name="all"]').is(':checked') ) {			
			$('.da-tab-checkbox .icheckbox_square-red').addClass('checked');
			$("#selectall .da-tab-checkbox input").attr("checked", "checked");				
		} 
		else {
			$('.da-tab-checkbox .icheckbox_square-red').removeClass('checked');
			$("#selectall .da-tab-checkbox input").removeAttr("checked");			
		}
}
/* /Data Tables Checkbox Sorting */
$(function (){
	
	/* Viewing Projects Search */
    $('#Search_filter').keyup(function() {
        var valThis = $(this).val().toUpperCase();
        if (valThis == "") {
            $('.filter div > div > li').show();
        } else {
            $('.filter div > div > li').each(function() {
                var text = $(this).text().toUpperCase();
                (text.indexOf(valThis) == 0) ? $(this).show(): $(this).hide();
            });
        };
    });
	$('.filter li').click(function(){
		$('.filter li').removeClass('selected');
		$(this).addClass('selected');
	});
	$(window).load(function(){
		$(".jobs-menu-details .filter").mCustomScrollbar({
			setHeight:240,
			theme:"dark-3"
		});
		
	});
	trigger_left_menu();
	$('.uni_header li a').on('click', function(){		  	
		 setTimeout(trigger_left_menu, 1 * 200);
	});
});

function trigger_left_menu(){
	if($('.jobs-menu-details ul').hasClass("filter")){			  
		  if(!$('.filter li').hasClass("selected")){		
			$('.side-menu').removeAttr('style');
			$('.arrow-left').css("margin-left") == "250px"
			$('.arrow-left > .glyphicon-chevron-right').hide();
			$('.arrow-left > .glyphicon-chevron-left').show();
			$('.side-menu').animate({"margin-left": '+=250'});
			$('.arrow-left').animate({"margin-left": '+=250'});
			$('.uni_child_wrapper').addClass('disablingDiv');	
			$('.create_project_con').show();					
			$('.arrow-left').addClass('pointer_none');						
		 }
	  }
	if($('.jobs-menu-details a').hasClass("no_project")){
			/*$('.side-menu').removeAttr('style');
			$('.arrow-left').css("margin-left") == "250px"
			$('.arrow-left > .glyphicon-chevron-right').hide();
			$('.arrow-left > .glyphicon-chevron-left').show();
			$('.side-menu').animate({"margin-left": '+=250'});
			$('.arrow-left').animate({"margin-left": '+=250'});*/
			$('.uni_child_wrapper').addClass('disablingDiv');	
			
			$('.create_project_con').show();
			$('.create_pro').remove();
			$('.create_project_text').addClass('select_project_text');
			$('.select_project_text').removeClass('create_project_text');
			$('.create_project_con').css({
				'position' : 'fixed',
				'left' : '44%',
				'top' : '50%',
				'margin-left' : -$('.className').width()/2,
				'margin-top' : -$('.className').height()/2
			});
			$('.select_project_text').html('<a href="'+base_url+'cHJvamVjdHMvc2F2ZV9wcm9qZWN0Lw--">Please Create a Project</a><div class="text-center">(or)</div><div class="text-center"><a href="'+base_url+'YnVpbgxf1Rlcl9kYXNoYm9hcmQvaW5kZXgv">Go To Dashboard</a></div>');
			$('.arrow-left').addClass('pointer_none');						
	}	
	if($('.no_project_selected').hasClass("no_project_selected")){
		$('.side-menu').removeAttr('style');
			$('.arrow-left').css("margin-left") == "250px"
			$('.arrow-left > .glyphicon-chevron-right').hide();
			$('.arrow-left > .glyphicon-chevron-left').show();
			$('.side-menu').animate({"margin-left": '+=250'});
			$('.arrow-left').animate({"margin-left": '+=250'});
			$('.uni_child_wrapper').addClass('disablingDiv');	
			$('.create_project_con').show();					
			$('.arrow-left').addClass('pointer_none');	
	}
}
$(function() {
	imgLink = base_url + 'assets/images/'; 
	$(document).on("change",'.file_up', function(){	
	var $input = $(this);	
	$(this).parent().parent().find('.imagePreview').empty();
	$(this).parent().hide();
	$(this).parent().parent().find('.preview_file').show();	
	$(this).parent().parent().find('.preview_file').addClass('sign_padding');	
	$(this).parent().parent().find('.preview_file').removeClass('hide');	
	$(this).parent().parent().find('.file_name').removeClass('hide');	
	$(this).parent().removeClass('show');
	var filename = $(this).val();   	
	var file = $(this)[0].files[0];   
	var fileName = file.name;
	$(this).parent().parent().find('.file_name').html(fileName);
	if($('#add_new_budget_po .preview_file').hasClass("sign_padding")){		
		$('.sigWrapper').addClass('pointer_none');
		$('.sigPad').signaturePad({drawOnly:false});
		$('.browse').removeClass('pointer_none');
	}
	var fileExt = '.' + fileName.split('.').pop();   
	var files = !!this.files ? this.files : [];
		if (!files.length || !window.FileReader) return;
		if (/^image/.test( files[0].type)){
		var reader = new FileReader();
		reader.readAsDataURL(files[0]);
		reader.onloadend = function(event){ 	
		var file_img = '<img src="'+event.target.result+'" />';										
				 $input.parent().parent().find('.imagePreview').html(file_img);
			}
		}
		else if (fileExt == '.xlsx'){
			var file_type_img = '<img src="' + imgLink + 'file_excel.png"/>';			
			$input.parent().parent().find('.imagePreview').html(file_type_img);
		}
		else if (fileExt == '.pdf'){
			var file_type_img = '<img src="' + imgLink + 'file_pdf.png"/>';			
			$input.parent().parent().find('.imagePreview').html(file_type_img);
		}
		else if (fileExt == '.docx'){
			var file_type_img = '<img src="' + imgLink + 'file_word.png"/>';			
			$input.parent().parent().find('.imagePreview').html(file_type_img);
		}
	});
	$(document).on('click','.close-file', function(){		
		$(this).parent().parent().next('.imagePreview').empty();		
		$(this).parent().parent().parent().find('.file_name').html('');
		$(this).parent().parent().parent().find('.file_up').val("");
		$(this).parent().parent().parent().find('.browse').show();
		$(this).parent().parent('.preview_file').hide();
		$(this).parent().parent('.preview_file').removeClass('sign_padding');		
	});
 });
 
/* $('#budget_select_project').on('click', function(){
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
				window.location.href = base_url + ajax_encoded_urls;
			}
		}
	});
});  */

/* $(document).on('click','.filter .budget_enable a', function(){
		var encoded_urls = Base64.encode('budget/project_budget/');
		var ajax_encoded_urls = encoded_urls.strtr(encode_chars_obj);
		window.location.href= base_url + ajax_encoded_urls;
		
}); */
function error_box(){
	$('.error-message').show();
	$('.error-message .alerts').removeClass('alert-success');
	$('.error-message .alerts').removeClass('alert-danger');
	$('.error-message .alerts').addClass('alert-danger');
}
function success_box(){
	$('.error-message').show();
	$('.error-message .alerts').removeClass('alert-danger');
	$('.error-message .alerts').addClass('alert-success');	
}
function grid_error_box(){
	$('.grid_settings').show();
	$('.grid_settings .error-message').show();
	$('.grid_settings .error-message .alerts').removeClass('alert-success');
	$('.grid_settings .error-message .alerts').removeClass('alert-danger');
	$('.grid_settings .error-message .alerts').addClass('alert-danger');
}
function grid_success_box(){
	$('.grid_settings').show();
	$('.grid_settings .error-message').show();
	$('.grid_settings .error-message .alerts').removeClass('alert-danger');
	$('.grid_settings .error-message .alerts').addClass('alert-success');	
}
function check_project_status(url,tab_name)
{
	if(project_status_check == false)
	{	
		if (typeof tab_name == 'undefined') {
			tab_name = '';
		}
		$('#alertModal').modal('show');
		$('.alert_modal_txt').text('project was closed. You can not able to add'); 
		var encoded_home_string = Base64.encode(url);
		var encoded_home_val = encoded_home_string.strtr(encode_chars_obj);	
		window.location.href = encoded_home_val+tab_name;
	}
}
$(function() {
	/*
		Switching Project View to Template View and Vice Versa
	*/
	$('#display_type').on('change', function() {
		var encoded_destroy_session = Base64.encode('builder_dashboard/switch_template/');
		var switch_url = encoded_destroy_session.strtr(encode_chars_obj);
		var ajaxUrl = base_url + switch_url;
		template_type = $("#display_type").val();
		jQuery.ajax({
			type:'POST',
			url:ajaxUrl,
			dataType:"json",
			data:'display_type='+template_type,
			success:function(res) {
				if(res.status == true){	
					window.location.href= res.redirect_url;
				}else
				{
					alert(res.message);
				}
			}
		});
	});
	
	function toggleSelectAll(control) {
    var allOptionIsSelected = (control.val() || []).indexOf("0") > -1;
    function valuesOf(elements) {
        return $.map(elements, function(element) {
            return element.value;
        });
    }

    if (control.data('allOptionIsSelected') != allOptionIsSelected) {
        // User clicked 'All' option
        if (allOptionIsSelected) {
            // Can't use .selectpicker('selectAll') because multiple "change" events will be triggered
            control.selectpicker('val', valuesOf(control.find('option')));
        } else {
            control.selectpicker('val', []);
        }
    } else {
        // User clicked other option
        if (allOptionIsSelected && control.val().length != control.find('option').length) {
            // All options were selected, user deselected one option
            // => unselect 'All' option
            control.selectpicker('val', valuesOf(control.find('option:selected[value!=0]')));
            allOptionIsSelected = false;
        } else if (!allOptionIsSelected && control.val().length == control.find('option').length - 1) {
            // Not all options were selected, user selected all options except 'All' option
            // => select 'All' option too
            control.selectpicker('val', valuesOf(control.find('option')));
            allOptionIsSelected = true;
        }
    }
    control.data('allOptionIsSelected', allOptionIsSelected);
}

$('#cost_code_id').selectpicker().change(function(){toggleSelectAll($(this));}).trigger('change');
	
});