<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Jenis Kartu</label>
                    <div class="col-lg-8">
                      <?php echo $this->Mcrud->sel_jenis_kartu('merah'); ?>
                      <?php echo $this->Mcrud->sel_jenis_kartu('hijau'); ?>
                      <?php echo $this->Mcrud->sel_jenis_kartu('kuning'); ?>
                      <?php echo $this->Mcrud->sel_jenis_kartu('putih'); ?>
                      <?php echo $this->Mcrud->sel_jenis_kartu('hitam'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">
                      Kondisi Pasien <br>
                      <b style="color:green;">(Pisahkan dengan koma)</b>
                    </label>
                    <div class="col-lg-8">
                      <input type="text" name="kondisi_pasien" class="form-control" value="" placeholder="Kondisi Pasien" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Deskripsi</label>
                    <div class="col-lg-8">
                      <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" rows="8" cols="80" required></textarea>
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default">Tutup</a>
                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
