<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$sql_idcond = "select idcondicion from actocondicion order by cast(actocondicion.idcondicion as signed) desc";
	
	$exe_idcond = mysql_query($sql_idcond, $conexion);
	
	$row_lastcond = mysql_fetch_array($exe_idcond);
		
	$id_cond = $row_lastcond[0]+1;
	
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
	
?>


<form id="frm_ncond" name="frm_ncond" style="width:100%; height:auto "/>
    <table width="543" height="240"  cellpadding="0" cellspacing="0">
        <tr height="30" style="background-color:#264965">
            <td colspan="4" align="center"><span class='submenutitu' style="font-size:14px">Nueva Condición</span></td>
        </tr>
        <tr height="35">
        	<td width="81"><span class='titubuskar0' style="margin-left:8px">Tipo Kardex</span></td>
            <td width="234">
            	<select id="n_tipkar" name="n_tipkar" style="width:197px;" onchange=" cambiar_tipacto(1)" class="Estilo7">
                    <option value="0">--Tipo Kardex--</option>
					<?php
            
                    $i=0;
            
                    while($kardex = mysql_fetch_array($exe_kardex)){ ?>
                    
                    <option value="<?php echo $kardex["idtipkar"]; ?>"><?php echo $kardex["nomtipkar"]; ?></option>
                    <?php
                        $i++; 
                    }
                    ?>
                </select>
                
            </td>
			<td width="69"><span class='titubuskar0'>Código</span></td>
            <td width="157"><input id="n_cod" name="n_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_cond; ?>" readonly /></td>
        </tr>
        <tr height="35">
        	<td width="81"><span class='titubuskar0' style="margin-left:8px">Tipo Acto</span></td>
            <td width="234">
            	<div id="div_tipacto" style="float:left"></div>
                <span style="color:red; margin-left:5px">(*)</span>
            </td>
			<td width="69"></td>
            <td width="157"></td>
        </tr>
        <tr height="35">
            <td><span class='titubuskar0' style="margin-left:8px">Condición</span></td>
            <td colspan="3"><input id="n_cond" name="n_cond" type="text" class="Estilo7" style="width:374px; text-transform:uppercase" maxlength="50"/><span style="color:red; margin-left:5px">(*)</span></td>
        </tr>  
        <tr height="35">
        	<td colspan="4">
            	<table width="100%">
                	<tr>
                		<td width="75"><span class='titubuskar0' style="margin-left:5px">Cond. SUNAT</span></td>	
                        <td width="71"><span class='Estilo7' style="margin-left:8px">Transferente</span></td>
            			<td width="49"><input type="radio" id="trans" name="n_sunat" value="1"/></td>
            			<td width="71"><span class='Estilo7' style="margin-left:8px">Adquirente</span></td>
            			<td width="251"><input type="radio" id="adq" name="n_sunat" value="2"/></td>
            		</tr>
                </table>
            </td>
        

        </tr>
 		<tr height="35">
            <td><span class='titubuskar0' style="margin-left:8px">Formulario</span></td>
            <td><input id="n_form" name="n_form"  type="checkbox" value="1" class="Estilo7" style="width:30px" /></td>
            <td></td>
            <td></td>

		</tr>
        <tr height="35">
			<td><span class='titubuskar0' style="margin-left:8px">Rol UIF</span></td>
            <td>
            	<select id="n_uif" name="n_uif" style="width:197px;" class="Estilo7" >
                	<option value="0">--Seleccione UIF --</option>
                    <?php

					$i=0;
    
					while($uif = mysql_fetch_array($exe_uif)){ ?>
                    
                    <option value="<?php echo $uif["cod_uif"]; ?>"><?php echo utf8_decode($uif["descripcion"]); ?></option>
                    
					<?php
						$i++; 
					}
					?>
                    
                </select>
            </td>        	 
            <td><span class='titubuskar0'>Monto Part.</span></td>
            <td><input id="n_monto" name="n_monto" type="checkbox" value="1" class="Estilo7" style="width:30px" /></td>
        </tr>
        <tr height="35" align="center">
            <td colspan="4"><input type="button" value="Guardar" class="Estilo7" style="width:70px" onClick="registrar_condicion()"/></td>
        </tr>
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-269px; left:520px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_ncondicion()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:390px; top:-30px">(*)Campos Obligatorios</span>	
