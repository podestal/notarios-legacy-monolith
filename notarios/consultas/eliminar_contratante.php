	<?php
    
    include("../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_contratante = $_REQUEST['id']; 
	
	$sql_contratante = "delete from contratantes where contratantes.idcontratante= '$id_contratante'";
	
	$sql_cliente2 = "delete from cliente2 where cliente2.idcontratante= '$id_contratante'";
				  
    $exe_contratante = mysql_query($sql_contratante, $conexion);
	
	$exe_cliente2 = mysql_query($sql_cliente2, $conexion);
	
	?>