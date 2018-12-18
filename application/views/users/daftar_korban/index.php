
<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="dashboard.html">Dashboard</a></li>
				<li class="active"><?php echo $judul_web; ?></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Data <small><?php echo $judul_web; ?></small></h1>
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
              <?php
                echo $this->session->flashdata('msg');
								$level 	 = $this->session->userdata('level');
              ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Data Table</h4>
                        </div>
                        <div class="panel-body">
													<?php if ($level==2): ?>
														<a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/t.html" class="btn btn-primary">+ Data</a>
														<hr>
													<?php endif; ?>
                          <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="1%">No.</th>
                                        <th width="10%">Foto</th>
                                        <th width="24%">Nama</th>
																				<th	width="12%">Kartu Triase</th>
                                        <th width="18%">Posko</th>
                                        <th width="16%">Desa</th>
                                        <th width="14%">Updated at</th>
																				<?php if ($level==2): ?>
                                        <th width="5%">Action</th>
																				<?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $no=1;
																	$red=0;
                                   foreach ($query->result() as $baris):?>
                                    <tr>
                                        <td><?php echo $no++; ?>.</td>
                                        <td>
																					<center>
																						<img src="<?php echo $this->Mcrud->cek_filename($baris->foto_korban); ?>" alt="" width="50">
																					</center>
																				</td>
																				<td><?php if($baris->nama_korban==''){echo "(Belum ada Nama)";}else{echo $baris->nama_korban;} ?></td>
																				<td><?php echo $this->Mcrud->cek_triase($baris->kondisi_korban); ?></td>
																				<td><?php echo $baris->posko; ?></td>
																				<td><?php echo $baris->desa; ?></td>
																				<td><?php echo date('d-m-Y H:i',strtotime($baris->tgl_daftar_korban)); ?></td>
																				<?php if ($level==2): ?>
																				<td align="center">
																					<a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/e/<?php echo hashids_encrypt($baris->id_daftar_korban); ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                          <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/h/<?php echo hashids_encrypt($baris->id_daftar_korban); ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda yakin?');"><i class="fa fa-trash-o"></i></a>
                                        </td>
																				<?php endif; ?>
                                    </tr>
                                  <?php
																	endforeach; ?>
                                </tbody>
                            </table>

														<?php foreach ($v_triase->result() as $key => $value): ?>
															<span class="btn btn-default btn-xs" style="height:12px;background:<?php echo $this->Mcrud->jenis_kartu($value->jenis_kartu,'val2'); ?>;"></span>
															<?php
															$this->db->join('tbl_timsar',"tbl_timsar.id_timsar=tbl_daftar_korban.id_timsar");
															if ($level==2) {
																$this->db->where('tbl_daftar_korban.id_timsar', $timsar->id_timsar);
															}
															$this->db->where('tbl_daftar_korban.kartu_triase', $value->jenis_kartu);
															echo $this->db->get("tbl_daftar_korban")->num_rows();
															?>
															Orang &nbsp;
														<?php endforeach; ?>

													</div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->
