<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        // TODO ensure that user is logged
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('CounterModel');
    }    

    public function index(){
        $this->load->view('header');
        $numberAgri = $this->UserModel->getNumberFromRole(3);
        if(!isset($this->session->VisitCounter)){
            $this->CounterModel->newVisitor();
            $this->session->set_userdata('VisitCounter',true);
        }
        $numberVisit = $this->CounterModel->countVisitors();
        $this->load->view('home',array('numberAgri' => $numberAgri, 'numberVisit' => $numberVisit));
        $this->load->view('footer');
    }
}