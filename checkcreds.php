<html>
<body>
<?php
session_start();
	$conn=mysqli_connect("34.224.83.184","student17","phppass17","student17");

	$userid = $_REQUEST['userident']; 
echo $userid;
$psw = $_REQUEST['passw']; 
echo $psw;
/*
	$sql="INSERT INTO account (userID, password)
	VALUES
	('$userid','$psw')";
*/
    $query=mysqli_query($conn,"SELECT * FROM account WHERE userID='$userid' && password='$psw'");
    $count=mysqli_num_rows($query);
	echo "count: " . $count;
    $row=mysqli_fetch_array($query);

 if ($count==1)
    {
        
        $_SESSION['userid'] = $userid;
        header("location: index2.php");
		exit;
		
        }
    else
    {
	$_SESSION['error_message'] = "error";
       	header("location: index.php");	
		exit;
    }   
	
    mysqli_close($conn);
   
	
?>

</body>
</html>