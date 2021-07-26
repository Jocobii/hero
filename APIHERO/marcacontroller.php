<?php
header('Access-Control-Allow-Origin:*');
require_once('models/marcadispositivo.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $m = new MarcaDispositivo($_GET['id']);
        echo json_encode(array(
            'marca' => json_decode($m->toJson())
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
        'marca' => json_decode(MarcaDispositivo::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombremarca'])){
        try{
            $md= new MarcaDispositivo();
            $md->setNombre($_POST['nombremarca']);
                if($md->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'marca agregada correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar la marca '
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
    if(isset($_PUT['nombremarca']) && isset($_PUT['id']) && isset($_PUT['estatus'])){
        try{
            $md= new MarcaDispositivo();
            $md->setNombre($_PUT['nombremarca']);
            $md->setId($_PUT['id']);
            $md->setStatus($_PUT['estatus']);
                if($md->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'marca actualizada correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al actualizar la marca '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid marca '));
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