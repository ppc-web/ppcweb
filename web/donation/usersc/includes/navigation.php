<?php
?>

<div class="collapse navbar-collapse navbar-top-menu-collapse navbar-left"> <!-- Left navigation items -->
	<ul class="nav navbar-nav ">
		<li><a href="<?=$us_url_root?>"><i class="fa"></i> My PPC Donations</a></li>
		<?php if (checkMenu(2,$user->data()?->id)){  //Links for permission level 2 (default admin) ?>

		<li><a href="<?=$us_url_root?>users/admin_users.php"><i class="fa"></i> Manage Users</a></li>
		<!-- <li><a href="<?=$us_url_root?>users/memberRequests.php"><i class="fa"></i> Member Requests </a></li> -->
		<li><a href="<?=$us_url_root?>users/report.php"><i class="fa"></i> Report </a></li>


		<?php } ?>

		<li><a href="<?=$us_url_root?>users/honorary_page.php"><i class="fa"></i> Honorary Page </a></li>
<!-- Custom menus. Uncomment or copy/paste to use
		<li class="dropdown"><a class="dropdown-toggle" href="" data-toggle="dropdown"><i class="fa fa-wrench"></i> Custom 1 <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="<?=$us_url_root?>"><i class="fa fa-wrench"></i> Item 1</a></li>
				<li><a href="<?=$us_url_root?>"><i class="fa fa-wrench"></i> Item 2</a></li>
				<li><a href="<?=$us_url_root?>"><i class="fa fa-wrench"></i> Item 3</a></li>
			</ul>
		</li>
		
		<li class="dropdown"><a class="dropdown-toggle" href="" data-toggle="dropdown"><i class="fa fa-wrench"></i> Custom 2 <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="<?=$us_url_root?>"><i class="fa fa-wrench"></i> Item 1</a></li>
				<li><a href="<?=$us_url_root?>"><i class="fa fa-wrench"></i> Item 2</a></li>
				<li><a href="<?=$us_url_root?>"><i class="fa fa-wrench"></i> Item 3</a></li>
			</ul>
		</li>
		
		<li><a href="/"><i class="fa fa-home"></i> Other</a></li>
                              -->
	</ul>
</div>	 <!-- End left navigation items -->	

<?php
?>