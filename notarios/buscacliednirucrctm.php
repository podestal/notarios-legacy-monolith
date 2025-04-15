<?php 
include("conexion.php");

$buscanombemp  = strtoupper($_POST['nompersona']);
$consulta = mysql_query("SELECT UPPER((CASE WHEN (cliente.tipper='N') THEN CONCAT(cliente.apepat,' ',cliente.apemat,' ',cliente.prinom,' ',cliente.segnom) ELSE cliente.razonsocial END)) AS 'cliente', 
cliente.idtipdoc, cliente.tipper, cliente.numdoc, cliente.idcliente 
FROM cliente 
WHERE CONCAT(cliente.apepat,' ',cliente.apemat,' ',cliente.prinom,' ',cliente.segnom) LIKE '%".$buscanombemp."%' OR cliente.razonsocial LIKE '%".$buscanombemp."%' ", $conn) or die(mysql_error());
	echo"<table width='650' border='1' cellspacing='0'  bordercolor='#333333' cellpadding='1'>
  <tr>
    <td width='412'><span style='font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#333;'>Apellidos y Nombres</span></td>
    <td width='121' align='center'><span style='font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#333;'>Nro Documento</span></td>
    <td width='109' align='center'><a onclick='newclientrctm()'><img src='iconos/newusuario.png' width='31' height='30' /></a><a onclick='newclientrucrctm()'><img src='iconos/newemp.fw.png' width='31' height='30' /></a></td>
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
    <td align='center'><a id='".$fila['idcliente']."' onclick='seleccionacontraxxx(this.id);'><img src='iconos/seleccionar.png' width='94' height='29' /></a></td>
    
  </tr>";
  

    } 
	echo"</table";

?>
