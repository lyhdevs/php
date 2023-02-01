
<?php
require_once("includes/connection.php");
include("includes/header.php");
session_start();

if(isset($_POST["register"])){

if(!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']));
   $full_name=$_POST['fullname'];
   $email=$_POST['email'];
   $username=$_POST['username'];
   $password=$_POST['password'];
   $password_hash = password_hash($password, PASSWORD_BCRYPT);//encripta  y almacena ne base d datos


    $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
      $query->bindParam("email", $email, PDO::PARAM_STR);
      $query->execute();

      if($query->rowCount() > 0) {
         echo' <p class="error"> El email ya se encuentra registrado </p>';
       }

     if ($query->rowCount() == 0) {
        $query = $connection->prepare ('INSERT INTO users(FULLNAME,USERNAME,PASSWORD,EMAIL) VALUES (:fullname,:username, :password_hash , :email)');
        $query->bindParam("fullname", $full_name, PDO::PARAM_STR);
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $result = $query->execute();

        if($result){
          $message= "Cuenta creada correctamente";
         }
         else{
           $message ="Error al ingresar datos de la informacion";
         }
      }
       else{
         $message = "EL NOMBRE DE USUARIO YA EXISTE, POR FAVOR INTENTA CON OTRO";
        }

       }
       else{
       $message="Todos los campos deben ser completados";
      }
 
?>

<?php if (!empty($message)) {echo "<p class=\"error\">" . "Mensaje: ". $message . "</p>";} ?>

<!DOCTYPE html>
<html lang="en">
<div class="container Mregister">
    <div id="login">
    <h1> Registrar </h1>
 <form name="registerform" id="registerform" action="register.php" method="post">
    <p>
      <label for="user_login">Nombre Completo <br />
      <input type="text" name="fullname" id="fullname" class="input" size="32" value="" /></label>
    </p>


    <p>
       <label for="user_pass">E-mail<br />
       <input type="email" name="email" id="email" class="input" value="" size="32" /></label>
     </p>


    <p>
        <label for="user_pass">Nombre de usuario<br />
       <input type="text" name="username" id="username" class="input" value="" size="20" /></label>
    </p>

    <p>
       <label for="user_pass">Constrasena<br />
       <input type="password" name="password" id="password" class="input" value="" size="32" /></label>
    </p>


     <p class="submit">
       <input type="submit" name="register" id="register" class="button" value="Register"/>
     </p>
    <p class="regtext"> Ya tienes una cuenta? <a href="./login.php"> Entra aqui</a></p>
 </form>
</div>
</div>
</html>
<?php include("./footer.php"); ?>

