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
        $this->columnCriteriaList[] = $column;
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
    }

    /**
     * This method will build a SQL query based on the columnCriteriaList and return it in the form a a string.
     *
     * @access public
     * @return String
     */
    public function getQuery()
    {
            $query = "SELECT * FROM ";
            $tableNames = null;
            $whereClauses = null;

            if(empty($this->columnCriteriaList))
                return null;

            // create unique list (a set) of tables 
            foreach($this->columnCriteriaList as $item)
            {
                $tableNames[] = $item->owner;   
                $whereClauses[] = "$item->owner.$item->columnName LIKE \"%$item->value%\"";
            }
            $tableNameList = array_unique($tableNames);
            unset($tableNames);

            /* // add identifier clauses to whereClauses
            for(int $i=1; $i<$tableNames->count();i++)
            {
                    $whereClauses = "$tableNames[$i-1].
            }		
            */

            // FROM table1, table2, .. tableN
            foreach($tableNameList as $table)
            {
                    if($table != null)
                        $query .= "$table, ";
            }
            $query = substr($query,0,-2) . " WHERE "; // remove last ", "


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
$criterion[1999] = new ColumnObject("Member ID", "MEMBER_IDENTIFIER","int(11)", "womensso_wsc.T_MEMBER");
$criterion["ANA"] = new ColumnObject("Company Name","COMPANY_NAME", "varchar(40)", "womensso_wsc.T_HEALTH_INSURANCE");


$search1 = new Search("batman", $criterion , 50, "12/12/2012");
    foreach($criterion as $key => $what)
       $what->setValue($key);
$newquery = $search1->getQuery();
$search1->performQuery($newquery, "", "Brian", "mysqlpassword1!");
echo "<br />" . $search1 . "<br />";

echo $search1->toUserString();

/*
 * 
 * Test Segment END
 */
?>