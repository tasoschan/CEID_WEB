<?php
include "dbcon.php";	
	
		$q=mysqli_query($con,"select * from polygons,kampilizitisis where polygons.name=kampilizitisis.polygon_name and timezone=$_GET[time] ");
		$json="{\"result\":[";
		while ($r=mysqli_fetch_array($q))
		{
			if($r['coords']!="")
			{
				$eleft_theseis=$r['parking_places']-$r['population']*0.2-$r['timi']*$r['parking_places'];
				if($eleft_theseis<0) $eleft_theseis=0;
				
				if($r['parking_places']>0)	$pososto_kat=($r['parking_places']-$eleft_theseis)/$r['parking_places'];
				else $pososto_kat=1;
								
				$json=$json."{\"id\":\"$r[name]\", \"center\":\"$r[center]\", \"pososto_kat\":\"$pososto_kat\", \"eleft_theseis\":\"$eleft_theseis\"},";
		
				
			}
		}
		$json=$json."{\"id\":\"0\", \"center\":\"1,1\", \"pososto_kat\":\"0\", \"eleft_theseis\":\"0\"}]}";
		
			echo $json;
	
?>


 