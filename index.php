<!DOCTYPE html>
<html>
	<title>
		Home Page
	</title>
	<body>
		<br><br>
		<div style="height:200px; width:20%">
			<table>
				<form method="POST" action="">
					<tr><td>Search</td><td><input type="text" name="searchbox" id="textbox1"></td>
						<td><input type="submit" name="wrap" id="button1" value="Search"></td>
					</tr>
			</table>
		</div>
		<div>
			<?php
				$searchval = "*:*";
				if(isset($_POST["wrap"])){					
					$searchval = $_POST['searchbox'];
					$searchval = str_replace(" ","%20",$searchval);
					$query = "http://localhost:8983/solr/mobile/select?q=".$searchval."";
					$results = (string)file_get_contents($query);
					$startposition = strpos($results,'[');
					$endposition = strlen($results)-4;
					$myfile = fopen("values.json", "w") or die("Unable to open file!");
					$newdata = "";
					for ($i = $startposition;$i<=$endposition;$i++){
						$newdata = "".$newdata."".$results[$i]."";
					}
					fwrite($myfile,$newdata);
					
					$url = 'values.json';
					$data = file_get_contents($url);					
					$characters = json_decode($data);
					$tot = sizeof($characters)-1;
					echo "<table border=1>";
					for($i=0;$i<=2;$i++){
						echo "<tr>";
						for($j=0;$j<=2;$j++){
							echo "<td>";
							$k = $i + $j;
							if(property_exists($characters[$k],"Phone_Name"))
								echo "Name	: ".$characters[$k]->Phone_Name."<br>";
							if(property_exists($characters[$k],"Colors"))
								echo "Color : ".$characters[$k]->Colors."<br>";
							if(property_exists($characters[$k],"Price"))
								echo "Price	: ".$characters[$k]->Price."<br>";							
							if(property_exists($characters[$k],"Technology"))
								echo "Technology: ".$characters[$k]->Technology."<br>";
							//if(property_exists($characters[$k],"RAM"))
								//echo "RAM	: ".$characters[$k]->RAM."<br>";
							if(property_exists($characters[$k],"Storage"))
								echo "Storage: ".$characters[$k]->Storage."<br>";
							if(property_exists($characters[$k],"Ratings"))
								echo "Ratings: ".$characters[$k]->Ratings."<br>";
							
							echo "</td>";
						}
						echo "</tr>";
					}
					echo "</table>";
					fclose($myfile);
				}
			?>
		</div>
	</body>
</html>

<?php

?>