<?php
/*
 * UserSpice 4
 * An Open Source PHP User Management System
 * by the UserSpice Team at http://UserSpice.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
?>
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
	Redirect::to ( "admin_users.php" );
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
                                                      
// Forms posted
if (! empty ( $_POST )) {
	// handle delete
	if (!empty($_POST['delete'])) {
		deleteDonation($donationId);
		echo "delete donation $donationId";
		Redirect::to("admin_user_donations.php?id=$userId");
		die;
	}
	
	$date = Input::get('date');
	$amount = Input::get('amount');
	$dtype = Input::get('dtype');
	$company = Input::get('company');
	$comment = Input::get('comment');
	$visibility = Input::get('visibility');
	$token = $_POST['csrf'];
	
	if (! Token::check ( $token )) {
		die ( 'Token doesn\'t match!' );
	} else {
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
				$fields=array(
						'date' => $date,
						'amount' => 
						Input::get('amount'),
						'dtype' => Input::get('dtype'),
						'company' => Input::get('company'),
						'comment' => Input::get('comment'),
						'visibility' => Input::get('visibility'),
						
				);
				$db = DB::getInstance();
				$db->update('donation', $donationId, $fields);
				Redirect::to ( "admin_user_donations.php?id=$userId");
		
		
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
		
	}
		
}


//
?>
<div id="page-wrapper">

	<div class="container">

<?=resultBlock($errors,$successes);?>
<?=$validation->display_errors();?>


<div class="row">
			
			<!--/col-2-->

			<div class="col-xs-12">
				<form class="form" name='adminUser'
					action='admin_user_donation.php?id=<?=$donationId?>' method='post'>

					<h3>Donation Information </h3>
					<div class="panel panel-default">
						<div class="panel-heading">Donor: <?= "$userdetails->fname $userdetails->lname" ?></div>
						<div class="panel-body">

									<div class="form-group">
										<div class="col-xs-6">
											<label> Date </label>
											<input class="form-control" type="text" name="date" id="date"
												placeholder="Date: 2017-01-01"
												value="<?=$date ?>"
												required autofocus>
										</div>
										<div class="col-xs-6">
											<label> $</label>
											<input type="text" class="form-control" id="amount"
												name="amount" placeholder="Amount"
												value="<?=money_format('%.2n', $amount)?>" 
												required>
										</div>
										
										<div class="col-xs-6">
											<label> &nbsp; </label>
											<select class="form-control" name="dtype" id="dtype" >
												<option value='0' <?= $dtype==0 ? "selected='selected'" : ""?>>Self</option>
												<option value='1' <?= $dtype==1 ? "selected='selected'" : ""?>>Match from Company</option>
											</select>
										</div>
										<div class="col-xs-6">
											<label> &nbsp; </label>
											<input class="form-control" type="text" name="company"
												id="company" placeholder="Company"
												value="<?=$company?>"
												>
										</div>
										<div class="col-xs-12">
											<label> &nbsp; </label>
											<input class="form-control" type="text" name="comment"
												id="comment" placeholder="Comment" value="<?=$comment?>">
										</div>

										<div class="col-xs-6">
											<label> &nbsp; </label>
											<select class="form-control" name="visibility" id="visibility" >
												<option value='0' <?= $visibility==0 ? "selected='selected'" : ""?> >Show to Public</option>
												<option value='1' <?= $visibility==1 ? "selected='selected'" : ""?>>Private</option>
											</select>
										</div>
										<div class="col-xs-3">
										<label> &nbsp; </label>
											<input class='btn btn-warning' type='submit'
												name='delete' value='delete' />
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
						href="<?="admin_user_donations.php?id=$userId"?>">Back</a><br>
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

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
