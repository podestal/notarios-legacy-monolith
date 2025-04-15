<?php 
include("../../conexion.php");
$cliente=$_POST['_cliente'];
$tipper=$_POST['_tipper'];



	$sqlclie=mysql_query("SELECT * FROM cliente WHERE CONCAT(apepat, ' ',apemat, ' ', prinom, ' ', segnom) LIKE '%".$cliente."%' and tipper='$tipper'", $conn) or die(mysql_error());
		$row=mysql_fetch_array($sqlclie);
		
	if (!empty($row) ){
		 if ($row['tipper']=="N"){
			 include("mostrarcliente2.php");
			}else{ 
				if ($row['tipper']=="N" and $row['numdoc']==""){
			 echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>No se encontro al cliente :</span><input name='nuevo' type='button' onclick='newclient()' value='Nuevo Cliente' /><input name='cancelar' type='button' onclick='regresa_caja();' value='Cancelar' />";
				  }
			  } 
		 
	   if ($row['tipper']=="J"){
			 include ("mostrarcliente2.php");
			}else{ 
				if ($row['tipper']=="J" and $row['numdoc']==""){
			 echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>No se encontro la empresa :</span><input name='cancelar2' type='button' onclick='newclientempresa()' value='Nueva Empresa' /><input name='cancelar' type='button' onclick='regresa_caja();' value='Cancelar' />"; 
				  }
	
			  }
		
	}else{
		if ($tipper=="J"){
		  echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>No se encontro la empresa :</span><input name='cancelar2' type='button' onclick='newclientempresa();' value='Nueva Empresa' /><input name='cancelar' type='button' onclick='regresa_caja();' value='Cancelar' />"; 
		 }else if ($tipper=="N"){
		  echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;'>No se encontro al cliente :</span><input name='nuevo' type='button' onclick='newclient();' value='Nuevo Cliente' /><input name='cancelar' type='button' onclick='regresa_caja();' value='Cancelar' />";
		 }
	}






 
?>
