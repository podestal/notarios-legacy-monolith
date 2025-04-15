<?php
session_start();
include("conexion.php");

$codkardexx=$_POST['codkardex'];
$fecha_modificacion = date("d/m/Y");
$sqlsum=mysql_query("Select * from detalle_actos_kardex where kardex = '$codkardexx'", $conn) or die(mysql_error());

function divide($cant,$monto){
	
if($cant>=2){
	
$faltante=0;
$divide=number_format(round($monto/$cant,2),2,'.','');
$consulta_suma=round($divide*$cant,2);
if($monto-$consulta_suma!=0){	
if($monto-$consulta_suma){
$faltante=number_format(round($monto-$consulta_suma,2),2,'.','');
}
}
//array si la divicion es porcentaje igual
for($a=0; $a<$cant; $a++) { 								
// el primer ingreso		
if($a==0){
    $array=array($divide);
}else{
	// si falta para el 100 %
	if($faltante<>0 ){
	if($a==$cant-1 ){
	array_push($array,$divide+$faltante);	
	}else{
	array_push($array,$divide);	
	}	
	}else{
	array_push($array,$divide);	
	}
}				
}

	
}else{
	
$array=array($monto);
	
}

 return $array;	
}

while($rowsum = mysql_fetch_array($sqlsum)){
	
	//actualizamos el item detalle_actos_kardex - patrimonial
	$var=" UPDATE patrimonial set item=".$rowsum['item']." where kardex='".$rowsum['kardex']."' and idtipoacto='".$rowsum['idtipoacto']."' ";
	mysql_query($var,$conn); 
			
    //actualizamos los detalles de contratantesxacto
	
	$consulta=mysql_query("SELECT * FROM actocondicion WHERE idtipoacto='".$rowsum['idtipoacto']."'",$conn) or die (mysql_error());
     while ($row=mysql_fetch_array($consulta)){
			$var=" UPDATE contratantesxacto set parte='".$row['parte']."' , uif='".$row['uif']."' , formulario='".$row['formulario']."' ,
        		   montop='".$row['montop']."' where idcondicion='".$row['idcondicion']."' and kardex='".$rowsum['kardex']."' and idtipoacto='".$rowsum['idtipoacto']."' ";
		    mysql_query($var,$conn); 
   }
	
	
	
	
   $itemdiv=$rowsum['item'];
   $codkardex=$rowsum['idtipoacto']; 
   $sqlnumer=mysql_query("Select * from contratantesxacto where item = '$itemdiv' and parte = '1'", $conn) or die(mysql_error());
   $numeroitem = mysql_num_rows($sqlnumer);
   $sqlnumer2=mysql_query("Select * from contratantesxacto where item = '$itemdiv' and parte = '2'", $conn) or die(mysql_error());
   $numeroitem2 = mysql_num_rows($sqlnumer2);
   $consulta=mysql_query("SELECT importetrans FROM patrimonial WHERE idtipoacto= '$codkardex' and item='$itemdiv'", $conn) or die(mysql_error());
   $row_importe=mysql_fetch_array($consulta);
   $array_vendedor_porcentaje=divide($numeroitem,100);
   $array_comprador_procentaje=divide($numeroitem2,100);
   $array_vendedor_monto=divide($numeroitem,$row_importe['importetrans']);
   $array_comprador_monto=divide($numeroitem2,$row_importe['importetrans']);
   $compradores=mysql_query("Select * from contratantesxacto where item = '$itemdiv' and parte = '2'", $conn) or die(mysql_error());
   $vendedor=mysql_query("Select * from contratantesxacto where item = '$itemdiv' and parte = '1'", $conn) or die(mysql_error());
   $i_vend=0;
   $i_comp=0;
    while($row_actualiza=mysql_fetch_array($vendedor)){
		
		 $sqldivi="UPDATE contratantesxacto set porcentaje='".$array_vendedor_porcentaje[$i_vend]."' , monto='".$array_vendedor_monto[$i_vend]."' 
		           WHERE item='$itemdiv' and parte = '1' and  idcontratante='".$row_actualiza["idcontratante"]."' and idtipoacto='".$row_actualiza["idtipoacto"]."'"; 
         mysql_query($sqldivi,$conn) or die(mysql_error());

	$i_vend++;	
	}
 
    while($row_actualiza=mysql_fetch_array($compradores)){
		
		 $sqldivi="UPDATE contratantesxacto set porcentaje='".$array_comprador_procentaje[$i_comp]."' , monto='".$array_comprador_monto[$i_comp]."' 
		           WHERE item='$itemdiv' and parte = '2' and  idcontratante='".$row_actualiza["idcontratante"]."' and idtipoacto='".$row_actualiza["idtipoacto"]."'"; 
         mysql_query($sqldivi,$conn) or die(mysql_error());

	$i_comp++;	
	}
 
}




?>
<html> 
<head> 
<title>Ingreso de la Minuta</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head> 
<body oncontextmenu="return false" >
<style type="text/css">
</style>
<?php 


//CONSULTA PARA LISTAR RESULTADOS
$sqlkardex=mysql_query("Select * from detalle_actos_kardex where kardex = '$codkardexx'", $conn) or die(mysql_error());

while($rowkardex = mysql_fetch_array($sqlkardex)){
   $item=$rowkardex['item'];
   $sqlitem=mysql_query("Select * from contratantesxacto where item = '$item' ", $conn) or die(mysql_error());
    while($rowitem = mysql_fetch_array($sqlitem)){

	echo "<table width='1000' border='1' bgcolor='#FFFFFF' cellpadding='0' cellspacing='0' bordercolor='#CCCCCC'>
            <tr>
              <td width='160'><div style='width:170px; height:auto; border:0px;'><span class='textoasigna'>".$rowkardex['desacto']."</span></div></td>
              <td width='120'><div style='width:163px; height:auto; border:0px;'><span class='textoasigna'>"; 
			  $idcontratante=$rowitem['idcontratante'];
			  $sqlcontrante=mysql_query("Select * from cliente2 where idcontratante = '$idcontratante'", $conn) or die(mysql_error());
			  $rowcontra=mysql_fetch_array($sqlcontrante);
			  if($rowcontra['tipper']=="N") { $nomyape=strtoupper($rowcontra['apepat']." ".$rowcontra['apemat'].", ".$rowcontra['prinom']." ".$rowcontra['segnom']);
	$textorefe=str_replace("?","'",$nomyape);
	$textoampers=str_replace("*","&",$textorefe);
	$textoamperss=str_replace("ñ","Ñ",$textoampers);
	echo strtoupper($textoamperss);      }else {   $empresita=strtoupper($rowcontra['razonsocial']);
	         $textorefe=str_replace("?","'",$empresita);
						  $textoampers=str_replace("*","&",$textorefe);
						  $textoamperss=str_replace("ñ","Ñ",$textoampers);
						  echo strtoupper($textoamperss); }
			  echo"</span></div></td>
              <td width='210'><div style='width:210px; height:auto; border:0px;'><span class='textoasigna'>";
			  $conditiion=$rowitem['idcondicion'];
			  $consucondi=mysql_query("Select * from actocondicion where idcondicion = '$conditiion' ", $conn) or die(mysql_error());
			  $rowconddi=mysql_fetch_array($consucondi);
			  echo strtoupper($rowconddi['condicion']);
			   echo"</span></div></td>
              <th width='75'>
			      <div style='width:70px; height:auto; border:0px;'>"; if ($rowitem['uif']!="R" and $rowitem['uif']!="A"){echo"<input name='".$rowitem['item']."' title='".$rowitem['id']."' id='".$rowitem['idcondicion']."' type='text' size='5' onchange='recal(this.name,this.id,this.value,this.title)' value='".$rowitem['porcentaje']."' />"; } echo"</div>
             </th>
              <td width='30' align='center'><div style='width:30px; height:auto; border:0px;'><span class='textoasigna'>".strtoupper($rowitem['uif'])."</span></div></td>
              <td width='72'><div style='width:72px; height:auto; border:0px;'>"; if ($rowitem['formulario']=="1"){
			  echo "<a href='#' onClick='validarformular(".intval($rowitem['idcontratante']).")'><img src='iconos/formu.png' width='34' height='29' border='0' /></a>";
			  
			  } echo"</div></td>
			  <td width='73' align='center'><div style='width:73px; height:auto; border:0px;'>"; if($rowitem['montop']=="1"){echo "<input style='text-transform:uppercase;' id='".$rowitem['id']."' name='".$rowitem['idcondicion']."' title='".$rowitem['item']."' type='text' size='5' onchange='remonto(this.name,this.id, this.title, this.value)' value='".$rowitem['monto']."' />";} echo"</div></td>
			  
			  <td width='172' align='center'><div style='width:194px; height:auto; border:0px;'>";
			if($rowitem['montop']=="1" && $rowitem['uif']="O" ){
			  if($rowitem['ofondo']==""){
				     echo" <input id='h".$rowitem['idcontratante']."' style='text-transform:uppercase;' name='r".$rowitem['idcondicion']."' title='".$rowitem['id']."' type='text' size='21' onchange='fondos(this.title,this.value)' value='' />";	 
				} else{		
					echo" <input id='h".$rowitem['idcontratante']."' style='text-transform:uppercase;' name='r".$rowitem['idcondicion']."' title='".$rowitem['id']."' type='text' size='21' onchange='fondos(this.title,this.value)' value='".$rowitem['ofondo']."' />";
					}

			}echo"</div></td>
            </tr>
          </table>"; 
    }
	
}

$sqlmodificacion="UPDATE KARDEX SET  fecha_modificacion ='$fecha_modificacion' WHERE KARDEX ='$codkardex'"; 
mysql_query($sqlmodificacion,$conn) or die(mysql_error());
?>
</body>
</html>