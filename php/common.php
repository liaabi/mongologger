<?php

  define("TIMESTAMPS", "logs");

  function is_option_set($opts) {
     foreach ($opts as $k => $v) {
        if (true == isset($_GET[$v]) ) {
           return true;
        }
     }

     return false;
  }

  function get_option_value($opts) {
     foreach ($opts as $k => $v) {
        if (true == isset($_GET[$v]) ) {
           return $_GET[$v];
        }
     }

     return NULL;
  }

  function convertToArray($zobject) {
     if (is_object($zobject) )
        return get_object_vars($zobject);
     else if (is_array($zobject) )
        /* Convert to object using __FUNCTION__ for recursive call.  */
        return array_map(__FUNCTION__, $zobject);
     else
        return $zobject;
  }


  function get_db_connection($dbname) {
    $user   = $_ENV['OPENSHIFT_MONGODB_HA_DB_USERNAME'];
    $passwd = $_ENV['OPENSHIFT_MONGODB_HA_DB_PASSWORD'];

     #$uri = "mongodb://" . $user . ":" . $passwd . "@" . $host . ":" . $port;
     $uri = "mongodb://" . $user . ":" . $passwd . "@" . $_ENV['OPENSHIFT_MONGODB_HA_DB_HOST1'] . ":" . $_ENV['OPENSHIFT_MONGODB_HA_DB_PORT1'] . "," . $_ENV['OPENSHIFT_MONGODB_HA_DB_HOST2'] . ":" . $_ENV['OPENSHIFT_MONGODB_HA_DB_PORT2']  . "," . $_ENV['OPENSHIFT_MONGODB_HA_DB_HOST3'] . ":" . $_ENV['OPENSHIFT_MONGODB_HA_DB_PORT3'] . "/" . $dbname;
     
     $mongo = new MongoClient($uri);
     return $mongo;
  }

  function get_database($dbname) {
     $conn = get_db_connection($dbname);
     return $conn;
  }

  function get_collection($collection) {
     $dbname = $_ENV['OPENSHIFT_APP_NAME'];
     $db = get_database($dbname);
     return $db->$collection;
  }

?>
