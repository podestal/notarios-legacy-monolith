

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
		
		.txt_contratantes{
			font-size:12px;
			width:120px;
		}
		
		.slc_cobros{
			font-size:12px;
			width:130px;
		}
	</style>
    
<table width="630">
	<tr>
    	<td width="582">
        	<span class="lbl_contratantes2">Seleccionar Ubigeo</span>
        </td>
        <td width="36">
        	<img src="../iconos/cerrar.png" onClick="cerrar_ubigeos()">
        </td>
    </tr>
    <tr>
    	<td colspan="2">
        	<input class="txt_contratantes" id="nom_ubigeo" name="nom_ubigeo" type="text" style="width:300px; text-transform:uppercase" onKeyUp="listar_ubigeos(this.value)" maxlength="50">
        </td>
    </tr>
    <tr>
    	<td colspan="2">
            <div id="list_ubigeos" style="width:585px; height:150px; overflow:auto"></div>
        </td>
    </tr>
</table>