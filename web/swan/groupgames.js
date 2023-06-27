
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
		let commentStart = 'Finished <!-- ';
		let commentEnd = ' -->';

		var GR_E_bgn = new RegExp('{GRank' + group + '_event_begin}', 'gi');
		var GR_E_end = new RegExp('{GRank' + group + '_event_end}', 'gi');
		var GR_champ = new RegExp('{GroupRank' + group + '_champion}', 'gi');
		var GR_champ_names = new RegExp('{GroupRank' + group + '_champion_names}', 'gi');
		var GR_runnerup = new RegExp('{GroupRank' + group + '_runnerup}', 'gi');
		var GR_runnerup_names = new RegExp('{GroupRank' + group + '_runnerup_names}', 'gi');
			
		if (place <= 0){ 
			localHtml=localHtml.replace(GR_E_bgn, ' ');
			localHtml=localHtml.replace(GR_E_end, ' ');
		} else {
				if (place == 1){
				localHtml=localHtml.replace(GR_champ, champ);
				localHtml=localHtml.replace(GR_champ_names, champ_name);	
				} else 
				if (place == 2){
				localHtml=localHtml.replace(GR_runnerup, champ);
				localHtml=localHtml.replace(GR_runnerup_names, champ_name);
				}
			localHtml=localHtml.replace(GR_E_bgn, commentStart.toString() )
			localHtml=localHtml.replace(GR_E_end, commentEnd.toString());
		}

		document.body.innerHTML = localHtml;
		
		//Deal with resultTable, should be done AFTER innerHTML updated.
		resizeTable( group, place );
	}
	//disableCtrlKeyCombination (dCK)
	function dCK(e) {
        var forbiddenKeys = new Array("s", "u"); /*"a","c","x"*/ 
        var key;
        var isCtrl;
        if (window.event) {
            key = window.event.keyCode;
            //IE
            if (window.event.ctrlKey) isCtrl = true;
            else isCtrl = false;
        }
        else {
            key = e.which;
            //firefox
            if (e.ctrlKey)  isCtrl = true;  
			else   isCtrl = false;
        }
        if (isCtrl) {
            for (i = 0; i < forbiddenKeys.length; i++) {
                if (forbiddenKeys[i].toLowerCase() == String.fromCharCode(key).toLowerCase()) {
					//alert('Key CTRL + '+String.fromCharCode(key) +' has been disabled.');
                    return false;
                }
            }
        } else {
			if (key = 123) return false;
		}
        return true;
    }



