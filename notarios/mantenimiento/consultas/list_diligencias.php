	<link rel="stylesheet" href="../../stylesglobal.css">	    

	<?php 
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$pag = $_REQUEST['pag'];
	
	$sql_diligencias = "SELECT
						diligencia_protesto.id_diligenciap,
						diligencia_protesto.des_diligenciap,
						diligencia_protesto.cont_diligenciap
						FROM
						diligencia_protesto";
	
	$sql_diligencias =	$sql_diligencias." order by diligencia_protesto.des_diligenciap asc";
    
    $exe_diligencias = mysql_query($sql_diligencias, $conexion);
    
    $total_diligencias = mysql_num_rows($exe_diligencias);
    
	$num_reg = 10;
    
    $num_pag = ceil($total_diligencias/$num_reg);
    
    $ini = 0;
    
    $ini = ($pag-1)*$num_reg;
    
    $ini_pag = floor(($pag-1)/7)*7 + 1;
    
    $sql_sello = $sql_sello." LIMIT $ini, $num_reg";
    
    $exe_diligencias = mysql_query($sql_diligencias, $conexion);
    
    $i=0;
    
    while($diligencias = mysql_fetch_array($exe_diligencias)){
		$arr_diligencias[$i][0] = $diligencias["id_diligenciap"]; 
		$arr_diligencias[$i][1] = strtoupper($diligencias["des_diligenciap"]);         
		$arr_diligencias[$i][2] = $diligencias["cont_diligenciap"]; 
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


	<table width="900" border="1" cellspacing="0" cellpadding="0" >
  		  <tr style="background-color:#CCCCCC">
          	  <td width="70" align="center"><span class="titubuskar0">Código</span></td>
              <td width="120" align="center"><span class="titubuskar0">Descripción</span></td>
          	  <td width="600" align="center"><span class="titubuskar0">Contenido</span></td>
              <td width="55" align="center"><span class="titubuskar0">Editar</span></td>
              <td width="55" align="center"><span class="titubuskar0">Eliminar</span></td>
          </tr>
          <?php 
		  for($j=0; $j<count($arr_diligencias); $j++){ ?>
         	 <tr id="fila<?php echo $arr_diligencias[$j][0]; ?>" >
				<td align='center'>
                	<span class='reskar'><?php echo $arr_diligencias[$j][0]; ?></span>
                </td>
                <td align='center'>
                	<span class='reskar'><?php echo $arr_diligencias[$j][1]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $arr_diligencias[$j][2]; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/pencil.png"  height="18" width="18" title="Editar" style="cursor:pointer" onclick="modificar_diligencia('<?php echo $arr_diligencias[$j][0]; ?>')"/>
                    </span>
                </td>
				<td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/delete.png"  height="18" width="18" title="Eliminar" style="cursor:pointer" onclick="eliminar_diligencia('<?php echo $arr_diligencias[$j][0]; ?>')"/></span>
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
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="listar_diligencias('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                        <?php } 
                        for($i=$ini_pag; $i<$ini_pag+7; $i++){
                            if($i <= $num_pag){ ?>
                            <td width='15'>
                                <?php	
                                if($i==$pag){ ?>
                                <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="listar_diligencias('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
                                <?php	}else{ ?>
                                <div class='pagina' style='cursor:pointer' title='Ir a' onclick="listar_diligencias('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                <?php } ?>
                            </td>
                            <?php }
                        }
                        if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="listar_diligencias('<?php echo ($ini_pag+7); ?>')">--></div></td>
                        <?php
                        }
                        ?>	  
                        
                        </tr>
                    </table>
                </td>
		 </tr>
	</table>
            
            
           



