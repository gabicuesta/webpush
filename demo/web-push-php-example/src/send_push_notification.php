<?php
require __DIR__ . '/../../vendor/autoload.php';
use Minishlink\WebPush\WebPush;

class MiBD extends SQLite3
{
    function __construct()
    {
        $this->open('database.sqlite');
    }
}

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

$bd = new MiBD();

$query = "SELECT * FROM subs";
$ret = $bd->query($query);

while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $endpoint = $row['endpoint'];
    $key      = $row['subkey'];
    $token    = $row['token'];

    $title    = "Título del mensaje";
    $content  = "Contenido del mensaje";
    $icon     = "https://ssl-webpushtest2.7e14.starter-us-west-2.openshiftapps.com/demo/web-push-php-example/src/images/icon.png";
    $image    = "https://ssl-webpushtest2.7e14.starter-us-west-2.openshiftapps.com/demo/web-push-php-example/src/images/badge.jpg";

    $res = $webPush->sendNotification(
        $endpoint,
        "{title:'". $title ."',content:'". $content ."',icon:'". $icon ."',image:'". $image ."'}",
        $key,
        $token,
        true
    );
}
