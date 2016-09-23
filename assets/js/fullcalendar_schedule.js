var runFullCalendar = function() {
    var $modal = $('#event-management');
    $('#event-categories div.event-category').each(function() {
        var eventObject = {
            title: $.trim($(this).text())
        };
        $(this).data('eventObject', eventObject);
        $(this).draggable({
            zIndex: 999,
            revert: true, // will cause the event to go back to its
            revertDuration: 50 //  original position after the drag
        });
    });
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
	var assignedto = $('#assigned_users').val();
	var status  = $('#status').val();
	var tags    = $('#tags').val();
	var phase   = $('#phase').val();
    var encoded_home_string = Base64.encode('schedules/get_schedules_calender/') ;
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 
    var data = 'tags='+tags+'&assignedto='+assignedto+'&phase='+phase+'&status='+status ;
	
	$.ajax({
		url: base_url + encoded_home_val,
		dataType: "json",
		type: "post",
		data: data,			
		success: function(response) {		
			
		var form = '';
        var calendar = $('#calendar').fullCalendar({
        buttonText: {
            prev: '<i class="glyphicon glyphicon-chevron-left"></i>',
            next: '<i class="glyphicon glyphicon-chevron-right"></i>'
        },
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },	
		events: response,
        editable: true,
        droppable: true,
		eventMouseover: function(calEvent, jsEvent) {
		var startdate = new Date(calEvent.start) ;
		var start = startdate.getMonth()+1 + " / " + startdate.getDate() + " / " +  startdate.getFullYear() ;
	    var enddate = new Date(calEvent.end) ;
		var end = enddate.getMonth()+1 + " / " + enddate.getDate() + " / " +  enddate.getFullYear() ;
		// alert(calEvent.end);
		if(!calEvent.end)
		{
			//alert(1);
			end = start;
		}
        var tooltip = '<div class="tooltipevent" style="min-width:100px;height:auto;background:#eee;position:absolute;z-index:10001;padding:3px;"><b>Title:</b> ' + calEvent.title + '<br/>' + '<b>Start Date:</b> ' + start + '<br/>' +'<b>End Date:</b> '+ end + '</div>';
			$("body").append(tooltip);
			$(this).mouseover(function(e) {
			$(this).css('z-index', 10000);
			$('.tooltipevent').fadeIn('500');
			$('.tooltipevent').fadeTo('10', 1.9);
			}).mousemove(function(e) {
			$('.tooltipevent').css('top', e.pageY + 10);
			$('.tooltipevent').css('left', e.pageX + 20);
			});
		 },
		eventMouseout: function(calEvent, jsEvent) {
          $(this).css('z-index', 8);
          $('.tooltipevent').remove();
         }, 
		eventClick: function(calEvent, jsEvent, view) {
		var scheduleid = calEvent.id ;
			if(!scheduleid)
			{
				return false;
			}
			else
			{
				var encoded_schedule_string = Base64.encode('schedules/save_schedule/'+scheduleid);
				var encoded_edit_schedule_val = encoded_schedule_string.strtr(encode_chars_obj); 
				window.location.href = base_url + encoded_edit_schedule_val;
			}
        }
			
    });	
			
			
		}
	});	
   

}

/* $(function() {
    runFullCalendar();
}); */
/* $('#update_result').click(function(e){	
	alert('in calender');
	$('#calendar').empty();
     runFullCalendar();
});
 */
