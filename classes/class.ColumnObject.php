<?php

error_reporting(E_ALL);

/**
 * WSCmodel - server\class.ColumnObject.php
 *
 * $Id$
 *
 * This file is part of WSCmodel.
 *
 * Automatically generated on 25.11.2012, 13:40:21 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 * @package server
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * include client_HTMLObject
 *
 * @author firstname and lastname of author, <author@example.org>
 */
//require_once('client/class.HTMLObject.php');

/**
 * include server_Search
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('class.Search.php');

/**
 * include server_TableObject
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('class.TableObject.php');

/* user defined includes */
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:000000000000089E-includes begin
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:000000000000089E-includes end

/* user defined constants */
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:000000000000089E-constants begin
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:000000000000089E-constants end

/**
 * Short description of class server_ColumnObject
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 * @package server
 */
class ColumnObject
{
    public $alias = null;
    public $columnName = null;
    public $sqlDataType = null;
    public $value = null;
    public $owner = null; //"database.table"

    public function __construct($alias, $columnName, $sqlDataType, $owner)
    {
        $this->alias = $alias;
        $this->columnName = $columnName;
        $this->sqlDataType = $sqlDataType;
        $this->owner = $owner;
       
    }
    
    public function __toString()
    {
         return "Alias: ".$this->alias."<br />ColumnName: ".$this->columnName."<br />Datatype: ".$this->sqlDataType."<br />Owner: ".$this->owner."<br />";
    }

} /* end of class server_ColumnObject */

?>