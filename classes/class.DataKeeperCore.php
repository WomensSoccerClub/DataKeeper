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

require_once('class.KeyObject.php');
require_once('class.Search.php');
require_once('class.TableObject.php');
require_once('class.ColumnObject.php');

function LoadObjectsFromXML($tag)
{
    $xml = new DOMDocument();
    $location = "/config.xml";
    
    if(!file_exists($location))   //if the file doesn't exists
    {
        echo "The config file \"$location\" was not found. This is horribly wrong.";
        exit;
    }

    $xml->loadHTMLFile($location);
    $Objects = $xml->getElementsByTagName($tag);
    
    return $Objects;
}


?>