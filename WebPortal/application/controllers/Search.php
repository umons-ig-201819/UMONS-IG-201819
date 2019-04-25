<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
    public function __construct(){
        // TODO ensure that user is logged
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('DataSourceModel');
    }
    public function index(){
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
        $this->load->view('search_user',array('result' => $result));
        $this->load->view('footer');
    }
    public function datasource(){
        $result = array();
        if($this->input->post('action')){
            $filter = array();
            if(!empty($this->input->post('owner'))) $filter['owner']=$this->input->post('owner');
            if(!empty($this->input->post('name'))) $filter['file_name']=$this->input->post('name');
            $result = $this->UserModel->searchDataSources($filter,true);
        }
        $this->load->view('header');
        $this->load->view('search_datasource',array('result' => $result));
        $this->load->view('footer');
    }
}