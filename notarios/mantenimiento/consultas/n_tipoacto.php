<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	for($i = 1;$i<=999;$i++){
		
		$codigoActo = str_pad($i, 3, "0", STR_PAD_LEFT); //580
		$sql = "SELECT idtipoacto  FROM tiposdeacto WHERE idtipoacto = '$codigoActo' LIMIT 1";
		$result = mysql_query($sql, $conexion);
		if(!mysql_fetch_array($result)){
			$id_acto = $codigoActo;
			break;
		}
	}
		
		
	/*
	$sql_idacto = "select idtipoacto from tiposdeacto order by cast( tiposdeacto.idtipoacto as signed) desc";
	
	$exe_idacto = mysql_query($sql_idacto, $conexion);
	
	$row_lastacto = mysql_fetch_array($exe_idacto);*/
		
	//$id_acto = $row_lastacto[0]+1;
	
	$sql_tipkar = "select idtipkar, nomtipkar from tipokar";
	
	$exe_tipkar = mysql_query($sql_tipkar, $conexion);
	
?>


<form id="frm_nacto" name="frm_nacto" style="width:100%"/>
    <table width="543" height="231" cellpadding="0" cellspacing="0">
        <tr style="background-color:#264965">
            <td colspan="4" align="center"><span class='submenutitu' style="font-size:14px">Nuevo Acto</span></td>
        </tr>
        <tr>
        	<td width="83"><span class='titubuskar0' style="margin-left:8px">Tipo Kardex</span></td>
            <td width="216">
            	<select id="n_tipkar" name="n_tipkar" style="width:197px;" class="Estilo7">
                	<option value="0">--Seleccion Kardex --</option>
                    <?php

					$i=0;
    
					while($tip_kar = mysql_fetch_array($exe_tipkar)){ ?>
                    
                    <option value="<?php echo $tip_kar["idtipkar"]; ?>"><?php echo $tip_kar["nomtipkar"]; ?></option>
                    
					<?php
						$i++; 
					}
					?>
                    
                </select><span style="color:red; margin-left:5px">(*)</span>
            </td>
            <td width="58"><span class='titubuskar0'>Código</span></td>
            <td width="166"><input id="n_cod" name="n_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_acto; ?>" readonly /></td>
        </tr>
        <tr>
            <td><span class='titubuskar0' style="margin-left:8px">Descripción</span></td>
            <td colspan="3"><input id="n_desc" name="n_desc" type="text" class="Estilo7" style="width:374px; text-transform:uppercase" maxlength="150"/><span style="color:red; margin-left:5px">(*)</span></td>
        <tr>
            <td><span class='titubuskar0' style="margin-left:8px">Código SUNAT</span></td>
            <td><input id="n_sunat" name="n_sunat" type="text" class="Estilo7" style="width:100px" onKeyPress="return isNumberKey(event)" maxlength="20"/></td>
            <td><span class='titubuskar0'>Impuesto</span></td>
            <td><input id="n_impuesto" name="n_impuesto" type="text" class="Estilo7" style="width:100px" onKeyPress="return isNumberKey(event)" maxlength="20"/></td>
        </tr>
        <tr>
            <td><span class='titubuskar0' style="margin-left:8px">Código UIF</span></td>
            <td><input id="n_uif" name="n_uif" type="text" class="Estilo7" style="width:100px" onKeyPress="return isNumberKey(event)" maxlength="20"/></td>
            <td><span class='titubuskar0'>Umbral</span></td>
            <td><input id="n_umbral" name="n_umbral" type="text" class="Estilo7" style="width:100px" onKeyPress="return isNumberKey(event)" maxlength="20"/></td>
        </tr>
       <!-- <tr>
            <td><span class='titubuskar0' style="margin-left:8px">Modelo</span></td>
            <td><input id="n_modelo" name="n_modelo" type="text" class="Estilo7" style="width:100px" onKeyPress="return isNumberKey(event)" maxlength="20"/></td>
            <td></td>
            <td></td>
        </tr>-->
        <tr align="center">
            <td colspan="4"><input type="button" value="Guardar" class="Estilo7" style="width:70px" onClick="registrar_acto()"/></td>
        </tr>
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-223px; left:520px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_nacto()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:390px; top:-30px">(*)Campos Obligatorios</span>	
