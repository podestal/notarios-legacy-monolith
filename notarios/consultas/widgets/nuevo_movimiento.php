
        <?php 
	
		include("../../extraprotocolares/view/funciones.php");
		
		include("../../consultas/kardex.php");
		
		$arr_sedes = dame_sedesregistrales();
		$arr_secciones = dame_seccionesregistrales();
		$arr_tramos = dame_tramos();
		$arr_estados = dame_estregistrales();
		
		?>
        
        <style>
		.lbl_cobros{
			font-size:13px;
			margin-left:5px
		}
		.lbl_contratantes{
			color: #333333;
			font-family: Calibri;
			font-size: 14px;
			font-style: italic;
		}
		.txt_cobros{
			font-size:12px;
			width:100px;
			text-transform:uppercase;
		}
		
		.slc_cobros{
			font-size:12px;
			width:130px;
		}
		
		</style>
        
        
        <body>
        <form id="frm_movimiento" name="frm_movimiento">
        <table width="700" height="257" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
            	<tr>
                	<td height="31" colspan="4"><span  class="lbl_cobros" style="font-family:Calibri; font-weight:bold; margin-left:10px">Ingreso de Movimientos RR. PP</span></td>
                </tr>
                <tr>
                	<td width="129"><span class="lbl_contratantes" style="margin-left:10px">Fecha</span></td>
                    <td width="205"><input id="mov_fecha" name="mov_fecha" class="txt_cobros" type="text" tabindex="1" readonly/></td>
                    <td width="103"><span class="lbl_contratantes">Vencimiento</span></td>
                    <td width="234"><input id="mov_venc" name="mov_venc" class="txt_cobros" type="text" tabindex="2" readonly/></td>
                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Oficina Registral</span></td>
                    <td>
                    	<select id="mov_ofreg" name="mov_ofreg" class="slc_cobros" tabindex="3">
                        	<option value="0">--Oficina Registral--</option>
                            <?php for($i=0; $i<count($arr_sedes); $i++) {?>
                            <option value="<?php echo $arr_sedes[$i][0];?>"><?php echo $arr_sedes[$i][1];?></option>
                            <?php }?>
                        </select>
                    </td>
                    <td><span class="lbl_contratantes">Tramite</span></td>
                    <td>
                    	<select id="mov_tramite" name="mov_tramite" class="slc_cobros" tabindex="4">
                        	<option value="0">--Trámite--</option>
                            <?php for($i=0; $i<count($arr_tramos); $i++) {?>
                            <option value="<?php echo $arr_tramos[$i][0];?>"><?php echo $arr_tramos[$i][1];?></option>
                            <?php }?>
                        </select>
                     </td>
                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Sección Registro</span></td>
                    <td>
                    	<select id="mov_secreg" name="mov_secreg" class="slc_cobros" tabindex="5">
                        	<option value="0">--Sección Registro--</option>
                            <?php for($i=0; $i<count($arr_secciones); $i++) {?>
                            <option value="<?php echo $arr_secciones[$i][0];?>"><?php echo $arr_secciones[$i][1];?></option>
                            <?php }?>
                        </select>
                     </td>
                    <td><span class="lbl_contratantes">Importe</span></td>
                    <td><input id="mov_importe" name="mov_importe" class="txt_cobros" type="text" onKeyPress="return numerosdecimales(event);" onChange="currency(this.id)" maxlength="9" tabindex="6"/></td>
                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Titulo en RR.PP</span></td>
                    <td><input id="mov_titulo" name="mov_titulo" class="txt_cobros" type="text" maxlength="20" onKeyPress="return isNumberKey(event)" tabindex="7"/></td>
                    <td><span class="lbl_contratantes">Observación</span></td>
                    <td rowspan="3" valign="top" >
                    	<textarea id="mov_obs" name="mov_obs" style="width:190px; height:50px; " class="txt_cobros" maxlenght="100" tabindex="8"></textarea>
                    </td>
                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Estado</span></td>
                    <td>
                    	<select id="mov_estado" name="mov_estado" class="slc_cobros">
                        	<option value="0">--Estado--</option>
                            <?php for($i=0; $i<count($arr_estados); $i++) {?>
                            <option value="<?php echo $arr_estados[$i][0];?>"><?php echo $arr_estados[$i][1];?></option>
                            <?php }?>
                        </select>
                    </td>
                    <td></td>

                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Encargado</span></td>
                    <td><input id="mov_encargado" name="mov_encargado" class="txt_cobros" type="text" maxlength="50" tabindex="9" style="width:200px"/></td>
                    <td></td>
                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Anotación</span></td>
                    <td><input id="mov_anotacion" name="mov_anotacion" class="txt_cobros" type="text" maxlength="50" tabindex="10" style="width:200px"/></td>
                    <td><img src="iconos/grabar.png" onClick="registrar_movimiento()" width="92" height="27" style="margin-left:10px"  tabindex="10"/></td>
                    <td><input id="mov_kardex" name="mov_kardex" type="hidden" value=""/></td>
                </tr>
                <tr>
               	  <td height="30" colspan="4"><span></span></td>
              </tr>
            </table>
            </form>

            
        <div style="position:absolute; left:669px; top:12px; cursor:pointer; width: 4px;" onClick="cerrar_movimiento()"><img src="images/delete.png" width="12" height="12"/></div>