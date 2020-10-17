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
	public function send($nomor_transaksi)
	{
		
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
    	$config['smtp_port']    = '465'; 

        $config['smtp_user']    = 'koperasisahabatmandiri@gmail.com';
        $config['smtp_pass']    = 'Cakung99';
		$config['charset']    = 'iso-8859-1';
		
		//untuk email ke penerima sesuai database
		$hasil= $this->ModelData->datastat($nomor_transaksi);
		
		//untuk body email
		$data = array(
			'message'=> $this->input->post('message'),
			'namanya'=> $hasil->nama
				);
		$body = $this->load->view('Pengajuan/BodyEmail',$data,TRUE); 
		$this->load->library('email',$config);

		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
        $this->email->from('koperasisahabatmandiri@gmail.com', 'ADMIN_KOPERASI');
        $this->email->to($hasil->email); 
        $this->email->subject('Email Konfirmasi Pengajuan');
        $this->email->message($body);  
		// $this->email->send();
        
		if ($this->email->send()) {
		 			echo "send";
				} else {
				echo "aul";
				}
				
	}

	public function sendCancel($nomor_transaksi)
	{
		
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
    	$config['smtp_port']    = '465'; 

        $config['smtp_user']    = 'koperasisahabatmandiri@gmail.com';
        $config['smtp_pass']    = 'Cakung99';
		$config['charset']    = 'iso-8859-1';
		
		//untuk email ke penerima sesuai database
		$hasil= $this->ModelData->datastat($nomor_transaksi);
		
		//untuk body email
		$data = array(
			'message'=> $this->input->post('message'),
			'namanya'=> $hasil->nama
				);
		$body = $this->load->view('Pengajuan/BodyEmailNot',$data,TRUE); 
		$this->load->library('email',$config);

		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
        $this->email->from('koperasisahabatmandiri@gmail.com', 'ADMIN_KOPERASI');
        $this->email->to($hasil->email); 
        $this->email->subject('Email Pengajuan');
        $this->email->message($body);  
		// $this->email->send();
        
		if ($this->email->send()) {
		 			echo "send";
				} else {
				echo "aul";
				}
				
	}

	function ver($nomor_transaksi){
		
		$data = array('status'=>'Allowed');		
		// simpan data 
		$where=array('nomor_transaksi'=>$nomor_transaksi);
		$this->ModelGue->update('pengajuan',$data,$where);
		$a=base_url('CPengajuan');
		$this->send($nomor_transaksi);
		redirect($a);
		
	}
	function vercancel($nomor_transaksi){
		
		$data = array('status'=>'Not Allowed');
		
		// simpan data ke tabel jurusan
		$where=array('nomor_transaksi'=>$nomor_transaksi);
		$this->ModelGue->update('pengajuan',$data,$where);
		$a=base_url('CPengajuan');
		$this->sendCancel($nomor_transaksi);
		redirect($a);
	}
	
	function get_P($id){
		
		$data = array('nomor_transaksi'=>$id);
		$hasil = $this->ModelGue->GetWhere('pengajuan',$data); 

		echo json_encode($hasil);
	}
	function tambahP(){
		$hasil=$this->ModelGue->semuadata('pengajuan');
		$data= array('datakar'=>$hasil);
		$this->load->view('Pengajuan/NewPengajuan',$data);
	}

	function saveP(){
		// buat validasi data
		$this->form_validation->set_rules('id','No Transaksi','required|trim');
		$this->form_validation->set_rules('nomor','No nasabah','required|trim');
		

		if ($this->form_validation->run() == FALSE) {
			
			$hasil=$this->ModelGue->semuadata('pengajuan');
			$data= array(
					'datakar'=>$hasil,
					'pesan'=>validation_errors()
				); 
				
			$this->load->view('Pengajuan/ListPengajuan',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$kod=$this->input->post('id');
			$tgl=$this->input->post('tgl');
			$tglpinjam= $this->input->post('tglpinjam');
			$nomor=$this->input->post('nomor');
			$ket=$this->input->post('ket');
		

			
			// validasi data double
			$x = array('nomor_transaksi' =>$kod  );
			$cari=$this->ModelGue->GetWhere('pengajuan',$x);

			if(count($cari)>0){
				// $hasil=$this->modelsaya->semuadata('barang');
				$data= array('nomor_transaksi'=>$kod,'pesan'=>'data Id tidak boleh Sama');
				$this->load->view('Pengajuan/NewPengajuan',$data);
			}else{
				$data = array('nomor_transaksi' =>$kod ,
				'tanggal_transaksi'=>$tgl,
				'nomor_nasabah'=>$nomor,
				'tanggal_peminjaman'=>$tglpinjam,
				'keterangan'=>$ket);
				
				// simpan data ke tabel 
				$this->ModelGue->insert('pengajuan',$data);
				$a=base_url('CPengajuan');
				redirect($a);
				// atau memanggil ke index
				// $this->index()
			}
		}
	}
	public function editP($id){
		$where = array('nomor_transaksi' =>$id );
		$datanasabah=$this->ModelGue->GetWhere('pengajuan',$where);
		$data=array('datakar'=>$datanasabah);
		$this->load->view('Pengajuan/EditPengajuan',$data );
	}
	function updateP(){
		$kod=$this->input->post('id');
		$tgl=$this->input->post('tgl');
		$tglpinjam= $this->input->post('tglpinjam');
		$nomor=$this->input->post('nomor');
		$ket=$this->input->post('ket');
		$data = array('nomor_nasabah'=>$omor,'tanggal_transaksi'=>$tgl,'tanggal_peminjaman'=>$tglpinjam,
		'keterangan'=>$ket);
		
		// simpan data ke tabel jurusan
		$where=array('nomor_transaksi'=>$kod);
		$this->ModelGue->update('pengajuan',$data,$where);
		$a=base_url('CPengajuan');
		redirect($a);
		// atau memanggil ke index
		// $this->barang();
	}
		function deletP($id_nasabah){
		$syarat = array('nomor_Ttransaksi' => $id_nasabah );
		$this->ModelGue->delete('pengajuan',$syarat);
		redirect(base_url('CPengajuan'));
	}	
	function autocomp(){
		
		// POST data
		$postData = $this->input->post('term');

		// Get data
		$data = $this->ModelData->get_nasabah($postData);
	
		echo json_encode($data);
   }
	   
	function get_nasabah($id){
				
		$hasil = $this->ModelData->ambil_nasabah($id); 

		echo json_encode($hasil);
	}
	function ckaryawan(){
		var_dump('A');
		$id=$this->input->post('nomor');
		$data=$this->ModelData->tampil_nama($id);
		$dt=$this->ModelData->cek_id($id);
		$dataa=$dt->row();
		if ($dt->num_rows()>0) {
			$jar['nama']=$dataa->nama_nasabah;
		
		}
		echo json_encode($jar);
	}
	function carinama(){
		$nama=$this->input->get('nomor_nasabah');
		$query=$this->ModelData->CariNama($nama);
		foreach ($query->result() as $row ) {
			echo "$row->nama_nasabah \n";
		}
	}
}

?>