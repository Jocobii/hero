<?php
require_once('mysqlconnection.php');
require_once('tipodispositivo.php');
require_once('modelodispositivo.php');
class Dispositivos{
    private $id;
    private $descripcion;
    private $serie;
    private $procesador;
    private $memoria;
    private $almacenamiento;
    private $resolucion;
    private $puertosvideo;
    private $tipo;
    private $modelo;
    private $estado;
    public function getId() {
        return $this->id; 
    }
    public function setId($id) { 
        $this->id = $id; 
    }
    public function getDescripcion() {
        return $this->descripcion; 
    }
    public function setDescripcion($descripcion){
        $this->descripcion=$descripcion;
    }
    public function getSerie() {
        return $this->serie; 
    }
    public function setSerie($serie){
        $this->serie=$serie;
    }
    public function getProcesador() {
        return $this->procesador; 
    }
    public function setProcesador($procesador){
        $this->procesador=$procesador;
    }
    public function getMemoria() {
        return $this->memoria; 
    }
    public function setMemoria($memoria){
        $this->memoria=$memoria;
    }
    public function getAlacenamiento() {
        return $this->almacenamiento; 
    }
    public function setAlmacenamiento($almacenamiento){
        $this->almacenamiento=$almacenamiento;
    }
    public function getResolucion() {
        return $this->resolucion; 
    }
    public function setResolucion($resolucion){
        $this->resolucion=$resolucion;
    }
    public function getPuertosVideo() {
        return $this->puertosvideo; 
    }
    public function setPuertosVideo($puertosvideo){
        $this->puertosvideo=$puertosvideo;
    }
    public function getTipo() {
        return $this->tipo; 
    }
    public function setTipo($tipo){
        $this->tipo=$tipo;
    }
    public function getModelo() {
        return $this->modelo; 
    }
    public function setModelo($modelo){
        $this->modelo=$modelo;
    }
    public function getEstado() {
        return $this->estado; 
    }
    public function setEstado($estado){
        $this->estado=$estado;
    }
    public function __construct(){
        if(func_num_args() == 0){
            $this->id='';
            $this->descripcion='';
            $this->serie="";
            $this->procesador="";
            $this->memoria="";
            $this->almacenamiento="";
            $this->resolucion="";
            $this->puertosvideo="";
            $this->tipo="";
            $this->modelo="";
            $this->estado="";
        }
        if(func_num_args() == 1){
            $arguments = func_get_args();
            $query = 'SELECT idDispositivo,descripcionDispositivo,serieDispositivo,procesadorDisposito,memoriaDispositivo,almacenamientoDispositivo,resolucionDispositivo,puertosVideo,tipoDispositivo,modeloDispositivo,estadoFisico FROM dispositivo WHERE idDispositivo=?'; 
            $connection= MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('s', $arguments[0]); 
            $command->bind_result($id,$descripcion,$serie,$procesador,$memoria,$almacenamiento,$resolucion,$puertosvideo,$tipo,$modelo,$estado); 
            $command->execute(); 
            if ($command->fetch()){
                $this->id=$id;
                $this->descripcion=$descripcion;
                $this->serie=$serie;
                $this->procesador=$procesador;
                $this->memoria=$memoria;
                $this->almacenamiento=$almacenamiento;
                $this->resolucion=$resolucion;
                $this->puertosvideo=$puertosvideo;
                $this->tipo=new TipoDispositivo($tipo);
                $this->modelo=new ModeloDispositivo($modelo);
                $this->estado=$estado;
            }else{
                throw new RecordNotFoundException($arguments[0]);
            }
             mysqli_stmt_close($command);  
            $connection->close(); 
        }
        if(func_num_args() == 11){
            $arguments = func_get_args();
            $this->id =$arguments[0];
            $this->descripcion=$arguments[1];
            $this->serie=$arguments[2];
            $this->procesador=$arguments[3];
            $this->memoria=$arguments[4];
            $this->almacenamiento=$arguments[5];
            $this->resolucion=$arguments[6];
            $this->puertosvideo=$arguments[7];
            $this->tipo=$arguments[8];
            $this->modelo=$arguments[9];
            $this->estado=$arguments[10];
        }
    }
    public function toJson(){
        return json_encode(array(
            'id'=>$this->id,
            'descripcion'=>$this->descripcion,
            'serie'=>$this->serie,
            'procesador'=>$this->procesador,
            'memoria'=>$this->memoria,
            'almacenamiento'=>$this->almacenamiento,
            'resolucion'=>$this->resolucion,
            'puertosvideo'=>$this->puertosvideo,
            'tipodispositivo'=>json_decode($this->tipo->toJson()),
            'modelodespositivo'=>json_decode($this->modelo->toJson()),
            'estadodispositivo'=>$this->estado
        ));
    }
    public static function getAll(){
        $list = array(); 
        $query = 'SELECT idDispositivo,descripcionDispositivo,serieDispositivo,procesadorDisposito,memoriaDispositivo,almacenamientoDispositivo,resolucionDispositivo,puertosVideo,tipoDispositivo,modeloDispositivo,estadoFisico FROM dispositivo';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);    
        $command->bind_result($id,$descripcion,$serie,$procesador,$memoria,$almacenamiento,$resolucion,$puertosvideo,$tipo,$modelo,$estado);
        $command->execute();
        while ($command->fetch()){ 
           array_push($list,new Dispositivos($id,$descripcion,$serie,$procesador,$memoria,$almacenamiento,$resolucion,$puertosvideo,new TipoDispositivo($tipo),new ModeloDispositivo($modelo),$estado));
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
        $query='INSERT INTO dispositivo(descripcionDispositivo,serieDispositivo,procesadorDisposito,memoriaDispositivo,almacenamientoDispositivo,resolucionDispositivo,puertosVideo, tipoDispositivo,modeloDispositivo,estadoFisico) VALUES (?,?,?,?,?,?,?,?,?,?);';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('sssssssiis', $this->descripcion,$this->serie,$this->procesador,$this->memoria,$this->almacenamiento,$this->resolucion,$this->puertosvideo,$this->tipo,$this->modelo,$this->estado);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
    public function put(){
        $query='UPDATE dispositivo 
        SET descripcionDispositivo=?,serieDispositivo=?,procesadorDisposito=?,memoriaDispositivo=?,almacenamientoDispositivo=?,resolucionDispositivo=?,puertosVideo=?,tipoDispositivo=?,modeloDispositivo=?,estadoFisico=? 
        WHERE idDispositivo=?';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('sssssssiisi', $this->descripcion,$this->serie,$this->procesador,$this->memoria,$this->almacenamiento,$this->resolucion,$this->puertosvideo,$this->tipo,$this->modelo,$this->estado,$this->id);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
}
?>