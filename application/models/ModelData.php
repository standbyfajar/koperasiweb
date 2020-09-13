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
		public function getUser($id){
		$query = $this->db->get_where('login',array('id'=>$id));
		return $query->row_array();
	   }
	  
	   public function activate($data, $id){
		$this->db->where('login.login_id', $id);
		return $this->db->update('login', $data);
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
	function combokaryawan(){
		$quer="SELECT * from karyawan";
		$hasil=$this->db->query($quer);
		return $hasil;
	}

	function data_karyawan($nik){
      $myquery="select * from karyawan where nik='$nik'";
      $kasus=$this->db->query($myquery);
      return $kasus->row();
	}
	function cek_id($id){
		$qr="SELECT * From pinjaman where id_karyawan='$id' order by datetime desc";
		$hsl=$this->db->query($qr);
		return $hsl;
	}

	function datastat($nomor_transaksi){
		$query="select a.*,b.nama,b.email from pengajuan a INNER JOIN login b ON a.nomor_nasabah=b.nomor_nasabah where nomor_transaksi=".$nomor_transaksi;
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
	function tpl(){
		$qr="select * from cashadvancepermit ";
		$hsl=$this->db->query($qr);
		return $hsl;
	}
	function jumlahpinjam($nik){
		$qr="select COUNT(*) as jumlahpinjam from cashadvancepermit group by nik having nik='".$nik."'";
		$hasil=$this->db->query($qr);
		return $hasil->row();
	}
	function data_PP(){
		$qr="SELECT No_PP,cashadvancepermit.nik,tanggal,cashadvancepermit.id_department,nmDepart,cashadvancepermit.position,karyawan.gaji,gaji_blndpn FROM cashadvancepermit left join department on cashadvancepermit.id_department=department.idDepartment LEFT JOIN karyawan on cashadvancepermit.nik=karyawan.nik left join pinjaman on pinjaman.nik=karyawan.nik group by No_PP";
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
      $myquery="select * from d_cashadvance where id_pinjam='$id_pinjam'";
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
	function cetak_formPP($nota){
		$qr="SELECT No_PP,tanggal,cashadvancepermit.nik,karyawan.nama_karyawan,deskripsi,admin from cashadvancepermit inner join karyawan on karyawan.nik= cashadvancepermit.nik where No_PP='$nota'";
		$hsl=$this->db->query($qr);
		return $hsl->row();
	}
	function laporan_bln($tglawal,$tglakhir){
		$query="SELECT d_cashadvance.id_pinjam,h_cashadvance.tgl_pinjam,d_cashadvance.jumlah_pinjam,d_cashadvance.keterangan,h_cashadvance.total from d_cashadvance inner join h_cashadvance on d_cashadvance.id_pinjam=h_cashadvance.id_pinjam where (tgl_pinjam>='$tglawal' and tgl_pinjam<='$tglakhir')";
			$kasus=$this->db->query($query)->result();
		      return $kasus;
	}
	function laporan_user($tglawal,$tglakhir,$kode_karyawan){
		$qr="SELECT d_cashadvance.id_pinjam,h_cashadvance.tgl_pinjam,karyawan.nama_karyawan,d_cashadvance.jumlah_pinjam,d_cashadvance.keterangan,h_cashadvance.total from d_cashadvance inner join h_cashadvance on d_cashadvance.id_pinjam=h_cashadvance.id_pinjam inner join karyawan on h_cashadvance.nik=karyawan.nik where (tgl_pinjam>='$tglawal' and tgl_pinjam<='$tglakhir') and (h_cashadvance.nik='$kode_karyawan')";
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