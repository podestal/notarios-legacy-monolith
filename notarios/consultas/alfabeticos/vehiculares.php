<link rel="stylesheet"  href="stylesglobal.css">

<?php 

include('../../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$pag = $_REQUEST['pag'];
$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 

$consulta_vehicular = "SELECT 
					   UPPER((CASE WHEN (cliente2.tipper='N') THEN CONCAT(cliente2.apepat,' ',cliente2.apemat,' ',cliente2.prinom,' ',cliente2.segnom) ELSE cliente2.razonsocial END)) AS 'cliente',
					   kardex.fechaescritura, 
					   kardex.kardex,
  					   kardex.contrato, 
					   kardex.numescritura, 
					   kardex.numminuta, 
					   kardex.folioini
					   FROM kardex
					   INNER JOIN contratantes ON contratantes.kardex = kardex.kardex AND contratantes.indice='1'
					   INNER  JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante 
					   WHERE kardex.idtipkar='3'
					   AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					   AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
					   
$ejecutar_vehicular = mysql_query($consulta_vehicular, $conexion);

$total_vehicular = mysql_num_rows($ejecutar_vehicular);

$num_reg = 10;

$num_pag = ceil($total_vehicular/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_vehicular = $consulta_vehicular." ORDER BY cliente ASC LIMIT $ini, $num_reg";

$ejecutar_vehicular = mysql_query($consulta_vehicular, $conexion);

$i=0;

while($vehicular = mysql_fetch_array($ejecutar_vehicular)){

	$arr_vehicular[$i][0] = $vehicular["cliente"]; 
	$arr_vehicular[$i][1] = $vehicular["fechaescritura"]; 
	$arr_vehicular[$i][2] = $vehicular["kardex"]; 
	$arr_vehicular[$i][3] = $vehicular["contrato"]; 
	$arr_vehicular[$i][4] = $vehicular["numescritura"]; 
	$arr_vehicular[$i][5] = $vehicular["numminuta"]; 
	$arr_vehicular[$i][6] = $vehicular["folioini"]; 
	$i++; 
	
}

?>

	<table width='835' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>
			<tr bgcolor="#CCCCCC" height="30">
               <td width="200" align="center"><span class="Estilo14">Contratantes</span></td>
               <td width="75" align="center"><span class="Estilo14">Fecha  escr.</span></td>
               <td width="75" align="center"><span class="Estilo14">kardex</span></td>
               <td width="275" align="center"><span class="Estilo14">Acto</span></td>
               <td width="100" align="center"><span class="Estilo14">Nº Acta</span></td>
               <td width="100" align="center"><span class="Estilo14">Nº Folio</span></td>
            </tr>
			<?php
            for($j=0; $j<count($arr_vehicular); $j++) { 
            ?>	
		    <tr height='auto'>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_vehicular[$j][0]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo fechabd_an($arr_vehicular[$j][1]); ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_vehicular[$j][2]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_vehicular[$j][3]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_vehicular[$j][4]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_vehicular[$j][6]; ?></span></td>
		    </tr>
  		    <?php 
            }
            ?>
    		<tr height='25'>
                <td colspan='7' align='center' valign='bottom'>
                    <table style='margin-bottom:4px'>
                       <tr class='paginacion'>
                        <?php if($pag>7){?>
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_vehiculares('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                        <?php } 
                        for($i=$ini_pag; $i<$ini_pag+7; $i++){
                            if($i <= $num_pag){ ?>
                            <td width='15'>
                                <?php	
                                if($i==$pag){ ?>
                                <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_vehiculares('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
                                <?php	}else{ ?>
                                <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_vehiculares('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                <?php } ?>
                            </td>
                            <?php }
                        }
                        if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_vehiculares('<?php echo ($ini_pag+7); ?>')">--></div></td>
                        <?php
                        }
                        ?>	  
                        </tr>
                    </table>
                </td>
             </tr>
    
    </table>






