	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$idsello = $_REQUEST['id'];
	$dessello = $_REQUEST['m_desc'];
	$contenido = $_REQUEST['m_cont'];

	$sql_msello =  "update selloscartas set dessello='$dessello', contenido='$contenido' where selloscartas.idsello='$idsello'";
	
	$exe_msello = mysql_query($sql_msello, $conexion);
	
	?>