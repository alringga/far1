<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
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
                    <label class="control-label col-lg-3">Posko</label>
                    <div class="col-lg-9">
                      <input type="text" name="posko" class="form-control" value="<?php echo $query->posko; ?>" placeholder="Posko" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Desa</label>
                    <div class="col-lg-9">
                      <input type="text" name="desa" class="form-control" value="<?php echo $query->desa; ?>" placeholder="Desa" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $query->nama; ?>" placeholder="Nama" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">E-mail Address</label>
                    <div class="col-lg-9">
                      <input type="email" name="email" class="form-control" value="<?php echo $query->email; ?>" placeholder="E-mail Address" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Username</label>
                    <div class="col-lg-9">
                      <input type="text" name="username" class="form-control" value="<?php echo $query->username; ?>" placeholder="Username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password" class="form-control" value="" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Confirm Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password2" class="form-control" value="" placeholder="Confirm Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Foto</label>
                    <div class="col-lg-9">
                      <input type="file" name="foto" class="form-control" value="">
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->