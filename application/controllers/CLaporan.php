<?php

class CLaporan extends CI_Controller
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
    function Laporan_perbln(){
			// jika belom disi tanggal
            $this->session->set_userdata('muncul',False);
            $this->load->view('Laporan/LaporanPerbulan');
        
	}
	function Laporan_peruser(){
		// jika belom disi tanggal
		$this->session->set_userdata('muncul',False);
		$this->load->view('Laporan/LaporanPerUser');
	
}
}


?>