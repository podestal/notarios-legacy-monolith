	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$m_cod = $_REQUEST['m_cod'];
	
	$m_fecha = $_REQUEST['m_fecha'];
	$entidad = strtoupper($_REQUEST['entidad']);
	$n_impentidad = strtoupper($_REQUEST['n_impentidad']);
	$n_impmotivo = strtoupper($_REQUEST['n_impmotivo']);
	
	$sql_impe_control = "update impedidos set origen='$n_impentidad', motivo='$n_impmotivo' where idimpedido='$m_cod'";
				  
    $exe_impe_control = mysql_query($sql_impe_control, $conexion);
	
	?>
	
    
