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

function __construct($name) {
       $this->name = $name;
       $this->tableList = this::getTables();
       $this->freqCounter = $freqCounter;
       $this->timeStamp = $timeStamp;
   }
   
function getTables()
{
    $KeyObjects = new DOMNodeList(LoadObjectsFromXML("KeyObjects"));
    $thisKeyObject = new DOMNode();
    foreach($KeyObjects as $KeyObject)
    {
        $node = new DOMNode($KeyObject);
        if($node->nodeName == $this->name)
            $thisKeyObject = $node;
    }
    $tableList = array();
    $tableNodes = new DOMNodeList($thisKeyObject);
    //need to put these tableNodes into TableObjects and return it as an array
}

} /* end of class databases_KeyObject */

?>