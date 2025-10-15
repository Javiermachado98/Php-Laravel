<?php
// index.php?action=login


class Controller 
{
    private $model;
    public function __construct(){
        $this->model = UserModel();
    }


    public function login()
    {
        $errores = [];
        session_start();
        $_SESSION['usuario_id'] = "javier";
        if ($_SERVER["REQUEST_METHOD"] == "POST") { // Importante primero se debe verificar el request
            $name = trim(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            // si pongo esta linea no debo poner el $name = $_post
            $password = trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            // aqui ya estamos verificando que no queden espacios

            if (empty($name)) {
                $errores[] = "El nombre es obligatorio";
                // podemos hacer un elif para verificar la longitud y parametros incorrectos
                //no es obligatoria, se puede saltar
            } elseif (strlen($name) < 3 || strlen($name) > 20) {
                $errores[] = "El usuario no cumple la cantidad de caracteres, deben ser mas de 3 menos de 20";
            }

            if (empty($password)) {
                $errores[] = "La contraseña esta vacia";
            } elseif (strlen($password) < 3 || strlen($password) > 20) {
                $errores[] = "El usuario no cumple la cantidad de caracteres, en la contraseña deben ser minimo 6 y maximo 20";
            }

            if (!empty($errores)) { // esto lo deberia poner para saber que esta dando error
                foreach ($errores as $error) {
                    echo "<p>$error</p>";
                }
            }

            if (empty($errores)) {
                echo "Login Correcto para el usuario: " . $name;// esto me ayuda a depurar que si estuvo ok
            }
        }

    }

    public function accessDatabase()
    {
        require_once 'model.php';
        try {
            $myDb = new UserModel(); // aqui va la clase que cree en model, 
            echo "Se logro la conexion con la base de datos!";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    public function showUser(){

    }

    public function loginOut(){
        
        if(isset($_POST['cerrar_sesion'])){
        // funciones que pueden ser importantes
        session_unset(); // esto limpia todas las variables
        session_destroy();
        header("Location: ejercicio1.html"); // devuelve a otra pagina, preguntar si se debe hacer otra cosa
        exit;
    }
    }



}



?>