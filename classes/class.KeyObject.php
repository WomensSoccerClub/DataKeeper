<?php

error_reporting(E_ALL);

/**
 * WSCmodel - databases\class.KeyObject.php
 *
 * $Id$
 *
 * This file is part of WSCmodel.
 *
 * Automatically generated on 07.12.2012, 21:19:23 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 * @package databases
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

require_once('class.DataKeeperCore.php');
require_once('class.TableObject.php');

class KeyObject
{
    public $alias = null;
    public $tableList = array();
    public $relatedKeyObjects = array();
    public $labelColumns = null;

function __construct($name) {
       $this->alias = $name;
       $this->tableList = $this::getTables();
       $this->relatedKeyObjects = $this::getRelatedKeyObjects();
       $this->labelColumns = $this::getLabelColumns();
       
   }
   
function getTables()
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
    $KeyObjects = $xml->getElementsByTagName("KeyObject");

    foreach($KeyObjects as $domElement)
    {
        if($domElement->getAttribute("name") == $this->alias) //if the element is the object we're looking for
            break;
    }
    
    $tableNodes = $domElement->getElementsByTagName("table");
    $tableArray = array();
    
    foreach($tableNodes as $tableElement) //loop to find all tables
    {
            $databaseName = $tableElement->getElementsByTagName("database")->item(0)->nodeValue;
            $alias = $tableElement->getAttribute("name");
            $tableName = $tableElement->getAttribute("value");
            $tableArray[] = new TableObject($alias,$tableName, $databaseName);
           // echo $tableElement->getAttribute("name");
      
        
    }
    return $tableArray;
    
}

function getRelatedKeyObjects()
{
    $xml = new DOMDocument();
    $location = "../config.xml";
    
    if(!file_exists($location))   //if the file doesn't exists
    {
        echo "The config file \"$location\" was not found. This is horribly wrong.";
        exit;
    }
    $theXML = file_get_contents($location);
    $xml->loadXML($theXML);
    $KeyObjects = $xml->getElementsByTagName("KeyObject");
    foreach($KeyObjects as $domElement)
    {
        if($domElement->getAttribute("name") == $this->alias) //if the element is the object we're looking for
            break;
    }
    $relatedNodes = $domElement->getElementsByTagName("KeyObject");
    $relatedArray = array();
    foreach($relatedNodes as $relatedElement) //loop to find all tables
    {
            $relatedArray[] = $relatedElement->nodeValue;
    }
    return $relatedArray;
}

function getLabelColumns($name="")
{
    if($name=="")
        $name=$this->alias;
    
    $xml = new DOMDocument();
    $location = "../config.xml";
    
    if(!file_exists($location))   //if the file doesn't exists
    {
        echo "The config file \"$location\" was not found. This is horribly wrong.";
        exit;
    }
    $theXML = file_get_contents($location);
    $xml->loadXML($theXML);
    $KeyObjects = $xml->getElementsByTagName("KeyObject");
    foreach($KeyObjects as $domElement)
    {
        if($domElement->getAttribute("name") == $name) //if the element is the object we're looking for
            break;
    }
    return $domElement->getAttribute("labelColumns");
}
} /* end of class databases_KeyObject */



?>