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
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<a href="<?= base_url().'admin/barang/add' ?>" class="btn btn-sm btn-primary col-md-2"> Tambah Barang Baru </a>
								</div>
								<br><br>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form method="POST" action="">
										<div class="input-group col-md-12">
											<select class="form-control select2" name="kode_barang" required autofocus>
												<option value=""> Cari Barang </option>
												<?php foreach($barang as $b) : ?>
													<option value="<?= $b->kode_barang ?>"> <?= $b->nama_barang ?></option>
												<?php endforeach; ?>
											</select>

											<div class="input-group-btn">
												<input type="submit" value="Cari" name="search" class="form-control">
											</div>
										</div>
									</form>
								</div>
							</div>
							<hr>
							<div class="row">
								<?php if(isset($_POST['search'])) : 
									$where = array('kode_barang'=>$_POST['kode_barang']);
									$data_barang = $this->barang_model->get_data($where,'barang')->row(); 
								?>
								
								<div class="col-md-12">
									<div class="row">
									
									<div class="col-md-6">
										<form method="POST" action="<?= base_url().'admin/barang/add_action_masuk' ?>">
										<div class="form-group col-md-12">
											<label for="nama">Kode Barang</label>
											<input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data_barang->kode_barang ?>" disabled>
											<input type="hidden" value="<?= $data_barang->kode_barang ?>" name="kode_barang">
										</div>
										<div class="form-group col-md-12">
											<label for="nama">Nama Barang</label>
											<input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data_barang->nama_barang ?>" disabled>
										</div>
										<div class="form-group col-md-12">
											<label for="nama">Stok</label>
											<input type="text" class="form-control" id="exampleInputEmail1" value="<?= $data_barang->qty." ".$data_barang->satuan ?>" disabled>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group col-md-12">
											<label for="nama">Jumlah Barang yang masuk</label>
											<input type="number" class="form-control" id="exampleInputEmail1" name="jumlah" value="<?= set_value('jumlah') ?>" required>
											<?= form_error('jumlah'); ?>
										</div>
										<div class="form-group col-md-12">
											<label for="nama">Nama Pengirim</label>
											<input type="text" class="form-control" id="exampleInputEmail1" name="nama_pengirim" value="<?= set_value('nama_pengirim') ?>" required>
											<?= form_error('nama_pengirim'); ?>
										</div>
										<div class="form-group col-md-12">
											<label for="nama">No Kontak</label>
											<input type="text" class="form-control" id="exampleInputEmail1" name="no_hp" value="<?= set_value('no_hp') ?>" required>
											<?= form_error('no_hp'); ?>
										</div>
										<div class="form-group col-md-12">
											<input type="submit" class="btn btn-sm btn-primary col-md-12" value="Submit">
										</div>
									</div>
									</form>
								</div>
								</div>
								<?php endif; ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>