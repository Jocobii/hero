<?php
header('Access-Control-Allow-Origin:*');
require_once('models/stock.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $r = new Stock($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'stock' => json_decode($r->toJson())
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
        'stock' => json_decode(Stock::getAllToJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    echo 'post';

}
if($_SERVER['REQUEST_METHOD']=='PUT'){
    $_PUT = json_decode(file_get_contents("php://input"), true);
    if( isset($_PUT['idcolaborador']) && isset($_PUT['idrecurso']) && isset($_PUT['idusuario'])){
        try{
            $s= new Stock();
            $s->setColaboradorA($_PUT['idcolaborador']);
            $s->setId($_PUT['idrecurso']);
            $s->setUsuarioGestion($_PUT['idusuario']);
                if($s->Asignar()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Recurso Asignado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al Asignar el recurso '
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