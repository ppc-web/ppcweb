<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>



<?php

$limit = empty ( $_REQUEST["filter"] ) ? 10 :  $_REQUEST["filter"];

$userData = fetchTopDonations($limit,NULL);// Fetch top donations

$userData2 = fetchTopDonations($limit,"year");

?>

<div id="page-wrapper">

	<div class="container">

		<!-- Page Heading -->
		<div class="row">

		    <div class="col-xs-12 col-md-2">
        				<h3>
        				<form class="" method="GET" >
        					<select name="filter" onchange="this.form.submit()">
        						<option value='10' <?= ($limit==10) ? "selected" : "" ?>> Top 10 </option>
        						<option value='30' <?= ($limit==30) ? "selected" : "" ?>> Top 30 </option>
        						<option value='50' <?= ($limit==50) ? "selected" : "" ?>> Top 50 </option>
        						<option value='100' <?= ($limit==100) ? "selected" : "" ?>> Top 100 </option>
                          	</select>
        				</form>
        				</h3>
        			</div>

			<div class="col-xs-12 col-md-6">
				<h2>Honorary Page</h2>
			</div>


        </div>

		<div class="row">

			<div class="col-xs-12">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#allTime">All Time</a></li>
					<li><a data-toggle="tab" href="#pastYear">Past Year</a></li>
				</ul>
			</div>
		</div>

		<div class="tab-content">
			<div id="allTime" class="tab-pane fade in active">
				<div class="row">
					<div class="col-xs-12">
						<div class="allutable table-responsive">
							<table class='table table-hover table-list-search'>
								<thead>
									<tr>
										<th>Name</th>
                                        <th>Total Donation</th>
									</tr>
								</thead>

								<tbody>
					<?php
                        // Cycle through users
                        foreach ( $userData as $v1 ) {
                            if ($v1->amt == 0)
                                continue;
                            ?>
                                    <tr>
                                             <td><?=$v1->fname?> <?=$v1->lname?> </td>
                                             <td>$<?=money_format('%.0n', $v1->amt)?></td>

                                        </tr>
                                <?php } ?>

				  </tbody>
							</table>
						</div>

					</div>

				</div>
			</div>
			<div id="pastYear" class="tab-pane fade in">
				<div class="row">
					<div class="col-xs-12">
						<div class="alluinfo">&nbsp;</div>
						<div class="allutable table-responsive">
							<table class='table table-hover table-list-search'>
								<thead>
									<tr>
										<th>Name</th>
                                       <th>Total Donation</th>
									</tr>
								</thead>
								<tbody>
					<?php
					// Cycle through users
					foreach ( $userData2 as $v1 ) {
						if ($v1->amt == 0)
                              continue;
						?>
					<tr>
										<td><?=$v1->fname?> <?=$v1->lname?> </td>
                                        <td>$<?=money_format('%.0n', $v1->amt)?></td>
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

