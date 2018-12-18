<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function index()
	{
		redirect('404');
	}

	public function pengguna($aksi='', $id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level != 'admin') {
					redirect('404_content');
			}

			$this->db->where('dihapus',"tidak");
			$this->db->where('level',"operator");
			$this->db->order_by('id_user', 'DESC');
			$data['query'] = $this->db->get("tbl_user");

				if ($aksi == 't') {
					$p = "tambah";
					$data['judul_web'] 	  = "+ Pengguna";
				}elseif ($aksi == 'e') {
					$p = "edit";
					$data['judul_web'] 	  = "Edit Pengguna";
					$data['query'] = $this->db->get_where("tbl_user", array('id_user'=>"$id",'level'=>'operator','dihapus'=>'tidak'))->row();
					if ($data['query']->id_user=='') {redirect('404');}
				}
				elseif ($aksi == 'h') {
					$cek_data = $this->db->get_where("tbl_user", array('id_user'=>"$id",'level'=>'operator','dihapus'=>'tidak'));
					if ($cek_data->num_rows() != 0) {
							$this->db->update('tbl_user', array('dihapus'=>'ya'), array('id_user'=>$id));
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
							redirect("master/pengguna");
					}else {
						redirect('404_content');
					}
				}else{
					$p = "index";
					$data['judul_web'] 	  = "Pengguna";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/master/pengguna/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$nama_lengkap = htmlentities(strip_tags($this->input->post('nama_lengkap')));
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

							if($simpan=='ya'){
										$data = array(
											'nama_lengkap' => $nama_lengkap,
											'username' 		 => $username,
											'password'  	 => $password,
											'level'  		 	 => 'operator',
											'dihapus'  		 => 'tidak',
											'tgl_daftar'   => $tgl
										);
										$this->db->insert('tbl_user',$data);

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
						 redirect("master/pengguna/t");
					}


					if (isset($_POST['btnupdate'])) {
						$nama_lengkap = htmlentities(strip_tags($this->input->post('nama_lengkap')));
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

							if($simpan=='ya'){
										$data = array(
											'nama_lengkap' => $nama_lengkap,
											'username' 		 => $username,
											'password'  	 => $password,
											'level'  		 	 => 'operator',
											'dihapus'  		 => 'tidak'
										);
										$this->db->update('tbl_user',$data, array('id_user' => $id));

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
								redirect("master/pengguna/e/".hashids_encrypt($id));
					}
		}
	}


	public function hitung()
	{
		if (isset($_POST['btnkirim'])) {
				$banyak  = preg_replace('/[Rp. ]/','',htmlentities(strip_tags($this->input->post('banyak'))));
				$harga   = preg_replace('/[Rp. ]/','',htmlentities(strip_tags($this->input->post('harga'))));

				$total  = "Rp. ".number_format($banyak*$harga, 0,",",".");

			echo json_encode(array('total'=>$total));
		}else {
			redirect('404');
		}
	}


}
