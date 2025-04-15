	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_condicion=$_REQUEST['id_condicion'];
	$m_tipact=$_REQUEST['m_tipact'];
	$m_cond=strtoupper($_REQUEST['m_cond']);
	$m_sunat=$_REQUEST['m_sunat'];
	$m_uif=$_REQUEST['m_uif'];
	$m_form=$_REQUEST['m_form'];
	$m_monto=$_REQUEST['m_monto'];
	
	$sql_macto =  "update actocondicion set
	idtipoacto='$m_tipact', condicion='$m_cond', parte='$m_sunat', formulario='$m_form', uif='$m_uif', montop='$m_monto' where actocondicion.idcondicion=$id_condicion";
				  
    $exe_macto = mysql_query($sql_macto, $conexion);
	
	?>
	
    
