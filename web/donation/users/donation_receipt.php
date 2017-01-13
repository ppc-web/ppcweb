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

$token = Input::get('csrf');
if(Input::exists()){
	if(!Token::check($token)){
		die('Token doesn\'t match!');
	}
}



$donationDetails = fetchDonationDetails ( $donationId );
$date = $donationDetails->date;
$cdate = $donationDetails->created_at;
$amount = $donationDetails->amount;
$dtype = $donationDetails->dtype;
$company = $donationDetails->company;
$comment = $donationDetails->comment;
$donationId = $donationDetails->id;
$visibility = $donationDetails->visibility;

$userId = $donationDetails->user_id;
$userdetails = fetchUserDetails ( NULL, NULL, $userId ); // Fetch user details

$loggedInUserId = $user->data ()->id;
if ($loggedInUserId != $userId &&!checkMenu(2,$user->data()->id)) {
	// not your donation. You cannot access it.
	Redirect::to ( "../index.php" );
	die ();
}

//Forms posted
if (!empty($_POST) && !empty($_POST["email"])) {
	echo "sending email";
	$subject = "Your donation receipt #$donationId";
	$options = array(
			'fname' => $userdetails->fname,
			'lname' => $userdetails->lname,
	);
	$body =  email_body('_receipt.php',$options);
	$attachment = array(
			"data" => Input::get("pdfdata"),
			"filename" => receiptFileName($donationDetails, $userdetails) . "pdf",
			"encoding" => "base64", "type" => "application/pdf"
	);
	
	$email_sent=email($userdetails->email,$subject,$body, $attachment);
	
	if(!$email_sent){
		$errors[] = 'Email NOT sent due to error. Please contact site administrator.';
	} else {
		$successes[] ="Successfully sent receipt to $userdetails->email.";
	}
}

?>
<div id="page-wrapper">

	<div class="container">

			<div class="row">
				<div class="col-md-12">
          <?php
										
										echo resultBlock ( $errors, $successes );
										?>
		<div class="row">
			<div class="col-xs-3 text-center">
			<form class="form-signup" action="donation_receipt.php?id=<?=$donationId?>" method="POST" id="payment-form">
				<label> &nbsp; </label>
				<input class='btn btn-primary print-receipt' type='submit'
												name='print' value='Print' />
												<label>&nbsp;</label>
												
				<input class='btn btn-primary download-receipt' type='submit'
												name='download' value='Download' />
												<label>&nbsp;</label>
				<input class='btn btn-primary email-receipt' type='submit'
												name='email' value='Email' />
												<label>&nbsp;</label>
				<input type="hidden" id="pdfdata" name="pdfdata" value="Mickey Mouse">
				<input type="hidden" value="<?=Token::generate();?>" name="csrf">
			</form>
			</div>
			<div class="col-xs-9 text-center">
			<iframe class="preview-pane" type="application/pdf"  width="600" height="900" frameborder="0" style="position:relative;z-index:999">
			</iframe>
			</div>
			
		</div>
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

var doc;
	
function getDoc() {
	doc=new jsPDF('p', 'mm', 'letter');
	
	doc.setFontType("bold");
	doc.setFontSize(14);
	doc.text(25, 34, "Charitable Donation Receipt");

	doc.setFontType("normal");
	doc.setFontSize(11);
	
	doc.text(25, 40, 'Issued on: <?=mysql2DateString(substr($cdate, 0, 10))?>');

	doc.setFontType("bold");
	doc.text(25, 50, 'Ping Pong Community');

	doc.setFontType("normal");
	doc.text(25, 56, '3273 Falerno Way');
	doc.text(25, 62, 'San Jose, CA 95135');
	doc.text(25, 68, 'Tel: 408-915-7464');
	doc.text(25, 74, 'Email: pingpong.community@gmail.com');
	doc.text(25, 80, 'EIN#: 81-2451936');

	
	doc.text(25, 92, 'We acknowledge, with thanks, the receipt of following contributions from');

	doc.setFontType('bold');
	doc.text(150, 92, '<?php echo "$userdetails->fname $userdetails->lname"?>:');

	doc.setFontType('normal');
	doc.text(25, 102, 'No.');
	doc.text(105, 102, 'Receipt #', 'right');
	doc.text(145, 102, 'Contribution Date', 'right');
	doc.text(175, 102, 'Amount', 'right');
	doc.line(25, 106, 175, 106);

	doc.text(25, 112, '1');
	doc.text(105, 112, '<?=$donationId?>', 'right');
	doc.text(145, 112, '<?=mysql2DateString($date)?>', 'right');
	doc.text(175, 112, '$<?=money_format('%.2n', $amount)?>', 'right');


	doc.line(25, 134, 175, 134);
	doc.setFontType('bold');
	doc.text(145, 140, 'Total', 'right');
	doc.setFontType('normal');
	doc.text(175, 140, '$<?=money_format('%.2n', $amount)?>', 'right');

	doc.text(25, 150, "No benefit was bestowed upon this donor in exchange for these contributions.");
	
	doc.text(25, 160, "Ping Pong Community is an exempt organization as described in Section 501(c)(3) of the");
	doc.text(25, 166, "Internal Revenue Code.");
			
	doc.text(25, 178, "Sincerely,");

	var imageData = 'data:image/png;base64,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';
	doc.addImage(imageData, 25, 180);

	doc.text(25, 204, "Yongjun Liu");
	doc.text(25, 210, "CFO, Ping Pong Community");

	return doc;
	
}

function update() {
	doc = getDoc();
	setTimeout(function() {
		if (typeof doc !== 'undefined') try {
			if (navigator.msSaveBlob) {
				// var string = doc.output('datauristring');
				string = 'http://microsoft.com/thisdoesnotexists';
				console.error('Sorry, we cannot show live PDFs in MSIE')
			} else {
				var string = doc.output('bloburi');
				var blob = doc.output('blob');
			}
			$('.preview-pane').attr('src', string);
			var reader = new window.FileReader();
			reader.readAsDataURL(blob); 
			reader.onloadend = function() {
			                base64data = reader.result;                
			                console.log(base64data);
			    			$('#pdfdata').val(base64data);
			}
		} catch(e) {
			alert('Error ' + e);
		}
	}, 0);
}

var initDownload = function() {
	$('.download-receipt').click(function(){
		if (typeof doc !== 'undefined') {
			file = '<?php echo receiptFileName($donationDetails, $userdetails);
		?>';
			doc.save(file + '.pdf');
		} else {
			alert('Error 0xE001BADF');
		}
	});
	return false;
};


var initPrint = function() {
	$('.print-receipt').click(function(){
		doc.autoPrint();

		// need the follwing line of hack to make print work.
		doc.output("dataurlnewwindow");
	});
	return false;
}

update();
initDownload();
initPrint();
</script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

