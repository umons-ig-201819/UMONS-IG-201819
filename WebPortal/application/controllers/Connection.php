<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connection extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
    }
    public function index(){
        $this->load->view('header');
        if($this->input->post('action')){
            // data sent
            print_r($this->UserModel->authentification($this->input->post('username'),$this->input->post('password')));
            // Save user id inside session 'UserID' : $this->session, see https://www.codeigniter.com/userguide3/libraries/sessions.html
            // Put user id $this->session->set_userdata('UserID', valeur ici);
        }
        $this->load->view('connection');
        $this->load->view('footer');
    }
}