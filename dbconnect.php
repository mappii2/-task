<?php
require_once('config.php');

$mysqli = new mysqli($localhost, $user, $password, $dbname);
if ($mysqli->connect_error) {
  error_log($mysqli->connect_error);
  exit;
}


?>
