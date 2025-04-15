<?php
include('../../conexion.php');

$num_crono     = strtoupper($_POST["num_crono"]);
$fecha         = strtoupper($_POST["fecha"]);
$num_formu     = strtoupper($_POST["num_formu"]);
$documento     = strtoupper($_POST["documento"]);

$nombre0=strtoupper($_POST['nombre']);
$nombre1=str_replace("'","?",$nombre0);
$nombre2=str_replace("&","*",$nombre1);
$nombre=strtoupper($nombre2);


$tipdocu       = strtoupper($_POST["tipdocu"]);
$numdocu       = strtoupper($_POST["numdocu"]);
$nacionalidad  = strtoupper($_POST["nacionalidad"]);
$ecivil 	   = strtoupper($_POST["ecivil"]);

$direccion0=strtoupper($_POST['direccion']);
$direccion1=str_replace("'","?",$direccion0);
$direccion2=str_replace("&","*",$direccion1);
$direccion=strtoupper($direccion2);

$observaciones = strtoupper($_POST["observaciones"]);
$idzona        = strtoupper($_POST["idzona"]);


$representante0=strtoupper($_POST['representante']);
$representante1=str_replace("'","?",$representante0);
$representante2=str_replace("&","*",$representante1);
$representante=strtoupper($representante2);

$tipdocu_rep   = strtoupper($_POST["tipdocu_rep"]);
$numdocu_rep   = strtoupper($_POST["numdocu_rep"]);
$nombre_rep    = strtoupper($_POST["nombre_rep"]);

$nom_testigo   = strtoupper($_POST["nom_testigo"]);

$nom_testigo0=strtoupper($_POST['nom_testigo']);
$nom_testigo1=str_replace("'","?",$nom_testigo0);
$nom_testigo2=str_replace("&","*",$nom_testigo1);
$nom_testigo=strtoupper($nom_testigo2);

$tdoc_testigo  = strtoupper($_POST["tdoc_testigo"]);
$ndocu_testigo = strtoupper($_POST["ndocu_testigo"]);

$pelectronica	= strtoupper($_POST["pelectronica"]);

$especi1		= strtoupper($_POST["especi1"]);

$id_supervivencia = $_POST["id_supervivencia"];
$swt_capacidad = "I";


$updatepersonacapaz = "UPDATE cert_supervivencia SET num_crono = '$num_crono', fecha = STR_TO_DATE('$fecha','%d/%m/%Y'), num_formu = '$num_formu', documento = '$documento', nombre = '$nombre', 
tipdocu = '$tipdocu', numdocu = '$numdocu', nacionalidad = '$nacionalidad', ecivil = '$ecivil', ubigeo = '$idzona', direccion = '$direccion', observaciones = '$observaciones', 
swt_capacidad = '$swt_capacidad', representante = '$representante', tipdocu_rep = '$tipdocu_rep', numdocu_rep = '$numdocu_rep', nombre_rep = '$nombre_rep', nom_testigo = '$nom_testigo', tdoc_testigo = '$tdoc_testigo', ndocu_testigo = '$ndocu_testigo' , pelectronica='$pelectronica',especificacion = '$especi1' WHERE id_supervivencia = '$id_supervivencia' AND swt_capacidad = 'I'";

mysql_query($updatepersonacapaz, $conn) or die(mysql_error());
mysql_close($conn);
?>



