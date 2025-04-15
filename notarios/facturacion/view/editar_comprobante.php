<?php 
session_start();

include('../../extraprotocolares/view/funciones.php');
include('../../conexion.php');
include('../consultas/comprobante.php');


$id=$_REQUEST['id'];

$arr_regventa = dame_comprobante($id);
$arr_documentos = dame_documentos();
$arr_comprobantes = dame_comprobantes();
$arr_tipospagos = dame_tipopagos();
$arr_servicios = dame_servicios();
$arr_usuarios = dame_usuarios();
$arr_dregventas = dame_dregventas($id);

//var_dump($arr_dregventas);

//var_dump($arr_regventa);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Emision de comprobantes</title>
<style type="text/css">
div.frmcartas
{ 
  background-color: #ffffff;
border: 4px solid #264965;  

-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:900px; height:850px;
}

.titulosprincipales {
	font-family: Calibri;
	font-size: 18px;
	color: #FF9900;
	font-style: italic;
}
.line {color: #FFFFFF}
</style>

<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<!--<link rel="stylesheet" type="text/css" href="../../librerias/jquery/jquery-ui.theme.css">-->

<script type="text/javascript" src="../../librerias/jquery/external/jquery/jquery.js"></script>
<script type="text/javascript" src="../../librerias/jquery/jquery-ui.js"></script>
<script type="text/javascript" src="../Ajax/emision.js" ></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script  src="../../tcal.js" type="text/javascript"></script> 

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
<script type="text/javascript" src="../Ajax/anular.js" ></script>
<script type="text/javascript" src="../../librerias/scriptaculous/src/scriptaculous.js" ></script>
<script type="text/javascript" src="../Ajax/emision.js" ></script>
</head>

<body>
<div class="frmcartas">
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" bgcolor="#264965"><table width="900" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="33" height="30"><img src="../../iconos/newproto.png" alt="" width="26" height="26" /></td>
          <td width="328"><span class="titulosprincipales">Editar Comprobantes</span></td>
          <td width="510" align="left"><table width="454" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="376" height="30">&nbsp;</td>
              <td width="10"><span class="line">|</span></td>
              <td width="69"><a onclick="history.back()" target="ncartas"><img src="../../images/back.png" width="22" height="22" border="0" title="Regresar"/></a></td>
              </tr>
          </table></td>
          <td width="29">&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="19">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">
    	<form name="frm_comprobante" id="frm_comprobante" style="width:850px">
        <input type="hidden" name="idregventas" id="idregvengas"  value="<?php echo $id;?>"/>

            <table align="center" style="width:850px" id="table_sis">
                <tr>
                    <td width="515" height="59">
                        <table width="800">
                               <tr>
                                    <td width="57" colspan="2">
                                    <!--<div onclick="mod_comprobante()" title="Guardar" style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:40px; cursor:pointer">
                                    <img width="15" height="15" title="Grabar" src="../../images/save.png" style="margin-left:10px">
                                    <span style="color:#3A7099; font-size:10px; margin-left:2px"><b>Grabar</b></span>
                                    </div>-->
                                    <span class="camposss" style="font-size:18px; color:#0080FF"><u>Edición de Comprobante</u></span>
                                 </td>
                                    <!--<td width="83">
                                    <div onclick="generar_comprobante()" title="Generar Doc." style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:64px; cursor:pointer; display:none" name="div_gencomp" id="div_gencomp">
                                    <img width="20" height="20" title="Generdad Doc." src="../../images/print.png" style="margin-left:20px; ">
                                    <span style="color:#3A7099"><b>Generar Docs.</b></span>
                                    </div></td>-->
                                    <!--<td width="95">
                                    <div title="Comprobantes" style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:65px; display:none">
                                    <img width="20" height="20" title="Comprobantes" src="../../images/block.png" style="margin-left:22px; cursor:pointer">
                                    <span style="color:#3A7099"><b>Comprobantes</b></span>
                                    </div></td>-->
                                    
                                    <td><div style="display:none" id="div_flagidreg"></div></td>
                                    <td><div style="display:" id="div_flagidreg"><img src="../../iconos/grabar.png" align="right" onclick="guardarEditarCaja()" /></div></td>
                                </tr>
                        </table>	
                    </td>
                 </tr>
                 <tr>
                    <td>
                        <table width="810">
                               <tr>
                                    <td width="102"><span class="camposss">Tipo de Comprobante:</span></td>
                                    <td width="167">
                                    <div id="">
                                    <?php 
									$consulta_tipdoc = "SELECT tip_documen.id_documen AS 'id', tip_documen.des_docum AS 'des' FROM tip_documen ORDER BY tip_documen.des_docum ASC";
	                                $ejecuta_tipdoc = mysql_query($consulta_tipdoc, $conn);
	                               $i=0;
	                               ?>
                              <select id="tip_comp" name="tip_comp"  onchange="cambiar_comprobante_edit()" style='width:167px; background-color:#E1E1E1' class='camposss'  >
                                <option value="">--Tipo de Comprobante--</option>
                                 <?php    
	                                while($tipodoc = mysql_fetch_assoc($ejecuta_tipdoc)){ ?>
	                             <option 
                                   <?php
                                  if($tipodoc['id']==$arr_regventa[1]){
		                    		echo "selected='selected'";
		                          }
                                 ?>
                                 value='<?php 						
	                            echo $tipodoc['id']; ?>'><?php echo $tipodoc['des'];
	                              ?></option> 
	                               <?php } ?>
	                           </select>
									</div></td>
                                    <td width="78"><span style="margin-left:10px" class="camposss">N. Docum:</span></td>
                                    <td width="35">
                                    <div id="div_serie">
                					<input type="text" value="<?php echo $arr_regventa[2]; ?>" style="width:30px; " class="camposss" id="numDocBoleta" name="numDocBoleta" />
                                    </div>
                					</td>
                                    <td width="9"><span>--</span></td>
                                    <td width="120">
                                    <div id="div_numdoc">
                					<input type="text" value="<?php echo $arr_regventa[3]; ?>" style="width:100px; " class="camposss" id="numBoleta" name="numBoleta" />
									</div>
                                    </td>
                                    <td width="109"><span class="camposss">Fecha de Emisión:</span></td>
                                    <td width="112">
                                    <input type="text" value="<?php echo fechabd_an($arr_regventa[4]); ?>" style="width:90px; " class="camposss" id="fedita" name="fedita" /></td>
                                   <!-- <td width="38"><img width="20" height="20" style="cursor:pointer" src="../../images/pencil.png" onClick="mod_comprobante()"></td> -->
                                </tr>
                        </table>	
                    </td>
                 </tr>
                 <tr>
                    <td height="96">
                        <div style="border: 2px solid #D3D3D3; border-radius: 8px ; padding:5px; width:840px" id="div_datoscliente">
                			<table width="754">
                                <tr>
                                    <td width="102"><span class="camposss">RUC/DOIC:</span></td>
                                    <td width="340">
									  <?php 
                                     $consulta_tipdoc = "SELECT idtipdoc AS 'id', destipdoc AS 'des' FROM tipodocumento ORDER BY idtipdoc ASC";
	                                 $ejecuta_tipdoc = mysql_query($consulta_tipdoc, $conn);
	                                
                                      ?>
                                      <select style="width:340px; " class="camposss" id="dni" name="dni" >
		
							         <option value="0">--Tipo de Documento--</option>
                                      <?php    while($tipodocu = mysql_fetch_assoc($ejecuta_tipdoc)){ ?>
	                                 <option <?php
                                       if($tipodocu['id']==(int)$arr_regventa[18]){
				                       echo "selected='selected'";
                                       } ?>
                                      value='<?php echo $tipodocu['id']; ?>'><?php echo $tipodocu['des'];?></option> 
	                                  <?php } ?>
	                                 </select>
                                    </td>
                                    <td width="102"><input type="text" value="<?php echo $arr_regventa[7]; ?>" style="width:100px; " name="dnicliente" id="dnicliente" class="camposss" ></td>
                                    <td width="22"></td>
                                    <td width="58"><span class="camposss">Teléfono:</span></td>
                                    <td width="102">
                                    	<input type="text" value="<?php echo $arr_regventa[9]; ?>" style="width:100px; " class="camposss" name="tel" id="tel"/>
                                     </td>
                                </tr>
                                <tr>
                                    <td><span class="camposss">Nombre Cliente:</span></td>
                                    <td colspan="5"><input type="text" value="<?php echo $arr_regventa[6]; ?>" style="width:300px; " class="camposss" id="cliente" name="cliente" ></td>
                                </tr>
                                <tr>
                                    <td><span class="camposss">Dirección:</span></td>
                                    <td colspan="5"><input type="text" value="<?php echo $arr_regventa[8]; ?>" style="width:640px; " class="camposss" id="direccion" name="direccion" /></td>
                        		</tr>
                          </table>
                      </div>
                    </td>
                 </tr>
                 <tr>
                    <td>
                        <div style="border: 2px solid #D3D3D3; border-radius: 8px ; padding:5px; width:840px" id="div_detalleslc">
                        <table width="783">
                        <tr>
                            <td height="25" colspan="7"><span class="camposss">Detalle:</span></td>
                        </tr>
                        <tr>
                            <td width="76"><span class="camposss">Pago:</span></td>
                            <td width="152"><div id="slc_tippag">    
							   <?php 
                                     $consulta_tippago = "SELECT codigo AS 'id', descrip AS 'des' FROM tipo_pago ORDER BY codigo ASC";
	                                 $ejecuta_tippago = mysql_query($consulta_tippago, $conn);
                               ?>
                             <select class="camposss" style="width:160px;" id="tipoPago" name="tipoPago">
		
							 <option value="">--Tipo de Pago--</option>
                              <?php    while($tipopago = mysql_fetch_assoc($ejecuta_tippago)){ ?>
	                        <option <?php
                                       if($tipopago['id']==$arr_regventa[17]){
				                       echo "selected='selected'";
                                       } ?>
                               value='<?php echo $tipopago['id']; ?>'><?php echo $tipopago['des'];?></option> 
	                           <?php } ?>
	                         </select>
                            </div>
                            </td>
                            <td width="279" height="35"><div style="width:270px;  overflow:hidden; " id="div_checkpago"></div></td>
                            <td width="93"><span class="camposss">Atendido por:</span></td>
                            <td width="169"><div id="slc_usuario"> 
								 <?php 
                                     $consulta_tipusu = "SELECT usuarios.idusuario AS 'id', usuarios.loginusuario AS 'des' FROM usuarios order by usuarios.idusuario ASC";
	                                 $ejecuta_tipusu = mysql_query($consulta_tipusu, $conn);
	                                
                                      ?>
                                     <select class="camposss" style="width:185px; "   disabled="disabled">
		
							         <option>--Atendido por--</option>
                                      <?php    while($tipousu = mysql_fetch_assoc($ejecuta_tipusu)){ ?>
	                                 <option <?php
                                       if((int)$tipousu['id']==(int)($arr_regventa[13])){
				                       echo "selected='selected'";
                                       } ?>
                                      value='<?php echo $tipousu['id']; ?>'><?php echo $tipousu['des'];?></option> 
	                                  <?php } ?>
	                                 </select>
                            </div></td>
                        </tr>
                       </table>
                      </div>	
                  </td>
             	 </tr>
                 <!-- 	
                 <tr>
                    <td>
                        <table>
                               <tr>
                                    <td>
                                      <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:85px; margin-top:5px">
                                    <img width="20" height="20" src="../../images/new.png"><span style="color:#3A7099; position:relative; left:5px; top:-5px; width:120px; font-size:10px"><b>SERVICIOS</b></span>
                                    </div>
                                    </td>
                                </tr>
                        </table>	
                    </td>
                 </tr>
                 <tr>
                    <td>
                        <div style="border: 1px solid; border-radius: 8px; padding: 5px; display: block; width:840px" id="div_servicio">  
                        <table width="752">
                            <tr>
                                <td width="98"><span class="camposss">Servicio:</span></td>
                                <td colspan="3"><div id="slc_serv">	
                                    <select class="camposss" style="width:450px; ">
                                        <option value="0">--Servicio--</option>
                                        <?php for($i=0; $i<count($arr_servicios); $i++){ ?>
                                        <option 
                                        <?php
										if($arr_comprobantes[$i][0]==$arr_regventa[1]){
											echo "selected='selected'";
										}
										?>
                                        value="<?php echo $arr_servicios[$i][0];?>"><?php echo $arr_servicios[$i][2] ?></option> 
 										<?php }?>
                                    </select>
                                </div></td>
                                <td width="82"><span style="margin-left:55px" class="camposss">Tipo:</span></td>
                                <td width="236">
                                <div id="slc_tipserv" style="width:130px">
                                <select style='width:130px; ' class='camposss'>
                                   <option value="1">DETALLAR</option>
                                   <option value="2" selected="selected">ESPECIFICO</option>
                                </select>
                                </div>
                              </td>
                            </tr>
                            <tr height="40">
                                <td><span class="camposss">Precio: &nbsp;(S/.)</span></td>
                                <td width="300">
                                <div id="div_precio">
                                <input type="text" value="<?php //echo $arr_regventa[0]; ?>" style="width:100px; " class="camposss" ></div>
                                </td>
                                <td colspan="4">
                                    <table width="300">
                                        <tr>
                                            <td width="59"><div id="div_numero"></div></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="camposss">Cantidad:</span></td>
                                <td colspan="5"><input type="text" value="<?php //echo $arr_regventa[0]; ?>" style="width:100px; " class="camposss" name="cantidad" id="cantidad" ></td>
                            </tr>
                            <tr>
                                <td colspan="6">--------------------------------------------------------------------------------------------------------------------------------------------------</td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <table width="768" height="41">
                                            <tr>
                                                <td width="640">&nbsp;</td>
                                                <td width="47">
                                                </td>
                                                <td width="41">

</td>
                                            </tr>
                                    </table>	
                                </td>
                             </tr>
                        </table>
                        </div>	
                    </td>
                 </tr>
                 -->
                 <tr>
                     <td align="center">
                        <div style="border: 1px #777 solid ; border-radius: 8px ;  width:auto; height:70px; display:none" id="div_textarea">
                            <table>
                                <tbody><tr>
                                    <td>
                                        <span class="camposss">Detalle: </span>
                                    </td>
                                    <td>
                                        <textarea style="width:450px; height:60px; text-transform:uppercase" class="camposss" ><?php echo $arr_regventa[0]; ?></textarea>
                                    </td>	
                                </tr>
                                </tbody>
                            </table>
                        </div>
                     </td>
                 </tr>
                 <tr style="height:auto">
                    <td align="center">
                        <div style="border: 1px solid ; border-radius: 8px ;  width:850px; height:auto; min-height:120px" id="div_detalle">
                        <table cellspacing="0" cellpadding="0" border="1" width="100%" style="background:#E1E1E1" id="myTable">
                                <tr>
                                    <td width="99"><span style="margin-left:5px" class="camposss">Código</span></td>
                                    <td width="316"><span style="margin-left:10px" class="camposss">Descripción</span></td>
                                    <td align="center" width="106"><span class="camposss">Precio</span></td>
                                    <td align="center" width="122"><span class="camposss">Cantidad</span></td>
                                    <td align="center" width="89"><span class="camposss">Total</span></td>
                                    <td align="center" width="70"><span class="camposss">Kardex</span></td>
                                    <td align="center" width="70"><span class="camposss"></span></td>
                                </tr>
                                <?php 
								for($i=0; $i<count($arr_dregventas); $i++){
								?>
                                <tr>
                                    <td width="90"><span style="margin-left:5px" class="camposss"><?php echo $arr_dregventas[$i][3]?></span></td>
                                    <td width="242"><span style="margin-left:10px" class="camposss"><?php echo $arr_dregventas[$i][4]?></span></td>
                                    <td align="center" width="100"><span class="camposss"><?php echo $arr_dregventas[$i][5]?></span></td>
                                    <td align="center" width="100"><span class="camposss"><?php echo (int)$arr_dregventas[$i][6]?></span></td>
                                    <td align="center" width="90"><span class="camposss"><?php echo $arr_dregventas[$i][7]?></span></td>
                                    <td align="center" width="90">
                                    	<span class="camposss">
                                    	<input id="kardex" name="kardex" type="text" value="<?php echo $arr_dregventas[$i][0]?>" style="width:55px; text-align:center; background-color:transparent" maxlength="6" />
                                        </span>
                                    </td>
                                    <td width="90" align="center">
                                    	<span class="camposss">
                                    	<input type="button" value="Cambiar" class="camposss" onclick="mod_comprobante('<?php echo $arr_dregventas[$i][8]?>')" style="width:70px" />
                                        </span>
                                    </td>
                                </tr>
                                <?php 
								} ?>
                        </table>
                        </div>
                    </td>
                 </tr>
                 <tr>
                    <td height="77">
                        <div id="div_totales">    
                            <table width="839">
                                <tr>
                                    <td width="390"></td>
                                    <td width="62"><span class="camposss">Sub Total:</span></td>
                                    <td width="80"><input type="text" value="<?php echo $arr_regventa[14]; ?>" style="width:70px; background-color:#CCCCCC; text-align:right" class="camposss" /></td>
                                    <td width="62"><span class="camposss">IGV(18%):</span></td>
                                    <td width="80"><input type="text" value="<?php echo $arr_regventa[15]; ?>" style="width:70px; background-color:#CCCCCC; text-align:right" class="camposss" ></td>
                                    <td width="63"><span class="camposss">Total:</span></td>
                                    <td width="80"><input type="text" value="<?php echo $arr_regventa[16]; ?>" style="width:70px; background-color:#CCCCCC; text-align:right" class="camposss" ></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                 </tr>
            </table>
            </form>
       </td>
    </tr>
  </table>
  
</div>
</body>
</html>


