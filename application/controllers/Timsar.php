<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timsar extends CI_Controller {

	public function index()
	{
		redirect('timsar/v');
	}

	public function v($aksi='', $id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level != '1') {
					redirect('404_content');
			}

			$this->db->join('tbl_user',"tbl_user.id_timsar=tbl_timsar.id_timsar");
			$this->db->order_by('tbl_timsar.id_timsar', 'DESC');
			$data['query'] = $this->db->get("tbl_timsar");

				if ($aksi == 't') {
					$p = "tambah";
					$data['judul_web'] 	  = "+ TIM SAR";
				}elseif ($aksi == 'e') {
					$p = "edit";
					$data['judul_web'] 	  = "Edit TIM SAR";
													 $this->db->join('tbl_user','tbl_user.id_timsar=tbl_timsar.id_timsar');
					$data['query'] = $this->db->get_where("tbl_timsar", array('tbl_user.id_user'=>"$id"))->row();
					if ($data['query']->id_timsar=='') {redirect('404');}
				}
				elseif ($aksi == 'h') {
					$this->db->join('tbl_user','tbl_user.id_timsar=tbl_timsar.id_timsar');
					$cek_data = $this->db->get_where("tbl_timsar", array('id_user'=>"$id"));
					if ($cek_data->num_rows() != 0) {
							$data_x = $cek_data->row();
							if ($this->Mcrud->cek_filename($data_x->foto,'cek')!='0') {
								unlink($data_x->foto);
							}
							$this->db->delete('tbl_timsar', array('id_timsar'=>$data_x->id_timsar));
							$this->db->delete('tbl_user', array('id_user'=>$id));
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Berhasil dihapus.
								</div>
								<br>'
							);
							redirect("timsar/v");
					}else {
						redirect('404_content');
					}
				}else{
					$p = "index";
					$data['judul_web'] 	  = "DAFTAR TIM SAR";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/timsar/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d H:i:s');

					$lokasi = "img/profile/";
					$cmax = 5; //5 mb
							$file_size = 1024 * $cmax;
							$this->upload->initialize(array(
								"upload_path"   => "./$lokasi",
								"allowed_types" => "jpg|jpeg|png|gif|bmp",
								"max_size" => "$file_size",
								"remove_spaces" => TRUE,
								"encrypt_name" => TRUE
							));

					if (isset($_POST['btnsimpan'])) {
						$posko 				= htmlentities(strip_tags($this->input->post('posko')));
						$desa 				= htmlentities(strip_tags($this->input->post('desa')));
						$nama_lengkap = htmlentities(strip_tags($this->input->post('nama_lengkap')));
						$email 				= htmlentities(strip_tags($this->input->post('email')));
						$username		  = htmlentities(strip_tags($this->input->post('username')));
						$password			= htmlentities(strip_tags($this->input->post('password')));
						$password2		= htmlentities(strip_tags($this->input->post('password2')));

						$simpan = 'ya';
						$cek_un = $this->db->get_where('tbl_user', array('username'=>$username));
						if ($cek_un->num_rows()!=0) {
							$simpan = 'tidak';
							$pesan  = "Username <b>'$username'</b> sudah ada";
						}
						if ($password!=$password2) {
							$simpan = 'tidak';
							$pesan  = "Password tidak cocok";
						}

						if ($simpan=='ya') {
									if ( ! $this->upload->do_upload('foto'))
									{
												$error = htmlentities(strip_tags($this->upload->display_errors()));
												$up_size = $_FILES['foto']['size']/1024;
												if ($up_size > $file_size) {
													$pesan  = 'Maksimal Unggah '.$cmax.' MB.';
												}else {
													$pesan  = $error;
												}
												$simpan = 'tidak';
									}
									 else
									{
										$upload_data  = $this->upload->data();
										$foto = $upload_data['file_name'];
										$foto = $lokasi.preg_replace('/ /', '_', $foto);
										$simpan = 'ya';
									}
						}

							if($simpan=='ya'){
										$data = array(
											'posko' 		 => $posko,
											'desa' 		 	 => $desa,
											'nama'  	 	 => $nama_lengkap,
											'email'  	 	 => $email,
											'foto'  		 => $foto,
											'tgl_timsar' => $tgl
										);
										$this->db->insert('tbl_timsar',$data);

									$id_timsar = $this->db->insert_id();
										$datax = array(
											'nama_lengkap' => $nama_lengkap,
											'username' 		 => $username,
											'password'  	 => $password,
											'id_timsar'  	 => $id_timsar,
											'foto_user'  	 => $foto,
											'level'  		 	 => '2',
											'tgl_daftar'   => $tgl,
											'dihapus'   	 => 'tidak'
										);
										$this->db->insert('tbl_user',$datax);

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Berhasil disimpan.
											</div>
		 								 <br>'
										);
								}else{
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
								}
						 redirect("timsar/v/t");
					}


					if (isset($_POST['btnupdate'])) {
						$posko 				= htmlentities(strip_tags($this->input->post('posko')));
						$desa 				= htmlentities(strip_tags($this->input->post('desa')));
						$nama_lengkap = htmlentities(strip_tags($this->input->post('nama_lengkap')));
						$email 				= htmlentities(strip_tags($this->input->post('email')));
						$username		  = htmlentities(strip_tags($this->input->post('username')));
						$password			= htmlentities(strip_tags($this->input->post('password')));
						$password2		= htmlentities(strip_tags($this->input->post('password2')));

						$simpan = 'ya';
						$data_un 		= $this->db->get_where('tbl_user', array('id_user'=>$id))->row();
						$cek_un = $this->db->get_where('tbl_user', array('username'=>$username,'username!='=>$data_un->username));
						if ($cek_un->num_rows()!=0) {
							$simpan = 'tidak';
							$pesan  = "Username <b>'$username'</b> sudah ada";
						}
						if ($password!='' AND $password2=='') {
							$simpan = 'tidak';
							$pesan  = "Ulangi Password belum diisi";
						}elseif ($password=='' AND $password2!='') {
							$simpan = 'tidak';
							$pesan  = "Password belum diisi";
						}elseif ($password!='' AND $password2!='') {
							if ($password!=$password2) {
								$simpan = 'tidak';
								$pesan  = "Password tidak cocok";
							}
						}elseif ($password=='' AND $password2=='') {
							$simpan = 'ya';
							$password  = $data_un->password;
						}else {
							$simpan = 'ya';
						}

						if ($simpan=='ya') {
							$foto_lama = $data_un->foto_user;
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
												$simpan = 'tidak';
									}
									 else
									{
											if ($this->Mcrud->cek_filename($foto_lama,'cek') != '0') {
													unlink("$foto_lama");
											}
										$upload_data  = $this->upload->data();
										$foto = $upload_data['file_name'];
										$foto = $lokasi.preg_replace('/ /', '_', $foto);
										$simpan = 'ya';
									}
							}else {
								$foto = $foto_lama;
								$simpan = 'ya';
							}
						}

							if($simpan=='ya'){
										$data = array(
											'posko' 		 => $posko,
											'desa' 		 	 => $desa,
											'nama'  	 	 => $nama_lengkap,
											'email'  	 	 => $email,
											'foto'  		 => $foto
										);
										$this->db->update('tbl_timsar', $data, array('id_timsar'=>$data_un->id_timsar));

										$datax = array(
											'nama_lengkap' => $nama_lengkap,
											'username' 		 => $username,
											'password'  	 => $password,
											'foto_user'  	 => $foto
										);
										$this->db->update('tbl_user',$datax, array('id_user' => $id));

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Berhasil disimpan.
											</div>
		 								 <br>'
										);
								}else{
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
								}
								redirect("timsar/v/e/".hashids_encrypt($id));
					}
		}
	}

}
