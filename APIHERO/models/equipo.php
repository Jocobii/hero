<?php
require_once('mysqlconnection.php');
require_once('area.php');

class Equipo{
    private $id;
    private $nombre;
    private $codequipo;
    private $email;
    private $area;
    public function getId() {
        return $this->id; 
    }
    public function setId($id) { 
        $this->id = $id; 
    }
    public function getNombre() {
        return $this->nombre; 
    }
    public function setNombre($nombre) { 
        $this->nombre = $nombre; 
    }
    public function getCodEquipo() {
        return $this->codequipo; 
    }
    public function setCodEquipo($codequipo) { 
        $this->codequipo = $codequipo; 
    }
    public function getEmail() {
        return $this->email; 
    }
    public function setEmail($email) { 
        $this->email = $email; 
    }
    public function getArea() {
        return $this->area; 
    }
    public function setArea($area) { 
        $this->area = $area; 
    }
    public function __construct(){
        if(func_num_args() == 0){
            $this->id='';
            $this->nombre='';
            $this->codequipo="";
            $this->email="";
            $this->area="";
        }
        if(func_num_args() == 1){
            $arguments = func_get_args();
            $query = 'SELECT idEquipo,nombreEquipo,codEquipo,emailEquipo,idArea FROM equipo WHERE idEquipo=?'; 
            $connection= MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('i', $arguments[0]); 
            $command->bind_result($id,$nombre,$codequipo,$email,$area); 
            $command->execute(); 
            if ($command->fetch()){ 
            $this->id = $id;
            $this->nombre = $nombre;
            $this->email = $email;
            $this->area =new Area($area);
            }else{
                throw new RecordNotFoundException($arguments[0]);
            }
             mysqli_stmt_close($command);  
            $connection->close(); 
        }
        if(func_num_args() == 5){

            $arguments = func_get_args();
            $this->id =$arguments[0];
            $this->nombre =$arguments[1];
            $this->codequipo =$arguments[2];
            $this->email =$arguments[3];
            $this->area =$arguments[4];
        }
    }
    public function toJson(){
        return json_encode(array(
            'id'=>$this->id,
            'equipo'=>$this->nombre,
            'codEquipo'=>$this->codequipo,
            'email'=>$this->email,
            'area'=>json_decode($this->area->toJson())
        ));
    }
    public static function getAll(){
        $list = array(); 
        $query = 'SELECT idEquipo,nombreEquipo,codEquipo,emailEquipo,idArea FROM equipo';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);    
        $command->bind_result($id,$nombre,$codequipo,$email,$area);
        $command->execute();
        while ($command->fetch()){ 
           array_push($list,new Equipo($id,$nombre,$codequipo,$email,new Area($area)));
        }
        mysqli_stmt_close($command);  
        $connection->close();  
        return $list; 
    }
    public static function getAllToJson(){
        $jsonArray= array();
        foreach (self::getAll() as $item) {
            array_push($jsonArray, json_decode($item->toJson()));
        }
        return json_encode($jsonArray);
    }
    public function add()
    {
        $query = 'INSERT INTO equipo(nombreEquipo,codEquipo,emailEquipo,idArea) VALUES (?,?,?,?)';
        $connection = MySqlConnection::getConnection();
        $command = $connection->prepare($query);
        $command->bind_param('sssi', $this->nombre, $this->codequipo, $this->email, $this->area);
        $result = $command->execute();
        mysqli_stmt_close($command);
        $connection->close();
        return $result;
    }
    public function put(){
        $query='UPDATE equipo 
        SET nombreEquipo=?,codEquipo=?,emailEquipo=?,idArea= 
        WHERE idEquipo=?';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('sssii', $this->nombre, $this->codequipo, $this->email, $this->area,$this->id);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
}
?>