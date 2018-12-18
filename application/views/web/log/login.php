<!-- begin #page-container -->
<div id="page-container" class="fade">
		<!-- begin login -->
			<div class="login login-with-news-feed">
					<!-- begin news-feed -->
					<div class="news-feed">
							<div class="news-image">
									<img src="assets/panel/img/login-bg/bg-7.jpg" data-id="login-cover-image" height="100%" alt="" />
							</div>
							<div class="news-caption">
									<h4 class="caption-title"><i class="ion-ios-medkit m-r-15 fa-2x pull-left"></i> <?php echo $this->Mcrud->judul_web(1); ?></h4>
									<b>
											<?php echo $this->Mcrud->judul_web(); ?>
									</b>
							</div>
					</div>
					<!-- end news-feed -->
					<!-- begin right-content -->
					<div class="right-content">
							<!-- begin login-header -->
							<div class="login-header">
									<div class="brand">
											<span class="logo"><i class="ion-ios-medkit"></i></span> Form Login
											<small><?php echo $this->Mcrud->tgl_id(date('d-m-Y')); ?></small>
									</div>
									<div class="icon">
											<i class="ion-ios-locked"></i>
									</div>
							</div>
							<!-- end login-header -->
							<!-- begin login-content -->
							<div class="login-content">
								<?php
								echo $this->session->flashdata('msg');
								?>
									<form action="" method="POST" class="margin-bottom-0" data-parsley-validate="true">
											<div class="form-group m-b-15">
													<input type="text" name="username" class="form-control input-lg" placeholder="Username" autofocus required />
											</div>
											<div class="form-group m-b-15">
													<input type="password" name="password" class="form-control input-lg" placeholder="Password" required />
											</div>
											<div class="checkbox m-b-30">
													<label>
															<input type="checkbox" /> Remember Me
													</label>
											</div>
											<div class="login-buttons">
													<button type="submit" name="btnlogin" class="btn btn-primary btn-block btn-lg">Sign me in</button>
											</div>
											<!-- <div class="m-t-20 m-b-40 p-b-40 text-inverse">
													Not a member yet? Click <a href="register_v3.html">here</a> to register.
											</div> -->
											<hr />
											<p class="text-center">
													<?php echo $this->Mcrud->footer(); ?>
											</p>
									</form>
							</div>
							<!-- end login-content -->
					</div>
					<!-- end right-container -->
			</div>
			<!-- end login -->
</div>
<!-- end page container -->
