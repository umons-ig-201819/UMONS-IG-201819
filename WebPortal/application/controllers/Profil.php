<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
    }
    public function index(){
        $data = $this->UserModel->getUser($this->session->UserID);
        $data['username'] =  $data['login'];
        // TODO $gdpr, $advisor, $scientist, $farmer

        /* see
        * <br> $response['login']
        * <br> $response['visible'] default visibility attribute for user files (0=hidden, 1=visible, 2=on demand)
        * <br> $response['advice']  1 if a user is ok to receive advices and 0 if not
        */
        
        $this->load->view('header');
        $this->load->view('profil',$data);
        $this->load->view('footer');
    }
    public function update(){
        // TODO update infos
        $this->index();
    }
    public function rights(){
        // TODO update rights
        $this->index();
    }
    public function remove(){
        // TODO update rights
    }
    public function data(){
        // TODO update rights
    }
    public function password(){
        // TODO update rights
    }
}