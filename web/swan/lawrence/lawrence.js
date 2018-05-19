updateDonationInfo = function(){
    var apiUrl = 'https://sheets.googleapis.com/v4/spreadsheets/1fNarlg8sjchF87pzEAS5c7cLSfEzQ24tNcdh1f32UOY/values/B1:B4?key=AIzaSyAIGmxQOkvEeG51g5cH_PcnWo-M6RiTtsc';
    $.getJSON(apiUrl)
		.done(function(data){
        	console.log(data)
        	if(data.values){
				$('#donationUpdateTime').html(data.values[0][0]);
				$('#donationAmount').html(data.values[1][0]);
				$('#donationPeople').html(data.values[2][0]);
				$('#donationTimes').html(data.values[3][0]);
				
            }
        })
    	.fail(function(){
        	console.log('Failed to fetch data');
    	});
}

$(function() {
    updateDonationInfo();
});