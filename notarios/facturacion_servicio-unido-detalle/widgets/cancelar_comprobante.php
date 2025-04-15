<link rel="stylesheet" href="../../stylesglobal.css">	

<?php 
	session_start();
	
	include("../../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();
	
	$id_ctaventas = $_REQUEST['id_ctaventas'];
	
	$sql_cuenta  = "SELECT  
					m_cteventas.id_ctaventas as id,
					m_cteventas.fecha as fecha,
					tipocomprobante.descompro as des_comp,
					m_cteventas.serie as serie,
					m_cteventas.documento as num_doc,
					m_cteventas.concepto as cliente,
					m_cteventas.codiempl as empleado,
					m_cteventas.saldo as saldo,
					m_cteventas.tipo_docu as id_tipdoc,
					m_cteventas.num_docu_cli as doic
					from m_cteventas
					inner join tipocomprobante on  m_cteventas.tipo_docu= tipocomprobante.idcompro
					where  m_cteventas.id_ctaventas = $id_ctaventas";
    
	$sql_cuenta =	$sql_cuenta." ORDER BY m_cteventas.fecha desc";
	
	$res_cuenta = mysql_query($sql_cuenta, $conexion);
    
    while($cuenta = mysql_fetch_array($res_cuenta)){
		
		$arr_cuenta[0] = $cuenta["id"]; 
		$arr_cuenta[1] = fechabd_an($cuenta["fecha"]); 
		$arr_cuenta[2] = $cuenta["des_comp"];         
        $arr_cuenta[3] = $cuenta["serie"]; 
		$arr_cuenta[4] = $cuenta["num_doc"]; 
        $arr_cuenta[5] = $cuenta["cliente"]; 
        $arr_cuenta[6] = $cuenta["doic"]; 
		$arr_cuenta[7] = $cuenta["cliente"]; 
        $arr_cuenta[8] = $cuenta["empleado"]; 
		$arr_cuenta[9] = $cuenta["saldo"]; 
		$arr_cuenta[10] = $cuenta["id_tipdoc"];

		$i++; 
		
    }
  
?>
<form id="frm_abono" name="frm_abono">
<fieldset id="field_remitente">
<table width="100%">
	<tr>
    	<td>
        	<fieldset id="field_remitente">
            <legend><span class="camposss">Datos del Cargo</span></legend>
        	<table width="786">
            	<tr>
                	<td width="115"><span class="camposss">Tip. Comprobante:</span></td>
                    <td width="275">
                        <input id="canc_tipcomp" name="canc_tipcomp" class="camposss" style="width:110px; background-color:#CCC;" value="<?php echo $arr_cuenta[2] ;?>" readonly="readonly" type="text"/>
                        <input id="canc_id" name="canc_id" value="<?php echo $arr_cuenta[0] ;?>" type="hidden"/>
                        <input id="canc_idtipcomp" name="canc_idtipcomp" value="<?php echo $arr_cuenta[10] ;?>" type="hidden"/>
                        <input id="canc_doic" name="canc_doic" value="<?php echo $arr_cuenta[6] ;?>" type="hidden"/>
                    </td>
                    <td width="37"><span class="camposss">Serie:</span></td>
                    <td width="95">
                    	<input id="canc_serie" name="canc_serie" class="camposss" style="width:30px; background-color:#CCC; text-align:center; padding-right:0px" value="<?php echo $arr_cuenta[3] ;?>" readonly="readonly" type="text"/>
                    </td>
                    <td width="104"><span class="camposss">Nº Documento:</span></td>
                    <td width="132">
                    	<input id="canc_num" name="canc_num" class="camposss" style="width:110px; background-color:#CCC; " value="<?php echo $arr_cuenta[4] ;?>" readonly="readonly" type="text" />
                    </td>
                </tr>
                <tr>
                	<td><span class="camposss">Cliente:</span></td>
                    <td colspan="3">
                    	<input id="canc_cliente" name="canc_cliente"  class="camposss" style="text-transform:uppercase; width:353px; background-color:#CCC" value="<?php echo $arr_cuenta[7] ;?>"  readonly="readonly" type="text"/>
                    </td>
                    <td><span class="camposss">Empleado:</span></td>
                    <td><input id="canc_usuario" name="canc_usuario" class="camposss" style="width:110px; background-color:#CCC" value="<?php echo $arr_cuenta[8] ;?>" onKeyPress="return isNumberKey(event)" readonly="readonly" type="text" /></td>
                </tr>
            </table>
            </fieldset>
        </td>
    </tr>
    
    <tr>
    	<td>
        	<fieldset id="field_remitente">
            <legend><span class="camposss">Abono a Realizar</span></legend>
        	<table width="772">
            	<tr>
                	<td width="125"><span class="camposss">Fecha de Abono:</span></td>
                    <td colspan="7"><input id="canc_fecha" name="canc_fecha" style="width:100px; height:16px" readonly="readonly" value="<?php echo date('d/m/Y');?>" class="camposss" type="text"/>
                   	</td>
                </tr>
                <tr>
                	<td><span class="camposss">Forma de Pagos:</span></td>
                    <?php
					$consulta_pago = "SELECT tipo_pago.codigo AS 'id', tipo_pago.descrip AS 'des' FROM tipo_pago where tipo_pago.codigo<>'2' and tipo_pago.codigo<>'3' and tipo_pago.codigo<>'5'  ORDER BY tipo_pago.descrip ASC";
		
					$ejecuta_pago = mysql_query($consulta_pago, $conexion);
						
					$i=0;
				
					while($tippago = mysql_fetch_array($ejecuta_pago, MYSQL_ASSOC))
					{
						$arr_tippago[$i][0] = $tippago["id"]; 
						$arr_tippago[$i][1] = $tippago["des"];
						$i++; 
					}
					

					?>
                    <td width="324">
                    <select id="canc_tippago" name="canc_tippago" style='width:160px;' class='camposss'>
                         <?php 
						 for($j=0;$j<count($arr_tippago); $j++){ 
						 		 ?>
								 <option value='<?php echo $arr_tippago[$j][0]; ?>'
								 <?php 
								 if($arr_tippago[$j][0]==1){
									echo "selected = 'selected'";		 
								 }
								 ?>
								 ><?php echo $arr_tippago[$j][1]; ?></option> 
                         <?php 
						 }
						 ?>
                    </select>
                    </td>
                    
                     <td width="91"><span class="camposss">Banco:</span></td>
                    <?php
                    $sql_banco = "SELECT bancos.idbancos as idbanco, bancos.desbanco as desbanco FROM bancos";
	
					$res_banco = mysql_query($sql_banco, $conexion);
					
					$i=0;
				
					while($banco = mysql_fetch_array($res_banco, MYSQL_ASSOC))
					{
						$arr_banco[$i][0] = $banco["idbanco"]; 
						$arr_banco[$i][1] = $banco["desbanco"];
						$i++; 
					}
					?>
                    <td width="212">
                    	<select id="canc_banco" name="canc_banco" style='width:248px;' class='camposss'>
                            <option value="">--Entidad Finaciera--</option>
                            <?php    
                            for($j=0;$j<count($arr_banco); $j++){ ?>
                            <option value='<?php echo $arr_banco[$j][0]; ?>'><?php echo $arr_banco[$j][1]; ?></option> 
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><span class="camposss">Numero:</span></td>
                    <td><input id="canc_numero" name="canc_numero" class="camposss" style="width:100px" maxlength="20" type="text"/></td>
                    <td><span class="camposss">Monto: (S/.)</span></td>
                    <td><input id="canc_monto" name="canc_monto" class="camposss" style="width:100px" maxlength="9" onKeyPress="return numerosdecimales(event)" type="text" value="<?php echo $arr_cuenta[9]; ?>"/></td>
                </tr>
            </table>
            </fieldset>

        </td>
    </tr>
    <tr>
        <td colspan="6">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
    </tr>
    <tr>
        <td colspan="6">
            <table width="744"  height="41" align="right">
                    <tr>
                        <td width="624">&nbsp;</td>
                        <td width="49">
                        <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:6px; width:30px; cursor:pointer" title="Abonar" onclick="crear_abono()">
                        <img style="margin-left:6px" src="../../images/success.png" width="20" height="20"   /></div></td>
                        <td width="55">
                        <div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:6px; width:30px; cursor:pointer" title="Cerrar" onClick="cerrar_abonar()"><img style="margin-left:4px" src="../../images/delete.png" width="20" height="20" /></div></td>
                    </tr>
            </table>	
        </td>
    </tr>
</table>
</fieldset>
</form>




