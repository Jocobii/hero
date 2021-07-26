<?php
header('Access-Control-Allow-Origin:*');
require_once('models/sede.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $s = new Sede($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'sede' => json_decode($s->toJson())
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
        'sedes' => json_decode(Sede::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['codsede']) && isset($_POST['nombre']) && isset($_POST['calle']) && isset($_POST['numext']) && isset($_POST['numint']) && isset($_POST['colonia']) 
    && isset($_POST['postal']) && isset($_POST['ciudad']) && isset($_POST['estado']) && isset($_POST['pais']) && isset($_POST['telefono'])){
        try{
            $s= new Sede();
            $s->setCodSede($_POST['codsede']);
            $s->setNombre($_POST['nombre']);
            $s->setCalle($_POST['calle']);
            $s->setNumExterior($_POST['numext']);
            $s->setNumInterior($_POST['numint']);
            $s->setColonia($_POST['colonia']);
            $s->setCodPostal($_POST['postal']);
            $s->setCiudad($_POST['ciudad']);
            $s->setEstadoSede($_POST['estado']);
            $s->setPais($_POST['pais']);
            $s->setTelefono($_POST['telefono']);
                if($s->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Sede agregada correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar la sede '
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
    $_PUT = json_decode(file_get_contents("php://input"), true);
    if(isset($_PUT['codsede']) && isset($_PUT['nombre']) && isset($_PUT['calle']) && isset($_PUT['numext']) && isset($_PUT['numint']) && isset($_PUT['colonia']) 
    && isset($_PUT['postal']) && isset($_PUT['ciudad']) && isset($_PUT['estadosede']) && isset($_PUT['pais']) && isset($_PUT['telefono']) && isset($_PUT['id']) && isset($_PUT['estado'])){
        try{
            $s= new Sede();
            $s->setCodSede($_PUT['codsede']);
            $s->setNombre($_PUT['nombre']);
            $s->setCalle($_PUT['calle']);
            $s->setNumExterior($_PUT['numext']);
            $s->setNumInterior($_PUT['numint']);
            $s->setColonia($_PUT['colonia']);
            $s->setCodPostal($_PUT['postal']);
            $s->setCiudad($_PUT['ciudad']);
            $s->setEstadoSede($_PUT['estadosede']);
            $s->setPais($_PUT['pais']);
            $s->setTelefono($_PUT['telefono']);
            $s->setEstado($_PUT['estado']);
            $s->setId($_PUT['id']);
                if($s->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Sede modificada correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al modificar la sede '
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

if($_SERVER['REQUEST_METHOD']=='DELETE'){

    echo 'delete';
}
?>