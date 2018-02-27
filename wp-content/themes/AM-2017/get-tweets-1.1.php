<?php
// this file simply outputs tweet JSON
session_start();
require_once("twitteroauth-master/twitteroauth/twitteroauth.php"); //Path to twitteroauth library

// get variables from settings / AM-theme-options.php
$twitteruser = $tweet_link['twitter_user'];
$notweets = $tweet_link['no_tweets'];

if ($notweets = 'one') {
  $notweets = 1;
}
if ($notweets = 'two') {
  $notweets = 2;
}
if ($notweets = 'three') {
  $notweets = 3;
}
// $notweets = 3;
// var_dump($notweets);




// $twitteruser = "ablemediation";
// $notweets = 1;

// this stuff can be kept here for the time being
$consumerkey = "wsyJJale89cnyoVaM6fHQQrTs";
$consumersecret = "uBmfpmFqood7M86xMwZUCYKadzjqcZu8qITrqonBCxapFii5sW";
$accesstoken = "2995785839-RaY1kbCAW8jT4DonQnrsn3frSmtkpQjoxU3nrmo";
$accesstokensecret = "JHRrSHhCdVKj1mnt4Q26daGXly3AnUcMQUtIB69K9xwe7";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
 
echo json_encode($tweets);
?>