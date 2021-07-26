<?php
require_once('mysqlconnection.php');
require_once('tipousuario.php');
class Usuario
{
    private $id;
    private $nombre;
    private $password;
    private $tipousuario;
    private $colaborador;
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getTipoUsuario()
    {
        return $this->tipousuario;
    }
    public function setTipoUsuario($tipousuario)
    {
        $this->tipousuario = $tipousuario;
    }
    public function getColaborador()
    {
        return $this->colaborador;
    }
    public function setColaborador($colaborador)
    {
        $this->colaborador = $colaborador;
    }
    public function __construct()
    {
        if (func_num_args() == 0) {
            $this->id = '';
            $this->nombre = '';
            $this->password = "";
            $this->tipousuario = "";
        }
        if (func_num_args() == 1) {
            $arguments = func_get_args();
            $query = 'SELECT idUsuario,nombreUsuario,passwordUsuario,idTipoUsuario FROM usuario WHERE idUsuario=?';
            $connection = MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('s', $arguments[0]);
            $command->bind_result($id, $nombre, $password, $tipousuario);
            $command->execute();
            if ($command->fetch()) {
                $this->id = $id;
                $this->nombre = $nombre;
                $this->password = $password;
                $this->tipousuario = new TipoUsuario($tipousuario);
            } else {
                throw new RecordNotFoundException($arguments[0]);
            }
            mysqli_stmt_close($command);
            $connection->close();
        }
        if (func_num_args() == 4) {

            $arguments = func_get_args();
            $this->id = $arguments[0];
            $this->nombre = $arguments[1];
            $this->password = $arguments[2];
            $this->tipousuario = $arguments[3];
        }
    }
    public function toJson()
    {
        return json_encode(array(
            'id'=>$this->id,
            'usuario'=>$this->nombre,
            'password'=>$this->password,
            'tipoUsuario'=>json_decode($this->tipousuario->toJson())
        ));
        
    }
    public static function getAll()
    {
        $list = array();
        $query = 'SELECT idUsuario,nombreUsuario,passwordUsuario,idTipoUsuario FROM usuario';
        $connection = MySqlConnection::getConnection();
        $command = $connection->prepare($query);
        $command->bind_result($id, $nombre, $password, $tipousuario);
        $command->execute();
        while ($command->fetch()) {
            array_push($list, new Usuario($id, $nombre, $password, new TipoUsuario($tipousuario)));
        }
        mysqli_stmt_close($command);
        $connection->close();
        return $list;
    }
    public static function getAllToJson()
    {
        $jsonArray = array();
        foreach (self::getAll() as $item) {
            array_push($jsonArray, json_decode($item->toJson()));
        }
        return json_encode($jsonArray);
    }
    public function add()
    {
        $query = 'INSERT INTO usuario(nombreUsuario,passwordUsuario,idColaborador,idTipoUsuario) VALUES (?,?,?,?);';
        $connection = MySqlConnection::getConnection();
        $command = $connection->prepare($query);
        $command->bind_param('ssii', $this->nombre, $this->password, $this->colaborador, $this->tipousuario);
        $result = $command->execute();
        mysqli_stmt_close($command);
        $connection->close();
        return $result;
    }
    public function put(){
        $query='UPDATE usuario 
        SET   nombreUsuario=?, passwordUsuario=?, idTipoUsuario=? 
        WHERE idUsuario=?';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('ssii', $this->nombre, $this->password, $this->tipousuario,$this->id);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
}
