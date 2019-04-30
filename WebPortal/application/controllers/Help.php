<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('help');
        $this->load->view('footer');
    }
}