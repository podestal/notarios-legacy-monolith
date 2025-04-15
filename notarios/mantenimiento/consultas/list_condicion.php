	<link rel="stylesheet" href="../../stylesglobal.css">	    
	
	<?php 
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    	
	$pag = $_REQUEST['pag'];
	
	$tipo_kardex = $_REQUEST['cond'];
	
	//if(isset($_REQUEST['tipo_kardex'])){$tipo_kardex = $_REQUEST['tipo_kardex'];}
	
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
					  tipokar.nomtipkar as kardex,
					  rol_uif.cod_uif as cod_uif
					  from actocondicion
					  INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = actocondicion.idtipoacto
					  LEFT JOIN rol_uif ON rol_uif.id_uif = actocondicion.uif
					  INNER JOIN tipokar ON tiposdeacto.idtipkar = tipokar.idtipkar ";
	
	if($tipo_kardex<>"" and $tipo_kardex<>0){$sql_condicion = $sql_condicion. " where tiposdeacto.idtipkar= $tipo_kardex";}
	
	$sql_condicion =	$sql_condicion." order by cast(tiposdeacto.idtipkar as signed), tiposdeacto.desacto, actocondicion.condicion asc";
    
    $res_condicion = mysql_query($sql_condicion, $conexion);
    
    $total_condicion = mysql_num_rows($res_condicion);
    
	$num_reg = 10;
    
    $num_pag = ceil($total_condicion/$num_reg);
    
    $ini = 0;
    
    $ini = ($pag-1)*$num_reg;
    
    $ini_pag = floor(($pag-1)/7)*7 + 1;
    
    $sql_condicion = $sql_condicion." LIMIT $ini, $num_reg";
    
    $res_condicion = mysql_query($sql_condicion, $conexion);
    
    $i=0;
    
    while($condicion = mysql_fetch_array($res_condicion)){
		$arr_condicion[$i][0] = $condicion["id_condicion"]; 
		$arr_condicion[$i][1] = $condicion["tip_acto"];         
		$arr_condicion[$i][2] = $condicion["condicion"]; 
		$arr_condicion[$i][3] = $condicion["parte"]; 
		$arr_condicion[$i][4] = $condicion["uif"]; 
		if($condicion["form"]==1){$arr_condicion[$i][5] ="SI";}
		if($condicion["monto"]=='1'){$arr_condicion[$i][6] ="SI";}
		$arr_condicion[$i][7] = $condicion["otorgante"]; 
		$arr_condicion[$i][8] = $condicion["des_acto"]; 
		$arr_condicion[$i][9] = $condicion["tipkar"]; 
		$arr_condicion[$i][10] = $condicion["kardex"]; 
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


	<table width="920" border="1" cellspacing="0" cellpadding="0" >
  		  <tr style="background-color:#CCCCCC">
          	  <td width="140" align="center"><span class="titubuskar0">Tipo Kardex</span></td>
              <td width="270" align="center"><span class="titubuskar0">Tipo Acto</span></td>
          	  <td width="155" align="center"><span class="titubuskar0">Condición</span></td>
          	  <td width="100" align="center"><span class="titubuskar0">Cond. SUNAT</span></td>
              <td width="60" align="center"><span class="titubuskar0">Formulario</span></td>
              <td width="60" align="center"><span class="titubuskar0">Rol UIF</span></td>
			  <td width="60" align="center"><span class="titubuskar0">Monto</span></td>
              <td width="55" align="center"><span class="titubuskar0">Editar</span></td>
              <td width="55" align="center"><span class="titubuskar0">Eliminar</span></td>
          </tr>
          <?php 
		  for($j=0; $j<count($arr_condicion); $j++){ ?>
         	 <tr id="fila<?php echo $arr_condicion[$j][0]; ?>" >
				<td align='center'>
                	<span class='reskar'><?php echo $arr_condicion[$j][10]; ?></span>
                </td>
                <td align='center'>
                	<span class='reskar'><?php echo $arr_condicion[$j][8]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_condicion[$j][2]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php if($arr_condicion[$j][3]==1){echo "TRANSFERENTE";} if($arr_condicion[$j][3]==2){echo "ADQUIRENTE";} ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_condicion[$j][5]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'>
					<?php
					if($arr_condicion[$j][4]=="0" or $arr_condicion[$j][4]==""){ 
						echo "NINGUNO"; 
					}else{
						echo $arr_condicion[$j][4]; 
					}
					?>
                    </span>
                </td>
                <td align='center'>
                	<span class='reskar'><?php echo $arr_condicion[$j][6]; ?></span>
                </td>
                <td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/pencil.png"  height="18" width="18" title="Editar" style="cursor:pointer" onclick="modificar_condicion('<?php echo $arr_condicion[$j][0]; ?>')"/>
                    </span>
                </td>
				<td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/delete.png"  height="18" width="18" title="Eliminar" style="cursor:pointer" onclick="eliminar_condicion('<?php echo $arr_condicion[$j][0]; ?>')"/></span>
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
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="listar_condicion('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                        <?php } 
                        for($i=$ini_pag; $i<$ini_pag+7; $i++){
                            if($i <= $num_pag){ ?>
                            <td width='15'>
                                <?php	
                                if($i==$pag){ ?>
                                <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="listar_condicion('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
                                <?php	}else{ ?>
                                <div class='pagina' style='cursor:pointer' title='Ir a' onclick="listar_condicion('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                <?php } ?>
                            </td>
                            <?php }
                        }
                        if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="listar_condicion('<?php echo ($ini_pag+7); ?>')">--></div></td>
                        <?php
                        }
                        ?>	  
                        
                        </tr>
                    </table>
                </td>
		 </tr>
	</table>
            
            
           



