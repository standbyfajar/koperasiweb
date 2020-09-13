<?php

class CLogin extends CI_Controller 
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

		$this->load->view('Login/Login');
    }
    
    function save(){
		// buat validasi data
		$this->form_validation->set_rules('user','user','required|trim');
		$this->form_validation->set_rules('email','email','required|trim');
		

		if ($this->form_validation->run() == FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$hasil=$this->ModelGue->semuadata('login');
			$data= array(
					'data'=>$hasil,
					'pesan'=>validation_errors()
				); 
				
			$this->load->view('Login/Login',$data);
			// pesan error
		}else{
            // jika tidak error maka data disimpan
			// $kod=$this->input->post('login');
			$user=$this->input->post('user');
			$nama1= $this->input->post('namadepan');
			$nama2=$this->input->post('namabelakang');
            $email=$this->input->post('email');
            $pass= $this->input->post('pass');
			// validasi data double
			$x = array('username' =>$user  );
			$cari=$this->ModelGue->GetWhere('login',$x);

			if(count($cari)>0){
				$data= array('username'=>$user,'pesan'=>'username tidak boleh Sama');
				$this->load->view('Login/Login',$data);
			}else{
				$data = array(
                // 'login_id'=>$kod,
				'username'=>$user,
				// 'nomor_nasabah'=>$nama,
				'namadepan'=>$nama1,
				'namabelakang'=>$nama2,
				'email'=>$email,
				'password'=>md5($pass));
                
				// simpan data ke tabel 
				$this->ModelGue->insert('login',$data);
                                    //generate simple random code
                $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $code = substr(str_shuffle($set), 0, 12);

                    //set up email
                $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com', //Ubah sesuai dengan host anda
                    'smtp_port' => 465,
                    'smtp_user' => 'koperasisahabatmandiri@gmail.com', // Ubah sesuai dengan email yang dipakai untuk mengirim konfirmasi
                    'smtp_pass' => 'Cakung99', // ubah dengan password host anda
                    'smtp_username' => 'ADMIN_KOPERASI', // Masukkan username SMTP anda
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE
                    );

                $message =  "
                <html>
                <head>
                <title>Verification Code</title>
                </head>
                <body>
                <h2>Thank you for Registering.</h2>
                <p>Your Account:</p>
                <p>Email: ".$email."</p>
                <p>Password: ".$pass."</p>
                <p>Please click the link below to activate your account.</p>
                <h4><a href='".base_url('CLogin/activate/').$user."/".$code."'>Activate My Account</a></h4>
                </body>
                </html>
                ";
                
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from($config['smtp_user']);
                $this->email->to($email);
                $this->email->subject('Signup Verification Email');
                $this->email->message($message);

                    //sending email
                if($this->email->send()){
                    $this->session->set_flashdata('message','Activation code sent to email');
                }
                else{
                    $this->session->set_flashdata('message', $this->email->print_debugger());
                    
                }
                $a=base_url('CLogin');
              
                redirect($a);
				// atau memanggil ke index
				// $this->index()
			}
		}
    }	

    public function activate(){
        $id =  $this->uri->segment(3);
        $code = $this->uri->segment(4);
      
        //fetch user details
        $user = $this->ModelData->getUser($id);
      
        //if code matches
        if($user['code'] == $code){
         //update user active status
         $data['active'] = true;
         $query = $this->ModelData->activate($data, $id);
      
         if($query){
          $this->session->set_flashdata('message', 'User activated successfully');
         }
         else{
          $this->session->set_flashdata('message', 'Something went wrong in activating account');
         }
        }
        else{
         $this->session->set_flashdata('message', 'Cannot activate account. Code didnt match');
        }
        $a=base_url('CLogin');
              
        redirect($a);
    }
    
    // function login(){
	// 	$this->form_validation->set_rules('email','email','required|trim');
	// 	$this->form_validation->set_rules('pass','password','required|trim');
		
	// 	// $login = false;
	// 	if ($this->form_validation->run()==FALSE) {
	// 	 $dt = array('pesan' => validation_errors());
	// 		//$dt['pesan']= validation_error();
	// 	 	$login = 'kosong';
	// 	$this->load->view('index',$dt);
	// 	}else
	// 	{
	// 		$login = 'gagal';
	// 		$userid=$this->input->post('email');
	// 		$pass=$this->input->post('pass');
	// 		$where=array('email'=>$userid);
	// 		$dataadmn=$this->ModelGue->GetWhere('login',$where); 
			
	// 		$data_account=array('email'=>$userid,'PASSWORD'=>md5($pass));
	// 		$dt_result_ceklogin = $this->ModelGue->cek_login('login',$data_account);

	// 		// echo $dt_result_ceklogin; exit();
	// 		// ```````````````````````````````````````````````````````````````````
			
	// 		// if($dt_result_ceklogin==1 && $dataadmn->hak_akses==1){
				
	// 		// 	$nama=$dataadmn->nama_karyawan;
	// 		// 	$this->session->set_userdata('userlogin',array(
	// 		// 		'nama'=>$nama,
	// 		// 		"level"=>$dataadmn->hak_akses,
	// 		// 	));
	// 		// 	$data=array('dt_hrd'=>$dt_result_ceklogin);
	// 		// 	$login = 'berhasil';
				
	// 		// }
	// 		// if($dt_result_ceklogin==1 && $dataadmn->hak_akses==2){

	// 		// 	$cek=array('pesan'=>'Selamat Datang'.$dt_result_ceklogin);
	// 		// 	$nama=$dataadmn->nama_karyawan;
	// 		// 	$this->session->set_userdata('userlogin',array(
	// 		// 		'nama'=>$nama,
	// 		// 		"level"=>$dataadmn->hak_akses,
	// 		// 	));
	// 		// 	$data=array('dt_uang'=>$dt_result_ceklogin);
	// 		// 	$login = 'berhasil';
	// 		// }
	// 		// if($dt_result_ceklogin==1 && $dataadmn->hak_akses==3){
				
	// 		// 	$cek=array('pesan'=>'Selamat Datang'.$dt_result_ceklogin);
	// 		// 	$nama=$dataadmn->nama_karyawan;
	// 		// 	$this->session->set_userdata('userlogin',array(
	// 		// 		'nama'=>$nama,
	// 		// 		"level"=>$dataadmn->hak_akses,
	// 		// 	));
	// 		// 	$data=array('owner'=>$dt_result_ceklogin);
	// 		// 	$login = 'berhasil';
	// 		// }

	// 		$cek=array('pesan'=>'username dan password salah');

	// 		echo json_encode($cek);
			
	// 		// $this->load->view('Index',$cek);
	// 	}
    // }
    function logout(){
		$this->session->sess_destroy();
		// redirect(base_url('Signin'));
			// $sesi=array('user_name'=>'','useraktif'=>'');
			$this->session->unset_userdata('userlogin');
			$x=base_url('Login');
			redirect($x);
	}

    

    
}


?>