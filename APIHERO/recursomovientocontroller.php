<?php
header('Access-Control-Allow-Origin:*');
require_once('models/recursomovimiento.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $r = new RecursoMovimiento($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'RecursoMoviento' => json_decode($r->toJson())
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
        'fecursoMovientos' => json_decode(RecursoMovimiento::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['recurso']) && isset($_POST['colaboradorant']) && isset($_POST['colaboradoract']) && isset($_POST['usuariogest']) && isset($_POST['tipomovimiento']) && isset($_POST['motivo']) 
    && isset($_POST['nota']) ){
        try{
            $rm= new RecursoMovimiento();
            $rm->setRecurso($_POST['recurso']);
            $rm->setColaboradorAnt($_POST['colaboradorant']);
            $rm->setColaboradorActu($_POST['colaboradoract']);
            $rm->setUsuarioGestion($_POST['usuariogest']);
            $rm->setTipo($_POST['tipomovimiento']);
            $rm->setMotivo($_POST['motivo']);
            $rm->setNota($_POST['nota']);
                if($rm->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'movimiento del recurso agregada correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar el movimiento del recurso '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid sede '));
           }    
    }else{
        echo json_encode(array(
            'status'=>999,
            'error Menssage'=>'Missing parameters'
        ));
    }

}
if($_SERVER['REQUEST_METHOD']=='PUT'){

    echo 'put';
}

if($_SERVER['REQUEST_METHOD']=='DELETE'){

    echo 'delete';
}
?>