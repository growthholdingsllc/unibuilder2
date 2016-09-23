imgLink = base_url + 'assets/images/'; 
$(function(){
	$('#datetimepicker3').datetimepicker({ pickTime: false });
	$('#datetimepicker4').datetimepicker({ pickTime: false });	
	$('#colorselector_1').colorselector();
});
/* Schedule */
 $(function(){  
$('.checked_marked').hide();	
	$('.unchecked_marked').click(function(){		
		$(this).hide();
		$('.checked_marked').show();
		$('#marked-list').attr("checked", true);
	});
	$('.checked_marked').click(function(){
		$(this).hide();
		$('.unchecked_marked').show();
		$('#marked-list').attr("checked", false);
	}); 
  //remove button
$('.removeBtn').click( function() {
    var cointainer = $(this).parent().parent().parent().parent().closest('.cointainer');
    var counts = cointainer.children('.content').length;
    counts--;
    if(counts < 3) {
        cointainer.children('.addBtn').show();         
        if (counts == 1) {
            cointainer.find('.removeBtn').hide();
        }
    }
    $(this).parent().parent().parent().parent().remove();
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
    content.clone(true,true).insertAfter(content).find('input').val('').end().find('.label-num').text(counts);
	$('.Lag').val(0);
    cointainer.find('.removeBtn').show();
});  
 


$('.spinner .btn:first-of-type').on('click', function() {	
	var spinner_first = $(this).parent().parent('.spinner').find('.Lag'); 	
	$(spinner_first).val( parseInt($(spinner_first).val(), 10) + 1);
});
$('.spinner .btn:last-of-type').on('click', function() {	
	var spinner_last = $(this).parent().parent('.spinner').find('.Lag'); 	
	$(spinner_last).val( parseInt($(spinner_last).val(), 10) - 1);
	
});
/* Duration */
$('.spinner .btn:first-of-type').on('click', function() {	
	var spinner_first = $(this).parent().parent('.spinner').find('.Duration'); 	
	$(spinner_first).val( parseInt($(spinner_first).val(), 10) + 1);
});
$('.spinner .btn:last-of-type').on('click', function() {	
	var spinner_last = $(this).parent().parent('.spinner').find('.Duration'); 			
	if($(spinner_last).val() > 0){
		$(spinner_last).val( parseInt($(spinner_last).val(), 0) -1);	
	}	
});
/* /Duration */
});
$(function() {     
    predecessor_list_view();
});
function predecessor_list_view() {
	$('#predecessor_list').dataTable({						
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5, 
		"paging": false,			
		sAjaxSource: base_url + 'assets/js/json_predecessor_list.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],			
		"columns":[            
		{ "sTitle":"Title", "data": "title"},		
		{ "sTitle":"Lag", "data": "lag"},
		{ "sTitle":"Start Date", "data": "start_date"},
		{ "sTitle":"End Date", "data": "end_date"}
		
	],
	"order": [[1, 'asc']]

	});
}
$(function() {     
    baseline_list_view();
});

function baseline_list_view() {
	$('#baseline_list').dataTable({						
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5, 
					
		sAjaxSource: base_url + 'assets/js/json_baseline_list.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],			
		"columns":[            
		{ "sTitle":"Baseline Current", "data": "baseline_current"},
		{ "sTitle":"Start Date", "data": "start_date"},
		{ "sTitle":"End Date", "data": "end_date"},
		{ "sTitle":"Duration", "data": "duration"},
		{ "sTitle":"Total Variance", "data": "total_variance"}
		
	],
	"order": [[1, 'asc']]

	});
}
$(function() {     
    shifts_list_view();
});
function shifts_list_view() {
	$('#shifts_list').dataTable({						
		"aLengthMenu": [
			[5, 15, 50, 100],
			[5, 15, 50, "l00"]
		],
		"iDisplayLength": 5, 
					
		sAjaxSource: base_url + 'assets/js/json_shifts_list.json',
		"aoColumnDefs": [{
			"bSortable": false,
			"aTargets": [0] // <-- gets last column and turns off sorting
		}],			
		"columns":[            
		{ "sTitle":"User", "data": "user"},
		{ "sTitle":"[Base] Start Date", "data": "start_date"},
		{ "sTitle":"[Base] End Date", "data": "end_date"},
		{ "sTitle":"Slip", "data": "slip"},
		{ "sTitle":"Type", "data": "type"},
		{ "sTitle":"Source", "data": "source"},
		{ "sTitle":"Reason", "data": "reason"},
		{ "sTitle":"Notes", "data": "notes"}
		
	],
	"order": [[1, 'asc']]

	});
}


$(function() {
	$('#pro-phase').on('change', function(){
		var selected = $(this).find("option:selected").val();
		$('#Edit_phase_group').val(selected);
		$('#selected').val(selected);
	});
	$('#save').click(function(){
		var sat = $('#phase_group').val();		
		$('#pro-phase').append($("<option value="+ sat +">"+ sat +"</option>").text(sat)); 	
		$(".selectpicker").selectpicker("refresh");						
	});		
	$('.TypeEditModal').click(function(){		
		var n = $('#pro-phase').next().find('.dropdown-menu.inner.selectpicker li.selected').length;				
		if(n === 1){
			$('#TypeEditModal').modal({
				show: true
			});						
			$('#Edit_phase').click(function(){				
				var sat = $('#Edit_phase_group').val();
				var selected_val = $('#selected').val();
				if(selected_val == selected_val){
					$('#pro-phase option[value='+ selected_val +']').remove();
				}
				if(sat == sat){										
					$('#pro-phase').append($("<option value="+ sat +">"+ sat +"</option>").text(sat)); 
				}				
				$('#pro-phase').next().find('.dropdown-menu li.selected a .text').empty();
				$('#pro-phase').next().find('.dropdown-menu li.selected a .text').append(sat);		
				$('#pro-phase').next().find('.selectpicker .filter-option').empty();
				$('#pro-phase').next().find('.selectpicker .filter-option').append(sat);		
			});
			$('#Delete_phase').click(function(){		
				var sat = $('#Edit_phase_group').val();
				if(sat == sat){
					$('#pro-phase option[value='+ sat +']').remove();
				}
				$('#Edit_phase_group').val('');		
				$('#pro-phase').next().find('.dropdown-menu li.selected').remove();		
				$('#pro-phase').next().find('.selectpicker .filter-option').empty();		
				$('#pro-phase').next().find('.dropdown-toggle.selectpicker').removeAttr('title');						
			});			
		}
		else if(n > 1){
			// alert('select only one at a time');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('select only one at a time');
		}
		else if(n === 0){
			// alert('Please select');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select');
		}
	});
});

$(function() {
	$('#Tag-group').on('change', function(){
		var selected = $(this).find("option:selected").val();
		$('#Edit_phase_group').val(selected);
		$('#selected').val(selected);
	});
	$('#save').click(function(){
		var sat = $('#tag_group').val();		
		$('#Tag-group').append($("<option value="+ sat +">"+ sat +"</option>").text(sat)); 	
		$(".selectpicker").selectpicker("refresh");						
	});		
	$('.TagEditModal').click(function(){		
		var n = $('#Tag-group').next().find('.dropdown-menu.inner.selectpicker li.selected').length;				
		if(n === 1){
			$('#TagEditModal').modal({
				show: true
			});						
			$('#Edit_tag').click(function(){				
				var sat = $('#Edit_tag_group').val();
				var selected_val = $('#selected').val();
				if(selected_val == selected_val){
					$('#Tag-group option[value='+ selected_val +']').remove();
				}
				if(sat == sat){										
					$('#Tag-group').append($("<option value="+ sat +">"+ sat +"</option>").text(sat)); 
				}				
				$('#Tag-group').next().find('.dropdown-menu li.selected a .text').empty();
				$('#Tag-group').next().find('.dropdown-menu li.selected a .text').append(sat);		
				$('#Tag-group').next().find('.selectpicker .filter-option').empty();
				$('#Tag-group').next().find('.selectpicker .filter-option').append(sat);		
			});
			$('#Delete_tag').click(function(){		
				var sat = $('#Edit_tag_group').val();
				if(sat == sat){
					$('#Tag-group option[value='+ sat +']').remove();
				}
				$('#Edit_tag_group').val('');		
				$('#Tag-group').next().find('.dropdown-menu li.selected').remove();		
				$('#Tag-group').next().find('.selectpicker .filter-option').empty();		
				$('#Tag-group').next().find('.dropdown-toggle.selectpicker').removeAttr('title');						
			});			
		}
		else if(n > 1){
			// alert('select only one at a time');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('select only one at a time');
		}
		else if(n === 0){
			// alert('Please select');
			$('#alertModal').modal('show');
			$('.alert_modal_txt').text('Please select');
		}
	});
});

/* /Schedule */
$(function(){
	$('body ul.drag-ele').on('click', 'li', function() {
	   $(this).toggleClass('selected'); 
	});
	$('#sub_move_left').click(function() {
		$('.sub_list1').append($('.sub_list2 .selected').removeClass('selected'));				
	});
	$('#sub_move_right').click(function() {
		$('.sub_list2').append($('.sub_list1 .selected').removeClass('selected'));	
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
    /* /Viewing Access Search */
	
}); 