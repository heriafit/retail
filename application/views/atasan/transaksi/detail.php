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
                <div class="row">
                  <div class="col-md-6">
                   <label> Kode Peminjaman</label> : <?= $peminjam->kode_peminjaman ?> <br>
                   <label> Tanggal Peminjaman </label> : <?= tanggal($peminjam->tgl_peminjaman) ?>
                 </div>
                 <div class="col-md-6">
                   <label> Nama Peminjam </label> : <?= $peminjam->nama_peminjam." / ".$peminjam->no_hp ?>
                 </div>
               </div>
               <br>
               <div class="row">
                <b>Detail Barang yang dipinjam :</b>
                <table class="table table-bordered table-striped">
                  <tr>
                    <th> No </th>
                    <th> Kode Barang </th>
                    <th> Nama Barang </th>
                    <th> Jumlah </th>
                  </tr>
                  <?php $no=1;
                  foreach($barang as $b) :
                    ?> 
                    <tr>
                      <td> <?= $no++ ?></td>
                      <td> <?= $b->kode_barang ?></td>
                      <td> <?= $b->nama_barang ?></td>
                      <td> <?= $b->jumlah." ".$b->satuan ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tr>
              </table>
            </div>
            <div class="row">
              <?php
                if($peminjam->status == 0){
                  $link = base_url().'atasan/transaksi/approve/'.$peminjam->kode_peminjaman;
                  $class = "btn btn-sm btn-success";
                  $text = "Approve";
                }
                else {
                  $link = base_url().'atasan/transaksi/';
                  $class = "btn btn-sm btn-warning";
                  $text = "Telah disetujui";
                }
              ?>
              <a href="<?= $link ?>" class="<?= $class ?> col-md-12"> <b><?= $text ?></b> </a>
            </div>


          </div>
        </div>

      </div>
    </div>
  </section>
</div>

