<?php
header('Access-Control-Allow-Origin:*');
require_once('models/dispositivo.php');
require_once('models/recurso.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        try{
            $d = new Dispositivos($_GET['id']);
            echo json_encode(array(
                'dispositivo' =>json_decode($d->toJson())
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
            'dispositivos' => json_decode(Dispositivos::getAlltoJson())
        ));
    }
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['descripcion'])&& isset($_POST['serie']) && isset($_POST['procesador']) && isset($_POST['memoria']) && isset($_POST['almacenamiento']) && isset($_POST['resolucion']) && isset($_POST['puertos']) 
    && isset($_POST['tipo']) && isset($_POST['modelo']) && isset($_POST['estado']) && isset($_POST['codservicio']) && isset($_POST['precio']) && isset($_POST['estador'])  && isset($_POST['usuariog']) 
    && isset($_POST['sede'])){
        try{
            $d= new Dispositivos();
            $d->setDescripcion($_POST['descripcion']);
            $d->setSerie($_POST['serie']);
            $d->setProcesador($_POST['procesador']);
            $d->setMemoria($_POST['memoria']);
            $d->setAlmacenamiento($_POST['almacenamiento']);
            $d->setResolucion($_POST['resolucion']);
            $d->setPuertosVideo($_POST['puertos']);
            $d->setTipo($_POST['tipo']);
            $d->setModelo($_POST['modelo']);
            $d->setEstado($_POST['estado']);

            $r= new Recurso();
            $r->setCodServicio($_POST['codservicio']);
            $r->setPrecio($_POST['precio']);
            $r->setStatus($_POST['estador']);
            $r->setUsuarioGestion($_POST['usuariog']);
            $r->setSede($_POST['sede']);
            
                if($d->add()){
                    if($r->add()){
                        echo json_encode(array(
                            'status'=>0,
                            ' Menssage'=>'Recurso  agregado correctamente'
                        ));
                    }else{
                        echo json_encode(array(
                            'status'=>1,
                            'error Menssage'=>'Error al agregar el recurso'
                        ));
                    }
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid resour '));
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
    if(isset($_PUT['descripcion'])&& isset($_PUT['serie']) && isset($_PUT['procesador']) && isset($_PUT['memoria']) && isset($_PUT['almacenamiento']) 
    && isset($_PUT['resolucion']) && isset($_PUT['puertos']) && isset($_PUT['tipo']) && isset($_PUT['modelo']) && isset($_PUT['estado']) && isset($_PUT['id'])){
        try{
            $d= new Dispositivos();
            $d->setDescripcion($_PUT['descripcion']);
            $d->setSerie($_PUT['serie']);
            $d->setProcesador($_PUT['procesador']);
            $d->setMemoria($_PUT['memoria']);
            $d->setAlmacenamiento($_PUT['almacenamiento']);
            $d->setResolucion($_PUT['resolucion']);
            $d->setPuertosVideo($_PUT['puertos']);
            $d->setTipo($_PUT['tipo']);
            $d->setModelo($_PUT['modelo']);
            $d->setEstado($_PUT['estado']);
            $d->setId($_PUT['id']);
                if($d->put()){
                    echo json_encode(array(
                        'status'=>0,
                        'Menssage'=>'Dispositivo actualizado correctamente'
                    ));
                }
                else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar el recurso'
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid resour '));
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