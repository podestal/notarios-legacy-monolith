<link rel="stylesheet"  href="stylesglobal.css">

<?php 

include('../../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$pag = $_REQUEST['pag'];
$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 

$consulta_testamentos = "SELECT 
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
					   WHERE kardex.idtipkar='5'
					   AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					   AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
					   
$ejecutar_testamentos = mysql_query($consulta_testamentos, $conexion);

$total_testamentos = mysql_num_rows($ejecutar_testamentos);

$num_reg = 10;

$num_pag = ceil($total_testamentos/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_testamentos = $consulta_testamentos." ORDER BY cliente ASC LIMIT $ini, $num_reg";

$ejecutar_testamentos = mysql_query($consulta_testamentos, $conexion);

$i=0;

while($testamentos = mysql_fetch_array($ejecutar_testamentos)){

	$arr_testamentos[$i][0] = $testamentos["cliente"]; 
	$arr_testamentos[$i][1] = $testamentos["fechaescritura"]; 
	$arr_testamentos[$i][2] = $testamentos["kardex"]; 
	$arr_testamentos[$i][3] = $testamentos["contrato"]; 
	$arr_testamentos[$i][4] = $testamentos["numescritura"]; 
	$arr_testamentos[$i][5] = $testamentos["numminuta"]; 
	$arr_testamentos[$i][6] = $testamentos["folioini"]; 
	$i++; 
	
}

?>

	<table width='835' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>
			<tr bgcolor="#CCCCCC" height="30">
               <td width="200" align="center"><span class="Estilo14">Contratantes</span></td>
               <td width="75" align="center"><span class="Estilo14">Fecha  escr.</span></td>
               <td width="75" align="center"><span class="Estilo14">kardex</span></td>
               <td width="250" align="center"><span class="Estilo14">Acto</span></td>
               <td width="75" align="center"><span class="Estilo14">Nº Acta</span></td>
               <td width="75" align="center"><span class="Estilo14">Nº Folio</span></td>
            </tr>
			<?php
            for($j=0; $j<count($arr_testamentos); $j++) { 
            ?>	
		    <tr height='auto'>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_testamentos[$j][0]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo fechabd_an($arr_testamentos[$j][1]); ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_testamentos[$j][2]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_testamentos[$j][3]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_testamentos[$j][4]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_testamentos[$j][6]; ?></span></td>
		    </tr>
  		    <?php 
            }
            ?>
    		<tr height='25'>
                <td colspan='7' align='center' valign='bottom'>
                    <table style='margin-bottom:4px'>
                       <tr class='paginacion'>
                        <?php if($pag>7){?>
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_testamentos('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                        <?php } 
                        for($i=$ini_pag; $i<$ini_pag+7; $i++){
                            if($i <= $num_pag){ ?>
                            <td width='15'>
                                <?php	
                                if($i==$pag){ ?>
                                <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_testamentos('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
                                <?php	}else{ ?>
                                <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_testamentos('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                <?php } ?>
                            </td>
                            <?php }
                        }
                        if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_testamentos('<?php echo ($ini_pag+7); ?>')">--></div></td>
                        <?php
                        }
                        ?>	  
                        </tr>
                    </table>
                </td>
             </tr>
    
    </table>






