<?php session_start(); ?>
<?php include('dbcon.php'); ?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Είσοδος διαχειριστή</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style="background:url(back.jpg); background-repeat:no-repeat;background-size:100% 100%; height:auto; background-attachment:fixed">
<style>
  @media only screen and (max-width: 323px) {
    .form-wrapper {
    width:250px;
    height:320px;
      position: absolute;
      top: 63%;
      left: 50%;
      margin: -184px 0px 0px -155px;
  background: rgba(0, 0, 0, 0.822);
  padding: 15px 25px;
  border-radius: 15px;
  box-shadow: 0px 1px 0px rgba(0,0,0,0.6),inset 0px 1px 0px rgba(255,255,255,0.04);
    }
    }</style>
<header>
        <div class="container">
            <div id="branding">
                <h1>Parking...<br>στη στιγμή!</h1>
            </div>
            <div class="logo">
            <a href="index.php" >
                <img src="./LOGO.png"> 
                </a> 
            </div>
        </div>
</header>
<div class="form-wrapper">
  
  <form action="#" method="post">
    <h3>Είσοδος διαχειριστή: </h3>
	
    <div class="form-item">
		<input type="text" name="user" required="required" placeholder="Όνομα χρήστη" autofocus required>
    </div>
    
    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Κωδικός πρόσβασης" required>
    </div>
    
    <div class="button-panel">
		<input type="submit" class="button" title="Log In" name="login" value="Εισοδος">
    </div>
  </form>
  <?php
	if (isset($_POST['login']))
		{
			$username = mysqli_real_escape_string($con, $_POST['user']);
			$password = mysqli_real_escape_string($con, $_POST['pass']);
			
			$query 		= mysqli_query($con, "SELECT * FROM users WHERE  password='$password' and username='$username'");
      
      $row		= mysqli_fetch_array($query);
			$num_row 	= mysqli_num_rows($query);
			
			if ($num_row > 0) 
				{			
					$_SESSION['user_id']=$row['user_id'];
					header('location:adminHpage.php');
					
				}
			else
				{
					echo '<span style="color:#FFF;text-align:center;">Λάθος κωδικός ή όνομα χρήστη</span>';
				}
		}
  ?>
   
  
</div>
<footer>
        <p>e-parkadoros, Copyright &copy; 2019</p>
    </footer>
</body>
</html>