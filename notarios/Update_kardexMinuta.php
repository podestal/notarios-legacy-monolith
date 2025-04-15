<?php

include('conexion.php');

$misi       = $_POST['pagmisi'];  // html
$plantilla  = '<p align="center"><strong>ESCRITURA PUBLICA DE COMPRA VENTA DE INMUEBLE /</strong></p>
<p><strong>INTRODUCCIÓN:</strong> EN LA CIUDAD DE LIMA, CAPITAL DE LA REPUBLICA DEL  PERU, A LOS  <strong>DOCE DIAS DE DICIEMBRE DE  2013 ,</strong> <strong>aa aa</strong><strong>, ABOGADO-NOTARIO DE  LIMA, </strong>CON OFICIO NOTARIAL EN<strong>  11, </strong>DISTRITO DE <strong> 11 </strong>EXTIENDO EL PRESENTE  INSTRUMENTO PUBLICO NOTARIAL EN MI REGISTRO DE ESCRITURAS PUBLICAS EN EL QUE  COMPARECEN:                                                                                                    <br />
  VELAZQUEZ  HERRERA, LUIS , QUIEN MANIFIESTA SER DE NACIONALIDAD PERUANA, DE ESTADO CIVIL  SOLTERO , DE OCUPACION Y/O PROFESION INGENIERO DE SISTEMAS, DOMICILIAR EN LAS  FLORES 166, DISTRITO DE LINCE, PROVINCIA Y DEPARTAMENTO DE LIMA SE IDENTIFICA  CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO 07639534 Y DECLARA QUE PROCEDE POR  DERECHO PROPIO                           </p>
<p>DOY FE DE LA CAPACIDAD, LIBERTAD Y CONOCIMIENTO CON QUE  SE OBLIGAN QUIENES COMPARECEN, ASI COMO DE HABERLES IDENTIFICADO, INTELIGENTES  EN EL IDIOMA CASTELLANO Y ME ENTREGAN UNA MINUTA FIRMADA Y AUTORIZADA POR  ABOGADO PARA QUE ELEVE SU CONTENIDO A ESCRITURA PUBLICA, LA MISMA QUE ARCHIVO  EN MI LEGAJO RESPECTIVO CON EL NUMERO DE ORDEN CORRESPONDIENTE Y CUYO TENOR  LITERAL ES EL SIGUIENTE:                                                                                                                                                  <br />
  MINUTA</p>';

$num_kardex = $_REQUEST['num_kardex'];

$sqlminutas = "UPDATE kardex set txa_minuta = '".$plantilla.$misi."' WHERE kardex = '".$num_kardex."' ";
mysql_query($sqlminutas,$conn) or die(mysql_error());

echo $misi;
echo $num_kardex;

echo "grabado satisfactoriamente";

?>









