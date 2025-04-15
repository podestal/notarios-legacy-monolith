	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_domiciliario = $REQUEST['n_iddomi'];
	$num_certificado = $REQUEST[''];
	$fec_ingreso = $REQUEST['n_fecha'];
	$num_formu = $REQUEST['n_formu'];
	$nombre_solic = $REQUEST['n_solicitante'];
	$tipdoc_solic = $REQUEST['n_tipdocus'];
	$numdoc_solic = $REQUEST['n_numdocus'];
	$domic_solic = $REQUEST['n_domicilio'];
	$motivo_solic = $REQUEST['n_motivo'];
	$distrito_solic = $REQUEST['n_ubigeo'];
	$texto_cuerpo = $REQUEST['n_cuerpo'];
	$justifi_cuerpo = $REQUEST[''];
	$nom_testigo = $REQUEST['n_testigo'];
	$tdoc_testigo = $REQUEST['n_tipdocut'];
	$ndocu_testigo = $REQUEST['n_numdocut'];
	$idestcivil = $REQUEST['n_civil'];
	$sexo = $REQUEST['n_sexo'];
	$detprofesionc = $REQUEST[''];
	$profesionc = $REQUEST['n_profesion'];
	$especificacion = $REQUEST[''];
	
	$sql_ndomiciliario = "insert 
						  into cert_domiciliario(id_domiciliario, num_certificado, fec_ingreso, num_formu, nombre_solic, tipdoc_solic, numdoc_solic, domic_solic, motivo_solic, distrito_solic, texto_cuerpo, justifi_cuerpo, nom_testigo, tdoc_testigo,ndocu_testigo, idestcivil, sexo, detprofesionc, profesionc, especificacion)  
					 values('$id_domiciliario','$num_certificado','$fec_ingreso','$num_formu','$nombre_solic','$tipdoc_solic','$numdoc_solic','$domic_solic','$motivo_solic','$distrito_solic','$texto_cuerpo','$justifi_cuerpo','$nom_testigo','$tdoc_testigo','$ndocu_testigo','$idestcivil','$sexo','$detprofesionc','$profesionc','$especificacion')";
			  
	//$exe_ndomiciliario = mysql_query($sql_ndomiciliario, $conexion);

	?>