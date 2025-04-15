	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_servicio = $_REQUEST['id_servicio'];
	$descrip = strtoupper($_REQUEST['m_desc']);
	$tipo = $_REQUEST['m_tipserv'];
	$precio1 = $_REQUEST['m_precio1'];
	$precio2 = $_REQUEST['m_precio2'];
	$grupo = $_REQUEST['m_grupo'];
	$codigo = $_REQUEST['m_cod'];
	$abrev = $_REQUEST['m_abrev'];
	$porcentaje = $_REQUEST['m_porcentaje'];
	$kardex = $_REQUEST['m_kardex'];
	$infrrpp = $_REQUEST['m_inf'];
	//$activo = $_REQUEST[''];
	$area1 = $_REQUEST['m_area'];
	$serarea = $_REQUEST['m_sarea'];
	$ctaserv = $_REQUEST['m_cuenta'];
	
	if($_REQUEST['m_incpre']==""){
		$m_incpre=intval(0);
	}else if($_REQUEST['m_incpre']==1){
		$m_incpre= intval(1);
	}
	
	$sql_mservicio =  "update servicios set descrip='$descrip', tipo='$tipo', precio1='$precio1', grupo='$grupo', codigo='$codigo', abrev='$abrev', kardex='$kardex', infrrpp='$infrrpp', area1='$area1', serarea='$serarea', ctaserv='$ctaserv',flag=$m_incpre where servicios.id_servicio='$id_servicio'";
	
	$exe_mservicio = mysql_query($sql_mservicio, $conexion) or die(mysql_error());
     
	
	
	?>