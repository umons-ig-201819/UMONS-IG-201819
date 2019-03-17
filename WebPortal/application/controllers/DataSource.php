<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataSource extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('DataSourceModel');
    }
    public function index($sourceID=null){
        $this->load->view('header');
        $this->load->view('datasource');
        $this->load->view('footer');
    }
}
