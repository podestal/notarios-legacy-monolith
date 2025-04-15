<?php 

include ("../../conexion.php");


$n_cod=$_REQUEST['n_cod'];
$idcliente=$_REQUEST['idcliente'];
	
	if($n_cod!="" && $idcliente!=""){
$sql=mysql_query("insert into deta_impe (id,idimpedido,idcliente) 
				  values (NULL,'".$n_cod."','".$idcliente."')",$conn);
				  
				  if($sql){
					
					$update=mysql_query("update cliente set tipocli='1' where idcliente='".$idcliente."'",$conn) ;  
					  
				  }
	}
	


?>