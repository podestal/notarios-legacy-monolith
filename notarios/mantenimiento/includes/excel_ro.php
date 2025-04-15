<?php
require_once '../../Cpu/ROClass.php';
$initialDate = $_GET["initialDate"];
$finalDate = $_GET["finalDate"];
$objRoClass = new RoClass($initialDate,$finalDate);
$objRoClass->generateData();
$arrObj = $objRoClass->getListData();
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="../../Libs/bootstrap/css/bootstrap.min.css">
  <style type="text/css">
    
    .th-table{
      font-family: Verdana, Geneva, sans-serif;
      font-size:9px;
      color:#FFFFFF;
    }
    #header{
      display:block;
      width:100%;
      height:80px;
      overflow:hidden;
      position:fixed;
      top:0px;
      border:#fff 1px;
      margin:0 0 0 0px;
      padding:0;
    }

  </style>

</head>
<body>
<div id="header">
  <form action="ficheroExcel.php" method="post" target="_blank" id="frm-export-excel">
  <input type="hidden" id="sendHtmlExcel" name="sendHtmlExcel" />
    <table class="table table-hover" width="100%" >
      <tr>
        <tbody>
          <tr>
            <td style="background:#254061;">
              <h4 style="color:#FFF;">REGISTRO DE OPERACIONES UIF</h4>
            </td>
            <td style="background:#254061;">
               <h4 style="color:#FFF;"> EXPORTAR A EXCEL:
               <a href="javascript:;" id="btn-export-excel"><img src="../../images/xls.png"></a></h4>
            </td>
          </tr>
        </tbody>
      </tr>
    </table>
  </form>
  
</div>

 <div style="margin-top:69px; width:100%;">
  <table width="6528" class="table table-hover"  id="table-export-excel" border="1" style="font-family:'Arial Narrow'; font-size:10px;" bordercolor="#4F81BD" cellpadding="00" cellspacing="0">
    <col width="80" span="13" />
    <col width="97" />
    <col width="119" />
    <col width="115" />
    <col width="110" />
    <col width="119" />
    <col width="80" span="5" />
    <col width="208" />
    <col width="114" />
    <col width="130" />
    <col width="80" span="3" />
    <col width="132" />
    <col width="147" />
    <col width="118" />
    <col width="95" />
    <col width="87" />
    <col width="92" />
    <col width="101" />
    <col width="92" />
    <col width="86" />
    <col width="82" />
    <col width="80" span="12" />
    <col width="97" />
    <col width="89" />
    <col width="128" />
    <col width="80" />
    <col width="88" />
    <col width="91" />
    <col width="146" />
    <tr>
      <td width="62" rowspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px" >&nbsp;</td>
      <td width="59" rowspan="3" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Codigo de Fila</span></td>
      <td height="28" colspan="11" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Datos    de identificacion del registro de la operacion</span></td>
      <td colspan="5" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Participacion    y representacion de las personas involucradas en la operacion</span></td>
      <td colspan="26" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Datos de identificacion de las personas que    intervienen en la operacion</span></td>
      <td colspan="14" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Datos relacionados a la descripcion de la    operacion (Acto/Contrato extendido en IPNP)</span></td>
    </tr>
    <tr>
      <td width="68" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Numero Registro de la Operacion</span></td>
      <td width="63" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Tipo de    envio del RO</span></td>
      <td colspan="7" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">Instrumento    Publico Notarial Protocolar 
        (IPNP)</span></td>
      <td width="64" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Modalidad    de la operacion</span></td>
      <td width="91" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Cantidad    de operaciones individuales que contiene la operacion Multiple</span></td>
      <td colspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">Roles del Participante</span></td>
      <td colspan="2" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">Representacion</span></td>
      <td width="103" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Condicion de residencia (Declarada en el IPNP)</span></td>
      <td width="67" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Tipo de persona</span></td>
      <td colspan="2" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">Documento de identidad</span></td>
      <td width="149" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Numero de Registro unico de Contribuyente (RUC)</span></td>
      <td colspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">Nombre completo de la persona</span></td>
      <td width="88" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Pais de nacionalidad</span></td>
      <td width="96" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Fecha de nacimiento</span></td>
      <td width="78" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Estado civil</span></td>
      <td colspan="4" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">Ocupacion, oficio, profesion, actividad    economica u objeto social y cargo</span></td>
      <td colspan="2" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">Inscripcion en SUNARP de la Representacion    (Personas Juridicas)</span></td>
      <td colspan="5" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">Domicilio y telefonos</span></td>
      <td width="75" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Participacion del conyuge</span></td>
      <td colspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">Nombre completo del conyuge</span></td>
      <td width="185" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Tipo de fondos, bienes u otros activos con que se    realizo la operacion</span></td>
      <td width="78" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Tipo de operacion</span></td>
      <td width="155" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Forma de pago mediante la cual se realizo la    operacion </span></td>
      <td width="142" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Oportunidad de pago de la operacion</span></td>
      <td width="134" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Descripcion de la oportunidad de pago 
        (en caso de otros)</span></td>
      <td rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Origen de los fondos, bienes u otros activos involucrados en la    operacion</span></td>
      <td width="69" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Moneda en que se realizo la operacion 
        (Codificacion ISO.4217)</span></td>
      <td colspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px" ><span class="th-table">Montos de la operacion</span></td>
      <td width="57" rowspan="2" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Tipo de cambio</span></td>
      <td colspan="3" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">Inscripcion en SUNARP 
        del bien materia de la operacion </span></td>
    </tr>
    <tr>
      <td width="61" height="65" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Tipo de IPNP</span></td>
      <td width="86" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Numero    del IPNP</span></td>
      <td width="84" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Fecha    del IPNP</span></td>
      <td width="90" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Numero    del IPNP que se aclara</span></td>
      <td width="79" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Fecha    del IPNP que se aclara</span></td>
      <td width="81" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Conclusion</span></td>
      <td width="95" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Fecha    de la firma por participante</span></td>
      <td width="95" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Representante</span></td>
      <td width="127" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Persona    en cuyo nombre se realiza la operacion</span></td>
      <td width="121" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Persona    a favor de quien se realiza la operacion</span></td>
      <td width="105" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Persona    a la que se representa</span></td>
      <td width="97" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Tipo    de representacion</span></td>
      <td width="70" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Tipo</span></td>
      <td width="113" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Numero</span></td>
      <td width="349" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Apellido    paterno / Razon social</span></td>
      <td width="144" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Apellido    materno</span></td>
      <td width="254" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Nombres</span></td>
      <td width="79" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Codigo    de Ocupacion de persona natural</span></td>
      <td width="318" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Descripcion    del objeto social 
        (solo personas juridicas y otros)</span></td>
      <td width="73" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Codigo    CIIU (personas juridicas)</span></td>
      <td width="60" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Codigo    de Cargo</span></td>
      <td width="169" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Codigo    de la Zona Registral</span></td>
      <td width="143" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Numero    de la 
        Partida Registral</span></td>
      <td width="327" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Tipo,    nombre y numero de la via</span></td>
      <td width="71" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Departamento</span></td>
      <td width="58" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Provincia</span></td>
      <td width="43" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Distrito</span></td>
      <td width="80" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Teléfonos</span></td>
      <td width="57" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Apellido    paterno</span></td>
      <td width="57" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Apellido    materno</span></td>
      <td width="63" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Nombres</span></td>
      <td width="122" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Monto    total de la operacion</span></td>
      <td width="121" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Monto    por participante</span></td>
      <td width="117" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Monto    relacionado a los tipos de fondos, bienes u otros activos</span></td>
      <td width="79" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Inscripicion    registral del bien</span></td>
      <td width="71" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Codigo    de la Zona Registral</span></td>
      <td width="144" align="left" valign="top" bgcolor="#254061" style="color:#FFF; font-size:11px"><span class="th-table">Numero    de partida registral del bien materia de la operacion</span></td>
    </tr>
    <tr>
      <td height="23" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><div style="width:70px;"><span class="th-table">kardex</span></div></td>
      <td align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><div style="width:60px;"><span class="th-table">item: 1</span></div></td>
      <td align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><div style="width:70px;"><span class="th-table">2</span></div></td>
      <td align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><div style="width:70px;"><span class="th-table">3</span></div></td>
      <td width="61" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><div style="width:60px;"><span class="th-table">4</span></div></td>
      <td width="86" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">5</span></td>
      <td width="84" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">6</span></td>
      <td width="90" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">7</span></td>
      <td width="79" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">8</span></td>
      <td width="81" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">9</span></td>
      <td width="95" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">10</span></td>
      <td width="64" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">11</span></td>
      <td width="91" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">12</span></td>
      <td width="95" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">13</span></td>
      <td width="127" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">14</span></td>
      <td width="121" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">15</span></td>
      <td width="105" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">16</span></td>
      <td width="97" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">17</span></td>
      <td width="103" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">18</span></td>
      <td width="67" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">19</span></td>
      <td width="70" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">20</span></td>
      <td width="113" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">21</span></td>
      <td width="149" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">22</span></td>
      <td width="349" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">23</span></td>
      <td width="144" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">24</span></td>
      <td width="254" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">25</span></td>
      <td width="88" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">26</span></td>
      <td width="96" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">27</span></td>
      <td width="78" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">28</span></td>
      <td width="79" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">29</span></td>
      <td width="318" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">30</span></td>
      <td width="73" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">31</span></td>
      <td width="60" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">32</span></td>
      <td width="169" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">33</span></td>
      <td width="143" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">34</span></td>
      <td width="327" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">35</span></td>
      <td width="71" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">36</span></td>
      <td width="58" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">37</span></td>
      <td width="43" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">38</span></td>
      <td width="80" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">39</span></td>
      <td width="75" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">40</span></td>
      <td width="57" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">41</span></td>
      <td width="57" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">42</span></td>
      <td width="63" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">43</span></td>
      <td width="185" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">44</span></td>
      <td width="78" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">45</span></td>
      <td width="155" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">46</span></td>
      <td width="142" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">47</span></td>
      <td width="134" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">48</span></td>
      <td width="224" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">49</span></td>
      <td width="69" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">50</span></td>
      <td width="122" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">51</span></td>
      <td width="121" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">52</span></td>
      <td width="117" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">53</span></td>
      <td width="57" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">54</span></td>
      <td width="79" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">55</span></td>
      <td width="71" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">56</span></td>
      <td width="144" align="left" valign="top" bgcolor="#376091"  style="color:#FFF; font-size:11px"><span class="th-table">57</span></td>
    </tr>
    
    <?php foreach ($arrObj   as $objRo) { ?>
    <tr>
      <td height='23' align='left' valign='top' style='mso-number-format:\@' bgcolor='#FFFFFF'><?php echo $objRo->getItemRoByNumber(1)->getKardex(); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(1)->getElementValue(),0,8); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(2)->getElementValue(),0,8); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(3)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(4)->getElementValue(),0,2); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(5)->getElementValue(),0,6); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(6)->getElementValue(),0,8); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(7)->getElementValue(),0,6); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(8)->getElementValue(),0,8);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(9)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(10)->getElementValue(),0,8); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(11)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(12)->getElementValue(),0,4); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(13)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(14)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(15)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(16)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(17)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(18)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(19)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(20)->getElementValue(),0,1); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(21)->getElementValue(),0,20);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(22)->getElementValue(),0,11);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(23)->getElementValue(),0,120);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(24)->getElementValue(),0,40);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(25)->getElementValue(),0,40);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(26)->getElementValue(),0,2);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(27)->getElementValue(),0,8);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(28)->getElementValue(),0,1);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(29)->getElementValue(),0,3);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(30)->getElementValue(),0,40);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(31)->getElementValue(),0,4);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(32)->getElementValue(),0,3);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(33)->getElementValue(),0,2);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(34)->getElementValue(),0,12);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(35)->getElementValue(),0,150);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(36)->getElementValue(),0,2);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(37)->getElementValue(),0,2);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(38)->getElementValue(),0,2);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(39)->getElementValue(),0,40);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(40)->getElementValue(),0,1);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(41)->getElementValue(),0,40);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(42)->getElementValue(),0,40);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(43)->getElementValue(),0,40);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(44)->getElementValue(),0,2);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(45)->getElementValue(),0,3);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(46)->getElementValue(),0,1);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(47)->getElementValue(),0,2);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(48)->getElementValue(),0,40);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF' style='mso-number-format:\@'><?php ?><?php echo  substr($objRo->getItemRoByNumber(49)->getElementValue(),0,40);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(50)->getElementValue(),0,3); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(51)->getElementValue(),0,18);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF' style='mso-number-format:0.00'><?php echo substr($objRo->getItemRoByNumber(52)->getElementValue(),0,18); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF' style='mso-number-format:0.00'><?php echo substr($objRo->getItemRoByNumber(53)->getElementValue(),0,18); ?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF' style='mso-number-format:0.00'><?php echo substr($objRo->getItemRoByNumber(54)->getElementValue(),0,6);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF' style='mso-number-format:0.00'><?php echo substr($objRo->getItemRoByNumber(55)->getElementValue(),0,1);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(56)->getElementValue(),0,2);?></td>
      <td align='left' valign='top' bgcolor='#FFFFFF'><?php echo substr($objRo->getItemRoByNumber(57)->getElementValue(),0,12);?></td>
      
    </tr>
    <?php } ?>
  </table>
</div>

<script src="../../Libs/jquery/jquery-3.1.0.min.js" type="text/javascript"></script>
<script src="../../Libs/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">


  $("#btn-export-excel").on('click',function(event) {
    $("#sendHtmlExcel").val( $("<div>").append( $("#table-export-excel").eq(0).clone()).html());
    $("#frm-export-excel").submit();
  });
</script>
</body>
</html>

