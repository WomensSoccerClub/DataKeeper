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

/**
 * include databases_KeyObject
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('databases/class.KeyObject.php');

/**
 * include server_ColumnObject
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('server/class.ColumnObject.php');

/**
 * include server_Object
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('server/class.Object.php');

/* user defined includes */
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:000000000000087A-includes begin
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:000000000000087A-includes end

/* user defined constants */
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:000000000000087A-constants begin
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:000000000000087A-constants end

/**
 * Short description of class server_TableObject
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 * @package server
 */
class server_TableObject
    extends server_Object
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd :     // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute databaseName
     *
     * @access public
     * @var String
     */
    public $databaseName = null;

    /**
     * Short description of attribute columnList
     *
     * @access public
     * @var ColumnObject
     */
    public $columnList = null;

    /**
     * Short description of attribute primaryKey
     *
     * @access public
     * @var String
     */
    public $primaryKey = null;

    // --- OPERATIONS ---

    /**
     * Short description of method getFullName
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return String
     */
    public function getFullName()
    {
        $returnValue = null;

        // section -122-48--89-8--1e6caf83:13aa9af80f4:-8000:00000000000009F6 begin
        // section -122-48--89-8--1e6caf83:13aa9af80f4:-8000:00000000000009F6 end

        return $returnValue;
    }

    /**
     * Short description of method getColumnsList
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return server_ColumnObject
     */
    public function getColumnsList()
    {
        $returnValue = null;

        // section -122-48--89-8--1e6caf83:13aa9af80f4:-8000:0000000000000A1E begin
        // section -122-48--89-8--1e6caf83:13aa9af80f4:-8000:0000000000000A1E end

        return $returnValue;
    }

    /**
     * Short description of method updateTable
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    public function updateTable()
    {
        // section -64--88--106-1-2306742:13aaa869672:-8000:0000000000000A66 begin
        // section -64--88--106-1-2306742:13aaa869672:-8000:0000000000000A66 end
    }

    /**
     * Short description of method TableObject
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function TableObject()
    {
        // section -64--88--106-1-1d17cda6:13aff8f3ef5:-8000:0000000000000AB6 begin
        // section -64--88--106-1-1d17cda6:13aff8f3ef5:-8000:0000000000000AB6 end
    }

} /* end of class server_TableObject */

?>