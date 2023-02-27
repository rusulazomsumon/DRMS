<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "drms";

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
