$(document).ready(function() {
	eventSources.push(events);	
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		//fixedWeekCount: false, 
		eventSources: eventSources,
		eventRender: function(event, element, view){
            var ntoday = new Date().getTime();
            var eventEnd = moment( event.end ).valueOf();
            var eventStart = moment( event.start ).valueOf();
            if (!event.end){
                if (eventStart < ntoday){
                    element.addClass("past-event");
                    element.children().addClass("past-event");
                }
            } else {
                if (eventEnd < ntoday){
                    element.addClass("past-event");
                    element.children().addClass("past-event");
                }
            }
            
	    	if (!event.ranges)
	    		return true;
		    return (event.ranges.filter(function(range){ // test event against all the ranges
		    	rangeStart = moment(range.start).startOf('day');
		    	rangeEnd = moment(range.end).endOf('day');
		        return (event.start.isSameOrBefore(rangeEnd) &&
		                event.end.isSameOrAfter(rangeStart));

		    }).length)>0; //if it isn't in one of the ranges, don't render it (by returning false)
		},
		contentHeight: "auto",
		displayEventEnd: true,
		businessHours: {
		    // days of week. an array of zero-based day of week integers (0=Sunday)
		    dow: [ 0, 1, 2, 3, 4, 5, 6] ,// Sun - Sat

		    start: '11:00', 
		    end: '22:30'
		}

	});
});

if (typeof events === "undefined") {
	events = [];
}

if (typeof eventSources === "undefined") {
	eventSources = [];
}