<?php

class API
{
    protected $data;
    protected $keys;
    public $request;
    public $valid = false;

    public function __construct()
    {
        $this->data = json_decode(file_get_contents('data.json'));
        $this->keys = json_decode(file_get_contents('key.json'));
        
        $this->request = $this->__parseRequest();

        $this->__validateKey();
        
        if($this->valid)$this->__selectVerb();
    }

    public function get()
    {
        $requestedData = [];

        foreach ($this->data as $key => $value) {
            //any conditions
            if($this->request[2] == $value->{(string)$this->request[1]} )
            array_push($requestedData, $value);
        }
        return ($requestedData);
    }

    public function post()
    {
        //validate json fields
        $this->request[1] = isset($this->request[1])? json_decode($this->request[1]) : null ;
        array_push($this->data, $this->request[1]);
        file_put_contents ('data.json', json_encode ( $this->data ) ) ;
        echo 'new data added';
    }

    public function put()
    {
        foreach ($this->data as $key => $value) { 
            if($this->request[1] == $value->_id ) {
                 $value->{($this->request[2])} = $this->request[3];
            } 
              
        }  
         file_put_contents('data.json', json_encode($this->data));
         echo 'file modified';
    }

    public function delete()
    {
        $data = [];
        foreach($this->data as $key => $value) {
            if($this->request[1] !== $value->_id){
                array_push($data, $value);
            }
        }
        file_put_contents('data.json', json_encode($data));
        echo 'removed record';
    } 

    private function __parseRequest()
    {
        return explode('/', rtrim(ltrim($_SERVER['PATH_INFO'], '/'), '/'));
    }  

    private function __selectVerb()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') $this->post();
        if($_SERVER['REQUEST_METHOD'] === 'GET') $this->get();
        if($_SERVER['REQUEST_METHOD'] === 'PUT') $this->put();
        if($_SERVER['REQUEST_METHOD'] === "DELETE") $this->delete();
    } 

    private function __validateKey()
    {
        foreach ($this->keys as $key => $value) {
            if($this->request[0] === $value->key ){
                $this->valid = true;
            } 
        }
    }

}