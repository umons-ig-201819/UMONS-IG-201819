<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!isset($this->session->UserID)){
            http_response_code(403);
            die('Access denied!');
        }
        $this->load->model('UserModel');
        $this->load->model('DataSourceModel');
    }
    public function index(){
        $this->user();
    }
    public function update($userID=-1){
        if(in_array('MANAGE_USERS', $this->session->Rights) && $this->input->post('updateaction')){
            $roles = $this->input->post('roles');
            $this->UserModel->updateUserRoles($userID,$roles);
        }
        $this->user();
    }
    public function user(){
        $result = array();
        if($this->input->post('action')){
            $filter = array();
            if(!empty($this->input->post('lastname'))) $filter['lastname']=$this->input->post('lastname');
            if(!empty($this->input->post('firstname'))) $filter['firstname']=$this->input->post('firstname');
            if(!empty($this->input->post('email'))) $filter['email']=$this->input->post('email');
            if(!empty($this->input->post('login'))) $filter['login']=$this->input->post('login');
            if(!empty($this->input->post('phone'))) $filter['phone']=$this->input->post('phone');
            if(!empty($this->input->post('mobile'))) $filter['mobile']=$this->input->post('mobile');
            $result = $this->UserModel->getUsers($filter,true);
        }
        $this->load->view('header');
        if(in_array('MANAGE_USERS', $this->session->Rights)){
            for($i=0; $i<count($result);$i++){
                $result[$i]['roles'] = array();
                $temp = $this->UserModel->getUserRoles($result[$i]['id']);
                foreach($temp as $t){
                    array_push($result[$i]['roles'],$t['id']);
                }
            }
        }
        $roles = $this->UserModel->getRoles();
        $options = array();
        foreach($roles as $role)
            $options[$role['id']] = $role['name'];
        $this->load->view('search_user',array('result' => $result,'roles' => $options));
        $this->load->view('footer');
    }
    public function datasource(){
        $result = array();
        if($this->input->post('action')){
            $filter = array();
            if(!empty($this->input->post('owner'))) $filter['owner']=$this->input->post('owner');
            if(!empty($this->input->post('name'))) $filter['file_name']=$this->input->post('name');
            $result = $this->DataSourceModel->searchDataSources($filter,true);
        }
        $this->load->view('header');
        $this->load->view('search_datasource',array('result' => $result));
        $this->load->view('footer');
    }
    public function usersuggestion($limit=10,$username=''){
        header('Content-type: application/json');
        $username   = str_replace('%', "\\%", $username);
        $result     = $this->UserModel->getUsers(array('login' => $username),true, $limit, '');
        $result     = array_map(function ($x){ return $x['login']; }, $result);
        echo json_encode( $result );
    }
}