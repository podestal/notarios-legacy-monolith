<?php 

include("conexion.php");

$sqlx=mysql_query("SELECT kardex FROM contratantes WHERE firma='1'",$conn);

while ($kar = mysql_fetch_array($sqlx)){
	
	
	$sql=mysql_query("SELECT MAX(REPLACE(STR_TO_DATE(fechafirma,'%d/%m/%Y'), '-', '')) AS ultima FROM contratantes WHERE kardex='".$kar['kardex']."' and firma='1'",$conn);
	
	$last = mysql_fetch_array($sql);
	$year=substr($last[0],0,4);
	$month=substr($last[0],4,2);
	$day=substr($last[0],6,2);
	
	$fecha=$day."/".$month."/".$year;
	
	mysql_query("update kardex set fechaconclusion='$fecha' where kardex='".$kar['kardex']."'", $conn) or die(mysql_error());
}


printf("exito: %d\n", mysql_affected_rows());
?>