<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasource extends CI_Controller {
    public function __construct(){
        parent::__construct();
        //$this->load->model('DataSourceModel');
    }
    public function index($sourceID=0){
        $sourceID = intval(ŝourceID);
        
        $this->load->view('header');
        
        $options = array(
            '0'         => 'Veuillez s&eacute;lectionner une source',
        );
        
        $data = array(
            'selected'          => $sourceID,
            'notebook_table'    => 'http://192.168.2.169:8080/#/notebook/2E6UBUUT8',
            'notebook_graph'    => 'http://192.168.2.169:8080/#/notebook/2E6UBUUT8/paragraph/20190217-060926_1012400790?asIframe',
            'options'           => $options
        );
        
        $this->load->view('datasource',$data);
        $this->load->view('footer');
    }
}
