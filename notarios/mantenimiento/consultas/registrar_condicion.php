	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$idcondicion = $_REQUEST['n_cod']; 
	//$idtipoacto = $_REQUEST['n_tipkar']; 
	$idtipoacto = $_REQUEST['n_tipact']; 
	$condicion = strtoupper($_REQUEST['n_cond']); 
	$parte = $_REQUEST['n_sunat']; 
	$formulario = $_REQUEST['n_form']; 
	$uif = $_REQUEST['n_uif']; 
	$montop = $_REQUEST['n_monto']; 
	
	$sql_nacto = "insert 
				  into actocondicion (idcondicion, idtipoacto, condicion, parte, formulario, uif, montop)  
				  values('$idcondicion', '$idtipoacto', '$condicion', '$parte', '$formulario', '$uif', '$montop')";
	
    $exe_nacto = mysql_query($sql_nacto, $conexion);
	
	?>