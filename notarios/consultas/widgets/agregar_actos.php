
	<?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
	
	$tipkar = $_REQUEST['tipkar'];
	
	$arr_actos = dame_actos($tipkar);
	
	$cadena = $_REQUEST['cad'];
	
	$array_actos = dame_actoscadena($cadena);
	
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
	<form id="frm_actos" name="frm_actos">
    <table align="center" cellpadding="0">
        <tr height="30">
            <td>
            <span class="lbl_actos" style="margin-left:5px; font-weight:bold; font-size:13px" >Seleccione Acto(s)</span>
            </td>
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
                            	<input id="cod_acto<?php echo $arr_actos[$i][0];?>" name="cod_acto<?php echo $arr_actos[$i][0];?>" value="<?php echo $arr_actos[$i][0];?>" onclick="actualiza_actos(this.id, '<?php echo $arr_actos[$i][0];?>')"  								
								<?php 
							    for($j=0; $j<count($array_actos); $j++){
									if($arr_actos[$i][0]==$array_actos[$j][0]){
										echo "checked";		
									}
								}
								?>
                                type="checkbox">
                            </td>
                            <td><span class="lbl_actos"><?php echo $arr_actos[$i][1]; ?></span>
                            	<input id="desc_acto<?php echo $arr_actos[$i][0];?>" name="desc_acto<?php echo $arr_actos[$i][0];?>" value="<?php echo $arr_actos[$i][1];?>" type="hidden"/>
                            </td>
                        </tr>
                        <?php 
						}
						?>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td align="right"><img src="../iconos/aceptar.png" onClick="actualizar_actos(1)"></td>
        </tr>
    </table>
    </form>