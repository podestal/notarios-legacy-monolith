	<?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
	
	$arr_estciviles = dame_estciviles();
	$arr_documentos = dame_documentos();
	$arr_paises = dame_paises();
	$arr_nacionalidades = dame_nacionalidades();
	$arr_ocupaciones = dame_ocupaciones();
	$arr_cargos = dame_cargos();
	
	?>
	
	 <style>
    .lbl_cobros{
        font-size:13px;
        margin-left:5px
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
	
	.alerts{
		color:red; 
		font-size:10px; 
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
    
    </style>

    <form id="frm_natural" name="frm_natural"/>    
    <table width="600" border="0" align="center" style="border: 1px solid #CFCFCF;" >        
    <tr height="30">
        <td><span class="lbl_contratantes">Apellido Paterno:</span></td>
        <td>
        	<input id="n_apepat" name="n_apepat" type="text" class="txt_cobros" style="width:100px; height:16px; text-transform:uppercase" maxlength="20" onkeypress="return soloLetras(event)" tabindex="1"/>
            <input id="n_tipper" name="n_tipper" type="hidden" value="N" tabindex="1">
            <span style=" margin-left:5px" class="alerts">(*)</span>
        </td>
        <td><span class="lbl_contratantes" style="margin-left:10px">Apellido Materno:</span></td>
        <td><input id="n_apemat" name="n_apemat" type="text" class="txt_cobros" style="width:100px; height:16px; text-transform:uppercase" maxlength="20" onkeypress="return soloLetras(event)" tabindex="2"/></td>
    </tr>
    <tr height="30">
        <td width="109"><span class="lbl_contratantes">Primer Nombre:</span></td>
        <td width="172"><input id="n_prinom" name="n_prinom" type="text" class="txt_cobros" style="width:100px; height:16px; text-transform:uppercase" maxlength="20" onkeypress="return soloLetras(event)" tabindex="3"/><span style="margin-left:5px" class="alerts">(*)</span></td>
        <td width="151"><span class="lbl_contratantes" style="margin-left:10px">Segundo Nombre:</span></td>
        <td width="148"><input id="n_segnom" name="n_segnom" type="text" class="txt_cobros" style="width:100px; height:16px; text-transform:uppercase" maxlength="20" onkeypress="return soloLetras(event)" tabindex="4"/></td>
    </tr>
   <tr height="30">
        <td><span class="lbl_contratantes">Dirección:</span></td>
        <td colspan="3"><input id="n_dir" name="n_dir" type="text" class="txt_cobros" style="width:360px; height:16px; text-transform:uppercase" maxlength="80" tabindex="5"/></td>
    </tr>
    <tr height="30">
        <td><span class="lbl_contratantes">Ubigeos:</span></td>
        <td colspan="2"><input id="n_ubigeo" name="n_ubigeo" type="text" class="txt_cobros" style="width:300px; height:16px; text-transform:uppercase" maxlength="20" readonly="readonly"/><span style="margin-left:5px" class="alerts">(*)</span><input id="n_idubigeo" name="n_idubigeo" type="hidden"/>
        </td>
        <td>
        <img src="../iconos/seleccionar.png" onclick="buscar_ubigeos()" tabindex="6">
        </td>
    </tr>
    
   <tr height="30">
        <td><span class="lbl_contratantes">Estado Civil :</span></td>
        <td>
            <select id="n_civil" name="n_civil" class="slc_cobros" tabindex="7">
                <option value="0"></option>
                <?php for($i=0; $i<count($arr_estciviles); $i++){?>
                <option  
                value="<?php echo $arr_estciviles[$i][0]; ?>"><?php echo $arr_estciviles[$i][2]; ?></option>
                <?php }?>
            </select>
        </td>
        <td></td>
        <td></td>
    </tr>
    <!--<tr height="30">
        <td><span class="lbl_contratantes">Casado(a) con :</span></td>
        <td><img src="../iconos/grabarconyuge2.png" onclick="nuevo_conyugue()"></td>
        <td></td>
        <td></td>
    </tr>-->
    <tr height="30">
        <td><span class="lbl_contratantes">Sexo :</span></td>
        <td>
            <select id="n_sexo" name="n_sexo" class="slc_cobros" tabindex="8">
                <option value="0">--Género--</option>
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </td>
        <td>
            <select id="n_tipdoc" name="n_tipdoc" class="slc_cobros" tabindex="9">
                <option value="0">--Tipo de Documento--</option>
                <?php for($i=0; $i<count($arr_documentos); $i++){?>
                <option value="<?php echo $arr_documentos[$i][0]; ?>"><?php echo $arr_documentos[$i][2]; ?></option>
                <?php }?>
            </select><span style=" margin-left:5px" class="alerts">(*)</span>
        </td>
        <td><input id="n_numdoc" name="n_numdoc" type="text" class="slc_cobros" style="width:100px" maxlength="20" tabindex="9"><span style=" margin-left:5px" class="alerts">(*)</span></td>
    </tr>
    <tr height="30">
        <td><span class="lbl_contratantes">Nacionalidad:</span></td>
        <td>
        <select id="n_nac" name="n_nac" class="slc_cobros" style="width:105px" tabindex="10">
        	<option value="">--Nacionalidad--</option>
        	<option value="0"></option>
            <?php for($i=0; $i<count($arr_nacionalidades); $i++){?>
            <option 
             value="<?php echo $arr_nacionalidades[$i][0]; ?>"><?php echo $arr_nacionalidades[$i][3]; ?></option>
            <?php }?>  
        </select>
        </td>
        <td><span class="lbl_contratantes" style="margin-left:10px">Residente:</span></td>
        <td>
        	<input id="n_residente" name="n_residente" type="checkbox" tabindex="11"/>
        </td>
    </tr>
    <tr height="30">
	    <td><span class="lbl_contratantes">Natural de:</span></td>
        <td><input id="n_natde" name="n_natde" type="text" class="txt_cobros" style="width:100px; height:16px" maxlength="20" onkeypress="return soloLetras(event)" tabindex="12"/></td>
        <td><span class="lbl_contratantes" style="margin-left:10px">Fecha de Nac.</span></td>
        <td>
        <input id="n_fecnac" name="n_fecnac" type="text" class="txt_cobros" style="width:100px; height:16px" maxlength="20" readonly="readonly" tabindex="13"/>
        </td>
    </tr>
    
    <tr height="30">
        <td colspan="2"><span class="lbl_contratantes">Pais de Emisión del Documento de Identidad : 	</span></td>
        <td>
            <select id="n_paisemi" name="n_paisemi" class="slc_cobros" tabindex="14">
                <option value="0">--País--</option>
                <?php for($i=0; $i<count($arr_paises); $i++){?>
                <option 
                 value="<?php echo $arr_paises[$i][0]; ?>"><?php echo $arr_paises[$i][2]; ?></option>
                <?php }?>
            </select>
            </td>
            <td></td>
    </tr>
    <tr height="30">
        <td><span class="lbl_contratantes">Prof./Ocupación :</span></td>
        <td>
            <input id="n_ocupacion" name="n_ocupacion" type="text" class="txt_contratantes" onkeypress="return false;" onclick="buscar_ocupaciones()" style="width:165px">
            <input id="n_idocupacion" name="n_idocupacion" type="hidden" value="0">
        </td>
        <td  colspan="2"><img src="../iconos/seleccionar.png" onclick="buscar_ocupaciones()" tabindex="15"></td>
    </tr>
    <tr height="30">
        <td><span class="lbl_contratantes">Cargo :</span></td>
        <td>
            <input id="n_cargo" name="n_cargo" type="text" class="txt_contratantes" onkeypress="return false;" onclick="buscar_cargos()" style="width:165px" >
            <input id="n_idcargo" name="n_idcargo" type="hidden" value="0">					
        </td>
        <td><img src="../iconos/seleccionar.png" onclick="buscar_cargos()" tabindex="16"></td>
    </tr>
    <tr height="30">
        <td><span class="lbl_contratantes">Telefono Cel. : </span></td>
        <td><input id="n_telcel" name="n_telcel" type="text" class="txt_contratantes" onkeypress="return isNumberKey(event);" tabindex="17"></td>
        <td><span class="lbl_contratantes">Telefono Oficina :</span></td>
        <td><input id="n_telofi" name="n_telofi" type="text" class="txt_contratantes" onkeypress="return isNumberKey(event);" tabindex="18"></td>
    </tr>
    <tr height="30">
        <td><span class="lbl_contratantes">Telefono Fijo :</span></td>
        <td><input id="n_telfijo" name="n_telfijo" type="text" class="txt_contratantes" onkeypress="return isNumberKey(event);" tabindex="19"></td>
        <td></td>
        <td></td>
    </tr>
    <tr height="30">
        <td><span class="lbl_contratantes">Email:</span></td>
        <td colspan="3"><input id="n_email" name="n_email" type="text" class="txt_cobros" style="width:360px; height:16px" maxlength="50" tabindex="20"/></td>
    </tr>
    <tr height="35">
    	<td align="left"><img src="../iconos/grabar.png" onclick="grabar_cliente(1)" tabindex="21"/></td>
    	<td colspan="3" align="right"><span style="margin-right:46px" class="alerts">(*)Campos Obligatorios</span>	
        </div></td>
    </tr>
    </table>
    </form>