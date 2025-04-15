<link rel="stylesheet" href="../../stylesglobal.css">	    

	<?php 
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$pag = $_GET['page'];
	
	$fkTypeKardex = $_GET['fkTypeKardex'];
    $nameTemplate = $_GET['nameTemplate'];
	
					
	$sql_cliente = "SELECT tpl_template.pkTemplate,tpl_template.nameTemplate,tipokar.nomtipkar,tpl_template.fkTypeKardex,tipokar.nomtipkar,tpl_template.codeActs,tpl_template.contract,tpl_template.urlTemplate,fileName FROM tpl_template INNER JOIN tipokar ON tpl_template.fkTypeKardex = tipokar.idtipkar  ";
	
	$sql_cliente = $sql_cliente . " WHERE tpl_template.statusRegister = '1' ";
	if($fkTypeKardex != 0){
		$sql_cliente =	$sql_cliente." AND tpl_template.fkTypeKardex  = '$fkTypeKardex'";
	}
    if($nameTemplate != ''){
        $sql_cliente =  $sql_cliente." AND tpl_template.nameTemplate LIKE '%$nameTemplate%'";
    }
	
   // die($sql_cliente);



    $sql_cliente =	$sql_cliente."order by tpl_template.pkTemplate desc  ";
	
    $res_cliente = mysql_query($sql_cliente, $conexion);
    
    $total_cliente = mysql_num_rows($res_cliente);
    
	$num_reg = 15;
    
    $num_pag = ceil($total_cliente/$num_reg);
    
    $ini = 0;
    
    $ini = ($pag-1)*$num_reg;
    
    $ini_pag = floor(($pag-1)/7)*7 + 1;
    
    $sql_cliente = $sql_cliente." LIMIT $ini, $num_reg";
    
    $res_cliente = mysql_query($sql_cliente, $conexion);
    
    $i=0;
    
    $data = array();
    while($row = mysql_fetch_array($res_cliente)){
        $data[] = $row;

    }

	?>

	<!--<script type="text/javascript" src="../includes/Mantenimientos.js"></script>-->
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
              <td width="200" align="center"><span class="titubuskar0">Tipo de Kardex</span></td>
              <td width="300" align="center"><span class="titubuskar0">Nombre Plantilla</span></td>
          	  <td width="300" align="center"><span class="titubuskar0">Actos</span></td>
              <td width="60" align="center"><span class="titubuskar0">Ruta Plantilla</span></td>
              <td width="60" align="center"><span class="titubuskar0">Descagar</span></td>
              <td width="55" align="center"><span class="titubuskar0">Adj. Plantilla</span></td>
              <td width="55" align="center"><span class="titubuskar0">Editar</span></td>
              <td width="55" align="center"><span class="titubuskar0">Eliminar</span></td>

          </tr>
          <?php

        //  var_dump($data);
         // exit();

		  foreach ($data as $key => $plantilla){ ?>

         	 <tr id="fila<?php echo $plantilla['pkTemplate']; ?>" >

                <td align='center'>
                	<span class='reskar'><?php echo $plantilla['nomtipkar']; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $plantilla['nameTemplate']; ?></span></td>
                <td align='center'>
                	<span class='reskar'><?php echo $plantilla['contract']; ?></span>
                </td>
                <td align='center'>
                	<span class='reskar'><?php echo $plantilla['urlTemplate'].$plantilla['fileName']; ?></span>
                </td>

                <td align='center'>
                    <span class='reskar' style='margin-right:5px'>
                    <a href="../consultas/download_template.php?pkTemplate=<?php echo $plantilla['pkTemplate'];?>">
                        <img src="../../images/descagar.png"  height="25" width="25" title="Adjuntar">
                    </a>
                    </span>
                </td>

                <td align='center'>
                    <span class='reskar' style='margin-right:5px'>
                    <img src="../../images/adjuntar.jpg"  height="20" width="20" title="Adjuntar" style="cursor:pointer" onclick="showFrmAdjuntarTemplate('<?php echo $plantilla['pkTemplate']; ?>')"/>
                    </span>
                </td>
                
                <td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/pencil.png"  height="18" width="18" title="Editar" style="cursor:pointer" onclick="showFrmEditTemplate('<?php echo $plantilla['pkTemplate']; ?>')"/>
                    </span>
                </td>
				<td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/delete.png"  height="18" width="18" title="Eliminar" style="cursor:pointer" onclick="openLogin('<?php echo $plantilla['pkTemplate']; ?>')" /></span>
                    
                  
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
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="listarPlantilla('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                        <?php } 
                        for($i=$ini_pag; $i<$ini_pag+7; $i++){
                            if($i <= $num_pag){ ?>
                            <td width='15'>
                                <?php	
                                if($i==$pag){ ?>
                                <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="listarPlantilla('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
                                <?php	}else{ ?>
                                <div class='pagina' style='cursor:pointer' title='Ir a' onclick="listarPlantilla('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                <?php } ?>
                            </td>
                            <?php }
                        }
                        if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="listarPlantilla('<?php echo ($ini_pag+7); ?>')">--></div></td>
                        <?php
                        }
                        ?>	  
                        </tr>
                    </table>
              </td>
		 </tr>
	</table>
            
            
           



