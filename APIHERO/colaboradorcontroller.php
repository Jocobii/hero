<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
require_once('models/colaboradores.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $c = new Colaboradores($_GET['id']);
        echo json_encode(array(
            'colaborador' => json_decode($c->toJson())
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
        'colaboradores' => json_decode(Colaboradores::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombre']) && isset($_POST['paterno']) && isset($_POST['materno']) && isset($_POST['numservidor']) && isset($_POST['fecha']) && isset($_POST['email']) 
    && isset($_POST['comodato']) && isset($_POST['sede']) && isset($_POST['equipo']) && isset($_POST['puesto']) && isset($_POST['celular']) && isset($_POST['shortel'])){
        try{
            $c= new Colaboradores();
            $c->setNombre($_POST['nombre']);
            $c->setApaterno($_POST['paterno']);
            $c->setApmaterno($_POST['materno']);
            $c->setNumservidor($_POST['numservidor']);
            $c->setFecha($_POST['fecha']);
            $c->setEmail($_POST['email']);
            $c->setComodato($_POST['comodato']);
            $c->setSede($_POST['sede']);
            $c->setEquipo($_POST['equipo']);
            $c->setPuesto($_POST['puesto']);
            $c->setCelular($_POST['celular']);
            $c->setShortel($_POST['shortel']);
                if($c->add()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Colaborador agregado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al agregar al colaborador'
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
    if(isset($_PUT['nombre']) && isset($_PUT['paterno']) && isset($_PUT['materno']) && isset($_PUT['numservidor'])  && isset($_PUT['email']) 
    && isset($_PUT['comodato'])&& isset($_PUT['estado']) && isset($_PUT['sede']) && isset($_PUT['equipo']) && isset($_PUT['puesto']) && isset($_PUT['id']) && isset($_PUT['celular']) && isset($_PUT['shortel'])){
        try{
            $c= new Colaboradores();
            $c->setNombre($_PUT['nombre']);
            $c->setApaterno($_PUT['paterno']);
            $c->setApmaterno($_PUT['materno']);
            $c->setNumservidor($_PUT['numservidor']);
            $c->setEstado($_PUT['estado']);
            $c->setEmail($_PUT['email']);
            $c->setComodato($_PUT['comodato']);
            $c->setSede($_PUT['sede']);
            $c->setEquipo($_PUT['equipo']);
            $c->setPuesto($_PUT['puesto']);
            $c->setId($_PUT['id']);
            $c->setCelular($_PUT['celular']);
            $c->setShortel($_PUT['shortel']);
                if($c->put()){
                    echo json_encode(array(
                        'status'=>0,
                        ' Menssage'=>'Colaborador actializado correctamente'
                    ));
                }else{
                    echo json_encode(array(
                        'status'=>1,
                        'error Menssage'=>'Error al actualizar al colaborador '
                    ));
                }
            }catch(RecordNotFoundException $ex){
                    echo json_encode(array('status'=>2,'menssage'=>'invalid id '));
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