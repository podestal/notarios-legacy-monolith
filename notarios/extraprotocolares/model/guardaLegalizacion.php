<?php
include('../../conexion.php');
$direCertificado=$_POST['direCertificado'];
$tipdocSolic=$_POST['tipdocSolic'];
$numdocSolic=$_POST['numdocSolic'];
$condicion=$_POST['motivoSolic'];
$textoCuerpo=$_POST['textoCuerpo'];
$fechaIngreso=$_POST['fecIngreso'];

$idLegalizacion=$_POST['idLegalizacion'];

$arrySolicitante=json_decode($_POST['arrySolicitante']);
// echo json_encode($arrySolicitante);return false;

$_fechaIngreso=explode("/",$fechaIngreso);
	$fechaReal=$_fechaIngreso[2]."-".$_fechaIngreso[1]."-".$_fechaIngreso[0];

if($idLegalizacion=='')
{
		$sqlLegal="INSERT INTO legalizacion (fechaIngreso,direccionCertificado,documento) values ('".$fechaReal."','".$direCertificado."','".$textoCuerpo."')";
		$resultVerify2 = mysql_query($sqlLegal,$conn) or die(mysql_error());

	    $sqlidLegalizacion="SELECT MAX(idLegalizacion) as idLegalizacion FROM legalizacion";
		$rsptQuery = mysql_query($sqlidLegalizacion,$conn) or die(mysql_error());
		$rownum = mysql_fetch_array($rsptQuery);
		$idLegalizacion=$rownum['idLegalizacion'];

	foreach ($arrySolicitante as $key) {
/*				$sqlDni="select idcliente from cliente where numdoc='".$key->numDoc."' ";
				$rsptQueryDni = mysql_query($sqlDni,$conn) or die(mysql_error());
				$rownum = mysql_fetch_array($rsptQueryDni);
				$idCliente=$rownum['idcliente'];
*/

		$sqlLegalSolicitante="INSERT INTO solicitantelegalizacion (idLocalizacion,nombreSolicitante,numdoc) values ('".$idLegalizacion."','".$key->nombreSolicitante."','".$key->numDoc."')";
		//echo $sqlLegalSolicitante."<br>";
		mysql_query($sqlLegalSolicitante,$conn) or die(mysql_error());
 }
}else
{

	foreach ($arrySolicitante as $key) {


		$sqlLegalSolicitante="INSERT INTO solicitantelegalizacion (idLocalizacion,nombreSolicitante,numdoc) values ('".$idLegalizacion."','".$key->nombreSolicitante."','".$key->numDoc."')";
		//echo $sqlLegalSolicitante."<br>";
		mysql_query($sqlLegalSolicitante,$conn) or die(mysql_error());
 }
}
	

	
	echo "<input type='text' readOnly value='".$idLegalizacion."' id='idLegalizacion'>";	



?>