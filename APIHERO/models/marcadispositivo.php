<?php
require_once('mysqlconnection.php');
class MarcaDispositivo{
    private $id;
    private $nombre;
    private $status;
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
    public function getStatus() {
        return $this->status; 
    }
    public function setStatus($status){
        $this->status=$status;
    }
    public function __construct(){
        if(func_num_args() == 0){
            $this->id='';
            $this->nombre='';
            $this->status='';
        }
        if(func_num_args() == 1){
            $arguments = func_get_args();
            $query = 'SELECT idMarca,nombreMarca,statusMarca FROM marca WHERE idMarca=?'; 
            $connection= MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('i', $arguments[0]); 
            $command->bind_result($id,$nombre,$status); 
            $command->execute(); 
            if ($command->fetch()){
                $this->id=$id;
                $this->nombre=$nombre;
                $this->status=$status;
            }else{
                throw new RecordNotFoundException($arguments[0]);
            }
             mysqli_stmt_close($command);  
            $connection->close(); 
        }
        if(func_num_args() == 3){
            $arguments = func_get_args();
            $this->id =$arguments[0];
            $this->nombre =$arguments[1];
            $this->status =$arguments[2];
        }
    }
    public function toJson(){
        return json_encode(array(
            'id'=>$this->id,
            'Nombre'=>$this->nombre,
            'status'=>$this->status
        ));
    }
    public static function getAll(){
        $list = array(); //create list
        $query = 'SELECT idMarca,nombreMarca,statusMarca FROM marca WHERE statusMarca = 1';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);    
        $command->bind_result($id,$nombre,$status);//bind result
        $command->execute(); //execute query
        //read result
 
        while ($command->fetch()){ //fetch es ir y traer
           //populate list
           array_push($list,new MarcaDispositivo($id,$nombre,$status) );
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
        $query='INSERT INTO marca(nombreMarca) VALUES (?);';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('s', $this->nombre);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
    public function put(){
        $query='UPDATE marca 
        SET nombreMarca=?,statusMarca=?
        WHERE idMarca=?';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('sii',$this->nombre,$this->status,$this->id);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
}
?>