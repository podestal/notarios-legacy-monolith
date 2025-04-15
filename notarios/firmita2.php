<?php 

include("conexion.php");

//truncamos el campo fechaconclucion de la tabla kardex
mysql_query("update kardex set fechaconclusion=''",$conn);


$cn=mysql_query("select kardex from kardex",$conn);
$cc=0;$ci=0;
while($rowkard=mysql_fetch_array($cn)){
	
	
$sqlfir=mysql_query("SELECT fechafirma FROM contratantes WHERE kardex='".$rowkard['kardex']."' and firma='1'",$conn) or die(mysql_error());
$numero = mysql_num_rows($sqlfir);
$sqlfir2=mysql_query("SELECT fechafirma FROM contratantes WHERE kardex='".$rowkard['kardex']."' and firma='1' and fechafirma <> ''",$conn) or die(mysql_error());
$numero2 = mysql_num_rows($sqlfir2); 

	if($numero>0){
		if($numero>$numero2){
			/*$valor=$numero-$numero2;
			echo "<span style='color:red'> Faltan Firmar : ".$valor."(".$rowkard['kardex'].")"."</span><br>";*/
			$ci++;
		}else{
			
				$sqlx=mysql_query("SELECT kardex FROM contratantes WHERE firma='1' and kardex='".$rowkard['kardex']."'",$conn);
				
				while ($kar = mysql_fetch_array($sqlx)){
	
				
				$sql=mysql_query("SELECT MAX(REPLACE(STR_TO_DATE(fechafirma,'%d/%m/%Y'), '-', '')) AS ultima FROM contratantes WHERE kardex='".$kar['kardex']."' and firma='1'",$conn);
				
				$last = mysql_fetch_array($sql);
				$year=substr($last[0],0,4);
				$month=substr($last[0],4,2);
				$day=substr($last[0],6,2);
				
				$fecha=$day."/".$month."/".$year;
				
				mysql_query("update kardex set fechaconclusion='$fecha' where kardex='".$kar['kardex']."'", $conn) or die(mysql_error());
				
			}
			echo "Firmas Completas"."(".$rowkard['kardex'].")"."<br>";	
			$cc++;
		}
	
	}
	
}

echo "COMPLETAS: $cc INCOMPLETAS: $ci";
printf("exito: %d\n", mysql_affected_rows());
?>