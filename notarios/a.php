<?php 
//script para arreglar la data de la tia del pozo
include ('conexion.php');

$sql_mservicio =  "SELECT * FROM detallemediopago WHERE detmp>=4870 and itemmp>3800";
	
$exe_mservicio = mysql_query($sql_mservicio, $conn);

while ($r=mysql_fetch_array($exe_mservicio)){
	
	$id=$r['detmp'];
	$valorentero=intval($r['itemmp']);

		$newvalor=$valorentero+intval(1);
		echo $newvalor."<br>";
		mysql_query("update detallemediopago set itemmp='00".$newvalor."' where detmp='".$id."'", $conn) or die (mysql_error());
				
		

}

echo "se actualizaron los registros";

?>