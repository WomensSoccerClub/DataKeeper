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
        }       
    });
    
    $('.selector td').click(function (e) {
        alert("test");
    });
    
  });
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

    $.get(HTML_FILE_URL, function(data) {
        populateKeyObjectSelector(data);
        
    });
   }
   
  function populateKeyObjectSelector(xml)
  {
      var KeyObjects = $(xml).find("KeyObjects").children(); //get all <KeyObject> tags
      
      $.each(KeyObjects, function(key, value) {
          var name = $(this).attr("name");
       $("#KeyObjectSelector > tbody:last").append("<tr onclick=\"javascript:selectKeyObject(this)\"><td>"+name+"</td></tr>");
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
       $("#TableSelector > tbody:last").append("<tr onclick='javascript:selectColumnObject(this)'><td>"+name+"</td></tr>");
       //string += "<tr>"+name+"</tr>"
       });
  }
  function populateColumnSelector(data,TableObject)
  {
      var columns = $(data).find("table[name='"+TableObject+"']").find("column");
      //alert(columns.length);
      $("#ColumnSelector tbody").html("<th class='title' colspan=\"2\"></th>"); //erase all but header
      $("#ColumnSelector th").html(TableObject); //set the header to the current selected KeyObject
      
     
     $.each(columns, function(key, value) {
          var name = $(this).attr("name");
       $("#ColumnSelector > tbody:last").append("<tr onclick=''><td>"+name+"</td><td><input type=\"text\" name=\"\"></td></tr>");
       //string += "<tr>"+name+"</tr>"
       });
  }
  
   function selectKeyObject(element)
   {
    var name = $(element).find("td").html();
    $(element).addClass("selected");
    var HTML_FILE_URL = 'config.xml';

    $.get(HTML_FILE_URL, function(data) {
        populateTableSelector(data,name);
        populateColumnSelector(null,"Column")
    });
   }
   function selectColumnObject(element)
   {
    var name = $(element).find("td").html();
    $(element).addClass("selected");
    var HTML_FILE_URL = 'config.xml';

    $.get(HTML_FILE_URL, function(data) {
        //alert($(data).val());
        populateColumnSelector(data,name);
        
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
<?php



?>
