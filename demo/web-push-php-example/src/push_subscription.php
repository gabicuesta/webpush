<?php
$subscription = json_decode(file_get_contents('php://input'), true);

if (!isset($subscription['endpoint'])) {
    echo 'Error: not a subscription';
    return;
}

class MiBD extends SQLite3
{
    function __construct()
    {
        $this->open('database.sqlite');
    }
}

$bd = new MiBD();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // create a new subscription entry in your database (endpoint is unique)
        $query = "INSERT INTO subs (endpoint,subkey,token,dateTime,active) VALUES ('". $subscription['endpoint'] ."','". $subscription['key'] ."','". $subscription['token'] ."','". time() ."','1')";
        $bd->exec($query);
        break;
    case 'PUT':
        $query = "SELECT COUNT(endpoint) AS counter FROM subs WHERE endpoint='". $subscription['endpoint'] ."'";
        $ret = $bd->query($query);

        $counter = 0;
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
          $counter = $row["counter"];
        }
        if($counter==0){
          // update the key and token of subscription corresponding to the endpoint
          $query = "INSERT INTO subs (endpoint,subkey,token,dateTime,active) VALUES ('". $subscription['endpoint'] ."','". $subscription['key'] ."','". $subscription['token'] ."','". time() ."','1')";
          $bd->exec($query);
        }
        break;
    case 'DELETE':
        // delete the subscription corresponding to the endpoint
        $query = "DELETE FROM subs WHERE endpoint='". $subscription['endpoint'] ."'";
        $bd->exec($query);
        break;
    default:
        echo "Error: method not handled";
        return;
}
