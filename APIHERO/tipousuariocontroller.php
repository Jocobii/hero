<?php
require_once('models/tipousuario.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $t = new TipoUsuario($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'tipoUsuario' => json_decode($t->toJson())
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
        'tipoUsuario' => json_decode(TipoUsuario::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombre'])){
        try{
            $tu= new TipoUsuario();
            $tu->setNombre($_POST['nombre']);
                if($tu->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Tipo de usuario agregado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar al tipo de usuario '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid Contact '));
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
            $tu= new TipoUsuario();
            $tu->setNombre($_PUT['nombre']);
            $tu->setId($_PUT['id']);
                if($tu->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Tipo de usuario actualizado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al actualizar el tipo de usuario '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid Contact '));
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