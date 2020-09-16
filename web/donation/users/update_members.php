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
	$start = Input::get('start');
	$expire = Input::get('expire');
	$memberType = Input::get('memberType');
	$token = $_POST['csrf'];


	if(!Token::check($token)){
		die('Token doesn\'t match!');
	}
    $form_valid=FALSE; // assume the worst
    $validation = new Validate();
    $validation->check($_POST,array(
    	'start' => array(
					'display' => 'Start',
					'required' => true,
					'date' => true,
    	),
    	'expire' => array(
					'display' => 'Expire',
					'required' => true,
					'date' => true,
    	),
    ));
	if($validation->passed()) {
    		$form_valid=TRUE;

		try {
		    updateMembershipDetails($userId, $memberType, 2, $start, $start, $expire);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}

?>

<div id="page-wrapper">

	<div class="container">

		<!-- Page Heading -->
		<div class="row">

			<div class="col-xs-12 col-md-6">
				<h2>Membership Information of <?=$userdetails->fname . " " . $userdetails->lname?></h2>
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
									<h4 class="form-signin-heading">Change Membership Information</h4>
									<div class="form-group row">
										<div class="col-xs-3">
											<input class="form-control" type="text" name="start" id="date"
												placeholder="Start: 2020-01-31"
												value="<?php if (!$form_valid && !empty($_POST)){ echo $start;} ?>"
												required autofocus>
										</div>
										<div class="col-xs-3">
											<input type="text" class="form-control" id="date"
												name="expire" placeholder="Expire: 2021-01-31"
												value="<?php if (!$form_valid && !empty($_POST)){ echo $expire;}  ?>"
												required>
										</div>
										<div class="col-xs-3">
											<select class="form-control" name="memberType" id="mtype">
												<option value='1'>Swan Friend</option>
												<option value='2'>Swan Friend and Family</option>
												<option value='3'>Swan Sponsor</option>
												<option value='4'>Monthly Membership</option>
												<option value='5'>Swan Honor Member</option>
											</select>
										</div>
										<div class="col-xs-2">
                                        	<input class='btn btn-primary' type='submit'
                                        	name='changeMembership' value='Update' />
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
                                                <th> Membership Type</th>
                                                <th> Status</th>
                                                <th> Request Date</th>
                                                <th> Start Date</th>
                                                <th> Expiration Date</th>
											</tr>
										</thead>
										<tbody>
					            <tr>
					                <?php
                                		if ($userdetails->membership_status>0) {
                                		    echo "<td>".fetchMembership($userdetails->membership)->membership_type."</td>";
                                			echo "<td>".fetchMembershipStatus($userdetails->membership_status)->mem_status."</td>";
                                		    if ($userdetails->membership_status>=2) {
                                			    echo "<td>".$userdetails->mem_date_requested."</td>";
                                			    echo "<td>".$userdetails->mem_date_accepted."</td>";
                                			    echo "<td>".$userdetails->mem_date_expire."</td>";
                                		    }
                                		} else {
                                			echo "<td> N/A </td>";
                                			echo "<td>".fetchMembershipStatus($userdetails->membership_status)->mem_status."</td>";
                                			echo "<td> --- </td>";
                                			echo "<td> --- </td>";
                                			echo "<td> --- </td>";
                                		}
                                	?>
					            </tr>

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
