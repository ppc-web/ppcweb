
    function updateGameTitle(t) {
		document.body.innerHTML =
		document.body.innerHTML
		.replace(/{GAME_TITLE}/g, t);
    }
	function updateGameVenue(ad) {
		document.body.innerHTML =
		document.body.innerHTML
		.replace(/{GAME_VENUE}/g, ad);
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
	
	function updateGroupTitle( group, flag ){
		var localHtml = document.body.innerHTML;
		var GR_Title_b = new RegExp('{GRank' + group + '_Title_bgn}', 'gi');
		var GR_Title_e = new RegExp('{GRank' + group + '_Title_end}', 'gi');
		if (flag==0){
			localHtml=localHtml.replace(GR_Title_b, ' <!-- ');
			localHtml=localHtml.replace(GR_Title_e, ' --> ');
		}
		else{
			localHtml=localHtml.replace(GR_Title_b, ' ');
			localHtml=localHtml.replace(GR_Title_e, ' ');
		}
		document.body.innerHTML = localHtml;
	}
	
	function resizeGroupsTable(g1, g2, g3, g4, g5, g6){
		
		if ( g6 == '') {	
			document.getElementById("groupsTableID").deleteRow(6);
			updateGroupTitle(6,0); }
		else{
			updateGroupTitle(6,1);
			}
		if ( g5 == '') {	
			document.getElementById("groupsTableID").deleteRow(5);
			updateGroupTitle(5,0); }
		else{
			updateGroupTitle(5,1);
			}
		if ( g4 == '') {	
			document.getElementById("groupsTableID").deleteRow(4);
			updateGroupTitle(4,0); }
		else{
			updateGroupTitle(4,1);
			}
		if ( g3 == '') {
			document.getElementById("groupsTableID").deleteRow(3);
			updateGroupTitle(3,0); }
		else {
			updateGroupTitle(3,1);
			}
		if ( g2 == '') { 
			document.getElementById("groupsTableID").deleteRow(2);
			updateGroupTitle(2,0);
			}
		else {
			updateGroupTitle(2,1);
			}
		/* always has at least one group 😂 */
	}
	
/* replace 2nd level macros : <a href="https://www.google.com/calendar/render?action=TEMPLATE&text={GAME_TITLE}&dates={GRank4DateCal}T130000/{GRank4DateCal}T180000&details=Swan%20scheduled%20{GroupRank4}%20%F0%9F%98%89.%0ASee%20you%20soon.%20%F0%9F%91%8C&location=Address%3A%202600%20Lafayette%20Street%2C%20Santa%20Clara%2C%20CA%2C%2095050 "
target="_blank"> Google &#x1F4C5 Event </a>  &nbsp&nbsp&nbsp */
	function genCalMacros(gp){
		var gstr = 'https:\/\/www.google.com/calendar/render?action=TEMPLATE&text={GAME_TITLE}&dates={GRank' +gp+
		'DateCal}T130000/{GRank' +gp+ 'DateCal}T180000&details=Swan%20reminder%20{GroupRank' +gp+
		'}%20%F0%9F%98%89.%0ASee%20you%20soon.%20%F0%9F%91%8C&location={GAME_VENUE}';
		var ystr = 'http:\/\/calendar.yahoo.com/?v=60&view=d&type=20&TITLE={GAME_TITLE}&ST={GRank' +gp+
		'DateCal}T130000&ET={GRank' +gp+ 'DateCal}T180000&DESC=Swan%20reminder%20{GroupRank' +gp+
		'}%20%F0%9F%98%89.%0ASee%20you%20soon.%20%F0%9F%91%8C&in_loc={GAME_VENUE}';
		
		var GR_E_Google = new RegExp('{GRank' + gp + '_Google}', 'g');
		var GR_E_Yahoo = new RegExp('{GRank' + gp + '_Yahoo}', 'g');
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(GR_E_Google, gstr);
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(GR_E_Yahoo, ystr);
	}

    // Replace all the "placeholder" in the page with "doc_link"
    function updateGroups(title,g1, g2, g3, g4, g5, g6) {
		genCalMacros(1);
        document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank1}/g, g1);
		if (g2 != ''){
		genCalMacros(2);
        document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank2}/g, g2);
		}
		if (g3 != ''){
		genCalMacros(3);
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank3}/g, g3);
		}
        if (g4 != '') {
		genCalMacros(4);
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank4}/g, g4);
		}
		if (g5 != '') {
		genCalMacros(5);
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank5}/g, g5);
		}
		if (g6 != '') {
		genCalMacros(6);
		document.body.innerHTML=
            document.body.innerHTML
		    .replace(/{GroupRank6}/g, g6);
		}
        updateGameTitle(title);/*after all secondary Macros are generated*/
		
	    // h3 specific
/* 		document.getElementById('h3')
                .innerHTML = document.getElementById('h3')
                                     .innerHTML
		    .replace(/{GroupRank1}/gi, g1); */
			
		resizeGroupsTable( g1, g2, g3, g4, g5, g6);
    }


    function updateGroupsDate(d1,d1cal, d2,d2cal, d3,d3cal, d4,d4cal, d5,d5cal, d6,d6cal){
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
	    document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank5Date}/g, d5);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank5DateCal}/g, d5cal);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank6Date}/g, d6);
        document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank6DateCal}/g, d6cal);
    }
	
	/* 	Doc page id */	
	function updateGroupsPid(d1, d2, d3, d4, d5,d6) {
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
		
		document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank5DocPage}/g, d5);
			
	    document.body.innerHTML =
            document.body.innerHTML
		    .replace(/{GRank6DocPage}/g, d6);
	}
	
	
	function resizeTable( group, place){
		if ( group == 1){
			if ( place == 0){
				document.getElementById("resultTable").deleteRow(0);
				document.getElementById("resultTable").deleteRow(1);
			} else 
			if ( place == -1 ){
				document.getElementById("resultTable").deleteRow(1);
			}
		}
		else
		if ( group > 1 && group<= 6){
			if ( place == 0){
				var entry = (group-1) *2;
				// winner & runnerup placeholders
				document.getElementById("resultTable").deleteRow(entry+1);
				document.getElementById("resultTable").deleteRow(entry);
			} 
		} else {
			    // More than 4 groups?
		}
	}
	
	function resizeVideoTable(group, flag){
		if ( group >= 1 && group<= 6){
			if ( flag == 0){
				document.getElementById("videoTable").deleteRow(group-1);
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
	
	function finalVideo( group, flag, vlink, title ){
		var localHtml = document.body.innerHTML;
		var GR_V = new RegExp('{GRank' + group + 'Video}', 'g');
		var GR_VTITLE = new RegExp('{GRank' + group + 'VideoTitle}', 'g');
		if (flag==1){
			localHtml=localHtml.replace(GR_V, vlink);
			localHtml=localHtml.replace(GR_VTITLE, title);
		}
		document.body.innerHTML = localHtml;
		resizeVideoTable( group, flag );
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

//Deprecated by chrome
  function includeCustomHTML() {
  var z, i, elmnt, file, xhttp;
  /*loop through a collection of all HTML elements:*/
  z = document.getElementsByTagName("*");
  for (i = 0; i < z.length; i++) {
    elmnt = z[i];
    /*search for elements with a certain atrribute:*/
    file = elmnt.getAttribute("include-custom-html");

    if (file) {
		alert(file);
      /*make an HTTP request using the attribute value as the file name:*/
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if (this.status == 200) {elmnt.innerHTML = this.responseText; alert("Text="+this.responseText);}
          if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
          /*remove the attribute, and recursively call this function once more:*/
          elmnt.removeAttribute("include-custom-html");
          includeCustomHTML();
        }
      }      
      xhttp.open("GET", file, true);
      xhttp.send();
      /*exit the function:*/
      return;
    }
  }
}


