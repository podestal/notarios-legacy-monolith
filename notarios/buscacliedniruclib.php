<?php 
include("conexion.php");
$tipoper=$_POST['tipoper'];
$numdoc=$_POST['numdoc'];
$buscanom=strtoupper($_POST['buscanombre']);




if($numdoc!=""){

	if (strpos($numdoc, 'CODJU') !== false) {
		$query = "SELECT * FROM cliente WHERE  numdoc_plantilla='$numdoc'";
	}else{
		$query = "SELECT * FROM cliente WHERE  numdoc='$numdoc'";
	}
	
	$sqlclie=mysql_query($query, $conn) or die(mysql_error());
	$row=mysql_fetch_array($sqlclie);


	if (!empty($row) ){

		if (strpos($row['numdoc_plantilla'], 'CODJU') !== false) {
			$nroDoc = $row['numdoc_plantilla'];
		}else{
			$nroDoc = $row['numdoc'];
		}

		 if ($row['tipper']=="N" and $nroDoc!=""){
			 include("mostrarclientelib.php");
			}else{ 
				if ($row['tipper']=="N" and $nroDoc==""){
			 echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro al cliente :</span><a onClick='newclient()'> <img src='iconos/newcliente.png' width='134' height='28' border='0'></a><input type='hidden' name='codclie' id='codclie' value=''/>";
				  }
			  } 
		 
	   if ($row['tipper']=="J" and $nroDoc!=""){
			 include ("mostrarempresalib.php");
			}else{ 
				if ($row['tipper']=="J" and $nroDoc==""){
			 echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro la empresa :</span> <a onClick='newclientempresa()'><img src='iconos/newcliente.png' width='134' height='28' border='0'></a><input type='hidden' name='codclie' id='codclie' value=''/>"; 
				  }
	
			  }
		
	}else{
		if ($tipoper!="N"){
		  echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro la empresa :</span> <a onClick='newclientempresa()'><img src='iconos/newcliente.png' width='134' height='28' border='0'></a><input type='hidden' name='codclie' id='codclie' value=''   />"; 
		 }else{
		  echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro al cliente :</span><a onClick='newclient()'> <img src='iconos/newcliente.png' width='134' height='28' border='0'></a><input type='hidden' name='codclie' id='codclie' value=''   />";
		 }
	}

}

if($buscanom!=""){
	
	
$consulta = mysql_query("SELECT UPPER((CASE WHEN (cliente.tipper='N') THEN CONCAT(cliente.apepat,' ',cliente.apemat,' ',cliente.prinom,' ',cliente.segnom) ELSE cliente.razonsocial END)) AS 'cliente', cliente.idtipdoc, cliente.tipper, cliente.numdoc, cliente.idcliente FROM cliente where cliente.nombre LIKE '%".$buscanom."%' OR cliente.razonsocial LIKE '%".$buscanom."%' ", $conn) or die(mysql_error());
	echo"<table width='650' border='1' cellspacing='0'  bordercolor='#333333' cellpadding='1'>
  <tr>
    <td width='412'><span style='font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;'>Apellidos y Nombres</span></td>
    <td width='121' align='center'><span style='font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;'>Nro Documento</span></td>
    <td width='109' align='center'><a onclick='newclient()'><img src='iconos/newusuario.png' width='31' height='30' /></a><a onclick='newclientempresa()'><img src='iconos/newemp.fw.png' width='31' height='30' /></a></td>
  </tr>";

   while($fila=mysql_fetch_array($consulta))
    {
     $nomyape=strtoupper($fila['cliente']);
	 $textorefe=str_replace("?","'",$nomyape);
	 $textoampers=str_replace("*","&",$textorefe);
	 $textoamperss=str_replace("ñ","Ñ",$textoampers);
	 $clientes=strtoupper($textoamperss);
	 
	
   echo"	 
  <tr>
    <td height='39'><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;'>".$clientes."</span></td>
    <td><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#333;'>".$fila['numdoc']."</span></td>
    <td align='center'><a id='".$fila['idcliente']."' onclick='seleccionacliente(this.id);'><img src='iconos/seleccionar.png' width='94' height='29' /></a></td>
    
  </tr>";
  

    } 
	echo"</table";
	}


if($buscanom=="" && $numdoc==""){
	
	echo '<input type="hidden" name="codclie" id="codclie" value="" />';
	}


 
?>
