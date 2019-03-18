<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
    public function __construct(){
        // TODO ensure that user is logged
        parent::__construct();
        $this->load->model('UserModel');
    }
    public function index($userID=null){
        if(is_null($userID)) $userID = $this->session->UserID;
        $editable_login = false;
        if($userID != $this->session->UserID){
            // TODO get right to change user personal info
            $editable_login = True;
        }
        $data                   = $this->UserModel->getUser($this->session->UserID);
        $data['username']       = $data['login'];
        $data['user_id']        = $data['id'];
        $data['sharing']        = $data['visible'];
        $data['advice']         = $data['advice'] == 1;
        $data['editable_login'] = $editable_login;
        foreach($data as $key => $value)
            $data[$key] = html_escape($value);
        
        $this->load->view('header');
        $this->load->view('profil',$data);
        $this->load->view('footer');
    }
    public function update($userID=null){
        if($userID != $this->session->UserID){ // TODO and get right
            $userID = intval($this->session->UserID);
            if(!array_key_exists('EDIT_USER'/*TODO correct right (edit user) */,$this->UserModel->getUserRights($this->session->UserID))){
                $userID = $this->session->UserID;
            }
        }else{
            $userID = $this->session->UserID;
        }
        // TODO update infos
        
        $data = array(
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
        
        $this->UserModel->updateUser($data);
        
        $this->index($userID);
    }
    public function rights($userID=null){
        // TODO update rights
        $this->index($userID);
    }
    public function remove($userID=null){
        // TODO remove all data sources (and references) owned by user
        // TODO remove user info and link to this user (ex: advisor)
        // then disconnect
    }
    public function data($userID=null){
        // TODO update rights
    }
    public function password($userID=null){
        // TODO update rights
    }
}