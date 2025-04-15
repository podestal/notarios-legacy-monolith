<?php 
include("conexion.php");
$tipoper = $_POST['tipoper'];
$numdoc  = $_POST['numdoc'];
$tip_poder = $_POST['tip_poder'];


$sqlclie=mysql_query("select * from cliente where  numdoc='$numdoc' and tipper='$tipoper'", $conn) or die(mysql_error());
$row=mysql_fetch_array($sqlclie);
if (!empty($row)){
	 if ($row['tipper']=="N"){
		 if($row['numdoc']!=""){
			 include("mostrarclientelibP.php");
			 }else{ echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro al cliente :</span><a onClick='newclient()'> <img src='iconos/newcliente.png' width='134' height='28' border='0'></a>"; }
		 
		}
		
	 if($row['tipper']=="J"){ 
	  if($row['numdoc']!=""){
			 include("mostrarempresalibP.php");
			 }else{ echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro la empresa :</span> <a onClick='newclientempresa()'><img src='iconos/newcliente.png' width='134' height='28' border='0'></a>"; }
	 }
	  
		
}else{
    if ($tipoper=="N"){
	   echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro al cliente :</span><a onClick='newclient()'> <img src='iconos/newcliente.png' width='134' height='28' border='0'></a>";
	 }else{
	 
	  echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro la empresa :</span> <a onClick='newclientempresa()'><img src='iconos/newcliente.png' width='134' height='28' border='0'></a>"; 
	 }
}

?>