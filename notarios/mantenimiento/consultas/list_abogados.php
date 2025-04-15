	<link rel="stylesheet" href="../../stylesglobal.css">	    

	<?php 
    
    include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
    
	$pag = $_REQUEST['pag'];
	
	$desc = $_REQUEST['desc'];
	
	$sql_servicios = "SELECT * FROM  `estudioabogado` ";
	
	if($desc<>""){$sql_servicios =  $sql_servicios." where nombre like '%$desc%'";}
	
	$sql_servicios = $sql_servicios." ORDER BY nombre ASC";
    
    $exe_servicios = mysql_query($sql_servicios, $conexion);
    
    $total_servicios = mysql_num_rows($exe_servicios);
    
	$num_reg = 10;
    
    $num_pag = ceil($total_servicios/$num_reg);
    
    $ini = 0;
    
    $ini = ($pag-1)*$num_reg;
    
    $ini_pag = floor(($pag-1)/7)*7 + 1;
    
    $sql_servicios = $sql_servicios." LIMIT $ini, $num_reg";
    
    $exe_servicios = mysql_query($sql_servicios, $conexion);
    
    $i=0;
    
    while($servicios = mysql_fetch_array($exe_servicios)){
		$arr_servicios[$i][1] = $servicios["nombre"]; 
		$arr_servicios[$i][2] = $servicios["direccion"];   
		$arr_servicios[$i][3] = $servicios["telefono"]; 
		$arr_servicios[$i][5] = $servicios["correo"]; 
		$arr_servicios[$i][4] = $servicios["colegiatura"]; 
		$arr_servicios[$i][0] = $servicios["idest"]; 
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
	.Estilo7 {font-family: Calibri; font-size: 13px; font-style: italic; }
    -->
    </style>

	<table cellpadding="0" cellspacing="0">
         <tr>
            <td height="76">
            	<form id="frm_servicio" name="frm_servicio">
                <table width="548">
                    <tr>
                        <td height="28" colspan="2"><span class="reskar2">Búsqueda por:</span></td>
                    </tr>
                    <tr>
                        <td width="68"><span class="titubuskar0">Nombre:</span></td>
                        <td width="352"><input id="desc" name="desc" type="text" style="width:350px" maxlength="200" /></td>
                        <td width="112"><input value="Buscar" type="button" style="width:80px" class="Estilo7" onClick="listar_servicios(1)" /></td>
                    </tr>
                </table>
                </form>
            </td>
      </tr>	
    
        <tr>
            <td>
                <table width="860" border="1" cellspacing="0" cellpadding="0" >
                        <tr style="background-color:#CCCCCC">
                          <td width="320" align="center"><span class="titubuskar0">Nombre</span></td>
                          <td width="100" align="center"><span class="titubuskar0">Direccion</span></td>
                          <td width="100" align="center"><span class="titubuskar0">Telefono</span></td>
                          <td width="100" align="center"><span class="titubuskar0">Colegiatura</span></td>
                          <td width="100" align="center"><span class="titubuskar0">Correo</span></td>
                          <td width="70" align="center"><span class="titubuskar0">Editar</span></td>
                          <td width="70" align="center"><span class="titubuskar0">Eliminar</span></td>
                      </tr>
                      <?php 
                      for($j=0; $j<count($arr_servicios); $j++){ ?>
                         <tr id="fila<?php echo $arr_servicios[$j][0]; ?>" >
                            <td align='center'>
                                <span class='reskar'><?php echo strtoupper($arr_servicios[$j][1]); ?></span>
                            </td>
                            <td align='center'>
                                 <span class='reskar'><?php echo strtoupper($arr_servicios[$j][2]); ?></span>
                            </td>
                            <td align='center'>
                                <span class='reskar'><?php echo strtoupper($arr_servicios[$j][3]); ?></span>
                            </td>
                            <td align='center'>
                                <span class='reskar'><?php echo strtoupper($arr_servicios[$j][4]); ?></span>
                            </td>
                            <td align='center'>
                                <span class='reskar'><?php echo $arr_servicios[$j][5]; ?></span>
                            </td>
                            <td align='center'>
                                <span class='reskar' style='margin-right:5px'>
                                <img src="../../images/pencil.png"  height="18" width="18" title="Editar" style="cursor:pointer" onclick="modificar_servicio('<?php echo $arr_servicios[$j][0]; ?>')"/>
                                </span>
                            </td>
                            <td align='center'>
                                <span class='reskar' style='margin-right:5px'>
                                <img src="../../images/delete.png"  height="18" width="18" title="Eliminar" style="cursor:pointer" onclick="eliminar_servicio('<?php echo $arr_servicios[$j][0]; ?>')"/></span>
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
                                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="listar_servicios('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                                    <?php } 
                                    for($i=$ini_pag; $i<$ini_pag+7; $i++){
                                        if($i <= $num_pag){ ?>
                                        <td width='15'>
                                            <?php	
                                            if($i==$pag){ ?>
                                            <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="listar_servicios('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
                                            <?php	}else{ ?>
                                            <div class='pagina' style='cursor:pointer' title='Ir a' onclick="listar_servicios('<?php echo $i; ?>')"><?php echo $i; ?></div>
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
            </td>
        </tr>
    </table>
            
            
           



