<?php
require("config.inc.php");

$subscription = json_decode(file_get_contents('php://input'), true);

if (!isset($subscription['endpoint'])) {
    echo 'Error: not a subscription';
    return;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // create a new subscription entry in your database (endpoint is unique)
        $query = "INSERT INTO subs (endpoint,subkey,token,datetime,active) VALUES ('". $subscription['endpoint'] ."','". $subscription['key'] ."','". $subscription['token'] ."','". time() ."','1')";
        $conn->query($query);
        break;
    case 'PUT':
        $query = "SELECT COUNT(endpoint) AS counter FROM subs WHERE endpoint='". $subscription['endpoint'] ."'";
	$ret = $conn->query($query);
	
	$row=mysqli_fetch_array($ret,MYSQLI_NUM);
        $counter = $row[0];
	
        if($counter==0){
          // update the key and token of subscription corresponding to the endpoint
            $query = "INSERT INTO subs (endpoint,subkey,token,active) VALUES ('". $subscription['endpoint'] ."','". $subscription['key'] ."','". $subscription['token'] ."','1')";
	    $conn->query($query);
        }
        break;
    case 'DELETE':
        // delete the subscription corresponding to the endpoint
        $query = "DELETE FROM subs WHERE endpoint='". $subscription['endpoint'] ."'";
        $conn->query($query);
        break;
    default:
        echo "Error: method not handled";
        return;
}

$conn->close();
