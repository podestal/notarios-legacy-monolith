
	<?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
	
	$id_contratante = $_REQUEST['id'];
	
	$arr_contratante = dame_contratante($id_contratante);
	
	$arr_documentos = dame_documentos();
	
	$arr_sedes = dame_seccionesregistrales();
	
	$arr_ciiu = dame_ciiu();
	
	?>

	<style>
		.lbl_cobros{
			font-size:12px;
		}
		.lbl_actos{
			font-size:12px;
			color:#FFF;
			font-family:Calibri;
			font-style:italic;
		}
		.lbl_contratantes{
			color: #333333;
			font-family: Calibri;
			font-size: 14px;
			font-style: italic;
		}
		.lbl_contratantes2{
			font-family: Calibri;
			font-size: 14px;
			font-style: italic;
			font-weight: bold;
		}
		.txt_cobros{
			font-size:12px;
			width:80px;
		}
		
		.txt_contratantes{
			font-size:12px;
			width:120px;
		}
		
		.slc_cobros{
			font-size:12px;
			width:130px;
		}
	</style>
    
	<form id="frm_mcontratante2" name="frm_mcontratante2">
    <table>
    		<tr>
            	<td width="617"><span class="lbl_contratantes2">Editar Contratante</span></td>
                <td width="32"><img src="../iconos/cerrar.png" onClick="cerrar_modicontratante2()" title="Cerrar"></td>
            </tr>
            <tr>
            	<td valign="top" colspan="2">
                	<div style="height:225px; width:650px; overflow:auto">
                    	<table cellpadding="0" cellspacing="0" width="630" align="center"> 
                        		<tr height="30">
                                	<td><span class="lbl_contratantes">Razón Social :</span></td>
                                    <td colspan="3"><input id="m_razon" name="m_razon" value="<?php echo $arr_contratante[5]; ?>" type="text" class="txt_contratantes" style="width:431px; text-transform:uppercase" maxlength="150" tabindex="1"></td>
                                </tr>
                                <tr height="30">
                                	<td><span class="lbl_contratantes">Domicilio Fiscal :</span></td>
                                    <td colspan="3"><input id="m_domfiscal" name="m_domfiscal" value="<?php echo $arr_contratante[29]; ?>" type="text" class="txt_contratantes" style="width:431px; text-transform:uppercase" maxlength="150" tabindex="2"></td>
                                </tr>
                                <tr>
                                	<td height="26"><span class="lbl_contratantes">Tipo de Documento</span></td>
                                	<td>
                                    	<select id="m_tipdoc" name="m_tipdoc" class="slc_cobros" tabindex="9">
                                            <option value="0">--Tipo Documento--</option>
                                            <?php for($i=0; $i<count($arr_documentos); $i++){?>
                                            <option 
                                            <?php 
                                            if($arr_contratante[12]==$arr_documentos[$i][0]){
                                                echo "selected='selected'";
                                            }
                                            ?>
                                            value="<?php echo $arr_documentos[$i][0]; ?>"><?php echo $arr_documentos[$i][2]; ?></option>
                                            <?php }?>
                                      </select>
                                  </td>
                                    <td><span class="lbl_contratantes">Nº de Documento</span></td>
                                    <td>
                                       <input id="m_numdoc" name="m_numdoc"  value="<?php echo $arr_contratante[13]; ?>" type="text" class="txt_contratantes" maxlength="8" tabindex="10"></td>
                          </tr>
                  <tr height="30">
                                	<td><span class="lbl_contratantes">Ubigeo :</span></td>
                                    <td colspan="2">
                                    	<?php 
										$arr_ubigeo = dame_ubigeo($arr_contratante[27]);
										?>
                                        <input id="m_ubigeo" name="m_ubigeo"  value="<?php echo $arr_ubigeo[4]; ?>" type="text" class="txt_contratantes" readonly="readonly" onclick="buscar_ubigeos()" style="width:240px">
                                        <input id="m_idubigeo" name="m_idubigeo" value="<?php echo $arr_contratante[27]; ?>" type="hidden"></td>
                                    <td><img src="../iconos/seleccionar.png" tabindex="3" onclick="buscar_ubigeos()"></td>

                    </tr>
                                <tr height="30">
                                	<td><span class="lbl_contratantes">Objeto Social :</span></td>
                                    <td><input id="m_contacto" name="m_contacto" value="<?php echo $arr_contratante[32]; ?>" type="text" class="txt_contratantes" maxlength="20" style="text-transform:uppercase" tabindex="4"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr height="30">
                                	<td><span class="lbl_contratantes">Fecha de Constitución :</span></td>
                                    <td><input id="m_feccons" name="m_feccons" value="<?php echo $arr_contratante[33]; ?>" type="text" class="txt_contratantes" readonly="readonly" tabindex="5"></td>
                                    <td><span class="lbl_contratantes">Nº de Registro :</span></td>
                                    <td><input id="m_numreg" name="m_numreg" value="<?php echo $arr_contratante[35]; ?>" type="text" class="txt_contratantes" maxlength="20" onkeypress="return isNumberKey(event)" tabindex="6"></td>
                                </tr>
                                <tr height="30">
                                	<td><span class="lbl_contratantes">Sede Registral :</span></td>
                                    <td>
                                    	<select id="m_sede" name="m_sede" class="slc_cobros" tabindex="7">
                                        <option value="0">--Sede Registral--</option>
                                        <?php for($i=0; $i<count($arr_sedes); $i++){?>
                                        <option 
                                        <?php 
										if($arr_contratante[34]==$arr_sedes[$i][0]){
											echo "selected='selected'";
										}
										?>
                                        value="<?php echo $arr_sedes[$i][0]; ?>"><?php echo $arr_sedes[$i][1]; ?></option>
                                        <?php }?>
                                        </select>
                                    </td>
                                    <td><span class="lbl_contratantes">Nº de Partida :</span></td>
                                    <td><input id="m_partida" name="m_partida" value="<?php echo $arr_contratante[36]; ?>" type="text" class="txt_contratantes" maxlength="20" onkeypress="return isNumberKey(event)" tabindex="8"></td>
                                </tr>
                                <tr height="30">
                                	<td><span class="lbl_contratantes">Teléfono :</span></td>
                                    <td><input id="m_telfemp" name="m_telfemp" value="<?php echo $arr_contratante[30]; ?>" type="text" class="txt_contratantes" maxlength="7" onkeypress="return isNumberKey(event)" tabindex="9"></td>
                                    <td><span class="lbl_contratantes">CIU :</span></td>
                                    <td>
                                        <select id="m_ciu" name="m_ciu" class="slc_cobros" tabindex="10">
										<option value="0">--Elija opción--</option>
                                        <?php for($i=0; $i<count($arr_ciiu); $i++){?>
                                        <option 
                                        <?php 
										/*
										if($arr_contratante[34]==$arr_ciiu[$i][0]){
											echo "selected='selected'";
										}*/
										?>
                                        value="<?php echo $arr_ciiu[$i][0]; ?>"><?php echo $arr_ciiu[$i][1]; ?></option>
                                        <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr height="30">
                                	<td><span class="lbl_contratantes">Correo de la empresa :</span></td>
                                    <td colspan="3"><input id="m_mailemp" name="m_mailemp" value="<?php echo $arr_contratante[31]; ?>" type="text" class="txt_contratantes" style="width:431px" maxlength="100" tabindex="11"></td>
                                </tr>
                        		<tr height="55">
                                	<td></td>
                                    <td colspan="3">
                                        <img src="../iconos/grabar.png" onClick="mod_contratante('<?php echo $arr_contratante[0]; ?>',2)" tabindex="12"><input type="hidden" id="idcliente" name="idcliente" value="<?php echo $arr_contratante[40];?>"/><input type="hidden" id="m_tipper" name="m_tipper" value="J"/>
                                    </td>
                                </tr>
                        </table>
                    </div>
                </td>
            </tr>
    </table>
    </form>
    
     		 	
  	 		 	
  	 	
  	 	
	
  	 		
  	 	
  	 			
  	 		 	
  	 		 	
  	
  	 	
	
  	 	
	
  			 	
  	 		  	 
  	 	
  	  		  