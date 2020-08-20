<?php
if (isset($this->session->userlogin)==FALSE) {
redirect(); //= memanggil routes nya boleh di isi redirect('signin/login')
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- untuk hape -->
	<meta http-equiv="content-Language" content="en-us">
	<meta charset="utf-8">
	<link rel="icon" href="<?php echo base_url('image/era.jpg') ?>" type="image/ico" />
	
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
	<!-- jQuery -->
    <script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js')?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js')?>"></script>

	<link href='<?php echo base_url('cash.png') ?>' rel='shortcut icon'>

	<!-- tambahan -->
 <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/vendors/iCheck/skins/flat/green.css')?>" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('assets/vendors/jqvmap/dist/jqvmap.min.css')?>" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/build/css/custom.min.css')?>" rel="stylesheet">


</head>

<body class="nav-md">
		<div class="container body">
			<div class="main_container">
					<?php $this->load->view('sampingatasmenu.php'); ?>
			          <?php $this->load->view('topnav'); ?>
				 

			        <!-- page content -->
			       <div class="right_col" role="main">


					<div class="container" style="width: 100% ; ">									
						<div class="col-sm-12">
									<!-- untuk isi -->
								<div class="panel panel-info">
											<div class="panel-heading">Formulir Input Karyawan Baru</div>

									<div class="panel-body">
												<?php if (isset($pesan)) {?>
													<div class="alert alert-danger" role="alert">
														<button type="button" class="close" data-dismiss="alert"> X </button>
														<h4>Peringatan</h4>
														<?php echo $pesan; ?>
													</div>
												<?php } ?>
												<!-- awal pembuatan form -->

											<form class="form-horizontal" action="<?php echo base_url('CKaryawan/savekaryawan') ?>" method="POST" name="formbook" enctype="multipart/form-data">

											<div class="col-sm-6">
													<div class="form-group">
														<label class="col-sm-2 control-label">Nik Karyawan</label>
														<div class="col-sm-2">
														<input type="text" name="id" placeholder="isi Id Karyawan...!">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Nama Karyawan</label>
														<div class="col-sm-2">
														<input type="text" name="nama" placeholder="isi nama Karyawan...">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Alamat</label>
														<div class="col-sm-2">
															<textarea name="alm" placeholder="isi alamat"></textarea>
														<!-- <input type="textarea" name="alm" placeholder="isi alamat..."> -->
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Tempat lahir</label>
														<div class="col-sm-2">
														<input type="text" name="tmptlhr" onkeypress ="">
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Tanggal lahir</label>
														<div class="col-sm-2">
														<input type="date" name="tgllahir" onkeypress ="">
														</div>
													</div>


													<div class="form-group">
														<label class="col-sm-2 control-label">Id Department</label>
														<div class="col-sm-4">
															<select  class="form-control " id="depart" name="depart">
															<option value="">Pilih</option> 
															<?php 
															if ($datakombo->num_rows() > 0) {
															foreach ($datakombo->result() as $row ) {
																echo "<option value='$row->idDepartment'>
																$row->nmDepart
																</option>";

																}
															}
																?>
															</select>
														<!-- <?php 
														///$js='class="form-control select2"';
														//echo form_dropdown('depart',$datakombo,'',$js);
														?>  -->
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Position</label>
														<div class="col-sm-2">
														<input type="text" name="posisi" onkeypress ="">
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Id Shift</label>
														<div class="col-sm-4">
															<select  class="form-control " id="shf" name="shf">
															<option value="">Pilih</option> 
															<?php 
															if ($data2->num_rows() > 0) {
															foreach ($data2->result() as $row ) {
																echo "<option value='$row->idShift'>
																$row->ShiftName
																</option>";

																}
															}
																?>
															</select>
														<!-- <?php 
														///$js='class="form-control select2"';
														//echo form_dropdown('depart',$datakombo,'',$js);
														?>  -->
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Jenis Kelamin</label>
														<div class="col-sm-5">
														<input type="radio" name="jk" value="Laki-Laki">Laki-Laki <br>
														<input type="radio" name="jk" value="Perempuan">Perempuan

														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Telepon</label>
														<div class="col-sm-2">
														<input type="text" name="tlp" onkeypress="return hanyaAngka(event)">
														</div>
													</div>

												
													
													
											</div>
													
												<div class="col-sm-6">

													<div class="form-group">
														<label class="col-sm-2 control-label">Nama Bank</label>
														<div class="col-sm-4">
															<select  class="form-control " id="nmBank" name="nmBank">
															<option value="">Pilih</option> 
															<?php 
															if ($databank->num_rows() > 0) {
															foreach ($databank->result() as $row ) {
																echo "<option value='$row->idBank'>
																$row->nm_Bank
																</option>";

																}
															}
																?>
															</select>
														<!-- <input type="text" name="nmBank" onkeypress ="return hanyaChar(event)"> -->
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Account No.Bank</label>
														<div class="col-sm-1">
														<input type="text" name="accNo" onkeypress ="return hanyaAngka(event)">
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Status</label>
														<div class="col-sm-4">
														<!-- <input type="text" name="status" onkeypress =""> -->
														<select  class="form-control " id="status" name="status">
															<option value="">Pilih</option> 
															<option value="Single">Single</option>
															<option value="Married">Married</option>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Anak</label>
														<div class="col-sm-4">
														<!-- <input type="text" name="anak" onkeypress =""> -->
														<select  class="form-control " id="anak" name="anak">
															<option value="">Pilih</option> 
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>

															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">NPWP</label>
														<div class="col-sm-2">
														<input type="text" name="npwp" onkeypress ="return hanyaAngka(event)">
														</div>	
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Gaji</label>
														<div class="col-sm-2">
														<input type="text" name="gaji" onkeypress="return hanyaAngka(event)">
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Foto</label>
														<div class="col-sm-2">
														<input type="File" name="ft">
														</div>
													</div>
													<div class="form-group">
															<label class="col-sm-2 control-label"></label>
															<div class="col-sm-6">
															<button type="submit" class="btn btn-primary" name="proses" value="proses"><span class="glyphicon glyphicon-save"></span>Simpan</button>
															</div>
													</div>
													

												</div>
													
											<!-- </div> tutup colom input -->
											
												
										</form>
											
									</div>
								</div>
						</div>

							
					</div>
			</div>
		</div>

					<!-- tutup page content -->
					        <!-- footer content -->
			        <footer>
			          <div class="pull-right">
			           Copyright &copy; Koperasi Sahabat Mandiri
			          </div>
			          <div class="clearfix"></div>
			        </footer>
			        <!-- /footer content -->
			      
		</div>
			  

</body>


  	<!-- jQuery -->
<script src="assets/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assets/AdminLTE/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/AdminLTE/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets/AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/AdminLTE/plugins/moment/moment.min.js"></script>
<script src="assets/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/AdminLTE/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/AdminLTE/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/AdminLTE/dist/js/demo.js"></script>

    
</html>
<script type="text/javascript">
		function hanyaAngka(evt) {
				// alert('a');
				  var charCode = (evt.which) ? evt.which : event.keyCode;
				   if (charCode > 31 && (charCode < 48 || charCode > 57))
		 
				    return false;
				  return true;
				}
				function hanyaChar(evt){
				// alert('a');

					 var charCode = (evt.which) ? evt.which : event.keyCode;
			         if ((charCode < 65) || (charCode == 32))
			            return false;        
			         return true;
				}
</script>

