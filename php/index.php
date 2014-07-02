<html>
  <head>
    <title>PHPMongoTweet - MongoDB + tweets</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <link href="css/tipTip.css" rel="stylesheet" type="text/css" />
    <script src="scripts/jquery-1.7.1.min.js"></script>
    <script src="scripts/sorttable.js"></script>
    <script src="scripts/jquery.tipTip.js"></script>
    <script type="text/javascript">
        $(document).ready(
           function() {
              $("td, th").hover(
                 function() { $(this).css("background-color", "#FDDC80"); },
                 function() { $(this).css("background-color", ""); }
              );

           }
        );
    </script>
  </head>
  <body>
  <div> First div</div>

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include 'common.php';

// Get tweets collection in MongoDB.
$collection = get_collection(TIMESTAMPS);
//echo "Collection selected ";
//echo $collection;
//echo "\n";
//echo "Type: ", gettype($collection), "\n";
$cursor     = $collection->find();
$cursor->setReadPreference(MongoClient::RP_PRIMARY);
//$cursor->sort(array('time'=>-1));
$resarray   = iterator_to_array($cursor);

//echo "Number of logs " ;
//echo "is" . count($resarray) . "\n" ;
?>

   <div id="contentdiv">
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
$tmp = 0;
foreach ($resarray as $d) if ($tmp++ < 50) {
   echo "<tr id='tweetrow'>\n";
   echo "  <td class='when' colspan='2'" . "'>" .  $d['time'] .
        "  </td>\n";
  echo "  <td class='tag'>" .  $d['tag'] .
        "  </td>\n"
   echo "  <td class='who'>" .  $d['host'] .
        "  </td>\n";
   echo "</tr>\n";
}

?>
        </table>
      <div id="clearalignment">&nbsp;</div>
    </div>
  </div>
  </body>
</html>
