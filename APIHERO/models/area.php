<?php
require_once('mysqlconnection.php');
require_once('departamento.php');
class Area{
    private $id;
    private $area;
    private $departamento;
    public function getId() {
        return $this->id; 
    }
    public function setId($id) { 
        $this->id = $id; 
    }
    public function getArea() {
        return $this->area; 
    }
    public function setArea(){
        $this->area=$area;
    }
    public function getDepartamento() {
        return $this->departamento; 
    }
    public function setDepartamento(){
        $this->departamento=$departamento;
    }
    public function __construct(){
        if(func_num_args() == 0){
            $this->id='';
            $this->area='';
            $this->departamento="";
        }
        if(func_num_args() == 1){
            $arguments = func_get_args();
            $query = 'SELECT idArea, nombreArea, idDepartamento FROM area WHERE idArea=?'; 
            $connection= MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('s', $arguments[0]); 
            $command->bind_result($id,$area,$departamento); 
            $command->execute(); 
            if ($command->fetch()){
                $this->id=$id;
                $this->area=$area;
                $this->departamento=new Departamento($departamento);
            }else{
                throw new RecordNotFoundException($arguments[0]);
            }
             mysqli_stmt_close($command);  
            $connection->close(); 
        }
        if(func_num_args() == 3){
            $arguments = func_get_args();
            $this->id =$arguments[0];
            $this->area =$arguments[1];
            $this->departamento =$arguments[2];
        }
    }
    public function toJson(){
        return json_encode(array(
            'id'=>$this->id,
            'area'=>$this->area,
            'departamento'=>json_decode($this->departamento->toJson())
        ));
    }
    public static function getAll(){
        $list = array(); 
        $query = 'SELECT idArea, nombreArea, idDepartamento FROM area';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);    
        $command->bind_result($id,$nombre,$departamento);
        $command->execute();
        while ($command->fetch()){ 
           array_push($list,new Area($id,$nombre,new Departamento($departamento)));
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