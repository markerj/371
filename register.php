<!DOCTYPE html>
<html>
<?php
session_start();
if(isset($_SESSION['error_message2'])){
     $message = "Username already taken.\\nTry again.";
  echo "<script type='text/javascript'>alert('$message');</script>";
   unset($_SESSION['error_message2']);
}
?>

<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>
<body>
<form name="credentials" action="insert.php" method="post" onsubmit="return validatePass()">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>User ID</b></label>
    <input type="text" placeholder="Enter User ID" name="userid" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
    <label id="errorlabel" style="color:red"></label>

    <div class="clearfix">

      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button> 

    </div>
  </div>
</form>

</body>
     <script>
function validatePass() {
    var pass1 = document.forms["credentials"]["psw"].value;
    var pass2 = document.forms["credentials"]["psw-repeat"].value;   
    if (pass1 != pass2) {
       document.getElementById('errorlabel').innerHTML = 'Passwords must match.';
	return false;
    }
}

function cancel(){
    window.location.replace("index.php");
}
</script>
</html>

