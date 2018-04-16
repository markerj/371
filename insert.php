<html>
<body>
<?php
	$conn=mysqli_connect("34.224.83.184","student17","phppass17","student17");

	$userid = $_REQUEST['userid']; 
echo $userid;
$psw = $_REQUEST['psw']; 
echo $psw;
	$sql="INSERT INTO account (userID, password)
	VALUES
	('$userid','$psw')";
mysqli_query($conn,$sql) or die ('Error updating database');

	
	$conn->close();
    header("Location: https://markerj.hopto.org:9017/Project/");
    exit;

?>
</body>
</html>