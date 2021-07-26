<?php
require_once('mysqlconnection.php');
require_once('usuario.php');
require_once('sede.php');
require_once('puesto.php');
require_once('equipo.php');

class Colaboradores{
    private $id;
    private $nombre;
    private $apaterno;
    private $apmaterno;
    private $fecha;
    private $email;
    private $estado;
    private $created_at;
    private $updated_at;
    private $sede;
    private $equipo;
    private $numservidor;
    private $puesto;
    private $comodato;
    private $celular;
    private $shortel;

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
    public function getApaterno() {
        return $this->apaterno; 
    }
    public function setApaterno($apaterno) { 
        $this->apaterno = $apaterno; 
    }
    public function getApmaterno() {
        return $this->apmaterno; 
    }
    public function setApmaterno($apmaterno) { 
        $this->apmaterno = $apmaterno; 
    }
    public function getFecha() {
        return $this->fecha; 
    }
    public function setFecha($fecha) { 
        $this->fecha = $fecha; 
    }
    public function getEmail() {
        return $this->email; 
    }
    public function setEmail($email) { 
        $this->email = $email; 
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
    public function getUpdate_at() {
        return $this->update_at; 
    }
    public function setUpdate_at($update_at) { 
        $this->update_at = $update_at; 
    }
    public function getSede() {
        return $this->sede; 
    }
    public function setSede($sede) { 
        $this->sede = $sede; 
    }
    public function getEquipo() {
        return $this->equipo; 
    }
    public function setEquipo($equipo) { 
        $this->equipo = $equipo; 
    }
    public function getNumservidor() {
        return $this->numservidor; 
    }
    public function setNumservidor($numservidor) { 
        $this->numservidor = $numservidor; 
    }
    public function getPuesto() {
        return $this->puesto; 
    }
    public function setPuesto($puesto) { 
        $this->puesto = $puesto; 
    }
    public function getComodato() {
        return $this->comodato; 
    }
    public function setComodato($comodato) { 
        $this->comodato = $comodato; 
    }
    public function getCelular() {
        return $this->celular; 
    }
    public function setCelular($celular) { 
        $this->celular = $celular; 
    }
    public function getShortel() {
        return $this->shortel; 
    }
    public function setShortel($shortel) { 
        $this->shortel = $shortel; 
    }
    public function __construct(){
        if(func_num_args() == 0){
            $this->id='';
            $this->nombre='';
            $this->apaterno="";
            $this->amaterno="";
            $this->fecha="";
            $this->email="";
            $this->estado="";
            $this->created_at="";
            $this->updated_at="";
            $this->sede="";
            $this->equipo="";
            $this->numservidor="";
            $this->puesto="";
            $this->celular="";
            $this->shortel="";
        }
        if(func_num_args() == 1){
            $arguments = func_get_args();
            $query = 'SELECT idColaborador, nombreCol, ApPaternoCol,ApMaterno,numServidor,fechaNacCol,emailCol,linkComodato,estadoCol,created_at,updated_at,idSede,idEquipo,idPuesto,celular,shortel FROM colaborador WHERE idColaborador=?'; 
            $connection= MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('i', $arguments[0]); 
            $command->bind_result($id,$nombre,$apaterno,$apmaterno,$numservidor,$fecha,$email,$comodato,$estado,$created_at,$updated_at,$sede,$equipo,$puesto,$celular,$shortel); 
            $command->execute(); 
            if ($command->fetch()){
                $this->id=$id;
                $this->nombre=$nombre;
                $this->apaterno=$apaterno;
                $this->apmaterno=$apmaterno;
                $this->fecha=$fecha;
                $this->email=$email;
                $this->estado=$estado;
                $this->created_at=$created_at;
                $this->updated_at=$updated_at;
                $this->numservidor=$numservidor;
                $this->sede= new Sede($sede);
                $this->equipo= new Equipo($equipo);
                $this->puesto= new Puesto($puesto);
                $this->comodato= $comodato; 
                $this->celular= $celular; 
                $this->shortel= $shortel; 
            }else{
                throw new RecordNotFoundException($arguments[0]);
            }
            mysqli_stmt_close($command);  
            $connection->close(); 
        }
        if(func_num_args() == 16){
            $arguments = func_get_args();
            $this->id =$arguments[0];
            $this->nombre =$arguments[1];
            $this->apaterno =$arguments[2];
            $this->apmaterno =$arguments[3];
            $this->numservidor =$arguments[4];
            $this->fecha =$arguments[5];
            $this->email =$arguments[6];
            $this->comodato =$arguments[7];
            $this->estado =$arguments[8];
            $this->created_at =$arguments[9];
            $this->update_at =$arguments[10];
            $this->sede =$arguments[11];
            $this->equipo =$arguments[12];
            $this->puesto =$arguments[13];
            $this->celular =$arguments[14];
            $this->shortel =$arguments[15];
        }
    }
    public function toJson(){
        $usuarios = array();
       foreach($this->getUsuarios() as $u){
            array_push($usuarios,json_decode($u->toJson()));
       }
        return json_encode(array(
            'id'=>$this->id,
            'nombre'=>$this->nombre,
            'apellidoPaterno'=>$this->apaterno,
            'apellidoMaterno'=>$this->apmaterno,
            'fecha'=>$this->fecha,
            'email'=>$this->email,
            'celular'=>$this->celular,
            'shortel'=>$this->shortel,
            'estado'=>$this->estado,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'sede'=>json_decode($this->sede->toJson()),
            'equipo'=>json_decode($this->equipo->toJson()),
            'numeroServidor'=>$this->numservidor,
            'comodato'=>$this->comodato,
            'Usuarios'=>$usuarios,
            'tipoColaborador'=>json_decode($this->puesto->toJson())
            
        ));
        
    }
    public function toJsonHeader(){
        return json_encode(array(
            'id'=>$this->id,
            'nombre'=>$this->nombre,
            'apellidoPaterno'=>$this->apaterno,
            'apellidoMaterno'=>$this->apmaterno,
            'email'=>$this->email,
            'equipo'=>json_decode($this->equipo->toJson()),
            'numeroServidor'=>$this->numservidor,
            'tipoColaborador'=>json_decode($this->puesto->toJson()),
        ));
        
    }
    public static function getAll(){
        $list = array(); 
        $query = 'SELECT idColaborador, nombreCol, ApPaternoCol,ApMaterno,numServidor,fechaNacCol,emailCol,linkComodato,estadoCol,created_at,updated_at,idSede,idEquipo,idPuesto,celular,shortel FROM colaborador';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);    
        $command->bind_result($id,$nombre,$apaterno,$apmaterno,$numservidor,$fecha,$email,$comodato,$estado,$created_at,$updated_at,$sede,$equipo,$puesto,$celular,$shortel);
        $command->execute(); 
        while ($command->fetch()){ 
           array_push($list,new Colaboradores($id,$nombre,$apaterno,$apmaterno,$numservidor,$fecha,$email,$comodato,$estado,$created_at,$updated_at,new Sede($sede),new Equipo($equipo),new Puesto($puesto),$celular,$shortel));
        }
        mysqli_stmt_close($command);  
        $connection->close(); 
        return $list; 
    }
    public static function getAllToJson(){
        $jsonArray= array();
        foreach (self::getAll() as $item) {
            array_push($jsonArray, json_decode($item->toJsonHeader()));
        }
        return json_encode($jsonArray);
    }
    public function getUsuarios(){
        $list = array();
        $query = 'SELECT idUsuario,nombreUsuario,passwordUsuario,idTipoUsuario FROM usuario WHERE idColaborador=?';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query);
        $command->bind_param('i', $this->id);
        $command->bind_result($id,$nombre,$password,$tipousuario);
        $command->execute(); 
        while ($command->fetch()){ 
            array_push($list, new Usuario($id,$nombre,$password,new TipoUsuario($tipousuario)));
        }  
        mysqli_stmt_close($command);  
        $connection->close(); 
        return $list;
    }
    public function add(){
        $query='INSERT INTO colaborador(nombreCol, ApPaternoCol, ApMaterno,numServidor, fechaNacCol, emailCol, linkComodato, idSede, idEquipo,idPuesto,celular,shortel) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('sssssssiiiss', $this->nombre, $this->apaterno,$this->apmaterno,$this->numservidor,$this->fecha,$this->email,$this->comodato,$this->sede,$this->equipo,$this->puesto,$this->celular,$this->shortel);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
    public function put(){
        $query='UPDATE colaborador 
        SET   nombreCol=?, ApPaternoCol=?, ApMaterno=?, numServidor=?, emailCol=?, linkComodato=?, estadoCol=?, idSede=?, idEquipo=?, idPuesto=? ,celular=?,shortel=?
        WHERE idColaborador=?';
        $connection= MySqlConnection::getConnection();
        $command = $connection->prepare($query); 
        $command->bind_param('ssssssiiiissi',$this->nombre,$this->apaterno,$this->apmaterno,$this->numservidor,$this->email,$this->comodato,$this->estado,$this->sede,$this->equipo,$this->puesto,$this->celular,$this->shortel,$this->id);
        $result=$command->execute(); 
        mysqli_stmt_close($command);  
        $connection->close();  
        return $result; 
    }
}
