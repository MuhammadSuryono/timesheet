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

	private function upload_files($path, $title, $files)
    {
        $config = array(
            'upload_path'   => $path,
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'. $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }

        return $images;
    }

	public function parseDateToTimestampApi($dateString) 
	{
		$data = "";
		$d = DateTime::createFromFormat('Y-m-d H:i:s', $dateString.' 00:00:00');
		if ($d === false) {
			$data = "Incorect Date";
		} else {
			$data = $d->getTimestamp();
		}

		return $data;
	}

	public function getNumberOfWeek($date) 
	{
		$date = new DateTime($date);
		$week = $date->format("W");
		return $week;
	}

	public function getDayNameOfDate($date)
	{
		$datetime = DateTime::createFromFormat('Y-m-d', $date);
    	return $datetime->format('l');
	}

	public function dateNowTimeStamp()
	{
		$now = new DateTime();
		$now->format('Y-m-d H:i:s'); 
		return $now->getTimestamp();
	}

	public function getStartAndEndDate($week) 
	{
		$year = date("Y");
		$dto = new DateTime();
		$dto->setISODate($year, $week);
		$ret['week_start'] = $dto->format('Y-m-d');
		$dto->modify('+5 days');
		$ret['week_end'] = $dto->format('Y-m-d');
		return $ret;
	}

	public function selisihHariByDate($date1, $date2)
	{
		$date1 = new DateTime($date1); 
		$date2 = new DateTime();
		$compare = $date1->diff($date2);
		return $compare;
	}
}
