<?php
session_start(); // preguntar si es obligatorio en todos los archivos php..
if(isset($_SESSION['usuario_id'])){ // este isset nos dice que si existe, lo imprime
    echo "Bienvenido: " . $_SESSION["usuario_id"];     
}else{
    echo "No se ha iniciado sesión";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida del login</title>
</head>
<body>
    <p>Hola, este es un mensaje de bienvenida</p><br>
    <!--IMPORTANTE si quiero destruir la sesion debo mandar un form con el post -->
    <form method = "post" action="">
        <input type="submit" name = "cerrar_sesion" value="Cerrar sesion">
    </form>

    <!-- IMPORTANTE 2, si quiero destruir la sesion se puede hacer una comprobacion 
    con una funcion isset, que verifica si existe y que no sea null
    es decir devuelve true si la variable existe-->
    <?php 

    // parte 5. aqui se destruye la sesion
    if(isset($_POST['cerrar_sesion'])){
        // funciones que pueden ser importantes
        session_unset(); // esto limpia todas las variables
        session_destroy();
        header("Location: view.html"); // devuelve a otra pagina, preguntar si se debe hacer otra cosa
        exit;
    }
    
?>
</body>
</html>