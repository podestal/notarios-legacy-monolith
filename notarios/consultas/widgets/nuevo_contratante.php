	<?php

	include("../../extraprotocolares/view/funciones.php");
		
	include("../../consultas/kardex.php");
	
	$arr_tipdocumento = dame_documentos();
	
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

    <div style="background-color:#333333; padding:22px; padding-top:0px; opacity:0.9; overflow:auto">

    <table cellpadding="0" cellspacing="0" border="0" width="670" height="369" bgcolor="#FFFFFF">
        <tr bgcolor="#333333" height="25">
            <td height="25" colspan="4" align="center">
                <table width="667">
                    <tr>
                    <td width="623"><span class="camposss" style="margin-left:0px; color:white; font-family:Calibri; font-weight:700 ">Agregar Contratante</span></td>
                    <td width="18"><img onclick="cerrar_contratante()" src="../iconos/cerrar.png" width="18" height="18"/></td>
                    </tr>
                
                </table>
            </td>
        </tr>
        <tr>
        	<td colspan="4">
            	<form id="frm_bcontratante">
            	<table cellpadding="0" cellspacing="0">
                		<tr bgcolor="#CFCFCF" height="25">
                            <td width="167" height="46" align="center">
                                <select id="b_tippersona" name="b_tippersona" class="slc_cobros" onchange="buscar_contratante()" >
                                    <option value="">Elija Persona</option>
                                    <option value="N" style="margin-left:2px"
                                    <?php
                                    if($sdoic==2){
                                        echo " selected='selected'";
                                    }
                                    ?>
                                    >Natural</option>
                                    <option value="J" style="margin-left:2px"
                                    <?php
                                    if($sdoic==1){
                                        echo " selected='selected'";
                                    }
                                    ?>
                                    >Juridica</option>
                                </select>
                            </td>
                            <td width="291">
                                <select id="b_tipdocu" name="b_tipdocu" style="width:280px" class="slc_cobros" onchange="buscar_contratante()" >
                                    <option value="">Elija Tipo de Documento</option>
                                    <?php 
                                    for($i=0; $i<count($arr_tipdocumento); $i++){
                                    ?>
                                    <option value="<?php echo $arr_tipdocumento[$i][0]; ?>"><?php echo $arr_tipdocumento[$i][2]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td width="122">
                                <input id="b_doic" name="b_doic" type="input" class="txt_cobros" maxlength="20"/>
                            </td>
                            <td width="90">
                                <img src="../iconos/buscarclie.png" onclick="buscar_contratante()" />
                            </td>
                        </tr>
                        <tr bgcolor="#CFCFCF">
                            <td height="37" colspan="4">
                                <table width="655" height="39">
                                    <tr>
                                        <td width="299"><span class="lbl_cobros" style="margin-left:10px">Busqueda por Nombre, Apellidos / Razon Social:</span></td>
                                        <td colspan="2" width="292"><input id="b_cliente" name="b_cliente"  type="input" class="txt_cobros" style="width:335px" /></td>
                                        
                                        <!--<td width="48"><img src="../iconos/buscarclie.png" onclick="buscar_nom()" /></td>-->
                                        
                                        
                                    </tr>
                                </table>
                            </td>
                        </tr>
                </table>
                </form>
            </td>
        </tr>
        <tr>
            <td colspan="4" valign="top">
                <div id="cuerpo_contratante" style="height:250px; overflow:auto" ></div>
            </td>	
        </tr>
     </table>
    
    </div>

