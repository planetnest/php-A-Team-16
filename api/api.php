<?php

class API
{
    protected $data;
    public $request;

    public function __construct()
    { 
        $this->data = json_decode(file_get_contents('data.json'));
        $this->request = urldecode($_SERVER['QUERY_STRING']);
    }

    public function get()
    {
        foreach ($this->data as $key => $value) {
            
           foreach($value as $key=>$value) {
               try {
                   if($key === $this->request) print_r($value);
               }catch(Exception $e) {
                    
               }
               
                foreach ($value as $key => $value) {
                    try {
                        if($key === $this->request) print_r($value);
                    }catch(Exception $e) {
                            
                    }                  
                }

           }
       }
    }

    public function post()
    {
        $key = $this->keyGen();
        $data = [$key=>(json_decode($this->request, true))];
        array_push($this->data, $data);
        // file_put_contents('data.json', json_encode($this->data));
        echo $_SERVER['SERVER_NAME'].'/api/'.$key;
        
    }
 
    public function keyGen()
    {
        $url = str_shuffle('asdfg0987654321FCXDRESZAWQ');
        foreach ($this->data as $key => $value) {
           foreach($value[0] as $key) {
               if($key === $url){
                   $this->keyGen();
               } else {
                   return $url;
               }
           }
       }
    }

}