	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_acto = $_REQUEST['id']; 
	
	$sql_delacto = "delete from tiposdeacto where tiposdeacto.idtipoacto= '$id_acto'";
				  
    $exe_delacto = mysql_query($sql_delacto, $conexion);
	
	?>