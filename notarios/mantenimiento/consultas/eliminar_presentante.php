	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$idPresentate = $_REQUEST['id']; 
	
	$sql_cliente = "DELETE FROM presentante where presentante.idPresentante = '$idPresentate'";
				  
    $exe_cliente = mysql_query($sql_cliente, $conexion);
	
	?>