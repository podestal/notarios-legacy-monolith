<html> 
<head> 
<title>Ingreso de la Minuta</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="stylesglobal.css"> 
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

</head> 
<body  oncontextmenu="return false" >
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
<?php session_start();
include("conexion.php");	
include("conexion2.php");	
include("extraprotocolares/view/funciones.php");
$vkardex=$_REQUEST['kardex'];
$tipoKardex=0;
$sql1=mysqli_query($conn_i,"select documentos,idtipkar from kardex where kardex='$vkardex'");
$row1=mysqli_fetch_array($sql1);
$tipoKardex=$row1['idtipkar'];
$sql="select so,nombre from servidor where idservidor='1'";
$rpta=mysql_query($sql,$conn) or die(mysql_error());
$row=mysql_fetch_array($rpta);
$dir="";
/*
$sql_ruta="select ruta_generar from rutaplantillas where id='22'";
$rpta_ruta=mysql_query($sql_ruta,$conn) or die(mysql_error());
$row_ruta=mysql_fetch_array($rpta_ruta);

*/
//DECLARACION DE VARIABLES
$path="";

if($row["so"]=="WINDOWS"){
	//$path="\\"."\\".$row["nombre"];
    $path="C:/Minutas/";
}else if($row["so"]=="LINUX"){
	$path=$row["nombre"]."/notarysoft/";
} 

if(!isset($row_ruta["ruta_generar"]))
    $row_ruta["ruta_generar"]="";

$uploads_dir = $path.$row_ruta["ruta_generar"]."__MIN__".$vkardex.".docx";
$uploads_dir2 = $path.$row_ruta["ruta_generar"]."__MIN__".$vkardex.".doc";
$uploads_dir3 = $path.$row_ruta["ruta_generar"]."__MIN__".$vkardex.".odt";	

$tipodoc="";
$DISABLED="";
if (is_file($uploads_dir)){
	
	$tipodoc="docx";	
	$mensaje="El archivo .DOCX ha sido cargado en el siguiente directorio: ";
	$dir=$uploads_dir;
	$color="#2077D8";
}else if (is_file($uploads_dir2)){
	
	$tipodoc="doc";
	$mensaje="El archivo .DOC ha sido cargado en el siguiente directorio: ";
	$dir=$uploads_dir2;
	$color="#2077D8";
}else if (is_file($uploads_dir3)){
	
	$tipodoc="odt";
	$mensaje="El archivo .ODT ha sido cargado en el siguiente directorio: ";
	$dir=$uploads_dir3;
	$color="#2077D8";
}else{
	
	$tipodoc="";
	$mensaje="ATENCION: El archivo aun NO HA SIDO CARGADO";
	$DISABLED=" disabled='disabled' ";
	$color="red";
}
?>
<div id="verObsEscri" style="display:none;position:absolute;width:80%;height:200px;margin-left:10%;margin-top:5%;border-radius: 10px; box-shadow: 0px 0px 7px rgb(0, 0, 0); border: medium solid; position: absolute; background-color: rgb(14, 80, 111);"></div>
<table width="100%">
<tr>
    <td colspan="2">
    <span class="TITULO">
    CUERPO DEL DOCUMENTO
    </span>
    </td>
</tr>
<tr><td></td></tr>
<tr style="display: none;">
	<td>
    <span class="respuuuu" style="font-size:13px;font-weight:bold; font-family: verdana;color: <?=$color?>;"><?=$mensaje?>&nbsp;</span>
    </td>
    
    <td>

        <?php
        $lblM="";
         if($tipoKardex==6){
            $lblM="CREAR ARCHIVO";
        }else{
            $lblM="CREAR ARCHIVO PARA MINUTA";
        } ?>

    	<input type="button" value="<?php  echo $lblM; ?>" style="width:98%"  onclick="creaminuta('<?=$vkardex?>','<?=$tipodoc?>');"/>


    </td>
</tr>

<tr>
	<td><input type="text" readonly="readonly" class="respuuuu" style="font-size:10px;font-family: verdana;color: #333;width:90%" value="<?php echo $dir; ?>" /></td>
    <td>
    <input type="button" value="VER" style="width:48%"  onclick="generaminuta('<?php echo $vkardex;?>','<?php echo $tipodoc;?>');" <?php echo $DISABLED?>/>
    <input type="button" value="ELIMINAR" style="width:48%"  onclick="eliminarminuta('<?php echo $vkardex;?>','<?php echo $tipodoc; ?>');" <?php echo $DISABLED?>/>    
    </td>
</tr>

<tr><td colspan="2"></td></tr>
<tr><td colspan="2"><hr /></td></tr>
<tr>
    <td colspan="2">
    <span class="TITULO">
    SUBIDA DE ARCHIVO
    </span>   
    </td>
</tr>
<form enctype="multipart/form-data" id="formu" name="formu" action="actualizaminuta.php" method="POST">
<tr>
    <td width="70%">
    	<input style="width:100%;" type="file" id="archivo" name="archivo" value="Cargar nuevo archivo">
    	<input style="width:100%;" type="hidden" id="kardex" name="kardex" value="<?php echo $vkardex; ?>">
    </td>
    <td width="30%" align="center">
   	 <input type="submit" value="Grabar Archivo">
    </td>
</tr>
</form>
</table>
<table width="100%" align="center">
<tr><td><hr /></td></tr>
    <tr>
    	<td>
        	<table width="100%" cellspacing="0" cellpadding="0">
            	<tr bgcolor="#0E506F">
                	<td align="center" width="10%"><span class="TITULO2">TIPO</span></td>
                	<td align="center" width="15%"><span class="TITULO2">FECHA</span></td>
                    <td align="center" width="15%"><span class="TITULO2">HORA</span></td>
                    <td align="center" width="25%"><span class="TITULO2">USUARIO</span></td>
                    <td align="center" width="15%"><span class="TITULO2">PC</span></td>   
                    <td align="center" width="5%"><span class="TITULO2">&nbsp;</span></td>                	<td style="display: none;" align="center" width="5%"><span class="TITULO2" style="color:#0E506F">aa</span></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td>
        	<div id="divProyecto" style="width:100%;height:90px;border:1px #000 solid;overflow:scroll;">
        	<table width="100%" cellspacing="0" cellpadding="0">
            <?php
			$query="SELECT 
					  d.*,
					  u.`loginusuario` 
					FROM
					  documentogenerados d 
					  LEFT JOIN usuarios u 
						ON u.`idusuario` = d.`usuario` 
					WHERE d.kardex = '".$vkardex."'
					AND flag='MIN' order by d.id desc ";	
                    		
			$queryLast=mysqli_query($conn_i,$query);

            if($queryLast!=false){
			while($row=mysqli_fetch_assoc($queryLast)){


                if($row["pc"]=="")
                        $row["pc"]="PC/LOCAL";
				if($row["tipogeneracion"]=="CUERPO"){
					$TEXTO="MIN";$COLOR="#FF0";
				}else if($row["tipogeneracion"]=="INSTRUMENTO"){
					$TEXTO="INST";$COLOR="#3C3";
				}else if($row["tipogeneracion"]=="PROYECTO"){
					$TEXTO="PROY";$COLOR="#F00";
				}else if($row["tipogeneracion"]=="PARTE"){
					$TEXTO="PART";$COLOR="#FF8000";
				}else if($row["tipogeneracion"]=="TESTIMONIO"){
					$TEXTO="TEST";$COLOR="#FFF";
				}
			?>
            	<tr class="fila">
                	<td align="center" width="10%">
                    <div style="
                    background-color: <?php echo $COLOR; ?>;
                    border: 2px solid;
                    border-radius: 6px;
                    font-family: Verdana;
                    font-size: 11px;
                    font-weight: bolder;
                    text-align: center;
                    box-shadow: 0 0 0px #000000;
                    height: 14px;
                    width: 80%;">
                    <?php echo $TEXTO ; ?>
                    </div>
                    </td>
                	<td align="center" width="15%"><span class="TITULO21"><?php echo fechabd_an(substr($row["fecha"],0,10)); ?></span></td>
                    <td align="center" width="15%"><span class="TITULO21"><?php echo (substr($row["fecha"],11,10)); ?></span></td>
                    <td align="center" width="25%"><span class="TITULO21"><?php echo $row["loginusuario"]; ?></span></td>
                    <td align="center" width="15%"><span class="TITULO21"><?php echo $row["pc"]; ?></span></td>   
                    <td style="display: none;" align="center" width="5%"><span class="TITULO21">
                    <?php if(trim($row["observacion"])!=""){
						if($row["tipogeneracion"]=="PARTE" || $row["tipogeneracion"]=="TESTIMONIO"){
							$funcion="verObsEscriP";
						}else{
							$funcion="verObsEscriF";
						}
					?>
                    <a onClick="<?=$funcion?>('<?=$row["id"]?>');" style="cursor:pointer;"><img src="iconos/view.png" width="20" height="20"></a>
                    <?php }else{ echo '<img src="imagenes/fndacor.png" width="20" height="20">';}?>
                    </span></td>
                </tr>
            <?php }
        }
            ?>   
            </table>
            </div>
        </td>
    </tr>
</table>

</body></html>

