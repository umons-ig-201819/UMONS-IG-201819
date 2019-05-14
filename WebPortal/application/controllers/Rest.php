<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest extends CI_Controller {
    private $response,$userID;
    private $query;
    
    public function __construct(){
        parent::__construct();
        
        $this->load->model('UserModel');
        
        $this->response = array(
            'status'    => 'OK',
            'message'   => '',
            'body'      => array()
        );
        $this->userID = null;
        $this->query = null;
    }
    private function authentication(){
        $login      = array_key_exists('username', $this->query) ? $this->query['username'] : '';
        $password   = array_key_exists('password', $this->query) ? $this->query['password'] : '';
        $res        = $this->UserModel->authentification($login,$password);
        if(res === false) return false;
        $this->userID = $res['id'];
    }
    private function canAccess($sourceID){
        $data   = $this->DataSourceModel->getPersonalDataSources($this->userID);
        foreach($data as $source){
            if($source['id'] == $sourceID) return true;
        }
        
        $access = $this->DataSourceModel->getAccessDataSources($this->userID);
        foreach($access as $source){
            if($source['id'] == $sourceID) return true;
        }

        return false;
    }
    public function index(){
        $methods = get_class_methods('Rest');
        $methods = array_map(function ($x){ return new ReflectionMethod($this, $x);}, $methods);
        $methods = array_filter($methods,function ($x){ return $x->isPublic() && !$x->isConstructor();});
        echo $methods[0]->getDeclaringClass()->getName();
        echo $methods[count($methods)-1]->getDeclaringClass()->getName();
        $methods = array_map(function ($x){ return $x->getName();}, $methods);
        $this->response['body']['methods'] = $methods;
        $this->output();
    }
    public function data(){
        process();
        $source = array_key_exists('source', $this->query) ? intval($this->query['source']) : -1;
        if($source < 0){
            $this->response['status']='KO';
            $this->response['message']='Cannot identify the data source';
        }elseif(!canAccess($source)){
            $this->response['status']='KO';
            $this->response['message']='Cannot access to this data source';
        }else{
            // TODO read from source
        }
        $this->output();
    }
    public function source(){
        process();
        $source = array_key_exists('source', $this->query) ? intval($this->query['source']) : -1;
        if($source < 0){
            $this->response['status']='KO';
            $this->response['message']='Cannot identify the data source';
        }elseif(!canAccess($source)){
            $this->response['status']='KO';
            $this->response['message']='Cannot access to this data source';
        }else{
            $res = $this->DataSourceModel->getDataSource($source);
            $keys = array('id','owner_id','name','application','add_date');
            foreach($keys as $k)
                $this->response['body'][$k] = $res[$k];
        }
        $this->output();
    }
    public function list(){
        process();
        $data   = $this->DataSourceModel->getPersonalDataSources($this->userID);
        $access = $this->DataSourceModel->getAccessDataSources($this->userID);
        
        foreach($data as $source){
            array_push($this->response['body'],array('id'=>$source['id'],'name'=>$source['file_name']));
        }
        
        foreach($access as $source){
            array_push($this->response['body'],array('id'=>$source['id'],'name'=>$source['file_name']));
        }
        
        $this->output();
    }
    private function output(){
        header('Content-type: application/json');
        echo json_encode( $this->response );
    }
    private function process(){
        if(is_null($this->query)) $this->query = json_decode(file_get_contents('php://input'),true);
        if(is_null($this->query)){
            $this->response['status']='KO';
            $this->response['message']='Bad JSON encoding';
            return false;
        }
        $this->userID = authentication($query);
        if(is_null($this->userID)){
            $this->response['status']='KO';
            $this->response['message']='Autentication failure';
            return false;
        }
        return true;
    }
}