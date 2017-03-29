<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
		$loggedIn = $this->auth->isLoggedIn();
        if ($loggedIn ) redirect('general');
		
    }
    
    function index() {
        
        $data['page']= 'login';
        $data['title'] = 'Login Page';
        $this->load->view('layout/general',$data);
        
        
        
    }
        
        
    function logon() {
        
        $base = 'required|trim|xss_clean';
        $this->form_validation->set_rules('email', 'Email', $base.'|valid_email|max_length[40]')
                              ->set_rules('password', 'Password', $base);

        
        if ($this->form_validation->run() !== false) {
            $loginOk = $this->auth->logIn($this->input->post('email'),$this->input->post('password'));
            if ($loginOk != FALSE){
                session_start();
                $this->session->set_userdata($loginOk);
                redirect('general');
                
            } else {
                $data['page']= 'login';
                $data['title'] = 'Login Page';
                $this->load->view('layout/general',$data);
                echo 'error login';
            }
            
            
        } else {
            $data['page']= 'login';
            $data['title'] = 'Login Page';
            $this->load->view('layout/general',$data);
            
        }
        
        
    }
     function register() {   
        
        $base = 'required|trim|xss_clean';

        $this->form_validation->set_rules('username', 'Username', $base.'|max_length[40]')
                    ->set_rules('email', 'Email', $base.'|valid_email|max_length[50]')
                    ->set_rules('password', 'Password', $base.'|matches[password_conf]')
                    ->set_rules('password_conf', 'Password Confirmation', $base.'|min_length[5]');

        if ($this->form_validation->run())  {
            
            $this->auth->create_user(
                            $this->input->post('username'),
                            $this->input->post('password'),
                            $this->input->post('email')
                        );

            $this->session->set_flashdata('registration_message', 'Thanks for registering.  Log in now!');
            redirect();
        }

        $this->load->view('register');
    }
}