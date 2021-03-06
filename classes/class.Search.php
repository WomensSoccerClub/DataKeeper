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
require_once('class.DataKeeperCore.php');

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
     * Short description of attribute columnCriteriaList
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
    
    public $resultList = null;

    // --- OPERATIONS ---
 function __construct($searchName, $columnCriteriaList, $freqCounter, $timeStamp) {
       $this->searchName = $searchName;
       $this->columnCriteriaList = $columnCriteriaList;
       ksort($this->columnCriteriaList);
       $this->freqCounter = $freqCounter;
       $this->timeStamp = $timeStamp;
   }
    /**
     * Short description of method addColumn
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    public function addColumn(ColumnObject $column)
    {
        $this->columnCriteriaList[$column->alias] = $column;
        ksort($this->columnCriteriaList);
    }

    /**
     * Pass in a ColumnObject to remove from the ColumnCriteriaList
     *
     * @access public
     * @author firstname and lastname of author, <author@example.org>
     */
    public function removeColumn($columnToRemove)
    {
        unset($this->columnCriteriaList[$columnToRemove]);
        if(!empty($this->columnCriteriaList))
            ksort($this->columnCriteriaList);
    }

    /**
     * This method will build a SQL query based on the columnCriteriaList and return it in the form a a string.
     *
     * @access public
     * @return String
     */
    public function getQuery()
    {
            $tableNames = null;
            $whereClauses = null;
        
            reset($this->columnCriteriaList);
            $aString = substr(strstr(current($this->columnCriteriaList)->owner,'.',false),1);
            $bString = getParentAliasOfTable($aString);
            $labelColumns = KeyObject::getLabelColumns($bString);
            $labelCols = explode(",",$labelColumns);
            foreach($labelCols as $col)
            {
                $cs = explode(".",$col);
                $tableNames[] = "$cs[0].$cs[1]";
            }
                       
            if(empty($this->columnCriteriaList))
                return null;

            // create unique list (a set) of tables 
            foreach($this->columnCriteriaList as $item)
            {
                $tableNames[] = $item->owner;   
                $whereClauses[] = "$item->owner.$item->columnName LIKE \"%$item->value%\"";
            }
            $query = "SELECT $labelColumns";//,.* FROM ";
            $tableNameList = array_unique($tableNames);
            unset($tableNames);
            
            foreach($tableNameList as $table)
            {
                    if($table != null)
                        $query .= ",$table.*";
            }
            
            $query .= " FROM ";

            unset($table);
            // FROM table1, table2, .. tableN
            foreach($tableNameList as $table)
            {
                    if($table != null)
                        $query .= "$table, ";
            }
            $query = substr($query,0,-2) . " WHERE "; // remove last ", "
            
            $relationshipColumn = KeyObject::getRelationshipColumn($bString);
            $ot = null;
            
            foreach($tableNameList as $t)
            {
                if($ot != null)
                {
                    $whereClauses[] = "$ot.$relationshipColumn = $t.$relationshipColumn";
                }
                $ot = $t;
            }
             
            
            // WHERE condition1 AND condition2 AND ... conditionN
            foreach($whereClauses as $condition)
            {                   
                    $query .= "$condition AND ";
            }

            $query = substr($query,0,-4) . ";";
            
            return $query;
        
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
        
        return $this->resultList;
    }
    
    public function resultsToHTML()
    {
        $htmlString = "";
        if(!empty($this->resultList))
        {
            $htmlString .= "<table>";
            foreach($this->resultList as $row)
            {
                $htmlString .= "<tr>";
                foreach($row as $key => $value)
                {
                    $htmlString .= "<td class=\"$key\" id=\"$value\">$value</td>";
                }
                $htmlString .= "</tr>";
            }
            $htmlString .= "</table>";
        }
        
        return $htmlString;
    }
    
    public function performQuery($query, $host, $username, $password)
    {
        if($host == "" || $host == null)        
            $host = ini_get("mysql.default_host");
        
        $db_connecton = mysql_connect($host, $username, $password) or die("Unable to connect to MySQL");
        $result = mysql_query($query);
        $this->resultList = null;
        while($record = mysql_fetch_assoc($result))
        {
            $this->resultList[] = $record;
        }
        mysql_close($db_connecton);
    }
    
    public function toUserString()
    {
        $prettyString = null;
        
        if(!empty($this->columnCriteriaList))
        {
           // $prettyString = "" . getParentAliasOfTable($tableName);
            reset($this->columnCriteriaList);
            $aString = substr(strstr(current($this->columnCriteriaList)->owner,'.',false),1);
            //$prettyString = getParentAliasOfTable($aString);
            $prettyString = getParentAliasOfTable($aString) . "[ ";           
            
            foreach($this->columnCriteriaList as $column)
            {
                $prettyString .= "$column->alias =\"$column->value\" ";
            }
        }
        
        return $prettyString . "]";
    }
    
    public function __toString() {
        $returnString = null;
        $returnString = "Search Name: " . $this->searchName ."<br />Timestamp: " . $this->timeStamp .
            "<br /> Counter: " . $this->freqCounter . "<br />Columns: ";
        if( empty($this->columnCriteriaList))
        {
            $returnString .= "NULL <br />";
        }
        else
        {
            $returnString .= "<br />{";            
            foreach($this->columnCriteriaList as $column)
            {
                    $returnString .= "<br />" . $column;
            }
            $returnString .= "}";
        }
        
        $returnString .= "<br />Results: ";
        if( empty($this->resultList))
        {
            $returnString .= "NULL <br />";
        }
        else
        {
            $returnString .= "<br />{";
            foreach($this->resultList as $item)
            {
                
                $returnString .= "<br />";
                foreach($item as $piece)
                {
                    $returnString .= $piece . " ";
                }
            }
            $returnString .= "<br />}";
        }
        return $returnString;
    }

} /* end of class server_Search */
/**
 * 
 * Test Segment BEGIN
 */
//$criterion[1999] = new ColumnObject("Member ID", "MEMBER_IDENTIFIER","int(11)", "womensso_wsc.T_MEMBER");
//$criterion["ANA"] = new ColumnObject("Company Name","COMPANY_NAME", "varchar(40)", "womensso_wsc.T_HEALTH_INSURANCE");
//
//$search1 = new Search("batman", $criterion , 50, "12/12/2012");
//    foreach($criterion as $key => $what)
//       $what->setValue($key);
//$newquery = $search1->getQuery();
//$search1->performQuery($newquery, "", "Brian", "mysqlpassword1!");
////echo "<br />" . $search1 . "<br />";
//
////echo $search1->toUserString() . "<br />";
//echo $search1->resultsToHTML();
/*
 * 
 * Test Segment END
 */
?>