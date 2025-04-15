	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$idtipkar = $_REQUEST['n_tipkar']; 
	$idtipoacto = $_REQUEST['n_cod'];
	$desacto = strtoupper($_REQUEST['n_desc']);
	$actosunat = $_REQUEST['n_sunat'];
	$impuestos = $_REQUEST['n_impuesto'];
	if($impuestos==""){$impuestos=0;}
	$actouif = $_REQUEST['n_uif'];
	$umbral = $_REQUEST['n_umbral'];
	if($umbral==""){$umbral=0;}
	$idmodelo = $_REQUEST['n_modelo'];
	if($idmodelo==""){$idmodelo=0;}
	
	$sql_nacto = "insert 
				  into tiposdeacto (idtipkar, idtipoacto, desacto, actosunat, impuestos, actouif, umbral, idmodelo)  
				  values('$idtipkar', '$idtipoacto', '$desacto', '$actosunat', '$impuestos', '$actouif', '$umbral', '$idmodelo')";
	
    $res_nacto = mysql_query($sql_nacto, $conexion);
	
	?>