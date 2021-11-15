<?php
$validate = true;
$title ="";
$desc ="";
$qty =0;

if (isset($_POST["submitted"]) && $_POST["submitted"])
{
    $title = trim($_POST["title"]);
    $desc = trim($_POST["desc"]);
    $qty = trim($_POST["qty"]);
    
    $db = new mysqli("localhost", "jse553", "Js#sql", "jse553");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }

    if($title == null || $title == "") 
    {
        $validate = false;
        echo "<br>title wrong";
    }
    if($desc == null || $desc == "") 
    {
        $validate = false;
        echo "<br>desc wrong";
    }
    if($qty == null || $qty < 0) 
    {
        $validate = false;
        echo "<br>qty wrong";
    }

    if($validate == true)
    {
      session_start();
      $uid =$_SESSION['u_id'];
      $fid =$_SESSION['f_id'];
      $date = date('Y-m-d H:i:s');

       $q2= "INSERT INTO glist (u_id, f_id, title, descript, dt, qty) VALUES ($uid, $fid, '$title', '$desc', '$date', $qty)";

       echo $uid."<br>";
       echo $fid."<br>";
       echo $title."<br>";
       echo $desc."<br>";
       echo $date."<br>";
       echo $qty."<br>";

        $r2 = $db->query($q2);
        
        if ($r2 === true)
        {
            header("Location: glist.php");
            $db->close();
            exit();
        }
        else{
           echo "Query failed.";
        }
    }
    else
    {
        $error = "Grocery post failed.";
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
    <title>Post Groceries</title>
    <script src="https://kit.fontawesome.com/2adf8c3f23.js" crossorigin="anonymous"></script>
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/postg-validate.js"></script>
  </head>
  <body>
    <header>
      <h1><i class="fas fa-cookie-bite"></i>jsGroc</h1>
      <h2>Post Groceries</h2>
    </header>
    
    <nav class="left">
      <ul>
        <li><a href="index.php">INDEX</a></li>
        <li><a href="family.php">Family</a></li> 
        <li><a href="glist.php">Grocery list</a></li> 
        <li><a class="active"  href="postg.php">Post groceries</a></li>
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
      <form id="Additem" action="postg.php" method="POST">
        <table>
          <tr>
            <td><label >Title :</label></td>
            <td><input type="text" id="title" name="title" /><span id="msg_title" class="err_msg"></span></td>
          </tr>
          <tr>
            <td><label >Description :</label></td>
            <td><input type="text" id="desc" name="desc" /><span id="msg_desc" class="err_msg"></span></td>    
          </tr>
          <tr>
            <td><label >Quantity : </label></td>
            <td><input type="number" id="qty" name="qty"><span id="msg_qty" class="err_msg"></span></td>
          </tr>
        </table>
      <input type="submit" value="Add item" />
      <input type="hidden" name="submitted" value="1" />
      </form>
    </section>
    
    <script type="text/javascript" src="../js/postg-r.js"></script>
    <footer>
     <p>&copy; 2021 jsGroc. All rights reserved.</p>
    </footer>

  </body>
</html>