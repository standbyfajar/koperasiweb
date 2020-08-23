<?php 
/**
* 
*/
class CNasabah extends CI_Controller
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
		$hasil=$this->ModelGue->semuadata('nasabah');
		$data=array('datakr'=>$hasil);
		$this->load->view('Nasabah/ListNasabah',$data);
	}

	function get_nasabah($id){
		
		$data = array('nomor_nasabah'=>$id);
		$hasil = $this->ModelGue->GetWhere('nasabah',$data); 

		echo json_encode($hasil);
	}
	function tambahnasabah(){
		$hasil=$this->ModelGue->semuadata('nasabah');
		$data= array('datakar'=>$hasil);
		$this->load->view('Nasabah/NewNasabah',$data);
	}

	function savenasabah(){
		// buat validasi data
		$this->form_validation->set_rules('id','No Nasabah','required|trim');
		$this->form_validation->set_rules('nama','Nama nasabah','required|trim');
		$this->form_validation->set_rules('gaji','Gaji','numeric|trim','*hanya berupa angka');
		$this->form_validation->set_rules('tlp','Telepon','numeric|trim','*Data hanya berupa angka');
		

		if ($this->form_validation->run() == FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$hasil=$this->ModelGue->semuadata('nasabah');
			$data= array(
					'datakar'=>$hasil,
					'pesan'=>validation_errors()
				); 
				
			$this->load->view('Nasabah/NewNasabah',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$kod=$this->input->post('id');
			$nama=$this->input->post('nama');
			$tmpt= $this->input->post('tmptlhr');
			$tgl=$this->input->post('tgllahir');
			$usia=$this->input->post('usia');
			$jen=$this->input->post('jk');
			$type=$this->input->post('type');
			$noidentitas=$this->input->post('noidentitas');
			$alm=$this->input->post('alm');
			$bank=$this->input->post('bank');
			$rek=$this->input->post('rek');
			$tel=$this->input->post('tlp');
			$gaji=$this->input->post('gaji');

			$ft=$this->upload();
			$ft2=$this->upload2();

			
			// validasi data double
			$x = array('nomor_nasabah' =>$kod  );
			$cari=$this->ModelGue->GetWhere('nasabah',$x);

			if(count($cari)>0){
				// $hasil=$this->modelsaya->semuadata('barang');
				$data= array('nomor_nasabah'=>$kod,'pesan'=>'data Id tidak boleh Sama');
				$this->load->view('Nasabah/NewNasabah',$data);
			}else{
				$data = array('nomor_nasabah' =>$kod ,
				'nama_nasabah'=>$nama,
				'tempat_lahir'=>$tmpt,
				'tanggal_lahir'=>$tgl,
				'usia'=>$usia,
				'jenis_kelamin'=>$jen,
				'type_identitas'=>$type,
				'no_identitas'=>$noidentitas,
				'alamat'=>$alm,
				'Bank'=>$bank,
				'no_rek'=>$rek,
				'telepon'=>$tel,
				'Gaji'=>$gaji,
				'Foto'=>$ft,
				'Foto_Identitas'=>$ft2);
				
				// simpan data ke tabel 
				$this->ModelGue->insert('nasabah',$data);
				$a=base_url('CNasabah');
				redirect($a);
				// atau memanggil ke index
				// $this->index()
			}
		}
	}	

	public function editnasabah($id_nasabah){
		$where = array('nomor_nasabah' =>$id_nasabah );
		$datanasabah=$this->ModelGue->GetWhere('nasabah',$where);
		$data=array('datakar'=>$datanasabah);
		$this->load->view('Nasabah/EditNasabah',$data );
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
	function upload2(){
		if (isset($_FILES['ft2'])) {
			if ($_FILES['ft2']['name'] !="") {
				$eks=explode('.',$_FILES['ft2']['name']);
				$nb=rand().'.'.$eks[1];

				$config['file_name']=$nb;
				$config['upload_path'] ='./image';
				$config['allowed_types']='gif|jpg|png|jpeg';
			

				$this->load->library('upload',$config);
				$this->upload->do_upload('ft2');
				
				return $nb;

			}else{
				$namafoto=$this->input->post('ftlama');
				return($namafoto);
			}
		}
	}
	function updatenasabah(){
		$kod=$this->input->post('id');
		$nama=$this->input->post('nama');
		$eml=$this->input->post('eml');
		$tmpt= $this->input->post('tmptlhr');
		$tgl=$this->input->post('tgllahir');
		$dep=$this->input->post('depart');
		$jbt=$this->input->post('jbt');
		$shf=$this->input->post('shf');

		$jen=$this->input->post('jk');
		$tel=$this->input->post('tel');
		$nmB=$this->input->post('nmBank');
		$accNo=$this->input->post('accNo');
		$stat=$this->input->post('status');
		$ank=$this->input->post('anak');
		$npwp=$this->input->post('npwp');		
		$gj=$this->input->post('gaji');
		$ft=$this->upload();
		
		$data = array('nama_nasabah'=>$nama,'alamat'=>$eml,'tmptlahir'=>$tmpt,'tgllahir'=>$tgl,'id_department'=>$dep,'position'=>$jbt,'idShift'=>$shf,'jenis_kelamin'=> $jen,'nomor_telpon'=>$tel,'nm_bank'=>$nmB,'accNo_bank'=>$accNo,'status'=>$stat,'anak'=>$ank,'npwp'=>$npwp,'gaji'=>$gj,'Foto'=>$ft);
		
		// simpan data ke tabel jurusan
		$where=array('nik'=>$kod);
		$this->ModelGue->update('nasabah',$data,$where);
		$a=base_url('Cnasabah');
		redirect($a);
		// atau memanggil ke index
		// $this->barang();
	}
		function deletnasabah($id_nasabah){
		$syarat = array('nomor_nasabah' => $id_nasabah );
		$this->ModelGue->delete('nasabah',$syarat);
		redirect(base_url('CNasabah'));
	}
}
 ?>