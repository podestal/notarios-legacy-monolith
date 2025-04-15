<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$id_acto = $_REQUEST['id_acto'];
	
	$sql_tipkar = "select idtipkar, nomtipkar from tipokar";
	
	$exe_tipkar = mysql_query($sql_tipkar, $conexion);
	
	$sql_tipo_acto = "select 
					  tiposdeacto.idtipoacto as cod_acto,
					  tiposdeacto.actosunat as cod_sunat,
					  tiposdeacto.actouif as cod_uif,
					  tiposdeacto.idtipkar as id_tipkar,
					  tiposdeacto.desacto as acto,
					  tiposdeacto.umbral as umbral,
					  tipokar.nomtipkar as des_tipkar,
					  tiposdeacto.impuestos as impuestos,
					  tiposdeacto.idmodelo as idmodelo
					  from tiposdeacto
					  inner join tipokar on tipokar.idtipkar = tiposdeacto.idtipkar
					  where tiposdeacto.idtipoacto= $id_acto";
	
	$res_tipo_acto = mysql_query($sql_tipo_acto, $conexion);
    
    $total_tipo_acto = mysql_num_rows($res_tipo_acto);
    
    while($tipo_acto = mysql_fetch_array($res_tipo_acto)){
		
		$arr_tipo_acto[0] = $tipo_acto["cod_acto"]; 
		$arr_tipo_acto[1] = $tipo_acto["cod_sunat"];         
        $arr_tipo_acto[2] = $tipo_acto["cod_uif"]; 
		$arr_tipo_acto[3] = $tipo_acto["id_tipkar"]; 
        $arr_tipo_acto[4] = $tipo_acto["des_tipkar"]; 
        $arr_tipo_acto[5] = $tipo_acto["acto"]; 
        $arr_tipo_acto[6] = $tipo_acto["umbral"]; 
		$arr_tipo_acto[7] = $tipo_acto["impuestos"]; 
		$arr_tipo_acto[8] = $tipo_acto["idmodelo"]; 
	
    }
	
?>


<form id="frm_macto" name="frm_macto" style="width:100%"/>
    <table width="543" height="231" cellpadding="0" cellspacing="0">
        <tr style="background-color:#264965">
            <td colspan="4" align="center"><span class='submenutitu' style="font-size:14px">Modificar Acto</span></td>
        </tr>
        <tr>
        	<td width="83"><span class='titubuskar0' style="margin-left:8px">Tipo Kardex</span></td>
            <td width="216">
            	<select id="m_tipkar" name="m_tipkar" style="width:197px;" class="Estilo7">
                    <?php

					$i=0;
    
					while($tip_kar = mysql_fetch_array($exe_tipkar)){ ?>
                    
                    <option value="<?php echo $tip_kar["idtipkar"]; ?>"
                    <?php
                    if($arr_tipo_acto[3]==$tip_kar["idtipkar"]){
						echo "selected='selected'";
					}
					?>
                    ><?php echo $tip_kar["nomtipkar"]; ?></option>
                    
					<?php
						$i++; 
					}
					?>
                    
                </select><span style="color:red; margin-left:5px">(*)</span>
            </td>
            <td width="58"><span class='titubuskar0'>Código</span></td>
            <td width="166"><input id="m_cod" name="m_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_acto; ?>" readonly /></td>
        </tr>
        <tr>
            <td><span class='titubuskar0' style="margin-left:8px">Descripción</span></td>
            <td colspan="3"><input id="m_desc" name="m_desc" type="text" class="Estilo7" style="width:374px; text-transform:uppercase" maxlength="150" value="<?php echo $arr_tipo_acto[5]; ?>"/><span style="color:red; margin-left:5px">(*)</span></td>
        <tr>
            <td><span class='titubuskar0' style="margin-left:8px">Código SUNAT</span></td>
            <td><input id="m_sunat" name="m_sunat" type="text" class="Estilo7" style="width:100px" onKeyPress="return isNumberKey(event)" maxlength="20" value="<?php echo $arr_tipo_acto[1]; ?>"/></td>
            <td><span class='titubuskar0'>Impuesto</span></td>
            <td><input id="m_impuesto" name="m_impuesto" type="text" class="Estilo7" style="width:100px" onKeyPress="return isNumberKey(event)" maxlength="20" value="<?php echo $arr_tipo_acto[7]; ?>"/></td>
        </tr>
        <tr>
            <td><span class='titubuskar0' style="margin-left:8px">Código UIF</span></td>
            <td><input id="m_uif" name="m_uif" type="text" class="Estilo7" style="width:100px" onKeyPress="return isNumberKey(event)" maxlength="20" value="<?php echo $arr_tipo_acto[2]; ?>"/></td>
            <td><span class='titubuskar0'>Umbral</span></td>
            <td><input id="m_umbral" name="m_umbral" type="text" class="Estilo7" style="width:100px" onKeyPress="return isNumberKey(event)" maxlength="20" value="<?php echo $arr_tipo_acto[6]; ?>"/></td>
        </tr>
        <!--<tr>
            <td><span class='titubuskar0' style="margin-left:8px">Modelo</span></td>
            <td><input id="m_modelo" name="m_modelo" type="text" class="Estilo7" style="width:100px" onKeyPress="return isNumberKey(event)" maxlength="20" value="<?php echo $arr_tipo_acto[8]; ?>"/></td>
            <td></td>
            <td></td>
        </tr>-->
        <tr align="center">
            <td colspan="4"><input type="button" value="Modificar" class="Estilo7" style="width:70px" onClick="mod_acto()"/></td>
        </tr>
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-223px; left:520px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_macto()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:390px; top:-30px">(*)Campos Obligatorios</span>	
