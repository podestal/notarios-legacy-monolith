	<link rel="stylesheet" type="text/css" href="../../css/protocolares/kardex.css">
	
	<style>
    .input_yellow{
	text-align:right; 
	width:80px; 
	padding:3px; 
	color:#666; 
	font-size:12px;
	}
    </style>
    
	<?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
	
	$codkardex = $_REQUEST['id'];
	
	$arr_facts = facturas_kardex($codkardex);
	
	$arr_nr = dame_notreg($codkardex);
	
	?>
            
    
    <table align="center" width="100%" height="100%">
    
    	<tr>
        	<td valign="top" align="center">
            	<table id='detPagosTb' width='480px' border='1' cellspacing='0' cellpadding='0' style="margin-top:10px">
                  <tr bgcolor="#CCCCCC"  height="27" style="font-size:13px">
                      <td width="156" align="center"><span class="Estilo18">Tipo</span></td>
                      <td width="93" align="center"><span class="Estilo18">N.Docu.</span></td>
                      <td width="89" align="center"><span class="Estilo18">Fecha</span></td>
                      <td width="121" align="center"><span class="Estilo18">Condición</span></td>
                      <td width="79" align="center"><span class="Estilo18">Pv</span></td>
                      <td width="73" align="center"><span class="Estilo18">Saldo</span></td>
                  </tr>		
                        
                <?php 
                
                for($i=0; $i<count($arr_facts); $i++){
                    
                ?>
                
                  <tr class='well' style='font-size:12px; color:#333333''>
                    <td align='center'><?php echo $arr_facts[$i][0]; ?></td>
                    <td align='center'><?php echo $arr_facts[$i][1].'-'.$arr_facts[$i][2]; ?></td>
                    <td align='center'><?php echo fechabd_an($arr_facts[$i][3]); ?></td>
                    <td align='center'><?php echo $arr_facts[$i][4]; ?></td>
                    <td align='center'><?php echo $arr_facts[$i][5]; ?></td>
                    <td align='center'><?php echo $arr_facts[$i][6]; ?></td>
                  </tr>
                
                <?php 
                } 
                ?>
                </table>
            </td>
            <td></td>
            <td align="center" >
            	<table width="201" height="172" bgcolor="#FFFF99" style="font-size:12px; margin-top:10px">
                	<tr>
                    	<td width="87" align="center"><span class="Estilo23">TNOT</span></td>
                        <td width="34" align="center"><span class="Estilo21">-</span></td>
                        <td width="86" align="center"><span class="Estilo23">TREG</span></td>
                    </tr>
                    <tr>
                    	<td colspan="3" align="center"><span class="Estilo21">Presupuesto</span></td>
                    </tr>
                    <tr>
                    	<td align="center">
                        	<input class="input_yellow" name="pre1" type="text" id="pre1" value="0.00" readonly />
                        </td>
                        <td align="center"><span class="Estilo21"> -</span></td>
                        <td align="center">
                        	<input class="input_yellow" name="pre2" type="text" id="pre2" style="text-align:right; width:80px; padding:3px; color:#666" value="0.00" readonly/>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="3" align="center"><span class="Estilo21">Cobrado</span></td>
                    </tr>
                    <tr>
                    	<td align="center">
                        	<input class="input_yellow" name="cobrado1" type="text" id="cobrado1" style="text-align:right; width:80px; padding:3px; color:#666" value="<?php echo $arr_nr[0];?>" readonly/>
                        </td>
                        <td align="center"><span class="Estilo21">-</span></td>
                        <td align="center">
                        	<input class="input_yellow" name="cobrado2" type="text" id="cobrado2" style="text-align:right; width:80px; padding:3px; color:#666" value="<?php echo $arr_nr[1];?>" readonly/>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="3" align="center"><span class="Estilo21">Saldo </span></td>
                    </tr>
                    <tr>
                    	<td align="center">
                        	<input class="input_yellow" name="saldo1" type="text" id="saldo1" style="text-align:right; width:80px; padding:3px; color:#666" value="0.00" readonly/></td>
                        <td align="center"><span class="Estilo21">-</span></td>
                        <td align="center">
                        	<input class="input_yellow" name="saldo2" type="text" id="saldo2" style="text-align:right; width:80px; padding:3px; color:#666" value="0.00" readonly  /></td>
                    </tr>
                </table>
          </td>
        </tr>
        
    </table>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
            
	


