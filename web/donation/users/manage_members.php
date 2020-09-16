<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>



<?php
    // fecth all members
    $userData=fetchUserMembershipDetails(2, "mem_date_accepted");

    $expiredUser=fetchUserMembershipDetails(3, "mem_date_accepted");
?>

<div id="page-wrapper">

  <div class="container">

    <!-- Page Heading -->
    <div class="row">
	    <div class="col-xs-12 col-md-6">
		<h1>Manage Members</h1>
	    </div>
    </div>
<div class="row">
        <div class="col-xs-12">
				 <div class="alluinfo">&nbsp;</div>
				 <?php if (count($userData)>0) { ?>
				 <div class="allutable table-responsive">
					<table class='table'>
					<thead>
					<tr>
						<th width="15%">Username</th>
						<th width="16%">Name</th>
						<th width="24%">Email</th>
						<th width="25%">Membership Type</th>
						<th width="10%">Date Accepted</th>
						<th width="10%">Date Expire</th>
					 </tr>
					</thead>
				 <tbody>
					<?php
					//Cycle through users
					foreach ($userData as $v1) {
                    ?>
                    <tr>
                    <td><a href='update_members.php?id=<?=$v1->id?>'><?=$v1->username?></a></td>
					<td><?=$v1->fname?> <?=$v1->lname?></td>
					<td><?=$v1->email?></td>

					<td> <?php echo fetchMembership($v1->membership)->membership_type;?> </td>
					<td> <?=$v1->mem_date_accepted?></td>
					<td> <?=$v1->mem_date_expire?></td>
					</tr>
						<?php } ?>

				    </table>
				    </div>
						<?php
					}
					else {
                        echo "You have no membership requests."." Click "."<a href='<?=$us_url_root?>users/admin_users.php'>"."here</a>
                              to return to the User Management page."."<br><br><br>";
                        }?>

				  </tbody>

		  </div>
		</div>

</div>
</div>




<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->
<script src="js/search.js" charset="utf-8"></script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>