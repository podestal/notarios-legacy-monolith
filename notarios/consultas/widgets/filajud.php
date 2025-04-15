	<?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");

	$arr_documentos = dame_documentos();
	
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
    
    </style>
   
   <form id="frm_juridica" name="frm_juridica"/>    
   <table width="600"  border="0" align="center" style="border: 1px solid #CFCFCF;" >
   <tr height="35">
        <td width="107"><span class="lbl_contratantes">Razón Social:</span></td>
        <td colspan="3">
        	<input id="n_razon" name="n_razon" type="text" class="txt_cobros" style="width:345px; height:14px; text-transform:uppercase" maxlength="80" tabindex="1"/>
            <input id="n_tipper" name="n_tipper" type="hidden" value="J" tabindex="2">
            <span style="margin-left:5px" class="alerts">(*)</span></td>
    </tr>
    <tr height="35">
        <td><span class="lbl_contratantes">Dirección:</span></td>
        <td colspan="3"><input id="n_domfiscal" name="n_domfiscal" type="text" class="txt_cobros" style="width:345px; height:14px; text-transform:uppercase" maxlength="80" tabindex="3"/></td>
    </tr>
    <tr height="35">
        <td><span class="lbl_contratantes">Email:</span></td>
        <td colspan="3"><input id="n_mailemp" name="n_mailemp" type="text" class="txt_cobros" style="width:345px; height:14px" maxlength="50" tabindex="4"/></td>
    </tr>
   <tr height="35">
        <td width="107"><span class="lbl_contratantes">Telf. de oficina:</span></td>
 		<td width="188"><input id="n_telemp" name="n_telefi" type="text" class="txt_cobros" style="width:100px; height:14px" maxlength="7" onkeypress="return isNumberKey(event);" tabindex="5"/></td>
        <td width="144"><span class="lbl_contratantes">Celular:</span></td>
        <td width="141"><input id="n_telcel" name="n_telcel" type="text" class="txt_cobros" style="width:100px; height:14px" maxlength="9" onkeypress="return isNumberKey(event);" tabindex="6"/></td>
    </tr>  
    <tr>
    	<td width="107"><span class="lbl_contratantes">Tipo de Doc.:</span></td>
    	<td>
            <select id="n_tipdoc" name="n_tipdoc" class="slc_cobros" style="width:160px" tabindex="7">
                <option value="0">--Tipo de Documento--</option>
                <?php for($i=0; $i<count($arr_documentos); $i++){?>
                <option value="<?php echo $arr_documentos[$i][0]; ?>"><?php echo $arr_documentos[$i][2]; ?></option>
                <?php }?>
            </select><span style=" margin-left:5px" class="alerts">(*)</span>
        </td>
        <td width="144"><span class="lbl_contratantes">Nº de Documento:</span></td>
        <td><input id="n_numdoc" name="n_numdoc" type="text" class="slc_cobros" style="width:100px" maxlength="20" tabindex="8"><span style=" margin-left:5px" class="alerts">(*)</span></td>
    </tr>
	<tr height="35">
        <td><span class="lbl_contratantes">Fec. Constitución:</span></td>
        <td><input id="n_feccons" name="n_feccons" type="text" style="width:100px; height:14px" maxlength="20" readonly="readonly" tabindex="9"/></td>
        <td></td>
		<td></td>
    </tr>
    <tr height="35">
        <td><span class="lbl_contratantes">Ubigeo:</span></td>
        <td colspan="2"><input id="n_ubigeo" name="n_ubigeo" type="text" class="camposss" style="width:300px; height:14px; text-transform:uppercase;"  maxlength="20" onclick="buscar_ubigeos()" readonly="readonly"/>
        <input id="n_idubigeo" name="n_idubigeo" type="hidden"/></td>
        <td><img src="../iconos/seleccionar.png" onclick="buscar_ubigeos()" tabindex="10"></td>
    </tr>
    <tr height="35">
    	<td align="left"><img src="../iconos/grabar.png" onclick="grabar_cliente(2)" tabindex="11"/></td>
    	<td colspan="3" align="right"><span class="alerts" style="margin-right:46px">(*)Campos Obligatorios</span>	
        </div></td>
    </tr>

    </table>
    </form>