<?php

$_SESSION['CURRENT_KEYOBJECT'] = ""; //keep track of the KeyObject the user is looking for
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" type="text/css" href="table.css">
<script src="inc/jquery-1.8.2.min.js"></script>

<script type="text/javascript">
$(window).load(function () {
   var searchHistory = getSearchHistory();
   setKeyObjects();
});
    
$(document).ready(function() {

    $(".searchChoice").click(function (e) {
        if($(this).attr("id")=="searchChoiceLeft") //previous search
        {
            $(this).css("background", "highlight");
            $("#customSearch").hide('medium',null);
            $("#searchChoiceRight").css("background","white");
            $("#searchHistory").show('medium',null);
        }else{                                  //build a new search
            $(this).css("background", "highlight");
            $("#searchChoiceLeft").css("background","white");
            $("#searchHistory").hide("medium",null);
            $("#customSearch").show('medium',null);
            $("#query").attr("disabled", "disabled");
        }       
    });
    
    $("input.column").keyup(function(event) {
       alert($(this).attr("class"));
       //addColumnToSearch(this);
    });

  });
  function setCurrentKeyObject(KeyObjectString, element)
  {
      $.ajax({
                type: 'GET',
                url: 'classes/class.DataKeeperCore.php',
                dataType: "html",
                data: "KeyObjectSelect="+KeyObjectString ,
                success: function(data) { 
                  $("#"+data).parent("tr").removeClass("selected");
                  $(element).addClass("selected");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status+""+thrownError);
                }
            });
  }
  function getSearchHistory()
   {
            $.ajax({
                type: 'GET',
                url: 'searchHistory/searchHistoryScript.php',
                dataType: "html",
                data: "" ,
                success: function(data) { 
                  buildTable(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status+""+thrownError);
                }
            });
         
   }
  function setKeyObjects()
   {
      var HTML_FILE_URL = 'config.xml';

        $.ajax({
                type: 'GET',
                url: HTML_FILE_URL,
                dataType: "html",
                data: "" ,
                cache: false,
                success: function(data) { 
                  populateKeyObjectSelector(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status+""+thrownError);
                }
            });

        } 
  function populateKeyObjectSelector(xml)
  {
      var KeyObjects = $(xml).filter("KeyObjects").children(); //get all <KeyObject> tags

      $.each(KeyObjects, function(key, value) {
          //alert(key+" "+value);
          var name = $(this).attr("name");
          
       $("#KeyObjectSelector > tbody:last").append("<tr onclick=\"javascript:selectKeyObject(this);\"><td id=\""+name+"\">"+name+"</td></tr>");
       //string += "<tr>"+name+"</tr>"
      });

  }
  function populateTableSelector(data,KeyObject)
  {
      
      var Tables = $(data).find("KeyObject[name="+KeyObject+"]").find("table");
   
      $("#TableSelector tbody").html("<th class='title'></th>"); //erase all but header
      $("#TableSelector th").html(KeyObject); //set the header to the current selected KeyObject
      
     
     $.each(Tables, function(key, value) {
          var name = $(this).attr("name");
       $("#TableSelector > tbody:last").append("<tr onclick='javascript:selectTableObject(this);'><td>"+name+"</td></tr>");
       //string += "<tr>"+name+"</tr>"
       });
  }
  function populateColumnSelector(data,TableObject, database)
  {
      $("#ColumnSelector tbody").html("<th class='title' colspan=\"2\"></th>"); //erase all but header
      $("#ColumnSelector th").html(TableObject); //set the header to the current selected KeyObject

    
     $.each(data, function(key, value) {
          var name = $(this).attr("name");
          var columnName = $(this).text();
          var datatype = $(this).attr("datatype");
          
          var owner = database+"."+TableObject;
          
          var appendString =
          "<tr onclick=''>\n\
           <td>"+name+"</td>\n\
           <td>\n\
           <input type=\"text\" id=\""+columnName+"\" class=\"column\" owner=\""+owner+"\" dataType=\""+datatype+"\" \>\n\
           <input type=\"image\" id=\"addColumn\" src=\"http://www.womenssoccerclub.com/images/add.png\" onclick=\"addColumnToSearch(this);\" alias=\""+name+"\" name=\""+columnName+"\">\n\
           <input type=\"image\" id=\"removeColumn\" src=\"http://www.womenssoccerclub.com/images/redx.jpg\" onclick=\"removeColumnFromSearch(this);\" alias=\""+name+"\" name=\""+columnName+"\">\n\
           </td>\n\
           </tr>";
       
       $("#ColumnSelector > tbody:last").append(appendString);
       //string += "<tr>"+name+"</tr>"
       });
  } 
  function selectKeyObject(element)
   {
    var KeyObjectName = $(element).find("td").html();
    setCurrentKeyObject(KeyObjectName, element)
    
    var HTML_FILE_URL = 'config.xml';
    $.ajax({
                type: 'GET',
                url: HTML_FILE_URL,
                dataType: "html",
                cache: false,
                data: "" ,
                success: function(data) { 
                  populateTableSelector(data,KeyObjectName);
                  populateColumnSelector("null","Columns") //set the column to be empty
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status+""+thrownError);
                }
          });

   }
  function selectTableObject(element)
   {
    var name = $(element).find("td").html();
    $(element).addClass("selected");

    $.ajax({
                type: 'GET',
                url: 'config.xml',
                cache: false,
                success: function(data) { 
                   var tableName = $(data).find("table[name='"+name+"']").attr("value");
                   var database = $(data).find("table[name='"+name+"']").find("database").text();
                   var columns = $(data).find("table[name='"+name+"']").find("column");
                   populateColumnSelector(columns,tableName, database);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status+""+thrownError);
                }
          });
   } 
  function placeInSearch(tableRowQuery)
   {
       var query = $(tableRowQuery).find("td[name=query]").html();
       $("#query").val(query);
   }
  function buildTable(searchHistory)
  {      

      var searches = $(searchHistory).find("search");

      var html = '<table id="hor-minimalist-a">';
      for (var i = 0; i < 15; i++) { // For each row  
          var search = $(searches).get(i-2)
          if(i==0) //if first row
          {
              html += "<tr><th colspan='3'>Most Popular Searches</th></tr>";
          }else if(i==6){ //if 6th row
              html += "<tr><th colspan='3'>Most Recently Searched</th></tr>";
          }else if(i==1 || i==7){ //if title slides
              html += "<td class='title'>Popularity</td><td class='title'>Date</td><td class='title'>Search</td>";
          
          }else{
          html += "<tr id='choice"+i+"' onclick=\"javascript:placeInSearch(this)\">";
          for(var j=0; j<3; j++) //for each column
              {
                  if(j==0) //popularity
                      html += '<td name="popularity">'+$(search).attr("popularity")+'</td>';
                  if(j==1)
                       html += '<td name="date">'+$(search).attr("date")+'</td>';
                  if(j==2)
                       html += '<td name="query">'+$(search).attr("query")+'</td>';
              }
          html += '</tr>'; // Add row separator
         }
      } //for
        
      html += '</tr></table>'; // Finish up
      $('#searchHistory').append(html); // And add to document
}
  function addColumnToSearch(element)
  {
      var columnName = $(element).attr("name"); //this is the button being clicked
      var alias = $(element).attr("alias");
      var value = $("#"+columnName).val(); //this is the textbox (which holds alot of info)
      var owner = $("#"+columnName).attr("owner");
      var dataType = $("#"+columnName).attr("dataType");
      
      $.ajax({
                type: 'GET',
                url: '/classes/class.DataKeeperCore.php',
                dataType: "html",
                data: "AddToSearch=true&dataType="+dataType+"&columnAlias="+alias+"&columnName="+columnName+"&value="+value+"&owner="+owner ,
                cache: false,
                success: function(data) { 
                    alert(data);
                    $("#query").val(data);
                    $("#"+columnName).closest("tr").addClass("selected");
                    $(element).hide();
                    $("#removeColumn[name='"+columnName+"']").show();
                    
                  //populateKeyObjectSelector(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status+""+thrownError);
                }
       });
  }
  function removeColumnFromSearch(element)
  {
      var columnName = $(element).attr("name");
      var alias = $(element).attr("alias");
      var value = $("#"+columnName).val();
      var owner = $("#"+columnName).attr("owner");
      var dataType = $("#"+columnName).attr("dataType");
      
      $.ajax({
                type: 'GET',
                url: '/classes/class.DataKeeperCore.php',
                dataType: "html",
                data: "RemoveFromSearch=true&dataType="+dataType+"&columnAlias="+alias+"&columnName="+columnName+"&value="+value+"&owner="+owner ,
                cache: false,
                success: function(data) { 
                    alert(data);
                    $("#query").val(data)
                    $("#"+columnName).closest("tr").removeClass("selected"); //unselect the tr
                    $(element).hide(); //hide the X
                    $("#addColumn[name='"+columnName+"']").show(); //show the +
                    $("#"+columnName).val("")
                  //populateKeyObjectSelector(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  alert(xhr.status+""+thrownError);
                }
       });
  }

</script>
</head>

    <center>  
    <div id="container">
    <img src="images/logo.png" width="175" /> 
    
    <h1>
        DATA KEEPER
    </h1>
    
    
    <div id="filters">
        <fieldset>
            <legend>What are you looking for?</legend>    
        
        <br />
         <div id="searchHolder">
            <input maxlength="128" name="query" id="query" value=""><a href="javascript: function(){};" id="searchButton">Search</a>
        </div>
        <div id="searchResults"></div>
        <div id="choiceDiv">
        <div class="searchChoice" id="searchChoiceLeft">
            <strong>SEARCH HISTORY</strong>
        </div>
        
        <div class="searchChoice" id="searchChoiceRight">
            <strong>CUSTOM SEARCH</strong>
        </div>
        </div>
            
        <div id="searchHistory">
        </div>
        
        <div id="customSearch">
           
            <table id="KeyObjectSelector" class="selector">
                <tbody>
                    <th class="title" >Select Object</th>
                </tbody>
            </table>
            <table id="TableSelector" class="selector">
                <tbody>
                    <th class="title" >Tables</th>
                </tbody>
            </table>
            <table id="ColumnSelector" class="selector">
                <tbody>
                    <th class="title" colspan="2">Columns</th>
                </tbody>
            </table>
        </div>
</fieldset>
    </div>
    
        
    </div>
    
    </center>
</html>

