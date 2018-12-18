<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

	public function index()
	{
		// redirect('web/login');
		$this->db->join('tbl_timsar',"tbl_timsar.id_timsar=tbl_daftar_korban.id_timsar");
		$this->db->order_by('tbl_daftar_korban.id_daftar_korban', 'DESC');
		$data['query'] = $this->db->get("tbl_daftar_korban");

		$data['judul_web'] 	  = $this->Mcrud->judul_web()." DAFTAR KORBAN";

		$this->db->order_by('id_triase', 'ASC');
		$data['v_triase'] = $this->db->get("tbl_triase");

		$this->load->view('web/header', $data);
		$this->load->view('web/beranda', $data);
		$this->load->view('web/footer');
	}

	public function login()
	{
		$ceks = $this->session->userdata('username');
		if(isset($ceks)) {
			// $this->load->view('404_content');
			redirect('dashboard');
		}else{
			$this->load->view('web/log/header');
			$this->load->view('web/log/login');
			$this->load->view('web/log/footer');

				if (isset($_POST['btnlogin'])){
						 $username = htmlentities(strip_tags($_POST['username']));
						 $pass	   = htmlentities(strip_tags($_POST['password']));

						 $query  = $this->Mcrud->get_users_by_un($username);
						 $cek    = $query->result();
						 $cekun  = $cek[0]->username;
						 $jumlah = $query->num_rows();

						 if($jumlah == 0) {
								 $this->session->set_flashdata('msg',
									 '
									 <div class="alert alert-danger alert-dismissible" role="alert">
									 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;&nbsp;</span>
											</button>
											<strong>Username "'.$username.'"</strong> belum terdaftar.
									 </div>'
								 );
								 redirect('web/login');
						 } else {
										 $row = $query->row();
										 $cekpass = $row->password;
										 if($cekpass <> $pass) {
												$this->session->set_flashdata('msg',
													 '<div class="alert alert-warning alert-dismissible" role="alert">
													 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																<span aria-hidden="true">&times;&nbsp;</span>
															</button>
															<strong>Username atau Password Salah!</strong>.
													 </div>'
												);
												redirect('web/login');
										 } else {

																$this->session->set_userdata('username', "$cekun");
																$this->session->set_userdata('id_user', "$row->id_user");
																$this->session->set_userdata('level', "$row->level");

												 			 	redirect('dashboard');
										 }
						 }
				}
		}
	}


	public function logout() {
     if ($this->session->has_userdata('username') and $this->session->has_userdata('id_user')) {
         $this->session->sess_destroy();
     }
		 redirect('web/login');
  }

	function error_not_found(){
		$this->load->view('404_content');
	}

}
