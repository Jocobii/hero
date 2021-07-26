<?php

class Config{
    public static function getFillerUrl($key){
        $data = file_get_contents('C:\xampp\htdocs\teams\config/config.json');
        $config = json_decode($data, true);
        if(isset($config['files'])){
            $files=$config['files'];
            if(isset($files[$key])){
                return $files[$key];
                
            }else{
                return ' ';
            }
        }
    }
    
}

?>