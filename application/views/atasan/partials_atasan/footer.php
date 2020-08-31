<!-- Main Footer -->
<footer class="main-footer">
	<strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 3.0.4
	</div>
</footer>
</div>
<?php if($this->session->userdata('logged_in')) : ?>

<div class="modal fade" id="modal-changepassword">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ganti Password</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?= base_url().'admin/user/change_password' ?>">
					<div class="form-group col-md-8">
						<label for="nama">Password</label>
						<input type="password" class="form-control" id="exampleInputEmail1" name="password" >
						<?= form_error('password'); ?>
					</div>
					<div class="form-group col-md-8">
						<label for="nama">Konfirmasi Password</label>
						<input type="password" class="form-control" id="exampleInputEmail1" name="konfirmasi_password" >
						<?= form_error('konfirmasi_password'); ?>

						<input type="hidden" name="username" value="<?= $this->session->userdata('username') ?>">
					</div>
					<div class="form-group col-md-3">
						<input type="submit" class="form-control btn btn-primary" value="Ubah Password">
					</div>

				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
    <!-- /.modal -->
<?php endif; ?>