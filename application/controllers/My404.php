<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My404 extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$this->output->set_status_header('404');
		$this->load->view('inc/header');
		$this->load->view('My404_view');
		$this->load->view('inc/footer');
	}
}
