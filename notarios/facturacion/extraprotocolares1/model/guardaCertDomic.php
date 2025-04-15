<?php
include('../../conexion.php');

$num_certificado    = $_POST["num_certificado"];
$fec_ingreso        = $_POST["fec_ingreso"];
$num_formu          = $_POST["num_formu"];


$apepatexto=strtoupper($_POST['nombre_solic']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$nombre_solic=strtoupper($cabioapostroa);

$tipdoc_solic       = $_POST["tipdoc_solic"];
$numdoc_solic       = $_POST["numdoc_solic"];


$apepatexto=strtoupper($_POST['domic_solic']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$domic_solic=strtoupper($cabioapostroa);

$motivo_solic       = $_POST["motivo_solic"];
$distrito_solic 	= $_POST["distrito_solic"];
$texto_cuerpo       = $_POST["texto_cuerpo"];
$justifi_cuerpo     = $_POST["justifi_cuerpo"];
$sexo				= $_POST['sexo'];
$idestcivil 		= intval($_POST['idestcivil']);


$apepatexto=strtoupper($_POST['nom_testigo']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$nom_testigo=strtoupper($cabioapostroa);

$tdoc_testigo       = $_POST["tdoc_testigo"];
$ndocu_testigodom   = $_POST["ndocu_testigodom"];

$idprofesionc		= $_POST["idprofesionc"];
$nomprofesionesc	= $_POST["nomprofesionesc"];
// verifica la existendia del numero de certificado, sino edita

if($num_certificado == '')
{
	
// se arma el numero de certificado: formato 000001

$busnumcarta = " SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(cert_domiciliario.num_certificado,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(cert_domiciliario.num_certificado,6) AS DECIMAL))+1)) AS numcertificado FROM cert_domiciliario";

$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$newnumcarta  = $rownum[0];

if($newnumcarta == '')
{
	$new_num_carta = date('Y').'000001';
}
else if($newnumcarta != '')
{
	$new_num_carta = $newnumcarta;
}

########
echo "<input name='num_certificado' id='num_certificado' readonly='readonly' type='hidden' value='".$new_num_carta."' style='font-family:Calibri; font-size:14px; color:#003366; border:none;' size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkar = $new_num_carta;
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

echo "<input name='muesnumcerti' id='muesnumcerti' readonly='readonly' type='text' value='".$numkar2."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";
########

$grabcertidom = "INSERT INTO cert_domiciliario(id_domiciliario, num_certificado,fec_ingreso, num_formu, nombre_solic, tipdoc_solic, numdoc_solic, domic_solic,
motivo_solic, distrito_solic, texto_cuerpo, justifi_cuerpo, nom_testigo, tdoc_testigo, ndocu_testigo, idestcivil, sexo,detprofesionc,profesionc) VALUES (NULL, '$new_num_carta', STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), '$num_formu', '$nombre_solic', 
'$tipdoc_solic', '$numdoc_solic', '$domic_solic', '$motivo_solic', '$distrito_solic', '$texto_cuerpo', '$justifi_cuerpo', '$nom_testigo', '$tdoc_testigo', '$ndocu_testigodom' , '$idestcivil' ,'$sexo','$nomprofesionesc','$idprofesionc')";

mysql_query($grabcertidom,$conn) or die(mysql_error());

}

# edicion
if($num_certificado != '')
{

$updatecertidom = "UPDATE cert_domiciliario SET fec_ingreso = STR_TO_DATE('$fec_ingreso','%d/%m/%Y'), num_formu = '$num_formu', nombre_solic = '$nombre_solic', 
tipdoc_solic = '$tipdoc_solic', numdoc_solic = '$numdoc_solic', domic_solic = '$domic_solic', motivo_solic = '$motivo_solic', 
distrito_solic = '$distrito_solic', texto_cuerpo = '$texto_cuerpo', justifi_cuerpo = '$justifi_cuerpo', nom_testigo = '$nom_testigo', tdoc_testigo = '$tdoc_testigo', ndocu_testigo = '$ndocu_testigodom' ,
idestcivil = '$idestcivil' , sexo = '$sexo',
detprofesionc = '$nomprofesionesc',
profesionc = '$idprofesionc'
WHERE num_certificado = '$num_certificado'";

mysql_query($updatecertidom, $conn) or die(mysql_error());

################
echo "<input name='num_certificado' id='num_certificado' readonly='readonly' type='hidden' value='".$num_certificado."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' 																																																size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkarE = $num_certificado;
$numkar3 = substr($numkarE,5,6).'-'.substr($numkarE,0,4);

echo "<input name='muesnumcerti' id='muesnumcerti' readonly='readonly' type='text' value='".$numkar3."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";
################

	
}

mysql_close($conn);
?>


