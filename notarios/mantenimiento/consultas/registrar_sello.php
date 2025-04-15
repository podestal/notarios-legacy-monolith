	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$idsello = $_REQUEST['n_cod'];
	$dessello = strtoupper($_REQUEST['n_desc']);
	$contenido = $_REQUEST['n_cont'];
	
	$sql_nsello = "insert into selloscartas (idsello, dessello, contenido) values('$idsello', '$dessello', '$contenido')" ;
	
    $exe_nsello = mysql_query($sql_nsello, $conexion);
	
	?>