<?php
	
function fdate($mifecha)    

		{
		$var = str_replace('/', '-', $mifecha);
		return date('Y-m-d', strtotime($var));
		}


//include("protocolares.php");	


$fechade=$_POST['fec_desde'];
$fechadee=fdate($fechade);
$fechaha=$_POST['fec_hasta'];
$fechahaha=fdate($fechaha);


include('../conexion.php');
	


			//PRINCIPAL DE LIBROS
			$query = "SELECT numlibro, ano, fecing, tipper, apepat, apemat, concat (prinom,' ',segnom) as nombre, ruc, 
				domicilio, coddis, empresa, domfiscal, idtiplib, descritiplib, idlegal, folio,
				idtipfol, detalle  FROM libros
				";
					
	$querynor ="SELECT idnotar,concat(nombre,' ',apellido) as notario ,telefono,correo,ruc,direccion,distrito,codnotario FROM confinotario";

	$resultadonor = mysql_query($querynor, $conn) or die("Sin datos del notario."); 

	while($nor = mysql_fetch_array($resultadonor)){ 
			$ruc=$nor['ruc'];
		$codnotario=$nor['codnotario'];
	//	$departamento=$nor['departamento'];
	//	$provincia=$nor['provincia'];
		$distrito=$nor['distrito'];
		$notario=$nor['notario'];
		$telefono=$nor['telefono'];
	}

$resultado = mysql_query($query, $conn) or die("Sin Kardex Encontrados"); 

	/*
 $salida_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";  
 
$salida_xml .= "<Envelope xmlns='http://schemas.xmlsoap.org/soap/envelope/'>\n";
		$salida_xml .= "\t<Body>\n";
				$salida_xml .= "\t\t<setDocumentosNotariales xmlns='http://ws.sisgen.ancert.notariado.org/'>\n";
						$salida_xml .= "\t\t\t<arg0 xmlns=''><![CDATA[<?xml version='1.0' encoding='utf-8'?>\n";

*/
 $salida_xml .= "<Libros xmlns='http://ancert.notariado.org/SISGEN/XML' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://ancert.notariado.org/SISGEN/XML C:\SISGEN\LIBROS\libro.xsd'>\n";

	 while($x = mysql_fetch_array($resultado)){ 
	 
		$salida_xml	.= "\t<Libro>\n"; 
		$salida_xml .= "\t<Documento>\n"; 
				$salida_xml .= "\t\t<CodNotario>" .$codnotario. "</CodNotario>\n"; 
				$salida_xml .= "\t\t<DniNotario>" .$ruc. "</DniNotario>\n"; 
				$salida_xml .= "\t\t<Notario>" .$notario. "</Notario>\n"; 
				$salida_xml .= "\t\t<CodNotaria>" .$ruc. "</CodNotaria>\n";
				//$salida_xml .= "\t\t<DescNotaria>" .. "</DescNotaria>\n";
				$salida_xml .= "\t\t<TelNotaria>" .$telefono. "</TelNotaria>\n";
				$salida_xml .= "\t\t<NumLibro>" .$x['numlibro']. "</NumLibro>\n";
				$salida_xml .= "\t\t<FechaLegalizacion>" .$x['fecing']. "</FechaLegalizacion>\n";
				$salida_xml .= "\t\t<TipoLibro>" .$x['idtiplib']. "</TipoLibro>\n";
				$salida_xml .= "\t\t<NumFolios>" .$x['folio']. "</NumFolios>\n";		
		$salida_xml .= "\t</Documento>\n"; 
		$salida_xml .= "\t<Maestros>\n";
		if($x['tipper']=='J'){
			$salida_xml .= "\t<PersonasJuridicas>\n";
				$salida_xml .= "\t\t<PersonaJuridica>\n";
					$salida_xml .= "\t\t\t<DocsIdentificativos>\n";
						$salida_xml .= "\t\t\t\t<DocIdentificativo>\n";
							$salida_xml .= "\t\t\t\t\t<TipoDocIdentidad>" ."08". "</TipoDocIdentidad>\n";
							$salida_xml .= "\t\t\t\t\t<NumDocIdentificativo>" .$x['ruc']. "</NumDocIdentificativo>\n";
						$salida_xml .= "\t\t\t\t</DocIdentificativo>\n";
					$salida_xml .= "\t\t\t</DocsIdentificativos>\n";
					$salida_xml .= "\t\t\t<RazonSocial>" .$x['empresa']. "</RazonSocial>\n";	
				$salida_xml .= "\t\t</PersonaJuridica>\n";
			$salida_xml .= "\t</PersonasJuridicas>\n";
		}else{
			$salida_xml .= "\t<PersonasNaturales>\n";
			$salida_xml .= "\t\t<PersonaNaturale>\n";
					$salida_xml .= "\t\t\t<DocsIdentificativos>\n";
						$salida_xml .= "\t\t\t\t<DocIdentificativo>\n";
							$salida_xml .= "\t\t\t\t\t<TipoDocIdentidad>" ."08". "</TipoDocIdentidad>\n";
							$salida_xml .= "\t\t\t\t\t<NumDocIdentificativo>" .$x['ruc']. "</NumDocIdentificativo>\n";
						$salida_xml .= "\t\t\t\t</DocIdentificativo>\n";
					$salida_xml .= "\t\t\t</DocsIdentificativos>\n";
					$salida_xml .= "\t\t\t<Nombre>" .$x['nombre']. "</Nombre>\n";
					$salida_xml .= "\t\t\t<PrimerApellido>" .$x['apepat']. "</PrimerApellido>\n";	
					$salida_xml .= "\t\t\t<SegundoApellido>" .$x['apemat']. "</SegundoApellido>\n";						
				$salida_xml .= "\t\t</PersonaNaturale>\n";
			$salida_xml .= "\t</PersonasNaturales>\n";
		}
		$salida_xml .= "\t</Maestros>\n";
		$salida_xml	.= "\t</Libro>\n\n"; 
		
}
$salida_xml .= "</Libros>\n";

$crearxml = fopen("textlibros.xml", "w+");
	fwrite($crearxml,$salida_xml);
	fclose($crearxml);
	
	mysql_close();
/*$envio_correcto ='Se Genero el Archivo Correctamente..!';
echo $envio_correcto;*/

echo "<p style='font-size:15px;'>... Se Genero el Archivo Correctamente..!  <a href='textlibros.xml' download='textlibros.xml'>aqui</a></p>"



/*
$envio_correcto ='Se Genero el Archivo Correctamente..!';
echo $envio_correcto;
$xmlobj=new SimpleXMLElement($salida_xml); 
$xmlobj->asXML("text.xml");*/


?>
<!--
<form>
<input type="button" value="Enviar SISGEN" onclick="location.href='prueba6.php'">
</form>
-->