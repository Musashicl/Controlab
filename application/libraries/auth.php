<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth
 *
 * @author Administrador
 */
class Auth {

    
    
    function __construct() {
        $this->CI =& get_instance();
        
    }
    
    
    public function logIn($email, $password) {
    //---------------------------------------------------------------
        $q = Model\Usuarios::limit(1)->find_by_email($email,FALSE);
       // print_r ($q);exit;
        if (count($q) > 0 ) {
            if ( $q->password == do_hash($password)){
                $userdata = array( 'userId' => $q->id,
                               	   'userRole' => $q->userRole,
								   'app' => $q->app
								   );
								   
                                 
                return $userdata;    
            }

        }
        return FALSE;
    }
    
    public function logOut() {
    //---------------------------------------------------------------
        
    }
    
    public function createUser($username, $password, $email) {
    //---------------------------------------------------------------
        
       // $qry = 
    }
    
  public function isLoggedIn() {
    //---------------------------------------------------------------
        if ( $this->CI->session->userdata('userId') && $this->CI->session->userdata('userId') != '') {
            return TRUE;
        }
        return FALSE;
        
    }
    
    public function changePassword() {
    //---------------------------------------------------------------
        
    }
    
    
    public function forgotPassword() {
    //---------------------------------------------------------------
        
    }
}

?>
