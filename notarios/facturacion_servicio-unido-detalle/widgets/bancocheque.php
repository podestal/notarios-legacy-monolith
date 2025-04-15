
	<?php
	
	include("../../extraprotocolares/view/funciones.php");
	
	$conexion = Conectar();
	
	$sql_banco = "SELECT bancos.idbancos as idbanco, bancos.desbanco as desbanco FROM bancos";
	
	$res_banco = mysql_query($sql_banco, $conexion);
	
	$i=0;

	while($banco = mysql_fetch_array($res_banco, MYSQL_ASSOC))
	{
		$arr_banco[$i][0] = $banco["idbanco"]; 
		$arr_banco[$i][1] = $banco["desbanco"];
		$i++; 
	}
	?>

<table width="266" align="center">
        <tr>
            <td width="151">
                <select id="banco" name="banco" style='width:130px;' class='camposss'>
                    <option value="">Entidad Finaciera</option>
                    <?php    
                    for($j=0;$j<count($arr_banco); $j++){ ?>
                    <option value='<?php echo $arr_banco[$j][0]; ?>'><?php echo $arr_banco[$j][1]; ?></option> 
                    <?php } ?>
                </select>
            </td>
           <td width="47"><span class="camposss">Cheque</span></td>
            <td width="52"><input id="cheque" name="cheque" style="width:40px" maxlength="10"/></td
            
        ></tr>
    </table>