<?php 
 session_start();
include("conexion.php");

    $fecing=$_POST['fecing'];
	$tiempo = explode ("/", $fecing);
    $fecha = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];
	$nlibro=intval($_POST['nlibro']);
	$tipoper=$_POST['tipoper'];
	$tipolib=$_POST['tipolib'];
	$tlibro=intval($_POST['tlibro']);
	$tlegal=intval($_POST['tlegal']);
	$folio=$_POST['folio'];
	$tipfol=intval($_POST['tipfol']);
	$detalle=$_POST['detalle'];
	$solicitante=$_POST['solicitante'];
	$dni=$_POST['dni'];
	$idusuario=intval($_POST['idusuario']);
	$comentarios2=$_POST['comentarios2'];
	$comentarios=$_POST['comentarios'];
	$idnotario=intval($_POST['idnotario']);
	$flegal=$_POST['flegal']; 
	$codclie=$_POST['codclie'];

$anio=date("Y");

$consulta=mysql_query("SELECT * FROM libros WHERE ano = '$anio' ORDER BY ano DESC, numlibro DESC LIMIT 1", $conn) or die(mysql_error());
$row = mysql_fetch_array($consulta);

$numero=$row['numlibro'];
$suma= intval($numero) + 1;
$cantidad= strlen($suma);


switch ($cantidad) {
	case "1":
	$codlibro="00000".$suma;
	break;
	case "2":
	$codlibro="0000".$suma;
	break;
	case "3":
	$codlibro="000".$suma;
	break;
	case "4":
	$codlibro="00".$suma;	
	break;
	case "5":
	$codlibro="0".$suma;
	break;
	case "6":
	$codlibro=$suma;	
	break;
			
}


$cliente="select * from cliente where idcliente='$codclie'"; 
$respuesta=mysql_query($cliente,$conn) or die(mysql_error());
$rowclie=mysql_fetch_array($respuesta);

if (strpos($rowclie['numdoc_plantilla'], 'CODJU') !== false) {

    $numdocu = '';
    $numDocPlantilla = $rowclie['numdoc_plantilla'];

}else{
    $numdocu = $rowclie['numdoc'];
    $numDocPlantilla = '';
}


$tipper=$rowclie['tipper']; $apepat=$rowclie['apepat']; $apemat=$rowclie['apemat']; $prinom=$rowclie['prinom']; $segnom=$rowclie['segnom']; $nombre=$rowclie['nombre']; $direccion=$rowclie['direccion']; $numdoc=$numdocu; $idubigeo=$rowclie['idubigeo']; $razonsocial=$rowclie['razonsocial']; $domfiscal=$rowclie['domfiscal']; 

$libros="INSERT INTO libros(numlibro, ano, fecing, tipper, apepat, apemat, prinom, segnom, ruc, domicilio, coddis, empresa, domfiscal, idtiplib, descritiplib, idlegal, folio, idtipfol, detalle, idnotario, solicitante, comentario, feclegal, comentario2, dni, idusuario,idnlibro,codclie,numdoc_plantilla) VALUES ('$codlibro','$anio','$fecha','$tipper','$apepat','$apemat','$prinom','$segnom','$numdoc','$direccion','$idubigeo','$razonsocial','$domfiscal','$tlibro','$tipolib','$tlegal','$folio','$tipfol','$detalle','$idnotario','$solicitante','$comentarios','$flegal','$comentarios2','$dni','$idusuario','$nlibro','$codclie','$numDocPlantilla')"; 
mysql_query($libros,$conn) or die(mysql_error());

echo $codlibro."-".$anio;
echo"<input name='numerolib' type='hidden' id='numerolib' value=".$codlibro." />";
echo '<input type="hidden" name="numlibro" id="numlibro" value="'.$codlibro.'" />';
echo '<input type="hidden" name="anioLibro" id="anioLibro" value="'.$anio.'" />';
	
?>
