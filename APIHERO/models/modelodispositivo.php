<?php
require_once('mysqlconnection.php');
require_once('models/marcadispositivo.php');
class ModeloDispositivo{
    private $id;
    private $nombre;
    private $marca;
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
    public function getMarca() {
        return $this->marca; 
    }
    public function setMarca($marca){
        $this->marca=$marca;
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
            $this->marca='';
            $this->status='';
        }
        if(func_num_args() == 1){
            $arguments = func_get_args();
            $query = 'SELECT idModelo,nombreModelo,idMarca,status FROM modelo WHERE idModelo=?'; 
            $connection= MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('s', $arguments[0]); 
            $command->bind_result($id,$nombre,$marca,$status); 
            $command->execute(); 
            if ($command->fetch()){
                $this->id=$id;
                $this->nombre=$nombre;
                $this->marca=new MarcaDispositivo($marca);
                $this->status=$status;
            }else{
                throw new RecordNotFoundException($arguments[0]);
            }
             mysqli_stmt_close($command);  
            $connection->close(); 
        }
        if(func_num_args() == 4){
            $arguments = func_get_args();
            $this->id =$arguments[0];
            $this->nombre =$arguments[1];
            $this->marca =$arguments[2];
            $this->status =$arguments[3];
        }
    }
    public function toJson(){
        return json_encode(array(
            'id'=>$this->id,
            'modelo'=>$this->nombre,
            'marca'=>json_decode($this->marca->toJson()),
            'status'=>$this->status
        ));
    }
    public static function getAll(){
        $list = array(); 
        $query = 'SELECT idModelo,nombreModelo,idMarca,status FROM modelo WHERE status = 1';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);    
        $command->bind_result($id,$nombre,$marca,$status);
        $command->execute(); 
        while ($command->fetch()){ 
           array_push($list,new ModeloDispositivo($id,$nombre,new MarcaDispositivo($marca),$status));
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
    public function add(){
        $query='INSERT INTO modelo( nombreModelo,idMarca) VALUES (?,?);';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('si', $this->nombre,$this->marca);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
    public function put(){
        $query='UPDATE modelo 
        SET nombreModelo=?, idMarca=? , status=?
        WHERE idModelo=?';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('siii',$this->nombre,$this->marca,$this->status,$this->id);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
}
?>