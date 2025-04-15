<?php
include("../../conexion.php");
  $_epublic = $_POST["_epublic"];
   $val  = $_POST["val"];
   $col  = $_POST["col"];
 
?>
<!--<table width="700" border="0" cellspacing="0" cellpadding="0">
   
         <!--- <td>-->
     <?php  //if($_epublic!='N' & $_epublic!='J'){
	 
?>

<!-- <table width="680" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
<?php
//}elseif($_epublic!='ini' & $_epublic!='J'){
?>
<table width="680" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">

<?php 
//}else{
?>
<table width="680" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
    <?php
// }
 ?>          
          
            <tr>
             
              <td width="80" align="center"><span class="titubuskar0">Apelldios y Nombres</span></td>
               <td width="100" align="center"><span class="titubuskar0">Direccion</span></td>
               <td width="50" align="center"><span class="titubuskar0">N° Doc</span></td>
              <td width="15" align="center"><span class="titubuskar0">Tipo</span></td>
			  <td width="15" align="center"><span class="titubuskar0">&nbsp;</span></td>
              <td width="15" align="center"><span class="titubuskar0">&nbsp;</span></td>
            </tr>
          </table><!--</td>-->
      <!--   </tr>
        <tr>
          <td>-->
      <table class="aatable" width="100%">
<tr>

	<th ><span class="titubuskar0">Apellidos y Nombres</span></th>
	<th><span class="titubuskar0">Direccion</span></th>
	<th><span class="titubuskar0">N Doc</span></th>
    <th><span class="titubuskar0">Tipo</span></th>
	<th><span class="titubuskar0">Estado</span></th>
	<th><span class="titubuskar0">Operaciones</span></th>
</tr>
    
          <div id="bkardex">


 
 
 <?php
 if($_epublic!='N' & $_epublic!='J'){
//echo "ol";
$consulcontrat=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row = mysql_fetch_array($consulcontrat)){
$des=$row['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);
?>


<td ><?php echo $row['Descripcion']; ?></td>
<td ><?php echo $row['Direccion'];?></td>
<td ><?php echo $row['Documento'];?></td>
<td ><?php echo $row['Tipo'];?></td>
<td ></td>
<td align="center">
<div id="operacion">
<span class="reskar"><a href="#" id="<?php echo $row['ID']; ?>"  name="<?php echo $row['Tipo']; ?>" onclick="editContratante(this.id,this.name)"><img src="../../iconos/editamv.png" width="16" height="18"></a></span> \ 
<span class='reskar'><a href="#" id="<?php echo $row['ID']; ?>" onclick="ElimContratante(this.id,this.name)"><img src="../../iconos/eliminamv.png" width="16" height="18"></a></span>
</div>
</td>
</tr>
<?php
$i++;
}
}




if($_epublic!='ini' & $_epublic!='J'){
//echo "bu";
$consulcontrat1=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) LIKE '%$val%' AND cliente.tipper='N' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat1)){
$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);
?>


<td ><?php echo $row1['Descripcion']; ?></td>
<td ><?php echo $row1['Direccion'];?></td>
<td ><?php echo $row1['Documento'];?></td>
<td ><?php echo $row1['Tipo'];?></td>
<td ></td>
<td align="center">
<div id="operacion">
<span class="reskar"><a href="#" id="<?php echo $row1['ID']; ?>"  name="<?php echo $row1['Tipo']; ?>" onclick="editContratante(this.id,this.name)"><img src="../../iconos/editamv.png" width="16" height="18"></a></span> \ 
<span class='reskar'><a href="#" id="<?php echo $row1['ID']; ?>" onclick="ElimContratante(this.id,this.name)"><img src="../../iconos/eliminamv.png" width="16" height="18"></a></span>
</div>
</td>
</tr>
<?php
$i++;
}
}




if($_epublic!='ini' & $val!='J'){
	//echo "gato";
$consulcontrat11=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE  cliente.numdoc LIKE '%$val%' AND cliente.tipper='N' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat11)){
$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);
?>


<td ><?php echo $row1['Descripcion']; ?></td>
<td ><?php echo $row1['Direccion'];?></td>
<td ><?php echo $row1['Documento'];?></td>
<td ><?php echo $row1['Tipo'];?></td>
<td ></td>
<td align="center">
<div id="operacion">
<span class="reskar"><a href="#" id="<?php echo $row1['ID']; ?>"  name="<?php echo $row1['Tipo']; ?>" onclick="editContratante(this.id,this.name)"><img src="../../iconos/editamv.png" width="16" height="18"></a></span> \ 
<span class='reskar'><a href="#" id="<?php echo $row1['ID']; ?>" onclick="ElimContratante(this.id,this.name)"><img src="../../iconos/eliminamv.png" width="16" height="18"></a></span>
</div>
</td>
</tr>
<?php
$i++;
}
}


if($_epublic!='ini' & $val!='N'){
	
$consulcontrat112=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE  cliente.numdoc LIKE '%$val%' AND cliente.tipper='J' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat112)){
$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);
?>


<td ><?php echo $row1['Descripcion']; ?></td>
<td ><?php echo $row1['Direccion'];?></td>
<td ><?php echo $row1['Documento'];?></td>
<td ><?php echo $row1['Tipo'];?></td>
<td ></td>
<td align="center">
<div id="operacion">
<span class="reskar"><a href="#" id="<?php echo $row1['ID']; ?>"  name="<?php echo $row1['Tipo']; ?>" onclick="editContratante(this.id,this.name)"><img src="../../iconos/editamv.png" width="16" height="18"></a></span> \ 
<span class='reskar'><a href="#" id="<?php echo $row1['ID']; ?>" onclick="ElimContratante(this.id,this.name)"><img src="../../iconos/eliminamv.png" width="16" height="18"></a></span>
</div>
</td>
</tr>
<?php
$i++;
}
}



if($_epublic!='ini' & $val!='J'){
	
$consulcontrat15=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE  cliente.direccion LIKE '%$val%' AND cliente.tipper='N' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat15)){
$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);
?>


<td ><?php echo $row1['Descripcion']; ?></td>
<td ><?php echo $row1['Direccion'];?></td>
<td ><?php echo $row1['Documento'];?></td>
<td ><?php echo $row1['Tipo'];?></td>
<td ></td>
<td align="center">
<div id="operacion">
<span class="reskar"><a href="#" id="<?php echo $row1['ID']; ?>"  name="<?php echo $row1['Tipo']; ?>" onclick="editContratante(this.id,this.name)"><img src="../../iconos/editamv.png" width="16" height="18"></a></span> \ 
<span class='reskar'><a href="#" id="<?php echo $row1['ID']; ?>" onclick="ElimContratante(this.id,this.name)"><img src="../../iconos/eliminamv.png" width="16" height="18"></a></span>
</div>
</td>
</tr>
<?php
$i++;
}
}



if($_epublic!='ini' & $val!='N'){
	
$consulcontrat15=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE  cliente.direccion LIKE '%$val%' AND cliente.tipper='J' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat15)){
$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);
?>


<td ><?php echo $row1['Descripcion']; ?></td>
<td ><?php echo $row1['Direccion'];?></td>
<td ><?php echo $row1['Documento'];?></td>
<td ><?php echo $row1['Tipo'];?></td>
<td ></td>
<td align="center">
<div id="operacion">
<span class="reskar"><a href="#" id="<?php echo $row1['ID']; ?>"  name="<?php echo $row1['Tipo']; ?>" onclick="editContratante(this.id,this.name)"><img src="../../iconos/editamv.png" width="16" height="18"></a></span> \ 
<span class='reskar'><a href="#" id="<?php echo $row1['ID']; ?>" onclick="ElimContratante(this.id,this.name)"><img src="../../iconos/eliminamv.png" width="16" height="18"></a></span>
</div>
</td>
</tr>
<?php
$i++;
}
}



 if($_epublic!='ini' & $_epublic!='N'){
$consulcontrat2=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc  AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE cliente.tipper='J' AND  cliente.razonsocial LIKE '%$val%' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row2 = mysql_fetch_array($consulcontrat2)){
$des=$row2['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);
?>


<td ><?php echo $row['Descripcion']; ?></td>
<td ><?php echo $row['Direccion'];?></td>
<td ><?php echo $row['Documento'];?></td>
<td ><?php echo $row2['Tipo'];?></td>
<td ></td>
<td align="center">
<div id="operacion">
<span class="reskar"><a href="#" id="<?php echo $row2['ID']; ?>"  name="<?php echo $row2['Tipo']; ?>" onclick="editContratante(this.id,this.name)"><img src="../../iconos/editamv.png" width="16" height="18"></a></span> \ 
<span class='reskar'><a href="#" id="<?php echo $row2['ID']; ?>" onclick="ElimContratante(this.id,this.name)"><img src="../../iconos/eliminamv.png" width="16" height="18"></a></span>
</div>
</td>
</tr>
<?php
$i++;
}
}





?>

<?php



/*if($_epublic!='N' & $_epublic!='J'){
//echo "ol";
$consulcontrat=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row = mysql_fetch_array($consulcontrat)){
$des=$row['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);

echo "<table width='680' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
  
	<td width='90' align='center' ><span class='reskar'>".$row['Descripcion']."</span></td>
	  <td width='10%' align='center' ><span class='reskar'>".$row['Direccion']."</span></td>
	  <td width='5%' align='center' ><span class='reskar'>".$row['Documento']."</span></td>
	<td width='5%' align='center' ><span class='reskar'>".$row['Tipo']."</span></td>
    <td width='5%' align='center' ><span class='reskar'><a href='#' id='".$row['ID']."'  name='".$row['Tipo']."' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span></td>
	<td width='5%' align='center' ><span class='reskar'><a href='#' id='".$row['ID']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
  </tr>
</table>";
$i++;
}
}*/




/*if($_epublic!='ini' & $_epublic!='J'){
echo "bu";
$consulcontrat1=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) LIKE '%$val%' AND cliente.tipper='N' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat1)){
$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);

echo "<table width='680' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
   <td width='80' align='center' ><span class='reskar'>".$row1['Descripcion']."</span></td>
	  <td width='100' align='center' ><span class='reskar'>".$row1['Direccion']."</span></td>
	  <td width='50' align='center' ><span class='reskar'>".$row1['Documento']."</span></td>
	<td width='15' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='15' align='center' ><span class='reskar'><a href='#' id='".$row1['ID']."'  name='".$row1['Tipo']."' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span></td>
	<td width='15' align='center' ><span class='reskar'><a href='#' id='".$row1['ID']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
  </tr>
</table>";
$i++;
}
}


if($_epublic!='ini' & $val!='J'){
	echo "gato";
$consulcontrat11=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE  cliente.numdoc LIKE '%$val%' AND cliente.tipper='N' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat11)){
$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);

echo "<table width='680' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
   <td width='80' align='center' ><span class='reskar'>".$row1['Descripcion']."</span></td>
	  <td width='100' align='center' ><span class='reskar'>".$row1['Direccion']."</span></td>
	  <td width='50' align='center' ><span class='reskar'>".$row1['Documento']."</span></td>
	<td width='15' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='15' align='center' ><span class='reskar'><a href='#' id='".$row1['ID']."'  name='".$row1['Tipo']."' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span></td>
	<td width='15' align='center' ><span class='reskar'><a href='#' id='".$row1['ID']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
  </tr>
</table>";
$i++;
}
}




if($_epublic!='ini' & $val!='N'){
	
$consulcontrat112=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE  cliente.numdoc LIKE '%$val%' AND cliente.tipper='J' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat112)){
$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);

echo "<table width='680' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
   <td width='80' align='center' ><span class='reskar'>".$row1['Descripcion']."</span></td>
	  <td width='100' align='center' ><span class='reskar'>".$row1['Direccion']."</span></td>
	  <td width='50' align='center' ><span class='reskar'>".$row1['Documento']."</span></td>
	<td width='15' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='15' align='center' ><span class='reskar'><a href='#' id='".$row1['ID']."'  name='".$row1['Tipo']."' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span></td>
	<td width='15' align='center' ><span class='reskar'><a href='#' id='".$row1['ID']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
  </tr>
</table>";
$i++;
}
}


if($_epublic!='ini' & $val!='J'){
	
$consulcontrat15=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE  cliente.direccion LIKE '%$val%' AND cliente.tipper='N' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat15)){
$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);

echo "<table width='680' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
   <td width='80' align='center' ><span class='reskar'>".$row1['Descripcion']."</span></td>
	  <td width='100' align='center' ><span class='reskar'>".$row1['Direccion']."</span></td>
	  <td width='50' align='center' ><span class='reskar'>".$row1['Documento']."</span></td>
	<td width='15' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='15' align='center' ><span class='reskar'><a href='#' id='".$row1['ID']."'  name='".$row1['Tipo']."' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span></td>
	<td width='15' align='center' ><span class='reskar'><a href='#' id='".$row1['ID']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
  </tr>
</table>";
$i++;
}
}


if($_epublic!='ini' & $val!='N'){
	
$consulcontrat15=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE  cliente.direccion LIKE '%$val%' AND cliente.tipper='J' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row1 = mysql_fetch_array($consulcontrat15)){
$des=$row1['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);

echo "<table width='680' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
   <td width='80' align='center' ><span class='reskar'>".$row1['Descripcion']."</span></td>
	  <td width='100' align='center' ><span class='reskar'>".$row1['Direccion']."</span></td>
	  <td width='50' align='center' ><span class='reskar'>".$row1['Documento']."</span></td>
	<td width='15' align='center' ><span class='reskar'>".$row1['Tipo']."</span></td>
    <td width='15' align='center' ><span class='reskar'><a href='#' id='".$row1['ID']."'  name='".$row1['Tipo']."' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span></td>
	<td width='15' align='center' ><span class='reskar'><a href='#' id='".$row1['ID']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
  </tr>
</table>";
$i++;
}
}



 if($_epublic!='ini' & $_epublic!='N'){
$consulcontrat2=mysql_query("SELECT cliente.idcliente as 'ID',
(CASE WHEN (cliente.tipper='J') THEN cliente.razonsocial  ELSE CONCAT(cliente.apepat,' ',cliente.apemat,' ,',cliente.prinom) END) AS 'Descripcion',
(CASE WHEN (cliente.tipper='J') THEN 'Juridica' ELSE 'Natural' END) AS 'Tipo', cliente.apepat ,cliente.apemat, cliente.prinom, cliente.segnom, cliente.nombre,
cliente.direccion  AS 'Direccion', cliente.idtipdoc, cliente.numdoc  AS 'Documento', cliente.email, cliente.telfijo, cliente.telcel, cliente.telofi, cliente.sexo, 
cliente.idestcivil, cliente.natper, cliente.conyuge, cliente.nacionalidad, cliente.idprofesion, cliente.detaprofesion, cliente.idcargoprofe,
cliente.profocupa, cliente.dirfer, cliente.idubigeo, cliente.cumpclie, cliente.fechaing, cliente.razonsocial, cliente.domfiscal, cliente.telempresa, 
cliente.mailempresa, cliente.contacempresa, cliente.fechaconstitu, cliente.idsedereg, cliente.numregistro, cliente.numpartida, cliente.actmunicipal,
cliente.tipocli, cliente.impeingre, cliente.impnumof, cliente.impeorigen, cliente.impentidad, cliente.impremite, cliente.impmotivo, cliente.residente, cliente.docpaisemi  
FROM cliente WHERE cliente.tipper='J' AND  cliente.razonsocial LIKE '%$val%' ORDER BY cliente.nombre ASC", $conn) or die(mysql_error());
$i = 1;
while($row2 = mysql_fetch_array($consulcontrat2)){
$des=$row2['c_descontrat'];
$des2=str_replace("?","'",$des);
$des3=str_replace("*","&",$des2);
$des4=strtoupper($des3);

echo "<table width='680' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='80' align='center' ><span class='reskar'>".$row['Descripcion']."</span></td>
	  <td width='100' align='center' ><span class='reskar'>".$row['Direccion']."</span></td>
	  <td width='50' align='center' ><span class='reskar'>".$row['Documento']."</span></td>
	<td width='15' align='center' ><span class='reskar'>".$row2['Tipo']."</span></td>
    <td width='15' align='center' ><span class='reskar'><a href='#' id='".$row2['ID']."'  name='".$row2['Tipo']."' onclick='editContratante(this.id,this.name)'><img src='../../iconos/editamv.png' width='16' height='18'></a></span></td>
	<td width='15' align='center' ><span class='reskar'><a href='#' id='".$row2['ID']."' onclick='ElimContratante(this.id,this.name)'><img src='../../iconos/eliminamv.png' width='16' height='18'></a></span></td>
	
  </tr>
</table>";
$i++;
}
}*/


 
?> 
 </div>
 
 </table>
 
 
 <!--</td>
        </tr>

    </div></td>
  </tr>
</table>-->

