<?php
	
	include("../../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();

	$consulta_pago = "SELECT tipo_pago.codigo AS 'id', tipo_pago.descrip AS 'des' FROM tipo_pago ORDER BY tipo_pago.descrip ASC";
		
	$ejecuta_pago = mysql_query($consulta_pago, $conexion);
		
	$i=0;

	while($tippago = mysql_fetch_array($ejecuta_pago, MYSQL_ASSOC))
	{
		$arr_tippago[$i][0] = $tippago["id"]; 
		$arr_tippago[$i][1] = $tippago["des"];
		$i++; 
	}
	?>
    
	<select id="slc_tippago" name="slc_tippago" style='width:160px;' class='camposss' onchange="cambiar_tipopago()">
    	 <?php for($j=0;$j<count($arr_tippago); $j++){ ?>
		 <option value='<?php echo $arr_tippago[$j][0]; ?>'
         <?php 
		 if($arr_tippago[$j][0]==1){
		 	echo "selected = 'selected'";		 
		 }
		 ?>
         ><?php echo $arr_tippago[$j][1]; ?></option> 
         <?php } ?>
	</select>

