
        <?php 
	
		include("../../extraprotocolares/view/funciones.php");
		
		include("../../consultas/kardex.php");
		
		$cod = $_REQUEST['cod'];
		
		$arr_dmov = detalle_mov($cod);
		
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
        <form id="frm_mmovimiento" name="frm_mmovimiento">
        <table width="700" height="257" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
            	<tr>
                	<td height="31" colspan="4"><span class="lbl_cobros" style="font-family:Calibri; font-weight:bold">Editar Movimientos RR. PP</span></td>
                </tr>
                <tr>
                	<td width="129"><span class="lbl_contratantes" style="margin-left:10px">Fecha</span></td>
                    <td width="205"><input value="<?php echo $arr_dmov[0]; ?>" id="mov_mfecha" name="mov_mfecha" class="txt_cobros" type="text"/></td>
                    <td width="103"><span class="lbl_contratantes">Vencimiento</span></td>
                    <td width="234"><input value="<?php echo $arr_dmov[8]; ?>" id="mov_mvenc" name="mov_mvenc" class="txt_cobros" type="text"/></td>
                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Oficina Registral</span></td>
                    <td>
                    	<select id="mov_mofreg" name="mov_mofreg" class="slc_cobros">
                        	<option value="0">--Oficina Registral--</option>
                            <?php for($i=0; $i<count($arr_sedes); $i++) {?>
                            <option
                            <?php 
							if($arr_dmov[12] == $arr_sedes[$i][0]){
								echo "selected='selected'";
							}
							?>
                            value="<?php echo $arr_sedes[$i][0];?>"><?php echo $arr_sedes[$i][1];?></option>
                            <?php }?>
                        </select>
                    </td>
                    <td><span class="lbl_contratantes">Tramite</span></td>
                    <td>
                    	<select id="mov_mtramite" name="mov_mtramite" class="slc_cobros">
							<option value="0">--Trámite--</option>
                            <?php for($i=0; $i<count($arr_tramos); $i++) {?>
                            <option 
                            <?php 
							if($arr_dmov[14] == $arr_tramos[$i][0]){
								echo "selected='selected'";
							}
							?>
                            value="<?php echo $arr_tramos[$i][0];?>"><?php echo $arr_tramos[$i][1];?></option>
                            <?php }?>
                        </select>
                     </td>
                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Sección Registro</span></td>
                    <td>
                    	<select id="mov_msecreg" name="mov_msecreg" class="slc_cobros">
                        	<option value="0">--Sección Registro--</option>
                            <?php for($i=0; $i<count($arr_secciones); $i++) {?>
                            <option
                            <?php 
							if($arr_dmov[13] == $arr_secciones[$i][0]){
								echo "selected='selected'";
							}
							?>
                            value="<?php echo $arr_secciones[$i][0];?>"><?php echo $arr_secciones[$i][1]; ?></option>
                            <?php }?>
                        </select>
                     </td>
                    <td><span class="lbl_contratantes">Importe</span></td>
                    <td><input value="<?php echo $arr_dmov[4]; ?>" id="mov_mimporte" name="mov_mimporte" class="txt_cobros" type="text" onKeyPress="return numerosdecimales(event);" onChange="currency(this.id)" maxlength="9"/></td>
                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Titulo en RR.PP</span></td>
                    <td><input value="<?php echo $arr_dmov[2]; ?>" id="mov_mtitulo" name="mov_mtitulo" class="txt_cobros" type="text" maxlength="25"  onkeypress="return isNumberKey(event);"/></td>
                    <td><span class="lbl_contratantes">Observación</span></td>
                    <td rowspan="3" valign="top" >
                    	<textarea id="mov_mobs" name="mov_mobs" style="width:190px; height:50px; " class="txt_cobros" maxlenght="100"><?php echo $arr_dmov[9]; ?></textarea>
                    </td>
                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Estado</span></td>
                    <td>
                    	<select id="mov_mestado" name="mov_mestado" class="slc_cobros">
                        	<option value="0">--Estado--</option>
                            <?php for($i=0; $i<count($arr_estados); $i++) {?>
                            <option 
                            <?php 
							if($arr_dmov[15] == $arr_estados[$i][0]){
								echo "selected='selected'";
							}
							?>
                            value="<?php echo $arr_estados[$i][0];?>"><?php echo $arr_estados[$i][1];?></option>
                            <?php }?>
                        </select>
                    </td>
                    <td></td>
				</tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Encargado</span></td>
                    <td><input value="<?php echo $arr_dmov[10]; ?>" id="mov_mencargado" name="mov_mencargado" class="txt_cobros" type="text" maxlength="50"/></td>
                    <td></td>
                </tr>
                <tr>
                	<td><span class="lbl_contratantes" style="margin-left:10px">Anotación</span></td>
                    <td><input value="<?php echo $arr_dmov[11]; ?>" id="mov_manotacion" name="mov_manotacion" class="txt_cobros" type="text" maxlength="50"/></td>
                    <td><img src="iconos/grabar.png" onClick="mod_movimiento('<?php echo $arr_dmov[16]; ?>')" width="92" height="27" style="margin-left:10px" /></td>
                    <td><input id="mov_mkardex" name="mov_mkardex" type="hidden" value=""/></td>
                </tr>
                <tr>
               	  <td height="30" colspan="4"><span></span></td>
                </tr>
            </table>
            </form>
			
            <div style="position:absolute; left:669px; top:12px; cursor:pointer" onClick="cerrar_movimiento2()"><img src="images/delete.png" width="12" height="12"/></div>