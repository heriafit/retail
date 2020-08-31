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
						<li class="breadcrumb-item active">Tambah Transaksi</li>
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
									<form method="POST" action="<?= base_url() ?>admin/cart/add">
										<div class="input-group col-md-12">
											<input type="text" class="form-control" id="exampleInputEmail1" name="kode_barang" value="<?= set_value('kode_barang') ?>" placeholder="Masukkan Kode Barang" autofocus>
											
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
							<form method="POST" action="<?= base_url().'admin/transaksi/add_action' ?>">
									<?php $no=1; $no1=1; $no2=1; $no3=1; foreach($this->cart->contents() as $items) : ?>
									<tr>
										<td> <?= $no++ ?></td>
										<td> <?= $items['name'] ?></td>
										<td> <input type="hidden" name="rowid[]" value="<?= $items['rowid'] ?>"><?= $items['options']['kode'] ?></td>
										<td> 
											<input type=text name="jumlah[]" value="<?= $items['qty'] ?>" class="form-control" size=1 maxlength=3 id="in<?= $no1++ ?>" oninput="myFunction()">
											<input type=hidden id="stok<?= $no2++ ?>" value="<?= $items['options']['stok'] ?>">
											<p class="text-center" id="demo<?= $no3++ ?>"></p>

										</td>
										<td> <a href="<?= base_url().'admin/cart/remove/'.$items['rowid'] ?>" class="btn btn-sm btn-danger">Hapus</a></td>
									</tr>
								<?php endforeach; ?>
								<?= form_error('rowid'); ?>
							</table>
						</div>
						
							<div class="row">
								<div class="form-group col-md-6">
									<label for="nama">Nama Peminjam</label>
									<input type="text" class="form-control" id="exampleInputEmail1" name="nama_peminjam" value="<?= set_value('nama_peminjam') ?>">
									<?= form_error('nama_peminjam'); ?>
								</div>
								<div class="form-group col-md-6">
									<label for="nama">No. Kontak</label>
									<input type="text" class="form-control" id="exampleInputEmail1" name="no_hp" value="<?= set_value('no_hp') ?>">
									<?= form_error('no_hp'); ?>
								</div>
							</div>

							<div class="row">
								<input type="submit" class="btn btn-md btn-success col-md-12" value="Input" >
							</div>

						</form>
					</div>


				</div>
			</div>
		</div>
	</div>
</section>
</div>

