<?php 
include("../../conexion.php");
$tipoper=$_POST['tipoper'];
$numdoc=$_POST['numdoc'];
$tipodoc=$_POST['tipodoc'];


if($numdoc==""){ echo "";}else{

$sqlclie=mysql_query("select * from cliente where  numdoc = '$numdoc' and tipper = 'N' and idtipdoc='$tipodoc'", $conn) or die(mysql_error());

if($tipodoc =="11" || $tipodoc=="9"){
	echo "<table width='650' border='1' cellspacing='0'  bordercolor='#333333' cellpadding='0'>
  <tr>
    <td width='412'><span style='font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;'>Apellidos y Nombres</span></td>
    <td width='121' align='center'><span style='font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#333;'>Nro Documento</span></td>
    <td width='109' align='center'><a onclick='newclient()'><img src='../../iconos/newusuario.png' width='31' height='30' /></a></td>
  </tr>";
while($row=mysql_fetch_array($sqlclie)){
	echo "
  <tr>
    <td height='39'>".$row['nombre']."</td>
    <td>".$row['numdoc']."</td>
    <td align='center'><a id='".$row['idcliente']."' onclick='seleccionaclie(this.id);'><img src='../../iconos/seleccionar.png' width='94' height='29' /></a></td>
  </tr>";

	}	
echo "</table>";

}else{

$row=mysql_fetch_array($sqlclie);
if (!empty($row)){
	 if ($row['tipper']=="N"){
		 include("../view/mostrarclientelib.php");
		}else{ 
		  include ("../view/mostrarempresalib.php");} 
}else{
    if ($tipoper!="N"){
	  echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro la empresa :</span> <a onClick='newclientempresa()'><img src='../../iconos/newcliente.png' width='134' height='28' border='0'></a>"; 
	 }else{
	  echo"<span style='font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px;'>No se encontro al cliente :</span><a onClick='newclient()'> <img src='../../iconos/newcliente.png' width='134' height='28' border='0'></a>";
	 }
}
}
}
?>
