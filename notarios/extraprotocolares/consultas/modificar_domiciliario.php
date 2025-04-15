	<?php
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$id_domiciliario = $_REQUEST['m_iddomi'];
	$num_certificado = $_REQUEST['m_numcert'];
	$fec_ingreso = $_REQUEST['m_fecha'];
	$nombre_solic = $_REQUEST['m_solicitante'];
	$domic_solic = $_REQUEST['m_domicilio'];
	$motivo_solic = $_REQUEST['m_motivo'];
	$num_formu = $_REQUEST['m_formu'];
	$tipdoc_solic = $_REQUEST['m_tipdocus'];
	$numdoc_solic = $_REQUEST['m_numdocus'];
	$distrito_solic = $_REQUEST['m_idubigeo'];
	$texto_cuerpo = $_REQUEST['m_cuerpo'];
	$nom_testigo = $_REQUEST['m_testigo'];
	$tdoc_testigo = $_REQUEST['m_tipdocut'];
	$ndocu_testigo = $_REQUEST['m_numdocut'];
	$idestcivil = $_REQUEST['m_civil'];
	$sexo = $_REQUEST['m_sexo'];
	$profesionc = $_REQUEST['m_idprofesion'];
	
	$sql_mdom =  "update cert_domiciliario set fec_ingreso='$fec_ingreso', nombre_solic='$nombre_solic', domic_solic='$domic_solic', motivo_solic='$motivo_solic', num_formu='$num_formu', tipdoc_solic='$tipdoc_solic', numdoc_solic='$numdoc_solic', distrito_solic='$distrito_solic', texto_cuerpo='$texto_cuerpo', nom_testigo='$nom_testigo', tdoc_testigo='$tdoc_testigo', ndocu_testigo='$ndocu_testigo', idestcivil='$idestcivil', sexo='$sexo', profesionc='$profesionc' where cert_domiciliario.id_domiciliario ='$id_domiciliario'";
				  
    $exe_mdom = mysql_query($sql_mdom, $conexion);
	

	
	?>