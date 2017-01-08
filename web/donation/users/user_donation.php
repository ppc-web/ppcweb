<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
$donationId = Input::get ( 'id' );
// Check if selected user exists
if (! donationIdExists ( $donationId )) {
	Redirect::to ( "../index.php" );
	die ();
}

$donationDetails = fetchDonationDetails($donationId);
$date = $donationDetails->date;
$amount = $donationDetails->amount;
$dtype = $donationDetails->dtype;
$company = $donationDetails->company;
$comment = $donationDetails->comment;
$visibility = $donationDetails->visibility;

$userId = $donationDetails->user_id;
$userdetails = fetchUserDetails ( NULL, NULL, $userId); // Fetch user details

$loggedInUserId = $user->data()->id;
if ($loggedInUserId!=$userId) {
	// not your donation. You cannot access it.
	Redirect::to ( "../index.php" );
	die ();
	
}

// Forms posted
if (! empty ( $_POST )) {
	$visibility = Input::get('visibility');
	$token = $_POST['csrf'];
	
	if (! Token::check ( $token )) {
		die ( 'Token doesn\'t match!' );
	} else {
			try {
				$fields=array(
						'visibility' => Input::get('visibility'),
						
				);
				$db = DB::getInstance();
				$db->update('donation', $donationId, $fields);
				Redirect::to ( "../index.php");
		
		
			} catch (Exception $e) {
				die($e->getMessage());
			}
		
		
	}
		
}
?>

<div id="page-wrapper">

	<div class="container">

		<div class="row">
			
			<!--/col-2-->

			<div class="col-xs-12">
				<form class="form" name='adminUser'
					action='user_donation.php?id=<?=$donationId?>' method='post'>

					<h3>Donation Information </h3>
					<div class="panel panel-default">
						<div class="panel-heading">Donor: <?= "$userdetails->fname $userdetails->lname" ?>
						&nbsp; Donation Id: <?=$donationId ?> 
						</div>
						<div class="panel-body">

									<div class="form-group">
										<div class="col-xs-6">
											<label> Date </label>
											<input class="form-control" type="text" name="date" id="date"
												placeholder="Date: 2017-01-01"
												value="<?=$date ?>"
												disabled autofocus>
										</div>
										<div class="col-xs-6">
											<label> $</label>
											<input type="text" class="form-control" id="amount"
												name="amount" placeholder="Amount"
												value="<?=money_format('%.2n', $amount)?>" 
												disabled>
										</div>
										
										<div class="col-xs-6">
											<label> &nbsp; </label>
											<select class="form-control" name="dtype" id="dtype" disabled>
												<option value='0' <?= $dtype==0 ? "selected='selected'" : ""?>>Self</option>
												<option value='1' <?= $dtype==1 ? "selected='selected'" : ""?>>Match from Company</option>
											</select>
										</div>
										<div class="col-xs-6">
											<label> &nbsp; </label>
											<input class="form-control" type="text" name="company"
												id="company" placeholder="Company"
												value="<?=$company?>"
												disabled >
										</div>
										<div class="col-xs-12">
											<label> &nbsp; </label>
											<input class="form-control" type="text" name="comment"
												id="comment" placeholder="Comment" value="<?=$comment?>" disabled>
										</div>

										<div class="col-xs-6">
											<label> &nbsp; </label>
											<select class="form-control" name="visibility" id="visibility" >
												<option value='0' <?= $visibility==0 ? "selected='selected'" : ""?> >Show to Public</option>
												<option value='1' <?= $visibility==1 ? "selected='selected'" : ""?>>Private</option>
											</select>
										</div>
										<div class="col-xs-3">
										
										</div>

										<div class="col-xs-3">
										<label> &nbsp; </label>
											<input class='btn btn-primary' type='submit'
												name='edit' value='edit' />
										</div>
										

									</div>

						</div>
					</div>

					<input type="hidden" name="csrf" value="<?=Token::generate();?>" />
					<a class='btn btn-info'
						href="<?="../../index.php"?>">Back</a><br>
					<br>

				</form>

			</div>
			<!--/col-9-->
		</div>
		<!--/row-->

	</div>
</div>



<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->




