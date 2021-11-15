<?php

$validate = true;

$name = "";
$email = "";
$pswd = "";
$pswdr = "";
$error = "";
$date = "yyyy/mm/dd";

$reg_name = "/^[a-zA-Z0-9_-]+$/";
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S+)?$/";
$reg_Dob = "/^\d{4}\/\d{1,2}\/\d{1,2}$/";

if (isset($_POST["submitted"]) && $_POST["submitted"])
{
    $name = trim($_POST["uname"]);
    $email = trim($_POST["email"]);
    $date = trim($_POST["dob"]);
    $pswd = trim($_POST["pswd"]);
    $pswdr = trim($_POST["pswdr"]);
    
    $db = new mysqli("localhost", "jse553", "Js#sql", "jse553");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }
       
    $q1 = "SELECT * FROM users WHERE email='$email'";
    $r1 = $db->query($q1);

    if($r1->num_rows > 0)
    {
        $validate = false;
    }
    else
    {
        $nameMatch = preg_match($reg_name, $name);
        if($name == null || $name == "" || $nameMatch == false)
        {
            $validate = false;
            echo "<br>name wrong";
        }
      
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false)
        {
            $validate = false;
            echo "<br>email wrong";
        }
              
        $pswdLen = strlen($pswd);
        $pswdMatch = preg_match($reg_Pswd, $pswd);
        if($pswd == null || $pswd == "" || $pswdLen< 6|| $pswdMatch == false)
        {
            $validate = false;
            echo "<br>pswd wrong";
        }

        $dobMatch = preg_match($reg_Dob, $date);
        if($date == null || $date == "")
        {
            $validate = false;
            echo "<br>dobMatch wrong";
        }

        if($pswdr !== $pswd)
        {
            $validate = false;
            echo "<br>pswdr wrong";
        }
    }

    if($validate == true)
    {
        $dateFormat = date("Y-m-d", strtotime($date));

       $q2= "INSERT INTO users (email, pswd, uname, dob) VALUES ('$email', '$pswd', '$name', '$dateFormat')";

        $r2 = $db->query($q2);
        
        if ($r2 === true)
        {
            header("Location: login.php");
            $db->close();
            exit();
        }
    }
    else
    {
        $error = "Email address is not available. Signup failed.";
        echo '<br/><br/>';
        echo $error;
        $db->close();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>User Sign Up</title>
  <script src="https://kit.fontawesome.com/2adf8c3f23.js" crossorigin="anonymous"></script>
  <link href="../css/style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="../js/signup-validate.js"></script>
</head>

<body>

  <header>
    <h1><i class="fas fa-cookie-bite"></i>jsGroc</h1>
    <h2>Create an account</h2>
  </header>

  <nav class="left">
    <ul>
      <li><a href="login.php">Log in</a></li>
      <li><a class="active" href="signup.php">Sign up</a></li>
      <li style="float:right"><a href="#">User-name</a></li>
      <li style="float:right"><a href="#">Family-name</a></li>
    </ul>
  </nav>

  <section>
    <form id="SignUp" action="signup.php" method="POST" enctype="multipart/form-data">
      <table>
        <tr>
          <td><label for="uname">Username :</label></td>
          <td><input type="text" id="uname" name="uname"/></td>
          <td><span id="msg_uname" class="err_msg"></span></td>
        </tr>

        <tr>
          <td><label for="email">Email :</label></td>
          <td><input type="email" id="email" name="email" /></td>
          <td><span id="msg_email" class="err_msg"></span></td>
        </tr>

        <tr>
          <td><label for="dob">Date of birth :</label></td>
          <td><input type="date" id="dob" name="dob" /></td>
          <td><span id="msg_dob" class="err_msg"></span></td>
        </tr>

        <tr>
          <td><label for="img">Upload avatar : </label></td>
          <td><input class="file-upload" type="file" id="img" accept="image/*" name="fileToUpload" /></td>
          <td><span id="msg_img" class="err_msg"></span></td>
        </tr>

        <tr>
          <td><label for="pswd">Password : </label></td>
          <td><input type="password" id="pswd" name="pswd" ></td>
          <td><span id="msg_pswd" class="err_msg"></span></td>
        </tr>

        <tr>
          <td><label for="pswdr">Confirm Password : </label></td>
          <td><input type="password" id="pswdr" name="pswdr" ></td>
          <td><span id="msg_pswdr" class="err_msg"></span></td>
        </tr>
      </table>
      <input type="submit" value="Signup">
      <input type="reset" value="Reset" />
      <input type="hidden" name="submitted" value="1" />
    </form>


    <a href="login.php">Log into an existing account</a>
  </section>

  <script type="text/javascript" src="../js/signup-r.js"></script>
  
  <footer>
    <p>&copy; 2021 jsGroc. All rights reserved.</p>
  </footer>
</body>

</html>