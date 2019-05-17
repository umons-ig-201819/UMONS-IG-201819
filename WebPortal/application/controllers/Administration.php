<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends CI_Controller {
    private $success, $error;
    public function __construct(){
        parent::__construct();
        if(!isset($this->session->UserID)){
            http_response_code(403);
            die('Access denied!');
        }
        $this->load->model('ProjectModel');
        $this->success  = null;
        $this->error    = null;
    }
    
    public function index(){
        if(! in_array('MANAGE_PROJECT', $this->session->Rights)){
            $this->forbidden();
            return;
        }
        $filter = array();
        if($this->input->post('action')){
            if(!empty($this->input->post('search'))){
                $filter['project_name']         = $this->input->post('search');
                $filter['project_description']  = $this->input->post('search');
            }
        }
        $data = $this->ProjectModel->listProjects($filter);
        $this->load->view('header');
        $this->load->view('projects',array('projects' => $data,'success' => $this->success, 'error' => $this->error));
        $this->load->view('footer');
    }
    
    public function removeProject($projectID = -1){
        if(! in_array('MANAGE_PROJECT', $this->session->Rights)){
            $this->forbidden();
            return;
        }
        $this->ProjectModel->deleteAllUsersProject($projectID);
        $this->ProjectModel->deleteProject($projectID);
        $this->success = 'Le projet a bien &eacute;t&eacute; supprim&eacute;.';
        $this->index();
    }
    
    public function removeUser($projectID = -1,$userID){
        if(! in_array('MANAGE_PROJECT', $this->session->Rights)){
            $this->forbidden();
            return;
        }
        $this->ProjectModel->deleteUserProject($userID,$projectID);
        $this->success = 'Le membre a bien &eacute;t&eacute; supprim&eacute;.';
        $this->project($projectID);
    }
    
    private function forbidden(){
        $this->load->view('header');
        $this->load->view('forbidden');
        $this->load->view('footer');
    }
    
    public function addProject(){
        if(! in_array('MANAGE_PROJECT', $this->session->Rights)){
            $this->forbidden();
            return;
        }
        if($this->input->post('addaction')){
            $userID = $this->session->UserID;
            $data   = array(
                'pname'         => $this->input->post('project_name'),
                'pdescription'  => $this->input->post('project_description'),
                'pdate_start'   => $this->input->post('date_start'),
                'pdate_end'     => $this->input->post('date_end')
            );
            
            if($this->ProjectModel->addProject($userID,$data) === false){
                $this->error = 'Impossible d\'ajouter le projet.';
            }else{
                $this->success = 'Projet ajout&eacute;.';
            }
        }
        $this->index();
    }
    
    public function update($projectID = -1, $memberID = -1){
        if(! in_array('MANAGE_PROJECT', $this->session->Rights)){
            $this->forbidden();
            return;
        }
        if($this->input->post('update')){
            $gestion = empty($this->input->post('manage'))? 0 : 1;
            if($this->ProjectModel->updateUserProject($projectID, $memberID, array('manage' => $gestion)) === true){
                $this->success = 'Modification effectu&eacute;e.';
            }else{
                $this->success = 'Impossible d\'effectuer cette modification.';
            }
        }
        $this->project($projectID);
    }
    
    public function project($projectID = -1){
        if(! in_array('MANAGE_PROJECT', $this->session->Rights)){
            $this->forbidden();
            return;
        }
        if($this->input->post('action')){
            $data = array(
                'id'            => $projectID,
                'pname'         => $this->input->post('project_name'),
                'pdate_start'   => $this->input->post('add_date'),
                'pdate_end'     => $this->input->post('date_end'),
                'pdescription'  => $this->input->post('project_description')
            );
            if($this->ProjectModel->updateProject($projectID,NULL,$data)===true){
                $this->success = 'Projet modifi&eacute;';
            }else{
                $this->error = 'Impossible de modifier le projet';
            }
        } elseif($this->input->post('addaction')){
            $login   = $this->input->post('login');
            $gestion = empty($this->input->post('manage'))? 0 : 1;
            if($this->ProjectModel->addUserProject($login,$projectID,array('gestion' => $gestion))===true){
                $this->success = 'Membre ajout&eacute;';
            }else{
                $this->error = 'Impossible d\'ajouter le membre au projet';
            }
        }
        $project    = $this->ProjectModel->getProject($projectID);
        $scientists = $this->ProjectModel->getProjectMembers($projectID);
        $this->load->view('header');
        $this->load->view('project',array('project' => $project, 'scientists' => $scientists,'success' => $this->success, 'error' => $this->error));
        $this->load->view('footer');
    }
}