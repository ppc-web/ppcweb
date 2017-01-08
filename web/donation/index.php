<?php

if(file_exists("install/index.php")){
	//perform redirect if installer files exist
	//this if{} block may be deleted once installed
	header("Location: install/index.php");
}

require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';
?>

<?php 
if($user->isLoggedIn()) {
	$userId = $user->data()->id;

	//Fetch user details
	$userdetails = fetchUserDetails(NULL, NULL, $userId); 
	
	//Fetch all donations from this user
	$userData = fetchAllUserDonations($userId); 
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
												<td><a href='users/user_donation.php?id=<?=$v1->id?>'>#<?=$v1->date?></a></td>
												<td>$<?=money_format('%.2n', $v1->amount)?></td>
												<td><?=($v1->dtype==1) ? $v1->company : "" ?></td>
												<td><?=$v1->comment?></td>
												<td><?=($v1->visibility==0 ? "Show to public" : "Private") ?></td>
												<td> <a href='users/donation_receipt.php?id=<?=$v1->id?>'> <?=$v1->id?> </a></td>
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
  

	

<?php } else{?>
<div id="page-wrapper">
<div class="container">
<div class="row">
	<div class="col-xs-12">
		<div class="jumbotron">
			<p>

				<h2>Ping Pong Community</h2>
				<p>Donation Management System <?php //print_r($_SESSION);?></p>
				<a class="btn btn-warning" href="users/login.php" role="button">Log In &raquo;</a>
				<!--a class="btn btn-info" href="users/join.php" role="button">Sign Up &raquo;</a-->
			</p>
		</div>
	</div>
</div>
<?php } ?>



</div> <!-- /container -->

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
