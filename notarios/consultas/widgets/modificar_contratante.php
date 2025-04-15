	<?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
	
	$id_contratante = $_REQUEST['id'];
	
	$arr_contratante = dame_contratante($id_contratante);
	
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
		.lbl_contratantes{
			color: #333333;
			font-family: Calibri;
			font-size: 14px;
			font-style: italic;
		}
		.lbl_contratantes2{
			font-family: Calibri;
			font-size: 14px;
			font-style: italic;
			font-weight: bold;
		}
		.txt_cobros{
			font-size:12px;
			width:80px;
		}
	</style>
    
    <table style="height:250px; width:720px">
    	<tr height="25">
        	<td><span class="lbl_contratantes" style="font-weight: bold; margin-left:5px">Editar Contratante</span></td>
            <td align="right"><img src="../iconos/cerrar.png" style="margin-right:10px" onclick="cerrar_modicontratante()"/></td>
        </tr>
        <tr>
        	<td colspan="2">
				<div style="height:190px; overflow:auto; width:700px">
                	<form id="frm_econtratante" naem="frm_econtratante">
                	<table style="width:650px" align="center">
                    	<tr height="25">
                            <td width="400"><span class="lbl_contratantes2"><?php echo $arr_contratante[39]; echo $arr_contratante[5]; ?></span><img onclick="modificar_contratante2('<?php echo $arr_contratante[0]; ?>','<?php echo $arr_contratante[6]; ?>' )" src="../iconos/editacontratantes3.png" style="margin-left:10px"></td>
                            <td width="250"></td>
                        </tr>
                        <tr height="25">
                            <td height="37" colspan="2"><span class="lbl_contratantes">Representa a:</span></td>
                        </tr>
                        <tr height="25">
                            <td>
                            <input 
                            <?php 
							if($arr_contratante[1]==1){
								echo "checked='checked'";
							}
							?>
                            type="checkbox">
                            <span class="lbl_contratantes2" style="margin-left:5px">Firma</span></td>
                            <td>
                            <input
                            <?php 
							if($arr_contratante[2]==1){
								echo "checked='checked'";
							}
							?> 
                            type="checkbox">
                            <span class="lbl_contratantes2" style="margin-left:5px">Indice</span></td>
                        </tr>
                        <tr height="25">
                            <td colspan="2">
                                <table width="650" height="30">
                                    <tr>
                                        <td width="30">
                                        <input 
                                        <?php 
										if($arr_contratante[3]==0){
											echo "checked='checked'";
										}
										?> 
                                        type="radio">
                                        </td>
                                        <td width="150"><span class="lbl_contratantes">Derecho Propio:</span></td>
                                        <td width="30">
                                        <input
                                        <?php 
										if($arr_contratante[3]==1){
											echo "checked='checked'";
										}
										?> 
                                        type="radio">
                                        </td>
                                        <td width="150"><span class="lbl_contratantes">Representante:</span></td>
                                        <td width="30">
                                        <input
                                        <?php 
										if($arr_contratante[3]==2){
											echo "checked='checked'";
										}
										?>
                                        type="radio">
                                        </td>
                                        <td width="220"><span class="lbl_contratantes">Derecho Propio y Representación:</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr height="125">
                            <td colspan="2">
                                <table>
                                    <?php ?>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <?php ?>
                                </table>
                            </td>
                        </tr>
                        <tr height="25">
                            <td colspan="2">
                            <img src="../iconos/grabar.png">
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </td>
        </tr>
    </table>