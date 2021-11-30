<?php

class MY_Controller extends CI_Controller {
	private $dataParse = [];

	public function __construct()
    {
        parent::__construct();
		if (!$this->session->userdata('ses_username')) {
			redirect('auth');
		}
    }

	public function getParseData()
	{
		return $this->dataParse;
	}

	public function setHeaderPage($header, $isBack = false)
	{
		$this->dataParse['header'] = [
			"title" => $header,
			"is_back" => $isBack,
		];
	}

	public function setData($key, $data)
	{
		$this->dataParse['datas'][$key] = $data;
	}

	public function response($code = 200, $message = "", $data = [])
	{
		$statusCode = true;
		if ($code >= 300) {
			$statusCode = false;
		}

		return [
			"is_success" => $statusCode,
			"message" => $message,
			"data" => $data 
		];
	}
}
