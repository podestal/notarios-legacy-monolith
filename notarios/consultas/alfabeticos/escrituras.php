<link rel="stylesheet"  href="stylesglobal.css">

<?php 

include('../../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$pag = $_REQUEST['pag'];
$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 

$consulta_escritura = "SELECT 
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
					   WHERE kardex.idtipkar='1'
					   AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					   AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
					   
$ejecutar_escritura = mysql_query($consulta_escritura, $conexion);

$total_escritura = mysql_num_rows($ejecutar_escritura);

$num_reg = 10;

$num_pag = ceil($total_escritura/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_escritura = $consulta_escritura." ORDER BY cliente ASC LIMIT $ini, $num_reg";

$ejecutar_escritura = mysql_query($consulta_escritura, $conexion);

$i=0;

while($escritura = mysql_fetch_array($ejecutar_escritura)){

	$arr_escritura[$i][0] = $escritura["cliente"]; 
	$arr_escritura[$i][1] = $escritura["fechaescritura"]; 
	$arr_escritura[$i][2] = $escritura["kardex"]; 
	$arr_escritura[$i][3] = $escritura["contrato"]; 
	$arr_escritura[$i][4] = $escritura["numescritura"]; 
	$arr_escritura[$i][5] = $escritura["numminuta"]; 
	$arr_escritura[$i][6] = $escritura["folioini"]; 
	$i++; 
	
}

?>

	<table width='835' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>
			<tr bgcolor="#CCCCCC" height="30">
               <td width="200" align="center"><span class="Estilo14">Contratantes</span></td>
               <td width="75" align="center"><span class="Estilo14">Fecha  escr.</span></td>
               <td width="75" align="center"><span class="Estilo14">kardex</span></td>
               <td width="250" align="center"><span class="Estilo14">Acto</span></td>
               <td width="75" align="center"><span class="Estilo14">Nº Escritura</span></td>
               <td width="75" align="center"><span class="Estilo14">Nº Minuta</span></td>
               <td width="75" align="center"><span class="Estilo14">Nº Folio</span></td>
            </tr>
			<?php
            for($j=0; $j<count($arr_escritura); $j++) { 
            ?>	
		    <tr height='auto'>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_escritura[$j][0]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo fechabd_an($arr_escritura[$j][1]); ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_escritura[$j][2]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_escritura[$j][3]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_escritura[$j][4]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_escritura[$j][5]; ?></span></td>
			  <td valign='top' align='center'><span class='Estilo12'><?php echo $arr_escritura[$j][6]; ?></span></td>
		    </tr>
  		    <?php 
            }
            ?>
    		<tr height='25'>
                <td colspan='7' align='center' valign='bottom'>
                    <table style='margin-bottom:4px'>
                       <tr class='paginacion'>
                        <?php if($pag>7){?>
                            <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_escrituras('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                        <?php } 
                        for($i=$ini_pag; $i<$ini_pag+7; $i++){
                            if($i <= $num_pag){ ?>
                            <td width='15'>
                                <?php	
                                if($i==$pag){ ?>
                                <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_escrituras('<?php echo $i; ?>')"><u><?php echo $i; ?></u></div>
                                <?php	}else{ ?>
                                <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_escrituras('<?php echo $i; ?>')"><?php echo $i; ?></div>
                                <?php } ?>
                            </td>
                            <?php }
                        }
                        if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                        <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_escrituras('<?php echo ($ini_pag+7); ?>')">--></div></td>
                        <?php
                        }
                        ?>	  
                        </tr>
                    </table>
                </td>
             </tr>
    
    </table>






