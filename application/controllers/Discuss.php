<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discuss extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function create($idTask) {
		// print_r($this->session->all_userdata());
		// echo $idTask;

		$this->load->view('template/header');
		// $this->load->view('dashboard/dashboard2', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/footer');
	}
}

