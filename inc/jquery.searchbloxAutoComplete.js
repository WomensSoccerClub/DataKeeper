(function($){
 
   $.fn.searchbloxAutoComplete = function(options){
      return this.each(function(){
		instantSearch = true;
		autoComplete = true;
		callback = 0;
		t = setTimeout(function() {}, 10);
		
		$('#seachAutoComplete').html('<ul id="suggestionsHolder"></ul>');
		 
		 /* Create the listener for the search button */
		 $('#searchButton').click(function(){
			 updateResults(options.searchResultsURL, options.searchResultsDivID, '?query='+$('#query').val());
		 });
		 
		 /* Create the listener for the on/off toggle buttons */
		 $('#autoCompleteToggle').click(function(){
			if(autoComplete)
			{
				autoComplete = false;
				$(this).html('Autocomplete <strong>off</strong>');
			}
			else
			{
				autoComplete = true;
				$(this).html('Autocomplete <strong>on</strong>');
			}
		 });
		 
		 $('#instantToggle').click(function(){
			if(instantSearch)
			{
				instantSearch = false;
				$(this).html('Instant search <strong>off</strong>');
			}
			else
			{
				instantSearch = true;
				$(this).html('Instant search <strong>on</strong>');
			}
		 });
		 
		 /*
		  * Create a listner for losing focus
		  */
		 $(this).blur(function() {
			$('#suggestionsHolder').css('display', 'none');
			if(instantSearch)
			{
				suggestClicked($('#query').val(), options.searchResultsURL, options.searchResultsDivID);
			}
		 });
		 
		 /*
		  * The key press action listener 
		  * for the search box
		  */
		 $(this).keyup(function(e) {
			 callback = 0;
			 // get the value
			 var searchQuery = $(this).val();
			 var code = (e.keyCode ? e.keyCode : e.which);
			 var listitem = '';
			 if(code === 13)
			 {
				 //then return is pressed, so do the search
				 clearTimeout(t);
				 $('#query').blur();
				 updateResults(options.searchResultsURL, options.searchResultsDivID, "?query="+searchQuery+"&page=1");
			 }
			 else if(code === 40)
			 {
				 //then the down arrow is pressed
				 //check if any of the autocompletes are selected
				 if($("li.suggestion a.selected").length === 0)
				 {
					 //add it to the first one
					 $("li.suggestion:first a").addClass('selected');
				 }
				 else
				 {
					 //move it down
					 listitem = $("li.suggestion a.selected");
					 listitem.parent().next().find('a').addClass('selected');
					 listitem.removeClass('selected');
				 }
				 
				 if($("li.suggestion a.selected").text().length > 0)
				 {
					 //then update the query
					 $("#query").val($("li.suggestion a.selected").text());
				 }
			 }
			 else if(code === 38)
			 {
				 //then the up arrow is pressed
				 if($("li.suggestion a.selected").length === 0)
				 {
					 //add it to the last one
					 $("li.suggestion:last a").addClass('selected');
				 }
				 else
				 {
					 //move it down
					 listitem = $("li.suggestion a.selected");
					 listitem.parent().prev().find('a').addClass('selected');
					 listitem.removeClass('selected');
				 }
				 
				 if($("li.suggestion a.selected").text().length > 0)
				 {
					 //then update the query
					 $("#query").val($("li.suggestion a.selected").text());
				 }
			 }
			 else if(searchQuery === '')
			 {
				 $('#suggestionsHolder').html('');
			 }
			 else
			 {
				 //if auto complete is on
				 if(autoComplete)
				 {
					//autocomplete ajax
					$.ajax({
						  type: "GET",
						  url: options.autoCompleteURL,
						  data: encodeURI("q="+searchQuery),
						  dataType: 'jsonp',
						  success: function(data) {
							$('#suggestionsHolder').html('');
							if(data.length > 0)
							{
								$.each(data, function(i){
									 $("#suggestionsHolder").append('<li class="suggestion" id="suggestion'+i+'"><a class="suggestionAnchor">'+this+'</a></li>');
								});
								
								$("#suggestionsHolder").css('display', 'block');
								
								$(".suggestionAnchor").hover(function() {
									$('#query').val($(this).text());
									$("suggestionAnchor").removeClass('selected');				
								});
								
							}
						  }
					 }); // end autocomplete ajax
				 }
				 
				 //if the instant search is on
				 if(instantSearch)
				 {
					clearTimeout(t);
					//then update the results after 1s if a key isn't pressed
					t = setTimeout(function() {
							updateResults(options.searchResultsURL, options.searchResultsDivID, "?query="+searchQuery+"&page=1");
					 }, 1000);
				 }
			 }
		 }); // end keyup
		 
      });
   };
   
   /*
    * Function that is fired when
	* a search term is selected from the
	* auto complete. 
	* 
	* It update the text field and fires the 
	* instant search if it's turned on
	*/
   function suggestClicked(term, site, resultsDiv)
   {
	   //update the value
	   $('#query').val(term);
	   
	   //hide the autocomplete
	   $("#suggestionsHolder").css('display', 'none');

	   if(instantSearch)
	   {
		   updateResults(site, resultsDiv, '?query='+term);
	   }
   }
   
   
   /*
    * Function that is fired when
	* a search has been performed
	* 
	* It send the request to the searchBlox
	* server with the appropraite query
	*
	* It updates the search results area with
	* the searchBlox returned html, then removes 
	* any parts of the html that we dont want to
	* be displayed.
	*/
   function updateResults(site, resultsDivId, query)
   {
	   $("#"+resultsDivId).html('<div class="loading"><img src="images/loading.gif" alt="Loading..."/></div>');
	   
	   requestCrossDomain(encodeURI(site+query), function(results) {  
			//now format the results
			$("#"+resultsDivId).html(results);
			
			//hide the areas we dont want
			$("#searchform").remove();
			$("#masthead").remove();
			$("#suggest").remove();
			$(".htButton").remove();
			
			//update the top page links
			$('#links0 a').each(function() {
				$(this).attr('href', $(this).attr('href').replace("../servlet/SearchServlet", ""));
				$(this).click(function() { 
					updateResults(site, resultsDivId, $(this).attr('href'));
					return false;
				});											  
			});
			
			//update the bottom page links
			$('#links1 a').each(function() {
				$(this).attr('href', $(this).attr('href').replace("../servlet/SearchServlet", ""));
				$(this).click(function() { 
					updateResults(site, resultsDivId, $(this).attr('href'));
					return false;
				});											  
			});
			
			//update the sortby links
			$('#sort a').each(function() {
				$(this).attr('href', $(this).attr('href').replace("../servlet/SearchServlet", ""));
				$(this).click(function() { 
					updateResults(site, resultsDivId, $(this).attr('href'));
					return false;
				});											  
			});
		});
   }
   
   
   /*
    * This function handles the cross-domain requests
	* using YQL.
	*
	* Accepts a url and a callback function to run.
	*/ 
   function requestCrossDomain(site, callback) 
   {  
		// Take the provided url, and add it to a YQL query.  
		var yql = 'http://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent('select * from html where url="' + site + '"') + '&format=xml&callback=?';  
		function cbFunc(data) {  
			// If we have something to work with...  
			if ( data.results[0] ) {  
				// Strip out all script tags, for security reasons. 
				data = data.results[0].replace(/<script[^>]*>[\s\S]*?<\/script>/gi, '');  
		  
				// If the user passed a callback, and it  
				// is a function, call it, and send through the data var.  
				if ( typeof callback === 'function') {  
					callback(data);  
				}  
			}  
			// Else, Maybe we requested a site that doesn't exist, and nothing returned.
			else
			{
				//try again
				if(callback < 5)
				{
					setTimeout(function() { requestCrossDomain(site, callback); }, 500);
					callback++;
				}
				else
				{
					throw new Error('Nothing returned from getJSON.');  
				}
			}
		}  
		
		// Request that YSQL string, and run a callback function.  
		// Pass a defined function to prevent cache-busting.  
		$.getJSON( yql, cbFunc );  
	  
	}  //end requestCrossDomain
	
})(jQuery);



/*
 * This is the bit that you edit to make the plugin work on different websites.
 * It also runs the plugin once the page has loaded.
 
$(document).ready(function() {
	var options = {
		// The url that the autocomplete array comes from. 
		// Note that you leave the query varaible's value out of the url, this is added on by the plugin
		autoCompleteURL: 'http://174.143.141.226/searchblox/servlet/AutoSuggest',
		// The url that the updated search results come from
		// Note that you leave the query varaible's value out of the url, this is added on by the plugin
		searchResultsURL: 'http://174.143.141.226/searchblox/servlet/SearchServlet',
		searchResultsDivID: 'searchResults'
	};
	
	// now run the plugin on the search box field
	// and pass in the options defined above
	$('#query').searchbloxAutoComplete(options);
});
*/