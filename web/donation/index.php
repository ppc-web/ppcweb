<?php
if (file_exists ( "install/index.php" )) {
	// perform redirect if installer files exist
	// this if{} block may be deleted once installed
	header ( "Location: install/index.php" );
}

require_once 'users/init.php';
require_once $abs_us_root . $us_url_root . 'users/includes/header.php';
require_once $abs_us_root . $us_url_root . 'users/includes/navigation.php';
?>



<div id="page-wrapper">

	<div class="container">

<?php
if ($user->isLoggedIn ()) {
	$userId = $user->data ()->id;
	
	// Fetch user details
	$userdetails = fetchUserDetails ( NULL, NULL, $userId );
	
	// Fetch all donations from this user
	$userData = fetchAllUserDonations ( $userId );
	?>
		<!-- Page Heading -->
		<div class="row">

			<div class="col-xs-12 col-md-6">
				<h2>Donations from <?=$userdetails->fname . " " . $userdetails->lname?></h2>
			</div>

			<div class="row">
				<div class="col-md-12">


					<hr />
					<div class="row">
						<div class="col-xs-12">
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
														<th>Privacy</th>
														<th>Receipt</th>
													</tr>
												</thead>
												<tbody>
					<?php
	// Cycle through users
	foreach ( $userData as $v1 ) {
		?>
					<tr>
														<td><a href='users/user_donation.php?id=<?=$v1->id?>'><?=mysql2DateString($v1->date)?></a></td>
														<td>$<?=money_format('%.2n', $v1->amount)?></td>
														<td><?=($v1->dtype==1) ? $v1->company : "" ?></td>
														<td><?=$v1->comment?></td>
														<td><?=($v1->visibility==0 ? "Show to public" : "Private") ?></td>
												<?php if (!isMatch($v1->dtype, $v1->company)) { ?>
												<td><a href='users/donation_receipt.php?id=<?=$v1->id?>'> <?=$v1->id?> </a></td>
												<?php } else { ?>
												<td></td>
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
		</div>
		<!-- End of main content section -->






<?php } else{?>
<div class="row">
			<div class="col-xs-12">
				<div class="jumbotron">
					<p>
					
					
					<h2>Ping Pong Community</h2>
					<p>Donation Management System <?php //print_r($_SESSION);?></p>
					<a class="btn btn-warning" href="users/login.php" role="button">Log
						In &raquo;</a>
					<!--a class="btn btn-info" href="users/join.php" role="button">Sign Up &raquo;</a-->
					</p>
				</div>
			</div>
		</div>
		
<?php } ?>

		<div class="row">

			<div class="col-xs-12">
				<div class="jumbotron">
					<h3> * Note to our generous Donors</h3>
						<ol>
							<li>Your donation through Benevity will be recorded 1-2 months
								after you make the donation.
								<ul>
									<li>Benevity sends us the detailed report on 21st of the next
										month after you make your donation. This is when we can
										accurately record your donation amount, date and match.</li>
									<li>If you already have the Benevity receipt, you can send 
										us an email and we will record it after
										receiving the receipt.
									</li>
								</ul>
							</li>
							<li>We are sending out account activation email for you to
								register and manage your donation receipt.
								<ul>
									<li>Some providers, such as Yahoo,
										treat email coming from <a
										href="mailto: pingpong.community@gmail.com">
											pingpong.community@gmail.com</a> as a spam. If you are expecting an email from us, please check
											your spam folder regularly.
								
								</ul>
							</li>
							<li> If you find any errors or missings in our donation receipt, please send us an email so we can correct them.
							</li>
							<li> Our email address is: <a
										href="mailto: pingpong.community@gmail.com">
											pingpong.community@gmail.com</a>
							</li>
							
						</ol>
						<h4> We greatly appreciate your support to PPC and wish you a happy and fruitful year 2018! </h4>
				</div>
			</div>
		</div>



		<!-- /container -->

	</div>
	<!-- /#page-wrapper -->

	<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
