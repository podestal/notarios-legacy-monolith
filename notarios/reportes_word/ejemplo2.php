<?php

// Display this code source is asked.
//if (isset($_GET['source'])) exit('<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>OpenTBS plug-in for TinyButStrong - demo //source</title></head><body>'.highlight_file(__FILE__,true).'</body></html>');

// load the TinyButStrong libraries
include_once('../includes/tbs_class.php');

// load the OpenTBS plugin
include_once('../includes/tbs_plugin_opentbs.php');


$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load OpenTBS plugin


// Retrieve the template to open
$template = 'demo_oo_text.odt';//(isset($_POST['tpl'])) ? $_POST['tpl'] : '';
$template = basename($template);
$x = pathinfo($template);
$template_ext = $x['extension'];
if (substr($template,0,5)!=='demo_') exit("Wrong file.");
if (!file_exists($template)) exit("File does not exist.");


// Prepare some data for the demo
$data = array();
$data[] = array('firstname'=>'Sandra' , 'name'=>'Hill'      , 'number'=>'1523d', 'score'=>200, 'email_1'=>'sh@tbs.com',  'email_2'=>'sandra@tbs.com',  'email_3'=>'s.hill@tbs.com');
$data[] = array('firstname'=>'Roger'  , 'name'=>'Smith'     , 'number'=>'1234f', 'score'=>800, 'email_1'=>'rs@tbs.com',  'email_2'=>'robert@tbs.com',  'email_3'=>'r.smith@tbs.com' );
$data[] = array('firstname'=>'William', 'name'=>'Mac Dowell', 'number'=>'5491y', 'score'=>130, 'email_1'=>'wmc@tbs.com', 'email_2'=>'william@tbs.com', 'email_3'=>'w.m.dowell@tbs.com' );

$x_num = 3152.456;
$x_pc = 0.2567;
$x_dt = mktime(13,0,0,2,15,2010);
$x_bt = true;
$x_bf = false;

$x_delete = 1;

// Load the template
$TBS->LoadTemplate($template);

// Merge data
$TBS->MergeBlock('a,b', $data);

//Por default la ODT:

    // delete comments
    //$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
    

// Define the name of the output file
$file_name = str_replace('.','_'.date('Y-m-d').'.',$template);

// Output as a download file (some automatic fields are merged here)

    // download
    $TBS->Show(OPENTBS_DOWNLOAD, $file_name);
