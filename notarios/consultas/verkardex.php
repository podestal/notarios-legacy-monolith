	<?php 
	
	session_start();
	
	include("../extraprotocolares/view/funciones.php");
	
	include("../consultas/kardex.php");
	
	$cod_kard = $_REQUEST['kardex'];
	
	$arr_kardex = dame_kardex($cod_kard);
	
	$arr_tipkar = dame_tipkar();
	
	$arr_notarias = dame_notarias();
	
	?>
	
    <!DOCTYPE html>
	 
    <html lang="es">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link href="../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
 	<link rel="stylesheet" type="text/css" href="../includes/css/uniform.default.min.css" />	
    <link rel="stylesheet" type="text/css" href="../tcal.css" />

 	<script type="text/javascript" src="../tcal.js"></script> 

    <link rel="stylesheet" type="text/css" href="../css/protocolares/kardex.css">
    
    <!--<link rel="stylesheet" type="text/css" href="../librerias/jquery/jquery-ui.theme.css">-->
    
    <script type="text/javascript" src="../librerias/jquery/external/jquery/jquery.js"></script>
	<script type="text/javascript" src="../librerias/jquery/jquery-ui.js"></script>
    
    
    <script type="text/javascript" src="../js/prototype.js"></script>
    <script type="text/javascript" src="../ajax/protocolares/kardex.js"></script>
    
    <script type="text/javascript" src="../librerias/scriptaculous/src/scriptaculous.js" ></script>
    
    </head>

	<div class="newproto">
    	<form id="frm_mkardex" name="frm_mkardex">
    	<table align="center" cellpadding="0" cellspacing="0" style="width:100%">
        	<tr style="background-color:#264965"> 
            	<td><span class="submenutitu" style="margin-left:28px">Editar Kardex</span></td>
            </tr>
            <tr>
            	<td align="center">
                	<table style="padding-top:10px">
                         <tr>
                            <td>
                                <table width="361" height="23">
                                    <tr>
                                        <td width="231"><span class="camposss">Tipo de Kardex</span>
                                        </td>
                                        <td width="118"><span class="camposss">Fecha de Ingreso</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="771" height="35">
                                    <tr>
                                        <td width="234">
                                            <select id="m_tipkardex" name="m_tipkardex" class="camposss" style="width:220px" onChange="cambiar_kardex()">
                                            	<?php for($i=0; $i<count($arr_tipkar); $i++){?>
                                                <option 
                                                <?php
												if($arr_tipkar[$i][0]==$arr_kardex[2]){
													echo "selected='selected'";
												}
												?>
                                                value="<?php echo $arr_tipkar[$i][0] ?>"><?php echo $arr_tipkar[$i][1] ?></option>
                                                <?php }?>
                                            </select>
                                        </td>
                                        <td width="297">
                                            <input id="m_feckardex" name="m_feckardex" value="<?php echo $arr_kardex[4]; ?>" type="text" readonly="readonly" style="width:100px" class="tcal"/>
                                        </td>
                                        <td width="104">
                                            <span class="kardex">Nº Kardex:</span>
                                        </td>
                                        <td width="116">
                                            <span class="kardex"><?php echo $arr_kardex[1]; ?></span>
                                            <input id="codkardex" name="codkardex" type="hidden" value="<?php echo $arr_kardex[1]; ?>">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="756">
                                    <tr>
                                        <td width="105">
                                            <span class="camposss">Referencia:</span>
                                        </td>
                                        <td width="639">
                                            <input id="m_referencia" name="m_referencia" value="<?php echo $arr_kardex[5]; ?>" type="text" style="width:400px; text-transform:uppercase" class="camposss"/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="751">
                                    <tr>
                                        <td width="104">
                                            <span class="camposss">Código de Actos:</span>
                                        </td>
                                        <td width="145">
                                            <div id="div_codactos">
                                            <input id="m_codactos" name="m_codactos" value="<?php echo $arr_kardex[6]; ?>" type="text" style="width:100px; background-color:#B8E7DF" class="camposss" readonly />
                                            </div>
                                        </td>
                                        <td width="107">
                                            <span class="camposss">Derecho Notarial:</span>
                                        </td>
                                        <td width="131">
                                            <input id="m_notarial" name="m_notarial" value="<?php echo $arr_kardex[7]; ?>" type="text" style="width:100px" class="camposss" onKeyPress="return numerosdecimales(event);" maxlength="12" onChange="currency(this.id)"/>
                                        </td>
                                        <td width="115">
                                            <span class="camposss">Derecho Registral:</span>
                                        </td>
                                        <td width="121">
                                            <input id="m_registral" name="m_registral"  value="<?php echo $arr_kardex[8]; ?>" type="text" style="width:100px" class="camposss" onKeyPress="return numerosdecimales(event);" maxlength="12" onChange="currency(this.id)"/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="751">
                                    <tr>
                                        <td width="105">
                                            <span class="camposss">Contrato:</span>
                                        </td>
                                        <td width="454">
                                            <div id="div_contrato">
                                             <input id="m_contrato" name="m_contrato" value="<?php echo $arr_kardex[9]; ?>" type="text" style="width:400px" class="camposss" readonly/>
                                            </div>
                                        </td>
                                        <td width="78">
                                            <img src="../iconos/addacto.png" onClick="mostrar_actos('<?php echo $arr_kardex[1]; ?>', 1)" />
                                        </td>
                                        <td width="94">
                                            <img src="../iconos/delacto.png" onClick="mostrar_actos('<?php echo $arr_kardex[1]; ?>', 2)" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="758" height="25">
                                    <tr>
                                        <td>---------------------------------------------------------------------------------------------------------------------------------------
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="726" height="29">
                                    <tr>
                                        <td width="100">
                                            <span class="camposss">Kardex Conexo:</span>
                                        </td>
                                        <td width="121">
                                            <input id="m_kardconex" name="m_kardconex" value="<?php echo $arr_kardex[10]; ?>" type="text" style="width:100px" class="camposss"/>
                                        </td>
                                       <td width="52">
                                            <span class="camposss">Notaria:</span>
                                        </td>
                                        <td width="275">
                                            <select id="m_notaria" name="m_notaria" class="camposss" style="width:270px">
                                                <option value="0">--Escoger Notaria--</option>
                                                <?php for($i=0; $i<count($arr_notarias); $i++){?>
                                                <option
                                                <?php
												if($arr_notarias[$i][0]==$arr_kardex[11]){
													echo "selected='selected'";
												}
												?>
                                                value="<?php echo $arr_notarias[$i][0] ?>"><?php echo $arr_notarias[$i][1] ?></option>
                                                <?php }?>
                                            </select>
                                        </td>
                                        <td width="154">
                                            <input value="GRABAR CAMBIOS" type="button" style="width:150px; font-size:12px;" class="camposss" onClick="grabar_cambios('<?php echo $arr_kardex[1]; ?>')"/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <ul class="tabs" style="width:711px; cursor:pointer; font-size:14px; font-weight:bold">
                                                <li id="celda1" onClick="menus_editar(1,'<?php echo $arr_kardex[1]; ?>')" onMouseOver="cambiar_celda(this.id)" onMouseOut="restaurar_celda(this.id)" style="width:120px; text-align:center">Contratantes</li>
                                                <li id="celda2" onClick="menus_editar(2,'<?php echo $arr_kardex[1]; ?>')" onMouseOver="cambiar_celda(this.id)" onMouseOut="restaurar_celda(this.id)" style="width:120px; text-align:center">Facturación</li>
                                                <li id="celda3" onClick="menus_editar(3,'<?php echo $arr_kardex[1]; ?>')" onMouseOver="cambiar_celda(this.id)" onMouseOut="restaurar_celda(this.id)" style="width:120px; text-align:center">Escrituración</li>
                                                <li id="celda4" onClick="menus_editar(4,'<?php echo $arr_kardex[1]; ?>')" onMouseOver="cambiar_celda(this.id)" onMouseOut="restaurar_celda(this.id)" style="width:150px; text-align:center">Registros Públicos</li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="menus" class="Contenedor1" style="min-height:220px; width:710px"></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            <input value="UIF/PDT PATRIMONIAL" type="button" style="width:140px; font-size:12px;" class="camposss"/>
                                        </td>
                                        <td>
                                            <input value="UIF/PDT PARTICIPA" type="button" style="width:140px; font-size:12px;" class="camposss"/>
                                        </td>
                                        <td>
                                            <input value="INSERTOS" type="button" style="width:140px; font-size:12px;" class="camposss"/>
                                        </td>
                                        <td>
                                            <input value="GENERAR DOCUMENTO" type="button" style="width:140px; font-size:12px;" class="camposss"/>
                                        </td>
                                        <td>
                                            <input value="VER" type="button" style="width:140px; font-size:12px;" class="camposss"/>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
	    </table>
        </form>
    </div>
    
    <div id="div_movimiento" style="width:auto; position:absolute; top:330px; left:43px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc"></div>
     
    <div id="div_mmovimiento" style="width:auto; position:absolute; top:330px; left:43px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc"></div>
     
    <div id="div_ncontratante" style="width:auto; position:absolute; top:310px; left:53px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc"></div>
    
    <div id="div_mcontratante" style="width:auto; position:absolute; top:310px; left:53px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc"></div>
    
    <div id="div_modicontratante" style="width:auto; position:absolute; top:385px; left:53px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc; padding:10px; height:230px "></div>
    
    <div id="div_modicontratante2" style="width:662px; position:absolute; top:385px; left:53px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc; padding:10px; height:275px "></div>
    
    <div id="div_modicontratante3" style="width:662px; position:absolute; top:385px; left:53px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc; padding:10px; height:275px "></div>
    
    <div id="div_nconyugue" style="width:662px; position:absolute; top:385px; left:53px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc; padding:10px; height:275px "></div>
    
    <div id="div_ubigeos" style="width:637px; position:absolute; top:450px; left:80px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc; padding:10px; height:223px "></div>
    
    <div id="div_ocupaciones" style="width:637px; position:absolute; top:450px; left:80px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc; padding:10px; height:223px "></div>
    
    <div id="div_cargos" style="width:637px; position:absolute; top:450px; left:80px; display:none; border-radius:13px; box-shadow: 0 0 5px #000000; border:1px solid #264965; background:none repeat scroll 0 0 #cccccc; padding:10px; height:223px "></div>
    
    <div id="div_actos1" style="width:auto; position:absolute; top: 182px; left: 46px; width: 760px; height: 225px; opacity: 0.95; display:none; border-radius:10px; box-shadow: 0 0 7px #000000; border:1px solid #333333; background:none repeat scroll 0 0 #333333; "></div>
    
    <div id="div_actos2" style="width:auto; position:absolute; top: 182px; left: 46px; width: 760px; height: 225px; opacity: 0.95; display:none; border-radius:10px; box-shadow: 0 0 7px #000000; border:1px solid #333333; background:none repeat scroll 0 0 #333333; "></div>

</body>
</html>