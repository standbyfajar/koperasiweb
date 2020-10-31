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
		$this->load->library('MyLibrary');
		$this->load->library('fpdf');


    }
    function Laporan_perbln(){
	
			// jika belom disi tanggal
            $this->session->set_userdata('muncul',False);
            $this->load->view('Laporan/LaporanPerbulan');
        
	}
	function Laporan_peruser(){

		$kr=$this->ModelData->combonasabah();
		$data=array('cmbkar'=>$kr);
		// jika belom disi tanggal
		$this->session->set_userdata('muncul',False);
		$this->load->view('Laporan/LaporanPerUser',$data);
	
	}
	function act_preview(){
		// jika belom di klik preview
		// $kar=$this->ModelData->combokaryawan();
		// $data=array('cmbarang'=>$kar);
		$this->session->set_userdata('muncul',true);

		$tglawal=$this->input->post('dari');
		$tglakhir=$this->input->post('sampai');
		// $kode_barang= $this->input->post('barang');

		$this->session->set_userdata('tglawal',$tglawal);
		$this->session->set_userdata('tglakhir',$tglakhir);
		// $this->session->set_userdata('barang',$kode_barang);

		$a=$this->ModelData->laporan_bln($tglawal,$tglakhir);
		// $b= $this->ModelData->laporan_user($tglawal,$tglakhir,$kode_barang);

		$tglawal=$this->mylibrary->format_tanggal($tglawal);
		$tglakhir=$this->mylibrary->format_tanggal($tglakhir);

		// if ($this->session->set_userdata('barang',$kode_barang)) {
		$data=array('laporan'=>$a,'tglawal'=>$tglawal,'tglakhir'=>$tglakhir);
		// }else{
		
		// $data=array('laporantgl'=>$a,'tglawal'=>$tglawal,'tglakhir'=>$tglakhir);

		$this->load->view('Laporan/LaporanPerbulan',$data);
		// $this->load->view('transaksi/preview_laporan_tgl',$data1);

		// }
	}
	function act_preview_karyawan(){
		// jika belom di klik preview
		$this->session->set_userdata('muncul',true);
		$kar=$this->ModelData->combonasabah();
		$data=array('cmbkar'=>$kar);
		
		$tglawal=$this->input->post('dari');
		$tglakhir=$this->input->post('sampai');
		$nasabah= $this->input->post('nasabah');

		$this->session->set_userdata('tglawal',$tglawal);
		$this->session->set_userdata('tglakhir',$tglakhir);
		$this->session->set_userdata('nasabah',$nasabah);

		// $a=$this->ModelData->laporan_bln($tglawal,$tglakhir);
		$b= $this->ModelData->laporan_user($tglawal,$tglakhir,$nasabah);

		$tglawal=$this->mylibrary->format_tanggal($tglawal);
		$tglakhir=$this->mylibrary->format_tanggal($tglakhir);

		// if ($this->session->set_userdata('barang',$kode_barang)) {
		$data=array('laporan'=>$b,'cmbkar'=>$kar,'tglawal'=>$tglawal,'tglakhir'=>$tglakhir,'nasabah'=> $nasabah);
		// }else{
		
		// $data=array('laporantgl'=>$a,'tglawal'=>$tglawal,'tglakhir'=>$tglakhir);

		$this->load->view('Laporan/LaporanPerUser',$data);
		// $this->load->view('transaksi/preview_laporan_tgl',$data1);

		// }
	}
	public function list_Penjualan_pdf(){
		// $this->session->set_userdata('muncul',true);

		$tglawal=$this->input->get('tglawal');
		$tglakhir=$this->input->get('tglakhir');

		$a=$this->ModelData->laporan_bln($tglawal,$tglakhir);
		$tglawal=$this->mylibrary->format_tanggal($tglawal);
		$tglakhir=$this->mylibrary->format_tanggal($tglakhir);
		
		$this->load->library('fpdf');
		$pdf= new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','',9);
		$title="LAPORAN Peminjaman Koperasi PER PERIODE";
		$pdf->SetTitle($title);
		$pdf->SetAuthor('Fajar karunia');
		$pdf->Cell(200,4,'Laporan Peminjaman Koperasi Per Bulan ',0,1,'C');
		$pdf->Cell(205,4,'Di KOPERASI SAHABAT MANDIRI ',0,1,'C');

		$pdf->Ln();

		$pdf->Cell(8,8,'No',1,0,'C');
		$pdf->Cell(35,8,'No Transaksi',1,0,'C');
		$pdf->Cell(30,8,'Tanggal Transaksi',1,0,'C');
		// $pdf->Cell(60,8,'No Nasabah',1,0,'C');
		$pdf->Cell(40,8,'Nama Nasabah',1,0,'C');
		$pdf->Cell(25,8,'Keterangan',1,0,'C');
		$pdf->Cell(40,8,'Nominal',1,0,'C');
		// $pdf->Cell(30,8,'Total',1,0,'C');

		$no=0;
		$total=0;
		foreach ($a as $row ) {
			$no++;	
			$total=$total+$row->nominal;
			$pdf->Ln();

			$pdf->Cell(8,8,$no,1,0,'C');
			$pdf->Cell(35,8,$row->nomor_pinjam,1,0,'C');
			$pdf->Cell(30,8,$row->tanggal_transaksi,1,0,'C');
			// $pdf->Cell(60,8,$row->nomor_nasabah,1,0,'C');
			$pdf->Cell(40,8,$row->nama_nasabah,1,0,'C');
			$pdf->Cell(25,8,$row->keterangan,1,0,'C');
			$pdf->Cell(40,8,$row->nominal,1,0,'C');
			// $pdf->Cell(30,8,number_format($total,0),1,0,'C');
		}

		$pdf->Ln();

		$pdf->Cell(138,8,'Grand Total',1,0,'C');
		$pdf->Cell(40,8,number_format($total,0),1,0,'C');
		

		$pdf->Output('I');

	}

	public function list_peminjaman_user_pdf(){
		// $this->session->set_userdata('muncul',true);

		$tglawal=$this->input->get('tglawal');
		$tglakhir=$this->input->get('tglakhir');
		$nasabah=$this->input->get('nasabah');

		// $tglawal=$this->session->tglawal;
		// $tglakhir=$this->session->tglakhir;
		// $nasabah=$this->session->nasabah;

		$a=$this->ModelData->laporan_user($tglawal,$tglakhir,$nasabah);
		$tglawal=$this->mylibrary->format_tanggal($tglawal);
		$tglakhir=$this->mylibrary->format_tanggal($tglakhir);

		$this->load->library('fpdf');
		$pdf= new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','',9);
		$title="LAPORAN Peminjaman Koperasi PER USER";
		$pdf->SetTitle($title);
		$pdf->SetAuthor('Fajar karunia');
		$pdf->Cell(200,4,'Laporan Peminjaman Koperasi Per user ',0,1,'C');
		$pdf->Cell(205,4,'Di KOPERASI SAHABAT MANDIRI ',0,1,'C');

		$pdf->Ln();

		$pdf->Cell(8,8,'No',1,0,'C');
		$pdf->Cell(35,8,'No Transaksi',1,0,'C');
		$pdf->Cell(35,8,'nama Nasabah',1,0,'C');
		$pdf->Cell(25,8,'Tanggal',1,0,'C');
		$pdf->Cell(25,8,'Keterangan',1,0,'C');
		$pdf->Cell(60,8,'Jumlah Pinjam',1,0,'C');
		// $pdf->Cell(30,8,'Total',1,0,'C');

		$no=0;
		$total=0;
		foreach ($a as $row ) {
		$no++;	
		$total=$total+$row->nominal;
		

		$pdf->Ln();

		$pdf->Cell(8,8,$no,1,0,'C');
		$pdf->Cell(35,8,$row->nomor_pinjam,1,0,'C');
		$pdf->Cell(35,8,$row->nama_nasabah,1,0,'C');
		$pdf->Cell(25,8,$row->tanggal_transaksi,1,0,'C');
		$pdf->Cell(25,8,$row->keterangan,1,0,'C');
		$pdf->Cell(60,8,$row->nominal,1,0,'C');
		// $pdf->Cell(30,8,number_format($row->total,0),1,0,'C');

				}
		$pdf->Ln();

		$pdf->Cell(128,8,'Grand Total',1,0,'C');
		$pdf->Cell(60,8,number_format($total,0),1,0,'C');

		$pdf->Output('I');

	}
}


?>