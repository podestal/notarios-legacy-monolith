
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
    
    <div style="background-color:#333333; padding:22px; padding-top:0px; opacity:0.9; overflow:auto">
    <form id="frm_bcontratante">
    <table cellpadding="0" cellspacing="0" border="0" width="670" height="299" bgcolor="#FFFFFF">
        <tr bgcolor="#333333" height="35">
            <td height="25" align="center">
            <table width="667">
                    <tr>
                    <td width="623" height="50"><span class="camposss" style="margin-left:0px; color:white; font-family:Calibri; font-weight:700 ">Mantenimiento Contrantes</span></td>
                    <td width="18"><img onclick="cerrar_mcontratante()" src="../iconos/cerrar.png" width="18" height="18"/></td>
                  </tr>
                
                </table>
            </td>
        </tr>
        <tr bgcolor="#333333">
        	<td valign="top" align="center">
            	<table height="auto" width="659" border="1" cellpadding="0" cellspacing="0">
                		<?php for($i=0; $i<count($arr_contratantes); $i++) {?>
                       <tr height="25" bgcolor="#FFFFFF" >
                            <td width="459">
                            <span class="lbl_cobros" style="margin-left:5px" ><?php echo $arr_contratantes[$i][8]; echo $arr_contratantes[$i][1];?></span>
                            </td>
                            <td width="100" align="center">
                            <img onclick="modificar_contratante('<?php echo $arr_contratantes[$i][6];?>')" src="../iconos/editacontrar.png" title="Editar Contratante" style="cursor:pointer" />
                            </td>
                            <td width="100" align="center">
                            <img onclick="eliminar_contratante('<?php echo $arr_contratantes[$i][6];?>')" src="../iconos/eliminacontrar.png" title="Eliminar Contratante" style="cursor:pointer"/>
                            </td>
                        </tr>
                        <?php }?>
                </table>
            </td>
        </tr>
     </table>
     </form>
    </div>