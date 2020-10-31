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

		if (!isset($this->session->hd)) 
		{
			$no= $this->ModelData->get_ppUrutTabungan();
			// $notransbaru= "TR".date('Y-m-d').sprintf("%03s",$no->transaksi+1);
			$n=$no->Ppuruttabungan+1;
			// echo $n;
			$notransbaru="TB".date('y-m-d').substr('0000'.$n,-4,4);

			$datasesi=array('noPP'=>$notransbaru,'tanggal'=>date('y-m-d'),'nik'=>'');
			$this->session->set_userdata($datasesi);

			$this->session->set_userdata('hd',0);

		}
		$nota=$this->session->noPP;
		$hasil=$this->ModelGue->semuadata('transaksi_tabungan');
		$data=array('datakr'=>$hasil);
		$this->load->view('Tabungan/ListTabungan',$data);
	}
	function upload(){
		if (isset($_FILES['ft'])) {
			if ($_FILES['ft']['name'] !="") {
				$eks=explode('.',$_FILES['ft']['name']);
				$nb=rand().'.'.$eks[1];

				$config['file_name']=$nb;
				$config['upload_path'] ='./image';
				$config['allowed_types']='gif|jpg|png|jpeg';

				$this->load->library('upload',$config);
				$this->upload->do_upload('ft');
				return $nb;

			}else{
				$namafoto=$this->input->post('ftlama');
				return($namafoto);
			}
		}
	}
	function get_T($id){
		
		$data = array('nomor_tabungan'=>$id);
		$hasil = $this->ModelGue->GetWhere('transaksi_tabungan',$data); 

		echo json_encode($hasil);
	}
	function tambahT(){
		$idp=$this->session->noPP;
		$ses=array('hd'=>0,
					'noPP'=>'',
					'tanggal'=>'',
					'nik'=>'');
		$this->session->unset_userdata($ses);
		$this->ModelData->updateNotabungan($idp);
		$this->session->unset_userdata('hd',0);

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
			$nomor=$this->input->post('nomor');
			$tgl=$this->input->post('tgl');
			$bulan= $this->input->post('bulan');
			$nominal=$this->input->post('nominal');
			$ket=$this->input->post('ket');
			$ft=$this->upload();

			
			// validasi data double
			$x = array('nomor_tabungan' =>$kod  );
			$cari=$this->ModelGue->GetWhere('transaksi_tabungan',$x);

			if(count($cari)>0){
				// $hasil=$this->modelsaya->semuadata('barang');
				$data= array('nomor_tabungan'=>$kod,'pesan'=>'data Id tidak boleh Sama');
				$this->load->view('Tabungan/NewTabungan',$data);
			}else{
				$data = array('nomor_tabungan' =>$kod ,
				'nomor_nasabah'=>$nomor,
				'tanggal_transaksi'=>$tgl,
				'bulan'=>$bulan,
				'nominal'=>$nominal,
				'keterangan'=>$ket,
				'upload_transaksi'=>$ft);
				
				// simpan data ke tabel 
				$this->ModelGue->insert('transaksi_tabungan',$data);
				$a=base_url('CTabungan');
				redirect($a);
				// atau memanggil ke index
				// $this->index()
			}
		}
	}
	public function editT($id){
		$where = array('nomor_tabungan' =>$id );
		$datatabungan=$this->ModelGue->GetWhere('transaksi_tabungan',$where);
		$data=array('datakar'=>$datatabungan);
		$this->load->view('Tabungan/EditTabungan',$data );
	}
	function updateT(){
		$kod=$this->input->post('id');
		$nomor=$this->input->post('nomor');
		$tgl=$this->input->post('tgl');
		$bulan= $this->input->post('bulan');
		$nominal=$this->input->post('nominal');
		$ket=$this->input->post('ket');
		$ft=$this->upload();

		$data = array('nomor_nasabah'=>$oomor,
		'tanggal_transaksi'=>$tgl,'bulan'=>$bulan,'nominal'=>$nominal,
		'keterangan'=>$ket,'upload_transaksi'=>$ft);
		
		// simpan data ke tabel jurusan
		$where=array('nomor_tabungan'=>$kod);
		$this->ModelGue->update('transaksi_tabungan',$data,$where);
		$a=base_url('CTabungan');
		redirect($a);
		// atau memanggil ke index
		// $this->barang();
	}
		function deletT($nomor_tabungan){
		$syarat = array('nomor_tabungan' => $nomor_tabungan );
		$this->ModelGue->delete('transaksi_tabungan',$syarat);
		redirect(base_url('CTabungan'));
	}	
	function get_tabungan($id){
		
		$data = array('nomor_tabungan'=>$id);
		$hasil = $this->ModelGue->GetWhere('transaksi_tabungan',$data); 

		echo json_encode($hasil);
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
    
}

?>