<?php 
session_start();
include("conexion.php");

    $fecing=$_POST['fecing'];
	$tiempo = explode ("/", $fecing);
    $fechis = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];
	$numlibro=$_POST['numlibro'];
	$nlibro=intval($_POST['nlibro']);
	$idnotario = intval($_POST['idnotario']);
	$numcrono=$_POST['numcrono'];
	$flegal=$_POST['flegal'];
	$comentarios=$_POST['comentarios'];
	$tipolib=$_POST['tipolib'];
	$tlegal=intval($_POST['tlegal']);
	$folio=$_POST['folio'];
	$tipfol=intval($_POST['tipfol']);
	$detalle=$_POST['detalle'];
	$solicitante=$_POST['solicitante'];
	$dni=$_POST['dni'];
	$idusuario=intval($_POST['idusuario']);
	$comentarios2=$_POST['comentarios2'];
	$coddis=$_POST['coddis'];
	$tlibro=intval($_POST['tlibro']);
	$codclie=$_POST['codclie'];

$numanio  = substr($numcrono,-4);

	
$cliente="select * from cliente where idcliente='$codclie'"; 
$respuesta=mysql_query($cliente,$conn) or die(mysql_error());
$rowclie=mysql_fetch_array($respuesta);

// print_r($rowclie['numdoc_plantilla']);return false;

if (strpos($rowclie['numdoc_plantilla'], 'CODJU') !== false) {

    $numdocu = '';
    $numDocPlantilla = $rowclie['numdoc_plantilla'];

}else{
    $numdocu = $rowclie['numdoc'];
    $numDocPlantilla = '';
}

$tipper=$rowclie['tipper']; $apepat=$rowclie['apepat']; $apemat=$rowclie['apemat']; $prinom=$rowclie['prinom']; $segnom=$rowclie['segnom']; $nombre=$rowclie['nombre']; $direccion=$rowclie['direccion']; $numdoc=$numdocu; $idubigeo=$rowclie['idubigeo']; $razonsocial=$rowclie['razonsocial']; $domfiscal=$rowclie['domfiscal']; $idcliente=$rowclie['idcliente']; 

$libros="UPDATE libros SET fecing='$fechis',tipper='$tipper',apepat='$apepat',apemat='$apemat',prinom='$prinom',segnom='$segnom',ruc='$numdoc',domicilio='$direccion',coddis='$coddis',empresa='$razonsocial',domfiscal='$domfiscal',idtiplib='$tlibro',descritiplib='$tipolib',idlegal='$tlegal',folio='$folio',idtipfol='$tipfol',detalle='$detalle',idnotario='$idnotario',solicitante='$solicitante',comentario='$comentarios',feclegal='$flegal',comentario2='$comentarios2',dni='$dni',idusuario='$idusuario',idnlibro='$nlibro', codclie='$idcliente', numdoc_plantilla='$numDocPlantilla' WHERE numlibro='$numlibro' and ano='$numanio' ";
mysql_query($libros,$conn) or die(mysql_error());	
?>
