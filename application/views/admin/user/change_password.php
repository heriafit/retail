<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $judul ?></h1>
          
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url().'admin/guru' ?>"><?= $judul ?></a></li>
            <li class="breadcrumb-item active">Ganti Password</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          

          <div class="card card-primary card-outline">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?= base_url().'admin/user/change_password' ?>">
					<div class="form-group col-md-8">
						<label for="nama">Password</label>
						<input type="password" class="form-control" id="exampleInputEmail1" name="password" >
						<?= form_error('password'); ?>
					</div>
					<div class="form-group col-md-8">
						<label for="nama">Konfirmasi Password</label>
						<input type="password" class="form-control" id="exampleInputEmail1" name="konfirmasi_password" >
						<?= form_error('konfirmasi_password'); ?>

						<input type="hidden" name="username" value="<?= $this->session->userdata('username') ?>">
					</div>
					<div class="form-group col-md-3">
						<input type="submit" class="form-control btn btn-primary" value="Ubah Password">
					</div>

				</form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>