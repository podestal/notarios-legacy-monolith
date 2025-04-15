<?php
include('../../conexion.php');

$id_cambio      = $_POST["id_cambio"];
$num_crono		= $_POST["num_crono"];
$fec_ingreso	= $_POST["fec_ingreso"];
$num_formu		= $_POST["num_formu"];


$nombre0=strtoupper($_POST['nombre']);
$nombre1=str_replace("'","?",$nombre0);
$nombre=strtoupper($nombre1);

$tipdoc			= $_POST["tipdoc"];
$num_docu		= $_POST["num_docu"];


$direccion0=strtoupper($_POST['direccion']);
$direccion1=str_replace("'","?",$direccion0);
$direccion=strtoupper($direccion1);

$ecivil			= $_POST["ecivil"];
$c_nombre		= $_POST["c_nombre"];
$c_tipdoc		= $_POST["c_tipdoc"];
$c_numdoc		= $_POST["c_numdoc"];


$representacion0=strtoupper($_POST['representacion']);
$representacion1=str_replace("'","?",$representacion0);
$representacion=strtoupper($representacion1);

$poder_inscrito = $_POST["poder_inscrito"];
$int_legitimo 	= $_POST["int_legitimo"];
$observacion 	= $_POST["observacion"];

// verifica la existendia del numero de carta, sino edita

if($num_crono =='')
{
// se arma el numero de la carta  formato:  'año + 000001';

$busnumcarta = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(cambio_caracter.num_crono,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(cambio_caracter.num_crono,6) AS DECIMAL))+1)) AS numcrono FROM cambio_caracter";

$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$newnumcarta  = $rownum[0];
if($newnumcarta == '')
{
	$new_num_crono =date('Y').'000001';
}
else if($newnumcarta != '')
{
	$new_num_crono = $newnumcarta;
}


########
echo "<input name='num_crono' id='num_crono' readonly='readonly' type='hidden' value='".$new_num_crono."' style='font-family:Calibri; font-size:14px; color:#003366; border:none;' size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkar = $new_num_crono;
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

echo "<input name='muesnumcrono' id='muesnumcrono' readonly='readonly' type='text' value='".$numkar2."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";
########


$grabacartas = "INSERT INTO cambio_caracter(id_cambio, num_crono, fec_ingreso, num_formu, nombre, tipdoc, num_docu ,direccion ,ecivil ,c_nombre ,c_tipdoc ,
c_numdoc, representacion, poder_inscrito, int_legitimo,observacion)
VALUES (NULL, '$new_num_crono', STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), '$num_formu', '$nombre', '$tipdoc', '$num_docu' ,'$direccion' ,'$ecivil' ,'$c_nombre' ,'$c_tipdoc' ,
'$c_numdoc', '$representacion', '$poder_inscrito', '$int_legitimo', '$observacion')";
mysql_query($grabacartas,$conn) or die(mysql_error());

$creaidcambio      = "SELECT MAX(cambio_caracter.id_cambio) FROM cambio_caracter";
$resulcreaidcambio = mysql_query($creaidcambio,$conn) or die(mysql_error());
$rowcreaidcambio   = mysql_fetch_array($resulcreaidcambio);

echo "<input name='id_cambio' id='id_cambio' type='hidden' value='".$rowcreaidcambio[0]."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";

}
# edicion
if($num_crono != '')
{

$updatecarta="UPDATE cambio_caracter SET fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), num_formu = '$num_formu', nombre = '$nombre', tipdoc = '$tipdoc', num_docu = '$num_docu' ,
direccion = '$direccion' ,ecivil = '$ecivil' ,c_nombre = '$c_nombre' ,c_tipdoc = '$c_tipdoc' ,c_numdoc = '$c_numdoc', representacion = '$representacion', 
poder_inscrito = '$poder_inscrito', int_legitimo = '$int_legitimo', observacion = '$observacion'  WHERE num_crono = '$num_crono'";
mysql_query($updatecarta,$conn) or die(mysql_error());

################
echo "<input name='num_crono' id='num_crono' readonly='readonly' type='hidden' value='".$num_crono."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' 																																																										size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkarE = $num_crono;
$numkar3 = substr($numkarE,5,6).'-'.substr($numkarE,0,4);

echo "<input name='muesnumcrono' id='muesnumcrono' readonly='readonly' type='text' value='".$numkar3."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";

echo "<input name='id_cambio' id='id_cambio' type='hidden' value='".$id_cambio."' style='font-family:Calibri; font-size:24px; color:#003366; border:none;' size='8'>";

################
	
}
mysql_close($conn);

?>


