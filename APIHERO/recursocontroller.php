<?php
header('Access-Control-Allow-Origin:*');
require_once('models/recurso.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $r = new Recurso($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'recurso' => json_decode($r->toJson())
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
        'recursos' => json_decode(Recurso::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    echo "post";
}

if($_SERVER['REQUEST_METHOD']=='PUT'){
    $_PUT = json_decode(file_get_contents("php://input"), true);
    if( isset($_PUT['codservicio']) && isset($_PUT['precio']) && isset($_PUT['estado']) && isset($_PUT['colaboradora']) && isset($_PUT['usuariog']) && isset($_PUT['sede']) && isset($_PUT['dispositivo']) && isset($_PUT['idrecurso']) && isset($_PUT['stock'])){
        try{
            $r= new Recurso();
            $r->setCodServicio($_PUT['codservicio']);
            $r->setPrecio($_PUT['precio']);
            $r->setStatus($_PUT['estado']);
            $r->setColaboradorA($_PUT['colaboradora']);
            $r->setUsuarioGestion($_PUT['usuariog']);
            $r->setSede($_PUT['sede']);
            $r->setDispositivo($_PUT['dispositivo']);
            $r->setId($_PUT['idrecurso']);
            $r->setStock($_PUT['stock']);
                if($r->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Recurso Actualizado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al Actualizar el recurso '
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