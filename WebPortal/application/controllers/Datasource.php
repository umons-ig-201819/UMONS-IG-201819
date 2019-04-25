<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasource extends CI_Controller {
    private $error,$success;
    public function __construct(){
        parent::__construct();
        $this->load->model('DataSourceModel');
        $this->load->helper('zeppelin');
        $this->error = '';
        $this->success = '';
    }

    
    public function index($sourceID=''){
        $sources = $this->DataSourceModel->getAccessibleDataSources($this->session->UserID);
        
        $options = array(
            ''         => 'Veuillez s&eacute;lectionner une source',
        );
        
        foreach($sources as $source){
            $options[$source['url']] = $source['name'];
        }
        
        if(empty($sourceID) && !empty($this->input->post('datasource'))){
            $sourceID = $this->input->post('datasource');
        }
        
        if(!preg_match('/^[0-9a-zA-Z]+$/', $sourceID)) $sourceID = '';
        
        $url = array();
        
        if(!empty($sourceID) && array_key_exists($sourceID, $options)){
            $url = get_user_workspace($this->session->UserID,$sourceID);
        }
        
        $data = array(
            'selected'          => $sourceID,
            'url'               => $url,
            'options'           => $options
        );
        
        $this->load->view('header');
        $this->load->view('datasource',$data);
        $this->load->view('footer');
    }
    public function addSource(){
        $error = null;
        if($this->input->post('action')){
            $userID                         = $this->session->UserID;
            $path_parts                     = pathinfo($_FILES["datafile"]["name"]);
            
            $config = array(
                'upload_path'          => "/var/nfs/general/$userID/",
                'allowed_types'        => 'csv|mdb|accdb',
                'max_size'             => 100,
                'file_ext_tolower'     => true,
                'detect_mime'          => true,
                'file_name'            => dechex(time()).'.'.strtolower($path_parts['extension'])
            );
            if(!file_exists($config['upload_path'])){
                mkdir($config['upload_path']);
            }
            
            $this->load->library('upload', $config);
            
            if(!$this->upload->do_upload('datafile')){
                $error = array('error' => $this->upload->display_errors());
            }else{
                $data = array('upload_data' => $this->upload->data());
                $error = $data;
                $data['upload_data']['file_ext'] = strtolower($data['upload_data']['file_ext']);
                if(strlen($data['upload_data']['file_ext'])>0){
                    $data['upload_data']['file_ext'] = substr($data['upload_data']['file_ext'],1);// remove initial dot (.)
                }
                $nodeName = "user/data-$userID-".$data['upload_data']['raw_name'];
                $path = $data['upload_data']['full_path'];
                $path = str_replace('/var/nfs/general/','/nfs/shared/',$path);
                $url = null;
                if($data['upload_data']['file_ext'] == 'csv'){
                    $url = create_csv_source($nodeName,"csv-$userID",$path);
                }elseif($data['upload_data']['file_ext'] == 'mdb' || $data['upload_data']['file_ext'] == 'accdb'){
                    $url = create_access_source($nodeName,"access-$userID-".$data['upload_data']['raw_name'],$path);
                }
                // no else because already checked by CodeIgniter
                $this->DataSourceModel->addDataSourceApp($userID, array(
                    'name'      => $data['upload_data']['client_name'],
                    'visible'   => 0,
                    'url'       => $url
                ));
            }
        }
        $this->load->view('header');
        $this->load->view('upload', array('error' => $error));
        $this->load->view('footer');
    }
    public function addAdvisor($sourceID){
        if($this->input->post('actionadd')){
            $login = $this->input->post('login');
            if($this->DataSourceModel->addAdvisor($sourceID,$login) == '1'){
                $this->success = 'Conseiller ajout&eacute;';
            }else{
                $this->error = 'Conseiller non trouv&eacute;';
            }
        }
        $this->advisor($sourceID);
    }
    public function manage(){
        $userID = $this->session->UserID;
        $data   = $this->DataSourceModel->getPersonalDataSources($userID);
        $access = $this->DataSourceModel->getAccessDataSources($userID);
        $this->load->view('header');
        $this->load->view('mysources',array('source' => $data, 'access' => $access));
        $this->load->view('footer');
    }
    public function update($sourceID){
        // TODO check permission for each function...
        $userID = $this->session->UserID;
        if($this->input->post('action')){
            $data = array(
                'name'      => $this->input->post('file_name'),
                'visible'   => $this->input->post('visible')
            );
            $this->DataSourceModel->updateDataSource($sourceID,$userID,$data);
        }
        $this->manage();
    }
    public function revoke($sourceID){
        // TODO check permission for each function...
        $userID = $this->session->UserID;
        $this->DataSourceModel->revokeAccess($sourceID,$userID);
        $this->manage();
    }
    public function ask($sourceID){
        // TODO check permission for each function...
        $userID = $this->session->UserID;
        $this->DataSourceModel->askAccess($sourceID,$userID);
        $this->manage();
    }
    
    public function remove($sourceID){
        // TODO check permission for each function...
        $userID         = $this->session->UserID;
        $source         = $this->DataSourceModel->getDataSource($sourceID);
        $zeppelinID     = $source['url'];
        $name           = get_note_name($zeppelinID);// ex: user/data-2-5cc0b9f1
        $name           = explode('-',$name);
        $name           = array_pop($name);
        $this->DataSourceModel->deleteDataSource($sourceID);
        delete_note($zeppelinID);
        array_map('unlink', glob("/var/nfs/general/$userID/$name.*"));
        $this->manage();
    }
    public function advisor($sourceID){
        // TODO check permission for each function...
        $userID     = $this->session->UserID;
        
        if($this->input->post('action')){
            $state      = $this->input->post('state');
            $advisorID  = $this->input->post('advisorid');
            if($state == '1') $this->DataSourceModel->acceptAccess($sourceID, $advisorID);
            else $this->DataSourceModel->refuseAccess($sourceID, $advisorID);
        }
        
        $source     = $this->DataSourceModel->getDataSource($sourceID);
        $advisors   = $this->DataSourceModel->getAdvisors($sourceID);
        
        $this->load->view('header');
        $this->load->view('datasource_advisor',array('source' => $source, 'advisors' => $advisors,'error' => $this->error, 'success' => $this->success));
        $this->load->view('footer');
    }
    public function project($sourceID){
        // TODO check permission for each function...
        $userID = $this->session->UserID;
        $source = $this->DataSourceModel->getDataSource($sourceID);
        $this->load->view('header');
        $this->load->view('datasource_project',array('source' => $source));
        $this->load->view('footer');
    }
}
