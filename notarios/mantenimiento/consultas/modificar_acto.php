	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$idtipkar = $_REQUEST['m_tipkar']; 
	$idtipoacto = $_REQUEST['m_cod'];
	$desacto = strtoupper($_REQUEST['m_desc']);
	$actosunat = $_REQUEST['m_sunat'];
	$impuestos = $_REQUEST['m_impuesto'];
	if($impuestos==""){$impuestos=0;}
	$actouif = $_REQUEST['m_uif'];
	$umbral = $_REQUEST['m_umbral'];
	if($umbral==""){$umbral=0;}
	$idmodelo = $_REQUEST['m_modelo'];
	if($idmodelo==""){$idmodelo=0;}
	
	$sql_macto =  "update tiposdeacto set idtipkar='$idtipkar',idtipoacto='$idtipoacto', desacto='$desacto', actosunat='$actosunat', impuestos='$impuestos', actouif='$actouif', umbral='$umbral', idmodelo='$idmodelo' where tiposdeacto.idtipoacto= $idtipoacto";
				  
    $res_macto = mysql_query($sql_macto, $conexion);
	
	?>
	
    
