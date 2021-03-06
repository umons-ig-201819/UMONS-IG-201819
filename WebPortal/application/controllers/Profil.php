<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
    public function __construct(){
        // TODO ensure that user is logged
        parent::__construct();
        if(!isset($this->session->UserID)){
            http_response_code(403);
            die('Access denied!');
        }
        $this->load->model('UserModel');
        $this->load->model('DataSourceModel');
    }
    public function index($userID=null){
//        if(is_null($userID)) $userID = $this->session->UserID;
//        $editable_login = FALSE;
/*        if($userID != $this->session->UserID){
            $editable_login = TRUE;
        }*/
        $data                   = $this->UserModel->getUser($this->session->UserID);
        $data['username']       = $data['login'];
        $data['user_id']        = $data['id'];
        $data['sharing']        = $data['visible'];
//        $data['advice']         = $data['advice'];
//        $data['editable_login'] = $editable_login;
        foreach($data as $key => $value)
            $data[$key] = html_escape($value);
        
  /*
         $dataRoles = $this->UserModel->getUserRoles($this->session->UserID);
         $firstArray=$dataRoles[0];
         $data['test']= $firstArray['id'];            
         $data['roleName']= $firstArray['name'];
  */  
         
         $dataRoles = $this->UserModel->getUserRoles($this->session->UserID);
         $data['roleName']= $dataRoles;

        $this->load->view('header');
        $this->load->view('profil',$data);
        $this->load->view('footer');
    }
    public function update($userID=null)
    {
        if($userID != $this->session->UserID){ // TODO and get right
            $userID = intval($this->session->UserID);
            if(!array_key_exists('EDIT_USER'/*TODO correct right (edit user) */,$this->UserModel->getUserRights($this->session->UserID))){
                $userID = $this->session->UserID;
            }
        }else{
            $userID = $this->session->UserID;
        }
        
        $allowed = array(
            'lastname'  => 'lastname',
            'firstname' => 'firstname',
            'birthdate' => 'birthdate', // TODO check db type
            'email'     => 'email',
            'phone'     => 'phone',
            'mobile'    => 'mobile',
            'gender'    => 'gender',
            'username'  => 'login',
            'sharing'   => 'visible',
            'advice'    => 'advice'
        );
        foreach($allowed as $key => $value){
            $data[$value] = $this->input->post($key);
        }
        $data['id'] = $userID;
        
        $resuserupdate = $this->UserModel->updateUser($data);
        /*
        if ($resuserupdate)
            echo "<script>alert('Modification effectu�e')</script>";
        else 
            echo "<script>alert('Modification �chou�e')</script>";
        */
        $this->index($userID);
    }
    public function rights($userID=null)
    {
    if($userID != $this->session->UserID)
        {
            $userID = intval($this->session->UserID);
            if(!array_key_exists('EDIT_USER'/*TODO correct right (edit user) */,$this->UserModel->getUserRights($this->session->UserID)))
            {
                $userID = $this->session->UserID;
            }
        }
        else
        {
            $userID = $this->session->UserID;
        }
        
        $allowed = array(
            'sharing'   => 'visible',
            'advice'    => 'advice'
        );
        foreach($allowed as $key => $value){
            $data[$value] = $this->input->post($key);
        }
        $data['id'] = $userID;
        
        $resuserupdate = $this->UserModel->updateUser($data);
        /*
        if ($resuserupdate)
            echo "<script>alert('Modification effectuee')</script>";
            else
                echo "<script>alert('Modification echouee')</script>";
                */
        $this->index($userID);
    }
    public function remove($userID=null){
        //  remove all data sources (and references) owned by user
        //  remove user info and link to this user (ex: advisor)
        // then disconnect
        if($userID != $this->session->UserID){ // TODO and get right
            $userID = intval($this->session->UserID);
            if(!array_key_exists('EDIT_USER'/*TODO correct right (edit user) */,$this->UserModel->getUserRights($this->session->UserID))){
                $userID = $this->session->UserID;
            }
        } else {
            $userID = $this->session->UserID;
        }
        
        $resultatdel1 =  $this->DataSourceModel->deleteAllDataSourcesUser($userID);
        $resultatdel2 =  $this->UserModel->deleteUserAllRole($userID);
        $resultatdel3 =  $this->UserModel->deleteUser($userID);
        if ($resultatdel1 && $resultatdel2 && $resultatdel3) {
            echo "<script charset='ISO-8859-1'>alert('Suppression des donnees effectuee')</script>";
            $this->session->sess_destroy();
            $this->load->view('connection');
        //      redirect('/');
        } else {
            echo "<script charset='ISO-8859-1'>alert('Suppression echouee, veuillez contacter l'administrateur')</script>";
            $this->load->view('profil');
        }
            
    }
    public function data($userID=null){
        // TODO update rights
    }
    public function password($userID=null){
        if($userID != $this->session->UserID){ // TODO and get right
            $userID = intval($this->session->UserID);
            if(!array_key_exists('EDIT_USER'/*TODO correct right (edit user) */,$this->UserModel->getUserRights($this->session->UserID))){
                $userID = $this->session->UserID;
            }
            }else{
                $userID = $this->session->UserID;
            }
        // TODO update infos

        $data['id'] = $userID;
     
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'mot de passe', 'trim|required|min_length[4]',
            array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('passwordconfirm', 'Password Confirmation', 'matches[password]');
        
        $this->load->view('header');
        
        $data = $this->UserModel->getUser($this->session->UserID);
        $data['username']       = $data['login'];
        $data['user_id']        = $data['id'];
        $data['sharing']        = $data['visible'];
        $data['advise']         = $data['advise'] = 1;
        //     $data['editable_login'] = $editable_login;
        foreach($data as $key => $value)
        $data[$key] = html_escape($value);
           
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('profil',$data);
        } else {
            $data2['id'] = $this->session->UserID;
            $data2['password'] = $this->input->post('password');
            $resultatUpdatePassword =  $this->UserModel->updateUser($data2);
            if (!$resultatUpdatePassword) {
                $this->load->view('profil',$data);
                //echo "<script charset='ISO-8859-1'>alert('Changement de MDP �chou�e')</script>";
            } else {   
                //echo "<script charset='ISO-8859-1'>alert('Changement r�ussi')</script>";
                $this->load->view('profil',$data);
            }
        }
        
        $this->load->view('footer');
    }
    
  //  public function roles(){
       // TODO update rights
//      $data = $this->UserModel->getUserRoles($this->session->UserID);  
  //     $data['test']= $data['id'];
 //      $this->load->view('profil',$data);
 //   }
}