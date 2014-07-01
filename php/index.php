<html>
  <head>
    <title>PHPMongoTweet - MongoDB + tweets</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link href="css/tipTip.css" rel="stylesheet" type="text/css" />
    <script src="scripts/jquery-1.7.1.min.js"></script>
    <script src="scripts/sorttable.js"></script>
    <script src="scripts/jquery.tipTip.js"></script>
    <script type="text/javascript">
        function loadmo(term) {
           document.forms["loadform"].q.value = term;
           if ($.trim($("#q").val()) != "") {
              $("#x").fadeIn();
           }
        };

        $(document).ready(
           function() {
              $("td, th").hover(
                 function() { $(this).css("background-color", "#FDDC80"); },
                 function() { $(this).css("background-color", ""); }
              );

              $(function() {
                  $(".homelink").tipTip();
                  $(".loadtweets").tipTip();
                }
              );

           }
        );
    </script>
  </head>
  <body>
    <div id="loaddiv">
       <a href="/">
          <img class="homelink" src="images/twitter.jpeg" align="left"
               title="Back to home page">
       </a>
       <h5 id="wip">#search-and-load-tweets-from-mongo</h5>
       <form name="loadform" method="get" action="load-tweets.php">
          <input id="submit" class="loadtweets" name="submit" type="submit"
                 value="Load tweets"
                 title="Search and load saved logs"/>
       </form>
    </div>
    <br>

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include 'common.php';

// Get tweets collection in MongoDB.
$collection = get_collection(TIMESTAMPS);
$cursor     = $collection->find();
$resarray   = iterator_to_array($cursor);


   <div id="contentdiv">
   echo "Number of logs " ;
   echo "is" . count($resarray) . "\n" ;
 
    <div class="floaterdiv">
        <table id="twtable" class="sortable" cellspacing="0"
               summary="Last logs">
<?php
    echo "<caption>MongoDB: A timeline of logs [" . count($resarray) .
         "]<br />an <a href=\"https://openshift.redhat.com/app/\" target=\"_new\">OpenShift</a> demo application with MongoDB -- follow us <a href=\"https://twitter.com/#!/openshift\" target=\"_new\">@openshift</a></caption>\n";
?>
           <tr>
             <th scope="col" abbr="timeline" class="nobackground">timeline</th>
             <th scope="col" abbr="@when">Timestamp</th>
             <th scope="col" abbr="tag">Tag</th>
             <th scope="col" abbr="@who">Host Ip</th>
           </tr>

<?php
foreach ($resarray as $d) {
   echo "<tr id='tweetrow'>\n";
   echo "  <td class='when' colspan='2'" . "'>" .  $d['time'] .
        "  </td>\n";
   echo "</tr>\n";
}

?>

        </table>
      <div id="clearalignment">&nbsp;</div>
    </div>
  </body>
</html>
