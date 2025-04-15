	<link rel="stylesheet" href="../../stylesglobal.css">	    

	<?php 
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	
	$pag1 = $_REQUEST['pag'];
		
    $res_cliente1 = mysql_query($sql_cliente, $conn);
    
    $total_cliente1 = mysql_num_rows($res_cliente1);
    
	$num_reg1 = 15;
    
    $num_pag1 = ceil($total_cliente1/$num_reg1);
    
    $ini1 = 0;
    
    $ini1 = ($pag1-1)*$num_reg1;
    
    $ini_pag1 = floor(($pag1-1)/7)*7 + 1;
    
    $sql_cliente = $sql_cliente." LIMIT $ini1, $num_reg1";
    
   
    
    $i=0;
    
    while($cliente = mysql_fetch_array($res_cliente1)){
		$arr_cliente[$i][0] = $cliente["id"]; 
		$arr_cliente[$i][1] = $cliente["entidad"]; 
		$arr_cliente[$i][2] = $cliente["motivo"]; 
		
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
          	  <!--<td width="90" align="center"><span class="titubuskar0">Código</span></td>-->
              <td width="70" align="center"><span class="titubuskar0">Nro Control</span></td>
              <td width="300" align="center"><span class="titubuskar0">Clientes</span></td>
          	  <td width="150" align="center"><span class="titubuskar0">Entidad</span></td>
          	  <td width="180" align="center"><span class="titubuskar0">Motivo</span></td>
            
              <td width="55" align="center"><span class="titubuskar0">Editar</span></td>
              
          </tr>
          <?php 
		  for($j=0; $j<count($arr_cliente); $j++){ ?>
         	 <tr id="fila<?php echo $arr_cliente[$j][4]; ?>" >
				<!--<td align='center'>
                	<span class='reskar'><?php echo $arr_cliente[$j][4]; ?></span>
                </td>-->
                <td align='center'>
                	<span class='reskar'><?php echo $arr_cliente[$j][0]; ?></span>
                </td>
				<td align='left'>
                	<span class='reskar'><?php 
					
					
					
					$id_kardex = $arr_cliente[$j][0];
			$consulta_clientes = "SELECT deta_impe.`idimpedido`,CONCAT(cliente.prinom,' ',cliente.segnom,' ',cliente.apepat,' ',cliente.apemat,' ') AS   nombre,cliente.`razonsocial` AS empresa
FROM cliente
INNER JOIN deta_impe ON cliente.`idcliente` = `deta_impe`.`idcliente`
WHERE deta_impe.`idimpedido`= '".$id_kardex."'";

		$ejecuta_clientes= mysql_query($consulta_clientes, $conn);

			while($rowcliente=mysql_fetch_array($ejecuta_clientes)){
			 echo "&nbsp;&nbsp;&nbsp;".holaacentos(strtoupper($rowcliente['nombre'].$rowcliente['empresa']))."<br/>";
			}
					 ?></span>
                </td>
                <td align='center'>
                	<span class='reskar'><?php echo $arr_cliente[$j][1]; ?></span>
                </td>
                <td align='left'>
                	<span class='reskar'><?php echo strtoupper($arr_cliente[$j][2]); ?></span>
                </td>

                <td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/pencil.png"  height="18" width="18" title="Editar" style="cursor:pointer" onclick="modificar_impedido_control('<?php echo $arr_cliente[$j][0]; ?>');mostrar_tachados_m('<?php echo $arr_cliente[$j][0]; ?>')"/>
                    </span>
                </td>
				
			</tr>
            
          <?php
          }
		  ?>
          <tr height='25'>
                <td colspan='9' align='center' valign='bottom'>
                    <table style='margin-bottom:4px'>
                       <tr class='paginacion'>
                        <?php if($pag1>7){?>
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="listar_impedidos('<?php echo ($ini_pag1-1); ?>')"><--</div></td>
                        <?php } 
                        for($i=$ini_pag1; $i<$ini_pag1+7; $i++){
                            if($i <= $num_pag1){ ?>
                            <td width='15'>
                                <?php	
                                if($i==$pag1){ ?>
                                <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="listar_impedidos('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
                                <?php	}else{ ?>
                                <div class='pagina' style='cursor:pointer' title='Ir a' onclick="listar_impedidos('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                <?php } ?>
                            </td>
                            <?php }
                        }
                        if($num_pag1>7 and ($ini_pag1+7)<=$num_pag1){	?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="listar_impedidos('<?php echo ($ini_pag1+7); ?>')">--></div></td>
                        <?php
                        }
                        ?>	  
                        
                        </tr>
                    </table>
              </td>
		 </tr>
	</table>
            
            
           



