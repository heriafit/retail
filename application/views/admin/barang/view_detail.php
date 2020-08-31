
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
                <table class="table table-striped table-striped table-bordered">
                  <tr>
                    <th> No </th>
                    <th> Tanggal </th>
                    <th> Keterangan </th>
                    <th> Jumlah </th>
                    <th> No. Transaksi </th>
                  </tr>
                  <?php $no=1; foreach($barang as $b) : ?>
                    <tr>
                      <td> <?= $no++ ?></td>
                      <td> <?= tanggal($b->tanggal)?></td>
                      <td> <?= $b->ket ?></td>
                      <td> <?= $b->jumlah ?></td>
                      <td> <?= $b->kode_transaksi ?></td>
                    </tr>
                  <?php endforeach; ?>
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



