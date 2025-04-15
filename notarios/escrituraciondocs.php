<?php 
session_start();
include("conexion2.php");	
$vkardex=$_REQUEST['kardex'];
$kardex=$_REQUEST['kardex'];
$realid_kard = $_REQUEST['id'];

//include("alertasuif_val.php");

$sqlvkardex=mysqli_query($conn_i,"SELECT kardex.*, DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') AS 'fechaescritura2' FROM kardex where kardex='$vkardex' and idkardex='$realid_kard'") or die(mysqli_error($conn_i));

$rowvkardex=mysqli_fetch_array($sqlvkardex);

$id_usuario= $_SESSION["id_usu"];
/*$sqlu  = mysqli_query($conn_i,"SELECT * FROM permisos_usuarios where idusuario = '$id_usuario'") or die(mysqli_error($conn_i));
$rowu= mysqli_fetch_array($sqlu);
*/
if($rowvkardex["idtipkar"]=="3"){
	$veracta= "style='display:;' ";
	$verconten= "style='display:none;'";
	$verall= "style='display:none;'";
	$campo="style='display:none;'";
}else if($rowvkardex["idtipkar"]=="2"){
	$veracta= "style='display:none;'";
	$verconten= "style='display:;' ";
	$verall= "style='display:none;'";
	$campo="style='display:;width:80%;'";
}else{
	$veracta= "style='display:none;'";
	$verconten= "style='display:none;'";
	$verall= "style='display:;' ";	
	$campo="style='display:;width:80%;'";
}


##
/*
$sql_plantilla="SELECT * FROM confiplantillas where id='1'"; 
$rpta_plantillas=mysqli_query($conn_i,$sql_plantilla) or die(mysqli_error($conn_i));
$row_plantillas = mysqli_fetch_array($rpta_plantillas);
*/
//CONSUTA PARA EL SERVIDOR
$sql="select * from servidor where idservidor='1'";
$rpta=mysqli_query($conn_i,$sql) or die(mysqli_error($conn_i));
$row=mysqli_fetch_array($rpta);

//RUTA PARA LIBROS ES 1

/*$sql_ruta="select * from rutaplantillas where id='15'";
$rpta_ruta=mysqli_query($conn_i,$sql_ruta) or die(mysqli_error($conn_i));
$row_ruta=mysqli_fetch_array($rpta_ruta);
*/
/*
$sql_ruta2="select * from rutaplantillas where id='23'";
$rpta_ruta2=mysqli_query($conn_i,$sql_ruta2) or die(mysqli_error($conn_i));
$row_ruta2=mysqli_fetch_array($rpta_ruta2);
*/

//DECLARACION DE VARIABLES
$server = $row['nombre'];
$SO = $row['so'];
$path="";$path2="";

//CAMBIAMOS LA EXTENSION DEPENDIENO DE QUE XUXA SEA

$extensionfinal="";
if(isset($row_plantillas['extension_proto']))
	$extensionfinal=$row_plantillas['extension_proto']; 

//ASIGNAMOS SU EXTENSION SEGUN LA HAYAMOS CONFIGURADO
$archivo = "__".$vkardex.".".$extensionfinal; 
$archivo2 = "__PROY__".$vkardex.".".$extensionfinal; 
//COMPROBAMOS EL SISTEMA OPERATIVO, PARA PODER JALAR POR IP
if($row["so"]=="WINDOWS"){
	$path="\\"."\\".$server;
	$path2="\\"."\\".$server;
}else if($row["so"]=="LINUX"){
	$path="";$path2="";
} 

$type = '';
//BASENAMOS DE ARCHIVO IMPORTANTE SINO SE NOS DESCARARA EL FICHERO COMO .PHP Y NO .***
$file = basename($archivo);$file2 = basename($archivo2);


if(!isset($row_ruta["ruta_generar"]))
	$row_ruta["ruta_generar"]="";

if(!isset($row_ruta2["ruta_generar"]))
	$row_ruta2["ruta_generar"]="";

$path.=$row_ruta["ruta_generar"].$file;

$path2.=$row_ruta2["ruta_generar"].$file2;


$path=$path;

	if (is_file($path))
	{
		$dis="disabled";
		$dispt="";
	}else{
		$dis="";
		$dispt="disabled";
	}
	$title="";
	

if (is_file($path2))
{
	$dis2="";
}else{
	$dis2="disabled";
}


?>

<div style="border:0px #000 solid;width:100%;position:relative;height:370px;">

	<div style="position:relative;float:left;width:100%;border:1px #000 solid">
	<!-- <div style="position:relative;float:left;width:15%;height:370px;border:1px #000 solid"> -->
    	<table width="100%" align="LEFT">
        	<!-- <tr>
            	<th height="40">&nbsp;</th>
            </tr> -->
            <?PHP if($rowvkardex["idtipkar"]!=3 && $rowvkardex["idtipkar"]!=4 ){?>
        	<tr>
            	<th height="0">
            		<?PHP if($rowvkardex["idtipkar"]==6){?>
            		<input onclick="listarCuerpoDocum('<?php echo $vkardex;?>');" style="width:120px;height:30;" type="button" value="ACTA"  />
            		<?PHP }else  {?>
            	
            		<!--<span style="cursor: pointer;" onclick="listarCuerpoDocum('<?php echo $vkardex; ?>');">
            			<img src="iconos/minuta.jpg">	
            		</span>-->
            		
            		<?php } ?>
            	</th>
            </tr>
            <?PHP }?>

            <?php 
            	if(false){
            ?>
            <tr>
            	<th height="40"><input onclick="listarGenerarActa('<?php echo $vkardex; ?>','<?php echo $rowvkardex["idtipkar"]; ?>');"  style="width:120px;height:30;" type="button" value="GEN. ACTA/INST"  /></th>
            </tr>
            
            <tr>
            	<th height="40">
            		<span style="cursor: pointer;background:steelblue;color:white;padding:.7em .5em .8em .5em;letter-spacing: 2px; border-radius:5px 5px 0 0;" onclick="listarGenerarProy('<?php echo  $vkardex; ?>');">
            			PROYECTO	
            		</span>
            		<input onclick="listarGenerarProy('<?=$vkardex?>');"  style="width:120px;height:30;" type="button" value="GEN. PROYECTO"  />
            	</th>
            </tr>


            <?php }else{ ?>
	            <tr>
	            	<th height="40">
	            		<span style="cursor: pointer;background:steelblue;color:white;padding:.7em .5em .8em .5em;letter-spacing: 2px; border-radius:5px 5px 0 0;" onclick="listarGenerarProy('<?php echo $vkardex; ?>');">
            			PROYECTO	
            		</span>
            		<input style="display: none;" onclick="listarGenerarProy('<?=$vkardex?>');"  style="width:120px;height:30;" type="button" value="GEN. PROYECTO" /></th>
	            </tr>
	        	<tr style="display: none;">
	            	<th height="40">
	            		<?php 
			            	if($rowvkardex["idtipkar"]==6){
			            ?>
	            		<input onclick="listarGenerarActa('<?=$vkardex?>','<?=$rowvkardex["idtipkar"]?>');"  style="width:120px;height:30;" type="button" value="GEN. C.C."  />
	            		<?php } else{?>
	            		<input onclick="listarGenerarActa('<?=$vkardex?>','<?=$rowvkardex["idtipkar"]?>');"  style="width:120px;height:30;" type="button" value="GEN. ACTA/INST"  />
	            		<?php } ?>
	            	</th>
	            </tr>
            <?php } ?>
        	
        	<tr style="display: none;">
            	<th height="40">
                <?php

				if((int)$ContadorErrores>0){
				?>
                <input  onclick="javascript:alert('DEBE COMPLETAR CAMPOS DE UIF/PDT PARA PODER GENERAR EL PARTE');return false;"
                style="width:120px;height:30;" <?=$dispt?> type="button" value="GEN. PARTE" />
                
				
                <?php
				}else{
				?>
                <input  onclick="listarGenerarParte('<?=$vkardex?>');"
                style="width:120px;height:30;" <?=$dispt?> type="button" value="GEN. PARTE" />
                <?php	
				}
				?>
               </th>
            </tr>
        	<tr style="display: none;">
            	<th height="40">
                <?php
                //(int)$ContadorErrores>0
               
				if(false){
				?>
                <input  onclick="javascript:alert('DEBE COMPLETAR CAMPOS DE UIF/PDT PARA PODER GENERAR EL TESTIMONIO');return false;"
                style="width:120px;height:30;" <?=$dispt?> type="button" value="GEN. TESTIMONIO" />
                
				
                <?php
				}else{
				?>
                <input  onclick="listarGenerarTest('<?=$vkardex?>');"
                style="width:120px;height:30;"  type="button" value="GEN. TESTIMONIO" />
                <?php	
				}
				?>
               </th>
            </tr>
        </table>
    </div>
    
    <div id="resultEscri" style="position:relative;float:left;width:100%; height:350px;border:1px #000 solid">
    <!-- <div id="resultEscri" style="position:relative;float:left;width:81%; height:350px;padding:10px;border:1px #000 solid"> -->
    
    GENERAR MINUTA , ESCRITURAS
    
    </div>
    
    <div id="verObsEscri" style="display:none;position:absolute;width:50%;height:200px;margin-left:35%;margin-top:5%;border-radius: 10px; box-shadow: 0px 0px 7px rgb(0, 0, 0); border: medium solid; position: absolute; background-color: rgb(14, 80, 111);"></div>
    
    <div id="verliterales" style="display:none;position:absolute;width:96%;height:250px;margin-left:2%;margin-top:5%;border-radius: 10px; box-shadow: 0px 0px 7px rgb(0, 0, 0); border: medium solid; position: absolute; background-color: rgb(14, 80, 111);"></div>

    <div id="verListadoEscri" style="display:none;position:absolute;width:80%;height:250px;margin-left:15%;margin-top:5%;border-radius: 10px; box-shadow: 0px 0px 7px rgb(0, 0, 0); border: medium solid; position: absolute; background-color: rgb(255,255,255);"></div>
        
</div>

<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<script src="jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<style type="text/css">
.TITULO {
	font-family: Verdana;
	font-size: 14px;
	font-weight:bolder;
	color: #000;	
}
.TITULO2 {
	font-family: Verdana;
	font-size: 11px;
	font-weight:bolder;
	color: #fff;
	text-align:center;	
}
.TITULO21 {
	font-family: Verdana;
	font-size: 11px;
	font-weight:bolder;
	color: #000;
	text-align:center;	
}
.TITULO3 {
	font-family: Verdana;
	font-size: 11px;
	color: #000;	
}
.fila:hover{
background-color:#09C;	
}
</style>
<script type="text/javascript" src="tcal.js"></script> 
<script type="text/javascript" src="mantenimiento/includes/jquery.scrollableFixedHeaderTable.js"></script>
<script src="includes/maskedinput.js"></script>
<script src="includes/jquery-1.8.3.js"></script>