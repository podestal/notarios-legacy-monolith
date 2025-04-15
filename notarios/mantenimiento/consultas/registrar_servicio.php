	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_servicio = $_REQUEST['n_cod'];
	$descrip = strtoupper($_REQUEST['n_desc']);	
	$tipo = $_REQUEST['n_tipserv'];	
	$precio1 = $_REQUEST['n_precio1'];	
	$precio2 = $_REQUEST['n_precio2'];	
	$grupo = $_REQUEST['n_grupo'];

	
	$codigo =  substr(( '0000'.correlativo_numero4($id_servicio)),-4);
	
	
	
	$abrev = $_REQUEST['n_abrev'];	
	$porcentaje = $_REQUEST['n_porcentaje'];	
	$kardex = $_REQUEST['n_kardex'];	
	$infrrpp = $_REQUEST['n_inf'];	
	$activo = "1";
	$area1 = $_REQUEST['n_area'];	
	$serarea = $_REQUEST['n_sarea'];	
    $ctaserv= $_REQUEST['n_cuenta'];
	
	if($_REQUEST['n_incpre']==""){
		$n_incpre=intval(0);
	}else if($_REQUEST['n_incpre']==1){
		$n_incpre= intval(1);
	}
	
	
	$sql_nservicio = "insert into servicios ( descrip, tipo, precio1, precio2, grupo, codigo, abrev, porcentaje, kardex, infrrpp, activo, area1, serarea, ctaserv,flag) 
					values( '$descrip', '$tipo', '$precio1', '$precio2', '$grupo', '$codigo', '$abrev', '$porcentaje', '$kardex', '$infrrpp', '$activo', '$area1', '$serarea', '$ctaserv',$n_incpre)" ;

mysql_query($sql_nservicio,$conexion) or die(mysql_error());
echo "Ingresado correctamente";
	
	?>