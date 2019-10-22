<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Pelanggan extends REST_Controller {

	function __construct($config = 'rest') {
		parent::__construct($config);
		$this->load->database();
		$this->load->helper('api_helper');

		$data = getallheaders();
		$this->deviceKey = !empty($data['Devicekey']) ? $data['Devicekey'] : '';
		$this->appKey = !empty($data['Appkey']) ? $data['Appkey'] : '';

		if(empty($this->deviceKey) || empty($this->appKey))
		{
			$this->response(NULL, REST_Controller::HTTP_NOT_FOUND);
		}
	}

	function index_get() {
		$id = $this->get('id');

		if ($id == '') {
			$pelanggan = $this->db->get('m_pelanggan')->result();
		} else {
			$this->db->where('id', $id);
			$pelanggan = $this->db->get('m_pelanggan')->result();
		}
		
		$status = keyAuth($this->deviceKey, $this->appKey);

		if($status){
			if ($pelanggan)
			{
				$this->response($pelanggan, REST_Controller::HTTP_OK); 
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

	function index_post() {
		$data = array(
			'nama'     => $this->post('nama'),
			'alamat'    => $this->post('alamat'),
			'kodepos'    => $this->post('kodepos'),
			'telepon'    => $this->post('telepon'),
			'tipe_identitas'    => $this->post('tipe_identitas'),
			'no_identitas'    => $this->post('no_identitas'),
			'berkas_identitas'    => $this->post('berkas_identitas'),
			'no_npwp'    => $this->post('no_npwp'),
			'berkas_npwp'    => $this->post('berkas_npwp'),
			'tgl_dibuat'    => date('Y-m-d'),
			'status'    => $this->post('status'),
			'id_pemohon'    => $this->post('id_pemohon'),
		);

		$insert = $this->db->insert('m_pelanggan', $data);
		if ($insert) {
			//$this->response($data, REST_Controller::HTTP_OK);
			$this->response([
				'status' => TRUE,
				'message' => 'Data Berhasil Disimpan'
			], REST_Controller::HTTP_OK);

		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data Gagal Disimpan'
			], REST_Controller::HTTP_BAD_GATEWAY);
		}
	}
}
?>