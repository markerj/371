<head>
<script src="https://cis371a.hopto.org:9040/demo/Chart.bundle.js"></script>
<script src="https://cis371a.hopto.org:9040/demo/utils.js"></script>
<link rel="stylesheet" type="text/css" href="main.css"> 
</head>
<?PHP
session_start();
$user_id = $_SESSION['userid'];
//echo $user_id1;

require('nav.php');
$clientURL="http://bb.dataii.com:8080";
require_once('classes/Rest.class.php');
require_once('classes/Token.class.php');
$rest = new Rest($clientURL);
$token = new Token();
$token = $rest->authorize();
$access_token = $token->access_token;
//$user_id = '_45_1';
$user = $rest->readUser($access_token, $user_id);
$c = $user->results;
//echo "user is hardcoded, user_id:" .  $user_id;
//echo " <br /> ";
$courseList=array();
echo "<table class='table' >";
echo "<tr><th>Name</th><th>Description</th></tr>";
foreach($c as $row) {
		
	//echo $row->courseId;
	array_push($courseList,$row->courseId);
	$course = $rest->readCourse($access_token, $row->courseId);
       //echo "course id: " . $row->courseId . "   name of course: " . $course->name . "<br />";
       //$membership = $rest->readMembership($access_token, $course_id);
    	echo "<tr>";
       echo "<td>$course->name</td>";
       echo "<td>$course->courseId</td>";
       
	echo "</tr>";
}
echo "</table>";
$usersList = array();
for($i=0; $i<count($courseList);$i++) {
$membership = $rest->readMembership($access_token,$courseList[$i] );
$c = $membership->results;
//echo "Users in course " . $courseList[$i] . ":<br /> ";
foreach($c as $row) {
	//echo $row->userId;
	array_push($usersList,$row->userId);
}
//echo " <br /> ";
}
$commonusers = array();
$countarray = array_count_values($usersList);
foreach($countarray as $x => $x_value){
        //echo "Student: " . $x . ", Classes together: " . $x_value;
	if($x_value == count($courseList)) {
        array_push($commonusers,$x);
	}
        //echo "<br>";
}
$commonusersfname = array();
$commonuserslname = array();
for($i=0; $i<count($commonusers);$i++){

	//echo "common user" . $i . ": " . $commonusers[$i];
	$user = $rest->readUser2($access_token, $commonusers[$i]);
	
	echo $user->name->given;
	array_push($commonusersfname,$user->name->given);
	echo $user->name->family;
	array_push($commonuserslname,$user->name->family);
	echo "<br>";

}
	

?>
<?PHP
$bararray = array_fill(1, 6, 0);
foreach($countarray as $x => $x_value){
	if($x_value == 1){
		$bararray[1]++;
	}
	else if($x_value == 2){
		$bararray[2]++;
	}
	else if($x_value == 3){
		$bararray[3]++;
	}
	else if($x_value == 4){
		$bararray[4]++;
	}
	else if($x_value == 5){
		$bararray[5]++;
	}
	else if($x_value == 6){
		$bararray[6]++;
	}
}
?>
<div id="canvas-holder" style="width:40%">
        <canvas id="chart-area" />
    </div>
<script>
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };
    var config = {
        type: 'bar',
        data: {
            datasets: [{
                data: [
			<?PHP
			for($i = 1; $i < 7; $i++){
				echo $bararray[$i] . ",";
			}
			?>
             ],
                backgroundColor: window.chartColors.red,
                label: 'Dataset 1'
				}],				
            labels: [
                "Shares 1 class",
                "Shares 2 classes",
                "3",
                "4",
				"5",
				"6"
            ]
        },
        options: {
            responsive: true
        }
    };
    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myBar = new Chart(ctx, config);
    };
</script>


