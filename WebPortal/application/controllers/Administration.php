<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends CI_Controller {
    // TODO check rights
    private $success, $error;
    public function __construct(){
        parent::__construct();
        $this->load->model('ProjectModel');
        $this->success  = null;
        $this->error    = null;
    }
    
    public function index(){
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
        $this->load->ProjectModel->deleteAllUsersProject($projectID);
        $this->load->ProjectModel->deleteProject($projectID);
        $this->success = 'Le projet a bien &eacute;t&eacute; supprim&eacute;.';
        $this->index();
    }
    
    public function removeUser($projectID = -1,$userID){
        $this->load->ProjectModel->deleteUserProject($userID,$projectID);
        $this->success = 'Le membre a bien &eacute;t&eacute; supprim&eacute;.';
        $this->project($projectID);
    }
    
    public function addProject(){
        if($this->input->post('addaction')){
            $userID = $this->session->UserID;
            $data   = array(); // TODO
            // TODO add project
            // addProject() 
            /*
                'pname'
                'pdescription'
                'pdate_start'
                'pdate_end'
         */
            $this->load->ProjectModel->addProject($userID,$data);
        }
        $this->index();
    }
    
    public function update($projectID = -1, $memberID = -1){
        if($this->input->post('update')){
            // TODO gestion
        }
        $this->project($projectID);
    }
    
    public function project($projectID = -1){
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