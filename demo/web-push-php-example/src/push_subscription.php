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
        $query = "SELECT * FROM subs WHERE enpoint='". $subscription['endpoint'] ."'";
        $ret = $bd->query($query);

        $contador = 0;
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $contador = 1;
        }
        if($contador==0){
          $query = "INSERT INTO subs (endpoint,subkey,token,dateTime,active) VALUES ('". $subscription['endpoint'] ."','". $subscription['key'] ."','". $subscription['token'] ."','". time() ."','1')";
          $bd->exec($query);
        }
        break;
    case 'PUT':
        // update the key and token of subscription corresponding to the endpoint
        $contador = 0;
        while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $contador = 1;
        }
        if($contador==0){
          $query = "INSERT INTO subs (endpoint,subkey,token,dateTime,active) VALUES ('". $subscription['endpoint'] ."','". $subscription['key'] ."','". $subscription['token'] ."','". time() ."','1')";
          $bd->exec($query);
        }
        break;
    case 'DELETE':
        // delete the subscription corresponding to the endpoint
        $query = "DELETE FROM subs WHERE endpoint='". $subscription['endpoint'] ."'";
        $dbh->query($query);
        break;
    default:
        echo "Error: method not handled";
        return;
}
