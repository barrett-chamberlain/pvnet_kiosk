<?php
include('_lib.php');
include('./_includes/connect.php');
$sql = "UPDATE timestamp SET logged_in=0 WHERE 0=0";
 if ($conn->query($sql) === TRUE) {

    }
echo 'all users logged out';
?>