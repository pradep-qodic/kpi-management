<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_vts_auth 
{
    function __construct()
    {	
	   $this->ci=& get_instance();
       $this->ci->load->model('admins/admin_model');
    }
	
	function process_login($login_array_input = NULL){				
		if(!isset($login_array_input) OR count($login_array_input) != 2)
                return false;
            //set its variable
            $username = $login_array_input[0];
            $password = $login_array_input[1];			
            // select data from database to check user exist or not?
            $query = $this->ci->db->query("SELECT * FROM `users` WHERE isDeleted=0 and `email`= '".$username."' LIMIT 1");
            if ($query->num_rows() > 0)
            {
				
				$row = $query->row();
		        $user_pass = $row->password;
				$user_id = $row->email;
				$admin_salt = $row->salt;											
                if($this->encryptUserPwd($password,$admin_salt) === $user_pass){
                	
					$data['ShiftLoggedIn'] = true;
					$data['Shift_email']=$username;						
					$data['adminId']=$row->user_id;						
					$data['UserName']=$row->name;																
										
					$this->ci->session->set_userdata($data);				
					$rUrl = base_url().'admins/dashboard';										
					$data ['json'] = json_encode ( array (
							"status" => "success",
							"message" => "Login Success", 
							"redirect_url" => $rUrl 
					) );
					return $data;
                }else{					
					$data ['json'] = json_encode ( array (
							"status" => "error",
							"message" => "<p>Invalid Email or Password.</p>", 
							
					) );
					return $data;
				}
            }else{				
					$data ['json'] = json_encode ( array (
							"status" => "error",
							"message" => "<p>Unable to find your account.</p>", 
							
					) );
					return $data;
            }
	}
	function check_logged(){
		return ($this->ci->session->userdata('ShiftLoggedIn'))?TRUE:FALSE;
	}
	function logged_id(){
		return ($this->ci->check_logged())?$this->ci->session->userdata('ShiftLoggedIn'):'';
	} 	
	function _admin_signin_redirect(){
			
	   if(!$this->_is_logged_in()){
				
			$rUrl=base_url().'admins';
			redirect($rUrl);					
	   }
			
					
	}
    function check_email(){
		$query = $this->ci->db->query("SELECT * FROM `admin` WHERE `email`= '".$user_id."' LIMIT 1");
	   	if ($query->num_rows() > 0)
	   	{
	   		$row = $query->row();
	   		$email = $row->email;
			if($email){
	   			return true;
	   		}
	   		return false;
	   	}		
		
	}
	function _member_area(){
		if(!$this->_is_logged_in()){
			redirect('');
		}
	}
	function _member_area_redirect(){
        if(!$this->_is_logged_in()){
		
            $this->ci->load->helper('url');
            $this->ci->session->set_userdata('last_page', current_url());
			redirect('admins','refresh');
            return;
		}
	}	
	function _is_logged_in(){
		if(null !== $this->ci->session->userdata('ShiftLoggedIn') && $this->ci->session->userdata('ShiftLoggedIn')){
			return true;
		}else{
			return false;
		}
	}
	function encryptUserPwd($pwd, $salt) {
            return sha1(md5($pwd) . $salt);
    }
	// Generate Random Salt for Password encryption
    function genRndSalt() {
            return $this->genRndDgt(8, true);
    }
	// Generate Random Digit
    function genRndDgt($length = 8, $specialCharacters = true){
        $digits = '';	
        $chars = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";

        if($specialCharacters === true)
                $chars .= "!?=/&+,.";


        for($i = 0; $i < $length; $i++) {
                $x = mt_rand(0, strlen($chars) -1);
                $digits .= $chars{$x};
        }
        return $digits;
    } 
	// Generate Random code for driver
	function genRnddrivercode() {
            return $this->genRndDcode(8, true);
    }	
    function genRndDcode($length = 8){
        $drivercode = '';	
        $chars = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";
        for($i = 0; $i < $length; $i++) {
                $x = mt_rand(0, strlen($chars) -1);
                $drivercode .= $chars{$x};
        }
        return $drivercode;
    }

}