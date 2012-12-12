<?php
require_once('class.KeyObject.php');
require_once('class.Search.php');
require_once('class.TableObject.php');
require_once('class.ColumnObject.php');
session_start();
error_reporting(E_ALL);

/**
 * WSCmodel - server\class.DataKeeperCore.php
 *
 * $Id$
 *
 * This file is part of WSCmodel.
 *
 * Automatically generated on 25.11.2012, 13:41:45 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 * @package server
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}


$KeyObjects = array();
$KeyObjectXML = LoadObjectsFromXML("KeyObject");
foreach($KeyObjectXML as $KeyObjectElement)
{
    $KeyObjects[]=$KeyObjectElement->getAttribute("name");
}


if(isset($_GET['KeyObjectSelect'])) //keeping track of the current KeyObject the user is searching for
{
    echo $_SESSION['CURRENT_KEYOBJECT'];
    $_SESSION['CURRENT_KEYOBJECT']=$_GET['KeyObjectSelect'];
    
}

if(isset($_GET['AddToSearch'])) //adding a column to the current search
{
   $columnName = $_GET['columnName'];
   $value = $_GET['value'];
   $owner = $_GET['owner'];
   
   $newColumn = new ColumnObject(null, $columnName, null, $owner);
   $newColumn->setValue($value);
   $_SESSION['CURRENT_SEARCH'][] = $newColumn;
   print_r($_SESSION['CURRENT_SEARCH']);
   $search = new Search(null, $_SESSION['CURRENT_SEARCH'], null, null);
   echo $search->getQuery();
}

if(isset($_GET['ClearSearch'])) //if ClearSearch exists, do just that.
{
    $_SESSION['CURRENT_SEARCH']=null;
}


function cast($destination, $sourceObject)
{
    if (is_string($destination)) {
        $destination = new $destination();
    }
    $sourceReflection = new ReflectionObject($sourceObject);
    $destinationReflection = new ReflectionObject($destination);
    $sourceProperties = $sourceReflection->getProperties();
    foreach ($sourceProperties as $sourceProperty) {
        $sourceProperty->setAccessible(true);
        $name = $sourceProperty->getName();
        $value = $sourceProperty->getValue($sourceObject);
        if ($destinationReflection->hasProperty($name)) {
            $propDest = $destinationReflection->getProperty($name);
            $propDest->setAccessible(true);
            $propDest->setValue($destination,$value);
        } else {
            $destination->$name = $value;
        }
    }
    return $destination;
}

function LoadObjectsFromXML($tag)
{
    $root = $_SERVER["DOCUMENT_ROOT"];
    $xml = new DOMDocument();
    $location = $root."/config.xml";
    
    if(!file_exists($location))   //if the file doesn't exists
    {
        echo "The config file \"$location\" was not found. This is horribly wrong.";
        exit;
    }
    $theXML = file_get_contents($location);
    $xml->loadXML($theXML);
    $Objects = $xml->getElementsByTagName($tag);
    
    return $Objects;
}
function updateSearchHistory($search){

    $root = $_SERVER["DOCUMENT_ROOT"];
    $history = new DOMDocument();
    $location = "../searchHistory/searchHistory.xml";
    
     if(!file_exists($location))   //if the file doesn't exists
    {
        echo "The config file \"$location\" was not found. This is horribly wrong.";
        exit;
    }
    
    $theXML = file_get_contents($location);
    $history->loadXML($theXML);
    $xp = new DOMXPath($history);
     //echo $theXML;
    $list = $history->getElementsByTagName("search");
    $increment = 1;
    
    foreach($list as $value){
       
            $query = $value->getAttribute("query");
            $popularity = $value->getAttribute("popularity");
            $update = $popularity + $increment;
            
        if ($query == $search){
            
            $value->setAttribute("popularity", $update);
            
        }
        echo $value->getAttribute('id').' ';
        echo $value->getAttribute("popularity").'<br>';
        
    }
    
}
$search = "Seach for captains?";
updateSearchHistory($search);
    

?>
