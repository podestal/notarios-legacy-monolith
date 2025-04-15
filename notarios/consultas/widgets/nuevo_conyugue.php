
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
    
	<form id="frm_nconyugue" name="frm_nconyugue">
    <table>
    		<tr>
            	<td width="617"><span class="lbl_contratantes2">Nuevo Conyugue</span></td>
                <td width="32"><img src="../iconos/cerrar.png" onClick="cerrar_conyugue()" title="Cerrar"></td>
            </tr>
            <tr>
            	<td valign="top" colspan="4">
                	<div style="height:225px; width:650px; overflow:auto">
                    	<table cellpadding="0" cellspacing="0" width="630" align="center"> 
                        		<tr height="30">
                                    <td><span class="lbl_contratantes">Apellido Paterno :</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                    <td><span class="lbl_contratantes">Apellido Materno :</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">1er Nombre :</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                    <td><span class="lbl_contratantes">2do Nombre :</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Direccion :</span></td>
                                    <td colspan="3"><input type="text" class="txt_contratantes" style="width:460px"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Ubigeo :</span></td>
                                    <td><input type="text" class="txt_contratantes" ></td>
                                    <td colspan="2"><img src="../iconos/seleccionar.png"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Estado Civil :</span></td>
                                    <td><select class="slc_cobros"></select></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Casado(a) con :</span></td>
                                    <td><img src="../iconos/grabarconyuge2.png"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Sexo :</span></td>
                                    <td><select class="slc_cobros"></select></td>
                                    <td><select class="slc_cobros"></select></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Nacionalidad :</span></td>
                                    <td><select class="slc_cobros"></select></td>
                                    <td><span class="lbl_contratantes">Residente :</span></td>
                                    <td><select class="slc_cobros"></select></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Natural de :</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                    <td><span class="lbl_contratantes">Fecha de Nac. :</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                </tr>
                                <tr height="30">
                                    <td colspan="3"><span class="lbl_contratantes">Pais de Emisión del Documento de Identidad : 	</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Prof./Ocupación :</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                    <td  colspan="2"><img src="../iconos/seleccionar.png"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Cargo :</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                    <td ><img src="../iconos/seleccionar.png"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Telefono Cel. : </span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                    <td><span class="lbl_contratantes">Telefono Oficina :</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Telefono Fijo :</span></td>
                                    <td><input type="text" class="txt_contratantes"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr height="30">
                                    <td><span class="lbl_contratantes">Email :</span></td>
                                    <td colspan="3"><input type="text" class="txt_contratantes" style="width:460px"></td>
                                </tr>
                                <tr height="55">
                                    <td colspan="4">
                                        <img src="../iconos/grabar.png" onClick="grabar_conyugue()">
                                    </td>
                                </tr>
                        </table>
                    </div>
                </td>
            </tr>
            
            
    </table>
    </form>
    
     		 	
  	 		 	
  	 	
  	 	
	
  	 		
  	 	
  	 			
  	 		 	
  	 		 	
  	
  	 	
	
  	 	
	
  			 	
  	 		  	 
  	 	
  	  		  