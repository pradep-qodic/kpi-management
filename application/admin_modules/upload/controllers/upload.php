<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('admin_vehicle_helper');
		$this->load->library('admin_vts_auth');
		$this->load->library('vehicle_tracking_service_auth');
		$this->load->library('form_validation');
	}

	public function index()
	{
		return;
	}
	public function updatemodal()
	{
		if ($_POST) {
			$imgData = $this->input->post('imageData', true);
			$base64img = substr($imgData, 9);
			if (isset($base64img) && $base64img) {
				$base64img = str_replace('data:image/png;base64,', '', $base64img);
				$base64img = str_replace(' ', '+', $base64img);
				//$base64img = preg_replace('#^data:image/[^;]+;base64,#', '', $base64img);
				$base64img = base64_decode($base64img);
				$fName = uniqid() . '.png';
				$file = $this->config->item('upload_dir') . "adminLogo/" . $fName;
				$img = file_put_contents($file, $base64img);
				if ($img) {
					$this->load->helper('date');
					$now = time();
					$clId = 1;
					if ($clId) {
						$data['json'] = json_encode(array("status" => "success", "message" => "Logo Uploading...", "data" => array("fileName" => $fName)));
						$this->load->view('json_view', $data);
						return;
					} else {
						$data['json'] = json_encode(array("status" => "error", "message" => "Unable to upload image."));
						$this->load->view('json_view', $data);
						return;
					}
				} else {
					$data['json'] = json_encode(array("status" => "error", "message" => "Unable to upload image."));
					$this->load->view('json_view', $data);
					return;
				}
			} else {
				$data['json'] = json_encode(array("status" => "error", "message" => "Unable to upload image."));
				$this->load->view('json_view', $data);
				return;
			}
			return;
		}
		$dt['modalImages'] = $this->input->get('img', true);
		$dt['main_content'] = 'updatemodal';
		$this->load->view('outputPage', $dt);
		return;
	}
}
