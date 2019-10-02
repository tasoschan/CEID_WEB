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
    <title>Καλώς Ήρθατε | Admin</title>
    <link rel="stylesheet" href="adminHpageStyle.css">
</head>
<style>
    @media only screen and (max-width: 900px){
    #photo img {
        display: block;
        margin-left: 30px;
        margin-right: auto;
        margin-top: 2px;
    }

    #options h3{
    font-size: 35px;
    margin-left: 175px;
    margin-top: -170px;
}
  }
    </style>
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
        <h3>Eπιλέξτε Ενέργεια: </h3>
        <button class="collapsible">Διαχείριση Βάσης Δεδομένων</button>
        <div class="content">
            <nav>
                <ul>
                    <li><a href="storing_data.php">Φόρτωση χαρτογραφικών δεδομένων στο σύστημα</a></li>
                    <li><a href="delete_data.php">Διαγραφή δεδομένων</a></li>
                </ul>
            </nav>
        </div>  
        <nav>
            <ul>
                <li><a href="map.php">Απεικόνιση και διαχείρηση χάρτη</a></li>
                <li><a href="admin_map_color.php">Εκτέλεση Εξομοίωσης</a></li>

            </ul>
        </nav>
    </section>
    
    <footer>
        <p>e-parkadoros, Copyright &copy; 2019</p>
    </footer>
    <script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
        });
    }
</script>
</body>
</html>