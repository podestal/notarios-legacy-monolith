	<?php
    
    include("../extraprotocolares/view/funciones.php");
    
	include("../consultas/kardex.php");
	
    $conexion = Conectar();
	
	$idcliente = $_REQUEST['c_idcliente'];
	
	$arr_cliente = dame_cliente($idcliente);
	
	$sql_idcont =  "SELECT
					contratantes.idcontratante
					FROM
					contratantes
					ORDER BY
					cast(contratantes.idcontratante as signed) DESC";
					
	$exe_idcont = mysql_query($sql_idcont, $conexion);
	
	$row_idcont = mysql_fetch_array($exe_idcont);
	
	$new_idcont = $row_idcont[0]+1;
	
	$new_idcont = correlativo_numero10($new_idcont);
	
	$idcontratante = $new_idcont;
	$idtipkar = $_REQUEST['tipkardex'];
	$kardex = $_REQUEST['codkardex'];
	$condicion = $_REQUEST[''];
	$firma = $_REQUEST['c_firma'];
	$fechafirma = $_REQUEST[''];
	$resfirma = 0;
	$tiporepresentacion = $_REQUEST[''];
	$idcontratanterp = $_REQUEST[''];
	$facultades = $_REQUEST['']; 
	$idsedereg = $_REQUEST[''];
	$numpartida = $_REQUEST[''];
	$indice = $_REQUEST['c_indice'];
	$visita = $_REQUEST[''];
	$inscrito = $_REQUEST[''];
 
	$sql_ncontratante = "insert into contratantes (idcontratante, idtipkar, kardex, condicion, firma, fechafirma, resfirma, tiporepresentacion, idcontratanterp, facultades, idsedereg, numpartida, indice, visita, inscrito) values('$idcontratante', '$idtipkar', '$kardex', '$condicion', '$firma', '$fechafirma', '$resfirma', '$tiporepresentacion', '$idcontratanterp', '$facultades', '$idsedereg', '$numpartida', '$indice', '$visita', '$inscrito')";
	
	$exe_ncontratante = mysql_query($sql_ncontratante, $conexion);

	$tipper = $arr_cliente[1];
	$apepat = $arr_cliente[2];
	$apemat = $arr_cliente[3];
	$prinom = $arr_cliente[4];
	$segnom = $arr_cliente[5];
	$direccion = $arr_cliente[6];
	$n_nombre = $arr_cliente[7];
	$razonsocial = $arr_cliente[8];
	$domfiscal = $arr_cliente[9];
	$numdoc = $arr_cliente[10];
	$email = $arr_cliente[11];
	$telfijo = $arr_cliente[12];
	$telcel = $arr_cliente[13];
	$telofi = $arr_cliente[14];
	$sexo = $arr_cliente[15];
	if (trim($arr_cliente[15])!=""){$sexo = $arr_cliente[15];}else{$sexo = 0;}
	$idestcivil = $arr_cliente[16];
	$natper =  $arr_cliente[17];
	$conyuge = $arr_cliente[18];
	$nacionalidad = $arr_cliente[19];
	if (trim($arr_cliente[20])!=""){$idprofesion = $arr_cliente[20];}else{$idprofesion = 0;}
	$detaprofesion = $arr_cliente[21];
	if (trim($arr_cliente[22])!=""){$idcargoprofe = $arr_cliente[22];}else{$idcargoprofe = 0;}
	if (trim($arr_cliente[23])!=""){$profocupa = $profocupa[23];}else{$profocupa = 0;}
	$dirfer = $arr_cliente[24];
	$idubigeo = $arr_cliente[25];
	$cumpclie = $arr_cliente[26];
	$fechaing = $arr_cliente[27];
	$telempresa = $arr_cliente[28];
	$mailempresa = $arr_cliente[29];
	$contacempresa = $arr_cliente[30];
	$fechaconstitu = $arr_cliente[31];
	if (trim($arr_cliente[32])!=""){$idsedereg = $arr_cliente[32];}else{$idsedereg = 0;}
	$numregistro = $arr_cliente[33];
	$numpartida = $arr_cliente[34];
	$actmunicipal =  $arr_cliente[35];
	if(trim($arr_cliente[36])!=""){$tipocli=$arr_cliente[36];}else{$tipocli=0;}
	$impeingre = $arr_cliente[37];
	$impnumof = $arr_cliente[38];
	$impeorigen =  $arr_cliente[39];
	$impentidad = $arr_cliente[40];
	$impremite = $arr_cliente[41];
	$impmotivo = $arr_cliente[42];
	$residente = $arr_cliente[43];
	$docpaisemi = $arr_cliente[44];
	$idtipdoc = $arr_cliente[45];
	
	$sql_cliente2 = "insert into cliente2 (idcontratante, idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo, residente, docpaisemi) values('$idcontratante', '$idcliente', '$tipper', '$apepat', '$apemat', '$prinom', '$segnom', '$nombre', '$direccion', '$idtipdoc', '$numdoc', '$email', '$telfijo', '$telcel', '$telofi', '$sexo', '$idestcivil', '$natper', '$conyuge', '$nacionalidad', '$idprofesion', '$detaprofesion', '$idcargoprofe', '$profocupa', '$dirfer', '$idubigeo', '$cumpclie', '$fechaing', '$razonsocial', '$domfiscal', '$telempresa', '$mailempresa', '$contacempresa', '$fechaconstitu', '$idsedereg', '$numregistro', '$numpartida', '$actmunicipal', '$tipocli', '$impeingre', '$impnumof', '$impeorigen', '$impentidad', '$impremite', '$impmotivo', '$residente', '$docpaisemi')";
	
	$exe_cliente2 = mysql_query($sql_cliente2, $conexion);
	
	?>
    
   
	
    