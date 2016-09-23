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
    var name = $('#name').val();
    var encoded_home_string = Base64.encode('leads/get_activity_calendar/');
    var encoded_home_val = encoded_home_string.strtr(encode_chars_obj); 

    $.ajax({
        url: base_url + encoded_home_val,
        dataType: "json",
        type: "post",
        data: 'name='+name,
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
                drop: function(date, allDay) 
                { // this function is called when something is dropped
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    var $categoryClass = $(this).attr('data-class');
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);
                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    if ($categoryClass)
                        copiedEventObject['className'] = [$categoryClass];
                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },
                selectable: false,
                selectHelper: true,
                select: function(start, end, allDay) 
                {
                    $modal.modal({
                        backdrop: 'static'
                    });
                    form = $("<form></form>");
                    form.append("<div class='row'></div>");
                    form.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>New Event Name</label><input class='form-control' placeholder='Insert Event Name' type=text name='title'/></div></div>").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='label-default'>Work</option>").append("<option value='label-green'>Home</option>").append("<option value='label-purple'>Holidays</option>").append("<option value='label-orange'>Party</option>").append("<option value='label-yellow'>Birthday</option>").append("<option value='label-teal'>Generic</option>").append("<option value='label-beige'>To Do</option>");
                    $modal.find('.remove-event').hide().end().find('.save-event').show().end().find('.modal-con1').empty().prepend(form).end().find('.save-event').unbind('click').click(function() {
                        form.submit();
                    });
                    $modal.find('form').on('submit', function() {
                        title = form.find("input[name='title']").val();
                        $categoryClass = form.find("select[name='category'] option:checked").val();
                        if (title !== null) {
                            calendar.fullCalendar('renderEvent', {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay,
                                    className: $categoryClass
                                }, true // make the event "stick"
                            );
                        }
                        $modal.modal('hide');
                        return false;
                    });
                    calendar.fullCalendar('unselect');
                },
                eventClick: function(calEvent, jsEvent, view) 
                {
                    var form = $("<form></form>");
                    form.append("<div class='row panel-content'><div class='col-xs-6'><label>Event Name</label><input type='text' class='form-control' value='" + calEvent.title + "' readonly/></div><div class='col-xs-6'><label>Date &amp; Time </label><input type='text' class='form-control'  value='" + calEvent.start + "' readonly/></div></div><div class='row panel-content'><div class='col-xs-6'><label>Lead Name</label><input type='text' class='form-control' value='" + calEvent.name + "' readonly/></div><div class='col-xs-6'><label>Sales Person</label><input type='text' class='form-control' value='" + calEvent.salesperson + "' readonly/></div></div>");            
                    $modal.modal({
                        backdrop: 'static'
                    });
                    $modal.find('.remove-event').show().end().find('.save-event').hide().end().find('.modal-con1').empty().prepend(form).end().find('.remove-event').unbind('click').click(function() {
                        calendar.fullCalendar('removeEvents', function(ev) {
                            return (ev._id == calEvent._id);
                        });
                        $modal.modal('hide');
                    });
                    $modal.find('form').on('submit', function() {
                        calEvent.title = form.find("input[type=text]").val();
                        calendar.fullCalendar('updateEvent', calEvent);
                        $modal.modal('hide');
                        return false;
                    });
                }
            });
        }
    });      
}

$(function() {
    runFullCalendar();
});
$('#update_result').click(function(e){
    $('#calendar').empty();
     runFullCalendar();
});