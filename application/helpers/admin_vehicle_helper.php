<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Author: Ajay Patel
Date: 16/02/2017
Version: 2.0
*/

// ------------------------------------------------------------------------

if ( ! function_exists('admin_base_url'))
{
	function admin_base_url($uri = '')
	{
		return base_url($uri);
		/* $u=get_instance()->config->base_url();
        $res=substr($u, 0, -6);
		return $res.$uri;  */
	}
}
if ( ! function_exists('base_url1'))
{
    function base_url1($uri = '')
    {
        return base_url($uri);
    }
}

if (!function_exists('storename'))
{
	function storename($id)
	{
		$ci=& get_instance();		
		$uId=$ci->session->userdata('adminId');		
		$query = $ci->db->query("SELECT * FROM `store` WHERE isDeleted=0 and store_id=?",$id);		
		if($query->num_rows()>0){
			return $query->result()[0]->store_name;
		}
		return false;
	}
}

if (!function_exists('isSuperAdmin'))
{
	function isSuperAdmin()
	{
		$ci=& get_instance();		
		$uId=$ci->session->userdata('adminId');		
		$query = $ci->db->query("SELECT * FROM `users` WHERE user_id=? and isDeleted=0 and users_type='1' and isDeleted=0",array($uId));		
		if($query->num_rows()>0 && isset($query->row()->users_type) && $query->row()->users_type==1){
			return true;
		}
		return false;
	}
}

if (!function_exists('number_format_val'))
{
	function number_format_val($val){
		if(strpos($val, 'm')){		
			return $val;
		}else{
			return round($val);
		}		
	}
}

if (!function_exists('rupiss_format_val'))
{
	function rupiss_format_val($val){
		/* if(strpos($val, 'm')){		
			return '&#36;'.$val;
		}else{
			$val=round($val);
			if($val < 1000){				
				$formatter = new NumberFormatter('en_UK',  NumberFormatter::CURRENCY);
				return $formatter->formatCurrency($val, 'USD');
			}else{
				$formatter = new NumberFormatter('en_UK',  NumberFormatter::CURRENCY);
				$nval=$formatter->formatCurrency($val, 'USD');
				return explode('.',$nval)[0];
			}
		} */
		if(strpos($val, 'm')){		
			return '&#36;'.$val;
		}else{
			return '$ '.$val;
		}		
	}
}


// ------------------------------------------------------------------------
