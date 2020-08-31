  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kelola Barang</h1>
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
                <br>
                <br>
                <div class="table-responsive">
                <table class="table table-bordered" id='data-table'>
                  <thead>
                    <tr>
                      <th> No </th>
                      <th> Kode Barang </th>
                      <th> Nama Barang </th>
                      <th> Jumlah </th>
                      <th> Opsi </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; 

                    foreach ($barang as $b) : ?>

                      <tr>
                        <td> <?= $no++ ?> </td>
                        <td> <?= $b->kode_barang ?> </td>
                        <td> <?= $b->nama_barang ?> </td>
                        <td> <?= $b->qty." ".$b->satuan ?> </td>
                        <td> 
                          <a href="<?= base_url().'atasan/barang/view_detail/'.$b->kode_barang?>" class="btn btn-xs btn-success">Lihat Progress</a>
                         </td>
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

