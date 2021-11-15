<?php

$validate = true;
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";

$email = "";
$error = "";

if (isset($_POST["submitted"]) && $_POST["submitted"])
{
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    
    $db = new mysqli("localhost", "jse553", "Js#sql", "jse553");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }

    $q= "SELECT * FROM users WHERE (email = '$email') AND (pswd = '$password')";

       
    $r = $db->query($q);
    $row = $r->fetch_assoc();
    $fid=$row["f_id"];
    if($email != $row["email"] && $password != $row["pswd"])
    {
        $validate = false;
    }
    else
    {
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false)
        {
            $validate = false;
        }
        
        $pswdLen = strlen($password);
        $passwordMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen < 6 || $passwordMatch == false)
        {
            $validate = false;
        }
    }
    
    if($validate == true)
    {
        $q2= "SELECT * FROM family WHERE f_id = $fid";
        $r2 = $db->query($q2);
        $row2 = $r2->fetch_assoc();
        session_start();
        $_SESSION["email"] = $row["email"];
        $_SESSION["uname"] = $row["uname"];
        $_SESSION["u_id"] = $row["u_id"];
        $_SESSION["f_id"] = $row["f_id"];

        $_SESSION["fname"] = $row2["fname"];
        header("Location: family.php");
        $db->close();
        exit();
    }
    else 
    {
        $error = "The email/password combination was incorrect. Login failed.";
        echo $email.'<br> :email';
        echo $password.'<br> :pswd';
        echo $error;
        $db->close();
    }
}

?>


<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width">
  <title>User Login</title>
  <script src="https://kit.fontawesome.com/2adf8c3f23.js" crossorigin="anonymous"></script>
  <link href="../css/style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="../js/login-validate.js"></script>
</head>

<body>
  <header>
    <h1><i class="fas fa-cookie-bite"></i>jsGroc</h1>
    <h2>User Login</h2>
  </header>

  <nav class="left">
    <ul>
      <li><a class="active" href="login.php">Log in</a></li>
      <li><a href="signup.php">Sign up</a></li>
      <li style="float:right"><a href="#">
      <?php
      session_start();
      if(isset($_SESSION["uname"])){
        echo $_SESSION['uname'];
      }
      else echo "User-name";
      ?>
      </a></li>
      <li style="float:right"><a href="#">
      <?php
      session_start();
      if(isset($_SESSION["fname"])){
        echo $_SESSION['fname'];
      }
      else echo "Family-name";
      ?>
      </a></li>
    </ul>
  </nav>

  <section>
  <form id="fLogin" action="login.php" method="post">
      <input type="hidden" name="submitted" value="1" />
      <table>
        <tr>
          <td><label>Username :</label></td>
          <td><input type="email" id="uname" name="email" value="" /></td>
          <td><span id="msg_email" class="err_msg "></span></td>
        </tr>
        <tr>
          <td><label>Password : </label></td>
          <td><input type="password" id="pswd" name="password" /></td>
          <td><span id="msg_pswd" class="err_msg"></span></td>
        </tr>
      </table>

      <input type="submit" value="Login" />
      <input type="reset" value="Reset" />
    </form>
    <a href="signup.php ">Create a new account</a>
  </section>

  <script type="text/javascript" src="../js/login-r.js"></script>

  <footer>
    <p>&copy; 2021 jsGroc. All rights reserved.</p>
  </footer>
</body>

</html>