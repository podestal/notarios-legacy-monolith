	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_sello = $_REQUEST['id']; 
	
	$sql_sello = "delete from selloscartas where selloscartas.idsello= '$id_sello'";
				  
    $exe_sello = mysql_query($sql_sello, $conexion);
	
	?>