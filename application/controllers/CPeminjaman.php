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
		$this->load->library('Mylibrary');

	}

	function index(){
		if (!isset($this->session->hd)) 
		{
			$no= $this->ModelData->get_notrans();
			// $notransbaru= "TR".date('Y-m-d').sprintf("%03s",$no->transaksi+1);
			$n=$no->nota+1;
			// echo $n;
			$transnew="PM".date('y-m-d').substr('0000'.$n,-4,4);

			$dtsession=array('noPM'=>$transnew,'tanggal'=>date('y-m-d'),'nik'=>'');
			$this->session->set_userdata($dtsession);

			$this->session->set_userdata('hd',0);

		}
		$nota=$this->session->noPP;
		$PP=$this->ModelData->data_PP();
		$hasil=$this->ModelGue->semuadata('peminjaman');
		$data=array('datakar'=>$hasil,'datapp'=>$PP);
		$this->load->view('Peminjaman/ListPeminjaman',$data);
	}
	function autocomp(){
		
		 // POST data
		 $postData = $this->input->post('term');

		 // Get data
		 $data = $this->ModelData->get_auto($postData);
	 
		 echo json_encode($data);
	}

    function get_P($id){
		
		$hasil = $this->ModelData->datastat($id); 

		echo json_encode($hasil);
	}
	function tambahP(){
		$idp=$this->session->noPP;
		$ses=array('hd'=>0,
					'noPM'=>'',
					'tanggal'=>'',
					'nik'=>'');
		$this->session->unset_userdata($ses);
		$this->ModelData->updatenota($idp);
		$this->session->unset_userdata('hd',0);

		$hasil=$this->ModelGue->semuadata('peminjaman');
		// $data= array('datakar'=>$hasil);
		$this->load->view('Peminjaman/NewPeminjaman');
	}

	function saveP(){
		// buat validasi data
		$this->form_validation->set_rules('no_pengajuan','No pengajuan','required|trim');
		$this->form_validation->set_rules('nominal','nominal','required|trim');

		if ($this->form_validation->run() == FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$hasil=$this->ModelGue->semuadata('peminjaman');
			$data= array(
					'datakar'=>$hasil,
					'pesan'=>validation_errors()
				); 
				
			$this->load->view('Peminjaman/ListPeminjaman',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$peng=$this->input->post('no_pengajuan');
			$tgl=$this->input->post('tgl');
			$trans= $this->input->post('nomor');
			$nasa=$this->input->post('nasa');
			$nominal=$this->input->post('nominal');
			$cicil=$this->input->post('cicil');
			$bunga=$this->input->post('bunga');
			$cicil_bulan=$this->input->post('cicil_bulan');
			$ket=$this->input->post('ket');
			
			// validasi data double
			$x = array('nomor_pinjam' =>$trans  );
			$cari=$this->ModelGue->GetWhere('peminjaman',$x);

			if(count($cari)>0){
				$data= array('nomor_pinjam'=>$kod,'pesan'=>'data pinjam tidak boleh Sama');
				$this->load->view('Peminjaman/NewPeminjaman',$data);
			}else{
				$data = array('nomor_pengajuan' =>$peng ,
				'tanggal_transaksi'=>$tgl,
				'nomor_pinjam'=>$trans,
				'nomor_nasabah'=>$nasa,
				'nominal'=>$nominal,
				'cicilan'=>$cicil,
				'bunga'=>$bunga,
				'kredit_bulan'=>$cicil_bulan,
				'keterangan'=>$ket);
				
				// simpan data ke tabel 
				$this->ModelGue->insert('peminjaman',$data);
				// var_dump($data);
				$a=base_url('CPeminjaman');
				redirect($a);
				// atau memanggil ke index
				// $this->index()
			}
		}
	}

	function delete_detil($id_pinjam)

		{
			
			$where=array('nomor_pengajuan'=>$id_pinjam);
			
			$dat=$this->ModelGue->GetWhere('peminjaman',$where);

			// ini script ngapus dateta detail
			$this->ModelGue->delete('peminjaman',$where);

			$this->session->set_userdata('pesan','Data Pengajuan peminjam sudah dihapus');
			redirect(base_url().'CPeminjaman');
		}

	public function Cetak_form($noPP){
			$this->session->set_userdata('muncul',true);
	
			$where=array('nomor_pengajuan'=>$noPP);
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
				$pdf->Cell(200,4,'Form Permintaan Peminjaman  ',0,1,'C');
				$pdf->Cell(205,4,' Koperasi Sahabat Mandiri ',0,1,'C');
				$pdf->Cell(205,4,'Jln Pintu Air Utara ',0,1,'C');

			$pdf->Ln();
			$pdf->SetFont('Arial','',11);
			// cell(width,height,text,border,endline, align)
			// $pdf->Cell(8,8,'',1,0,'C');
				$pdf->Cell(95,8,'No Pengajuan ',0,0,'C');
				$pdf->Cell(5,8,':',0,0,'C');
				$pdf->Cell(45,8,$datadetil->nomor_pengajuan,0,1,'C');


				$pdf->Cell(95,8,'Tanggal ',0,0,'C');
				$pdf->Cell(5,8,':',0,0,'C');
				$pdf->Cell(45,8,$datadetil->tanggal,0,1,'C');

				$pdf->Cell(95,8,'NIK ',0,0,'C');
				$pdf->Cell(5,8,':',0,0,'C');
				$pdf->Cell(45,8,$datadetil->nik,0,1,'C');

				$pdf->Cell(95,8,'admin ',0,0,'C');
				$pdf->Cell(5,8,':',0,0,'C');
				$pdf->Cell(45,8,$datadetil->admin,0,1,'C');

				$pdf->Cell(95,8,'Deskripsi ',0,0,'C');
				$pdf->Cell(5,8,':',0,0,'C');
				$pdf->Cell(45,8,$datadetil->deskripsi,0,1,'C');

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
				$pdf->Cell(60,70,$datadetil->nama_karyawan,0,0,'R');  //nama 
				$pdf->Line(135, 135, 175, 135); 
				$pdf->Cell(100,70,$datadetil->admin,0,1,'R');  //nama 

				// $pdf->Line(85, 125, 125, 125); 

			$pdf->Output();

		}


}

?>