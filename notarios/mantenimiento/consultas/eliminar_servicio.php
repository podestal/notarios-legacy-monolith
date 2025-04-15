	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_servicio = $_REQUEST['id']; 
	
	echo $sql_delserv = "delete from servicios where servicios.id_servicio= '$id_servicio'";
				  
    $exe_delserv = mysql_query($sql_delserv, $conexion);
	
	?>