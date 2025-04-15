<?php 
session_start();
include('conexion.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ingreso de Comprobantes</title>

<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<!--<link rel="stylesheet" type="text/css" href="../../librerias/jquery/jquery-ui.theme.css">-->

<script type="text/javascript" src="../../librerias/jquery/external/jquery/jquery.js"></script>
<script type="text/javascript" src="../../librerias/jquery/jquery-ui.js"></script>

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script  src="../../tcal.js" type="text/javascript"></script> 
<script  type = "text/javascript" > 
function print ()  { 
    var iframe = document . getElementById ( 'textfile' ); 
    iframe . contentWindow . print (); 
} 
</script>
<style type="text/css">
div.carta_content {
	background:#333333; 
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:638px;
	height:220px;
	position:absolute;
	left: 549px;
	top: 496px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;
}

div.allcontrata {width:600px; height:150px; overflow:auto;}
.titupatrimo {font-size: 12; font-style: italic; font-family: Calibri;}

div.div_bloques
{ 
background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:820px; height:750px;
}

.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }

.camposss2 {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; vertical-align:top; text-align:right }


#field_remitente, #field_destinatario, #field_responpago, #field_diligencia, #field_cargo, #div_detfact{
	margin:0 auto;
	border: 2px solid #ddd; 
	border-radius: 10px; 
	padding: 2px; 
	box-shadow: #ccc 5px 0 5px;
	margin-bottom:0px;
	}

.fielSetTipoVista{
	width:100%;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#000;
	font-weight:bold;
	border:#000 solid 1px;
	box-shadow: #ccc 5px 0 10px;
	border-radius: 10px; 
	}
.detraccion{
	width:100%;
	font-family:Arial, Helvetica, sans-serif;
	font-size:15px;
	text-decoration:blink;
	text-transform:uppercase;
	color:#F00;
	font-weight:bold;
	border-radius: 10px;
	}
	
.detraccion2{
	width:100%;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	text-transform:uppercase;
	color:#F00;
	font-weight:bold;
	border-radius: 10px;
	}			
.detraccion21 {	width:100%;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	text-transform:uppercase;
	color:#F00;
	font-weight:bold;
	border-radius: 10px;
}
</style>

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../Ajax/egresos_emitir.js" ></script>
<script type="text/javascript" src="../../librerias/scriptaculous/src/scriptaculous.js" ></script>

</head>

<body style="font-size:62.5%;" onLoad="cargar_contenido()" >

<form id="frm_comprobante" name="frm_comprobante">
<table id="table_sis" style="width:850px" align="center">
	 <tr>
     	<td width="515" height="59">
        	<table width="241">
            		<tr>
                    	<td width="57">
                        <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:40px; cursor:pointer" title="Guardar" onClick="grabar_comprobante()">
                        <img style="margin-left:10px" src="../../images/save.png" width="15" height="15" title="Guardar">
                        <span style="color:#3A7099"><B>Guardar</B></span>
                        </div></td>
                        <td width="83">
                        <div id="imprimir_todo" style="display:"></div>
                        
                        <div id="div_gencomp" name="div_gencomp" style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:64px; cursor:pointer; display:none" title="Generar Doc." onclick = " print () ">
                        
                        <img style="margin-left:20px; " src="../../images/print.png" width="20" height="20" title="Generdad Doc."><span style="color:#3A7099"><B>Generar Docs.</B></span>
                        <input id="id_pdf" name="id_pdf" type="hidden" value="" />
                        </div>
                        </td>
                        <td width="95">
                        <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:65px; display:none" title="Comprobantes">
                        <img style="margin-left:22px; cursor:pointer" src="../../images/block.png" width="20" height="20" title="Comprobantes">
                        <span style="color:#3A7099"><B>Comprobantes</B></span>
                        </div></td>
                        
                        <td></td>
                    </tr>
            </table>
   	   </td>
     </tr>
     <tr>
     	<td>
        	<table width="739">
            		<tr>
                    	<td width="95"><span class="camposss">Tipo de Comprobante:</span></td>
                        <td width="115"><div id="slc_tipdoc"></div></td>
                        <td width="10">&nbsp;</td>
                        <td width="150"><div id="div_checkpago"></div></td>
                        <td width="136"><span class="camposss">Fecha de Emisión:</span></td>
                        
                        <td width="157">
                        <input id="fecha_emision1" name="fecha_emision1" type="text"  style="width:90px; color:#777777; display:none" value="<?php echo date("d/m/Y"); ?>" readonly class="tcal" /><input id="fecha_emision2" name="fecha_emision2" type="text"  style="width:90px; color:#777777" value="<?php echo date("d/m/Y"); ?>"  class="tcal" /></td>
                       
                        <input id="usuario_sesion" name="usuario_sesion" type="hidden"  style="text-transform:uppercase" size="15" value="<?php echo $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"]; ?>" />
                    </tr>
            </table>	
        </td>
     </tr>
     <tr>
     	<td height="96">
            <div id="div_datoscliente" style="border: 2px solid #D3D3D3; border-radius: 8px ; padding:5px">
        		
            </div>
        </td>
     </tr>
     <tr>
     	
     </tr>
     <tr>
     	<td>
        	<table>
            		<tr>
                    	<td>
                          <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:95px; margin-top:5px" ><span style="color:#3A7099; position:relative; left:5px; top:-5px; width:120px"><B>DESCRIPCION</B></span>
                        </div><!--onClick="mostrar_servicio()"-->
                        </td>
                    </tr>
            </table>	
        </td>
     </tr>
     <tr>
     	
     </tr>
     <tr>
         <td align="center">
         	<div id="div_textarea" style="border: 1px #777 solid ; border-radius: 8px ;  width:auto; height:70px; display:none">
            	<table>
                	<tr>
                    	<td>
                        	<span class="camposss">Detalle: </span>
                        </td>
                        <td>
                        	<textarea id="comentarios" name="comentarios" class="camposss" style="width:450px; height:60px; text-transform:uppercase" maxlength="250">
                            </textarea>
                        </td>	
                    </tr>
                </table>
            </div>
         </td>
     </tr>
     <tr style="height:auto">
     	<td>
        	<div id="div_detalle"  style="border: 2px solid #D3D3D3; border-radius: 8px ; padding:5px ;  width:auto; height:auto; min-height:120px">
        		
            </div>
        </td>
     </tr>
     <tr>
     	<td>
        	<div id="div_totales"></div>
        		
        </td>
     </tr>
</table>
</form>


<div id="div_cliente" style="background-color:#DDECF7; width:auto; height:auto; border-radius: 10px; border-color:#DDECF7; position:absolute; left:135px; top:110px; display:none; padding:20px; overflow:hidden; width:620px"></div>

<div id="div_ncliente" style="background-color:#264965; width:auto; height:auto; border-radius: 10px; border-color:#3B88A8; position:absolute; left:120px; top:110px; display:none; padding:20px; overflow:hidden; width:620px"></div>

<div id="div_login" style="background-color:#DDECF7; width:300px; height:auto; border-radius: 10px; border-color:#DDECF7; position:absolute; left:511px; top:110px; display:none">
	<table width="300px">
    		<tr>
            	<td colspan="2" align="center">
                <table width="287">
                    <tr>
                        <td width="84"></td>
                    	<td width="145"><span class="camposss2" >Ingrese sus datos</span></td>
                        <td width="42"><span onClick="cerrar_login()" style="margin-left:30px; cursor:pointer" title="Cerrar">X</span></td>
                    </tr>

                </table>
              </td>
            </tr>
            <tr>
            	<td width="84"><span class="camposss2" style="font-size:12px; margin-left:10px">Usuario</span></td>
                <td width="204"><input id="usuario" name="usuario" type="text" maxlength="20" size="20"/></td>
            </tr>
            <tr>
            	<td><span class="camposss2" style="font-size:12px; margin-left:10px">Contraseña</span></td>
                <td><input id="pass" name="pass" type="password" maxlength="20" size="20"/></td>
            </tr>
            <tr>
            	<td colspan="2" align="center"><input onClick="habilitar_edicion();" type="button" value="Login" size="15" style="font-family:Verdana, Geneva, sans-serif; font-size:12px"/></td>
            </tr>
    </table>
</div>

<div id="valorusuario"><input id="valorusu" name="valorusu" type="hidden" /></div>






</body>
</html>