<?php
/*CREATE DATABASE practicaservidor;
CREATE USER 'consultorserver'@'%' IDENTIFIED BY 'consultorpass';
GRANT ALL PRIVILEGES ON practicaservidor.* TO 'consultorserver'@'%';
FLUSH PRIVILEGES 
CREATE TABLE myusers (id INT PRIMARY KEY AUTO_INCREMENT, nombre VARCHAR(30), password VARCHAR(255));
*/

class UserModel
{
    private $user = 'consultorserver'; // es propiedad estatica, no se puede usar self::
    private $password = 'consultorpass';
    private $myMachine = 'localhost';
    private $dataBase = 'practicaservidor';
    public $connection;
    private $table = 'myusers';
    private $url = '';
 
    public function __construct()
    {/*toca crear siempre el dsn que es un data source name y se usa para conectarse
       a la base de datos lleva el nombre del controlador PDO
       */
        $dsn = 'mysql:host=' . $this->myMachine . ';dbname=' . $this->dataBase . ';charset=utf8';
        try {
            $this->connection = new PDO($dsn, $this->user, $this->password);
        } catch (\PDOException $e) {
            die("Error de conexion a la base de datos: " . $e->getMessage());
        }

    }
    public function query($sql, array $params)
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }


    public 

}
?>








<!--public static Connection connectMyDatabase() {
        Connection con = null;
        String url = "jdbc:mysql://" + myMachine + "/" + baseDeDatos;
        try {
            con = DriverManager.getConnection(url, user, password);
        } catch (SQLException ex) {
            System.out.println("Error al conectar con la base de datos.");
        }
        return con;
    }
-->