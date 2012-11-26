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
require_once('client/class.HTMLObject.php');

/**
 * include server_Object
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('server/class.Object.php');

/**
 * include server_Search
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('server/class.Search.php');

/**
 * include server_TableObject
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('server/class.TableObject.php');

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
    extends Object
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd :     // generateAssociationEnd :     // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute columnName
     *
     * @access public
     * @var String
     */
    public $columnName = null;

    /**
     * Short description of attribute sqlDataType
     *
     * @access public
     * @var String
     */
    public $sqlDataType = null;

    /**
     * Short description of attribute owner
     *
     * @access public
     * @var TableObject
     */
    public $owner = null;

    // --- OPERATIONS ---

    /**
     * Short description of method getValue
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return String
     */
    public function getValue()
    {
        $returnValue = null;

        // section -122-48--89-8--1e6caf83:13aa9af80f4:-8000:00000000000009F8 begin
        // section -122-48--89-8--1e6caf83:13aa9af80f4:-8000:00000000000009F8 end

        return $returnValue;
    }

    /**
     * Short description of method getHTMLObject
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return client_HTMLObject
     */
    public function getHTMLObject()
    {
        $returnValue = null;

        // section -122-48--89-8--1e6caf83:13aa9af80f4:-8000:00000000000009FF begin
        // section -122-48--89-8--1e6caf83:13aa9af80f4:-8000:00000000000009FF end

        return $returnValue;
    }

    /**
     * Short description of method updateColumn
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    public function updateColumn()
    {
        // section -64--88--106-1-2306742:13aaa869672:-8000:0000000000000A68 begin
        // section -64--88--106-1-2306742:13aaa869672:-8000:0000000000000A68 end
    }

    /**
     * Short description of method ColumnObject
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function ColumnObject()
    {
        // section -64--88--106-1-1d17cda6:13aff8f3ef5:-8000:0000000000000AB2 begin
        // section -64--88--106-1-1d17cda6:13aff8f3ef5:-8000:0000000000000AB2 end
    }

} /* end of class server_ColumnObject */

?>