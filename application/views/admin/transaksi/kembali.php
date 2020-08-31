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
						<li class="breadcrumb-item"><a href="<?= base_url().'admin/transaksi' ?>"><?= $judul ?></a></li>
						<li class="breadcrumb-item active">Pengembalian</li>
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
						
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<?php if($this->session->flashdata('message')){
										echo $this->session->flashdata('message');
									}
									?>
									<form method="POST" action="">
										<div class="input-group col-md-12">
											<input type="text" class="form-control" id="exampleInputEmail1" name="kode_peminjaman" value="<?= set_value('kode_peminjaman') ?>" placeholder="Masukkan Kode Peminjaman" required autofocus>
											
											<div class="input-group-btn">
												<input type="submit" value="Cari" name="search" class="form-control">
											</div>
										</div>
										<?= form_error('kode_peminjaman'); ?>
									</form>
								</div>
							</div>
							<br>
						<?php if(isset($_POST['search'])) : 
								$where = array('kode_peminjaman'=>$_POST['kode_peminjaman']);

								$peminjam = $this->transaksi_model->get_data($where,'peminjaman');
								if($peminjam->num_rows() > 0 ) :
									$peminjam = $this->transaksi_model->get_data($where,'peminjaman')->row();
									if($peminjam->tgl_pengembalian != "0000-00-00 00:00:00") {
										echo "Sudah kembali";
									}
									if ($peminjam->tgl_pengembalian == "0000-00-00 00:00:00") :

						?>
							<div class="row">
								<div class="col-md-6">
									<dl>
										<dt> Nama 
											<dd> <?= $peminjam->nama_peminjam ?></dd>
										</dt>
										<dt> No. Kontak 
											<dd> <?= $peminjam->no_hp ?></dd>
										</dt>
									</dl>

								</div>
								<div class="col-md-6">
									<dl>
										<dt> Kode Peminjaman 
											<dd> <?= $peminjam->kode_peminjaman ?></dd>
										</dt>
										<dt> Tanggal Peminjaman 
											<dd> <?= tanggal($peminjam->tgl_peminjaman) ?></dd>
										</dt>
									</dl>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-striped table-bordered">
										<tr>
											<th> No. </th>
											<th> Kode Barang </th>
											<th> Nama Barang </th>
											<th> Jumlah </th>
										</tr>
										<?php $no=1; $barang = $this->transaksi_model->get_barang($peminjam->kode_peminjaman)->result(); foreach($barang as $b) : ?>
										<tr>
											<td> <?= $no++ ?></td>
											<td> <?= $b->kode_barang ?></td>
											<td> <?= $b->nama_barang ?></td>
											<td> <?= $b->jumlah ?></td>
										</tr>
										<?php endforeach; ?>
									</table>
								</div>
								<div class="col-md-12">
									<a href="<?= base_url().'admin/transaksi/kembali_action/'.$peminjam->kode_peminjaman ?>" class="btn btn-sm btn-success col-md-12"> Selesai </a>
								</div>
							</div>
						<?php endif; endif; endif; ?>
					</div>


				</div>
			</div>
		</div>
	</div>
</section>
</div>

