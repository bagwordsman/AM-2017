<?php
// this file simply outputs tweet JSON
session_start();
require_once("twitteroauth-master/twitteroauth/twitteroauth.php"); //Path to twitteroauth library


// get theme settings
// - load wordpress core, ignoring the template engine
define( 'WP_USE_THEMES', false );
require_once( '../../../wp-load.php' );


// get variables from settings / AM-theme-options.php
$tweet_options = get_option ( 'sandbox_theme_tweet_options' );

// load keys / access tokens:
$consumerkey = $tweet_options['twitter_consumer_key'];
$consumerkeysecret = $tweet_options['twitter_consumer_key_secret'];
$accesstoken = $tweet_options['twitter_access_token'];
$accesstokensecret = $tweet_options['twitter_access_token_secret'];

// load user and number of tweets
$tweetuser = $tweet_options['twitter_user'];
$tweetamount = $tweet_options['twitter_tweet_count'];

 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumerkeysecret, $accesstoken, $accesstokensecret);
 
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$tweetuser."&count=".$tweetamount);

// also works like this, user and count seem to be irrelevant
// $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=&count=");
 
echo json_encode($tweets);
?>