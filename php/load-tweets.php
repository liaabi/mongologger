<html>
  <head>
    <title>Tweet loader</title>
    <meta http-equiv="refresh" content="10; url=/">
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link href="css/tipTip.css" rel="stylesheet" type="text/css" />
    <script src="scripts/jquery-1.7.1.min.js"></script>
    <script src="scripts/sorttable.js"></script>
    <script src="scripts/jquery.tipTip.js"></script>
    <script type="text/javascript">
        $(document).ready(
           function() {
              $(function() { $(".homelink").tipTip();
			    $(".loadtweets").tipTip(); });
           }
        );
    </script>
  </head>
  <body>

    <a href="/">
       <img class="homelink" src="images/twitter.jpeg" align="left"
            title="Back to home page">
    </a>
    <br><br>
    <p class="hint">
       Hint: useable options are [-d|-delta] [-r|-recreate] [-q|-query <term>]
    <br><br>

<?php

include 'common.php';

//  Check if we need to recreate the collection.
$r_opts = array('r', 'recreate');
if (true == is_option_set($r_opts) ) {
   $collection = get_collection(TIMESTAMPS);
   $collection->drop();
}

//  Get tweets collection in MongoDB and last tweet ID.
$collection = get_collection(TIMESTAMPS);
$cursor    = $collection->find();

//  Set the search term.
//$search_term = "openshift";
//$q_opts = array('q', 'query');
//if (true == is_option_set($q_opts) ) {
//   $search_term = get_option_value($q_opts);
//}

//  Set twitter search api uri.
// $twitter_uri = "http://api.twitter.com/1/statuses/user_timeline.json?screen_name=" . $screen_name;
//$twitter_uri = "https://api.twitter.com/1.1/search/tweets.json?q=" . $search_term . "&rpp=70";

//$d_opts = array('d', 'delta');
//if ((true == is_option_set($d_opts))  && ($lastid != null) ) {
//   $twitter_uri .= "&since_id=" . $lastid;
//}

//  Search for newer tweets.
//$zeecurl = curl_init($twitter_uri);
//curl_setopt($zeecurl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($zeecurl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
//TODO here query the database
//$resp = curl_exec($zeecurl);

//curl_close($zeecurl);

//$decoded_resp = json_decode($resp);

//  Insert each tweet into the MongoDB collection. 
$beancounter = 0;
foreach ($cursor as $v) {
         // echo "<br><p>loading item #" . $id . " : " . print_r($time) . "...\n";
	 $id = $v["id"]
         $entry = convertToArray($v);
         $beancounter++;
      }
   }
}

//echo "<p><b>Search URI: </b><font size='-1'>" . $twitter_uri . "</font>\n";
echo "<br/>\n";
echo "<p><b>Logged Timestamps Loaded: " . $beancounter . "</b>\n";

?>

    <br><br/>
    You will soon be automatically redirected back to the home page ...
  </body>
</html>
