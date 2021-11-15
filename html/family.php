<?php
session_start();
$validate = false;
$fnameSel = "";
$u_id = $_SESSION['u_id'];

if (isset($_POST["submitted1"]) && $_POST["submitted1"])
{
  $fn = trim($_POST["family"]);
  echo $fn;

  if($fn){
    $validate=true;
    echo "<br> new line 14 : ".$validate;
  }
  else{
    echo "<br>.line15 : ".$validate;
  }

  $db = new mysqli("localhost", "jse553", "Js#sql", "jse553");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }
       
  $p1 = "SELECT * FROM family WHERE fname='$fn'";
  $s1 = $db->query($p1);
  $pow1 = $s1->fetch_assoc();
  if($fn == $pow1["fname"]){
    $validate=false;
  }
  $email = $_SESSION['email'];
  if($validate == true)
  {

       $q2= "INSERT family (fname) VALUES ('$fn')";
       $r2 = $db->query($q2);
        
        if ($r2 === true)
        {
            $q1 = "SELECT * FROM family WHERE fname='$fn'";
            $r1 = $db->query($q1);
            $row1 = $r1->fetch_assoc();
            $fid= $row1['f_id'];
            $q2= "UPDATE users set f_id = $fid WHERE u_id = '$u_id'";
            $r2 = $db->query($q2);
            $_SESSION["f_id"]=$row1['f_id'];
            $_SESSION["fname"]= $fn;
            header("Location: glist.php");
            $db->close();
            exit();
        }
        else{
          echo "<br>r2 was false";
        }
    }
    else
    {
        $error = "Adding family is failed.";
        echo '<br/><br/>';
        echo $error;
        $db->close();
    }
}
if (isset($_POST["submitted"]) && $_POST["submitted"])
{
    $fnameSel = filter_input(INPUT_POST, "cfamily", FILTER_SANITIZE_STRING);
    echo $fnameSel."<br>";
    
    if($fnameSel){
      $validate=true;
      echo "<br>.line12 : ".$validate;
    }
    else{
      echo "<br>.line15 : ".$validate;
    }
    
    $db = new mysqli("localhost", "jse553", "Js#sql", "jse553");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }
       
    $q1 = "SELECT * FROM family WHERE fname='$fnameSel'";
    $r1 = $db->query($q1);
    $row1 = $r1->fetch_assoc();
    echo "<br>.line27: ".$row1['f_id'];
    $fid= $row1['f_id'];
    $email = $_SESSION['email'];
    echo "<br>30 ".$email;
    if($validate == true)
    {

       $q2= "UPDATE users set f_id = $fid WHERE u_id = '$u_id'";
       $r2 = $db->query($q2);
        
        if ($r2 === true)
        {
            $_SESSION["f_id"]=$row1['f_id'];
            $_SESSION["fname"]= $fnameSel;
            header("Location: glist.php");
            $db->close();
            exit();
        }
        else{
          echo "<br>r2 was false";
        }
    }
    else
    {
        $error = "Adding family is failed.";
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
  <title>Family page</title>
  <script src="https://kit.fontawesome.com/2adf8c3f23.js" crossorigin="anonymous"></script>
  <link href="../css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>
  <header>
    <h1><i class="fas fa-cookie-bite"></i>jsGroc</h1>
    <h2>Choose Family</h2>
  </header>

  <nav class="left">
    <ul>
      <li><a href="index.php">INDEX</a></li>
      <li><a class="active" href="family.php">Family</a></li>
      <li><a href="glist.php">Grocery list</a></li>
      <li><a href="postg.php">Post groceries</a></li>
      <li style="float:right"><a href="logout.php">Log out</a></li>
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
    <table>
      <tr>
        <td>
          <div class="left-form">
            <form action="family.php" method="POST">
              <table>
                <tr>
                  <td><label for="family">Family name:</label></td>
                  <td><input type="text" id="family" name="family" /></td>
                </tr>
              </table>
              <input type="submit" name="Create" value="Create">
              <input type="hidden" name="submitted1" value="1" />
            </form>
          </div>
        </td>
        <td>
          <div class="right-form">
            <form action="family.php" method="POST">
              <table>
                <tr>
                  <td><label for="cfamily">Choose or Change family:</label></td>
                  <td>
                    <select name="cfamily" id="cfamily">
                      <?php
                      {
                          $db = new mysqli("localhost", "jse553", "Js#sql", "jse553");
                          if ($db->connect_error)
                          {
                              die ("Connection failed: " . $db->connect_error);
                          }

                          $q= "SELECT DISTINCT fname FROM family ORDER BY fname ASC";

                          $r = $db->query($q);
                          while($row = $r->fetch_assoc()){
                            echo "<option value=".$row["fname"].">".$row["fname"]."</option>";
                          }
                          $db->close;
                      }

                      ?>
                    </select>
                </tr>
              </table>
              <input type="submit" name="Choose" value="Choose">
              <input type="hidden" name="submitted" value="1" />
            </form>
          </div>
        </td>
      </tr>
    </table>
  </section>

  <footer>
    <p>&copy; 2021 jsGroc. All rights reserved.</p>
  </footer>
</body>

</html>