<?php
header('Access-Control-Allow-Origin:*');
require_once('models/tipodispositivo.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $t = new TipoDispositivo($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'tipoDispositivo' => json_decode($t->toJson())
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
        'tiposDispositivo' => json_decode(TipoDispositivo::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombre'])){
        try{
            $td= new TipoDispositivo();
            $td->setNombre($_POST['nombre']);
                if($td->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Tipo de dispositivo agregado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar al tipo de dispositivo '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid tipo dispositivo '));
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
            $td= new TipoDispositivo();
            $td->setNombre($_PUT['nombre']);
            $td->setId($_PUT['id']);
                if($td->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Tipo de dispositivo actualizado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al actualizar al tipo de dispositivo '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid tipo dispositivo '));
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