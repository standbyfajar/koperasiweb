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
					'pesan'=>validation_errors(),
					'pesan1'=>validation_errors()
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
			$x = array('username' =>$user,
						'email' =>$email  );
			$cari=$this->ModelGue->GetWhere('login',$x);

			if(count($cari)>0){
				$data= array('username'=>$user,'pesan'=>'username tidak boleh Sama',
							'email'=> $email,'pesan1'=>'email tidak boleh Sama');
				$this->load->view('Login/Login',$data);
			}else{
				$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code = trim(substr(str_shuffle($set), 0, 12));
				
				$data = array(
                // 'login_id'=>$kod,
				'username'=>$user,
				// 'nomor_nasabah'=>$nama,
				'namadepan'=>$nama1,
				'namabelakang'=>$nama2,
				'email'=>$email,
				'password'=>md5($pass),
                'code'=>$code);
				// simpan data ke tabel 
				$this->ModelGue->insert('login',$data);
                                    //generate simple random code
              
				// echo $code;
				// return;
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
			// echo 'sama';
         //update user active status
         $data['active'] ='true';
         $query = $this->ModelData->activate($data, $id);
      
         if($query){
          $this->session->set_flashdata('pesan', 'User activated successfully');
         }
         else{
          $this->session->set_flashdata('pesan', 'Something went wrong in activating account');
         }
        }
        else{
			// echo 'ga sama';
        $this->session->set_flashdata('pesan', 'Cannot activate account. Code didnt match');
        }
        // $a=base_url('CLogin');
              
        // redirect($a);
    }
    
    function login(){
		$this->form_validation->set_rules('email','email','required|trim');
		$this->form_validation->set_rules('pass','password','required|trim');
		 
		if ($this->form_validation->run()==FALSE) {
			$dt = array('pesan' => validation_errors());
			// $this->load->view('Template',$dt);
			exit;
		}
		else { 
			$userid=$this->input->post('email');
			$pass=$this->input->post('pass');
			$where=array('email'=>$userid);
			$dataadmn=$this->ModelGue->GetWhere('login',$where); 
			
			$data_account=array('email'=>$userid,'PASSWORD'=>md5($pass));
			$dt_result_ceklogin = $this->ModelGue->cek_login('login',$data_account);
			
			if($dt_result_ceklogin==1){
				$data_result = [];
				$nama=$dataadmn->username;
				$data_result['hak_akses'] = $dataadmn->hak_akses;
				$data_result['namadepan'] = $nama;
				$cek=array('pesan'=>'Selamat Datang');

				$this->session->set_userdata('userlogin', $data_result);
				$data=array('admin'=>$dt_result_ceklogin);
				$this->session->set_flashdata('msg_login',$cek['pesan'].' '.$nama);
				$x=base_url('Welcome');
				echo json_encode(array(
					'url' => $x,
					'msg' => $cek['pesan'].' '.$nama,
					'res' => true
				));
				// redirect($x);
			}else{
				$cek=array('pesan'=>'Username dan Password salah');
				$this->session->set_flashdata('msg_login',$cek['pesan']);
				$x=base_url('CLogin');
				echo json_encode(array(
					'url' => $x,
					'msg' => $cek['pesan'],
					'res' => false
				));
				// redirect($x);
			}
			// echo json_encode($cek);
			// $this->load->view('Template',$cek);
		}
    }
    function logout(){
		$this->session->sess_destroy();
			$this->session->unset_userdata('userlogin');
			$x=base_url('CLogin');
			redirect($x);
	}

    

    
}


?>