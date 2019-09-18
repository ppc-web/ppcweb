function loadCommon(active) {
	$(function() {
		if (!active) {
			path = window.location.pathname;
			path = path.substring(path.lastIndexOf("/")+1);
			active = path.substring(0, path.lastIndexOf(".html"));
			console.log(active);
		}
		$("#header").load("header.html", 
			function() {
				$("#header-" +active).addClass("active");
		});
		$("#footer").load("footer.html", function() {
			$("#footer-" +active).addClass("active");
		});
	});
}