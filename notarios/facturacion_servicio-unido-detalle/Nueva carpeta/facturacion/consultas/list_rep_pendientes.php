	<link rel="stylesheet" href="../../stylesglobal.css">	    

	<?php 
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
   	$pag = $_REQUEST['pag'];
	$desde = $_REQUEST['fechade'];
	$hasta = $_REQUEST['fechaa'];
	
	$desde = fechan_abd($desde);
	$hasta = fechan_abd($hasta); 
    
	$sql_cuentas = "SELECT  
					m_cteventas.id_ctaventas as id,
					m_cteventas.fecha as fecha,
					tipocomprobante.descompro as des_comp,
					m_cteventas.serie as serie,
					m_cteventas.documento as num_doc,
					m_cteventas.concepto as cliente,
					m_cteventas.codiempl as empleado,
					m_cteventas.saldo as saldo,
					m_cteventas.tipo_docu as id_tipdoc,
					m_cteventas.tipo_movi as movi
					from m_cteventas
					inner join tipocomprobante on  m_cteventas.tipo_docu= tipocomprobante.idcompro
					where m_cteventas.tipo_movi ='C' and m_cteventas.saldo>0 and
					STR_TO_DATE(m_cteventas.fecha,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') and 
					STR_TO_DATE(m_cteventas.fecha,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
					
	$sql_cuentas =	$sql_cuentas." ORDER BY m_cteventas.fecha desc";
    
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
        $arr_cuentas[$i][2] = $cuentas["des_comp"]; 
        $arr_cuentas[$i][3] = $cuentas["serie"]; 
        $arr_cuentas[$i][4] = $cuentas["num_doc"]; 
        $arr_cuentas[$i][5] = strtoupper($cuentas["cliente"]); 
        $arr_cuentas[$i][6] = $cuentas["empleado"]; 
        $arr_cuentas[$i][7] = $cuentas["saldo"]; 
		$arr_cuentas[$i][8] = $cuentas["id_tipdoc"]; 
		$arr_cuentas[$i][9] = $cuentas["movi"]; 
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
  			<tr style="background-color:#CCCCCC" height='20'>
              <td width="80" align="center"><span class="titubuskar0">Fec. Emisión</span></td>
          	  <td width="110" align="center"><span class="titubuskar0">Tipo Doc.</span></td>
          	  <td width="50" align="center"><span class="titubuskar0">Serie</span></td>
              <td width="70" align="center"><span class="titubuskar0">Num. Doc.</span></td>
			  <td width="230" align="center"><span class="titubuskar0">Cliente</span></td>
              <td width="70" align="center"><span class="titubuskar0">Saldo</span></td>
              <td width="70" align="center"><span class="titubuskar0">Tip. Mov.</span></td>
          </tr>
          <?php
		  if (count($arr_cuentas)>0){
		  for($j=0; $j<count($arr_cuentas); $j++){ ?>
         	 <tr id="fila_cancelar<?php echo $arr_cuentas[$j][0]; ?>">
				<td align='center'>
                	<span class='reskar'><?php echo $arr_cuentas[$j][1]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_cuentas[$j][2]; ?></span>
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
				<td align='right'>
                	<span class='reskar' style='margin-right:5px'><?php echo $arr_cuentas[$j][7]; ?></span>
                </td>
                <td align='center'>
                	<span class='reskar' style='margin-right:5px'><?php echo $arr_cuentas[$j][9]; ?></span>
                </td>
			</tr>
		  <?php
          }
		  ?>
          
		  	 <tr height='25'>
				    <td colspan='9' align='center' valign='bottom'>
					    <table style='margin-bottom:4px'>
						   <tr class='paginacion'>
						    <?php if($pag>7){?>
								<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="listar_rep_pendientes('<?php echo ($ini_pag-1); ?>')"><--</div></td>
						    <?php } 
							for($i=$ini_pag; $i<$ini_pag+7; $i++){
							 	if($i <= $num_pag){ ?>
								<td width='15'>
									<?php	
									if($i==$pag){ ?>
									<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="listar_rep_pendientes('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
									<?php	}else{ ?>
									<div class='pagina' style='cursor:pointer' title='Ir a' onclick="listar_rep_pendientes('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                	<?php } ?>
                                </td>
								<?php }
						    }
						  	if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
							<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="listar_rep_pendientes('<?php echo ($ini_pag+7); ?>')">--></div></td>
    						<?php
						    }
                            ?>	  
							
							</tr>
			  	        </table>
					</td>
			    </tr>
                
    		</table>
            <?php }
            ?>
            



