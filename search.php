
<?php 
include('dbconnect.php');

if($_POST)
{
	$searchId = $_POST['searchId']

// Select a database:
mssql_select_db('Sanguine') 
		    or die('Could not select a database.');

// Example query: (TOP 10 equal LIMIT 0,10 in MySQL)
$SQL = "SELECT * FROM [Sanguine].[dbo].[UserDetail]  
        where PhoneNumber = $searchId or UserName = $searchId "; 

// Execute query:
$result = mssql_query($SQL) 
    or die('A error occured: ' . mysql_error());

 
// Get result count:
$Count = mssql_num_rows($result);
print "Showing $count rows:<hr/>\n\n";   



// Fetch rows:
while ($Row = mssql_fetch_assoc($result)) {
 
    print $Row['Fieldname'] . "\n";


sqlsrv_close( $conn);
}

?>