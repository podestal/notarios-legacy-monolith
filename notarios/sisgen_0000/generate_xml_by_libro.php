<?php 
include('conexion.php');

$columnIdLibro="";
$columnIdLibro=$_COOKIE["ckColumnIdLibro"];

$xidlibro=$_POST["idLibro"];
$xnumlibro=$_POST["numlibro"];

$dataResponse=array();
$dataVariables=array("CodNotario","CodNotaria","TelNotaria","DniNotario","Notario","FechaLegalizacion","TipoLibro","NumFolios","NumLibro","TipoDocIdentidad","NumDocIdentificativo","Nombre","PrimerApellido","SegundoApellido","RazonSocial","NumControl");
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

$Notario=$row["apellido"]." ".$row["nombre"];

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
		$sql.=" WHERE l.".$columnIdLibro."=".$xidlibro;
	




$query=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($query);

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
	$EstadoSisgen=$row["estadoSisgen"];
	$DescLibro=$row["descripLib"]; 

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
	$salida.="<Libros xmlns='http://ancert.notariado.org/SISGEN/XML' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://ancert.notariado.org/SISGEN/XML'>\n";

	$salida.="<Libro>\n";
	$salida.="<Documento>\n";
	$salida.="<CodNotario>".$CodNotario."</CodNotario>\n";
	$salida.="<DniNotario>".$DniNotario."</DniNotario>\n";
	$salida.="<Notario>".$Notario."</Notario>\n";
	$salida.="<CodNotaria>".$CodNotaria."</CodNotaria>\n";
	$salida.="<DescNotaria>".$DescNotaria."</DescNotaria>\n";
	$salida.="<TelNotaria>".$TelNotaria."</TelNotaria>\n";
	$salida.="<NumLibro>".$NumLibro."</NumLibro>\n";
	$salida.="<FechaLegalizacion>".$FechaLegalizacion."</FechaLegalizacion>\n";
	$salida.="<TipoLibro>".$TipoLibro."</TipoLibro>\n";
	$salida.="<DescLibro>".$DescLibro."</DescLibro>\n";
 

	$salida.="<NumFolios>".$NumFolios."</NumFolios>\n";
	$salida.="<NumControl>".$NumControl."</NumControl>\n";
	$salida.="<NumCronologico>".$NumCronologico."</NumCronologico>\n";
	$salida.="</Documento>\n";
	$salida.="<Maestros>\n";
	if($row["tipper"]=="J")
	{
		$salida.="<PersonasJuridicas>\n
			<PersonaJuridica>\n";
	}
	else{
	$salida.="<PersonasNaturales>\n
			<PersonaNatural>\n";
	}
			//TIPO DE DOCUMENTO NUMERO DE DOCUMENTO

	$salida.="<DocsIdentificativos>\n
					<DocIdentificativo>\n";
	$salida.="<TipoDocIdentidad>".$TipoDocIdentidad."</TipoDocIdentidad>\n";
	$salida.="<NumDocIdentificativo>".$NumDocIdentificativo."</NumDocIdentificativo>\n";
	
	$salida.="</DocIdentificativo>\n
				</DocsIdentificativos>\n";
			//FIN TIPO DE DOCUMENTO

	if($row["tipper"]=="J")
		$salida.="<RazonSocial>".$RazonSocial."</RazonSocial>\n";
	else{
		$salida.="<Nombre>".$Nombre."</Nombre>\n";
		$salida.="<PrimerApellido>".$PrimerApellido."</PrimerApellido>\n";
		$salida.="<SegundoApellido>".$SegundoApellido."</SegundoApellido>\n";
	}

	if($row["tipper"]=="J" )
	{
		$salida.="</PersonaJuridica></PersonasJuridicas>\n";
	}
	else{
	$salida.="</PersonaNatural></PersonasNaturales>\n";
	}
	
	$salida.="</Maestros>\n";
	$salida.="</Libro>\n";
	$salida.="</Libros>\n";
	

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

$objResponse = new stdClass();
$objResponse->error = 0;
$objResponse->numlibro = $xnumlibro;
$objResponse->idlibro = $xidlibro;
echo json_encode($objResponse);

$gestor = fopen("libro.xml", 'w+');
fwrite($gestor, $salida);
fclose($gestor);

 ?>