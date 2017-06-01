<?php
require __DIR__ . '/../../vendor/autoload.php';
use Minishlink\WebPush\WebPush;

// here I'll get the subscription endpoint in the POST parameters
// but in reality, you'll get this information in your database
// because you already stored it (cf. push_subscription.php)
$subscription = json_decode(file_get_contents('php://input'), true);

$auth = array(
    'VAPID' => array(
        'subject' => 'https://github.com/Minishlink/web-push-php-example/',
        'publicKey' => 'BCmti7ScwxxVAlB7WAyxoOXtV7J8vVCXwEDIFXjKvD-ma-yJx_eHJLdADyyzzTKRGb395bSAtxlh4wuDycO3Ih4',
        'privateKey' => 'HJweeF64L35gw5YLECa-K7hwp3LLfcKtpdRNK8C_fPQ', // in the real world, this would be in a secret file
    ),
);

$webPush = new WebPush($auth);
/*
$res = $webPush->sendNotification(
    $subscription['endpoint'],
    "Contenido del mensaje",
    $subscription['key'],
    $subscription['token'],
    true
);
*/

// handle eventual errors here, and remove the subscription from your server if it is expired


class MiBD extends SQLite3
{
    function __construct()
    {
        $this->open('database.sqlite');
    }
}

$bd = new MiBD();

$query = "SELECT * FROM subs";
$ret = $db->query($query);

while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $endpoint = $row[1];
    $key      = $row[2];
    $token    = $row[3];

    $res = $webPush->sendNotification(
        $endpoint,
        "{mensaje:'Contenido del mensaje'}",
        $key,
        $token,
        true
    );
}
