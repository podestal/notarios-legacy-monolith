	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_cliente = $_REQUEST['id']; 
	
	$sql_cliente = "update cliente set cliente.tipocli = 0 where cliente.idcliente = '$id_cliente'";
	
	$sql_impedido="delete from impedidos where idcliente= '$id_cliente'";
				  
    $exe_cliente = mysql_query($sql_cliente, $conexion);
	$exe_impedido = mysql_query($sql_impedido, $conexion);
	
	
	?>