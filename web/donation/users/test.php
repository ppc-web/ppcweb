<?php
if (file_exists ( "install/index.php" )) {
	// perform redirect if installer files exist
	// this if{} block may be deleted once installed
	header ( "Location: install/index.php" );
}

require_once 'init.php';
// require_once $abs_us_root . $us_url_root . 'includes/header.php';
// require_once $abs_us_root . $us_url_root . 'includes/navigation.php';

	$userId = $user->data ()->id;

	// Fetch user details
	$userdetails = fetchUserDetails ( NULL, NULL, $userId );

	// Fetch membership details
	$membershipDetails = fetchMembershipDetails ( $userId );

	// Fetch all donations from this user
	$userData = fetchAllUserDonations ( $userId );

// set membership

if (isset($_POST["membership"])) {
    print_r($_POST);
    $memRequest=$_POST["membership"];
    updateMembership($userId, $memRequest, 1);

} else{
    echo "no...";
}

?>