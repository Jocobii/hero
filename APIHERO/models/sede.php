<?php
require_once('mysqlconnection.php');
class Sede{
    private $id;
    private $codsede;
    private $nombre;
    private $calle;
    private $numexterior;
    private $numinterior;
    private $colonia;
    private $codpostal;
    private $ciudad;
    private $estadosede;
    private $pais;
    private $telefono;
    private $estado;
    private $created_at;
    private $updated_at;
    public function getId() {
        return $this->id; 
    }
    public function setId($id) { 
        $this->id = $id; 
    }
    public function getCodSede() {
        return $this->codsede; 
    }
    public function setCodSede($codsede) { 
        $this->codsede = $codsede; 
    }
    public function getNombre() {
        return $this->nombre; 
    }
    public function setNombre($nombre) { 
        $this->nombre = $nombre; 
    }
    public function getCalle() {
        return $this->calle; 
    }
    public function setCalle($calle) { 
        $this->calle = $calle; 
    }
    public function getNumExterior() {
        return $this->numexterior; 
    }
    public function setNumExterior($numexterior) { 
        $this->numexterior = $numexterior; 
    }
    public function getNumInterior() {
        return $this->numinterior; 
    }
    public function setNumInterior($numinterior) { 
        $this->numinterior = $numinterior; 
    }
    public function getColonia() {
        return $this->colonia; 
    }
    public function setColonia($colonia) { 
        $this->colonia = $colonia; 
    }
    public function getCodPostal() {
        return $this->codpostal; 
    }
    public function setCodPostal($codpostal) { 
        $this->codpostal = $codpostal; 
    }
    public function getCiudad() {
        return $this->ciudad; 
    }
    public function setCiudad($ciudad) { 
        $this->ciudad = $ciudad; 
    }
    public function getEstadoSede() {
        return $this->estadosede; 
    }
    public function setEstadoSede($estadosede) { 
        $this->estadosede = $estadosede; 
    }
    public function getPais() {
        return $this->pais; 
    }
    public function setPais($pais) { 
        $this->pais = $pais; 
    }
    public function getTelefono() {
        return $this->telefono; 
    }
    public function setTelefono($telefono) { 
        $this->telefono = $telefono; 
    }
    public function getEstado() {
        return $this->estado; 
    }
    public function setEstado($estado) { 
        $this->estado = $estado; 
    }
    public function getCreated_at() {
        return $this->created_at; 
    }
    public function setCreated_at($created_at) { 
        $this->created_at = $created_at; 
    }
    public function getUpdated_at() {
        return $this->updated_at; 
    }
    public function setUpdated_at($updated_at) { 
        $this->updated_at = $updated_at; 
    }
    
    public function __construct(){
        if(func_num_args() == 0){
            $this->id='';
            $this->codsede='';
            $this->nombre='';
            $this->calle='';
            $this->numexterior='';
            $this->numinterior='';
            $this->colonia='';
            $this->codpostal='';
            $this->ciudad='';
            $this->estadosede='';
            $this->pais='';
            $this->telefono='';
            $this->estado='';
            $this->created_at='';
            $this->updated_at='';
        }
        if(func_num_args() == 1){
            $arguments = func_get_args();
            $query = 'SELECT idSede,codSede,nombreSede,calleSede,numeroExtSede,numeroIntSede,coloniaSede,codPostalSede,ciudadSede,estadoSede,paisSede,telefonoSede,estado,created_at,updated_at FROM `sede` WHERE idSede=?'; 
            $connection= MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('s', $arguments[0]); 
            $command->bind_result($id,$codsede,$nombre,$calle,$numexterior,$numinterior,$colonia,$codpostal,$ciudad,$estadosede,$pais,$telefono,$estado,$created_at,$updated_at); 
            $command->execute(); 
            
            if ($command->fetch()){ 
                $this->id = $id;
                $this->codsede = $codsede;
                $this->nombre = $nombre;
                $this->calle = $calle;
                $this->numexterior = $numexterior;
                $this->numinterior = $numinterior;
                $this->colonia = $colonia;
                $this->codpostal = $codpostal;
                $this->ciudad = $ciudad;
                $this->estadosede =$estadosede;
                $this->pais = $pais;
                $this->telefono = $telefono;
                $this->estado = $estado;
                $this->created_at = $created_at;
                $this->updated_at = $updated_at;
            }else{
                throw new RecordNotFoundException($arguments[0]);
            }
             mysqli_stmt_close($command); 
            $connection->close();  
        }
        if(func_num_args() == 15){

            $arguments = func_get_args();
            $this->id =$arguments[0];
            $this->codsede = $arguments[1];
            $this->nombre = $arguments[2];
            $this->calle = $arguments[3];
            $this->numexterior = $arguments[4];
            $this->numinterior = $arguments[5];
            $this->colonia = $arguments[6];
            $this->codpostal = $arguments[7];
            $this->ciudad = $arguments[8];
            $this->estadosede =$arguments[9];
            $this->pais = $arguments[10];
            $this->telefono = $arguments[11];
            $this->estado = $arguments[12];
            $this->created_at = $arguments[13];
            $this->updated_at = $arguments[14];
        }
    }
    public function toJson(){
        return json_encode(array(
            'id'=>$this->id,
            'CodSede'=>$this->codsede,
            'Nombre'=>$this->nombre,
            'Calle'=>$this->calle,
            'NumExterior'=>$this->numexterior,
            'NumInterior'=>$this->numinterior,
            'Colonia'=>$this->colonia,
            'CodPostal'=>$this->codpostal,
            'Ciudad'=>$this->ciudad,
            'EstadoSede'=>$this->estadosede,
            'Pais'=>$this->pais,
            'Telefono'=>$this->telefono,
            'Estado'=>$this->estado,
            'Created_at'=>$this->created_at,
            'Updated_at'=>$this->updated_at
        ));
    }
    public static function getAll(){
        $list = array(); 
        $query = 'SELECT idSede,codSede,nombreSede,calleSede,numeroExtSede,numeroIntSede,coloniaSede,codPostalSede,ciudadSede,estadoSede,paisSede,telefonoSede,estado,created_at,updated_at FROM sede';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);    
        $command->bind_result($id,$codsede,$nombre,$calle,$numexterior,$numinterior,$colonia,$codpostal,$ciudad,$estadosede,$pais,$telefono,$estado,$created_at,$updated_at);
        $command->execute();
        while ($command->fetch()){ 
           array_push($list,new Sede($id,$codsede,$nombre,$calle,$numexterior,$numinterior,$colonia,$codpostal,$ciudad,$estadosede,$pais,$telefono,$estado,$created_at,$updated_at));
        }
        //mysqli_stmt_close($command);  
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
        $query='INSERT INTO sede(codSede,nombreSede,calleSede,numeroExtSede,numeroIntSede,coloniaSede,codPostalSede,ciudadSede,estadoSede,paisSede,telefonoSede) VALUES (?,?,?,?,?,?,?,?,?,?,?);';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('sssssssssss', $this->codsede, $this->nombre, $this->calle, $this->numexterior, $this->numinterior, $this->colonia, $this->codpostal, $this->ciudad, $this->estadosede, $this->pais, $this->telefono);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close(); 
        return $result; 
    }
    public function put(){
        $query='UPDATE sede 
        SET codSede=?,nombreSede=?,calleSede=?,numeroExtSede=?,numeroIntSede=?,coloniaSede=?,codPostalSede=?,ciudadSede=?,estadoSede=?,paisSede=?,telefonoSede=?,estado=?
        WHERE idSede=?';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('ssssssssssssi',$this->codsede, $this->nombre, $this->calle, $this->numexterior, $this->numinterior, $this->colonia, $this->codpostal, $this->ciudad, $this->estadosede, $this->pais, $this->telefono,$this->estado,$this->id);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
}
?>
