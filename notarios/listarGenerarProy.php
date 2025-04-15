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
.btnProyectos{
    
    border-radius:5px;
    padding:.3em .6em;
    width:200px;
    box-shadow:0;
    color:white;
    border:none;
    width:140px;
    font-family:Calibri;
    cursor: pointer;
}
.btn-primary{background:rgba(52,152,219,1);}
.btn-success{background:rgba(39,174,96,1);}
.btn-info{background:rgba(211,84,15,1);}
.btn-default{background:rgba(231,76,60,1);}

.btn-primary:hover{background:rgba(52,152,219,.8);}
.btn-success:hover{background:rgba(39,174,96,.8);}
.btn-info:hover{background:rgba(211,84,15,.8);}
.btn-default:hover{background:rgba(231,76,60,.8);}
</style>

</head> 
<body  oncontextmenu="return false" >
    <img src="loading.gif" id="loaderProy" style="display:none;width:40px;position:absolute;top:0%;left:49%;translate:scaleX(-50%) scaleY(-50%)">
<?php 
session_start();
include("conexion2.php");	
include("extraprotocolares/view/funciones.php");	
$vkardex=$_REQUEST['kardex'];

$sqlvkardex=mysqli_query($conn_i,"SELECT kardex.*, DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') AS 'fechaescritura2' FROM kardex where kardex='$vkardex' ") or die(mysqli_error($conn_i));

$rowvkardex=mysqli_fetch_array($sqlvkardex);
//print_r($rowvkardex);return false;

$id_usuario= $_SESSION["id_usu"];
$sqlu  = mysqli_query($conn_i,"SELECT * FROM permisos_usuarios where idusuario = '$id_usuario'") or die(mysqli_error($conn_i));
$rowu= mysqli_fetch_array($sqlu);
?>

<table width="100%" align="center">
	<tr><td></td></tr>
    <tr>
    	<td  style="padding-bottom:1em"><span class="TITULO">GENERADOR DE PROYECTOS (<?php echo $vkardex;?>)</span></td>
    </tr>
    <tr><td></td></tr>
    <tr >
    	<td align="center" >
            <!--registraDocum('<?=$vkardex?>','PROYECTO')-->
        	<!-- <input type="button" value="LIMPIAR CAMPO" style="width:130px;font-family:Calibri;display: none;" onClick="limpiarCamposEscri()"> -->
            &nbsp;&nbsp;&nbsp;
            
            <?php
                // if($id_usuario==1){
                    //echo '<input type="button" class="btnProyectos" type="button" id="btnGenerarProyecto"  style="width:130px;font-family:Calibri;cursor: pointer;"  onclick="CreaDocum();" value="GENERAR PROYECTO">';
                // }else{

                //     if (strpos($vkardex, 'ACT') !== false) {
                //         $directorio= 'C:/Proyectos/Vehicular/__PROY__'.$vkardex.'.docx';
                //     }else{
                //         $directorio= 'C:/Proyectos/Escrituras/__PROY__'.$vkardex.'.docx';
                //     }  
    
                //     if (!file_exists($directorio)) {
                //         echo '<input type="button" class="btnProyectos" type="button" id="btnGenerarProyecto"  style="width:130px;font-family:Calibri;cursor: pointer;" title="Genera tu documento en formato DOCX" onclick="CreaDocum();" value="GENERAR PROYECTO">';
                //     } else {
                //         echo 'DOCUMENTO GENERADO';
                //     }
                // }
            ?>
            <input type="button" class="btnProyectos btn-default" type="button" id="btnGenerarProyecto" onclick="CreaDocum(null);" value="GENERAR PROYECTO">
            <input type="button" class="btnProyectos btn-primary" type="button" id="btnActualizarProyecto" onclick="CreaDocum('actualizar');" value="ACTUALIZAR PROYECTO">
            <input type="button" class="btnProyectos btn-success" type="button" id="btnGenerarParte"  onclick="CreaDocum('parte')" value="GENERAR PARTE">
            <input disabled type="button" class="btnProyectos btn-info " type="button" id="btnGenerarTestimonio"  onclick="CreaDocum('testimonio');" value="GENERAR TESTIMONIO">
            &nbsp;&nbsp;&nbsp;
            <!--<a class="btnProyectos" type="button" id="btnGenerarProyecto"  style="width:130px;font-family:Calibri;cursor: pointer;" title="Abrir proyecto" onclick="abrirDocumento('<?php echo $vkardex; ?>');"><img src="iconos/icon_pdf.png" alt="" width="15px"> ABRIR PROYECTO</a>
            &nbsp;&nbsp;&nbsp;
            <a class="btnProyectos" type="button" id="btnActualizarProyecto" style="width:130px;font-family:Calibri;cursor: pointer;" title="ACTUALIZAR DOCUMENTO" onclick="CreaDocum('actualizar');"><img src="images/refresh.png" alt="" width="15px"> ACTUALIZAR PROYECTO</a>-->

            <!-- &nbsp;&nbsp;&nbsp;
            <input type="button" value="EDITAR PROYECTO" style="width:130px;font-family:Calibri;display: none;" onClick="fVisualDocument();">
            &nbsp;&nbsp;&nbsp;
            <input type="button" value="VER PROYECTO" style="width:130px;font-family:Calibri;display: none;" onClick="fVisualDocument_Ver();"> -->
        </td>
    </tr>
    <tr><td></td></tr>
    <tr><td><hr /></td></tr>
    <tr>
    	<td>
        	<table width="100%" cellspacing="0" cellpadding="0">
            	<!--<tr bgcolor="#0E506F">
                	<td align="center" width="10%"><span class="TITULO2">TIPO</span></td>
                	<td align="center" width="10%"><span class="TITULO2">DOCUMENTO</span></td>
                	<td align="center" width="15%"><span class="TITULO2">FECHA</span></td>
                    <td align="center" width="15%"><span class="TITULO2">HORA</span></td>
                    <td align="center" width="25%"><span class="TITULO2">USUARIO</span></td>
                    <td align="center" width="15%"><span class="TITULO2">PC</span></td>   
                    <td align="center" width="15%"><span class="TITULO2">PROY.</span></td>   
                    <td align="center" width="15%"><span class="TITULO2">PARTE</span></td>   
                    <td  align="center" width="5%"><span class="TITULO2">&nbsp;</span></td>                	
                    <td align="center" width="5%"><span class="TITULO2" style="color:#0E506F">aa</span></td>
                </tr>-->
            </table>
        </td>
    </tr>
    <tr>
        <style type="text/css">
            .headProy{
                padding:.2em;
                border:1px solid #9dc6e8;
                margin:.2em;
                border-radius: 5px;
                background:steelblue;
                text-align: center;
            }
            .bodyProy{
                border:1px solid #9dc6e8;
                border-radius: 5px;
                text-align: center;

            }
        </style>
    	<td>
        	<div id="divProyecto" style="width:100%;height:90px;overflow:scroll;">
        	<table  width="100%" cellspacing="0" cellpadding="0">
                <tr style="padding:.5em 0;">
                    <td  class="headProy"><span class="TITULO2">TIPO</span></td>
                    <td  class="headProy"><span class="TITULO2">DOCUMENTO</span></td>
                    <td  class="headProy"><span class="TITULO2">FECHA</span></td>
                    <td  class="headProy"><span class="TITULO2">HORA</span></td>
                    <td  class="headProy"><span class="TITULO2">USUARIO</span></td>
                    <td  class="headProy"><span class="TITULO2">PC</span></td>   
                    <td  class="headProy"><span class="TITULO2">PROY.</span></td>   
                    <td  class="headProy"><span class="TITULO2">PART.</span></td>   
                    <td  class="headProy"><span class="TITULO2">TEST.</span></td>   
                    <td  class="headProy"><span class="TITULO2">REG.</span></td>   
                </tr>
            <?php
			$query="SELECT 
					  d.*,
					  u.`loginusuario` 
					FROM
					  documentogenerados d 
					  LEFT JOIN usuarios u 
						ON u.`idusuario` = d.`usuario` 
					WHERE d.kardex = '".$vkardex."' 
					AND (flag='ESCRI' OR flag='MIN') order by d.id desc";			
			$queryLast=mysqli_query($conn_i,$query);
			while($row=mysqli_fetch_assoc($queryLast)){

                if($row["pc"]=="")
                        $row["pc"]="PC/LOCAL";

				if($row["tipogeneracion"]=="CUERPO"){
					$TEXTO="MIN";$COLOR="#FF0";
				}else if($row["tipogeneracion"]=="INSTRUMENTO"){
					$TEXTO="INST";$COLOR="#3C3";
				}else if($row["tipogeneracion"]=="PROYECTO"){
					//$TEXTO="PROY";$COLOR="#F00";
                    $TEXTO="PROY";$COLOR="steelblue";
				}else if($row["tipogeneracion"]=="PARTE"){
					$TEXTO="PART";$COLOR="#FF8000";
				}else if($row["tipogeneracion"]=="TESTIMONIO"){
					$TEXTO="TEST";$COLOR="#FFF";
				}
			?>
            	<tr class="fila">
                	<td style="border:1px solid #9dc6e8" align="center" width="10%">
                    <div style="
                    background-color: <?php echo $COLOR;?>;
                    border: 1px solid white;
                    color:white;
                    border-radius: 6px;
                    font-family: Verdana;
                    font-size: 11px;
                    font-weight: bolder;
                    text-align: center;
                    box-shadow: 0 0 0px #000000;
                    height: 14px;
                    width: 80%;">
                    <?php echo $TEXTO?>
                    </div>
                    </td>
                	<td class="bodyProy"><span class="TITULO21"><?php echo ($row["kardex"]); ?></span></td>
                	<td class="bodyProy"><span class="TITULO21"><?php echo fechabd_an(substr($row["fecha"],0,10)); ?></span></td>
                    <td class="bodyProy"><span class="TITULO21"><?php echo (substr($row["fecha"],11,10)); ?></span></td>
                    <td class="bodyProy"><span class="TITULO21"><?php echo $row["loginusuario"]; ?></span></td>
                    <td class="bodyProy"><span class="TITULO21"><?php echo $row["pc"];?></span></td>   
                    <td class="bodyProy"><a href="#" id="btnAbrirProyecto" title="ABRIR REGISTRO" onclick="abrirDocumento('<?php echo ($row['kardex']); ?>');"><img src="iconos/icon_pdf.png" alt="" width="25px"></a></td>   
                    <td class="bodyProy"><a href="#" title="ABRIR PARTE NOTARIAL" onclick="abrirParteNotarial('<?php echo ($row['kardex']); ?>')"><img src="iconos/nuevo2.png" alt="" width="22px"></a></td>   
                    <td class="bodyProy"><a href="#" title="ABRIR TESTIMONIO" onclick="CreaDocum('parte')"><img src="iconos/nuevo2.png" alt="" width="22px"></a></td>  

                    <?php 

                            $fechaEntera = strtotime($rowvkardex["fechaescritura"]);
                            $anio = date("Y", $fechaEntera);
                            $numEscritura =  '';
                            $dirEscritura =  '';

                            switch ($rowvkardex["idtipkar"]) {
                                case 1:
                                    $numEscritura = 'E'.$rowvkardex["numescritura"].'-'.$anio;
                                    $dirEscritura = 'ESCRITURAS';
                                    break;
                                case 2:
                                    $numEscritura = 'N'.$rowvkardex["numescritura"].'-'.$anio;
                                    $dirEscritura = 'NOCONTENCIOSOS';
                                    break;
                                case 3:
                                    $numEscritura = 'A'.$rowvkardex["numescritura"].'-'.$anio;
                                    $dirEscritura = 'ACTAS';
                                    break;
                                case 4:
                                    $numEscritura = 'G'.$rowvkardex["numescritura"].'-'.$anio;
                                    $dirEscritura = 'GARANTIAS';
                                    break;
                                case 5:
                                    $numEscritura = 'T'.$rowvkardex["numescritura"].'-'.$anio;
                                    $dirEscritura = 'TESTAMENTOS';
                                    break;
                                
                            }                            
                    ?> 
                    <td class="bodyProy"><a href="#" title="ABRIR REGISTRO" onclick="abrirPdf('<?php echo $numEscritura; ?>','<?php echo $dirEscritura; ?>','<?php echo $anio; ?>')"><img src="images/pdf.png" alt="" width="22px"></a></td>   
                    
                </td>

                </tr>
            <?php }?>
            
            </table>
            </div>
        </td>
    </tr>
    <tr>
    	<td><span class="TITULO21">OBSERVACION</span></td>
    </tr>
    <tr>
    	<td><textarea id="obs" name="obs" class="TITULO21" style="width:100%;height:70px;text-transform:uppercase;"></textarea></td>
    </tr>
</table>

</body>
</html>