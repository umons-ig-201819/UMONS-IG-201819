<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        // TODO ensure that user is logged
        parent::__construct();
        $this->load->model('UserModel');
    }    

    public function index(){
        $this->load->view('header');
        $data['numberAgri'] = $this->UserModel->getNumberFromRole(3);
        $this->load->view('home',$data);
        $this->load->view('footer');
    }
}