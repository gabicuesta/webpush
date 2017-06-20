<?php
/**
 * Created by PhpStorm.
 * User: gabrielcuestaarza
 * Date: 19/6/17
 * Time: 21:56
 */

require("config.inc.php");

echo("<h2>Crear notificación</h2>");

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

    //echo("<br/>". $sql ."<br/>");
    $conn->query($sql);
    echo("<b>Notification created.</b><br/>");
    echo("<p><a href=\"send_push_notification.php\">Enviar notificación</a></p>");

}

?>
<html>
<head>
    <title>Create notification</title>
    <style>
    <!--
        body{
            font-family:verdana;
        }
        div{
            margin-bottom:10px;
        }
	input{
	    font-family:verdana;
	    font-size:12px;
	}
	.cLeft{
	    width:100px;
	    float:left;
	}
	.cRight{
	    width:150px;
	    float:left;
	}
	.limpio{
	    clear:both;
	}
    -->
    </style>
</head>
<body>
<form method="post" action="create_notifications.php">
    <input type="hidden" name="create" value="1" />
    <div>
	<div class="cLeft">
            Customer:
	</div>
	<div class="cRight">
            <select name="customer">
                <option value="1">Customer 1</option>
                <option value="2">Customer 2</option>
            </select>
	</div>
    </div>
    <div class="limpio"></div>
    <div>
	<div class="cLeft">
            Title: 
	</div>
	<div class="cRight">
	    <input type="text" name="title" size="50" />
	</div>
    </div>
    <div class="limpio"></div>
    <div>
	<div class="cLeft">
            Content: 
	</div>
	<div class="cRight">
	    <textarea name="content" cols="50" rows="5"></textarea>
        </div>
    </div>
    <div class="limpio"></div>
    <div>
	<div class="cLeft">
            Icon: 
	</div>
	<div class="cRight">
	    <input type="text" name="icon" size="50" />
	</div>
    </div>
    <div class="limpio"></div>
    <div>
	<div class="cLeft">
            Image: 
	</div>
	<div class="cRight">
	    <input type="text" name="image" size="50" />
    	</div>
    </div>
    <div class="limpio"></div>
    <div>
        <input type="submit" value="Enviar" />
    </div>
</form>
</body>
</html>
