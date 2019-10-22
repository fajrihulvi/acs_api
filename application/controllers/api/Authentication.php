<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Authentication extends REST_Controller {

	function __construct($config = 'rest') {
		parent::__construct($config);

		$data = getallheaders();
		$this->deviceKey = !empty($data['Devicekey']) ? $data['Devicekey'] : '';
		$this->appKey = !empty($data['Appkey']) ? $data['Appkey'] : '';

		if(empty($this->deviceKey) || empty($this->appKey))
		{
			$this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
		}
	}

	function index_get()
	{
		$this->db->select('email, password');
		$pemohon = $this->db->get('m_pemohon')->result();

		$status = keyAuth($this->deviceKey, $this->appKey);

		if($status){
			if ($pemohon)
			{
				$this->response($pemohon, REST_Controller::HTTP_OK); 
			}
		}
		else
		{
			$this->response([
				'status' => FALSE,
				'message' => 'Key Authentication Failed'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	function login_post()
	{
		$email = $this->post('email');
		$password = $this->post('password');

		$this->response([
			'email' => $email,
			'password' => $password
		], REST_Controller::HTTP_OK);
	}
}
?>