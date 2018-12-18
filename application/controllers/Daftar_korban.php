<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_korban extends CI_Controller {

	public function index()
	{
		redirect('daftar_korban/v');
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

			if ($level != '1' AND $level != '2') {
					redirect('404_content');
			}

			if ($level==2) {
				$this->db->join('tbl_user',"tbl_user.id_timsar=tbl_timsar.id_timsar");
				$this->db->where('tbl_user.id_user', "$id_user");
				$data['timsar'] = $this->db->get("tbl_timsar")->row();
				$id_timsar = $data['timsar']->id_timsar;
			}

			$this->db->order_by('id_triase', 'ASC');
			$data['v_triase'] = $this->db->get("tbl_triase");

			$this->db->join('tbl_timsar',"tbl_timsar.id_timsar=tbl_daftar_korban.id_timsar");
			if ($level==2) {
				$this->db->where('tbl_daftar_korban.id_timsar', $id_timsar);
			}
			$this->db->order_by('tbl_daftar_korban.id_daftar_korban', 'DESC');
			$data['query'] = $this->db->get("tbl_daftar_korban");

				if ($aksi == 't') {
					if ($level != '2') {
							redirect('404_content');
					}
					$p = "tambah";
					$data['judul_web'] 	  = "+ Daftar Korban";
				}elseif ($aksi == 'e') {
					if ($level != '2') {
							redirect('404_content');
					}
					$p = "edit";
					$data['judul_web'] 	  = "Edit Daftar Korban";
													 $this->db->join('tbl_timsar',"tbl_timsar.id_timsar=tbl_daftar_korban.id_timsar");
													 $this->db->where('tbl_daftar_korban.id_timsar', $id_timsar);
					$data['query'] = $this->db->get_where("tbl_daftar_korban", array('tbl_daftar_korban.id_daftar_korban'=>"$id"))->row();
					if ($data['query']->id_daftar_korban=='') {redirect('404');}
				}
				elseif ($aksi == 'h') {
					if ($level != '2') {
							redirect('404_content');
					}
					$this->db->join('tbl_timsar',"tbl_timsar.id_timsar=tbl_daftar_korban.id_timsar");
					$this->db->where('tbl_daftar_korban.id_timsar', $id_timsar);
					$cek_data = $this->db->get_where("tbl_daftar_korban", array('id_daftar_korban'=>"$id"));
					if ($cek_data->num_rows() != 0) {
							$data_x = $cek_data->row();
							if ($this->Mcrud->cek_filename($data_x->foto_korban,'cek')!='0') {
								unlink($data_x->foto_korban);
							}
							$this->db->delete('tbl_daftar_korban', array('id_daftar_korban'=>$id));
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
							redirect("daftar_korban/v");
					}else {
						redirect('404_content');
					}
				}else{
					$p = "index";
					$data['judul_web'] 	  = "DAFTAR KORBAN";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/daftar_korban/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d H:i:s');

					$lokasi = "img/pasien/";
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
						$nama_lengkap 	= htmlentities(strip_tags($this->input->post('nama_lengkap')));
						$kondisi_pasien = $this->input->post('kondisi_pasien');

						$kondisi_ = '';
            for ($i=0; $i < count($kondisi_pasien) ; $i++) {
                $kondisi_ = $kondisi_.','.$kondisi_pasien[$i];
            }
						$kondisi_korban = substr($kondisi_,1);
						$kartu_triase   = $this->Mcrud->cek_triase($kondisi_korban,'input');

						$simpan = 'ya';
						if ($simpan=='ya') {
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
										$upload_data  = $this->upload->data();
										$foto = $upload_data['file_name'];
										$foto = $lokasi.preg_replace('/ /', '_', $foto);
										$simpan = 'ya';
									}
							}else {
								$foto = Null;
								$simpan = 'ya';
							}
						}

							if($simpan=='ya'){
									$id_timsar = $data['timsar']->id_timsar;
										$data = array(
											'nama_korban'				=> $nama_lengkap,
											'foto_korban'				=> $foto,
											'kondisi_korban' 		=> $kondisi_korban,
											'kartu_triase' 			=> $kartu_triase,
											'id_timsar' 				=> $id_timsar,
											'tgl_daftar_korban' => $tgl
										);
										$this->db->insert('tbl_daftar_korban',$data);

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
						 redirect("daftar_korban/v/t");
					}


					if (isset($_POST['btnupdate'])) {
						$nama_lengkap = htmlentities(strip_tags($this->input->post('nama_lengkap')));

						$simpan = 'ya';
						$data_un 		= $this->db->get_where('tbl_daftar_korban', array('id_daftar_korban'=>$id))->row();
						if ($simpan=='ya') {
							$foto_lama = $data_un->foto_korban;
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
											'nama_korban'				=> $nama_lengkap,
											'foto_korban'				=> $foto,
											'tgl_daftar_korban' => $tgl
										);
										$this->db->update('tbl_daftar_korban', $data, array('id_daftar_korban'=>$id));

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
								redirect("daftar_korban/v/e/".hashids_encrypt($id));
					}
		}
	}

}
