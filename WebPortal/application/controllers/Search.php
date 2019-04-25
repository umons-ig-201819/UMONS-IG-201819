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
        $this->load->view('header');
        $this->load->view('search_user');
        $this->load->view('footer');
    }
    public function datasource(){
        $this->load->view('header');
        $this->load->view('search_datasource');
        $this->load->view('footer');
    }
}