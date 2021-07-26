<?php
header('Access-Control-Allow-Origin:*');
require_once('models/tipomovimiento.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $t = new TipoMovimiento($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            ' Tipo de movimiento' => json_decode($t->toJson())
        ));
    }
    catch(RecordNotFoundException $ex){
        echo json_encode(array(
            'status' => 1,
            'errorMessage' => 'error'
        ));
    }
 
}else{
    echo json_encode(array(
        'status' => 0,
        'Tipos de movimiento ' => json_decode(TipoMovimiento::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombre'])){
        try{
            $tu= new TipoMovimiento();
            $tu->setNombre($_POST['nombre']);
                if($tu->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Tipo de Movimiento agregado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar al tipo de Movimiento '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid tipo movimiento '));
           }    
    }else{
        echo json_encode(array(
            'status'=>999,
            'error Menssage'=>'Missing parameters'
        ));
    }

}
if($_SERVER['REQUEST_METHOD']=='PUT'){
    $_PUT = json_decode(file_get_contents("php://input"), true);
    if(isset($_PUT['nombre']) && isset($_PUT['id'])){
        try{
            $tu= new TipoMovimiento();
            $tu->setNombre($_PUT['nombre']);
            $tu->setId($_PUT['id']);
                if($tu->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Tipo de Movimiento actualizado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al actualizar al tipo de Movimiento '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid tipo movimiento '));
           }    
    }else{
        echo json_encode(array(
            'status'=>999,
            'error Menssage'=>'Missing parameters'
        ));
    }
}

if($_SERVER['REQUEST_METHOD']=='DELETE'){

    echo 'delete';
}
?>