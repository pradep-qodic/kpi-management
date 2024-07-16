<?php
	/**
		Author: Ajay Patel 
		Date: 16/03/2017
		Version: 2.0
	*/
	class Users extends MY_Controller {
		function __construct() {
			parent::__construct ();
			$this->load->library( 'vehicle_tracking_service_auth' );
			$this->load->model('users_model');
			$this->load->library('form_validation');		
			$this->load->helper('date');
		}
		function index() {
			redirect('users/signin');
			return;
		}	
		function signin(){			
			if ($_POST) {
					$config = array (
							array (
							'field' => 'drivercode',
							'label' => 'Drivercode',
							'rules' => 'trim|required'
							)
						);				
					$this->form_validation->set_rules ( $config );
					
					if ($this->form_validation->run () === false) {
						$this->form_validation->set_error_delimiters(' ', ' ');
						$arrV [] = validation_errors ();
						$data ['json'] = json_encode ( array ("status" => "error","message" => $arrV) );
						$this->load->view ( 'json_view', $data );
						return;				
					} else {
						$driver_code = $this->input->post ( 'drivercode', true );
						$temps = $this->vehicle_tracking_service_auth->process_service_login ( array ($driver_code));
						return;
					}					
			}else{
				$data ['json'] = json_encode (array("status" => "error","message" => $this->config->item('validInput'),"data" => ""));
				$this->load->view ( 'json_view', $data );
				return;
			}
		}
		function forgetDrivercode(){
			if ($_POST) {
				$config = array (
							array (
							'field' => 'driver_email',
							'label' => 'Driver Email',
							'rules' => 'trim|required'
							)
						);				
				$this->form_validation->set_rules ( $config );
				if ($this->form_validation->run () === false) {
					$this->form_validation->set_error_delimiters('', '');
					$arrV[]=validation_errors();
					$data['json'] = json_encode(array("status"=>"error","message"=>$arrV));
					$this->load->view('json_view', $data);
				} else {
					$userId=$this->session->userdata('userId');
					$driveremail = $this->input->post('driver_email');						
					$UsersDetaisl=$this->users_model->getUsersDetails($userId);						
					if($UsersDetaisl[0]->driver_email == $driveremail){						
						$randrivercode       = rand(0,10000000);
						$ddata['driver_id'] = $userId;
						$ddata['driver_code'] = $randrivercode;
						$updateddata=$this->users_model->UpdateUserdetail($userId,$ddata);						
						if ($updateddata) {
							try {
								$dt['logo'] = $this->config->item('email_logo');
								$dt['Drivercode'] = $randrivercode;
								$dt['Driveremail'] = $driveremail;
								$email  = $driveremail;
								$this->load->library('email', $this->config->item('email_config'));
								$this->email->from($this->config->item('email_from'), $this->config->item('applicationName'));
								$this->email->to($email);
								$this->email->subject(strtolower($this->config->item('applicationName')) . ": Forgot Password Link");
								$msg = $this->load->view('email/forgot_email_driver', $dt, TRUE);
								$this->email->message($msg);
								$this->email->send();
							}
							catch (Exception $e) {}							
							$data['json'] = json_encode(array("status"=>"success","message"=>"Driver code reset successfully."));
							$this->load->view('json_view', $data);
							return;
						}else{
							$data['json'] = json_encode(array("status"=>"error","message"=>"Unable to Change Your Driver Code"));
							$this->load->view('json_view', $data);
							return;
						}
					}else{
						$data['json'] = json_encode(array("status"=>"error","message"=>"Enter valid email Address..!"));
						$this->load->view('json_view', $data);
						return;
					}
				}
			}else{
				$data ['json'] = json_encode (array("status" => "error","message" => $this->config->item('validInput'),"data" => ""));
				$this->load->view ( 'json_view', $data );
				return;
				}
		}	
		function save_cordinates(){	
			$userdatas = $this->vehicle_tracking_service_auth->validateTokenCode();
			if ($_POST) {
				$config = array (
							array (
							'field' => 'latitude',
							'label' => 'Latitude',
							'rules' => 'trim|required'
							),array (
							'field' => 'longitude',
							'label' => 'Longitude',
							'rules' => 'trim|required'
							),array (
							'field' => 'access_token',
							'label' => 'AccessToken',
							'rules' => 'trim|required'
							)
						);				
				$this->form_validation->set_rules ( $config );
				
				if ($this->form_validation->run () === false) {
					$this->form_validation->set_error_delimiters(' ', ' ');
					$arrV [] = validation_errors ();
					$data ['json'] = json_encode ( array ("status" => "error","message" => $arrV));
					$this->load->view ( 'json_view', $data );
					return;				
				} else {
					$latitude = $this->input->post ( 'latitude', true );
					$longitude = $this->input->post ( 'longitude', true );					
					$user_id = $userdatas[0]->userId;
					$getusertripdatas = $this->users_model->getUserstrips($user_id);
					if(empty($getusertripdatas)){
						$data ['json'] = json_encode (array("status" => "error","message" =>"unable to find Trip")); 
						$this->load->view ( 'json_view', $data );
						return;
					}else{						
						$cdata['trip_latitude'] = $latitude;
						$cdata['trip_longitude'] = $longitude;
						$updatecordinates = $this->users_model->update_cordinates($user_id,$cdata);
						if ($updatecordinates) {
							$data['json'] = json_encode(array("status"=>"success","message"=>"Cordinates Insert successfully."));
							$this->load->view('json_view', $data);
							return;
						}else{
							$data['json'] = json_encode(array("status"=>"error","message"=>"Unable to Insert Cordinates"));
							$this->load->view('json_view', $data);
							return;
						}
					}					
				}
			}else{
				$data ['json'] = json_encode (array("status" => "error","message" => $this->config->item('validInput'),"data" => ""));
				$this->load->view ( 'json_view', $data );
				return;
			}
		}
	}								