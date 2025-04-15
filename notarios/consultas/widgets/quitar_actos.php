
	<?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
	
	$cadena = $_REQUEST['cad'];
	
	$arr_actos = dame_actoscadena($cadena);
	
	?>

	<style>
		.lbl_cobros{
			font-size:12px;
		}
		.lbl_actos{
			font-size:12px;
			color:#FFF;
			font-family:Calibri;
			font-style:italic;
		}
		.txt_cobros{
			font-size:12px;
			width:80px;
		}
	</style>

    <table align="center" cellpadding="0">
        <tr height="30">
            <td><span class="lbl_actos" style="margin-left:5px; font-weight:bold; font-size:13px" >Quitar Acto(s)</span></td>
        </tr>
        <tr>
            <td>
                <div style="height:160px; width:720px; overflow:auto">
                    <table>
              			<?php 
						for($i=0; $i<count($arr_actos); $i++){
						?>      
                    	<tr>
                            <td>
                            <input id="cod_qacto<?php echo $arr_actos[$i][0];?>" name="cod_qacto<?php echo $arr_actos[$i][0];?>" value="<?php echo $arr_actos[$i][0];?>" onclick="actualiza_actos(this.id, '<?php echo $arr_actos[$i][0];?>')" type="checkbox" checked="checked" >
                            </td>
                            <td><span class="lbl_actos"><?php echo $arr_actos[$i][1]; ?></span></td>
                        </tr>
                        <?php 
						}
						?>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td align="right"><img src="../iconos/aceptar.png" onClick="actualizar_actos(2)"></td>
        </tr>
    </table>