	<link rel="stylesheet" href="../../stylesglobal.css">	    

	<?php 
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$pag = $_REQUEST['pag'];
	$desde = $_REQUEST['fechade'];
	$hasta = $_REQUEST['fechaa'];
	$filtro = $_REQUEST['filtro'];
	
	$desde = fechan_abd($desde);
	$hasta = fechan_abd($hasta); 	
    
	$sql_cuentas = "SELECT 
                    m_regventas.id_regventas as id,
                    m_regventas.fecha as fecha,
                    m_regventas.tipo_docu as tipo_docu,
					t_params.des_item AS des_comp,
                    m_regventas.serie as serie,
                    m_regventas.factura as numdoc,
					m_regventas.num_docu as doic,
                    m_regventas.concepto as cliente,
					m_regventas.subtotal as subtotal,
					m_regventas.impuesto as impuesto,
                    m_regventas.imp_total as total,
					m_regventas.tipopago as tipopago
					from m_regventas
                    INNER JOIN t_params ON  m_regventas.tipo_docu= t_params.num_item
					where  STR_TO_DATE(m_regventas.fecha,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					and STR_TO_DATE(m_regventas.fecha,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
					
	if($filtro<>0){
		
		/*
		
		                <option value="0">--Todos--</option>
						<option value="1">Facturas, Boletas</option>
                        <option value="2">Factura</option>
						<option value="3">Boleta</option>
						<option value="4">Recibo</option>
		
		
		
                01 boleta                
				02 factura	           	 
                03 nota de credito        
				04 recibo          		  
						                 
		*/
		
		if($filtro==1){$sql_cuentas =	$sql_cuentas." AND ( m_regventas.tipo_docu='02' or m_regventas.tipo_docu='01' ) ";}
		if($filtro==2){$sql_cuentas =	$sql_cuentas." AND m_regventas.tipo_docu='02'";}
		if($filtro==3){$sql_cuentas =	$sql_cuentas." AND m_regventas.tipo_docu='01'";}
		if($filtro==4){$sql_cuentas =	$sql_cuentas." AND m_regventas.tipo_docu='04'";}
		
		
		
		
	}
    
	$sql_cuentas =	$sql_cuentas." ORDER BY m_regventas.fecha desc, m_regventas.tipo_docu asc, fn_onlynum(m_regventas.factura) desc";
	
    $res_cuentas = mysql_query($sql_cuentas, $conexion);
    
    $total_cuentas = mysql_num_rows($res_cuentas);
    
    $num_reg = 15;
    
    $num_pag = ceil($total_cuentas/$num_reg);
    
    $ini = 0;
    
    $ini = ($pag-1)*$num_reg;
    
    $ini_pag = floor(($pag-1)/7)*7 + 1;
    
    $sql_cuentas = $sql_cuentas." LIMIT $ini, $num_reg";
    
    $res_cuentas = mysql_query($sql_cuentas, $conexion);
    
    $i=0;
    
    while($cuentas = mysql_fetch_array($res_cuentas)){
		
		$arr_cuentas[$i][0] = $cuentas["id"]; 
		$arr_cuentas[$i][1] = fechabd_an($cuentas["fecha"]); 
		$arr_cuentas[$i][2] = $cuentas["tipo_docu"];         
        $arr_cuentas[$i][3] = $cuentas["des_comp"]; 
		$arr_cuentas[$i][4] = $cuentas["serie"]; 
        $arr_cuentas[$i][5] = $cuentas["numdoc"]; 
        $arr_cuentas[$i][6] = $cuentas["doic"]; 
		$arr_cuentas[$i][7] = strtoupper($cuentas["cliente"]); 
        $arr_cuentas[$i][8] = $cuentas["subtotal"]; 
		$arr_cuentas[$i][9] = $cuentas["impuesto"]; 
		$arr_cuentas[$i][10] = $cuentas["total"]; 
		$arr_cuentas[$i][11] = $cuentas["tipopago"]; 
		$i++; 
		
    }
    
    ?>

<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
	color: #003366;
}
.titubuskar0 {font-family: Calibri; font-size: 12px; font-style: italic; font-weight: bold; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Calibri; font-size: 13px; font-weight: bold; font-style: italic; color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
-->
</style>

	<table width="870" border="1" cellspacing="0" cellpadding="0" >
  			<tr style="background-color:#CCCCCC">
              <td width="80" align="center"><span class="titubuskar0">Fec.Emisión</span></td>
          	  <td width="110" align="center"><span class="titubuskar0">Tipo Doc.</span></td>
          	  <td width="50" align="center"><span class="titubuskar0">Serie</span></td>
              <td width="70" align="center"><span class="titubuskar0">Num. Doc.</span></td>
              <td width="70" align="center"><span class="titubuskar0">DOC</span></td>
			  <td width="230" align="center"><span class="titubuskar0">Cliente</span></td>
              <td width="70" align="center"><span class="titubuskar0">Sub Total</span></td>
              <td width="70" align="center"><span class="titubuskar0">IGV(18%)</span></td>
              <td width="70" align="center"><span class="titubuskar0">Imp.Total</span></td>
              <td width="20" align="center"><span class="titubuskar0">TE</span></td>
          </tr>
          <?php 
		  for($j=0; $j<count($arr_cuentas); $j++){ ?>
         	 <tr>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_cuentas[$j][1]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_cuentas[$j][3]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_cuentas[$j][4]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_cuentas[$j][5]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_cuentas[$j][6]; ?></span>
                </td>
                <td align='center'>
                	<span class='reskar'><?php echo $arr_cuentas[$j][7]; ?></span>
                </td>
                <td align='right'>
                	<span class='reskar' style='margin-right:5px'><?php echo $arr_cuentas[$j][8]; ?></span>
                </td>
                <td align='right'>
                	<span class='reskar' style='margin-right:5px'><?php echo $arr_cuentas[$j][9]; ?></span>
                </td>
				<td align='right'>
                	<span class='reskar' style='margin-right:5px'><?php echo $arr_cuentas[$j][10]; ?></span>
                </td>
                <td align='right'>
                	<span class='reskar' style='margin-right:5px'><?php echo $arr_cuentas[$j][11]; ?></span>
                </td>
				
			</tr>
		  <?php
          }
		  ?>
          
		  	 <tr height='25'>
				    <td colspan='10' align='center' valign='bottom'>
					    <table style='margin-bottom:4px'>
						   <tr class='paginacion'>
						    <?php if($pag>7){?>
								<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="listar_reporte_e('<?php echo ($ini_pag-1); ?>')"><--</div></td>
						    <?php } 
							for($i=$ini_pag; $i<$ini_pag+7; $i++){
							 	if($i <= $num_pag){ ?>
								<td width='15'>
									<?php	
									if($i==$pag){ ?>
									<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="listar_reporte_e('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
									<?php	}else{ ?>
									<div class='pagina' style='cursor:pointer' title='Ir a' onclick="listar_reporte_e('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                	<?php } ?>
                                </td>
								<?php }
						    }
						  	if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
							<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="listar_reporte_e('<?php echo ($ini_pag+7); ?>')">--></div></td>
    						<?php
						    }
                            ?>	  
							
							</tr>
			  	        </table>
					</td>
			    </tr>
				<tr>
                	<td colspan="10" align="left" class="titubuskar0" style="margin-left:10px; font-size:9px">
                    	<table width="481" cellpadding="0" cellspacing="1">
                        	<tr>
                            	<td width="153">Tipos de Emisión = TE</td>
                            	<td width="148"><span>1.-EFECTIVO</span></td>
								<td width="178"><span>5. NOTA DE CREDITO</span></td>
                            </tr>
                            <tr>
                                <td></td>
                            	<td><span>2.-CREDITO</span></td>
                            	<td><span>7. TARJETA DE CREDITO</span></td>
                            </tr>
                            <tr>
                                <td></td>
                            	<td><span>3. GRATUITO</span></td>
                            	<td><span>8. DEPOSITO EN CUENTA</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span>4. CHEQUE</span></td>
                            	<td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
    		</table>
            
            
           



