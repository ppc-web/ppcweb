
    function updateGameTitle(t) {
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GAME_TITLE}/gi, t);
    }
    // Replace all the "placeholder" in the page with "doc_link"
    function updateDoc(newdoc) {
        document.body.innerHTML =
            document.body.innerHTML
            .replace(/{GoogleDoc}/gi, newdoc);
    }

	function enableGroup (gp_bgn, gp_end, flag){
		if( flag === '1' ){
	        document.body.innerHTML =
            document.body.innerHTML
            .replace(gp_bgn, "<br>");
			document.body.innerHTML =
            document.body.innerHTML
            .replace(gp_end, "<br>");
			} else {
			document.body.innerHTML =
            document.body.innerHTML
            .replace(gp_bgn, "<! --- disable group");
			document.body.innerHTML =
            document.body.innerHTML
            .replace(gp_end, "end disable group -->");
			}
	}
	
    // Replace all the "placeholder" in the page with "doc_link"
    function updateGroups(g1, g2, g3, g4) {
        document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank1}/gi, g1);
        document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank2}/gi, g2);
        document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank3}/gi, g3);
        if (g4 !== ""){
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank4}/gi, g4);
			enableGroup('{G4_begin}', '{G4_end}', '1');
			} else {
			enableGroup('{G4_begin}', '{G4_end}', '0');
			}

	    // h3 specific
	document.getElementById('h3')
                .innerHTML = document.getElementById('h3')
                                     .innerHTML
		    .replace(/{GroupRank1}/gi, g1);
    }


    function updateGroupsDate(d1,d1cal, d2,d2cal, d3,d3cal, d4,d4cal){
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank1Date}/gi, d1);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank1DateCal}/gi, d1cal);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank2Date}/gi, d2);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank2DateCal}/gi, d2cal);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank3Date}/gi, d3);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank3DateCal}/gi, d3cal);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank4Date}/gi, d4);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank4DateCal}/gi, d4cal);
    }
	
	function 	updateGroupWinners(group, place, champ, cham_name)	{
	if (group === 1){
		if (place === 1){
	        document.body.innerHTML = document.body.innerHTML
		    .replace(/{GroupRank1_champion}/gi, champ);
			document.body.innerHTML = document.body.innerHTML
		    .replace(/{GroupRank1_champion_names}/gi, champ_name);
			} else
			if (place === 2){
	        document.body.innerHTML = document.body.innerHTML
		    .replace(/{GroupRank1_runnerup}/gi, champ);
			document.body.innerHTML = document.body.innerHTML
		    .replace(/{GroupRank1_runnerup_names}/gi, champ_name);
			}
	
	} else
	if ( group === 2){
		if ( place === 1){	
	        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank2_champion}/gi, champ);
			document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank2_champion_names}/gi, champ_name);
			} else
			if ( place === 2){			
		    document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank2_runnerup}/gi, champ);
			document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank2_runnerup_names}/gi, champ_name);
			}
	} else 
	if (group === 3){
		if ( place === 1){	
	        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank3_champion}/gi, champ);
			document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank3_champion_names}/gi, champ_name);
			} else
			if ( place === 2){			
		    document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank3_runnerup}/gi, champ);
			document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank3_runnerup_names}/gi, champ_name);
			}
	} else 
	if (group === 4){
		if (place === 1){
	        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank4_champion}/gi, champ);
			document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank4_champion_names}/gi, champ_name);
			} else
			if ( place === 2){			
		    document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank4_runnerup}/gi, champ);
			document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GroupRank4_runnerup_names}/gi, champ_name);
			}
	}
	}

