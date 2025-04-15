
	<link rel="stylesheet" type="text/css" href="../../css/protocolares/kardex.css">
    
	<?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
	
	$codkardex = $_REQUEST['id'];
	
	$arr_contratantes = dame_contratantes($codkardex);
	
	?>

	<style>
		.lbl_cobros{
			font-size:12px;
		}
		.txt_cobros{
			font-size:12px;
			width:80px;
		}
	</style>

    <table width="706" height="393" style="margin-top:8px;">
        <tr>
            <td height="340" valign="top">
                <table width="700px" border="1" cellpadding="0" cellspacing="0">
                    <tr style="background-color:#264965" height="20">
                        <td width="240" align="center"><span style="color:#FFF; font-family:Calibri; font-weight:bold" class="lbl_cobros">Contratantes</span></td>
                        <td width="110" align="center"><span style="color:#FFF; font-family:Calibri; font-weight:bold" class="lbl_cobros">Condición</span></td>
                        <td width="110" align="center"><span style="color:#FFF; font-family:Calibri; font-weight:bold" class="lbl_cobros">Firma</span></td>
                        <td width="110" align="center"><span style="color:#FFF; font-family:Calibri; font-weight:bold" class="lbl_cobros">Fecha Firma</span></td>
                        <td width="130" align="center"><span style="color:#FFF; font-family:Calibri; font-weight:bold" class="lbl_cobros">Responsable</span></td>
                    </tr>
                    <?php 
					for($i=0; $i<count($arr_contratantes); $i++){
					?>
                    <tr>
                        <td><span class="lbl_cobros" style="margin-left:5px">
						<?php 
						echo $arr_contratantes[$i][8]; 
						echo $arr_contratantes[$i][1];
						?></span></td>
                        <td align="center"><span class="lbl_cobros"><?php echo $arr_contratantes[$i][7]; ?></span></td>
                        <td align="center"><span class="lbl_cobros">
						<?php echo $arr_contratantes[$i][2]; ?>
                        <?php if($arr_contratantes[$i][2]=="SI"){?>
                        <img src="../iconos/firmita.png" onclick="mostrar_firma()" />
                        <?php }?>
                        </span></td>
                        <td align="center"><span class="lbl_cobros"><?php echo $arr_contratantes[$i][3]; ?></span></td>
                        <td><span class="lbl_cobros" style="margin-left:5px"><?php echo $arr_contratantes[$i][5]; ?></span></td>
                    </tr>
                    <?php 
					}
					?>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td><img onclick="nuevo_contratante()" src="../iconos/mostrarcontratantes.png" width="134" height="28" /></td>
                        <td><img onclick="editar_contratante('<?php echo $codkardex; ?>')" src="../iconos/editarcontratante.png" width="134" height="28" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    <div id="div_firma" style="background-color:#CCCCCC; position:absolute; top:380px; left:420px; height:91px; width:247px; border:1px solid #264965; border-radius: 13px; box-shadow:0 0 5px #000000; display:none"></div>
