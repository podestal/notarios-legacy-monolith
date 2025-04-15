<?php 


session_start();
include("conexion.php");
include("extraprotocolares/view/funciones.php");

$txa_minuta = addslashes(($_POST['txa_minuta'])); 

$codkardex=$_POST['codkardex'];
$idtipkar=intval($_POST['idtipkar']);

$referenciatexto=$_POST['nreferencia'];
$cabioapostro=str_replace("'","?",$referenciatexto);
$referencia=strtoupper(str_replace("ñ","Ñ",$cabioapostro));

$codactos=$_POST['codactos'];
$contrato=strtoupper(str_replace("ñ","Ñ",$_POST['contrato']));
$dregistral=$_POST['dregistral'];
$dnotarial=$_POST['dnotarial'];
$idusuario=intval($_SESSION["id_usu"]);
$responsable=intval($_SESSION["id_usu"]);
$kardexconexo=$_POST['kardexconexo'];
$idnotario=intval($_POST['idnotario']);
$fechain=$_POST['fechaingreso'];
$funcionario_new=$_POST['funcionario_new'];
$idabogado=$_POST['idabogado'];

$responsable_new=$_POST['responsable_new'];
$ob_nota=$_POST['ob_nota'];
$ins_espec=$_POST['ins_espec'];

$sql9="select * from kardex WHERE kardex='".$codkardex."'";
$consultitaaaa=mysql_query($sql9,$conn) or die(mysql_error());
$rowkarr=mysql_fetch_array($consultitaaaa);
$codactosori=$rowkarr['codactos'];

$fecha_modificacion = date("d/m/Y");


$idPresentante = $_POST['idPresentante'];
$pkTemplate = $_POST['pkTemplate'];






if($rowkarr['idtipkar']==$idtipkar){
		




		if($rowkarr['codactos']==$codactos ){
			
		   mysql_query("UPDATE kardex SET kardexconexo='$kardexconexo',referencia='$referencia',contrato='$contrato',idusuario='$idusuario',responsable='$responsable',dregistral='$dregistral', fechaingreso='$fechain',dnotarial='$dnotarial',idnotario='$idnotario', idabogado='$idabogado', responsable_new='$responsable_new', ob_nota='$ob_nota',ins_espec='$ins_espec' ,recepcion='$idusuarios',funcionario_new='$funcionario_new', fecha_modificacion ='$fecha_modificacion',
		   		idPresentante = '$idPresentante',fkTemplate='$pkTemplate',estado_sisgen ='0'
		   	WHERE kardex='$codkardex'", $conn) or die(mysql_error());
		   
		}else{



			
			mysql_query("UPDATE kardex SET kardexconexo='$kardexconexo',referencia='$referencia',codactos='$codactos',contrato='$contrato',idusuario='$idusuario',responsable='$responsable',dregistral='$dregistral', fechaingreso='$fechain', dnotarial='$dnotarial',idnotario='$idnotario', idabogado='$idabogado', responsable_new='$responsable_new', ob_nota='$ob_nota',ins_espec='$ins_espec' ,recepcion='$idusuarios',funcionario_new='$funcionario_new', fecha_modificacion ='$fecha_modificacion',idPresentante = '$idPresentante',fkTemplate='$pkTemplate',estado_sisgen ='0' WHERE kardex='$codkardex'", $conn) or die(mysql_error());
			
			
			$sqldelcontaxacto="DELETE FROM detalle_actos_kardex WHERE kardex='$codkardex'"; 
mysql_query($sqldelcontaxacto,$conn) or die(mysql_error());

			$acto1=substr($codactos,0,3);
			$acto2=substr($codactos,3,3);
			$acto3=substr($codactos,6,3);
			$acto4=substr($codactos,9,3);
			$acto5=substr($codactos,12,3);
			
			
			$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
			
			
		    $i=0;
			while ($i < count ($actoss) ) {
				$numacto=$actoss[$i];
				$consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto'", $conn) or die(mysql_error());
				$row=mysql_fetch_array($consulta);
				if(!empty($row)){
				$desactos=$row['desacto']; $idtipoacto=$row['idtipoacto']; $actosunat=$row['actosunat']; $actouif=$row['actouif'];
				$sql2="INSERT INTO detalle_actos_kardex(item, kardex, idtipoacto, actosunat, actouif, idtipkar, desacto) VALUES (NULL,'$codkardex','$idtipoacto','$actosunat','$actouif','$idtipkar','$desactos')";
				mysql_query($sql2,$conn) or die(mysql_error());    
						
				
				}
				$i++;
				}
			
		/*	$x=0;	
			$acto1a=substr($codactosori,0,3);
			$acto2a=substr($codactosori,3,3);
			$acto3a=substr($codactosori,6,3);
			$acto4a=substr($codactosori,9,3);
			$acto5a=substr($codactosori,12,3);	
			
			$actossa = array($acto1a,$acto2a,$acto3a,$acto4a,$acto5a);
			
			while ($x < count ($actossa) ) {
				$numactoa=$actossa[$x];
				
				}
				$x++;*/
				
		mysql_query("UPDATE contratantes SET condicion='',fechafirma='', facultades='' WHERE kardex='$codkardex'", $conn) or die(mysql_error());
			
			$valitem=0;
		$rctm="UPDATE contratantesxacto SET idtipoacto='', item='$valitem', idcondicion='', parte='', porcentaje='', uif='', formulario='', monto='',opago='', ofondo='', montop='' WHERE kardex='$codkardex'";
		mysql_query($rctm, $conn) or die(mysql_error());

			
		}

}else if($rowkarr['idtipkar']!=$idtipkar){
	 



	
		   mysql_query("UPDATE kardex SET kardexconexo='$kardexconexo',referencia='$referencia',contrato='$contrato',idusuario='$idusuario',responsable='$responsable',dregistral='$dregistral', fechaingreso='$fechain',dnotarial='$dnotarial',idnotario='$idnotario', codactos='$codactos', idtipkar='$idtipkar', txa_minuta = '$txa_minuta' ,idabogado='$idabogado', responsable_new='$responsable_new', ob_nota='$ob_nota',ins_espec='$ins_espec', fecha_modificacion ='$fecha_modificacion',idPresentante = '$pkCustomer',estado_sisgen ='0' WHERE kardex='$codkardex'", $conn) or die(mysql_error());
			
			
				$sqldelcontaxacto="DELETE FROM detalle_actos_kardex WHERE kardex='$codkardex'"; 
mysql_query($sqldelcontaxacto,$conn) or die(mysql_error());


			$acto1=substr($codactos,0,3);
			$acto2=substr($codactos,3,3);
			$acto3=substr($codactos,6,3);
			$acto4=substr($codactos,9,3);
			$acto5=substr($codactos,12,3);
			
			$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
		 $i=0;
			while ($i < count ($actoss) ) {
				$numacto=$actoss[$i];
				$consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto'", $conn) or die(mysql_error());
				$row=mysql_fetch_array($consulta);
				if(!empty($row)){
						$desactos=$row['desacto']; $idtipoacto=$row['idtipoacto']; $actosunat=$row['actosunat']; $actouif=$row['actouif'];
						$sql2="INSERT INTO detalle_actos_kardex(item, kardex, idtipoacto, actosunat, actouif, idtipkar, desacto) VALUES (NULL,'$codkardex','$idtipoacto','$actosunat','$actouif','$idtipkar','$desactos')";
						mysql_query($sql2,$conn) or die(mysql_error());    
							
							}
				$i++;
				}


             $valitem=0;
			 mysql_query("UPDATE contratantes SET idtipkar='$idtipkar', condicion='',fechafirma='', facultades='' WHERE kardex='$codkardex'", $conn) or die(mysql_error());
	         mysql_query("UPDATE contratantesxacto SET idtipkar='$idtipkar', idtipoacto='', item='$valitem', idcondicion='', parte='', porcentaje='', uif='', formulario='', monto='',opago='', ofondo='', montop='' WHERE kardex='$codkardex'", $conn) or die(mysql_error());
}




/*if($rowkarr['idtipkar']==$idtipkar && $rowkarr['codactos']==$codactos ){
	mysql_query("UPDATE kardex SET kardexconexo='$kardexconexo',referencia='$referencia',contrato='$contrato',idusuario='$idusuario',responsable='$responsable',dregistral='$dregistral', fechaingreso='$fechain',dnotarial='$dnotarial',idnotario='$idnotario' WHERE kardex='$codkardex'", $conn) or die(mysql_error());

					
}

if($rowkarr['idtipkar']==$idtipkar && $rowkarr['codactos']!=$codactos ){
	mysql_query("UPDATE kardex SET kardexconexo='$kardexconexo',referencia='$referencia',codactos='$codactos',contrato='$contrato',idusuario='$idusuario',responsable='$responsable',dregistral='$dregistral', fechaingreso='$fechain', dnotarial='$dnotarial',idnotario='$idnotario' WHERE kardex='$codkardex'", $conn) or die(mysql_error());
	
	
$sqlelidetakardex="DELETE FROM detalle_actos_kardex WHERE kardex='$codkardex'"; 
mysql_query($sqlelidetakardex,$conn) or die(mysql_error());
	
	
		$acto1=substr($codactos,0,3);
		$acto2=substr($codactos,3,3);
		$acto3=substr($codactos,6,3);
		$acto4=substr($codactos,9,3);
		$acto5=substr($codactos,12,3);
		
		$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
	 $i=0;
		while ($i < count ($actoss) ) {
			$numacto=$actoss[$i];
			$consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto'", $conn) or die(mysql_error());
			$row=mysql_fetch_array($consulta);
			if(!empty($row)){
					$desactos=$row['desacto']; $idtipoacto=$row['idtipoacto']; $actosunat=$row['actosunat']; $actouif=$row['actouif'];
					$sql2="INSERT INTO detalle_actos_kardex(item, kardex, idtipoacto, actosunat, actouif, idtipkar, desacto) VALUES (NULL,'$codkardex','$idtipoacto','$actosunat','$actouif','$idtipkar','$desactos')";
				     mysql_query($sql2,$conn) or die(mysql_error()); 
					
						
						}
			
			$i++;
			
			
			}		
	$sql5="UPDATE contratantes SET condicion='',firma='0',fechafirma='',resfirma='',tiporepresentacion='0',facultades='',indice='0' WHERE kardex='$codkardex'";
mysql_query($sql5,$conn) or die(mysql_error());

$sql6="UPDATE contratantesxacto SET idtipoacto='',item='',idcondicion='',parte='',porcentaje='',uif='',formulario='' WHERE kardex='$codkardex'";
mysql_query($sql6,$conn) or die(mysql_error());            
					
}

if($rowkarr['idtipkar']!=$idtipkar){
	mysql_query("UPDATE kardex SET idtipkar='$idtipkar',kardexconexo='$kardexconexo',referencia='$referencia',codactos='$codactos',contrato='$contrato',idusuario='$idusuario',responsable='$responsable',dregistral='$dregistral', fechaingreso='$fechain',  dnotarial='$dnotarial',idnotario='$idnotario' WHERE kardex='$codkardex'", $conn) or die(mysql_error());
	
	$sqlelidetakardex="DELETE FROM detalle_actos_kardex WHERE kardex='$codkardex'"; 
mysql_query($sqlelidetakardex,$conn) or die(mysql_error());

		$acto1=substr($codactos,0,3);
		$acto2=substr($codactos,3,3);
		$acto3=substr($codactos,6,3);
		$acto4=substr($codactos,9,3);
		$acto5=substr($codactos,12,3);
		
		$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
	 $i=0;
		while ($i < count ($actoss) ) {
			$numacto=$actoss[$i];
			$consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto'", $conn) or die(mysql_error());
			$row=mysql_fetch_array($consulta);
			if(!empty($row)){
					$desactos=$row['desacto']; $idtipoacto=$row['idtipoacto']; $actosunat=$row['actosunat']; $actouif=$row['actouif'];
					
					$sql2="INSERT INTO detalle_actos_kardex(item, kardex, idtipoacto, actosunat, actouif, idtipkar, desacto) VALUES (NULL,'$codkardex','$idtipoacto','$actosunat','$actouif','$idtipkar','$desactos')";
				     mysql_query($sql2,$conn) or die(mysql_error()); 
						
						}
			
			$i++;
			
			
			}		
	$sql5="UPDATE contratantes SET idtipkar='$idtipkar', condicion='',firma='0',fechafirma='',resfirma='',tiporepresentacion='0',facultades='',indice='0' WHERE kardex='$codkardex'";
mysql_query($sql5,$conn) or die(mysql_error());

$sql6="UPDATE contratantesxacto SET idtipkar='$idtipkar',idtipoacto='',item='',idcondicion='',parte='',porcentaje='',uif='',formulario='' WHERE kardex='$codkardex'";
mysql_query($sql6,$conn) or die(mysql_error());    
					
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*mysql_query("UPDATE kardex SET idtipkar='$idtipkar',kardexconexo='$kardexconexo',referencia='$referencia',codactos='$codactos',contrato='$contrato',idusuario='$idusuario',responsable='$responsable',dregistral='$dregistral',dnotarial='$dnotarial',idnotario='$idnotario' WHERE kardex='$codkardex'", $conn) or die(mysql_error());


    $acto1=substr($codactos,0,3);
	$acto2=substr($codactos,3,3);
	$acto3=substr($codactos,6,3);
	$acto4=substr($codactos,9,3);
	$acto5=substr($codactos,12,3);
	
	$actoss = array($acto1,$acto2,$acto3,$acto4,$acto5);
 $i=0;
	while ($i < count ($actoss) ) {
		$numacto=$actoss[$i];
        $consulta=mysql_query("Select * from tiposdeacto where idtipoacto = '$numacto'", $conn) or die(mysql_error());
		$row=mysql_fetch_array($consulta);
		if(!empty($row)){
		        $desactos=$row['desacto']; $idtipoacto=$row['idtipoacto']; $actosunat=$row['actosunat']; $actouif=$row['actouif'];
				
				$sql2="UPDATE detalle_actos_kardex SET idtipoacto='$idtipoacto',actosunat='$actosunat',actouif='$actouif',idtipkar='$idtipkar',desacto='$desactos' WHERE kardex='$codkardex'";
				mysql_query($sql2,$conn) or die(mysql_error());    
					
					}
		
		$i++;
		
		
		}
 
 
 
 $sql5="UPDATE contratantes SET idtipkar='$idtipkar', condicion='',firma='',fechafirma='',resfirma='',tiporepresentacion='',facultades='',indice='' WHERE kardex='$codkardex'";
mysql_query($sql5,$conn) or die(mysql_error());

$sql6="UPDATE contratantesxacto SET idtipkar='$idtipkar',idtipoacto='',item='',idcondicion='',parte='',porcentaje='',uif='',formulario='' WHERE kardex='$codkardex'";
mysql_query($sql6,$conn) or die(mysql_error());    */

?>