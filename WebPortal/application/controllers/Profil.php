<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
    public function __construct(){
        // TODO ensure that user is logged
        parent::__construct();
        $this->load->model('UserModel');
    }
    public function index($userID=null){
//        if(is_null($userID)) $userID = $this->session->UserID;
//        $editable_login = FALSE;
/*        if($userID != $this->session->UserID){
            // TODO get right to change user personal info
            $editable_login = TRUE;
        }*/
        $data                   = $this->UserModel->getUser($this->session->UserID);
        $data['username']       = $data['login'];
        $data['user_id']        = $data['id'];
        $data['sharing']        = $data['visible'];
        $data['advice']         = $data['advice'];
//        $data['editable_login'] = $editable_login;
        foreach($data as $key => $value)
            $data[$key] = html_escape($value);
        
  
         $dataRoles = $this->UserModel->getUserRoles($this->session->UserID);
         $firstArray=$dataRoles[0];
         $data['test']= $firstArray['id'];            
         $data['roleName']= $firstArray['name'];      
                
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
        // TODO update infos
        
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
        if ($resuserupdate)
            echo "<script>alert('Modification effectuée')</script>";
        else 
            echo "<script>alert('Modification échouée')</script>";
        
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
        // TODO update infos
        
        $allowed = array(
            'sharing'   => 'visible',
            'advice'    => 'advice'
        );
        foreach($allowed as $key => $value){
            $data[$value] = $this->input->post($key);
        }
        $data['id'] = $userID;
        
        $resuserupdate = $this->UserModel->updateUser($data);
        if ($resuserupdate)
            echo "<script>alert('Modification effectuée')</script>";
            else
                echo "<script>alert('Modification échouée')</script>";
                
        $this->index($userID);
    }
    public function remove($userID=null){
        // TODO remove all data sources (and references) owned by user
        // TODO remove user info and link to this user (ex: advisor)
        // then disconnect
            if($userID != $this->session->UserID){ // TODO and get right
                $userID = intval($this->session->UserID);
                if(!array_key_exists('EDIT_USER'/*TODO correct right (edit user) */,$this->UserModel->getUserRights($this->session->UserID))){
                    $userID = $this->session->UserID;
                }
            }
            else
            {
                $userID = $this->session->UserID;
            }
            
            echo 'Deleted successfully.';
            $this->UserModel->deleteUserAllRole($userID);
            $this->UserModel->deleteUser($userID);
            $this->session->sess_destroy();
            redirect('/');
    
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
           
        $dataRoles = $this->UserModel->getUserRoles($this->session->UserID);
        $firstArray=$dataRoles[0];
        $data['test']= $firstArray['id'];
        $data['roleName']= $firstArray['name'];     
              
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('profil',$data);
        }
        else
        {
            $data2['id'] = $this->session->UserID;
            $data2['password'] = $this->input->post('password');
            $resultatUpdatePassword =  $this->UserModel->updateUser($data2);
            if (!$resultatUpdatePassword)
            {
                $this->load->view('profil',$data);
                echo "<script charset='ISO-8859-1'>alert('Changement de MDP échouée')</script>";
            }
            else
            {   
                echo "<script charset='ISO-8859-1'>alert('Changement réussi')</script>";
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