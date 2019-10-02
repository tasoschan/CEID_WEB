<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>e-Parkadoros! | Home</title>
    <link rel="stylesheet" href="arxikiStyle.css">
</head>
<body style="background:url(back.jpg); background-repeat:no-repeat;background-size:100% 100%; height:auto; background-attachment:fixed">
<style>
@media only screen and (max-width: 330px) {
    header .logo img{
        width: 250px;
        margin: 0;
        float: left;
        }
    }
</style>
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
    
    <div id="wrapper">
        <form action='forma.php'>
            <button type="Admin_btn" id="button1" >Είσοδος Διαχειριστή</button>
        </form>
        <form action="user_map.php">
            <button type="Guest_btn" id="button2">Λειτουργία Επισκέπτη</button>
        </form>
    </div>

    
    <footer>
        <p>e-parkadoros, Copyright &copy; 2019</p>
    </footer>
   
</body>
</html>