<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Model {

	var $tbl_users				 = 'tbl_user';

 public static function tgl_id($date, $bln='')
 {
		 $str = explode('-', $date);
		 $bulan = array(
			 '01' => 'Januari',
			 '02' => 'Februari',
			 '03' => 'Maret',
			 '04' => 'April',
			 '05' => 'Mei',
			 '06' => 'Juni',
			 '07' => 'Juli',
			 '08' => 'Agustus',
			 '09' => 'September',
			 '10' => 'Oktober',
			 '11' => 'November',
			 '12' => 'Desember',
		 );
		 if ($bln == '') {
			 $hasil = $str['0'] . " " . $bulan[$str[1]] . " " .$str[2];
		 }else {
			 $hasil = $bulan[$str[1]];
		 }
		 return $hasil;
 }

	public function hari_id($tanggal)
	{
		$day = date('D', strtotime($tanggal));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => "Jum'at",
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}

	public function get_users()
	{
			return $this->db->get_where($this->tbl_users, "dihapus='tidak'");
	}

	public function get_level_users()
	{
			// $this->db->where('tbl_user.level', 'user');
			return $this->db->get_where($this->tbl_users, "dihapus='tidak'");
	}

	public function get_users_by_un($id)
	{
				return $this->db->get_where($this->tbl_users, array('username'=>"$id", "dihapus"=>'tidak'));
	}

	public function get_level_users_by_id($id)
	{
			$this->db->from($this->tbl_users);
			$this->db->where('tbl_user.dihapus', 'tidak');
			$this->db->where('tbl_user.level', 'user');
			$this->db->where('tbl_user.id_user', $id);
			$query = $this->db->get();
			return $query->row();
	}

	public function save_user($data)
	{
		$this->db->insert($this->tbl_users, $data);
		return $this->db->insert_id();
	}

	public function update_user($where, $data)
	{
		$this->db->update($this->tbl_users, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_user_by_id($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbl_users);
	}


	public function v_video($order, $limit='', $by='')
	{
		if ($by=='') {
			$by='DESC';
		}
					 $this->db->order_by("$order", "$by");
					 if ($limit!='') {
						 $this->db->limit($limit);
					 }
		return $this->db->get('tbl_video');
	}

	public function v_artikel($order, $limit='', $by='')
	{
		if ($by=='') {
			$by='DESC';
		}
					 $this->db->order_by("$order", "$by");
					 if ($limit!='') {
						 $this->db->limit($limit);
					 }
		return $this->db->get('tbl_artikel');
	}

	public function video_by()
	{
		return 'Admin';
	}

	function view_galeri($num, $offset)
	{
		$this->db->order_by('id_galeri', 'DESC');
		$query = $this->db->get('tbl_galeri',$num, $offset);
		return $query;
	}

	function view_artikel($num, $offset)
	{
		$this->db->order_by('id_artikel', 'DESC');
		$query = $this->db->get('tbl_artikel',$num, $offset);
		return $query;
	}

	function view_video($num, $offset)
	{
		$this->db->order_by('id_video', 'DESC');
		$query = $this->db->get('tbl_video',$num, $offset);
		return $query;
	}

	function link_download($url)
	{
		if(preg_match("/https:/i", $url)) {
		  $link = "https://ss".substr($url,12);
		} elseif(preg_match("/http:/i", $url)) {
		  $link = "https://ss".substr($url,11);
		} elseif(preg_match("/www./i", $url)) {
		  $link = "https://ss".substr($url,4);
		} else {
		  $link = "https://ss".$url;
		}
		return $link;
	}

	function judul_web($id='')
	{
		$nama_web = $this->db->get_where('tbl_web',"id_web='1'")->row()->nama_web;
		$ket_web  = $this->db->get_where('tbl_web',"id_web='1'")->row()->ket_web;
		if ($id==1) {
			$data = "$nama_web";
		}elseif ($id==2) {
			$data = "$ket_web";
		}else {
			$data = "$nama_web $ket_web";
		}
		return $data;
	}

	function v_kat($aksi='',$id='',$max='')
	{
		$cek_data = $this->db->get_where('tbl_kat', array('dihapus'=>'tidak','id_kat'=>"$id"))->row();
		if ($aksi=='nama') {
			if ($max=='') {
				$data = ucwords($cek_data->nama_kat);
			}else {
				$data = ucwords(substr($cek_data->nama_kat,0,$max));
			}
		}elseif ($aksi=='url') {
			$data = "kat/".$cek_data->url_kat.".html";
		}else {
			$data = '';
		}
		return $data;
	}

	function footer()
	{
			return "Copyright &copy; 2018 | Developer by <a href='http://esotechno.com/' target='_blank'>CV. ESOTECHNO</a>";
	}

	function level($id)
	{
		if ($id==1) {
			$data = "DINAS KESEHATAN";
		}elseif ($id==2) {
			$data = "TIM SAR";
		}else {
			$data = "MASYARAKAT";
		}
		return $data;
	}

	public function cek_filename($file='',$aksi='')
	{
		if ($aksi=='cek') {
			$data = '0';
		}else {
			$data = "img/logo_user.jpg";
		}
		if ($file != '') {
			if(file_exists("$file")){
				$data = $file;
			}
		}
		return $data;
	}

	public function sel_jenis_kartu($val,$id='')
	{
		if ($val=='merah') {
			$warna = "danger";
		}elseif ($val=='hijau') {
			$warna = "success";
		}elseif ($val=='kuning') {
			$warna = "warning";
		}elseif ($val=='putih') {
			$warna = "default";
		}elseif ($val=='hitam') {
			$warna = "inverse";
		}
			?>
			<div class="radio radio-css radio-<?php echo $warna; ?>">
					<input type="radio" name="jenis_kartu" id="<?php echo $val; ?>" value="<?php echo $val; ?>" <?php if($val==$id){echo "checked";} ?> required>
					<label for="<?php echo $val; ?>">
							<?php echo ucwords($val); ?>
					</label>
			</div>
			<?php
	}

	public function jenis_kartu($val,$val2='')
	{
		if ($val=='merah') {
			$warna = "red";
		}elseif ($val=='hijau') {
			$warna = "green";
		}elseif ($val=='kuning') {
			$warna = "yellow";
		}elseif ($val=='putih') {
			$warna = "white";
		}elseif ($val=='hitam') {
			$warna = "black";
		}

		if ($val2=='') {
			?>
			<label style="color:<?php echo $warna; ?>"><?php echo ucwords($val); ?></label>
			<?php
		}else {
			return $warna;
		}
	}


	public function kondisi_pasien($val,$val2='')
	{
		$v_data = (explode(",",$val));
		$no=1;
		foreach ($v_data as $key => $value) {
			if ($value!='') {?>
			<div class="checkbox checkbox-css checkbox-inline checkbox-inverse">
				<input type="checkbox" name="kondisi_pasien[]" value="<?php echo $value; ?>" id="kondisi_pasien_<?php echo $no; ?>" <?php echo $val2; ?> required>
				<label for="kondisi_pasien_<?php echo $no; ?>">
					<?php echo $value; ?>
				</label>
			</div>
			<br>
	<?php
			}
			$no++;
		}
	}

	public function cek_triase($val,$val2='')
	{
		$v_data = (explode(",",$val));
		$no=1;
		foreach ($v_data as $key => $value2) {
				// if ($no<=1) {
					$this->db->like('kondisi_pasien',"$value2");
				// }else {
					// $this->db->or_like('kondisi_pasien',"$value2");
				// }
			$no++;
		}
						$this->db->order_by('id_triase','DESC');
		$cek = $this->db->get('tbl_triase');
		if ($cek->num_rows()==0) {
			$data = "putih";
		}else {
			$data = $cek->row()->jenis_kartu;
		}
		if ($val2=='input') {
			return $data;
		}else {
			return $this->jenis_kartu($data);
		}

	}

}
