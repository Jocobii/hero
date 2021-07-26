<?php
require_once('mysqlconnection.php');
require_once('sede.php');
require_once('colaboradores.php');
require_once('dispositivo.php');
class Inventario
{
    private $id;
    private $codservicio;
    private $precio;
    private $status;
    private $created_at;
    private $stock;
    private $colaboradora;
    private $usuariogestion;
    private $sede;
    private $dispositivo;
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getCodServicio()
    {
        return $this->codservicio;
    }
    public function setCodServicio($codservicio)
    {
        $this->codservicio = $codservicio;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function getCreated_at()
    {
        return $this->created_at;
    }
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    public function getStock()
    {
        return $this->stock;
    }
    public function setStock($stock)
    {
        $this->stock = $stock;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getColaboradorA()
    {
        return $this->colaboradora;
    }
    public function setColaboradorA($colaboradora)
    {
        $this->colaboradora = $colaboradora;
    }
    public function getUsuarioGestion()
    {
        return $this->usuariogestion;
    }
    public function setUsuarioGestion($usuariogestion)
    {
        $this->usuariogestion = $usuariogestion;
    }
    public function getSede()
    {
        return $this->sede;
    }
    public function setSede($sede)
    {
        $this->sede = $sede;
    }
    public function getDispositivo()
    {
        return $this->dispositivo;
    }
    public function setDispositivo($dispositivo)
    {
        $this->dispositivo = $dispositivo;
    }
    public function __construct()
    {
        if (func_num_args() == 0) {
            $this->id = '';
            $this->codservicio = '';
            $this->precio = '';
            $this->status = "";
            $this->created_at = '';
            $this->stock = '';
            $this->colaboradora = '';
            $this->usuariogestion = '';
            $this->sede = "";
            $this->dispositivo = '';
        }
        if (func_num_args() == 1) {
            $arguments = func_get_args();
            $query = 'SELECT idRecurso, codigoServicioRecurso, precioRecurso, fechaRegistroRecurso, stockRecurso, estadoRecurso, idSede, idDispositivoR FROM recurso WHERE idRecurso=?';
            $connection = MySqlConnection::getConnection();
            $command = $connection->prepare($query);
            $command->bind_param('s', $arguments[0]);
            $command->bind_result($id, $codservicio, $precio, $created_at, $stock, $status, $sede, $dispositivo);
            $command->execute();
            if ($command->fetch()) {
                $this->id = $id;
                $this->codservicio = $codservicio;
                $this->precio = $precio;
                $this->status = $status;
                $this->created_at = $created_at;
                $this->stock = $stock;
                $this->sede = new Sede($sede);
                $this->dispositivo = new Dispositivos($dispositivo);
            } else {
                throw new RecordNotFoundException($arguments[0]);
            }
            mysqli_stmt_close($command);
            $connection->close();
        }
        if (func_num_args() == 8) {
            $arguments = func_get_args();
            $this->id = $arguments[0];
            $this->codservicio = $arguments[1];
            $this->precio = $arguments[2];
            $this->created_at = $arguments[3];
            $this->stock = $arguments[4];
            $this->status = $arguments[5];
            $this->sede = $arguments[6];
            $this->dispositivo = $arguments[7];
        }
    }
    public function toJson()
    {
        return json_encode(array(
            'id' => $this->id,
            'codservicio' => $this->codservicio,
            'precio' => $this->precio,
            'estado' => $this->status,
            'created_at' => $this->created_at,
            'stock' => $this->stock,
            'sede' => json_decode($this->sede->toJson()),
            'dispositivo' => json_decode($this->dispositivo->toJson())
        ));
    }
    public function toJsonHeader()
    {
        return json_encode(array(
            'id' => $this->id,
            'codservicio' => $this->codservicio,
            'precio' => $this->precio,
            'estado' => $this->status,
            'created_at' => $this->created_at,
            'stock' => $this->stock,
            'sede' => json_decode($this->sede->toJson()),
            'dispositivo' => json_decode($this->dispositivo->toJson())
        ));
    }
    public static function getAll()
    {
        $list = array();
        $query = 'SELECT idRecurso, codigoServicioRecurso, precioRecurso, fechaRegistroRecurso, stockRecurso, estadoRecurso,  idSede, idDispositivoR FROM recurso WHERE stockRecurso=0';
        $connection = MySqlConnection::getConnection();
        $command = $connection->prepare($query);
        $command->bind_result($id, $codservicio, $precio, $created_at, $stock, $estado, $sede, $dispositivo);
        $command->execute();
        while ($command->fetch()) {
            array_push($list, new Inventario($id, $codservicio, $precio, $created_at, $stock, $estado, new Sede($sede), new Dispositivos($dispositivo)));
        }
        mysqli_stmt_close($command);
        $connection->close();
        return $list;
    }
    public static function getAllToJson()
    {
        $jsonArray = array();
        foreach (self::getAll() as $item) {
            array_push($jsonArray, json_decode($item->toJsonHeader()));
        }
        return json_encode($jsonArray);
    }
    public function Desligar(){
        $query='UPDATE recurso 
        SET stockRecurso=1, idColaboradorActual=NULL, idUsuarioGestion=?
        WHERE idRecurso=? ';
        $connection = MySqlConnection::getConnection();
        $command = $connection->prepare($query);
        $command->bind_param('ii', $this->usuariogestion, $this->id);
        $result = $command->execute();
        mysqli_stmt_close($command);
        $connection->close();
        return $result;
    }
    
}
