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
						<li class="breadcrumb-item active">Tambah Barang</li>
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
						<form enctype="multipart/form-data" method="POST" action="<?= base_url() ?>admin/barang/add_action">
							<div class="card-body">
								<div class="form-group col-md-8">
									<label for="nama">Kode Barang</label>
									<input type="text" class="form-control" id="exampleInputEmail1" name="kode_barang" value="<?= set_value('kode_barang') ?>">
									<?= form_error('kode_barang'); ?>
								</div>
								<div class="form-group col-md-8">
									<label for="nama">Nama Barang</label>
									<input type="text" class="form-control" id="exampleInputEmail1" name="nama_barang" value="<?= set_value('nama_barang') ?>">
									<?= form_error('nama_barang'); ?>
								</div>
								<div class="form-group col-md-3">
									<label for="nama">Jumlah</label>
									<input type="text" class="form-control" id="exampleInputEmail1" name="qty" value="<?= set_value('qty') ?>">
									<?= form_error('qty'); ?>
								</div>
								<div class="form-group col-md-3">
									<label for="nama">Satuan</label>
									<input type="text" class="form-control" id="exampleInputEmail1" name="satuan" value="<?= set_value('satuan') ?>">
									<?= form_error('satuan'); ?>
								</div>
								<div class="form-group col-md-1">
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