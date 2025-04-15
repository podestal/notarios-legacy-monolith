<?php 
include('conexion.php');

$columnIdLibro="";
$columnIdLibro=$_COOKIE["ckColumnIdLibro"];

$xidlibro=$_POST["idlibro"];
$all=$_POST["all"];
$dataResponse=array();
$dataVariables=array("CodNotario","CodNotaria","TelNotaria","DniNotario","Notario","FechaLegalizacion","TipoLibro","NumFolios","NumLibro","TipoDocIdentidad","NumDocIdentificativo","Nombre","PrimerApellido","SegundoApellido","RazonSocial","NumControl","NumCronologico","DescNotaria");
$sql="SELECT nombre,apellido,ruc,codnotario,codoficial,telefono,direccion FROM confinotario";
$query=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($query);
$CodNotario=$row["codnotario"];
$CodNotaria=$row["ruc"];
$TelNotaria=$row["telefono"];
$DescNotaria=$row["direccion"];

$row["ruc"]=trim($row["ruc"]);
$DniNotario="";
if($row["ruc"]!="")
	$DniNotario=substr($row["ruc"],2,8);

$Notario=$row["nombre"]." ".$row["apellido"];

	$sql="SELECT l.".$columnIdLibro." as id,fecing AS fechalegalizacion,l.idtiplib,
	tl.destiplib  as descripLib,descritiplib as descritiplib2
	,folio AS numfolio,l.tipper,c.idtipdoc,l.ruc AS numdoc,
	l.prinom,l.segnom,l.apepat,l.`apemat`,empresa,idnlibro, l.numlibro ,estadoSisgen,
	concat(l.numlibro,'-',l.ano) as libro
	FROM libros l  
	INNER JOIN libros_temp temp ON l.".$columnIdLibro."=temp.idlibro 
	LEFT JOIN cliente c ON l.codclie=c.`idcliente`
	LEFT JOIN tipolibro tl ON tl.idtiplib = l.idtiplib

	";

	if($all==0 && $xidlibro!="")
		$sql.=" WHERE l.".$columnIdLibro."=".$xidlibro;
	$sql.=" ORDER BY l.".$columnIdLibro;




$query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
while ($row=mysqli_fetch_assoc($query)) {

	$FechaLegalizacion=$row["fechalegalizacion"];
	$TipoLibro=(int)$row["idtiplib"];
	$NumFolios=$row["numfolio"];
	$NumLibro=$row["idnlibro"];
	$Libro=$row["libro"];
	$XId=$row["id"];
	$NumControl=$row["id"];
	$NumDocIdentificativo=trim($row["numdoc"]);
	if(strlen($NumDocIdentificativo)==11)
		$TipoDocIdentidad="08";
	else
		$TipoDocIdentidad=strlen($row["idtipdoc"])==1?"0".$row["idtipdoc"]:$row["idtipdoc"];
	
	$Nombre=trim($row["prinom"])." ".trim($row["segnom"]);
	$PrimerApellido=trim($row["apepat"]);
	$SegundoApellido=trim($row["apemat"]);
	$RazonSocial=trim($row["empresa"]);
	$RazonSocial=str_replace("?","",$RazonSocial);
	$EstadoSisgen=$row["estadoSisgen"];
	$DescLibro=strtoupper(trim($row["descripLib"])); 
	if($DescLibro=="")
		$DescLibro=strtoupper(trim($row["descritiplib2"])); 
	
	$DescLibro=ucfirst(strtolower($DescLibro));
	$NumCronologico=intval($row["numlibro"]);

	if($TipoLibro>15 || $TipoLibro==0)
		$TipoLibro=16;
	else
		$DescLibro="";

	if($row["tipper"]=="" && $TipoDocIdentidad==8 && $RazonSocial!="")
		$row["tipper"]="J";
	

	$salida="";
	$salida.="<Libros xmlns='http://ancert.notariado.org/SISGEN/XML' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://ancert.notariado.org/SISGEN/XML'>";

	$salida.="<Libro>";
	$salida.="<Documento>";
	$salida.="<CodNotario>".$CodNotario."</CodNotario>";
	$salida.="<DniNotario>".$DniNotario."</DniNotario>";
	$salida.="<Notario>".$Notario."</Notario>";
	$salida.="<CodNotaria>".$CodNotaria."</CodNotaria>";
	$salida.="<DescNotaria>".$DescNotaria."</DescNotaria>";
	

	$salida.="<TelNotaria>".$TelNotaria."</TelNotaria>";
	$salida.="<NumLibro>".$NumLibro."</NumLibro>";
	$salida.="<FechaLegalizacion>".$FechaLegalizacion."</FechaLegalizacion>";
	$salida.="<TipoLibro>".$TipoLibro."</TipoLibro>";
	$salida.="<DescLibro>".$DescLibro."</DescLibro>\n";

	$salida.="<NumFolios>".$NumFolios."</NumFolios>";
	$salida.="<NumControl>".$NumControl."</NumControl>";
	$salida.="<NumCronologico>".$NumCronologico."</NumCronologico>";
	$salida.="</Documento>";
	$salida.="<Maestros>";
	if($row["tipper"]=="J")
	{
		$salida.="<PersonasJuridicas>
			<PersonaJuridica>";
	}
	else{
	$salida.="<PersonasNaturales>
			<PersonaNatural>";
	}
			//TIPO DE DOCUMENTO NUMERO DE DOCUMENTO

	$salida.="<DocsIdentificativos>
					<DocIdentificativo>";
	$salida.="<TipoDocIdentidad>".$TipoDocIdentidad."</TipoDocIdentidad>";
	$salida.="<NumDocIdentificativo>".$NumDocIdentificativo."</NumDocIdentificativo>";
	
	$salida.="</DocIdentificativo>
				</DocsIdentificativos>";
			//FIN TIPO DE DOCUMENTO

	if($row["tipper"]=="J")
		$salida.="<RazonSocial>".$RazonSocial."</RazonSocial>";
	else{
		$salida.="<Nombre>".$Nombre."</Nombre>";
		$salida.="<PrimerApellido>".$PrimerApellido."</PrimerApellido>";
		$salida.="<SegundoApellido>".$SegundoApellido."</SegundoApellido>";
	}

	if($row["tipper"]=="J")
	{
		$salida.="</PersonaJuridica></PersonasJuridicas>";
	}
	else{
	$salida.="</PersonaNatural></PersonasNaturales>";
	}
	
	$salida.="</Maestros>";
	$salida.="</Libro>";
	$salida.="</Libros>";
	

$salida = str_replace("&","*",$salida);
$salida = str_replace("Ã‘","Ñ",$salida);
$salida = str_replace("Ï¿½","Ñ",$salida);
$salida = str_replace("Ï¿Ï¿½","Ñ",$salida);
#ENVIADO EL XML AL WEB SERVICE
$soap_request = '';
$soap_request .= "<SOAP-ENV:Envelope xmlns:SOAP-ENV='http://schemas.xmlsoap.org/soap/envelope/'>\n";
$soap_request .= "\t<SOAP-ENV:Body>\n";
$soap_request .= "\t\t<setLibros xmlns='http://ws.sisgen.ancert.notariado.org/'>\n";
$soap_request .= "\t\t\t<arg0 xmlns=''><![CDATA[";

$soap_request .= $salida;

$soap_request .= "\t\t\t]]></arg0>";
$soap_request .= "\t\t</setLibros>\n";
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
    "Content-length: ".strlen($soap_request),
  );

$soap_do = curl_init();

curl_setopt($soap_do, CURLOPT_URL, $URL_LIBROS);
//curl_setopt($soap_do, CURLOPT_URL, "https://servicios.notarios.org.pe/sisgen-web/DocumentosNotarialesService" );
  
//if($EstadoSisgen!=1){
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
//}


#DESMENUSAMOS EL XML QUE NOS RESPONDE EL WEB SERVICE

$xml2 = '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><ns2:setDocumentosLibrosServiceResponse xmlns:ns2="http://ws.sisgen.ancert.notariado.org/" xmlns:ns3="http://ancert.notariado.org/SISGEN/XML">';
   $xml3 = '</ns2:setDocumentosLibrosServiceResponse></soap:Body></soap:Envelope>';
   $xml4 = '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><ns2:setDocumentosLibrosServiceResponse xmlns:ns2="http://ws.sisgen.ancert.notariado.org/" xmlns:ns3="http://ancert.notariado.org/SISGEN/XML" xmlns:ns4="http://www.w3.org/2000/09/xmldsig#">';
   
  $xmlresponse = str_replace('ns3:','',str_replace($xml3,'',str_replace($xml2,'',$response)));
  $xmlresponse = str_replace($xml4,'',$xmlresponse);
  
// var_dump($xmlresponse);
  $xml_status =  substr($xmlresponse, strpos($xmlresponse,'<status>'), strpos($xmlresponse,'</status>')-strpos($xmlresponse,'<status>'));

  $status="";
  $msj="";
  $message_xml="";
  if($xml_status == "<status>OK"){

  	$status="ENVIADO";
  	//actualizando estado
  	if($XId!=""){
	  	$sql="UPDATE libros set estadoSisgen=1 WHERE ".$columnIdLibro."=".$XId;
  		mysqli_query($conn,$sql) or die(mysqli_error($conn));
  	}

  }else{
  	$status="NO ENVIADO (FALLIDO)";
  	
  		$substrxml=substr($xmlresponse,strpos($xmlresponse,"<message>"));
  		$message_xml=substr($substrxml,strpos($substrxml,"<message>"),strpos($substrxml,"</message>"));
  		if($message_xml!="")
  			$message_xml=str_replace("NOT_ACCEPTABLE","",$message_xml);

	  	$sql2="UPDATE libros set estadoSisgen=3 WHERE ".$columnIdLibro."=".$XId;

	  	mysqli_query($conn,$sql2) or die(mysqli_error($conn)." fin");

	  	foreach ($dataVariables as $value) {
	  			if(stripos($xmlresponse, $value)!==false)
	  			{
	  				$v=${$value};
		  				if($v=="")
		  					$msj.="<strong>".$value.":</strong> VALOR OBLIGATORIO <br>";
		  				else
		  					$msj.="<strong>".$value.":</strong> VALOR NO VÁLIDO ".($v!=""?"'".$v."'":"")."<br>";
		  			
	  			}
	  		}

  		}

  $dataResponse[]=array('libro' =>$Libro,'cliente'=>trim($Nombre." ".$PrimerApellido." ".$SegundoApellido." ".$RazonSocial) ,'status'=>$status, 'mensaje'=>$msj, 'response'=>$message_xml.$xml_status);

}
echo json_encode($dataResponse);

 ?>