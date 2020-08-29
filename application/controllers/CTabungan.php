<?php

class CTabungan extends CI_Controller
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
		$hasil=$this->ModelGue->semuadata('transaksi_tabungan');
		$data=array('datakr'=>$hasil);
		$this->load->view('Tabungan/ListTabungan',$data);
	}
	function get_T($id){
		
		$data = array('nomor_tabungan'=>$id);
		$hasil = $this->ModelGue->GetWhere('transaksi_tabungan',$data); 

		echo json_encode($hasil);
	}
	function tambahT(){
		$hasil=$this->ModelGue->semuadata('transaksi_tabungan');
		$data= array('datakar'=>$hasil);
		$this->load->view('Tabungan/NewTabungan',$data);
	}

	function saveT(){
		// buat validasi data
		$this->form_validation->set_rules('id','No Transaksi','required|trim');
		$this->form_validation->set_rules('nomor','No nasabah','required|trim');
		

		if ($this->form_validation->run() == FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
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
			$x = array('nomor_tabungan' =>$kod  );
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
	public function editT($id){
		$where = array('nomor_transaksi' =>$id );
		$datanasabah=$this->ModelGue->GetWhere('pengajuan',$where);
		$data=array('datakar'=>$datanasabah);
		$this->load->view('Pengajuan/EditPengajuan',$data );
	}
	function updateT(){
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
		function deletT($id_nasabah){
		$syarat = array('nomor_Ttransaksi' => $id_nasabah );
		$this->ModelGue->delete('pengajuan',$syarat);
		redirect(base_url('CPengajuan'));
	}	
    
}

?>