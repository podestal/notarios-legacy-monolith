<?php
/** @file
  * The Query Path package provides tools for manipulating a Document Object Model.
  * The two major DOMs are the XML DOM and the HTML DOM. Using Query Path, you can 
  * build, parse, search, and modify DOM documents.
  *
  * To use Query Path, this is the only file you should need to import.
  *
  * Standard usage:
  * @code
  * <?php
  * require 'QueryPath/QueryPath.php';
  * $qp = qp('#myID', '<?xml version="1.0"?><test><foo id="myID"/></test>');
  * $qp->append('<new><elements/></new>')->writeHTML();
  * ?>
  * @endcode
  *
  * The above would print (formatted for readability):
  * @code
  * <?xml version="1.0"?>
  * <test>
  *  <foo id="myID">
  *    <new>
  *      <element/>
  *    </new>
  *  </foo>
  * </test>
  * @endcode
  *
  * To learn about the functions available to a Query Path object, 
  * see {@link QueryPath}. The {@link qp()} function is used to build
  * new QueryPath objects. The documentation for that function explains the
  * wealth of arguments that the function can take.
  *
  * Included with the source code for QueryPath is a complete set of unit tests
  * as well as some example files. Those are good resources for learning about
00037  * how to apply QueryPath's tools. The full API documentation can be generated
00038  * from these files using PHPDocumentor.
00039  *
00040  * If you are interested in building extensions for QueryParser, see the 
00041  * {@link QueryPathExtender} class. There, you will find information on adding
00042  * your own tools to QueryPath.
00043  *
00044  * QueryPath also comes with a full CSS 3 selector parser implementation. If
00045  * you are interested in reusing that in other code, you will want to start
00046  * with {@link CssEventHandler.php}, which is the event interface for the parser.
00047  *
00048  * All of the code in QueryPath is licensed under either the LGPL or an MIT-like
00049  * license (you may choose which you prefer). All of the code is Copyright, 2009
00050  * by Matt Butcher.
00051  *
00052  * @author M Butcher <matt @aleph-null.tv>
00053  * @license http://opensource.org/licenses/lgpl-2.1.php The GNU Lesser GPL (LGPL) or an MIT-like license.
00054  * @see QueryPath
00055  * @see qp()
00056  * @see http://querypath.org The QueryPath home page.
00057  * @see http://api.querypath.org An online version of the API docs.
00058  * @see http://technosophos.com For how-tos and examples.
00059  * @copyright Copyright (c) 2009, Matt Butcher.
00060  * @version 2.1.1
00061  *
00062  */
00063 
00064 /** @addtogroup querypath_core Core API
00065  * Core classes and functions for QueryPath.
00066  *
00067  * These are the classes, objects, and functions that developers who use QueryPath
00068  * are likely to use. The qp() and htmlqp() functions are the best place to start,
00069  * while most of the frequently used methods are part of the QueryPath object.
00070  */
00071 
00072 /** @addtogroup querypath_util Utilities
00073  * Utility classes for QueryPath.
00074  *
00075  * These classes add important, but less-often used features to QueryPath. Some of
00076  * these are used transparently (QueryPathIterator). Others you can use directly in your 
00077  * code (QueryPathEntities).
00078  */
00079 
00080 /*   * @namespace QueryPath
00081  * The core classes that compose QueryPath.
00082  *
00083  * The QueryPath classes contain the brunt of the QueryPath code. If you are 
00084  * interested in working with just the CSS engine, you may want to look at CssEventHandler,
00085  * which can be used without the rest of QueryPath. If you are interested in looking 
00086  * carefully at QueryPath's implementation details, then the QueryPath class is where you 
00087  * should begin. If you are interested in writing extensions, than you may want to look at
00088  * QueryPathExtension, and also at some of the simple extensions, such as QPXML.
00089  */
00090  
00091 /**
00092  * Regular expression for checking whether a string looks like XML.
00093  * @deprecated This is no longer used in QueryPath.
00094  */
00095 define('ML_EXP','/^[^<]*(<(.|\s)+>)[^>]*$/');
00096 
00097 /**
00098  * The CssEventHandler interfaces with the CSS parser.
00099  */
00100 require_once 'CssEventHandler.php';
00101 /**
00102  * The extender is used to provide support for extensions.
00103  */
00104 require_once 'QueryPathExtension.php';
00105 
00106 /**
00107  * Build a new Query Path.
00108  * This builds a new Query Path object. The new object can be used for 
00109  * reading, search, and modifying a document.
00110  *
00111  * While it is permissible to directly create new instances of a QueryPath
00112  * implementation, it is not advised. Instead, you should use this function
00113  * as a factory.
00114  *
00115  * Example:
00116  * @code
00117  * <?php
00118  * qp(); // New empty QueryPath
00119  * qp('path/to/file.xml'); // From a file
00120  * qp('<html><head></head><body></body></html>'); // From HTML or XML
00121  * qp(QueryPath::XHTML_STUB); // From a basic HTML document.
00122  * qp(QueryPath::XHTML_STUB, 'title'); // Create one from a basic HTML doc and position it at the title element.
00123  *
00124  * // Most of the time, methods are chained directly off of this call.
00125  * qp(QueryPath::XHTML_STUB, 'body')->append('<h1>Title</h1>')->addClass('body-class');
00126  * ?>
00127  * @endcode
00128  *
00129  * This function is used internally by QueryPath. Anything that modifies the
00130  * behavior of this function may also modify the behavior of common QueryPath
00131  * methods.
00132  *
00133  * <b>Types of documents that QueryPath can support</b>
00134  *
00135  *  qp() can take any of these as its first argument:
00136  *
00137  *  - A string of XML or HTML (See {@link XHTML_STUB})
00138  *  - A path on the file system or a URL
00139  *  - A {@link DOMDocument} object
00140  *  - A {@link SimpleXMLElement} object.
00141  *  - A {@link DOMNode} object.
00142  *  - An array of {@link DOMNode} objects (generally {@link DOMElement} nodes).
00143  *  - Another {@link QueryPath} object.
00144  *
00145  * Keep in mind that most features of QueryPath operate on elements. Other 
00146  * sorts of DOMNodes might not work with all features.
00147  *
00148  * <b>Supported Options</b>
00149  *  - context: A stream context object. This is used to pass context info
00150  *    to the underlying file IO subsystem.
00151  *  - encoding: A valid character encoding, such as 'utf-8' or 'ISO-8859-1'.
00152  *    The default is system-dependant, typically UTF-8. Note that this is 
00153  *    only used when creating new documents, not when reading existing content.
00154  *    (See convert_to_encoding below.)
00155  *  - parser_flags: An OR-combined set of parser flags. The flags supported
00156  *    by the DOMDocument PHP class are all supported here.
00157  *  - omit_xml_declaration: Boolean. If this is TRUE, then certain output
00158  *    methods (like {@link QueryPath::xml()}) will omit the XML declaration
00159  *    from the beginning of a document.
00160  *  - replace_entities: Boolean. If this is TRUE, then any of the insertion
00161  *    functions (before(), append(), etc.) will replace named entities with
00162  *    their decimal equivalent, and will replace un-escaped ampersands with 
00163  *    a numeric entity equivalent.
00164  *  - ignore_parser_warnings: Boolean. If this is TRUE, then E_WARNING messages
00165  *    generated by the XML parser will not cause QueryPath to throw an exception.
00166  *    This is useful when parsing
00167  *    badly mangled HTML, or when failure to find files should not result in 
00168  *    an exception. By default, this is FALSE -- that is, parsing warnings and 
00169  *    IO warnings throw exceptions.
00170  *  - convert_to_encoding: Use the MB library to convert the document to the 
00171  *    named encoding before parsing. This is useful for old HTML (set it to
00172  *    iso-8859-1 for best results). If this is not supplied, no character set 
00173  *    conversion will be performed. See {@link mb_convert_encoding()}.
00174  *    (QueryPath 1.3 and later)
00175  *  - convert_from_encoding: If 'convert_to_encoding' is set, this option can be
00176  *    used to explicitly define what character set the source document is using.
00177  *    By default, QueryPath will allow the MB library to guess the encoding.
00178  *    (QueryPath 1.3 and later)
00179  *  - strip_low_ascii: If this is set to TRUE then markup will have all low ASCII
00180  *    characters (<32) stripped out before parsing. This is good in cases where 
00181  *    icky HTML has (illegal) low characters in the document.
00182  *  - use_parser: If 'xml', Parse the document as XML. If 'html', parse the 
00183  *    document as HTML. Note that the XML parser is very strict, while the 
00184  *    HTML parser is more lenient, but does enforce some of the DTD/Schema.
00185  *    <i>By default, QueryPath autodetects the type.</i>
00186  *  - escape_xhtml_js_css_sections: XHTML needs script and css sections to be
00187  *    escaped. Yet older readers do not handle CDATA sections, and comments do not
00188  *    work properly (for numerous reasons). By default, QueryPath's *XHTML methods
00189  *    will wrap a script body with a CDATA declaration inside of C-style comments.
00190  *    If you want to change this, you can set this option with one of the 
00191  *    JS_CSS_ESCAPE_* constants, or you can write your own.
00192  *  - QueryPath_class: (ADVANCED) Use this to set the actual classname that
00193  *    {@link qp()} loads as a QueryPath instance. It is assumed that the 
00194  *    class is either {@link QueryPath} or a subclass thereof. See the test 
00195  *    cases for an example.
00196  *
00197  * @ingroup querypath_core
00198  * @param mixed $document
00199  *  A document in one of the forms listed above.
00200  * @param string $string 
00201  *  A CSS 3 selector.
00202  * @param array $options
00203  *  An associative array of options. Currently supported options are listed above.
00204  * @return QueryPath
00205  */
00206 function qp($document = NULL, $string = NULL, $options = array()) {
00207   
00208   $qpClass = isset($options['QueryPath_class']) ? $options['QueryPath_class'] : 'QueryPath';
00209   
00210   $qp = new $qpClass($document, $string, $options);
00211   return $qp;
00212 }
00213 
00214 /**
00215  * A special-purpose version of {@link qp()} designed specifically for HTML.
00216  *
00217  * XHTML (if valid) can be easily parsed by {@link qp()} with no problems. However,
00218  * because of the way that libxml handles HTML, there are several common steps that
00219  * need to be taken to reliably parse non-XML HTML documents. This function is
00220  * a convenience tool for configuring QueryPath to parse HTML.
00221  *
00222  * The following options are automatically set unless overridden:
00223  *  - ignore_parser_warnings: TRUE
00224  *  - convert_to_encoding: ISO-8859-1 (the best for the HTML parser).
00225  *  - convert_from_encoding: auto (autodetect encoding)
00226  *  - use_parser: html
00227  *
00228  * Parser warning messages are also suppressed, so if the parser emits a warning,
00229  * the application will not be notified. This is equivalent to 
00230  * calling @code@qp()@endcode.
00231  *
00232  * Warning: Character set conversions will only work if the Multi-Byte (mb) library
00233  * is installed and enabled. This is usually enabled, but not always.
00234  *
00235  * @ingroup querypath_core
00236  * @see qp()
00237  */
00238 function htmlqp($document = NULL, $selector = NULL, $options = array()) {
00239 
00240   // Need a way to force an HTML parse instead of an XML parse when the 
00241   // doctype is XHTML, since many XHTML documents are not valid XML
00242   // (because of coding errors, not by design).
00243   
00244   $options += array(
00245     'ignore_parser_warnings' => TRUE,
00246     'convert_to_encoding' => 'ISO-8859-1',
00247     'convert_from_encoding' => 'auto',
00248     //'replace_entities' => TRUE,
00249     'use_parser' => 'html',
00250     // This is stripping actually necessary low ASCII.
00251     //'strip_low_ascii' => TRUE,
00252   );
00253   return @qp($document, $selector, $options);
00254 }
00255 
00256 /**
00257  * The Query Path object is the primary tool in this library.
00258  *
00259  * To create a new Query Path, use the {@link qp()} function.
00260  *
00261  * If you are new to these documents, start at the {@link QueryPath.php} page.
00262  * There you will find a quick guide to the tools contained in this project.
00263  *
00264  * A note on serialization: QueryPath uses DOM classes internally, and those
00265  * do not serialize well at all. In addition, QueryPath may contain many
00266  * extensions, and there is no guarantee that extensions can serialize. The
00267  * moral of the story: Don't serialize QueryPath.
00268  *
00269  * @see qp()
00270  * @see QueryPath.php
00271  * @ingroup querypath_core
00272  */
00273 class QueryPath implements IteratorAggregate, Countable {
00274   
00275   /**
00276    * The version string for this version of QueryPath.
00277    *
00278    * Standard releases will be of the following form: <MAJOR>.<MINOR>[.<PATCH>][-STABILITY].
00279    *
00280    * Examples:
00281    * - 2.0
00282    * - 2.1.1
00283    * - 2.0-alpha1
00284    *
00285    * Developer releases will always be of the form dev-<DATE>.
00286    *
00287    * @since 2.0
00288    */
00289   const VERSION = '2.1.1';
00290   
00291   /**
00292    * This is a stub HTML 4.01 document.
00293    *
00294    * <b>Using {@link QueryPath::XHTML_STUB} is preferred.</b>
00295    *
00296    * This is primarily for generating legacy HTML content. Modern web applications
00297    * should use {@link QueryPath::XHTML_STUB}.
00298    *
00299    * Use this stub with the HTML familiy of methods ({@link html()}, 
00300    * {@link writeHTML()}, {@link innerHTML()}).
00301    */
00302   const HTML_STUB = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
00303   <html lang="en">
00304   <head>
00305   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
00306   <title>Untitled</title>
00307   </head>
00308   <body></body>
00309   </html>';
00310   
00311   /**
00312    * This is a stub XHTML document.
00313    * 
00314    * Since XHTML is an XML format, you should use XML functions with this document
00315    * fragment. For example, you should use {@link xml()}, {@link innerXML()}, and 
00316    * {@link writeXML()}.
00317    * 
00318    * This can be passed into {@link qp()} to begin a new basic HTML document.
00319    *
00320    * Example:
00321    * @code
00322    * $qp = qp(QueryPath::XHTML_STUB); // Creates a new XHTML document
00323    * $qp->writeXML(); // Writes the document as well-formed XHTML.
00324    * @endcode
00325    * @since 2.0
00326    */
00327   const XHTML_STUB = '<?xml version="1.0"?>
00328   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
00329   <html xmlns="http://www.w3.org/1999/xhtml">
00330   <head>
00331   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
00332   <title>Untitled</title>
00333   </head>
00334   <body></body>
00335   </html>';
00336   
00337   /**
00338    * Default parser flags.
00339    *
00340    * These are flags that will be used if no global or local flags override them.
00341    * @since 2.0
00342    */
00343   const DEFAULT_PARSER_FLAGS = NULL;
00344   
00345   const JS_CSS_ESCAPE_CDATA = '\\1';
00346   const JS_CSS_ESCAPE_CDATA_CCOMMENT = '/* \\1 */';
00347   const JS_CSS_ESCAPE_CDATA_DOUBLESLASH = '// \\1';
00348   const JS_CSS_ESCAPE_NONE = '';
00349   
00350   //const IGNORE_ERRORS = 1544; //E_NOTICE | E_USER_WARNING | E_USER_NOTICE;
00351   private $errTypes = 771; //E_ERROR; | E_USER_ERROR;
00352   
00353   /**
00354    * The base DOMDocument.
00355    */
00356   protected $document = NULL;
00357   private $options = array(
00358     'parser_flags' => NULL,
00359     'omit_xml_declaration' => FALSE,
00360     'replace_entities' => FALSE,
00361     'exception_level' => 771, // E_ERROR | E_USER_ERROR | E_USER_WARNING | E_WARNING
00362     'ignore_parser_warnings' => FALSE,
00363     'escape_xhtml_js_css_sections' => self::JS_CSS_ESCAPE_CDATA_CCOMMENT,
00364   );
00365   /**
00366    * The array of matches.
00367    */
00368   protected $matches = array();
00369   /**
00370    * The last array of matches.
00371    */
00372   protected $last = array(); // Last set of matches.
00373   private $ext = array(); // Extensions array.
00374   
00375   /**
00376    * The number of current matches.
00377    *
00378    * @see count()
00379    */
00380   public $length = 0;
00381   
00382   /**
00383    * Constructor.
00384    *
00385    * This should not be called directly. Use the {@link qp()} factory function
00386    * instead.
00387    *
00388    * @param mixed $document 
00389    *   A document-like object.
00390    * @param string $string
00391    *   A CSS 3 Selector
00392    * @param array $options
00393    *   An associative array of options.
00394    * @see qp()
00395    */
00396   public function __construct($document = NULL, $string = NULL, $options = array()) {
00397     $string = trim($string);
00398     $this->options = $options + QueryPathOptions::get() + $this->options;
00399     
00400     $parser_flags = isset($options['parser_flags']) ? $options['parser_flags'] : self::DEFAULT_PARSER_FLAGS;
00401     if (!empty($this->options['ignore_parser_warnings'])) {
00402       // Don't convert parser warnings into exceptions.
00403       $this->errTypes = 257; //E_ERROR | E_USER_ERROR;
00404     }
00405     elseif (isset($this->options['exception_level'])) {
00406       // Set the error level at which exceptions will be thrown. By default, 
00407       // QueryPath will throw exceptions for 
00408       // E_ERROR | E_USER_ERROR | E_WARNING | E_USER_WARNING.
00409       $this->errTypes = $this->options['exception_level'];
00410     }
00411     
00412     // Empty: Just create an empty QP.
00413     if (empty($document)) {
00414       $this->document = isset($this->options['encoding']) ? new DOMDocument('1.0', $this->options['encoding']) : new DOMDocument();
00415       $this->setMatches(new SplObjectStorage());
00416     }
00417     // Figure out if document is DOM, HTML/XML, or a filename
00418     elseif (is_object($document)) {
00419       
00420       if ($document instanceof QueryPath) {
00421         $this->matches = $document->get(NULL, TRUE);
00422         if ($this->matches->count() > 0)
00423           $this->document = $this->getFirstMatch()->ownerDocument;
00424       }
00425       elseif ($document instanceof DOMDocument) {
00426         $this->document = $document;
00427         //$this->matches = $this->matches($document->documentElement);
00428         $this->setMatches($document->documentElement);
00429       }
00430       elseif ($document instanceof DOMNode) {
00431         $this->document = $document->ownerDocument;
00432         //$this->matches = array($document);
00433         $this->setMatches($document);
00434       }
00435       elseif ($document instanceof SimpleXMLElement) {
00436         $import = dom_import_simplexml($document);
00437         $this->document = $import->ownerDocument;
00438         //$this->matches = array($import);
00439         $this->setMatches($import);
00440       }
00441       elseif ($document instanceof SplObjectStorage) {
00442         if ($document->count() == 0) {
00443           throw new QueryPathException('Cannot initialize QueryPath from an empty SplObjectStore');
00444         }
00445         $this->matches = $document;
00446         $this->document = $this->getFirstMatch()->ownerDocument;

00447       }
00448       else {
00449         throw new QueryPathException('Unsupported class type: ' . get_class($document));
00450       }
00451     }
00452     elseif (is_array($document)) {
00453       //trigger_error('Detected deprecated array support', E_USER_NOTICE);
00454       if (!empty($document) && $document[0] instanceof DOMNode) {
00455         $found = new SplObjectStorage();
00456         foreach ($document as $item) $found->attach($item);
00457         //$this->matches = $found;
00458         $this->setMatches($found);
00459         $this->document = $this->getFirstMatch()->ownerDocument;
00460       }
00461     }
00462     elseif ($this->isXMLish($document)) {
00463       // $document is a string with XML
00464       $this->document = $this->parseXMLString($document);
00465       $this->setMatches($this->document->documentElement);
00466     }
00467     else {
00468       
00469       // $document is a filename
00470       $context = empty($options['context']) ? NULL : $options['context'];
00471       $this->document = $this->parseXMLFile($document, $parser_flags, $context);
00472       $this->setMatches($this->document->documentElement);
00473     }
00474     
00475     // Do a find if the second param was set.
00476     if (isset($string) && strlen($string) > 0) {
00477       $this->find($string);
00478     }
00479   }
00480   
00481   /**
00482    * A static function for transforming data into a Data URL.
00483    *
00484    * This can be used to create Data URLs for injection into CSS, JavaScript, or other 
00485    * non-XML/HTML content. If you are working with QP objects, you may want to use
00486    * {@link dataURL()} instead.
00487    *
00488    * @param mixed $data
00489    *  The contents to inject as the data. The value can be any one of the following:
00490    *  - A URL: If this is given, then the subsystem will read the content from that URL. THIS 
00491    *    MUST BE A FULL URL, not a relative path.
00492    *  - A string of data: If this is given, then the subsystem will encode the string.
00493    *  - A stream or file handle: If this is given, the stream's contents will be encoded
00494    *    and inserted as data.
00495    *  (Note that we make the assumption here that you would never want to set data to be
00496    *  a URL. If this is an incorrect assumption, file a bug.)
00497    * @param string $mime
00498    *  The MIME type of the document.
00499    * @param resource $context
00500    *  A valid context. Use this only if you need to pass a stream context. This is only necessary
00501    *  if $data is a URL. (See {@link stream_context_create()}).
00502    * @return 
00503    *  An encoded data URL.
00504    */
00505   public static function encodeDataURL($data, $mime = 'application/octet-stream', $context = NULL) {
00506     if (is_resource($data)) {
00507       $data = stream_get_contents($data);
00508     }
00509     elseif (filter_var($data, FILTER_VALIDATE_URL)) {
00510       $data = file_get_contents($data, FALSE, $context);
00511     }
00512     
00513     $encoded = base64_encode($data);
00514     
00515     return 'data:' . $mime . ';base64,' . $encoded;
00516   }
00517   
00518   /**
00519    * Get the effective options for the current QueryPath object.
00520    *
00521    * This returns an associative array of all of the options as set
00522    * for the current QueryPath object. This includes default options,
00523    * options directly passed in via {@link qp()} or the constructor,
00524    * an options set in the {@link QueryPathOptions} object.
00525    *
00526    * The order of merging options is this:
00527    *  - Options passed in using {@link qp()} are highest priority, and will
00528    *    override other options.
00529    *  - Options set with {@link QueryPathOptions} will override default options,
00530    *    but can be overridden by options passed into {@link qp()}.
00531    *  - Default options will be used when no overrides are present.
00532    *
00533    * This function will return the options currently used, with the above option
00534    * overriding having been calculated already.
00535    *
00536    * @return array
00537    *  An associative array of options, calculated from defaults and overridden 
00538    *  options. 
00539    * @see qp()
00540    * @see QueryPathOptions::set()
00541    * @see QueryPathOptions::merge()
00542    * @since 2.0
00543    */
00544   public function getOptions() {
00545     return $this->options;
00546   }
00547   
00548   /**
00549    * Select the root element of the document.
00550    *
00551    * This sets the current match to the document's root element. For 
00552    * practical purposes, this is the same as:
00553    * @code
00554    * qp($someDoc)->find(':root');
00555    * @endcode
00556    * However, since it doesn't invoke a parser, it has less overhead. It also 
00557    * works in cases where the QueryPath has been reduced to zero elements (a
00558    * case that is not handled by find(':root') because there is no element
00559    * whose root can be found).
00560    *
00561    * @param string $selector
00562    *  A selector. If this is supplied, QueryPath will navigate to the 
00563    *  document root and then run the query. (Added in QueryPath 2.0 Beta 2) 
00564    * @return QueryPath
00565    *  The QueryPath object, wrapping the root element (document element)
00566    *  for the current document.
00567    */
00568   public function top($selector = NULL) {
00569     $this->setMatches($this->document->documentElement);
00570     // print '=====================' . PHP_EOL;
00571     // var_dump($this->document);
00572     // print '=====================' . PHP_EOL;
00573     return !empty($selector) ? $this->find($selector) : $this;
00574   }
00575   
00576   /**
00577    * Given a CSS Selector, find matching items.
00578    *
00579    * @param string $selector
00580    *   CSS 3 Selector
00581    * @return QueryPath
00582    * @see filter()
00583    * @see is()
00584    * @todo If a find() returns zero matches, then a subsequent find() will
00585    *  also return zero matches, even if that find has a selector like :root.
00586    *  The reason for this is that the {@link QueryPathCssEventHandler} does
00587    *  not set the root of the document tree if it cannot find any elements
00588    *  from which to determine what the root is. The workaround is to use 
00589    *  {@link top()} to select the root element again.
00590    */
00591   public function find($selector) {
00592     
00593     // Optimize for ID/Class searches. These two take a long time
00594     // when a rdp is used. Using an XPath pushes work to C code.
00595     $ids = array();
00596     
00597     $regex = '/^#([\w-]+)$|^\.([\w-]+)$/'; // $1 is ID, $2 is class.
00598     //$regex = '/^#([\w-]+)$/';
00599     if (preg_match($regex, $selector, $ids) === 1) {
00600       // If $1 is a match, we have an ID.
00601       if (!empty($ids[1])) {
00602         $xpath = new DOMXPath($this->document);
00603         foreach ($this->matches as $item) {
00604           
00605           // For whatever reasons, the .// does not work correctly
00606           // if the selected element is the root element. So we have
00607           // an awful hack.
00608           if ($item->isSameNode($this->document->documentElement) ) {
00609             $xpathQuery = "//*[@id='{$ids[1]}']";
00610           }
00611           // This is the correct XPath query.
00612           else {
00613             $xpathQuery = ".//*[@id='{$ids[1]}']";
00614           }
00615           //$nl = $xpath->query("//*[@id='{$ids[1]}']", $item);
00616           //$nl = $xpath->query(".//*[@id='{$ids[1]}']", $item);
00617           $nl = $xpath->query($xpathQuery, $item);
00618           if ($nl->length > 0) {
00619             $this->setMatches($nl->item(0));
00620             break;
00621           }
00622           else {
00623             // If no match is found, we set an empty.
00624             $this->noMatches();
00625           }
00626         }
00627       }
00628       // Quick search for class values. While the XPath can't do it
00629       // all, it is faster than doing a recusive node search.
00630       else {
00631         $xpath = new DOMXPath($this->document);
00632         $found = new SplObjectStorage();
00633         foreach ($this->matches as $item) {
00634           // See comments on this in the #id code above.
00635           if ($item->isSameNode($this->document->documentElement) ) {
00636             $xpathQuery = "//*[@class]";
00637           }
00638           // This is the correct XPath query.
00639           else {
00640             $xpathQuery = ".//*[@class]";
00641           }
00642           $nl = $xpath->query($xpathQuery, $item);
00643           for ($i = 0; $i < $nl->length; ++$i) {
00644             $vals = explode(' ', $nl->item($i)->getAttribute('class'));
00645             if (in_array($ids[2], $vals)) $found->attach($nl->item($i));
00646           }
00647         }
00648         $this->setMatches($found);
00649       }
00650       
00651       return $this;
00652     }
00653     
00654     
00655     $query = new QueryPathCssEventHandler($this->matches);
00656     $query->find($selector);
00657     //$this->matches = $query->getMatches();
00658     $this->setMatches($query->getMatches());
00659     return $this;
00660   }
00661   
00662   /**
00663    * Execute an XPath query and store the results in the QueryPath.
00664    *
00665    * Most methods in this class support CSS 3 Selectors. Sometimes, though,
00666    * XPath provides a finer-grained query language. Use this to execute
00667    * XPath queries.
00668    *
00669    * Beware, though. QueryPath works best on DOM Elements, but an XPath 
00670    * query can return other nodes, strings, and values. These may not work with
00671    * other QueryPath functions (though you will be able to access the
00672    * values with {@link get()}).
00673    *
00674    * @param string $query
00675    *  An XPath query.
00676    * @param array $options
00677    *  Currently supported options are:
00678    *   - 'namespace_prefix': And XML namespace prefix to be used as the default. Used 
00679    *      in conjunction with 'namespace_uri'
00680    *   - 'namespace_uri': The URI to be used as the default namespace URI. Used 
00681    *      with 'namespace_prefix'
00682    * @return QueryPath 
00683    *  A QueryPath object wrapping the results of the query.
00684    * @see find()
00685    * @author M Butcher
00686    * @author Xavier Prud'homme
00687    */
00688   public function xpath($query, $options = array()) {
00689     $xpath = new DOMXPath($this->document);
00690     
00691     // Register a default namespace.
00692     if (!empty($options['namespace_prefix']) && !empty($options['namespace_uri'])) {
00693       $xpath->registerNamespace($options['namespace_prefix'], $options['namespace_uri']);
00694     }
00695     
00696     $found = new SplObjectStorage();
00697     foreach ($this->matches as $item) {
00698       $nl = $xpath->query($query, $item);
00699       if ($nl->length > 0) {
00700         for ($i = 0; $i < $nl->length; ++$i) $found->attach($nl->item($i));
00701       }
00702     }
00703     $this->setMatches($found);
00704     return $this;
00705   }
00706   
00707   /**
00708    * Get the number of elements currently wrapped by this object.
00709    *
00710    * Note that there is no length property on this object.
00711    *
00712    * @return int
00713    *  Number of items in the object.
00714    * @deprecated QueryPath now implements Countable, so use count().
00715    */
00716   public function size() {
00717     return $this->matches->count();
00718   }
00719   
00720   /**
00721    * Get the number of elements currently wrapped by this object.
00722    *
00723    * Since QueryPath is Countable, the PHP count() function can also
00724    * be used on a QueryPath.
00725    *
00726    * @code
00727    * <?php
00728    *  count(qp($xml, 'div'));
00729    * ?>
00730    * @endcode
00731    *
00732    * @return int
00733    *  The number of matches in the QueryPath.
00734    */
00735   public function count() {
00736     return $this->matches->count();
00737   }
00738   
00739   /**
00740    * Get one or all elements from this object.
00741    *
00742    * When called with no paramaters, this returns all objects wrapped by 
00743    * the QueryPath. Typically, these are DOMElement objects (unless you have
00744    * used {@link map()}, {@link xpath()}, or other methods that can select
00745    * non-elements).
00746    *
00747    * When called with an index, it will return the item in the QueryPath with 
00748    * that index number.
00749    *
00750    * Calling this method does not change the QueryPath (e.g. it is 
00751    * non-destructive).
00752    *
00753    * You can use qp()->get() to iterate over all elements matched. You can
00754    * also iterate over qp() itself (QueryPath implementations must be Traversable). 
00755    * In the later case, though, each item 
00756    * will be wrapped in a QueryPath object. To learn more about iterating
00757    * in QueryPath, see {@link examples/techniques.php}.
00758    *
00759    * @param int $index
00760    *   If specified, then only this index value will be returned. If this 
00761    *   index is out of bounds, a NULL will be returned.
00762    * @param boolean $asObject
00763    *   If this is TRUE, an {@link SplObjectStorage} object will be returned 
00764    *   instead of an array. This is the preferred method for extensions to use.
00765    * @return mixed
00766    *   If an index is passed, one element will be returned. If no index is
00767    *   present, an array of all matches will be returned.
00768    * @see eq()
00769    * @see SplObjectStorage
00770    */
00771   public function get($index = NULL, $asObject = FALSE) {
00772     if (isset($index)) {
00773       return ($this->size() > $index) ? $this->getNthMatch($index) : NULL;
00774     }
00775     // Retain support for legacy.
00776     if (!$asObject) {
00777       $matches = array();
00778       foreach ($this->matches as $m) $matches[] = $m;
00779       return $matches;
00780     }
00781     return $this->matches;
00782   }
00783   
00784   /**
00785    * Get the DOMDocument that we currently work with.
00786    *
00787    * This returns the current DOMDocument. Any changes made to this document will be
00788    * accessible to QueryPath, as both will share access to the same object.
00789    * 
00790    * @return DOMDocument
00791    */
00792   public function document() {
00793     return $this->document;
00794   }
00795   
00796   /**
00797    * On an XML document, load all XIncludes.
00798    *
00799    * @return QueryPath
00800    */
00801   public function xinclude() {
00802     $this->document->xinclude();
00803     return $this;
00804   }
00805   
00806   /**
00807    * Get all current elements wrapped in an array.
00808    * Compatibility function for jQuery 1.4, but identical to calling {@link get()}
00809    * with no parameters.
00810    *
00811    * @return array
00812    *  An array of DOMNodes (typically DOMElements).
00813    */
00814   public function toArray() {
00815     return $this->get();
00816   }
00817   /**
00818    * Get/set an attribute.
00819    * - If no parameters are specified, this returns an associative array of all 
00820    *   name/value pairs.
00821    * - If both $name and $value are set, then this will set the attribute name/value
00822    *   pair for all items in this object. 
00823    * - If $name is set, and is an array, then
00824    *   all attributes in the array will be set for all items in this object.
00825    * - If $name is a string and is set, then the attribute value will be returned.
00826    *
00827    * When an attribute value is retrieved, only the attribute value of the FIRST
00828    * match is returned.
00829    *
00830    * @param mixed $name
00831    *   The name of the attribute or an associative array of name/value pairs.
00832    * @param string $value
00833    *   A value (used only when setting an individual property).
00834    * @return mixed
00835    *   If this was a setter request, return the QueryPath object. If this was
00836    *   an access request (getter), return the string value.
00837    * @see removeAttr()
00838    * @see tag()
00839    * @see hasAttr()
00840    * @see hasClass()
00841    */
00842   public function attr($name = NULL, $value = NULL) {
00843     
00844     // Default case: Return all attributes as an assoc array.
00845     if (is_null($name)) {
00846       if ($this->matches->count() == 0) return NULL;
00847       $ele = $this->getFirstMatch();
00848       $buffer = array();
00849       
00850       // This does not appear to be part of the DOM
00851       // spec. Nor is it documented. But it works.
00852       foreach ($ele->attributes as $name => $attrNode) {
00853         $buffer[$name] = $attrNode->value;
00854       }
00855       return $buffer;
00856     }
00857     
00858     // multi-setter
00859     if (is_array($name)) {
00860       foreach ($name as $k => $v) {
00861         foreach ($this->matches as $m) $m->setAttribute($k, $v);
00862       }
00863       return $this;
00864     }
00865     // setter
00866     if (isset($value)) {
00867       foreach ($this->matches as $m) $m->setAttribute($name, $value);
00868       return $this;
00869     }
00870     
00871     //getter
00872     if ($this->matches->count() == 0) return NULL;
00873     
00874     // Special node type handler:
00875     if ($name == 'nodeType') {
00876       return $this->getFirstMatch()->nodeType;
00877     }
00878     
00879     // Always return first match's attr.
00880     return $this->getFirstMatch()->getAttribute($name);
00881   }
00882   /**
00883    * Check to see if the given attribute is present.
00884    *
00885    * This returns TRUE if <em>all</em> selected items have the attribute, or 
00886    * FALSE if at least one item does not have the attribute.
00887    *
00888    * @param string $attrName
00889    *  The attribute name.
00890    * @return boolean
00891    *  TRUE if all matches have the attribute, FALSE otherwise.
00892    * @since 2.0
00893    * @see attr()
00894    * @see hasClass()
00895    */
00896   public function hasAttr($attrName) {
00897     foreach ($this->matches as $match) {
00898       if (!$match->hasAttribute($attrName)) return FALSE;
00899     }
00900     return TRUE;
00901   }
00902   
00903   /**
00904    * Set/get a CSS value for the current element(s).
00905    * This sets the CSS value for each element in the QueryPath object.
00906    * It does this by setting (or getting) the style attribute (without a namespace).
00907    *
00908    * For example, consider this code:
00909    * @code
00910    * <?php
00911    * qp(HTML_STUB, 'body')->css('background-color','red')->html();
00912    * ?>
00913    * @endcode
00914    * This will return the following HTML:
00915    * @code
00916    * <body style="background-color: red"/>
00917    * @endcode
00918    *
00919    * If no parameters are passed into this function, then the current style
00920    * element will be returned unparsed. Example:
00921    * @code
00922    * <?php
00923    * qp(HTML_STUB, 'body')->css('background-color','red')->css();
00924    * ?>
00925    * @endcode
00926    * This will return the following:
00927    * @code
00928    * background-color: red
00929    * @endcode
00930    *
00931    * As of QueryPath 2.1, existing style attributes will be merged with new attributes.
00932    * (In previous versions of QueryPath, a call to css() overwrite the existing style
00933    * values).
00934    *
00935    * @param mixed $name
00936    *  If this is a string, it will be used as a CSS name. If it is an array,
00937    *  this will assume it is an array of name/value pairs of CSS rules. It will
00938    *  apply all rules to all elements in the set.
00939    * @param string $value
00940    *  The value to set. This is only set if $name is a string.
00941    * @return QueryPath
00942    */
00943   public function css($name = NULL, $value = '') {
00944     if (empty($name)) {
00945       return $this->attr('style');
00946     }
00947     
00948     // Get any existing CSS.
00949     $css = array();
00950     foreach ($this->matches as $match) {
00951       $style = $match->getAttribute('style');
00952       if (!empty($style)) {
00953         // XXX: Is this sufficient?
00954         $style_array = explode(';', $style);
00955         foreach ($style_array as $item) {
00956           $item = trim($item);
00957           
00958           // Skip empty attributes.
00959           if (strlen($item) == 0) continue;
00960           
00961           list($css_att, $css_val) = explode(':',$item, 2);
00962           $css[$css_att] = trim($css_val);
00963         }
00964       }
00965     }
00966     
00967     if (is_array($name)) {
00968       // Use array_merge instead of + to preserve order.
00969       $css = array_merge($css, $name);
00970     }
00971     else {
00972       $css[$name] = $value;
00973     }
00974     
00975     // Collapse CSS into a string.
00976     $format = '%s: %s;';
00977     $css_string = '';
00978     foreach ($css as $n => $v) {
00979       $css_string .= sprintf($format, $n, trim($v));
00980     }
00981     
00982     $this->attr('style', $css_string);
00983     return $this;
00984   }
00985   
00986   /**
00987    * Insert or retrieve a Data URL.
00988    *
00989    * When called with just $attr, it will fetch the result, attempt to decode it, and
00990    * return an array with the MIME type and the application data.
00991    *
00992    * When called with both $attr and $data, it will inject the data into all selected elements
00993    * So @code$qp->dataURL('src', file_get_contents('my.png'), 'image/png')@endcode will inject 
00994    * the given PNG image into the selected elements.
00995    *
00996    * The current implementation only knows how to encode and decode Base 64 data.
00997    *
00998    * Note that this is known *not* to work on IE 6, but should render fine in other browsers.
00999    *
01000    * @param string $attr
01001    *  The name of the attribute.
01002    * @param mixed $data
01003    *  The contents to inject as the data. The value can be any one of the following:
01004    *  - A URL: If this is given, then the subsystem will read the content from that URL. THIS 
01005    *    MUST BE A FULL URL, not a relative path.
01006    *  - A string of data: If this is given, then the subsystem will encode the string.
01007    *  - A stream or file handle: If this is given, the stream's contents will be encoded
01008    *    and inserted as data.
01009    *  (Note that we make the assumption here that you would never want to set data to be
01010    *  a URL. If this is an incorrect assumption, file a bug.)
01011    * @param string $mime
01012    *  The MIME type of the document.
01013    * @param resource $context
01014    *  A valid context. Use this only if you need to pass a stream context. This is only necessary
01015    *  if $data is a URL. (See {@link stream_context_create()}).
01016    * @return
01017    *  If this is called as a setter, this will return a QueryPath object. Otherwise, it
01018    *  will attempt to fetch data out of the attribute and return that.
01019    * @see http://en.wikipedia.org/wiki/Data:_URL
01020    * @see attr()
01021    * @since 2.1
01022    */
01023   public function dataURL($attr, $data = NULL, $mime = 'application/octet-stream', $context = NULL) {
01024     if (is_null($data)) {
01025       // Attempt to fetch the data
01026       $data = $this->attr($attr);
01027       if (empty($data) || is_array($data) || strpos($data, 'data:') !== 0) {
01028         return;
01029       }
01030       
01031       // So 1 and 2 should be MIME types, and 3 should be the base64-encoded data.
01032       $regex = '/^data:([a-zA-Z0-9]+)\/([a-zA-Z0-9]+);base64,(.*)$/';
01033       $matches = array();
01034       preg_match($regex, $data, $matches);
01035       
01036       if (!empty($matches)) {
01037         $result = array(
01038           'mime' => $matches[1] . '/' . $matches[2],
01039           'data' => base64_decode($matches[3]),
01040         );
01041         return $result;
01042       }
01043     }
01044     else {
01045       
01046       $attVal = self::encodeDataURL($data, $mime, $context);
01047       
01048       return $this->attr($attr, $attVal);
01049       
01050     }
01051   }
01052   
01053 
01054   
01055   /**
01056    * Remove the named attribute from all elements in the current QueryPath.
01057    *
01058    * This will remove any attribute with the given name. It will do this on each
01059    * item currently wrapped by QueryPath.
01060    *
01061    * As is the case in jQuery, this operation is not considered destructive.
01062    *
01063    * @param string $name
01064    *  Name of the parameter to remove.
01065    * @return QueryPath
01066    *  The QueryPath object with the same elements.
01067    * @see attr()
01068    */
01069   public function removeAttr($name) {
01070     foreach ($this->matches as $m) {
01071       //if ($m->hasAttribute($name))
01072         $m->removeAttribute($name);
01073     }
01074     return $this;
01075   }
01076   /**
01077    * Reduce the matched set to just one.
01078    *
01079    * This will take a matched set and reduce it to just one item -- the item 
01080    * at the index specified. This is a destructive operation, and can be undone
01081    * with {@link end()}.
01082    *
01083    * @param $index
01084    *  The index of the element to keep. The rest will be 
01085    *  discarded.
01086    * @return QueryPath
01087    * @see get()
01088    * @see is()
01089    * @see end()
01090    */
01091   public function eq($index) {
01092     // XXX: Might there be a more efficient way of doing this?
01093     $this->setMatches($this->getNthMatch($index));
01094     return $this;
01095   }
01096   /**
01097    * Given a selector, this checks to see if the current set has one or more matches.
01098    *
01099    * Unlike jQuery's version, this supports full selectors (not just simple ones).
01100    *
01101    * @param string $selector
01102    *   The selector to search for. As of QueryPath 2.1.1, this also supports passing a
01103    *   DOMNode object.
01104    * @return boolean
01105    *   TRUE if one or more elements match. FALSE if no match is found.
01106    * @see get()
01107    * @see eq()
01108    */
01109   public function is($selector) {
01110     
01111     if (is_object($selector)) {
01112       if ($selector instanceof DOMNode) {
01113         return count($this->matches) == 1 && $selector->isSameNode($this->get(0));
01114       }
01115       elseif ($selector instanceof Traversable) {
01116         if (count($selector) != count($this->matches)) {
01117           return FALSE;
01118         }
01119         // Without $seen, there is an edge case here if $selector contains the same object
01120         // more than once, but the counts are equal. For example, [a, a, a, a] will
01121         // pass an is() on [a, b, c, d]. We use the $seen SPLOS to prevent this.
01122         $seen = new SplObjectStorage();
01123         foreach ($selector as $item) {
01124           if (!$this->matches->contains($item) || $seen->contains($item)) {
01125             return FALSE;
01126           }
01127           $seen->attach($item);
01128         }
01129         return TRUE;
01130       }
01131       throw new Exception('Cannot compare an object to a QueryPath.');
01132       return FALSE;
01133     }
01134     
01135     foreach ($this->matches as $m) {
01136       $q = new QueryPathCssEventHandler($m);
01137       if ($q->find($selector)->getMatches()->count()) {
01138         return TRUE;
01139       }
01140     }
01141     return FALSE;
01142   }
01143   /**
01144    * Filter a list down to only elements that match the selector.
01145    * Use this, for example, to find all elements with a class, or with 
01146    * certain children.
01147    *
01148    * @param string $selector
01149    *   The selector to use as a filter.
01150    * @return QueryPath
01151    *   The QueryPath with non-matching items filtered out.
01152    * @see filterLambda()
01153    * @see filterCallback()
01154    * @see map()
01155    * @see find()
01156    * @see is()
01157    */
01158   public function filter($selector) {
01159     $found = new SplObjectStorage();
01160     foreach ($this->matches as $m) if (qp($m, NULL, $this->options)->is($selector)) $found->attach($m);
01161     $this->setMatches($found);
01162     return $this;
01163   }
01164   /**
01165    * Filter based on a lambda function.
01166    *
01167    * The function string will be executed as if it were the body of a 
01168    * function. It is passed two arguments:
01169    * - $index: The index of the item.
01170    * - $item: The current Element.
01171    * If the function returns boolean FALSE, the item will be removed from
01172    * the list of elements. Otherwise it will be kept.
01173    *
01174    * Example:
01175    * @code
01176    * qp('li')->filterLambda('qp($item)->attr("id") == "test"');
01177    * @endcode
01178    *
01179    * The above would filter down the list to only an item whose ID is
01180    * 'text'.
01181    *
01182    * @param string $fn
01183    *  Inline lambda function in a string.
01184    * @return QueryPath
01185    * @see filter()
01186    * @see map()
01187    * @see mapLambda()
01188    * @see filterCallback()
01189    */
01190   public function filterLambda($fn) {
01191     $function = create_function('$index, $item', $fn);
01192     $found = new SplObjectStorage();
01193     $i = 0;
01194     foreach ($this->matches as $item)
01195       if ($function($i++, $item) !== FALSE) $found->attach($item);
01196     
01197     $this->setMatches($found);
01198     return $this;
01199   }
01200   
01201   /**
01202    * Use regular expressions to filter based on the text content of matched elements.
01203    *
01204    * Only items that match the given regular expression will be kept. All others will
01205    * be removed.
01206    *
01207    * The regular expression is run against the <i>text content</i> (the PCDATA) of the 
01208    * elements. This is a way of filtering elements based on their content. 
01209    *
01210    * Example:
01211    * @code
01212    *  <?xml version="1.0"?>
01213    *  <div>Hello <i>World</i></div>
01214    * @endcode
01215    *
01216    * @code
01217    *  <?php
01218    *    // This will be 1.
01219    *    qp($xml, 'div')->filterPreg('/World/')->size();
01220    *  ?>
01221    * @endcode
01222    *
01223    * The return value above will be 1 because the text content of @codeqp($xml, 'div')@endcode is
01224    * @codeHello World@endcode.
01225    *
01226    * Compare this to the behavior of the <em>:contains()</em> CSS3 pseudo-class.
01227    * 
01228    * @param string $regex
01229    *  A regular expression.
01230    * @return QueryPath
01231    * @see filter()
01232    * @see filterCallback()
01233    * @see preg_match()
01234    */
01235   public function filterPreg($regex) {
01236     
01237     $found = new SplObjectStorage();
01238     
01239     foreach ($this->matches as $item) {
01240       if (preg_match($regex, $item->textContent) > 0) {
01241         $found->attach($item);
01242       }
01243     }
01244     $this->setMatches($found);
01245     
01246     return $this;
01247   }
01248   /**
01249    * Filter based on a callback function.
01250    *
01251    * A callback may be any of the following:
01252    *  - a function: 'my_func'.
01253    *  - an object/method combo: $obj, 'myMethod'
01254    *  - a class/method combo: 'MyClass', 'myMethod'
01255    * Note that classes are passed in strings. Objects are not.
01256    *
01257    * Each callback is passed to arguments:
01258    *  - $index: The index position of the object in the array.
01259    *  - $item: The item to be operated upon.
01260    *
01261    * If the callback function returns FALSE, the item will be removed from the 
01262    * set of matches. Otherwise the item will be considered a match and left alone.
01263    *
01264    * @param callback $callback.
01265    *   A callback either as a string (function) or an array (object, method OR 
01266    *   classname, method).
01267    * @return QueryPath
01268    *   Query path object augmented according to the function.
01269    * @see filter()
01270    * @see filterLambda()
01271    * @see map()
01272    * @see is()
01273    * @see find()
01274    */
01275   public function filterCallback($callback) {
01276     $found = new SplObjectStorage();
01277     $i = 0;
01278     if (is_callable($callback)) {
01279       foreach($this->matches as $item) 
01280         if (call_user_func($callback, $i++, $item) !== FALSE) $found->attach($item);
01281     }
01282     else {
01283       throw new QueryPathException('The specified callback is not callable.');
01284     }
01285     $this->setMatches($found);
01286     return $this;
01287   }
01288   /**
01289    * Filter a list to contain only items that do NOT match.
01290    *
01291    * @param string $selector
01292    *  A selector to use as a negation filter. If the filter is matched, the 
01293    *  element will be removed from the list.
01294    * @return QueryPath
01295    *  The QueryPath object with matching items filtered out.
01296    * @see find()
01297    */
01298   public function not($selector) {
01299     $found = new SplObjectStorage();
01300     if ($selector instanceof DOMElement) {
01301       foreach ($this->matches as $m) if ($m !== $selector) $found->attach($m); 
01302     }
01303     elseif (is_array($selector)) {
01304       foreach ($this->matches as $m) {
01305         if (!in_array($m, $selector, TRUE)) $found->attach($m);
01306       }
01307     }
01308     elseif ($selector instanceof SplObjectStorage) {
01309       foreach ($this->matches as $m) if ($selector->contains($m)) $found->attach($m); 
01310     }
01311     else {
01312       foreach ($this->matches as $m) if (!qp($m, NULL, $this->options)->is($selector)) $found->attach($m);
01313     }
01314     $this->setMatches($found);
01315     return $this;
01316   }
01317   /**
01318    * Get an item's index.
01319    *
01320    * Given a DOMElement, get the index from the matches. This is the 
01321    * converse of {@link get()}.
01322    *
01323    * @param DOMElement $subject
01324    *  The item to match.
01325    * 
01326    * @return mixed
01327    *  The index as an integer (if found), or boolean FALSE. Since 0 is a 
01328    *  valid index, you should use strong equality (===) to test..
01329    * @see get()
01330    * @see is()
01331    */
01332   public function index($subject) {
01333     
01334     $i = 0;
01335     foreach ($this->matches as $m) {
01336       if ($m === $subject) {
01337         return $i;
01338       }
01339       ++$i;
01340     }
01341     return FALSE;
01342   }
01343   /**
01344    * Run a function on each item in a set.
01345    *
01346    * The mapping callback can return anything. Whatever it returns will be
01347    * stored as a match in the set, though. This means that afer a map call, 
01348    * there is no guarantee that the elements in the set will behave correctly
01349    * with other QueryPath functions.
01350    *
01351    * Callback rules:
01352    * - If the callback returns NULL, the item will be removed from the array.
01353    * - If the callback returns an array, the entire array will be stored in 
01354    *   the results.
01355    * - If the callback returns anything else, it will be appended to the array 
01356    *   of matches.
01357    *
01358    * @param callback $callback
01359    *  The function or callback to use. The callback will be passed two params:
01360    *  - $index: The index position in the list of items wrapped by this object.
01361    *  - $item: The current item.
01362    *
01363    * @return QueryPath
01364    *  The QueryPath object wrapping a list of whatever values were returned
01365    *  by each run of the callback.
01366    *
01367    * @see QueryPath::get()
01368    * @see filter()
01369    * @see find()
01370    */
01371   public function map($callback) {
01372     $found = new SplObjectStorage();
01373     
01374     if (is_callable($callback)) {
01375       $i = 0;
01376       foreach ($this->matches as $item) {
01377         $c = call_user_func($callback, $i, $item);
01378         if (isset($c)) {
01379           if (is_array($c) || $c instanceof Iterable) {
01380             foreach ($c as $retval) {
01381               if (!is_object($retval)) {
01382                 $tmp = new stdClass();
01383                 $tmp->textContent = $retval;
01384                 $retval = $tmp;
01385               }
01386               $found->attach($retval);
01387             }
01388           }
01389           else {
01390             if (!is_object($c)) {
01391               $tmp = new stdClass();
01392               $tmp->textContent = $c;
01393               $c = $tmp;
01394             }
01395             $found->attach($c);
01396           }
01397         }
01398         ++$i;
01399       }
01400     }
01401     else {
01402       throw new QueryPathException('Callback is not callable.');
01403     }
01404     $this->setMatches($found, FALSE);
01405     return $this;
01406   }
01407   /**
01408    * Narrow the items in this object down to only a slice of the starting items.
01409    *
01410    * @param integer $start
01411    *  Where in the list of matches to begin the slice.
01412    * @param integer $length
01413    *  The number of items to include in the slice. If nothing is specified, the 
01414    *  all remaining matches (from $start onward) will be included in the sliced
01415    *  list.
01416    * @return QueryPath
01417    * @see array_slice()
01418    */
01419   public function slice($start, $length = 0) {
01420     $end = $length;
01421     $found = new SplObjectStorage();
01422     if ($start >= $this->size()) {
01423       $this->setMatches($found);
01424       return $this;
01425     }
01426     
01427     $i = $j = 0;
01428     foreach ($this->matches as $m) {
01429       if ($i >= $start) {
01430         if ($end > 0 && $j >= $end) {
01431           break;
01432         }
01433         $found->attach($m);
01434         ++$j;
01435       }
01436       ++$i;
01437     }
01438     
01439     $this->setMatches($found);
01440     return $this;
01441   }
01442   /**
01443    * Run a callback on each item in the list of items.
01444    *
01445    * Rules of the callback:
01446    * - A callback is passed two variables: $index and $item. (There is no 
01447    *   special treatment of $this, as there is in jQuery.)
01448    *   - You will want to pass $item by reference if it is not an
01449    *     object (DOMNodes are all objects).
01450    * - A callback that returns FALSE will stop execution of the each() loop. This
01451    *   works like break in a standard loop.
01452    * - A TRUE return value from the callback is analogous to a continue statement.
01453    * - All other return values are ignored.
01454    *
01455    * @param callback $callback
01456    *  The callback to run.
01457    * @return QueryPath
01458    *  The QueryPath.
01459    * @see eachLambda()
01460    * @see filter()
01461    * @see map()
01462    */
01463   public function each($callback) {
01464     if (is_callable($callback)) {
01465       $i = 0;
01466       foreach ($this->matches as $item) {
01467         if (call_user_func($callback, $i, $item) === FALSE) return $this;
01468         ++$i;
01469       }
01470     }
01471     else {
01472       throw new QueryPathException('Callback is not callable.');
01473     }
01474     return $this;
01475   }
01476   /**
01477    * An each() iterator that takes a lambda function.
01478    * 
01479    * @param string $lambda
01480    *  The lambda function. This will be passed ($index, &$item).
01481    * @return QueryPath
01482    *  The QueryPath object.
01483    * @see each()
01484    * @see filterLambda()
01485    * @see filterCallback()
01486    * @see map()
01487    */
01488   public function eachLambda($lambda) {
01489     $index = 0;
01490     foreach ($this->matches as $item) {
01491       $fn = create_function('$index, &$item', $lambda);
01492       if ($fn($index, $item) === FALSE) return $this;
01493       ++$index;
01494     }
01495     return $this;
01496   }
01497   /**
01498    * Insert the given markup as the last child.
01499    *
01500    * The markup will be inserted into each match in the set.
01501    *
01502    * The same element cannot be inserted multiple times into a document. DOM
01503    * documents do not allow a single object to be inserted multiple times 
01504    * into the DOM. To insert the same XML repeatedly, we must first clone
01505    * the object. This has one practical implication: Once you have inserted
01506    * an element into the object, you cannot further manipulate the original 
01507    * element and expect the changes to be replciated in the appended object.
01508    * (They are not the same -- there is no shared reference.) Instead, you
01509    * will need to retrieve the appended object and operate on that.
01510    *
01511    * @param mixed $data
01512    *  This can be either a string (the usual case), or a DOM Element.
01513    * @return QueryPath
01514    *  The QueryPath object.
01515    * @see appendTo()
01516    * @see prepend()
01517    * @throws QueryPathException
01518    *  Thrown if $data is an unsupported object type.
01519    */
01520   public function append($data) {
01521     $data = $this->prepareInsert($data);
01522     if (isset($data)) {
01523       if (empty($this->document->documentElement) && $this->matches->count() == 0) {
01524         // Then we assume we are writing to the doc root
01525         $this->document->appendChild($data);
01526         $found = new SplObjectStorage();
01527         $found->attach($this->document->documentElement);
01528         $this->setMatches($found);
01529       }
01530       else {
01531         // You can only append in item once. So in cases where we
01532         // need to append multiple times, we have to clone the node.
01533         foreach ($this->matches as $m) { 
01534           // DOMDocumentFragments are even more troublesome, as they don't
01535           // always clone correctly. So we have to clone their children.
01536           if ($data instanceof DOMDocumentFragment) {
01537             foreach ($data->childNodes as $n)
01538               $m->appendChild($n->cloneNode(TRUE));
01539           }
01540           else {
01541             // Otherwise a standard clone will do.
01542             $m->appendChild($data->cloneNode(TRUE));
01543           }
01544           
01545         }
01546       }
01547         
01548     }
01549     return $this;
01550   }
01551   /**
01552    * Append the current elements to the destination passed into the function.
01553    *
01554    * This cycles through all of the current matches and appends them to 
01555    * the context given in $destination. If a selector is provided then the 
01556    * $destination is queried (using that selector) prior to the data being
01557    * appended. The data is then appended to the found items.
01558    *
01559    * @param QueryPath $dest
01560    *  A QueryPath object that will be appended to.
01561    * @return QueryPath
01562    *  The original QueryPath, unaltered. Only the destination QueryPath will
01563    *  be modified.
01564    * @see append()
01565    * @see prependTo()
01566    * @throws QueryPathException
01567    *  Thrown if $data is an unsupported object type.
01568    */
01569   public function appendTo(QueryPath $dest) {
01570     foreach ($this->matches as $m) $dest->append($m);
01571     return $this;
01572   }
01573   /**
01574    * Insert the given markup as the first child.
01575    *
01576    * The markup will be inserted into each match in the set.
01577    *
01578    * @param mixed $data
01579    *  This can be either a string (the usual case), or a DOM Element.
01580    * @return QueryPath
01581    * @see append()
01582    * @see before()
01583    * @see after()
01584    * @see prependTo()
01585    * @throws QueryPathException
01586    *  Thrown if $data is an unsupported object type.
01587    */
01588   public function prepend($data) {
01589     $data = $this->prepareInsert($data);
01590     if (isset($data)) {
01591       foreach ($this->matches as $m) {
01592         $ins = $data->cloneNode(TRUE);
01593         if ($m->hasChildNodes())
01594           $m->insertBefore($ins, $m->childNodes->item(0));
01595         else
01596           $m->appendChild($ins);
01597       }
01598     }
01599     return $this;
01600   }
01601   /**
01602    * Take all nodes in the current object and prepend them to the children nodes of
01603    * each matched node in the passed-in QueryPath object.
01604    *
01605    * This will iterate through each item in the current QueryPath object and 
01606    * add each item to the beginning of the children of each element in the 
01607    * passed-in QueryPath object.
01608    *
01609    * @see insertBefore()
01610    * @see insertAfter()
01611    * @see prepend()
01612    * @see appendTo()
01613    * @param QueryPath $dest
01614    *  The destination QueryPath object.
01615    * @return QueryPath
01616    *  The original QueryPath, unmodified. NOT the destination QueryPath.
01617    * @throws QueryPathException
01618    *  Thrown if $data is an unsupported object type.
01619    */
01620   public function prependTo(QueryPath $dest) {
01621     foreach ($this->matches as $m) $dest->prepend($m);
01622     return $this;
01623   }
01624 
01625   /**
01626    * Insert the given data before each element in the current set of matches.
01627    *
01628    * This will take the give data (XML or HTML) and put it before each of the items that 
01629    * the QueryPath object currently contains. Contrast this with after().
01630    * 
01631    * @param mixed $data
01632    *  The data to be inserted. This can be XML in a string, a DomFragment, a DOMElement,
01633    *  or the other usual suspects. (See {@link qp()}).
01634    * @return QueryPath
01635    *  Returns the QueryPath with the new modifications. The list of elements currently
01636    *  selected will remain the same.
01637    * @see insertBefore()
01638    * @see after()
01639    * @see append()
01640    * @see prepend()
01641    * @throws QueryPathException
01642    *  Thrown if $data is an unsupported object type.
01643    */
01644   public function before($data) {
01645     $data = $this->prepareInsert($data);
01646     foreach ($this->matches as $m) {
01647       $ins = $data->cloneNode(TRUE);
01648       $m->parentNode->insertBefore($ins, $m);
01649     }
01650     
01651     return $this;
01652   }
01653   /**
01654    * Insert the current elements into the destination document.
01655    * The items are inserted before each element in the given QueryPath document.
01656    * That is, they will be siblings with the current elements.
01657    *
01658    * @param QueryPath $dest
01659    *  Destination QueryPath document.
01660    * @return QueryPath
01661    *  The current QueryPath object, unaltered. Only the destination QueryPath
01662    *  object is altered.
01663    * @see before()
01664    * @see insertAfter()
01665    * @see appendTo()
01666    * @throws QueryPathException
01667    *  Thrown if $data is an unsupported object type.
01668    */
01669   public function insertBefore(QueryPath $dest) {
01670     foreach ($this->matches as $m) $dest->before($m);
01671     return $this;
01672   }
01673   /**
01674    * Insert the contents of the current QueryPath after the nodes in the 
01675    * destination QueryPath object.
01676    *
01677    * @param QueryPath $dest
01678    *  Destination object where the current elements will be deposited.
01679    * @return QueryPath
01680    *  The present QueryPath, unaltered. Only the destination object is altered.
01681    * @see after()
01682    * @see insertBefore()
01683    * @see append()
01684    * @throws QueryPathException
01685    *  Thrown if $data is an unsupported object type.
01686    */
01687   public function insertAfter(QueryPath $dest) {
01688     foreach ($this->matches as $m) $dest->after($m);
01689     return $this;
01690   }
01691   /**
01692    * Insert the given data after each element in the current QueryPath object.
01693    *
01694    * This inserts the element as a peer to the currently matched elements.
01695    * Contrast this with {@link append()}, which inserts the data as children
01696    * of matched elements.
01697    *
01698    * @param mixed $data
01699    *  The data to be appended.
01700    * @return QueryPath
01701    *  The QueryPath object (with the items inserted).
01702    * @see before()
01703    * @see append()
01704    * @throws QueryPathException
01705    *  Thrown if $data is an unsupported object type.
01706    */
01707   public function after($data) {
01708     $data = $this->prepareInsert($data);
01709     foreach ($this->matches as $m) {
01710       $ins = $data->cloneNode(TRUE);
01711       if (isset($m->nextSibling)) 
01712         $m->parentNode->insertBefore($ins, $m->nextSibling);
01713       else
01714         $m->parentNode->appendChild($ins);
01715     }
01716     return $this;
01717   }
01718   /**
01719    * Replace the existing element(s) in the list with a new one.
01720    *
01721    * @param mixed $new
01722    *  A DOMElement or XML in a string. This will replace all elements
01723    *  currently wrapped in the QueryPath object.
01724    * @return QueryPath
01725    *  The QueryPath object wrapping <b>the items that were removed</b>.
01726    *  This remains consistent with the jQuery API.
01727    * @see append()
01728    * @see prepend()
01729    * @see before()
01730    * @see after()
01731    * @see remove()
01732    * @see replaceAll()
01733    */
01734   public function replaceWith($new) {
01735     $data = $this->prepareInsert($new);
01736     $found = new SplObjectStorage();
01737     foreach ($this->matches as $m) {
01738       $parent = $m->parentNode;
01739       $parent->insertBefore($data->cloneNode(TRUE), $m);
01740       $found->attach($parent->removeChild($m));
01741     }
01742     $this->setMatches($found);
01743     return $this;
01744   }
01745   /**
01746    * Remove the parent element from the selected node or nodes.
01747    *
01748    * This takes the given list of nodes and "unwraps" them, moving them out of their parent
01749    * node, and then deleting the parent node.
01750    *
01751    * For example, consider this:
01752    *
01753    * @code
01754    *   <root><wrapper><content/></wrapper></root>
01755    * @endcode
01756    * 
01757    * Now we can run this code:
01758    * @code
01759    *   qp($xml, 'content')->unwrap();
01760    * @endcode
01761    *
01762    * This will result in:
01763    *
01764    * @code
01765    *   <root><content/></root>
01766    * @endcode
01767    * This is the opposite of {@link wrap()}.
01768    *
01769    * <b>The root element cannot be unwrapped.</b> It has no parents.
01770    * If you attempt to use unwrap on a root element, this will throw a QueryPathException.
01771    * (You can, however, "Unwrap" a child that is a direct descendant of the root element. This
01772    * will remove the root element, and replace the child as the root element. Be careful, though.
01773    * You cannot set more than one child as a root element.)
01774    *
01775    * @return QueryPath
01776    *  The QueryPath object, with the same element(s) selected.
01777    * @throws QueryPathException
01778    *  An exception is thrown if one attempts to unwrap a root element.
01779    * @see wrap()
01780    * @since 2.1
01781    * @author mbutcher
01782    */
01783   public function unwrap() {
01784     
01785     // We do this in two loops in order to
01786     // capture the case where two matches are
01787     // under the same parent. Othwerwise we might
01788     // remove a match before we can move it.
01789     $parents = new SplObjectStorage();
01790     foreach ($this->matches as $m) {
01791       
01792       // Cannot unwrap the root element.
01793       if ($m->isSameNode($m->ownerDocument->documentElement)) {
01794         throw new QueryPathException('Cannot unwrap the root element.');
01795       }
01796       
01797       // Move children to peer of parent.
01798       $parent = $m->parentNode;
01799       $old = $parent->removeChild($m);
01800       $parent->parentNode->insertBefore($old, $parent);
01801       $parents->attach($parent);
01802     }
01803     
01804     // Now that all the children are moved, we 
01805     // remove all of the parents.
01806     foreach ($parents as $ele) {
01807       $ele->parentNode->removeChild($ele);
01808     }
01809     
01810     return $this;
01811   }
01812   /**
01813    * Wrap each element inside of the given markup.
01814    *
01815    * Markup is usually a string, but it can also be a DOMNode, a document
01816    * fragment, a SimpleXMLElement, or another QueryPath object (in which case
01817    * the first item in the list will be used.)
01818    *
01819    * @param mixed $markup 
01820    *  Markup that will wrap each element in the current list.
01821    * @return QueryPath
01822    *  The QueryPath object with the wrapping changes made.
01823    * @see wrapAll()
01824    * @see wrapInner()
01825    */
01826   public function wrap($markup) {
01827     $data = $this->prepareInsert($markup);
01828     
01829     // If the markup passed in is empty, we don't do any wrapping.
01830     if (empty($data)) {
01831       return $this;
01832     }
01833     
01834     foreach ($this->matches as $m) {
01835       $copy = $data->firstChild->cloneNode(TRUE);
01836       
01837       // XXX: Should be able to avoid doing this over and over.
01838       if ($copy->hasChildNodes()) {
01839         $deepest = $this->deepestNode($copy); 
01840         // FIXME: Does this need a different data structure?
01841         $bottom = $deepest[0];
01842       }
01843       else
01844         $bottom = $copy;
01845 
01846       $parent = $m->parentNode;
01847       $parent->insertBefore($copy, $m);
01848       $m = $parent->removeChild($m);
01849       $bottom->appendChild($m);
01850       //$parent->appendChild($copy);
01851     }
01852     return $this;  
01853   }
01854   /**
01855    * Wrap all elements inside of the given markup.
01856    *
01857    * So all elements will be grouped together under this single marked up 
01858    * item. This works by first determining the parent element of the first item
01859    * in the list. It then moves all of the matching elements under the wrapper
01860    * and inserts the wrapper where that first element was found. (This is in 
01861    * accordance with the way jQuery works.)
01862    *
01863    * Markup is usually XML in a string, but it can also be a DOMNode, a document
01864    * fragment, a SimpleXMLElement, or another QueryPath object (in which case
01865    * the first item in the list will be used.)
01866    * 
01867    * @param string $markup 
01868    *  Markup that will wrap all elements in the current list.
01869    * @return QueryPath
01870    *  The QueryPath object with the wrapping changes made.
01871    * @see wrap()
01872    * @see wrapInner()
01873    */
01874   public function wrapAll($markup) {
01875     if ($this->matches->count() == 0) return;
01876     
01877     $data = $this->prepareInsert($markup);
01878     
01879     if (empty($data)) {
01880       return $this;
01881     }
01882     
01883     if ($data->hasChildNodes()) {
01884       $deepest = $this->deepestNode($data); 
01885       // FIXME: Does this need fixing?
01886       $bottom = $deepest[0];
01887     }
01888     else
01889       $bottom = $data;
01890 
01891     $first = $this->getFirstMatch();
01892     $parent = $first->parentNode;
01893     $parent->insertBefore($data, $first);
01894     foreach ($this->matches as $m) {
01895       $bottom->appendChild($m->parentNode->removeChild($m));
01896     }
01897     return $this;
01898   }
01899   /**
01900    * Wrap the child elements of each item in the list with the given markup.
01901    *
01902    * Markup is usually a string, but it can also be a DOMNode, a document
01903    * fragment, a SimpleXMLElement, or another QueryPath object (in which case
01904    * the first item in the list will be used.)
01905    *
01906    * @param string $markup 
01907    *  Markup that will wrap children of each element in the current list.
01908    * @return QueryPath
01909    *  The QueryPath object with the wrapping changes made.
01910    * @see wrap()
01911    * @see wrapAll()
01912    */
01913   public function wrapInner($markup) {
01914     $data = $this->prepareInsert($markup);
01915     
01916     // No data? Short circuit.
01917     if (empty($data)) return $this;
01918     
01919     if ($data->hasChildNodes()) {
01920       $deepest = $this->deepestNode($data); 
01921       // FIXME: ???
01922       $bottom = $deepest[0];
01923     }
01924     else
01925       $bottom = $data;
01926       
01927     foreach ($this->matches as $m) {
01928       if ($m->hasChildNodes()) {
01929         while($m->firstChild) {
01930           $kid = $m->removeChild($m->firstChild);
01931           $bottom->appendChild($kid);
01932         }
01933       }
01934       $m->appendChild($data);
01935     }
01936     return $this; 
01937   }
01938   /**
01939    * Reduce the set of matches to the deepest child node in the tree.
01940    *
01941    * This loops through the matches and looks for the deepest child node of all of 
01942    * the matches. "Deepest", here, is relative to the nodes in the list. It is 
01943    * calculated as the distance from the starting node to the most distant child
01944    * node. In other words, it is not necessarily the farthest node from the root
01945    * element, but the farthest note from the matched element.
01946    *
01947    * In the case where there are multiple nodes at the same depth, all of the 
01948    * nodes at that depth will be included.
01949    *
01950    * @return QueryPath
01951    *  The QueryPath wrapping the single deepest node.
01952    */
01953   public function deepest() {
01954     $deepest = 0;
01955     $winner = new SplObjectStorage();
01956     foreach ($this->matches as $m) {
01957       $local_deepest = 0;
01958       $local_ele = $this->deepestNode($m, 0, NULL, $local_deepest);
01959       
01960       // Replace with the new deepest.
01961       if ($local_deepest > $deepest) {
01962         $winner = new SplObjectStorage();
01963         foreach ($local_ele as $lele) $winner->attach($lele);
01964         $deepest = $local_deepest;
01965       }
01966       // Augument with other equally deep elements.
01967       elseif ($local_deepest == $deepest) {
01968         foreach ($local_ele as $lele)
01969           $winner->attach($lele);
01970       }
01971     }
01972     $this->setMatches($winner);
01973     return $this;
01974   }
01975   
01976   /**
01977    * A depth-checking function. Typically, it only needs to be
01978    * invoked with the first parameter. The rest are used for recursion.
01979    * @see deepest();
01980    * @param DOMNode $ele
01981    *  The element.
01982    * @param int $depth
01983    *  The depth guage
01984    * @param mixed $current
01985    *  The current set.
01986    * @param DOMNode $deepest
01987    *  A reference to the current deepest node.
01988    * @return array
01989    *  Returns an array of DOM nodes.
01990    */
01991   protected function deepestNode(DOMNode $ele, $depth = 0, $current = NULL, &$deepest = NULL) {
01992     // FIXME: Should this use SplObjectStorage?
01993     if (!isset($current)) $current = array($ele);
01994     if (!isset($deepest)) $deepest = $depth;
01995     if ($ele->hasChildNodes()) {
01996       foreach ($ele->childNodes as $child) {
01997         if ($child->nodeType === XML_ELEMENT_NODE) {
01998           $current = $this->deepestNode($child, $depth + 1, $current, $deepest);
01999         }
02000       }
02001     }
02002     elseif ($depth > $deepest) {
02003       $current = array($ele);
02004       $deepest = $depth;
02005     }
02006     elseif ($depth === $deepest) {
02007       $current[] = $ele;
02008     }
02009     return $current;
02010   }
02011   
02012   /**
02013    * Prepare an item for insertion into a DOM.
02014    *
02015    * This handles a variety of boilerplate tasks that need doing before an 
02016    * indeterminate object can be inserted into a DOM tree.
02017    * - If item is a string, this is converted into a document fragment and returned.
02018    * - If item is a QueryPath, then the first item is retrieved and this call function
02019    *   is called recursivel.
02020    * - If the item is a DOMNode, it is imported into the current DOM if necessary.
02021    * - If the item is a SimpleXMLElement, it is converted into a DOM node and then
02022    *   imported.
02023    *
02024    * @param mixed $item
02025    *  Item to prepare for insert.
02026    * @return mixed
02027    *  Returns the prepared item.
02028    * @throws QueryPathException
02029    *  Thrown if the object passed in is not of a supprted object type.
02030    */
02031   protected function prepareInsert($item) {
02032     if(empty($item)) {
02033       return;
02034     }
02035     elseif (is_string($item)) {
02036       // If configured to do so, replace all entities.
02037       if ($this->options['replace_entities']) {
02038         $item = QueryPathEntities::replaceAllEntities($item);
02039       }
02040       
02041       $frag = $this->document->createDocumentFragment();
02042       try {
02043         set_error_handler(array('QueryPathParseException', 'initializeFromError'), $this->errTypes);
02044         $frag->appendXML($item);
02045       }
02046       // Simulate a finally block.
02047       catch (Exception $e) {
02048         restore_error_handler();
02049         throw $e;
02050       }
02051       restore_error_handler();
02052       return $frag;
02053     }
02054     elseif ($item instanceof QueryPath) {
02055       if ($item->size() == 0) 
02056         return;
02057         
02058       return $this->prepareInsert($item->get(0));
02059     }
02060     elseif ($item instanceof DOMNode) {
02061       if ($item->ownerDocument !== $this->document) {
02062         // Deep clone this and attach it to this document
02063         $item = $this->document->importNode($item, TRUE);
02064       }
02065       return $item;
02066     }
02067     elseif ($item instanceof SimpleXMLElement) {
02068       $element = dom_import_simplexml($item);
02069       return $this->document->importNode($element, TRUE);
02070     }
02071     // What should we do here?
02072     //var_dump($item);
02073     throw new QueryPathException("Cannot prepare item of unsupported type: " . gettype($item));
02074   }
02075   /**
02076    * The tag name of the first element in the list.
02077    *
02078    * This returns the tag name of the first element in the list of matches. If
02079    * the list is empty, an empty string will be used.
02080    *
02081    * @see replaceAll()
02082    * @see replaceWith()
02083    * @return string
02084    *  The tag name of the first element in the list.
02085    */
02086   public function tag() {
02087     return ($this->size() > 0) ? $this->getFirstMatch()->tagName : '';
02088   }
02089   /**
02090    * Remove any items from the list if they match the selector.
02091    *
02092    * In other words, each item that matches the selector will be remove 
02093    * from the DOM document. The returned QueryPath wraps the list of 
02094    * removed elements.
02095    *
02096    * If no selector is specified, this will remove all current matches from
02097    * the document.
02098    *
02099    * @param string $selector
02100    *  A CSS Selector.
02101    * @return QueryPath
02102    *  The Query path wrapping a list of removed items.
02103    * @see replaceAll()
02104    * @see replaceWith()
02105    * @see removeChildren()
02106    */
02107   public function remove($selector = NULL) {
02108     if(!empty($selector)) {
02109       // Do a non-destructive find.
02110       $query = new QueryPathCssEventHandler($this->matches);
02111       $query->find($selector);
02112       $matches = $query->getMatches();
02113     }
02114     else {
02115       $matches = $this->matches;
02116     }
02117 
02118     $found = new SplObjectStorage();
02119     foreach ($matches as $item) {
02120       // The item returned is (according to docs) different from 
02121       // the one passed in, so we have to re-store it.
02122       $found->attach($item->parentNode->removeChild($item));
02123     }
02124     
02125     // Return a clone QueryPath with just the removed items.
02126     return new QueryPath($found);
02127   }
02128   /**
02129    * This replaces everything that matches the selector with the first value
02130    * in the current list.
02131    *
02132    * This is the reverse of replaceWith.
02133    *
02134    * Unlike jQuery, QueryPath cannot assume a default document. Consequently,
02135    * you must specify the intended destination document. If it is omitted, the
02136    * present document is assumed to be tthe document. However, that can result
02137    * in undefined behavior if the selector and the replacement are not sufficiently
02138    * distinct.
02139    *
02140    * @param string $selector
02141    *  The selector.
02142    * @param DOMDocument $document
02143    *  The destination document.
02144    * @return QueryPath
02145    *  The QueryPath wrapping the modified document.
02146    * @deprecated Due to the fact that this is not a particularly friendly method,
02147    *  and that it can be easily replicated using {@see replaceWith()}, it is to be 
02148    *  considered deprecated.
02149    * @see remove()
02150    * @see replaceWith()
02151    */
02152   public function replaceAll($selector, DOMDocument $document) {
02153     $replacement = $this->size() > 0 ? $this->getFirstMatch() : $this->document->createTextNode('');
02154     
02155     $c = new QueryPathCssEventHandler($document);
02156     $c->find($selector);
02157     $temp = $c->getMatches();
02158     foreach ($temp as $item) {
02159       $node = $replacement->cloneNode();
02160       $node = $document->importNode($node);
02161       $item->parentNode->replaceChild($node, $item);
02162     }
02163     return qp($document, NULL, $this->options);
02164   }
02165   /**
02166    * Add more elements to the current set of matches.
02167    *
02168    * This begins the new query at the top of the DOM again. The results found
02169    * when running this selector are then merged into the existing results. In
02170    * this way, you can add additional elements to the existing set.
02171    *
02172    * @param string $selector
02173    *  A valid selector.
02174    * @return QueryPath
02175    *  The QueryPath object with the newly added elements.
02176    * @see append()
02177    * @see after()
02178    * @see andSelf()
02179    * @see end()
02180    */
02181   public function add($selector) {
02182     
02183     // This is destructive, so we need to set $last:
02184     $this->last = $this->matches;
02185     
02186     foreach (qp($this->document, $selector, $this->options)->get() as $item)
02187       $this->matches->attach($item);
02188     return $this;
02189   }
02190   /**
02191    * Revert to the previous set of matches.
02192    *
02193    * This will revert back to the last set of matches (before the last 
02194    * "destructive" set of operations). This undoes any change made to the set of
02195    * matched objects. Functions like find() and filter() change the 
02196    * list of matched objects. The end() function will revert back to the last set of
02197    * matched items.
02198    *
02199    * Note that functions that modify the document, but do not change the list of 
02200    * matched objects, are not "destructive". Thus, calling append('something')->end()
02201    * will not undo the append() call.
02202    *
02203    * Only one level of changes is stored. Reverting beyond that will result in 
02204    * an empty set of matches. Example:
02205    *
02206    * @code
02207    * // The line below returns the same thing as qp(document, 'p');
02208    * qp(document, 'p')->find('div')->end();
02209    * // This returns an empty array:
02210    * qp(document, 'p')->end();
02211    * // This returns an empty array:
02212    * qp(document, 'p')->find('div')->find('span')->end()->end();
02213    * @endcode
02214    *
02215    * The last one returns an empty array because only one level of changes is stored.
02216    *
02217    * @return QueryPath
02218    *  A QueryPath object reflecting the list of matches prior to the last destructive
02219    *  operation.
02220    * @see andSelf()
02221    * @see add()
02222    */
02223   public function end() {
02224     // Note that this does not use setMatches because it must set the previous
02225     // set of matches to empty array.
02226     $this->matches = $this->last;
02227     $this->last = new SplObjectStorage();
02228     return $this;
02229   }
02230   /**
02231    * Combine the current and previous set of matched objects.
02232    *
02233    * Example:
02234    *
02235    * @code
02236    * qp(document, 'p')->find('div')->andSelf();
02237    * @endcode
02238    *
02239    * The code above will contain a list of all p elements and all div elements that 
02240    * are beneath p elements.
02241    *
02242    * @see end();
02243    * @return QueryPath
02244    *  A QueryPath object with the results of the last two "destructive" operations.
02245    * @see add()
02246    * @see end()
02247    */
02248   public function andSelf() {
02249     // This is destructive, so we need to set $last:
02250     $last = $this->matches;
02251     
02252     foreach ($this->last as $item) $this->matches->attach($item);
02253     
02254     $this->last = $last;
02255     return $this;
02256   }
02257   /**
02258    * Remove all child nodes.
02259    *
02260    * This is equivalent to jQuery's empty() function. (However, empty() is a 
02261    * PHP built-in, and cannot be used as a method name.)
02262    *
02263    * @return QueryPath
02264    *  The QueryPath object with the child nodes removed.
02265    * @see replaceWith()
02266    * @see replaceAll()
02267    * @see remove()
02268    */
02269   public function removeChildren() {
02270     foreach ($this->matches as $m) {
02271       while($kid = $m->firstChild) {
02272         $m->removeChild($kid);
02273       }
02274     }
02275     return $this;
02276   }
02277   /**
02278    * Get the children of the elements in the QueryPath object.
02279    *
02280    * If a selector is provided, the list of children will be filtered through
02281    * the selector.
02282    *
02283    * @param string $selector
02284    *  A valid selector.
02285    * @return QueryPath
02286    *  A QueryPath wrapping all of the children.
02287    * @see removeChildren()
02288    * @see parent()
02289    * @see parents()
02290    * @see next()
02291    * @see prev()
02292    */
02293   public function children($selector = NULL) {
02294     $found = new SplObjectStorage();
02295     foreach ($this->matches as $m) {
02296       foreach($m->childNodes as $c) {
02297         if ($c->nodeType == XML_ELEMENT_NODE) $found->attach($c);
02298       }
02299     }
02300     if (empty($selector)) {
02301       $this->setMatches($found);
02302     }
02303     else {
02304       $this->matches = $found; // Don't buffer this. It is temporary.
02305       $this->filter($selector);
02306     }
02307     return $this;
02308   }
02309   /**
02310    * Get all child nodes (not just elements) of all items in the matched set.
02311    *
02312    * It gets only the immediate children, not all nodes in the subtree.
02313    *
02314    * This does not process iframes. Xinclude processing is dependent on the 
02315    * DOM implementation and configuration.
02316    *
02317    * @return QueryPath
02318    *  A QueryPath object wrapping all child nodes for all elements in the 
02319    *  QueryPath object.
02320    * @see find()
02321    * @see text()
02322    * @see html()
02323    * @see innerHTML()
02324    * @see xml()
02325    * @see innerXML()
02326    */
02327   public function contents() {
02328     $found = new SplObjectStorage();
02329     foreach ($this->matches as $m) {
02330       if (empty($m->childNodes)) continue; // Issue #51
02331       foreach ($m->childNodes as $c) {
02332         $found->attach($c);
02333       }
02334     }
02335     $this->setMatches($found);
02336     return $this;
02337   }
02338   /**
02339    * Get a list of siblings for elements currently wrapped by this object.
02340    *
02341    * This will compile a list of every sibling of every element in the 
02342    * current list of elements. 
02343    *
02344    * Note that if two siblings are present in the QueryPath object to begin with,
02345    * then both will be returned in the matched set, since they are siblings of each 
02346    * other. In other words,if the matches contain a and b, and a and b are siblings of 
02347    * each other, than running siblings will return a set that contains 
02348    * both a and b.
02349    *
02350    * @param string $selector
02351    *  If the optional selector is provided, siblings will be filtered through
02352    *  this expression.
02353    * @return QueryPath
02354    *  The QueryPath containing the matched siblings.
02355    * @see contents()
02356    * @see children()
02357    * @see parent()
02358    * @see parents()
02359    */
02360   public function siblings($selector = NULL) {
02361     $found = new SplObjectStorage();
02362     foreach ($this->matches as $m) {
02363       $parent = $m->parentNode;
02364       foreach ($parent->childNodes as $n) {
02365         if ($n->nodeType == XML_ELEMENT_NODE && $n !== $m) {
02366           $found->attach($n);
02367         }
02368       }
02369     }
02370     if (empty($selector)) {
02371       $this->setMatches($found);
02372     }
02373     else {
02374       $this->matches = $found; // Don't buffer this. It is temporary.
02375       $this->filter($selector);
02376     }
02377     return $this;
02378   }
02379   /**
02380    * Find the closest element matching the selector.
02381    *
02382    * This finds the closest match in the ancestry chain. It first checks the 
02383    * present element. If the present element does not match, this traverses up 
02384    * the ancestry chain (e.g. checks each parent) looking for an item that matches.
02385    *
02386    * It is provided for jQuery 1.3 compatibility.
02387    * @param string $selector
02388    *  A CSS Selector to match.
02389    * @return QueryPath
02390    *  The set of matches.
02391    * @since 2.0
02392    */
02393   public function closest($selector) {
02394     $found = new SplObjectStorage();
02395     foreach ($this->matches as $m) {
02396       
02397       if (qp($m, NULL, $this->options)->is($selector) > 0) {
02398         $found->attach($m);
02399       }
02400       else {
02401         while ($m->parentNode->nodeType !== XML_DOCUMENT_NODE) {
02402           $m = $m->parentNode;
02403           // Is there any case where parent node is not an element?
02404           if ($m->nodeType === XML_ELEMENT_NODE && qp($m, NULL, $this->options)->is($selector) > 0) {
02405             $found->attach($m);
02406             break;
02407           }
02408         }
02409       }
02410       
02411     }
02412     $this->setMatches($found);
02413     return $this;
02414   }
02415   /**
02416    * Get the immediate parent of each element in the QueryPath.
02417    *
02418    * If a selector is passed, this will return the nearest matching parent for
02419    * each element in the QueryPath.
02420    *
02421    * @param string $selector
02422    *  A valid CSS3 selector.
02423    * @return QueryPath
02424    *  A QueryPath object wrapping the matching parents.
02425    * @see children()
02426    * @see siblings()
02427    * @see parents()
02428    */
02429   public function parent($selector = NULL) {
02430     $found = new SplObjectStorage();
02431     foreach ($this->matches as $m) {
02432       while ($m->parentNode->nodeType !== XML_DOCUMENT_NODE) {
02433         $m = $m->parentNode;
02434         // Is there any case where parent node is not an element?
02435         if ($m->nodeType === XML_ELEMENT_NODE) {
02436           if (!empty($selector)) {
02437             if (qp($m, NULL, $this->options)->is($selector) > 0) {
02438               $found->attach($m);
02439               break;
02440             }
02441           }
02442           else {
02443             $found->attach($m);
02444             break;
02445           }
02446         }
02447       }
02448     }
02449     $this->setMatches($found);
02450     return $this;
02451   }
02452   /**
02453    * Get all ancestors of each element in the QueryPath.
02454    * 
02455    * If a selector is present, only matching ancestors will be retrieved.
02456    *
02457    * @see parent()
02458    * @param string $selector
02459    *  A valid CSS 3 Selector.
02460    * @return QueryPath
02461    *  A QueryPath object containing the matching ancestors.
02462    * @see siblings()
02463    * @see children()
02464    */
02465   public function parents($selector = NULL) {
02466     $found = new SplObjectStorage();
02467     foreach ($this->matches as $m) {
02468       while ($m->parentNode->nodeType !== XML_DOCUMENT_NODE) {
02469         $m = $m->parentNode;
02470         // Is there any case where parent node is not an element?
02471         if ($m->nodeType === XML_ELEMENT_NODE) {
02472           if (!empty($selector)) {
02473             if (qp($m, NULL, $this->options)->is($selector) > 0)
02474               $found->attach($m);
02475           }
02476           else 
02477             $found->attach($m);
02478         }
02479       }
02480     }
02481     $this->setMatches($found);
02482     return $this;
02483   }
02484   /**
02485    * Set or get the markup for an element.
02486    * 
02487    * If $markup is set, then the giving markup will be injected into each
02488    * item in the set. All other children of that node will be deleted, and this
02489    * new code will be the only child or children. The markup MUST BE WELL FORMED.
02490    *
02491    * If no markup is given, this will return a string representing the child 
02492    * markup of the first node.
02493    *
02494    * <b>Important:</b> This differs from jQuery's html() function. This function
02495    * returns <i>the current node</i> and all of its children. jQuery returns only
02496    * the children. This means you do not need to do things like this: 
02497    * @code$qp->parent()->html()@endcode.
02498    *
02499    * By default, this is HTML 4.01, not XHTML. Use {@link xml()} for XHTML.
02500    *
02501    * @param string $markup
02502    *  The text to insert.
02503    * @return mixed
02504    *  A string if no markup was passed, or a QueryPath if markup was passed.
02505    * @see xml()
02506    * @see text()
02507    * @see contents()
02508    */
02509   public function html($markup = NULL) {
02510     if (isset($markup)) {
02511       
02512       if ($this->options['replace_entities']) {
02513         $markup = QueryPathEntities::replaceAllEntities($markup);
02514       }
02515       

02516       // Parse the HTML and insert it into the DOM
02517       //$doc = DOMDocument::loadHTML($markup);
02518       $doc = $this->document->createDocumentFragment();
02519       $doc->appendXML($markup);
02520       $this->removeChildren();
02521       $this->append($doc);
02522       return $this;
02523     }
02524     $length = $this->size();
02525     if ($length == 0) {
02526       return NULL;
02527     }
02528     // Only return the first item -- that's what JQ does.
02529     $first = $this->getFirstMatch();
02530 
02531     // Catch cases where first item is not a legit DOM object.
02532     if (!($first instanceof DOMNode)) {
02533       return NULL;
02534     }
02535     
02536     // Added by eabrand.
02537     if(!$first->ownerDocument->documentElement) {
02538       return NULL;
02539     }
02540     
02541     if ($first instanceof DOMDocument || $first->isSameNode($first->ownerDocument->documentElement)) {
02542       return $this->document->saveHTML();
02543     }
02544     // saveHTML cannot take a node and serialize it.
02545     return $this->document->saveXML($first);
02546   }
02547   
02548   /**
02549    * Fetch the HTML contents INSIDE of the first QueryPath item.
02550    *
02551    * <b>This behaves the way jQuery's @codehtml()@endcode function behaves.</b>
02552    *
02553    * This gets all children of the first match in QueryPath. 
02554    *
02555    * Consider this fragment:
02556    * @code
02557    * <div>
02558    * test <p>foo</p> test
02559    * </div>
02560    * @endcode
02561    *
02562    * We can retrieve just the contents of this code by doing something like
02563    * this:
02564    * @code
02565    * qp($xml, 'div')->innerHTML();
02566    * @endcode
02567    *
02568    * This would return the following:
02569    * @codetest <p>foo</p> test@endcode
02570    *
02571    * @return string
02572    *  Returns a string representation of the child nodes of the first
02573    *  matched element.
02574    * @see html()
02575    * @see innerXML()
02576    * @see innerXHTML()
02577    * @since 2.0
02578    */
02579   public function innerHTML() {
02580     return $this->innerXML();
02581   } 
02582   
02583   /**
02584    * Fetch child (inner) nodes of the first match.
02585    *
02586    * This will return the children of the present match. For an example, 
02587    * see {@link innerHTML()}.
02588    *
02589    * @see innerHTML()
02590    * @see innerXML()
02591    * @return string
02592    *  Returns a string of XHTML that represents the children of the present
02593    *  node.
02594    * @since 2.0
02595    */
02596   public function innerXHTML() {
02597     $length = $this->size();
02598     if ($length == 0) {
02599       return NULL;
02600     }
02601     // Only return the first item -- that's what JQ does.
02602     $first = $this->getFirstMatch();
02603 
02604     // Catch cases where first item is not a legit DOM object.
02605     if (!($first instanceof DOMNode)) {
02606       return NULL;
02607     }
02608     elseif (!$first->hasChildNodes()) {
02609       return '';
02610     }
02611     
02612     $buffer = '';
02613     foreach ($first->childNodes as $child) {
02614       $buffer .= $this->document->saveXML($child, LIBXML_NOEMPTYTAG);
02615     }
02616     
02617     return $buffer;
02618   }
02619   
02620   /**
02621    * Fetch child (inner) nodes of the first match.
02622    *
02623    * This will return the children of the present match. For an example, 
02624    * see {@link innerHTML()}.
02625    *
02626    * @see innerHTML()
02627    * @see innerXHTML()
02628    * @return string
02629    *  Returns a string of XHTML that represents the children of the present
02630    *  node.
02631    * @since 2.0
02632    */
02633   public function innerXML() {
02634     $length = $this->size();
02635     if ($length == 0) {
02636       return NULL;
02637     }
02638     // Only return the first item -- that's what JQ does.
02639     $first = $this->getFirstMatch();
02640 
02641     // Catch cases where first item is not a legit DOM object.
02642     if (!($first instanceof DOMNode)) {
02643       return NULL;
02644     }
02645     elseif (!$first->hasChildNodes()) {
02646       return '';
02647     }
02648     
02649     $buffer = '';
02650     foreach ($first->childNodes as $child) {
02651       $buffer .= $this->document->saveXML($child);
02652     }
02653     
02654     return $buffer;
02655   }
02656   
02657   /**
02658    * Retrieve the text of each match and concatenate them with the given separator.
02659    *
02660    * This has the effect of looping through all children, retrieving their text
02661    * content, and then concatenating the text with a separator.
02662    *
02663    * @param string $sep
02664    *  The string used to separate text items. The default is a comma followed by a
02665    *  space.
02666    * @param boolean $filterEmpties
02667    *  If this is true, empty items will be ignored.
02668    * @return string
02669    *  The text contents, concatenated together with the given separator between
02670    *  every pair of items.
02671    * @see implode()
02672    * @see text()
02673    * @since 2.0
02674    */
02675   public function textImplode($sep = ', ', $filterEmpties = TRUE) {
02676     $tmp = array(); 
02677     foreach ($this->matches as $m) {
02678       $txt = $m->textContent;
02679       $trimmed = trim($txt);
02680       // If filter empties out, then we only add items that have content.
02681       if ($filterEmpties) {
02682         if (strlen($trimmed) > 0) $tmp[] = $txt;
02683       }
02684       // Else add all content, even if it's empty.
02685       else {
02686         $tmp[] = $txt;
02687       }
02688     }
02689     return implode($sep, $tmp);
02690   }
02691   /**
02692    * Get the text contents from just child elements.
02693    *
02694    * This is a specialized variant of textImplode() that implodes text for just the
02695    * child elements of the current element.
02696    *
02697    * @param string $separator
02698    *  The separator that will be inserted between found text content.
02699    * @return string
02700    *  The concatenated values of all children.
02701    */
02702   function childrenText($separator = ' ') {
02703     // Branch makes it non-destructive.
02704     return $this->branch()->xpath('descendant::text()')->textImplode($separator);
02705   }
02706   /**
02707    * Get or set the text contents of a node.
02708    * @param string $text
02709    *  If this is not NULL, this value will be set as the text of the node. It
02710    *  will replace any existing content.
02711    * @return mixed 
02712    *  A QueryPath if $text is set, or the text content if no text
02713    *  is passed in as a pram.
02714    * @see html()
02715    * @see xml()
02716    * @see contents()
02717    */
02718   public function text($text = NULL) {
02719     if (isset($text)) {
02720       $this->removeChildren();
02721       $textNode = $this->document->createTextNode($text);
02722       foreach ($this->matches as $m) $m->appendChild($textNode);
02723       return $this;
02724     }
02725     // Returns all text as one string:
02726     $buf = '';
02727     foreach ($this->matches as $m) $buf .= $m->textContent;
02728     return $buf;
02729   }
02730   /**
02731    * Get or set the text before each selected item.
02732    *
02733    * If $text is passed in, the text is inserted before each currently selected item.
02734    *
02735    * If no text is given, this will return the concatenated text after each selected element.
02736    *
02737    * @code
02738    * <?php
02739    * $xml = '<?xml version="1.0"?><root>Foo<a>Bar</a><b/></root>';
02740    * 
02741    * // This will return 'Foo'
02742    * qp($xml, 'a')->textBefore();
02743    *
02744    * // This will insert 'Baz' right before <b/>.
02745    * qp($xml, 'b')->textBefore('Baz');
02746    * ?>
02747    * @endcode
02748    *
02749    * @param string $text
02750    *  If this is set, it will be inserted before each node in the current set of
02751    *  selected items.
02752    * @return mixed
02753    *  Returns the QueryPath object if $text was set, and returns a string (possibly empty)
02754    *  if no param is passed.
02755    */
02756   public function textBefore($text = NULL) {
02757     if (isset($text)) {
02758       $textNode = $this->document->createTextNode($text);
02759       return $this->before($textNode);
02760     }
02761     $buffer = '';
02762     foreach ($this->matches as $m) {
02763       $p = $m;
02764       while (isset($p->previousSibling) && $p->previousSibling->nodeType == XML_TEXT_NODE) {
02765         $p = $p->previousSibling;
02766         $buffer .= $p->textContent;
02767       }
02768     }
02769     return $buffer;
02770   }
02771   
02772   public function textAfter($text = NULL) {
02773     if (isset($text)) {
02774       $textNode = $this->document->createTextNode($text);
02775       return $this->after($textNode);
02776     }
02777     $buffer = '';
02778     foreach ($this->matches as $m) {
02779       $n = $m;
02780       while (isset($n->nextSibling) && $n->nextSibling->nodeType == XML_TEXT_NODE) {
02781         $n = $n->nextSibling;
02782         $buffer .= $n->textContent;
02783       }
02784     }
02785     return $buffer;
02786   }
02787   
02788   /**
02789    * Set or get the value of an element's 'value' attribute.
02790    *
02791    * The 'value' attribute is common in HTML form elements. This is a 
02792    * convenience function for accessing the values. Since this is not  common
02793    * task on the server side, this method may be removed in future releases. (It 
02794    * is currently provided for jQuery compatibility.)
02795    *
02796    * If a value is provided in the params, then the value will be set for all 
02797    * matches. If no params are given, then the value of the first matched element
02798    * will be returned. This may be NULL.
02799    *
02800    * @deprecated Just use attr(). There's no reason to use this on the server.
02801    * @see attr()
02802    * @param string $value
02803    * @return mixed
02804    *  Returns a QueryPath if a string was passed in, and a string if no string
02805    *  was passed in. In the later case, an error will produce NULL.
02806    */
02807   public function val($value = NULL) {
02808     if (isset($value)) {
02809       $this->attr('value', $value);
02810       return $this;
02811     }
02812     return $this->attr('value');
02813   }
02814   /**
02815    * Set or get XHTML markup for an element or elements.
02816    * 
02817    * This differs from {@link html()} in that it processes (and produces)
02818    * strictly XML 1.0 compliant markup.
02819    *
02820    * Like {@link xml()} and {@link html()}, this functions as both a 
02821    * setter and a getter.
02822    *
02823    * This is a convenience function for fetching HTML in XML format.
02824    * It does no processing of the markup (such as schema validation).
02825    * @param string $markup
02826    *  A string containing XML data.
02827    * @return mixed
02828    *  If markup is passed in, a QueryPath is returned. If no markup is passed
02829    *  in, XML representing the first matched element is returned.
02830    * @see html()
02831    * @see innerXHTML()
02832    */
02833   public function xhtml($markup = NULL) {
02834     
02835     // XXX: This is a minor reworking of the original xml() method.
02836     // This should be refactored, probably.
02837     // See http://github.com/technosophos/querypath/issues#issue/10
02838    
02839     $omit_xml_decl = $this->options['omit_xml_declaration'];
02840     if ($markup === TRUE) {
02841       // Basically, we handle the special case where we don't
02842       // want the XML declaration to be displayed.
02843       $omit_xml_decl = TRUE;
02844     }
02845     elseif (isset($markup)) {
02846       return $this->xml($markup);
02847     }
02848     
02849     $length = $this->size();
02850     if ($length == 0) {
02851       return NULL;
02852     }
02853     
02854     // Only return the first item -- that's what JQ does.
02855     $first = $this->getFirstMatch();
02856     // Catch cases where first item is not a legit DOM object.
02857     if (!($first instanceof DOMNode)) {
02858       return NULL;
02859     }
02860     
02861     if ($first instanceof DOMDocument || $first->isSameNode($first->ownerDocument->documentElement)) {
02862       
02863       // Has the unfortunate side-effect of stripping doctype.
02864       //$text = ($omit_xml_decl ? $this->document->saveXML($first->ownerDocument->documentElement, LIBXML_NOEMPTYTAG) : $this->document->saveXML(NULL, LIBXML_NOEMPTYTAG));
02865       $text = $this->document->saveXML(NULL, LIBXML_NOEMPTYTAG);
02866     }
02867     else {
02868       $text = $this->document->saveXML($first, LIBXML_NOEMPTYTAG);
02869     }
02870     
02871     // Issue #47: Using the old trick for removing the XML tag also removed the 
02872     // doctype. So we remove it with a regex:
02873     if ($omit_xml_decl) {
02874       $text = preg_replace('/<\?xml\s[^>]*\?>/', '', $text);
02875     }
02876     
02877     // This is slightly lenient: It allows for cases where code incorrectly places content
02878     // inside of these supposedly unary elements.
02879     $unary = '/<(area|base|basefont|br|col|frame|hr|img|input|isindex|link|meta|param)(?(?=\s)([^>\/]+))><\/[^>]*>/i';
02880     $text = preg_replace($unary, '<\\1\\2 />', $text);
02881     
02882     // Experimental: Support for enclosing CDATA sections with comments to be both XML compat
02883     // and HTML 4/5 compat
02884     $cdata = '/(<!\[CDATA\[|\]\]>)/i';
02885     $replace = $this->options['escape_xhtml_js_css_sections'];
02886     $text = preg_replace($cdata, $replace, $text);
02887     
02888     return $text;
02889   }
02890   /**
02891    * Set or get the XML markup for an element or elements.
02892    *
02893    * Like {@link html()}, this functions in both a setter and a getter mode.
02894    * 
02895    * In setter mode, the string passed in will be parsed and then appended to the 
02896    * elements wrapped by this QueryPath object.When in setter mode, this parses 
02897    * the XML using the DOMFragment parser. For that reason, an XML declaration 
02898    * is not necessary.
02899    *
02900    * In getter mode, the first element wrapped by this QueryPath object will be 
02901    * converted to an XML string and returned.
02902    *
02903    * @param string $markup
02904    *  A string containing XML data.
02905    * @return mixed
02906    *  If markup is passed in, a QueryPath is returned. If no markup is passed
02907    *  in, XML representing the first matched element is returned.
02908    * @see xhtml()
02909    * @see html()
02910    * @see text()
02911    * @see content()
02912    * @see innerXML()
02913    */
02914   public function xml($markup = NULL) {
02915     $omit_xml_decl = $this->options['omit_xml_declaration'];
02916     if ($markup === TRUE) {
02917       // Basically, we handle the special case where we don't
02918       // want the XML declaration to be displayed.
02919       $omit_xml_decl = TRUE;
02920     }
02921     elseif (isset($markup)) {
02922       if ($this->options['replace_entities']) {
02923         $markup = QueryPathEntities::replaceAllEntities($markup);
02924       }
02925       $doc = $this->document->createDocumentFragment();
02926       $doc->appendXML($markup);
02927       $this->removeChildren();
02928       $this->append($doc);
02929       return $this;
02930     }
02931     $length = $this->size();
02932     if ($length == 0) {
02933       return NULL;
02934     }
02935     // Only return the first item -- that's what JQ does.
02936     $first = $this->getFirstMatch();
02937     
02938     // Catch cases where first item is not a legit DOM object.
02939     if (!($first instanceof DOMNode)) {
02940       return NULL;
02941     }
02942     
02943     if ($first instanceof DOMDocument || $first->isSameNode($first->ownerDocument->documentElement)) {
02944       
02945       return  ($omit_xml_decl ? $this->document->saveXML($first->ownerDocument->documentElement) : $this->document->saveXML());
02946     }
02947     return $this->document->saveXML($first);
02948   }
02949   /**
02950    * Send the XML document to the client.
02951    * 
02952    * Write the document to a file path, if given, or 
02953    * to stdout (usually the client).
02954    *
02955    * This prints the entire document.
02956    *
02957    * @param string $path
02958    *  The path to the file into which the XML should be written. if 
02959    *  this is NULL, data will be written to STDOUT, which is usually
02960    *  sent to the remote browser.
02961    * @param int $options
02962    *  (As of QueryPath 2.1) Pass libxml options to the saving mechanism.
02963    * @return QueryPath
02964    *  The QueryPath object, unmodified.
02965    * @see xml()
02966    * @see innerXML()
02967    * @see writeXHTML()
02968    * @throws Exception 
02969    *  In the event that a file cannot be written, an Exception will be thrown.
02970    */
02971   public function writeXML($path = NULL, $options = NULL) {
02972     if ($path == NULL) {
02973       print $this->document->saveXML(NULL, $options);
02974     }
02975     else {
02976       try {
02977         set_error_handler(array('QueryPathIOException', 'initializeFromError'));
02978         $this->document->save($path, $options);
02979       }
02980       catch (Exception $e) {
02981         restore_error_handler();
02982         throw $e;
02983       }
02984       restore_error_handler();
02985     }
02986     return $this;
02987   }
02988   /**
02989    * Writes HTML to output.
02990    *
02991    * HTML is formatted as HTML 4.01, without strict XML unary tags. This is for
02992    * legacy HTML content. Modern XHTML should be written using {@link toXHTML()}.
02993    * 
02994    * Write the document to stdout (usually the client) or to a file.
02995    *
02996    * @param string $path
02997    *  The path to the file into which the XML should be written. if 
02998    *  this is NULL, data will be written to STDOUT, which is usually
02999    *  sent to the remote browser.
03000    * @return QueryPath
03001    *  The QueryPath object, unmodified.
03002    * @see html()
03003    * @see innerHTML()
03004    * @throws Exception 
03005    *  In the event that a file cannot be written, an Exception will be thrown.
03006    */
03007   public function writeHTML($path = NULL) {
03008     if ($path == NULL) {
03009       print $this->document->saveHTML();
03010     }
03011     else {
03012       try {
03013         set_error_handler(array('QueryPathParseException', 'initializeFromError'));
03014         $this->document->saveHTMLFile($path);
03015       }
03016       catch (Exception $e) {
03017         restore_error_handler();
03018         throw $e;
03019       }
03020       restore_error_handler();
03021     }
03022     return $this;
03023   }
03024   
03025   /**
03026    * Write an XHTML file to output.
03027    *
03028    * Typically, you should use this instead of {@link writeHTML()}.
03029    *
03030    * Currently, this functions identically to {@link toXML()} <i>except that</i>
03031    * it always uses closing tags (e.g. always @code<script></script>@endcode, 
03032    * never @code<script/>@endcode). It will
03033    * write the file as well-formed XML. No XHTML schema validation is done.
03034    *
03035    * @see writeXML()
03036    * @see xml()
03037    * @see writeHTML()
03038    * @see innerXHTML()
03039    * @see xhtml()
03040    * @param string $path
03041    *  The filename of the file to write to.
03042    * @return QueryPath
03043    *  Returns the QueryPath, unmodified.
03044    * @throws Exception
03045    *  In the event that the output file cannot be written, an exception is
03046    *  thrown.
03047    * @since 2.0
03048    */
03049   public function writeXHTML($path = NULL) {
03050     return $this->writeXML($path, LIBXML_NOEMPTYTAG);
03051     /*
03052     if ($path == NULL) {
03053       print $this->document->saveXML(NULL, LIBXML_NOEMPTYTAG);
03054     }
03055     else {
03056       try {
03057         set_error_handler(array('QueryPathIOException', 'initializeFromError'));
03058         $this->document->save($path, LIBXML_NOEMPTYTAG);
03059       }
03060       catch (Exception $e) {
03061         restore_error_handler();
03062         throw $e;
03063       }
03064       restore_error_handler();
03065     }
03066     return $this;
03067     */
03068   }
03069   /**
03070    * Get the next sibling of each element in the QueryPath.
03071    *
03072    * If a selector is provided, the next matching sibling will be returned.
03073    *
03074    * @param string $selector
03075    *  A CSS3 selector.
03076    * @return QueryPath
03077    *  The QueryPath object.
03078    * @see nextAll()
03079    * @see prev()
03080    * @see children()
03081    * @see contents()
03082    * @see parent()
03083    * @see parents()
03084    */
03085   public function next($selector = NULL) {
03086     $found = new SplObjectStorage();
03087     foreach ($this->matches as $m) {
03088       while (isset($m->nextSibling)) {
03089         $m = $m->nextSibling;
03090         if ($m->nodeType === XML_ELEMENT_NODE) {
03091           if (!empty($selector)) {
03092             if (qp($m, NULL, $this->options)->is($selector) > 0) {
03093               $found->attach($m);
03094               break;
03095             }
03096           }
03097           else {
03098             $found->attach($m);
03099             break;
03100           }
03101         }
03102       }
03103     }
03104     $this->setMatches($found);
03105     return $this;
03106   }
03107   /**
03108    * Get all siblings after an element.
03109    *
03110    * For each element in the QueryPath, get all siblings that appear after
03111    * it. If a selector is passed in, then only siblings that match the 
03112    * selector will be included.
03113    *
03114    * @param string $selector 
03115    *  A valid CSS 3 selector.
03116    * @return QueryPath
03117    *  The QueryPath object, now containing the matching siblings.
03118    * @see next()
03119    * @see prevAll()
03120    * @see children()
03121    * @see siblings()
03122    */
03123   public function nextAll($selector = NULL) {
03124     $found = new SplObjectStorage();
03125     foreach ($this->matches as $m) {
03126       while (isset($m->nextSibling)) {
03127         $m = $m->nextSibling;
03128         if ($m->nodeType === XML_ELEMENT_NODE) {
03129           if (!empty($selector)) {
03130             if (qp($m, NULL, $this->options)->is($selector) > 0) {
03131               $found->attach($m);
03132             }
03133           }
03134           else {
03135             $found->attach($m);
03136           }
03137         }
03138       }
03139     }
03140     $this->setMatches($found);
03141     return $this;
03142   }
03143   /**
03144    * Get the next sibling before each element in the QueryPath.
03145    *
03146    * For each element in the QueryPath, this retrieves the previous sibling
03147    * (if any). If a selector is supplied, it retrieves the first matching 
03148    * sibling (if any is found).
03149    *
03150    * @param string $selector
03151    *  A valid CSS 3 selector.
03152    * @return QueryPath
03153    *  A QueryPath object, now containing any previous siblings that have been 
03154    *  found.
03155    * @see prevAll()
03156    * @see next()
03157    * @see siblings()
03158    * @see children()
03159    */
03160   public function prev($selector = NULL) {
03161     $found = new SplObjectStorage();
03162     foreach ($this->matches as $m) {
03163       while (isset($m->previousSibling)) {
03164         $m = $m->previousSibling;
03165         if ($m->nodeType === XML_ELEMENT_NODE) {
03166           if (!empty($selector)) {
03167             if (qp($m, NULL, $this->options)->is($selector)) {
03168               $found->attach($m);
03169               break;
03170             }
03171           }
03172           else {
03173             $found->attach($m);
03174             break;
03175           }
03176         }
03177       }
03178     }
03179     $this->setMatches($found);
03180     return $this;
03181   }
03182   /**
03183    * Get the previous siblings for each element in the QueryPath.
03184    *
03185    * For each element in the QueryPath, get all previous siblings. If a 
03186    * selector is provided, only matching siblings will be retrieved.
03187    *
03188    * @param string $selector
03189    *  A valid CSS 3 selector.
03190    * @return QueryPath
03191    *  The QueryPath object, now wrapping previous sibling elements.
03192    * @see prev()
03193    * @see nextAll()
03194    * @see siblings()
03195    * @see contents()
03196    * @see children()
03197    */
03198   public function prevAll($selector = NULL) {
03199     $found = new SplObjectStorage();
03200     foreach ($this->matches as $m) {
03201       while (isset($m->previousSibling)) {
03202         $m = $m->previousSibling;
03203         if ($m->nodeType === XML_ELEMENT_NODE) {
03204           if (!empty($selector)) {
03205             if (qp($m, NULL, $this->options)->is($selector)) {
03206               $found->attach($m);
03207             }
03208           }
03209           else {
03210             $found->attach($m);
03211           }
03212         }
03213       }
03214     }
03215     $this->setMatches($found);
03216     return $this;
03217   }
03218   /**
03219    * @deprecated Use {@link siblings()}.
03220    */
03221   public function peers($selector = NULL) {
03222     $found = new SplObjectStorage();
03223     foreach ($this->matches as $m) {
03224       foreach ($m->parentNode->childNodes as $kid) {
03225         if ($kid->nodeType == XML_ELEMENT_NODE && $m !== $kid) {
03226           if (!empty($selector)) {
03227             if (qp($kid, NULL, $this->options)->is($selector)) {
03228               $found->attach($kid);
03229             }
03230           }
03231           else {
03232             $found->attach($kid);
03233           }
03234         }
03235       }
03236     }
03237     $this->setMatches($found);
03238     return $this;
03239   }
03240   /**
03241    * Add a class to all elements in the current QueryPath.
03242    *
03243    * This searchers for a class attribute on each item wrapped by the current 
03244    * QueryPath object. If no attribute is found, a new one is added and its value
03245    * is set to $class. If a class attribute is found, then the value is appended
03246    * on to the end.
03247    *
03248    * @param string $class 
03249    *  The name of the class.
03250    * @return QueryPath
03251    *  Returns the QueryPath object.
03252    * @see css()
03253    * @see attr()
03254    * @see removeClass()
03255    * @see hasClass()
03256    */
03257   public function addClass($class) {
03258     foreach ($this->matches as $m) {
03259       if ($m->hasAttribute('class')) {
03260         $val = $m->getAttribute('class');
03261         $m->setAttribute('class', $val . ' ' . $class);
03262       }
03263       else {
03264         $m->setAttribute('class', $class);
03265       }
03266     }
03267     return $this;
03268   }
03269   /**
03270    * Remove the named class from any element in the QueryPath that has it.
03271    *
03272    * This may result in the entire class attribute being removed. If there
03273    * are other items in the class attribute, though, they will not be removed.
03274    * 
03275    * Example:
03276    * Consider this XML:
03277    * @code
03278    * <element class="first second"/>
03279    * @endcode
03280    *
03281    * Executing this fragment of code will remove only the 'first' class:
03282    * @code
03283    * qp(document, 'element')->removeClass('first');
03284    * @endcode
03285    *
03286    * The resulting XML will be:
03287    * @code
03288    * <element class="second"/>
03289    * @endcode
03290    *
03291    * To remove the entire 'class' attribute, you should use {@see removeAttr()}.
03292    *
03293    * @param string $class
03294    *  The class name to remove.
03295    * @return QueryPath
03296    *  The modified QueryPath object.
03297    * @see attr()
03298    * @see addClass()
03299    * @see hasClass()
03300    */
03301   public function removeClass($class) {
03302     foreach ($this->matches as $m) {
03303       if ($m->hasAttribute('class')) {
03304         $vals = explode(' ', $m->getAttribute('class'));
03305         if (in_array($class, $vals)) {
03306           $buf = array();
03307           foreach ($vals as $v) {
03308             if ($v != $class) $buf[] = $v;
03309           }
03310           if (count($buf) == 0)
03311             $m->removeAttribute('class');
03312           else
03313             $m->setAttribute('class', implode(' ', $buf));
03314         }
03315       }
03316     }
03317     return $this;
03318   }
03319   /**
03320    * Returns TRUE if any of the elements in the QueryPath have the specified class.
03321    *
03322    * @param string $class
03323    *  The name of the class.
03324    * @return boolean 
03325    *  TRUE if the class exists in one or more of the elements, FALSE otherwise.
03326    * @see addClass()
03327    * @see removeClass()
03328    */
03329   public function hasClass($class) {
03330     foreach ($this->matches as $m) {
03331       if ($m->hasAttribute('class')) {
03332         $vals = explode(' ', $m->getAttribute('class'));
03333         if (in_array($class, $vals)) return TRUE;
03334       }
03335     }
03336     return FALSE;
03337   }
03338 
03339   /**
03340    * Branch the base QueryPath into another one with the same matches.
03341    *
03342    * This function makes a copy of the QueryPath object, but keeps the new copy 
03343    * (initially) pointed at the same matches. This object can then be queried without
03344    * changing the original QueryPath. However, changes to the elements inside of this
03345    * QueryPath will show up in the QueryPath from which it is branched.
03346    * 
03347    * Compare this operation with {@link cloneAll()}. The cloneAll() call takes
03348    * the current QueryPath object and makes a copy of all of its matches. You continue
03349    * to operate on the same QueryPath object, but the elements inside of the QueryPath
03350    * are copies of those before the call to cloneAll().
03351    *
03352    * This, on the other hand, copies <i>the QueryPath</i>, but keeps valid 
03353    * references to the document and the wrapped elements. A new query branch is 
03354    * created, but any changes will be written back to the same document.
03355    *
03356    * In practice, this comes in handy when you want to do multiple queries on a part
03357    * of the document, but then return to a previous set of matches. (see {@link QPTPL}
03358    * for examples of this in practice).
03359    *
03360    * Example:
03361    *
03362    * @code
03363    * <?php
03364    * $qp = qp(QueryPath::HTML_STUB);
03365    * $branch = $qp->branch();
03366    * $branch->find('title')->text('Title');
03367    * $qp->find('body')->text('This is the body')->writeHTML;
03368    * ?>
03369    * @endcode
03370    *
03371    * Notice that in the code, each of the QueryPath objects is doing its own 
03372    * query. However, both are modifying the same document. The result of the above 
03373    * would look something like this:
03374    *
03375    * @code
03376    * <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
03377    * <html xmlns="http://www.w3.org/1999/xhtml">
03378    * <head>
03379    *    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>
03380    *    <title>Title</title>
03381    * </head>
03382    * <body>This is the body</body>
03383    * </html>
03384    * @endcode
03385    *
03386    * Notice that while $qp and $banch were performing separate queries, they 
03387    * both modified the same document.
03388    *
03389    * In jQuery or a browser-based solution, you generally do not need a branching
03390    * function because there is (implicitly) only one document. In QueryPath, there
03391    * is no implicit document. Every document must be explicitly specified (and,
03392    * in most cases, parsed -- which is costly). Branching makes it possible to 
03393    * work on one document with multiple QueryPath objects.
03394    *
03395    * @param string $selector
03396    *  If a selector is passed in, an additional {@link find()} will be executed
03397    *  on the branch before it is returned. (Added in QueryPath 2.0.)
03398    * @return QueryPath
03399    *  A copy of the QueryPath object that points to the same set of elements that
03400    *  the original QueryPath was pointing to.
03401    * @since 1.1
03402    * @see cloneAll()
03403    * @see find()
03404    */
03405   public function branch($selector = NULL) {
03406     $temp = qp($this->matches, NULL, $this->options);
03407     if (isset($selector)) $temp->find($selector);
03408     return $temp;
03409   }
03410   /**
03411    * Perform a deep clone of each node in the QueryPath.
03412    *
03413    * This does not clone the QueryPath object, but instead clones the 
03414    * list of nodes wrapped by the QueryPath. Every element is deeply 
03415    * cloned.
03416    *
03417    * This method is analogous to jQuery's clone() method.
03418    *
03419    * This is a destructive operation, which means that end() will revert
03420    * the list back to the clone's original.
03421    * @see qp()
03422    * @return QueryPath
03423    */
03424   public function cloneAll() {
03425     $found = new SplObjectStorage();
03426     foreach ($this->matches as $m) $found->attach($m->cloneNode(TRUE));
03427     $this->setMatches($found, FALSE);
03428     return $this;
03429   }
03430   
03431   /**
03432    * Clone the QueryPath.
03433    *
03434    * This makes a deep clone of the elements inside of the QueryPath.
03435    *
03436    * This clones only the QueryPathImpl, not all of the decorators. The
03437    * clone operator in PHP should handle the cloning of the decorators.
03438    */
03439   public function __clone() {
03440     //XXX: Should we clone the document?
03441     
03442     // Make sure we clone the kids.
03443     $this->cloneAll();
03444   }  
03445 
03446   /**
03447    * Detach any items from the list if they match the selector.
03448    *
03449    * In other words, each item that matches the selector will be remove
03450    * from the DOM document. The returned QueryPath wraps the list of
03451    * removed elements.
03452    *
03453    * If no selector is specified, this will remove all current matches from
03454    * the document.
03455    *
03456    * @param string $selector
03457    *  A CSS Selector.
03458    * @return QueryPath
03459    *  The Query path wrapping a list of removed items.
03460    * @see replaceAll()
03461    * @see replaceWith()
03462    * @see removeChildren()
03463    * @since 2.1
03464    * @author eabrand
03465    */
03466   public function detach($selector = NULL) {
03467 
03468     if(!empty($selector))
03469     $this->find($selector);
03470 
03471     $found = new SplObjectStorage();
03472     $this->last = $this->matches;
03473     foreach ($this->matches as $item) {
03474       // The item returned is (according to docs) different from
03475       // the one passed in, so we have to re-store it.
03476       $found->attach($item->parentNode->removeChild($item));
03477     }
03478     $this->setMatches($found);
03479     return $this;
03480   }
03481 
03482   /**
03483    * Attach any items from the list if they match the selector.
03484    *
03485    * If no selector is specified, this will remove all current matches from
03486    * the document.
03487    *
03488    * @param QueryPath $dest
03489    *  A QueryPath Selector.
03490    * @return QueryPath
03491    *  The Query path wrapping a list of removed items.
03492    * @see replaceAll()
03493    * @see replaceWith()
03494    * @see removeChildren()
03495    * @since 2.1
03496    * @author eabrand
03497    */
03498   public function attach(QueryPath $dest) {
03499     foreach ($this->last as $m) $dest->append($m);
03500     return $this;
03501   }
03502   
03503   /**
03504    * Reduce the elements matched by QueryPath to only those which contain the given item.
03505    *
03506    * There are two ways in which this is different from jQuery's implementation:
03507    * - We allow ANY DOMNode, not just DOMElements. That means this will work on 
03508    *   processor instructions, text nodes, comments, etc.
03509    * - Unlike jQuery, this implementation of has() follows QueryPath standard behavior
03510    *   and modifies the existing object. It does not create a brand new object.
03511    * 
03512    * @param mixed $contained
03513    *   - If $contained is a CSS selector (e.g. '#foo'), this will test to see
03514    *     if the current QueryPath has any elements that contain items that match
03515    *     the selector.
03516    *   - If $contained is a DOMNode, then this will test to see if THE EXACT DOMNode
03517    *     exists in the currently matched elements. (Note that you cannot match across DOM trees, even if it is the same document.)
03518    * @since 2.1
03519    * @author eabrand
03520    * @todo It would be trivially easy to add support for iterating over an array or Iterable of DOMNodes.
03521    */
03522   public function has($contained) {
03523     $found = new SplObjectStorage();
03524     
03525     // If it's a selector, we just get all of the DOMNodes that match the selector.
03526     $nodes = array();
03527     if (is_string($contained)) {
03528       // Get the list of nodes.
03529       $nodes = $this->branch($contained)->get();
03530     }
03531     elseif ($contained instanceof DOMNode) {
03532       // Make a list with one node.
03533       $nodes = array($contained);
03534     }
03535     
03536     // Now we go through each of the nodes that we are testing. We want to find
03537     // ALL PARENTS that are in our existing QueryPath matches. Those are the
03538     // ones we add to our new matches.
03539     foreach ($nodes as $original_node) {
03540       $node = $original_node;
03541       while (!empty($node)/* && $node != $node->ownerDocument*/) {
03542         if ($this->matches->contains($node)) {
03543           $found->attach($node);
03544         }
03545         $node = $node->parentNode;
03546       }
03547     }
03548     
03549     $this->setMatches($found);
03550     return $this;
03551   }
03552 
03553   /**
03554    * Empty everything within the specified element.
03555    *
03556    * A convenience function for removeChildren(). This is equivalent to jQuery's 
03557    * empty() function. However, `empty` is a built-in in PHP, and cannot be used as a 
03558    * function name.
03559    *
03560    * @return QueryPath
03561    *  The QueryPath object with the newly emptied elements.
03562    * @see removeChildren()
03563    * @since 2.1
03564    * @author eabrand
03565    * @deprecated The removeChildren() function is the preferred method.
03566    */
03567   public function emptyElement() {
03568     $this->removeChildren();
03569     return $this;
03570   }
03571   
03572   /**
03573    * Get the even elements, so counter-intuitively 1, 3, 5, etc.
03574    *
03575    *
03576    *
03577    * @return QueryPath
03578    *  A QueryPath wrapping all of the children.
03579    * @see removeChildren()
03580    * @see parent()
03581    * @see parents()
03582    * @see next()
03583    * @see prev()
03584    * @since 2.1
03585    * @author eabrand
03586    */
03587   public function even() {
03588     $found = new SplObjectStorage();
03589     $even = false;
03590     foreach ($this->matches as $m) {
03591       if ($even && $m->nodeType == XML_ELEMENT_NODE) $found->attach($m);
03592       $even = ($even) ? false : true;
03593     }
03594     $this->setMatches($found);
03595     $this->matches = $found; // Don't buffer this. It is temporary.
03596     return $this;
03597   }
03598 
03599   /**
03600    * Get the odd elements, so counter-intuitively 0, 2, 4, etc.
03601    *
03602    *
03603    *
03604    * @return QueryPath
03605    *  A QueryPath wrapping all of the children.
03606    * @see removeChildren()
03607    * @see parent()
03608    * @see parents()
03609    * @see next()
03610    * @see prev()
03611    * @since 2.1
03612    * @author eabrand
03613    */
03614   public function odd() {
03615     $found = new SplObjectStorage();
03616     $odd = true;
03617     foreach ($this->matches as $m) {
03618       if ($odd && $m->nodeType == XML_ELEMENT_NODE) $found->attach($m);
03619       $odd = ($odd) ? false : true;
03620     }
03621     $this->setMatches($found);
03622     $this->matches = $found; // Don't buffer this. It is temporary.
03623     return $this;
03624   }
03625   
03626   /**
03627    * Get the first matching element.
03628    *
03629    *
03630    * @return QueryPath
03631    *  A QueryPath wrapping all of the children.
03632    * @see next()
03633    * @see prev()
03634    * @since 2.1
03635    * @author eabrand
03636    */
03637   public function first() {
03638     $found = new SplObjectStorage();
03639     foreach ($this->matches as $m) {
03640       if ($m->nodeType == XML_ELEMENT_NODE) {
03641         $found->attach($m);
03642         break;
03643       }
03644     }
03645     $this->setMatches($found);
03646     $this->matches = $found; // Don't buffer this. It is temporary.
03647     return $this;
03648   }
03649 
03650   /**
03651    * Get the first child of the matching element.
03652    *
03653    *
03654    * @return QueryPath
03655    *  A QueryPath wrapping all of the children.
03656    * @see next()
03657    * @see prev()
03658    * @since 2.1
03659    * @author eabrand
03660    */
03661   public function firstChild() {
03662     // Could possibly use $m->firstChild http://theserverpages.com/php/manual/en/ref.dom.php
03663     $found = new SplObjectStorage();
03664     $flag = false;
03665     foreach ($this->matches as $m) {
03666       foreach($m->childNodes as $c) {
03667         if ($c->nodeType == XML_ELEMENT_NODE) {
03668           $found->attach($c);
03669           $flag = true;
03670           break;
03671         }
03672       }
03673       if($flag) break;
03674     }
03675     $this->setMatches($found);
03676     $this->matches = $found; // Don't buffer this. It is temporary.
03677     return $this;
03678   }
03679 
03680   /**
03681    * Get the last matching element.
03682    *
03683    *
03684    * @return QueryPath
03685    *  A QueryPath wrapping all of the children.
03686    * @see next()
03687    * @see prev()
03688    * @since 2.1
03689    * @author eabrand
03690    */
03691   public function last() {
03692     $found = new SplObjectStorage();
03693     $item = null;
03694     foreach ($this->matches as $m) {
03695       if ($m->nodeType == XML_ELEMENT_NODE) {
03696         $item = $m;
03697       }
03698     }
03699     if ($item) {
03700       $found->attach($item);
03701     }
03702     $this->setMatches($found);
03703     $this->matches = $found; // Don't buffer this. It is temporary.
03704     return $this;
03705   }
03706 
03707   /**
03708    * Get the last child of the matching element.
03709    *
03710    *
03711    * @return QueryPath
03712    *  A QueryPath wrapping all of the children.
03713    * @see next()
03714    * @see prev()
03715    * @since 2.1
03716    * @author eabrand
03717    */
03718   public function lastChild() {
03719     $found = new SplObjectStorage();
03720     $item = null;
03721     foreach ($this->matches as $m) {
03722       foreach($m->childNodes as $c) {
03723         if ($c->nodeType == XML_ELEMENT_NODE) {
03724           $item = $c;
03725         }
03726       }
03727       if ($item) {
03728         $found->attach($item);
03729         $item = null;
03730       }
03731     }
03732     $this->setMatches($found);
03733     $this->matches = $found; // Don't buffer this. It is temporary.
03734     return $this;
03735   }
03736 
03737   /**
03738    * Get all siblings after an element until the selector is reached.
03739    *
03740    * For each element in the QueryPath, get all siblings that appear after
03741    * it. If a selector is passed in, then only siblings that match the
03742    * selector will be included.
03743    *
03744    * @param string $selector
03745    *  A valid CSS 3 selector.
03746    * @return QueryPath
03747    *  The QueryPath object, now containing the matching siblings.
03748    * @see next()
03749    * @see prevAll()
03750    * @see children()
03751    * @see siblings()
03752    * @since 2.1
03753    * @author eabrand
03754    */
03755   public function nextUntil($selector = NULL) {
03756     $found = new SplObjectStorage();
03757     foreach ($this->matches as $m) {
03758       while (isset($m->nextSibling)) {
03759         $m = $m->nextSibling;
03760         if ($m->nodeType === XML_ELEMENT_NODE) {
03761           if (!empty($selector)) {
03762             if (qp($m, NULL, $this->options)->is($selector) > 0) {
03763               break;
03764             }
03765             else {
03766               $found->attach($m);
03767             }
03768           }
03769           else {
03770             $found->attach($m);
03771           }
03772         }
03773       }
03774     }
03775     $this->setMatches($found);
03776     return $this;
03777   } 
03778 
03779   /**
03780    * Get the previous siblings for each element in the QueryPath
03781    * until the selector is reached.
03782    *
03783    * For each element in the QueryPath, get all previous siblings. If a
03784    * selector is provided, only matching siblings will be retrieved.
03785    *
03786    * @param string $selector
03787    *  A valid CSS 3 selector.
03788    * @return QueryPath
03789    *  The QueryPath object, now wrapping previous sibling elements.
03790    * @see prev()
03791    * @see nextAll()
03792    * @see siblings()
03793    * @see contents()
03794    * @see children()
03795    * @since 2.1
03796    * @author eabrand
03797    */
03798   public function prevUntil($selector = NULL) {
03799     $found = new SplObjectStorage();
03800     foreach ($this->matches as $m) {
03801       while (isset($m->previousSibling)) {
03802         $m = $m->previousSibling;
03803         if ($m->nodeType === XML_ELEMENT_NODE) {
03804           if (!empty($selector) && qp($m, NULL, $this->options)->is($selector))
03805           break;
03806           else
03807           $found->attach($m);
03808         }
03809       }
03810     }
03811     $this->setMatches($found);
03812     return $this;
03813   }
03814   
03815   /**
03816    * Get all ancestors of each element in the QueryPath until the selector is reached.
03817    *
03818    * If a selector is present, only matching ancestors will be retrieved.
03819    *
03820    * @see parent()
03821    * @param string $selector
03822    *  A valid CSS 3 Selector.
03823    * @return QueryPath
03824    *  A QueryPath object containing the matching ancestors.
03825    * @see siblings()
03826    * @see children()
03827    * @since 2.1
03828    * @author eabrand
03829    */
03830   public function parentsUntil($selector = NULL) {
03831     $found = new SplObjectStorage();
03832     foreach ($this->matches as $m) {
03833       while ($m->parentNode->nodeType !== XML_DOCUMENT_NODE) {
03834         $m = $m->parentNode;
03835         // Is there any case where parent node is not an element?
03836         if ($m->nodeType === XML_ELEMENT_NODE) {
03837           if (!empty($selector)) {
03838             if (qp($m, NULL, $this->options)->is($selector) > 0)
03839             break;
03840             else
03841             $found->attach($m);
03842           }
03843           else
03844           $found->attach($m);
03845         }
03846       }
03847     }
03848     $this->setMatches($found);
03849     return $this;
03850   }
03851   
03852   /////// INTERNAL FUNCTIONS ////////
03853   
03854   
03855   /**
03856    * Determine whether a given string looks like XML or not.
03857    *
03858    * Basically, this scans a portion of the supplied string, checking to see
03859    * if it has a tag-like structure. It is possible to "confuse" this, which
03860    * may subsequently result in parse errors, but in the vast majority of 
03861    * cases, this method serves as a valid inicator of whether or not the 
03862    * content looks like XML.
03863    *
03864    * Things that are intentional excluded:
03865    * - plain text with no markup.
03866    * - strings that look like filesystem paths.
03867    * 
03868    * Subclasses SHOULD NOT OVERRIDE THIS. Altering it may be altering
03869    * core assumptions about how things work. Instead, classes should 
03870    * override the constructor and pass in only one of the parsed types
03871    * that this class expects.
03872    */
03873   protected function isXMLish($string) {
03874     // Long strings will exhaust the regex engine, so we
03875     // grab a representative string.
03876     // $test = substr($string, 0, 255);
03877     return (strpos($string, '<') !== FALSE && strpos($string, '>') !== FALSE);
03878     //return preg_match(ML_EXP, $test) > 0;
03879   }
03880   
03881   private function parseXMLString($string, $flags = NULL) {
03882     
03883     $document = new DOMDocument('1.0');
03884     $lead = strtolower(substr($string, 0, 5)); // <?xml
03885     try {
03886       set_error_handler(array('QueryPathParseException', 'initializeFromError'), $this->errTypes);
03887       
03888       if (isset($this->options['convert_to_encoding'])) {
03889         // Is there another way to do this?
03890         
03891         $from_enc = isset($this->options['convert_from_encoding']) ? $this->options['convert_from_encoding'] : 'auto';
03892         $to_enc = $this->options['convert_to_encoding'];
03893         
03894         if (function_exists('mb_convert_encoding')) {
03895           $string = mb_convert_encoding($string, $to_enc, $from_enc);
03896         }
03897         
03898       }
03899       
03900       // This is to avoid cases where low ascii digits have slipped into HTML.
03901       // AFAIK, it should not adversly effect UTF-8 documents.
03902       if (!empty($this->options['strip_low_ascii'])) {
03903         $string = filter_var($string, FILTER_UNSAFE_RAW, FILTER_FLAG_ENCODE_LOW);
03904       }
03905       
03906       // Allow users to override parser settings.
03907       if (empty($this->options['use_parser'])) {
03908         $useParser = '';
03909       }
03910       else {
03911         $useParser = strtolower($this->options['use_parser']);
03912       }
03913       
03914       // If HTML parser is requested, we use it.
03915       if ($useParser == 'html') {
03916         $document->loadHTML($string);
03917       }
03918       // Parse as XML if it looks like XML, or if XML parser is requested.
03919       elseif ($lead == '<?xml' || $useParser == 'xml') {
03920         if ($this->options['replace_entities']) {
03921           $string = QueryPathEntities::replaceAllEntities($string);
03922         }
03923         $document->loadXML($string, $flags);
03924       }
03925       // In all other cases, we try the HTML parser.
03926       else {
03927         $document->loadHTML($string);
03928       }
03929     }
03930     // Emulate 'finally' behavior.
03931     catch (Exception $e) {
03932       restore_error_handler();
03933       throw $e;
03934     }
03935     restore_error_handler();
03936     
03937     if (empty($document)) {
03938       throw new QueryPathParseException('Unknown parser exception.');
03939     }
03940     return $document;
03941   }
03942   
03943   /**
03944    * EXPERT: Be very, very careful using this.
03945    * A utility function for setting the current set of matches.
03946    * It makes sure the last matches buffer is set (for end() and andSelf()).
03947    * @since 2.0
03948    */
03949   public function setMatches($matches, $unique = TRUE) {
03950     // This causes a lot of overhead....
03951     //if ($unique) $matches = self::unique($matches);
03952     $this->last = $this->matches;
03953     
03954     // Just set current matches.
03955     if ($matches instanceof SplObjectStorage) {
03956       $this->matches = $matches;
03957     }
03958     // This is likely legacy code that needs conversion.
03959     elseif (is_array($matches)) {
03960       trigger_error('Legacy array detected.');
03961       $tmp = new SplObjectStorage();
03962       foreach ($matches as $m) $tmp->attach($m);
03963       $this->matches = $tmp;
03964     }
03965     // For non-arrays, try to create a new match set and 
03966     // add this object.
03967     else {
03968       $found = new SplObjectStorage();
03969       if (isset($matches)) $found->attach($matches);
03970       $this->matches = $found;
03971     }
03972     
03973     // EXPERIMENTAL: Support for qp()->length.
03974     $this->length = $this->matches->count();
03975   }
03976   
03977   /**
03978    * Set the match monitor to empty.
03979    *
03980    * This preserves history.
03981    *
03982    * @since 2.0
03983    */
03984   private function noMatches() {
03985     $this->setMatches(NULL);
03986   }
03987     
03988   /**
03989    * A utility function for retriving a match by index.
03990    *
03991    * The internal data structure used in QueryPath does not have
03992    * strong random access support, so we suppliment it with this method.
03993    */
03994   private function getNthMatch($index) {
03995     if ($index > $this->matches->count() || $index < 0) return;
03996     
03997     $i = 0;
03998     foreach ($this->matches as $m) {
03999       if ($i++ == $index) return $m;
04000     }
04001   }
04002   
04003   /**
04004    * Convenience function for getNthMatch(0).
04005    */
04006   private function getFirstMatch() {
04007     $this->matches->rewind();
04008     return $this->matches->current();
04009   }
04010   
04011   /**
04012    * Parse just a fragment of XML.
04013    * This will automatically prepend an <?xml ?> declaration before parsing.
04014    * @param string $string 
04015    *   Fragment to parse.
04016    * @return DOMDocumentFragment 
04017    *   The parsed document fragment.
04018    */
04019    /*
04020   private function parseXMLFragment($string) {
04021     $frag = $this->document->createDocumentFragment();
04022     $frag->appendXML($string);
04023     return $frag;
04024   }
04025   */
04026   
04027   /**
04028    * Parse an XML or HTML file.
04029    *
04030    * This attempts to autodetect the type of file, and then parse it.
04031    *
04032    * @param string $filename
04033    *  The file name to parse.
04034    * @param int $flags
04035    *  The OR-combined flags accepted by the DOM parser. See the PHP documentation
04036    *  for DOM or for libxml.
04037    * @param resource $context
04038    *  The stream context for the file IO. If this is set, then an alternate 
04039    *  parsing path is followed: The file is loaded by PHP's stream-aware IO
04040    *  facilities, read entirely into memory, and then handed off to 
04041    *  {@link parseXMLString()}. On large files, this can have a performance impact.
04042    * @throws QueryPathParseException 
04043    *  Thrown when a file cannot be loaded or parsed.
04044    */
04045   private function parseXMLFile($filename, $flags = NULL, $context = NULL) {
04046     
04047     // If a context is specified, we basically have to do the reading in 
04048     // two steps:
04049     if (!empty($context)) {
04050       try {
04051         set_error_handler(array('QueryPathParseException', 'initializeFromError'), $this->errTypes);
04052         $contents = file_get_contents($filename, FALSE, $context);
04053         
04054       }
04055       // Apparently there is no 'finally' in PHP, so we have to restore the error
04056       // handler this way:
04057       catch(Exception $e) {
04058         restore_error_handler();
04059         throw $e;
04060       }
04061       restore_error_handler();
04062       
04063       if ($contents == FALSE) {
04064         throw new QueryPathParseException(sprintf('Contents of the file %s could not be retrieved.', $filename));
04065       }
04066       
04067       
04068       /* This is basically unneccessary overhead, as it is not more
04069        * accurate than the existing method.
04070       if (isset($md['wrapper_type']) &&  $md['wrapper_type'] == 'http') {
04071         for ($i = 0; $i < count($md['wrapper_data']); ++$i) {
04072           if (stripos($md['wrapper_data'][$i], 'content-type:') !== FALSE) {
04073             $ct = trim(substr($md['wrapper_data'][$i], 12));
04074             if (stripos('text/html') === 0) {
04075               $this->parseXMLString($contents, $flags, 'text/html');
04076             }
04077             else {
04078               // We can't account for all of the mime types that have
04079               // an XML payload, so we set it to XML.
04080               $this->parseXMLString($contents, $flags, 'text/xml');
04081             }
04082             break;
04083           }
04084         }
04085       }
04086       */
04087       
04088       return $this->parseXMLString($contents, $flags);
04089     }
04090     
04091     $document = new DOMDocument();
04092     $lastDot = strrpos($filename, '.');
04093     
04094     $htmlExtensions = array(
04095       '.html' => 1,
04096       '.htm' => 1,
04097     );
04098     
04099     // Allow users to override parser settings.
04100     if (empty($this->options['use_parser'])) {
04101       $useParser = '';
04102     }
04103     else {
04104       $useParser = strtolower($this->options['use_parser']);
04105     }
04106     
04107     $ext = $lastDot !== FALSE ? strtolower(substr($filename, $lastDot)) : '';
04108     
04109     try {
04110       set_error_handler(array('QueryPathParseException', 'initializeFromError'), $this->errTypes);
04111       
04112       // If the parser is explicitly set to XML, use that parser.
04113       if ($useParser == 'xml') {
04114         $r = $document->load($filename, $flags);
04115       }
04116       // Otherwise, see if it looks like HTML.
04117       elseif (isset($htmlExtensions[$ext]) || $useParser == 'html') {
04118         // Try parsing it as HTML.
04119         $r = $document->loadHTMLFile($filename);
04120       }
04121       // Default to XML.
04122       else {
04123         $r = $document->load($filename, $flags);
04124       }
04125       
04126     }
04127     // Emulate 'finally' behavior.
04128     catch (Exception $e) {
04129       restore_error_handler();
04130       throw $e;
04131     }
04132     restore_error_handler();
04133     
04134     
04135     
04136     /*
04137     if ($r == FALSE) {
04138       $fmt = 'Failed to load file %s: %s (%s, %s)';
04139       $err = error_get_last();
04140       if ($err['type'] & self::IGNORE_ERRORS) {
04141         // Need to report these somehow...
04142         trigger_error($err['message'], E_USER_WARNING);
04143       }
04144       else {
04145         throw new QueryPathParseException(sprintf($fmt, $filename, $err['message'], $err['file'], $err['line']));
04146       }
04147       
04148       //throw new QueryPathParseException(sprintf($fmt, $filename, $err['message'], $err['file'], $err['line']));
04149     }
04150     */
04151     return $document;
04152   }
04153   
04154   /**
04155    * Call extension methods.
04156    *
04157    * This function is used to invoke extension methods. It searches the
04158    * registered extenstensions for a matching function name. If one is found,
04159    * it is executed with the arguments in the $arguments array.
04160    * 
04161    * @throws QueryPathException
04162    *  An exception is thrown if a non-existent method is called.
04163    */
04164   public function __call($name, $arguments) {
04165     
04166     if (!QueryPathExtensionRegistry::$useRegistry) {
04167       throw new QueryPathException("No method named $name found (Extensions disabled).");      
04168     }
04169     
04170     // Loading of extensions is deferred until the first time a
04171     // non-core method is called. This makes constructing faster, but it
04172     // may make the first invocation of __call() slower (if there are 
04173     // enough extensions.)
04174     //
04175     // The main reason for moving this out of the constructor is that most
04176     // new QueryPath instances do not use extensions. Charging qp() calls
04177     // with the additional hit is not a good idea.
04178     //
04179     // Also, this will at least limit the number of circular references.
04180     if (empty($this->ext)) {
04181       // Load the registry
04182       $this->ext = QueryPathExtensionRegistry::getExtensions($this);
04183     }
04184     
04185     // Note that an empty ext registry indicates that extensions are disabled.
04186     if (!empty($this->ext) && QueryPathExtensionRegistry::hasMethod($name)) {
04187       $owner = QueryPathExtensionRegistry::getMethodClass($name);
04188       $method = new ReflectionMethod($owner, $name);
04189       return $method->invokeArgs($this->ext[$owner], $arguments);
04190     }
04191     throw new QueryPathException("No method named $name found. Possibly missing an extension.");
04192   }
04193   
04194   /**
04195    * Dynamically generate certain properties.
04196    *
04197    * This is used primarily to increase jQuery compatibility by providing property-like
04198    * behaviors.
04199    *
04200    * Currently defined properties:
04201    *   - length: Alias of {@link size()}.
04202    */
04203    /*
04204   public function __get($name) {
04205     switch ($name) {
04206       case 'length':
04207         return $this->size();
04208       default:
04209         throw new QueryPathException('Unknown or inaccessible property "' . $name . '" (via __get())');
04210     }
04211   }
04212   */
04213   
04214   /**
04215    * Get an iterator for the matches in this object.
04216    * @return Iterable
04217    *  Returns an iterator.
04218    */
04219   public function getIterator() {
04220     $i = new QueryPathIterator($this->matches);
04221     $i->options = $this->options;
04222     return $i;
04223   }
04224 }
04225 
04226 /**
04227  * Perform various tasks on HTML/XML entities.
04228  *
04229  * @ingroup querypath_util
04230  */
04231 class QueryPathEntities {
04232   
04233   /**
04234    * This is three regexes wrapped into 1. The | divides them.
04235    * 1: Match any char-based entity. This will go in $matches[1]
04236    * 2: Match any num-based entity. This will go in $matches[2]
04237    * 3: Match any hex-based entry. This will go in $matches[3]
04238    * 4: Match any ampersand that is not an entity. This goes in $matches[4]
04239    *    This last rule will only match if one of the previous two has not already
04240    *    matched.
04241    * XXX: Are octal encodings for entities acceptable?
04242    */
04243   //protected static $regex = '/&([\w]+);|&#([\d]+);|&([\w]*[\s$]+)/m';
04244   protected static $regex = '/&([\w]+);|&#([\d]+);|&#(x[0-9a-fA-F]+);|(&)/m';
04245   
04246   /**
04247    * Replace all entities.
04248    * This will scan a string and will attempt to replace all
04249    * entities with their numeric equivalent. This will not work
04250    * with specialized entities.
04251    *
04252    * @param string $string
04253    *  The string to perform replacements on.
04254    * @return string
04255    *  Returns a string that is similar to the original one, but with 
04256    *  all entity replacements made.
04257    */
04258   public static function replaceAllEntities($string) {
04259     return preg_replace_callback(self::$regex, 'QueryPathEntities::doReplacement', $string);
04260   }
04261   
04262   /**
04263    * Callback for processing replacements.
04264    *
04265    * @param array $matches
04266    *  The regular expression replacement array.
04267    */
04268   protected static function doReplacement($matches) {
04269     // See how the regex above works out.
04270     //print_r($matches);
04271 
04272     // From count, we can tell whether we got a 
04273     // char, num, or bare ampersand.
04274     $count = count($matches);
04275     switch ($count) {
04276       case 2:
04277         // We have a character entity
04278         return '&#' . self::replaceEntity($matches[1]) . ';';
04279       case 3:
04280       case 4:
04281         // we have a numeric entity
04282         return '&#' . $matches[$count-1] . ';'; 
04283       case 5:
04284         // We have an unescaped ampersand.
04285         return '&#38;';
04286     }
04287   }
04288   
04289   /**
04290    * Lookup an entity string's numeric equivalent.
04291    *
04292    * @param string $entity
04293    *  The entity whose numeric value is needed.
04294    * @return int
04295    *  The integer value corresponding to the entity.
04296    * @author Matt Butcher
04297    * @author Ryan Mahoney
04298    */
04299   public static function replaceEntity($entity) {
04300     return self::$entity_array[$entity];
04301   }
04302   
04303   /**
04304    * Conversion mapper for entities in HTML.
04305    * Large entity conversion table. This is 
04306    * significantly broader in range than 
04307    * get_html_translation_table(HTML_ENTITIES).
04308    *
04309    * This code comes from Rhizome ({@link http://code.google.com/p/sinciput})
04310    *
04311    * @see get_html_translation_table()
04312    */
04313   private static $entity_array = array(
04314     'nbsp' => 160, 'iexcl' => 161, 'cent' => 162, 'pound' => 163, 
04315     'curren' => 164, 'yen' => 165, 'brvbar' => 166, 'sect' => 167, 
04316     'uml' => 168, 'copy' => 169, 'ordf' => 170, 'laquo' => 171, 
04317     'not' => 172, 'shy' => 173, 'reg' => 174, 'macr' => 175, 'deg' => 176, 
04318     'plusmn' => 177, 'sup2' => 178, 'sup3' => 179, 'acute' => 180, 
04319     'micro' => 181, 'para' => 182, 'middot' => 183, 'cedil' => 184, 
04320     'sup1' => 185, 'ordm' => 186, 'raquo' => 187, 'frac14' => 188, 
04321     'frac12' => 189, 'frac34' => 190, 'iquest' => 191, 'Agrave' => 192, 
04322     'Aacute' => 193, 'Acirc' => 194, 'Atilde' => 195, 'Auml' => 196, 
04323     'Aring' => 197, 'AElig' => 198, 'Ccedil' => 199, 'Egrave' => 200, 
04324     'Eacute' => 201, 'Ecirc' => 202, 'Euml' => 203, 'Igrave' => 204, 
04325     'Iacute' => 205, 'Icirc' => 206, 'Iuml' => 207, 'ETH' => 208, 
04326     'Ntilde' => 209, 'Ograve' => 210, 'Oacute' => 211, 'Ocirc' => 212, 
04327     'Otilde' => 213, 'Ouml' => 214, 'times' => 215, 'Oslash' => 216, 
04328     'Ugrave' => 217, 'Uacute' => 218, 'Ucirc' => 219, 'Uuml' => 220, 
04329     'Yacute' => 221, 'THORN' => 222, 'szlig' => 223, 'agrave' => 224, 
04330     'aacute' => 225, 'acirc' => 226, 'atilde' => 227, 'auml' => 228, 
04331     'aring' => 229, 'aelig' => 230, 'ccedil' => 231, 'egrave' => 232, 
04332     'eacute' => 233, 'ecirc' => 234, 'euml' => 235, 'igrave' => 236, 
04333     'iacute' => 237, 'icirc' => 238, 'iuml' => 239, 'eth' => 240, 
04334     'ntilde' => 241, 'ograve' => 242, 'oacute' => 243, 'ocirc' => 244, 
04335     'otilde' => 245, 'ouml' => 246, 'divide' => 247, 'oslash' => 248, 
04336     'ugrave' => 249, 'uacute' => 250, 'ucirc' => 251, 'uuml' => 252, 
04337     'yacute' => 253, 'thorn' => 254, 'yuml' => 255, 'quot' => 34, 
04338     'amp' => 38, 'lt' => 60, 'gt' => 62, 'apos' => 39, 'OElig' => 338, 
04339     'oelig' => 339, 'Scaron' => 352, 'scaron' => 353, 'Yuml' => 376, 
04340     'circ' => 710, 'tilde' => 732, 'ensp' => 8194, 'emsp' => 8195, 
04341     'thinsp' => 8201, 'zwnj' => 8204, 'zwj' => 8205, 'lrm' => 8206, 
04342     'rlm' => 8207, 'ndash' => 8211, 'mdash' => 8212, 'lsquo' => 8216, 
04343     'rsquo' => 8217, 'sbquo' => 8218, 'ldquo' => 8220, 'rdquo' => 8221, 
04344     'bdquo' => 8222, 'dagger' => 8224, 'Dagger' => 8225, 'permil' => 8240, 
04345     'lsaquo' => 8249, 'rsaquo' => 8250, 'euro' => 8364, 'fnof' => 402, 
04346     'Alpha' => 913, 'Beta' => 914, 'Gamma' => 915, 'Delta' => 916, 
04347     'Epsilon' => 917, 'Zeta' => 918, 'Eta' => 919, 'Theta' => 920, 
04348     'Iota' => 921, 'Kappa' => 922, 'Lambda' => 923, 'Mu' => 924, 'Nu' => 925, 
04349     'Xi' => 926, 'Omicron' => 927, 'Pi' => 928, 'Rho' => 929, 'Sigma' => 931,
04350     'Tau' => 932, 'Upsilon' => 933, 'Phi' => 934, 'Chi' => 935, 'Psi' => 936,
04351     'Omega' => 937, 'alpha' => 945, 'beta' => 946, 'gamma' => 947, 
04352     'delta' => 948, 'epsilon' => 949, 'zeta' => 950, 'eta' => 951, 
04353     'theta' => 952, 'iota' => 953, 'kappa' => 954, 'lambda' => 955, 
04354     'mu' => 956, 'nu' => 957, 'xi' => 958, 'omicron' => 959, 'pi' => 960, 
04355     'rho' => 961, 'sigmaf' => 962, 'sigma' => 963, 'tau' => 964, 
04356     'upsilon' => 965, 'phi' => 966, 'chi' => 967, 'psi' => 968, 
04357     'omega' => 969, 'thetasym' => 977, 'upsih' => 978, 'piv' => 982, 
04358     'bull' => 8226, 'hellip' => 8230, 'prime' => 8242, 'Prime' => 8243, 
04359     'oline' => 8254, 'frasl' => 8260, 'weierp' => 8472, 'image' => 8465, 
04360     'real' => 8476, 'trade' => 8482, 'alefsym' => 8501, 'larr' => 8592, 
04361     'uarr' => 8593, 'rarr' => 8594, 'darr' => 8595, 'harr' => 8596, 
04362     'crarr' => 8629, 'lArr' => 8656, 'uArr' => 8657, 'rArr' => 8658, 
04363     'dArr' => 8659, 'hArr' => 8660, 'forall' => 8704, 'part' => 8706, 
04364     'exist' => 8707, 'empty' => 8709, 'nabla' => 8711, 'isin' => 8712, 
04365     'notin' => 8713, 'ni' => 8715, 'prod' => 8719, 'sum' => 8721, 
04366     'minus' => 8722, 'lowast' => 8727, 'radic' => 8730, 'prop' => 8733, 
04367     'infin' => 8734, 'ang' => 8736, 'and' => 8743, 'or' => 8744, 'cap' => 8745, 
04368     'cup' => 8746, 'int' => 8747, 'there4' => 8756, 'sim' => 8764, 
04369     'cong' => 8773, 'asymp' => 8776, 'ne' => 8800, 'equiv' => 8801, 
04370     'le' => 8804, 'ge' => 8805, 'sub' => 8834, 'sup' => 8835, 'nsub' => 8836, 
04371     'sube' => 8838, 'supe' => 8839, 'oplus' => 8853, 'otimes' => 8855, 
04372     'perp' => 8869, 'sdot' => 8901, 'lceil' => 8968, 'rceil' => 8969, 
04373     'lfloor' => 8970, 'rfloor' => 8971, 'lang' => 9001, 'rang' => 9002, 
04374     'loz' => 9674, 'spades' => 9824, 'clubs' => 9827, 'hearts' => 9829, 
04375     'diams' => 9830
04376   );
04377 }
04378 
04379 /**
04380  * An iterator for QueryPath.
04381  *
04382  * This provides iterator support for QueryPath. You do not need to construct
04383  * a QueryPathIterator. QueryPath does this when its {@link QueryPath::getIterator()}
04384  * method is called.
04385  *
04386  * @ingroup querypath_util
04387  */
04388 class QueryPathIterator extends IteratorIterator {
04389   public $options = array();
04390   private $qp = NULL;
04391   
04392   public function current() {
04393     if (!isset($this->qp)) {
04394       $this->qp = qp(parent::current(), NULL, $this->options);
04395     }
04396     else {
04397       $splos = new SplObjectStorage();
04398       $splos->attach(parent::current());
04399       $this->qp->setMatches($splos);
04400     }
04401     return $this->qp;
04402   }
04403 }
04404 
04405 /**
04406  * Manage default options.
04407  *
04408  * This class stores the default options for QueryPath. When a new 
04409  * QueryPath object is constructed, options specified here will be 
04410  * used.
04411  *
04412  * <b>Details</b>
04413  * This class defines no options of its own. Instead, it provides a 
04414  * central tool for developers to override options set by QueryPath.
04415  * When a QueryPath object is created, it will evaluate options in the 
04416  * following order:
04417  *
04418  * - Options passed into {@link qp()} have highest priority.
04419  * - Options in {@link QueryPathOptions} (this class) have the next highest priority.
04420  * - If the option is not specified elsewhere, QueryPath will use its own defaults.
04421  *
04422  * @see qp()
04423  * @see QueryPathOptions::set()
04424  * @ingroup querypath_util
04425  */
04426 class QueryPathOptions {
04427   
04428   /**
04429    * This is the static options array.
04430    *
04431    * Use the {@link set()}, {@link get()}, and {@link merge()} to
04432    * modify this array.
04433    */
04434   static $options = array();
04435   
04436   /**
04437    * Set the default options.
04438    *
04439    * The passed-in array will be used as the default options list.
04440    *
04441    * @param array $array
04442    *  An associative array of options.
04443    */
04444   static function set($array) {
04445     self::$options = $array;
04446   }
04447   
04448   /**
04449    * Get the default options.
04450    *
04451    * Get all options currently set as default.
04452    *
04453    * @return array
04454    *  An array of options. Note that only explicitly set options are 
04455    *  returned. {@link QueryPath} defines default options which are not
04456    *  stored in this object.
04457    */
04458   static function get() {
04459     return self::$options;
04460   }
04461   
04462   /**
04463    * Merge the provided array with existing options.
04464    *
04465    * On duplicate keys, the value in $array will overwrite the 
04466    * value stored in the options.
04467    *
04468    * @param array $array
04469    *  Associative array of options to merge into the existing options.
04470    */
04471   static function merge($array) {
04472     self::$options = $array + self::$options;
04473   }
04474   
04475   /**
04476    * Returns true of the specified key is already overridden in this object.
04477    *
04478    * @param string $key
04479    *  The key to search for.
04480    */
04481   static function has($key) {
04482     return array_key_exists($key, self::$options);
04483   }
04484   
04485 }
04486 
04487 /**
04488  * Exception indicating that a problem has occured inside of a QueryPath object.
04489  *
04490  * @ingroup querypath_core
04491  */
04492 class QueryPathException extends Exception {}
04493 
04494 /**
04495  * Exception indicating that a parser has failed to parse a file.
04496  *
04497  * This will report parser warnings as well as parser errors. It should only be 
04498  * thrown, though, under error conditions.
04499  *
04500  * @ingroup querypath_core
04501  */
04502 class QueryPathParseException extends QueryPathException {
04503   const ERR_MSG_FORMAT = 'Parse error in %s on line %d column %d: %s (%d)';
04504   const WARN_MSG_FORMAT = 'Parser warning in %s on line %d column %d: %s (%d)';
04505   // trigger_error
04506   public function __construct($msg = '', $code = 0, $file = NULL, $line = NULL) {
04507 
04508     $msgs = array();
04509     foreach(libxml_get_errors() as $err) {
04510       $format = $err->level == LIBXML_ERR_WARNING ? self::WARN_MSG_FORMAT : self::ERR_MSG_FORMAT;
04511       $msgs[] = sprintf($format, $err->file, $err->line, $err->column, $err->message, $err->code);
04512     }
04513     $msg .= implode("\n", $msgs);
04514     
04515     if (isset($file)) {
04516       $msg .= ' (' . $file;
04517       if (isset($line)) $msg .= ': ' . $line;
04518       $msg .= ')';
04519     }
04520     
04521     parent::__construct($msg, $code);
04522   }
04523   
04524   public static function initializeFromError($code, $str, $file, $line, $cxt) {
04525     //printf("\n\nCODE: %s %s\n\n", $code, $str);
04526     $class = __CLASS__;
04527     throw new $class($str, $code, $file, $line);
04528   }
04529 }
04530 
04531 /**
04532  * Indicates that an input/output exception has occurred.
04533  *
04534  * @ingroup querypath_core
04535  */
04536 class QueryPathIOException extends QueryPathParseException {
04537   public static function initializeFromError($code, $str, $file, $line, $cxt) {
04538     $class = __CLASS__;
04539     throw new $class($str, $code, $file, $line);
04540   }
04541   
04542 }