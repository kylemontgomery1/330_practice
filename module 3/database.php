<?php
// Content of database.php

$mysqli = new mysqli('localhost', 'kyle', '5746M3rc3d3s', 'news');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>