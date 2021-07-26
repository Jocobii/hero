<?php
header('Access-Control-Allow-Origin:*');
require_once('models/equipo.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $e = new Equipo($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'equipo' => json_decode($e->toJson())
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
        'equipos' => json_decode(Equipo::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombre'])&& isset($_POST['codequipo']) && isset($_POST['email']) && isset($_POST['area'])){
        try{
            $e= new Equipo();
            $e->setNombre($_POST['nombre']);
            $e->setCodEquipo($_POST['codequipo']);
            $e->setEmail($_POST['email']);
            $e->setArea($_POST['area']);
                if($e->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Equipo agregado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar el equipo'
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid team '));
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
    print_r($_PUT);
    if(isset($_PUT['nombre'])&& isset($_PUT['codequipo']) && isset($_PUT['email']) && isset($_PUT['area']) && isset($_PUT['id'])){
        try{
            $e= new Equipo();
            $e->setNombre($_PUT['nombre']);
            $e->setCodEquipo($_PUT['codequipo']);
            $e->setEmail($_PUT['email']);
            $e->setArea($_PUT['area']);
            $e->setId($_PUT['id']);
                if($e->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Equipo actualizado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al actualizar el equipo'
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid team '));
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