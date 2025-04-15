	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    include("../../conexion.php");
    $conexion = Conectar();
    
	$idabogado = $_REQUEST['idabogado'];
	
	$direccion = strtoupper($_REQUEST['direccion']);
	$documento= $_REQUEST['documento'];

	$razonsocial = $_REQUEST['razonsocial'];
	$matricula = $_REQUEST['matricula'];
	$sede_colegio = $_REQUEST['sede_colegio'];
		$telefono = $_REQUEST['telefono'];
	
	
	$sql_mcliente = "update tb_abogado 
	set tb_abogado.razonsocial='$razonsocial',
		tb_abogado.documento ='$documento',
		tb_abogado.telefono = '$telefono',
		tb_abogado.direccion = '$direccion',
		tb_abogado.matricula ='$matricula',
		tb_abogado.sede_colegio ='$sede_colegio'
 where tb_abogado.idabogado='$idabogado'";
				  
    $exe_mcliente = mysql_query($sql_mcliente, $conexion) or die(mysql_error());
	
	?>
	
    
