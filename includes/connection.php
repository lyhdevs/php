<?php
require_once("constants.php");


try{
    $connection=new PDO('mysql:host=' .DB_HOST .';dbname='.DB_NAME, DB_USER, DB_PASS);
}
catch(Exception $e)
{
    die($e->getMessage());
}

?>
//se utiliza para establecer la conexion con la base de date_offset_get