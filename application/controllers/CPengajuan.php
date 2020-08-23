<?php

class CPengajuan extends CI_Controller 
{
    public function __construct()
	{
		parent::__construct();
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelGue');
		$this->load->model('ModelData');
	}

	function index(){
		$hasil=$this->ModelGue->semuadata('pengajuan');
		$data=array('datakr'=>$hasil);
		$this->load->view('Pengajuan/ListPengajuan',$data);
	}
}

?>