<?php
require_once('mysqlconnection.php');
class TipoColaborador{
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
    public function setNombre($nombre) { 
        $this->nombre = $nombre; 
    }
    public function __construct(){
        if(func_num_args() == 0){
            $this->id='';
            $this->nombre='';
        }
        if(func_num_args() == 1){
            $arguments = func_get_args();//read arguments
            $query = ' '; //query
            $connection= MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('s', $arguments[0]); 
            $command->bind_result($id,$nombre); 
            $command->execute(); 
            
            if ($command->fetch()){ 
            $this->id = $id;
            $this->nombre = $nombre;
             
            }else{
                throw new RecordNotFoundException($arguments[0]);
            }
             mysqli_stmt_close($command);  //close statament
            $connection->close();  //close connection
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
            'tipocolaborador'=>$this->nombre
          ));
    }
    public static function getAll(){
        $list = array(); 
        $query = '';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);    
        $command->bind_result($id,$nombre);
        $command->execute();
        while ($command->fetch()){ 
           array_push($list,new TipoColaborador($id,$nombre));
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
}
?>