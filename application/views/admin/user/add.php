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
            <li class="breadcrumb-item active">Tambah User</li>
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
            <form method="POST" action="<?= base_url() ?>admin/user/add_action">
              <div class="card-body">
                <div class="form-group col-md-4">
                  <label for="nama">Username</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="username" value="<?= set_value('username') ?>">
                  <?= form_error('username'); ?>
                </div>
                <div class="form-group col-md-4">
                  <label for="nama">Password</label>
                  <input type="password" class="form-control" id="exampleInputEmail1" name="password" value="<?= set_value('password') ?>">
                  <?= form_error('password'); ?>
                </div>
                <div class="form-group col-md-12">
                  <label for="nama">Role</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value='admin'>
                    <label class="form-check-label">Admin</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" value='atasan'>
                    <label class="form-check-label">Atasan</label>
                  </div>
                  <?= form_error('role') ?>
                </div>
                <div class="form-group col-md-2">
                  <input type="submit" class="form-control btn btn-primary" value="Tambah">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>