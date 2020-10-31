<?php 
/**
* 
*/
class ModelData extends CI_Model
{
	function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
	}
	function get_auto($postData){
		$response = array();

		if(isset($postData) ){
			// Select record
			$this->db->select('*');
			$this->db->where("nomor_transaksi like '%".$postData."%' ");

			$records = $this->db->get('pengajuan')->result();

			foreach($records as $row ){
				$response[] = array("value"=>$row->nomor_transaksi,"label"=>$row->nomor_transaksi);
			}

		}

		return $response;
	}
	function get_nasabah($postData){
		$response = array();

		if(isset($postData) ){
			// Select record
			$this->db->select('*');
			$this->db->where("nomor_nasabah like '%".$postData."%' ");

			$records = $this->db->get('nasabah')->result();

			foreach($records as $row ){
				$response[] = array("value"=>$row->nomor_nasabah,"label"=>$row->nama_nasabah);
			}

		}

		return $response;
	}
		public function getUser($id){
		$query = $this->db->get_where('login',array('username'=>$id));
		return $query->row_array();
	   }
	  
	   public function activate($data, $id){
		$where= array('username'=> $id);
		 $this->db->update('login',$data,$where);
	   }

		function CariNama($nik){
		$qr="SELECT * from nasabah where nik like '%$nik%'";
		$hsl=$this->db->query($qr);
		return $hsl;
	}
	function comboadmin(){
		$qr="select * from admin_login";
		$hsl=$this->db->query($qr);
	
		return $hsl;
	}
	 function tampil_nama($nik)
    {
        $query= "SELECT * FROM nasabah
		WHERE nomor_nasabah='".$nik."'";
        $hasil=$this->db->query($query)->row();
        return $hasil;
    }
	function combonasabah(){
		$quer="SELECT * from nasabah";
		$hasil=$this->db->query($quer);
		return $hasil;
	}

	function ambil_nasabah($nomor){
      $myquery="select * from nasabah where nomor_nasabah=".$nomor;
      $kasus=$this->db->query($myquery);
      return $kasus->row();
	}
	function cek_id($id){
		$qr="SELECT * From pinjaman where id_karyawan='$id' order by datetime desc";
		$hsl=$this->db->query($qr);
		return $hsl;
	}

	function datastat($nomor_transaksi){
		$query="select a.*,b.nama_nasabah,b.total_tabungan from pengajuan a INNER JOIN nasabah b ON a.nomor_nasabah=b.nomor_nasabah where nomor_transaksi=".$nomor_transaksi;
		$hsl=$this->db->query($query);
		return $hsl->row();
	}
	function datanasabah($nomor_nasabah){
		$query="select a.*,b.email From nasabah a inner join login b on a.nomor_nasabah=b.nomor_nasabah where a.nomor_nasabah=".$nomor_nasabah;
		$hsl=$this->db->query($query);
		return $hsl->row();
	}

	

	function get_notrans(){
		$qr="select nota from inisial";
		$hsl=$this->db->query($qr);
		return $hsl->row();
	}
	function get_ppUrut(){
		$qr="select Ppurut from ppurut";
		$hsl=$this->db->query($qr);
		return $hsl->row();
	}
	function get_ppUrutTabungan(){
		$qr="select PpurutTabungan from ppuruttabungan";
		$hsl=$this->db->query($qr);
		return $hsl->row();
	}
	function tpl(){
		$qr="select * from pengajuan ";
		$hsl=$this->db->query($qr);
		return $hsl;
	}
	function jumlahpinjam($nik){
		$qr="select COUNT(*) as jumlahpinjam from cashadvancepermit group by nik having nik='".$nik."'";
		$hasil=$this->db->query($qr);
		return $hasil->row();
	}
	function data_PP(){
		$qr="SELECT a.*,b.nama_nasabah,b.total_tabungan FROM pengajuan a left join nasabah b on a.nomor_nasabah=b.nomor_nasabah";
		$hsl=$this->db->query($qr);
		return $hsl;

	}
	function tampildata($id_pinjam){
		$qr="SELECT h_cashadvance.id_pinjam,karyawan.nama_karyawan,h_cashadvance.tgl_pinjam,h_cashadvance.total,d_cashadvance.jumlah_pinjam,d_cashadvance.keterangan, d_cashadvance.index from karyawan INNER join h_cashadvance on karyawan.nik=h_cashadvance.nik INNER join d_cashadvance on d_cashadvance.id_pinjam=h_cashadvance.id_pinjam WHERE h_cashadvance.id_pinjam='".$id_pinjam."'";
		$hsl=$this->db->query($qr);
		return $hsl;
	}
	function infocashdetil($id_pinjam){
		   $myquery="select id_pinjam,jumlah_pinjam from d_cashadvance where id_pinjam=$id_pinjam";
		   
		   $kasus=$this->db->query($myquery);
		   return $kasus;	
	}
	function update_gaji($id_karyawan,$pinjaman,$tanda){
      $myquery="update gaji set gaji=gaji".$tanda.$pinjaman." where id_karyawan='$id_karyawan'";
      $kasus=$this->db->query($myquery);
           
	}
	function data_detil($id_pinjam){
      $myquery="select * from pengajuan where nomor_transaksi='$id_pinjam'";
      $kasus=$this->db->query($myquery)->result();
      return $kasus;
	}
	function updatenota(){
	   	$myquery="update inisial set nota=nota+1";
	   	$kasus=$this->db->query($myquery);
	}
	function updatePP(){
	   	$myquery="update ppurut set Ppurut=Ppurut+1";
	   	$kasus=$this->db->query($myquery);
	}
	function cancelPP(){
		$myquery="update ppurut set Ppurut=Ppurut-1";
		$kasus=$this->db->query($myquery);
 }
	function updateNotabungan(){
		$myquery="update ppuruttabungan set Ppuruttabungan=Ppuruttabungan+1";
		$kasus=$this->db->query($myquery);
 }
	function cetak_formPP($nota){
		$qr="SELECT a.nomor_transaksi,a.tanggal_transaksi,b.nomor_nasabah,b.nama_nasabah,a.tanggal_peminjaman,a.keterangan
		 FROM pengajuan a INNER JOIN nasabah b ON a.nomor_nasabah=b.nomor_nasabah where nomor_transaksi='$nota'";
		$hsl=$this->db->query($qr);
		return $hsl->row();
	}
	function laporan_bln($tglawal,$tglakhir){
		$query="SELECT a.nomor_pinjam,a.tanggal_transaksi,a.nomor_nasabah,b.nama_nasabah,a.nominal,a.keterangan from peminjaman a inner join nasabah b ON a.nomor_nasabah=b.nomor_nasabah where (tanggal_transaksi>='$tglawal' and tanggal_transaksi<='$tglakhir')";
			$kasus=$this->db->query($query)->result();
		      return $kasus;
	}
	function laporan_user($tglawal,$tglakhir,$nasabah){
		$qr="SELECT a.nomor_pinjam,a.tanggal_transaksi,a.nomor_nasabah,b.nama_nasabah,a.nominal,a.keterangan from peminjaman a inner join nasabah b ON a.nomor_nasabah=b.nomor_nasabah 
		where (tanggal_transaksi>='$tglawal' and tanggal_transaksi<='$tglakhir') and (a.nomor_nasabah='$nasabah')";
		$kasus=$this->db->query($qr)->result();
		return $kasus;	
	}
	function penjualan_detil($id_pinjam){
   	$myquery="SELECT d_cashadvance.id_pinjam,karyawan.nama_karyawan,d_cashadvance.jumlah_pinjam,d_cashadvance.keterangan from d_cashadvance INNER JOIN pinjaman on d_cashadvance.jumlah_pinjam=pinjaman.pinjaman INNER JOIN karyawan on karyawan.nik=pinjaman.nik where id_pinjam='$id_pinjam'";
   	$kasus=$this->db->query($myquery)->result();
   	return $kasus;
}
	function penjualan_header($id_pinjam){
      $myquery="SELECT h_cashadvance.id_pinjam,h_cashadvance.tgl_pinjam,h_cashadvance.id_admin,karyawan.nama_karyawan,karyawan.nomor_telpon,h_cashadvance.total from h_cashadvance INNER JOIN karyawan on h_cashadvance.nik=karyawan.nik where id_pinjam='".$id_pinjam."'";
      $kasus=$this->db->query($myquery)->row();
      return $kasus;
}
	function tampilreportTransaksi(){
		$qr="SELECT h_cashadvance.id_pinjam,h_cashadvance.tgl_pinjam,h_cashadvance.id_admin,karyawan.nama_karyawan,karyawan.nomor_telpon,h_cashadvance.total, d_cashadvance.jumlah_pinjam,d_cashadvance.keterangan from h_cashadvance INNER JOIN karyawan on h_cashadvance.nik=karyawan.nik inner join d_cashadvance on h_cashadvance.id_pinjam=d_cashadvance.id_pinjam";
		$ks=$this->db->query($qr)->result();
		return $ks;
	}
	function tampilreportPerTrans($id_pinjam){
		$qr="SELECT h_cashadvance.id_pinjam,h_cashadvance.tgl_pinjam,h_cashadvance.id_admin,karyawan.nama_karyawan,karyawan.nomor_telpon,h_cashadvance.total, d_cashadvance.jumlah_pinjam,d_cashadvance.keterangan from h_cashadvance INNER JOIN karyawan on h_cashadvance.nik=karyawan.nik inner join d_cashadvance on h_cashadvance.id_pinjam=d_cashadvance.id_pinjam='".$id_pinjam."'";
		$ks=$this->db->query($qr);
		return $ks;
	}

}

 ?>