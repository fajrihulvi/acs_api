<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Transaksi_Pasang_Baru extends REST_Controller {

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
			$transaksi_pasang_baru = $this->db->get('m_transaksi_pasang_baru')->result();
		} else {
			$this->db->where('id', $id);
			$transaksi_pasang_baru = $this->db->get('m_transaksi_pasang_baru')->result();
		}
		
		$status = keyAuth($this->deviceKey, $this->appKey);

		if($status){
			if ($transaksi_pasang_baru)
			{
				$this->response($transaksi_pasang_baru, REST_Controller::HTTP_OK); 
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
			'id_pelanggan'     => $this->post('id_pelanggan'),
			'tanggal'    => date('Y-m-d'),
			'id_tarif'    => $this->post('id_tarif'),
			'daya'    => $this->post('daya'),
			'tarif_lwpb'    => $this->post('tarif_lwpb'),
			'tarif_ujl'    => $this->post('tarif_ujl'),
			'tarif_bp'    => $this->post('tarif_bp'),
			'diperuntukkan'    => $this->post('diperuntukkan'),
			'tgl_rencana'    => $this->post('tgl_rencana'),
			'materai'    => $this->post('materai'),
			'status'    => 'pending',
		);

		$insert = $this->db->insert('m_transaksi_pasang_baru', $data);
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