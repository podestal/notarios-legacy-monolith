	<?php
	
	include("../../extraprotocolares/view/funciones.php");
	$conexion = Conectar();
	$consulta_tipdoc = "SELECT tip_documen.id_documen AS 'id', tip_documen.des_docum AS 'des' FROM tip_documen ORDER BY tip_documen.des_docum ASC";
	$ejecuta_tipdoc = mysql_query($consulta_tipdoc, $conexion);
	$i=0;

	while($tipodoc = mysql_fetch_array($ejecuta_tipdoc, MYSQL_ASSOC))
	{
		$arr_tipodoc[$i][0] = $tipodoc["id"]; 
		$arr_tipodoc[$i][1] = $tipodoc["des"];
		$i++; 
	}
	?>

    <table width="266">
        <tr>
            <td width="109">
                <select id="d_tipcomp" name="d_tipcomp" style='width:100px;' class='camposss'>
                    <option value="">Tipo Comp.</option>
                    <?php    
                    for($j=0;$j<count($arr_tipodoc); $j++){ ?>
                    <option value='<?php echo $arr_tipodoc[$j][0]; ?>'><?php echo $arr_tipodoc[$j][1]; ?></option> 
                    <?php } ?>
                </select>
            </td>
            <td width="31"><span class="camposss">Serie</span></td>
            <td width="32"><input id="d_serie" name="d_serie" style="width:20px" maxlength="2" /></td>
            <td width="30"><span class="camposss">Núm</span></td>
            <td width="40"><input id="d_ndoc" name="d_ndoc" style="width:40px" maxlength="6" /></td>
        </tr>
    </table>