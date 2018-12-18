<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Triase extends CI_Controller {

	public function index()
	{
		redirect('triase/v');
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

			$this->db->order_by('id_triase', 'ASC');
			$data['query'] = $this->db->get("tbl_triase");

				if ($aksi == 't') {
					$p = "tambah";
					$data['judul_web'] 	  = "+ Triase";
				}elseif ($aksi == 'e') {
					$p = "edit";
					$data['judul_web'] 	  = "Edit Triase";
					$data['query'] = $this->db->get_where("tbl_triase", array('id_triase' => "$id"))->row();
					if ($data['query']->id_triase=='') {redirect('404');}
				}
				elseif ($aksi == 'h') {
					$cek_data = $this->db->get_where("tbl_triase", array('id_triase' => "$id"));
					if ($cek_data->num_rows() != 0) {
							$this->db->delete('tbl_triase', array('id_triase' => $id));
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
							redirect("triase/v");
					}else {
						redirect('404_content');
					}
				}else{
					$p = "index";
					$data['judul_web'] 	  = "Triase";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/triase/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$jenis_kartu 		= htmlentities(strip_tags($this->input->post('jenis_kartu')));
						$kondisi_pasien = htmlentities(strip_tags($this->input->post('kondisi_pasien')));
						$deskripsi			= htmlentities(strip_tags($this->input->post('deskripsi')));

										$data = array(
											'jenis_kartu' 	 => $jenis_kartu,
											'kondisi_pasien' => $kondisi_pasien,
											'deskripsi'  		 => $deskripsi,
											'tgl_triase'  	 => $tgl
										);
										$this->db->insert('tbl_triase',$data);

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

						 redirect("triase/v/t");
					}


					if (isset($_POST['btnupdate'])) {
						$jenis_kartu 		= htmlentities(strip_tags($this->input->post('jenis_kartu')));
						$kondisi_pasien = htmlentities(strip_tags($this->input->post('kondisi_pasien')));
						$deskripsi			= htmlentities(strip_tags($this->input->post('deskripsi')));

										$data = array(
											'jenis_kartu' 	 => $jenis_kartu,
											'kondisi_pasien' => $kondisi_pasien,
											'deskripsi'  		 => $deskripsi
										);
										$this->db->update('tbl_triase',$data, array('id_triase' => $id));

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

						 redirect("triase/v/e/".hashids_encrypt($id));
					}
		}
	}

}
