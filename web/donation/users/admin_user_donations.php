<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
$validation = new Validate ();
// PHP Goes Here!
$errors = [ ];
$successes = [ ];
$form_valid=TRUE;
$userId = Input::get ( 'id' );
// Check if selected user exists
if (! userIdExists ( $userId )) {
	Redirect::to ( "admin_users.php" );
	die ();
}

$userdetails = fetchUserDetails(NULL, NULL, $userId); //Fetch user details

//Forms posted
if (!empty($_POST)) {
	$date = Input::get('date');
	$amount = Input::get('amount');
	$dtype = Input::get('dtype');
	$company = Input::get('company');
	$comment = Input::get('comment');
	$token = $_POST['csrf'];
	
	if(!Token::check($token)){
		die('Token doesn\'t match!');
	}
	
	$form_valid=FALSE; // assume the worst
	$validation = new Validate();
	$validation->check($_POST,array(
			'date' => array(
					'display' => 'Date',
					'required' => true,
					'date' => true,
			),
			'amount' => array(
					'display' => 'Amount',
					'required' => true,
					'is_numeric' => true,
					
			),
	));
	
	if($validation->passed()) {
		$form_valid=TRUE;
		try {
			echo "Trying to create donation";
			$fields=array(
					'date' => Input::get('date'),
					'amount' => Input::get('amount'),
					'dtype' => Input::get('dtype'),
					'company' => Input::get('company'),
					'comment' => Input::get('comment'),
					'user_id' => $userId,
					'created_by' => $user->data()->id,
					'created_at' => date("Y-m-d H:i:s")
			);
			$db->insert('donation', $fields);
			$theNewId=$db->lastId();
			bold($theNewId);
	
	
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	
}

$userData = fetchAllUserDonations($userId); //Fetch all donations from this user

?>

<div id="page-wrapper">

	<div class="container">

		<!-- Page Heading -->
		<div class="row">

			<div class="col-xs-12 col-md-6">
				<h2>Donations from <?=$userdetails->fname . " " . $userdetails->lname?></h2>
			</div>

			<div class="row">
				<div class="col-md-12">
          <?php
										
										echo resultBlock ( $errors, $successes );
										?>

							 <hr />
					<div class="row">
						<div class="col-xs-12">
               <?php
															if (! $form_valid && Input::exists ()) {
																echo display_errors ( $validation->errors () );
															}
															?>
               <form class="form-horizental"
								action="<?php echo $_SERVER['PHP_SELF']."?id=$userId";?>" method="POST"
								id="payment-form">

								<div class="well well-sm">
									<h4 class="form-signin-heading">Add a Donation</h4>
									<div class="form-group row">
										<div class="col-xs-3">
											<input class="form-control" type="text" name="date" id="date"
												placeholder="Date: 2017-01-01"
												value="<?php if (!$form_valid && !empty($_POST)){ echo $date;} ?>"
												required autofocus>
										</div>
										<div class="col-xs-2">
											<input type="text" class="form-control" id="amount"
												name="amount" placeholder="Amount"
												value="<?php if (!$form_valid && !empty($_POST)){ echo $amount;} ?>"
												required>
										</div>
										<div class="col-xs-2">
											<select class="form-control" name="dtype" id="dtype">
												<option value='0'>Self</option>
												<option value='1'>Match from Company</option>
											</select>
										</div>
										<div class="col-xs-3">
											<input class="form-control" type="text" name="company"
												id="company" placeholder="Company"
												value="<?php if (!$form_valid && !empty($_POST)){ echo $company;} ?>"
												>
										</div>
										<div class="col-xs-2">
											<select class="form-control" name="visibility" id="visibility">
												<option value='0'>Show to Public</option>
												<option value='1'>Private</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										
										<div class="col-xs-10">
											<input class="form-control" type="text" name="comment"
												id="comment" placeholder="Comment">
										</div>

										<div class="col-xs-2">
											<input class='btn btn-primary' type='submit'
												name='addUserDonation' value='Add Donation' />
										</div>
										

									</div>

									 <input type="hidden"
										value="<?=Token::generate();?>" name="csrf">
								</div>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="alluinfo">&nbsp;</div>
							<form name="adminUserDonations"
								action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
								<div class="allutable table-responsive">
									<table class='table table-hover table-list-search'>
										<thead>
											<tr>
												<th>Date</th>
												<th>Amount</th>
												<th>Match from Company</th>
												<th>Comment</th>
												<th> Privacy </th>
												<th> Receipt </th>
											</tr>
										</thead>
										<tbody>
					<?php
					// Cycle through users
					foreach ( $userData as $v1 ) {
						?>
					<tr>
												<td><a href='admin_user_donation.php?id=<?=$v1->id?>'><?=mysql2DateString($v1->date)?></a></td>
												<td>$<?=money_format('%.2n', $v1->amount)?></td>
												<td><?=($v1->dtype==1) ? $v1->company : "" ?></td>
												<td><?=$v1->comment?></td>
												<td><?=($v1->visibility==0 ? "Show to public" : "Private") ?></td>
												<?php if (!isMatch($v1->dtype, $v1->company)) { ?>
												<td> <a href='donation_receipt.php?id=<?=$v1->id?>'> <?=$v1->id?> </a></td>
												<?php } else { ?>
												<td> </td>
												<?php } ?>
												
											</tr>
							<?php } ?>

				  </tbody>
									</table>
								</div>


								<br>
							</form>

						</div>
					</div>

				</div>
			</div>

		</div>
		</div>
		<!-- End of main content section -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
