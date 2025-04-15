
	<?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
	
	$nom = $_REQUEST['nom'];
	
	$arr_cargos = dame_cargosdesc($nom);
	
	?>

    <table border="1" width="560" align="left" cellpadding="1" cellspacing="1" style="border:#A0A0A0">	
        <?php for($i=0; $i<count($arr_cargos); $i++){ ?>
        <tr>
            <td width="423"><span class="lbl_contratantes" style="font-size:12px"><?php echo $arr_cargos[$i][2];?></span></td>
            <td width="124" align=""><img src="../iconos/seleccionar.png" onclick="escoger_cargo('<?php echo $arr_cargos[$i][0];?>', '<?php echo $arr_cargos[$i][2];?>')"></td>
        </tr>
        <?php }?>
    </table>