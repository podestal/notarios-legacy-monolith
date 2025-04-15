<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
          <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
            <tr>
              <td width="10%" align="center"><span class="titubuskar0">Nro Oficio</span></td>
               <td width="10%" align="center"><span class="titubuskar0">Origen</span></td>
               <td width="20%" align="center"><span class="titubuskar0">Cliente</span></td>
               <td width="10%" align="center"><span class="titubuskar0">N° Doc</span></td>
               <td width="20%" align="center"><span class="titubuskar0">Direccion</span></td>
               
               
              <td width="10%" align="center"><span class="titubuskar0">Fechaing</span></td>
               <td width="10%" align="center"><span class="titubuskar0">Tipo</span></td>
			  <td width="10%" align="center"><span class="titubuskar0">Accion</span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="bkardex">
<?php
include("../../conexion.php");
  $_epublic = $_POST["_epublic"];
  $val  = $_POST["val"];
  $valor  = $_POST["valor"];
 


if($_epublic!='N' & $_epublic!='J'){
	//echo "pablo";
 $consulcontrat=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE cliente.tipocli = '1' ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row = mysql_fetch_array($consulcontrat)){
/*$des=$row['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);
<td width='10%' align='center' ></td>
*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row['Cliente']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row['DOCUMENTO']."</span></td>
	   <td width='20%' align='center' ><span class='reskar'>".$row['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row['Fecha']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row['Tipo']."</span></td>
    <td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";
$i++;
}
}


if($_epublic!='ini' & $_epublic!='J' and $valor=='5'){
$consulcontrat1=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE cliente.impeorigen  LIKE '%$val%'  AND cliente.tipper='N' AND cliente.tipocli='1'  ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat1)){
/*$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row1['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row1['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row1['Cliente']."</span></td>
	   <td width='10%' align='center' ><span class='reskar'>".$row1['DOCUMENTO']."</span></td>
	     <td width='20%' align='center' ><span class='reskar'>".$row1['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row1['Fecha']."</span></td>
  <td width='10%' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row1['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row1['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";
$i++;
}
}


if($_epublic!='ini' & $_epublic!='N' and $valor=='5'){
$consulcontrat1=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE cliente.impeorigen  LIKE '%$val%'  AND cliente.tipper='J'  AND cliente.tipocli='1' ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat1)){
/*$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row1['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row1['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row1['Cliente']."</span></td>
	   <td width='10%' align='center' ><span class='reskar'>".$row1['DOCUMENTO']."</span></td>
	     <td width='20%' align='center' ><span class='reskar'>".$row1['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row1['Fecha']."</span></td>
  <td width='10%' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row1['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row1['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";
$i++;
}
}


if($_epublic!='ini' & $val!='J' and $valor=='4'){
	
$consulcontrat11=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE cliente.impnumof  LIKE '%$val%'  AND cliente.tipper='N' AND cliente.tipocli='1' ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat11)){
/*$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row1['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row1['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row1['Cliente']."</span></td>
	   <td width='10%' align='center' ><span class='reskar'>".$row1['DOCUMENTO']."</span></td>
	     <td width='20%' align='center' ><span class='reskar'>".$row1['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row1['Fecha']."</span></td>
   <td width='10%' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
	<td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row1['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row1['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";

$i++;
}
}


if($_epublic!='ini' & $val!='N' and $valor=='4'){
	
$consulcontrat11=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE cliente.impnumof  LIKE '%$val%'  AND cliente.tipper='J' AND cliente.tipocli='1'  ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat11)){
/*$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row1['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row1['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row1['Cliente']."</span></td>
	   <td width='10%' align='center' ><span class='reskar'>".$row1['DOCUMENTO']."</span></td>
	     <td width='20%' align='center' ><span class='reskar'>".$row1['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row1['Fecha']."</span></td>
   <td width='10%' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
	<td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row1['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row1['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";

$i++;
}
}


if($_epublic!='ini' & $val!='J' and $valor=='6'){
	
$consulcontrat11=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) LIKE '%$val%'  AND cliente.tipper='N' AND cliente.tipocli='1' ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat11)){
/*$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row1['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row1['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row1['Cliente']."</span></td>
	   <td width='10%' align='center' ><span class='reskar'>".$row1['DOCUMENTO']."</span></td>
	     <td width='20%' align='center' ><span class='reskar'>".$row1['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row1['Fecha']."</span></td>
   	<td width='10%' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row1['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row1['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";

$i++;
}
}

if($_epublic!='ini' & $val!='N' and $valor=='6'){
	
$consulcontrat11=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) LIKE '%$val%' AND cliente.tipper='J'  AND cliente.tipocli='1' ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat11)){
/*$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row1['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row1['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row1['Cliente']."</span></td>
	   <td width='10%' align='center' ><span class='reskar'>".$row1['DOCUMENTO']."</span></td>
	     <td width='20%' align='center' ><span class='reskar'>".$row1['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row1['Fecha']."</span></td>
   	<td width='10%' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row1['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row1['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";

$i++;
}
}


if($_epublic!='ini' & $val!='J' and $valor=='8'){
	
$consulcontrat11=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE cliente.numdoc LIKE '%$val%' AND cliente.tipper='N' AND cliente.tipocli='1' ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat11)){
/*$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row1['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row1['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row1['Cliente']."</span></td>
	   <td width='10%' align='center' ><span class='reskar'>".$row1['DOCUMENTO']."</span></td>
	     <td width='20%' align='center' ><span class='reskar'>".$row1['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row1['Fecha']."</span></td>
   	<td width='10%' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row1['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row1['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";

$i++;
}
}


if($_epublic!='ini' & $val!='N' and $valor=='8'){
	
$consulcontrat11=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE cliente.numdoc LIKE '%$val%' AND cliente.tipper='J' AND cliente.tipocli='1' ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat11)){
/*$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row1['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row1['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row1['Cliente']."</span></td>
	   <td width='10%' align='center' ><span class='reskar'>".$row1['DOCUMENTO']."</span></td>
	     <td width='20%' align='center' ><span class='reskar'>".$row1['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row1['Fecha']."</span></td>
   	<td width='10%' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row1['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row1['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";

$i++;
}
}

if($_epublic!='ini' & $val!='J' and $valor=='9'){
	
$consulcontrat11=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE cliente.direccion LIKE '%$val%' AND cliente.tipper='N' AND cliente.tipocli='1'  ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat11)){
/*$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row1['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row1['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row1['Cliente']."</span></td>
	   <td width='10%' align='center' ><span class='reskar'>".$row1['DOCUMENTO']."</span></td>
	     <td width='20%' align='center' ><span class='reskar'>".$row1['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row1['Fecha']."</span></td>
   	<td width='10%' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row1['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row1['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";

$i++;
}
}


if($_epublic!='ini' & $val!='N' and $valor=='9'){
	
$consulcontrat11=mysql_query("SELECT cliente.idcliente AS 'Id', cliente.idcliente AS 'Id. Cliente', (CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo',cliente.numdoc AS 'DOCUMENTO',cliente.direccion AS 'DIRECCION',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', cliente.fechaing AS 'Fecha', cliente.impnumof AS 'Oficio', 
cliente.impeorigen AS 'Origen', cliente.impmotivo AS 'Motivo'
FROM cliente  WHERE cliente.direccion LIKE '%$val%' AND cliente.tipper='J' AND cliente.tipocli='1'  ORDER BY cliente.idcliente ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat11)){
/*$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);*/

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='10%' align='center' ><span class='reskar'>".$row1['Oficio']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row1['Origen']."</span></td>
	  <td width='20%' align='center' ><span class='reskar'>".$row1['Cliente']."</span></td>
	   <td width='10%' align='center' ><span class='reskar'>".$row1['DOCUMENTO']."</span></td>
	     <td width='20%' align='center' ><span class='reskar'>".$row1['DIRECCION']."</span></td>
	<td width='10%' align='center' ><span class='reskar'>".$row1['Fecha']."</span></td>
   	<td width='10%' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='10%' align='center' ><span class='reskar'><a href='#' id='".$row1['Id']."'  name='1' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span><span class='reskar'><a href='#' id='".$row1['Id']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
	
  </tr>
</table>";

$i++;
}
}

//require_once("../includes/gridView.php")  ;
/*
$Grid1 = new GridView()					  ;
			echo 	$_epublic = $_POST["_epublic"];
			echo 	$val  = $_POST["val"];
				$hasta = 20;
								
if($_epublic == "ini") 
{					
				$Grid1->DataSource= "SELECT impedidos.idimpedido AS 'Id', impedidos.idcliente AS 'Id. Cliente', 
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', impedidos.fechaing AS 'Fecha Ing.', impedidos.oficio AS 'Oficio', 
impedidos.origen AS 'Origen', impedidos.motivo AS 'Motivo', impedidos.pep AS 'pep', impedidos.laft AS 'laft'
FROM impedidos
INNER JOIN cliente ON cliente.idcliente = impedidos.idcliente WHERE cliente.tipocli = '1' ORDER BY impedidos.idimpedido DESC";

}

else if ($_epublic == 'N'){
$Grid1->DataSource="SELECT impedidos.idimpedido AS 'Id', impedidos.idcliente AS 'Id. Cliente', 
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', impedidos.fechaing AS 'Fecha Ing.', impedidos.oficio AS 'Oficio', 
impedidos.origen AS 'Origen', impedidos.motivo AS 'Motivo', impedidos.pep AS 'pep', impedidos.laft AS 'laft'
FROM impedidos
INNER JOIN cliente ON cliente.idcliente = impedidos.idcliente WHERE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) LIKE '%$val%' ORDER BY impedidos.idimpedido DESC";
}

else if ($_epublic == 'J'){		
$Grid1->DataSource="SELECT impedidos.idimpedido AS 'Id', impedidos.idcliente AS 'Id. Cliente', 
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Cliente', impedidos.fechaing AS 'Fecha Ing.', impedidos.oficio AS 'Oficio', 
impedidos.origen AS 'Origen', impedidos.motivo AS 'Motivo', impedidos.pep AS 'pep', impedidos.laft AS 'laft'
FROM impedidos
INNER JOIN cliente ON cliente.idcliente = impedidos.idcliente WHERE cliente.razonsocial LIKE '%$val%' ORDER BY impedidos.idimpedido DESC";
}
                //echo $Grid1->DataSource;
				$Grid1->name      = "gridImpedidos"         ;
                $Grid1->cssPar    = "GridParx"              ; 
                $Grid1->cssImp    = "GridImp"              ;
                $Grid1->cssCab    = "GridCab"               ;
                $Grid1->click     = "fShowDetail(this)"     ; 
                #$Grid1->dblclick  = "fShowDetail(this)"    ;
				$Grid1->paginar   = "Si"				    ; 
                $Grid1->posPag    = "1"                     ;
				$Grid1->width     = "100%"                  ;
				$Grid1->border     = 1                      ;
				$Grid1->NumFields = 4                       ;
				$Grid1->botonModi = "Si"		            ;
				$Grid1->modiClick = "editclie(this);"	    ;
				$Grid1->botonElim   = ""			        ;
				$Grid1->elimClick = "fElimItemClient();"    ;
			    #$Grid1->despuesElim = "fDisMonto(numFil);"   ;
				$Grid1->Show()                             ; 
                $Grid1->fDesCon()						   ;*/
 ?>
  </div></td>
        </tr>

    </div></td>
  </tr>
</table>