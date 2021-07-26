<?php
header('Access-Control-Allow-Origin:*');
require_once('models/usuario.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $u = new Usuario($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'usuario' => json_decode($u->toJson())
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
        'usuarios' => json_decode(Usuario::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombreusuario'])&& isset($_POST['password']) && isset($_POST['colaborador']) && isset($_POST['tipo'])){
        try{
            $u= new Usuario();
            $u->setNombre($_POST['nombreusuario']);
            $u->setPassword($_POST['password']);
            $u->setColaborador($_POST['colaborador']);
            $u->setTipoUsuario($_POST['tipo']);
                if($u->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'usuario agregado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar al usuario '
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
    if(isset($_PUT['nombreusuario'])&& isset($_PUT['password']) && isset($_PUT['tipo']) && isset($_PUT['id'])){
        try{
            $u= new Usuario();
            $u->setNombre($_PUT['nombreusuario']);
            $u->setPassword($_PUT['password']);
            $u->setTipoUsuario($_PUT['tipo']);
            $u->setId($_PUT['id']);
                if($u->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'usuario actualizado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al actualizar el usuario '
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