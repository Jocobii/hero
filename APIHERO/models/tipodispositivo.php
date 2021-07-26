<?php
require_once('mysqlconnection.php');
class TipoDispositivo{
    private $id;
    private $nombre;
    public function getId() {
        return $this->id; 
    }
    public function setId($id) { 
        $this->id = $id; 
    }
    public function getNombre() {
        return $this->nombre; 
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function __construct(){
        if(func_num_args() == 0){
            $this->id='';
            $this->nombre='';
        }
        if(func_num_args() == 1){
            $arguments = func_get_args();
            $query = 'SELECT idTipoDispositivo,nombreTipoRecurso FROM tipodispositivo WHERE idTipoDispositivo=?'; 
            $connection= MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('i', $arguments[0]); 
            $command->bind_result($id,$nombre); 
            $command->execute(); 
            if ($command->fetch()){
                $this->id=$id;
                $this->nombre=$nombre;
            }else{
                throw new RecordNotFoundException($arguments[0]);
            }
             mysqli_stmt_close($command);  
            $connection->close(); 
        }
        if(func_num_args() == 2){
            $arguments = func_get_args();
            $this->id =$arguments[0];
            $this->nombre =$arguments[1];
        }
    }
    public function toJson(){
        return json_encode(array(
            'id'=>$this->id,
            'dispositivo'=>$this->nombre
        ));
    }
    public static function getAll(){
        $list = array(); //create list
        $query = 'SELECT idTipoDispositivo,nombreTipoRecurso FROM tipodispositivo';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);    
        $command->bind_result($id,$nombre);//bind result
        $command->execute(); //execute query
        //read result
 
        while ($command->fetch()){ //fetch es ir y traer
           //populate list
           array_push($list,new TipoDispositivo($id,$nombre) );
        }
        mysqli_stmt_close($command);  //close statament
        $connection->close();  //close connection
        return $list; 
    }
    public static function getAllToJson(){
        $jsonArray= array();
        foreach (self::getAll() as $item) {
            array_push($jsonArray, json_decode($item->toJson()));
        }
        return json_encode($jsonArray);
    }
    public function add(){
        $query='INSERT INTO tipodispositivo(nombreTipoRecurso) VALUES (?);';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('s', $this->nombre);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close(); 
        return $result; 
    }
    public function put(){
        $query='UPDATE tipodispositivo 
        SET nombreTipoRecurso= ?
        WHERE idTipoDispositivo=?';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('si',$this->nombre,$this->id);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
}
?>