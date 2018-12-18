<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$data['users']  	 = $this->Mcrud->get_users();
			$data['judul_web'] = "Dashboard";

			$this->load->view('users/header', $data);
			$this->load->view('users/dashboard', $data);
			$this->load->view('users/footer');
		}
	}

	public function profile()
	{
		$ceks = $this->session->userdata('username');
		$level = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  = $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Profile";

					$this->load->view('users/header', $data);
					$this->load->view('users/profile', $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnupdate'])) {
						$username	 		= htmlentities(strip_tags($this->input->post('username')));
						$nama_lengkap	= htmlentities(strip_tags($this->input->post('nama_lengkap')));

						$pesan = '';
						if ($ceks == $username) {
							$update = 'yes';
						}else{
							$cek_un = $this->Mcrud->get_users_by_un($username)->num_rows();
							if ($cek_un == 0) {
									$update = 'yes';
							}else{
									$update = 'no';
									$pesan  = 'Username "<b>'.$username.'</b>" sudah ada';
							}
						}

						if ($update=='yes') {
							$folder = "profile";
							$data_user = $this->db->get_where('tbl_user', array('username'=>$ceks))->row();
							$foto_lama = $data_user->foto_user;
							$lokasi = "img/$folder/";
							$cmax = 5; //5 mb
									$file_size = 1024 * $cmax;
									$this->upload->initialize(array(
										"upload_path"   => "./$lokasi",
										"allowed_types" => "jpg|jpeg|png|gif|bmp",
										"max_size" => "$file_size",
										"remove_spaces" => TRUE,
										"encrypt_name" => TRUE
									));

							if ($_FILES['foto']['error'] <> 4) {
									if ( ! $this->upload->do_upload('foto'))
									{
												$error = htmlentities(strip_tags($this->upload->display_errors()));
												$up_size = $_FILES['foto']['size']/1024;
												if ($up_size > $file_size) {
													$pesan  = 'Maksimal Unggah '.$cmax.' MB.';
												}else {
													$pesan  = $error;
												}
												$update = 'no';
									}
									 else
									{
										if ($this->Mcrud->cek_filename($foto_lama,'cek') != '0') {
												unlink("$foto_lama");
										}
										$upload_data  = $this->upload->data();
										$foto = $upload_data['file_name'];
										$foto = $lokasi.preg_replace('/ /', '_', $foto);
										$update = 'yes';
									}
							}else {
								$foto = $foto_lama;
								$update = 'yes';
							}
						}

						if ($update == 'yes') {
									$data = array(
										'username'			=> $username,
										'nama_lengkap'	=> $nama_lengkap,
										'foto_user'			=> $foto
									);
									$this->Mcrud->update_user(array('username' => $ceks), $data);

									if ($level=='2') {
										$datax = array(
											'username'			=> $username,
											'nama_lengkap'	=> $nama_lengkap,
											'foto_user'			=> $foto
										);
										$this->db->update('tbl_timsar', $datax, array('id_timsar'=>$data_user->id_timsar));
									}

									$this->session->has_userdata('username');
									$this->session->set_userdata('username', "$username");

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Profile berhasil disimpan.
										</div>
	 								 <br>'
									);
									redirect('profile');
						}else {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> '.$pesan.'.
								</div>
								<br>'
							);
							redirect('profile');
						}
					}
		}
	}

	public function ubah_pass()
	{
		$ceks = $this->session->userdata('username');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  = $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Ubah Password";

					$this->load->view('users/header', $data);
					$this->load->view('users/ubah_pass', $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnupdate2'])) {
						$password0 	= htmlentities(strip_tags($this->input->post('password0')));
						$password 	= htmlentities(strip_tags($this->input->post('password')));
						$password2 	= htmlentities(strip_tags($this->input->post('password2')));

						if ($password0 != $data['user']->row()->password) {
								$this->session->set_flashdata('msg2',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Password lama salah.
									</div>
 								 <br>'
								);
								redirect('ubah_pass');
						}

						if ($password != $password2) {
								$this->session->set_flashdata('msg2',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Password tidak cocok.
									</div>
 								 <br>'
								);
						}else{
									$data = array(
										'password'	=> $password
									);
									$this->Mcrud->update_user(array('username' => $ceks), $data);

									$this->session->set_flashdata('msg2',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Password berhasil disimpan.
										</div>
	 								 <br>'
									);
						}
									redirect('ubah_pass');
					}
		}
	}

}
