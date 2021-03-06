  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $judul ?></h1>
            <?php
            if($this->session->flashdata('message')){
              echo $this->session->flashdata('message');
            }
            ?>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard </a></li>
              <li class="breadcrumb-item active"><?= $judul ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <a href="<?= base_url().'admin/user/add'?>" class="btn btn-sm btn-primary" > Tambah User</a>
                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-import"> Import Data</a>
                <br>
                <br>
                <div class="table-responsive">
                <table class="table table-bordered table" id='data-table'>
                  <thead>
                    <tr>
                      <th> No </th>
                      <th> Username</th>
                      <th> Role </th>
                      <th> Status </th>
                      <th> Last Login </th>
                      <th> Opsi </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; 

                    foreach ($user as $b) : ?>

                      <tr>
                        <td> <?= $no++ ?> </td>
                        <td> <?= $b->username ?> </td>
                        <td> <?= $b->role ?> </td>
                        <td> <?php if($b->status==1){ echo 'online';}else{ echo 'offline';} ?> </td>
                        <td> <?= tanggalwaktu($b->last_login) ?> </td>
                        <td> 
                          <a href="<?= base_url().'admin/user/edit/'.$b->id_user ?>" class="btn btn-xs btn-primary">Edit</a>
                          <a href="<?= base_url().'admin/user/delete/'.$b->id_user ?>" class="btn btn-xs btn-danger">Delete</a></td>
                        </tr>

                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                </div>

              </div>
            </div>
            
          </div>
        </div>
      </section>
    </div>

    <div class="modal fade" id="modal-import">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Upload File Excel</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?= base_url().'admin/user/import' ?>">
              <div class="form-group col-md-12">
                <label for="exampleInputFile">File Excel</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="import_files" class="form-control" id="exampleInputFile">
                  </div>
                </div>
                <p class="text-danger"> format .xls</p>
                <?= form_error('import_files'); ?> 
              </div>
              <div class="form-group col-md-3">
                <input type="submit" class="form-control btn btn-primary" value="Upload">
              </div>

            </form>
            <div class="text-right"><a href="<?= base_url().'files/import_user.xls'?>">Download Format</a></div>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->