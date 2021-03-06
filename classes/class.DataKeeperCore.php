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

function createKeyObjects()
{
    $KeyObjects = array(); //an array of KeyObject "names"
    $KeyObjectXML = LoadObjectsFromXML("KeyObject");
    foreach($KeyObjectXML as $KeyObjectElement)
    {
        $name = $KeyObjectElement->getAttribute("name");
        if(!$name=="")
            $KeyObjects[]= $name;
    }
    $KeyObjectArray = array();
    foreach($KeyObjects as $KeyObject)
    {
        $KeyObjectArray[$KeyObject] = new KeyObject($KeyObject);
    }
    return $KeyObjectArray;

}
//$KeyObjects = createKeyObjects();
//print_r($KeyObjects);


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
   $alias = $_GET['columnAlias'];
   $newColumn = new ColumnObject($alias, $columnName, null, $owner);
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

if(isset($_GET['GetParentAliasFromTable']))
{
    echo getParentAliasOfTable($_GET['GetParentAliasFromTable']);
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

function getParentAliasOfTable($tableName)
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
    $tables = $xml->getElementsByTagName("table");
    
    foreach($tables as $tableElement)
    {
        //echo $tableElement->getAttribute("value");
        if($tableElement->getAttribute("value")==$tableName)
        {
            $parent = $tableElement->parentNode->getAttribute("name");
            break;
        }
    }
    return $parent;
}

function search($array, $key, $value)
{
    $results = array();

    if (is_array($array))
    {
        if (isset($array[$key]) && $array[$key] == $value)
            $results[] = $array;

        foreach ($array as $subarray)
            $results = array_merge($results, search($subarray, $key, $value));
    }

    return $results;
}

?>
