<?php
// parte 4, inicio de sesion
session_start();
$_SESSION['usuario_id'] = "Javier";
$errores = [];
$name = $_POST["fname"];
$lastName = $_POST["lname"];
$age = $_POST["fage"];
$email = $_POST["femail"]; //parte 3 correo electronico
$email = trim($email);

// parte 2, sanitacion y verificacion de datos.

if(empty($name)){
    $errores[] = "El nombre no puede ir vacio";
}else if(empty($lastName)){
    $errores[] = "El apellido no puede ir vacio";
}else if(empty($age) && is_numeric($age)){
    $errores[] = "La edad no puede ir vacia";
}else if(empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL))){
    $errores[] = "El correo no puede ir vacio o tiene un formato incorrecto"; 
    // verificacion correo electronico y filtro con filtervar
} 
if(empty($errores)){
    echo "Hola, " . $name . " " . $lastName . " tienes " . $age . " años. <br/>";
    echo "con correo: " . $email . "<br/>";
    //parte 4. Inicio de sesion (aqui empezamos a redirigir a otros archivos)
    echo "Bienvenido: " . $_SESSION["usuario_id"]; // Importante esto es lo que crea el id de php para el usuario
    echo "<br><a href='bienvenida.php'>Ir a la pagina de bienvenida</a>"; // esto lo hacemos para redirigir al mensaje de bienvenida
}


?>
