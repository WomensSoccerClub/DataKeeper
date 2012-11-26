<?php

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

/**
 * include databases_KeyObject
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('databases/class.KeyObject.php');

/**
 * include server_Search
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('server/class.Search.php');

/* user defined includes */
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:0000000000000879-includes begin
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:0000000000000879-includes end

/* user defined constants */
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:0000000000000879-constants begin
// section -64--88-2-3--5e821307:13aa8f73ca8:-8000:0000000000000879-constants end

/**
 * Short description of class server_DataKeeperCore
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 * @package server
 */
class server_DataKeeperCore
{
    // --- ASSOCIATIONS ---
    // generateAssociationEnd :     // generateAssociationEnd : 

    // --- ATTRIBUTES ---

    /**
     * Short description of attribute keyList
     *
     * @access public
     * @var KeyObject
     */
    public $keyList = null;

    /**
     * Short description of attribute recentSearchList
     *
     * @access public
     * @var Search
     */
    public $recentSearchList = null;

    /**
     * Short description of attribute currentSearch
     *
     * @access public
     * @var Search
     */
    public $currentSearch = null;

    // --- OPERATIONS ---

    /**
     * Short description of method initialize
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function initialize()
    {
        // section -64--88-2-3--5e821307:13aa8f73ca8:-8000:000000000000088E begin
        // section -64--88-2-3--5e821307:13aa8f73ca8:-8000:000000000000088E end
    }

    /**
     * Short description of method performSearch
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return databases_KeyObject
     */
    public function performSearch()
    {
        $returnValue = null;

        // section -122-48--89-8--1e6caf83:13aa9af80f4:-8000:0000000000000A2B begin
        // section -122-48--89-8--1e6caf83:13aa9af80f4:-8000:0000000000000A2B end

        return $returnValue;
    }

    /**
     * Short description of method setCurrentSearch
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    public function setCurrentSearch()
    {
        // section -64--88--106-1--6c338a91:13aaa68e2e6:-8000:0000000000000A38 begin
        // section -64--88--106-1--6c338a91:13aaa68e2e6:-8000:0000000000000A38 end
    }

    /**
     * Short description of method getResultsList
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function getResultsList()
    {
        // section -64--88--106-1-2306742:13aaa869672:-8000:0000000000000A4C begin
        // section -64--88--106-1-2306742:13aaa869672:-8000:0000000000000A4C end
    }

    /**
     * Short description of method saveResult
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function saveResult()
    {
        // section -64--88--106-1-2306742:13aaa869672:-8000:0000000000000A64 begin
        // section -64--88--106-1-2306742:13aaa869672:-8000:0000000000000A64 end
    }

    /**
     * Short description of method DataKeeperCore
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function DataKeeperCore()
    {
        // section -64--88--106-1-1d17cda6:13aff8f3ef5:-8000:0000000000000AB8 begin
        // section -64--88--106-1-1d17cda6:13aff8f3ef5:-8000:0000000000000AB8 end
    }

} /* end of class server_DataKeeperCore */

?>