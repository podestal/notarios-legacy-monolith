	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    include("../../conexion.php");
    $conexion = Conectar();
    
	$idPresentante = $_REQUEST['idPresentante'];
	
	$numeroDocumento = $_REQUEST['dni'];
	$apellidoPaterno = strtoupper($_REQUEST['apellidoPaterno']);
	$apellidoMaterno = strtoupper($_REQUEST['apellidoMaterno']);
	$primerNombre = strtoupper($_REQUEST['primerNombre']);
	$segundoNombre = strtoupper($_REQUEST['segundoNombre']);
	$tercerNombre = strtoupper($_REQUEST['tercerNombre']);
	
	$sql = "UPDATE presentante  
	set presentante.numeroDocumento ='$numeroDocumento',
		presentante.apellidoPaterno ='$apellidoPaterno',
		presentante.apellidoMaterno = '$apellidoMaterno',
		presentante.primerNombre = '$primerNombre',
		presentante.segundoNombre ='$segundoNombre',
		presentante.tercerNombre ='$tercerNombre'
 where presentante.idPresentante ='$idPresentante'";
				  
    $exe_mcliente = mysql_query($sql, $conexion) or die(mysql_error());
	
	?>
	
    