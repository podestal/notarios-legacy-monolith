	
    <?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
	
	$id_contratante = $_REQUEST['id'];
	
	$arr_contratante = dame_contratante($id_contratante);
	$arr_estciviles = dame_estciviles();
	$arr_documentos = dame_documentos();
	$arr_paises = dame_paises();
	$arr_nacionalidades = dame_nacionalidades();
	$arr_ocupaciones = dame_ocupaciones();
	$arr_cargos = dame_cargos();
	
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
    
	<form id="frm_mcontratante1" name="frm_mcontratante1">
    <table> 
    		<tr>
            	<td width="617"><span class="lbl_contratantes2">Editar Contratante</span></td>
                <td width="32"><img src="../iconos/cerrar.png" onClick="cerrar_modicontratante2()" title="Cerrar"></td>
            </tr>
            <tr>
            	<td valign="top" colspan="2" align="center">
   					<div style="height:225px; width:650px; overflow:auto">
                    	<table cellpadding="0" cellspacing="0" width="630" align="center"> 
                        		<tr height="30">
                                    <td width="105"><span class="lbl_contratantes">Apellido Paterno :</span></td>
                                    <td width="207"><input id="m_apepat" name="m_apepat" value="<?php echo $arr_contratante[9]; ?>" type="text" class="txt_contratantes" maxlength="20" style="text-transform:uppercase" tabindex="1"></td>
                                    <td width="136"><span class="lbl_contratantes">Apellido Materno :</span></td>
                                    <td width="180"><input id="m_apemat" name="m_apemat" value="<?php echo $arr_contratante[10]; ?>" type="text" class="txt_contratantes" maxlength="20" style="text-transform:uppercase" tabindex="2"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">1er Nombre :</span></td>
                                    <td><input id="m_prinom" name="m_prinom" value="<?php echo $arr_contratante[7]; ?>" type="text" class="txt_contratantes" maxlength="20" style="text-transform:uppercase" tabindex="3"></td>
                                    <td><span class="lbl_contratantes">2do Nombre :</span></td>
                                    <td><input id="m_segnom" name="m_segnom" value="<?php echo $arr_contratante[8]; ?>" type="text" class="txt_contratantes" maxlength="20" style="text-transform:uppercase" tabindex="4"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Direccion :</span></td>
                                    <td colspan="3"><input id="m_dir" name="m_dir" value="<?php echo $arr_contratante[11]; ?>" type="text" class="txt_contratantes" style="width:465px; text-transform:uppercase" maxlength="150" tabindex="5"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Ubigeo :</span></td>
                                    <td colspan="2" >
                                    	<?php 
										$arr_ubigeo = dame_ubigeo($arr_contratante[27]);
										?>
                                    	<input id="m_ubigeo" name="m_ubigeo" value="<?php echo $arr_ubigeo[4]; ?>" type="text" class="txt_contratantes" onkeypress="return false;" onclick="buscar_ubigeos()" style="width:300px" readonly="readonly">
                                        <input id="m_idubigeo" name="m_idubigeo" value="<?php echo $arr_contratante[27]; ?>" type="hidden">
                                    </td>
                                    <td><img src="../iconos/seleccionar.png" onclick="buscar_ubigeos()" tabindex="6"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Estado Civil :</span></td>
                                    <td>
                                    	<select id="m_civil" name="m_civil" class="slc_cobros" tabindex="7">
                                        	<option value="0">--Estado Civil--</option>
                                        	<?php for($i=0; $i<count($arr_estciviles); $i++){?>
                                            <option  
                                            <?php 
											if($arr_contratante[19]==$arr_estciviles[$i][0]){
												echo "selected='selected'";
											}
											?>
                                            value="<?php echo $arr_estciviles[$i][0]; ?>"><?php echo $arr_estciviles[$i][2]; ?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Casado(a) con :</span></td>
                                    <td><img src="../iconos/grabarconyuge2.png" onclick="nuevo_conyugue()" tabindex="8"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Sexo :</span></td>
                                    <td>
                                    	<select id="m_sexo" name="m_sexo" class="slc_cobros" tabindex="8">
                                        	<option value="0">--Seleccione Género--</option>
                                        	<option 
                                            <?php 
											if($arr_contratante[18]=="M"){
												echo "selected='selected'";
											}
											?>
                                            value="M">Masculino</option>
                                            <option 
                                            <?php 
											if($arr_contratante[18]=="F"){
												echo "selected='selected'";
											}
											?>
                                            value="F">Femenino</option>
                                        </select>
                                    </td>
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
                                    <td>
                                       <input id="m_numdoc" name="m_numdoc"  value="<?php echo $arr_contratante[13]; ?>" type="text" class="txt_contratantes" maxlength="8" tabindex="10"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Nacionalidad :</span></td>
                                    <td>
                                    	 <select id="m_nac" name="m_nac" class="slc_cobros" tabindex="11">
                                             <option value="0">--Nacionalidad--</option>
                                             <?php for($i=0; $i<count($arr_nacionalidades); $i++){?>
                                             <option 
                                             <?php 
                                             if($arr_contratante[22]==$arr_nacionalidades[$i][0]){
                                                echo "selected='selected'";
                                             }
                                             ?>
                                             value="<?php echo $arr_nacionalidades[$i][0]; ?>"><?php echo $arr_nacionalidades[$i][3]; ?></option>
                                        <?php }?>	
                                        </select>
                                    </td>
                                    <td><span class="lbl_contratantes">Residente :</span></td>
                                    <td>
                                    	<input  id="m_res" name="m_res" type="checkbox" tabindex="12"
                                        <?php 
										if($arr_contratante[37]=="1"){
											echo "checked='checked'"; 
										}
										?>
                                        />
                                    </td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Natural de :</span></td>
                                    <td>
                                    	<input id="m_natde" name="m_natde" value="<?php echo $arr_contratante[20]; ?>" type="text" class="txt_contratantes" maxlength="20" style="text-transform:uppercase" tabindex="13"></td>
                                    <td><span class="lbl_contratantes">Fecha de Nac. :</span></td>
                                    <td>
                                    	<input id="m_fecnac" name="m_fecnac" value="<?php echo $arr_contratante[28]; ?>" type="text" class="txt_contratantes" readonly="readonly" tabindex="14"></td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2"><span class="lbl_contratantes">Pais de Emisión del Documento de Identidad : 	</span></td>
                                    <td>
                                    	<select id="m_paisemi" name="m_paisemi"  class="slc_cobros" tabindex="15">
                                            <option value="0">--Pais Doc. --</option>
                                            <?php for($i=0; $i<count($arr_paises); $i++){?>
                                            <option 
                                             <?php 
                                             if($arr_contratante[38]==$arr_paises[$i][0]){
                                                echo "selected='selected'";
                                             }
                                             ?> 
                                             value="<?php echo $arr_paises[$i][0]; ?>"><?php echo $arr_paises[$i][2]; ?></option>
                                            <?php }?>
                                        </select>
                                        </td>
                                        <td></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Prof./Ocupación :</span></td>
                                    <td>
                                    	<?php
										for($i=0; $i<count($arr_ocupaciones); $i++){
											if($arr_ocupaciones[$i][0]==$arr_contratante[26]){
												$ocupacion = $arr_ocupaciones[$i][2];
											}
											
										}
										?>
                                    	<input id="m_ocupacion" name="m_ocupacion" value="<?php echo $ocupacion; ?>" type="text" class="txt_contratantes" onkeypress="return false;" onclick="buscar_ocupaciones()" style="width:165px" readonly="readonly">
                                        <input id="m_idocupacion" name="m_idocupacion" value="<?php echo $arr_contratante[26]; ?>" type="hidden">
                                    </td>
                                    <td  colspan="2"><img src="../iconos/seleccionar.png" onclick="buscar_ocupaciones()" tabindex="16"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Cargo :</span></td>
                                    <td>
                                    	<?php
										for($i=0; $i<count($arr_cargos); $i++){
											if($arr_cargos[$i][0]==$arr_contratante[25]){
												$cargo = $arr_cargos[$i][2];
											}
											
										}
										?>
                                        <input id="m_cargo" name="m_cargo" value="<?php echo $cargo; ?>" type="text" class="txt_contratantes" onkeypress="return false;" onclick="buscar_cargos()" style="width:165px" readonly="readonly">
                                        <input id="m_idcargo" name="m_idcargo" value="<?php echo $arr_contratante[25]; ?>" type="hidden">					
                                    </td>
                                    <td><img src="../iconos/seleccionar.png" onclick="buscar_cargos()" tabindex="17"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Telefono Cel. : </span></td>
                                    <td>
                                    	<input id="m_telcel" name="m_telcel"  value="<?php echo $arr_contratante[16]; ?>" type="text" class="txt_contratantes" maxlength="9" onkeypress="return isNumberKey(event)" tabindex="18">
                                    </td>
                                    <td><span class="lbl_contratantes">Telefono Oficina :</span></td>
                                    <td><input id="telofi" name="telofi" value="<?php echo $arr_contratante[17]; ?>" type="text" class="txt_contratantes" maxlength="7" onkeypress="return isNumberKey(event)" tabindex="19"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Telefono Fijo :</span></td>
                                    <td><input id="m_telfijo" name="m_telfijo" value="<?php echo $arr_contratante[15]; ?>" type="text" class="txt_contratantes" maxlength="7" onkeypress="return isNumberKey(event)" tabindex="20"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Email :</span></td>
                                    <td colspan="3"><input id="m_email" name="m_email" value="<?php echo $arr_contratante[14]; ?>" type="text" class="txt_contratantes" style="width:465px" maxlength="100" tabindex="21"></td>
                                </tr>
                                <tr height="55">
                                	<td></td>
                                    <td colspan="3">
                                        <img src="../iconos/grabar.png" onClick="mod_contratante('<?php echo $arr_contratante[0]; ?>',1)" tabindex="22"><input type="hidden" id="idcliente" name="idcliente" value="<?php echo $arr_contratante[40];?>"/><input type="hidden" id="m_tipper" name="m_tipper" value="N"/>
                                    </td>
                                </tr>
                        </table>
                    </div>
                </td>
            </tr>
    </table>
    </form>
    
     		 	
  	 		 	
  	 	
  	 	
	
  	 		
  	 	
  	 			
  	 		 	
  	 		 	
  	
  	 	
	
  	 	
	
  			 	
  	 		  	 
  	 	
  	  		  