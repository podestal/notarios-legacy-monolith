<?php
include('../../conexion.php');

$num_crono  = strtoupper($_POST["num_crono"]);
$fecha      = strtoupper($_POST["fecha"]);
$num_formu  = strtoupper($_POST["num_formu"]);
$documento  = strtoupper($_POST["documento"]);


$nombre=strtoupper($_POST['nombre']);
$nombre1=str_replace("'","?",$nombre);
$nombre2=str_replace("&","*",$nombre1);
$nombre=strtoupper($nombre2);


$tipdocu    = strtoupper($_POST["tipdocu"]);
$numdocu    = strtoupper($_POST["numdocu"]);
$nacionalidad = strtoupper($_POST["nacionalidad"]);
$ecivil 	  = strtoupper($_POST["ecivil"]);

$direccion=strtoupper($_POST['direccion']);
$direccion1=str_replace("'","?",$direccion);
$direccion2=str_replace("&","*",$direccion1);
$direccion=strtoupper($direccion2);

$observaciones= strtoupper($_POST["observaciones"]);
$idzona       = strtoupper($_POST["idzona"]);

$nom_testigo        = strtoupper($_POST["nom_testigo"]);
$tdoc_testigo       = strtoupper($_POST["tdoc_testigo"]);
$ndocu_testigo      = strtoupper($_POST["ndocu_testigo"]);
$idprofesion = strtoupper($_POST["idprofesion"]);
$detprofesion	= strtoupper($_POST["detprofesion"]);
$espec1				= strtoupper($_POST["espec1"]);
echo $espec1	;
$id_supervivencia = $_POST["id_supervivencia"];
$swt_capacidad = "C";


$updatepersonacapaz = "UPDATE cert_supervivencia SET num_crono = '$num_crono', fecha = STR_TO_DATE('$fecha','%d/%m/%Y'), num_formu = '$num_formu', documento = '$documento', nombre = '$nombre', 
tipdocu = '$tipdocu', numdocu = '$numdocu', nacionalidad = '$nacionalidad', ecivil = '$ecivil', ubigeo = '$idzona'  , direccion = '$direccion', observaciones = '$observaciones', 
swt_capacidad = '$swt_capacidad', nom_testigo = '$nom_testigo', tdoc_testigo = '$tdoc_testigo', ndocu_testigo = '$ndocu_testigo', profesion
='$idprofesion' , detprofesion = '$detprofesion' , especificacion = '$espec1' WHERE id_supervivencia = '$id_supervivencia' AND swt_capacidad = 'C'";

mysql_query($updatepersonacapaz, $conn) or die(mysql_error());
mysql_close($conn);
?>
