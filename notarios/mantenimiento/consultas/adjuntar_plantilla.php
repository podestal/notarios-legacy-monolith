<?php

include("../../extraprotocolares/view/funciones.php");
$conexion = Conectar();

$sql_tipkar = "select idtipkar, nomtipkar from tipokar";
$exe_tipkar = mysql_query($sql_tipkar);

$pkTemplate = $_REQUEST['pkTemplate'];
$sql = "SELECT tpl_template.pkTemplate,tpl_template.nameTemplate,tipokar.nomtipkar,tpl_template.fkTypeKardex,tipokar.nomtipkar,tpl_template.codeActs,tpl_template.contract,tpl_template.urlTemplate,fileName 
FROM tpl_template INNER JOIN tipokar ON tpl_template.fkTypeKardex = tipokar.idtipkar WHERE tpl_template.pkTemplate = '$pkTemplate' ";
$result = mysql_query($sql);
$rowTemplate = mysql_fetch_array($result);

?>
<link rel="stylesheet" href="../../stylesglobal.css">   


    <form id="frmAddTemplate" name="frmAddTemplate" style="width:100%" onsubmit="return  false;" />
    <input type="hidden"  id= "pkTemplate" name="pkTemplate" value="<?php echo $pkTemplate;  ?>">
    <table width="584" height="250" cellpadding="0" cellspacing="0">
        <tr height="35" style="background-color:#264965">
            <td colspan="6" align="center"><span class='submenutitu' style="font-size:14px">Cambiar de Plantilla</span></td>
        </tr>
        
  <tr>
       <th align="" width="30%"><span class="titubuskar0">Tipo de Kardex:</span></th>
      <td colspan="3">
        <select id="fkTypeKardex" name="fkTypeKardex" style="width:197px;" disabled="" class="Estilo7">
          <option value="0">--Seleccion Kardex --</option>
          <?php
          $selected = '';
            while($tip_kar = mysql_fetch_array($exe_tipkar)){ ?>
              <?php $selected = $tip_kar["idtipkar"]== $rowTemplate['fkTypeKardex']?'selected':''; ?>
            
                  <option <?php echo $selected; ?> value="<?php echo $tip_kar["idtipkar"]; ?>"><?php echo $tip_kar["nomtipkar"]; ?></option>
          
                 
           
          <?php 
            }
           ?>
                    
          </select>
       
      </td>
    
  </tr>      


 

  <tr>
    <th align="" width="30%"></th>
    <td colspan="3"><span class="">
    </td>
  </tr>
  <tr>
    <th align="" width="30%"><span class="titubuskar0">Nombre de Plantilla:</span></th>
    <td colspan="3"><span class=""><input type="text" size="50" value="<?php echo  $rowTemplate['nameTemplate']; ?>" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="nameTemplate" id="nameTemplate" readonly="" /></span><span style="color:red; margin-left:5px">(*)</span></td>
    
  </tr>

 

   <tr>
    <th align="right" width="30%"><span class="titubuskar0">Plantilla: </span></th>
    <td colspan="3">
    <span class="">
    <input type="file"  size="10" class="Estilo7"  style="background-color:#FFFFFF;text-transform:uppercase; font-family:Verdana, Geneva, sans-serif; font-size:11px;" name="fileTemplate" id="fileTemplate"/>

    </span>
    <span style="color:red; margin-left:5px">(*)</span>
    </td>
    
  </tr>

  <tr>
    <td colspan="6" align="center">
      <div id="msgError" style="color: #a94442;background-color: #f2dede;border-color: #ebccd1;padding: 15px;border: 1px solid transparent;border-radius: 4px;width: 480px;display:none;"></div>
      <div id="msg-success" style="color: #3c763d;background-color: #dff0d8;border-color: #d6e9c6;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;width: 480px;display:none;"></div>
    </td>
  </tr>  




  <tr height="40">
       <td colspan="6" align="center">
          <input type="button" value="Grabar" onClick="changeFileTemplate()" class="Estilo7" tabindex="13" />
        </td>
    </tr>
        
    </table>
    </form>

  <span class='submenutitu' style="position:relative; top:-245px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="closeUploadTemplate()">x</span></div>
     <span style="color:red; font-size:8px; position:relative; left:429px; top:-30px">(*)Campos Obligatorios</span>