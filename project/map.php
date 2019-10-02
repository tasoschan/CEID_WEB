<?php
include "dbcon.php";



?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>Διαχείρηση | Admin</title>
<link rel="stylesheet" href="mapStyle.css">
<style>
	
	#map{
		width:100% ;
    	height:300px;
	}

	@media only screen and (min-height: 400px){
		#map{
		width:100% ;
    	height:380px;
	}
	}

	#logout{
float: right;
margin-right: 25px;
margin-top: -40px;
}


	
	</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
	
	
	<div id=logout>
	<nav>
		<ul>
			<li><a href="logout.php">Αποσύνδεση</a></li>
		</ul>
	</nav>
	</div>
</section>
<div class="xartis">

<script>

	<?php
	
	$q=mysqli_query($con,"select * from polygons");
	
	$i=0;
	while($r=mysqli_fetch_array($q))
	{
			echo "var polygons$i; ";
			$i++;
	}
	?>
	
	function initMap() {
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 13,
		
		center: {lat:  40.6256, lng: 22.9505}
	});

		
	<?php
	//$link_address = 'change_conf.php'; 
	$q=mysqli_query($con,"select * from polygons");
	
	$i=0;
	while($r=mysqli_fetch_array($q))
	{
		
		if($r['coords']!="")
		{
				$allcoord= explode(" ",$r['coords']);
			
				
				echo "var c$i = [";
				foreach ($allcoord as $coordi)
				{
					
					$xy=explode(",",$coordi);
					echo "{lat:$xy[1], lng:$xy[0]},";
					
				}	
				echo "{lat:$xy[1], lng:$xy[0]}];
				
				

					polygons$i = new google.maps.Polygon({
						paths: c$i,
						fillColor: '#808080'
				});
				
			polygons$i.setMap(map);
			

			google.maps.event.addListener(polygons$i, 'click', function (event) {
				
				
				var infow= new google.maps.InfoWindow({
		content: \"population: $r[population] - places: $r[parking_places]<br><a href='change_conf.php?id=$r[name]'>Edit</a>\"
	});
				infow.setPosition(event.latLng);
					infow.open(map);
					
					
				});
			
			
			";
			
			$i++;
		}
		
		
	}
	
	?>

	
	
	
	}
	
	
	
	
		
		
	
	
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkuqWJPgENNIl0eyR1L1sB5kNXcdEhCEI&language=gr&region=GR&callback=initMap">
</script>

<footer>
	<p>e-parkadoros, Copyright &copy; 2019</p>
</footer>

	

<div id="map" style='width:100% ; height:600px'></div>

	
	


</div>
</body>
</html>