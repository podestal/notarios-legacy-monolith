	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_asunto= $_REQUEST['n_cod'];
	$des_asunto= strtoupper($_REQUEST['n_desc']);
	//$conte_asunto
	$contenido= $_REQUEST['n_cont'];
	
	echo $sql_npoder = "insert into contenidopoderes (id_asunto, des_asunto, conte_asunto, contenido) values('$id_asunto', '$des_asunto', '$conte_asunto', '$contenido')" ;
	
    $exe_npoder = mysql_query($sql_npoder, $conexion);
	
	?>