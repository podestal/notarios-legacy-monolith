<?php 
include("../../conexion.php");
$tipodocumen=$_POST['_tipo_doc'];
$numdoc=$_POST['_num_doc'];



if($numdoc!=""){
	$sqlclie=mysql_query("select * from cliente where  numdoc='$numdoc' and idtipdoc='$tipodocumen'", $conn) or die(mysql_error());
	$row=mysql_fetch_array($sqlclie);
	if (!empty($row) ){
		 if ($row['tipper']=="N" and $row['numdoc']!=""){
			 include("mostrarcliente2.php");
			 
			}else{ 
				if ($row['tipper']=="N" and $row['numdoc']==""){
			 echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro al cliente :</span><input name='nuevo' type='button' onclick='newclient2()' value='Nuevo Cliente' /><input name='cancelar' type='button' onclick='regresa_caja2();' value='Cancelar' />";
				  }
			  } 
		 
	   if ($row['tipper']=="J" and $row['numdoc']!=""){
			 include ("mostrarcliente2.php");
			 
			}else{ 
				if ($row['tipper']=="J" and $row['numdoc']==""){
			 echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro la empresa :</span><input name='cancelar2' type='button' onclick='newclientempresa2()' value='Nueva Empresa' /><input name='cancelar' type='button' onclick='regresa_caja2();' value='Cancelar' />"; 
				  }
	
			  }
		
	}else{
		if ($tipodocumen=="8"){
		  echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro la empresa :</span><input name='cancelar2' type='button' onclick='newclientempresa2();' value='Nueva Empresa' /><input name='cancelar' type='button' onclick='regresa_caja2();' value='Cancelar' />"; 
		 }else{
		  echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro al cliente :</span><input name='nuevo' type='button' onclick='newclient2();' value='Nuevo Cliente' /><input name='cancelar' type='button' onclick='regresa_caja2();' value='Cancelar' />";
		 }
	}

}




 
?>
