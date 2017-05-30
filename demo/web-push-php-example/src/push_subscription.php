<?php
$subscription = json_decode(file_get_contents('php://input'), true);

if (!isset($subscription['endpoint'])) {
    echo 'Error: not a subscription';
    return;
}

$method = $_SERVER['REQUEST_METHOD'];

$dir = 'sqlite:/database.sqlite';
$dbh  = new PDO($dir) or die("cannot open the database");

switch ($method) {
    case 'POST':
        // create a new subscription entry in your database (endpoint is unique)
        $query = "INSERT INTO subs (endpoint,subkey,token,dateTime,active) VALUES ('". $subscription['endpoint'] ."','". $subscription['key'] ."','". $subscription['token'] ."','". time() ."','1')";
        $dbh->query($query);
        break;
    case 'PUT':
        // update the key and token of subscription corresponding to the endpoint
        $query = "UPDATE subs SET subkey='". $subscription['key'] ."',token='". $subscription['token'] ."' WHERE endpoint='". $subscription['endpoint'] ."'";
        $dbh->query($query);
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
