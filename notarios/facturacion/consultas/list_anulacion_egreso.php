	<link rel="stylesheet" href="../../stylesglobal.css">	    

	<?php 
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
    $a_tipodocu = $_REQUEST['a_tipcomp'];
    $a_serie = $_REQUEST['a_serie'];
    $a_doic = $_REQUEST['a_doic'];
    $a_cliente = $_REQUEST['a_cliente'];
    
    if(isset($_REQUEST['pag'])){
        $pag = $_REQUEST['pag'];	
    }else{
        $pag = 1;
    }
    
    $sql_cuentas = "SELECT 
     tb_egreso.c_c_egreso AS id,
     tb_egreso.ddt_fecha AS fecha,
     tb_egreso.c_tipo_documento AS tipo_docu,
     tb_egreso.c_numero_comprobante AS serie,
     (CASE WHEN IFNULL(tb_proveedor.`razonsocial`,'')='' THEN tb_proveedor.`nombre` ELSE tb_proveedor.`razonsocial` END ) AS cliente,
     tb_egreso.d_monto AS total,
     tip_documen_egreso.des_docum AS des_comp,
     tb_egreso.b_estado AS estado,tb_proveedor.numdoc AS numdoc
     FROM tb_egreso
     INNER JOIN tip_documen_egreso ON  tip_documen_egreso.id_documen= tb_egreso.c_tipo_documento
     INNER JOIN tb_proveedor ON tb_proveedor.idproveedor=tb_egreso.c_participante";
    
    
    if($a_tipodocu<>"" and $a_serie==""  and $a_cliente==""){
        $sql_cuentas =	$sql_cuentas." where tb_egreso.c_tipo_documento = $a_tipodocu";
    }
    
    if($a_tipodocu=="" and $a_serie<>""  and $a_cliente==""){
        $sql_cuentas =	$sql_cuentas." where tb_egreso.c_numero_comprobante = $a_serie";	
    }
    /*
    if($a_tipodocu=="" and $a_serie=="" and $a_doic<>"" and $a_cliente==""){
        $sql_cuentas =	$sql_cuentas." where m_regventas.factura = $a_doic";		
    }
    */
    if($a_tipodocu=="" and $a_serie=="" and $a_cliente<>""){
        $sql_cuentas =	$sql_cuentas." where (CASE WHEN IFNULL(tb_proveedor.`razonsocial`,'')='' THEN tb_proveedor.`nombre` ELSE tb_proveedor.`razonsocial` END ) like '%$a_cliente%'";
    }
    
    
    
    
    if($a_tipodocu<>"" and $a_serie<>"" and $a_cliente==""){
        $sql_cuentas =	$sql_cuentas." where tb_egreso.c_tipo_documento = $a_tipodocu and    tb_egreso.c_numero_comprobante = $a_serie";	
    }
    
       
    if($a_tipodocu<>"" and $a_serie=="" and $a_cliente<>""){
        $sql_cuentas =	$sql_cuentas." where tb_egreso.c_tipo_documento = $a_tipodocu and (CASE WHEN IFNULL(tb_proveedor.`razonsocial`,'')='' THEN tb_proveedor.`nombre` ELSE tb_proveedor.`razonsocial` END ) like '%$a_cliente%'";
    }
    
   
    $sql_cuentas =	$sql_cuentas." ORDER BY tb_egreso.ddt_fecha desc, tb_egreso.c_tipo_documento asc";
    
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
//        $arr_cuentas[$i][0] = fechabd_an($cuentas["fecha"]); 
        $arr_cuentas[$i][0] = $cuentas["fecha"]; 
        $arr_cuentas[$i][1] = $cuentas["des_comp"]; 
        $arr_cuentas[$i][2] = $cuentas["serie"]; 
        $arr_cuentas[$i][3] = $cuentas["numdoc"]; 
        $arr_cuentas[$i][4] = strtoupper($cuentas["cliente"]); 
        $arr_cuentas[$i][5] = $cuentas["total"]; 
        $arr_cuentas[$i][6] = $cuentas["estado"]; 
        $arr_cuentas[$i][7] = $cuentas["id"]; 
		$arr_cuentas[$i][8] = $cuentas["tipo_docu"]; 
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

	<table width="850" border="1" cellspacing="0" cellpadding="0" align="center">
  			<tr style="background-color:#CCCCCC">
              <td width="80" align="center"><span class="titubuskar0">Fec. Emisión</span></td>
          	  <td width="110" align="center"><span class="titubuskar0">Tipo Doc.</span></td>
          	  <td width="50" align="center"><span class="titubuskar0">Serie</span></td>
              <td width="70" align="center"><span class="titubuskar0">Num. Doc.</span></td>
			  <td width="230" align="center"><span class="titubuskar0">Cliente</span></td>
              <td width="70" align="center"><span class="titubuskar0">Imp.Total</span></td>
              <td width="80" align="center"><span class="titubuskar0">Estado</span></td>
              <td width="65" align="center"><span class="titubuskar0">Anular</span></td>
          </tr>
          <?php
		  if (count($arr_cuentas)>0){
		  for($j=0; $j<count($arr_cuentas); $j++){ ?>
         	 <tr>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_cuentas[$j][0]; ?></span>
                </td>
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
				<td align='right'>
                	<span class='reskar' style='margin-right:5px'><?php echo $arr_cuentas[$j][5]; ?></span>
                </td>
                <td align='center'><span class='reskar'>
				<?php
				//if($arr_cuentas[$j][6]!=''){
					
					if ($arr_cuentas[$j][6]=='1'){
					echo "ACTIVO";
					}
					else
					{
						echo "ANULADO";
						}
				//}
				?>
				</span></td>
                
                               
				<td align='center'>
                <?php
				if($arr_cuentas[$j][6]=='1'){
				?>	
				<a href='#' onclick="desactivar_venta('<?php echo $arr_cuentas[$j][8];?>', '<?php echo $arr_cuentas[$j][2];?>', '<?php echo $arr_cuentas[$j][3];?>', '<?php echo $arr_cuentas[$j][7];?>')" title="Desactivar"><img src='../../images/delete.png' width='16' height='18'></a>			
				<?php
				} 
				?>										  
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
								<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="listar_anular('<?php echo ($ini_pag-1); ?>')"><--</div></td>
						    <?php } 
							for($i=$ini_pag; $i<$ini_pag+7; $i++){
							 	if($i <= $num_pag){ ?>
								<td width='15'>
									<?php	
									if($i==$pag){ ?>
									<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="listar_anular('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
									<?php	}else{ ?>
									<div class='pagina' style='cursor:pointer' title='Ir a' onclick="listar_anular('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                	<?php } ?>
                                </td>
								<?php }
						    }
						  	if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
							<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="listar_anular('<?php echo ($ini_pag+7); ?>')">--></div></td>
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
            
            <div id="div_login" style="background-color:#DDECF7; width:300px; height:auto; border-radius: 10px; border-color:#DDECF7; position:absolute; left:290px; top:190px; display:none">
                
            </div>
            
            
          
            
            <div id="valorusuario"><input id="valorusu" name="valorusu" type="hidden" /></div>
        



