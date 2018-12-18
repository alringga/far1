
<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="">Beranda</a></li>
				<li class="active">Daftar Korban</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">SEMUA DATA <small>Daftar Korban</small></h1>
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
                                <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a> -->
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title"><?php echo $this->Mcrud->judul_web(); ?></h4>
                        </div>
                        <div class="panel-body">
                          <div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="1%">No.</th>
                                        <th width="10%">Foto</th>
                                        <th width="27%">Nama</th>
																				<th	width="12%">Kartu Triase</th>
                                        <th width="19%">Posko</th>
                                        <th width="17%">Desa</th>
                                        <th width="14%">Updated at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $no=1;
																	$red=0;
                                   foreach ($query->result() as $baris):
                                     $foto = $this->Mcrud->cek_filename($baris->foto_korban);?>
                                    <tr>
                                        <td><?php echo $no++; ?>.</td>
                                        <td>
																					<center>
                                            <a href="<?php echo $foto; ?>" data-fancybox="all" data-caption="<?php echo "$baris->nama_korban"; ?>">
                                              <img src="<?php echo $foto; ?>" alt="" width="70">
  																					</a>
																					</center>
																				</td>
																				<td><?php if($baris->nama_korban==''){echo "(Belum ada Nama)";}else{echo $baris->nama_korban;} ?></td>
																				<td><?php echo $this->Mcrud->cek_triase($baris->kondisi_korban); ?></td>
																				<td><?php echo $baris->posko; ?></td>
																				<td><?php echo $baris->desa; ?></td>
																				<td><?php echo date('d-m-Y H:i',strtotime($baris->tgl_daftar_korban)); ?></td>
																		</tr>
                                  <?php
																	endforeach; ?>
                                </tbody>
                            </table>

														<?php foreach ($v_triase->result() as $key => $value): ?>
															<span class="btn btn-default btn-xs" style="height:12px;background:<?php echo $this->Mcrud->jenis_kartu($value->jenis_kartu,'val2'); ?>;"></span>
															<?php
															$this->db->join('tbl_timsar',"tbl_timsar.id_timsar=tbl_daftar_korban.id_timsar");
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
