	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$nombrenuevoab = $_REQUEST['nombrenuevoab'];
	$direccionnuevoab = strtoupper($_REQUEST['direccionnuevoab']);	
	$telnuevoab = $_REQUEST['telnuevoab'];	
	$colegnuevoab = $_REQUEST['colegnuevoab'];	
	$correonuevoab = $_REQUEST['correonuevoab'];	
	
	
	$sql_nservicio = "insert into estudioabogado (nombre, direccion, telefono, correo, colegiatura) 
					values('$nombrenuevoab', '$direccionnuevoab', '$telnuevoab', '$colegnuevoab', '$correonuevoab')" ;
	
	$exe_nservicio = mysql_query($sql_nservicio, $conexion);
	
	?>