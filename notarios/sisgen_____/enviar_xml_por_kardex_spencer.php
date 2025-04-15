<?php
require_once 'conexion.php';
function fdate($date){
	$var = str_replace('/', '-', $date);
	return date('Y-m-d', strtotime($var));
}

$data = json_decode($_POST['listDocumentos']);

$salida_xml = '';
$salida_xml .= "<DocumentosNotariales xmlns='http://ancert.notariado.org/SISGEN/XML' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://ancert.notariado.org/SISGEN/XML C:\SISGEN\SISGEN_V2_RO\documentos_notariales.xsd'>\n";

$salida_xml .= "\t<GeneradorDatos>\n";
$salida_xml .= "\t\t<NomProveedor>" ."CNL". "</NomProveedor>\n"; 
$salida_xml .= "\t\t<NomAplicacion>" ."SISNOT". "</NomAplicacion>\n"; 
$salida_xml .= "\t\t<VersionAplicacion>" ."2.7". "</VersionAplicacion>\n"; 
$salida_xml .= "\t</GeneradorDatos>\n";


$sql = "SELECT idnotar,nombre,apellido ,telefono,correo,ruc,direccion,distrito,codnotario FROM confinotario LIMIT 1";
$result = mysqli_query($conn,$sql);
$rowNotario = mysqli_fetch_array($result);
$codigoNotario = trim($rowNotario['codnotario']);
$codigoNotaria = trim($rowNotario['ruc']);

//$data = array('kardex'=>'ACT154013','idKardex'=>'330147');

foreach ($data as $value) {
//var_dump($value);
	$kardex = $value->kardex;
	$idKardex = $value->idKardex;
	//$kardex = 'ACT154013';
//	$idKardex = '330147';
    //die('hola');
    //die('hoa');
	$sql = "SELECT kardex,numescritura AS numeroEscritura,idtipkar AS tipoKardex,fechaingreso AS fechaIngreso,contrato, fechaescritura AS fechaEscritura,fechaconclusion AS fechaConclusion,folioini AS folioInicial,foliofin AS folioFinal FROM kardex WHERE kardex = '$kardex' AND idkardex = '$idKardex' LIMIT 1";
	//die($sql);
	$resultKardex = mysqli_query($conn,$sql);
	$rowKardex = mysqli_fetch_array($resultKardex);
	$tipoKardex = $rowKardex['tipoKardex'];
	$fechaIngreso = fdate($rowKardex['fechaIngreso']);
	$numeroInstrumento = $rowKardex['numeroEscritura'];
	$fechaInstrumento = $rowKardex['fechaEscritura'];
	$folioInicial = $rowKardex['folioini'];
	$folioFinal = $rowKardex['folioFinal'];
	$FechaConclusion = fdate($rowKardex['fechaConclusion']);
	//die($tipoKardex.'H');
	switch ($tipoKardex) {
		case 1:
			# code...
		    $tipoInstrumento = 'E';
			break;
		case 2:
			# code...
		    $tipoInstrumento = 'C';
			break;
		case 3:
		# code...
	   		$tipoInstrumento = 'V';
			break;
		case 4:
		# code...
	   		$tipoInstrumento = 'G';
			break;
		case 5:
		# code...
   			$tipoInstrumento = 'T';
			break;		
		default:
			# code...
			break;
	}
	$folio = $folioFinal - $folioInicial +1;
	//die('hola');

	$salida_xml .= "\t<DocumentoNotarial>\n"; 
// DECUMENTO DATOS DEl NOTARIO
	$salida_xml .= "\t<Documento>\n"; 
			$salida_xml .= "\t\t<CodNotario>" .$codigoNotario. "</CodNotario>\n"; 
			$salida_xml .= "\t\t<CodNotaria>" .$codigoNotaria. "</CodNotaria>\n";
			$salida_xml .= "\t\t<NumKardex>" . $kardex . "</NumKardex>\n";
			//$salida_xml .= "\t\t<NumKardex>" . substr($x['kardex'],0,-5) . "</NumKardex>\n";
			$salida_xml .= "\t\t<FechaIngreso>" .  $fechaIngreso . "</FechaIngreso>\n";
			$salida_xml .= "\t\t<TipoInstrumento>" . $tipoInstrumento . "</TipoInstrumento>\n";
			$salida_xml .= "\t\t<NumDocumento>" . $numeroInstrumento . "</NumDocumento>\n";
			$salida_xml .= "\t\t<FechaInstrumento>" .  $fechaInstrumento . "</FechaInstrumento>\n";


			if($folio<=0){
				$salida_xml .= "\t\t<NumFolios>" . "1" . "</NumFolios>\n";
			}else{ 
				$salida_xml .= "\t\t<NumFolios>" . $folio . "</NumFolios>\n";
			}
			if($fechaConclusion != null ){
				$salida_xml .= "\t\t<FechaConclusion>" . $fechaConclusion. "</FechaConclusion>\n";
			}else{
				$salida_xml .= ""; 
			}
			$salida_xml .= "\t</Documento>\n";

			$sql = "SELECT  contratantesxacto.idcontratante,contratantesxacto.id,cliente2.tipper,cliente2.apepat,cliente2.apemat,cliente2.prinom,cliente2.segnom,cliente2.nombre,
cliente2.direccion,cliente2.idtipdoc,cliente2.numdoc,cliente2.email,cliente2.telfijo,cliente2.telcel, cliente2.telofi, cliente2.natper, cliente2.conyuge, cliente2.idprofesion, cliente2.detaprofesion, cliente2.idcargoprofe, 
cliente2.profocupa,cliente2.dirfer, cliente2.idubigeo, cliente2.nacionalidad
 FROM cliente2 INNER JOIN contratantesxacto on cliente2.idcontratante = contratantesxacto.idcontratante 
where contratantesxacto.kardex = 'KAR140983'  GROUP BY cliente2.idcliente";





	$salida_xml .= "\t</DocumentoNotarial>\n\n"; 		
			//die('holaw');
}

$salida_xml .= "</DocumentosNotariales>\n";
//die($salida_xml);
#FILTRO DE CARACTERES NO PERMITIDOS.
//$salida = '';
$salida = str_replace("&","*",$salida_xml);
$salida = str_replace("Ã‘","Ñ",$salida_xml);
$salida = str_replace("Ï¿½","Ñ",$salida_xml);
$salida = str_replace("Ï¿Ï¿½","Ñ",$salida_xml);



#CREAMOS EL ARCHIVO XML
/*$crearxml = fopen("text.xml", "w+");
write($crearxml,$salida);
fclose($crearxml);*/

#ENVIADO EL XML AL WEB SERVICE
$soap_request = '';
$soap_request .= "<SOAP-ENV:Envelope xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/'>\n";
$soap_request .= "\t<SOAP-ENV:Body>\n";
$soap_request .= "\t\t<setDocumentosNotariales xmlns='http://ws.sisgen.ancert.notariado.org/'>\n";
$soap_request .= "\t\t\t<arg0 xmlns=''><![CDATA[";

$soap_request .= $salida_xml;

$soap_request .= "\t\t\t]]></arg0>";
$soap_request .= "\t\t</setDocumentosNotariales>\n";
$soap_request .= "\t</SOAP-ENV:Body>\n";
$soap_request .= "</SOAP-ENV:Envelope>\n";
//die($soap_request);
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
curl_setopt($soap_do, CURLOPT_URL, "https://test.www.notariado.org/sisgen-web/DocumentosNotarialesService" );
curl_setopt($soap_do, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($soap_do, CURLOPT_TIMEOUT,        500);
curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true);
curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, true); 
//curl_setopt($soap_do, CURLOPT_CAINFO, "ancert.cer");
curl_setopt($soap_do, CURLOPT_CAINFO, "ancert.cer");
curl_setopt($soap_do, CURLOPT_POST,           1 );
curl_setopt($soap_do, CURLOPT_ENCODING , "gzip");
curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $soap_request);
curl_setopt($soap_do, CURLOPT_HTTPHEADER,     $header);

$response = curl_exec($soap_do);

echo $response;


?>

