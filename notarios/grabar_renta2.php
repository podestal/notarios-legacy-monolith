<?php 
include("conexion.php");

$contrataa=intval($_POST['contrata']);
$consultac=mysql_query("Select * from renta where idcontratante='$contrataa'", $conn) or die(mysql_error());
$rowcc = mysql_fetch_array($consultac);

if (!empty($rowcc)){
	
	if($rowcc['pregu1']=="0"){
		$p1="No";
		}else{
		$p1="Si";
			}
	
		if($rowcc['pregu2']=="0"){
		$p2="No";
		}else{
		$p2="Si";
			}
			
			if($rowcc['pregu3']=="0"){
		$p3="No";
		}else{
		$p3="Si";
			}
	echo "<input name='idrenta' id='idrenta' value='".$rowcc['idrenta']."' type='hidden' />";
	echo "P1:".$p1."/P2:".$p2."/P3:".$p3.": Preguntas ya Grabadas...";
}else{
	
	}


?>