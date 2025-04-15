<?php
// Esto le dice a PHP que usaremos cadenas UTF-8 hasta el final
mb_internal_encoding('UTF-8'); 
// Esto le dice a PHP que generaremos cadenas UTF-8
mb_http_output('UTF-8');
include('conexion.php');
include('xml_kardex.php');
$kardex =  $_POST['kardex'];
$idKardex = $_POST['idKardex'];
$salida_xml .= "<DocumentosNotariales xmlns='http://ancert.notariado.org/SISGEN/XML' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://ancert.notariado.org/SISGEN/XML C:\SISGEN\SISGEN_V2_RO\documentos_notariales.xsd'>\n";
$salida_xml .= "\t<GeneradorDatos>\n";
$salida_xml .= "\t\t<NomProveedor>" ."CNL". "</NomProveedor>\n"; 
$salida_xml .= "\t\t<NomAplicacion>" ."SISNOT". "</NomAplicacion>\n"; 
$salida_xml .= "\t\t<VersionAplicacion>" ."2.7". "</VersionAplicacion>\n"; 
$salida_xml .= "\t</GeneradorDatos>\n";
/******************************************************************/
$resultxml = kardexml($conn,0,$kardex,$idKardex);
$salida_xml .= $resultxml[0];
$errorListKar = $resultxml[1];
$errorListKarObs = $resultxml[2];
$arrPersonasErr = $resultxml[3];
/******************************************************************/
$salida_xml .= "</DocumentosNotariales>\n";
$salida = str_replace("&","&amp;",$salida_xml);
$salida = str_replace("Ã‘","Ñ",$salida);
$salida = str_replace("Ï¿½","Ñ",$salida);
$salida = str_replace("Ï¿Ï¿½","Ñ",$salida);

$crearxml = fopen("documento_notarial.xml", "w+");
fwrite($crearxml,$salida);
fclose($crearxml);

$sql = "UPDATE sisgen_temp SET  seleccionado = '0' WHERE kardex = '$kardex'" ;
$r = mysqli_query($conn,$sql);

$objResponse = new stdClass();
$objResponse->error = 0;
$objResponse->kardex = $kardex;
$objResponse->idKardex = $idKardex;
$objResponse->errores = $errorListKar;
$objResponse->observaciones = $errorListKarObs;
$objResponse->personas = $arrPersonasErr;
echo json_encode($objResponse);