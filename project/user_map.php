<?php
include "dbcon.php";



?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Απεικόνιση χάρτη | User</title>
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
		var map;
		latitude = 0; 
		longitude = 0;
		var previousMarker;			//global variables
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
		 
          center: {lat:  40.6256, lng: 22.9505}
        });

		
		<?php
        
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
						clickable: false,  
						paths: c$i,
						  fillColor: '#808080'
					});
					
				polygons$i.setMap(map);
				
				
				
				 
				 
				
				
				";
			
				
				$i++;
			}

			
			
		}
		echo"google.maps.event.addListener(map, 'click', function(e) {
			if (previousMarker)
			previousMarker.setMap(null);
			placeMarker(e.latLng, map);

		  });
		
		  function placeMarker(position, map) {
			
			previousMarker = new google.maps.Marker({
			  position: position,
			  map: map
			  
			});  
			
			map.panTo(position);
			lat = previousMarker.getPosition().lat();
			lng = previousMarker.getPosition().lng();
			console.log(lat + ',' + lng);
		
		  }";
		?>

			
      
       
      }
	  
	  
	 
		
		  
		  
	  
	  
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkuqWJPgENNIl0eyR1L1sB5kNXcdEhCEI&libraries=geometry&callback=initMap">
	</script>
	

    <footer>
        <p>e-parkadoros, Copyright &copy; 2019</p>
    </footer>

	 
	<form action='' method=post>
<table>
	<tr>
		<td><select name=time1>
	<?php
	for ($i=0;$i<24;$i++)
	echo "<option value=$i>$i:00</option>";
	?>
	</select></td>
	<td><input type=submit class='btn btn-primary' value='Εξομοίωση'></td>
	<tr>
	<td>Μέγιστη ακτίνα(m):</td>
	<td><input type=number name=aktina placeholder="Μέγιστη απόσταση"></td>
	<td><input type=submit class='protaseis' value='Βρες!' onclick="park_it(latitude,longitude)"></td>
	</tr>
	</tr>
</table>
</form>

	


	<div id="map"></div>
	<script>
		
	</script>

    <script>
function colormap()
	  {
		  
  <?php
		
		if(isset($_POST['time1']))
		{
			$time=$_POST['time1'];
		
			$jsontext=file_get_contents("http://localhost/project/json.php?time=$time");
			$json=json_decode($jsontext);
		 $i=0;
			foreach ($json->result as $rec)
			{
			 
			  
			  $p=$rec->pososto_kat;
			  if($p<0.59)
			  echo " polygons$i.setOptions({ fillColor: '#33FF00'});"; /*green*/
			  else
			  if($p<0.84)
			  echo " polygons$i.setOptions({ fillColor: '#FFFF00'});"; /*yellow*/
			  else
			  echo " polygons$i.setOptions({ fillColor: '#FF0000'});"; /*red*/
				$i++;
			  
			}
		  }
		  ?>
	  }
	  
	  colormap();
</script>


<script>
	
	function park_it(x,y){
		<?php
			if(isset($_POST['time1']) && isset($_POST['aktina'])) {
				$time=$_POST['time1'];
				$rad=$_POST['aktina'];
				$q=mysqli_query($con,"select * from polygons");
		
				$jsontext=file_get_contents("http://localhost/project/json.php?time=$time");
				$json=json_decode($jsontext);
				echo "console.log( x + ', ' + y);";
				while($r=mysqli_fetch_array($q)) {
					if($r['center']!=""){
						$centercoords = explode(",",$r['center']);
						$curcenterlat = $centercoords[0];
						$curcenterlong = $centercoords[1];
						$ky=40000/360;
						echo"var kx = Math.cos(Math.PI*x/180.0)*$ky;";
						echo"var dx = Math.abs(y - $curcenterlong)*kx;";
						echo"var dy = Math.abs(x - $curcenterlat)*$ky;";
						echo"distance = Math.sqrt(dx*dx + dy*dy);";
						
						
						
						
					
					}
				}
				
			}	
			?>
			
			var marker = new google.maps.Marker({
						position: {lat: x, lng: y},
						map: map,
						title: 'Επιθυμία χρήστη'
					  });
			
		
		}
		
</script>
	 	


</div>
</body>
</html>