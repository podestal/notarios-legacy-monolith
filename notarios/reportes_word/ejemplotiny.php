<?php
//llamamos a las librerias de formateo de plantillas de Open Office
    include('../includes/tbs_class.php');
    include('../includes/tinyDoc.class.php');

    $doc = new tinyDoc();

    $doc->setZipMethod('ziparchive');

    $doc->setProcessDir('./tmp');
//Le indicamos el archivo de Open Office que creamos como plantilla
    $doc->createFrom('formato_factura.odp');
//Indicamos el archivo que escribirá, OpenOffice guarda en content.xml la información capturada en el archivo
    $doc->loadXml('content.xml');
//Funcion que formateara la plantilla de Open Office
    crea_factura($doc);

	//executeBasic($doc);
	
//Indicamos que genere uan descarga del archivo para el usuario
    $doc->sendResponse();
//Elimina toda la información que fué creada temporalmente
    $doc->remove();

// #== function crea 
   function executeBasic($doc)
  {
    // create the document
    $doc = new sfTinyDoc();
    $doc->createFrom();

    $doc->loadXml('content.xml');
    $doc->mergeXmlField('field1', 'variable');
    $doc->mergeXmlField('field2', array('id' => 55, 'name' => 'bob'));
    $doc->mergeXmlField('field3', $doc);
    $doc->mergeXmlBlock('block1',
      array(
        array('firstname' => 'Jose'   , 'lastname' => 'Perez'),
        array('firstname' => 'Henry', 'lastname' => 'Ubaldo'),
        array('firstname' => 'Ines'  , 'lastname' => 'Sanchez'),
      )
    );
    $doc->saveXml();
    $doc->close();

    // send and remove the document
    $doc->sendResponse();
    $doc->remove();

    throw new sfStopException;
  }


function crea_factura($doc)
    {
//En el archivo plantilla de de openoffice tenemos [factura.fecha], [factura.subtotla], [factura.iva], [factura.total], [factura.totaltext]
//Lo que hace la clase es cambiar la información por la que asinemos aquí, si vemos asignamos el arreglo a factura y el método usado es mergeXmlField
    $doc->mergeXmlField('factura',
      array(
        'id'         => '1',
        'fecha'       => date('Y-m-d'),
        'subtotal'      => 10250,
        'iva'        => 1537.5,
        'total'   => 10787.5,
        'totaltext'   => 'Diez Mil Setecientos Pesos Cincuenta Centavos',
      )
    );
//Al igual que en factura a cliente le asignamos el arreglo de cliente que tiene las llaves que seran sustituidas en la plantilla
//usamos el metodo mergeXmlField ya que es un arreglo unidimensional
    $doc->mergeXmlField('cliente',
      array(
        'id'         => '1001',
        'nombre'       => 'OaxRom SA de CV',
        'direccion'      => 'Encuentranos en http://www.oaxrom.com',
        'rfc' => 'OAX090101C45'
      )
    );
//Este método es interesante, ya que nos permitirá mostrar listados en la plantilla
//En la plantilla tenemos [detalle.cantida] [detalle.descripcion][detalle;block=table:table-row] [detalle.preciounitario] [detalle.importe]
//Usando la funcion mergeXmlBlock, podremos listar información de un arreglo de arreglos en forma de listas, esto es práctico cuándo se intenta
//mostrar informacion de productos en una factura por ejemplo, donde el numero de productos puede ser 1 o varios, esto lo que comunmente se llama detalle
    $doc->mergeXmlBlock('detalle',
      array(
        array(
          'cantidad'    => 2,
          'descripcion'    => 'Adaptador SPA3102',
          'preciounitario'   => 1450.00,
          'importe'  => 2900
        ),
        array(
          'cantidad'    => 3,
          'descripcion'    => 'Modulos FXO',
          'preciounitario'   => 1400.00,
          'importe'  => 4200.00
        ),
        array(
          'cantidad'    => 1,
          'descripcion'    => 'Router Inalambrico WRT54G ',
          'preciounitario'   => 650,
          'importe'  => 650
        ),
        array(
          'cantidad'    => 1,
          'descripcion'    => 'Tarificador Web Asterisk',
          'preciounitario'   => 2500,
          'importe'  => 2500
        ),
      )
    );
//Ya que la clase asigna los valores, guarda la información
    $doc->saveXml();
            /*
            $doc->loadXml('styles.xml');
            $doc->mergeXmlField('header',
              array(
                'title' => 'made with tinyDoc and',
                'img'   => 'images/samples/openoffice-by-benjamin-bois.png',
              )
            );
            $doc->mergeXmlField('footer',
              array(
                'signature' => 'image credit : Benjamin Bois',
              )
            );
            $doc->saveXml();
         */
//cerramos el archivo
    $doc->close();
    }
?>