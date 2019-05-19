<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connection extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
    }
    
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
 /*       $this->load->view('header');
        $this->load->view('home');
        $this->load->view('footer');*/
    }
    
    public function lost(){
        $data = array();
        if($this->input->post('action')){
            $this->UserModel->forgot($this->input->post('email'));
            $data = array('state' => true);
        }
        $this->load->view('header');
        $this->load->view('lost',data);
        $this->load->view('footer');
    }
    
    public function index(){
        $data = array();
        if($this->input->post('action')){
            
            $data = $this->UserModel->authentification($this->input->post('username'),$this->input->post('password'));
            if($data !== false){
                $this->session->set_userdata('UserID', $data['id']);
                $rights = array();
                foreach($this->UserModel->getUserRights($data['id']) as $right)
                    array_push($rights,$right['name']);
                $this->session->set_userdata('Rights', $rights);
            }else{
                $data = array('error' => true);
            }
        }
        $this->load->view('header');
        $this->load->view('connection',$data);
        $this->load->view('footer');
    }
}