	<link rel="stylesheet" href="../../stylesglobal.css">	    

	<?php 
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$pag = $_REQUEST['pag'];
	
	$tipo_kardex = $_REQUEST['actos'];
	
	//if(isset($_REQUEST['tipo_kardex'])){$tipo_kardex = $_REQUEST['tipo_kardex'];}
	
	$sql_tipo_acto = "select 
					  tiposdeacto.idtipoacto as cod_acto,
					  tiposdeacto.actosunat as cod_sunat,
					  tiposdeacto.actouif as cod_uif,
					  tiposdeacto.idtipkar as id_tipkar,
					  tiposdeacto.desacto as acto,
					  tiposdeacto.umbral as umbral,
					  tipokar.nomtipkar as des_tipkar
					  from tiposdeacto
					  inner join tipokar on tipokar.idtipkar = tiposdeacto.idtipkar";
	
	if($tipo_kardex<>"" and $tipo_kardex<>0){$sql_tipo_acto = $sql_tipo_acto. " where tiposdeacto.idtipkar= $tipo_kardex";}
	
	$sql_tipo_acto =	$sql_tipo_acto." order by tiposdeacto.desacto asc";
    
    $res_tipo_acto = mysql_query($sql_tipo_acto, $conexion);
    
    $total_tipo_acto = mysql_num_rows($res_tipo_acto);
    
	$num_reg = 15;
    
    $num_pag = ceil($total_tipo_acto/$num_reg);
    
    $ini = 0;
    
    $ini = ($pag-1)*$num_reg;
    
    $ini_pag = floor(($pag-1)/7)*7 + 1;
    
    $sql_tipo_acto = $sql_tipo_acto." LIMIT $ini, $num_reg";
    
    $res_tipo_acto = mysql_query($sql_tipo_acto, $conexion);
    
    $i=0;
    
    while($tipo_acto = mysql_fetch_array($res_tipo_acto)){
		
		$arr_tipo_acto[$i][0] = $tipo_acto["cod_acto"]; 
		$arr_tipo_acto[$i][1] = $tipo_acto["cod_sunat"];         
        $arr_tipo_acto[$i][2] = $tipo_acto["cod_uif"]; 
		$arr_tipo_acto[$i][3] = $tipo_acto["id_tipkar"]; 
        $arr_tipo_acto[$i][4] = strtoupper($tipo_acto["des_tipkar"]); 
        $arr_tipo_acto[$i][5] = strtoupper($tipo_acto["acto"]); 
        $arr_tipo_acto[$i][6] = $tipo_acto["umbral"]; 
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


	<table width="820" border="1" cellspacing="0" cellpadding="0" >
  		  <tr style="background-color:#CCCCCC">
              <td width="50" align="center"><span class="titubuskar0">Cod. Acto</span></td>
          	  <td width="55" align="center"><span class="titubuskar0">Cod. Sunat</span></td>
          	  <td width="50" align="center"><span class="titubuskar0">Cod. UIF</span></td>
              <td width="190" align="center"><span class="titubuskar0">Tip. Kardex</span></td>
              <td width="325" align="center"><span class="titubuskar0">Descripción</span></td>
			  <td width="50" align="center"><span class="titubuskar0">Umbral</span></td>
              <td width="50" align="center"><span class="titubuskar0">Editar</span></td>
              <td width="50" align="center"><span class="titubuskar0">Eliminar</span></td>
          </tr>
          <?php 
		  for($j=0; $j<count($arr_tipo_acto); $j++){ ?>
         	 <tr id="fila<?php echo $arr_tipo_acto[$j][0]; ?>" >
				<td align='center'>
                	<span class='reskar'><?php echo $arr_tipo_acto[$j][0]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_tipo_acto[$j][1]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_tipo_acto[$j][2]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_tipo_acto[$j][4]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_tipo_acto[$j][5]; ?></span>
                </td>
                <td align='center'>
                	<span class='reskar'><?php if($arr_tipo_acto[$j][6]<>0){echo $arr_tipo_acto[$j][6];} ?></span>
                </td>
                <td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/pencil.png"  height="18" width="18" title="Editar" style="cursor:pointer" onclick="modificar_acto('<?php echo $arr_tipo_acto[$j][0]; ?>')"/>
                    </span>
                </td>
				<td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/delete.png"  height="18" width="18" title="Eliminar" style="cursor:pointer" onclick="eliminar_acto('<?php echo $arr_tipo_acto[$j][0]; ?>')"/></span>
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
								<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="listar_tipactos('<?php echo ($ini_pag-1); ?>')"><--</div></td>
						    <?php } 
							for($i=$ini_pag; $i<$ini_pag+7; $i++){
							 	if($i <= $num_pag){ ?>
								<td width='15'>
									<?php	
									if($i==$pag){ ?>
									<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="listar_tipactos('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
									<?php	}else{ ?>
									<div class='pagina' style='cursor:pointer' title='Ir a' onclick="listar_tipactos('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                	<?php } ?>
                                </td>
								<?php }
						    }
						  	if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
							<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="listar_tipactos('<?php echo ($ini_pag+7); ?>')">--></div></td>
    						<?php
						    }
                            ?>	  
							
							</tr>
			  	        </table>
					</td>
			    </tr>
	</table>
            
            
           



