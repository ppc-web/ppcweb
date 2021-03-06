<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>


<?php
$timeFilter = empty ( $_REQUEST["filter"] ) ? "" :  $_REQUEST["filter"];

$userData = fetchAllUsers (); // Fetch information for all users
                              
// fetch the total donations of all users.
$totalDonations = fetchTotalDonationsPublic ($timeFilter);

// fetch the latest donations of all users.
$latestDonations = fetchLatestDonationsPublic ($timeFilter);

// sort user data by last donation date.
function cmpLastDonationDate($u1, $u2) {
	return strcmp ( $u2->lastDonationDate, $u1->lastDonationDate );
}

// fill in total donation, last donation and last donate date for each user.
$userArray = array ();
$total = 0;
foreach ( $userData as $v1 ) {
	$v1->totalDonation = empty ( $totalDonations ["$v1->id"] ) ? 0 : $totalDonations ["$v1->id"];
	$total += $v1->totalDonation;
	if (! empty ( $latestDonations ["$v1->id"] )) {
		$v1->lastDonation = $latestDonations ["$v1->id"]->amount;
		$v1->lastDonationDate = $latestDonations ["$v1->id"]->date;
	} else {
		$v1->lastDonation = 0;
		$v1->lastDonationDate = "";
	}
	$userArray ["$v1->id"] = $v1;
}
usort($userData, "cmpLastDonationDate");

$donations = fetchAllDonationsPublic ($timeFilter);
function cmpDonation($u1, $u2) {
	if ($u1->id >= 10140 || $u2->id >= 10140) {
		return $u2->id - $u1->id;
	}
	return strcmp ( $u2->date, $u1->date );
}

// fill in username for each donation.
foreach ( $donations as $d1 ) {
	$u = $userArray ["$d1->user_id"];
	$d1->username = "$u->username";
}

usort ( $donations, "cmpDonation" );
?>

<div id="page-wrapper">

	<div class="container">

		<!-- Page Heading -->
		<div class="row">

			<div class="col-xs-12 col-md-2">
				<h3>
				<form class="" method="GET" >
					<select name="filter" onchange="this.form.submit()">
						<option value='All'> All Time</option>
						<option value='2016' <?= ($timeFilter=="2016") ? "selected" : "" ?> > 2016 </option>
						<option value='2017' <?= ($timeFilter=="2017") ? "selected" : "" ?> > 2017 </option>
						<option value='2018' <?= ($timeFilter=="2018") ? "selected" : "" ?> > 2018 </option>
						<option value='2019' <?= ($timeFilter=="2019") ? "selected" : "" ?> > 2019 </option>
                  	</select>
				</form>
				</h3>
			</div>
			<div class="col-xs-12 col-md-6">
				<h2>Donation: $<?= number_format($total, 0)?> </h2>
			</div>

        </div>
			
		<div class="row">

			<div class="col-xs-12">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#byDate">By Date</a></li>
					<li><a data-toggle="tab" href="#byUser">By User</a></li>
				</ul>
			</div>
		</div>

		<div class="tab-content">
			<div id="byDate" class="tab-pane fade in active">
				<div class="row">
					<div class="col-xs-12">
						<div class="allutable table-responsive">
							<table class='table table-hover table-list-search'>
								<thead>
									<tr>
										<th>Date</th>
										<th>Username</th>
										<th>Amount</th>
										<th>Match By</th>
									</tr>
								</thead>

								<tbody>
					<?php
					// Cycle through users
					foreach ( $donations as $v1 ) {
						?>
					<tr>
										<td><?=$v1->date?></td>
										<td><?=$v1->username?></td>
										<td>$<?=number_format($v1->amount, 0)?></td>
										<td> <?=($v1->dtype==1) ? $v1->company : ""?>
					</td>
									</tr>
							<?php } ?>

				  </tbody>
							</table>
						</div>

					</div>

				</div>
			</div>
			<div id="byUser" class="tab-pane fade in">
				<div class="row">
					<div class="col-xs-12">
						<div class="alluinfo">&nbsp;</div>
						<div class="allutable table-responsive">
							<table class='table table-hover table-list-search'>
								<thead>
									<tr>
										<th>Username</th>
										<th>Last Donate Date</th>
										<th>Last Donation</th>
										<th>Total Donation</th>
									</tr>
								</thead>
								<tbody>
					<?php
					// Cycle through users
					foreach ( $userData as $v1 ) {
						if ($v1->totalDonation == 0)
							continue;
						?>
					<tr>
										<td><?=$v1->username?></td>
										<td><?=$v1->lastDonationDate?></td>
										<td>$<?=money_format('%.0n', $v1->lastDonation)?></td>
										<td>$<?=money_format('%.0n', $v1->totalDonation)?></td>
									</tr>
							<?php } ?>

				  </tbody>
							</table>
						</div>


					</div>
				</div>
			</div>
		</div>

	</div>

</div>



<!-- End of main content section -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<script src="js/search.js" charset="utf-8"></script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
					
					