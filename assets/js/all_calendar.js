var runMonthCalendar = function() {
    var $modal_month = $('#month-event-management');
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
    var form = '';
    var calendar = $('#month-calendar').fullCalendar({
        buttonText: {
            prev: '<i class="glyphicon glyphicon-chevron-left"></i>',
            next: '<i class="glyphicon glyphicon-chevron-right"></i>'
        },
        header: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        events: [{
            title: 'Meeting with Boss',
            start: new Date(y, m, 1),
            className: 'label-default'
        }, {
            title: 'Bootstrap Seminar',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2),
            className: 'label-teal'
        }, {
            title: 'Lunch with Nicole',
            start: new Date(y, m, d - 3, 12, 0),
            className: 'label-green',
            allDay: false
        }],
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped
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
            $('#month-calendar').fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },
        selectable: false,
        selectHelper: true,
        select: function(start, end, allDay) {
            $modal_month.modal({
                backdrop: 'static'
            });
            form = $("<form></form>");
            form.append("<div class='row'></div>");
            form.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>New Event Name</label><input class='form-control' placeholder='Insert Event Name' type=text name='title'/></div></div>").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='label-default'>Work</option>").append("<option value='label-green'>Home</option>").append("<option value='label-purple'>Holidays</option>").append("<option value='label-orange'>Party</option>").append("<option value='label-yellow'>Birthday</option>").append("<option value='label-teal'>Generic</option>").append("<option value='label-beige'>To Do</option>");
            $modal_month.find('.remove-event').hide().end().find('.save-event').show().end().find('.modal-con1').empty().prepend(form).end().find('.save-event').unbind('click').click(function() {
                form.submit();
            });
            $modal_month.find('form').on('submit', function() {
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
                $modal_month.modal('hide');
                return false;
            });
            calendar.fullCalendar('unselect');
        },
        eventClick: function(calEvent, jsEvent, view) {
			$('#Schedule_item').modal('show');
            /*var form = $("<form></form>");            
            form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success'><i class='icon-ok'></i> Save</button></span></div>");
            $modal_month.modal({
                backdrop: 'static'
            });
            $modal_month.find('.remove-event').show().end().find('.save-event').hide().end().find('.modal-con1').empty().prepend(form).end().find('.remove-event').unbind('click').click(function() {
                calendar.fullCalendar('removeEvents', function(ev) {
                    return (ev._id == calEvent._id);
                });
                $modal_month.modal('hide');
            });
            $modal_month.find('form').on('submit', function() {
                calEvent.title = form.find("input[type=text]").val();
                calendar.fullCalendar('updateEvent', calEvent);
                $modal_month.modal('hide');
                return false;
            });*/
        }
    });
}
var runWeekCalendar = function() {
    var $modal_week = $('#week-event-management');
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
    var form = '';
    var calendar = $('#week-calendar').fullCalendar({
        buttonText: {
            prev: '<i class="glyphicon glyphicon-chevron-left"></i>',
            next: '<i class="glyphicon glyphicon-chevron-right"></i>'
        },
        header: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        events: [{
            title: 'Meeting with Boss',
            start: new Date(y, m, 1),
            className: 'label-default'
        }, {
            title: 'Bootstrap Seminar',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2),
            className: 'label-teal'
        }, {
            title: 'Lunch with Nicole',
            start: new Date(y, m, d - 3, 12, 0),
            className: 'label-green',
            allDay: false
        }],
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped
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
            $('#week-calendar').fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },
        selectable: false,
        selectHelper: true,
        select: function(start, end, allDay) {
            $modal_week.modal({
                backdrop: 'static'
            });
            form = $("<form></form>");
            form.append("<div class='row'></div>");
            form.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>New Event Name</label><input class='form-control' placeholder='Insert Event Name' type=text name='title'/></div></div>").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='label-default'>Work</option>").append("<option value='label-green'>Home</option>").append("<option value='label-purple'>Holidays</option>").append("<option value='label-orange'>Party</option>").append("<option value='label-yellow'>Birthday</option>").append("<option value='label-teal'>Generic</option>").append("<option value='label-beige'>To Do</option>");
            $modal_week.find('.remove-event').hide().end().find('.save-event').show().end().find('.modal-con1').empty().prepend(form).end().find('.save-event').unbind('click').click(function() {
                form.submit();
            });
            $modal_week.find('form').on('submit', function() {
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
                $modal_week.modal('hide');
                return false;
            });
            calendar.fullCalendar('unselect');
        },
        eventClick: function(calEvent, jsEvent, view) {
			$('#Schedule_item').modal('show');
           /* var form = $("<form></form>");
            form.append("<label>Change event name</label>");
            form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success'><i class='icon-ok'></i> Save</button></span></div>");
            $modal_week.modal({
                backdrop: 'static'
            });
            $modal_week.find('.remove-event').show().end().find('.save-event').hide().end().find('.modal-con1').empty().prepend(form).end().find('.remove-event').unbind('click').click(function() {
                calendar.fullCalendar('removeEvents', function(ev) {
                    return (ev._id == calEvent._id);
                });
                $modal_week.modal('hide');
            });
            $modal_week.find('form').on('submit', function() {
                calEvent.title = form.find("input[type=text]").val();
                calendar.fullCalendar('updateEvent', calEvent);
                $modal_week.modal('hide');
                return false;
            });*/
        }
    });

}
var runDayCalendar = function() {
    var $modal_day = $('#day-event-management');
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
    var form = '';
    var calendar = $('#day-calendar').fullCalendar({
        buttonText: {
            prev: '<i class="glyphicon glyphicon-chevron-left"></i>',
            next: '<i class="glyphicon glyphicon-chevron-right"></i>'
        },
        header: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        events: [{
            title: 'Meeting with Boss',
            start: new Date(y, m, 1),
            className: 'label-default'
        }, {
            title: 'Bootstrap Seminar',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2),
            className: 'label-teal'
        }, {
            title: 'Lunch with Nicole',
            start: new Date(y, m, d - 3, 12, 0),
            className: 'label-green',
            allDay: false
        }],
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped
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
            $('#day-calendar').fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                $(this).remove();
            }
        },
        selectable: false,
        selectHelper: true,
        select: function(start, end, allDay) {
            $modal_day.modal({
                backdrop: 'static'
            });
            form = $("<form></form>");
            form.append("<div class='row'></div>");
            form.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>New Event Name</label><input class='form-control' placeholder='Insert Event Name' type=text name='title'/></div></div>").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>").find("select[name='category']").append("<option value='label-default'>Work</option>").append("<option value='label-green'>Home</option>").append("<option value='label-purple'>Holidays</option>").append("<option value='label-orange'>Party</option>").append("<option value='label-yellow'>Birthday</option>").append("<option value='label-teal'>Generic</option>").append("<option value='label-beige'>To Do</option>");
            $modal_day.find('.remove-event').hide().end().find('.save-event').show().end().find('.modal-con1').empty().prepend(form).end().find('.save-event').unbind('click').click(function() {
                form.submit();
            });
            $modal_day.find('form').on('submit', function() {
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
                $modal_day.modal('hide');
                return false;
            });
            calendar.fullCalendar('unselect');
        },
        eventClick: function(calEvent, jsEvent, view) {
			$('#Schedule_item').modal('show');
            /*var form = $("<form></form>");
            form.append("<label>Change event name</label>");
            form.append("<div class='input-group'><input class='form-control' type=text value='" + calEvent.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success'><i class='icon-ok'></i> Save</button></span></div>");
            $modal_day.modal({
                backdrop: 'static'
            });
            $modal_day.find('.remove-event').show().end().find('.save-event').hide().end().find('.modal-con1').empty().prepend(form).end().find('.remove-event').unbind('click').click(function() {
                calendar.fullCalendar('removeEvents', function(ev) {
                    return (ev._id == calEvent._id);
                });
                $modal_day.modal('hide');
            });
            $modal_day.find('form').on('submit', function() {
                calEvent.title = form.find("input[type=text]").val();
                calendar.fullCalendar('updateEvent', calEvent);
                $modal_day.modal('hide');
                return false;
            });*/
        }
    });
}
$(function() { 
	 runMonthCalendar();
     runWeekCalendar();
     runDayCalendar();
});