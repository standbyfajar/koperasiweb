<?php 
class ModelGue extends CI_Model
{
	public function semuadata($tabel){
		$myquer= "SELECT * FROM ". $tabel;
		$res=$this->db->query($myquer);
		return $res->result();
	}
	public function Insert($tabel,$data){
		$res=$this->db->insert($tabel,$data);
		return $res;
	}
	public function update($tabel,$data,$where){
		$res=$this->db->update($tabel,$data,$where);
		return $res;
	}
	public function delete($tabel,$where){
		$res=$this->db->delete($tabel,$where);
		return $res;
	}
	public function GetWhere($tabel,$data){
		$res=$this->db->get_where($tabel,$data);
		return $res->row();
	}
	public function jumlahdata($tabel){
		return $this->db->get($tabel)->num_rows();
	}
	public function data_pagination($tabel,$number,$from){
		return $this->db->get($tabel,$number,$from)->result();
	}
	public	function cek_login($tabel,$where){
		return $this->db->get_where($tabel,$where)->num_rows();
	}
		function data_get($tabel,$data){
     $res=$this->db->get_where($tabel,$data);
		return $res;
	}
}

 ?>