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
		if (!isset($this->session->hd)) 
				{
					$no= $this->ModelData->get_ppUrut();
					// $notransbaru= "TR".date('Y-m-d').sprintf("%03s",$no->transaksi+1);
					$n=$no->Ppurut+1;
					// echo $n;
					$notransbaru="PP".date('y-m-d').substr('000'.$n,-3,3);

					$datasesi=array('noPP'=>$notransbaru,'tanggal'=>date('y-m-d'),'nik'=>'');
					$this->session->set_userdata($datasesi);

					$this->session->set_userdata('hd',0);

				}
		$nota=$this->session->noPP;
		$hasil=$this->ModelGue->semuadata('pengajuan');
		$data=array('datakr'=>$hasil);
		$this->load->view('Pengajuan/ListPengajuan',$data);
	}
	function tambahP(){
		$idp=$this->session->noPP;
		$ses=array('hd'=>0,
					'noPP'=>'',
					'tanggal'=>'',
					'nik'=>'');
		$this->session->unset_userdata($ses);
		$this->ModelData->updatePP($idp);
		$this->session->unset_userdata('hd',0);

		$hasil=$this->ModelGue->semuadata('pengajuan');
		$data= array('datakar'=>$hasil);
		$this->load->view('Pengajuan/NewPengajuan',$data);
	}
	public function transaksibatal()
	{
		$nota=$this->session->noPP;
		$hasil=$this->ModelData->data_detil($nota);
		$ses=array('hd'=>0,
					'noPP'=>'',
					'tanggal'=>'',
					'nik'=>'');
		$this->session->set_userdata($ses);
		$this->session->unset_userdata('hd');
		$this->ModelData->cancelPP($nota);
		// ini udah bisa
		$where=array('nomor_transaksi'=>$nota);
		$this->ModelGue->delete('pengajuan',$where);
		
		$this->session->set_userdata('pesan','Data Transakasi Telah dibatalkan');
		redirect(base_url().'CPengajuan');
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
	function delete_detil($id_pinjam)

	{
		$where=array('nomor_transaksi'=>$id_pinjam);
		
		$dat=$this->ModelGue->GetWhere('pengajuan',$where);

		// ini script ngapus dateta detail
		$this->ModelGue->delete('pengajuan',$where);

		$this->session->set_userdata('pesan','Data pengajuan peminjam sudah dihapus');
		redirect(base_url().'CPengajuan');
	}
	public function Cetak_form($noPP){
		$this->session->set_userdata('muncul',true);

		$where=array('nomorPP'=>$noPP);
		$datadetil=$this->ModelData->cetak_formPP($noPP);	

		// if (count($datadetil)==0) {
		// 	$this->session->set_userdata('pesan','Belum ada data');
		// 	redirect(base_url().'Cpermintaan');
		// 	exit;
		// }
		$this->load->library('fpdf');
		$pdf= new FPDF('P','mm','A4');
		$pdf->AddPage();
		// judul baris 1
		$pdf->SetFont('Arial','B',14);
		$title="Form Pengajuan Peminjaman";
		$pdf->SetTitle($title);
		$pdf->SetAuthor('Fajar karunia');
		// cell(width,height,text,border,endline, align)
			$pdf->Cell(200,4,'Form Pengajuan Peminjaman  ',0,1,'C');
			$pdf->Cell(205,4,'Di Koperasi Sahabat Mandiri ',0,1,'C');
			$pdf->Cell(205,4,'Jln Komarudin ',0,1,'C');

		$pdf->Ln();
		$pdf->SetFont('Arial','',11);
		// cell(width,height,text,border,endline, align)
		// $pdf->Cell(8,8,'',1,0,'C');
			$pdf->Cell(95,8,'No Pengajuan ',0,0,'C');
			$pdf->Cell(5,8,':',0,0,'C');
			$pdf->Cell(45,8,$datadetil->nomor_transaksi,0,1,'C');


			$pdf->Cell(95,8,'Tanggal ',0,0,'C');
			$pdf->Cell(5,8,':',0,0,'C');
			$pdf->Cell(45,8,$datadetil->tanggal_transaksi,0,1,'C');

			$pdf->Cell(95,8,'No Nasabah ',0,0,'C');
			$pdf->Cell(5,8,':',0,0,'C');
			$pdf->Cell(45,8,$datadetil->nomor_nasabh,0,1,'C');

			$pdf->Cell(95,8,'Tanggal Peminjaman ',0,0,'C');
			$pdf->Cell(5,8,':',0,0,'C');
			$pdf->Cell(45,8,$datadetil->tanggal_peminjaman,0,1,'C');

			$pdf->Cell(95,8,'Deskripsi ',0,0,'C');
			$pdf->Cell(5,8,':',0,0,'C');
			$pdf->Cell(45,8,$datadetil->keterangan,0,1,'C');

		$pdf->Ln();
			$pdf->SetLineWidth(0.5);
			$pdf->Line(20, 25, 190, 25);

		$pdf->Ln();
			//menentukan tebal
			$pdf->SetLineWidth(0.5);
			
			//menentukan titik awal dan titik akhir garis yang akan di buat (x1,y1,x2,y2)
			$pdf->Ln();
			$pdf->Cell(300,5,'Prepared By,',0,1,'C');
			$pdf->Line(85, 135, 45, 135); 
			$pdf->Cell(60,70,$datadetil->nama_nasabah,0,0,'R');  //nama 
			// $pdf->Line(135, 135, 175, 135); 
			// $pdf->Cell(100,70,$datadetil->admin,0,1,'R');  //nama 



			// $pdf->Line(85, 125, 125, 125); 

		
		

		$pdf->Output('I');

	}
}

?>