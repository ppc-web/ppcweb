
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
	
	
	function resizeGroupsTable(g1, g2, g3, g4){
		if ( g4 == '') {	
			document.getElementById("groupsTableID").deleteRow(4); }
		if ( g3 == '') {
			document.getElementById("groupsTableID").deleteRow(3);}
		if ( g2 == '') { 
			document.getElementById("groupsTableID").deleteRow(2);}
		/* always has at least one group 😂 */
	}
	
    // Replace all the "placeholder" in the page with "doc_link"
    function updateGroups(g1, g2, g3, g4) {
        document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank1}/g, g1);
		if (g2 != ''){
        document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank2}/g, g2);
		}
		if (g3 != ''){
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank3}/g, g3);
		}
        if (g4 != '') {
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank4}/g, g4);
		}

	    // h3 specific
/* 		document.getElementById('h3')
                .innerHTML = document.getElementById('h3')
                                     .innerHTML
		    .replace(/{GroupRank1}/gi, g1); */
			
		resizeGroupsTable( g1, g2, g3, g4);
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
	
	function updateEvents(gp, flag){ 
			var localHtml = document.body.innerHTML;
		if (gp == 1){
			if (flag == 0){
			localHtml=localHtml.replace(/{GRank1_event_begin}/g, 'Finished <!-- ');
			localHtml=localHtml.replace(/{GRank1_event_end}/g, '--> ');
			} else {
			localHtml=localHtml.replace(/{GRank1_event_begin}/g, ' ');
			localHtml=localHtml.replace(/{GRank1_event_end}/g, ' ');
			}
		} else if (gp == 2) {
			if (flag == 0){
			localHtml=localHtml.replace(/{GRank2_event_begin}/g, 'Finished <!-- ');
			localHtml=localHtml.replace(/{GRank2_event_end}/g, '--> ');
			} else {
			localHtml=localHtml.replace(/{GRank2_event_begin}/g, ' ');
			localHtml=localHtml.replace(/{GRank2_event_end}/g, ' ');
			}
		} else if (gp == 3) {
			if (flag == 0){
			localHtml=localHtml.replace(/{GRank3_event_begin}/g, 'Finished <!-- ');
			localHtml=localHtml.replace(/{GRank3_event_end}/g, '--> ');
			} else {
			localHtml=localHtml.replace(/{GRank3_event_begin}/g, ' ');
			localHtml=localHtml.replace(/{GRank3_event_end}/g, ' ');
			}
		} else if (gp == 4) {
			if (flag == 0){
			localHtml=localHtml.replace(/{GRank4_event_begin}/g, 'Finished <!-- ');
			localHtml=localHtml.replace(/{GRank4_event_end}/g, '--> ');
			} else {
			localHtml=localHtml.replace(/{GRank4_event_begin}/g, ' ');
			localHtml=localHtml.replace(/{GRank4_event_end}/g, ' ');
			}
		}
		document.body.innerHTML = localHtml;
	}
	
	function resizeTable( group, place){
		if ( group == 1){
			if ( place == 0){
				//document.getElementById("resultTable").deleteRow(0);
				//document.getElementById("resultTable").deleteRow(1);
			} else 
			if ( place == -1 ){
				document.getElementById("resultTable").deleteRow(1);
			}
		}
		else
		if ( group > 1 && group<= 4){
			if ( place == 0){
				var entry = (group-1) *2;
				document.getElementById("resultTable").deleteRow(entry+1);
				document.getElementById("resultTable").deleteRow(entry);
			} 
		} else {
			    // More than 4 groups?
		}
	}
	
	// place = 0 is initial state for Cal event. User should remove this usage when finalResult came in.
	function finalResult(group, place, champ, champ_name)	{
		var localHtml = document.body.innerHTML;
		if (group == 1){
			if (place <= 0){ 
			localHtml=localHtml.replace(/{GRank1_event_begin}/g, ' ');
			localHtml=localHtml.replace(/{GRank1_event_end}/g, ' ');
			} else {
				if (place == 1){
				localHtml=localHtml.replace(/{GroupRank1_champion}/g, champ);
				localHtml=localHtml.replace(/{GroupRank1_champion_names}/g, champ_name);	
				} else 
				if (place == 2){
				localHtml=localHtml.replace(/{GroupRank1_runnerup}/g, champ);
				localHtml=localHtml.replace(/{GroupRank1_runnerup_names}/g, champ_name);
				}
				localHtml=localHtml.replace(/{GRank1_event_begin}/g, 'Finished <!-- ');
				localHtml=localHtml.replace(/{GRank1_event_end}/g, '--> ');
			}
		} else
		if ( group == 2){
			if ( place <= 0){
				localHtml=localHtml.replace(/{GRank2_event_begin}/g, ' ');
				localHtml=localHtml.replace(/{GRank2_event_end}/g, ' ');
			} else { 
			if ( place == 1){	
			localHtml=localHtml.replace(/{GroupRank2_champion}/g, champ);
			localHtml=localHtml.replace(/{GroupRank2_champion_names}/g, champ_name);
			} else
			if ( place == 2){			
			localHtml=localHtml.replace(/{GroupRank2_runnerup}/g, champ);
			localHtml=localHtml.replace(/{GroupRank2_runnerup_names}/g, champ_name);
			}
			localHtml=localHtml.replace(/{GRank2_event_begin}/g, 'Finished <!-- ');
			localHtml=localHtml.replace(/{GRank2_event_end}/g, '--> ');
				}
		} else 
		if (group == 3){
			if ( place <= 0){
				localHtml=localHtml.replace(/{GRank3_event_begin}/g, ' ');
				localHtml=localHtml.replace(/{GRank3_event_end}/g, ' ');
			} else {
				if ( place == 1){	
				localHtml=localHtml.replace(/{GroupRank3_champion}/g, champ);
				localHtml=localHtml.replace(/{GroupRank3_champion_names}/g, champ_name);
				} else
				if ( place == 2){			
				localHtml=localHtml.replace(/{GroupRank3_runnerup}/g, champ);
				localHtml=localHtml.replace(/{GroupRank3_runnerup_names}/g, champ_name);
				}
				localHtml=localHtml.replace(/{GRank3_event_begin}/g, 'Finished <!-- ');
				localHtml=localHtml.replace(/{GRank3_event_end}/g, '--> ');
			}
		} else 
		if (group == 4){
			if ( place <= 0){
				localHtml=localHtml.replace(/{GRank4_event_begin}/g, ' ');
				localHtml=localHtml.replace(/{GRank4_event_end}/g, ' ');
			} else {
			if (place == 1){
				localHtml=localHtml.replace(/{GroupRank4_champion}/g, champ);
				localHtml=localHtml.replace(/{GroupRank4_champion_names}/g, champ_name);
			} else
			if ( place == 2){			
				localHtml=localHtml.replace(/{GroupRank4_runnerup}/g, champ);
				localHtml=localHtml.replace(/{GroupRank4_runnerup_names}/g, champ_name);
			}
			localHtml=localHtml.replace(/{GRank4_event_begin}/g, 'Finished <!-- ');
			localHtml=localHtml.replace(/{GRank4_event_end}/g, '--> ');
			}
		}
		document.body.innerHTML = localHtml;
		
		//Deal with resultTable, should be done AFTER innerHTML updated.
		//var tableHtml = document.getElementById("resultTable").innerHTML;
		resizeTable( group, place );
		//document.getElementById("resultTable").innerHTML = tableHtml;
	}
	
	


