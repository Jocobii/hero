<?php
header('Access-Control-Allow-Origin:*');
require_once('models/modelodispositivo.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $m = new ModeloDispositivo($_GET['id']);
        echo json_encode(array(
            
            'Modelo' => json_decode($m->toJson())
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
        'Modelos' => json_decode(ModeloDispositivo::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombremodelo'])&& isset($_POST['idmarca'])){
        try{
            $md= new ModeloDispositivo();
            $md->setNombre($_POST['nombremodelo']);
            $md->setMarca($_POST['idmarca']);
                if($md->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'modelo agregado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar el modelo '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid modelo '));
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
    if(isset($_PUT['nombremodelo']) && isset($_PUT['id']) && isset($_PUT['idmarca']) && isset($_PUT['status'])){
        try{
            $md= new ModeloDispositivo();
            $md->setNombre($_PUT['nombremodelo']);
            $md->setMarca($_PUT['idmarca']);
            $md->setStatus($_PUT['status']);
            $md->setId($_PUT['id']);
                if($md->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'modelo actualizado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al actualizar el modelo '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid modelo '));
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