<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
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
            }else{
                $data = array('error' => true);
            }
        }
        $this->load->view('header');
        $this->load->view('register');
        $this->load->view('footer');
    }
}