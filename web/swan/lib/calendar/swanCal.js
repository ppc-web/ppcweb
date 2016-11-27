$(document).ready(function() {
	eventSources.push(events);	
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		eventSources: eventSources,
		eventRender: function(event){
	    	if (!event.ranges)
	    		return true;
		    return (event.ranges.filter(function(range){ // test event against all the ranges
		    	rangeStart = moment(range.start).startOf('day');
		    	rangeEnd = moment(range.end).endOf('day');
		        return (event.start.isSameOrBefore(rangeEnd) &&
		                event.end.isSameOrAfter(rangeStart));

		    }).length)>0; //if it isn't in one of the ranges, don't render it (by returning false)
		},

	});
});

if (typeof events === "undefined") {
	events = [];
}

if (typeof eventSources === "undefined") {
	eventSources = [];
}