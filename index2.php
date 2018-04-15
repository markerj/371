?PHP
//var_dump($_POST);
/*
$url = $_POST['launch_presentation_return_url'];
$query=parse_url($url,PHP_URL_QUERY);
parse_str($query, $out);
$course_id=$out['course_id'];
$course_title=$_POST['context_title'];
$course_batchUID=$_POST['context_label'];
$user_id=$_POST['user_id'];
$name=$_POST['lis_person_name_full'];
//replacement for the Constant public $HOSTNAME =
preg_match_all('/\//', $url,$matches, PREG_OFFSET_CAPTURE);
$clientURL = substr($url, 0, $matches[0][2][1]);
*/
//echo "Welcome $name.  Your course is $course_title ($course_batchUID).<br /><br /><br />";

$course_id=$_GET['course_id'];
$clientURL="http://bb.dataii.com:8080";

require_once('classes/Rest.class.php');
require_once('classes/Token.class.php');
$rest = new Rest($clientURL);
$token = new Token();
$token = $rest->authorize();

$access_token = $token->access_token;
//$course = $rest->readCourse($access_token, $course_id);
//var_dump($course);
//echo $user_id;
$user_id = '_45_1';


$user = $rest->readUser($access_token, $user_id);
$c = $user->results;

echo "user is hardcoded, user_id:" .  $user_id;
echo " <br /> ";

$courseList=array();
foreach($c as $row) {

        //echo $row->courseId;
        array_push($courseList,$row->courseId);
        $course = $rest->readCourse($access_token, $row->courseId);
        echo "course id: " . $row->courseId . "   name of course: " . $course->name . "<br />";
        //$membership = $rest->readMembership($access_token, $course_id);
}

$usersList = array();
for($i=0; $i<count($courseList);$i++) {
$membership = $rest->readMembership($access_token,$courseList[$i] );
$c = $membership->results;
echo "Users in course " . $courseList[$i] . ":<br /> ";
foreach($c as $row) {
        echo $row->userId;
$usersList[] =  $row->userId;
}
echo " <br /> ";
}





foreach($c as $row) {
//      echo $row->userId; ;

}

//var_dump($membership);
//die();
$columns = $rest->readGradebookColumns($access_token, $course_id);
$c=$columns->results;
//print_r($c);
foreach($c as $row)
{
        // echo $row->name;
        if($row->name == "Weighted Total") {
//      echo "another col";
}
        //if ($row->externalGrade == 1)
        if ($row->name == "Weighted Total")
        {
         $finalGradeName=$row->name;
         $finalGradeID=$row->id;
        //$finalPossible=$row->score->possible;
         break;
        }

}

//echo $finalGradeName . " " . $finalGradeID;
$grades = $rest->readGradebookGrades($access_token, $course_id, $finalGradeID);
$g=$grades->results;

foreach($g as $row)
{

       // echo " User ID:" . $row->userId . " has " .$row->score." out of ".$finalPossible . " points.";

}

?>



