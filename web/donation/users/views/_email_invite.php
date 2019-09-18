<?php
$db = DB::getInstance();
$query = $db->query("SELECT * FROM email");
$results = $query->first();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <p>Dear Donor <?=$fname;?>,</p>
    <p>Thanks for your donation to Ping Pong Community. We have created an account for you to review your donations and print your donation receipts.</p>

    <p>Please click the link below to continue set your password and start to use your account.</p>
    <p><a href="<?php echo $results->verify_url."users/invite_reset.php?email=".$email."&vericode=$vericode&reset=1"; ?>">Set Your Password</a></p>
    <p>Sincerely,</p>
    <p>- Ping Pong Community-</p>
  </body>
</html>
