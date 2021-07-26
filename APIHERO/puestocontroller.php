<?php
header('Access-Control-Allow-Origin:*');
require_once('models/puesto.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $p = new Puesto($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'puesto' => json_decode($p->toJson())
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
        'puestos' => json_decode(Puesto::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombre'])){
        try{
            $p= new Puesto();
            $p->setNombre($_POST['nombre']);
                if($p->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Puesto agregado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar el puesto '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid puesto '));
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
            $p= new Puesto();
            $p->setNombre($_PUT['nombre']);
            $p->setId($_PUT['id']);
                if($p->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'puesto actualizado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al actualizar el puesto '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid puesto '));
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