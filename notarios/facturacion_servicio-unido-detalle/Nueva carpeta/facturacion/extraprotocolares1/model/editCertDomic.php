<?php
include('../../conexion.php');

$id_domiciliario    = $_POST["id_domiciliario"];
$num_certificado    = $_POST["num_certificado"];
$fec_ingreso        = $_POST["fec_ingreso"];
$num_formu          = $_POST["num_formu"];


$nombre_solic0=strtoupper($_POST['nombre_solic']);
$nombre_solic1=str_replace("'","?",$nombre_solic0);
$nombre_solic2=str_replace("&","*",$nombre_solic1);
$nombre_solic=strtoupper($nombre_solic2);

$tipdoc_solic       = $_POST["tipdoc_solic"];
$numdoc_solic       = $_POST["numdoc_solic"];

$domic_solic0=strtoupper($_POST['domic_solic']);
$domic_solic1=str_replace("'","?",$domic_solic0);
$domic_solic2=str_replace("&","*",$domic_solic1);
$domic_solic=strtoupper($domic_solic2);


$motivo_solic       = $_POST["motivo_solic"];
$distrito_solic 	= $_POST["distrito_solic"];
$texto_cuerpo       = $_POST["texto_cuerpo"];
$justifi_cuerpo     = $_POST["justifi_cuerpo"];


$nom_testigo0=strtoupper($_POST['nom_testigo']);
$nom_testigo1=str_replace("'","?",$nom_testigo0);
$nom_testigo2=str_replace("&","*",$nom_testigo1);
$nom_testigo=strtoupper($nom_testigo2);


$tdoc_testigo		= $_POST["tdoc_testigo"];
$ndocu_testigodom	= $_POST["ndocu_testigodom"];

$sexo0	  = $_POST['sexo'];
$sexo = substr($sexo0,0,1);


$idestcivil = intval($_POST['idestcivil']);
$nomprofesionesc= $_POST['nomprofesionesc']; 
$idprofesionc= $_POST['idprofesionc'];


$updatecertidom = "UPDATE cert_domiciliario SET fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), num_formu = '$num_formu', nombre_solic = '$nombre_solic', 
cert_domiciliario.tipdoc_solic = '$tipdoc_solic', numdoc_solic = '$numdoc_solic', domic_solic = '$domic_solic', motivo_solic = '$motivo_solic', 
cert_domiciliario.distrito_solic = '$distrito_solic', texto_cuerpo = '$texto_cuerpo', justifi_cuerpo = '$justifi_cuerpo', nom_testigo = '$nom_testigo' , tdoc_testigo = '$tdoc_testigo' , 
ndocu_testigo='$ndocu_testigodom',cert_domiciliario.idestcivil = '$idestcivil' , sexo = '$sexo',
detprofesionc = '$nomprofesionesc',
profesionc = '$idprofesionc'
WHERE id_domiciliario = '$id_domiciliario'";

mysql_query($updatecertidom, $conn) or die(mysql_error());
mysql_close($conn);
?>
