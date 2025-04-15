	<?php
    
    include("../view/funciones.php");
    
    $conexion = Conectar();
    
	$id_domiciliario = $_REQUEST['n_iddomi'];
	$num_certificado = $_REQUEST['n_numcert'];
	$fec_ingreso = $_REQUEST['n_fecha'];
	$num_formu = $_REQUEST['n_formu'];
	$nombre_solic = strtoupper($_REQUEST['n_solicitante']);
	$tipdoc_solic = $_REQUEST['n_tipdocus'];
	$numdoc_solic = $_REQUEST['n_numdocus'];
	$domic_solic = strtoupper($_REQUEST['n_domicilio']);
	$motivo_solic = $_REQUEST['n_motivo'];
	$distrito_solic = $_REQUEST['n_idubigeo'];
	$texto_cuerpo = $_REQUEST['n_cuerpo'];
	$nom_testigo = strtoupper($_REQUEST['n_testigo']);
	$tdoc_testigo = $_REQUEST['n_tipdocut'];
	$ndocu_testigo = $_REQUEST['n_numdocut'];
	$idestcivil = $_REQUEST['n_civil'];
	$sexo = $_REQUEST['n_sexo'];
	$profesionc = $_REQUEST['n_idprofesion'];

	echo $sql_ndomiciliario = "insert 
						  into cert_domiciliario(id_domiciliario, num_certificado, fec_ingreso, num_formu, nombre_solic, tipdoc_solic, numdoc_solic, domic_solic, motivo_solic, distrito_solic, texto_cuerpo, justifi_cuerpo, nom_testigo, tdoc_testigo,ndocu_testigo, idestcivil, sexo, detprofesionc, profesionc, especificacion)  
					 values('$id_domiciliario','$num_certificado','$fec_ingreso','$num_formu','$nombre_solic','$tipdoc_solic','$numdoc_solic','$domic_solic','$motivo_solic','$distrito_solic','$texto_cuerpo','$justifi_cuerpo','$nom_testigo','$tdoc_testigo','$ndocu_testigo','$idestcivil','$sexo','$detprofesionc','$profesionc','$especificacion')";
			  
	$exe_ndomiciliario = mysql_query($sql_ndomiciliario, $conexion);

	?>