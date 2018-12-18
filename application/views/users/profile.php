<?php
$user = $user->roW();
$level = $user->level;
?>
<!-- Main content -->
<div class="content-wrapper">

  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
      <div class="panel panel-flat">
          <div class="panel-body">
              <center>
                <img src="<?php echo $this->Mcrud->cek_filename($user->foto_user); ?>" alt="<?php echo $user->nama_lengkap; ?>" class="img-circle" width="176" height="170">
              </center>
            <br>
            <fieldset class="content-group">
              <hr style="margin-top:0px;">
              <i class="icon-calendar"></i> <b>Tanggal Terdaftar</b> : <?php echo $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($user->tgl_daftar))); ?>
            </fieldset>
          </form>
          </div>
      </div>

      <div class="panel panel-flat">
          <div class="panel-body">
            <fieldset class="content-group">
              <legend class="text-bold"><i class="icon-user"></i> Ubah Profile</legend>
              <?php
              echo $this->session->flashdata('msg');
              ?>
              <form class="form-horizontal" action="" method="post" data-parsley-validate="true" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label col-lg-3">Username</label>
                  <div class="col-lg-9">
                    <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>" placeholder="Nama Pengguna" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Nama Lengkap</label>
                  <div class="col-lg-9">
                    <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $user->nama_lengkap; ?>" placeholder="Nama Lengkap" maxlength="100" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Foto</label>
                  <div class="col-lg-9">
                    <input type="file" name="foto" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-3">Level</label>
                  <div class="col-lg-9">
                    <input type="text" name="" class="form-control" value="<?php echo $this->Mcrud->level($level); ?>" placeholder="Level User" readonly>
                  </div>
                </div>
                <hr>
                <!-- <div class="col-md-12"> -->
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                <!-- </div> -->
            </fieldset>

          </form>
          </div>
      </div>
      </div>


    </div>
    <!-- /dashboard content -->
