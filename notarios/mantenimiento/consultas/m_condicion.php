<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$sql_kardex	=  "SELECT
					tipokar.idtipkar,
					tipokar.nomtipkar,
					tipokar.tipkar
					FROM
					tipokar";
					
	$exe_kardex = mysql_query($sql_kardex, $conexion);
	
	$sql_tipoacto = "select idtipoacto, desacto from tiposdeacto order by desacto asc ";
	
	$exe_tipoacto = mysql_query($sql_tipoacto, $conexion);
	
	$sql_uif = "select id_uif, cod_uif, descripcion from rol_uif";
	
	$exe_uif = mysql_query($sql_uif, $conexion);
	
	$id_cond = $_REQUEST['id_condicion'];
	
	$sql_condicion = "select 
					  actocondicion.idcondicion as id_condicion, 
					  actocondicion.idtipoacto as tip_acto, 
					  actocondicion.condicion as condicion, 
					  actocondicion.parte as parte, 
					  actocondicion.uif as uif, 
					  actocondicion.formulario as form, 
					  actocondicion.montop as monto, 
					  actocondicion.totorgante as otorgante,
					  tiposdeacto.desacto as des_acto,
					  tiposdeacto.idtipkar as tipkar,
					  tipokar.nomtipkar as kardex
					  from actocondicion
					  INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto
					  INNER JOIN tipokar ON tiposdeacto.idtipkar = tipokar.idtipkar 
					  where actocondicion.idcondicion='$id_cond'";
	
	$exe_condicion = mysql_query($sql_condicion, $conexion);
    
    $total_condicion = mysql_num_rows($exe_condicion);
    
    while($condicion = mysql_fetch_array($exe_condicion)){
		$arr_condicion[0] = $condicion["id_condicion"]; 
		$arr_condicion[1] = $condicion["tip_acto"];         
        $arr_condicion[2] = $condicion["condicion"]; 
		$arr_condicion[3] = $condicion["parte"]; 
        $arr_condicion[4] = $condicion["uif"]; 
        $arr_condicion[5] = $condicion["form"]; 
        $arr_condicion[6] = $condicion["monto"]; 
		$arr_condicion[7] = $condicion["otorgante"]; 
		$arr_condicion[8] = $condicion["des_acto"]; 
		$arr_condicion[9] = $condicion["tipkar"]; 
		$arr_condicion[10] = $condicion["kardex"]; 
	}
	
?>


<form id="frm_mcond" name="frm_mcond" style="width:100%; height:auto "/>
    <table width="543" height="240"  cellpadding="0" cellspacing="0">
        <tr height="30" style="background-color:#264965">
            <td colspan="4" align="center" width="100%"><span class='submenutitu' style="font-size:14px">Modificar Condición</span></td>
        </tr>
        <tr height="35">
        	<td width="80"><span class='titubuskar0' style="margin-left:8px">Tipo Kardex</span></td>
            <td width="218">
            	<select id="m_tipkar" name="m_tipkar" style="width:197px;" onchange=" cambiar_tipacto(2)" class="Estilo7">
                    <?php
            
                    $i=0;
            
                    while($kardex = mysql_fetch_array($exe_kardex)){ ?>
                    
                    <option
                    <?php 
					if($arr_condicion[9]== $kardex["idtipkar"]){
                        echo "selected='selected'";
                    }
                    ?>
                    value="<?php echo $kardex["idtipkar"]; ?>"><?php echo $kardex["nomtipkar"]; ?></option>
                    <?php
                        $i++; 
                    }
                    ?>
                </select>
            </td>
            <td width="70"><span class='titubuskar0'>Código</span></td>
            <td width="147"><input id="m_cod" name="m_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_cond; ?>" readonly /></td>
        </tr>
         <tr height="35">
        	<td width="80"><span class='titubuskar0' style="margin-left:8px">Tipo Acto</span></td>
            <td width="218">
            	<div id="div_tipacto" style="float:left">
                <select id="m_tipact" name="m_tipact" style="width:197px;" class="Estilo7">
                    <?php
            
                    $i=0;
            
                    while($tipoacto = mysql_fetch_array($exe_tipoacto)){ ?>
                    
                    <option
                    <?php 
                    if($arr_condicion[1]== $tipoacto["idtipoacto"]){
                        echo "selected='selected'";
                    }
                    ?>
                    
                     value="<?php echo $tipoacto["idtipoacto"]; ?>"><?php echo $tipoacto["desacto"]; ?></option>
                    <?php
                        $i++; 
                    }
                    ?>
                </select>
                </div>
            </td>
            <td width="70"></td>
            <td width="147"></td>
        </tr>
        <tr height="35">
            <td><span class='titubuskar0' style="margin-left:8px">Condición</span></td>
            <td colspan="3"><input id="m_cond" name="m_cond" type="text" class="Estilo7" style="width:374px; text-transform:uppercase" maxlength="50" value="<?php echo $arr_condicion[2];?>"/><span style="color:red; margin-left:5px">(*)</span></td>
        </tr>   
        <tr height="35">
        	<td colspan="4">
            	<table width="100%">
                	<tr>
                		<td width="77"><span class='titubuskar0' style="margin-left:5px">Cond. SUNAT</span></td>	
                        <td width="74"><span class='Estilo7' style="margin-left:8px">Transferente</span></td>
            			<td width="43"><input type="radio" id="trans" 
                        <?php 
						if($arr_condicion[3]==1){
							echo "checked='checked' ";
						}
						?>
                        name="m_sunat" value="1"/></td>
            			<td width="73"><span class='Estilo7' style="margin-left:8px">Adquirente</span></td>
            			<td width="75"><input type="radio" id="adq" 
                        <?php 
						if($arr_condicion[3]==2){
							echo "checked='checked' ";
						}
						?>
                        name="m_sunat" value="2"/></td>
				<td width="73"><span class='Estilo7' style="margin-left:8px">Ninguno</span></td>
				<td width="75"><input type="radio" id="adq" 
                        <?php 
						if($arr_condicion[3]==""){
							echo "checked='checked' ";
						}
						?>
                        name="m_sunat" value=""/></td>
            		</tr>
                </table>
            </td>
        </tr>
 		 <tr height="35">
            <td><span class='titubuskar0' style="margin-left:8px">Formulario</span></td>
            <td><input id="m_form"  name="m_form" type="checkbox" value="1" 
            <?php
			if($arr_condicion[5]==1){
				echo "checked='checked'";
			}
			?>
             class="Estilo7" style="width:30px"/></td>
            <td></td>
            <td></td>
		</tr>
        <tr height="35">
        	<td><span class='titubuskar0' style="margin-left:8px">Rol UIF</span></td>
            <td>
            	<select id="m_uif" name="m_uif" style="width:197px;" class="Estilo7" >
                	<option value="0">--Seleccione UIF --</option>
                    <?php

					$i=0;
    
					while($uif = mysql_fetch_array($exe_uif)){ ?>
                    
                    <option 
                    <?php 
					if($arr_condicion[4]==$uif["cod_uif"]){
						echo "selected='selected'";
					}
					?>
                    value="<?php echo $uif["cod_uif"]; ?>"><?php echo utf8_decode($uif["descripcion"]); ?></option>
                    
					<?php
						$i++; 
					}
					?>
                    
                </select>
            </td>
            <td><span class='titubuskar0'>Monto Part.</span></td>
            <td><input id="m_monto" name="m_monto" type="checkbox" value="1"
            <?php
			if($arr_condicion[6]==1){
				echo "checked='checked'";
			}
			?>
            class="Estilo7" style="width:30px"/></td>
            <td width="0"></td>
            <td width="0"></td>
        </tr>
        <tr height="35" align="center">
            <td colspan="4"><input type="button" value="Modificar" class="Estilo7" style="width:70px" onClick="mod_condicion('<?php echo $arr_condicion[0]; ?>')"/></td>
        </tr>
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-269px; left:520px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_mcondicion()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:390px; top:-30px">(*)Campos Obligatorios</span>	
