<?php
require_once('mysqlconnection.php');
require_once('colaboradores.php');
require_once('recurso.php');
require_once('tipomovimiento.php');
class RecursoMovimiento{
    private $id;
    private $recurso;
    private $colaboradorant;
    private $colaboradoractu;
    private $fecha;
    private $usuariogestion;
    private $tipo;
    private $motivo;
    private $nota;
    public function getId() {
        return $this->id; 
    }
    public function setId($id) { 
        $this->id = $id; 
    }
    public function getRecurso() {
        return $this->recurso; 
    }
    public function setRecurso($recurso){
        $this->recurso=$recurso;
    }
    public function getColaboradorAnt() {
        return $this->colaboradorant; 
    }
    public function setColaboradorAnt($colaboradorant){
        $this->colaboradorant=$colaboradorant;
    }
    public function getColaboradorActu() {
        return $this->colaboradoractu; 
    }
    public function setColaboradorActu($colaboradoractu){
        $this->colaboradoractu=$colaboradoractu;
    }
    public function getFecha() {
        return $this->fecha; 
    }
    public function setFecha($fecha){
        $this->fecha=$fecha;
    }
    public function getUsuarioGestion() {
        return $this->usuariogestion; 
    }
    public function setUsuarioGestion($usuariogestion){
        $this->usuariogestion=$usuariogestion;
    }
    public function getTipo() {
        return $this->tipo; 
    }
    public function setTipo($tipo){
        $this->tipo=$tipo;
    }
    public function getMotivo() {
        return $this->motivo; 
    }
    public function setMotivo($motivo){
        $this->motivo=$motivo;
    }
    public function getNota() {
        return $this->nota; 
    }
    public function setNota($nota){
        $this->nota=$nota;
    }
    public function __construct(){
        if(func_num_args() == 0){
            $this->id='';
            $this->recurso='';
            $this->colaboradorant='';
            $this->colaboradoractu="";
            $this->fecha='';
            $this->usuariogestion='';
            $this->tipo="";
            $this->motivo='';
            $this->nota='';
        }
        if(func_num_args() == 1){
            $arguments = func_get_args();
            $query = 'SELECT idRecursoMovimiento, idRecurso, idColaboradorAnterior, idColaboradorCambio, recursoMovimientoFecha, idUsuarioGestion, idTipoMovimiento, motivoRecusoMovimiento, notaRecusoMovimiento FROM recursomovimiento WHERE idRecursoMovimiento=?'; 
            $connection= MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('i', $arguments[0]); 
            $command->bind_result($id,$recurso,$colaboradorant,$colaboradoractu,$fecha,$usuariogestion,$tipo,$motivo,$nota); 
            $command->execute(); 
            if ($command->fetch()){
                $this->id=$id;
                $this->recurso=new Recurso($recurso);
                $this->colaboradorant=new Colaboradores($colaboradorant);
                $this->colaboradoractu=new Colaboradores($colaboradoractu);
                $this->fecha=$fecha;
                $this->usuariogestion=new Colaboradores($usuariogestion);
                $this->tipo=new TipoMovimiento($tipo);
                $this->motivo=$motivo;
                $this->nota=$nota;
            }else{
                throw new RecordNotFoundException($arguments[0]);
            }
             mysqli_stmt_close($command);  
            $connection->close(); 
        }
        if(func_num_args() == 9){
            $arguments = func_get_args();
            $this->id =$arguments[0];
            $this->recurso=$arguments[1];
            $this->colaboradorant=$arguments[2];
            $this->colaboradoractu=$arguments[3];
            $this->fecha=$arguments[4];
            $this->usuariogestion=$arguments[5];
            $this->tipo=$arguments[6];
            $this->motivo=$arguments[7];
            $this->nota=$arguments[8];
        }
    }
    public function toJson(){
        return json_encode(array(
            'id'=>$this->id,
            'recurso'=>json_decode($this->recurso->toJsonHeader()),
            'ColaboradorAnterior'=>json_decode($this->colaboradorant->toJson()),
            'ColaboradorActual'=>json_decode($this->colaboradoractu->toJson()),
            'Fecha'=>$this->fecha,
            'Usuario Gestion'=>json_decode($this->usuariogestion->toJson()),
            'tipo'=>json_decode($this->tipo->toJson()),
            'motivo'=>$this->motivo,
            'nota '=>$this->nota
        ));
    }
    public static function getAll(){
        $list = array(); 
        $query = 'SELECT idRecursoMovimiento, idRecurso, idColaboradorAnterior, idColaboradorCambio, recursoMovimientoFecha, idUsuarioGestion, idTipoMovimiento, motivoRecusoMovimiento, notaRecusoMovimiento FROM recursomovimiento';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);    
        $command->bind_result($id,$recurso,$colaboradorant,$colaboradoractu,$fecha,$usuariogestion,$tipo,$motivo,$nota);
        $command->execute();
        while ($command->fetch()){ 
           array_push($list,new RecursoMovimiento($id,new Recurso($recurso),new Colaboradores($colaboradorant),new Colaboradores($colaboradoractu),$fecha,new Colaboradores($usuariogestion),new TipoMovimiento($tipo),$motivo,$nota));
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
        $query='INSERT INTO recursomovimiento(idRecurso,idColaboradorAnterior,idColaboradorCambio, idUsuarioGestion, idTipoMovimiento, motivoRecusoMovimiento, notaRecusoMovimiento) VALUES (?,?,?,?,?,?,?);';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('iiiiiss', $this->recurso, $this->colaboradorant, $this->colaboradoractu, $this->usuariogestion, $this->tipo, $this->motivo, $this->nota);
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