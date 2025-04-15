	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_poder = $_REQUEST['id']; 
	
	$sql_poder = "delete from contenidopoderes where contenidopoderes.id_asunto= '$id_poder'";
				  
    $exe_poder = mysql_query($sql_poder, $conexion);
	
	?>