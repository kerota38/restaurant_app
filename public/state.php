<?php
session_start();
// javascriptから送られてきたクエリを変数に代入
$latitude =  $_POST['latitude']; 
$longitude = $_POST['longitude'];
$_SESSION["lat"]=$latitude;
$_SESSION["lng"]=$longitude;
$response = null;
$json = json_encode($response);
echo ($json);