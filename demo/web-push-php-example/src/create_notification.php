<?php
class MiBD extends SQLite3
{
    function __construct()
    {
        $this->open('database.sqlite');
    }
}

if($_POST["create"]){
  $customer   = $_POST["customer"];
  $title      = $_POST["title"];
  $content    = $_POST["content"];
  $icon       = $_POST["icon"];
  $image      = $_POST["image"];

  $sql = "INSERT INTO notifications (id_customers,title,body,logo,image,dateTime) VALUES ";
  $sql .= "('". $customer ."'";
  $sql .= ",'". $title ."'";
  $sql .= ",'". $content ."'";
  $sql .= ",'". $icon ."'";
  $sql .= ",'". $image ."'";
  $sql .= ",'". time() ."')";

  $bd = new MiBD();
  $bd->query($sql);

  echo("<b>Notification created.</b><br/>");
}
?>
<html>
<head>
  <title>Create notification</title>
</head>
<body>
<form method="post" action="create_notification.php">
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
