	<?php
    
    include("../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_mov = $_REQUEST['id_mov']; 
	
	echo $sql_delacto = "delete from detallemovimiento where detallemovimiento.itemmov= '$id_mov'";
				  
    $exe_delacto = mysql_query($sql_delacto, $conexion);
	
	?>