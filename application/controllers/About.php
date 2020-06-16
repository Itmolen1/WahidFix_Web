<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {
	
	public function index()
	{
		$this->load->view('inc/header');
		$this->load->view('Aboutus_view');
		$this->load->view('inc/footer');
	}	
}
