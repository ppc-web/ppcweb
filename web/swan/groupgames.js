
    function updateGameTitle(t) {
		document.body.innerHTML =
		document.body.innerHTML
		.replace(/{GAME_TITLE}/g, t);
    }
    // Replace all the "placeholder" in the page with "doc_link"
    function updateDoc(newdoc) {
        document.body.innerHTML =
            document.body.innerHTML
            .replace(/{GoogleDoc}/g, newdoc);
    }

	function enableGroup (gp_bgn, gp_end, flag){
		var grpB = gp_bgn;
		var grpE = gp_end;
		if( flag === '1' ){
	        document.body.innerHTML =
            document.body.innerHTML
            .replace(/gp_bgn/, "<br>");
			document.body.innerHTML =
            document.body.innerHTML
            .replace(/gp_end/, "<br>");
			} else {
			document.body.innerHTML =
            document.body.innerHTML
            .replace(/gp_bgn/, "<! --- disable group");
			document.body.innerHTML =
            document.body.innerHTML
            .replace(/gp_end/, "end disable group -->");
			}
	}
	
    // Replace all the "placeholder" in the page with "doc_link"
    function updateGroups(g1, g2, g3, g4) {
        document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank1}/g, g1);
        document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank2}/g, g2);
        if (g3 !== '') {
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank3}/g, g3);
			document.body.innerHTML =
            document.body.innerHTML
			            .replace(/{G3_begin}/, '<br\>');
			document.body.innerHTML =
            document.body.innerHTML
            .replace(/{G3_end}/, '<br/>');
		} else {
			document.body.innerHTML =
            document.body.innerHTML
            .replace(/{G3_begin}/, '<! --- disable group');
			document.body.innerHTML =
            document.body.innerHTML
            .replace(/{G3_end}/, 'end disable group -->');
		}
        if (g4 !== ''){
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank4}/g, g4);
			/* enableGroup('{G4_begin}', '{G4_end}', '1'); */
									document.body.innerHTML =
            document.body.innerHTML
            .replace(/{G4_begin}/, '<br\>');
			document.body.innerHTML =
            document.body.innerHTML
            .replace(/{G4_end}/, '<br\>');
			} else {
			/* enableGroup('{G4_begin}', '{G4_end}', '0'); */
						document.body.innerHTML =
            document.body.innerHTML
            .replace(/{G4_begin}/, '<! --- disable group');
			document.body.innerHTML =
            document.body.innerHTML
            .replace(/{G4_end}/, 'end disable group -->');
			}

	    // h3 specific
/* 	document.getElementById('h3')
                .innerHTML = document.getElementById('h3')
                                     .innerHTML
		    .replace(/{GroupRank1}/gi, g1); */
    }


    function updateGroupsDate(d1,d1cal, d2,d2cal, d3,d3cal, d4,d4cal){
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank1Date}/g, d1);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank1DateCal}/g, d1cal);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank2Date}/g, d2);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank2DateCal}/g, d2cal);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank3Date}/g, d3);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank3DateCal}/g, d3cal);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank4Date}/g, d4);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank4DateCal}/g, d4cal);
    }
	
	/* 	Doc page id */	
	function updateGroupsPid(d1, d2, d3, d4) {
		document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank1DocPage}/g, d1);

        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank2DocPage}/g, d2);

        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank3DocPage}/g, d3);

        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank4DocPage}/g, d4);
		
	}
	
	function finalResult(group, place, champ, champ_name)	{
		var localHtml = document.body.innerHTML;
		if (group == 1){
			if (place == 1){
				localHtml=localHtml.replace(/{GroupRank1_champion}/g, champ);
				localHtml=localHtml.replace(/{GroupRank1_champion_names}/g, champ_name);	
			} else 
			if (place == 2){
				localHtml=localHtml.replace(/{GroupRank1_runnerup}/g, champ);
				localHtml=localHtml.replace(/{GroupRank1_runnerup_names}/g, champ_name);
			}
		} else
		if ( group == 2){
			if ( place == 1){	
localHtml=localHtml.replace(/{GroupRank2_champion}/g, champ);
localHtml=localHtml.replace(/{GroupRank2_champion_names}/g, champ_name);
			} else
			if ( place == 2){			
localHtml=localHtml.replace(/{GroupRank2_runnerup}/g, champ);
localHtml=localHtml.replace(/{GroupRank2_runnerup_names}/g, champ_name);
			}
		} else 
		if (group == 3){
			if ( place == 1){	
localHtml=localHtml.replace(/{GroupRank3_champion}/g, champ);
localHtml=localHtml.replace(/{GroupRank3_champion_names}/g, champ_name);
			} else
			if ( place == 2){			
localHtml=localHtml.replace(/{GroupRank3_runnerup}/g, champ);
localHtml=localHtml.replace(/{GroupRank3_runnerup_names}/g, champ_name);
			}
		} else 
		if (group == 4){
			if (place == 1){
localHtml=localHtml.replace(/{GroupRank4_champion}/g, champ);
localHtml=localHtml.replace(/{GroupRank4_champion_names}/g, champ_name);
			} else
			if ( place == 2){			
localHtml=localHtml.replace(/{GroupRank4_runnerup}/g, champ);
localHtml=localHtml.replace(/{GroupRank4_runnerup_names}/g, champ_name);
			}
		}
		document.body.innerHTML = localHtml;
	}
	
	


