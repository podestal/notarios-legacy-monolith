	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_condicion = $_REQUEST['id']; 
	
	$sql_condicion = "delete from actocondicion where actocondicion.idcondicion= '$id_condicion'";
				  
    $exe_condicion = mysql_query($sql_condicion, $conexion);
	
	?>