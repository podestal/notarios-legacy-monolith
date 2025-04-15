<?php
include('../../conexion.php');

$id_poder    = $_POST["id_poder"];

$num_kardex    = $_POST["num_kardex"];
$num_formu     = $_POST["num_formu"];
$fec_crono     = $_POST["fecha_crono"];

// NUM_KARDEX AUTOGENERADO:

$busnumkardex = "SELECT num_kardex FROM ingreso_poderes WHERE num_kardex <> '' ORDER BY num_kardex DESC LIMIT 0,1";

$numkarbus = mysql_query($busnumkardex,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numkarbus);
$newnumkar  = $rownum['num_kardex'];
$anio_act=intval(date("Y"));
$anio_crono=intval(substr($newnumkar, 0,4));
$numero_crono=intval(substr($newnumkar, 4));

if($newnumkar == '')
{
	$new_num_kar = date("Y").'000001';
}
else if($newnumkar != '')
{

	if($anio_crono<$anio_act){
		$new_num_kar = date("Y").'000001';
	}else{
	  $suma_num=$numero_crono + 1;
	  $cantidad= strlen($suma_num);
		 switch ($cantidad) {
			case "1":
			 $new_num_kar=$anio_act."00000".$suma_num;
			break;
			case "2":
			 $new_num_kar=$anio_act."0000".$suma_num;	
			break;
			case "3":
			 $new_num_kar=$anio_act."000".$suma_num;
			break;
			case "4":
			 $new_num_kar=$anio_act."00".$suma_num;	
			break;
			case "5":
			 $new_num_kar=$anio_act."0".$suma_num;
			break;
			case "6":
			 $new_num_kar=$anio_act.$suma_num;	
			break;	
						
		}
	}
}

$updatepoderes = "UPDATE ingreso_poderes SET num_kardex = '$new_num_kar', fec_crono = STR_TO_DATE('$fec_crono','%d/%m/%Y'), num_formu = '$num_formu'  WHERE id_poder = '$id_poder'";

echo "<input name='muestraCodkar' id='muestraCodkar' readonly='readonly' type='hidden' value='".$new_num_kar."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkar = $new_num_kar;
$numkar2 = substr($numkar,4,6).'-'.substr($numkar,0,4);

echo "<input name='num_crono' id='num_crono' type='text' value='".$numkar2."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";

mysql_query($updatepoderes, $conn) or die(mysql_error());
	
mysql_close($conn);

?>


