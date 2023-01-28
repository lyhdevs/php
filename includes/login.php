<?php
require_once("includes/connection.php");
include("includes/header.php");
session_start();

if(!empty($_POST["login"])){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
   
   $query= $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
   $query->bindParam("username", $username, PDO::PARAM_STR);
   $query->execute();
  
   $result = $query->fetch(PDO::FETCH_ASSOC);
   
   if (!$result){
        echo '<p class="error">La combinacion de usuario y contrasena son invalidos</p>';
     }else{
        if (password_verify($password, $result['password'])){
            $_SESSION['session_username']=$username;
       
         header("Location: intropage.php");    
        }
        else{
            $message = "nombre de ususario y contrasena ivalida";
        }
     }
    }
    else{
        $message ="todos los campos son requerido";
    }
}
?>

<div class="container mlogin">
       <div id="login">
    <h1>Autenticacion de usuario</h1>
    <form name="loginform" id="loginform" action="" method="POST">
        <p>
            <label for="user_login">Nombre de usuario<br />
            <input type="text" name="username" id="username" class="input" value="" size="20" /></label>
       </p>
       <p>
            <label for="user_pass">Contrasena<br />
            <input type="password" name="password" id="password" class="input" value="" size="20" /></label>
       </p>
       <p class="submit">
            
            <input type="submit" name="login" class="button" value="Entrar"/>
       </p>
       <p class="regtext">no estas registrado? <a href="register.php">registrate aqui</a></p>
    </form>
</div>

</div>

<?php if(!empty($message)) {echo "<p class=\"error\">" . "MESSAGE: ". $message . "</p>";}?>