<?php
// Esto le dice a PHP que usaremos cadenas UTF-8 hasta el final
mb_internal_encoding('UTF-8'); 
// Esto le dice a PHP que generaremos cadenas UTF-8
mb_http_output('UTF-8');
include('conexion.php');
include('xml_kardex.php');

$idkardexpost = $_POST['idkardex'];
$kardexpost = $_POST['kardex'];
$all = $_POST['all'];
$salida_xml='';
$salida = '';
if($all == 0){
	$salida_xml .= "<DocumentosNotariales xmlns='http://ancert.notariado.org/SISGEN/XML' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://ancert.notariado.org/SISGEN/XML C:\SISGEN\SISGEN_V2_RO\documentos_notariales.xsd'>\n";
	$salida_xml .= "\t<GeneradorDatos>\n";
	$salida_xml .= "\t\t<NomProveedor>" ."CNL". "</NomProveedor>\n"; 
	$salida_xml .= "\t\t<NomAplicacion>" ."SISNOT". "</NomAplicacion>\n"; 
	$salida_xml .= "\t\t<VersionAplicacion>" ."2.7". "</VersionAplicacion>\n"; 
	$salida_xml .= "\t</GeneradorDatos>\n";
	/******************************************************************/
	$resultxml = kardexml($conn,0,$kardexpost,$idkardexpost);
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

	$crearxml = fopen("textparaenviar-uno.xml", "w+");
	fwrite($crearxml,$salida);
	fclose($crearxml);

	$crearxml = fopen("textconerror-uno.xml", "w+");
	fwrite($crearxml,$salida_kardex_error);
	fclose($crearxml);
}else{
	$archivo = getcwd().'/textparaenviar.xml';
	$file = fopen($archivo, "r") or exit("Unable to open file!");
	while(!feof($file))
	{
		$salida .=fgets($file);
	}
	fclose($file);
	$crearxml = fopen("textparaenviar-todos.xml", "w+");
	fwrite($crearxml,$salida);
	fclose($crearxml);
}


#ENVIADO EL XML AL WEB SERVICE
$soap_request = '';
$soap_request .= "<SOAP-ENV:Envelope xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/'>\n";
$soap_request .= "\t<SOAP-ENV:Body>\n";
$soap_request .= "\t\t<setDocumentosNotariales xmlns='http://ws.sisgen.ancert.notariado.org/'>\n";
$soap_request .= "\t\t\t<arg0 xmlns=''><![CDATA[";

$soap_request .= $salida;

$soap_request .= "\t\t\t]]></arg0>";
$soap_request .= "\t\t</setDocumentosNotariales>\n";
$soap_request .= "\t</SOAP-ENV:Body>\n";
$soap_request .= "</SOAP-ENV:Envelope>\n";
$header = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
	"Accept-Encoding: gzip",
	//"Content-Encoding: gzip",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction: \"http://ws.sisgen.ancert.notariado.org/DocumentosNotarialesSOAPService/setDocumentosNotariales\"",
    "Content-length: ".strlen($soap_request),
  );

$soap_do = curl_init();
curl_setopt($soap_do, CURLOPT_URL, $URL_KARDEX );
curl_setopt($soap_do, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($soap_do, CURLOPT_TIMEOUT,        500);
curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($soap_do, CURLOPT_POST,           1 );
curl_setopt($soap_do, CURLOPT_ENCODING , "gzip");
curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request);
curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);
$response = curl_exec($soap_do);
$xml2 = '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><ns2:setDocumentosNotarialesResponse xmlns:ns2="http://ws.sisgen.ancert.notariado.org/" xmlns:ns3="http://ancert.notariado.org/SISGEN/XML">';
   $xml3 = '</ns2:setDocumentosNotarialesResponse></soap:Body></soap:Envelope>';
   $xml4 = '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><ns2:setDocumentosNotarialesResponse xmlns:ns2="http://ws.sisgen.ancert.notariado.org/" xmlns:ns3="http://ancert.notariado.org/SISGEN/XML" xmlns:ns4="http://www.w3.org/2000/09/xmldsig#">';
   
   $xmlraul = str_replace('ns3:','',str_replace($xml3,'',str_replace($xml2,'',$response)));
  $xmlraul = str_replace($xml4,'',$xmlraul);


	$nuevoarchivo = fopen("response.xml", "w+");
	fwrite($nuevoarchivo,$xmlraul);
	fclose($nuevoarchivo);

$responsexml = simplexml_load_file('response.xml');
function dame_fecha_corto()
{ 
   
    $months = array ("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("d");  
    $date = $day_now . "/" . $months[$month_now] . "/" . mb_substr($year_now,0,4);   
    return $date;    

}
	
	
	$num_kardex='';
	$num_escritura='';
	$tipo_kardex='';
	$fecha=dame_fecha_corto();

	$Hora= time();
	$horaingreso=date( "H:i:s",$Hora);
	
	$xmll =  mb_substr($response, strpos($response,'<message>'), strpos($response,'</message>')-strpos($response,'<message>'));
    $xmll2 =  mb_substr($response, strpos($response,'<status>'), strpos($response,'</status>')-strpos($response,'<status>'));

	$trun_sisgen_mensaje = "TRUNCATE sisgen_mensaje"; 
            mysqli_query($conn,$trun_sisgen_mensaje) or die(mysqli_error());
			
	$trun_sisgen = "TRUNCATE sisgen"; 
            mysqli_query($conn,$trun_sisgen) or die(mysqli_error());

	$fallido = 0;
	$guardado = 0;
	$observado = 0;
	
	foreach ($responsexml as  $value) {		
		foreach ($value->DocumentoNotarial as $value2) {
			$dato = $value2->Status;
			$Documento = $value2->Documento;
			$numkardex = $Documento->NumKardex;
			$numeroEscritura = $Documento->NumDocumento;
			$tipoInstrumento = $Documento->TipoInstrumento;
			$FechaInstrumento = $Documento->FechaInstrumento;	
			
			if ($dato == 'FALLIDO'){
					$sqlinsertsisgen="insert into sisgen (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
					('$tipoInstrumento','$numkardex','$numeroEscritura','$FechaInstrumento','$fecha','$horaingreso','$dato',3)"; 
					mysqli_query($conn,$sqlinsertsisgen) or die(mysqli_error());

					$sqlinsertsisgenr="insert into sisgen_report (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
					('$tipoInstrumento','$numkardex','$numeroEscritura','$FechaInstrumento','$fecha','$horaingreso','$dato',3)"; 
					mysqli_query($conn,$sqlinsertsisgen) or die(mysqli_error());
				
					$sqlupdateestado="UPDATE kardex SET estado_sisgen ='3' WHERE kardex='$numkardex'";
					mysqli_query($conn,$sqlupdateestado) or die(mysqli_error());

					$fallido++;
			}

			if ($dato == 'GUARDADO'){
				$sqlinsertsisgen="insert into sisgen (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
				('$tipoInstrumento','$numkardex','$numeroEscritura','$FechaInstrumento','$fecha','$horaingreso','$dato',1)";
				mysqli_query($conn,$sqlinsertsisgen) or die(mysqli_error());
				$sqlinsertsisgenr = "insert into sisgen_report (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
				('$tipoInstrumento','$numkardex','$numeroEscritura','$FechaInstrumento','$fecha','$horaingreso','$dato',1)"; 
				mysqli_query($conn,$sqlinsertsisgenr) or die(mysqli_error());
				$sqlupdateestado = "UPDATE kardex SET estado_sisgen ='1' WHERE kardex='$numkardex'";
				mysqli_query($conn,$sqlupdateestado) or die(mysqli_error());
				$guardado++;

			}
			if ($dato == 'CON OBSERVACIONES'){
				$sqlinsertsisgen="insert into sisgen (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
				('$tipoInstrumento','$numkardex','$numeroEscritura','$FechaInstrumento','$fecha','$horaingreso','$dato',2)"; 
				mysqli_query($conn,$sqlinsertsisgen) or die(mysqli_error());

				$sqlinsertsisgenr = "insert into sisgen_report (tipo_kardex,kardex,num_escritura,fecha_instrumento,fech_envio,hora_envio,status,estado)values
				('$tipoInstrumento','$numkardex','$numeroEscritura','$FechaInstrumento','$fecha','$horaingreso','$dato',2)"; 
				mysqli_query($conn,$sqlinsertsisgenr) or die(mysqli_error());
				
				$sqlupdateestado = "UPDATE kardex SET estado_sisgen ='2' WHERE kardex='$numkardex'";
				mysqli_query($conn,$sqlupdateestado) or die(mysqli_error());
				
				$observado++;
			}
			foreach ($Documento->ERRORS as $ErroresDocumentos) {
				$ErrorD = $ErroresDocumentos->ERROR;
				foreach ($ErrorD as $mensaje) {
						$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$mensaje')"; 
						mysqli_query($conn,$sqlwsdl) or die(mysqli_error());
				}
			}
			$Maestros = $value2->Maestros;
			foreach ($Maestros->ERRORS as $ErroresMaestros) {
				$ErrorM = $ErroresMaestros->ERROR;
				foreach ($ErrorM as $mensaje) {
					$mensaje = utf8_encode($mensaje);
					$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$mensaje')"; 
					mysqli_query($conn,$sqlwsdl) or die(mysqli_error());
				}
			}
			$Operaciones = $value2->Operaciones;
			foreach ($Operaciones as $OperacionUnica) {
				$Operacion = $OperacionUnica->Operacion;
				$Operantes = $Operacion->Operantes;
				foreach ($Operantes->ERRORS as $ErroresOperantes) {
					$ErrorO = $ErroresOperantes->ERROR;
					foreach ($ErrorO as $mensaje) {
						$mensaje = utf8_encode($mensaje);
						$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$mensaje')"; 
						mysqli_query($conn,$sqlwsdl) or die(mysqli_error());
					}
				}
				$MediosPagos = $Operacion->MediosPagos;
				foreach ($MediosPagos as $MedioPago) {
					$Pago = $MedioPago->MediosPago;
					if(array_key_exists('ERRORS',$Pago)){
						foreach ($Pago->ERRORS as $ErroresPago) {
							$ErrorPago = $ErroresPago->ERROR;
							foreach ($ErrorPago as $mensaje) {
								$mensaje = utf8_encode($mensaje);
								$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$mensaje')"; 
								mysqli_query($conn,$sqlwsdl) or die(mysqli_error());
							}
						}
					}
					
				}
				foreach ($Operacion->ERRORS as $ErroresOperacion) {
					$ErrorOpera = $ErroresOperacion->ERROR;
					foreach ($ErrorOpera as $mensaje) {
						$mensaje = utf8_encode($mensaje);
						$sqlwsdl="insert into sisgen_mensaje (kardex,mensaje) values ('$numkardex','$mensaje')"; 
						mysqli_query($conn,$sqlwsdl) or die(mysqli_error());
					}
				}
			}
		}
	}




	$contenedorTXT = '';
	if($xmll2 == "<status>OK"){
			
	}else{
	
		$contenedorTXT = $response.$contenedorTXT;
		$nuevoarchivo = fopen("erroresSISGEN.xml", "w+");
		fwrite($nuevoarchivo,$contenedorTXT);
		fclose($nuevoarchivo);	
	
	}

	$objResponse = new stdClass();

	if ($xmll2 == '<status>INTERNAL_SERVER_ERROR') {
		$objResponse->error = 1;
		$objResponse->messageDescription = 'Error interno del XML.';
		$objResponse->data = $dataResponse;
		$objResponse->kardex = $kardex;
		$objResponse->idKardex = $idKardex;
		$objResponse->errores = $errorListKar;
		$objResponse->observaciones = $errorListKarObs;
		$objResponse->personas = $arrPersonasErr;

	}else{

		$consulta = mysqli_query($conn,"SELECT distinct  sisgen_mensaje.mensaje,  tipo_kardex AS TIPKAR, sisgen.kardex AS kardex, num_escritura AS NUM_ESC, 
		fech_envio AS FEC_ENVIO, hora_envio AS HORA_ENVIO,estado AS estado, IF ( mensaje IS NULL , '',mensaje) AS mensaje, sisgen.status AS status, sisgen_temp.idkardex AS IDKARDEX, sisgen_temp.contrato AS contrato FROM sisgen 
		LEFT JOIN sisgen_mensaje ON sisgen.kardex = sisgen_mensaje.kardex 
		INNER JOIN sisgen_temp ON sisgen.kardex = sisgen_temp.kardex
		ORDER BY sisgen.kardex ASC") or die(mysqli_error());

		
		$consultaguardados = mysqli_query($conn,"SELECT COUNT(*) AS cantidadguardados FROM sisgen WHERE sisgen.status ='GUARDADO' GROUP BY sisgen.Kardex ")or die(mysqli_error());while ($row = mysqli_fetch_array($consultaguardados))
		{$guardados=$row['cantidadguardados'];}

		$consultafallidos = mysqli_query($conn,"SELECT COUNT(*) AS cantidadguardados FROM sisgen WHERE sisgen.status ='FALLIDO' GROUP BY sisgen.Kardex")or die(mysqli_error());while ($row = mysqli_fetch_array($consultafallidos))
		{$fallidos=$row['cantidadguardados'];}

		$consultaobservados = mysqli_query($conn,"SELECT COUNT(*) AS cantidadguardados FROM sisgen WHERE sisgen.status ='CON OBSERVACIONES' GROUP BY sisgen.Kardex")or die(mysqli_error());while ($row = mysqli_fetch_array($consultaobservados))
		{$observados = $row['cantidadguardados'];}		
			
	
		$dataResponse = array();
		while($row1 = mysqli_fetch_array($consulta)){
			$dataResponse[] = $row1;
		}
	
			
		$objResponse->error = 0;
		$objResponse->messageDescription = '';
		$objResponse->data = $dataResponse;
		$objResponse->kardex = $kardex;
		$objResponse->idKardex = $idKardex;
		$objResponse->errores = $errorListKar;
		$objResponse->observaciones = $errorListKarObs;
		$objResponse->personas = $arrPersonasErr;
	
	}

echo json_encode($objResponse);

