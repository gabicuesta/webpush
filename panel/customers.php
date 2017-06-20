<?php
/**
 * Created by PhpStorm.
 * User: gabrielcuestaarza
 * Date: 19/6/17
 * Time: 21:56
 */

require("config.inc.php");

// Formulario de inserción


// Listado
$query = "SELECT * FROM customers ORDER BY id_customers DESC";
$ret = $conn->query($query);

echo("<ul>");

if ($ret->num_rows > 0) {
    while($row = $ret->fetch_assoc()) {
        echo("<li>");
        echo($row['name']);
        echo("<li>");
    }
}

echo("</ul>");