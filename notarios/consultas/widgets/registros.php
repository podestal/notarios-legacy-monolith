	<link rel="stylesheet" type="text/css" href="../../css/protocolares/kardex.css">
    
	<?php 
	
	include("../../extraprotocolares/view/funciones.php");
	
	include("../../consultas/kardex.php");
	
	$codkardex = $_REQUEST['id'];
	
	$arr_dmovs = detalle_movs($codkardex);
	
	$arr_nr = dame_notreg($codkardex);
	
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

	<table width="100%" style="margin-top:20px">
	<tr>
    	<td align="center">
          <table cellpadding="0" cellspacing="0" border="1" style="width:690px">
            <tr style="background-color:#CCCCCC; font-size:11px" class="Estilo18" height="25">
                <td align="center" width="75"><span>Fecha Movi.</span></td>
                <td align="center" width="75"><span>Trámite</span></td>
                <td align="center" width="75"><span>Nº Título</span></td>
                <td align="center" width="75"><span>Estado</span></td>
                <td align="center" width="75"><span>Importe</span></td>
                <td align="center" width="75"><span>Sede Reg.</span></td>
                <td align="center" width="130"><span>Sec. Reg</span></td>
                <td align="center" width="55"><span>Modificar</span></td>
                <td align="center" width="55"><span>Eliminar</span></td>
            </tr>
            <?php 
            for($i=0; $i<count($arr_dmovs); $i++){
			?>
            <tr style="font-size:11px">
                <td align="center"><span class="Estilo36"><?php echo $arr_dmovs[$i][0]; ?></span></td>
                <td align="center"><span class="Estilo36"><?php echo $arr_dmovs[$i][1]; ?></span></td>
                <td align="center"><span class="Estilo36"><?php echo $arr_dmovs[$i][2]; ?></span></td>
                <td align="center"><span class="Estilo36"><?php echo $arr_dmovs[$i][3]; ?></span></td>
                <td align="center"><span class="Estilo36"><?php echo $arr_dmovs[$i][4]; ?></span></td>
                <td align="center"><span class="Estilo36"><?php echo $arr_dmovs[$i][5]; ?></span></td>
                <td align="center"><span class="Estilo36"><?php echo $arr_dmovs[$i][6]; ?></span></td>
                <td align="center"><img onclick="modificar_movimiento('<?php echo $arr_dmovs[$i][8]; ?>')" src="images/pencil.png" width="20" height="20" style="cursor:pointer"></td>
                <td align="center"><img onclick="eliminar_movimiento('<?php echo $arr_dmovs[$i][8]; ?>')" src="images/delete.png" width="20" height="20" style="cursor:pointer"></td>
            </tr>
            <?php 
			}
			?>
        </table>
        </td>
    </tr>
    <tr height="35">
    	<td height="23">  </td>
    </tr>
  <tr>
    	<td>
        	<table bgcolor="#CCCCCC" border="1" cellpadding="1" cellspacing="1" style="margin-left:10px" width="519">
            	<tr>
                	<td align="left" colspan="3">
                    	<table border="1" cellpadding="1" cellspacing="0" width="246">
                        	<tr>
                            	<td align="center"><span class="lbl_cobros">Presupuesto</span></td>
                                <td><span>-</span></td>
                                <td align="center"><span class="lbl_cobros">Cobrado</span></td>
                            </tr>
                            <tr>
                            	<td align="center"><input style="text-align:right" class="txt_cobros" id="txt_presupuesto" name="txt_presupuesto" type="text" readonly/></td>
                                <td><span>-</span></td>
                                <td align="center"><input value="<?php echo $arr_nr[1]; ?>"  style="text-align:right" class="txt_cobros" id="txt_cobrado" name="txt_cobrado" type="text" readonly/></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center"><span class="lbl_cobros">Pagado a RR.PP</span></td>
                    <td align="center"><span class="lbl_cobros">Mayor derecho por Pagar</span></td>
                    <td align="center"><span class="lbl_cobros">Por Cobrar al Cliente</span></td>
                </tr>
                <tr>
                    <td align="center"><input value="<?php echo $arr_dmovs[0]['total_importe'];?>" style="text-align:right" class="txt_cobros" id="txt_pagado" name="txt_pagado" type="text" readonly/></td>
                    <td align="center"><input value="<?php echo $arr_dmovs[0]['mayor_derecho'];?>" style="text-align:right" class="txt_cobros" id="txt_derecho" name="txt_derecho" type="text" readonly/></td>
                    <td align="center"><input value="<?php echo ($arr_dmovs[0]['total_importe']-$arr_nr[1]); ?>" style="text-align:right" class="txt_cobros" id="txt_porcobrar" name="txt_porcobrar" type="text" readonly/></td>
                </tr>
            </table>
        </td>
    </tr>
     <tr><td height="17"></td></tr>
    <tr>
        <td>
			<img src="iconos/neww.png" onclick="nuevo_movimiento()" width="92" height="27" style="margin-left:10px" />
        </td>
    </tr>
    
	</table>
    
     
   



