<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>
<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>
<?php
$error_message = null;
$errors = array();
$email_sent=FALSE;

$validation = new Validate();
//PHP Goes Here!
$errors = [];
$successes = [];
$userId = Input::get('id');
//Check if selected user exists
if(!userIdExists($userId)){
  Redirect::to("admin_users.php"); die();
}

$fuser = new User($userId);

if ($fuser->exists ()) {
	
	$email = $fuser->data()->email;
	$options = array (
			'fname' => $fuser->data ()->fname,
			'email' => rawurlencode ( $email ),
			'vericode' => $fuser->data ()->vericode 
	);
	$subject = 'Register your account';
	$encoded_email = rawurlencode ( $email );
	$body = email_body ( '_email_invite.php', $options );
	//echo "$email<br/> $subject <br/> $body <br/> $email";
	$email_sent = email( $email, $subject, $body );
	if (! $email_sent) {
		$errors [] = 'Email NOT sent due to error. Please contact site administrator.';
	} else {
		updateInviteSentAt($userId);
	}
} else {
	$errors [] = 'That user does not exist in our database.';
}
?>

<div id="page-wrapper">
<div class="container">
<?php

if($email_sent){
	require 'views/_invite_sent.php';
}else{
	resultBlock($errors,$successes);
	$validation->display_errors();
}

?>
</div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- footer -->
<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>

