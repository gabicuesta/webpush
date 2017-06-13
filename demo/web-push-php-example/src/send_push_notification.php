<?php

require __DIR__ . '/../../vendor/autoload.php';

use Minishlink\WebPush\WebPush;

require("config.inc.php");
die;
$subscription = json_decode(file_get_contents('php://input'), true);

$auth = array(
    'VAPID' => array(
        'subject' => 'https://github.com/Minishlink/web-push-php-example/',
        'publicKey' => 'BCmti7ScwxxVAlB7WAyxoOXtV7J8vVCXwEDIFXjKvD-ma-yJx_eHJLdADyyzzTKRGb395bSAtxlh4wuDycO3Ih4',
        'privateKey' => 'HJweeF64L35gw5YLECa-K7hwp3LLfcKtpdRNK8C_fPQ', // in the real world, this would be in a secret file
    ),
);

$webPush = new WebPush($auth);
// handle eventual errors here, and remove the subscription from your server if it is expired


$query = "SELECT * FROM notifications ORDER BY id_notifications DESC LIMIT 0,1";
$ret = $conn->query($query);

$row=mysqli_fetch_array($result,MYSQLI_NUM);

$title    = $row[0]['title'];
$content  = $row[0]['body'];
$icon     = $row[0]['logo'];
$image    = $row[0]'image'];

$query = "SELECT * FROM subs";
$ret = $conn->query($query);

while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $endpoint = $row['endpoint'];
    $key      = $row['subkey'];
    $token    = $row['token'];

    $res = $webPush->sendNotification(
        $endpoint,
        "{\"title\":\"". $title ."\",\"content\":\"". $content ."\",\"icon\":\"". $icon ."\",\"image\":\"". $image ."\"}",
        $key,
        $token,
        true
    );
}
