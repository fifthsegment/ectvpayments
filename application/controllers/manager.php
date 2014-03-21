<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
		$this->load->helper('url');


    }

	public function index()
	{
		$this->load->view('manager');
	}



	public function saveFile($fileName=NULL,$Akey, $Avalue, $bool){
		$file = "application/config/".$fileName.".php";
		$pattern = '$config[\''.$Akey.'\']';
		$newValue = $Avalue;
		$text = file($file, FILE_IGNORE_NEW_LINES);
		foreach ($text as $key => $line)
		{
		   if(strpos($line, $pattern) !== false){
		   			if (!$bool)
		            	$text[$key] = $pattern . " = '". $newValue . "';";
		        	else 
		 		        $text[$key] = $pattern . " = ". $newValue . ";";

		        }else{
		            //$out = $line;
		        }
		}
		file_put_contents($file, implode("\n", $text));
	}

	public function oldSaveFile(){
				// $out = '';
		// $pattern = '$db[\'default\'][\'username\']';
		// $newValue = 'roots-dsa-sasa';
		// $fileName = "application/config/database.php";
		
		// if(file_exists($fileName)) {
		//     $file = fopen($fileName,'r+');
		//     $fileline = '';
		//     while(!feof($file)) { 

		//         $line = fgets($file);
		//        	$fileline = $fileline.$line;
		//         if(strpos($line, $pattern) !== false){
		//             $out = $pattern . " = '". $newValue . "'";
		//         }else{
		//             $out = $line;
		//         }

		//     }
		//     file_put_contents($fileline, $out);
		//     fclose($file);
		// } 
	}


	// $this->load->library('paypal_class');
	// 	$this->paypal_class->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
	// 	//$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';	 // paypal url
	// 	$this->paypal_class->add_field('currency_code', 'USD');
	// 	$this->paypal_class->add_field('business', 'rechos16@gmail.com');
	// 	//$this->paypal_class->add_field('business', $this->config->item('bussinessPayPalAccount'));
	// 	$this->paypal_class->add_field('return', site_url('shoppingcart/return')); // return url
	// 	$this->paypal_class->add_field('cancel_return', site_url('shoppingcart/cancel')); // cancel url
	// 	$this->paypal_class->add_field('notify_url', site_url('shoppingcart/notify')); // notify url
		
	// 	$this->paypal_class->add_field('item_name', 'Testing');
	// 	$this->paypal_class->add_field('amount', $totalPrice);
	// 	$this->paypal_class->add_field('custom', '1313');

	public function paypal_save(){
		foreach ($_POST as $key => $value) {
			//echo $key.' = '.$value;
			if ($key == 'sandbox')
				$this->saveFile('paypal','paypal_'.$key,$value,1);
			else
				$this->saveFile('paypal','paypal_'.$key,$value);
		}
		redirect('manager/paypal');
	}

	

	

	public function paypal_logview() {
		$this->load->model("Logloader");

        $this->load->library("pagination");
        $this->load->database();
        $config = array();
        $config["base_url"] = site_url("manager/paypal_logview");
        $config["base_url"] = $config["base_url"]."/";
        $config["total_rows"] = $this->Logloader->record_count("paymentsystem_paypal_log");
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $data['page_title'] = 'Paypal';
		$data['view_to_load'] = 'paypal_logs';
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Logloader->fetch_logs("paymentsystem_paypal_log",$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view("template", $data);
    }

	public function paypal_notify(){
		//.'\paymentsystem.log'
		$log_file = 'application\logs';
		//echo $log_file;
		$log_file = realpath($log_file);
		$filename = 'paypal';
		$log_file = $log_file."\paymentsystem_$filename.log";
		//echo $log_file;
		$this->config->load('paypal');
		$this->load->helper('path');
		$this->load->library('paypalcls');
		$paypal_handler = new paypalcls();
		$paypal_handler->sandbox($this->config->item('paypal_sandbox'));
		$paypal_handler->ipn_log_file = $log_file;
		$paypal_handler->set_email($this->config->item('paypal_email'));
		$paypal_handler->paypal_url = $this->config->item('paypal_url');
		$paypal_handler->notify_url = $this->config->item('paypal_ackurl');
		$paypal_handler->acknowledgement_url = 'ssl://www.sandbox.paypal.com';
      //$paypal_handler->achknowledgement_host = 'www.sandbox.paypal.com';
		//$paypal_handler->return_url = $this->config->item('paypal_returnurl');		//$this->paypal_class->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';	 // paypal url
		$this->load->database();

		if ($paypal_handler->validate_ipn()) {
			$text = '['.date('m/d/Y g:i A').']';
			foreach ($paypal_handler->ipn_data as $key=>$value) {
		         $ipn_data .= "$key=$value, ";
		    }
			$data = array(
			   'Date_Time' => $text ,
			   'Status' => 'SUCCESS',
			   'LOG' => $ipn_data
			);

			$this->db->insert('paymentsystem_paypal_log', $data); 
		}else{
			$text = '['.date('m/d/Y g:i A').']';
			foreach ($paypal_handler->ipn_data as $key=>$value) {
		         $ipn_data .= "$key=$value, ";
		    }
			$data = array(
			   'Date_Time' => $text ,
			   'Status' => 'FAIL',
			   'LOG' => $ipn_data.' '.$paypal_handler->last_error
			);

			$this->db->insert('paymentsystem_paypal_log', $data);

		}
	}

	public function paypal_test(){
		$this->config->load('paypal');
		$this->load->library('paypalcls');
		$paypal_handler = new paypalcls;

		$paypal_handler->set_email($this->config->item('paypal_email'));
		$paypal_handler->paypal_url = $this->config->item('paypal_url');
		$paypal_handler->return_url = $this->config->item('paypal_returnurl');
		$paypal_handler->notify_url = $this->config->item('paypal_ackurl');

		$paypal_handler->add_field('currency_code', $this->config->item('paypal_currencycode'));
		$paypal_handler->add_field('amount', 1);
		$paypal_handler->submit_paypal_post();
	}


	public function paypal(){
		$this->config->load('paypal');
		$data['page_title'] = 'Paypal';
		$data['view_to_load'] = 'paypal';
		$this->load->view('template',$data);
	}
}

