	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	
	$id_asunto = $_REQUEST['id_poder'];
	$des_asunto = $_REQUEST['m_desc'];
	//$conte_asunto = $_REQUEST['id'];
	$contenido = $_REQUEST['m_cont'];
	
	$sql_mpoder =  "update contenidopoderes set des_asunto='$des_asunto', conte_asunto='$conte_asunto', contenido='$contenido' where contenidopoderes.id_asunto ='$id_asunto'";
	
	$exe_mpoder = mysql_query($sql_mpoder, $conexion);
	
	?>