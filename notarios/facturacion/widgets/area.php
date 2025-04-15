<?php
	
	include("../../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();

    $consulta_pago = "SELECT area_detalle.id_area AS 'id', area_detalle.des_area AS 'des' FROM area_detalle ORDER BY area_detalle.des_area ASC";
		
	$ejecuta_pago = mysql_query($consulta_pago, $conexion);
		
	$i=0;

	while($tippago = mysql_fetch_array($ejecuta_pago, MYSQL_ASSOC))
	{
		$arr_tippago[$i][0] = $tippago["id"]; 
		$arr_tippago[$i][1] = $tippago["des"];
		$i++; 
	}
	?>
	
	<select style='width:190px;' class='camposss'>
		<?php for($j=0;$j<count($arr_tippago); $j++){ ?>
		<option value='<? echo $arr_tippago[$j][0];?>'
        <?php 
		if($arr_tippago[$j][0]=='06'){
			echo  "selected='selected'";
		}
		?>
        ><?php echo $arr_tippago[$j][1];?></option>
     	<?php } ?>    
    </select>