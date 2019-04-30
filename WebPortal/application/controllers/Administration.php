<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends CI_Controller {
    private $success, $error;
    public function __construct(){
        parent::__construct();
        $this->load->model('ProjectModel');
        $this->success  = null;
        $this->error    = null;
    }
    
    public function index(){
        if(! array_key_exists('MANAGE_PROJECT', $this->session->Rights)){
            forbidden();
            return;
        }
        $filter = array();
        if($this->input->post('action')){
            if(!empty($this->input->post('search'))){
                $filter['project_name']         = $this->input->post('search');
                $filter['project_description']  = $this->input->post('search');
            }
        }
        $data = $this->load->ProjectModel->getProjects($filter);
        $this->load->view('header');
        $this->load->view('projects',array('projects' => $data,'success' => $success, 'error' => $error));
        $this->load->view('footer');
    }
    
    public function removeProject($projectID = -1){
        if(! array_key_exists('MANAGE_PROJECT', $this->session->Rights)){
            forbidden();
            return;
        }
        $this->load->ProjectModel->deleteAllUsersProject($projectID);
        $this->load->ProjectModel->deleteProject($projectID);
        $this->success = 'Le projet a bien &eacute;t&eacute; supprim&eacute;.';
        $this->index();
    }
    
    public function removeUser($projectID = -1,$userID){
        if(! array_key_exists('MANAGE_PROJECT', $this->session->Rights)){
            forbidden();
            return;
        }
        $this->load->ProjectModel->deleteUserProject($userID,$projectID);
        $this->success = 'Le membre a bien &eacute;t&eacute; supprim&eacute;.';
        $this->project($projectID);
    }
    
    private function forbidden(){
        $this->load->view('header');
        $this->load->view('forbidden');
        $this->load->view('footer');
    }
    
    public function addProject(){
        if(! array_key_exists('MANAGE_PROJECT', $this->session->Rights)){
            forbidden();
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
            
            if($this->load->ProjectModel->addProject($userID,$data) === false){
                $this->error = 'Impossible d\'ajouter le projet.';
            }else{
                $this->success = 'Projet ajout&eacute;.';
            }
        }
        $this->index();
    }
    
    public function update($projectID = -1, $memberID = -1){
        if(! array_key_exists('MANAGE_PROJECT', $this->session->Rights)){
            forbidden();
            return;
        }
        if($this->input->post('update')){
            $gestion = empty($this->input->post('manage'))? 0 : 1;
            if($this->load->ProjectModel->updateUserProject($projectID, $memberID, array('manage' => $gestion)) === true){
                $this->success = 'Modification effectu&eacute;e.';
            }else{
                $this->success = 'Impossible d\'effectuer cette modification.';
            }
        }
        $this->project($projectID);
    }
    
    public function project($projectID = -1){
        if(! array_key_exists('MANAGE_PROJECT', $this->session->Rights)){
            forbidden();
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
            if($this->load->ProjectModel->updateProject($projectID,NULL,$data)===true){
                $error = 'Projet modifi&eacute;';
            }else{
                $error = 'Impossible de modifier le projet';
            }
        } elseif($this->input->post('addaction')){
            $login   = $this->input->post('login');
            $gestion = empty($this->input->post('manage'))? 0 : 1;
            if($this->load->ProjectModel->addUserProject($projectID,NULL,array('login'=>$login, 'gestion' => $gestion))===true){
                $error = 'Membre ajout&eacute;';
            }else{
                $error = 'Impossible d\'ajouter le projet';
            }
        }
        $project    = $this->load->ProjectModel->getProject($projectID);
        $scientists = $this->load->ProjectModel->getProjectMembers($projectID);
        $this->load->view('header');
        $this->load->view('project',array('project' => $project, 'scientists' => $scientists,'success' => $success, 'error' => $error));
        $this->load->view('footer');
    }
}