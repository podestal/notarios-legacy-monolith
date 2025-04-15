<?php
require_once 'conexion.php';
$fechaDesde = $_POST['fechaDesde'];
$fechaHasta = $_POST['fechaHasta'];

$sql = "SELECT libros.id,concat(libros.numlibro,'-',libros.ano) as libro,libros.fecing AS fechaIngreso,libros.tipper AS tipoPersona,IF(tipper = 'N',concat(apepat,' ',apemat,' ',prinom,' ',segnom), empresa) AS empresa,libros.ruc,libros.domfiscal, libros.idtiplib,libros.descritiplib  AS descripcionTipoLibro ,IF(libros.idtiplib = 99,libros.descritiplib,tipolibro.destiplib ) descripcionLibro,estadoSisgen FROM libros LEFT JOIN tipolibro ON tipolibro.idtiplib = libros.idtiplib WHERE fecing>'$fechaDesde' and fecing<='$fechaHasta' order by fecing ";
//die($sql);
$result = mysqli_query($conn,$sql);

$data = array();
while($row = mysqli_fetch_array($result)){
	$data[] = $row;


}

$objResponse  = new stdClass();
$objResponse->error = 0;
$objResponse->data = $data;

echo json_encode($objResponse);