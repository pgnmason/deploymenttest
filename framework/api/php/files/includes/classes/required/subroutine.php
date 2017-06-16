<?php

interface Sub{
    public function setTask($task);
    public function run();
}


class Subroutine implements Sub{
    public $task;
    
    public function setTask($task){
        if(!method_exists($this,$task)){
            die("No Such Task");
        }
        $this->task = $task;
    }
    
    function run(){
        $task = $this->task;
        $this->$task();
    }
    
    function error($code,$message,$details){
        $data = new Response();
        $data->set("status",0);
        $data->set("code",$code);
        $data->set("message",$message);
        $data->set("details",$details);
        return $data;
    }
    
}

?>