  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $judul ?> <button onclick="window.print()">Cetak</button></h1>
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
                    <dl>
                      <dt> Kode Peminjaman </dt>
                      <dd> <?= $peminjam->kode_peminjaman ?> </dd>
                      <dt> Tanggal Peminjaman  </dt>
                      <dd> <?= tanggal($peminjam->tgl_peminjaman) ?> </dd>
                    </dl>
                   
                 </div>
                 <div class="col-md-6">
                  <dl>
                      <dt> Nama Peminjam </dt>
                      <dd> <?= $peminjam->nama_peminjam ?> </dd>
                      <dt> No. Kontak  </dt>
                      <dd> <?= $peminjam->no_hp ?> </dd>
                    </dl>
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

              <table>
                <tr>
                  <td width="200"></td>
                  <td width="300" align="center"> 
                    Petugas 
                    <br><br><Br><bR><Br> (.............................)
                  </td>
                  <td width="300" align="center"> 
                    Peminjam 
                    <br><br><Br><bR><Br> (.............................)
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  window.print();
</script>