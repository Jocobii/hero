<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
require_once('models/area.php');
require_once('models/exceptions/recordnotfoundexception.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
if(isset($_GET['id'])){
    try{
        $a = new Area($_GET['id']);
        echo json_encode(array(
            'status' => 0,
            'area' => json_decode($a->toJson())
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
        'areas' => json_decode(Area::getAlltoJson())
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