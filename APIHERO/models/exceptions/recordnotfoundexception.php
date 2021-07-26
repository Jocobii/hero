<?php

class RecordNotFoundException extends Exception{


    protected $message;
    public function __construct(){
        if(func_num_args()==0)
        $this->messege ='resultado nt found';

        if(func_num_args()==1)
        $this->messege ='resultado found'.func_get_arg(0);
    }
}

?>