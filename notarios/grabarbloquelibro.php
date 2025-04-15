<?php 
 session_start();
include("conexion.php");

    $fecing=$_POST['fecing'];
	$tiempo = explode ("/", $fecing);
    $fecha = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];
	$solicitante=$_POST['solicitante'];
	$dni=$_POST['dni'];
	$idusuario=$_POST['idusuario'];
	$codclie=$_POST['codclie'];
	$cantidad2=$_POST['cantidad'];



$cliente="select * from cliente where idcliente='$codclie'"; 
$respuesta=mysql_query($cliente,$conn) or die(mysql_error());
$rowclie=mysql_fetch_array($respuesta);

$tipper=$rowclie['tipper']; $apepat=$rowclie['apepat']; $apemat=$rowclie['apemat']; $prinom=$rowclie['prinom']; $segnom=$rowclie['segnom']; $nombre=$rowclie['nombre']; $direccion=$rowclie['direccion']; $numdoc=$rowclie['numdoc']; $idubigeo=$rowclie['idubigeo']; $razonsocial=$rowclie['razonsocial']; $domfiscal=$rowclie['domfiscal']; $codcliente=$rowclie['idcliente'];

for($i=1;$i<=$cantidad2;$i++)
{

$consulta=mysql_query("SELECT * FROM libros ORDER BY ano DESC, numlibro DESC LIMIT 1", $conn) or die(mysql_error());
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

$ano=date("Y");

$libros="INSERT INTO libros(numlibro, ano, fecing, tipper, apepat, apemat, prinom, segnom, ruc, domicilio, coddis, empresa, domfiscal, idtiplib, descritiplib, idlegal, folio, idtipfol, detalle, idnotario, solicitante, comentario, feclegal, comentario2, dni, idusuario,idnlibro,codclie) VALUES ('$codlibro','$ano','$fecha','$tipper','$apepat','$apemat','$prinom','$segnom','$numdoc','$direccion','$idubigeo','$razonsocial','$domfiscal','0','0','0','0','0','$detalle','0','$solicitante','$comentarios','$flegal','$comentarios2','$dni','$idusuario','0','$codcliente')"; 
mysql_query($libros,$conn) or die(mysql_error());

}
header('Location: listadolibro.php');

?>
