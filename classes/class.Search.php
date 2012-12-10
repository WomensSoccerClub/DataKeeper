<?php

error_reporting(E_ALL);

/**
 * WSCmodel - server\class.Search.php
 *
 * $Id$
 *
 * This file is part of WSCmodel.
 *
 * Automatically generated on 25.11.2012, 13:38:31 with ArgoUML PHP module 
 * (last revised $Date: 2010-01-12 20:14:42 +0100 (Tue, 12 Jan 2010) $)
 *
 * @author firstname and lastname of author, <author@example.org>
 * @package server
 */

if (0 > version_compare(PHP_VERSION, '5')) {
    die('This file was generated for PHP 5');
}

/**
 * include server_ColumnObject
 *
 * @author firstname and lastname of author, <author@example.org>
 */
require_once('class.ColumnObject.php');

/**
 * Short description of class server_Search
 *
 * @access public
 * @author firstname and lastname of author, <author@example.org>
 * @package server
 */
class Search
{
    /**
     * Short description of attribute searchName
     *
     * @access public
     * @var String
     */
    public $searchName = null;

    /**
     * Short description of attribute columnCriterionList
     *
     * @access public
     * @var ColumnObject
     */
    public $columnCriteriaList = null;

    /**
     * Short description of attribute freqCounter
     *
     * @access public
     * @var Integer
     */
    public $freqCounter = null;

    /**
     * Short description of attribute timeStamp
     *
     * @access public
     * @var String
     */
    public $timeStamp = null;

    // --- OPERATIONS ---
 function __construct($searchName, $columnCriterionList, $freqCounter, $timeStamp) {
       $this->searchName = $searchName;
       $this->columnCriterionList = array($columnCriterionList);
       $this->freqCounter = $freqCounter;
       $this->timeStamp = $timeStamp;
   }
    /**
     * Short description of method addColumn
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    public function addColumn($column)
    {
        $this->columnCriterionList[] = $column;
    }

    /**
     * Pass in a ColumnObject to remove from the ColumnCriterionList
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    public function removeColumn($columnToRemove)
    {
        unset($this->columnCriterionList[$columnToRemove]);
    }

    /**
     * This method will build a SQL query based on the columnCriterionList and return it in the form a a string.
     *
     * @access public
     * @return String
     */
    public function getQuery()
    {
        return $returnValue;
    }

    /**
     * Short description of method getResultList
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     * @return mixed
     */
    public function getResultList()
    {
        // section -64--88--106-1--6c338a91:13aaa68e2e6:-8000:0000000000000A36 begin
        // section -64--88--106-1--6c338a91:13aaa68e2e6:-8000:0000000000000A36 end
    }

} /* end of class server_Search */

?>