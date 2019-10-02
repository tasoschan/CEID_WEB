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
<title>Φόρτωση Δεδομένων | Admin</title>
<link rel="stylesheet" href="storing_dataStyle.css">
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
    <h2>Επιλέξτε κατάλληλο KML αρχείο: </h2>
    <form method="post" enctype="multipart/form-data">
    <input type="file" name="myFile" id="myFile">
    <input type="submit" value="Upload" name="submit" id="submisssion">
    </form>
    <?php
    if (isset($_FILES['myFile'])) {
        $filename =$_FILES["myFile"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        switch($ext){
            case "kml":
                if(isset($_POST['submit'])) {
                    if(move_uploaded_file($_FILES['myFile']['tmp_name'],'my.kml')) {
                        /*ka8e fora pou kanw upload, svinw ta prohgoumena data*/
                        mysqli_query($con,"delete from kampilizitisis");
                        mysqli_query($con,"delete from polygons");
                        $kml_data = simplexml_load_file('my.kml');
                        $Placemarks=$kml_data->Document->Folder->Placemark;

                        foreach($Placemarks as $p){
                            $id=$p->name;
                            $descr=$p->description;
                            /*don't remove the @, it will cause a mess :D */
                            $coords=@$p->MultiGeometry->Polygon->outerBoundaryIs->LinearRing->coordinates;
                            $center=@$p->MultiGeometry->Point->coordinates;
                            $txt1=explode("Population</span>:</strong> <span class=\"atr-value\">",$descr);
                            $pop0=explode("</span>",@$txt1[1]);
                            /*yparxoun polygons pou den exoun population tab, opote ta kanoume manually 0 */
                            if( @$pop0[0]=="")	
                                $popul=0;
                            else 
                                $popul=$pop0[0];
                            
                            mysqli_query($con,"INSERT INTO polygons(name, coords, parking_places,center,population) 
                                VALUES ( '$id', '$coords', '".rand(20,40)."','$center','$popul')");
                            $curveV=array(0.1,0.1,0.2,0.2,0.2,0.3,0.4,0.4,0.4,0.7,0.7,0.7,0.7,0.8,0.8,0.5,0.4,0.3,0.6,0.6,0.4,0.1,0.1,0.1);
                
                            for ($i=0;$i<24;$i++)
                            {
                                
                                mysqli_query($con,"INSERT INTO kampilizitisis(polygon_name, timezone, timi) 	VALUES ('$id','$i','".$curveV[$i]."')");
                                
                            }
                        }
                        $message1 = "Φόρτωση δεδομένων επιτυχής.";
                        echo "<script type='text/javascript'>alert('$message1');</script>";
                        break;

                    }
                }
            default:
                $message = "Σφάλμα! Εισάγατε λάθος τύπο δεδομένων. Δοκιμάστε ξανά.";
                echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    ?>
</section>

<footer>
    <p>e-parkadoros, Copyright &copy; 2019</p>
</footer>

</body>
</html>