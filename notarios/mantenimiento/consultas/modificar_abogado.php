	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$nombremab = $_REQUEST['nombremab'];
	$direccionmab = $_REQUEST['direccionmab'];
	$telmab = $_REQUEST['telmab'];
	$colegmab = $_REQUEST['colegmab'];
	$correomab = $_REQUEST['correomab'];
	$correomab = $_REQUEST['correomab'];
	$id_servicio = $_REQUEST['id_servicio'];

	
	$sql_mservicio =  "update estudioabogado set nombre='$nombremab', direccion='$direccionmab', telefono='$telmab', correo='$correomab', colegiatura='$colegmab' where idest='$id_servicio'";
	
	$exe_mservicio = mysql_query($sql_mservicio, $conexion);

	?>