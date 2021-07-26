<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
require_once('models/departamento.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $d = new Departamento($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'departamento' => json_decode($d->toJson())
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
        'departamentos' => json_decode(Departamento::getAlltoJson())
    ));
}

}

if($_SERVER['REQUEST_METHOD']=='POST'){
    echo "post";
}
if($_SERVER['REQUEST_METHOD']=='PUT'){
   echo "put";
}

if($_SERVER['REQUEST_METHOD']=='DELETE'){

    echo 'delete';
}
?>