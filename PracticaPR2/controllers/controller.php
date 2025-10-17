<?php
// index.php?action=login

class Controller
{
    var $errores = [];
    private $model;
    private $userName;
    private $userPassword;

    public function __construct()
    {
        //require_once 'model.php';
        //$this->model = new UserModel();
    }

    public function validateUser()
    {
        $this->userName = trim(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        if (empty($this->userName)) {
            //importante poner el this
            $this->errores[] = "El nombre es obligatorio";
            // podemos hacer un elif para verificar la longitud y parametros incorrectos
            //no es obligatoria, se puede saltar
        } elseif (strlen($this->userName) < 3 || strlen($this->userName) > 20) {
            $this->errores[] = "El usuario no cumple la cantidad de caracteres, deben ser mas de 3 menos de 20";
        }
    }

    public function validatePassword()
    {
        $this->userPassword = trim($_POST['pwd'] ?? ''); // si existe bien si no lo envia vacio
        // si pongo esta linea no debo poner el $userName = $_post
        if (empty($this->userPassword)) {
            $this->errores[] = "La contraseña esta vacia";
        } elseif (strlen($this->userPassword) < 6 || strlen($this->userPassword) > 20) {
            $this->errores[] = "El usuario no cumple la cantidad de caracteres, en la contraseña deben tener minimo 6 caracteres";
        }
    }

    public function showLogin(){
        // este no muestra errores, solo el login
        // aqui voy a revisar que si esta logeado lo mantenga en el login, si no lo mando al dashboard
        if(isset($_SESSION['usuario_id'])){ // el isset me ayuda a comprobar que si se inicio la sesion el usuario
            header ('Location: index.php?action=dashboard');
            exit();
        }
        else{
            if(!empty($this->errores)) { // esto lo deberia poner para saber que esta dando error
            foreach ($this->errores as $error) {
                echo "<p>$error</p>";
                }
            }     
        }
    }

    public function login(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") { // Importante primero se debe verificar el request
            // con el !== revalido que realmente si llegue la peticion
            header('Location: index.php?action=login');
            exit();

        }else{
            $this->validateUser();
            $this->validatePassword();
        }
        if (!empty($this->errores)) {// si errores no esta vacio los imprimo en la variable de la $session
            $_SESSION['errores'] = $this->errores;
            header('Location: index.php?action=login');
            exit();
            
        }else{
            $_SESSION['usuario_id'] = 1;
            $_SESSION['usuario_name'] = $this->userName;
            echo "Login Correcto para el usuario: " . $this->userName;// esto me ayuda a depurar que si estuvo ok
            header ('Location: index.php?action=dashboard');
            /*
            //Inicio de sesion (aqui empezamos a redirigir a otros archivos)
            echo "Bienvenido: " . $_SESSION["usuario_id"]; // Importante esto es lo que crea el id de php para el usuario
            echo "<br><a href='dashboard.php'>Ir a la pagina de bienvenida</a>"; // esto lo hacemos para redirigir al mensaje de bienvenida
        */
            }
    }

    public function dashboard(){
        if(!isset($_SESSION['usuario_id'])){ //verifica el login
            header('Location: index.php?action=login');
            exit();
        }
        else{
            include 'views/dashboard.php';
        }
    }
    public function logout(){
            $_SESSION = [];
            session_destroy();
            header('Location: index.php?action=login');
            exit();
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