<?php
$db = DB::getInstance();
$query = $db->query("SELECT * FROM email");
$results = $query->first();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <p>Hi, Dear <?=$fname;?> <?=$lname;?>,</p>
    <p>Here is your donation receipt. Thanks for your generous contribution to Ping Pong Community!</p>

  </body>
</html>
