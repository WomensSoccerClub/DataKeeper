<?php

error_reporting(E_ALL);

/**
 * WSCmodel - server\class.TableObject.php
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

require_once('class.KeyObject.php');
require_once('class.ColumnObject.php');

/**
 * Short description of class server_TableObject
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 * @package server
 */
class TableObject
{
    
    public $alias = null;
    public $tableName = null;
    public $columnList = array();
    public $databaseName = null;

    public function getColumns()
    {
    $xml = new DOMDocument();
    $root = $_SERVER["DOCUMENT_ROOT"];
    $location = "$root/config.xml";
    
    if(!file_exists($location))   //if the file doesn't exists
    {
        echo "The config file \"$location\" was not found. This is horribly wrong.";
        exit;
    }
    $theXML = file_get_contents($location);
    $xml->loadXML($theXML);
    $KeyObjects = $xml->getElementsByTagName("table");

    foreach($KeyObjects as $domElement)
    {
        if($domElement->getAttribute("name") == $this->alias) //if the element is the object we're looking for
            break;
    }
    
    $tableNodes = $domElement->getElementsByTagName("column");
    $columnsArray = array();
    
    foreach($tableNodes as $tableElement) //loop to find all tables
    {
            //$databaseName = $tableElement->getElementsByTagName("database")->item(0)->nodeValue;
            $alias = $tableElement->getAttribute("name");
            $columnName = $tableElement->nodeValue;
            $sqlDataType = $tableElement->getAttribute("datatype");
            $columnsArray[] = new ColumnObject($alias,$columnName,$sqlDataType, $this->databaseName.".".$this->tableName );
           // echo $tableElement->getAttribute("name");
      
        
    }
    return $columnsArray;
    }

    public function __construct($alias, $tableName, $databaseName)
    {
        $this->alias = $alias;
        $this->tableName = $tableName;
        $this->databaseName = $databaseName;
        $this->columnList = $this::getColumns();
        
       
    }
    
    public function __toString()
    {
         return "Alias: ".$this->alias."<br />TableName: ".$this->tableName."<br />DatabaseName: ".$this->databaseName."<br />";
    }
} /* end of class server_TableObject */

?>