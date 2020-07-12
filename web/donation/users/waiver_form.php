<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php

    $userId = $user->data ()->id;
    if (isset($_POST['waiver_checkbox'])) {
        updateUsers('waiver_signed', 1, $userId, NULL);
	    Redirect::to($us_url_root.'index.php');
    }

?>

<div id="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="jumbotron">
                    <form action="waiver_form.php" method="post">
                        <h4> To continue, please read our waiver:
                        <a href=http://www.swanpp.com/images/waiver.pdf target="_blank">www.swanpp.com/images/waiver.pdf</a></h4>

	                    <div class="alluinfo">&nbsp;</div>
	                    <h4>Check this box to show that you have read and agreed to the terms on the waiver: </h4>

	                    <div class="alluinfo">&nbsp;</div>
	                    <input type="checkbox" id="waiver_checkbox" name="waiver_checkbox" class="form-control">
                        <br>
	                    <button class="submit btn btn-primary " type="submit" id="next_button"><i class="fa fa-plus-square"></i> Submit</button>
	                    <div class="alluinfo">&nbsp;</div>

	                </form>
	            </div>
	        </div>
        </div>
    </div>
</div>




<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

    <!-- Place any per-page javascript here -->
<script src="js/search.js" charset="utf-8"></script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>