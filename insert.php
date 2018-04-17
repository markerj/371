<html>
<body>
<?php
session_start();
	$conn=mysqli_connect("34.224.83.184","student17","phppass17","student17");

	$userid = $_REQUEST['userid']; 
echo $userid;
$psw = $_REQUEST['psw']; 
echo $psw;

 $query=mysqli_query($conn,"SELECT * FROM account WHERE userID='$userid'");
    $count=mysqli_num_rows($query);
	echo "count: " . $count;
    $row=mysqli_fetch_array($query);

 if ($count==1)
    {
        
        $_SESSION['error_message2'] = "error";
       	header("location: register.php");	
		exit;		
        }
    else
    {
		$sql="INSERT INTO account (userID, password)
	VALUES
	('$userid','$psw')";
	mysqli_query($conn,$sql) or die ('Error updating database');
 	header("Location: index.php");
    	exit;

    }   
	$conn->close();
   

?>
</body>
</html>
