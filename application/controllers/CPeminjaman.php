<?php
class CPeminjaman extends CI_Controller
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
		$hasil=$this->ModelGue->semuadata('peminjaman');
		$data=array('datakr'=>$hasil);
		$this->load->view('Peminjaman/ListPeminjaman',$data);
    }
    function get_P($id){
		
		$data = array('nomor_transaksi'=>$id);
		$hasil = $this->ModelGue->GetWhere('pengajuan',$data); 

		echo json_encode($hasil);
	}
	function tambahP(){
		$hasil=$this->ModelGue->semuadata('pengajuan');
		$data= array('datakar'=>$hasil);
		$this->load->view('Peminjaman/NewPeminjaman',$data);
	}

	function saveP(){
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
}

?>