<?php
/**
 * Created by PhpStorm.
 * User: gabrielcuestaarza
 * Date: 19/6/17
 * Time: 21:56
 */

require("config.inc.php");

if($_POST["create"]){

    $customer   = $_POST["customer"];
    $title      = $_POST["title"];
    $content    = $_POST["content"];
    $icon       = $_POST["icon"];
    $image      = $_POST["image"];

    $sql = "INSERT INTO notifications (id_customers,title,body,logo,image) VALUES ";
    $sql .= "('". $customer ."'";
    $sql .= ",'". $title ."'";
    $sql .= ",'". $content ."'";
    $sql .= ",'". $icon ."'";
    $sql .= ",'". $image ."')";

    echo("<br/>". $sql ."<br/>");
    $conn->query($sql);
    echo("<b>Notification created.</b><br/>");
    echo("<p><a href=\"send_push_notification.php\">Enviar notificación</a></p>");

}

?>
<html>
<head>
    <title>Create notification</title>
</head>
<body>
<form method="post" action="create_notifications.php">
    <input type="hidden" name="create" value="1" />
    Customer:
    <select name="customer">
        <option value="1">Customer 1</option>
        <option value="2">Customer 2</option>
    </select>
    <br/>
    Title: <input type="text" name="title" />
    <br/>
    Content: <textarea name="content"></textarea>
    <br/>
    Icon: <input type="text" name="icon" />
    <br/>
    Image: <input type="text" name="image" />
    <br/>
    <input type="submit" value="Enviar" />
</form>
</body>
</html>