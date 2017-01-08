<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>


<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
$validation = new Validate ();
// PHP Goes Here!
$errors = [ ];
$successes = [ ];
$donationId = Input::get ( 'id' );
// Check if selected user exists
if (! donationIdExists ( $donationId )) {
	Redirect::to ( "../index.php" );
	die ();
}

$donationDetails = fetchDonationDetails ( $donationId );
$date = $donationDetails->date;
$amount = $donationDetails->amount;
$dtype = $donationDetails->dtype;
$company = $donationDetails->company;
$comment = $donationDetails->comment;
$visibility = $donationDetails->visibility;

$userId = $donationDetails->user_id;
$userdetails = fetchUserDetails ( NULL, NULL, $userId ); // Fetch user details

$loggedInUserId = $user->data ()->id;
if ($loggedInUserId != $userId) {
	// not your donation. You cannot access it.
	Redirect::to ( "../index.php" );
	die ();
}

?>
<div id="page-wrapper">

	<div class="container">


		<div id="pdf" class="row">
			<div class="col-xs-1">
			</div>
			<div class="col-xs-10">
				<h3>Charitable Donation Receipt</h3>
				<p>Issued on: <?php echo date("M d, Y")?></p>
				<p>
					Ping Pong Community <br /> 3273 Falerno Way 
					<br />San Jose, CA
					95135 
					<br />Tel: 408-915-7464 
					<br />Email: pingpong.community@gmail.com
					<br />EIN#: 81-2451936
				</p>

				<p>
					We acknowledge, with thanks, the receipt of following contributions
					from <b> <?=$userdetails->fname?> <?=$userdetails->lname?></b>:
				
				
				<table>
					<thead>
						<tr>
							<th>No.</th>
							<th>Receipt #</th>
							<th>Contribution Date</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td> <?=$donationDetails->id?></td>
							<td> <?=$donationDetails->date?></td>
							<td> $<?=money_format('%.2n', $donationDetails->amount)?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td><b> Total </b></td>
							<td> $<?=money_format('%.2n', $donationDetails->amount)?></td>
						</tr>
					</tbody>
				</table>
				<p>No benefit was bestowed upon this donor in exchange for these
					contributions.</p>
				<p>Ping Pong Community is an exempt organization as described in
					Section 501(c)(3) of the Internal Revenue Code.</p>

				<p>Sincerely,</p>
				<p>
					<img src='../images/yj-signature.png'>
				</p>
				<p>
					Yongjun Liu <br />CFO, Ping Pong Community
				</p>
			</div>
		</div>
			
		<hr/>
		<div class="row">
			<div class="col-xs-3">
			
				<input class='btn btn-primary' type='button'
					name='print' value='Print' onclick="print()"> 
			</div>
			
		</div>
		<br/>

	</div>
</div>



<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<script src="../js/jspdf.debug.js"></script>
<script src="../js/from_html.js"></script>
<script src="../js/autoprint.js"></script>
<script src="../js/split_text_to_size.js"></script>
<script src="../js/standard_fonts_metrics.js"></script>
<script>
var specialElementHandlers = {
		'#editor': function(element, renderer){
			return true;
		}
	};
	
function print() {
	doc=new jsPDF();
	var options = { format : 'PNG' };
	doc.addHTML($('#pdf').get(0), 10, 35, options, function() {
		doc.output("dataurlnewwindow");
	});
	//var source = window.document.getElementsByTagName("body")[0];
	/*
	doc.setFontType("bold");
	doc.setFontSize(14);
	doc.text(20, 30, "Charitable Donation Receipt");

	doc.setFontType("normal");
	doc.setFontSize(11);
	
	doc.text(20, 36, 'Issued on  <?php echo date("M d, Y")?>');

	doc.setFontType("bold");
	doc.text(20, 50, 'Ping Pong Community');

	doc.setFontType("normal");
	doc.text(20, 56, '3273 Falerno Way');
	doc.text(20, 62, 'San Jose, CA 95135');
	doc.text(20, 68, 'Tel: 408-915-7464');
	doc.text(20, 76, 'Email: pingpong.community@gmail.com');
	doc.text(20, 84, 'EIN#: 81-2451936');

	debugger;
	doc.text(20, 100, 'We acknowledge, with thanks, the receipt of following contributions from');
	
	doc.text(' Xingang Huang');
	*/		
	
	console.log("I'm here");
	
	//doc.autoPrint();
	
}
</script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

