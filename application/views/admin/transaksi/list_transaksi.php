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
                <?= anchor('admin/transaksi/add','<div class="btn btn-sm btn-primary">Tambah Transaksi</div>') ?>
                <hr>
                <div class="table-responsive">
                  <table class="table table-bordered" id='data-table'>
                    <thead>
                      <tr>
                        <th> No </th>
                        <th> Approve </th>
                        <th> Kode Peminjaman </th>
                        <th> Tgl Peminjaman / Pengembalian </th>
                        <th> Nama Peminjam </th>
                        <th> Opsi </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; 

                      foreach ($transaksi as $b) : ?>

                        <tr>
                          <td> <?= $no++ ?> </td>
                          <td> 
                            <?php
                            if($b->status == 0){
                              $link = base_url().'admin/transaksi/edit/'.$b->kode_peminjaman;
                              $class = "btn btn-xs btn-success";
                              $text = "Edit";
                              echo "<div class='btn btn-xs btn-warning'>Pending</div>";
                            }
                            else {
                              $link = base_url().'admin/transaksi/cetak/'.$b->kode_peminjaman;
                              $class = "btn btn-xs btn-default";
                              $text = "Cetak";
                              echo "<div class='btn btn-xs btn-success'>Approve</div>";
                            }

                            if($b->tgl_pengembalian == "0000-00-00 00:00:00"){
                              $tgl_pengembalian = "<span class='btn btn-xs btn-danger'>Belum Kembali</span> ";
                            }
                            else {
                             $tgl_pengembalian = tanggal($b->tgl_pengembalian);
                           }
                           ?> 
                         </td>
                         <td> <?= $b->kode_peminjaman ?> </td>
                         <td> <?= tanggal($b->tgl_peminjaman).' / '.$tgl_pengembalian ?> </td>
                         <td> <?= $b->nama_peminjam?> </td>
                         <td> 
                          <a href="<?= base_url().'admin/transaksi/view_detail/'.$b->kode_peminjaman?>" class="btn btn-xs btn-success">Detail</a>
                          <a href="<?= $link ?>" class="<?= $class ?>"><?= $text ?></a>
                          <a href="<?= base_url().'admin/transaksi/delete/'.$b->kode_peminjaman ?>" class="btn btn-xs btn-danger">Delete</a></td>
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

