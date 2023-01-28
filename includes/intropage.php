<?php
session_start();
if(!isset($_SESSION["session_username"])){
    header("location:login.php");
 }else{
    include("includes/header.php"); ?>
 <div id="Bienvenido">
    <h2>Bienvenido, <span><?php echo $_SESSION['session_username'];?>!</span></h2>
    <p><a href="logout.php>Finalice</a> sesion aqui</p>
 </div>
 <?php
}
?>