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
    <link rel="stylesheet" href="change_confStyle.css">
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
        <?php
        if(isset($_POST['save']))
{
	
	
	mysqli_query($con,"update polygons set population=$_POST[popul], parking_places=$_POST[places] where name='$_GET[id]'");
	mysqli_query($con,"update kampilizitisis set timi='$_POST[timiz]' where polygon_name='$_GET[id]' and timezone=$_POST[tmz]");
	
	
}	

	 $q=mysqli_query($con,"select * from polygons where name='$_GET[id]'");
	 $r=mysqli_fetch_array($q);
	 
	 echo "<div class=listes>
	 <h2>ID Πολυγώνου: $r[name]</h2>
	 <form action='' method=post>
	 Πληθυσμός: <input type=number value='$r[population]' name=popul><br>
	 Θέσεις για παρκάρισμα: <input type=number name=places value='$r[parking_places]'><br>";
	 
	 ?>
		
    Για την ώρα:<select name=tmz>
	<?php
	for ($i=0;$i<24;$i++)
		echo "<option value=$i>$i:00</option>";
	
	?>
	</select>
	<br>Ποσοστό στην καμπύλη ζήτησης:
	
	
	<input type=number step="0.01" name=timiz value='0'>
	
	<input type="submit"  value='Αποθήκευση' class='button' name=save>
</form>
	<?php
	echo "<span id='lowerheader'><h2>Τιμές:</h2></span>";
     $q=mysqli_query($con,"select * from kampilizitisis where polygon_name='$_GET[id]' order by timezone");
     $count = 0 ; //just for css purposes :D
	while( $r=mysqli_fetch_array($q))
	{
        if($count<13){
            echo "<span class='infos'>Ώρα:  $r[timezone]:00  | Τιμή ζήτησης=$r[timi]</span><br>";
            $count = $count + 1;
        }else {
            echo "<span class='infos2'>Ώρα:  $r[timezone]:00  | Τιμή ζήτησης=$r[timi]</span><br>";
        }

	}
	 
	?>

</div>

</div>  
    </section>
    
    <footer>
        <p>e-parkadoros, Copyright &copy; 2019</p>
    </footer>
    
</body>
</html>