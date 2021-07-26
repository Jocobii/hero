<?php
header('Access-Control-Allow-Origin:*');
require_once('models/inventario.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $r = new Stock($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'Inventario' => json_decode($r->toJson())
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
        'Inventario' => json_decode(Inventario::getAllToJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    echo 'post';

}
if($_SERVER['REQUEST_METHOD']=='PUT'){
    $_PUT = json_decode(file_get_contents("php://input"), true);
    if( isset($_PUT['idrecurso']) && isset($_PUT['idusuario'])){
        try{
            $i= new Inventario();
            $i->setId($_PUT['idrecurso']);
            $i->setUsuarioGestion($_PUT['idusuario']);
                if($i->Desligar()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Recurso Desligado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al Desligar el recurso '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid id'));
           }    
    }else{
        echo json_encode(array(
            'status'=>999,
            'error Menssage'=>'Missing parameters',
        ));
    }
}

if($_SERVER['REQUEST_METHOD']=='DELETE'){

    echo 'delete';
}
?>