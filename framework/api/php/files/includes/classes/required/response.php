<?php

class Response extends Object{
    
    private $data;
    
    function __construct($data=array()){
        $this->data = new Object();
        $this->data->load($data);
    }
    
    function set($key, $data){
       $this->data->$key = $data;
    }
    
    function output($type = 'json'){
        switch($type){
            case "json":
                return json_encode($this->data);
                break;
            case "xml":
            case "obj":
            default:
                return $this->data;
                break;
                
        }
        
    }
    
    
}

?>