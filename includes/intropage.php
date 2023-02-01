<?php
session_start();
if(!isset($_SESSION["session_username"])){
    header("location:login.php");
 }else{
    include("includes/header.php"); ?>

<!DOCTYPE html>
<html lang="en">
 <div id="Bienvenido">
    <h2>Bienvenido, <span><?php echo $_SESSION['session_username'];?>!</span></h2>
    <p><a href="./logout.phplogout.php"> Finalice la sesion aqui</p>
 </div>
 </html>
 <?php
}
?>
