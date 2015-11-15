
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Sanguine</title>
    <link href="css/bootstrap.css" rel="stylesheet">

	</head>
<body>
<!-- Navigation Bar -->

<?php

if ( isset($_SESSION['UserName'],$_SESSION['Name'],$_SESSION['PhoneNumber'],$_SESSION['Email'],$_SESSION['Type'])){
	echo "Welcome to sanguine".$_SESSION['Name']."<br/>";
	//include"edit_field.html";

    $username= $_SESSION['UserName'] ;
	$name =  $_SESSION['Name'] ;
	$phonenumber = $_SESSION['PhoneNumber'] ;
	$email= $_SESSION['Email'] ;
	$type= $_SESSION['Type'] ;
  //  echo $username.",".$name.",".$phonenumber.",".$email.",".$type."<br/>" ;
    include 'result.html';
 }
else {
	echo " No data from the previous page";
}
?>
</body>


