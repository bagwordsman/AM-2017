//JQuery Twitter Feed. Coded by Tom Elliott @ www.tomelliott.com (2013) based on https://twitter.com/javascripts/blogger.js
//Requires JSON output from authenticating script: https://tomelliott.com/php/authenticating-twitter-feed-timeline-oauth/

jQuery(document).ready(function( $ ) {

    // following 3 need to be added to get-tweets-1.1.php in root of theme, and come from theme settings:
    // number of tweets to display:
    var displaylimit = $("#twitter-feed").attr("data-tweets");
    var numbers = {
        'one' : 1,
        'two' : 2,
        'three' : 3
    };
    displaylimit = numbers[displaylimit];
    var twitterprofile = $("#twitter-feed").attr("data-profile");
    var screenname = $("#twitter-feed").attr("data-user");
    var absPath = $("#twitter-feed").attr("data-path"); // hacky / lazy, but it will work for getting the JSON at any page level
    
    // other stuff:
    var showdirecttweets = false;
    var showretweets = true;
    var showtweetlinks = true;
    var showprofilepic = true;
	var showtweetactions = true;
    var showretweetindicator = true;

    

	
    // Able Mediation's profile
    var headerHTML = '';
    var loadingHTML = '';
    headerHTML += '<div class="twitter-header">';
    headerHTML += '<a class="profile" href="https://twitter.com/'+twitterprofile+'" target="_blank">';
    headerHTML += '<h3>'+screenname+'</h3><p>@'+twitterprofile+'</p>';
    headerHTML += '</a>';
	headerHTML += '<a class="bird" href="https://twitter.com/" target="_blank"><img src="'+ absPath + '/img/twitter-bird-light.png" width="34" style="float:left;padding:3px 12px 0px 6px" alt="twitter bird" /></a>';
	headerHTML += '</div>';
	loadingHTML += '<div id="loading-container"><img src="'+ absPath + '/img/ajax-loader.gif" width="32" height="32" alt="tweet loader" /></div>';
	
	$('#twitter-feed').html(headerHTML + loadingHTML);
	 
    
    
    // display the latest tweet
    // - this will output the number of tweets defined in get-tweets-1.1.php
    // - I need an abosolute path to the get-tweets JSON
    
    $.getJSON(absPath + '/get-tweets-1.1.php', 
        function(feeds) {   
		   //alert(feeds);
            var feedHTML = '';
            var displayCounter = 1;         
            for (var i=0; i<feeds.length; i++) {
				var tweetscreenname = feeds[i].user.name;
                var tweetusername = feeds[i].user.screen_name;
                var profileimage = feeds[i].user.profile_image_url_https;
                var status = feeds[i].text;
				var isaretweet = false;
				var isdirect = false;
                var tweetid = feeds[i].id_str;
                
                
                
                // time
                // console.log(feeds[i].created_at);
				
				// If the tweet has been retweeted, get the profile pic of the tweeter
				if(typeof feeds[i].retweeted_status != 'undefined'){
				   profileimage = feeds[i].retweeted_status.user.profile_image_url_https;
				   tweetscreenname = feeds[i].retweeted_status.user.name;
				   tweetusername = feeds[i].retweeted_status.user.screen_name;
				   tweetid = feeds[i].retweeted_status.id_str;
				   status = feeds[i].retweeted_status.text; 
				   isaretweet = true;
				 };
				 
				 
				 //Check to see if the tweet is a direct message
				 if (feeds[i].text.substr(0,1) == "@") {
					 isdirect = true;
				 }
				 
				 // Generate twitter feed HTML based on selected options
				 if (((showretweets == true) || ((isaretweet == false) && (showretweets == false))) && ((showdirecttweets == true) || ((showdirecttweets == false) && (isdirect == false)))) { 
					if ((feeds[i].text.length > 1) && (displayCounter <= displaylimit)) {             
						if (showtweetlinks == true) {
							status = addlinks(status);
						}
						 
                        // increment id by 1 for each tweet
                        if (displayCounter == 1) {
							feedHTML += headerHTML;
						}
									 
                        feedHTML += '<div class="twitter-article" id="tw'+displayCounter+'">';
                        
                        // if retweeted, display this at top
                        if ((isaretweet == true) && (showretweetindicator == true)) {
							feedHTML += '<div class="retweet-indicator">'+screenname+' Retweeted</div>';
                        }
                        									                 
                        // profile image of tweeter on the left
                        feedHTML += '<div class="twitter-pic"><a href="https://twitter.com/'+tweetusername+'" target="_blank"><img src="'+profileimage+'"images/twitter-feed-icon.png" width="42" height="42" alt="twitter icon" /></a></div>';

                        feedHTML += '<div class="twitter-text">';
                        // tweeter profile
                        feedHTML += '<div class="tweetprofilelink"><strong><a href="https://twitter.com/'+tweetusername+'" target="_blank">'+tweetscreenname+'</a></strong>';
                        feedHTML += '<br>@'+tweetusername+'</div>';
                        // tweet content - remove elipsis
                        feedHTML += '<p>'+status+'</p>';
                        // date of tweet
                        feedHTML += '<div class="tweet-time"><a href="https://twitter.com/'+tweetusername+'/status/'+tweetid+'" target="_blank">'+formatted_time(feeds[i].created_at)+'</a></div>';
						

                        // reply, retweet, favourite
                        if (showtweetactions == true) {
							feedHTML += '<div class="twitter-actions"><div class="intent" id="intent-reply"><a href="https://twitter.com/intent/tweet?in_reply_to='+tweetid+'" title="Reply"></a></div><div class="intent" id="intent-retweet"><a href="https://twitter.com/intent/retweet?tweet_id='+tweetid+'" title="Retweet"></a></div><div class="intent" id="intent-fave"><a href="https://twitter.com/intent/favorite?tweet_id='+tweetid+'" title="Favourite"></a></div></div>';
						}
						
						feedHTML += '</div>';
						feedHTML += '</div>';
						displayCounter++;
					}   
				 }
            }
             
            $('#twitter-feed').html(feedHTML);
			
			// toggle colour class when tweet is hovered over
			if (showtweetactions == true) {				
                $('.twitter-article').hover(function(){
                    $(this).addClass('hovered');
				}, function() {
					$(this).removeClass('hovered');
                });	
			
				// modal action clicks - make this nicer
				$('.twitter-actions a').click(function(){
                    var url = $(this).attr('href');
                    window.open(url, 'tweet action window', 'width=580,height=500');
                    return false;
				});
			}
			
			
    }).error(function(jqXHR, textStatus, errorThrown) {
		var error = "";
			 if (jqXHR.status === 0) {
               error = 'Connection problem. Check file path and www vs non-www in getJSON request';
            
            // getting 404 errors if not on child pages (i.e. if on home page, or grandchild page)
            } else if (jqXHR.status == 404) {
                error = 'JSON for Twitter Feed: not found. [404]';
            } else if (jqXHR.status == 500) {
                error = 'JSON for Twitter Feed: Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                error = 'JSON for Twitter Feed: parse failed.';
            } else if (exception === 'timeout') {
                error = 'JSON for Twitter Feed: Time out error.';
            } else if (exception === 'abort') {
                error = 'JSON for Twitter Feed: Ajax request aborted.';
            } else {
                error = 'Uncaught Error.\n' + jqXHR.responseText;
            }	
       		console.log("error: " + error);
    });
    

    //Function modified from Stack Overflow
    function addlinks(data) {
        //Add link to all http:// links within tweets
         data = data.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
            return '<a href="'+url+'"  target="_blank">'+url+'</a>';
        });
             
        //Add link to @usernames used within tweets
        data = data.replace(/\B@([_a-z0-9]+)/ig, function(reply) {
            return '<a href="http://twitter.com/'+reply.substring(1)+'" style="font-weight:lighter;" target="_blank">'+reply.charAt(0)+reply.substring(1)+'</a>';
        });
		//Add link to #hastags used within tweets
        data = data.replace(/\B#([_a-z0-9]+)/ig, function(reply) {
            return '<a href="https://twitter.com/search?q='+reply.substring(1)+'" style="font-weight:lighter;" target="_blank">'+reply.charAt(0)+reply.substring(1)+'</a>';
        });
        return data;
    }
     
     
    function formatted_time(time_value) {
        var values = time_value.split(" ");
        time_value = values[1] + " " + values[2] + ", " + values[5];
        return time_value;
    }
        
        
    function relative_time(time_value) {
      var values = time_value.split(" ");
      time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
      var parsed_date = Date.parse(time_value);
      var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
      var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
	  var shortdate = time_value.substr(4,2) + " " + time_value.substr(0,3);
      delta = delta + (relative_to.getTimezoneOffset() * 60);
     
      if (delta < 60) {
        return '1m';
      } else if(delta < 120) {
        return '1m';
      } else if(delta < (60*60)) {
        return (parseInt(delta / 60)).toString() + 'm';
      } else if(delta < (120*60)) {
        return '1h';
      } else if(delta < (24*60*60)) {
        return (parseInt(delta / 3600)).toString() + 'h';
      } else if(delta < (48*60*60)) {
        //return '1 day';
		return shortdate;
      } else {
        return shortdate;
      }
    }
     
});