<?php
	/*
		Author: Parth Dalwadi
		Date: 30/03/2017
		Version: 1.0
	*/
	class users_model extends CI_Model{	
		var $driver_details = "driver_details";		
		var $access_token = "access_token";		
		var $trip = "trip";		
		function __construct(){
			parent::__construct();
		}
		function removeToken($tokenCode){
			$query = $this->db->query("delete FROM $this->access_token where tokenCode=?",$tokenCode);
			if($query){
				return true;
				}else{
				return false;
			}
		}	
		function storeToken($id, $tokenCode,$tableId){
			$where = $tableId." = $id";
			$str = $this->db->update_string($this->access_token, array("tokenCode"=>$tokenCode), $where);
			$query = $this->db->query($str);
			if($this->db->affected_rows()>0){
				return true;
				}else{
				$this->db->trans_start();
				$this->db->insert($this->access_token,array($tableId=>$id,"tokenCode"=>$tokenCode));
				$insert_id = $this->db->insert_id();
				$this->db->trans_complete();
				return  $insert_id;
			}
		}
		function getUsersDetails($did){
			$this->db->where('driver_id',$did);
			$q = $this->db->get($this->driver_details);
			return $q->result();
		}		
		function UpdateUserdetail($did,$cdata){
			$data = (array)$cdata;
			$where = "driver_id = '$did'";
			$str = $this->db->update_string($this->driver_details, $data, $where);
			$query = $this->db->query($str);
			return $query;
		}
		function getUsersDetailsbytoken($tid){
			$this->db->where('tokenCode',$tid);
			$q = $this->db->get($this->access_token);
			return $q->result();
		}
		function getUserstrips($uid){
			$this->db->where('driver_id',$uid);
			$this->db->where('status',2);
			$q = $this->db->get($this->trip);
			return $q->result();
		}	
		function update_cordinates($did,$cdata){
			$data = (array)$cdata;
			$where = "driver_id = '$did'";
			$str = $this->db->update_string($this->trip, $data, $where);
			$query = $this->db->query($str);
			return $query;
		}
	}
	
?>
