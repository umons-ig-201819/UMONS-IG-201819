<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connection extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
    }
    public function logout(){
        $this->session->sess_destroy();
        $this->index();
    }
    public function index(){
        $data = array();
        if($this->input->post('action')){
            $data = $this->UserModel->authentification($this->input->post('username'),$this->input->post('password'));
            if($data !== false){
                $this->session->set_userdata('UserID', $data['id']);
            } 
        }
        $this->load->view('header');
        $this->load->view('connection');
        $this->load->view('footer');
    }
}