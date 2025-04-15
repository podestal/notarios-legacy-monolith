	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_cliente = $_REQUEST['id']; 
	
	$sql_cliente = "delete from cliente where cliente.idcliente= '$id_cliente'";
				  
    $exe_cliente = mysql_query($sql_cliente, $conexion);
	
	?>