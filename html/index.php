<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Index</title>
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
      <li><a class="active" href="index.php">INDEX</a></li>
      <li><a href="family.php">Family</a></li>
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
    <?php
    //If nobody is logged in, display login and signup page.
    if(isset($_SESSION["email"]))
    {
      //If somebody is logged in, display a welcome message
      echo "Welcome, logged in as:  " .$_SESSION['email']. "<br />" ;	
      echo "User Name :  " .$_SESSION['uname']. "<br />" ;	
      echo "U_ID :  " .$_SESSION['u_id']. "<br />" ;
      echo "Family name :  " .$_SESSION['fname']. "<br />" ;
      echo "F_ID :  " .$_SESSION['f_id']. "<br />" ;	

      echo "<a href='family.php'>Family</a><br>";
      echo "<a href='postg.php'>Post groceries</a><br>";
      echo "<a href='glist.php'>Groceries List</a><br>";
      echo "<a href='logout.php'>Logout</a><br>";
    }

    else
    {	
      echo "<H3>Please Login or Sign up</h3>";
      echo "<a href='login.php'>Login</a><br>"; 
      echo "<a href='signup.php'>Signup</a>";	
    }
    ?>

  </section>


  <footer>
    <p>&copy; 2021 jsGroc. All rights reserved.</p>
  </footer>
</body>

</html>