	<?php

	include("../../extraprotocolares/view/funciones.php");
		
	include("../../consultas/kardex.php");
	
	$id_cliente = $_REQUEST['id'];
	
	$arr_cliente = dame_cliente($id_cliente);
	
	?>
	
	<style>
        .lbl_cobros{
            font-size:13px;
            margin-left:5px
        }
        .txt_cobros{
            font-size:12px;
            width:100px;
            text-transform:uppercase;
        }
        
        .slc_cobros{
            font-size:12px;
            width:130px;
        }
    </style>

	<form id="frm_agrecont1">
    <table align="center" style="margin-top:25px">
        <tr>
            <td><span class="lbl_cobros">Apellido Paterno</span></td>
            <td>
            	<input id="c_apepat" name="c_apepat" class="txt_cobros" value="<?php echo $arr_cliente[2]; ?>" type="text" readonly/>
                <input id="c_idcliente" name="c_idcliente" value="<?php echo $id_cliente;?>" type="hidden"/>
                </td>
            <td><span class="lbl_cobros">Apellido Materno</span></td>
            <td><input id="c_apemat" name="c_apemat" class="txt_cobros" value="<?php echo $arr_cliente[3]; ?>" type="text" readonly/></td>
            <td><img src="../iconos/condicion.png"></td>
            <td><img src="../iconos/condicion2.png"></td>
        </tr>
        <tr>
            <td><span class="lbl_cobros">Primer Nombre</span></td>
            <td><input id="c_prinom" name="c_prinom" class="txt_cobros" value="<?php echo $arr_cliente[4]; ?>" type="text" readonly/></td>
            <td><span class="lbl_cobros">Segundo Nombre</span></td>
            <td><input id="c_segnom" name="c_segnom" class="txt_cobros" value="<?php echo $arr_cliente[5]; ?>" type="text" readonly/></td>
            <td colspan="2"><img src="../iconos/contratante.png" onclick="grabar_contratante(1)"></td>
        </tr>
        <tr>
            <td><span class="lbl_cobros">Dirección</span></td>
            <td colspan="3"><input id="c_direccion" name="c_direccion" class="txt_cobros" style="width:363px" value="<?php echo $arr_cliente[6]; ?>" type="text" readonly/></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td><span class="lbl_cobros">Firma</span></td>
            <td><input id="c_firma" name="c_firma"  class="txt_cobros" type="checkbox" value="1" checked /></td>
            <td><span class="lbl_cobros">Incluir en el Indice</span></td>
            <td><input id="c_indice" name="c_indice" type="checkbox" value="1" checked /></td>
            <td colspan="2"></td>
        </tr>
    </table>
    </form>