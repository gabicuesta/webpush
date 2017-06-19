<?php
require __DIR__ . '/../demo/vendor/autoload.php';
use Minishlink\WebPush\WebPush;

require("config.inc.php");

$auth = array(
    'VAPID' => array(
        'subject' => 'https://github.com/Minishlink/web-push-php-example/',
        'publicKey' => 'BCmti7ScwxxVAlB7WAyxoOXtV7J8vVCXwEDIFXjKvD-ma-yJx_eHJLdADyyzzTKRGb395bSAtxlh4wuDycO3Ih4',
        'privateKey' => 'HJweeF64L35gw5YLECa-K7hwp3LLfcKtpdRNK8C_fPQ', // in the real world, this would be in a secret file
    ),
);

$webPush = new WebPush($auth);

$query = "SELECT * FROM notifications ORDER BY id_notifications DESC LIMIT 0,1";
$ret = $conn->query($query);

$row = mysqli_fetch_array($ret,MYSQLI_NUM);

$title    = $row[2];
$content  = $row[3];
$icon     = $row[4];
$image    = $row[5];

$query = "SELECT * FROM subs";
$ret = $conn->query($query);

if ($ret->num_rows > 0) {
    // output data of each row
    while($row = $ret->fetch_assoc()) {
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
    echo("Notificaciones enviadas.<br/><br/><a href=\"menu.php\"></a>");
} else {
    echo "0 results";
}
?>
