	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_diligenciap = $_REQUEST['id'];	
	$des_diligenciap = $_REQUEST['m_desc'];
	$cont_diligenciap = $_REQUEST['m_cont'];		
		
	$sql_mdiligencia = "update diligencia_protesto set des_diligenciap='$des_diligenciap', cont_diligenciap='$cont_diligenciap' where diligencia_protesto.id_diligenciap ='$id_diligenciap'";

	$exe_mdiligencia = mysql_query($sql_mdiligencia, $conexion);
	
	?>