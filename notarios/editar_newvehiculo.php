   <?php 
include("conexion.php");

$detvehx   = $_POST['detvehx'];

$codkardex = $_POST['codkardex'];
$idtipacto = $_POST['idtipacto'];

$idplaca  = $_POST['idplaca'];
$numplaca = $_POST['numplaca'];
$clase    = $_POST['clase'];
$marca    = $_POST['marca'];
$anofab   = $_POST['anofab'];
$modelo   = $_POST['modelo'];
$combustible = $_POST['combustible'];
$carroceria  = $_POST['carroceria'];
$fecinsc     = $_POST['fecinsc'];
$color 		 = $_POST['color'];
$motor 		 = $_POST['motor'];
$numcil 	 = $_POST['numcil'];
$numserie 	 = $_POST['numserie'];
$numrueda 	 = $_POST['numrueda'];

// Nuevo 23-01-14
$pregis_vehi 	 = $_POST['pregis_vehi'];
$idsedereg2_vehi = $_POST['idsedereg2_vehi'];

$idmon 		 = "";
$precio 	 = "0.00";
$codmepag 	 = "";

	if($detvehx!='')
	{
		mysql_query("UPDATE detallevehicular SET  idplaca = '$idplaca', numplaca = '$numplaca', clase = '$clase', marca ='$marca', anofab ='$anofab', modelo ='$modelo', combustible ='$combustible', carroceria = '$carroceria', fecinsc = '$fecinsc' , color = '$color', motor = '$motor', numcil = '$numcil', numserie = '$numserie', numrueda = '$numrueda' ,pregistral = '$pregis_vehi', idsedereg = '$idsedereg2_vehi' WHERE detveh = '$detvehx' ", $conn) or die(mysql_error());
	}
	else if($detvehx=='')
	{
		mysql_query("INSERT INTO detallevehicular(detveh, kardex, idtipacto, idplaca, numplaca, clase, marca, anofab, modelo, combustible, carroceria, fecinsc,
color, motor, numcil, numserie, numrueda, idmon, precio, codmepag, pregistral, idsedereg) VALUES (NULL,'$codkardex','$idtipacto', '$idplaca', 			'$numplaca','$clase','$marca','$anofab','$modelo','$combustible','$carroceria','$fecinsc' ,'$color','$motor','$numcil','$numserie','$numrueda','$idmon','$precio','$codmepag' , '$pregis_vehi', '$idsedereg2_vehi')", $conn) or die(mysql_error());
	}
?>
