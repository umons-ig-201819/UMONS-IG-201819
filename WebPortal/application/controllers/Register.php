<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function index(){
        $data = array();
        $data2 = array();
        if($this->input->post('registering'))
        {
            $data['lastname'] = ($this->input->post('lastname'));
            $data['firstname'] = ($this->input->post('firstname'));
            $data['birthdate'] = ($this->input->post('birthdate'));
            $data['email'] = ($this->input->post('email'));
            $data['phone'] = ($this->input->post('phone'));
            $data['mobile'] = ($this->input->post('mobile'));
            $data['gender'] = ($this->input->post('gender'));
            $data['login'] = ($this->input->post('login'));
            $data['password'] = ($this->input->post('password'));
            $data['visible'] = ($this->input->post('visible'));
            $data['advice'] = 0;
 
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('login', 'login', 'trim|required|min_length[4]|max_length[12]');
            $this->form_validation->set_rules('firstname', 'firstname', 'trim|required|min_length[2]|max_length[12]');
            $this->form_validation->set_rules('lastname', 'lastname', 'trim|required|min_length[2]|max_length[12]');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
            $this->form_validation->set_rules('password', 'mot de passe', 'trim|required|min_length[4]',
                array('required' => 'You must provide a %s.'));
            $this->form_validation->set_rules('confirm_mdp', 'Password Confirmation', 'matches[password]');
            
            $this->load->view('header');
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('register',$data);
            }
            else
            {
                list($resultatRegister,$errorTextorID) = $this->UserModel->addUser($data);
                if (!$resultatRegister) 
                {
                    $data['error'] = $errorTextorID;
                    $this->load->view('register',$data);
                    echo "<script>alert('Inscription échouée')</script>";
                }
                else
                {
                    echo "<script>alert('Inscription réussie en tant que citoyen')</script>";
                    $roleid = '6';
                    $this->UserModel->addUserRole($errorTextorID, $roleid);
                    $this->load->view('connection');
                }
            }
            $this->load->view('footer');
  
        }
        else
        {
        $this->load->view('header');
        $this->load->view('register',$data);
        $this->load->view('footer');
        }
    }
}