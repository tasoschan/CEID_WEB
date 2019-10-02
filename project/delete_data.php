<?php 
include('dbcon.php');
include('session.php');


$result=mysqli_query($con, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);

 ?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Διαγραφή δεδομένων | Admin</title>
    <link rel="stylesheet" href="delete_dataStyle.css">
</head>
<body>
<header>
        <div class="container">
            <div id="branding">
                <h1>Parking...<br>στη στιγμή!</h1>
            </div>
            <div class="logo">
            <a href="adminHpage.php" >
                <img src="./LOGO.png"> 
                </a>  
            </div>
        </div>
    </header>
    <section id="WelcomeText">
        <h3 align="center">Καλώς Ήρθατε: <?php echo $row['name']; ?> </h3>
       
        <div id=logout>
        <nav>
            <ul>
                <li><a href="logout.php">Αποσύνδεση</a></li>
            </ul>
        </nav>
        </div>
    </section>
    <section id="options">
        <div id="photo">
            <img src="./gears.png" width="120" height="120"> 
        </div>
        <h2>Είστε σίγουροι; Όλα τα δεδομένα θα διαγραφoύν. </h2>        
    </section>
    <div id="boxes">
            <button class="buttons"><a href="delete_comp.php">Διαγραφή</a></button>
            <button class="buttons"><a href="adminHpage.php">Ακύρωση</a></button>
        </div>
    
    <footer>
        <p>e-parkadoros, Copyright &copy; 2019</p>
    </footer>
    
</body>
</html>