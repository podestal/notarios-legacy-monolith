	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();

	
	$id_impedido = $_REQUEST['id']; 
	$id_cliente = $_REQUEST['clie']; 
	
	$sql_impe_del = "delete from deta_impe where idimpedido='$id_impedido' 
	and idcliente='$id_cliente'";
	
	$sql_cliente_del = "update cliente set cliente.tipocli = 0 where cliente.idcliente = '$id_cliente'";
	
				  
    $exe_cliente_del = mysql_query($sql_impe_del, $conexion);
	$exe_impedido_del = mysql_query($sql_cliente_del, $conexion);
	
	
	?>