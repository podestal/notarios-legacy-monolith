<?php
require_once 'conexion.php';
$fechaDesde = $_POST['fechaDesde'];
$fechaHasta = $_POST['fechaHasta'];
$estado=$_POST["estado"];
	
$columnIdLibro="";
if(!isset($_COOKIE["ckColumnIdLibro"])){
	$resultado = mysqli_query($conn,"SHOW COLUMNS FROM libros");
	 while ($fila = mysqli_fetch_assoc($resultado)) {
	        if($fila["Field"]=="id" || $fila["Field"]=="idLibro" || $fila["Field"]=="idLibros"){
	        	$columnIdLibro=$fila["Field"];
	        	setcookie("ckColumnIdLibro",$fila["Field"]);
	        	break;
	        }
	    }

}

if($columnIdLibro=="")
	$columnIdLibro=$_COOKIE["ckColumnIdLibro"];


 

	$sql = "SELECT libros.".$columnIdLibro." as  id,concat(libros.numlibro,'-',libros.ano) as libro,libros.fecing AS fechaIngreso,libros.tipper AS tipoPersona,IF(tipper = 'N',concat(prinom,' ',segnom,' ',apepat,' ',apemat), empresa) AS empresa,libros.ruc,libros.domfiscal, libros.idtiplib,libros.descritiplib  AS descripcionTipoLibro ,IF(libros.idtiplib = 99,libros.descritiplib,tipolibro.destiplib ) descripcionLibro,IF(estadoSisgen IS NULL,0,estadoSisgen) as estadoSisgen FROM libros LEFT JOIN tipolibro ON tipolibro.idtiplib = libros.idtiplib WHERE fecing>='$fechaDesde' and fecing<='$fechaHasta'";


	switch ($estado) {
		case '0':
			$sql.=" AND (libros.estadoSisgen=0 or libros.estadoSisgen IS NULL) ";
			break;
		
		case '1':
			$sql.=" AND libros.estadoSisgen=1 ";
			break;
		
		case '3':
			$sql.=" AND libros.estadoSisgen=3 ";
			break;
		default:
			# code...
			break;
	}

	$sql.="order by libros.".$columnIdLibro;

//die($sql);

$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
$data = array();


//TRUNCATE TABLE DE LIBROS TEMPORAL 
$sql="TRUNCATE TABLE libros_temp;";
mysqli_query($conn,$sql) or die(mysqli_error($conn));

while($row = mysqli_fetch_array($result)){
	switch ($row["estadoSisgen"]) {
		case '0':
			$row["estadoSisgen"]="NO ENVIADO";
			break;
		case '1':
			$row["estadoSisgen"]="ENVIADO";
			break;

		case '3':
			$row["estadoSisgen"]="NO ENVIADO (FALLIDO)";
			break;
		
		default:
			# code...
			break;
	}
	if($row["estadoSisgen"]==0)

	$data[] = $row;
	$sql="INSERT INTO libros_temp(idlibro) VALUES (".$row["id"].");";
	mysqli_query($conn,$sql) or die(mysqli_error($conn));
}

$objResponse  = new stdClass();
$objResponse->error = 0;
$objResponse->data = $data;
$objResponse->total = sizeof($data);

echo json_encode($objResponse);