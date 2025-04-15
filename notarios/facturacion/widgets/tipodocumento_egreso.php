<?php
	
	include("../../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();

	$consulta_tipdoc = "SELECT tip_documen_egreso.id_documen AS 'id', tip_documen_egreso.des_docum AS 'des' FROM tip_documen_egreso ORDER BY tip_documen_egreso.des_docum ASC";
		
	$ejecuta_tipdoc = mysql_query($consulta_tipdoc, $conexion);
		
	$i=0;

	while($tipodoc = mysql_fetch_array($ejecuta_tipdoc, MYSQL_ASSOC))
	{
		$arr_tipodoc[$i][0] = $tipodoc["id"]; 
		$arr_tipodoc[$i][1] = $tipodoc["des"];
		$i++; 
	}
	?>
    
    <select id="tip_comp" name="tip_comp" style='width:167px;' class='camposss'>
		
    <option value="">--Tipo de Comprobante--</option>
        
    <?php    
		
	for($j=0;$j<count($arr_tipodoc); $j++){ ?>
		
	<option value='<?php echo $arr_tipodoc[$j][0]; ?>'><?php echo $arr_tipodoc[$j][1]; ?></option> 

	<?php } ?>
	
	</select>
	
    
