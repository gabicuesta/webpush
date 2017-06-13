<?php

require __DIR__ . '/../../vendor/autoload.php';
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

while($row = $ret->fetch_assoc()) {
    echo("--<br/>");
}

echo("Hola");
