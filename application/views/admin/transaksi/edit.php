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
						<li class="breadcrumb-item"><a href="<?= base_url().'admin/barang' ?>"><?= $judul ?></a></li>
						<li class="breadcrumb-item active">Edit Transaksi</li>
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
									<form method="POST" action="<?= base_url() ?>admin/transaksi/add_barang">
										<div class="input-group col-md-12">
											<input type="text" class="form-control" id="exampleInputEmail1" name="kode_barang" value="<?= set_value('kode_barang') ?>" placeholder="Masukkan Kode Barang" autofocus>
											<input type="hidden" name="kode_peminjaman" value="<?= $peminjaman->kode_peminjaman ?>">
											<div class="input-group-btn">
												<input type="submit" value="Cari" class="form-control">
											</div>
										</div>
										<?= form_error('kode_barang'); ?>
									</form>
								</div>
							</div>
							<br>
							<div class="row">
								<table class="table table-bordered table-striped table-hover">
									<tr>
										<th> No. </th>
										<th> Nama Barang </th>
										<th> Kode Barang </th>
										<th> Jumlah </th>
										<th> Opsi </th>
									</tr>
							<form method="POST" action="<?= base_url().'admin/transaksi/update' ?>">
									<?php $no=1; foreach($barang as $items) : ?>
									<tr>
										<td> <?= $no++ ?></td>
										<td> <?= $items->nama_barang ?></td>
										<td> <input type="hidden" name="id_barang[]" value="<?= $items->id_barangd ?>"><?= $items->kode_barang ?></td>
										<td> <input type=text name="jumlah[]" value="<?= $items->jumlah ?>" class="form-control" size=1 maxlength=3></td>
										<td> <a href="<?= base_url().'admin/transaksi/remove/'.$items->kode_peminjaman.'/'.$items->id_barangd ?>" class="btn btn-sm btn-danger">Hapus</a></td>
									</tr>
								<?php endforeach; ?>
								<?= form_error('id_barang'); ?>
							</table>
						</div>
						
							<div class="row">
								<div class="form-group col-md-6">
									<label for="nama">Nama Peminjam</label>
									<input type="text" class="form-control" id="exampleInputEmail1" name="nama_peminjam" value="<?= $peminjaman->nama_peminjam ?>">
									<?= form_error('nama_peminjam'); ?>
								</div>
								<input type="hidden" name="kode_peminjaman" value="<?= $peminjaman->kode_peminjaman?>">
								<div class="form-group col-md-6">
									<label for="nama">No. Kontak</label>
									<input type="text" class="form-control" id="exampleInputEmail1" name="no_hp" value="<?= $peminjaman->no_hp ?>">
									<?= form_error('no_hp'); ?>
								</div>
							</div>

							<div class="row">
								<input type="submit" class="btn btn-md btn-success col-md-12" value="Update" >
							</div>

						</form>
					</div>


				</div>
			</div>
		</div>
	</div>
</section>
</div>