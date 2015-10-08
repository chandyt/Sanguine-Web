
<?
if( $_POST )
{


  //mysql_select_db("inmoti6_mysite", $con);	
  $users_name = $_POST['name'];
  $users_email = $_POST['email'];
  $users_address = $_POST['address'];
  $users_phone = $_POST['phone'];
  $users_UserName = $_POST['username'];  
  $users_password = $_POST['password'];
  $users_type = $_POST['type'];

  /*$users_name = mysql_real_escape_string($users_name);
  $users_email = mysql_real_escape_string($users_email);
  $users_website = mysql_real_escape_string($users_website);
  $users_comment = mysql_real_escape_string($users_comment);*/
  $query = "
  INSERT INTO `Sanguine`.`UserDetail` (`Name`, `Address`, `PhoneNumber`, `Email`,
        `UserName`) VALUES ('$users_name',
        '$users_address', '$users_phone', '$users_email',
        '$users_UserName');";		
  mssql_query($query);
  echo "<h2>Thank you for your Comment!</h2>";

  mysql_close($con);
}
?>
