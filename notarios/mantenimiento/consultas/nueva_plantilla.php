<?php

include("../../extraprotocolares/view/funciones.php");
$conexion = Conectar();
$sql_tipkar = "select idtipkar, nomtipkar from tipokar";
$exe_tipkar = mysql_query($sql_tipkar, $conexion);


?>
<div class="form-template">
    <form id="frmAddTemplate" name="frmAddTemplate" style="width:100%" onsubmit="return  false;" />
    
    <table width="584" height="320" cellpadding="0" cellspacing="0">
        <tr height="35" style="background-color:#264965">
            <td colspan="6" align="center"><span class='submenutitu' style="font-size:14px">Nueva Plantilla</span></td>
        </tr>
        <tr>
       <th align="" width="30%"><span class="titubuskar0">Tipo de Kardex:</span></th>
      <td colspan="3">
        <select id="fkTypeKardex" name="fkTypeKardex" style="width:197px;" class="Estilo7">
          <option value="0">--Seleccion Kardex --</option>
          <?php
            while($tip_kar = mysql_fetch_array($exe_tipkar)){ ?>
              <option value="<?php echo $tip_kar["idtipkar"]; ?>"><?php echo $tip_kar["nomtipkar"]; ?></option>
                    
          <?php 
            }
           ?>
                    
          </select>
          <span style="color:red; margin-left:5px">(*)</span>
      </td>
    
  </tr>

  <tr>
    <th align="" width="30%"><span class="titubuskar0">Nombre de Plantilla:</span></th>
    <td colspan="3"><span class=""><input type="text" size="50" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="nameTemplate" id="nameTemplate"/></span><span style="color:red; margin-left:5px">(*)</span></td>
    
  </tr>

  <tr>
    <th align="" width="30%"><span class="titubuskar0" style="display:none;">Cod. de Actos:</span></th>
    <td colspan="3"><span class="">
    <input type="text" size="50" class="Estilo7" readonly="" style="background: #B8E7DF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;display:none;" name="codeActs" id="codeActs"/>
    </td>
  </tr>

  <tr>
    <th align="" width="30%"><span class="titubuskar0">Contrato: </span></th>
    <td colspan="3"><span class="">


    <textarea readonly="" id="contract" style="height:50px;width: 200px; resize:none;font-size:18px; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="contract"></textarea>
    </span><span style="color:red; margin-left:5px">(*)</span>
      <a onClick="showTypeActs(1)"><img src="../../iconos/addacto.png" width="75" height="29" /></a>
      <a onClick="showTypeActs(2)"><img src="../../iconos/delacto.png" width="75" height="29" /></a>

      <div id="menuactos" class="menuactos" style="display:none; z-index:2;" >
            <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="29" colspan="2" class="style30"><table width="196" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="16">&nbsp;</td>
                      <td width="180"><span class="titulomenuacto">Seleccione Acto(s)</span></td>
											<td width="16"><input type="text" style="position: absolute;width: 300px;left: 40%;background: white;" placeholder="FILTRAR ACTO" id="txtFiltrarGrupo"></td>
                    </tr>
                </table></td>
                <td width="21" align="right" valign="middle">&nbsp;</td>
              </tr>
              <tr>
                <td height="50" colspan="3"><div id="tipoacto" class="tipoacto"></div></td>
              </tr>
              <tr>
                <td width="607" height="10">&nbsp;</td>
                <td width="132"><a href='#' onClick="closeActs()"><img src="../../iconos/aceptar.png" width="95" height="29" border="0" /></a></td>
                <td height="10">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" align="center" valign="middle"></td>
              </tr>
              <tr></tr>
            </table>
    </div>




    </td>
    
  </tr>

 

   <!-- <tr>
    <th align="right" width="30%"><span class="titubuskar0">Plantilla: </span></th>
    <td colspan="3">
    <span class="">
    <input type="file"  size="10" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="fileTemplate" id="fileTemplate"/>
      
    </span>
    <span style="color:red; margin-left:5px">(*)</span>
    </td>
    
  </tr> -->
   <tr>
    <th align="right" width="30%"><span class="titubuskar0">Directorio: </span></th>
    <td colspan="3">
    <span class="">
            <input type="text" name="txtDirectorio" id="txtDirectorio" placeholder="ruta del directorio">
    </span>
    <span style="color:red; margin-left:5px">(*)</span>
    </td>
    
  </tr>


  <tr>
    <td colspan="6" align="center">
      <div id="msg-error" style="color: #a94442;background-color: #f2dede;border-color: #ebccd1;padding: 15px;border: 1px solid transparent;border-radius: 4px;width: 480px;display:none;"></div>
    </td>
  </tr>  


  <tr height="40">
       <td colspan="6" align="center">
          <input type="button" value="Grabar" onClick="addTemplate()" class="Estilo7" tabindex="13" />
        </td>
    </tr>
        
    </table>
    </form>

  <span class='submenutitu' style="position:relative; top:-315px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="closeAddTemplate()">x</span>
     <span style="color:red; font-size:8px; position:relative; left:429px; top:-30px">(*)Campos Obligatorios</span>

</div> 
<script>
    		

if(document.getElementById('txtFiltrarGrupo')){
	txtFiltrarGrupo.addEventListener('keyup',()=>{
		let texto = txtFiltrarGrupo.value.toUpperCase();
		for(let i=1 ; i<=5000 ; i++){

			if(document.getElementById('txtItems'+i)){
				/* console.log(document.getElementById('txtItems'+i)) */
				if(document.getElementById('txtItems'+i).textContent.includes(texto)){
					document.getElementById('txtItems'+i).style.display = 'block';
				}else{
					document.getElementById('txtItems'+i).style.display = 'none';
				}
			}
			
		}
	})
}


</script>
