<?php
// index.php?action=login


class Controller 
{
    var $errores = [];
    private $model;
    private $userName;
    private $userPassword;
    public function __construct(){
        $this->model = new UserModel();
    }

    function validateUser(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->userName = trim(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            if (empty($userName)) {
                //importante poner el this
                $this->errores[] = "El nombre es obligatorio";
                // podemos hacer un elif para verificar la longitud y parametros incorrectos
                //no es obligatoria, se puede saltar
            } elseif (strlen($userName) < 3 || strlen($userName) > 20) {
                $this->$errores[] = "El usuario no cumple la cantidad de caracteres, deben ser mas de 3 menos de 20";
            }
        }
    }

    public function validatePassword(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){// Importante primero se debe verificar el request
            $this->userPassword = trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            // si pongo esta linea no debo poner el $userName = $_post
            if (empty($userPassword)) {
                $errores[] = "La contraseña esta vacia";
            } elseif (strlen($userPassword) < 3 || strlen($userPassword) > 20) {
                $errores[] = "El usuario no cumple la cantidad de caracteres, en la contraseña deben ser minimo 6 y maximo 20";
            }
        }
    }

    public function login()
    {
        session_start();    
        $this->validateUser();
        $this->validatePassword();
        $_SESSION['usuario_id'] = "javier";
            if (!empty($errores)) { // esto lo deberia poner para saber que esta dando error
                foreach ($errores as $error) {
                    echo "<p>$error</p>";
                }
            }
            if (empty($errores)) {
                echo "Login Correcto para el usuario: " . $this->userName;// esto me ayuda a depurar que si estuvo ok
            }
            if(empty($errores)){
            echo "Hola, " . $name . "<br/>";
            //Inicio de sesion (aqui empezamos a redirigir a otros archivos)
            echo "Bienvenido: " . $_SESSION["usuario_id"]; // Importante esto es lo que crea el id de php para el usuario
            echo "<br><a href='dashboard.php'>Ir a la pagina de bienvenida</a>"; // esto lo hacemos para redirigir al mensaje de bienvenida
        }
        }

}

    /*public function accessDatabase()
    {
        require_once 'model.php';
        try {
            $myDb = new UserModel(); // aqui va la clase que cree en model, 
            echo "Se logro la conexion con la base de datos!";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }*/


    /*public function loginOut(){
        
        if(isset($_POST['cerrar_sesion'])){
        // funciones que pueden ser importantes
        session_unset(); // esto limpia todas las variables
        session_destroy();
        header("Location: ejercicio1.html"); // devuelve a otra pagina, preguntar si se debe hacer otra cosa
        exit;
    }
    }*/

?>