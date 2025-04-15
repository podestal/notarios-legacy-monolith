<link rel="stylesheet" href="../../stylesglobal.css">	    

	<?php 
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$pag = $_REQUEST['pag'];
	
	$numeroDocumento = trim($_REQUEST['numeroDocumento']);
	
					
	$sql_cliente = "SELECT presentante.idPresentante,presentante.apellidoPaterno,presentante.apellidoMaterno,CONCAT(presentante.primerNombre,' ',presentante.segundoNombre,IF(presentante.tercerNombre IS NULL , ' ',presentante.tercerNombre)) AS nombres, presentante.numeroDocumento FROM presentante ";
	
	
	if($numeroDocumento<>"" ){
		$sql_cliente =	$sql_cliente." where presentante.numeroDocumento like '%$numeroDocumento%'";
	}
	
   // die($sql_cliente);



    $sql_cliente =	$sql_cliente."order by presentante.idPresentante desc  ";
	
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

        $row["apellidoPaterno"] =  strtoupper(simbolos($row["apellidoPaterno"]));
        $row["apellidoMaterno"]   =  strtoupper(simbolos($row["apellidoMaterno"]));
        $row["nombres"]   =  strtoupper(simbolos($row["nombres"]));
        $row["numeroDocumento"]   =  strtoupper(simbolos($row["numeroDocumento"]));
        $data[] = $row;

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
              <td width="70" align="center"><span class="titubuskar0">N°</span></td>
              <td width="300" align="center"><span class="titubuskar0">Apellido Paterno</span></td>
          	  <td width="230" align="center"><span class="titubuskar0">Apellido Materno</span></td>
          	  <td width="100" align="center"><span class="titubuskar0">Nombres</span></td>
              <td width="60" align="center"><span class="titubuskar0">Documento</span></td>
              <td width="55" align="center"><span class="titubuskar0">Editar</span></td>
              <td width="55" align="center"><span class="titubuskar0">Eliminar</span></td>
          </tr>
          <?php

        //  var_dump($data);
         // exit();

		  foreach ($data as $key => $presentante){ ?>

         	 <tr id="fila<?php echo $presentante['idPresentante']; ?>" >

                <td align='center'>
                	<span class='reskar'><?php echo $presentante['idPresentante']; ?></span>
                </td>
				<td align='center'>
                	<span class='reskar'><?php echo $presentante['apellidoPaterno']; ?></span></td>
                <td align='center'>
                	<span class='reskar'><?php echo $presentante['apellidoMaterno']; ?></span>
                </td>
                <td align='center'>
                	<span class='reskar'><?php echo $presentante['nombres']; ?></span>
                </td>
                <td align='center'>
                	<span class='reskar'><?php echo $presentante['numeroDocumento']; ?></span>
                </td>
                
                <td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/pencil.png"  height="18" width="18" title="Editar" style="cursor:pointer" onclick="modificar_presentante('<?php echo $presentante['idPresentante']; ?>')"/>
                    </span>
                </td>
				<td align='center'>
                	<span class='reskar' style='margin-right:5px'>
                    <img src="../../images/delete.png"  height="18" width="18" title="Eliminar" style="cursor:pointer" onclick="open_login('<?php echo $presentante['idPresentante']; ?>')" /></span>
                    
                    <!--onclick="eliminar_cliente('<?php echo $arr_cliente[$j][0]; ?>')-->
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
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="listar_presentante('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                        <?php } 
                        for($i=$ini_pag; $i<$ini_pag+7; $i++){
                            if($i <= $num_pag){ ?>
                            <td width='15'>
                                <?php	
                                if($i==$pag){ ?>
                                <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="listar_presentante('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
                                <?php	}else{ ?>
                                <div class='pagina' style='cursor:pointer' title='Ir a' onclick="listar_presentante('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                <?php } ?>
                            </td>
                            <?php }
                        }
                        if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="listar_presentante('<?php echo ($ini_pag+7); ?>')">--></div></td>
                        <?php
                        }
                        ?>	  
                        </tr>
                    </table>
              </td>
		 </tr>
	</table>
            
            
           



