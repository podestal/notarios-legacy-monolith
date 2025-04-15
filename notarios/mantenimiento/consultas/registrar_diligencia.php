	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_diligenciap = $_REQUEST['n_cod'];
	$des_diligenciap = strtoupper($_REQUEST['n_desc']);
	$cont_diligenciap = $_REQUEST['n_cont'];
	
	$sql_ndiligencia = "insert into diligencia_protesto (id_diligenciap, des_diligenciap, cont_diligenciap) values('$id_diligenciap', '$des_diligenciap', '$cont_diligenciap')" ;
	
    $exe_ndiligencia = mysql_query($sql_ndiligencia, $conexion);
	
	?>