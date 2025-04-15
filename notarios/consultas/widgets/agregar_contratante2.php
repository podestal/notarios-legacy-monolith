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
    
    <form id="frm_agrecont2">
        <table align="center" style="margin-top:25px">
            <tr>
                <td width="142"><span class="lbl_cobros">Razón Social</span></td>
                <td width="270">
                	<input id="c_razon" name="c_razon" value="<?php echo $arr_cliente[8]; ?>" style="width:280px" class="txt_cobros" type="text" readonly/>
                    <input id="c_idcliente" name="c_idcliente" value="<?php echo $id_cliente;?>" type="hidden"/>
                </td>
                <td width="16"><img src="../iconos/condicion.png"></td>
                <td width="17"><img src="../iconos/condicion2.png"></td>
            </tr>
            <tr>
                <td><span class="lbl_cobros">Dominio Fiscal</span></td>
                <td><input id="c_domfiscal" name="c_domfiscal" value="<?php echo $arr_cliente[9]; ?>" style="width:280px" class="txt_cobros" type="text" readonly/></td>
                <td colspan="2"><img src="../iconos/contratante.png" onclick="grabar_contratante(2)"></td>
            </tr>
            <tr>
                <td><span class="lbl_cobros">Incluir en el índice</span></td>
                <td colspan="3"><input id="c_indice" name="c_indice"  type="checkbox" checked="checked"/></td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <table width="100%">
                        <tr>
                            <td width="21" height="43"><input id="c_tiprepre1" name="c_tiprepre" type="radio"/></td>
                            <td width="114"><span class="lbl_cobros">Derecho Propio</span></td>
                            <td width="20"><input id="c_tiprepre2" name="c_tiprepre" type="radio"/></td>
                            <td width="96"><span class="lbl_cobros">Representante</span></td>
                            <td width="21"><input id="c_tiprepre3" name="c_tiprepre" type="radio"/></td>
                            <td width="199"><span class="lbl_cobros">Por Derecho Propio y Representante</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
