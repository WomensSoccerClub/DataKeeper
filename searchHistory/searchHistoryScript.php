<?php
error_reporting(E_ERROR | E_PARSE);
require_once("xml2json.php");

// Filename from where XML contents are to be read.
$testXmlFile = "searchHistory.xml";

//Read the XML contents from the input file.
file_exists($testXmlFile) or die('Could not find file ' . $testXmlFile);
$xmlStringContents = file_get_contents($testXmlFile); 
$jsonContents = "";

// Convert it to JSON now. 
// xml2json simply takes a String containing XML contents as input.
//$jsonContents = xml2json::transformXmlStringToJson($xmlStringContents);

//echo("JSON formatted output generated by xml2json:\n\n");
//echo json_encode($jsonContents);
echo $xmlStringContents;



//$page = simpledom_load_string('<page>
//    <talentTrees>
//        <tree name="Football" order="2"/>
//        <tree name="Baseball" order="0"/>
//        <tree name="Frisbee" order="1"/>
//    </talentTrees>
//</page>');
//
//$nodes = $page->sortedXPath('//tree', '@order');
//
//foreach ($nodes as $node)
//{
//    echo $node->asXML(), "\n";
//}
?>