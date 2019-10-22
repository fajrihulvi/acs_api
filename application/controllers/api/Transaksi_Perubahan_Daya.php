<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';

class Transaksi_Perubahan_Daya extends REST_Controller {

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
			$transaksi_perubahan_daya = $this->db->get('m_transaksi_perubahan_daya')->result();
		} else {
			$this->db->where('id', $id);
			$transaksi_perubahan_daya = $this->db->get('m_transaksi_perubahan_daya')->result();
		}
		
		$status = keyAuth($this->deviceKey, $this->appKey);

		if($status){
			if ($transaksi_perubahan_daya)
			{
				$this->response($transaksi_perubahan_daya, REST_Controller::HTTP_OK); 
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
			'daya_lama'    => $this->post('daya_lama'),
			'daya_baru'    => $this->post('daya_baru'),
			'tarif_lwpb_lama'    => $this->post('tarif_lwpb_lama'),
			'tarif_lwpb_baru'    => $this->post('tarif_lwpb_baru'),
			'tarif_ujl_lama'    => $this->post('tarif_ujl_lama'),
			'tarif_ujl_baru'    => $this->post('tarif_ujl_baru'),
			'tarif_bp_lama'    => $this->post('tarif_bp_lama'),
			'tarif_bp_baru'    => $this->post('tarif_bp_baru'),
			'alasan'    => $this->post('alasan'),
			'tgl_rencana'    => date('Y-m-d'),
			'materai'    => $this->post('materai'),
			'tipe_tarif_lama'    => $this->post('tipe_tarif_lama'),
			'tipe_tarif_baru'    => $this->post('tipe_tarif_baru'),
			'status'    => 'pending',
		);

		$insert = $this->db->insert('m_transaksi_perubahan_daya', $data);
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