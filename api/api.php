<?php

class API
{
    protected $data;
    public $request;

    public function __construct()
    { 
        $this->data = [json_decode(file_get_contents('data.json'))];
        $this->request = explode('/', trim(urldecode($_SERVER['QUERY_STRING']), '/'));
        
        if(isset($this->request[1]) && ($this->request[1] == 'update') ){
            $this->update();
        } elseif( isset($this->request[1]) && ($this->request[1] == 'delete') ){
            $this->delete();
        }elseif($_SERVER['REQUEST_METHOD'] === 'GET'){
            $this->get();
        } elseif( (!isset($this->request[1])) && ($_SERVER['REQUEST_METHOD'] == 'POST') ){
            $this->post();
        }
        
    }

    public function get()
    {  
        foreach ($this->data as $key => $data) {
           
           foreach($data as $key=>$value) {            
               //returns regular get request with just key
               try {
                   if($key === $this->request[0] && (count($this->request) == 1 )) var_dump($value);
               }catch(Exception $e) {                   
               }               
           }
       }
    }

    public function post()
    { 
        $key = $this->keyGen();
        $data = [$key=>json_decode($_POST['json'])];
        array_push($this->data, $data);
        file_put_contents('data.json', json_encode($this->data));
        echo $_SERVER['SERVER_NAME'].'/api/'.$key;
        
    }

    public function update()
    {
        $data = [];
        if(isset($this->request[1]) && ($this->request[1] == 'update') ) {
            for ($i=0; $i < count($this->data); $i++) { 
                $data += ((array)$this->data[$i]);
            }
             $data[(string)$this->request[0]] = json_decode($_POST['json']);
             file_put_contents('data.json', [json_encode($data)] );
             echo 'updated';
        }        
    }

    public function delete()
    {
        $data = [];
        if(isset($this->request[1]) && ($this->request[1] == 'delete') ) {
            for ($i=0; $i < count($this->data); $i++) { 
                $data += ((array)$this->data[$i]);
            }
             unset($data[(string)$this->request[0]]);

             file_put_contents('data.json', json_encode($data));
             echo 'deleted';
        } 
    }
 

    public function keyGen()
    {
        $url = str_shuffle('asdfg0987654321FCXDRESZAWQ');
        foreach ($this->data as $key => $value) {
           
           foreach($value as $key=>$value) {
               if($key === $url){
                   $this->keyGen();
               } else {
                   return $url;
               }
           }
       }
    }

}