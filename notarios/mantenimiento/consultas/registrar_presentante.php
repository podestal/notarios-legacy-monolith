	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
  
	//$idabogado = $_REQUEST['idabogado'];
	$numeroDocumento = $_REQUEST['dni']; 
	$apellidoPaterno = $_REQUEST['apellidoPaterno'];
	$apellidoMaterno = $_REQUEST['apellidoMaterno'];
	$primerNombre = $_REQUEST['primerNombre'];
	$segundoNombre = $_REQUEST['segundoNombre'];
	$tercerNombre = $_REQUEST['tercerNombre'];
		
				
	
	$sql_presentante = "INSERT INTO presentante(numeroDocumento,apellidoPaterno,apellidoMaterno,primerNombre,segundoNombre,tercerNombre) 
	VALUES ('$numeroDocumento','$apellidoPaterno','$apellidoMaterno','$primerNombre','$segundoNombre','$tercerNombre')";
	
    $exe_ncliente = mysql_query($sql_presentante, $conexion) or die(mysql_error());
	
	?>