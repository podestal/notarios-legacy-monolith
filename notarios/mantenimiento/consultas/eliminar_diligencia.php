	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_diligencia = $_REQUEST['id']; 
	
	$sql_diligencia = "delete from diligencia_protesto where diligencia_protesto.id_diligenciap= '$id_diligencia'";
	
	$exe_diligencia = mysql_query($sql_diligencia, $conexion);
	
	?>