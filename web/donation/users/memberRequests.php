<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php

// Array ( [approve] => Array ( [id] => id ) [Submit] => Approve All )
    if (!empty($_POST['approve'])) {
        foreach ($_POST['approve'] as $id) {
            $mem_request=fetchMembershipDetails($id)->membership;
            updateMembership($id, $mem_request, 2);
        }
    }


?>

<style>
.buttonGreen {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>

<?php
    $userData=fetchRequestsAndUserDetails();
?>
<div id="page-wrapper">

  <div class="container">

    <!-- Page Heading -->
    <div class="row">
	    <div class="col-xs-12 col-md-6">
		<h1>Membership Requests</h1>
	    </div>
    </div>
<div class="row">
        <div class="col-xs-12">
				 <div class="alluinfo">&nbsp;</div>
				<form name="membershipAccept" action="memberRequests.php" method="post">
				 <?php if (count($userData)>0) { ?>
				 <div class="allutable table-responsive">
					<table class='table'>
					<thead>
					<tr>
						<th width="5%">Approve</th>
						<th width="15%">Username</th>
						<th width="16%">Name</th>
						<th width="24%">Email</th>
						<th width="25%">Membership Requested</th>
						<th width="15%">Date Requested</th>
					 </tr>
					</thead>
				 <tbody>
					<?php
					//Cycle through users
					foreach ($userData as $v1) {
                    ?>
                    <tr>
                    <td><div class="form-group"><input type="checkbox" name="approve[<?=$v1->id?>]" value="<?=$v1->id?>"/></div></td>
					<td><a href='admin_user.php?id=<?=$v1->id?>'><?=$v1->username?></a></td>
					<td><?=$v1->fname?> <?=$v1->lname?></td>
					<td><?=$v1->email?></td>

					<td> <?php echo fetchMembership($v1->membership)->membership_type;?> </td>
					<td> <?=$v1->date_requested?></td>
					</tr>
						<?php } ?>

				    </table>
				    </div>
                <input class='buttonGreen' style= "width:100%"type='submit' name='Submit' value='Approve' /><br><br>
						<?php
					}
					else {
                        echo "You have no membership requests."." Click "."<a href='<?=$us_url_root?>users/admin_users.php'>"."here</a>
                              to return to the User Management page."."<br><br><br>";
                        }?>

				  </tbody>
			</form>

		  </div>
		</div>

</div>
</div>




<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->
<script src="js/search.js" charset="utf-8"></script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>